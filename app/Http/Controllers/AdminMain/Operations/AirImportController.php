<?php

namespace App\Http\Controllers\AdminMain\Operations;

use App\Models\MasterPort;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\MasterImportParty;
use App\Models\MasterParty;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Operations\OperationAirImport;
use App\Models\Operations\OperationJobMaster;
use App\Models\Operations\OperationAllFileUpload;

class AirImportController extends Controller
{
    public $company_id ;

    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->company_id = Auth::user()->company_id;
            return $next($request);
        });
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = OperationAirImport::where('company_id', $this->company_id);

        if($request->filled('mawb_no')){
            $query->where('mawb_no', 'LIKE', $request->mawb_no);
        }

        if($request->filled('job_no')){
            $query->orWhere('job_no', 'LIKE', $request->job_no);
        }

        if($request->filled('hbl_no')){
            $query->orWhere('hbl_no', 'LIKE', $request->hbl_no);
        }


        $airImports = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin-main.admin.airImport.index', compact('airImports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ports = MasterPort::where('company_id', $this->company_id)->get();
        $job_numbers = OperationJobMaster::where('company_id', $this->company_id)->orderBy('created_at', 'desc')->get();
        $parties = MasterImportParty::where('company_id', $this->company_id)->get();
        $party_lists  = MasterParty::where('company_id', $this->company_id)->get();  
        $files = OperationAllFileUpload::where('company_id', $this->company_id)->where('file_related', 'air_import')->orderBy('created_at', 'desc')->get();

        $airImports = OperationAirImport::where('company_id', $this->company_id)->orderBy('created_at', 'desc')->get();
        $findFiles = OperationAirImport::select('id', 'file_name')->whereNotNull('file_name')->where('company_id', $this->company_id)->get();;
      
        return view('admin-main.admin.airImport.create', compact('ports', 'job_numbers', 'parties', 'airImports', 'findFiles', 'party_lists', 'files'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'mawb_no' => 'required|string|max:35',
            'mawb_date' => 'required|date',
            'flight_no' => 'nullable|string|max:255',
            'flight_date' => 'nullable|date',
            'igm_no' => 'nullable|string|max:255',
            'igm_date' => 'nullable|date',
            'origin_port' => 'required|string|max:255',
            'dest_port' => 'required|string|max:255',
            'shipment' => 'nullable|in:1,2,3', // Total, Part, Split
            'package' => 'nullable|string|max:255',
            'weight' => 'nullable|numeric|min:0|max:99999999.99',
            'username' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'remark' => 'nullable|string|max:255',
            'full_job_no' => 'nullable|string|max:255',
            'eta_date' => 'nullable|date',
            'etd_date' => 'nullable|date',
        ]);

        $validated['uuid'] = Str::uuid();
        $validated['company_id'] = $this->company_id;

        $airImport = OperationAirImport::create($validated);

        $uuid = $airImport->uuid;

        return redirect()->route('air-imports.create')->with('success', 'MAWB details saved successfully!')->with('uuid', $uuid);

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
    public function edit(string $uuid)
    {

        $ports = MasterPort::where('company_id', $this->company_id)->get();
        $jobNumbers = OperationJobMaster::where('company_id', $this->company_id)->get();
        $parties = MasterImportParty::where('company_id', $this->company_id)->get();

        $airImport = OperationAirImport::where('uuid', $uuid)->firstOrFail();
        $files = OperationAllFileUpload::where('company_id', $this->company_id)->where('file_related', 'air_import')->orderBy('created_at', 'desc')->get();

        return view('admin-main.admin.airImport.edit', compact('ports', 'jobNumbers', 'parties', 'airImport', 'files'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $airImport = OperationAirImport::findOrFail($id);

        $validated = $request->validate([
            'mawb_no' => 'required|string|max:35',
            'mawb_date' => 'required|date',
            'flight_no' => 'nullable|string|max:255',
            'flight_date' => 'nullable|date',
            'igm_no' => 'nullable|string|max:255',
            'igm_date' => 'nullable|date',
            'origin_port' => 'required|string|max:255',
            'dest_port' => 'required|string|max:255',
            'shipment' => 'nullable|in:1,2,3',
            'package' => 'nullable|string|max:255',
            'weight' => 'nullable|numeric|min:0|max:99999999.99',
            'username' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'remark' => 'nullable|string|max:255',
            'full_job_no' => 'nullable|string|max:255',
            'eta_date' => 'nullable|date',
            'etd_date' => 'nullable|date',

            'job_no' => 'required|integer', 
            'hbl_no' => 'required|string|max:255',
            'hbl_date' => 'required|date',
            'hawb_origin_port' => 'nullable|string|max:255',
            'hawb_dest_port' => 'nullable|string|max:255',
            'hawb_shipment' => 'nullable|in:1,2,3',
            'hawb_package' => 'nullable|string|max:255',
            'hawb_weight' => 'nullable|numeric|min:0|max:99999999.99',
            'descriptions' => 'nullable|string',


            'freight' => 'nullable|string|max:255',
            'currency' => 'nullable|string|max:10',
            'exchange_rate' => 'required|numeric|min:0',
            'cc_perc' => 'required|numeric|min:0',
            'cc_currency' => 'nullable|string|max:10',
            'cc_exch_rate' => 'required|numeric|min:0',
            'caf_perc' => 'required|numeric|min:0',
            'chg_weight' => 'required|numeric|min:0',
            'consignee_id' => 'nullable|exists:master_import_parties,id',
            'shipper_id' => 'nullable|exists:master_import_parties,id',
            'billing_party_id' => 'nullable|exists:master_import_parties,id',
            'sales_person_id' => 'nullable|exists:master_import_parties,id',
            'fpa_amount' => 'nullable|numeric|min:0',
            'bill_of_entry' => 'nullable|string|max:255',
            'insurance' => 'nullable|string|max:255',
            'transportation' => 'nullable|string|max:255',
            'transportation_details' => 'nullable|string|max:1000',
            'clearance' => 'nullable|string|max:255',

        ]);

        $airImport->update($validated);

        return redirect()->back()->with('success', 'Air Export Updated Successfull');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $airImport = OperationAirImport::findOrFail($id);
        $airImport->delete();

        return response()->json(['success' => 'Air Export Record Deleted Successfull']);
    }

    public function updateHawb(Request $request){
    
        if (!$request->filled('mawb_no')) {
            return back()->withErrors(['uuid' => 'Please select MAWB NO.']);
        }

        $import = OperationAirImport::findOrFail($request->mawb_no);

        $validated = $request->validate([
            'job_no' => 'required|integer',  // MAWB ke saath linked hona chahiye
            'hbl_no' => 'required|string|max:255',
            'hbl_date' => 'required|date',
            'hawb_origin_port' => 'nullable|string|max:255',
            'hawb_dest_port' => 'nullable|string|max:255',
            'hawb_shipment' => 'nullable|in:1,2,3',
            'hawb_package' => 'nullable|string|max:255',
            'hawb_weight' => 'nullable|numeric|min:0|max:99999999.99',
            // 'enquiry_reference_no' => 'nullable|string|max:255',
            'descriptions' => 'nullable|string',
        ]);
       

        $import->update([
            'job_no' => $validated['job_no'],
            'hbl_no' => $validated['hbl_no'],
            'hbl_date' => $validated['hbl_date'],
            'hawb_origin_port' => $validated['hawb_origin_port'],
            'hawb_dest_port' => $validated['hawb_dest_port'],
            'hawb_shipment' => $validated['hawb_shipment'] ,
            'hawb_package' => $validated['hawb_package'] ,
            'hawb_weight' => $validated['hawb_weight'] ,
            // 'enquiry_reference_no' => $validated['enquiry_reference_no'] ,
            'descriptions' => $validated['descriptions'] ,
        ]);

        return redirect()->route('air-imports.create')->with('success', 'HAWB details updated!');

    }

    public function updateother(Request $request){
        if (!$request->filled('mawb_no')) {
            return back()->withErrors(['uuid' => 'Please select MAWB NO.']);
        }

        $import = OperationAirImport::findOrFail($request->mawb_no);

        $validated = $request->validate([
            'freight' => 'nullable|string|max:255',
            'currency' => 'nullable|string|max:10',
            'exchange_rate' => 'required|numeric|min:0',
            'cc_perc' => 'required|numeric|min:0',
            'cc_currency' => 'nullable|string|max:10',
            'cc_exch_rate' => 'required|numeric|min:0',
            'caf_perc' => 'required|numeric|min:0',
            'chg_weight' => 'required|numeric|min:0',

            'consignee_id' => 'nullable|exists:master_import_parties,id',
            'shipper_id' => 'nullable|exists:master_import_parties,id',
            'billing_party_id' => 'nullable|exists:master_import_parties,id',
            'sales_person_id' => 'nullable|exists:master_import_parties,id',

            'fpa_amount' => 'nullable|numeric|min:0',
            'bill_of_entry' => 'nullable|string|max:255',
            'insurance' => 'nullable|string|max:255',
            'transportation' => 'nullable|string|max:255',
            'transportation_details' => 'nullable|string|max:1000',
            'clearance' => 'nullable|string|max:255',
        ]);

       

        $import->update([
            'freight' => $validated['freight'],
            'currency' => $validated['currency'],
            'exchange_rate' => $validated['exchange_rate'],
            'cc_perc' => $validated['cc_perc'],
            'cc_currency' => $validated['cc_currency'],
            'cc_exch_rate' => $validated['cc_exch_rate'] ,
            'caf_perc' => $validated['caf_perc'] ,
            'chg_weight' => $validated['chg_weight'] ,
            'consignee_id' => $validated['consignee_id'] ,
            'shipper_id' => $validated['shipper_id'] ,

            'billing_party_id' => $validated['billing_party_id'] ,
            'sales_person_id' => $validated['sales_person_id'] ,
            'fpa_amount' => $validated['fpa_amount'] ,
            'transportation_details' => $validated['transportation_details'] ,
        ]);

        return redirect()->route('air-imports.create')->with('success', "Other's details updated!");

    }


}
