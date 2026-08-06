<?php

namespace App\Http\Controllers\AdminMain\Operations;

use App\Models\MasterPort;
use Illuminate\Support\Str;
use App\Models\MasterVessel;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;
use App\Models\MasterImportParty;
use App\Models\MasterExportParty;
use App\Models\MasterParty;
use App\Models\MasterForwarder;
use App\Models\MasterPackage;
use App\Models\MasterShipping;
use App\Models\MasterBlType;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Operations\OperationJobMaster;
use App\Models\Operations\OperationSeaExport;
use App\Models\Operations\OperationAllFileUpload;
use App\Models\Operations\OperationSeaExportCont;
use App\Models\Operations\OperationSalesPerson;
use Illuminate\Support\Facades\Validator;
use App\Models\Operations\OperationSeaExportShipmentLine;

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Shared\Html;
use Carbon\Carbon;
use App\Models\Company;

use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpWord\SimpleType\Jc;
use App\Services\DocumentDownloadService;

class SeaExportController extends Controller
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

    public function index(Request $request)
    {
        $page_title = 'Sea Export';

        $query = OperationSeaExport::with(['shipperName', 'jobMaster', 'container'])
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

        if ($request->filled('shipper_id')) {
            $query->where('shipper_id', $request->shipper_id); // Use = not LIKE
        }

        if ($request->filled('start_date') || $request->filled('end_date')) {

            $query->whereHas('jobMaster', function ($q) use ($request) {

                if ($request->filled('start_date') && $request->filled('end_date')) {

                    $q->whereBetween('job_date', [
                        $request->start_date,
                        $request->end_date
                    ]);

                } elseif ($request->filled('start_date')) {
                    $q->where('job_date', '>=', $request->start_date);
                } elseif ($request->filled('end_date')) {
                    $q->where('job_date', '<=', $request->end_date);
                }

            });
        }

        $sea_exports = $query->orderBy('job_no', 'desc')->distinct()->paginate(25);
        $uploadedJobs = OperationAllFileUpload::pluck('job_no')->toArray();

        // For dropdowns
        $all_exports = OperationSeaExport::with('jobMaster')->where('company_id', $this->company_id)->get();

        $full_job_nums = $all_exports->pluck('full_job_no')->unique()->filter()->values();
        $job_nums = $all_exports->unique()->filter()->values();

        $booking_nums = $all_exports->pluck('booking_no')->unique()->filter()->values();

        // Fetch distinct shippers
        $shipperIds = $all_exports->pluck('shipper_id')->unique()->filter();
        $shipperNames = \App\Models\MasterExportParty::whereIn('id', $shipperIds)->get();

        return view('admin-main.admin.seaExport.index', compact(
            'sea_exports', 'full_job_nums', 'job_nums', 'booking_nums', 'shipperNames', 'page_title','uploadedJobs'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $page_title = 'Sea Export Create';
        $ports = MasterPort::where('company_id', $this->company_id)->get();
        $vessels = MasterVessel::where('company_id', $this->company_id)->get();
        $packages = MasterPackage::where('company_id', $this->company_id)->get();
        // $job_numbers = OperationJobMaster::where('company_id', $this->company_id)->orderBy('created_at', 'desc')->get();
        $job_numbers = OperationJobMaster::with(['consigneeName', 'shipperName'])
            ->where('company_id', $this->company_id)
            ->where('job_activity', 'SEAEXP.FWD')
            // ->orWhere('job_activity', 'SEAEXP.NVOCC')
            ->orderBy('created_at', 'desc')
            ->get();

        $parties = MasterImportParty::where('company_id', $this->company_id)->get();
        $forwarders = MasterForwarder::where('company_id', $this->company_id)->get();
        $party_lists  = MasterParty::all();
        $salePersons  = OperationSalesPerson::where('company_id', $this->company_id)->get();
        $exportParites = MasterExportParty::where('company_id', $this->company_id)->get();
        $partyTypes = MasterParty::whereNotIn('party_type', [9, 6, 8])->get();
        $shipping_lines = MasterShipping::where('company_id', $this->company_id)->get();

        $sea_exports = OperationSeaExport::select('id')->where('company_id', $this->company_id)->orderBy('full_job_no', 'asc')->get();
        $master_bl_types = MasterBlType::where(['company_id' => $this->company_id, 'status' => '1'])->orderBy('created_at', 'desc')->get();

        $files = OperationAllFileUpload::where('company_id', $this->company_id)->where('file_related', 'sea_export')->orderBy('created_at', 'desc')->get();

        return view('admin-main.admin.seaExport.create', compact('page_title','forwarders','shipping_lines', 'partyTypes','exportParites','ports', 'job_numbers', 'parties', 'vessels', 'sea_exports', 'files', 'party_lists', 'packages', 'salePersons', 'master_bl_types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $checkJobNumberExist = OperationSeaExport::where('job_no', $request->job_no)->first();
        if($checkJobNumberExist){
            return response()->json([
                'status'  => false,
                'message' => "An entry for this Job Number already exists, so you cannot create another entry with the same Job No.!",
            ], 201);
        }

        $validator = Validator::make($request->all(), [
            'entry_by' => 'required|in:Packinglist,nominated',
            'job_no' => 'required|integer',
            'full_job_no' => 'nullable|string',
            'booking_no' => 'nullable|string',
            'booking_date' => 'nullable|date',
            'vessel_name' => 'nullable|string',
            'voyage_no' => 'nullable|string',
            'mbl_no' => 'nullable|string',
            'hbl_no' => 'nullable|string',
            'enquiry_ref_no' => 'nullable|string',
            'quantity' => 'required|string',
            'package_id' => 'required|integer',
            'freight' => 'required|string',
            'freight_charges' => 'nullable|numeric',
            'gross_weight' => 'required|numeric',
            'net_weight' => 'required|numeric',
            'tare_weight' => 'nullable|numeric',
            'volume_unit' => 'required|string',
            'movement' => 'nullable|string',
            'cargo_type' => 'required|string',
            'eta_date' => 'nullable|date',
            'etd_date' => 'nullable|date',
            'cbm' => 'nullable|numeric',

            'port_cutoff' => 'nullable|date',
            'si_cutoff' => 'nullable|date',
            'document_cutoff' => 'nullable|date',
            'vgm_cutoff' => 'nullable|date',
            'remarks' => 'required|string',
            'agent_id' => 'nullable|integer',
            'delivery_agent_id' => 'nullable|integer',
            'bl_type' => 'nullable|integer',
            'issue_place' => 'nullable|string',
            'no_of_origin' => 'nullable|integer',
            'place_of_acceptance' => 'nullable|string',
            'sales_person_id' => 'nullable|integer',
            'stuffing_point' => 'nullable|string',
            'stuffingDate' => 'nullable|date',
            'cha_id' => 'nullable|integer',
            'shipping_line_id' => 'nullable|integer',
            'forwarder_id' => 'nullable|integer',
            'bl_issued_date' => 'nullable|date',
            'vgm_issued_date' => 'nullable|date',

            'shipper_id' => 'required|integer',
            'consignee_id' => 'required|integer',
            'notify_id' => 'nullable|integer',
            'notify2_id' => 'nullable|integer',
            'loading_port_id' => 'required|integer',
            'discharge_port_id' => 'required|integer',
            'receipt_port_id' => 'required|integer',
            'delivery_port_id' => 'required|integer',
            'destination_port_id' => 'nullable|integer',

            'insurance' => 'nullable|string',
            'fpa_amount' => 'nullable|string',
            'transportation' => 'nullable|string',
            'transportation_details' => 'nullable|string',
            'clearance' => 'nullable|string',
            'goods_description' => 'nullable|string',
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
        $validated['branch_id'] = Auth::user()->branch_id;
        $validated['uuid'] = Str::uuid();

        $sea_export_id = OperationSeaExport::create($validated);

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
        $page_title = 'Sea Export Edit';
        $sea_export = OperationSeaExport::where('uuid', $uuid)->firstOrFail();

        $ports = MasterPort::where('company_id', $this->company_id)->get();
        $vessels = MasterVessel::where('company_id', $this->company_id)->get();
        $packages = MasterPackage::where('company_id', $this->company_id)->get();
        $jobNumbers = OperationJobMaster::where('company_id', $this->company_id)->get();
        $parties = MasterImportParty::where('company_id', $this->company_id)->get();
        $forwarders = MasterForwarder::where('company_id', $this->company_id)->get();

        $party_lists  = MasterParty::whereNotIn('party_type', [9, 6, 8])->get();
        $salePersons  = OperationSalesPerson::where('company_id', $this->company_id)->get();

        $full_job_nums = OperationSeaExport::where('company_id', $this->company_id)->orderBy('full_job_no', 'asc')->get();
        $files = OperationAllFileUpload::where('company_id', $this->company_id)->where(['file_related' => 'sea_export', 'job_no' => $sea_export->job_no])->orderBy('created_at', 'desc')->get();

        $exportParites = MasterExportParty::where('company_id', $this->company_id)->get();
        $partyTypes = MasterParty::whereNotIn('party_type', [9, 6, 8])->get();
        $shipping_lines = MasterShipping::where('company_id', $this->company_id)->get();
        $master_bl_types = MasterBlType::where(['company_id' => $this->company_id, 'status' => '1'])->orderBy('created_at', 'desc')->get();

        $sea_export_containers = OperationSeaExportCont::where('company_id', $this->company_id)->where('sea_export_id', $sea_export->id)->get();
        $sea_export_shipment_line = OperationSeaExportShipmentLine::where('company_id', $this->company_id)->where('sea_export_id', $sea_export->id)->get();

        return view('admin-main.admin.seaExport.edit', compact('sea_export_shipment_line','page_title','shipping_lines', 'partyTypes','exportParites','sea_export', 'ports', 'jobNumbers', 'parties', 'vessels', 'files', 'packages', 'salePersons', 'party_lists', 'forwarders', 'master_bl_types', 'sea_export_containers'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $sea_export = OperationSeaExport::find($id);

        $validated = $request->validate([
            'entry_by' => 'required|in:Packinglist,nominated',
            'job_no' => 'required|integer',
            'full_job_no' => 'nullable|string',
            'booking_no' => 'nullable|string',
            'booking_date' => 'nullable|date',
            'vessel_name' => 'nullable|string',
            'voyage_no' => 'nullable|string',
            'mbl_no' => 'nullable|string',
            'hbl_no' => 'nullable|string',
            'enquiry_ref_no' => 'nullable|string',

            'quantity' => 'nullable|string',
            'package_id' => 'nullable|integer',
            'freight' => 'nullable|string',
            'freight_charges' => 'nullable|numeric',
            'gross_weight' => 'nullable|numeric',
            'net_weight' => 'required|numeric',
            'tare_weight' => 'nullable|numeric',
            'volume_unit' => 'nullable|string',
            'movement' => 'nullable|string',
            'cargo_type' => 'nullable|string',
            'eta_date' => 'nullable|date',
            'etd_date' => 'nullable|date',
            'cbm' => 'nullable|numeric',

            'port_cutoff' => 'nullable|date',
            'si_cutoff' => 'nullable|date',
            'document_cutoff' => 'nullable|date',
            'vgm_cutoff' => 'nullable|date',
            'remarks' => 'required|string',
            'agent_id' => 'nullable|integer',
            'delivery_agent_id' => 'nullable|integer',
            'bl_type' => 'nullable|integer',
            'issue_place' => 'nullable|string',

            'no_of_origin' => 'nullable|integer',
            'place_of_acceptance' => 'nullable|string',
            'sales_person_id' => 'nullable|integer',
            'stuffing_point' => 'nullable|string',
            'stuffingDate' => 'nullable|date',
            'cha_id' => 'nullable|integer',
            'shipping_line_id' => 'nullable|integer',
            'forwarder_id' => 'nullable|integer',
            'bl_issued_date' => 'nullable|date',
            'vgm_issued_date' => 'nullable|date',

            'shipper_id' => 'nullable|integer',
            'consignee_id' => 'nullable|integer',
            'notify_id' => 'nullable|integer',
            'notify2_id' => 'nullable|integer',
            'loading_port_id' => 'required|integer',
            'discharge_port_id' => 'required|integer',
            'receipt_port_id' => 'required|integer',
            'delivery_port_id' => 'required|integer',
            'destination_port_id' => 'nullable|integer',

            'insurance' => 'nullable|string',
            'fpa_amount' => 'nullable|string',
            'transportation' => 'nullable|string',
            'transportation_details' => 'nullable|string',
            'clearance' => 'nullable|string',

            'mark_number' => 'nullable|string',
            'goods_description' => 'nullable|string',
            'customer_inv_no' => 'nullable|string',
            'check_list_date' => 'nullable|date',
            'sbill_no' => 'nullable|string',
            'cartining_date' => 'nullable|date',
            'commodity' => 'nullable|string',
            'goods_description' => 'nullable|string',

        ]);
        $validated['user_id'] = $this->user_id;
        $validated['branch_id'] = Auth::user()->branch_id;

        $sea_export->update($validated);

        return redirect()->back()->with('success', 'Sea export Updated successfully. !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sea_export = OperationSeaExport::find($id);
        $sea_export->container()->delete();
        $sea_export->delete();

        return response()->json(['success' => 'Sea Export Entry Deleted Successfully. !']);
    }

    public function addContainer(Request $request)
    {

            if (!$request->filled('sea_export_id')) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Please submit the general details form first. Otherwise, edit this form!'
                ], 200);
            }


            $validator = Validator::make($request->all(), [
                'sea_export_id' => 'required|integer',
                'cont_hbl'        => 'nullable|string|max:100',
                'gross_weight'    => 'required|string|max:50',
                'total_package'   => 'required|string|max:50',
                'ground_date'     => 'nullable|date',
                'temp'            => 'nullable|string|max:50',
                'remarks'         => 'required|string|max:255',
                'cont_job_no'     => 'nullable|string|max:50',
                'container_no'    => 'nullable|string|max:100',
                'cbm'             => 'required|string|max:50',
                'cargo_type'      => 'nullable|string|max:100',
                'vgm_wt'          => 'nullable|string|max:50',
                'soc'             => 'nullable|string|max:50',
                'commodity'       => 'nullable|string',
                'size'            => 'required|string|max:50',
                'refer'           => 'nullable|in:Y,N',
                'agent_seal_no'   => 'nullable|string|max:100',
                'imo_code'        => 'nullable|string|max:50',
                'disposal'        => 'nullable|string|max:50',
                'sector'          => 'nullable|string|max:50',
                'cust_seal_no'    => 'nullable|string|max:100',
                'fcl_lcl'         => 'required|in:FCL,LCL,ETY,AIR',
                'net_weight'      => 'nullable|string|max:50',
                'uno_no'          => 'nullable|string|max:50',
                'detent_date'     => 'nullable|date',
                'prev_days'       => 'nullable|numeric|min:0',

                'mark_number' => 'required|string',
                'goods_description' => 'required|string',
                'customer_inv_no' => 'nullable|string',
                'sbill_no' => 'nullable|string',
                'commodity' => 'nullable|string',
                'stuffingDate' => 'nullable|date',

                'leo_date' => 'nullable|string',
                'sob_date' => 'nullable|date',
                'cartining_date' => 'nullable|string',
                'check_list_date' => 'nullable|string',
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

            $container = OperationSeaExportCont::create($validated);

            return response()->json([
                'status'  => true,
                'message' => 'Container details added successfully!',
                'data'    => $container
            ], 201);

    }

    public function updateContainer(Request $request, int $id)
    {

        $validator = Validator::make($request->all(), [
            'cont_hbl'        => 'nullable|string|max:100',
            'gross_weight'    => 'required|nullable|string|max:50',
            'total_package'   => 'required|nullable|string|max:50',
            'ground_date'     => 'nullable|date',
            'temp'            => 'nullable|string|max:50',
            'remarks'         => 'required|string|max:255',
            'cont_job_no'     => 'nullable|string|max:50',
            'container_no'    => 'nullable|string|max:100',
            'cbm'             => 'required|nullable|string|max:50',
            'cargo_type'      => 'nullable|string|max:100',
            'vgm_wt'          => 'nullable|string|max:50',
            'soc'             => 'nullable|string|max:50',
            'commodity'       => 'nullable|string',
            'size'            => 'required|nullable|string|max:50',
            'refer'           => 'nullable|in:Y,N',
            'agent_seal_no'   => 'nullable|string|max:100',
            'imo_code'        => 'nullable|string|max:50',
            'disposal'        => 'nullable|string|max:50',
            'sector'          => 'nullable|string|max:50',
            'cust_seal_no'    => 'nullable|string|max:100',
            'fcl_lcl'         => 'required|nullable|in:FCL,LCL,ETY,AIR',
            'net_weight'      => 'nullable|string|max:50',
            'uno_no'          => 'nullable|string|max:50',
            'detent_date'     => 'nullable|date',
            'prev_days'       => 'nullable|numeric|min:0',

            'mark_number' => 'required|string',
            'goods_description' => 'required|string',
            'customer_inv_no' => 'nullable|string',
            'sbill_no' => 'nullable|string',
            'commodity' => 'nullable|string',
            'stuffingDate' => 'nullable|date',

            'leo_date' => 'nullable|string',
            'sob_date' => 'nullable|date',
            'cartining_date' => 'nullable|string',
            'check_list_date' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $validated = $validator->validated();


        $sea_export_cont = OperationSeaExportCont::where('id', $request->sea_export_cont_id)->first();

        if($sea_export_cont){
            $sea_export_cont->update($validated);
        }else{
            $validated['sea_export_id'] = $id;
            $validated['company_id'] = $this->company_id;
            $validated['uuid'] = Str::uuid();
            OperationSeaExportCont::create($validated);
        }



        return redirect()->back()->with('success', 'Container Details Updated Sucessfully. !');
    }

    public function getContainerDetail($id)
    {
        $chargeDetail = OperationSeaExportCont::find($id);

        if (!$chargeDetail) {
            return response()->json(['error' => 'Charge not found'], 404);
        }

        return response()->json($chargeDetail);
    }

    public function deleteContainer($id)
    {
        $container = OperationSeaExportCont::find($id);
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
        $file = OperationAllFileUpload::find($id);

        $filePath = 'public/' . $file->file_path;
        $fileName = $file->file_name;

        if (Storage::exists($filePath)) {
            return Storage::download($filePath, $fileName);
        }

        return back()->with('error', 'File not found.');
    }


    public function blDraftOption(Request $request, $id)
    {
        $page_title = 'Sea Export BL';
        return view('admin-main/admin/seaExport/bl-draft-option', compact('id', 'page_title'));
    }

    // mourya
    public function showSeaWayBill(Request $request, $id)
    {
        // Get all the necessary data
        $seaExportDraftData = OperationSeaExport::with([
            'ConsigneeName', 'blType', 'shipperName', 'deliveryPortName',
            'loadingPortName', 'dischargePortName', 'receiptPortName',
            'container', 'agentName', 'deliveryAgentName', 'shippingLine',
            'packageName', 'notify'
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
            $html = view('admin-main.admin.seaExport.sea-way-bill', compact(
                'seaExportDraftData',
                'company',
                'blType',
                'issueDate',
                'freightPayable'
            ))->render();

            return response()->json(['html' => $html]);
        }

        // Return full page view
        return view('admin-main.admin.seaExport.sea-way-bill', compact(
            'seaExportDraftData',
            'company',
            'blType',
            'issueDate',
            'freightPayable'
        ));
    }

    // mourya change bl using blade
    public function generateDraft(Request $request, $id)
    {
        //
    }

    public function downloadSeaWayBillDocx(Request $request, $id)
    {
        try {
            /* ══════════════════════════════════════════════════════════
               1. FETCH DATA
               ══════════════════════════════════════════════════════════ */
            $seaExportDraftData = OperationSeaExport::with([
                'ConsigneeName', 'blType', 'shipperName', 'deliveryPortName',
                'loadingPortName', 'dischargePortName', 'receiptPortName',
                'container', 'agentName', 'deliveryAgentName', 'shippingLine',
                'packageName', 'notify',
            ])->find($id);

            if (!$seaExportDraftData) {
                return response()->json(['error' => 'Data not found'], 404);
            }

            $company = Company::with(['companySetting', 'companyBranch'])
                ->where('id', $this->company_id)
                ->first();

            $blType             = $request->hbl_type      ?? 'DRAFT';
            $issueDate          = $request->issue_date     ?? date('Y-m-d');
            $freightPayable     = $request->freight_payable ?? '';
            $formattedIssueDate = strtotime($issueDate)
                ? date('d/m/Y', strtotime($issueDate))
                : $issueDate;

            /* ══════════════════════════════════════════════════════════
               2. SANITIZER
               IMPORTANT: NO htmlspecialchars() here.
               PHPWord calls htmlspecialchars() internally inside addText().
               Adding it here causes double-escaping → corrupt XML → Word error.
               ══════════════════════════════════════════════════════════ */
            $clean = function ($v) {

                if ($v === null) {
                    return '';
                }

                $v = (string) $v;

                // Fix UTF-8
                $v = mb_convert_encoding($v, 'UTF-8', 'UTF-8');

                // Remove illegal XML control chars
                $v = preg_replace(
                    '/[^\P{C}\n\r\t]+/u',
                    '',
                    $v
                );

                return trim($v);
            };
            // Safe property getter
            $get = function ($obj, $prop, $default = '') use ($clean) {

                try {

                    if (!$obj) {
                        return $default;
                    }
                    $val = data_get($obj, $prop);

                    if ($val === null) {
                        return $default;
                    }

                    $val = trim((string)$val);

                    if ($val === '') {
                        return $default;
                    }

                    return $clean($val);

                } catch (\Throwable $e) {

                    \Log::warning("Property read failed: {$prop}");

                    return $default;
                }
            };

            /* ══════════════════════════════════════════════════════════
               3. DISPLAY VARIABLES  (mirrors blade @php block)
               ══════════════════════════════════════════════════════════ */
            $blTypeMap = [
                'DRAFT'          => 'DRAFT',
                'ORIGINAL'       => 'ORIGINAL',
                '1st ORIGINAL'   => '1st ORIGINAL',
                '2nd ORIGINAL'   => '2nd ORIGINAL',
                '3rd ORIGINAL'   => '3rd ORIGINAL',
                'NON-NEGOTIABLE' => 'COPY NON-NEGOTIABLE',
                'SEA WAY B/L'    => 'SEA WAY BILL',
            ];
            $blTypeDisplay  = $blTypeMap[$blType] ?? 'DRAFT';

            $companyName    = $get($company, 'company_name');
            $companyAddress = $get($company, 'address');
            $companySet     = optional($company->companySetting);

            $shipper      = $seaExportDraftData->shipperName;
            $consignee    = $seaExportDraftData->ConsigneeName;
            $notify       = $seaExportDraftData->notify;
            $delivAgent   = $seaExportDraftData->deliveryAgentName;
            $containers   = $seaExportDraftData->container;
            $hasCont      = $containers && count($containers) > 0;

            $blNo         = $clean($seaExportDraftData->mbl_no ?? $seaExportDraftData->hbl_no ?? '-');
            $bookingNo    = $get($seaExportDraftData, 'booking_no', '-');

            /* ══════════════════════════════════════════════════════════
               4. PHPWORD BOOTSTRAP
               ══════════════════════════════════════════════════════════ */
            $phpWord = new \PhpOffice\PhpWord\PhpWord();
            \PhpOffice\PhpWord\Settings::setOutputEscapingEnabled(true);
            $phpWord->setDefaultFontName('Times New Roman');
            $phpWord->setDefaultFontSize(9);

            $section = $phpWord->addSection([
                'marginTop'    => 500,
                'marginBottom' => 500,
                'marginLeft'   => 600,
                'marginRight'  => 600,
            ]);

            // ── Alignment shortcuts ──────────────────────────────────
            $aC = ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER];
            $aR = ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::END];
            $aB = ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH];

            // ── Safe addText closure ─────
            // Always call this instead of $cell->addText() directly.
            $tx = function ($element, $text, $font = [], $para = []) {
                try {

                    if ($text === null) {
                        return;
                    }

                    $text = trim((string)$text);

                    if ($text === '') {
                        return;
                    }

                    $text = mb_convert_encoding($text, 'UTF-8', 'UTF-8');

                    $element->addText(
                        $text,
                        $font ?: [],
                        $para ?: []
                    );

                } catch (\Throwable $e) {

                    \Log::error('PHPWord text error: ' . $e->getMessage());
                }
            };
            // ── Shared table border style ────────────────────────────
            $borderStyle = [
                'borderSize'  => 6,
                'borderColor' => '000000',
                'cellMargin'  => 60,
            ];
            /* ══════════════════════════════════════════════════════════
               5. COLUMN GRID
               ──────────────────────────────────────────────────────────
               A4 page (11 906 twips) – margins 600 each side = 10 706 usable.
               We use 10 700 twips split into 4 columns:

                 C1=2400  C2=2400  C3=2950  C4=2950  →  Total = 10 700

               Common gridSpan combos:
                 Header  row : [C1+C2+C3 = 7750] [C4 = 2950]
                 2-col   row : [C1+C2    = 4800] [C3+C4 = 5900]  ← 45 % | 55 %
                 3-col-A row : [C1=2400] [C2=2400] [C3+C4=5900]  ← ports
                 3-col-B row : [C1+C2=4800] [C3=2950] [C4=2950]  ← vessel
                 Full-span   : [C1+C2+C3+C4 = 10700]
               ══════════════════════════════════════════════════════════ */
            $C1 = 2400;
            $C2 = 2400;
            $C3 = 2950;
            $C4 = 2950;
            /* ══════════════════════════════════════════════════════════
               ▌ TABLE 1 – MAIN DOCUMENT BODY
               ══════════════════════════════════════════════════════════ */
            $phpWord->addTableStyle('mainTable', $borderStyle);
            $main = $section->addTable('mainTable');
            // ── ROW: HEADER ─────────────────────────────────────────

            // ── ROW: SHIPPER (left 45%) | BL INFO + COMPANY (right 55%) ──
            $main->addRow(1400);

            // Left – Consignor / Shipper
            $shipCell = $main->addCell($C1 + $C2, ['gridSpan' => 2]);
            $shipCell->addText('Consignor / Shipper', ['bold' => true, 'size' => 8]);
            $shipperLines = [
                $get($shipper, 'party_name'),
                $get($shipper, 'address_line1'),
                $get($shipper, 'address_line2'),
                $get($shipper, 'city'),
            ];

            foreach ($shipperLines as $line) {

                if (!empty(trim((string)$line))) {
                    $tx($shipCell, $line, ['size' => 9]);
                }
            }
            if ($v = $get($shipper, 'contact_person'))
                $tx($shipCell, 'Contact: ' . $v, ['size' => 8]);
            if ($v = $get($shipper, 'tel_no'))
                $tx($shipCell, 'Tel: ' . $v, ['size' => 8]);
            if ($v = $get($shipper, 'pincode'))
                $tx($shipCell, 'Pincode: ' . $v, ['size' => 8]);
            if ($v = $get($shipper, 'gstin'))
                $tx($shipCell, 'GSTIN No: ' . $v, ['size' => 8]);

            // Right – Booking / BL No. + Company
            $blCell = $main->addCell($C3 + $C4, ['gridSpan' => 2]);

            $tx(
                $blCell,
                'Booking No. - ' . $bookingNo,
                ['bold' => true, 'size' => 9],
                $aC
            );
            // $tx($blCell, 'BL Number', ['size' => 8], $aC);
            // $tx($blCell, $blNo, ['bold' => true, 'size' => 9], $aC);

            $blCell->addTextBreak(1);

            if ($companyName)
                $tx($blCell, $companyName, ['bold' => true, 'size' => 13], $aC);
            if ($companyAddress)
                $tx($blCell, $companyAddress, ['bold' => true, 'size' => 8], $aC);
            if ($v = $get($companySet, 'phone'))
                $tx($blCell, 'Tel: ' . $v, ['size' => 8], $aC);
            if ($v = $get($companySet, 'email'))
                $tx($blCell, 'Email: ' . $v, ['size' => 8], $aC);
            if ($v = $get($company, 'website'))
                $tx($blCell, 'Website: ' . $v, ['size' => 8], $aC);
            if ($v = $get($companySet, 'reg_no'))
                $tx($blCell, 'MTO Reg. No. ' . $v, ['bold' => true, 'size' => 10], $aC);

            // ── ROW: CONSIGNEE (left 45%) | COMPANY TERMS TEXT (right 55%) ──
            $main->addRow(1400);

            $consCell = $main->addCell($C1 + $C2, ['gridSpan' => 2]);
            $consCell->addText("Consignee (if 'To Order' as indicated)", ['bold' => true, 'size' => 8]);
            foreach (array_filter([
                $get($consignee, 'party_name'),
                $get($consignee, 'address_line1'),
                $get($consignee, 'address_line2'),
                $get($consignee, 'city'),
            ]) as $line) {
                $tx($consCell, $line, ['size' => 9]);
            }
            if ($v = $get($consignee, 'contact_person'))
                $consCell->addText('Contact: ' . $v, ['size' => 8]);
            if ($v = $get($consignee, 'tel_no'))
                $consCell->addText('Tel: ' . $v, ['size' => 8]);
            if ($v = $get($consignee, 'pincode'))
                $consCell->addText('Pincode: ' . $v, ['size' => 8]);
            if ($v = $get($consignee, 'gstin'))
                $consCell->addText('GSTIN No: ' . $v, ['size' => 8]);

            $termsCell = $main->addCell($C3 + $C4, ['gridSpan' => 2]);
            $termsCell->addText(
                'Taken in charge in apparently good condition herein at the place of receipt for transport and delivery as mentioned above, unless otherwise stated. The MTO in accordance with the provisions contained in the MTD undertakes to perform or to procure the performance of the multimodal transport from the place at which the goods are taken in charge, to the place designated for delivery and assumes responsibility for such transport.',
                ['size' => 7], $aB
            );
            $termsCell->addTextBreak(1);
            $termsCell->addText(
                'One of the MTD(s) must be surrendered, duly endorsed in exchange for the goods, in witness whereof the original MTD all of this tenor and date have been signed in the number indicated below, one of which being accomplished, the other(s) to be void.',
                ['size' => 7], $aB
            );

            // ── ROW: NOTIFY ADDRESS | PLACE OF DELIVERY ───────────
            $main->addRow();

            // LEFT CELL (spans col1+col2)
            $notCell = $main->addCell($C1 + $C2, ['gridSpan' => 2]);
            $notCell->addText(
                'Notify Address (No Claim shall be attached for failure to notify)',
                ['bold' => true, 'size' => 8]
            );
            if ($notify && $get($notify, 'party_name')) {
                foreach ([
                    $get($notify, 'party_name'),
                    $get($notify, 'address_line1'),
                    $get($notify, 'address_line2'),
                    $get($notify, 'city'),
                ] as $line) {
                    if (!empty(trim((string)$line))) {
                        $tx($notCell, $line, ['size' => 9]);
                    }
                }
            } else {
                $tx($notCell, 'Same as consignee', ['italic' => true, 'size' => 9]);
            }

            // RIGHT CELL (spans col3+col4)
            $routeCell = $main->addCell($C3 + $C4, ['gridSpan' => 2]);
            $routeCell->addText('Route/Place of Transhipment (if any)', ['bold' => true, 'size' => 8]);
            $tx($routeCell, $get($seaExportDraftData, 'transhipment_port', ''), ['size' => 9]);

            // ── ROW: PLACE OF ACCEPTANCE | PORT OF LOADING ─────────
            $main->addRow();

            $placeCell = $main->addCell($C1 + $C2, ['gridSpan' => 2]);
            $placeCell->addText('Place Of Acceptance', ['bold' => true, 'size' => 8]);
            $tx($placeCell, $get($seaExportDraftData, 'place_of_acceptance', ''), ['size' => 9]);

            $loadCell = $main->addCell($C3 + $C4, ['gridSpan' => 2]);
            $loadCell->addText('Port Of Loading', ['bold' => true, 'size' => 8]);
            $tx($loadCell, $get($seaExportDraftData->loadingPortName, 'port_name', ''), ['size' => 9]);
            // Label row
            // ── ROW: PORT OF DISCHARGE | ROUTE ─────────────────────
            $main->addRow();

            $dischargeCell = $main->addCell($C1 + $C2, ['gridSpan' => 2]);
            $dischargeCell->addText('Port Of Discharge', ['bold' => true, 'size' => 8]);
            $tx($dischargeCell, $get($seaExportDraftData->dischargePortName, 'port_name', 'N/A'), ['size' => 9]);

            $deliveryCell = $main->addCell($C3 + $C4, ['gridSpan' => 2]);
            $deliveryCell->addText('Place Of Delivery', ['bold' => true, 'size' => 8]);
            $tx(
                $deliveryCell,
                $get($seaExportDraftData->deliveryPortName, 'port_name', ''),
                ['size' => 9]
            );

            // ── ROWS: VESSEL & TRANSPORT (3-col-B pattern) ───────────
            // Label row
            $main->addRow(220);
            $main->addCell($C1 + $C2, ['gridSpan' => 2])->addText('Vessel & Voyage No.',          ['bold' => true, 'size' => 8]);
            $main->addCell($C3)->addText('Mode Means Of Transport',                                ['bold' => true, 'size' => 8]);
            $main->addCell($C4)->addText('Route/Place of Transhipment (if any)',                   ['bold' => true, 'size' => 8]);
            // Value row
            $main->addRow(260);
            $vesText = $get($seaExportDraftData, 'vessel_name', '');
            if ($voy = $get($seaExportDraftData, 'voyage_no'))
                $vesText .= '  V. ' . $voy;
            $tx($main->addCell($C1 + $C2, ['gridSpan' => 2]), $vesText, ['size' => 9]);
            $main->addCell($C3)->addText('Sea', ['size' => 9]);
            $tx($main->addCell($C4), $get($seaExportDraftData, 'transhipment_port', ''), ['size' => 9]);

            /* ══════════════════════════════════════════════════════════
               ▌ TABLE 2 – GOODS
               Columns: Container(2700) | Description(4800) | Weight(2000) | CBM(1200)
               ══════════════════════════════════════════════════════════ */
            $phpWord->addTableStyle('goodsTable', $borderStyle);
            $gTbl = $section->addTable('goodsTable');
            $G1 = 2700; $G2 = 4800; $G3 = 2000; $G4 = 1200;

            // Header row
            $gTbl->addRow(300);
            $gTbl->addCell($G1)->addText('Container No.(s) / Marks and Numbers', ['bold' => true, 'size' => 8]);
            $gTbl->addCell($G2)->addText('Number of Packages, Kinds of Packages, General Description of Goods', ['bold' => true, 'size' => 8]);
            $gTbl->addCell($G3)->addText('Gross Weight', ['bold' => true, 'size' => 8]);
            $gTbl->addCell($G4)->addText('Measurement', ['bold' => true, 'size' => 8]);
            // horizontally align the description...
            $centerParagraph = [
                'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER
            ];

            if ($hasCont) {
                foreach ($containers as $idx => $cont) {
                    $qty = (int) $get($cont, 'total_package', 0);
                    $formatter = new \NumberFormatter('en', \NumberFormatter::SPELLOUT);
                    $qtyInWords = ucfirst($formatter->format($qty));

                    $gTbl->addRow(2800, ['exactHeight' => false]);

                    // ── Container / Marks cell ───────────────────────
                    $cCell = $gTbl->addCell($G1);
                    $cCell->addText(
                        'Container: ' . $get($cont, 'container_no', 'N/A') . ' / ' . $get($cont, 'size', 'N/A'),
                        ['bold' => true, 'size' => 9]
                    );
                    $cCell->addText('C.S.No: ' . $get($cont, 'cust_seal_no', 'N/A'),  ['size' => 8]);
                    $cCell->addText('A.S.No: ' . $get($cont, 'agent_seal_no', 'N/A'), ['size' => 8]);
                    if ($marks = $get($cont, 'mark_number')) {
                        $cCell->addText('Marks and Numbers:', ['bold' => true, 'size' => 8]);
                        $tx($cCell, $marks, ['size' => 8]);
                    }
                    $fcl = $get($cont, 'fcl_lcl', '');
                    $mov = $get($seaExportDraftData, 'movement', '');
                    if ($fcl)
                        $cCell->addText($fcl . ' / ' . $fcl . ', ' . $mov, ['size' => 8]);
                    $cCell->addText('ALL DESTINATION CHARGES ON CONSIGNEE ACCOUNT', ['size' => 7]);

                    // List additional container numbers (mirrors blade's nested loop)
                    if ($idx === 0 && count($containers) > 1) {
                        $cCell->addTextBreak(1);
                        foreach ($containers as $i => $c2) {
                            if ($i >= 1) {
                                $cCell->addText(
                                    'Cont. No.' . $get($c2, 'container_no') . ' / ' . $get($c2, 'size'),
                                    ['size' => 8]
                                );
                            }
                        }
                    }

                    // ── Description cell ─────────────────────────────
                    $dCell = $gTbl->addCell($G2);
                    $qty     = $get($cont, 'total_package', '0');
                    $size     = $get($cont, 'size', '0');
                    $pkgCode = $get($seaExportDraftData->packageName, 'package_code', 'PCS');
                    $dCell->addText('Set To Container, Size- ' . $size, ['bold' => false, 'size' => 9],$centerParagraph);
                    $dCell->addText(
                        'Total Packages: ' . $qty . ' ' . $pkgCode .
                        ' (' . $qtyInWords . ' ' . strtolower($pkgCode) . ' only)',
                        ['bold' => true, 'size' => 9],$centerParagraph
                    );
                    $dCell->addText('Goods Description:', ['bold' => true, 'size' => 8],$centerParagraph);
                    $tx($dCell, $get($cont, 'goods_description', 'N/A'), ['size' => 9],$centerParagraph);
                    $dCell->addTextBreak(1);
                    if ($inv = $get($cont, 'customer_inv_no'))
                        $dCell->addText('INVOICE NO: ' . $inv, ['size' => 8],$centerParagraph);
                        $dCell->addTextBreak(1);
                    if ($sb = $get($cont, 'sbill_no'))
                        $dCell->addText('SB. NO: ' . $sb, ['size' => 8],$centerParagraph);
                        $dCell->addTextBreak(1);
                    $dCell->addTextBreak(2);
                    if ($sob = $get($cont, 'sob_date'))
                        $dCell->addText('SHIPPED ONBOARD DATE: ' . $sob, ['bold' => true, 'size' => 8], $aR);
                        $dCell->addTextBreak(1);

                    // ── Weight cell ──────────────────────────────────
                    $wCell = $gTbl->addCell($G3);
                    $tx($wCell, $get($seaExportDraftData, 'gross_weight', '0'), ['bold' => true, 'size' => 10], $aC);
                    $wCell->addText('KGS', ['size' => 8], $aC);
                    $wCell->addTextBreak(1);
                    $wCell->addText('Net Weight', ['bold' => true, 'size' => 8], $aC);
                    $tx($wCell, $get($seaExportDraftData, 'net_weight', '0'), ['size' => 9], $aC);
                    $wCell->addText('KGS', ['size' => 8], $aC);

                    // ── CBM cell ─────────────────────────────────────
                    $cbmCell = $gTbl->addCell($G4);
                    $tx($cbmCell, $get($seaExportDraftData, 'cbm', '0'), ['bold' => true, 'size' => 10], $aC);
                    $cbmCell->addText('CBM', ['size' => 8], $aC);
                }
            } else {
                // ── No-container fallback (mirrors blade @else block) ─
                $gTbl->addRow(2800);

                $ncCell = $gTbl->addCell($G1);
                $ncCell->addText('NO CONTAINER', ['bold' => true, 'size' => 9]);
                $ncCell->addText(
                    'Packages: ' . $get($seaExportDraftData, 'quantity', '0') . ' ' .
                    $get($seaExportDraftData->packageName, 'package_code', 'PCS'),
                    ['size' => 8]
                );
                if ($marks = $get($seaExportDraftData, 'mark_number')) {
                    $ncCell->addText('Marks and Numbers:', ['bold' => true, 'size' => 8]);
                    $tx($ncCell, $marks, ['size' => 8]);
                }
                $ncCell->addText('ALL DESTINATION CHARGES ON CONSIGNEE ACCOUNT', ['size' => 7]);

                $ndCell = $gTbl->addCell($G2);
                $ndCell->addText(
                    'Total Packages: ' . $get($seaExportDraftData, 'quantity', '0') . ' ' .
                    $get($seaExportDraftData->packageName, 'package_code', 'PCS') . ' ONLY',
                    ['bold' => true, 'size' => 9],$centerParagraph
                );
                $ndCell->addText('Goods Description:', ['bold' => true, 'size' => 8],$centerParagraph);
                $tx($ndCell, $get($seaExportDraftData, 'goods_description', 'N/A'), ['size' => 9],$centerParagraph);
                if ($inv = $get($seaExportDraftData, 'customer_inv_no'))
                    $ndCell->addText('INVOICE NO: ' . $inv, ['size' => 8],$centerParagraph);
                if ($sb = $get($seaExportDraftData, 'sbill_no'))
                    $ndCell->addText('SB. NO: ' . $sb, ['size' => 8],$centerParagraph);

                $nwCell = $gTbl->addCell($G3);
                $tx($nwCell, $get($seaExportDraftData, 'gross_weight', '0'), ['bold' => true, 'size' => 10], $aC);
                $nwCell->addText('KGS', ['size' => 8], $aC);
                $nwCell->addTextBreak(1);
                $nwCell->addText('Net Weight', ['bold' => true, 'size' => 8], $aC);
                $tx($nwCell, $get($seaExportDraftData, 'net_weight', '0'), ['size' => 9], $aC);
                $nwCell->addText('KGS', ['size' => 8], $aC);

                $ncbmCell = $gTbl->addCell($G4);
                $tx($ncbmCell, $get($seaExportDraftData, 'cbm', '0'), ['bold' => true, 'size' => 10], $aC);
                $ncbmCell->addText('CBM', ['size' => 8], $aC);
            }

            /* ══════════════════════════════════════════════════════════
               ▌ TABLE 3 – FREIGHT ROW  (full-width single cell)
               ══════════════════════════════════════════════════════════ */
            $phpWord->addTableStyle('freightTable', $borderStyle);

            $fTbl = $section->addTable('freightTable');

            $fTbl->addRow();


            // LEFT CELL = FREIGHT
            $freightCell = $fTbl->addCell(5350);

            $freightType = strtoupper(
                $get($seaExportDraftData, 'freight', 'PREPAID')
            );

            $tx(
                $freightCell,
                'FREIGHT : ' . $freightType,
                ['bold' => false, 'size' => 11],
                $aC
            );


            // RIGHT CELL = MOVEMENT
            $movementCell = $fTbl->addCell(5350);

            $movement = strtoupper(
                $get($seaExportDraftData, 'movement', 'N/A')
            );

            $tx(
                $movementCell,
                'MOVEMENT : ' . $movement,
                ['bold' => false, 'size' => 11],
                $aC
            );

            /* ══════════════════════════════════════════════════════════
               6. SAVE & RETURN
               ══════════════════════════════════════════════════════════ */
            $fileName = 'Sea_Way_Bill_' . time() . '.docx';
            $tempPath = storage_path('app/temp');
            if (!file_exists($tempPath)) {
                mkdir($tempPath, 0777, true);
            }
            $tempFile = $tempPath . '/' . $fileName;

            $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
            $objWriter->save($tempFile);

            if (!file_exists($tempFile) || filesize($tempFile) === 0) {
                throw new \Exception('Generated Word document is empty.');
            }

            return response()->download($tempFile, $fileName)->deleteFileAfterSend(true);

        } catch (\Exception $e) {
            \Log::error('Word download error: ' . $e->getMessage());
            \Log::error($e->getTraceAsString());
            return response()->json(
                ['error' => 'Failed to generate Word document: ' . $e->getMessage()],
                500
            );
        }
    }

    // public function downloadSeaWayBillDocx(Request $request, $id)
    // {
    //     $seaExportDraftData = OperationSeaExport::with([
    //         'ConsigneeName',
    //         'blType',
    //         'shipperName',
    //         'deliveryPortName',
    //         'loadingPortName',
    //         'dischargePortName',
    //         'receiptPortName',
    //         'container',
    //         'agentName',
    //         'deliveryAgentName',
    //         'shippingLine',
    //         'packageName',
    //         'notify'
    //     ])->find($id);

    //     $company = Company::with(['companySetting', 'companyBranch'])
    //         ->where('id', $this->company_id)
    //         ->first();

    //     $blType = $request->hbl_type ?? 'DRAFT';

    //     $issueDate = $request->issue_date ?? date('d/m/Y');

    //     $freightPayable = $request->freight_payable ?? '';

    //     $phpWord = new PhpWord();

    //     $section = $phpWord->addSection([
    //         'marginTop' => 300,
    //         'marginBottom' => 300,
    //         'marginLeft' => 300,
    //         'marginRight' => 300,
    //         'pageSizeW' => 11906,
    //         'pageSizeH' => 16838,
    //     ]);

    //     $phpWord->addTableStyle('mainTable', [
    //         'borderSize' => 6,
    //         'borderColor' => '000000',
    //         'cellMargin' => 50,
    //         'alignment' => Jc::CENTER,
    //     ]);

    //     $table = $section->addTable('mainTable');

    //     // HEADER
    //     $table->addRow();

    //     $table->addCell(9000)->addText(
    //         'MULTIMODAL TRANSPORT DOCUMENT',
    //         ['bold' => true, 'size' => 14],
    //         ['align' => 'center']
    //     );

    //     $table->addCell(2500)->addText(
    //         $blType,
    //         ['bold' => true, 'size' => 10],
    //         ['align' => 'center']
    //     );

    //     // SHIPPER
    //     $table->addRow(1200);

    //     $shipperText =
    //         optional($seaExportDraftData->shipperName)->party_name . "\n" .
    //         optional($seaExportDraftData->shipperName)->address_line1 . "\n" .
    //         optional($seaExportDraftData->shipperName)->city;

    //     $table->addCell(5000)->addText($shipperText);

    //     $blNo =
    //         $seaExportDraftData->mbl_no ??
    //         $seaExportDraftData->hbl_no ??
    //         'N/A';

    //     $table->addCell(6500)->addText(
    //         "BL NO : " . $blNo,
    //         ['bold' => true]
    //     );

    //     // CONSIGNEE
    //     $table->addRow(1200);

    //     $consigneeText =
    //         optional($seaExportDraftData->ConsigneeName)->party_name . "\n" .
    //         optional($seaExportDraftData->ConsigneeName)->address_line1 . "\n" .
    //         optional($seaExportDraftData->ConsigneeName)->city;

    //     $table->addCell(5000)->addText($consigneeText);

    //     $table->addCell(6500)->addText(
    //         $company->company_name . "\n" .
    //         $company->address
    //     );

    //     // GOODS TABLE
    //     $table->addRow();

    //     $table->addCell(3000)->addText(
    //         'Container Details',
    //         ['bold' => true]
    //     );

    //     $table->addCell(5000)->addText(
    //         'Goods Description',
    //         ['bold' => true]
    //     );

    //     $table->addCell(2000)->addText(
    //         'Weight',
    //         ['bold' => true]
    //     );

    //     $table->addCell(1500)->addText(
    //         'CBM',
    //         ['bold' => true]
    //     );

    //     foreach ($seaExportDraftData->container as $container) {

    //         $table->addRow(2500);

    //         $table->addCell(3000)->addText(
    //             $container->container_no . '/' . $container->size
    //         );

    //         $table->addCell(5000)->addText(
    //             $container->goods_description
    //         );

    //         $table->addCell(2000)->addText(
    //             $container->gross_weight . ' KGS'
    //         );

    //         $table->addCell(1500)->addText(
    //             $container->cbm . ' CBM'
    //         );
    //     }

    //     // FOOTER
    //     $section->addTextBreak(2);

    //     $section->addText(
    //         'FOR ' . $company->company_name,
    //         ['bold' => true],
    //         ['align' => 'right']
    //     );

    //     $section->addTextBreak(3);

    //     $section->addText(
    //         'Authorised Signatory',
    //         [],
    //         ['align' => 'right']
    //     );

    //     $fileName = 'SeaWayBill_' . time() . '.docx';

    //     $tempFile = storage_path($fileName);

    //     $objWriter = IOFactory::createWriter($phpWord, 'Word2007');

    //     $objWriter->save($tempFile);

    //     return response()->download($tempFile)->deleteFileAfterSend(true);
    // }

    //mourya 11 oct
    // public function generateDraft(Request $request, $id)
    // {
    //     $seaExportDraftData = OperationSeaExport::with(['ConsigneeName', 'blType', 'shipperName', 'deliveryPortName', 'loadingPortName', 'dischargePortName', 'receiptPortName',  'container', 'agentName'])->find($id);
    //     $company = Company::with(['companySetting', 'companyBranch'])
    //         ->where('id', $this->company_id)
    //         ->first();

    //     $logoUrl = $company->logo
    //         ? asset('public/uploads/company_logo/' . $company->logo)
    //         : asset('images/default-logo.png');
    //     $draftHtml = '';

    //     if($request->hbl_type == 'DRAFT'){
    //         if ($seaExportDraftData) {
    //             $containerCount = count($seaExportDraftData->container);
    //             $draftHtml = '
    //             <style>
    //                 @media print {
    //                     .page-break {
    //                         page-break-before: always;
    //                         clear: both;
    //                     }
    //                     .draft-page {
    //                         width: 210mm;
    //                         min-height: 297mm;
    //                         padding: 5mm;
    //                         margin: 0 auto;
    //                         box-sizing: border-box;
    //                     }
    //                     body {
    //                         margin: 0;
    //                         padding: 0;
    //                     }
    //                     table {
    //                         page-break-inside: avoid;
    //                     }
    //                 }

    //                 .draft-container {
    //                     width: 210mm;
    //                     min-height: 297mm;
    //                     padding: 5mm;
    //                     margin: 0 auto;
    //                     font-family: Arial, sans-serif;
    //                     font-size: 11px;
    //                     color: #000000;
    //                     background: #fff;
    //                     box-sizing: border-box;
    //                     position: relative;
    //                     border: 1px dashed #ccc;
    //                 }

    //                 .back-page {
    //                     margin-top: 10px;
    //                     border: 1px dashed #999;
    //                 }

    //                 .watermark {
    //                     position: absolute;
    //                     top: 40%;
    //                     left: 25%;
    //                     font-size: 60px;
    //                     color: rgba(0,0,0,0.1);
    //                     transform: rotate(-45deg);
    //                     z-index: 0;
    //                 }
    //             </style>';

    //             $containerIndex = 0;

    //             foreach($seaExportDraftData->container as $container) {


    //                 $shipper   = $seaExportDraftData->shipperName;
    //                 $consignee = $seaExportDraftData->ConsigneeName;
    //                 $notify    = $seaExportDraftData->notifyName;
    //                 $deliveryAgent    = $seaExportDraftData->deliveryAgentName;
    //                 $shippingLine    = $seaExportDraftData->shippingLine;

    //                 $containerIndex++;

    //                 // FIRST CONTAINER - FRONT PAGE
    //                 if($containerIndex == 1) {
    //                 $draftHtml .= '
    //                     <div class="draft-container">
    //                         <div class="watermark">DRAFT</div>
    //                         <table style="width:100%; border-collapse:collapse;">
    //                             <tr>
    //                                 <!-- LEFT SIDE: Shipper, Consignee, Notify -->
    //                                 <td style="width:50%; vertical-align:top;">
    //                                     <table style="width:100%; min-height:140px; border:1px solid #000; border-right: none; border-collapse:collapse;">
    //                                         <tr><td style="padding:1px 1px; font-size:10px;"><b>Consignor / Shipper</b></td></tr>
    //                                         <tr>
    //                                             <td style="padding:0 3px; font-size:9px;">
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


    //                                             </td>
    //                                         </tr>
    //                                     </table>

    //                                     <table style="width:100%; min-height:140px; border:1px solid #000; border-top:none; border-right: none; border-collapse:collapse; vertical-align:top;">
    //                                         <tr><td style="padding:1px 3px; font-size:10px;"><b>Consignee (or order)</b></td></tr>
    //                                         <tr>
    //                                             <td style="padding:0 3px; font-size:9px;">
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
    //                                             </td>
    //                                         </tr>
    //                                     </table>

    //                                     <table style="width:100%; min-height:130px; border:1px solid #000; border-top:none; border-right: none; border-collapse:collapse; vertical-align:top;">
    //                                         <tr><td style="padding:1px 3px; font-size:10px;"><b>Notify Party</b></td></tr>
    //                                         <tr>
    //                                             <td style="padding:0 3px; font-size:9px;">
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


    //                                             </td>
    //                                         </tr>
    //                                     </table>
    //                                 </td>

    //                                 <!-- RIGHT SIDE: BL Info -->
    //                                 <td style="width:50%; vertical-align:top;">
    //                                     <table style="width:100%; min-height:190px; border:1px solid #000; border-collapse:collapse; padding:10px 0px;">
    //                                         <tr><td style="text-align:center; padding:10px; font-size:10px;">
    //                                             <b>Booking No:</b> '.($seaExportDraftData->booking_no ?? '').'<br><br>
    //                                             '.($seaExportDraftData->mbl_no ? "<b>MBL No:</b>". $seaExportDraftData->mbl_no  : '').'<br>
    //                                             '.($seaExportDraftData->hbl_no ? "<b>HBL No:</b>". $seaExportDraftData->hbl_no  : '').'<br><br>
    //                                             <b style="color:red; font-size:12px;">BL DRAFT</b><br><br>
    //                                             <b style="font-size:12px;">BILL OF LADING</b><br><br>
    //                                             <b>'.($company->company_name).'</b>
    //                                         </td></tr>
    //                                     </table>

    //                                     <table style="width:100%; min-height:190px; border:1px solid #000; border-top: none; border-collapse:collapse; padding:10px 0px; text-align:start;">
    //                                         <tr>
    //                                             <td style="padding:3px; vertical-align:top; font-size:9px;">
    //                                                 <b>Delivery Agent:</b><br>
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
    //                                             </td>
    //                                         </tr>
    //                                         <tr style="width:100%; border:1px solid #000; vertical-align:top;">
    //                                             <td style="padding:5px; font-size:9px;">
    //                                                 <b>SHIPPING LINE:</b><br>
    //                                                 '.(optional($shippingLine)->shipping_line_name ?? ''). '<br>
    //                                                 ' .(optional($shippingLine)->address_line_1 ?? ''). '
    //                                                 ' .(optional($shippingLine)->address_line_2 ?? ''). '<br>
    //                                                 ' .(optional($shippingLine)->agent_code ?? ''). '<br>
    //                                               ' .(
    //                                                     optional($shippingLine)->shipping_line_type == 1
    //                                                         ? 'Indian'
    //                                                         : (optional($shippingLine)->shipping_line_type == 2
    //                                                             ? 'Overseas'
    //                                                             : '')
    //                                                 ). '
    //                                             </td>
    //                                         </tr>
    //                                     </table>

    //                                     <table style="width:100%; min-height:30px; border:1px solid #000; border-top:none; border-collapse:collapse; font-size:9px;">
    //                                         <tr>
    //                                             <td style="padding:3px;">
    //                                                 <b>Number of Original MTD:</b> '.($seaExportDraftData->mbl_no ?? '').'
    //                                             </td>
    //                                             <td style="padding:3px; border-left:1px solid #000;">
    //                                                 <b>Place of Delivery:</b> '.($seaExportDraftData->deliveryPortName->port_name ?? 'N/A').'
    //                                             </td>
    //                                         </tr>
    //                                     </table>
    //                                 </td>
    //                             </tr>
    //                         </table>

    //                         <!-- PORT INFO SECTION -->
    //                         <table style="width:100%; border-collapse:collapse; margin-top:5px;">
    //                             <tr>
    //                                 <td style="width:50%; vertical-align:top;">
    //                                     <table style="width:100%; min-height:30px; border:1px solid #000; border-right:none; border-collapse:collapse; font-size:9px;">
    //                                         <tr>
    //                                             <td style="padding:3px;">
    //                                                 <b>Ocean Vessel:</b> '.($seaExportDraftData->vessel_name ?? 'N/A').'
    //                                             </td>
    //                                             <td style="padding:3px; border-left:1px solid #000;">
    //                                                 <b>Voyage No:</b> '.($seaExportDraftData->voyage_no ?? 'N/A').'
    //                                             </td>
    //                                         </tr>
    //                                     </table>
    //                                 </td>

    //                                 <td style="width:50%; vertical-align:top;">
    //                                     <table style="width:100%; min-height:30px; border:1px solid #000; border-collapse:collapse; font-size:9px;">
    //                                         <tr>
    //                                             <td style="padding:3px;">
    //                                                 <!-- Empty for alignment -->
    //                                             </td>
    //                                             <td style="padding:3px; border-left:1px solid #000;">
    //                                                 <!-- Empty for alignment -->
    //                                             </td>
    //                                         </tr>
    //                                     </table>
    //                                 </td>
    //                             </tr>
    //                         </table>

    //                         <!-- PORT LOCATIONS -->
    //                         <div style="display:flex; width:100%; font-size:9px;">
    //                             <div style="border:1px solid #000; border-top:none; padding:5px; flex:1; ">
    //                                 <b>Port of Loading:</b><br>'.($seaExportDraftData->loadingPortName->port_name ?? 'N/A').'
    //                             </div>
    //                             <div style="border-bottom:1px solid #000;  padding:5px; flex:1;">
    //                                 <b>Port of Discharge:</b><br>'.($seaExportDraftData->dischargePortName->port_name ?? 'N/A').'
    //                             </div>
    //                             <div style="border:1px solid #000; border-top:none; padding:5px; flex:1;">
    //                                 <b>Place of Receipt:</b><br>'.($seaExportDraftData->receiptPortName->port_name ?? 'N/A').'
    //                             </div>
    //                             <div style="border:1px solid #000; border-top:none; border-left:none; padding:5px; flex:1;">
    //                                 <b>Place of Delivery:</b><br>'.($seaExportDraftData->deliveryPortName->port_name ?? 'N/A').'
    //                             </div>
    //                         </div>

    //                         <!-- CARGO DETAILS FOR FIRST CONTAINER -->
    //                         <table style="width:100%; border-collapse:collapse; margin-top:1px;">
    //                             <tr>
    //                                 <th style="border:1px solid #000; padding:4px; width:20%; font-size:10px; background:#f0f0f0;">Marks and Numbers</th>
    //                                 <th style="border:1px solid #000; padding:4px; width:60%; font-size:10px; background:#f0f0f0;">No. of Packages / Description of Goods</th>
    //                                 <th style="border:1px solid #000; padding:4px; width:7%; font-size:10px; background:#f0f0f0;">Gross Weight</th>
    //                                 <th style="border:1px solid #000; padding:4px; width:7%; font-size:10px; background:#f0f0f0;">Net Weight</th>
    //                                 <th style="border:1px solid #000; padding:4px; width:6%; font-size:10px; background:#f0f0f0;">Measurement</th>
    //                             </tr>
    //                             <tr style="min-height:400px; height:400px; vertical-align:top;">

    //                                 <td style="border:1px solid #000; border-right:none; padding:4px; position:relative;">
    //                                     '.($container->mark_number ?? '').'
    //                                     <div style="position:absolute; bottom:0; font-size:8px;">
    //                                         <small><b>Container No:</b> '.($container->container_no ?? '').'</small><br>
    //                                         <small><b>A/Seal No:</b> '.($container->agent_seal_no ?? '').'</small><br>
    //                                         <small><b>Cus Seal No:</b> '.($container->cust_seal_no ?? '').'</small>
    //                                     </div>
    //                                 </td>

    //                                 <td style="border:1px solid #000; border-right:none; padding:4px; position:relative;">
    //                                     '.(!empty($container->total_package) ? "Total {$container->total_package} <br>" : '').'
    //                                     '.($container->goods_description ?? '').'<br>
    //                                     '.(!empty($container->sbill_no) ? "SB NO. : {$container->package_code}<br>" : '').'
    //                                     '.(!empty($container->customer_inv_no) ? "Cus Inv. No: {$container->customer_inv_no}<br>" : '').'
    //                                     '.(!empty($seaExportDraftData->freight) ? "FREIGHT : {$seaExportDraftData->freight}" : '').'

    //                                     <div style="position:absolute; bottom:0; font-size:8px;">
    //                                         <small><b>SOB Date:</b> '.($seaExportDraftData->sob_date ?? '').'</small>
    //                                     </div>
    //                                 </td>

    //                                 <td style="border:1px solid #000; border-right:none; padding:4px; position:relative;">
    //                                     '.($container->gross_weight ?? '0').' KGS
    //                                     <div style="position:absolute; bottom:0; font-size:8px;">
    //                                         <small><b>Size:</b> '.($container->size ?? '').'</small>
    //                                     </div>
    //                                 </td>

    //                                 <td style="border:1px solid #000; border-right:none; padding:4px;">
    //                                     '.($container->net_weight ?? '0').' KGS
    //                                 </td>

    //                                 <td style="border:1px solid #000; padding:4px; position:relative;">
    //                                     '.($container->cbm ?? '0').' CBM
    //                                     <div style="position:absolute; bottom:0; font-size:8px;">
    //                                         <small><b>Type:</b> '.($container->fcl_lcl ?? '').'</small>
    //                                     </div>
    //                                 </td>

    //                             </tr>

    //                         </table>

    //                         <table style="width:100%; border:1px solid #000; border-top:none; border-collapse:collapse; margin-top:5px; font-size:9px;">
    //                             <tr>
    //                                 <td style="padding:4px;">
    //                                     <b>Movement:</b> '.($seaExportDraftData->movement ?? '').'
    //                                 </td>
    //                             </tr>
    //                         </table>

    //                         <!-- FOOTER -->
    //                         <table style="width:100%; border-collapse:collapse; margin-top:10px; font-size:9px;">
    //                             <tr>
    //                                 <td style="width:33%; text-align:start;">
    //                                     <b>Issue Date:</b><br>'.($request->issue_date ?? '00/00/0000').'
    //                                 </td>
    //                                 <td style="width:33%; text-align:center;">
    //                                     <b>Freight:</b><br>'.($seaExportDraftData->freight ?? '').'
    //                                 </td>
    //                                 <td style="width:33%; text-align:end;">
    //                                     <b>Signature:</b><br>&nbsp;
    //                                 </td>
    //                             </tr>
    //                         </table>

    //                         <!-- PAGE INFO -->
    //                         <div style="text-align:center; margin-top:10px; font-size:8px; color:#666;">
    //                             Page 1 of '.($containerCount > 1 ? 2 : 1).' - Container '.$containerIndex.' of '.$containerCount.'
    //                         </div>
    //                     </div>';

    //                     // If there are more containers, add page break
    //                     if($containerCount > 1) {
    //                         $draftHtml .= '<div class="page-break"></div>';
    //                     }
    //                 }

    //                 // ADDITIONAL CONTAINERS - BACK PAGE
    //                 if($containerIndex > 1) {
    //                     // Start back page for second container
    //                     if($containerIndex == 2) {
    //                         $draftHtml .= '
    //                         <div class="draft-container back-page">
    //                             <div class="watermark">DRAFT</div>
    //                             <div style="text-align:center; margin-bottom:15px;">
    //                                 <h3 style="font-size:14px; color:red;">ADDITIONAL CONTAINER DETAILS</h3>
    //                                 <div style="font-size:10px; color:#666;">(Back Side - Draft Bill of Lading)</div>
    //                                 <div style="font-size:9px; margin-top:5px;">
    //                                     Booking No: '.($seaExportDraftData->booking_no ?? '').' |
    //                                     MBL No: '.($seaExportDraftData->mbl_no ?? '').' |
    //                                     Total Containers: '.$containerCount.'
    //                                 </div>
    //                             </div>';
    //                     }

    //                     // Each additional container
    //                     $draftHtml .= '
    //                     <div style="margin-bottom:20px; border:1px solid #000; padding:10px;">
    //                         <h4 style="font-size:12px; margin-bottom:5px; background:#f0f0f0; padding:5px;">
    //                             Container '.$containerIndex.' of '.$containerCount.' - '.($container->container_no ?? 'N/A').'
    //                         </h4>
    //                         <table style="width:100%; border-collapse:collapse; font-size:9px;">
    //                             <tr>
    //                                 <td style="border:1px solid #000; padding:4px; width:30%;">
    //                                     <b>Marks & Numbers:</b><br>
    //                                     '.($container->mark_number ?? '').'
    //                                 </td>
    //                                 <td style="border:1px solid #000; padding:4px; width:40%;">
    //                                     <b>Description of Goods:</b><br>
    //                                     Total : '.($container->total_package ?? '').' Packages<br>
    //                                     '.($container->goods_description ?? '').'
    //                                 </td>
    //                                 <td style="border:1px solid #000; padding:4px; width:30%;">
    //                                     <b>Container Details:</b><br>
    //                                     Package Type: '.($seaExportDraftData->packageName->package_code ?? '').'<br>
    //                                     Cus Inv. No: '.($container->customer_inv_no ?? '').'<br>
    //                                     FREIGHT : '.($seaExportDraftData->freight ?? '').'
    //                                 </td>
    //                             </tr>
    //                             <tr>
    //                                 <td style="border:1px solid #000; padding:4px;">
    //                                     <b>Gross Weight:</b><br>
    //                                     '.($container->gross_weight ?? '0').' KGS<br>
    //                                     <small>Size: '.($container->size ?? '').'</small>
    //                                 </td>
    //                                 <td style="border:1px solid #000; padding:4px;">
    //                                     <b>Net Weight:</b><br>
    //                                     '.($container->net_weight ?? '0').' KGS
    //                                 </td>
    //                                 <td style="border:1px solid #000; padding:4px;">
    //                                     <b>Measurement:</b><br>
    //                                     '.($container->cbm ?? '0').' CBM<br>
    //                                     <small>Type: '.($container->fcl_lcl ?? '').'</small>
    //                                 </td>
    //                             </tr>
    //                             <tr>
    //                                 <td colspan="3" style="border:1px solid #000; padding:4px; font-size:8px;">
    //                                     <b>Seal Numbers:</b>
    //                                     A/Seal: '.($container->agent_seal_no ?? '').' |
    //                                     Cus Seal: '.($container->cust_seal_no ?? '').'<br>
    //                                     <b>SOB Date:</b> '.($seaExportDraftData->sob_date ?? '').'
    //                                 </td>
    //                             </tr>
    //                         </table>
    //                     </div>';

    //                     // Close back page after last container
    //                     if($containerIndex == $containerCount) {
    //                         $draftHtml .= '
    //                             <!-- BACK PAGE FOOTER -->
    //                             <div style="margin-top:20px; border-top:1px dashed #999; padding-top:10px; font-size:9px;">
    //                                 <table style="width:100%;">
    //                                     <tr>
    //                                         <td style="text-align:left;">
    //                                             <b>Shipping Line:</b><br>
    //                                             '.(optional($shippingLine)->shipping_line_name ?? '').'
    //                                         </td>
    //                                         <td style="text-align:center;">
    //                                             <b>Movement:</b><br>
    //                                             '.($seaExportDraftData->movement ?? '').'
    //                                         </td>
    //                                         <td style="text-align:right;">
    //                                             <b>Vessel/Voyage:</b><br>
    //                                             '.($seaExportDraftData->vessel_name ?? '').' / '.($seaExportDraftData->voyage_no ?? 'N/A').'
    //                                         </td>
    //                                     </tr>
    //                                 </table>
    //                                 <div style="text-align:center; margin-top:10px; font-size:8px; color:#666;">
    //                                     Page 2 of 2 - Additional Container Details
    //                                 </div>
    //                             </div>
    //                         </div>'; // Close back-page div
    //                     }
    //                 }
    //             }

    //             // If only one container, ensure proper closing
    //             if($containerCount == 1) {
    //                 $draftHtml .= '</div>';
    //             }

    //             return response()->json(['html' => $draftHtml]);
    //         }
    //     }
    //     elseif($request->hbl_type == 'ORIGINAL' || $request->hbl_type == '1st ORIGINAL' || $request->hbl_type == '2nd ORIGINAL' || $request->hbl_type == '3rd ORIGINAL' || $request->hbl_type == 'NON-NEGOTIABLE' || $request->hbl_type == 'SEA WAY B/L')
    //     {
    //         if ($seaExportDraftData) {

    //             $termsAndConditions = view('admin-main.admin.seaExport.term-condition')->render();

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

    //             $containerCount = count($seaExportDraftData->container);
    //             $containerIndex = 0;

    //             foreach($seaExportDraftData->container as $container) {
    //                 $containerIndex++;

    //                 $shipper   = $seaExportDraftData->shipperName;
    //                 $consignee = $seaExportDraftData->ConsigneeName;
    //                 $notify    = $seaExportDraftData->notifyName;
    //                 $deliveryAgent    = $seaExportDraftData->deliveryAgentName;
    //                 $shippingLine    = $seaExportDraftData->shippingLine;

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
    //                                             <div style="font-weight:bold; color:#000000; font-size:10px;">Consignor / Shipper</div>
    //                                             <div style="font-size:12px; color:#000000;">
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
    //                                             <div style="font-weight:bold; color:#000000; font-size:10px;">Consignee (or order)</div>
    //                                             <div style="font-size:12px; color:#000000;">
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
    //                                             <div style="font-weight:bold; color:#000000; font-size:10px;">Notify Party</div>
    //                                             <div style="font-size:12px; color:#000000;">
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
    //                                                     <div style="font-size:9px;">'.($seaExportDraftData->place_of_acceptance ?? '').'</div>
    //                                                 </td>
    //                                             </tr>
    //                                             <tr>
    //                                                 <td style=" padding:3px;  vertical-align:top; min-height:20px;">
    //                                                     <b style="font-size:9px;">Vessel / Voyage no:</b><br>
    //                                                     <div style="font-size:9px;">'.($seaExportDraftData->vessel_name ?? '').' / '.($seaExportDraftData->voyage_no ?? 'N/A').'</div>
    //                                                 </td>
    //                                             </tr>
    //                                         </table>
    //                                     </td>

    //                                     <!-- RIGHT SIDE: BL Info -->
    //                                     <td style="width:50%; vertical-align:top;">
    //                                         <!-- BL Header -->
    //                                         <div style="border-bottom:1px solid #000; padding:3px 10px;">
    //                                             <table style="width:100%;">
    //                                                 <tr>
    //                                                     <td style="text-align:left; font-size:12px;">
    //                                                         <b>Booking No:</b> '.($seaExportDraftData->booking_no ?? '').'
    //                                                     </td>
    //                                                     <td style="text-align:right; font-size:12px;">
    //                                                         '.($seaExportDraftData->mbl_no ? "<b>MBL No:</b> ". $seaExportDraftData->mbl_no :  '').'
    //                                                         '.($seaExportDraftData->hbl_no ? "<b>MBL No:</b> ". $seaExportDraftData->hbl_no :  '').'
    //                                                     </td>
    //                                                 </tr>
    //                                                 <tr>
    //                                                     <td style="text-align:left; font-size:12px;">
    //                                                         <b>Reg No</b>
    //                                                     </td>
    //                                                     <td style="text-align:left; font-size:12px;">
    //                                                         <b>BL Type</b> '.($seaExportDraftData->blType->bl_description ?? '').'
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
    //                                             <div style="font-size:9px;">
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
    //                                         <div style="min-height:20px; font-size:9px;">'.($seaExportDraftData->receiptPortName->port_name ?? 'N/A').'</div>
    //                                     </td>
    //                                     <td style="width:25%; padding:4px; border-right:1px solid #000;">
    //                                         <b style="font-size:9px;">Port of Loading:</b><br>
    //                                         <div style="min-height:20px; font-size:9px;">'.($seaExportDraftData->loadingPortName->port_name ?? 'N/A').'</div>
    //                                     </td>
    //                                     <td style="width:25%; padding:4px; border-right:1px solid #000;">
    //                                         <b style="font-size:9px;">Port of Discharge:</b><br>
    //                                         <div style="min-height:20px; font-size:9px;">'.($seaExportDraftData->dischargePortName->port_name ?? 'N/A').'</div>
    //                                     </td>
    //                                     <td style="width:25%; padding:4px;">
    //                                         <b style="font-size:9px;">Final Place of Delivery:</b><br>
    //                                         <div style="min-height:20px; font-size:9px;">'.($seaExportDraftData->deliveryPortName->port_name ?? 'N/A').'</div>
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
    //                                         Package Type : '.($seaExportDraftData->packageName->package_code ?? '').'<br>
    //                                         Cus Inv. No: '.($container->customer_inv_no ?? '').'<br>
    //                                         FREIGHT : '.($seaExportDraftData->freight ?? '').'<br>

    //                                         <div style="position:absolute; bottom:0px; width:95%; font-size:9px;">
    //                                             <small><b>SOB Date:</b> '.($seaExportDraftData->sob_date ?? '').'</small><br>
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
    //                                         <b>Movement:</b> '.($seaExportDraftData->movement ?? '').'
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
    //                                         <div style="min-height:20px;">'.($seaExportDraftData->freight ?? '').'</div>
    //                                     </td>
    //                                     <td style="width:40%; padding:4px; vertical-align:top; border-left:1px solid #000; text-align:right; font-size:9px;">
    //                                         <b>For '.($company->company_name).'</b><br><br>
    //                                         ___________________________<br>
    //                                         Authorized Signature
    //                                     </td>
    //                                 </tr>
    //                             </table>
    //                         </div>';


    //                         // if($containerCount > 1) {
    //                         //     $draftHtml .= '
    //                         //     <div class="page-break"></div>
    //                         //     <div class="bill-of-lading container-page back-side">
    //                         //         <div style="text-align:center; margin-bottom:20px;">
    //                         //             <h3 style="font-size:14px;">ADDITIONAL CONTAINER DETAILS</h3>
    //                         //             <div style="font-size:10px;">(Back Side of Bill of Lading)</div>
    //                         //         </div>';
    //                         // }


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
    //                                             Package Type : '.($seaExportDraftData->packageName->package_code ?? '').'<br>
    //                                             Cus Inv. No: '.($container->customer_inv_no ?? '').'
    //                                             <div style="position:absolute; bottom:0px; width:95%; font-size:8px;">
    //                                                 <small><b>SOB Date:</b> '.($seaExportDraftData->sob_date ?? '').'</small>
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


    public function loadingConfirmation($id)
    {
        $page_title = 'Sea Export Loading Confirmation';
        $seaExport = OperationSeaExport::with([
            'shipperName', 'jobMaster', 'container', 'packageName',
            'ConsigneeName', 'deliveryPortName', 'dischargePortName', 'loadingPortName', 'branch'
        ])
            ->where('company_id', $this->company_id)
            ->where('id', $id)
            ->first();

        $company = Company::with(['companySetting', 'companyBranch'])
        ->where('id', $this->company_id)
        ->first();

        $logoUrl = $company->logo
            ? asset('public/uploads/company_logo/' . $company->logo)
            : asset('images/default-logo.png');

        return view('admin-main/admin/seaExport/loading-confirmation', [
                'seaExport' => $seaExport,
                'company' => $company,
                'logoUrl' => $logoUrl,
                'page_title'=>$page_title
            ]);
    }

    // mourya
    public function exportLoadingConfirmation($id)
    {
        $seaExport = OperationSeaExport::with([
            'shipperName', 'jobMaster', 'container', 'packageName',
            'ConsigneeName', 'deliveryPortName', 'dischargePortName', 'loadingPortName', 'branch'
        ])
        ->where('company_id', $this->company_id)
        ->where('id', $id)
        ->firstOrFail();

        $company = Company::with(['companySetting', 'companyBranch'])
            ->where('id', $this->company_id)
            ->first();

        $logoPath = $company->logo
            ? public_path('uploads/company_logo/' . $company->logo)
            : public_path('images/default-logo.png');


        $format = request('format', 'pdf');

        if ($format === 'pdf') {
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView(
                'admin-main.admin.seaExport.loading-confirmation-pdf',
                compact('seaExport', 'logoPath', 'company')
            )->setPaper('A4', 'portrait');

            return $pdf->download("Loading-Confirmation-{$seaExport->id}.pdf");
        }

        // ------------------- Excel Export -------------------
        if ($format === 'excel') {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $row = 1;
            $cols = ['A','B','C','D','E','F'];

            // ------------------- Company Header -------------------
            $sheet->mergeCells("A{$row}:F{$row}");
            $sheet->setCellValue("A{$row}", $company->company_name);
            $sheet->getStyle("A{$row}")->getFont()->setBold(true)->setSize(16);
            $sheet->getStyle("A{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

            $row++;
            $sheet->mergeCells("A{$row}:F{$row}");
            $sheet->setCellValue("A{$row}", $seaExport->branch->address ?? $company->address);
            $sheet->getStyle("A{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

            $row++;
            $sheet->mergeCells("A{$row}:F{$row}");
            $sheet->setCellValue("A{$row}",
                "PAN: {$seaExport->branch->pan_no}   GSTIN: {$seaExport->branch->gstin_no}   CIN: {$seaExport->branch->cin_no}"
            );

            $sheet->getStyle("A{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

            $row += 2;

            // ------------------- Report Title -------------------
            $sheet->mergeCells("A{$row}:F{$row}");
            $sheet->setCellValue("A{$row}", "LOADING CONFIRMATION REPORT");
            $sheet->getStyle("A{$row}")->getFont()->setBold(true)->setSize(14);
            $sheet->getStyle("A{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

            $row += 2;

            // ------------------- Loading Confirmation Details -------------------
            $details = [
                'Job No.' => $seaExport->jobMaster->job_no ?? '',
                'HBL No.' => $seaExport->hbl_no ?? '',
                'MBL No.' => $seaExport->mbl_no ?? '',
                'Shipper' => $seaExport->shipperName->party_name ?? '',
                'Consignee / Notify' => $seaExport->ConsigneeName->party_name ?? '',
                'Customer Invoice No.' => optional($seaExport->container->first())->customer_inv_no ?? '',
                'S/Bill No. / Date' => optional($seaExport->container->first())->sbill_no ?? '',
                'CBM' => $seaExport->cbm ?? '',
                'NT / GR WT' => ($seaExport->net_weight ?? '') . ' / ' . ($seaExport->gross_weight ?? ''),
                'PORT OF DISCHARGE / FPOD' => ($seaExport->dischargePortName->port_name ?? '') . ' / ' . ($seaExport->deliveryPortName->port_name ?? ''),
                'VSL / VOY' => ($seaExport->vessel_name ?? '') . ' / ' . ($seaExport->voyage_no ?? ''),
                'Load Port' => $seaExport->loadingPortName->port_name ?? '',
                'ETD / SAIL ON Date' => $seaExport->etd_date ? Carbon::parse($seaExport->etd_date)->format('d/m/Y') : ''
            ];

            foreach ($details as $key => $value) {
                $sheet->setCellValue("A{$row}", $key);
                $sheet->setCellValue("B{$row}", $value);

                $sheet->getStyle("A{$row}:B{$row}")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
                $sheet->getStyle("A{$row}")->getFont()->setBold(true);
                $sheet->getStyle("B{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
                $row++;
            }

            $row += 1; // space before container tables

            // ------------------- Container Tables -------------------
            if($seaExport->container && $seaExport->container->count()) {

                // Table 1: POL/ETD, POD/ETA, Vessel, Voyage, Stuffing Date
                $sheet->mergeCells("A{$row}:F{$row}");
                $sheet->setCellValue("A{$row}", "Container POL / POD / Vessel Info");
                $sheet->getStyle("A{$row}")->getFont()->setBold(true);
                $row++;

                $headers1 = ['POL // ETD','POD // ETA','VESSEL NAME','VOYAGE NO.','STUFFING DATE'];
                foreach($headers1 as $i => $h){
                    $sheet->setCellValue("{$cols[$i]}{$row}", $h);
                    $sheet->getStyle("{$cols[$i]}{$row}")->getFont()->setBold(true);
                    $sheet->getStyle("{$cols[$i]}{$row}")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
                }
                $row++;

                foreach($seaExport->container as $container){
                    $sheet->setCellValue("A{$row}", ($seaExport->loadingPortName->port_name ?? '') . ' // ' . ($seaExport->etd_date ?? ''));
                    $sheet->setCellValue("B{$row}", ($seaExport->dischargePortName->port_name ?? '') . ' // ' . ($seaExport->eta_date ?? ''));
                    $sheet->setCellValue("C{$row}", $seaExport->vessel_name ?? '');
                    $sheet->setCellValue("D{$row}", $seaExport->voyage_no ?? '');
                    $sheet->setCellValue("E{$row}", $seaExport->stuffing_point.'/'.$seaExport->stuffingDate ? Carbon::parse($seaExport->stuffingDate)->format('d/m/Y') : '');
                    $sheet->getStyle("A{$row}:E{$row}")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
                    $row++;
                }

                $row += 1;

                // Table 2: Gross WT, Volume, Package Count, Package Type, Shipping Bill
                $sheet->mergeCells("A{$row}:F{$row}");
                $sheet->setCellValue("A{$row}", "Package Details");
                $sheet->getStyle("A{$row}")->getFont()->setBold(true);
                $row++;

                $headers2 = ['GROSS WT.(IN KGS)','VOLUME','PACKAGE COUNT','PACKAGE TYPE','S/BILL NO // DATE','STUFFING POINT/DATE'];
                foreach($headers2 as $i => $h){
                    $sheet->setCellValue("{$cols[$i]}{$row}", $h);
                    $sheet->getStyle("{$cols[$i]}{$row}")->getFont()->setBold(true);
                    $sheet->getStyle("{$cols[$i]}{$row}")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
                }
                $row++;

                foreach($seaExport->container as $container){
                    $sheet->setCellValue("A{$row}", $container->gross_weight ?? '');
                    $sheet->setCellValue("B{$row}", $seaExport->volume_unit ?? '');
                    $sheet->setCellValue("C{$row}", $container->total_package ?? '');
                    $sheet->setCellValue("D{$row}", $seaExport->packageName->package_code ?? '');
                    $sheet->setCellValue("E{$row}", $container->sbill_no ?? '');
                    $sheet->setCellValue("F{$row}", $seaExport->stuffing_point.'/'.$seaExport->stuffingDate ?? '');
                    $sheet->getStyle("A{$row}:F{$row}")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
                    $row++;
                }

                $row += 1;

                // Table 3: Container No, Custom Seal, Agent Seal, Size, Container Type
                $sheet->mergeCells("A{$row}:F{$row}");
                $sheet->setCellValue("A{$row}", "Container Details");
                $sheet->getStyle("A{$row}")->getFont()->setBold(true);
                $row++;

                $headers3 = ['Container No','Custom Seal No','Agent Seal No','Size','Container Type'];
                foreach($headers3 as $i => $h){
                    $sheet->setCellValue("{$cols[$i]}{$row}", $h);
                    $sheet->getStyle("{$cols[$i]}{$row}")->getFont()->setBold(true);
                    $sheet->getStyle("{$cols[$i]}{$row}")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
                }
                $row++;

                foreach($seaExport->container as $container){
                    $sheet->setCellValue("A{$row}", $container->container_no ?? '');
                    $sheet->setCellValue("B{$row}", $container->cust_seal_no ?? '');
                    $sheet->setCellValue("C{$row}", $container->agent_seal_no ?? '');
                    $sheet->setCellValue("D{$row}", $container->size ?? '');
                    $sheet->setCellValue("E{$row}", $container->fcl_lcl ?? '');
                    $sheet->getStyle("A{$row}:E{$row}")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
                    $row++;
                }
            } else {
                $sheet->mergeCells("A{$row}:F{$row}");
                $sheet->setCellValue("A{$row}", "No container data available");
                $sheet->getStyle("A{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            }

            // ------------------- Save & Download -------------------
            $file = "Loading-Confirmation-{$seaExport->id}.xlsx";
            $temp = tempnam(sys_get_temp_dir(), $file);
            (new Xlsx($spreadsheet))->save($temp);

            return response()->download($temp, $file)->deleteFileAfterSend(true);
        }


        // word
        if ($format === 'word') {
            $logoPath = $company->logo
                        ? public_path('uploads/company_logo/' . $company->logo)
                        : public_path('images/default-logo.png');
            $phpWord = new \PhpOffice\PhpWord\PhpWord();

            $section = $phpWord->addSection([
                'marginTop' => 200, 'marginBottom' => 200,
                'marginLeft' => 400, 'marginRight' => 400
            ]);

            $phpWord->setDefaultFontName('Arial');
            $phpWord->setDefaultFontSize(11);

            // ------------------- Company Header -------------------
            $headerTable = $section->addTable([
                'borderSize' => 0,        // No border
                'borderColor' => 'FFFFFF', // Make sure border color is white
                'cellMarginTop' => 0,
                'cellMarginBottom' => 0,
                'cellMarginLeft' => 0,
                'cellMarginRight' => 0
            ]);
            $headerTable->addRow();
            $headerTable->addCell(3000, ['borderSize' => 0, 'borderColor' => 'FFFFFF'])->addImage($logoPath, [
                'width' => 120,
                'height' => 60,
                'alignment' => 'left'
            ]);

            $cell = $headerTable->addCell(7000, ['borderSize' => 0, 'borderColor' => 'FFFFFF']);
            $cell->addText($company->company_name, ['bold' => true, 'size' => 16, 'color' => '004080'], ['alignment' => 'right']);
            $cell->addText($seaExport->branch->address ?? $company->address, [], ['alignment' => 'right']);
            $cell->addText(
                "PAN: {$company->companySetting->pan_no}   GSTIN: {$company->companySetting->gstin_no}",
                [],
                ['alignment' => 'right']
            );
            $cell->addText(
                "CIN: {$company->companySetting->cin_no}",
                [],
                ['alignment' => 'right']
            );



            $section->addTextBreak(1);

            // ------------------- Report Title -------------------
            $section->addText('LOADING CONFIRMATION REPORT', ['bold' => true, 'size' => 14], ['alignment' => 'center']);
            $section->addTextBreak(1);

            // ------------------- Loading Confirmation Details Table -------------------
            $t1 = $section->addTable(['borderSize' => 6, 'borderColor' => '000000', 'cellMargin' => 50]);
            $details = [
                'Job No.' => $seaExport->jobMaster->job_no ?? '',
                'HBL No.' => $seaExport->hbl_no ?? '',
                'MBL No.' => $seaExport->mbl_no ?? '',
                'Shipper' => $seaExport->shipperName->party_name ?? '',
                'Consignee / Notify' => $seaExport->ConsigneeName->party_name ?? '',
                'Customer Invoice No.' => optional($seaExport->container->first())->customer_inv_no ?? '',
                'S/Bill No. / Date' => optional($seaExport->container->first())->sbill_no ?? '',
                // 'No. of Packages' => $seaExport->container->total_package ?? '',
                'CBM' => $seaExport->cbm ?? '',
                'NT / GR WT' => ($seaExport->net_weight ?? '') . ' / ' . ($seaExport->gross_weight ?? ''),
                'POD / FPOD' => ($seaExport->dischargePortName->port_name ?? '') . ' / ' . ($seaExport->deliveryPortName->port_name ?? ''),
                'VSL / VOY' => ($seaExport->vessel_name ?? '') . ' / ' . ($seaExport->voyage_no ?? ''),
                'Load Port' => $seaExport->loadingPortName->port_name ?? '',
                'ETD / SAIL ON Date' => $seaExport->etd_date ? Carbon::parse($seaExport->etd_date)->format('d/m/Y') : '',
                // 'SOB' => $seaExport->sob_date ? Carbon::parse($seaExport->sob_date)->format('d/m/Y') : ''
            ];

            foreach ($details as $key => $value) {
                $t1->addRow();
                $t1->addCell(4000)->addText($key, ['bold' => true]);
                $t1->addCell(8000)->addText($value);
            }

            $section->addTextBreak(1);

            // ------------------- Container Details Tables -------------------
            // Table 1: POL // ETD, POD // ETA, Vessel Name, Voyage, Stuffing Date
            $tableStyle = [
                'borderSize' => 6,
                'borderColor' => '000000',
                'cellMarginTop' => 0,
                'cellMarginBottom' => 0,
                'cellMarginLeft' => 0,
                'cellMarginRight' => 0
            ];
            // Table 1
            $t2 = $section->addTable($tableStyle);
            $t2->addRow();
            $headers1 = ['POL // ETD', 'POD // ETA', 'VESSEL NAME', 'VOYAGE NO.'];
            foreach ($headers1 as $h) $t2->addCell()->addText($h, ['bold' => true]);

            $t2->addRow();
            if ($seaExport->container) {
                $t2->addCell()->addText(($seaExport->loadingPortName->port_name ?? '') . ' // ' . ($seaExport->etd_date ?? ''));
                $t2->addCell()->addText(($seaExport->dischargePortName->port_name ?? '') . ' // ' . ($seaExport->eta_date ?? ''));
                $t2->addCell()->addText($seaExport->vessel_name ?? '');
                $t2->addCell()->addText($seaExport->voyage_no ?? '');
                // $t2->addCell()->addText($seaExport->stuffingDate ? Carbon::parse($seaExport->stuffingDate)->format('d/m/Y') : '');
            } else {
                $t2->addRow();
                $t2->addCell(5)->addText('No container data available', ['italic' => true], ['alignment' => 'center']);
            }

            $section->addTextBreak(1);

            // Table 2
            // Table 2: Package Details per container
            $t3 = $section->addTable($tableStyle);
            $t3->addRow();
            $headers2 = ['GROSS WT.(IN KGS)', 'VOLUME', 'PACKAGE COUNT', 'PACKAGE TYPE', 'SHIPPING BILL NO // DATE','STUFFING POINT/ DATE'];
            foreach ($headers2 as $h) $t3->addCell()->addText($h, ['bold'=>true]);

            if($seaExport->container && $seaExport->container->count()){
                foreach($seaExport->container as $container){
                    $t3->addRow();
                    $t3->addCell()->addText($container->gross_weight ?? '');
                    $t3->addCell()->addText($seaExport->volume_unit ?? '');
                    $t3->addCell()->addText($container->total_package ?? '');
                    $t3->addCell()->addText($seaExport->packageName->package_code ?? '');
                    $t3->addCell()->addText($container->sbill_no ?? '');
                    $t3->addCell()->addText($seaExport->stuffing_point.'/'.$seaExport->stuffingDate ?? '');
                }
            }

            // Table 3: Container Details per container
            $t4 = $section->addTable($tableStyle);
            $t4->addRow();
            $headers3 = ['Container No','Custom Seal No','Agent Seal No','Size','Container Type'];
            foreach ($headers3 as $h) $t4->addCell()->addText($h, ['bold'=>true]);

            if($seaExport->container && $seaExport->container->count()){
                foreach($seaExport->container as $container){
                    $t4->addRow();
                    $t4->addCell()->addText($container->container_no ?? '');
                    $t4->addCell()->addText($container->cust_seal_no ?? '');
                    $t4->addCell()->addText($container->agent_seal_no ?? '');
                    $t4->addCell()->addText($container->size ?? '');
                    $t4->addCell()->addText($container->fcl_lcl ?? '');
                }
            }



            // ------------------- Save and Download -------------------
            $file = "Loading-Confirmation-{$seaExport->id}.docx";
            $filePath = storage_path("app/public/{$file}");
            \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007')->save($filePath);

            return response()->download($filePath)->deleteFileAfterSend(true);
        }


        abort(404);
    }

    public function grossWeightTotal(Request $request)
    {
        $totalGrossWeight = OperationSeaExport::whereBetween(
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

    public function getShipmentDetail($id)
    {
        $shipmentDetail = OperationSeaExportShipmentLine::find($id);

        if (!$shipmentDetail) {
            return response()->json(['error' => 'Shipment Details not found'], 404);
        }

        return response()->json($shipmentDetail);
    }

    public function addShipmentLine(Request $request)
    {
        if (!$request->filled('sea_export_id')) {
            return response()->json([
                'status'  => false,
                'message' => 'Please submit the general details form first. Otherwise, edit this form!'
            ], 200);
        }


        $validator = Validator::make($request->all(), [
            'sea_export_id' => 'required|integer',
            'sea_export_cont_id' => 'required|integer',
            'consignee_id' => 'nullable|integer',
            'invoice_no'        => 'nullable|string|max:100',
            'invoice_date'        => 'nullable|date',
            'shipping_bill_no'        => 'nullable|string|max:100',
            'shipping_bill_date'        => 'nullable|date',
            'leo_date'        => 'nullable|date',
            'carting_date'        => 'nullable|date',
            'check_list_date'        => 'nullable|date',
            'packages'    => 'nullable|string|max:50',
            'gross_weight'   => 'nullable|string|max:50',
            'cbm'   => 'nullable|string|max:50',
            'goods_description'   => 'nullable|string',
            'mark_number'   => 'nullable|string',
            'remarks'   => 'nullable|string',

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

        $shipmentLineDetails = OperationSeaExportShipmentLine::create($validated);
        $consigneeName = $shipmentLineDetails->consignee->party_name;

        return response()->json([
            'status'  => true,
            'message' => 'Shipment details added successfully!',
            'data'    => $shipmentLineDetails,
            'consigneeName' => $consigneeName
        ], 201);
    }

    public function updateShipmentLine(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sea_export_id' => 'required|integer',
            'sea_export_cont_id' => 'required|integer',
            'consignee_id' => 'nullable|integer',
            'invoice_no'        => 'nullable|string|max:100',
            'invoice_date'        => 'nullable|date',
            'shipping_bill_no'        => 'nullable|string|max:100',
            'shipping_bill_date'        => 'nullable|date',
            'leo_date'        => 'nullable|date',
            'carting_date'        => 'nullable|date',
            'check_list_date'        => 'nullable|date',
            'packages'    => 'nullable|string|max:50',
            'gross_weight'   => 'nullable|string|max:50',
            'cbm'   => 'nullable|string|max:50',
            'goods_description'   => 'nullable|string',
            'mark_number'   => 'nullable|string',
            'remarks'   => 'nullable|string',

        ]);

        $validated = $validator->validated();
        if ($request->shipment_line_id) {

            $shipmentLine = OperationSeaExportShipmentLine::findOrFail(
                $request->shipment_line_id
            );

            $shipmentLine->update($validated);

        } else {

            $validated['company_id'] = $this->company_id;
            $validated['uuid'] = Str::uuid();

            OperationSeaExportShipmentLine::create($validated);
        }

        return redirect()->back()->with('success', 'Shipment Details Updated Sucessfully. !');
    }

    public function deleteShipmentLine($id)
    {
        $shipmentLine = OperationSeaExportShipmentLine::find($id);
        if(!$shipmentLine) {
            return response()->json(['status'=>false,'message'=>'Shipment not found'],404);
        }
        $shipmentLine->delete();
        return response()->json(['status'=>true,'message'=>'Shipment deleted successfully']);
    }

    // export restrictions
    public function checkSeaExportDownloadPermission(Request $request)
    {
        $request->validate([
            'job_no'    => 'required|integer',
            'copy_type' => 'required|string',
        ]);

        $result = $this->downloadService->canDownload(
            $request->job_no,
            'sea_export',
            'mbl',
            $request->copy_type
        );

        if (!$result['status']) {
            return response()->json([
                'status' => false,
                'message' => $result['message']
            ], 403);
        }

        return response()->json([
            'status' => true,
            'remaining' => $this->downloadService->remainingDownloads(
                $request->job_no,
                'sea_export',
                'mbl',
                $request->copy_type
            )
        ]);
    }

    public function confirmSeaExportDownload(Request $request)
    {
        $request->validate([
            'job_no'    => 'required|integer',
            'copy_type' => 'required|string',
        ]);

        $this->downloadService->recordDownload(
            $request->job_no,
            'sea_export',
            'mbl',
            $request->copy_type
        );

        return response()->json([
            'status' => true
        ]);
    }

}
