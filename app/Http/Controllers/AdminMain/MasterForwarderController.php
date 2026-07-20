<?php

namespace App\Http\Controllers\AdminMain;

use App\Models\MasterParty;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterForwarder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MasterForwarderController extends Controller
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
        $query = MasterForwarder::query();

        if($request->filled('party_name')){
            $query->where('party_name', 'LIKE', '%'.$request->party_name.'%');
        }
        
        $masterForwarder = $query->where('company_id', $this->company_id)->orderBy('created_at', 'desc')->paginate(10);
        
        return view('admin-main.admin.forwarder.index', compact('masterForwarder'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parties = MasterParty::all();
        return view('admin-main.admin.forwarder.create', compact('parties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'party_code'      => 'nullable|string|max:25',
            'party_name'      => 'required|string|max:25',
            'ledger_name'    => 'nullable|string|max:25',
            'address_1'   => 'nullable|string|max:100',
            'address_2'   => 'nullable|string|max:100',
            'address_3'   => 'nullable|string|max:100',
            'city'            => 'nullable|string|max:25',
            'pincode'         => 'nullable|string|max:20',
            // 'party_type'      => 'nullable|string|max:100',
            'contact_person'  => 'nullable|string|max:25',
            'tel_no'          => 'nullable|string|max:20',
            'email'           => 'nullable|email|max:50',
            'gstin'           => 'nullable|string|max:20',
            'pan_no'          => 'nullable|string|max:10',
            'cin_no'          => 'nullable|string|max:21',
            'credit_days'     => 'nullable|integer|min:1',
            'tds_percent'     => 'nullable|integer|min:0|max:100',
            'status'          => 'required|boolean',
        ]);
        
        $masterForwarder =  new MasterForwarder();
        $masterForwarder->company_id =  $this->company_id;
        $masterForwarder->uuid = Str::uuid();
        $masterForwarder->party_code = $validated['party_code'];
        $masterForwarder->party_name = $validated['party_name'];

        $masterForwarder->tally_ledger = $validated['ledger_name'];
        $masterForwarder->address_line1 = $validated['address_1'];
        $masterForwarder->address_line2 = $validated['address_2'];
        $masterForwarder->address_line3 = $validated['address_3'];

        $masterForwarder->city = $validated['city'];
        $masterForwarder->pincode = $validated['pincode'];
        // $masterForwarder->party_type = $validated['party_type'];
        $masterForwarder->contact_person = $validated['contact_person'];

        $masterForwarder->tel_no = $validated['tel_no'];
        $masterForwarder->email = $validated['email'];
        $masterForwarder->gstin = $validated['gstin'];
        $masterForwarder->pan_no = $validated['pan_no'];

        $masterForwarder->cin_no = $validated['cin_no'];
        $masterForwarder->credit_days = $validated['credit_days'];
        $masterForwarder->tds_percent = $validated['tds_percent'];
        $masterForwarder->status = $validated['status'];
        $masterForwarder->user_id = $this->user_id;

        if(!$validated['party_code']){
            $masterForwarder->party_code = '0';
        }

        $masterForwarder->save();

        return redirect()->route('forwarders.index')->with('success', 'Forwarder created successfully.');
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
    public function edit(string $id)
     {
        $partyTypes = MasterParty::all();

        $forwarderParty = MasterForwarder::where('company_id', $this->company_id)->find($id);
        
        return view('admin-main.admin.forwarder.edit', compact('forwarderParty', 'partyTypes'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'company_id'      => 'required|integer',
            'party_code'      => 'nullable|string|max:25',
            'party_name'      => 'required|string|max:25',
            'tally_ledger'    => 'nullable|string|max:25',
            'address_line1'   => 'nullable|string|max:100',
            'address_line2'   => 'nullable|string|max:100',
            'address_line3'   => 'nullable|string|max:100',
            'city'            => 'nullable|string|max:25',
            'pincode'         => 'nullable|string|max:20',
            // 'party_type'      => 'nullable|string|max:100',
            'contact_person'  => 'nullable|string|max:25',
            'tel_no'          => 'nullable|string|max:20',
            'email'           => 'nullable|email|max:255',
            'gstin'           => 'nullable|string|max:20',
            'pan_no'          => 'nullable|string|max:10',
            'cin_no'          => 'nullable|string|max:21',
            'credit_days'     => 'nullable|integer|min:1',
            'tds_percent'     => 'nullable|integer|min:0|max:100',
            'status'          => 'required|boolean',
        ]);
        $validated['user_id'] = $this->user_id;
        
        $forwarder = MasterForwarder::find($id);
        $forwarder->update($validated);

        return redirect()->route('forwarders.index')->with('success', 'Forwarder updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $party = MasterForwarder::findOrFail($id);
        $party->delete();
        return response()->json(['status' => 'success', 'message' => 'Forwarder record deleted successfully.']);
    }
}
