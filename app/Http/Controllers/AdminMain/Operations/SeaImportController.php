<?php

namespace App\Http\Controllers\AdminMain\Operations;

use App\Models\MasterPort;
use Illuminate\Support\Str;
use App\Models\MasterVessel;
use Illuminate\Http\Request;
use App\Models\MasterImportParty;
use App\Models\MasterExportParty;
use App\Models\MasterParty;
use App\Models\MasterForwarder;
use App\Models\MasterPackage;
use App\Models\MasterBlType;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Operations\OperationJobMaster;
use App\Models\Operations\OperationSeaImport;
use App\Models\Operations\OperationAllFileUpload;
use App\Models\Operations\OperationSeaImportCont;
use App\Models\Operations\OperationSalesPerson;
use App\Models\MasterShipping;
use App\Models\Company;

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Shared\Html;
use Illuminate\Support\Facades\View;
use App\Services\DocumentDownloadService;

use Illuminate\Support\Facades\Validator;

class SeaImportController extends Controller
{
    public $company_id ;
    protected $downloadService;

    public function __construct(DocumentDownloadService $downloadService){
        $this->downloadService = $downloadService;
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
        $page_title = 'Sea Import';
        $query = OperationSeaImport::with(['ConsigneeName', 'jobMaster', 'container'])
        ->where('company_id', $this->company_id)
        ->where(function ($q) {
            $q->whereNull('operation_complate')
              ->orWhere('operation_complate', 0);
        });

        // Use only where(), not orWhere()
        if ($request->filled('full_job_no')) {
            $query->where('full_job_no', 'LIKE', '%' . $request->full_job_no . '%');
        }
    
        if ($request->filled('job_no')) {
            $query->where('job_no', 'LIKE',  $request->job_no );
        }
    
        if ($request->filled('booking_no')) {
            $query->where('booking_no', 'LIKE', '%' . $request->booking_no . '%');
        }
    
        if ($request->filled('consignee_id')) {
            $query->where('consignee_id', $request->consignee_id); // Use = not LIKE
        }
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [
                $request->start_date . ' 00:00:00',
                $request->end_date . ' 23:59:59'
            ]);
        }
 
        $sea_imports = $query->orderBy('job_no', 'desc')->paginate(25);
        $uploadedJobs = OperationAllFileUpload::pluck('job_no')->toArray();
        
        $job_nums = $sea_imports->unique()->filter()->values();
        $booking_nums = $sea_imports->pluck('booking_no')->unique()->filter()->values();
        $shipperIds = $sea_imports->pluck('consignee_id')->unique()->filter();
        $consigneeNames = \App\Models\MasterImportParty::whereIn('id', $shipperIds)->get();
        
        
        return view('admin-main.admin.seaImport.index', compact('page_title','sea_imports', 'job_nums', 'booking_nums', 'consigneeNames','uploadedJobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $page_title = 'Sea Import Create';
        $ports = MasterPort::where('company_id', $this->company_id)->get();
        $vessels = MasterVessel::where('company_id', $this->company_id)->get();
        $packages = MasterPackage::where('company_id', $this->company_id)->get();
        $job_numbers = OperationJobMaster::where('company_id', $this->company_id)->where('job_activity', 'SEAIMP.FWD')->orWhere('job_activity', 'SEAIMP.NVOCC')->orderBy('created_at', 'desc')->get();
        $parties = MasterImportParty::where('company_id', $this->company_id)->get();
        $party_lists  = MasterParty::all();  //whereNotIn('party_type', [9, 6, 8])->get();
        $salePersons  = OperationSalesPerson::where('company_id', $this->company_id)->get();
        $shippingLines = MasterShipping::where('company_id', $this->company_id)->get();
        $forwarders = MasterForwarder::where('company_id', $this->company_id)->get();
        $files = OperationAllFileUpload::where('company_id', $this->company_id)->where('file_related', 'sea_import')->orderBy('created_at', 'desc')->get();
        $sea_imports = OperationSeaImport::select('id')->where('company_id', $this->company_id)->orderBy('created_at', 'desc')->get();
        $exportParites = MasterExportParty::where('company_id', $this->company_id)->get();
        $partyTypes = MasterParty::whereNotIn('party_type', [9, 6, 8])->get();
        $master_bl_types = MasterBlType::where(['company_id' => $this->company_id, 'status' => '1'])->orderBy('created_at', 'desc')->get();
        return view('admin-main.admin.seaImport.create', compact('page_title','shippingLines','forwarders', 'partyTypes','exportParites','ports', 'job_numbers', 'parties', 'vessels', 'files', 'sea_imports', 'party_lists', 'packages', 'salePersons', 'master_bl_types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $checkJobNumberExist = OperationSeaImport::where('job_no', $request->job_no)->first();
        if($checkJobNumberExist){
            return response()->json([
                'status'  => false,
                'message' => "An entry for this Job Number already exists, so you cannot create another entry with the same Job No.!",
            ], 201);
        }
        
        $validator = Validator::make($request->all(), [
            'bl_issue_by' => 'required',
            'job_no' => 'required|integer',
            'cargo_type' => 'required|string',
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
            'vessel_name' => 'required|string',
            'eta_date' => 'nullable|date',
            'etd_date' => 'nullable|date',
            'booking_no' => 'nullable',
            'booking_date' => 'nullable|date',
            'quantity' => 'nullable|integer',
            'package_id' => 'nullable|integer',
            'freight' => 'nullable|string',
            'amount' => 'nullable|string',
            'gross_weight' => 'required|numeric',
            'net_weight' => 'required|string',
            'ex_work' => 'nullable|string',
            'inv_ref_no' => 'nullable|string',
 
            'cargo' => 'nullable|string',
            'is_hazardous' => 'nullable|boolean',
            'delivery_type' => 'nullable|string',
            'imo_cd' => 'nullable|string',
            'uno_cd' => 'nullable|string',
            'free_days' => 'nullable|integer',
            'hbl_type' => 'nullable|integer',
            'fpa_amount' => 'nullable|numeric',
            'transportation_details' => 'nullable|string',
        
            'delivery_order_date' => 'nullable|date',
            'loading_port_id' => 'required|integer',
            'discharge_port_id' => 'required|integer',
            'delivery_port_id' => 'required|integer',
            'destination_port_id' => 'required|integer',
            'receipt_port_id' => 'nullable|integer',
            'shipping_line_id' => 'nullable|integer',
            'agent_id' => 'nullable|integer',
            'delivery_agent_id' => 'nullable|integer',
            'cfs_yard_id' => 'nullable|integer',
            'empty_yard_id' => 'nullable|integer',
            'sales_person_id' => 'nullable|integer',
            'coloader_id' => 'nullable|integer',
            'shipper_id' => 'required|integer',
            'consignee_id' => 'required|integer',
            'notify_id' => 'nullable|integer',
            'notify2_id' => 'nullable|integer',
            'cha_id' => 'nullable|integer',
            'forwarder_id' => 'nullable|integer',
            
            'obl_no' => 'nullable|string',
            'obl_date' => 'nullable|date',
            'ref_no' => 'nullable|string',
            
            'surveyor_id' => 'nullable|integer',
            'validity_date' => 'nullable|date',
            
            'transportation' => 'nullable|string',
            'insurance' => 'nullable|string',
            'clearance' => 'nullable|string',
            'sub_job_no' => 'nullable|string',
            'remarks' => 'required|string',
            'username' => 'nullable|string',
            'prealert_date' => 'nullable|string',
            'inv_no_full' => 'nullable|string',
            'movement' => 'nullable|string',
            'sob_date' => 'nullable|date',
            'reg_no' => 'nullable|string',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }
        
        $validated = $validator->validated();

        $validated['company_id'] = $this->company_id;
        $validated['user_id'] = $this->user_id;
        $validated['uuid'] = Str::uuid();

        $sea_export_id = OperationSeaImport::create($validated);

        if($sea_export_id){
            return response()->json([
                'status'  => true,
                'message' => 'Sea Export details added successfully!',
                'id'    => $sea_export_id->id
            ], 201);
        }else{
            return response()->json([
                'status'  => false,
                'message' => 'Form not submitted.!',
            ], 201);
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
        $page_title = 'Sea Import Edit';
        $sea_import = OperationSeaImport::with('container')->where('uuid', $uuid)->firstOrFail();
        
        $ports = MasterPort::where('company_id', $this->company_id)->get();
        $vessels = MasterVessel::where('company_id', $this->company_id)->get();
        $packages = MasterPackage::where('company_id', $this->company_id)->get();
        $jobNumbers = OperationJobMaster::where('company_id', $this->company_id)->get();
        $parties = MasterImportParty::where('company_id', $this->company_id)->get();
        $party_lists  = MasterParty::whereNotIn('party_type', [9, 6, 8])->get();
        $salePersons  = OperationSalesPerson::where('company_id', $this->company_id)->get();
        $shippingLines = MasterShipping::all();
        $forwarders = MasterForwarder::where('company_id', $this->company_id)->get();
        
        $files = OperationAllFileUpload::where('company_id', $this->company_id)->where(['file_related' => 'sea_import', 'job_no' => $sea_import->job_no])->orderBy('created_at', 'desc')->get();
        $exportParites = MasterExportParty::where('company_id', $this->company_id)->get();
        $partyTypes = MasterParty::whereNotIn('party_type', [9, 6, 8])->get();
        $master_bl_types = MasterBlType::where(['company_id' => $this->company_id, 'status' => '1'])->orderBy('created_at', 'desc')->get();
        
        $sea_import_containers = OperationSeaImportCont::where('company_id', $this->company_id)->where('sea_import_id', $sea_import->id)->get();

        return view('admin-main.admin.seaImport.edit', compact('page_title','sea_import_containers', 'shippingLines','forwarders', 'partyTypes','exportParites','sea_import', 'ports', 'jobNumbers', 'parties', 'vessels', 'files', 'packages', 'party_lists', 'salePersons', 'master_bl_types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $sea_import = OperationSeaImport::find($id);
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
            'vessel_name' => 'required',
            'eta_date' => 'nullable|date',
            'etd_date' => 'nullable|date',
            'booking_no' => 'nullable',
            'booking_date' => 'nullable|date',
            'quantity' => 'nullable|integer',
            'package_id' => 'nullable|integer',
            'freight' => 'nullable|string',
            'amount' => 'nullable|string',
            'gross_weight' => 'nullable|numeric',
            'net_weight' => 'nullable|string',
            'ex_work' => 'nullable|string',
            'inv_ref_no' => 'nullable|string',
          
            'cargo' => 'nullable|string',
            'is_hazardous' => 'nullable|boolean',
            'delivery_type' => 'nullable|string',
            'imo_cd' => 'nullable|string',
            'uno_cd' => 'nullable|string',
            'free_days' => 'nullable|integer',
            'hbl_type' => 'nullable|integer',
            'fpa_amount' => 'nullable|numeric',
            'transportation_details' => 'nullable|string',
        
            'delivery_order_date' => 'nullable|date',
            'loading_port_id' => 'required|integer',
            'discharge_port_id' => 'required|integer',
            'delivery_port_id' => 'required|integer',
            'destination_port_id' => 'required|integer',
            'receipt_port_id' => 'nullable|integer',
            'shipping_line_id' => 'nullable|integer',
            'agent_id' => 'nullable|integer',
            'delivery_agent_id' => 'nullable|integer',
            'cfs_yard_id' => 'nullable|integer',
            'empty_yard_id' => 'nullable|integer',
            'sales_person_id' => 'nullable|integer',
            'coloader_id' => 'nullable|integer',
            'shipper_id' => 'nullable|integer',
            'consignee_id' => 'nullable|integer',
            'notify_id' => 'nullable|integer',
            'notify2_id' => 'nullable|integer',
            'cha_id' => 'nullable|integer',
            'forwarder_id' => 'nullable|integer',
            
            'obl_no' => 'nullable|string',
            'obl_date' => 'nullable|date',
            'ref_no' => 'nullable|string',
       
            'surveyor_id' => 'nullable|integer',
            'validity_date' => 'nullable|date',

            'transportation' => 'nullable|string',
            'insurance' => 'nullable|string',
            'clearance' => 'nullable|string',
            'sub_job_no' => 'nullable|string',
            'remarks' => 'required|string',
            'username' => 'nullable|string',
            'prealert_date' => 'nullable|string',
            'inv_no_full' => 'nullable|string',
            'movement' => 'nullable|string',
            'sob_date' => 'nullable|date',
            'reg_no' => 'nullable|string',
            
        ]);
        $validated['user_id'] = $this->user_id;

        $sea_import->update($validated);

        return redirect()->back()->with('success', 'Sea Import Entry Updated. !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = OperationSeaImport::find($id);
        $delete->container()->delete();
        $delete->delete();

        return response()->json(['success' => 'Sea Import Entry Deleted Successfully']);
    }
    
    public function getContainerDetail($id)
    {
        $chargeDetail = OperationSeaImportCont::find($id);
    
        if (!$chargeDetail) {
            return response()->json(['error' => 'Charge not found'], 404);
        }
    
        return response()->json($chargeDetail);
    }


    public function addContainer(Request $request)
    {

        if (!$request->filled('sea_import_id')) {
            return response()->json([
                'status'  => false,
                'message' => 'Please submit the general details form first. Otherwise, edit this form!'
            ], 200);
        }
        

        $validator = Validator::make($request->all(), [
            'sea_import_id'   => 'required|integer|required',
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
            'remarks'         => 'required|string|max:255',
            'printed'         => 'nullable|string|max:100',
            'selected'        => 'nullable|string|max:100',
            'sector'          => 'nullable|string|max:100',
            'previous_days'   => 'nullable|integer|min:0',
            'sobDate'         => 'nullable|date',
            'agentSealNo'     => 'nullable|string',
            'mark_and_numbers' => 'required|string',
            'goods_description' => 'required|string',
            'bill_of_entry_date' => 'nullable|string',
            'customer_inv_no' => 'nullable|string',
            'net_weight' => 'nullable|string',
            'ex_rate' => 'nullable',
            'rate' => 'nullable',
            
            'check_list_date' => 'nullable|date',
            'destuffing_date' => 'nullable|date',
            'out_off_charge_date' => 'nullable|date',
            'do_date' => 'nullable|date',
            'cust_seal_no' => 'nullable|string',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }
        
        $validated = $validator->validated();


        $validated['company_id'] = $this->company_id;
        $validated['uuid'] = Str::uuid();

        $container = OperationSeaImportCont::create($validated);

        return response()->json([
            'status'  => true,
            'message' => 'Container details added successfully!',
            'data'    => $container
        ], 201);


    }

    // Update Container via AJAX
    public function updateContainer(Request $request, int $id)
    {
        $container = OperationSeaImportCont::find($id);
    
        if (!$container) {
            return response()->json([
                'status' => false,
                'message' => 'Container not found'
            ], 404);
        }
    
        $validator = Validator::make($request->all(), [
            'cont_hbl'        => 'nullable|string|max:255',
            'container_no'    => 'required|string|max:20',
            'size'            => 'required|string|max:20',
            'seal_no'         => 'nullable|string|max:50',
            'gross_weight'    => 'required|numeric|min:0',
            'cbm'             => 'required|numeric|min:0',
            'refer'           => 'nullable|in:Y,N',
            'fcl_lcl'         => 'required|string|max:10',
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
            'remarks'         => 'required|string|max:255',
            'printed'         => 'nullable|string|max:100',
            'selected'        => 'nullable|string|max:100',
            'sector'          => 'nullable|string|max:100',
            'previous_days'   => 'nullable|integer|min:0',
            'sobDate'         => 'nullable|date',
            'agentSealNo'     => 'nullable|string',
            'mark_and_numbers'=> 'required|string',
            'goods_description'=> 'required|string',
            'bill_of_entry_date'        => 'nullable|string',
            'customer_inv_no' => 'nullable|string',
            'net_weight' => 'nullable|string',
            'cust_seal_no' => 'nullable|string',
            
            'check_list_date' => 'nullable|date',
            'do_date' => 'nullable|date',
            'destuffing_date' => 'nullable|date',
            'out_off_charge_date' => 'nullable|date',
            'ex_rate' => 'nullable',
            'rate' => 'nullable',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }
    
        $container->update($validator->validated());
    
        return response()->json([
            'status' => true,
            'message' => 'Container details updated successfully!',
            'data' => $container
        ]);
    }

    
    public function deleteContainer($id)
    {
        $container = OperationSeaImportCont::find($id);
        if(!$container) {
            return response()->json(['status'=>false,'message'=>'Container not found'],404);
        }
        $container->delete();
        return response()->json(['status'=>true,'message'=>'Container deleted successfully']);
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
        $file = OperationAllFileUpload::find($id);

        $filePath = 'public/' . $file->file_path;
        $fileName = $file->file_name;

        if (Storage::exists($filePath)) {
            return Storage::download($filePath, $fileName);
        }

        return back()->with('error', 'File not found.');
    }
    
    public function cargoArrivelDetails($id)
    {
        $page_title = 'Sea Import Cargo Arrival';
        $seaImport = OperationSeaImport::with(['shipperName', 'jobMaster', 'notifyName', 'consignee', 'dischargePortName', 'container', 'receiptPortName', 'loadingPortName', 'packageName', 'cfsYardName','shippingLine'])
            ->where('company_id', $this->company_id)
            ->where('id', $id)
            ->first();
            
        $company = Company::with(['companySetting', 'companyBranch'])
            ->where('id', $this->company_id)
            ->first();
            
        return view('admin-main/admin/seaImport/arrival-cargo-details', [
                'seaImport' => $seaImport,
                'company' => $company,
                'page_title'=>$page_title
            ]);
    }
    
    //mourya
    public function cargoArrivelDetailsExport($id)
    {
        $seaImport = OperationSeaImport::with(['shipperName', 'jobMaster', 'notifyName', 'consignee', 'dischargePortName', 'container', 'receiptPortName', 'loadingPortName', 'packageName','cfsYardName','shippingLine'])
            ->where('company_id', $this->company_id)
            ->where('id', $id)
            ->first();
            
        $company = Company::with(['companySetting', 'companyBranch'])
            ->where('id', $this->company_id)
            ->first();
    
        $format = request('format', 'pdf');
    
        if ($format === 'pdf') {
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView(
                'admin-main.admin.seaImport.arrival-cargo-details-pdf',
                compact('seaImport', 'company')
            )->setPaper('A4', 'portrait');
    
            return $pdf->download('cargo-arrival-' . $seaImport->id . '.pdf');
        }
       
        if ($format === 'word') {

            $fileName = 'Cargo_Arrival_Notice_'.$seaImport->id.'.doc';

            $content = view('admin-main.admin.seaImport.arrival-cargo-details-word', compact('seaImport', 'company'))->render();
        
            return response($content)
                ->header('Content-Type', 'application/msword')
                ->header('Content-Disposition', 'attachment; filename="'.$fileName.'"');
        }

        
    }
    
    //mourya
    public function freightCertificateDetails($id)
    {
        $page_title = 'Sea Import Freight Certificate';
        $seaImport = OperationSeaImport::with(['shipperName', 'jobMaster', 'notifyName', 'consignee', 'dischargePortName', 'container', 'loadingPortName', 'packageName'])
            ->where('company_id', $this->company_id)
            ->where('id', $id)
            ->first();
            
        $company = Company::with(['companySetting', 'companyBranch'])
            ->where('id', $this->company_id)
            ->first();
            
        return view('admin-main/admin/seaImport/freight-details', [
                'seaImport' => $seaImport,
                'company'   => $company,
                'page_title'=>$page_title
            ]);
    }
    
    //mourya
    public function freightCertificateExport($id)
    {
        $seaImport = OperationSeaImport::with([
            'shipperName', 'jobMaster', 'notifyName', 'consignee',
            'dischargePortName', 'container', 'loadingPortName', 'deliveryPortName'
        ])
        ->where('company_id', $this->company_id)
        ->findOrFail($id);
        
        $company = Company::with(['companySetting', 'companyBranch'])
            ->where('id', $this->company_id)
            ->first();
    
        $format = request('format', 'pdf');
    
        if ($format === 'pdf') {
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView(
                'admin-main.admin.seaImport.freight-certificate-pdf',
                compact('seaImport', 'company')
            )->setPaper('A4', 'portrait');
    
            return $pdf->download('freight-certificate-' . $seaImport->id . '.pdf');
        }
    
        if ($format === 'word') {
            $fileName = 'freight-certificate-' . $seaImport->id . '.doc';
    
            $content = view('admin-main.admin.seaImport.freight-certificate-word', compact('seaImport', 'company'))->render();
    
            return response($content)
                ->header('Content-Type', 'application/msword')
                ->header('Content-Disposition', 'attachment; filename="'.$fileName.'"');
        }
    
        return redirect()->back()->with('error', 'Invalid export format selected.');
    }

    
    public function blDraftOption(Request $request, $id)
    {
        $page_title = 'Sea Import BL';
        return view('admin-main/admin/seaImport/bl-draft-option', compact('id','page_title'));
    }

    // mourya
    public function showSeaWayBill(Request $request, $id)
    {
        $page_title = 'Sea Import BL-Draft';
        // Get all the necessary data
        $seaImportDraftData = OperationSeaImport::with([
            'ConsigneeName', 'blType', 'shipperName', 'deliveryPortName',
            'loadingPortName', 'dischargePortName', 'receiptPortName',  
            'container', 'agentName', 'deliveryAgentName', 'shippingLine', 
            'packageName', 'notifyName'
        ])->find($id);
        
        $company = Company::with(['companySetting', 'companyBranch'])
            ->where('id', $this->company_id)
            ->first();
        
        // Get BL type from request
        $blType = $request->hbl_type ?? 'DRAFT';
        
        // Get issue date from request or use current date
        $issueDate = $request->issue_date ?? date('d/m/Y');
        $freightPayable = $request->freight_payable ?? '';
        
        // Check if we're returning HTML for AJAX or full page
        if ($request->ajax() || $request->wantsJson()) {
            // Load the sea-way-bill view and return as HTML
            $html = view('admin-main.admin.seaImport.sea-way-bill', compact(
                'seaImportDraftData',
                'company',
                'blType',
                'issueDate',
                'freightPayable'
            ))->render();
            
            return response()->json(['html' => $html]);
        }
        
        // Return full page view
        return view('admin-main.admin.seaImport.sea-way-bill', compact(
            'seaImportDraftData',
            'company',
            'blType',
            'issueDate',
            'freightPayable',
            'page_title'
        ));
    }
    
    public function grossWeightTotal(Request $request)
    {
        $totalGrossWeight = OperationSeaImport::whereBetween(
            'created_at',
            [
                $request->start_date,
                $request->end_date
            ]
        )->sum('gross_weight');
    
        return response()->json([
            'status' => true,
            'total' => $totalGrossWeight
        ]);
    }
    
    //export restrictions
    public function checkSeaImportBlPermission(Request $request)
    {
        $request->validate([
            'job_no' => 'required|integer',
            'copy_type' => 'required|string',
        ]);
    
        $result = $this->downloadService->canDownload(
            $request->job_no,
            'sea_import',
            'mbl',
            $request->copy_type
        );
    
        if (!$result['status']) {
            return response()->json([
                'status' => false,
                'message' => $result['message']
            ],403);
        }
    
        return response()->json([
            'status'=>true
        ]);
    }
    
    public function confirmSeaImportBlDownload(Request $request)
    {
        $request->validate([
            'job_no'=>'required|integer',
            'copy_type'=>'required|string',
        ]);
    
        $this->downloadService->recordDownload(
            $request->job_no,
            'sea_import',
            'mbl',
            $request->copy_type
        );
    
        return response()->json([
            'status'=>true
        ]);
    }
    
    // public function generateDraft(Request $request, $id)
    // {
    //     $seaImportDraftData = OperationSeaImport::with(['ConsigneeName','blType', 'shipperName', 'deliveryPortName', 'loadingPortName', 'dischargePortName', 'receiptPortName',  'container', 'agentName'])->find($id);
        
    //     $company = Company::with(['companySetting', 'companyBranch'])
    //         ->where('id', $this->company_id)
    //         ->first();
        
    //     $draftHtml = '';
        
    //     $logoUrl = $company->logo 
    //         ? asset('public/uploads/company_logo/' . $company->logo)
    //         : asset('images/default-logo.png'); // fallback
        
    //     if($seaImportDraftData->freight === 'C'){
    //         $freightFullValue = 'COLLECT';
    //     }else{
    //         $freightFullValue = 'PREPAID';
    //     }
        
    //     if($request->hbl_type == 'DRAFT'){
    //         if ($seaImportDraftData) {
    //             $draftHtml = '
    //             <div style="font-family: Arial, sans-serif; font-size:12px; color:#000000; background:#fff; padding:10px;">
    //                 <table style="width:100%; border-collapse:collapse;">
    //                     <tr>
    //                         <!-- LEFT SIDE: Shipper, Consignee, Notify -->
    //                         <td style="width:50%; vertical-align:top;">
    //                             <table style="width:100%; min-height:150px; border-collapse:collapse; border:1px solid #000; border-right:0;">
    //                                 <tr><td style="padding:1px 1px;"><b>Consignor / Shipper</b></td></tr>
    //                                 <tr>
    //                                     <td style="padding:0 3px; font-size:9px;">
    //                                         '.($seaImportDraftData->shipperName->party_name ?? '').'<br>
    //                                         '.($seaImportDraftData->shipperName->address_line1 ?? '').'<br>
    //                                         '.($seaImportDraftData->shipperName->address_line2 ?? '').'
    //                                         '.($seaImportDraftData->shipperName->city ?? '').'<br>
                                            
    //                                         '.($seaImportDraftData->shipperName->contact_person 
    //                                             ? '<b>Contact Person: </b>'.$seaImportDraftData->shipperName->contact_person 
    //                                             : '').'
                                            
    //                                         '.($seaImportDraftData->shipperName->tel_no 
    //                                             ? ' <b>Contact No: </b>'.$seaImportDraftData->shipperName->tel_no 
    //                                             : '').'<br>
                                            
    //                                         '.($seaImportDraftData->shipperName->pincode 
    //                                             ? '<b>Pincode: </b>'.$seaImportDraftData->shipperName->pincode 
    //                                             : '').'<br>
                                            
    //                                         '.($seaImportDraftData->shipperName->gstin 
    //                                             ? '<b>GSTIN No: </b>'.$seaImportDraftData->shipperName->gstin 
    //                                             : '').'
    //                                     </td>
    //                                 </tr>
    //                             </table>
        
    //                             <table style="width:100%; min-height:150px; border:1px solid #000; border-top:none; border-right:none; border-collapse:collapse; vertical-align:top;">
    //                                 <tr><td style="padding:1px 3px;"><b>Consignee (or order)</b></td></tr>
    //                                 <tr>
    //                                     <td style="padding:0 3px; font-size:9px;;">
    //                                         '.($seaImportDraftData->ConsigneeName->party_name ?? '').'<br>
    //                                         '.($seaImportDraftData->ConsigneeName->address_line1 ?? '').'<br>
    //                                         '.($seaImportDraftData->ConsigneeName->address_line2 ?? '').'
    //                                         '.($seaImportDraftData->ConsigneeName->city ?? '').'<br>
           
    //                                         '.($seaImportDraftData->ConsigneeName->contact_person 
    //                                             ? '<b>Contact Person: </b>'.$seaImportDraftData->ConsigneeName->contact_person 
    //                                             : '').'
                                            
    //                                         '.($seaImportDraftData->ConsigneeName->tel_no 
    //                                             ? ' <b>Contact No: </b>'.$seaImportDraftData->ConsigneeName->tel_no 
    //                                             : '').'<br>
                                            
    //                                         '.($seaImportDraftData->ConsigneeName->pincode 
    //                                             ? '<b>Pincode: </b>'.$seaImportDraftData->ConsigneeName->pincode 
    //                                             : '').'<br>
                                            
    //                                         '.($seaImportDraftData->ConsigneeName->gstin 
    //                                             ? '<b>GSTIN No: </b>'.$seaImportDraftData->ConsigneeName->gstin 
    //                                             : '').'
                                            
    //                                     </td>
    //                                 </tr>
    //                             </table>
        
    //                             <table style="width:100%; min-height:160px; border-left:1px solid #000; border-collapse:collapse; vertical-align:top;">
    //                                 <tr><td style="padding:1px 3px;"><b>Notify Party</b></td></tr>
    //                                 <tr>
    //                                     <td style="padding:0 3px; font-size:9px;">  
    //                                         '.($seaImportDraftData->notifyName->party_name ?? '').'<br>
    //                                         '.($seaImportDraftData->notifyName->address_line1 ?? '').'<br>
    //                                         '.($seaImportDraftData->notifyName->address_line2 ?? '').'<br>
    //                                         '.($seaImportDraftData->notifyName->city ?? '').'<br>
                                            
    //                                         '.($seaImportDraftData->notifyName->contact_person 
    //                                             ? '<b>Contact Person: </b>'.$seaImportDraftData->notifyName->contact_person 
    //                                             : '').'
                                            
    //                                         '.($seaImportDraftData->notifyName->tel_no 
    //                                             ? ' <b>Contact No: </b>'.$seaImportDraftData->notifyName->tel_no 
    //                                             : '').'<br>
                                            
    //                                         '.($seaImportDraftData->notifyName->pincode 
    //                                             ? '<b>Pincode: </b>'.$seaImportDraftData->notifyName->pincode 
    //                                             : '').'<br>
                                            
    //                                         '.($seaImportDraftData->notifyName->gstin 
    //                                             ? '<b>GSTIN No: </b>'.$seaImportDraftData->notifyName->gstin 
    //                                             : '').'
                                                
                                                
    //                                     </td>
    //                                 </tr>
    //                             </table>
    //                         </td>
        
    //                         <!-- RIGHT SIDE: BL Info -->
    //                         <td style="width:50%; vertical-align:top;">
    //                             <table style="width:100%; min-height:170px; border:1px solid #000; border-collapse:collapse; padding:20px 0px;">
    //                                 <tr><td style="text-align:center; padding:16px;">
    //                                     <b>Booking No:</b> '.($seaImportDraftData->booking_no ?? '').'<br><br>
    //                                     <b>MBL No:</b> '.($seaImportDraftData->mbl_no ?? '').'<br><br>
    //                                     <b>BL DRAFT</b><br><br>
    //                                     <b>BILL OF LADING</b><br><br>
    //                                     <b>'.($company->company_name).'</b>
    //                                 </td></tr>
    //                             </table>
        
    //                             <table style="width:100%; min-height:210px; border:1px solid #000; border-top: none; border-collapse:collapse; padding:15px 0px; text-align:start;">
    //                                 <tr>
    //                                     <td style="padding:3px; vertical-align:top;">
    //                                         <b>Delivery Agent:</b><br>
    //                                         '.($seaImportDraftData->deliveryAgentName->party_name ?? '').'<br>
    //                                         '.($seaImportDraftData->deliveryAgentName->address_line1 ?? '').'
    //                                         '.($seaImportDraftData->deliveryAgentName->address_line2 ?? '').'
    //                                         '.($seaImportDraftData->deliveryAgentName->address_line3 ?? '').'
    //                                         '.($seaImportDraftData->deliveryAgentName->city ?? '').'<br>
                    
    //                                         '.($seaImportDraftData->deliveryAgentName->contact_person 
    //                                             ? '<b>Contact Person: </b>'.$seaImportDraftData->deliveryAgentName->contact_person 
    //                                             : '').'
                                            
    //                                         '.($seaImportDraftData->deliveryAgentName->tel_no 
    //                                             ? ' <b>Contact No: </b>'.$seaImportDraftData->deliveryAgentName->tel_no 
    //                                             : '').'<br>
                                            
    //                                         '.($seaImportDraftData->deliveryAgentName->pincode 
    //                                             ? '<b>Pincode: </b>'.$seaImportDraftData->deliveryAgentName->pincode 
    //                                             : '').'<br>
                                            
    //                                         '.($seaImportDraftData->deliveryAgentName->gstin 
    //                                             ? '<b>GSTIN No: </b>'.$seaImportDraftData->deliveryAgentName->gstin 
    //                                             : '').'
                                                
    //                                     </td>
    //                                 </tr>
    //                                 <tr style="width:100%; border:1px solid #000; vertical-align:top; padding:3px;">
    //                                     <td style="padding: 3px;">
    //                                         <b>SHIPPING LINE:</b><br> 
    //                                         '.($seaImportDraftData->shippingLine->shipping_line_name ?? ''). '<br>
    //                                         ' .($seaImportDraftData->shippingLine->address_line_1 ?? ''). ',
    //                                         ' .($seaImportDraftData->shippingLine->address_line_2 ?? ''). ',<br>
    //                                         ' .($seaImportDraftData->shippingLine->agent_code ?? ''). '<br>
    //                                         ' .(
    //                                             $seaImportDraftData->shippingLine->shipping_line_type == 1
    //                                                 ? 'Shipping Line Type: Indian'
    //                                                 : ($seaImportDraftData->shippingLine->shipping_line_type == 2
    //                                                     ? 'Shipping Line Type: Overseas'
    //                                                     : '')
    //                                         ). '
    //                                     </td>
    //                                 </tr>
    //                             </table>
        
    //                             <table style="width:100%; padding:3px; min-height:40px; border:1px solid #000; border-top:none; border-bottom:none; border-collapse:collapse;">
    //                                 <tr>
    //                                     <td style="padding: 3px;">
    //                                         <b>Number of Original MTD:</b> <small style="font-size:11px;">'.($seaImportDraftData->mbl_no ?? '').'</small>
    //                                     </td>
                                        
    //                                     <td>
    //                                         <b>Place of Delivery:</b> <small style="font-size:11px;">'.($seaImportDraftData->deliveryPortName->port_name ?? 'N/A').'</small>
    //                                     </td>
    //                                 </tr>
    //                             </table>
        
    //                         </td>
    //                     </tr>
    //                 </table>
        
    //                 <!-- FULL-WIDTH SECTION -->
    //                 <table style="width:100%; border-collapse:collapse; margin-top:1px;">
    //                     <tr>
    //                         <td style="width:50%; vertical-align:top;">
    //                             <table style="width:100%;  min-height:40px; border:1px solid #000; border-bottom:none; border-right:none; border-collapse:collapse;">
    //                                 <tr>
    //                                     <td style="padding: 3px;">
    //                                         <b>Ocean Vessel:</b> <small style="font-size:9px;">'.($seaImportDraftData->vessel_name ?? 'N/A').'</small>
    //                                     </td>
                                        
    //                                     <td>
    //                                         <b>Voyage No:</b> <small style="font-size:9px;">'.($seaImportDraftData->voyage_no ?? 'N/A').'</small>
    //                                     </td>
    //                                 </tr>
    //                             </table>
    //                         </td>
                            
    //                         <td style="width:50%; vertical-align:top;">
    //                             <table style="width:100%; min-height:40px; border:1px solid #000; border-bottom:none; border-collapse:collapse;">
    //                                 <tr>
    //                                     <td>
                                            
    //                                     </td>
                                        
    //                                     <td>
                                            
    //                                     </td>
    //                                 </tr>
    //                             </table>
    //                         </td>
    //                     </tr>
    //                     <tr>
    //                         <div style="display:flex; justify-content:space-between; border-top: 1px solid #000; ">
    //                             <div style="border:1px solid #000; border-top:none; padding:5px; flex:1;">
    //                                 <b>Port of Loading:</b><br> <small style="font-size:9px;">'.($seaImportDraftData->loadingPortName->port_name ?? 'N/A').'</small>
    //                             </div>
    //                             <div style="border-bottom:1px solid #000; padding:5px; flex:1;">
    //                                 <b>Port of Discharge:</b><br> <small style="font-size:9px;">'.($seaImportDraftData->dischargePortName->port_name ?? 'N/A').'</small>
    //                             </div>
    //                             <div style="border:1px solid #000; border-top:none; padding:5px; flex:1;">
    //                                 <b>Place of Receipt:</b><br> <small style="font-size:9px;">'.($seaImportDraftData->receiptPortName->port_name ?? 'N/A').'</small>
    //                             </div>
    //                             <div style="border:1px solid #000; border-top:none; border-left:none; padding:5px; flex:1;">
    //                                 <b>Place of Delivery:</b><br> <small style="font-size:9px;">'.($seaImportDraftData->deliveryPortName->port_name ?? 'N/A').'</small>
    //                             </div>
    //                         </div>
    //                     </tr>
    //                 </table>
        
    //                 <!-- BOTTOM SECTION SAME AS BEFORE -->
    //                 <table style="width:100%; min-height:300px; border-collapse:collapse;">
    //                     <tr>
    //                         <th style="border:1px solid #000; padding:5px; width:20%;">Marks and Numbers</th>
    //                         <th style="border:1px solid #000; padding:5px; width:40%;">No. of Packages / Description of Goods</th>
    //                         <th style="border:1px solid #000; padding:5px; width:20%;">Gross Weight</th>
    //                         <th style="border:1px solid #000; padding:5px; width:20%;">Net Weight</th>
    //                         <th style="border:1px solid #000; padding:5px; width:20%;">Measurement</th>
    //                     </tr>';
                        
    //                         foreach($seaImportDraftData->container as $container){   
                                
    //                         $draftHtml .=   '<tr style="min-height:285px; height:285px; vertical-align:top;">
    //                             <td style="border:1px solid #000; padding:6px; position:relative;">
    //                                 '.($container->mark_and_numbers ?? '').'
                                    
    //                                 <div style="position:absolute; bottom:0px;">
    //                                     <small><b>Container No:</b> '.($container->container_no ?? '').'</small><br>
    //                                     <small><b>A/Seal No:</b> '.($container->agentSealNo ?? '').'</small><br>
    //                                     <small><b>Cus Seal No:</b> '.($container->cust_seal_no ?? '').'</small><br>
    //                                 </div>
    //                             </td>
    //                             <td style="border:1px solid #000; padding:6px; position:relative;">
    //                                 Total : '.($container->total_package ?? '').' Packages Only<br>
    //                                 '.($container->goods_description ?? '').'<br>
    //                                 Package Type : '.($seaImportDraftData->packageName->package_code ?? '').'<br>
    //                                 Cus Inv. No: '.($container->customer_inv_no ?? '').'<br>
    //                                 Freight : '.(
    //                                         $seaImportDraftData->freight == 'P' 
    //                                             ? 'Prepaid' 
    //                                             : ($seaImportDraftData->freight == 'C' ? 'Collect' : '')
    //                                     ).'<br>
    //                                 <div style="position:absolute; bottom:0px;">
    //                                     <small><b>SOB Date:</b> '.($container->sobDate ?? '').'</small><br>
    //                                 </div>
    //                             </td>
    //                         <td style="border:1px solid #000; padding:6px; position:relative;">
    //                             '.($container->gross_weight ?? '0').' KGS
                                
    //                             <div style="position:absolute; bottom:0px;">
    //                                 <small><b>Size:</b> '.($container->size ?? '').'</small><br>
    //                             </div>
    //                         </td>
    //                         <td style="border:1px solid #000; padding:6px;">'.($container->net_weight ?? '0').' KGS</td>
                            
    //                         <td style="border:1px solid #000; padding:6px; position:relative;">
    //                             '.($container->cbm ?? '0').' CBM
                                
    //                         </td>
    //                     </tr>';
    //                 }
    //                 $draftHtml .= '</table>
        
    //                 <table style="width:100%; border:1px solid #000; border-top:none; border-collapse:collapse; margin-top:10px;">
    //                     <tr>
    //                         <td style="padding:5px;">
    //                             <b>Movement:</b> '.($seaImportDraftData->movement ?? '').'<br>
    //                         </td>
    //                     </tr>
    //                 </table>
        
    //                 <table style="width:100%; border:1px solid #000; border-top:none; border-collapse:collapse;">
    //                     <tr>
    //                         <td style="padding:5px; text-align:end;">'.($seaImportDraftData->container->pluck('fcl_lcl')->implode(', ') ?? '').' / '.($seaImportDraftData->container->pluck('fcl_lcl')->implode(', ') ?? '').'</td>
    //                     </tr>
    //                 </table>
    //                 <table style="width:100%; border-collapse:collapse; margin-top:25px;">
    //                     <tr>
    //                         <td style="width:33%; text-align:start;"><b>Issue Date:</b><br>'.($request->issue_date ?? '00/00/0000').'</td>
    //                         <td style="width:33%; text-align:center;"><b>Freight:</b><br>'.($freightFullValue).'</td>
    //                         <td style="width:33%; text-align:end;"><b>Signature:</b><br>&nbsp;</td>
    //                     </tr>
    //                 </table>
    //             </div>';
    //         }
        
    //         return response()->json(['html' => $draftHtml]);
    //     }
    //     elseif($request->hbl_type == 'ORIGINAL' || $request->hbl_type == '1st ORIGINAL' || $request->hbl_type == '2nd ORIGINAL' || $request->hbl_type == '3rd ORIGINAL' || $request->hbl_type == 'NON-NEGOTIABLE' || $request->hbl_type == 'SEA WAY B/L')
    //     {
    //         if ($seaImportDraftData) {
                
    //             $termsAndConditions = view('admin-main.admin.seaImport.term-condition')->render();
                
    //             $draftHtml = '
    //             <style>
    //                 @media print {
    //                     .page-break {
    //                         page-break-before: always;
    //                         page-break-inside: avoid;
    //                     }
    //                     .back-page {
    //                         page-break-before: always;
    //                     }
    //                     body {
    //                         margin: 0;
    //                         padding: 0;
    //                     }
    //                     .container-page {
    //                         page-break-after: always;
    //                     }
    //                     table {
    //                         page-break-inside: avoid;
    //                     }
    //                 }
                    
    //                 .bill-of-lading {
    //                     width: 210mm;
    //                     min-height: 297mm;
    //                     margin: 0 auto;
    //                     padding: 1mm 4mm 1mm 1mm;
    //                     font-family: Arial, sans-serif;
    //                     font-size: 11px;
    //                     color: #000;
    //                     background: #fff;
    //                     box-sizing: border-box;
    //                     position: relative;
    //                 }
                    
    //                 .back-side {
    //                     transform-origin: start;
    //                 }
    //             </style>';
        
    //             $containerCount = count($seaImportDraftData->container);
    //             $containerIndex = 0;
        
    //             foreach($seaImportDraftData->container as $container) {
    //                 $containerIndex++;
                    
    //                 $shipper   = $seaImportDraftData->shipperName;
    //                 $consignee = $seaImportDraftData->ConsigneeName;
    //                 $notify    = $seaImportDraftData->notifyName;
    //                 $deliveryAgent    = $seaImportDraftData->deliveryAgentName;
    //                 $shippingLine    = $seaImportDraftData->shippingLine;
                
    //                 // First container = FRONT PAGE
    //                 if($containerIndex == 1) {
    //                     $draftHtml .= '
    //                         <div class="bill-of-lading container-page">
    //                             <!-- TOP INFO SECTION -->
    //                             <table style="width:100%; border-collapse:collapse; border:1px solid #000; margin-bottom:0px;">
    //                                 <tr>
    //                                     <td style="width:50%; vertical-align:top; border-right:1px solid #000;">
    //                                         <!-- Shipper -->
    //                                         <div style="border-bottom:1px solid #000; min-height:150px; padding:3px;">
    //                                             <div style="font-weight:bold; color:#000000; font-size:10px; margin-bottom: 15px;">Consignor / Shipper</div>
    //                                             <div style="font-size:11px; color:#000000;">
    //                                                 '.(optional($shipper)->party_name ?? '').'<br>
    //                                                 '.(optional($shipper)->address_line1 ?? '').'<br>
    //                                                 '.(optional($shipper)->address_line2 ?? '').'<br>
    //                                                 '.(optional($shipper)->city ?? '').'<br>
                                                    
    //                                                 '.(optional($shipper)->contact_person 
    //                                                     ? '<b>Contact Person: </b>'.optional($shipper)->contact_person 
    //                                                     : '').'
                                                    
    //                                                 '.(optional($shipper)->tel_no 
    //                                                     ? ' <b>Contact No: </b>'.optional($shipper)->tel_no 
    //                                                     : '').'<br>
                                                    
    //                                                 '.(optional($shipper)->pincode 
    //                                                     ? '<b>Pincode: </b>'.optional($shipper)->pincode 
    //                                                     : '').'<br>
                                                    
    //                                                 '.(optional($shipper)->gstin 
    //                                                     ? '<b>GSTIN No: </b>'.optional($shipper)->gstin 
    //                                                     : '').'
    //                                             </div>
    //                                         </div>
                    
    //                                         <!-- Consignee -->
    //                                         <div style="border-bottom:1px solid #000; min-height:150px; padding:3px;">
    //                                             <div style="font-weight:bold; color:#000000; font-size:10px; margin-bottom: 15px;">Consignee (or order)</div>
    //                                             <div style="font-size:11px; color:#000000;">
    //                                                 '.(optional($consignee)->party_name ?? '').'<br>
    //                                                 '.(optional($consignee)->address_line1 ?? '').'<br>
    //                                                 '.(optional($consignee)->address_line2 ?? '').'<br>
    //                                                 '.(optional($consignee)->city ?? '').'<br>
    //                                                 '.(optional($consignee)->contact_person 
    //                                                     ? '<b>Contact Person: </b>'.optional($consignee)->contact_person 
    //                                                     : '').'
                                                    
    //                                                 '.(optional($consignee)->tel_no 
    //                                                     ? ' <b>Contact No: </b>'.optional($consignee)->tel_no 
    //                                                     : '').'<br>
                                                    
    //                                                 '.(optional($consignee)->pincode 
    //                                                     ? '<b>Pincode: </b>'.optional($consignee)->pincode 
    //                                                     : '').'<br>
                                                    
    //                                                 '.(optional($consignee)->gstin 
    //                                                     ? '<b>GSTIN No: </b>'.optional($consignee)->gstin 
    //                                                     : '').'
    //                                             </div>
    //                                         </div>
                    
    //                                         <!-- Notify Party -->
    //                                         <div style="border-bottom:1px solid #000; min-height:120px; padding:3px;">
    //                                             <div style="font-weight:bold; color:#000000; font-size:10px; margin-bottom: 15px;">Notify Party</div>
    //                                             <div style="font-size:11px; color:#000000;">  
    //                                                 '.(optional($notify)->party_name ?? '').'<br>
    //                                                 '.(optional($notify)->address_line1 ?? '').'<br>
    //                                                 '.(optional($notify)->address_line2 ?? '').'<br>
    //                                                 '.(optional($notify)->city ?? '').'<br>
                                                    
    //                                                 '.(optional($notify)->contact_person 
    //                                                     ? '<b>Contact Person: </b>'.optional($notify)->contact_person 
    //                                                     : '').'
                                                    
    //                                                 '.(optional($notify)->tel_no 
    //                                                     ? ' <b>Contact No: </b>'.optional($notify)->tel_no 
    //                                                     : '').'<br>
                                                    
    //                                                 '.(optional($notify)->pincode 
    //                                                     ? '<b>Pincode: </b>'.optional($notify)->pincode 
    //                                                     : '').'<br>
                                                    
    //                                                 '.(optional($notify)->gstin 
    //                                                     ? '<b>GSTIN No: </b>'.optional($notify)->gstin 
    //                                                     : '').'
    //                                             </div>
    //                                         </div>
                                            
    //                                         <!-- Place of Acceptance & Vessel -->
    //                                         <table style="width:100%; border-collapse:collapse;">
    //                                             <tr>
    //                                                 <td style="border-bottom:1px solid #000; padding:3px; vertical-align:top; min-height:20px;">
    //                                                     <b style="font-size:9px;">Place of Acceptance:</b><br>
    //                                                     <div style="font-size:9px;">'.($seaImportDraftData->place_of_acceptance ?? '').'</div>
    //                                                 </td>
    //                                             </tr>
    //                                             <tr>
    //                                                 <td style=" padding:3px;  vertical-align:top; min-height:20px;">
    //                                                     <b style="font-size:9px;">Vessel / Voyage no:</b><br>
    //                                                     <div style="font-size:9px;">'.($seaImportDraftData->vessel_name ?? '').' / '.($seaImportDraftData->voyage_no ?? 'N/A').'</div>
    //                                                 </td>
    //                                             </tr>
    //                                         </table>
    //                                     </td>
                    
    //                                     <!-- RIGHT SIDE: BL Info -->
    //                                     <td style="width:50%; vertical-align:top;">
    //                                         <!-- BL Header -->
    //                                         <div style="border-bottom:1px solid #000; padding:3px 10px;">
    //                                             <table style="width:100%;">
    //                                                 <tr style="padding: 7px;">
    //                                                     <td style="text-align:left; font-size:12px; padding: 7px;">
    //                                                         <b>Booking No:</b> '.($seaImportDraftData->booking_no ?? '').'
    //                                                     </td>
    //                                                     <td style="text-align:right; font-size:12px; padding: 7px;">
    //                                                         <b>MBL No:</b> '.($seaImportDraftData->mbl_no ?? '').'
    //                                                     </td>
    //                                                 </tr>
    //                                                 <tr>
    //                                                     <td style="text-align:left; font-size:12px;">
    //                                                         <b>Reg No</b>
    //                                                     </td>
    //                                                     <td style="text-align:left; font-size:12px;">
    //                                                         <b>BL Type</b> '.($seaImportDraftData->blType->bl_description ?? '').'
    //                                                     </td>
    //                                                 </tr>
    //                                             </table>
    //                                         </div>
                                            
    //                                         <!-- Company Logo & Info -->
    //                                         <div style="border-bottom:1px solid #000; min-height:200px; padding:20px 10px; text-align:center;">
    //                                             <div style="margin-bottom:5px;">
    //                                                 <img src="'.$logoUrl.'" style="max-width:100px; max-height:80px;">
    //                                             </div>
    //                                             <div style="text-align:left;">
    //                                                 <h4 style="margin:0; font-size:14px;">'.($company->company_name).'</h4>
    //                                                 <small style="font-size:10px; letter-spacing: 1px;">'.($company->address).'</small><br>
    //                                                 <small style="font-size:10px;"><span style="text-decoration:underline;">PAN NO: '.(optional($company->companySetting)->pan_no).'</span></small>&nbsp;
    //                                                 <small style="font-size:10px;"><span style="text-decoration:underline;">GSTIN NO: '.(optional($company->companySetting)->gstin_no).'</span></small><br>
    //                                                 <small style="font-size:10px;"><span style="text-decoration:underline;">TAN NO: '.(optional($company->companySetting)->tan_no).'</span></small>&nbsp;
    //                                                 <small style="font-size:10px;"><span style="text-decoration:underline;">PHONE: '.(optional($company->companySetting)->phone).'</span></small><br>
    //                                                 <small style="font-size:10px;"><span style="text-decoration:underline;">CIN NO: '.(optional($company->companySetting)->cin_no).'</span></small>&nbsp;
    //                                                 <small style="font-size:10px;"><span style="text-decoration:underline;">Email: '.(optional($company->companySetting)->email).'</span></small><br>
    //                                             </div>
    //                                         </div>
                                            
    //                                         <!-- MTO Clause -->
    //                                         <div style="border-bottom:1px solid #000; min-height:100px; padding:3px 10px;">
    //                                             <small style="color:#000000; font-size:9px; line-height:1.2;">
    //                                                 Taken in charge in apparently goods condition herein at the place of receipt for transport & delivery as mentioned above, unless otherwise stated. The MTO in accordance with the provision contained in the MTD undertakes to perform or to procure the performance of the multimodal transport from the place at which the goods are taken in charge to the place designed for delivery and assumes responsibility for such transport. One of the MTD(s) must be surrendered, duly endorsed in exchange for the goods. In witness where of the original MTD all of this tenor and date have been signed in the number indicated below one of which being accomplished the other(s) to be void.
    //                                             </small>
    //                                         </div>
                    
    //                                         <!-- Delivery Agent -->
    //                                         <div style="padding:3px 10px; min-height:60px;">
    //                                             <b style="font-size:9px;">Delivery Agent:</b><br>
    //                                             <div style="font-size:11px; margin-top: 15px;">
    //                                                 '.(optional($deliveryAgent)->party_name ?? '').'<br>
    //                                                 '.(optional($deliveryAgent)->address_line1 ?? '').'
    //                                                 '.(optional($deliveryAgent)->address_line2 ?? '').'
    //                                                 '.(optional($deliveryAgent)->address_line3 ?? '').'
    //                                                 '.(optional($deliveryAgent)->city ?? '').'<br>
    //                                                 '.(optional($deliveryAgent)->contact_person 
    //                                                     ? '<b>Contact Person: </b>'.optional($deliveryAgent)->contact_person 
    //                                                     : '').'
                                                    
    //                                                 '.(optional($deliveryAgent)->tel_no 
    //                                                     ? ' <b>Contact No: </b>'.optional($deliveryAgent)->tel_no 
    //                                                     : '').'<br>
                                                    
    //                                                 '.(optional($deliveryAgent)->pincode 
    //                                                     ? '<b>Pincode: </b>'.optional($deliveryAgent)->pincode 
    //                                                     : '').'<br>
                                                    
    //                                                 '.(optional($deliveryAgent)->gstin 
    //                                                     ? '<b>GSTIN No: </b>'.optional($deliveryAgent)->gstin 
    //                                                     : '').'
    //                                             </div>
    //                                         </div>
    //                                     </td>
    //                                 </tr>
    //                             </table>
                                
    //                             <!--PORT INFO -->
    //                             <table style="width:100%; border-collapse:collapse; color:#000000; border:1px solid #000; border-top: none;">
    //                                 <tr>
    //                                     <td style="width:25%; padding:4px; border-right:1px solid #000;">
    //                                         <b style="font-size:9px;">Place of Receipt:</b><br>
    //                                         <div style="min-height:20px; font-size:9px;">'.($seaImportDraftData->receiptPortName->port_name ?? 'N/A').'</div>
    //                                     </td>
    //                                     <td style="width:25%; padding:4px; border-right:1px solid #000;">
    //                                         <b style="font-size:9px;">Port of Loading:</b><br>
    //                                         <div style="min-height:20px; font-size:9px;">'.($seaImportDraftData->loadingPortName->port_name ?? 'N/A').'</div>
    //                                     </td>
    //                                     <td style="width:25%; padding:4px; border-right:1px solid #000;">
    //                                         <b style="font-size:9px;">Port of Discharge:</b><br>
    //                                         <div style="min-height:20px; font-size:9px;">'.($seaImportDraftData->dischargePortName->port_name ?? 'N/A').'</div>
    //                                     </td>
    //                                     <td style="width:25%; padding:4px;">
    //                                         <b style="font-size:9px;">Final Place of Delivery:</b><br>
    //                                         <div style="min-height:20px; font-size:9px;">'.($seaImportDraftData->deliveryPortName->port_name ?? 'N/A').'</div>
    //                                     </td>
    //                                 </tr>
    //                             </table>';
                                
    //                         // FIRST CONTAINER DETAILS (FRONT PAGE)
    //                         $draftHtml .= '
    //                             <!-- CARGO DETAILS FOR FIRST CONTAINER -->
    //                             <table style="width:100%; border-collapse:collapse; color:#000000; border:1px solid #000;">
    //                                 <tr>
    //                                     <th style="border:1px solid #000; padding:10px; background:#f5f5f5; font-size:9px;">Marks & Numbers</th>
    //                                     <th style="border:1px solid #000; padding:10px; background:#f5f5f5; font-size:9px;">No. of Packages / Kind of packages / Description of Goods</th>
    //                                     <th style="border:1px solid #000; padding:10px; background:#f5f5f5; font-size:9px;">Gross Weight</th>
    //                                     <th style="border:1px solid #000; padding:10px; background:#f5f5f5; font-size:9px;">Net Weight</th>
    //                                     <th style="border:1px solid #000; padding:10px; background:#f5f5f5; font-size:9px;">Measurement (CBM)</th>
    //                                 </tr>
    //                                 <tr style="min-height:260px; height:350px; vertical-align:top;">
    //                                     <td style="border:1px solid #000; padding:4px; position:relative;">
    //                                         '.($container->mark_number ?? '').'
                                            
    //                                         <div style="position:absolute; bottom:0px; width:95%; font-size:9px;">
    //                                             <small><b>Container No:</b> '.($container->container_no ?? '').'</small><br>
    //                                             <small><b>A/Seal No:</b> '.($container->agent_seal_no ?? '').'</small><br>
    //                                             <small><b>Cus Seal No:</b> '.($container->cust_seal_no ?? '').'</small><br>
    //                                         </div>
    //                                     </td>
    //                                     <td style="border:1px solid #000; padding:4px; position:relative;">
    //                                         Total : '.($container->total_package ?? '').' Packages Only<br>
    //                                         '.($container->goods_description ?? '').'<br>
    //                                         Package Type : '.($seaImportDraftData->packageName->package_code ?? '').'<br>
    //                                         Cus Inv. No: '.($container->customer_inv_no ?? '').'<br>
    //                                         FREIGHT : '.($seaImportDraftData->freight ?? '').'<br>
                                            
    //                                         <div style="position:absolute; bottom:0px; width:95%; font-size:9px;">
    //                                             <small><b>SOB Date:</b> '.($seaImportDraftData->sob_date ?? '').'</small><br>
    //                                         </div>
    //                                     </td>
    //                                     <td style="border:1px solid #000; padding:4px; position:relative;">
    //                                         '.($container->gross_weight ?? '0').' KGS
                                            
    //                                         <div style="position:absolute; bottom:0px; width:95%; font-size:8px;">
    //                                             <small><b>Size:</b> '.($container->size ?? '').'</small><br>
    //                                         </div>
    //                                     </td>
    //                                     <td style="border:1px solid #000; padding:4px; font-size:10px;">
    //                                         '.($container->net_weight ?? '0').' KGS
    //                                     </td>
    //                                     <td style="border:1px solid #000; padding:4px; position:relative;">
    //                                         '.($container->cbm ?? '0').' CBM
    //                                         <div style="position:absolute; bottom:0px; width:95%; font-size:8px;">
    //                                             <small><b>Type:</b> '.($container->fcl_lcl ?? '').'</small><br>
    //                                         </div>
    //                                     </td>
    //                                 </tr>
    //                             </table>
    //                             <!-- CONTAINER DETAILS -->
    //                             <table style="width:100%; border-collapse:collapse; border:1px solid #000; border-top: none;">
    //                                 <tr>
    //                                     <td style="width:70%; padding:4px; vertical-align:top; font-size:9px;">
    //                                         <div><b>Shipping line:</b></div>
    //                                         '.(optional($shippingLine)->shipping_line_name ?? ''). '<br>
    //                                         ' .(optional($shippingLine)->address_line_1 ?? ''). '
    //                                         ' .(optional($shippingLine)->address_line_2 ?? ''). ',<br>
    //                                         ' .(optional($shippingLine)->agent_code ?? ''). '&nbsp;&nbsp;&nbsp;
    //                                       ' .(
    //                                             optional($shippingLine)->shipping_line_type == 1
    //                                                 ? 'Indian'
    //                                                 : (optional($shippingLine)->shipping_line_type == 2
    //                                                     ? 'Overseas'
    //                                                     : '')
    //                                         ). '
    //                                     </td>
    //                                     <td style="width:30%; padding:4px; vertical-align:top; text-align: right; font-size:9px;">
    //                                         <b>Movement:</b> '.($seaImportDraftData->movement ?? '').'
    //                                     </td>
    //                                 </tr>
    //                             </table>
                    
    //                             <!-- FOOTER SECTION -->
    //                             <table style="width:100%; border-collapse:collapse; border:1px solid #000; border-top: none;">
    //                                 <tr>
    //                                     <td style="width:20%; padding:4px; vertical-align:top; font-size:9px;">
    //                                         <b>Freight Payable at:</b><br>
    //                                         <div style="min-height:20px;">'.($request->freight_payable ?? '').'</div>
    //                                     </td>
    //                                     <td style="width:20%; padding:4px; vertical-align:top; border-left:1px solid #000; font-size:9px;">
    //                                         <b>Issue Date:</b><br>
    //                                         <div style="min-height:20px;">'.($request->issue_date ?? '00/00/0000').'</div>
    //                                     </td>
    //                                     <td style="width:20%; padding:4px; vertical-align:top; border-left:1px solid #000; font-size:9px;">
    //                                         <b>Freight :</b><br>
    //                                         <div style="min-height:20px;">'.($seaImportDraftData->freight ?? '').'</div>
    //                                     </td>
    //                                     <td style="width:40%; padding:4px; vertical-align:top; border-left:1px solid #000; text-align:right; font-size:9px;">
    //                                         <b>For '.($company->company_name).'</b><br><br>
    //                                         ___________________________<br>
    //                                         Authorized Signature
    //                                     </td>
    //                                 </tr>
    //                             </table>
    //                         </div>';
                      
                            
    //                         if($containerCount == 1) {
    //                             // Single container - terms on back of same page
    //                             $draftHtml .= '
    //                             <div class="page-break"></div>
    //                             <div class="bill-of-lading back-side">
    //                                 <!-- TERMS AND CONDITIONS -->
    //                                 <div style="width:100%; height:100%; padding:4px; box-sizing:border-box;">
    //                                     <div style="font-size:7px; line-height:1;">
    //                                         ' . $termsAndConditions . '
    //                                     </div>
    //                                 </div>
    //                             </div>';
    //                         } else {
    //                             // Multiple containers - first show additional containers
    //                             $draftHtml .= '
    //                             <div class="page-break"></div>
    //                             <div class="bill-of-lading back-side">
    //                                 <!-- TERMS AND CONDITIONS -->
    //                                 <div style="width:100%; height:100%; padding:4px; box-sizing:border-box;">
    //                                     <div style="font-size:7px; line-height:1;">
    //                                         ' . $termsAndConditions . '
    //                                     </div>
    //                                 </div>
    //                             </div>
    //                             <div class="bill-of-lading container-page back-side">
    //                                 <div style="text-align:center; margin-bottom:20px;">
    //                                     <h3 style="font-size:14px;">ADDITIONAL CONTAINER DETAILS</h3>
    //                                     <div style="font-size:10px;">(Back Side of Bill of Lading)</div>
    //                                 </div>';
    //                         }
                            
                            
                            
    //                     }
    //                     // Additional containers = BACK PAGE
    //                     elseif($containerIndex > 1) {
    //                         $draftHtml .= '
    //                             <!-- ADDITIONAL CONTAINER '.($containerIndex-1).' -->
    //                             <div style="margin-bottom:20px; min-height:200px; border:1px solid #000; padding:10px;">
    //                                 <h4 style="font-size:12px; margin-bottom:10px;">Container '.($containerIndex-1).' Details</h4>
    //                                 <table style="width:100%; border-collapse:collapse; color:#000000; border:1px solid #000;">
    //                                     <tr>
    //                                         <th style="border:1px solid #000; padding:4px; background:#f5f5f5; font-size:9px;">Marks & Numbers</th>
    //                                         <th style="border:1px solid #000; padding:4px; background:#f5f5f5; font-size:9px;">Description of Goods</th>
    //                                         <th style="border:1px solid #000; padding:4px; background:#f5f5f5; font-size:9px;">Gross Weight</th>
    //                                         <th style="border:1px solid #000; padding:4px; background:#f5f5f5; font-size:9px;">Net Weight</th>
    //                                         <th style="border:1px solid #000; padding:4px; background:#f5f5f5; font-size:9px;">Measurement</th>
    //                                     </tr>
    //                                     <tr style="min-height:200px; height:200px; vertical-align:top;">
    //                                         <td style="border:1px solid #000; padding:4px; position:relative; font-size:9px;">
    //                                             '.($container->mark_number ?? '').'
    //                                             <div style="position:absolute; bottom:0px; width:95%; font-size:8px;">
    //                                                 <small><b>Container No:</b> '.($container->container_no ?? '').'</small><br>
    //                                                 <small><b>A/Seal No:</b> '.($container->agent_seal_no ?? '').'</small><br>
    //                                                 <small><b>Cus Seal No:</b> '.($container->cust_seal_no ?? '').'</small>
    //                                             </div>
    //                                         </td>
    //                                         <td style="border:1px solid #000; padding:4px; position:relative; font-size:9px;">
    //                                             Total : '.($container->total_package ?? '').' Packages Only<br>
    //                                             '.($container->goods_description ?? '').'<br>
    //                                             Package Type : '.($seaImportDraftData->packageName->package_code ?? '').'<br>
    //                                             Cus Inv. No: '.($container->customer_inv_no ?? '').'
    //                                             <div style="position:absolute; bottom:0px; width:95%; font-size:8px;">
    //                                                 <small><b>SOB Date:</b> '.($seaImportDraftData->sob_date ?? '').'</small>
    //                                             </div>
    //                                         </td>
    //                                         <td style="border:1px solid #000; padding:4px; position:relative; font-size:9px;">
    //                                             '.($container->gross_weight ?? '0').' KGS
    //                                             <div style="position:absolute; bottom:0px; width:95%; font-size:8px;">
    //                                                 <small><b>Size:</b> '.($container->size ?? '').'</small>
    //                                             </div>
    //                                         </td>
    //                                         <td style="border:1px solid #000; padding:4px; font-size:9px;">
    //                                             '.($container->net_weight ?? '0').' KGS
    //                                         </td>
    //                                         <td style="border:1px solid #000; padding:4px; position:relative; font-size:9px;">
    //                                             '.($container->cbm ?? '0').' CBM
    //                                             <div style="position:absolute; bottom:0px; width:95%; font-size:8px;">
    //                                                 <small><b>Type:</b> '.($container->fcl_lcl ?? '').'</small>
    //                                             </div>
    //                                         </td>
    //                                     </tr>
    //                                 </table>
    //                             </div>';
                                
    //                         // Close back-side div after last container
    //                         if($containerIndex == $containerCount) {
    //                             $draftHtml .= '
    //                                 <!-- PAGE NUMBER FOR BACK SIDE -->
    //                                 <div style="text-align:center; margin-top:20px; font-size:8px;">
    //                                     Page 2 of 2 - Additional Container Details
    //                                 </div>
    //                             </div>
    //                             <div class="page-break"></div>
    //                             <div class="bill-of-lading back-side">
    //                                 <!-- TERMS AND CONDITIONS -->
    //                                 <div style="width:100%; height:100%; padding:4px; box-sizing:border-box;">
    //                                     <div style="font-size:7px; line-height:1;">
    //                                         ' . $termsAndConditions . '
    //                                     </div>
    //                                 </div>
    //                             </div>
    //                             ';
    //                         }
    //                     }
    //                 }
            
    //             // If only one container, close properly
    //             if($containerCount == 1) {
    //                 $draftHtml .= '</div>';
    //             }
    //         }
        
    //         return response()->json(['html' => $draftHtml]);
    //     }
    // }
    
}
