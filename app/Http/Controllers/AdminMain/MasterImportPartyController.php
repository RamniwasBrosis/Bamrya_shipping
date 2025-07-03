<?php

namespace App\Http\Controllers\AdminMain;

use App\Models\MasterParty;
use Illuminate\Http\Request;
use App\Models\MasterImportParty;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MasterImportPartyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = MasterImportParty::query();

        if($request->filled('party_name')){
            $query->where('party_name', 'LIKE', '%'.$request->party_name.'%');
        }
        
        $importParties = $query->orderBy('created_at', 'desc')->paginate(10);
        
        return view('admin-main.admin.party.import.index', compact('importParties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parties = MasterParty::all();
        return view('admin-main.admin.party.import.create', compact('parties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'party_code'      => 'nullable|string|max:255',
            'party_name'      => 'required|string|max:255',
            'ledger_name'    => 'nullable|string|max:255',
            'address_1'   => 'nullable|string|max:255',
            'address_2'   => 'nullable|string|max:255',
            'address_3'   => 'nullable|string|max:255',
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
        ]);

        $masterParty =  new MasterImportParty();
        $masterParty->company_id =  Auth::user()->company_id;
        $masterParty->uuid = Str::uuid();
        $masterParty->party_code = $validated['party_code'];
        $masterParty->party_name = $validated['party_name'];

        $masterParty->tally_ledger = $validated['ledger_name'];
        $masterParty->address_line1 = $validated['address_1'];
        $masterParty->address_line2 = $validated['address_2'];
        $masterParty->address_line3 = $validated['address_3'];

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
        $masterParty->status = $validated['status'];

        if(!$validated['party_code']){
            $masterParty->party_code = '0';
        }

        $masterParty->save();

        return redirect()->route('import-parties.index')->with('success', 'Party created successfully.');
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
        $partyTypes = MasterParty::all();

        $importParty = MasterImportParty::findOrFail($id);
        return view('admin-main.admin.party.import.edit', compact('partyTypes', 'importParty'));
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
            'ledger_name'    => 'nullable|string|max:255',
            'address_1'   => 'nullable|string|max:255',
            'address_2'   => 'nullable|string|max:255',
            'address_3'   => 'nullable|string|max:255',
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
        ]);

        $party = MasterImportParty::findOrFail($id);
        $party->update($request->all());

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

}
