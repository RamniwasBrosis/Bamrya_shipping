<?php

namespace App\Http\Controllers\AdminMain\Accounts;

use Illuminate\Support\Str;
use App\Models\MasterCharge;
use Illuminate\Http\Request;
use App\Models\MasterImportParty;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Accounts\AccountFileUpload;
use App\Models\MasterBank;
use App\Models\MasterParty;
use App\Models\Company;
use App\Models\Operations\OperationAirExport;
use App\Models\Operations\OperationAirImport;
use App\Models\Operations\OperationSeaExport;
use App\Models\Operations\OperationSeaImport;
use App\Models\Operations\OperationTransport;
use App\Models\Accounts\AccountPurchaseInvoice;
use App\Models\Accounts\AccountPurchaseInvoiceContainer;
use App\Models\MasterBillingParty;
use App\Models\Accounts\PurchaseParties;

class PurchaseInvoiceController extends Controller
{
    public $company_id ;

    public function __construct(){
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
        $query = AccountPurchaseInvoice::with(['chargesContainer.user'])->where('company_id', $this->company_id);

        if($request->filled('job_no')){
            $query->where('job_no', 'LIKE', $request->job_no);
        }

        if($request->filled('invoice_no')){
            $query->where('invoice_no', 'LIKE', $request->invoice_no);
        }

        if($request->filled('billing_party_id')){
            $query->where('billing_party_id', 'LIKE', $request->billing_party_id);
        }
        
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

        $purchase_invoices = $query->orderBy('created_at', 'desc')->paginate(10);
        
        $all_invoices = AccountPurchaseInvoice::where('company_id', $this->company_id)->get();
        $job_nums = [];
        foreach ($all_invoices as $invoice) {
            $year = $invoice->created_at->format('Y');
            $month = $invoice->created_at->format('m');
    
            if ((int)$month < 4) {
                $fyStart = $year - 1;
                $fyEnd = $year;
            } else {
                $fyStart = $year;
                $fyEnd = $year + 1;
            }
    
            $fy = $fyStart . '-' . substr($fyEnd, -2);
            // $job_nums[$invoice->job_no] = $invoice->inv_cat . '/' . $invoice->job_no . '/' . $fy;
            $job_nums[$invoice->job_no] = $invoice->full_job_no;
        }
        $page_title = 'Purchase';
        return view('admin-main.admin.purchaseInvoice.index', compact('purchase_invoices', 'job_nums','page_title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $parties = PurchaseParties::where('company_id', $this->company_id)->get();
        $charges = MasterCharge::where('company_id', $this->company_id)->get();
        $account_numbers = MasterBank::where('company_id', $this->company_id)->get();
        $files = AccountFileUpload::where('company_id', $this->company_id)->where('file_related', 'purchase_invoice')->get();
        $party_lists  = MasterParty::all();

        return view('admin-main.admin.purchaseInvoice.create', compact('parties', 'charges', 'files', 'account_numbers', 'party_lists'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $ifAlreadyExit = AccountPurchaseInvoice::where('invoice_no', $request->invoice_no)->first();
        if($ifAlreadyExit){
            return response()->json(['status' => false, 'message' => 'A record with this Invoice number already exists.']); 
        }
        $validated = $request->validate([
            'job_no' => 'nullable|string',
            'voyage_code' => 'nullable|string',
            'pod' => 'nullable|string',
            'container' => 'nullable|string',
            'consignee' => 'nullable|string',
            'cbm' => 'nullable|string',
            'gross_weight' => 'nullable|string',
            'chargeable_weight' => 'nullable|string',
            'party_type' => 'nullable|string',
            'billing_party_id' => 'required|integer',
            'invoice_no' => 'required|string',
            'invoice_type' => 'required|string',
            'overseas_exchange_rate' => 'nullable|numeric',
            'gst_type' => 'required|string',
            'invoice_date' => 'required|date',
            
            'sale_purchase' => 'nullable|string',
            'awb_bl_no' => 'nullable|string',
            'vessel_name' => 'nullable|string',
            'bank_id' => 'nullable|integer',
            'full_invoice_no' => 'nullable|string',
            
            'pol' => 'nullable|string',
            'pkgType' => 'nullable|string',
            'packages' => 'nullable|string',
            'shipping_no' => 'nullable|string',
            'shipping_bill_date' => 'nullable|date',
            'bl_no' => 'nullable|string',
            
            'hawb_no' => 'nullable|string',
            'job_date' => 'nullable|string',
            'invoice_due_date' => 'nullable|date',
            'shipper_name' => 'nullable|string',
            'eta_date' => 'nullable|string',
            'etd_date' => 'nullable|string',
            'freight_terms' => 'nullable|string',
            'mawb_no' => 'nullable|string',
            'hbl_no' => 'nullable|string',
            'sales_person' => 'nullable|string',
            'container_qty' => 'nullable|string',
            'remarks' => 'nullable|string',
        ]);
    
        $validated['company_id'] = $this->company_id;
        $validated['uuid'] = Str::uuid();
        $validated['Inv_cat'] = $request->Inv_cat;
        $validated['full_job_no'] = $request->full_job_no;
        $validated['user_id'] = $this->user_id;
        
        $purchaseInvoice = AccountPurchaseInvoice::create($validated);
        
        return response()->json([
            'status' => true,
            'message' => 'Purchase Invoice saved successfully!',
            'purchase_invoice_id' => $purchaseInvoice->id,
            'purchaseInvoice' => $purchaseInvoice
        ]);


        // return redirect()->back()->with('success', 'Purchase Invoice saved successfully.')->with('id', $purchaseInvoice->id);
        
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
        $purchase_invoice = AccountPurchaseInvoice::with('operationJob')->where('uuid', $uuid)->firstOrFail();

        $parties = PurchaseParties::where('company_id', $this->company_id)->get();
        $charges = MasterCharge::where('company_id', $this->company_id)->get();
        $account_numbers = MasterBank::where('company_id', $this->company_id)->get();
        
        $files = AccountFileUpload::where('file_related', 'purchase_invoice')
                                    ->where('purchase_invoice_id', $purchase_invoice->id)
                                    ->get();
        
        $chargeDetails = AccountPurchaseInvoiceContainer::with(['chargeName', 'purchaseInvoice.operationJob'])
            ->where('purchase_invoice_id', $purchase_invoice->id)
            ->get();

        return view('admin-main.admin.purchaseInvoice.edit', compact('files', 'parties', 'charges', 'purchase_invoice', 'chargeDetails', 'account_numbers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $sales_invoice = AccountPurchaseInvoice::findOrFail($id);

        $validated = $request->validate([
            'job_no' => 'nullable|string',
            'voyage_code' => 'nullable|string',
            'pod' => 'nullable|string',
            'container' => 'nullable|string',
            'consignee' => 'nullable|string',
            'cbm' => 'nullable|string',
            'gross_weight' => 'nullable|string',
            'chargeable_weight' => 'nullable|string',
            'party_type' => 'nullable|string',
            'billing_party_id' => 'required|integer',
            'invoice_no' => 'required|string',
            'invoice_type' => 'required|string',
            'overseas_exchange_rate' => 'nullable|numeric',
            'gst_type' => 'required|string',
            'invoice_date' => 'required|date',
            
            'sale_purchase' => 'nullable|string',
            'awb_bl_no' => 'nullable|string',
            'vessel_name' => 'nullable|string',
            'bank_id' => 'nullable|integer',
            'full_invoice_no' => 'nullable|string',
            
            'pol' => 'nullable|string',
            'pkgType' => 'nullable|string',
            'packages' => 'nullable|string',
            'shipping_no' => 'nullable|string',
            'shipping_bill_date' => 'nullable|date',
            'bl_no' => 'nullable|string',
            
            'hawb_no' => 'nullable|string',
            'job_date' => 'nullable|string',
            'invoice_due_date' => 'nullable|date',
            'shipper_name' => 'nullable|string',
            'eta_date' => 'nullable|string',
            'etd_date' => 'nullable|string',
            'freight_terms' => 'nullable|string',
            'mawb_no' => 'nullable|string',
            'hbl_no' => 'nullable|string',
            'sales_person' => 'nullable|string',
            'container_qty' => 'nullable|string',
            'remarks' => 'nullable|string',
        ]);
        $validated['user_id'] = $this->user_id;

        $sales_invoice->update($validated);
        return redirect()->back()->with('success', 'Purchase Invoice updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sales_invoice = AccountPurchaseInvoice::findOrFail($id);
        $sales_invoice->chargesContainer()->delete();
        $sales_invoice->delete();

        return response()->json(['success' => 'Purchase Invoice record deleted successfully. !']);
    }


    public function getJobNo(Request $request)
    {
        if (!$request->has('search_by') || empty($request->search_by)) {
            return response()->json([
                'status' => 'success',
                'result' => '<option value="">Select</option>',
                'Inv_cat' => ''
            ]);
        }
    
        switch ($request->search_by) {
            case 'AI':  
                $job_numbers = OperationAirImport::select('id', 'job_no', 'created_at', 'sales_person_id', 'shipper_id')
                ->where('company_id', $this->company_id)->get();
                break;
            case 'AE':
                $job_numbers = OperationAirExport::select('id', 'job_no', 'created_at', 'sales_person_id', 'shipper_id')->where('company_id', $this->company_id)->get();
                break;
            case 'SI':
                $job_numbers = OperationSeaImport::select('id', 'job_no', 'created_at', 'sales_person_id', 'shipper_id')->where('company_id', $this->company_id)->get();
                break;
            case 'SE':
                $job_numbers = OperationSeaExport::select('id', 'job_no', 'created_at', 'sales_person_id', 'shipper_id')->where('company_id', $this->company_id)->get();
                break;
            case 'TR':
                $job_numbers = OperationTransport::select('id', 'job_no', 'created_at', 'sales_person_id', 'shipper_id')->where('company_id', $this->company_id)->get();
                break;
            default:
                // If invalid option is passed
                return response()->json([
                    'status' => 'success',
                    'result' => '<option value="">Select</option>',
                    'Inv_cat' => ''
                ]);
        }
    
        $FullJobNum = '<option value="">Select</option>';
        $jobData = []; // Add this line
    
        foreach ($job_numbers as $job_number) {
            $activity = $request->search_by;
            $job_num = $job_number->jobMaster->full_job_no;
            
            $job_date = $job_number->jobMaster->job_date ?? '';
            $shipper_name = $job_number->shipperName->party_name ?? '';
            $sales_person = optional($job_number->salesPerson)->name ?? '';
            
            $original_job_no = $job_number->jobMaster->id;
    
            // $FullJobNum .= '<option value="' . $job_number->id . '" data-type="' . $activity . '">' . $job_num . '</option>';
            // $FullJobNum .= '<option value="' . $job_number->id . '" data-type="' . $activity . '" data-fulljob="' . $job_num . '">' . $job_num . '</option>';
            $FullJobNum .= '<option value="' . $job_number->id . '" 
                data-type="' . $activity . '" 
                data-fulljob="' . $job_num . '" 
                data-originaljob="' . $job_number->jobMaster->id . '"
                data-jobdate="' . $job_date . '"
                data-shippername="' . $shipper_name . '"
                data-salesperson="' . $sales_person . '">' 
                . $job_num . 
            '</option>';

            // store for optional use if needed later
            $jobData[] = [
                'id' => $job_number->id,
                'full_job_no' => $job_num,
                'activity' => $activity,
                'original_job_no' => $original_job_no,
                'job_date' => $job_date,
                'shipper_name'=>$shipper_name,
                'sales_person' => $sales_person,
            ];
        }
    
        return response()->json([
            'status' => 'success',
            'result' => $FullJobNum,
            'Inv_cat' => $request->search_by,
            'jobs' => $jobData
        ]);
    }

    public function getInvoiceRecord(Request $request){

        $recorde_id = $request->id;
        $type = $request->type;

        switch ($type) {
            case 'AE':
                $invoice_records = OperationAirExport::with(['ConsigneeName', 'dischargePortName', 'loadingPortName', 'packageName'])->find($recorde_id);
                break;
            case 'SI':
                $invoice_records = OperationSeaImport::with(['ConsigneeName', 'dischargePortName', 'loadingPortName', 'packageName','container'])->find($recorde_id);
                break;
            case 'SE':
                $invoice_records = OperationSeaExport::with(['ConsigneeName', 'dischargePortName', 'loadingPortName', 'packageName','container'])->find($recorde_id);
                break;
            case 'TR':
                $invoice_records = OperationTransport::with(['ConsigneeName', 'dischargePortName'])->find($recorde_id);
                break;
            default:
                $invoice_records = OperationAirImport::with(['ConsigneeName', 'dischargePortName', 'loadingPortName'])->find($recorde_id);
                break;
        }
        // Determine BL / AWB Number
        $blNo = '';
        
        switch ($type) {
            case 'AE': // Air Export
                $blNo = $invoice_records->hawb_no ?: $invoice_records->mawb_no ?: '';
                break;
            case 'SI': // Sea Import
                $blNo = $invoice_records->hbl_no ?: $invoice_records->mbl_no ?: '';
                break;
            case 'SE': // Sea Export
                $blNo = $invoice_records->hbl_no ?: $invoice_records->mbl_no ?: '';
                break;
            case 'TR': // Transport
                $blNo = ''; // no BL number for this module
                break;
            default: // Air Import
                $blNo = $invoice_records->mawb_no ?: '';
                break;
        }

        $deliveryPort = $invoice_records->dischargePortName ? $invoice_records->dischargePortName->port_name : '';
        $loadingPort = $invoice_records->loadingPortName ? $invoice_records->loadingPortName->port_name : '';
        $packageName = $invoice_records->package ? $invoice_records->packageName->package_code : '';
        $consigneeName = $invoice_records->ConsigneeName ? $invoice_records->ConsigneeName->party_name : '';
        
        // shipping bill no
        $sbill_no = '';
        if ($type == 'SE') {
            $sbill_no = optional($invoice_records->container->first())->sbill_no ?? '';
        }
        
        if ($type == 'SI') {
            $sbill_no = optional($invoice_records->container->first())->customer_inv_no ?? '';
        }
        
        if ($type == 'AE' || $type == 'AI') {
            $sbill_no = $invoice_records->sbill_no ?? '';
        }
        
        // quantity
        if ($type == 'SI' || $type == 'SE') {
            $packageValue = $invoice_records->quantity ?? '';
        } elseif ($type == 'AE') {
            $packageValue = $invoice_records->package ?? '';
        } else { // AI
            $packageValue = $invoice_records->package ?? '';
        }
        
        if ($type == 'SI' || $type == 'SE') {
            $mbl_no = $invoice_records->mbl_no ?? '';
        }else { // AI / AE
            $mbl_no = $invoice_records->mawb_no ?? '';
        }
        
        if ($type == 'AE') {
            $hbl_no = $invoice_records->hawb_no ?? '';
            $airLineAndVasselName = $invoice_records->flight_name_1 ?? ''.' '. $invoice_records->flight_name_2 ?? '';
        }elseif($type == 'AI') {
            $hbl_no = $invoice_records->hbl_no ?? '';
            $airLineAndVasselName = $invoice_records->airLineName ?? '';
        }elseif($type == 'SE') {
            $hbl_no = $invoice_records->hbl_no ?? '';
            $airLineAndVasselName = $invoice_records->vessel_name ?? '';
        }elseif($type == 'SI') {
            $hbl_no = $invoice_records->hbl_no ?? '';
            $airLineAndVasselName = $invoice_records->vessel_name ?? '';
        }
        
        $totalCbm = collect($invoice_records->container)->sum(function ($container) {
            return (float) $container->cbm;
        });
        
        return response()->json([
            'status' => 'success',
            'result' => $invoice_records,
            'deliveryPort' => $deliveryPort,
            'consigneeName' => $consigneeName,
            'loadingPort' => $loadingPort,
            'packageName' => $packageName,
            'packageValue' => $packageValue,
            'blNo' => $blNo,
            'sbill_no' => $sbill_no,
            'mbl_no' => $mbl_no,
            'hbl_no' => $hbl_no,
            'airLineAndVasselName' =>  $airLineAndVasselName,
            'totalCbm' => $totalCbm
        ]);
    }

    //store charges
    public function purchaseInvoiceCharge(Request $request)
    {
        if (!$request->filled('purchase_invoice_id')) {
            return response()->json([
                'status' => false,
                'message' => 'Please create the purchase invoice first.'
            ]);
        }
    
        //  Validate input
        $validated = $request->validate([
            'purchase_invoice_id' => 'required|numeric',
            'charge_id'         => 'nullable|string|max:255',
            'gst'                 => 'nullable|numeric|min:0|max:100',
            'currency'            => 'nullable|string|max:10',
            'prepaid_coll'        => 'nullable|in:P,C',
            'rate_basis'          => 'nullable|string|max:255',
            'gst_applicable'      => 'nullable|in:Y,N',
            'per_unit'            => 'nullable|numeric|min:0',
            'exchange_rate'       => 'nullable|numeric|min:0',
            'total_unit'       => 'nullable|numeric|min:0',
            'rate_per_unit'       => 'nullable|numeric|min:0',
            'freight'             => 'nullable|numeric|min:0',
            'amount'              => 'nullable|numeric|min:0',
            'tds'                 => 'nullable|string|max:255',
            'tds_amount'          => 'nullable|string|max:255',
            'remarks'             => 'nullable|string|max:255',
            'caf_percent'         => 'nullable|numeric|min:0|max:100',
            'caf_amount'          => 'nullable|numeric|min:0',
            'baf_percent'         => 'nullable|numeric|min:0|max:100',
            'baf_amount'          => 'nullable|numeric|min:0',
            'cc_percent'          => 'nullable|numeric|min:0|max:100',
            'cc_amount'           => 'nullable|numeric|min:0',
            'cc_apply'            => 'nullable|in:Y,N',
            'caf_apply'           => 'nullable|in:Y,N',
            'gstin'               => 'nullable|string|max:255',
            'sac_code'            => 'nullable|string|max:255',
            'cgst'                => 'nullable|numeric|min:0',
            'sgst'                => 'nullable|numeric|min:0',
            'igst'                => 'nullable|numeric|min:0',
            'total'               => 'nullable|numeric|min:0',
        ]);
    
        //  Add extra fields
        $validated['company_id'] = $this->company_id;
        $validated['user_id'] = $this->user_id;
        $validated['uuid'] = Str::uuid();
    
        //  Insert into container table
        $purchaseInvoiceContainer = AccountPurchaseInvoiceContainer::create($validated);
        $purchaseInvoiceContainer->load('chargeName');
        
        //  Return JSON with created record
        return response()->json([
            'status' => true,
            'message' => 'Purchase Invoice charges saved successfully!',
            'purchaseInvoiceContainer' => $purchaseInvoiceContainer
        ]);
    }

    //update charges
    public function UpdatePurchaseInvoiceCharge(Request $request, $id)
    {
        $rules = [
            'charge_id'         => 'required|string|max:255',
            'gst'                 => 'nullable|numeric|min:0|max:100',
            'currency'            => 'nullable|string|max:10',
            'prepaid_coll'        => 'nullable|in:P,C',
            'rate_basis'          => 'nullable|string|max:255',
            'gst_applicable'      => 'nullable|in:Y,N',
            'per_unit'            => 'nullable|numeric|min:0',
            'exchange_rate'       => 'nullable|numeric|min:0',
            'total_unit'          => 'nullable|numeric|min:0',
            'rate_per_unit'       => 'nullable|numeric|min:0',
            'freight'             => 'nullable|numeric|min:0',
            'amount'              => 'nullable|numeric|min:0',
            'tds'                 => 'nullable',
            'tds_amount'          => 'nullable',
            'remarks'             => 'nullable|string|max:255',
            
            'caf_percent'         => 'nullable|numeric|min:0|max:100',
            'caf_amount'          => 'nullable|numeric|min:0',
            'baf_percent'         => 'nullable|numeric|min:0|max:100',
            'baf_amount'          => 'nullable|numeric|min:0',
            'cc_percent'          => 'nullable|numeric|min:0|max:100',
            'cc_amount'           => 'nullable|numeric|min:0',
            
            'cc_apply'            => 'nullable|in:Y,N',
            'caf_apply'           => 'nullable|in:Y,N',

            'gstin'               => 'nullable|string|max:255',
            'sac_code'            => 'nullable|string|max:255',

            'cgst'                => 'nullable|numeric|min:0',
            'sgst'                => 'nullable|numeric|min:0',
            'igst'                => 'nullable|numeric|min:0',
            'total'               => 'nullable|numeric|min:0',
        ];

        $validated = $request->validate($rules);
        $con_id = $request->charge_edit_id;
        
        // Find or create a record
        $add_charges = AccountPurchaseInvoiceContainer::find($con_id);
    
        if ($add_charges) {
            $validated['user_id'] = $this->user_id;
            $add_charges->update($validated);
        } else {
            $validated['company_id'] = $this->company_id;
            $validated['user_id'] = $this->user_id;
            $validated['uuid'] = Str::uuid();
            $validated['purchase_invoice_id'] = $id;
            
            AccountPurchaseInvoiceContainer::create($validated);
        }

        return redirect()->back()->with('success', 'Purchase Invoice Charges Updated successfully.');
    }
    
    public function getChargeDetails($charge_id, $invoice_id)
    {
        // Find matching charge details in AccountSaleInvoiceContainer
        $containerCharge = AccountPurchaseInvoiceContainer::where('purchase_invoice_id', $invoice_id)
            ->where('charge_id', $charge_id)
            ->with('chargeName') // Relation to MasterCharge
            ->first();
    
        // Get master charge info (for default rate, description, etc.)
        $masterCharge = MasterCharge::find($charge_id);
    
        // Merge both results
        if ($containerCharge) {
            $data = [
                'container' => $containerCharge,
                'master' => '',
            ];
            return response()->json(['status' => true, 'data' => $data]);
        }
    
        return response()->json([
            'status' => false,
            'message' => 'Charge details not found in this purchase invoice.'
        ]);
    }
    
    
    public function ImportPurchaseInvoice($id)
    {
        $purchaseInvoice = AccountPurchaseInvoice::with([
            'partyName',
            'operationJob.seaExport',
            'operationJob.seaImport',
            'operationJob.airExport',
            'operationJob.airImport'
        ])->findOrFail($id);
        
        $accountDetails = MasterBank::where('company_id', $this->company_id)->first();
    
        $chargeDetails = AccountPurchaseInvoiceContainer::with('chargeName') // relation to MasterCharge
            ->where('purchase_invoice_id', $purchaseInvoice->id)
            ->get();
            
        $company = Company::with(['companySetting', 'companyBranch'])
            ->where('id', $this->company_id)
            ->first();
            
        $logoUrl = $company->logo 
            ? asset('public/uploads/company_logo/' . $company->logo)
            : asset('images/default-logo.png');
        
        return view('admin-main.admin.purchaseInvoice.ImportPurchaseInvoice', compact('purchaseInvoice', 'chargeDetails', 'company', 'logoUrl', 'accountDetails'));
    }
    
    
    public function getChargeDetailForUpdate($id)
    {
        $chargeDetail = AccountPurchaseInvoiceContainer::with('chargeName', 'purchaseInvoice')->find($id);
    
        if (!$chargeDetail) {
            return response()->json(['error' => 'Charge not found'], 404);
        }
    
        return response()->json($chargeDetail);
    }
    
    public function printPurchaseInvoice($id)
    {
        $purchaseInvoice = AccountPurchaseInvoice::with([
            'partyName',
            'operationJob.seaExport',
            'operationJob.seaImport',
            'operationJob.airExport',
            'operationJob.airImport'
        ])->findOrFail($id);
        
        $accountDetails = MasterBank::where('company_id', $this->company_id)->first();
        
        $chargeDetails = AccountPurchaseInvoiceContainer::with('chargeName') // relation to MasterCharge
            ->where('purchase_invoice_id', $purchaseInvoice->id)
            ->get();
        
        $company = Company::with(['companySetting', 'companyBranch'])
            ->where('id', $this->company_id)
            ->first();
        
        $logoUrl = $company->logo
            ? public_path('uploads/company_logo/' . $company->logo)
            : public_path('images/default-logo.png');
    
        $format = request('format', 'pdf');
        
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView(
            'admin-main.admin.purchaseInvoice.print-purchase-invoice',
            compact('purchaseInvoice', 'chargeDetails', 'company', 'logoUrl', 'accountDetails')
        )->setPaper('A4', 'portrait');

        return $pdf->download("Purchase-Invoice-{$purchaseInvoice->id}.pdf");
    }
    
    public function deleteChargeDetail($id)
    {
        $charge = AccountPurchaseInvoiceContainer::find($id);
    
        if ($charge) {
            $charge->delete();
            return response()->json(['success' => true, 'message' => 'Charge deleted successfully']);
        }
    
        return response()->json(['success' => false, 'message' => 'Charge not found'], 404);
    }
    
}
