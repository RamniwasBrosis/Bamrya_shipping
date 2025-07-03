<?php

namespace App\Http\Controllers\AdminMain\Reports;

use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\MasterImportParty;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PurchaseLedgerExport;
use App\Models\Accounts\AccountSaleInvoice;

class ReceiptLedgerController extends Controller
{
    public $company_id ;

    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->company_id = Auth::user()->company_id;
            return $next($request);
        });
    }
    
    public function index(){
        $parties = MasterImportParty::where('company_id', $this->company_id)->get();
        return view('admin-main.admin.receiptLedger.first', compact('parties'));
    }

    public function preview(Request $request)
    {
        $invoices = AccountSaleInvoice::with('partyName') // important
        ->where('company_id', $this->company_id)
        ->when($request->filled('from_date') && $request->filled('to_date'), function ($q) use ($request) {
            $from = Carbon::parse($request->from_date)->startOfDay();   // 00:00:00
            $to   = Carbon::parse($request->to_date)->endOfDay();       // 23:59:59
            $q->whereBetween('created_at', [$from, $to]);
        })
        ->when($request->filled('party_id'), function ($q) use ($request) {
            $q->where('billing_party_id', $request->party_id);
        })
        ->orderBy('created_at', 'desc')
        ->paginate(25);


        $html = '
            <h4 style="text-align:center; font-weight:bold;">PURCHASE LEDGER REPORT</h4>
            <div class="d-flex justify-content-between">
                <div>
                    <p style="text-align:left; font-weight:bold;">From Date : ' . $request->from_date . ' To : ' . $request->to_date . '</p>
                </div>
                <div>
                    <div>
                        <div class="dropdown mb-3">
                            <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                Download
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="'.route('receipt-ledger.download', ['format' => 'pdf']).'" target="_blank">Download PDF</a></li>
                                <li><a class="dropdown-item" href="'.route('receipt-ledger.download', ['format' => 'excel']) .'" target="_blank">Download Excel</a></li>
                                <li><a class="dropdown-item" href="'.route('receipt-ledger.download', ['format' => 'word']) .'" target="_blank">Download Word</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            

            <h5 style="text-align:center;">Purchase Receipt</h5>

            <table border="1" width="100%" cellspacing="0" cellpadding="5" style="border-collapse: collapse; font-size: 13px;" class="table">
                <thead>
                    <tr style="background-color: #f4e9d8; text-align: center; font-weight: bold;">
                        <th>Sr. No.</th>
                        <th>Invoice Date</th>
                        <th>Party Name</th>
                        <th>Inv. No</th>
                        <th>Debit<br>Amount</th>
                        <th>Credit<br>Actual Paid Amt</th>
                        <th>Credit<br>TDS</th>
                        <th>Receipt No</th>
                        <th>Receipt Date</th>
                        <th>NEFT Details</th>
                        <th>NEFT Date</th>
                        <th>Bank Name</th>
                        <th>Paid Party</th>
                    </tr>
                </thead>
                <tbody>';

        $totalDebit = $totalPaid = $totalTDS = 0;
        $srNo = ($invoices->currentPage() - 1) * $invoices->perPage() + 1;

        foreach ($invoices as $item) {
            $invoiceDate = optional($item->invoice_date)->format('d-m-Y') ?? '--';
            $receiptDate = optional($item->receipt_date)->format('d-m-Y') ?? '--';
            $neftDate = optional($item->neft_date)->format('d-m-Y') ?? '--';
            $debit = $item->amount ?? 0;
            $paid = $item->actual_paid_amount ?? 0;
            $tds = $item->tds_amount ?? 0;

            $totalDebit += $debit;
            $totalPaid += $paid;
            $totalTDS += $tds;

            $html .= '<tr style="text-align: center;">
                <td>' . $srNo++ . '</td>
                <td>' . $invoiceDate . '</td>
                <td>' . ($item->partyName->party_name ?? '--') . '</td>
                <td>' . ($item->invoice_no ?? '--') . '</td>
                <td align="right">' . number_format($debit, 2) . '</td>
                <td align="right">' . number_format($paid, 2) . '</td>
                <td align="right">' . number_format($tds, 2) . '</td>
                <td>' . ($item->receipt_no ?? '--') . '</td>
                <td>' . $receiptDate . '</td>
                <td>' . ($item->neft_details ?? '--') . '</td>
                <td>' . $neftDate . '</td>
                <td>' . ($item->bank_name ?? '--') . '</td>
                <td>' . ($item->paid_party ?? '--') . '</td>
            </tr>';
        }

        $html .= '
            <tr style="font-weight: bold; background-color: #f9f9f9; text-align: center;">
                <td colspan="4">Total :</td>
                <td align="right">' . number_format($totalDebit, 2) . '</td>
                <td align="right">' . number_format($totalPaid, 2) . '</td>
                <td align="right">' . number_format($totalTDS, 2) . '</td>
                <td colspan="6"></td>
            </tr>
            <tr style="font-weight: bold; text-align: left;">
                <td colspan="13">Balance Outstanding : ' . number_format($totalDebit - $totalPaid - $totalTDS, 2) . '</td>
            </tr>
        </tbody>
        </table>';

        $html .= '<div class="mt-3">' . $invoices->withQueryString()->links('pagination::bootstrap-5') . '</div>';

        return response()->json(['html' => $html]);

    }

    public function download($format)
    {
        $query = AccountSaleInvoice::where('company_id', $this->company_id)->get();

        if ($format == 'pdf') {
            $html = View::make('admin-main.admin.receiptLedger.report', compact('query'))->render();

            $dompdf = new Dompdf();
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'landscape');
            $dompdf->render();
            return response($dompdf->output(), 200)
                    ->header('Content-Type', 'application/pdf')
                    ->header('Content-Disposition', 'attachment; filename="repost.pdf"');
        }

        if ($format == 'excel') {
            return Excel::download(new PurchaseLedgerExport($query), 'Purchase-TDS-report.xlsx');
        }

        if ($format == 'word') {
            $html = View::make('admin-main.admin.receiptLedger.report', compact('query'))->render();
            return response($html)
                ->header('Content-Type', 'application/msword')
                ->header('Content-Disposition', 'attachment; filename="loading-list.doc"');
        }

        return redirect()->back()->with('error', 'Invalid format selected');
    }


}
