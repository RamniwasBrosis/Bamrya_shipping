<?php

namespace App\Http\Controllers\AdminMain;

use App\Models\MasterParty;
use Illuminate\Http\Request;
use App\Models\MasterImportParty;
use App\Models\MasterBillingParty;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\ImportPartyExport;

class MasterImportPartyController extends Controller
{
    public $company_id ;

    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->company_id = Auth::user()->company_id;
            $this->user_id = auth()->user()->id;
            return $next($request);
        });
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $page_title = 'Import Parties';
    
        $query = MasterImportParty::with('party')
            ->where('company_id', $this->company_id);
    
        $partyType = $request->party_type;
    
        // Party Name
        if ($request->filled('party_name')) {
            $query->where('party_name', 'LIKE', '%' . $request->party_name . '%');
        }
    
        // Party Type
        if ($request->filled('party_type')) {
            $query->where('party_type', $request->party_type);
        }
    
        // Party Mode
        if ($request->filled('party_mode') && $request->party_mode != 'all') {
            $query->where('party_mode', $request->party_mode);
        }
    
        // Export
        if ($request->action == 'export') {
    
            $importParties = $query
                ->orderBy('created_at', 'desc')
                ->get();
    
            if ($request->export_type == 'excel') {
                return Excel::download(
                    new ImportPartyExport($importParties),
                    'Import-Parties.xlsx'
                );
            }
    
            if ($request->export_type == 'pdf') {
                $pdf = Pdf::loadView(
                    'admin-main.admin.party.import.pdf',
                    compact('importParties', 'partyType')
                );
    
                return $pdf->download('Import-Parties.pdf');
            }
        }
    
        $importParties = $query
            ->orderBy('created_at', 'desc')
            ->paginate(25);
    
        $partyNameList = MasterImportParty::where('company_id', $this->company_id)
            ->orderBy('party_name')
            ->get();
    
        return view(
            'admin-main.admin.party.import.index',
            compact('page_title', 'importParties', 'partyNameList')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $page_title = 'Import Party Create';
        $parties = MasterParty::whereNotIn('party_type', [2])->get();
        return view('admin-main.admin.party.import.create', compact('page_title','parties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'party_code'      => 'nullable|string|max:255',
            'party_name'      => 'required|string|max:255',
            'address_1'       => 'required|string|max:255',
            'address_2'       => 'nullable|string|max:255',
            // 'address_3'       => 'nullable|string|max:255',
            // 'ledger_name'     => 'nullable|string|max:255',
            'city'            => 'nullable|string|max:255',
            'pincode'         => 'nullable|string|max:20',
            'party_type'      => 'required|string|max:100',
            'contact_person'  => 'nullable|string|max:255',
            'tel_no'          => 'nullable|string|max:20',
            'email'           => 'nullable|email|max:255',
            'gstin'           => 'nullable|string|max:20',
            'pan_no'          => 'nullable|string|max:10',
            'cin_no'          => 'nullable|string|max:21',
            'credit_days'     => 'nullable|integer|min:1',
            'tds_percent'     => 'nullable|integer|min:0|max:100',
            'status'          => 'required|boolean',
            'state'           => 'nullable|string|max:50',
            'state_code'      => 'nullable|string|max:50',
        ];
        
        // Check approval condition
        $checkApproval = DB::table('master_parties_enable_features')
            ->where('company_id', $this->company_id)->where('isOtherParties', 1)
            ->first();
            
            
        if ($checkApproval && $checkApproval->isFeatured == 0 && $request->party_mode === 'local') {
            $rules['documents'] = 'required|array|min:1';
            $rules['documents.*'] = 'file|mimes:pdf,doc,docx,jpg,png|max:5120';
        }
    
        $validated = $request->validate($rules);
        
        $existsInImport = \DB::table('master_import_parties')
            ->where('party_name', $request->party_name)
            ->where('company_id', '=', $this->company_id) 
            ->exists();
        if ($existsInImport) {
            return response()->json([
                'success' => false,
                'message' => 'Party name already exists in Import parties.'
            ]);
        }
        
        $paths = [];
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                $path = $file->store('party-documents', 'public');
        
                $paths[] = [
                    'name' => $file->getClientOriginalName(),
                    'path' => $path,
                    'type' => $file->getClientMimeType(),
                    'size' => $file->getSize(),
                ];
            }
        }
        
        $masterParty =  new MasterImportParty();
        $masterParty->company_id =  Auth::user()->company_id;
        $masterParty->uuid = Str::uuid();
        $masterParty->party_code = $validated['party_code'];
        $masterParty->party_name = $validated['party_name'];

        // $masterParty->tally_ledger = $validated['ledger_name'] ?? '';
        $masterParty->address_line1 = $validated['address_1'];
        $masterParty->address_line2 = $validated['address_2'];
        // $masterParty->address_line3 = $validated['address_3'] ?? '';

        $masterParty->city = $validated['city'];
        $masterParty->pincode = $validated['pincode'];
        $masterParty->party_type = $validated['party_type'];
        $masterParty->contact_person = $validated['contact_person'];

        $masterParty->tel_no = $validated['tel_no'];
        $masterParty->email = $validated['email'];
        $masterParty->gstin = $validated['gstin'];
        $masterParty->pan_no = $validated['pan_no'];

        $masterParty->cin_no = $validated['cin_no'];
        $masterParty->credit_days = $validated['credit_days'];
        $masterParty->tds_percent = $validated['tds_percent'];
        $masterParty->document = $paths;
        $masterParty->state = $validated['state'];
        $masterParty->state_code = $validated['state_code'];
        $masterParty->status = $validated['status'];
        $masterParty->user_id = $this->user_id;
    
        $masterParty->party_mode = $request->party_mode ?? '';

        if(!$validated['party_code']){
            $masterParty->party_code = '0';
        }
        
        $masterParty->save();
        
        if(isset($request->party_mode) && $masterParty->party_mode = 'local' && $masterParty->party_type == 1 ){
            $billing_data = $this->addBillingParty($request->all());
         }
        
        return response()->json([
            'success' => true,
            'redirect' => route('import-parties.index')
        ]);
    }
    
    private function addBillingParty($validated)
    {
        // First or Create with specific fields
        $billingParty = MasterBillingParty::firstOrCreate(
            [
                'party_name' => $validated['party_name'],
                'company_id' => $this->company_id // Optional: Add company_id if needed
            ],
            [
                'company_id' => $this->company_id,
                'uuid' => Str::uuid(),
                'party_code' => $validated['party_code'],
                'address_line1' => $validated['address_1'],
                'address_line2' => $validated['address_2'],
                'city' => $validated['city'],
                'pincode' => $validated['pincode'],
                'party_type' => $validated['party_type'],
                'contact_person' => $validated['contact_person'],
                'tel_no' => $validated['tel_no'],
                'email' => $validated['email'],
                'gstin' => $validated['gstin'],
                'pan_no' => $validated['pan_no'],
                'cin_no' => $validated['cin_no'],
                'credit_days' => $validated['credit_days'],
                'tds_percent' => $validated['tds_percent'],
                'status' => $validated['status'],
                'state'           => 'nullable|string|max:50',
                'state_code'      => 'nullable|string|max:50',
            ]
        );
    
        // If record exists, update it
        if ($billingParty->wasRecentlyCreated === false) {
            $billingParty->update($validated);
        }
        
        return $billingParty;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $page_title = 'Import Party Edit';
        $partyTypes = MasterParty::whereNotIn('party_type', [2])->get();

        $importParty = MasterImportParty::findOrFail($id);
        return view('admin-main.admin.party.import.edit', compact('page_title','partyTypes', 'importParty'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'company_id'      => 'required|integer',
            'party_code'      => 'nullable|string|max:255',
            'party_name'      => 'required|string|max:255',
            // 'ledger_name'    => 'nullable|string|max:255',
            'address_1'   => 'nullable|string|max:255',
            'address_2'   => 'nullable|string|max:255',
            // 'address_3'   => 'nullable|string|max:255',
            'city'            => 'nullable|string|max:255',
            'pincode'         => 'nullable|string|max:20',
            'party_type'      => 'nullable|string|max:100',
            'contact_person'  => 'nullable|string|max:255',
            'tel_no'          => 'nullable|string|max:20',
            'email'           => 'nullable|email|max:255',
            'gstin'           => 'nullable|string|max:20',
            'pan_no'          => 'nullable|string|max:10',
            'cin_no'          => 'nullable|string|max:21',
            'credit_days'     => 'nullable|integer|min:1',
            'tds_percent'     => 'nullable|integer|min:0|max:100',
            'status'          => 'required|boolean',
            'state'           => 'nullable|string|max:50',
            'state_code'      => 'nullable|string|max:50',
            'party_mode'      => 'nullable|string|max:50',
        ]);
        
        $masterParty = MasterImportParty::findOrFail($id);
        // echo "<pre>"; print_r($masterParty); exit();
        
        $documents = $masterParty->document ?? [];
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                $documents[] = [
                    'name' => $file->getClientOriginalName(),
                    'path' => $file->store('party-documents', 'public'),
                    'type' => $file->getClientMimeType(),
                    'size' => $file->getSize(),
                ];
            }
        }

        $masterParty->company_id = $validated['company_id'];
        $masterParty->party_code = $validated['party_code'];
        $masterParty->party_name = $validated['party_name'];

        // $masterParty->tally_ledger = $validated['ledger_name'];
        $masterParty->address_line1 = $validated['address_1'];
        $masterParty->address_line2 = $validated['address_2'];
        $masterParty->city = $validated['city'];
        $masterParty->pincode = $validated['pincode'];
        $masterParty->party_type = $validated['party_type'];
        $masterParty->contact_person = $validated['contact_person'];

        $masterParty->tel_no = $validated['tel_no'];
        $masterParty->email = $validated['email'];
        $masterParty->gstin = $validated['gstin'];
        $masterParty->pan_no = $validated['pan_no'];

        $masterParty->cin_no = $validated['cin_no'];
        $masterParty->credit_days = $validated['credit_days'];
        $masterParty->tds_percent = $validated['tds_percent'];
        $masterParty->document = array_values($documents);
        $masterParty->state = $validated['state'];
        $masterParty->state_code = $validated['state_code'];
        $masterParty->status = $validated['status'];
        $masterParty->user_id = $this->user_id;
        $masterParty->party_mode = $request->party_mode ?? '';

        if(!$validated['party_code']){
            $masterParty->party_code = '0';
        }

        $masterParty->save();
        
        if($masterParty->party_mode == 'local'){
            $this->addBillingParty($request->all());
        }

        return redirect()->route('import-parties.index')->with('success', 'Party updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $party = MasterImportParty::findOrFail($id);
        $party->delete();
        return response()->json(['status' => 'success', 'message' => 'Import Party record deleted successfully.']);
    }
    
    public function deleteDocument(Request $request, $id, $name)
    {
        $party = MasterImportParty::findOrFail($id);
        $documents = $party->document ?? [];
        $updatedDocuments = [];
    
        foreach ($documents as $doc) {
            if ($doc['name'] == $name) {
               
                if (isset($doc['path']) && Storage::exists($doc['path'])) {
                    Storage::delete($doc['path']);
                }
                continue; 
            }
    
            $updatedDocuments[] = $doc;
        }
        
        $party->document = array_values($updatedDocuments);
        $party->save();
    
        return back()->with('success', 'Document deleted successfully.');
    }
    
    

}
