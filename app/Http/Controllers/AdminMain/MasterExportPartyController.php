<?php

namespace App\Http\Controllers\AdminMain;

use App\Models\MasterParty;
use Illuminate\Http\Request;
use App\Models\MasterExportParty;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MasterExportPartyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = MasterExportParty::query();
        if($request->filled('party_name')){
            $query->where('party_name', 'LIKE', '%'.$request->party_name.'%');
        }
        $exportParties = $query->orderBy('created_at', 'desc')->paginate(10);

        $partyNameList = MasterExportParty::orderBy('party_name')->get();

        return view('admin-main.admin.party.export.index', compact('exportParties', 'partyNameList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $partyTypes = MasterParty::all();
        return view('admin-main.admin.party.export.create', compact('partyTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'party_code'      => 'nullable|string|max:255',
            'party_name'      => 'required|string|max:255',
            // 'ledger_name'    => 'nullable|string|max:255',
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

        $masterParty =  new MasterExportParty();
        $masterParty->company_id =  Auth::user()->company_id;
        $masterParty->uuid = Str::uuid();
        $masterParty->party_code = $validated['party_code'];
        $masterParty->party_name = $validated['party_name'];

        // $masterParty->tally_ledger = $validated['ledger_name'];
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

        return redirect()->route('export-parties.index')->with('success', 'Party created successfully.');
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
        $exportParty = MasterExportParty::findOrFail($id);
        $parties = MasterParty::all();
       
        return view('admin-main.admin.party.export.edit', compact('exportParty', 'parties'));
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

        $masterParty = MasterExportParty::findOrFail($id);
    
        $masterParty->company_id = $validated['company_id'];
        $masterParty->party_code = $validated['party_code'];
        $masterParty->party_name = $validated['party_name'];

        // $masterParty->tally_ledger = $validated['ledger_name'];
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

        return redirect()->route('export-parties.index')->with('success', 'Party updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $party = MasterExportParty::findOrFail($id);
        $party->delete();
        return response()->json(['status' => 'success', 'message' => 'Export Party record deleted successfully.']);
    }
}
