<?php

namespace App\Http\Controllers\AdminMain\Reports;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\MasterImportParty;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Accounts\AccountPurchasePayment;
use App\Models\Accounts\AccountReceiptPaymentDetail;
use App\Models\MasterParty;
use Dompdf\Dompdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReceiptListExport;
use Illuminate\Support\Facades\View;
use App\Models\Company;

class PurchaseReportController extends Controller
{
    public $company_id ;

    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->company_id = Auth::user()->company_id;
            return $next($request);
        });
    }
    
    public function listpurhcasePayment()
    {
        $purchase = AccountPurchasePayment::with('partyName')
            ->where('company_id', $this->company_id)
            ->get();
    
        // Get unique parties
        $uniqueParties = $purchase->pluck('partyName')->unique('id')->values();
    
        return view('admin-main.admin.purchasePaymentReport.first', compact('uniqueParties'));
    }
    
    public function preview(Request $request)
    {
        $query = AccountPurchasePayment::with('partyName')
            ->where('company_id', $this->company_id);
    
        // Filter by party
        if ($request->filled('billing_party_id')) {
            $query->where('billing_party_id', $request->billing_party_id);
        }
    
        // Filter by voy_no
        if ($request->filled('voy_no')) {
            $query->where('voy_no', 'LIKE', "%{$request->voy_no}%");
        }
    
        $receipt_lists = $query->orderBy('created_at', 'desc')->paginate(25);
    
        $firstParty = $receipt_lists->first()?->partyName;
        $partyName = $firstParty->party_name ?? 'Party';
        $partyAddress = $firstParty->address_line1 ?? 'Address';
        $partyCity = $firstParty->city ?? 'City';
        
        $company = Company::with(['companySetting', 'companyBranch'])
            ->where('id', $this->company_id)
            ->first();
        
        $logoPath = $company->logo
            ? public_path('uploads/company_logo/' . $company->logo)
            : public_path('images/default-logo.png');
    
        $html = '
            <h2 style="text-align: center;">'.($company->company_name).'</h2>
            <p style="text-align: center;">
                '.($company->address).'<br>
                Gstin No: '.($company->companySetting->gstin_no).' &nbsp; Pan: '.($company->companySetting->pan_no).'<br>
                Email: '.($company->company_email).'
            </p>
            <hr>
            <h2 style="text-align: center;margin-top: -20px;">'.$partyName.'</h2>
            <h4 style="text-align: center;">Ledger Account</h4>
            <p style="text-align: center;">'.$partyAddress.'<br>'.$partyCity.'</p>
            <hr>
        ';
        
        $html .='
            <div class="d-flex justify-content-between">
                <div class="">
                    
                </div>
                <div>
                    <div class="dropdown mb-3">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            Download
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="'.route('receipt-list.download', ['format' => 'pdf']).'" target="_blank">Download PDF</a></li>
                            <li><a class="dropdown-item" href="'.route('receipt-list.download', ['format' => 'excel']) .'" target="_blank">Download Excel</a></li>
                            <li><a class="dropdown-item" href="'.route('receipt-list.download', ['format' => 'word']) .'" target="_blank">Download Word</a></li>
                        </ul>
                    </div>
                </div>
                
            </div>';
    
        $html .= '
            <table border="1" width="100%" cellspacing="0" cellpadding="5" style="border-collapse: collapse;">
                <thead>
                    <tr>
                        <th>Receipt Date</th>
                        <th>Party Name</th>
                        <th>Invoice Type</th>
                        <th>Invoice No</th>
                        <th>Debit</th>
                        <th>Credit</th>
                    </tr>
                </thead>
                <tbody>
        ';
    
        $totalDebit = 0;
        $totalCredit = 0;
    
        foreach ($receipt_lists as $item) {
            // Debit: Sales or Payment, Credit: Receipt
            if ($item->invoice_type === 'Journal') {
                $debit = $item->amount;
                $credit = 0;
                $totalDebit += $debit;
            
            } elseif ($item->invoice_type === 'Purchase') {
                $debit = 0;
                $credit = $item->amount;
                $totalCredit += $credit;
            
            } else {
                $debit = 0;
                $credit = 0;
            }
    
            $html .= '
                <tr>
                    <td>'.$item->receipt_date.'</td>
                    <td>'.($item->partyName->party_name ?? '-').'</td>
                    <td>'.$item->invoice_type.'</td>
                    <td>'.$item->invoice_no.'</td>
                    <td>'.($debit ? number_format($debit, 2) : '-').'</td>
                    <td>'.($credit ? number_format($credit, 2) : '-').'</td>
                </tr>
            ';
        }
    
        $closingBalance = $totalCredit - $totalDebit;
     
        $html .= '
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4"><b>Total</b></td>
                        <td><b>'.number_format($totalDebit, 2).'</b><hr></td>
                        <td><b>'.number_format($totalCredit, 2).'</b><hr></td>
                    </tr>
                    <tr>
                        <td colspan="4"><b>Closing Balance</b></td>
                        <td colspan="" style="text-align: ;"><b>'.number_format($closingBalance, 2).'</b></td>
                    </tr>
                </tfoot>
            </table>
        ';
    
        return response()->json(['html' => $html]);
    }
    
}
