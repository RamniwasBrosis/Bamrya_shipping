<?php

namespace App\Http\Controllers\AdminMain\Operations;

use App\Models\MasterPort;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\MasterImportParty;
use App\Models\MasterExportParty;
use App\Models\MasterParty;
use App\Models\MasterForwarder;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Operations\OperationAirImport;
use App\Models\Operations\OperationJobMaster;
use App\Models\Operations\OperationAllFileUpload;
use App\Models\Operations\OperationSalesPerson;
use App\Models\MasterPackage;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Shared\Html;
use Carbon\Carbon;

use App\Models\Company;
use App\Services\DocumentDownloadService;

class AirImportController extends Controller
{
    public $company_id;
    protected $downloadService;

    public function __construct(DocumentDownloadService $downloadService)
    {
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
        $page_title = 'Air Import';
        $query = OperationAirImport::with(['ConsigneeName', 'jobMaster'])
            ->where('company_id', $this->company_id)
            ->where(function ($q) {
                $q->whereNull('operation_complate')
                  ->orWhere('operation_complate', 0);
            });

        if ($request->filled('job_no')) {
            $query->where('job_no', 'LIKE', "%{$request->job_no}%");
        }

        if ($request->filled('hbl_no')) {
            $query->where('hbl_no', 'LIKE', "%{$request->hbl_no}%");
        }

        if ($request->filled('mbl')) {
            $query->where('mbl_no', 'LIKE', "%{$request->mbl}%");
        }

        if ($request->filled('consignee_id')) {
            $query->where('consignee_id', $request->consignee_id);
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [
                $request->start_date . ' 00:00:00',
                $request->end_date . ' 23:59:59'
            ]);
        }

        $airImports = $query->orderBy('job_no', 'desc')->paginate(25);
        $uploadedJobs = OperationAllFileUpload::pluck('job_no')->toArray();

        return view('admin-main.admin.airImport.index', compact('airImports','page_title','uploadedJobs'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $page_title = 'Air Import Create';
        $ports = MasterPort::where('company_id', $this->company_id)->get();
        $job_numbers = OperationJobMaster::where('company_id', $this->company_id)->where('job_activity', 'AIRIMP.FWD')->orderBy('created_at', 'desc')->get();
        $parties = MasterImportParty::where('company_id', $this->company_id)->get();
        $party_lists  = MasterParty::all();
        $salePersons  = OperationSalesPerson::where('company_id', $this->company_id)->get();
        $files = OperationAllFileUpload::where('company_id', $this->company_id)->where('file_related', 'air_import')->orderBy('created_at', 'desc')->get();
        $packages = MasterPackage::where('company_id', $this->company_id)->get();
        $exportParites = MasterExportParty::where('company_id', $this->company_id)->get();
        $partyTypes = MasterParty::whereNotIn('party_type', [9, 6, 8])->get();
        $forwarders = MasterForwarder::where('company_id', $this->company_id)->get();
        $airImports = OperationAirImport::where('company_id', $this->company_id)->orderBy('created_at', 'desc')->get();
        $findFiles = OperationAirImport::select('id', 'file_name')->whereNotNull('file_name')->where('company_id', $this->company_id)->get();;

        return view('admin-main.admin.airImport.create', compact('page_title','partyTypes','forwarders', 'ports', 'job_numbers', 'parties', 'airImports', 'findFiles', 'party_lists', 'files', 'salePersons', 'packages', 'exportParites' ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $checkJobNumberExist = OperationAirImport::where('job_no', $request->job_no)->first();
        if($checkJobNumberExist){
            return response()->json([
                'status'  => false,
                'message' => "An entry for this Job Number already exists, so you cannot create another entry with the same Job No.!",
            ], 201);
        }

        $validations = [
             'job_no' => 'required|integer',
            'full_job_no' => 'nullable|string|max:255',
            'booking_no' => 'nullable|string',
            'booking_date' => 'nullable|date',

            'airLineName' => 'nullable|string|max:255',
            'flight_no' => 'nullable|string|max:255',
            'flight_date' => 'nullable|date',
            'remark' => 'nullable|string|max:255',
            'igm_no' => 'nullable|string|max:255',
            'igm_date' => 'nullable|date',
            'eta_date' => 'nullable|date',
            'sobDate' => 'nullable|date',
            'etd_date' => 'nullable|date',
            'movement' => 'nullable|string|max:255',
            'remarks' => 'required|string|max:255',

            'airLineName2' => 'nullable|string|max:255',
            'flight_no2' => 'nullable|string|max:255',
            'flight_date2' => 'nullable|date',
            'airLineName3' => 'nullable|string|max:255',
            'flight_no3' => 'nullable|string|max:255',
            'flight_date3' => 'nullable|date',

            'loading_port_id' => 'required|string|max:255',
            'destination_port_id' => 'required|string|max:255',
            'delivery_port_id' => 'nullable|string|max:255',
            'discharge_port_id' => 'required|string|max:255',

            'shipment' => 'nullable|in:1,2,3',
            'package' => 'nullable|integer',
            'package_id' => 'nullable|integer',
            'weight' => 'nullable|numeric|min:0|max:99999999.99',
            'gross_weight' => 'nullable|string|max:255',
            'net_weight' => 'required|string',

            'username' => 'nullable|string|max:255',
            'nature_qty_goods' => 'nullable|string',

            'forwarder_id' => 'nullable|integer',
        ];

        if($request->mawb_no == ''){
            $validations['hbl_no'] = 'required|string|max:35';
            $validations['hbl_date'] = 'required|date';
        }else{

            $validations['mawb_no'] = 'required|string|max:35';
            $validations['mawb_date'] = 'required|date';
        }

        $validated = $request->validate($validations);

        $validated['uuid'] = Str::uuid();
        $validated['company_id'] = $this->company_id;
        $validated['user_id'] = $this->user_id;
        $validated['branch_id'] = Auth::user()->branch_id;

        $airImport = OperationAirImport::create($validated);

        if($airImport){
            return response()->json([
                'status' => true,
                'message' => 'MAWB Details Saved Successfully!',
                'data' => $airImport
            ]);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'MAWB Details Not Saved Successfully!',
            ]);
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
        $page_title = 'Air Import Edit';
        $airImport = OperationAirImport::with('jobMaster')->where('uuid', $uuid)->firstOrFail();

        $ports = MasterPort::where('company_id', $this->company_id)->get();
        $jobNumbers = OperationJobMaster::where('company_id', $this->company_id)->get();
        $parties = MasterImportParty::where('company_id', $this->company_id)->get();
        $salePersons = OperationSalesPerson::where('company_id', $this->company_id)->get();
        $party_lists = MasterParty::all();

        $files = OperationAllFileUpload::where('company_id', $this->company_id)
            ->where(['file_related' => 'air_import', 'job_no' => $airImport->job_no])
            ->orderBy('created_at', 'desc')
            ->get();

        $packages = MasterPackage::where('company_id', $this->company_id)->get();
        $exportParites = MasterExportParty::where('company_id', $this->company_id)->get();
        $partyTypes = MasterParty::whereNotIn('party_type', [9, 6, 8])->get();
        $forwarders = MasterForwarder::where('company_id', $this->company_id)->get();

        return view('admin-main.admin.airImport.edit', compact('page_title','partyTypes','forwarders','exportParites','ports', 'jobNumbers', 'parties', 'party_lists', 'airImport', 'files', 'salePersons', 'packages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $airImport = OperationAirImport::find($id);

        $validated = $request->validate([
            'mawb_no' => 'required|string|max:35',
            'mawb_date' => 'required|date',
            'flight_no' => 'nullable|string|max:255',
            'airLineName' => 'nullable|string|max:255',
            'flight_date' => 'nullable|date',
            'igm_no' => 'nullable|string|max:255',
            'igm_date' => 'nullable|date',
            'movement' => 'nullable|string',
            'remarks' => 'required|string',

            'loading_port_id' => 'required|integer',
            'destination_port_id' => 'required|integer',
            'delivery_port_id' => 'nullable|integer',
            'discharge_port_id' => 'required|integer',

            'shipment' => 'nullable|in:1,2,3',
            'package' => 'nullable|integer',
            'package_id' => 'nullable|integer',
            'weight' => 'nullable|numeric|min:0|max:99999999.99',
            'gross_weight' => 'nullable|string|max:255',
            'net_weight' => 'required|string',
            'username' => 'nullable|string|max:255',
            'nature_qty_goods' => 'nullable|string',
            'remark' => 'nullable|string|max:255',
            'full_job_no' => 'nullable|string|max:255',
            'eta_date' => 'nullable|date',
            'sobDate' => 'nullable|date',
            'etd_date' => 'nullable|date',
            'forwarder_id' => 'nullable|integer',
            'booking_no' => 'nullable|string',
            'booking_date' => 'nullable|date',

            'airLineName2' => 'nullable|string|max:255',
            'flight_no2' => 'nullable|string|max:255',
            'flight_date2' => 'nullable|date',
            'airLineName3' => 'nullable|string|max:255',
            'flight_no3' => 'nullable|string|max:255',
            'flight_date3' => 'nullable|date',

            'job_no' => 'integer',
            'hbl_no' => 'nullable|string|max:255',
            'hbl_date' => 'nullable|date',


            'freight' => 'nullable|string|max:255',
            'currency' => 'nullable|string|max:10',
            'exchange_rate' => 'nullable|numeric',
            'cc_perc' => 'nullable|numeric',
            'cc_currency' => 'nullable|string',
            'cc_exch_rate' => 'nullable|numeric',
            'caf_perc' => 'nullable|numeric',
            'chargable_weight' => 'nullable|numeric',
            'consignee_id' => 'nullable|exists:master_import_parties,id',
            'shipper_id' => 'nullable|exists:master_export_parties,id',
            'billing_party_id' => 'nullable|exists:master_import_parties,id',
            'cha_party_id' => 'nullable|exists:master_import_parties,id',
            'sales_person_id' => 'nullable|exists:operation_sales_people,id',
            'fpa_amount' => 'nullable|numeric',
            'insurance' => 'nullable|string|max:255',
            'transportation' => 'nullable|string|max:255',
            'transportation_details' => 'nullable|string|max:1000',
            'clearance' => 'nullable|string|max:255',
            'notify_id' => 'nullable|integer',
            'notify2_id' => 'nullable|integer',

            'agent_id' => 'nullable|exists:master_import_parties,id',
            'iata_code' => 'nullable|string|max:255',
            'account_no' => 'nullable|string|max:255',
            'accounting_information' => 'nullable|string|max:255',

            'issued_by' => 'nullable|string|max:255',
            'handling_information' => 'nullable|string|max:255',

            'by_first_carrier' => 'nullable|string',
            'by_second' => 'nullable|string',
            'to_air_sec' => 'nullable|string',
            'by_third' => 'nullable|string',
            'to_air_third' => 'nullable|string',
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

            'customer_inv_no' => 'nullable|string',

            'check_list_date' => 'nullable|date',
            'bill_of_entry_date' => 'nullable|string',
            'destuffing_date' => 'nullable|date',
            'arrival_date' => 'nullable|date',
            'out_off_charge_date' => 'nullable|date',
        ]);
        $validated['user_id'] = $this->user_id;
        $validated['branch_id'] = Auth::user()->branch_id;
        $airImport->update($validated);

        return redirect()->back()->with('success', 'Air Import Updated Successful');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $airImport = OperationAirImport::find($id);
        $airImport->delete();

        return response()->json(['success' => 'Air Export Record Deleted Successful']);
    }

    // public function updateHawb(Request $request)
    // {

    //     if (!$request->filled('mawb_id')) {
    //         return response()->json(['status' => false, 'message' => 'Please before submit first HAWB Detail form, Ya update (Edit) this form.']);
    //     }

    //     $import = OperationAirImport::find($request->mawb_id);

    //     $validated = $request->validate([

    //         'hawb_loading_port_id' => 'required|integer',
    //         'hawb_destination_port_id' => 'nullable|integer',
    //         'hawb_discharge_port_id' => 'required|integer',
    //         'hawb_shipment' => 'nullable|in:1,2,3',
    //         'hawb_package' => 'nullable|string|max:255',
    //         'hawb_weight' => 'required | nullable|numeric|min:0|max:99999999.99',
    //         'descriptions' => 'required|nullable|string',
    //     ]);


    //     $import->update([
    //         // 'job_no' => $validated['job_no'],
    //         'hbl_no' => $validated['hbl_no'],
    //         'hbl_date' => $validated['hbl_date'],
    //         'hawb_loading_port_id' => $validated['hawb_loading_port_id'],
    //         'hawb_destination_port_id' => $validated['hawb_destination_port_id'],
    //         'hawb_discharge_port_id' => $validated['hawb_discharge_port_id'],
    //         'hawb_shipment' => $validated['hawb_shipment'],
    //         'hawb_package' => $validated['hawb_package'],
    //         'hawb_weight' => $validated['hawb_weight'],
    //         // 'enquiry_reference_no' => $validated['enquiry_reference_no'] ,
    //         'descriptions' => $validated['descriptions'],
    //     ]);

    //     if($import){
    //         return response()->json(['status' => true, 'message' => 'HAWB details updated!']);
    //     }else{
    //         return response()->json(['status' => false, 'message' => 'HAWB details not updated!']);

    //     }
    // }

    public function updateother(Request $request)
    {
        if (!$request->filled('mawb_id')) {
            return response()->json(['status' => false, 'message' => 'Please before submit first HAWB Detail form, or update (Edit) this form.']);
        }
        $import = OperationAirImport::find($request->mawb_id);

        $validated = $request->validate([
            'freight' => 'nullable|string|max:255',
            'currency' => 'nullable|string|max:10',
            'exchange_rate' => 'nullable|numeric',
            'chargable_weight' => 'nullable|numeric',
            'iata_code' => 'nullable|string|max:255',
            'issued_by' => 'nullable|string|max:255',

            'handling_information' => 'nullable|string|max:255',
            'accounting_information' => 'nullable|string|max:255',
            'account_no' => 'nullable|string|max:255',
            'agent_id' => 'nullable|exists:master_import_parties,id',

            'consignee_id' => 'nullable|exists:master_import_parties,id',
            'shipper_id' => 'nullable|exists:master_export_parties,id',
            'billing_party_id' => 'nullable|exists:master_import_parties,id',
            'cha_party_id' => 'nullable|exists:master_import_parties,id',
            'notify_id' => 'nullable|integer',
            'notify2_id' => 'nullable|integer',
            'sales_person_id' => 'nullable|exists:operation_sales_people,id',

            'insurance' => 'nullable|string|max:255',
            'transportation' => 'nullable|string|max:255',
            'fpa_amount' => 'nullable|numeric|min:0',
            'transportation_details' => 'nullable|string|max:1000',
            'clearance' => 'nullable|string|max:255',

            'cc_perc' => 'nullable|numeric',
            'cc_currency' => 'nullable|string',
            'cc_exch_rate' => 'nullable|numeric',
            'caf_perc' => 'nullable|numeric',

            'customer_inv_no' => 'nullable|string',
            'check_list_date' => 'nullable|date',
            'bill_of_entry_date' => 'nullable|string',
            'out_off_charge_date' => 'nullable|date',
            'arrival_date' => 'nullable|date',

            'by_first_carrier' => 'nullable|string',
            'by_second' => 'nullable|string',
            'to_air_sec' => 'nullable|string',
            'by_third' => 'nullable|string',
            'to_air_third' => 'nullable|string',
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

        ]);

        $import->update($validated);



        // $import->update([
        //     'freight' => $validated['freight'],
        //     'currency' => $validated['currency'],
        //     'exchange_rate' => $validated['exchange_rate'],
        //     'cc_perc' => $validated['cc_perc'],
        //     'cc_currency' => $validated['cc_currency'],
        //     'cc_exch_rate' => $validated['cc_exch_rate'],
        //     'caf_perc' => $validated['caf_perc'],
        //     'chg_weight' => $validated['chg_weight'],
        //     'consignee_id' => $validated['consignee_id'],
        //     'shipper_id' => $validated['shipper_id'],

        //     'billing_party_id' => $validated['billing_party_id'],
        //     'sales_person_id' => $validated['sales_person_id'],
        //     'fpa_amount' => $validated['fpa_amount'],
        //     'transportation_details' => $validated['transportation_details'],
        //     'notify_id' => $validated['notify_id'],
        //     'notify2_id' => $validated['notify2_id'],

        //     'by_first_carrier' => $validated['by_first_carrier'],
        //     'declared_value_by_carrier' => $validated['declared_value_by_carrier'],
        //     'declared_value_by_customs' => $validated['declared_value_by_customs'],
        //     'other_charges_due_carrier' => $validated['other_charges_due_carrier'],
        //     'other_charges_due_agent' => $validated['other_charges_due_agent'],
        //     'rate_charges' => $validated['rate_charges'],
        //     'executed_by' => $validated['executed_by'],
        //     'to_air' => $validated['to_air'],
        //     'chgs_code' => $validated['chgs_code'],
        //     'reference_number' => $validated['reference_number'],
        //     'shipper_agent' => $validated['shipper_agent'],
        //     'other_charges' => $validated['other_charges'],
        //     'routing_destination' => $validated['routing_destination'],

        //     'customer_inv_no' => $validated['customer_inv_no'],
        //     'check_list_date' => $validated['check_list_date'],
        //     'bill_of_entry_date' => $validated['bill_of_entry_date'],
        //     // 'destuffing_date' => $validated['destuffing_date'],
        //     'out_off_charge_date' => $validated['out_off_charge_date'],
        //     'arrival_date' => $validated['arrival_date'],
        // ]);

        return response()->json(['status' => true, 'message' => 'Other details updated!']);
    }


    public function awbDraftOption(Request $request, $id)
    {
        $page_title = 'Air Import AWB';
        $airImportDraftData = OperationAirImport::findOrFail($id);
        return view('admin-main/admin/airImport/awb-draft-option', compact('id','page_title','airImportDraftData'));
    }

    public function hawbDraftOptionAirImp(Request $request, $id)
    {
        $page_title = 'Air Import HAWB';
        $airImportDraftData = OperationAirImport::findOrFail($id);
        return view('admin-main/admin/airImport/hawb-draft-option', compact('id','page_title','airImportDraftData'));
    }

    public function generateDraft(Request $request, $id)
    {
        $billType = $request->awb_type;
        $hbl_type = $request->hbl_type;
        $executedDate = $request->issue_date;
        $issuedPlace = $request->issuedPlace;
        $airImportDraftData = OperationAirImport::with([
            'ConsigneeName',
            'shipperName',
            'iataAgent',
            'NotifyParty',
            'dischargePortName',
            'loadingPortName'
        ])->findOrFail($id);

        $company = Company::where('id', $this->company_id)->first();

        $html = view(
            'admin-main.admin.airImport.airWayBill-airImport',
            compact('id', 'airImportDraftData', 'request','hbl_type','executedDate','issuedPlace', 'company', 'billType')
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
        $issuedPlace = $request->issuedPlace;
        $airImportDraftData = OperationAirImport::with([
            'ConsigneeName',
            'shipperName',
            'iataAgent',
            'NotifyParty',
            'dischargePortName',
            'loadingPortName'
        ])->findOrFail($id);

        $company = Company::where('id', $this->company_id)->first();

        $logoPath = $company->logo
            ? public_path('uploads/company_logo/' . $company->logo)
            : public_path('images/default-logo.png');

        $logoType = pathinfo($logoPath, PATHINFO_EXTENSION);

        $logoData = file_get_contents($logoPath);

        $companyLogo = 'data:image/' . $logoType . ';base64,' . base64_encode($logoData);

        $html = view(
            'admin-main.admin.airImport.hawb-airWayBill-airImport',
            compact('id', 'airImportDraftData', 'request','hbl_type','executedDate','issuedPlace', 'company', 'billType', 'companyLogo')
        )->render();

        return response()->json([
            'html' => $html
        ]);
    }

    public function chargableWeightTotal(Request $request)
    {
        $totalChargableWeight = OperationAirImport::whereBetween(
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

    // download restrications
    // public function checkDownloadPermission(Request $request)
    // {
    //     $request->validate([
    //         'job_no' => 'required|integer',
    //         'module' => 'required|string',
    //         'document_type' => 'required|string',
    //         'copy_type' => 'required|string',
    //     ]);
    //     $result = $this->downloadService->canDownload(
    //         $request->job_no,
    //         $request->module,
    //         $request->document_type,
    //         $request->copy_type
    //     );
    //     if (!$result['status']) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => $result['message']
    //         ], 403);
    //     }
    // /*
    // |--------------------------------------------------------------------------
    // | Record Download
    // |--------------------------------------------------------------------------
    // */
    //     $this->downloadService->recordDownload(
    //         $request->job_no,
    //         $request->module,
    //         $request->document_type,
    //         $request->copy_type
    //     );
    //     $remaining = $this->downloadService->remainingDownloads(
    //         $request->job_no,
    //         $request->module,
    //         $request->document_type,
    //         $request->copy_type
    //     );
    //     return response()->json([
    //         'status' => true,
    //         'message' => 'Allowed',
    //         'remaining' => $remaining
    //     ]);
    // }

    // confirm download
    public function confirmMawbDownload(Request $request)
    {
        $request->validate([
            'job_no'    => 'required|integer',
            'copy_type' => 'required|string',
        ]);

        $this->downloadService->recordDownload(
            $request->job_no,
            'air_import',
            'mawb',
            $request->copy_type
        );

        return response()->json([
            'status' => true
        ]);
    }

    public function confirmHawbDownload(Request $request)
    {
        $request->validate([
            'job_no' => 'required|integer',
            'copy_type' => 'required|string',
        ]);

        $this->downloadService->recordDownload(
            $request->job_no,
            'air_import',
            'hawb',
            $request->copy_type
        );

        return response()->json([
            'status' => true
        ]);
    }

    // for mawb
    public function checkMawbDownloadPermission(Request $request)
    {
        $request->validate([
            'job_no'    => 'required|integer',
            'copy_type' => 'required|string',
        ]);

        $result = $this->downloadService->canDownload(
            $request->job_no,
            'air_import',
            'mawb',
            $request->copy_type
        );

        if (!$result['status']) {
            return response()->json([
                'status'  => false,
                'message' => $result['message']
            ], 403);
        }

        return response()->json([
            'status'    => true,
            'remaining' => $this->downloadService->remainingDownloads(
                $request->job_no,
                'air_import',
                'mawb',
                $request->copy_type
            )
        ]);
    }

    //for hawb
    public function checkHawbDownloadPermission(Request $request)
    {
        $request->validate([
            'job_no'    => 'required|integer',
            'copy_type' => 'required|string',
        ]);

        $result = $this->downloadService->canDownload(
            $request->job_no,
            'air_import',
            'hawb',
            $request->copy_type
        );

        if (!$result['status']) {
            return response()->json([
                'status'  => false,
                'message' => $result['message']
            ], 403);
        }

        return response()->json([
            'status'    => true,
            'remaining' => $this->downloadService->remainingDownloads(
                $request->job_no,
                'air_import',
                'hawb',
                $request->copy_type
            )
        ]);
    }

}
