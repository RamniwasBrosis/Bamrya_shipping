<?php

namespace App\Http\Controllers\AdminMain\Accounts;

use Illuminate\Support\Str;
use App\Models\MasterCharge;
use Illuminate\Http\Request;
use App\Models\MasterImportParty;
use App\Http\Controllers\Controller;
use App\Models\Accounts\AccountFileUpload;
use Illuminate\Support\Facades\Auth;
use App\Models\Operations\OperationAirExport;
use App\Models\Operations\OperationAirImport;
use App\Models\Operations\OperationSeaExport;
use App\Models\Operations\OperationSeaImport;
use App\Models\Operations\OperationTransport;
use App\Models\Accounts\AccountProformaInvoice;
use App\Models\MasterBank;

class ProformaInvoiceController extends Controller
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
        $query = AccountProformaInvoice::where('company_id', $this->company_id);

        if($request->filled('job_no')){
            $query->where('job_no', 'LIKE', $request->job_no);
        }

        if($request->filled('invoice_no')){
            $query->where('invoice_no', 'LIKE', $request->invoice_no);
        }

        if($request->filled('billing_party_id')){
            $query->where('billing_party_id', 'LIKE', $request->billing_party_id);
        }

        $proforma_invoices = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin-main.admin.proformaInvoice.index', compact('proforma_invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parties = MasterImportParty::where('company_id', $this->company_id)->get();
        $charges = MasterCharge::where('company_id', $this->company_id)->get();
        $account_numbers = MasterBank::where('company_id', $this->company_id)->get();
        $files = AccountFileUpload::where('company_id', $this->company_id)->where('file_related', 'proforma_invoice')->get();

        return view('admin-main.admin.proformaInvoice.create', compact('parties', 'charges', 'account_numbers', 'files'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'job_no' => 'required|string',
            'voyage_code' => 'nullable|string',
            'pod' => 'nullable|string',
            'container' => 'nullable|string',
            'consignee' => 'nullable|string',
            'cbm' => 'nullable|string',
            'gross_weight' => 'nullable|string',
            'chargeable_weight' => 'nullable|string',
            'party_type' => 'required|string',
            'billing_party_id' => 'required|integer',
            'invoice_no' => 'nullable|string',
            'invoice_type' => 'required|integer',
            'bank_id' => 'nullable',
            'gst_type' => 'required|string',
            'invoice_date' => 'nullable|date',
        ]);

        $validated['company_id'] = $this->company_id;
        $validated['uuid'] = Str::uuid();

        $validated['Inv_cat'] = $request->Inv_cat;

        $purchaseInvoice = AccountProformaInvoice::create($validated);

        return redirect()->back()->with('success', 'Proforma Invoice saved successfully.')->with('id', $purchaseInvoice->id);
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

        $proforma_invoice = AccountProformaInvoice::where('uuid', $uuid)->firstOrFail();

        return view('admin-main.admin.proformaInvoice.edit', compact('parties', 'charges', 'proforma_invoice', 'account_numbers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $sales_invoice = AccountProformaInvoice::findOrFail($id);

        $validated = $request->validate([
            'job_no' => 'required|string',
            'voyage_code' => 'nullable|string',
            'pod' => 'nullable|string',
            'container' => 'nullable|string',
            'consignee' => 'nullable|string',
            'cbm' => 'nullable|string',
            'gross_weight' => 'nullable|string',
            'chargeable_weight' => 'nullable|string',
            'party_type' => 'required|string',
            'billing_party_id' => 'required|integer',
            'invoice_no' => 'nullable|string',
            'invoice_type' => 'required|integer',
            'bank_id' => 'nullable|integer',
            'gst_type' => 'required|string',
            'invoice_date' => 'nullable|date',
        ]);

        $sales_invoice->update($validated);
        return redirect()->back()->with('success', 'Proforma Invoice updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sales_invoice = AccountProformaInvoice::findOrFail($id);
        $sales_invoice->delete();

        return response()->json(['success' => 'Proforma Invoice record deleted successfully. !']);
    }

    public function getJobNo(Request $request){

        switch ($request->search_by) {
            case 'AE':
                $job_numbers = OperationAirExport::select('id', 'job_no', 'created_at')->where('company_id', $this->company_id)->get();
                break;
            case 'SI':
                $job_numbers = OperationSeaImport::select('id', 'job_no', 'created_at')->where('company_id', $this->company_id)->get();
                break;
            case 'SE':
                $job_numbers = OperationSeaExport::select('id', 'job_no', 'created_at')->where('company_id', $this->company_id)->get();
                break;
            case 'TR':
                $job_numbers = OperationTransport::select('id', 'job_no', 'created_at')->where('company_id', $this->company_id)->get();
                break;
            default:
                $job_numbers = OperationAirExport::select('id', 'job_no', 'created_at')->where('company_id', $this->company_id)->get();
                break;
        }

        $FullJobNum = '<option>select</option>';

        foreach ($job_numbers as $job_number) {

            $year = $job_number->created_at->format('Y');
            $month = $job_number->created_at->format('m');

            if ((int)$month < 4) {
                // If Jan-Mar, financial year is previous year
                $fyStart = $year - 1;
                $fyEnd = $year;
            } else {
                $fyStart = $year;
                $fyEnd = $year + 1;
            }

            $fy = $fyStart . '-' . substr($fyEnd, -2);


            switch ($request->search_by) {
                case 'AE':
                    $job_num = 'AE/'.$job_number->job_no.'/'.$fy;
                    $activity = 'AE';
                    break;
                case 'SI':
                    $job_num = 'SI/'.$job_number->job_no.'/'.$fy;
                    $activity = 'SI';
                    break;
                case 'SE':
                    $job_num = 'SE/'.$job_number->job_no.'/'.$fy;
                    $activity = 'SE';
                    break;
                case 'TR':
                    $job_num = 'TR/'.$job_number->job_no.'/'.$fy;
                    $activity = 'TR';
                    break;                
                default:
                    $job_num = 'AI/'.$job_number->job_no.'/'.$fy;
                    $activity = 'AI';
                    break;
            }

            $FullJobNum .= '<option value="'.$job_number->id.'" data-type="'.$activity.'">'.$job_num.'</option>';
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
                $invoice_records = OperationAirExport::findOrFail($recorde_id);
                break;
            case 'SI':
                $invoice_records = OperationSeaImport::findOrFail($recorde_id);
                break;
            case 'SE':
                $invoice_records = OperationSeaExport::findOrFail($recorde_id);
                break;
            case 'TR':
                $invoice_records = OperationTransport::findOrFail($recorde_id);
                break;
            default:
                $invoice_records = OperationAirImport::findOrFail($recorde_id);
                break;
        }

        $deliveryPort = $invoice_records->deliveryPort ? $invoice_records->deliveryPort->port_name : '';


        return response()->json(['status' => 'success', 'result' => $invoice_records, 'deliveryPort' => $deliveryPort]);


    }


    public function proformaInvoiceCharge(Request $request){
        if(!$request->filled('proformaInvoice_id')){
            return redirect()->back()->with('error', 'Please filled before above sales invoice form. ');
        }

        $add_charges = AccountProformaInvoice::findOrFail($request->proformaInvoice_id);

        $validate = $request->validate([
            'charge_name'         => 'nullable|string|max:255',
            'gst'                 => 'nullable|numeric|min:0|max:100',
            'currency'            => 'nullable|string|max:10',
            'prepaid_coll'        => 'nullable|in:P,C',
            'rate_basis'          => 'nullable|string|max:255',
            'gst_applicable'      => 'nullable|in:Y,N',
            'per_unit'            => 'nullable|numeric|min:0',
            'exchange_rate'       => 'nullable|numeric|min:0',
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

        $add_charges->update($validate);

        return redirect()->back()->with('success', 'Proforma Invoice Charges saved successfully.');

    }

    public function UpdateProformaInvoiceCharge(Request $request, $id){

        $add_charges = AccountProformaInvoice::findOrFail($id);

        $validate = $request->validate([
            'charge_name'         => 'nullable|string|max:255',
            'gst'                 => 'nullable|numeric|min:0|max:100',
            'currency'            => 'nullable|string|max:10',
            'prepaid_coll'        => 'nullable|in:P,C',
            'rate_basis'          => 'nullable|string|max:255',
            'gst_applicable'      => 'nullable|in:Y,N',
            'per_unit'            => 'nullable|numeric|min:0',
            'exchange_rate'       => 'nullable|numeric|min:0',
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
        ]);

        $add_charges->update($validate);

        return redirect()->back()->with('success', 'Sales Invoice Charges Updated successfully.');
    }
}
