<?php

namespace App\Http\Controllers\AdminMain\Reports;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\MasterImportParty;
use App\Models\Company;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Accounts\AccountReceipt;
use App\Models\Accounts\AccountReceiptPaymentDetail;
use App\Models\MasterParty;
use Dompdf\Dompdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReceiptListExport;
use Illuminate\Support\Facades\View;

class ReceiptReportController extends Controller
{
    
    public $company_id ;

    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->company_id = Auth::user()->company_id;
            return $next($request);
        });
    }
    
    public function listReceipt()
    {
        $receipts = AccountReceipt::with('billingParty')
            ->where('company_id', $this->company_id)
            ->get();
    
        // Get unique parties
        $uniqueParties = $receipts->pluck('billingParty')->unique('id')->values();
    
        return view('admin-main.admin.receiptReport.first', compact('uniqueParties'));
    }
    
    // mourya
    public function preview(Request $request)
    {
        $query = AccountReceipt::with('billingParty')
            ->where('company_id', $this->company_id);
    
        if ($request->filled('billing_party_id')) {
            $query->where('billing_party_id', $request->billing_party_id);
        }
    
        if ($request->filled('voy_no')) {
            $query->where('voy_no', 'LIKE', "%{$request->voy_no}%");
        }
    
        $receipt_lists = $query->orderBy('created_at', 'desc')->get();
    
        $firstParty = $receipt_lists->first()?->billingParty;
        $partyName = $firstParty->party_name ?? 'Party';
        $partyAddress = $firstParty->address_line1 ?? 'Address';
        $partyCity = $firstParty->city ?? 'City';
        
        $company = Company::with(['companySetting', 'companyBranch'])
            ->where('id', $this->company_id)
            ->first();
        
        $logoPath = $company->logo
            ? public_path('uploads/company_logo/' . $company->logo)
            : public_path('images/default-logo.png');
    
        // Render blade layout
        $reportHtml = view('admin-main.admin.receiptReport.report', compact(
            'receipt_lists', 'partyName', 'partyAddress', 'partyCity', 'company', 'logoPath'
        ))->render();
    
        // Add download buttons above report
        $downloadButtons = '
            <div class="d-flex justify-content-end mb-3">
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        Download
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="'.route('receipt-list.download', ['format' => 'pdf']).'" target="_blank">Download PDF</a></li>
                        <li><a class="dropdown-item" href="'.route('receipt-list.download', ['format' => 'excel']).'" target="_blank">Download Excel</a></li>
                        <li><a class="dropdown-item" href="'.route('receipt-list.download', ['format' => 'word']).'" target="_blank">Download Word</a></li>
                    </ul>
                </div>
            </div>
        ';
    
        // Final HTML sent to AJAX preview
        return response()->json(['html' => $downloadButtons . $reportHtml]);
    }
    
    // mourya
    public function download(Request $request, $format)
    {
        $query = AccountReceipt::with('billingParty')
            ->where('company_id', $this->company_id);
    
        if ($request->filled('billing_party_id')) {
            $query->where('billing_party_id', $request->billing_party_id);
        }
    
        $receipt_lists = $query->orderBy('created_at', 'desc')->get();
        
        $company = Company::with(['companySetting', 'companyBranch'])
            ->where('id', $this->company_id)
            ->first();
        
        $logoPath = $company->logo
            ? public_path('uploads/company_logo/' . $company->logo)
            : public_path('images/default-logo.png');
    
        // $party = MasterImportParty::find($request->billing_party_id);
    
        // $partyName = $party->party_name ?? 'Party';
        // $partyAddress = $party->address_line1 ?? '';
        // $partyCity = $party->city ?? '';
        
        $firstParty = $receipt_lists->first()?->billingParty;
        $partyName = $firstParty->party_name ?? 'Party';
        $partyAddress = $firstParty->address_line1 ?? 'Address';
        $partyCity = $firstParty->city ?? 'City';
    
        $html = view('admin-main.admin.receiptReport.report', compact(
            'receipt_lists','partyName','partyAddress','partyCity', 'company', 'logoPath'
        ))->render();
        
        // PDF
        if($format === 'pdf'){
            $dompdf = new Dompdf();
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4','portrait');
            $dompdf->render();
            return response($dompdf->output(),200)
                ->header('Content-Type','application/pdf')
                ->header('Content-Disposition','attachment; filename="receipt-list.pdf"');
        }
    
        // WORD
        if($format === 'word'){
            return response($html)
                ->header('Content-Type','application/msword')
                ->header('Content-Disposition','attachment; filename="receipt-list.doc"');
        }
    
        // EXCEL
        if($format === 'excel'){
            return response($html)
                ->header('Content-Type','application/vnd.ms-excel')
                ->header('Content-Disposition','attachment; filename="receipt-list.xls"');
        }
    
        return back()->with('error','Invalid format');
    }



}
