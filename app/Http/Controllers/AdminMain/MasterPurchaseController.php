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

use App\Models\Accounts\PurchaseParties;

class MasterPurchaseController extends Controller
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
        $page_title = 'Purchase Parties';
        $query = PurchaseParties::where('company_id', $this->company_id);

        if($request->filled('party_name')){
            $query->where('party_name', 'LIKE', '%'.$request->party_name.'%');
        }
        
        $purchaseParties = $query->orderBy('created_at', 'desc')->paginate(10);
        
        $partyNameList = PurchaseParties::where('company_id', $this->company_id)->orderBy('party_name')->get();
        
        return view('admin-main.admin.party.purchase.index', compact('page_title','purchaseParties', 'partyNameList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $page_title = 'Purchase Party Create';
        
        return view('admin-main.admin.party.purchase.create', compact('page_title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'party_code'      => 'nullable|string|max:255',
            'party_name'      => 'required|string|max:255',
            'address_1'       => 'required|string|max:255',
            'address_2'       => 'nullable|string|max:255',
            'tally_ledger'     => 'nullable|string|max:255',
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
        ]);
        
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
        
        $masterParty =  new PurchaseParties();
        $masterParty->company_id =  Auth::user()->company_id;
        $masterParty->uuid = Str::uuid();
        $masterParty->party_code = $validated['party_code'];
        $masterParty->party_name = $validated['party_name'];

        $masterParty->tally_ledger = $validated['tally_ledger'] ?? '';
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
        $masterParty->state = $validated['state'];
        $masterParty->state_code = $validated['state_code'];
        $masterParty->status = $validated['status'];
        $masterParty->user_id = $this->user_id;
    
        $masterParty->party_mode = $request->party_mode ?? '';

        if(!$validated['party_code']){
            $masterParty->party_code = '0';
        }
        
        $masterParty->save();
        
        return response()->json([
            'success' => true,
            'redirect' => route('purchase-parties.index')
        ]);
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
        $page_title = 'Purchase Party Edit';

        $purchaseParty = PurchaseParties::findOrFail($id);
        return view('admin-main.admin.party.purchase.edit', compact('page_title', 'purchaseParty'));
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
            'tally_ledger'    => 'nullable|string|max:255',
            'address_1'   => 'nullable|string|max:255',
            'address_2'   => 'nullable|string|max:255',
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
        ]);

        $masterParty = PurchaseParties::findOrFail($id);
        
        $masterParty->company_id = $validated['company_id'];
        $masterParty->party_code = $validated['party_code'];
        $masterParty->party_name = $validated['party_name'];

        $masterParty->tally_ledger = $validated['tally_ledger'];
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
        $masterParty->state = $validated['state'];
        $masterParty->state_code = $validated['state_code'];
        $masterParty->status = $validated['status'];
        $masterParty->user_id = $this->user_id;

        if(!$validated['party_code']){
            $masterParty->party_code = '0';
        }

        $masterParty->save();

        return redirect()->route('purchase-parties.index')->with('success', 'Party updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $party = PurchaseParties::findOrFail($id);
        $party->delete();
        return response()->json(['status' => 'success', 'message' => 'Import Party record deleted successfully.']);
    }
    

}
