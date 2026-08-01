<?php

namespace App\Http\Controllers\AdminMain;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MasterParty;
use App\Models\MasterPackage;
use App\Models\MasterForwarder;
use App\Models\Operations\OperationJobMaster;
use App\Models\MasterImportParty;
use App\Models\MasterExportParty;
use App\Models\Operations\OperationAllFileUpload;
use App\Models\Operations\OperationSalesPerson;
use App\Models\MasterPort;
use App\Models\MasterShipping;
use App\Models\MasterCharge;
use App\Models\Operations\OperationEnquiries;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\CompanySetting;

class EnquiryController extends Controller
{

    public $company_id ;

    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->company_id = Auth::user()->company_id;
            $this->user_id = auth()->user()->id;
            return $next($request);
        });
    }

    public function index()
    {
        $page_title = "Enquiry";
        $enquiries = OperationEnquiries::with('BuyChargeDetails','SellingChargeDetails', 'shippingLine', 'salesPerson', 'consignee', 'loadingPort', 'dischargePort')
                    ->where('company_id', $this->company_id)
                    ->get();

        return view('admin-main.admin.enquiry.index', compact('enquiries', 'page_title'));
    }

    public function create()
    {
        $page_title = "Enquiry create";
        $ports = MasterPort::where('company_id', $this->company_id)->get();
        $packages = MasterPackage::where('company_id', $this->company_id)->get();
        $job_numbers = OperationJobMaster::where('company_id', $this->company_id)->where('job_activity', 'AIREXP.FWD')->orderBy('created_at', 'desc')->get();
        $parties = MasterImportParty::where('company_id', $this->company_id)->get();
        $party_lists  = MasterParty::all();
        $exportParites = MasterExportParty::where('company_id', $this->company_id)->get();
        $partyTypes = MasterParty::whereNotIn('party_type', [9, 6, 8])->get();
        $salePersons  = OperationSalesPerson::where('company_id', $this->company_id)->get();

        $forwarders = MasterForwarder::where('company_id', $this->company_id)->get();
        $shipping_lines = MasterShipping::where('company_id', $this->company_id)->get();

        $files = OperationAllFileUpload::where('company_id', $this->company_id)->where('file_related', 'air_export')->orderBy('created_at', 'desc')->get();
        $charges = MasterCharge::where('company_id', $this->company_id)->get();
        $enquiryNumber = $this->generateEnquiryNumber();

        return view('admin-main.admin.enquiry.create', compact('page_title','charges', 'shipping_lines', 'exportParites', 'partyTypes' , 'ports', 'job_numbers', 'parties', 'files', 'party_lists', 'packages', 'salePersons', 'forwarders','enquiryNumber'));
    }

    // generate auto increment enquiry no
    private function generateEnquiryNumber()
    {
        $month = date('n');
        $year = date('Y');

        if ($month < 4) {

            $fyStart = $year - 1;
            $fyEnd = $year;

        } else {

            $fyStart = $year;
            $fyEnd = $year + 1;

        }
        $financialYear = $fyStart.'-'.substr($fyEnd,-2);
        // company code
        $setting = CompanySetting::where('company_id', $this->company_id)->first();
        if (!$setting || empty($setting->company_code)) {
            throw new \Exception('Company Code is not configured.');
        }
        $companyCode = $setting->company_code;

        $lastEnquiry = OperationEnquiries::where(
            'company_id',
            $this->company_id
        )
        ->where(
            'financial_year',
            $financialYear
        )
        ->orderByDesc('enquiry_sequence')
        ->first();

        //generate next sequence
        $nextSequence = $lastEnquiry
            ? $lastEnquiry->enquiry_sequence + 1
            : 1;

        $enquiryNo =
            $companyCode .
            str_pad($nextSequence,2,'0',STR_PAD_LEFT)
            .'/'
            .substr($fyStart,-2)
            .'-'
            .substr($fyEnd,-2);

        return ['enquiry_no' => $enquiryNo, 'sequence' => $nextSequence, 'financial_year' => $financialYear];
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'discharge_port_id' => 'required|integer',
            'consignee_id'      => 'required|integer',
            'gross_weight'      => 'required|numeric',
            'job_activity'      => 'required',
            'enquiry_no' => 'required',
            'enquiry_date' => 'required',
        ], [
            'discharge_port_id.required' => 'Discharge Port is required',
            'job_activity.required' => 'Job Activity is required',
            'consignee_id.required'      => 'Consignee is required',
            'gross_weight.required'      => 'Gross Weight is required',
            'gross_weight.numeric'       => 'Gross Weight must be numeric',
            'enquiry_no.required' => 'Enquiry No is required',
            'enquiry_date.required' => 'Enquiry Date is required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Create or Update
        $enquiry = $request->enquiry_id
            ? OperationEnquiries::findOrFail($request->enquiry_id)
            : new OperationEnquiries();

        $enquiry->company_id          = $this->company_id;
        $enquiry->uuid                = Str::uuid();
        $enquiry->reference_id        = $request->reference_id;

        $number = $this->generateEnquiryNumber();
        $enquiry->enquiry_no = $number['enquiry_no'];
        $enquiry->enquiry_sequence = $number['sequence'];
        $enquiry->financial_year = $number['financial_year'];

        $enquiry->discharge_port_id   = $request->discharge_port_id;
        $enquiry->consignee_id        = $request->consignee_id;
        $enquiry->inco_terms          = $request->inco_terms;
        $enquiry->gross_weight        = $request->gross_weight;
        $enquiry->buying_rate         = $request->buying_rate;
        $enquiry->shipment_type       = $request->shipment_type;
        $enquiry->eta_etd             = $request->eta_etd;
        $enquiry->sales_person_id     = $request->sales_person_id;
        $enquiry->no_of_pkgs          = $request->no_of_pkgs;
        $enquiry->chargeable_weight   = $request->chargeable_weight;
        $enquiry->enquiry_date        = $request->enquiry_date;
        $enquiry->loading_port_id     = $request->loading_port_id;
        $enquiry->contact_details     = $request->contact_details;
        $enquiry->commodity_desc      = $request->commodity_desc;
        $enquiry->kgs_mts             = $request->kgs_mts;
        $enquiry->selling_rate        = $request->selling_rate;
        $enquiry->enquiry_status      = $request->enquiry_status;
        $enquiry->no_of_container     = $request->no_of_container;
        $enquiry->lcl_fcl             = $request->lcl_fcl;
        $enquiry->cbm                 = $request->cbm;
        $enquiry->follow_up           = $request->follow_up;
        $enquiry->lost_enquiry_remarks= $request->lost_enquiry_remarks;
        $enquiry->job_activity= $request->job_activity;
        $enquiry->user_id= $this->user_id;
        $enquiry->branch_id = Auth::user()->branch_id;

        $enquiry->save();

        return response()->json([
            'status' => true,
            'enquiry_id' => $enquiry->id
        ]);
    }

    public function cbmUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'enquiry_id' => 'required|exists:operation_enquiries,id',
        ], [
            'enquiry_id.required' => 'Enquiry ID missing',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $enquiry = OperationEnquiries::findOrFail($request->enquiry_id);

        // ===== CBM / DIMENSIONS =====
        $enquiry->length        = $request->length;
        $enquiry->width         = $request->width;
        $enquiry->height        = $request->height;
        $enquiry->quantity      = $request->quantity;
        $enquiry->total_cbm     = $request->total_cbm;
        $enquiry->total_chg_wt  = $request->total_chg_wt;

        $enquiry->save();

        return response()->json([
            'status' => true,
            'message' => 'CBM details updated successfully'
        ]);
    }

    public function sellingUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'enquiry_id' => 'required|exists:operation_enquiries,id',
        ], [
            'enquiry_id.required' => 'Enquiry ID missing',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $enquiry = OperationEnquiries::findOrFail($request->enquiry_id);

        // ===== SELLING SUMMARY =====
        $enquiry->total_selling_rate        = $request->total_selling_rate;
        $enquiry->total_buy_rate            = $request->total_buy_rate;
        $enquiry->estimated_profit          = $request->estimated_profit;

        // ===== SELLING OTHER DETAILS =====
        $enquiry->selling_ref_id_enquiry    = $request->selling_ref_id_enquiry;
        $enquiry->selling_from_valid_dt     = $request->selling_from_valid_dt;
        $enquiry->selling_to_valid_date     = $request->selling_to_valid_date;
        $enquiry->shipping_line_id          = $request->shipping_line_id;
        $enquiry->selling_activity          = $request->selling_activity;

        // ===== CONTAINER DETAILS =====
        $enquiry->selling_lcl               = $request->selling_lcl ? 1 : 0;
        $enquiry->selling_fcl_20            = $request->selling_fcl_20 ? 1 : 0;
        $enquiry->selling_fcl_40            = $request->selling_fcl_40 ? 1 : 0;
        $enquiry->selling_air               = $request->selling_air ? 1 : 0;
        $enquiry->selling_container_type    = $request->selling_container_type;
        $enquiry->selling_free_days         = $request->selling_free_days;
        $enquiry->selling_gstin             = $request->selling_gstin;
        $enquiry->selling_sac_code           = $request->selling_sac_code;

        // ===== CHARGES =====
        $enquiry->selling_charge_id         = $request->selling_charge_id;
        $enquiry->selling_currency          = $request->selling_currency;
        $enquiry->selling_rate_basis        = $request->selling_rate_basis;
        $enquiry->selling_origin_dest       = $request->selling_origin_dest;
        $enquiry->selling_exchange_rate     = $request->selling_exchange_rate;
        $enquiry->selling_freight           = $request->selling_freight;
        $enquiry->selling_per_unit          = $request->selling_per_unit;
        $enquiry->selling_total_unit        = $request->selling_total_unit;

        // ===== TAX =====
        $enquiry->selling_gstin_charge      = $request->selling_gstin_charge;
        $enquiry->selling_sac_code_charge   = $request->selling_sac_code_charge;
        $enquiry->selling_gst               = $request->selling_gst;
        $enquiry->selling_gst_applicable    = $request->selling_gst_applicable;
        $enquiry->selling_cgst              = $request->selling_cgst;
        $enquiry->selling_sgst              = $request->selling_sgst;
        $enquiry->selling_igst              = $request->selling_igst;
        $enquiry->selling_total             = $request->selling_total;

        $enquiry->save();

        return response()->json([
            'status' => true,
            'message' => 'Selling details updated successfully'
        ]);
    }

    public function buyUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'enquiry_id' => 'required|exists:operation_enquiries,id',
        ], [
            'enquiry_id.required' => 'Enquiry ID missing',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $enquiry = OperationEnquiries::findOrFail($request->enquiry_id);

        // ===== BUY OTHER DETAILS =====
        $enquiry->buy_ref_id_enquiry   = $request->buy_ref_id_enquiry;
        $enquiry->buy_from_valid_dt    = $request->buy_from_valid_dt;
        $enquiry->buy_to_valid_date    = $request->buy_to_valid_date;
        $enquiry->buy_vendor           = $request->buy_vendor;
        $enquiry->buy_activity         = $request->buy_activity;

        // ===== CONTAINER DETAILS =====
        $enquiry->buy_lcl              = $request->buy_lcl ? 1 : 0;
        $enquiry->buy_fcl20            = $request->buy_fcl20 ? 1 : 0;
        $enquiry->buy_fcl40            = $request->buy_fcl40 ? 1 : 0;
        $enquiry->buy_air              = $request->buy_air ? 1 : 0;
        $enquiry->buy_container        = $request->buy_container;
        $enquiry->buy_free_days        = $request->buy_free_days;
        $enquiry->buy_gstin            = $request->buy_gstin;

        // ===== TAX =====
        $enquiry->buy_cgst             = $request->buy_cgst;
        $enquiry->buy_sgst             = $request->buy_sgst;
        $enquiry->buy_igst             = $request->buy_igst;
        $enquiry->buy_total            = $request->buy_total;

        // ===== CHARGES =====
        $enquiry->buy_charge_id        = $request->buy_charge_id;
        $enquiry->buy_currency         = $request->buy_currency;
        $enquiry->buy_rate_basic       = $request->buy_rate_basic;
        $enquiry->buy_exchange_rate    = $request->buy_exchange_rate;
        $enquiry->buy_gst_y_n           = $request->buy_gst_y_n;
        $enquiry->buy_per_unit         = $request->buy_per_unit;
        $enquiry->buy_rate             = $request->buy_rate;
        $enquiry->buy_amount           = $request->buy_amount;

        $enquiry->save();

        return response()->json([
            'status' => true,
            'message' => 'Buy rate updated successfully'
        ]);
    }

    public function edit($id)
    {
        $page_title = "Enquiry edit";
        $ports = MasterPort::where('company_id', $this->company_id)->get();
        $party_lists  = MasterParty::all();
        $partyTypes = MasterParty::whereNotIn('party_type', [9, 6, 8])->get();
        $parties = MasterImportParty::where('company_id', $this->company_id)->get();
        $salePersons  = OperationSalesPerson::where('company_id', $this->company_id)->get();
        $shipping_lines = MasterShipping::where('company_id', $this->company_id)->get();
        $charges = MasterCharge::where('company_id', $this->company_id)->get();

        $enquiry = OperationEnquiries::with('BuyChargeDetails','SellingChargeDetails', 'shippingLine', 'salesPerson', 'consignee', 'loadingPort', 'dischargePort')->findOrFail($id);

        return view('admin-main.admin.enquiry.edit', compact('enquiry', 'ports', 'party_lists', 'partyTypes', 'parties', 'salePersons', 'shipping_lines', 'charges','page_title'));
    }

    public function destroy(string $id)
    {
        $delete = OperationEnquiries::find($id);
        $delete->delete();

        return redirect()->back()->with('success', 'Enquiry record deleted successfully');
    }

    function getCharge(Request $request){
       $recorde_id = $request->id;
       $charges = MasterCharge::find($recorde_id);

       if($charges){
           return response()->json(['status' => true, 'data' => $charges]);
       }else{
           return response()->json(['status' => false, 'data' => "Data not found related to this charges."]);
       }
    }

    public function update(Request $request, $id)
    {
        $enquiry = OperationEnquiries::findOrFail($id);

        // Validate all fields (adjust rules as needed)
        $validator = Validator::make($request->all(), [
            'discharge_port_id' => 'required|integer',
            'consignee_id'      => 'required|integer',
            'gross_weight'      => 'required|numeric',
            'job_activity'      => 'required',
            'enquiry_no'        => 'required|string',
            // Add validation for CBM fields if required
            'length'            => 'nullable|numeric',
            'width'             => 'nullable|numeric',
            'height'            => 'nullable|numeric',
            'quantity'          => 'nullable|numeric',
            'total_cbm'         => 'nullable|numeric',
            'total_chg_wt'      => 'nullable|numeric',
            // ... other fields ...
        ], [
            'discharge_port_id.required' => 'Discharge Port is required',
            'consignee_id.required'      => 'Consignee is required',
            'gross_weight.required'      => 'Gross Weight is required',
            'job_activity.required'      => 'Job Activity is required',
            'gross_weight.numeric'       => 'Gross Weight must be numeric',
            'enquiry_no.required' => 'Enquiry No is required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Assign all fields
        $enquiry->reference_id        = $request->reference_id;
        $enquiry->discharge_port_id   = $request->discharge_port_id;
        $enquiry->consignee_id        = $request->consignee_id;
        $enquiry->inco_terms          = $request->inco_terms;
        $enquiry->gross_weight        = $request->gross_weight;
        $enquiry->buying_rate         = $request->buying_rate;
        $enquiry->shipment_type       = $request->shipment_type;
        $enquiry->eta_etd             = $request->eta_etd;
        $enquiry->sales_person_id     = $request->sales_person_id;
        $enquiry->no_of_pkgs          = $request->no_of_pkgs;
        $enquiry->chargeable_weight   = $request->chargeable_weight;
        $enquiry->enquiry_date        = $request->enquiry_date;
        $enquiry->loading_port_id     = $request->loading_port_id;
        $enquiry->contact_details     = $request->contact_details;
        $enquiry->commodity_desc      = $request->commodity_desc;
        $enquiry->kgs_mts             = $request->kgs_mts;
        $enquiry->selling_rate        = $request->selling_rate;
        $enquiry->enquiry_status      = $request->enquiry_status;
        $enquiry->no_of_container     = $request->no_of_container;
        $enquiry->lcl_fcl             = $request->lcl_fcl;
        $enquiry->cbm                 = $request->cbm;
        $enquiry->follow_up           = $request->follow_up;
        $enquiry->lost_enquiry_remarks= $request->lost_enquiry_remarks;
        $enquiry->job_activity = $request->job_activity;

        // ---- CBM fields ----
        $enquiry->enquiry_no    = $request->enquiry_no;
        $enquiry->length        = $request->length;
        $enquiry->width         = $request->width;
        $enquiry->height        = $request->height;
        $enquiry->quantity      = $request->quantity;
        $enquiry->total_cbm     = $request->total_cbm;
        $enquiry->total_chg_wt  = $request->total_chg_wt;
        $enquiry->branch_id = Auth::user()->branch_id;

        $enquiry->save();

        // Redirect with success message or return JSON
        return redirect()->back()->with('success', 'Enquiry updated successfully.');
    }
}
