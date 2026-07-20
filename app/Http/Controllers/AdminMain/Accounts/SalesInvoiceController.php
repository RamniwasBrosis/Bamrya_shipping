<?php

namespace App\Http\Controllers\AdminMain\Accounts;

use App\Models\MasterBank;
use Illuminate\Support\Str;
use App\Models\MasterCharge;
use Illuminate\Http\Request;
use App\Models\MasterImportParty;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Accounts\AccountFileUpload;
use App\Models\Accounts\AccountSaleInvoice;
use App\Models\Accounts\AccountSaleInvoiceContainer;
use App\Models\Operations\OperationAirExport;
use App\Models\Operations\OperationAirImport;
use App\Models\Operations\OperationSeaExport;
use App\Models\Operations\OperationSeaImport;
use App\Models\Operations\OperationTransport;
use App\Models\MasterParty;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Company;

class SalesInvoiceController extends Controller
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
        $query = AccountSaleInvoice::with(['chargesContainer.user'])->where('company_id', $this->company_id);

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
        
        $sales_invoices = $query->orderBy('invoice_no', 'desc')->paginate(20);
        
        $all_invoices = AccountSaleInvoice::with('operationJob')->where('company_id', $this->company_id)->get();

        return view('admin-main.admin.salesInvoice.index', compact('sales_invoices', 'all_invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parties = MasterImportParty::where('company_id', $this->company_id)->get();
        $charges = MasterCharge::where('company_id', $this->company_id)->get();
        $account_numbers = MasterBank::where('company_id', $this->company_id)->get();
        $files = AccountFileUpload::where('company_id', $this->company_id)->where('file_related', 'sales_invoice')->get();
        $party_lists  = MasterParty::all();
        
       
        return view('admin-main.admin.salesInvoice.create', compact('parties', 'charges', 'account_numbers', 'files', 'party_lists'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $ifAlreadyExit = AccountSaleInvoice::where('invoice_no', $request->invoice_no)->first();
        if($ifAlreadyExit){
            return response()->json(['status' => false, 'message' => 'A record with this Invoice number already exists.']); 
        }
        $validated = $request->validate([
            'job_no' => 'required|integer', // ensures FK
            'full_job_no' => 'required|string',
            'voyage_code' => 'nullable|string',
            'pod' => 'nullable|string',
            'pol' => 'nullable|string',
            'bl_no' => 'nullable|string',
            'pkgType' => 'nullable|string',
            'container' => 'nullable|string',
            'consignee' => 'nullable|string',
            'cbm' => 'nullable|string',
            'gross_weight' => 'nullable|string',
            'chargeable_weight' => 'nullable|string',
            'party_type' => 'nullable|string',
            'billing_party_id' => 'required|integer|exists:master_import_parties,id',
            'invoice_no' => 'required|string',
            'invoice_type' => 'nullable|string',
            'overseas_exchange_rate' => 'nullable|numeric',
            'gst_type' => 'required|string',
            'invoice_date' => 'required|date',
            'full_invoice_no' => 'nullable|string',
            'bank_id' => 'nullable|integer|exists:master_banks,id',
            'vessel_name' => 'nullable|string',
            'awb_bl_no' => 'nullable|string',
            'sale_purchase' => 'nullable|string',
            'shipping_no' => 'nullable|string',
            'packages' => 'nullable|string',
            'shipping_bill_date' => 'nullable|date',
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
        $validated['user_id'] = $this->user_id;
        $validated['uuid'] = Str::uuid();

        $validated['Inv_cat'] = $request->Inv_cat;

        $salesInvoice = AccountSaleInvoice::create($validated);
        
        if($salesInvoice){
            return response()->json(['status' => true,'message' => "sales invoice form saved successfully.", 'salesInvoice' => $salesInvoice]);
        }else{
            return response()->json(['status' => false, 'message' => "Not saved sales invoice form."]);
        }

        // return redirect()->back()->with('success', 'Sales Invoice saved successfully.')->with('id', $salesInvoice->id);
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
        $parties = MasterImportParty::where('company_id', $this->company_id)->get();
        $charges = MasterCharge::where('company_id', $this->company_id)->get();
        $account_numbers = MasterBank::where('company_id', $this->company_id)->get();
        $party_lists  = MasterParty::all();
        $partyTypes = MasterParty::whereNotIn('party_type', [9, 6, 8])->get();

        $sales_invoice = AccountSaleInvoice::where('uuid', $uuid)->firstOrFail();
        
        $files = AccountFileUpload::where('file_related', 'sales_invoice')
                                    ->where('sales_invoice_id', $sales_invoice->id)
                                    ->get();
        
        // get only charge details linked to this sales invoice
        $chargeDetails = AccountSaleInvoiceContainer::with('chargeName')
            ->where('company_id', $this->company_id)
            ->where('sales_invoice_id', $sales_invoice->id)
            ->get();

        return view('admin-main.admin.salesInvoice.edit', compact('files', 'parties', 'charges', 'sales_invoice', 'account_numbers', 'party_lists', 'partyTypes','chargeDetails'));
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $sales_invoice = AccountSaleInvoice::findOrFail($id);

        $validated = $request->validate([
            'job_no' => 'required|string',
            'full_job_no' => 'required|string',
            'voyage_code' => 'nullable|string',
            'pod' => 'nullable|string',
            'container' => 'nullable|string',
            'consignee' => 'nullable|string',
            'cbm' => 'nullable|string',
            'gross_weight' => 'nullable|string',
            'chargeable_weight' => 'nullable|string',
            'party_type' => 'nullable|string',
            'billing_party_id' => 'required|integer',
            'invoice_no' => 'nullable|string',
            'invoice_type' => 'required|string',
            'overseas_exchange_rate' => 'nullable|numeric',
            'gst_type' => 'required|string',
            'invoice_date' => 'nullable|date',
            'full_invoice_no' => 'nullable|string',
            'bank_id' => 'nullable|integer',
            'vessel_name' => 'nullable|string',
            'awb_bl_no' => 'nullable|string',
            'sale_purchase' => 'nullable|string',
            'hawb_no' => 'nullable|string',
            
            'pol' => 'nullable|string',
            'bl_no' => 'nullable|string',
            'pkgType' => 'nullable|string',
            'packages' => 'nullable|string',
            'shipping_no' => 'nullable|string',
            'shipping_bill_date' => 'nullable|date',
            
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
        return redirect()->back()->with('success', 'Sales Invoice updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sales_invoice = AccountSaleInvoice::find($id);
        
        if($sales_invoice->invoice_amount_status == 'Completed'){
            return response()->json([
                'status' => false,
                'message' => 'This sales invoice payment is completed, so this record cannot be deleted.'
            ]);
        }
        if (!$sales_invoice) {
            return response()->json([
                'status' => false,
                'message' => 'Sales Invoice record not found.'
            ], 404);
        }
        
        // delete related charges
        $sales_invoice->chargesContainer()->delete();
        // If you just want to delete the invoice
        $sales_invoice->delete();
    
        return response()->json([
            'status' => true,
            'message' => 'Sales Invoice record deleted successfully!'
        ]);
    }
    
    public function getChargeDetails($charge_id, $invoice_id)
    {
        // Find matching charge details in AccountSaleInvoiceContainer
        $containerCharge = AccountSaleInvoiceContainer::where('sales_invoice_id', $invoice_id)
            ->where('charge_id', $charge_id)
            ->with(['chargeName', 'salesInvoice.operationJob']) // Relation to MasterCharge
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

    
    public function salesInvoiceChargeContainer(Request $request)
    {
        if (!$request->sales_invoice_id) {
            return response()->json(['status' => false, 'message' => 'Please create the Sales invoice first!']);
        }
    
        $validated = $request->validate([
            'charge_id'         => 'required|numeric',
            'gst'               => 'nullable|numeric|min:0|max:100',
            'currency'          => 'nullable|string|max:10',
            'prepaid_coll'      => 'nullable|in:P,C',
            'rate_basis'        => 'nullable|string|max:255',
            'gst_applicable'    => 'nullable|in:Y,N',
            'per_unit'          => 'nullable|numeric|min:0',
            'total_unit'        => 'nullable',
            'exchange_rate'     => 'nullable|numeric|min:0',
            'rate_per_unit'     => 'nullable|numeric|min:0',
            'freight'           => 'nullable|numeric|min:0',
            'amount'            => 'nullable|numeric|min:0',
            'charge_full_invoice_no' => 'nullable|string|max:255',
            'remarks'           => 'nullable|string|max:255',
            'caf_percent'       => 'nullable|numeric|min:0|max:100',
            'caf_amount'        => 'nullable|numeric|min:0',
            'baf_percent'       => 'nullable|numeric|min:0|max:100',
            'baf_amount'        => 'nullable|numeric|min:0',
            'cc_percent'        => 'nullable|numeric|min:0|max:100',
            'cc_amount'         => 'nullable|numeric|min:0',
            'cc_apply'          => 'nullable|in:Y,N',
            'caf_apply'         => 'nullable|in:Y,N',
            'gstin'             => 'nullable|string|max:255',
            'sac_code'          => 'nullable|string|max:255',
            'cgst'              => 'nullable|numeric|min:0',
            'sgst'              => 'nullable|numeric|min:0',
            'igst'              => 'nullable|numeric|min:0',
            'total'             => 'nullable|numeric|min:0',
            'charge_desc' => 'nullable|string',
            
            'tds' => 'nullable|numeric',
            'tds_amount' => 'nullable|numeric',
        ]);
        
        //  $validation['amount'] = round($request->amount);
         $validation['freight'] = round($request->freight);
         $validation['amount'] = round($request->amount);
         $validation['total'] = round($request->total);
    
        $validated['company_id'] = $this->company_id;
        $validated['user_id'] = $this->user_id;
        $validated['uuid'] = Str::uuid();
        $validated['sales_invoice_id'] = $request->sales_invoice_id;

        $salesInvoiceContainer = AccountSaleInvoiceContainer::create($validated);
        $salesInvoiceContainer->load('chargeName');
    
        if ($salesInvoiceContainer) {
            return response()->json([
                'status' => true,
                'message' => "Sales invoice charges saved successfully.",
                'salesInvoiceContainer' => $salesInvoiceContainer
            ]);
        } else {
            return response()->json(['status' => false, 'message' => "Not saved sales invoice charges."]);
        }
    }


    
    public function UpdateSalesInvoiceCharge(Request $request, $id)
    {
        $rules = [
            'sales_invoice_id'     => 'nullable|numeric',
            'charge_id'            => 'required|numeric',
            'gst'                  => 'nullable|numeric|min:0|max:100',
            'currency'             => 'nullable|string|max:10',
            'prepaid_coll'         => 'nullable|in:P,C',
            'rate_basis'           => 'nullable|string|max:255',
            'gst_applicable'       => 'nullable|in:Y,N',
            'per_unit'             => 'nullable|numeric|min:0',
            'total_unit'           => 'nullable',
            'exchange_rate'        => 'nullable|numeric|min:0',
            'rate_per_unit'        => 'nullable|numeric|min:0',
            'freight'              => 'nullable|numeric|min:0',
            'amount'               => 'nullable|numeric|min:0',
            'charge_full_invoice_no' => 'nullable|string|max:255',
            'remarks'              => 'nullable|string|max:255',
            'caf_percent'          => 'nullable|numeric|min:0|max:100',
            'caf_amount'           => 'nullable|numeric|min:0',
            'baf_percent'          => 'nullable|numeric|min:0|max:100',
            'baf_amount'           => 'nullable|numeric|min:0',
            'cc_percent'           => 'nullable|numeric|min:0|max:100',
            'cc_amount'            => 'nullable|numeric|min:0',
            'cc_apply'             => 'nullable|in:Y,N',
            'caf_apply'            => 'nullable|in:Y,N',
            'gstin'                => 'nullable|string|max:255',
            'sac_code'             => 'nullable|string|max:255',
            'cgst'                 => 'nullable|numeric|min:0',
            'sgst'                 => 'nullable|numeric|min:0',
            'igst'                 => 'nullable|numeric|min:0',
            'total'                => 'nullable|numeric|min:0',
            'tds' => 'nullable|numeric',
            'tds_amount' => 'nullable|numeric',
            'charge_desc' => 'nullable|string',
        ];
    
        $validated = $request->validate($rules);
        
        $validation['freight'] = round($request->freight);
        $validation['amount'] = round($request->amount);
        $validation['total'] = round($request->total);
        
        $con_id = $request->charge_edit_id;
    
        // Find or create a record
        $add_charges = AccountSaleInvoiceContainer::find($con_id);
    
        if ($add_charges) {
            $validated['user_id'] = $this->user_id;
            $add_charges->update($validated);
        } else {
            $validated['company_id'] = $this->company_id;
            $validated['user_id'] = $this->user_id;
            $validated['uuid'] = Str::uuid();
            $validated['sales_invoice_id'] = $id;
            
            AccountSaleInvoiceContainer::create($validated);
        }
    
        return redirect()->back()->with('success', 'Sales Invoice Charges updated successfully.');
    }


    //working 17-oct
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
                                ->where('company_id', $this->company_id)
                                ->get();
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
                return response()->json([
                    'status' => 'success',
                    'result' => '<option value="">Select</option>',
                    'Inv_cat' => ''
                ]);
        }
    
        $FullJobNum = '<option value="">Select</option>';
        $jobData = [];
        
        foreach ($job_numbers as $job_number) {
            $activity = $request->search_by;
            $job_num =  $job_number->jobMaster->full_job_no;
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
        // $saleInvoice = AccountSaleInvoice::with('partyName')->find($recorde_id);

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
        $packageName = $invoice_records->package_id ? $invoice_records->packageName->package_code : '';
        $consigneeName = $invoice_records->ConsigneeName ? $invoice_records->ConsigneeName->party_name : '';
        //shipping bill no
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
            'airLineAndVasselName' =>  $airLineAndVasselName
           
        ]);
        
        // return response()->json(['status' => 'success', 'result' => $invoice_records, 'deliveryPort' => $deliveryPort, 'saleInvoice' => $saleInvoice]);


    }


    // while creating the new entry of the form
    public function salesInvoiceCharge(Request $request){
        if(!$request->filled('salesInvoice_id')){
            return redirect()->back()->with('error', 'Please filled before above sales invoice form. ');
        }

        $add_charges = AccountSaleInvoice::find($request->salesInvoice_id);

        $validate = $request->validate([
            'charge_name'         => 'nullable|string|max:255',
            'gst'                 => 'nullable|numeric|min:0|max:100',
            'currency'            => 'nullable|string|max:10',
            'prepaid_coll'        => 'nullable|in:P,C',
            'rate_basis'          => 'nullable|string|max:255',
            'gst_applicable'      => 'nullable|in:Y,N',
            'per_unit'            => 'nullable|numeric|min:0',
            'total_unit'            => 'nullable',
            'exchange_rate'       => 'nullable|numeric|min:0',
            'rate_per_unit'       => 'nullable|numeric|min:0',
            'freight'             => 'nullable|numeric|min:0',
            'amount'              => 'nullable|numeric|min:0',
            'charge_full_invoice_no' => 'nullable|string|max:255',
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

        $add_charges->update($validate);

        return redirect()->back()->with('success', 'Sales Invoice Charges saved successfully.');

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
    
    // public function ImportSalesInvoice($id)
    // {
    //     $salesInvoice = AccountSaleInvoice::with([
    //         'partyName',
    //         'chargeName',
    //         'operationJob.seaExport',
    //         'operationJob.seaImport',
    //         'operationJob.airExport',
    //         'operationJob.airImport'
    //     ])->findOrFail($id);
        
    //     // $salesInvoice = AccountSaleInvoice::with('partyName')->where('id', $id)->first();
        
    //     return view('admin-main.admin.salesInvoice.ImportSalesInvoice', compact('salesInvoice'));
    // }
    
    public function ImportSalesInvoice($id)
    {
        // Load the main sales invoice
        $salesInvoice = AccountSaleInvoice::with([
            'partyName',
            'operationJob.seaExport',
            'operationJob.seaImport',
            'operationJob.airExport',
            'operationJob.airImport'
        ])->findOrFail($id);
        
        $accountDetails = MasterBank::where('company_id', $this->company_id)->first();
        
        $company = Company::with(['companySetting', 'companyBranch'])
            ->where('id', $this->company_id)
            ->first();
            
        $logoUrl = $company->logo 
            ? asset('public/uploads/company_logo/' . $company->logo)
            : asset('images/default-logo.png');
    
        // Get only the charge details linked to this sales invoice
        $chargeDetails = AccountSaleInvoiceContainer::with('chargeName') // relation to MasterCharge
            ->where('sales_invoice_id', $salesInvoice->id)
            ->get();
    
        // pass both invoice + its related charges to the view
        return view('admin-main.admin.salesInvoice.ImportSalesInvoice', compact('salesInvoice', 'chargeDetails', 'company', 'logoUrl', 'accountDetails'));
    }

    public function printSalesInvoice($id)
    {
        $salesInvoice = AccountSaleInvoice::with([
            'partyName',
            'operationJob.seaExport',
            'operationJob.seaImport',
            'operationJob.airExport',
            'operationJob.airImport'
        ])->findOrFail($id);
        
        $accountDetails = MasterBank::where('company_id', $this->company_id)->first();
        
        $company = Company::with(['companySetting', 'companyBranch'])
            ->where('id', $this->company_id)
            ->first();
            
        $logoUrl = $company->logo
            ? public_path('uploads/company_logo/' . $company->logo)
            : public_path('images/default-logo.png');
        
        $chargeDetails = AccountSaleInvoiceContainer::with('chargeName') // relation to MasterCharge
            ->where('sales_invoice_id', $salesInvoice->id)
            ->get();
    
        $format = request('format', 'pdf');
        
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView(
            'admin-main.admin.salesInvoice.print-sales-invoice',
            compact('salesInvoice', 'chargeDetails', 'company', 'logoUrl', 'accountDetails')
        )->setPaper('A4', 'portrait');

        return $pdf->download("Sales-Invoice-{$salesInvoice->id}.pdf");
    }

    
    // by bhavesh 05/11/2025
    public function getChargeDetailForUpdate($id)
    {
        $chargeDetail = AccountSaleInvoiceContainer::with('chargeName', 'salesInvoice')->find($id);
    
        if (!$chargeDetail) {
            return response()->json(['error' => 'Charge not found'], 404);
        }
    
        return response()->json($chargeDetail);
    }
    
    public function deleteChargeDetail($id)
    {
        $charge = AccountSaleInvoiceContainer::find($id);
    
        if ($charge) {
            $charge->delete();
            return response()->json(['success' => true, 'message' => 'Charge deleted successfully']);
        }
    
        return response()->json(['success' => false, 'message' => 'Charge not found'], 404);
    }

    
        
}
