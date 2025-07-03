<?php

namespace App\Http\Controllers\AdminMain\Operations;

use App\Models\MasterPort;
use Illuminate\Support\Str;
use App\Models\MasterVessel;
use Illuminate\Http\Request;
use App\Models\MasterImportParty;
use App\Models\MasterParty;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Operations\OperationExportBl;
use App\Models\Operations\OperationJobMaster;
use App\Models\Operations\OperationAllFileUpload;
use App\Models\Operations\OperationExportBlContainer;

class ExportBlEntryController extends Controller
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
    public function index()
    {
        $query = OperationExportBl::where('company_id', $this->company_id);

        $exportBlEntries = $query->orderBy('created_at', 'desc')->get();
        return view('admin-main.admin.exportBLDataEntry.index', compact('exportBlEntries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $job_masters = OperationJobMaster::select('id', 'job_no')->where('company_id', $this->company_id)->get();
        $vessels = MasterVessel::select('id', 'vessel_name')->where('company_id', $this->company_id)->get();
        $parties = MasterImportParty::select('id', 'party_name')->where('company_id', $this->company_id)->get();
        $ports = MasterPort::select('id', 'port_name')->where('company_id', $this->company_id)->get();
        $party_lists  = MasterParty::all();

        $booking_nums = OperationExportBl::select('booking_no')->where('company_id', $this->company_id)->get();

        $files = OperationAllFileUpload::where('company_id', $this->company_id)->where('file_related', 'exort_bl_data_ent')->orderBy('created_at', 'desc')->get();

        return view('admin-main.admin.exportBLDataEntry.create', compact('job_masters', 'vessels', 'parties', 'ports', 'booking_nums', 'files', 'party_lists'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if($request->filled('main_details')){
            $validated = $request->validate([
                'job_no' => 'required|string',
                'full_job_no' => 'nullable|string',
                'booking_no' => 'nullable|string',
                'booking_date' => 'nullable|date',
                'vessel_id' => 'nullable|integer',
                'voyage_no' => 'nullable|string',
                'mbl_no' => 'nullable|string',
                'hbl_no' => 'nullable|string',
                'enquiry_ref_no' => 'nullable|string',
                'quantity' => 'nullable|string',
                'package_type_id' => 'nullable|integer',
                'freight' => 'nullable|string',
                'freight_charges' => 'nullable|numeric',
                'gross_wt' => 'required|numeric',
                'net_wt' => 'required|numeric',
                'tare_wt' => 'nullable|numeric',
                'volume' => 'nullable|string',
                'movement' => 'nullable|string',
                'cargo_type' => 'required|string',
                'eta_date' => 'nullable|date',
                'etd_date' => 'required|date',
                'cbm' => 'nullable|numeric',
                'sob_dt' => 'nullable|date',
                'port_cutoff' => 'nullable|string',
                'si_cutoff' => 'nullable|string',
                'document_cutoff' => 'nullable|string',
                'vgm_cutoff' => 'nullable|string',
                'remarks' => 'nullable|string',
                'overseas_agent_id' => 'nullable|integer',
                'bl_type' => 'nullable|string',
                'issue_place' => 'nullable|string',
                'no_of_origin' => 'nullable|integer',
                'place_of_acceptance' => 'nullable|string',
                'sales_person_id' => 'nullable|integer',
                'stuffing_point' => 'nullable|string',
                'cha_id' => 'nullable|integer',
                'shipping_line_id' => 'nullable|integer',
                'forwarder_id' => 'nullable|integer',
                'bl_issued_date' => 'nullable|date',
                'vgm_issued_date' => 'nullable|date',

                'shipper_id' => 'nullable|integer',
                'consignee_id' => 'nullable|integer',
                'notify_id' => 'nullable|integer',
                'notify2_id' => 'nullable|integer',
                'loading_port_id' => 'nullable|integer|exists:master_ports,id',
                'discharge_port_id' => 'nullable|integer',
                'receipt_port_id' => 'nullable|integer',
                'delivery_port_id' => 'nullable|integer',
                'insurance' => 'nullable|string',
                'fpa_amount' => 'nullable|numeric',
                'transportation' => 'nullable|string',
                'transportation_details' => 'nullable|string',
                'clearance' => 'nullable|string',
                'shipping_bill' => 'nullable|string',
            ]);

            $validated['company_id'] = $this->company_id;
            $validated['uuid'] = Str::uuid();
            $validated['entry_type'] = '1';

            $exportBl_id = OperationExportBl::create($validated);

            return redirect()->route('export-bl-entry.create')->with('success', 'Export BL Data created successfully.')->with('export_bl_id', $exportBl_id->id);
        }

        if($request->filled('other_details')){

            $validated = $request->validate([
                'booking_no' => 'required|string',
                'cont_hbl' => 'nullable|string|max:20',
                'size' => 'required|string',
                'container_no' => 'required|string',
                'cust_seal_no' => 'nullable|string',
                'gross_weight' => 'nullable|numeric',
                'cbm' => 'nullable|numeric',
                'refer' => 'nullable|string',
                'fcl_lcl' => 'nullable|string',
                'total_package' => 'nullable|numeric',
                'cargo_type' => 'nullable|string',
                'agent_seal_no' => 'nullable|string',
                'net_weight' => 'nullable|numeric',
                'ground_date' => 'nullable|date',
                'vgm_weight' => 'nullable|numeric',
                'imo_code' => 'nullable|string',
                'uno_no' => 'nullable|string',
                'temperature' => 'nullable|string',
                'soc' => 'nullable|string',
                'disposal' => 'nullable|string',
                'detention_date' => 'nullable|date',
                'remarks' => 'nullable|string',
                'commodity' => 'nullable|string',
                'sector' => 'nullable|string',
                'previous_days' => 'nullable|numeric',
                'cont_job_no' => 'nullable|string',
            ]);

            $validated['company_id'] = $this->company_id;

            OperationExportBlContainer::create($validated);

            return redirect()->back()->with('success', 'Container saved successfully.');
        }
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
        $job_masters = OperationJobMaster::select('id', 'job_no')->where('company_id', $this->company_id)->get();
        $vessels = MasterVessel::select('id', 'vessel_name')->where('company_id', $this->company_id)->get();
        $parties = MasterImportParty::select('id', 'party_name')->where('company_id', $this->company_id)->get();
        $ports = MasterPort::select('id', 'port_name')->where('company_id', $this->company_id)->get();

        $booking_nums = OperationExportBl::select('booking_no')->where('company_id', $this->company_id)->get();

        $exportBlEntry = OperationExportBl::where('uuid', $uuid)->firstOrFail();
        // $exportBlContainer = OperationExportBlContainer::where('company_id', $this->company_id)->where('booking_no', $exportBlEntry->booking_no)->first();

        return view('admin-main.admin.exportBLDataEntry.edit', compact('exportBlEntry','job_masters','vessels','parties','ports','booking_nums'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        OperationExportBl::findOrFail($id)->delete();

        return response()->json(['success', 'BL record deleted successfull']);
    }

}
