<?php

namespace App\Http\Controllers\AdminMain\Operations;

use App\Models\MasterPort;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\MasterImportParty;
use App\Models\MasterExportParty;
use App\Http\Controllers\Controller;
use App\Models\MasterParty;
use App\Models\Company;
use App\Models\MasterPackage;
use App\Models\MasterForwarder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Operations\OperationAirExport;
use App\Models\Operations\OperationJobMaster;
use App\Models\Operations\OperationAllFileUpload;
use App\Models\Operations\OperationSalesPerson;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Services\DocumentDownloadService;

class AirExportController extends Controller
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
        $page_title = 'Air Export';
        $query = OperationAirExport::with('shipperName')->where('company_id', $this->company_id)
        ->where(function ($q) {
            $q->whereNull('operation_complate')
              ->orWhere('operation_complate', 0);
        });


        $query->when($request->filled('booking_no'), function ($q) use ($request) {
            $q->where('booking_no', 'LIKE', '%' . $request->booking_no . '%');
        });

        $query->when($request->filled('job_no'), function ($q) use ($request) {
            $q->where('job_no', 'LIKE', '%' . $request->job_no . '%');
        });

        $query->when($request->filled('hawb_no'), function ($q) use ($request) {
            $q->where('hawb_no', 'LIKE', '%' . $request->hawb_no . '%');
        });

        $query->when($request->filled('mawb_no'), function ($q) use ($request) {
            $q->where('mawb_no', 'LIKE', '%' . $request->mawb_no . '%');
        });

        $query->when($request->filled('shipper_id'), function ($q) use ($request) {
            $q->where('shipper_id', 'LIKE', '%' . $request->shipper_id . '%');
        });

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [
                $request->start_date . ' 00:00:00',
                $request->end_date . ' 23:59:59'
            ]);
        } elseif ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        } elseif ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }


        $air_exports = $query->orderBy('job_no', 'desc')->paginate(25);
        $uploadedJobs = OperationAllFileUpload::pluck('job_no')->toArray();

        $filter_records = OperationAirExport::where('company_id', $this->company_id)->orderBy('created_at', 'desc')->get();

        return view('admin-main.admin.airExport.index', compact('page_title','air_exports', 'filter_records','uploadedJobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $page_title = 'Air Export Create';
        $ports = MasterPort::where('company_id', $this->company_id)->get();
        $packages = MasterPackage::where('company_id', $this->company_id)->get();
        $job_numbers = OperationJobMaster::where('company_id', $this->company_id)->where('job_activity', 'AIREXP.FWD')->orderBy('created_at', 'desc')->get();
        $parties = MasterImportParty::where('company_id', $this->company_id)->get();
        $party_lists  = MasterParty::all();
        $exportParites = MasterExportParty::where('company_id', $this->company_id)->get();
        $partyTypes = MasterParty::whereNotIn('party_type', [9, 6, 8])->get();
        $salePersons  = OperationSalesPerson::where('company_id', $this->company_id)->get();

        $forwarders = MasterForwarder::where('company_id', $this->company_id)->get();

        $files = OperationAllFileUpload::where('company_id', $this->company_id)->where('file_related', 'air_export')->orderBy('created_at', 'desc')->get();

        return view('admin-main.admin.airExport.create', compact('page_title','exportParites', 'partyTypes' , 'ports', 'job_numbers', 'parties', 'files', 'party_lists', 'packages', 'salePersons', 'forwarders'));
    }
    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $checkJobNumberExist = OperationAirExport::where('job_no', $request->job_no)->first();
        if($checkJobNumberExist){
            return response()->json([
                'status'  => false,
                'message' => "An entry for this Job Number already exists, so you cannot create another entry with the same Job No.!",
            ], 201);
        }
        $data = $request->validate([
            'job_no' => 'required|integer',
            'full_job_no' => 'nullable|string',
            'booking_no' => 'nullable|string|max:15',
            'booking_date' => 'required|date',
            'mawb_no' => 'nullable|string',
            'hawb_no' => 'nullable|string',
            'eta_date' => 'nullable|date',
            'etd_date' => 'nullable|date',
            'enquiry_reference_no' => 'nullable|string',
            'flight_name_1' => 'nullable|string',
            'flight_date_1' => 'nullable|date',
            'flight_number_1' => 'nullable|string',
            'flight_name_2' => 'nullable|string',
            'flight_date_2' => 'nullable|date',
            'flight_number_2' => 'nullable|string',
            'flight_name_3' => 'nullable|string',
            'flight_date_3' => 'nullable|date',
            'flight_number_3' => 'nullable|string',
            'remarks' => 'required|string',
            'gross_weight' => 'required|numeric',
            'chargable_weight' => 'required|numeric',
            'net_weight' => 'required|numeric',
            'tare_weight' => 'nullable|numeric',
            'issue_place' => 'required|string',
            'movement' => 'required|string',
            'iata_agent' => 'nullable|string',
            'package' => 'required|integer',
            'package_id' => 'required|integer',
            'customer_acc_no' => 'nullable|string',
            'issue_date' => 'nullable|date',
            'sales_person_id' => 'nullable|integer',

            'accountNo' => 'nullable|string',
            'accountingInformation' => 'nullable|string',
            'sobDate' => 'nullable|date',

            'shipper_id' => 'required|integer',
            'consignee_id' => 'required|integer',
            'lata_agent' => 'nullable|integer',
            'overSeas_agent' => 'nullable|integer',
            'notify_id' => 'nullable|integer',
            'notify2_id' => 'nullable|integer',
            'forwarder_id' => 'nullable|integer',
            'cha_party_id' => 'nullable|integer',

            'loading_port_id' => 'required|integer|exists:master_ports,id',
            'discharge_port_id' => 'required|integer',
            'receipt_port_id' => 'nullable|integer',
            'delivery_port_id' => 'nullable|integer',
            'destination_port_id' => 'nullable|integer',

            'freight' => 'required|string',
            'by_first_carrier' => 'nullable|string',
            'currency' => 'nullable|string',
            'declared_value_by_carrier' => 'nullable|string',
            'declared_value_by_customs' => 'nullable|string',
            'other_charges_due_carrier' => 'nullable|string',
            'other_charges_due_agent' => 'nullable|string',
            'rate_charges' => 'nullable|string',
            'executed_by' => 'nullable|string',
            'to_air' => 'nullable|string',
            'chgs_code' => 'nullable|string',
            'reference_number' => 'nullable|string',
            'shipper_agent' => 'nullable|string',
            'other_charges' => 'nullable|string',
            'routing_destination' => 'nullable|string',

            'insurance' => 'nullable|string',
            'fpa_amount' => 'nullable|numeric',
            'transportation' => 'nullable|string',
            'transportation_details' => 'nullable|string',
            'clearance' => 'nullable|string',
            'shipping_bill' => 'nullable|string',
            'mark_number' => 'required|string',
            'goods_description' => 'required|string',
            'handling_information' => 'nullable|string',
            'dimention' => 'nullable|string',

            'leo_date' => 'nullable|string',
            'cartining_date' => 'nullable|string',
            'check_list_date' => 'nullable|string',
            'sbill_no' => 'nullable|string',
            'customer_inv_no' => 'nullable|string',
            'flight_status' => 'nullable|string',
            'to_air_sec' => 'nullable|string',
            'by_second' => 'nullable|string',
            'to_air_third' => 'nullable|string',
            'by_third' => 'nullable|string',
        ]);

        $data['company_id'] = $this->company_id;
        $data['user_id'] = $this->user_id;
        $data['branch_id'] = Auth::user()->branch_id;
        $data['uuid'] = Str::uuid();

        $airExport = OperationAirExport::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Air Export Form details saved successfully!',
            'data' => $airExport
        ]);

        // return redirect()->back()->with('success', 'Air Export Record Created Successfully.');
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
        $page_title = 'Air Export Edit';
        $air_export = OperationAirExport::where('uuid', $uuid)->firstOrFail();

        $ports = MasterPort::where('company_id', $this->company_id)->get();
        $packages = MasterPackage::where('company_id', $this->company_id)->get();
        $job_numbers = OperationJobMaster::where('company_id', $this->company_id)->orderBy('created_at', 'desc')->get();
        $parties = MasterImportParty::where('company_id', $this->company_id)->get();
        $files = OperationAllFileUpload::where('company_id', $this->company_id)->where(['file_related' => 'air_export', 'job_no' => $air_export->job_no])->orderBy('created_at', 'desc')->get();
        $party_lists  = MasterParty::all();
        $exportParites = MasterExportParty::where('company_id', $this->company_id)->get();
        $partyTypes = MasterParty::whereNotIn('party_type', [9, 6, 8])->get();
        $salePersons  = OperationSalesPerson::where('company_id', $this->company_id)->get();

        $forwarders = MasterForwarder::where('company_id', $this->company_id)->get();

        return view('admin-main.admin.airExport.edit', compact('page_title','salePersons', 'forwarders', 'partyTypes', 'exportParites', 'air_export', 'ports', 'job_numbers', 'parties', 'files', 'packages', 'party_lists'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $air_export = OperationAirExport::find($id);

        $data = $request->validate([
            'job_no' => 'required|integer',
            'full_job_no' => 'nullable|string',
            'booking_no' => 'nullable|string|max:15',
            'booking_date' => 'required|date',
            'mawb_no' => 'nullable|string',
            'hawb_no' => 'nullable|string',
            'eta_date' => 'nullable|date',
            'etd_date' => 'nullable|date',
            'enquiry_reference_no' => 'nullable|string',
            'flight_name_1' => 'nullable|string',
            'flight_date_1' => 'nullable|date',
            'flight_number_1' => 'nullable|string',
            'flight_name_2' => 'nullable|string',
            'flight_date_2' => 'nullable|date',
            'flight_number_2' => 'nullable|string',
            'flight_name_3' => 'nullable|string',
            'flight_date_3' => 'nullable|date',
            'flight_number_3' => 'nullable|string',
            'remarks' => 'required|string',
            'gross_weight' => 'required|numeric',
            'chargable_weight' => 'required|numeric',
            'net_weight' => 'required|numeric',
            'tare_weight' => 'nullable|numeric',
            'issue_place' => 'nullable|string',
            'movement' => 'required|string',
            'iata_agent' => 'nullable|string',
            'package' => 'required|integer',
            'package_id' => 'required|integer',
            'customer_acc_no' => 'nullable|string',
            'issue_date' => 'required|date',
            'sales_person_id' => 'nullable|integer',

            'shipper_id' => 'required|integer',
            'consignee_id' => 'required|integer',
            'lata_agent' => 'nullable|integer',
            'overSeas_agent' => 'nullable|integer',
            'notify_id' => 'nullable|integer',
            'notify2_id' => 'nullable|integer',
            'forwarder_id' => 'nullable|integer',
            'cha_party_id' => 'nullable|integer',

            'accountNo' => 'nullable|string',
            'accountingInformation' => 'nullable|string',
            'sobDate' => 'nullable|date',

            'loading_port_id' => 'required|integer|exists:master_ports,id',
            'discharge_port_id' => 'required|integer',
            'receipt_port_id' => 'nullable|integer',
            'delivery_port_id' => 'nullable|integer',
            'destination_port_id' => 'nullable|integer',

            'freight' => 'required|string',
            'by_first_carrier' => 'nullable|string',
            'currency' => 'nullable|string',
            'declared_value_by_carrier' => 'nullable|string',
            'declared_value_by_customs' => 'nullable|string',
            'other_charges_due_carrier' => 'nullable|string',
            'other_charges_due_agent' => 'nullable|string',
            'rate_charges' => 'nullable|string',
            'executed_by' => 'nullable|string',
            'to_air' => 'nullable|string',
            'chgs_code' => 'nullable|string',
            'reference_number' => 'nullable|string',
            'shipper_agent' => 'nullable|string',
            'other_charges' => 'nullable|string',
            'routing_destination' => 'nullable|string',

            'insurance' => 'nullable|string',
            'fpa_amount' => 'nullable|numeric',
            'transportation' => 'nullable|string',
            'transportation_details' => 'nullable|string',
            'clearance' => 'nullable|string',
            'shipping_bill' => 'nullable|string',
            'mark_number' => 'required|string',
            'goods_description' => 'required|string',
            'handling_information' => 'nullable|string',
            'dimention' => 'nullable|string',

            'leo_date' => 'nullable|string',
            'cartining_date' => 'nullable|string',
            'check_list_date' => 'nullable|string',
            'sbill_no' => 'nullable|string',
            'customer_inv_no' => 'nullable|string',
            'flight_status' => 'nullable|string',
            'to_air_sec' => 'nullable|string',
            'by_second' => 'nullable|string',
            'to_air_third' => 'nullable|string',
            'by_third' => 'nullable|string',
        ]);
        $data['user_id'] = $this->user_id;
        $data['branch_id'] = Auth::user()->branch_id;

        $air_export->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Air Export Form details updated successfully!',
        ]);

        // return redirect()->back()->with('success', 'Air Export Record Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = OperationAirExport::find($id);
        $delete->delete();

        return response()->json(['success' => 'Air Export record deleted successfully']);
    }

    public function jobMasterPartyNameJobNumberWise(Request $request)
    {
        $jobMasterTableData = OperationJobMaster::where('job_no', $request->job_no)->first();

        return response()->json([
            'status' => true,
            'data' => $jobMasterTableData,

        ]);

    }

    public function awbDraftOption(Request $request, $id)
    {
        $page_title = 'Air Export AWB';
        $airExportDraftData = OperationAirExport::with([
            'ConsigneeName',
            'shipperName',
            'LataAgentName',
            'receiptPortName',
            'notify',
            'dischargePortName',
            'loadingPortName'
        ])->findOrFail($id);
        return view('admin-main/admin/airExport/awb-draft-option', compact('id','page_title','airExportDraftData'));
    }

    public function hawbDraftOption(Request $request, $id)
    {
        $page_title = 'Air Export HAWB';
        $airExportDraftData = OperationAirExport::with([
            'ConsigneeName',
            'shipperName',
            'LataAgentName',
            'receiptPortName',
            'notify',
            'dischargePortName',
            'loadingPortName'
        ])->findOrFail($id);
        return view('admin-main/admin/airExport/hawb-draft-option', compact('id','page_title','airExportDraftData'));
    }

    public function generateDraft(Request $request, $id)
    {
        $billType = $request->awb_type;
        $hbl_type = $request->hbl_type;
        $executedDate = $request->issue_date;
        $freightPayable = $request->freight_payable;
        $airExportDraftData = OperationAirExport::with([
            'ConsigneeName',
            'shipperName',
            'LataAgentName',
            'receiptPortName',
            'notify',
            'dischargePortName',
            'loadingPortName'
        ])->findOrFail($id);

        $company = Company::where('id', $this->company_id)->first();
        $logoUrl = $company->logo
            ? public_path('uploads/company_logo/' . $company->logo)
            : public_path('images/default-logo.png');

        $html = view(
            'admin-main.admin.airExport.airWayBill-airExport',
            compact('id', 'airExportDraftData', 'request','hbl_type','executedDate','freightPayable', 'company', 'billType', 'logoUrl')
        )->render();

        return response()->json([
            'html' => $html
        ]);
    }

    public function hawbGenerateDraft(Request $request, $id)
    {
        $billType = $request->awb_type;
        $hbl_type = $request->hbl_type;
        $executedDate = $request->issue_date;
        $freightPayable = $request->freight_payable;
        $airExportDraftData = OperationAirExport::with([
            'ConsigneeName',
            'shipperName',
            'LataAgentName',
            'receiptPortName',
            'notify',
            'dischargePortName',
            'loadingPortName'
        ])->findOrFail($id);

        $company = Company::where('id', $this->company_id)->first();
        $logoUrl = $company->logo
            ? public_path('uploads/company_logo/' . $company->logo)
            : public_path('images/default-logo.png');

        $logoPath = $company->logo
            ? public_path('uploads/company_logo/' . $company->logo)
            : public_path('images/default-logo.png');

        $logoType = pathinfo($logoPath, PATHINFO_EXTENSION);

        $logoData = file_get_contents($logoPath);

        $companyLogo = 'data:image/' . $logoType . ';base64,' . base64_encode($logoData);

        $html = view(
            'admin-main.admin.airExport.hawb-airWayBill-airExport',
            compact('id', 'airExportDraftData', 'request','hbl_type','executedDate','freightPayable', 'company', 'billType', 'logoUrl', 'companyLogo')
        )->render();

        return response()->json([
            'html' => $html
        ]);
    }

    public function chargableWeightTotal(Request $request)
    {
        $totalChargableWeight = OperationAirExport::whereBetween(
            'created_at',
            [
                $request->start_date,
                $request->end_date
            ]
        )->sum('chargable_weight');

        return response()->json([
            'status' => true,
            'total' => $totalChargableWeight
        ]);
    }

    // export restrictions
    public function confirmMawbDownload(Request $request)
    {
        $request->validate([
            'job_no'    => 'required|integer',
            'copy_type' => 'required|string',
        ]);

        $this->downloadService->recordDownload(
            $request->job_no,
            'air_export',
            'mawb',
            $request->copy_type
        );

        return response()->json([
            'status' => true
        ]);
    }

    public function checkMawbDownloadPermission(Request $request)
    {
        $request->validate([
            'job_no'    => 'required|integer',
            'copy_type' => 'required|string',
        ]);

        $result = $this->downloadService->canDownload(
            $request->job_no,
            'air_export',
            'mawb',
            $request->copy_type
        );

        if (!$result['status']) {

            return response()->json([
                'status' => false,
                'message' => $result['message']
            ],403);

        }

        return response()->json([
            'status'=>true,
            'remaining'=>$this->downloadService->remainingDownloads(
                $request->job_no,
                'air_export',
                'mawb',
                $request->copy_type
            )
        ]);
    }

    public function confirmHawbDownload(Request $request)
    {
        $request->validate([
            'job_no'    => 'required|integer',
            'copy_type' => 'required|string',
        ]);

        $this->downloadService->recordDownload(
            $request->job_no,
            'air_export',
            'hawb',
            $request->copy_type
        );

        return response()->json([
            'status'=>true
        ]);
    }

    public function checkHawbDownloadPermission(Request $request)
    {
        $request->validate([
            'job_no'    => 'required|integer',
            'copy_type' => 'required|string',
        ]);

        $result = $this->downloadService->canDownload(
            $request->job_no,
            'air_export',
            'hawb',
            $request->copy_type
        );

        if(!$result['status']){

            return response()->json([
                'status'=>false,
                'message'=>$result['message']
            ],403);

        }

        return response()->json([
            'status'=>true,
            'remaining'=>$this->downloadService->remainingDownloads(
                $request->job_no,
                'air_export',
                'hawb',
                $request->copy_type
            )
        ]);
    }
    // export restirctions end

}
