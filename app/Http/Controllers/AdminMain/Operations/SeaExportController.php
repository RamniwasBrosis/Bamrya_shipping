<?php

namespace App\Http\Controllers\AdminMain\Operations;

use App\Models\MasterPort;
use Illuminate\Support\Str;
use App\Models\MasterVessel;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;
use App\Models\MasterImportParty;
use App\Models\MasterParty;
use App\Models\MasterPackage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Operations\OperationJobMaster;
use App\Models\Operations\OperationSeaExport;
use App\Models\Operations\OperationAllFileUpload;
use App\Models\Operations\OperationSeaExportCont;

class SeaExportController extends Controller
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
        $query = OperationSeaExport::where('company_id', $this->company_id);

        if($request->filled('full_job_no')){
            $query->where('full_job_no', 'LIKE', '%'.$request->full_job_no.'%');
        }

        if($request->filled('job_no')){
            $query->orWhere('job_no', 'LIKE', '%'.$request->job_no.'%');
        }

        if($request->filled('booking_no')){
            $query->orWhere('booking_no', 'LIKE', '%'.$request->booking_no.'%');
        }

        $sea_exports = $query->orderBy('created_at', 'desc')->paginate(10);

        $full_job_nums = OperationSeaExport::where('company_id', $this->company_id)->get();
        $job_nums = OperationSeaExport::where('company_id', $this->company_id)->get();
        $booking_nums = OperationSeaExport::where('company_id', $this->company_id)->get();

        return view('admin-main.admin.seaExport.index', compact('sea_exports', 'full_job_nums', 'job_nums', 'booking_nums'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {        
        $ports = MasterPort::where('company_id', $this->company_id)->get();
        $vessels = MasterVessel::where('company_id', $this->company_id)->get();
        $packages = MasterPackage::where('company_id', $this->company_id)->get();
        $job_numbers = OperationJobMaster::where('company_id', $this->company_id)->orderBy('created_at', 'desc')->get();
        $parties = MasterImportParty::where('company_id', $this->company_id)->get();
        $party_lists  = MasterParty::all();

        $sea_exports = OperationSeaExport::select('id')->where('company_id', $this->company_id)->orderBy('full_job_no', 'asc')->get();

        $files = OperationAllFileUpload::where('company_id', $this->company_id)->where('file_related', 'sea_export')->orderBy('created_at', 'desc')->get();
        
        return view('admin-main.admin.seaExport.create', compact('ports', 'job_numbers', 'parties', 'vessels', 'sea_exports', 'files', 'party_lists', 'packages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'entry_by' => 'required|in:Packinglist,nominated',
            'job_no' => 'required|integer',
            'full_job_no' => 'nullable|string',
            'booking_no' => 'nullable|string',
            'booking_date' => 'nullable|date',
            'vessel_id' => 'nullable|integer',
            'voyage_no' => 'nullable|string',
            'mbl_no' => 'nullable|string',
            'hbl_no' => 'nullable|string',
            'enquiry_ref_no' => 'nullable|string',
            'quantity' => 'nullable|integer',
            'package_id' => 'nullable|integer',
            'freight' => 'nullable|string',
            'freight_charges' => 'nullable|numeric',
            'gross_weight' => 'nullable|numeric',
            'net_weight' => 'nullable|numeric',
            'tare_weight' => 'nullable|numeric',
            'volume_unit' => 'nullable|string',
            'movement' => 'nullable|string',
            'cargo_type' => 'nullable|string',
            'eta_date' => 'nullable|date',
            'etd_date' => 'nullable|date',
            'cbm' => 'nullable|numeric',
            'sob_date' => 'nullable|date',
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
            'loading_port_id' => 'nullable|integer',
            'discharge_port_id' => 'nullable|integer',
            'receipt_port_id' => 'nullable|integer',
            'delivery_port_id' => 'nullable|integer',

            'insurance' => 'nullable|string',
            'fpa_amount' => 'nullable|string',
            'transportation' => 'nullable|string',
            'transportation_details' => 'nullable|string',
            'clearance' => 'nullable|string',
            'shipping_bill' => 'nullable|string',

            'mark_number' => 'nullable|string',
            'goods_description' => 'nullable|string',
            'customer_inv_no' => 'nullable|string',
            'sbill_no' => 'nullable|string',
            'commodity' => 'nullable|string',

        ]);

        $validated['company_id'] = $this->company_id;
        $validated['uuid'] = Str::uuid();

        OperationSeaExport::create($validated);

        return redirect()->back()->with('success', 'Sea import booking saved successfully.');
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
    {   $sea_export = OperationSeaExport::where('uuid', $uuid)->firstOrFail();

        $ports = MasterPort::where('company_id', $this->company_id)->get();
        $vessels = MasterVessel::where('company_id', $this->company_id)->get();
        $packages = MasterPackage::where('company_id', $this->company_id)->get();
        $jobNumbers = OperationJobMaster::where('company_id', $this->company_id)->get();
        $parties = MasterImportParty::where('company_id', $this->company_id)->get();

        $full_job_nums = OperationSeaExport::where('company_id', $this->company_id)->orderBy('full_job_no', 'asc')->get();
        $files = OperationAllFileUpload::where('company_id', $this->company_id)->where('file_related', 'sea_export')->orderBy('created_at', 'desc')->get();

        return view('admin-main.admin.seaExport.edit', compact('sea_export', 'ports', 'jobNumbers', 'parties', 'vessels', 'files', 'packages'));
    }
     

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $sea_export = OperationSeaExport::FindOrFail($id);
   
        $validated = $request->validate([
            'entry_by' => 'required|in:Packinglist,nominated',
            'job_no' => 'required|integer',
            'full_job_no' => 'nullable|string',
            'booking_no' => 'nullable|string',
            'booking_date' => 'nullable|date',
            'vessel_id' => 'nullable|integer',
            'voyage_no' => 'nullable|string',
            'mbl_no' => 'nullable|string',
            'hbl_no' => 'nullable|string',
            'enquiry_ref_no' => 'nullable|string',
            'quantity' => 'nullable|integer',
            'package_id' => 'nullable|integer',
            'freight' => 'nullable|string',
            'freight_charges' => 'nullable|numeric',
            'gross_weight' => 'nullable|numeric',
            'net_weight' => 'nullable|numeric',
            'tare_weight' => 'nullable|numeric',
            'volume_unit' => 'nullable|string',
            'movement' => 'nullable|string',
            'cargo_type' => 'nullable|string',
            'eta_date' => 'nullable|date',
            'etd_date' => 'nullable|date',
            'cbm' => 'nullable|numeric',
            'sob_date' => 'nullable|date',
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
            'loading_port_id' => 'nullable|integer',
            'discharge_port_id' => 'nullable|integer',
            'receipt_port_id' => 'nullable|integer',
            'delivery_port_id' => 'nullable|integer',

            'insurance' => 'nullable|string',
            'fpa_amount' => 'nullable|string',
            'transportation' => 'nullable|string',
            'transportation_details' => 'nullable|string',
            'clearance' => 'nullable|string',
            'shipping_bill' => 'nullable|string',

            'mark_number' => 'nullable|string',
            'goods_description' => 'nullable|string',
            'customer_inv_no' => 'nullable|string',
            'sbill_no' => 'nullable|string',
            'commodity' => 'nullable|string',
        ]);

        $sea_export->update($validated);

        return redirect()->back()->with('success', 'Sea import booking Updated successfully. !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sea_export = OperationSeaExport::FindOrFail($id);

        $sea_export->delete();

        return response()->json(['success' => 'Sea Export Entry Deleted Successfully. !']);
    }

    public function addContainer(Request $request){

        if(!$request->filled('sea_export_id')){
            return redirect()->back()->with('error', 'Please Select "Sea Export ID" Field First. !');
        }

        $validated = $request->validate([
            'sea_export_id' => 'required|integer',
            'cont_hbl'        => 'required|string|max:100',
            'gross_weight'    => 'nullable|string|max:50',
            'total_package'   => 'nullable|string|max:50',
            'ground_date'     => 'nullable|date',
            'temp'            => 'nullable|string|max:50',
            'remarks'         => 'nullable|string|max:255',
            'cont_job_no'     => 'nullable|string|max:50',
            'container_no'    => 'required|string|max:100',
            'cbm'             => 'nullable|string|max:50',
            'cargo_type'      => 'nullable|string|max:100',
            'vgm_wt'          => 'nullable|string|max:50',
            'soc'             => 'nullable|string|max:50',
            'commodity'       => 'nullable|string|max:100',
            'size'            => 'nullable|string|max:50',
            'refer'           => 'nullable|in:Y,N',
            'agent_seal_no'   => 'nullable|string|max:100',
            'imo_code'        => 'nullable|string|max:50',
            'disposal'        => 'nullable|string|max:50',
            'sector'          => 'nullable|string|max:50',
            'cust_seal_no'    => 'nullable|string|max:100',
            'fcl_lcl'         => 'nullable|in:FCL,LCL,ETY,AIR',
            'net_weight'      => 'nullable|string|max:50',
            'uno_no'          => 'nullable|string|max:50',
            'detent_date'     => 'nullable|date',
            'prev_days'       => 'nullable|numeric|min:0',
        ]);

        $validated['company_id'] = $this->company_id;
        $validated['uuid'] = Str::uuid();

        OperationSeaExportCont::create($validated);

        return redirect()->back()->with('success', 'Container Details added successfully. !');


    }

    public function updateContainer(Request $request, int $id){

        $sea_export_cont = OperationSeaExportCont::findOrFail($id);

        $validated = $request->validate([
            'cont_hbl'        => 'required|string|max:100',
            'gross_weight'    => 'nullable|string|max:50',
            'total_package'   => 'nullable|string|max:50',
            'ground_date'     => 'nullable|date',
            'temp'            => 'nullable|string|max:50',
            'remarks'         => 'nullable|string|max:255',
            'cont_job_no'     => 'nullable|string|max:50',
            'container_no'    => 'required|string|max:100',
            'cbm'             => 'nullable|string|max:50',
            'cargo_type'      => 'nullable|string|max:100',
            'vgm_wt'          => 'nullable|string|max:50',
            'soc'             => 'nullable|string|max:50',
            'commodity'       => 'nullable|string|max:100',
            'size'            => 'nullable|string|max:50',
            'refer'           => 'nullable|in:Y,N',
            'agent_seal_no'   => 'nullable|string|max:100',
            'imo_code'        => 'nullable|string|max:50',
            'disposal'        => 'nullable|string|max:50',
            'sector'          => 'nullable|string|max:50',
            'cust_seal_no'    => 'nullable|string|max:100',
            'fcl_lcl'         => 'nullable|in:FCL,LCL,ETY,AIR',
            'net_weight'      => 'nullable|string|max:50',
            'uno_no'          => 'nullable|string|max:50',
            'detent_date'     => 'nullable|date',
            'prev_days'       => 'nullable|numeric|min:0',
        ]);

        $sea_export_cont->update($validated);

        return redirect()->back()->with('success', 'Container Details Updated Sucessfully. !');
    }

    public function updateFileUpload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf,xls,xlsx,doc,docx',
        ], [
            'file.required' => 'Please choose a file to upload.',
            'file.mimes' => 'Only PDF, Excel, and Word files are allowed.',
        ]);

        $file = $request->file('file');
        $file_related = $request->file_related;
        $path = null;

        switch ($file_related) {
            case 'air_export':
                $path = $file->store('uploads/airExports', 'public');
                break;
            case 'sea_export':
                $path = $file->store('uploads/seaExports', 'public');
                break;
            case 'sea_import':
                $path = $file->store('uploads/seaImports', 'public');
                break;
            case 'transport':
                $path = $file->store('uploads/transport', 'public');
                break;
            default:
                return back()->with('error', 'Invalid file category.');
        }

        
        $originalName = $file->getClientOriginalName();
        $file_type  = $file->getClientOriginalExtension();
        $file_related = $request->file_related;

        $file_upload = new OperationAllFileUpload();

        $file_upload->company_id = $this->company_id;
        $file_upload->uuid = Str::uuid();
        $file_upload->file_name = $originalName;
        $file_upload->file_path = $path;
        $file_upload->file_type = $file_type;
        $file_upload->file_related = $file_related;

        $file_upload->save(); 
        return back()->with('success', 'File uploaded successfully.');
    }

    public function searchFile(Request $request)
    {        
        $request->validate([
            'search_query' => 'required'
        ]);

        $file = OperationAllFileUpload::find($request->search_query);
       
        $html = '
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>File ID</th>
                        <th>File Name</th>
                        <th>Download PDF</th>
                        <th>Remove PDF</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>' . $file->id . '</td>
                        <td>' . $file->file_name . '</td>
                        <td><a href="' . route('air-exports.downloadFile', $file->id) . '" target="_blank" class="text-success">Download</a></td>
                        <td>
                            <button class="btn btn-sm btn-danger" onclick="clearSearchFile()">×</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>';
        return response($html);
    }

    public function downloadFile($id)
    {
        $file = OperationAllFileUpload::findOrFail($id);

        $filePath = 'public/' . $file->file_path;
        $fileName = $file->file_name;

        if (Storage::exists($filePath)) {
            return Storage::download($filePath, $fileName);
        }

        return back()->with('error', 'File not found.');
    }
}
