<?php

namespace App\Http\Controllers\AdminMain\Accounts;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Models\Accounts\AccountProformaInvoice;
use App\Models\Accounts\AccountProformaInvoiceContainer;

use App\Models\Operations\OperationAirImport;
use App\Models\Operations\OperationAirExport;
use App\Models\Operations\OperationSeaImport;
use App\Models\Operations\OperationSeaExport;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Company;
use App\Models\MasterBank;

use Carbon\Carbon;

class TaxInvoiceController extends Controller
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
        return view('admin-main.admin.taxInvoice.tax-invoice-view');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $jobId = $request->jobId;
        
        $proforma = AccountProformaInvoice::where('company_id', $this->company_id)->where('job_no', $jobId)->first();
        
        if($proforma){
            $proforma->invoice_no = $request->invoice_no;
            $proforma->invoice_type = $request->invoice_type;
            
            $proforma->save();
            
            return response()->json(['status' => 'success', 'message' => 'Invoice Number and Invoice Type update Successfully!']);
        }
        
        return response()->json(['status' => 'error', 'message' => 'Proforma Record Not Found!']);
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
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
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
                $job_numbers = OperationAirImport::select('id', 'job_no', 'created_at')
                                ->where('company_id', $this->company_id)->get();
                break;
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
            
            $original_job_no = $job_number->jobMaster->id;

            $FullJobNum .= '<option value="' . $job_number->id . '" 
                data-type="' . $activity . '" 
                data-fulljob="' . $job_num . '" 
                data-originaljob="' . $job_number->jobMaster->id . '">' 
                . $job_num . 
            '</option>';

            
            // ðŸ‘‡ store for optional use if needed later
            $jobData[] = [
                'id' => $job_number->id,
                'full_job_no' => $job_num,
                'activity' => $activity,
                'original_job_no' => $original_job_no
            ];
        }
    
        return response()->json([
            'status' => 'success',
            'result' => $FullJobNum,
            'Inv_cat' => $request->search_by,
            'jobs' => $jobData
        ]);
    }
    
    public function getTaxInvoice(Request $request){
        $recorde_id = $request->id;
        $type = $request->type;
        $jobId = $request->jobId;
        
        $checkIfExist = AccountProformaInvoice::where('company_id', $this->company_id)->where('job_no', $jobId)->first();
        
        if(!$checkIfExist){
            return redirect()->route('tax-invoices.showErrorPage');
        }
        
        
        $currentDate = Carbon::now()->format('d-m-Y');
        //proformaInvoice
        $porformaInvoice = AccountProformaInvoice::with([
            'partyName',
            'operationJob.seaExport',
            'operationJob.seaImport',
            'operationJob.airExport',
            'operationJob.airImport',
            'salesPerson'
        ])->findOrFail($checkIfExist->id);
        
        // echo "<pre>"; print_r($porformaInvoice); exit();
        
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
            'admin-main.admin.taxInvoice.print-tax-invoice',
            compact('porformaInvoice', 'chargeDetails', 'company', 'logoUrl', 'accountDetails', 'currentDate')
        )->setPaper('A4', 'portrait');

        // return $pdf->download("Porforma-Invoice-{$porformaInvoice->id}.pdf");
        return $pdf->stream("Porforma-Invoice-{$porformaInvoice->id}.pdf");
        
        
        
    }
    
    public function showErrorPage(Request $request){
        return view('admin-main.admin.taxInvoice.404page');
    }

}
