<?php

namespace App\Http\Controllers\AdminMain\Accounts;

use Illuminate\Support\Str;
use App\Models\MasterCharge;
use Illuminate\Http\Request;
use App\Models\MasterImportParty;
use App\Models\MasterBillingParty;
use App\Http\Controllers\Controller;
use App\Models\Accounts\AccountFileUpload;
use Illuminate\Support\Facades\Auth;
use App\Models\Operations\OperationAirExport;
use App\Models\Operations\OperationAirImport;
use App\Models\Operations\OperationSeaExport;
use App\Models\Operations\OperationSeaImport;
use App\Models\Operations\OperationTransport;
use App\Models\Operations\OperationSalesPerson;
use App\Models\Accounts\AccountProformaInvoice;
use App\Models\Accounts\AccountProformaInvoiceContainer;
use App\Models\MasterBank;
use App\Models\MasterParty;
use App\Models\Company;
use App\Models\User;
use Carbon\Carbon;

class ProformaInvoiceController extends Controller
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
        $query = AccountProformaInvoice::with(['partyName', 'operationJob', 'chargeName', 'chargesContainer.user'])->where('company_id', $this->company_id);
        
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

        $proforma_invoices = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin-main.admin.proformaInvoice.index', compact('proforma_invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parties = MasterBillingParty::where('company_id', $this->company_id)->get();
        $charges = MasterCharge::where('company_id', $this->company_id)->get();
        $salesPerson = OperationSalesPerson::where('company_id', $this->company_id)->get();
        $account_numbers = MasterBank::where('company_id', $this->company_id)->get();
        $files = AccountFileUpload::where('company_id', $this->company_id)->where('file_related', 'proforma_invoice')->get();
        $party_lists  = MasterParty::whereIn('party_type', [1, 2])->get();
        
        // echo "<pre>"; print_r($parties); exit();

        return view('admin-main.admin.proformaInvoice.create', compact('party_lists', 'parties', 'charges', 'account_numbers', 'files', 'salesPerson'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $ifAlreadyExit = AccountProformaInvoice::where('invoice_no', $request->invoice_no)->first();
        if($ifAlreadyExit){
            return response()->json(['status' => false, 'message' => 'A record with this Invoice number already exists.']); 
        }
        
        $validated = $request->validate([
            'job_no' => 'required|string',
            'full_job_no' => 'required|string',
            'invoice_no' => 'nullable|string',
            'invoice_date' => 'required|date',
            'gst_type' => 'required|string',
            
            'voyage_code' => 'nullable|string',
            'pod' => 'required|string',
            'pol' => 'required|string',
            
            'container' => 'nullable|string',
            'consignee' => 'nullable|string',
            
            'cbm' => 'nullable|string',
            'pkgType' => 'nullable|string',
            'packages' => 'nullable|string',
            
            'gross_weight' => 'nullable|string',
            'chargeable_weight' => 'nullable|string',
            'vessel_name' => 'nullable|string',
            'shipping_no' => 'nullable|string',
            'boe_date' => 'nullable|string',
            'awb_bl_no' => 'nullable|string',
            
            'party_type' => 'nullable|string',
            'billing_party_id' => 'required',
            
            'invoice_type' => 'required|string',
            'bank_id' => 'nullable',
            'sale_purchase' => 'nullable|string',
            'sales_person_id' => 'required|exists:operation_sales_people,id',
        ]);
    
        $validated['company_id'] = $this->company_id;
        $validated['uuid'] = \Str::uuid();
        $validated['Inv_cat'] = $request->Inv_cat;
        $validated['job_no'] = $request->job_id;
        $validated['user_id'] = $this->user_id;
    
        $invoice = AccountProformaInvoice::create($validated);
    
        // return JSON response for AJAX
        return response()->json([
            'success' => true,
            'id' => $invoice->id,
            'proformaInvoice' => $invoice,
            'message' => 'Proforma Invoice saved successfully.'
        ]);
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
        $parties = MasterBillingParty::where('company_id', $this->company_id)->get();
        $charges = MasterCharge::where('company_id', $this->company_id)->get();
        $account_numbers = MasterBank::where('company_id', $this->company_id)->get();
        $salesPerson = OperationSalesPerson::where('company_id', $this->company_id)->get();

        $proforma_invoice = AccountProformaInvoice::where('company_id', $this->company_id)->where('uuid', $uuid)->firstOrFail();
        
        $files = AccountFileUpload::where('file_related', 'proforma_invoice')
                                    ->where('proforma_invoice_id', $proforma_invoice->id)
                                    ->get();
        
        $chargeDetails = AccountProformaInvoiceContainer::with(['charge', 'purchaseInvoice'])
            ->where('company_id', $this->company_id)
            ->where('proforma_invoice_id', $proforma_invoice->id)
            ->get();

        return view('admin-main.admin.proformaInvoice.edit', compact('files', 'parties', 'charges', 'proforma_invoice', 'account_numbers', 'chargeDetails', 'salesPerson'));
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $proforma_invoice = AccountProformaInvoice::findOrFail($id);

        $validated = $request->validate([
            'job_no' => 'required|string',
            'full_job_no' => 'required|string',
            'invoice_no' => 'nullable|string',
            'invoice_date' => 'required|date',
            'gst_type' => 'required|string',
            
            'voyage_code' => 'nullable|string',
            'pod' => 'required|string',
            'pol' => 'required|string',
            
            'container' => 'nullable|string',
            'consignee' => 'nullable|string',
            'cbm' => 'nullable|string',
            'pkgType' => 'nullable|string',
            'packages' => 'nullable|string',
            'gross_weight' => 'nullable|string',
            'chargeable_weight' => 'nullable|string',
            'vessel_name' => 'nullable|string',
            'shipping_no' => 'nullable|string',
            'boe_date' => 'nullable|string',
            'awb_bl_no' => 'nullable|string',
            'party_type' => 'nullable|string',
            'billing_party_id' => 'required|integer',
            'invoice_type' => 'required|string',
            'bank_id' => 'nullable',
            'sale_purchase' => 'nullable|string',
            'sales_person_id' => 'required|exists:operation_sales_people,id',
        ]);
        $validated['user_id'] = $this->user_id;

        $proforma_invoice->update($validated);
        return redirect()->back()->with('success', 'Proforma Invoice updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sales_invoice = AccountProformaInvoice::findOrFail($id);
        $sales_invoice->chargesContainer()->delete();
        $sales_invoice->delete();

        return response()->json(['success' => 'Proforma Invoice record deleted successfully. !']);
    }

    public function getJobNo(Request $request){
        if (!$request->has('search_by') || empty($request->search_by)) {
            return response()->json([
                'status' => 'success',
                'result' => '<option value="">Select</option>',
                'Inv_cat' => ''
            ]);
        }

        switch ($request->search_by) {
            case 'AI':  
                $job_numbers = OperationAirImport::select('id', 'job_no', 'created_at')
                                ->where('company_id', $this->company_id)->get();
                break;
            case 'AE':
                $job_numbers = OperationAirExport::with(['jobMaster'])->select('id', 'job_no', 'created_at')->where('company_id', $this->company_id)->get();
                break;
            case 'SI':
                $job_numbers = OperationSeaImport::with(['jobMaster'])->select('id', 'job_no', 'created_at')->where('company_id', $this->company_id)->get();
                break;
            case 'SE':
                $job_numbers = OperationSeaExport::with(['jobMaster'])->select('id', 'job_no', 'created_at')->where('company_id', $this->company_id)->get();
                break;
            case 'TR':
                $job_numbers = OperationTransport::with(['jobMaster'])->select('id', 'job_no', 'created_at')->where('company_id', $this->company_id)->get();
                break;
            default:
                return response()->json([
                    'status' => 'success',
                    'result' => '<option value="">Select</option>',
                    'Inv_cat' => ''
                ]);
        }

        $FullJobNum = '<option>select</option>';

        foreach ($job_numbers as $job_number) {
            $job_num = $job_number->jobMaster->full_job_no;
            $activity = $request->search_by;

            $FullJobNum .= '<option value="'.$job_number->id.'" data-type="'.$activity.'" data-fulljob="' . $job_num . '" job_id="'.$job_number->job_no.'" >'.$job_num.'</option>';
        }

        return response()->json([
            'status' => 'success',
            'result' => $FullJobNum,
            'Inv_cat' => $activity
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
                $invoice_records = OperationSeaImport::with(['ConsigneeName', 'dischargePortName', 'loadingPortName', 'packageName', 'container'])->find($recorde_id);
                break;
            case 'SE':
                $invoice_records = OperationSeaExport::with(['ConsigneeName', 'dischargePortName', 'loadingPortName', 'packageName', 'container'])->find($recorde_id);
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
            case 'AE': 
                $blNo = $invoice_records->hawb_no ?: $invoice_records->mawb_no ?: '';
                break;
            case 'SI': 
                $blNo = $invoice_records->hbl_no ?: $invoice_records->mbl_no ?: '';
                break;
            case 'SE': 
                $blNo = $invoice_records->hbl_no ?: $invoice_records->mbl_no ?: '';
                break;
            case 'TR': 
                $blNo = ''; 
                break;
            default: 
                $blNo = $invoice_records->mawb_no ?: $invoice_records->mawb_no ?: '';
                break;
        }
        
        $deliveryPort = $invoice_records->dischargePortName ? $invoice_records->dischargePortName->port_name : '';
        $consigneeName = $invoice_records->ConsigneeName ? $invoice_records->ConsigneeName->party_name : '';
        $loadingPort = $invoice_records->loadingPortName ? $invoice_records->loadingPortName->port_name : '';
        $packageName = $invoice_records->package ? $invoice_records->packageName->package_code : '';
        
        $containers = '';
        $boe = '';
        $shippingBillNoDt = '';
        $customer_inv_no = '';
        foreach (optional($invoice_records)->container ?? [] as $con) {
            $containers .= $con->container_no ? $con->container_no . ", " : '';
            $shippingBillNoDt .= $con->sbill_no ? $con->sbill_no . ", " : '';
            $boe .=  $con->bill_of_entry_date ? $con->bill_of_entry_date . ", " : '';
            $customer_inv_no .= $con->customer_inv_no ? $con->customer_inv_no . ", " : '';
        }
        
        $grossWeight = '';
        $chargeNetWeight = '';
        $vessel_airLine = '';
        $Awb_BlNo = '';
        if ($type == 'SI' || $type == 'SE') {
            $packageValue = $invoice_records->quantity ?? '';
            $grossWeight = $invoice_records->gross_weight ?? '';
            $chargeNetWeight = $invoice_records->net_weight ?? '';
            $vessel_airLine = $invoice_records->vessel_name ?? '';
            $Awb_BlNo = $invoice_records->mbl_no ?? '';
            
        } else if ($type == 'AE' || $type == 'AI') {
            $packageValue = $invoice_records->package ?? '';
            $grossWeight = $invoice_records->gross_weight ?? '';
            $chargeNetWeight = $invoice_records->chargable_weight ?? $invoice_records->chg_weight ?? '';
            $vessel_airLine = $invoice_records->flight_name_1 ?? $invoice_records->flight_name_2 ?? $invoice_records->airLineName ?? '';
            $Awb_BlNo = $invoice_records->mawb_no ?? '';
            $shippingBillNoDt = $invoice_records->sbill_no;
            $boe = $invoice_records->bill_of_entry_date;
        }
    

        return response()->json([
            'status' => 'success',
            // 'result' => $invoice_records,
            
            'deliveryPort' => $deliveryPort,
            'loadingPort' => $loadingPort,
            'consigneeName' => $consigneeName,
            'packageType' => $packageName,
            'packages' => $packageValue,
            
            'grossWeight' => $grossWeight,
            'chargeWeight' => $chargeNetWeight,
            'vessel_airLine' => $vessel_airLine,
            
            'containerNo' => $containers,
            'voyageNo' => $invoice_records->voyage_no ?? '',
            'cbm' => $invoice_records->cbm,
            'Awb_BlNo' =>   $Awb_BlNo,
            
            'shippingBillNoDt' => $shippingBillNoDt,
            'boe' => $boe,
            'customer_inv_no' => $customer_inv_no
            
        ]);

    }


    public function proformaInvoiceCharge(Request $request)
    {
        $request->validate([
            'proforma_invoice_id'   => 'required|integer',
            'charge_id'             => 'nullable|integer|exists:master_charges,id',
            'gst'                   => 'nullable|numeric|min:0|max:100',
            'currency'              => 'nullable|string|max:10',
            'prepaid_coll'          => 'nullable|in:P,C',
            'rate_basis'            => 'nullable|string|max:255',
            'gst_applicable'        => 'nullable|in:Y,N',
            'per_unit'              => 'nullable|numeric|min:0',
            'exchange_rate'         => 'nullable|numeric|min:0',
            'rate_per_unit'         => 'nullable|numeric|min:0',
            'total_unit'         => 'nullable|numeric|min:0',
            'freight'               => 'nullable|numeric|min:0',
            'amount'                => 'nullable|numeric|min:0',
            'tds'                   => 'nullable|string|max:255',
            'caf_percent'           => 'nullable|numeric|min:0|max:100',
            'caf_amount'            => 'nullable|numeric|min:0',
            'baf_percent'           => 'nullable|numeric|min:0|max:100',
            'baf_amount'            => 'nullable|numeric|min:0',
            'cc_percent'            => 'nullable|numeric|min:0|max:100',
            'cc_amount'             => 'nullable|numeric|min:0',
            'cc_apply'              => 'nullable|in:Y,N',
            'caf_apply'             => 'nullable|in:Y,N',
            'gstin'                 => 'nullable|string|max:255',
            'sac_code'              => 'nullable|string|max:255',
            'cgst'                  => 'nullable|numeric|min:0',
            'sgst'                  => 'nullable|numeric|min:0',
            'igst'                  => 'nullable|numeric|min:0',
            'total'                 => 'nullable|numeric|min:0',
            'remarks'                 => 'nullable|string',
            
            'tds' => 'nullable|numeric',
            'tds_amount' => 'nullable|numeric',
        ]);
    
        $data = $request->all();
        $data['company_id'] = $this->company_id;
        $data['user_id'] = $this->user_id;
        $data['uuid'] = \Str::uuid();
    
        $proformaCharges = AccountProformaInvoiceContainer::create($data);
        $proformaCharges->load('charge');
    
        return response()->json([
            'success' => true,
            'message' => 'Proforma Invoice Charge saved successfully.',
            'proformaInvoiceCharges' => $proformaCharges
        ]);
    }

    public function UpdateProformaInvoiceCharge(Request $request, $id)
    {
        $rules = [
            'charge_id'           => 'required|numeric',
            'charge_name'         => 'nullable|string|max:255',
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
            'remarks'             => 'nullable|string|max:255',
            'tds'                 => 'nullable|numeric',
            'tds_amount'          => 'nullable|numeric',
        ];
    
        $validated = $request->validate($rules);
    
        // 🔹 Try to find existing charge for this invoice
        $existingCharge = AccountProformaInvoiceContainer::where('proforma_invoice_id', $id)
            ->where('charge_id', $request->charge_id)
            ->first();
    
        if ($existingCharge) {
            // 🔄 Update existing charge
            $validated['user_id'] = $this->user_id;
            $existingCharge->update($validated);
        } else {
            // ➕ Add new charge
            $validated['company_id'] = $this->company_id;
            $validated['user_id'] = $this->user_id;
            $validated['uuid'] = Str::uuid();
            $validated['proforma_invoice_id'] = $id;
    
            AccountProformaInvoiceContainer::create($validated);
        }
    
        return redirect()->back()->with('success', 'Proforma Invoice Charges saved successfully.');
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
    
    public function getChargeDetails($charge_id, $invoice_id)
    {
        // Find matching charge details in AccountSaleInvoiceContainer
        $containerCharge = AccountProformaInvoiceContainer::where('proforma_invoice_id', $invoice_id)
            ->where('charge_id', $charge_id)
            ->with(['charge', 'salesInvoice.operationJob']) // Relation to MasterCharge
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
            'message' => 'Charge details not found in this sales invoice.'
        ]);
    }
    
    public function importProformaInvoice($id)
    {
        $currentDate = Carbon::now()->format('d-m-Y');
        
        $porformaInvoice = AccountProformaInvoice::with([
            'partyName',
            'operationJob.seaExport',
            'operationJob.seaImport',
            'operationJob.airExport',
            'operationJob.airImport'
        ])->findOrFail($id);
        
        $accountDetails = MasterBank::where('company_id', $this->company_id)->first();
    
        $chargeDetails = AccountProformaInvoiceContainer::with(['charge', 'purchaseInvoice']) // relation to MasterCharge
            ->where('proforma_invoice_id', $porformaInvoice->id)
            ->get();
        
        $company = Company::with(['companySetting', 'companyBranch'])
            ->where('id', $this->company_id)
            ->first();
            
        $logoUrl = $company->logo 
            ? asset('public/uploads/company_logo/' . $company->logo)
            : asset('images/default-logo.png');
    
        // pass both invoice + its related charges to the view
        return view('admin-main.admin.proformaInvoice.ImportPorformaInvoice', compact('porformaInvoice', 'chargeDetails', 'company', 'logoUrl', 'accountDetails', 'currentDate'));
    }
    
    public function getChargeDetailForUpdate($id)
    {
        $chargeDetail = AccountProformaInvoiceContainer::with('charge', 'purchaseInvoice')->find($id);
    
        if (!$chargeDetail) {
            return response()->json(['error' => 'Charge not found'], 404);
        }
    
        return response()->json($chargeDetail);
    }
    
    public function deleteChargeDetail($id)
    {
        $charge = AccountProformaInvoiceContainer::find($id);
    
        if ($charge) {
            $charge->delete();
            return response()->json(['success' => true, 'message' => 'Charge deleted successfully']);
        }
    
        return response()->json(['success' => false, 'message' => 'Charge not found'], 404);
    }
    
    public function printProformaInvoice($id)
    {
        $currentDate = Carbon::now()->format('d-m-Y');
        //proformaInvoice
        $porformaInvoice = AccountProformaInvoice::with([
            'partyName',
            'operationJob.seaExport',
            'operationJob.seaImport',
            'operationJob.airExport',
            'operationJob.airImport',
            'salesPerson'
        ])->findOrFail($id);
        
        $accountDetails = MasterBank::where('company_id', $this->company_id)->first();
        
        $chargeDetails = AccountProformaInvoiceContainer::with('charge') // relation to MasterCharge
            ->where('proforma_invoice_id', $porformaInvoice->id)
            ->get();
            
        $company = Company::with(['companySetting', 'companyBranch'])
            ->where('id', $this->company_id)
            ->first();
            
        $logoUrl = $company->logo
            ? public_path('uploads/company_logo/' . $company->logo)
            : public_path('images/default-logo.png');
    
        $format = request('format', 'pdf');
        
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView(
            'admin-main.admin.proformaInvoice.print-proforma-invoice',
            compact('porformaInvoice', 'chargeDetails', 'company', 'logoUrl', 'accountDetails', 'currentDate')
        )->setPaper('A4', 'portrait');

        return $pdf->download("Porforma-Invoice-{$porformaInvoice->id}.pdf");
    }

}
