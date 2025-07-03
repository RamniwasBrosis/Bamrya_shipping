<?php

namespace App\Http\Controllers\AdminMain\Operations;

use App\Models\MasterPort;
use Illuminate\Support\Str;
use App\Models\MasterVessel;
use Illuminate\Http\Request;
use App\Models\MasterImportParty;
use App\Models\MasterParty;
use App\Models\MasterPackage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Operations\OperationJobMaster;
use App\Models\Operations\OperationSeaImport;
use App\Models\Operations\OperationAllFileUpload;
use App\Models\Operations\OperationSeaImportCont;

class SeaImportController extends Controller
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
        $query = OperationSeaImport::where('company_id', $this->company_id);

        if($request->filled('job_no')){
            $query->where('job_no', 'LIKE', '%'.$request->job_no.'%');
        }

        $sea_imports = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('admin-main.admin.seaImport.index', compact('sea_imports'));
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

        $files = OperationAllFileUpload::where('company_id', $this->company_id)->where('file_related', 'sea_import')->orderBy('created_at', 'desc')->get();
        $sea_imports = OperationSeaImport::select('id')->where('company_id', $this->company_id)->orderBy('created_at', 'desc')->get();
        
        return view('admin-main.admin.seaImport.create', compact('ports', 'job_numbers', 'parties', 'vessels', 'files', 'sea_imports', 'party_lists', 'packages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'bl_issue_by' => 'required',
            'job_no' => 'required|integer',
            'cargo_type' => 'nullable|string',
            'mbl_no' => 'nullable|string',
            'mbl_date' => 'nullable|date',
            'hbl_no' => 'nullable|string',
            'hbl_date' => 'nullable|date',
            'igm_no' => 'nullable|string',
            'igm_date' => 'nullable|date',
            'item_no' => 'nullable|string',
            'sub_item_no' => 'nullable|string',
            'voyage_no' => 'nullable|string',
            'arrival_date' => 'nullable|date',
            'enquiry_reference_no' => 'nullable|string',
            'vessel_id' => 'nullable|integer',
            'eta_date' => 'nullable|date',
            'etd_date' => 'nullable|date',
            'quantity' => 'nullable|integer',
            'package_id' => 'nullable|integer',
            'freight' => 'nullable|string',
            'gross_weight' => 'nullable|numeric',
            'cbm' => 'nullable|numeric',
            'cargo' => 'nullable|string',
            'is_hazardous' => 'nullable|boolean',
            'delivery_type' => 'nullable|string',
            'imo_cd' => 'nullable|string',
            'uno_cd' => 'nullable|string',
            'free_days' => 'nullable|integer',
            'hbl_type' => 'nullable|string',
            'fpa_amount' => 'nullable|numeric',
            'transportation_details' => 'nullable|string',
            'bill_of_entry' => 'nullable|string',
            'delivery_order_date' => 'nullable|date',
            'loading_port_id' => 'nullable|integer',
            'discharge_port_id' => 'nullable|integer',
            'delivery_port_id' => 'nullable|integer',
            'destination_port_id' => 'nullable|integer',
            'shipping_line_id' => 'nullable|integer',
            'overseas_agent_id' => 'nullable|integer',
            'cfs_yard_id' => 'nullable|integer',
            'empty_yard_id' => 'nullable|integer',
            'sales_person_id' => 'nullable|integer',
            'coloader_id' => 'nullable|integer',
            'shipper_id' => 'nullable|integer',
            'consignee_id' => 'nullable|integer',
            'notify_id' => 'nullable|integer',
            'cha_id' => 'nullable|integer',
            'mark_and_numbers' => 'nullable|string',
            'goods_description' => 'nullable|string',
            'obl_no' => 'nullable|string',
            'obl_date' => 'nullable|date',
            'ref_no' => 'nullable|string',
            'do_date' => 'nullable|date',
            'surveyor_id' => 'nullable|integer',
            'validity_date' => 'nullable|date',

            'transportation' => 'nullable|string',
            'insurance' => 'nullable|string',
            'clearance' => 'nullable|string',
            'sub_job_no' => 'nullable|string',
            'remarks' => 'nullable|string',
            'username' => 'nullable|string',
            'prealert_date' => 'nullable|string',
            'inv_no_full' => 'nullable|string',
        ]);

        $validated['company_id'] = $this->company_id;
        $validated['uuid'] = Str::uuid();

        OperationSeaImport::create($validated);

        return redirect()->route('sea-imports.create')->with('success', 'Sea Import record created successfully.');
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
        $vessels = MasterVessel::where('company_id', $this->company_id)->get();
        $packages = MasterPackage::where('company_id', $this->company_id)->get();
        $jobNumbers = OperationJobMaster::where('company_id', $this->company_id)->get();
        $parties = MasterImportParty::where('company_id', $this->company_id)->get();

        $sea_import = OperationSeaImport::with('container')->where('uuid', $uuid)->firstOrFail();
        $files = OperationAllFileUpload::where('company_id', $this->company_id)->where('file_related', 'sea_import')->orderBy('created_at', 'desc')->get();

        return view('admin-main.admin.seaImport.edit', compact('sea_import', 'ports', 'jobNumbers', 'parties', 'vessels', 'files', 'packages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $sea_import = OperationSeaImport::findOrFail($id);

        $validated = $request->validate([
            'bl_issue_by' => 'required|in:1,2',
            'job_no' => 'required|integer',
            'cargo_type' => 'nullable|string',
            'mbl_no' => 'nullable|string',
            'mbl_date' => 'nullable|date',
            'hbl_no' => 'nullable|string',
            'hbl_date' => 'nullable|date',
            'igm_no' => 'nullable|string',
            'igm_date' => 'nullable|date',
            'item_no' => 'nullable|string',
            'sub_item_no' => 'nullable|string',
            'voyage_no' => 'nullable|string',
            'arrival_date' => 'nullable|date',
            'enquiry_reference_no' => 'nullable|string',
            'vessel_id' => 'nullable|integer',
            'eta_date' => 'nullable|date',
            'etd_date' => 'nullable|date',
            'quantity' => 'nullable|integer',
            'package_id' => 'nullable|integer',
            'freight' => 'nullable|string',
            'gross_weight' => 'nullable|numeric',
            'cbm' => 'nullable|numeric',
            'cargo' => 'nullable|string',
            'is_hazardous' => 'nullable|boolean',
            'delivery_type' => 'nullable|string',
            'imo_cd' => 'nullable|string',
            'uno_cd' => 'nullable|string',
            'free_days' => 'nullable|integer',
            'hbl_type' => 'nullable|string',
            'fpa_amount' => 'nullable|numeric',
            'transportation_details' => 'nullable|string',
            'bill_of_entry' => 'nullable|string',
            'delivery_order_date' => 'nullable|date',
            'loading_port_id' => 'nullable|integer',
            'discharge_port_id' => 'nullable|integer',
            'delivery_port_id' => 'nullable|integer',
            'destination_port_id' => 'nullable|integer',
            'shipping_line_id' => 'nullable|integer',
            'overseas_agent_id' => 'nullable|integer',
            'cfs_yard_id' => 'nullable|integer',
            'empty_yard_id' => 'nullable|integer',
            'sales_person_id' => 'nullable|integer',
            'coloader_id' => 'nullable|integer',
            'shipper_id' => 'nullable|integer',
            'consignee_id' => 'nullable|integer',
            'notify_id' => 'nullable|integer',
            'cha_id' => 'nullable|integer',
            'mark_and_numbers' => 'nullable|string',
            'goods_description' => 'nullable|string',
            'obl_no' => 'nullable|string',
            'obl_date' => 'nullable|date',
            'ref_no' => 'nullable|string',
            'do_date' => 'nullable|date',
            'surveyor_id' => 'nullable|integer',
            'validity_date' => 'nullable|date',

            'transportation' => 'nullable|string',
            'insurance' => 'nullable|string',
            'clearance' => 'nullable|string',
            'sub_job_no' => 'nullable|string',
            'remarks' => 'nullable|string',
            'username' => 'nullable|string',
            'prealert_date' => 'nullable|string',
            'inv_no_full' => 'nullable|string',
        ]);

        $sea_import->update($validated);

        return redirect()->back()->with('success', 'Sea Import Entry Updated. !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = OperationSeaImport::findOrFail($id);
        $delete->delete();

        return response()->json(['success' => 'Sea Import Entry Deleted Successfully']);
    }



    public function addContainer(Request $request){

        if(!$request->filled('sea_import_id')){
            return redirect()->back()->with('error', 'Please Select "Sea Import ID " Field First. !');
        }

        $validated = $request->validate([
            'sea_import_id'   => 'required|integer',
            'cont_hbl'        => 'nullable|string|max:255',
            'container_no'    => 'required|string|max:20',
            'size'            => 'required|string|max:20',
            'seal_no'         => 'nullable|string|max:50',
            'gross_weight'    => 'required|numeric|min:0',
            'cbm'             => 'required|numeric|min:0',
            'refer'           => 'nullable|in:Y,N',
            'fcl_lcl'         => 'nullable|string|max:10',
            'total_package'   => 'required|integer|min:0',
            'cargo_type'      => 'nullable|string|max:50',
            'detent_date'     => 'nullable|date',
            'freedays_cont'   => 'nullable|integer|min:0',
            'ground_date'     => 'nullable|date',
            'ground_days'     => 'nullable|integer|min:0',
            'imo_code'        => 'nullable|string|max:100',
            'uno_no'          => 'nullable|string|max:100',
            'tp_icd'          => 'nullable|string|max:100',
            'soc_yn'          => 'nullable|string|in:Y,N',
            'disposal'        => 'nullable|string|max:100',
            'remarks'         => 'nullable|string|max:255',
            'printed'         => 'nullable|string|max:100',
            'selected'        => 'nullable|string|max:100',
            'sector'          => 'nullable|string|max:100',
            'previous_days'   => 'nullable|integer|min:0',
        ]);


        $validated['company_id'] = $this->company_id;
        $validated['uuid'] = Str::uuid();

        OperationSeaImportCont::create($validated);

        return redirect()->back()->with('success', 'Container Details added successfully. !');


    }

    public function updateContainer(Request $request, int $id){

        $sea_export_cont = OperationSeaImportCont::findOrFail($id);

        $validated = $request->validate([
            'cont_hbl'        => 'nullable|string|max:255',
            'container_no'    => 'required|string|max:20',
            'size'            => 'required|string|max:20',
            'seal_no'         => 'nullable|string|max:50',
            'gross_weight'    => 'required|numeric|min:0',
            'cbm'             => 'required|numeric|min:0',
            'refer'           => 'nullable|in:Y,N',
            'fcl_lcl'         => 'nullable|string|max:10',
            'total_package'   => 'required|integer|min:0',
            'cargo_type'      => 'nullable|string|max:50',
            'detent_date'     => 'nullable|date',
            'freedays_cont'   => 'nullable|integer|min:0',
            'ground_date'     => 'nullable|date',
            'ground_days'     => 'nullable|integer|min:0',
            'imo_code'        => 'nullable|string|max:100',
            'uno_no'          => 'nullable|string|max:100',
            'tp_icd'          => 'nullable|string|max:100',
            'soc_yn'          => 'nullable|string|in:Y,N',
            'disposal'        => 'nullable|string|max:100',
            'remarks'         => 'nullable|string|max:255',
            'printed'         => 'nullable|string|max:100',
            'selected'        => 'nullable|string|max:100',
            'sector'          => 'nullable|string|max:100',
            'previous_days'   => 'nullable|integer|min:0',
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
                        <td><a href="' . route('sea-imports.downloadFile', $file->id) . '" target="_blank" class="text-success">Download</a></td>
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
