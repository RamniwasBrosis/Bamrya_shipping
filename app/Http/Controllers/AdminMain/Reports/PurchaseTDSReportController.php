<?php

namespace App\Http\Controllers\AdminMain\Reports;

use Carbon\Carbon;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use App\Models\MasterImportParty;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PurchaseTDSReportExport;
use App\Models\Accounts\AccountPurchaseInvoice;

class PurchaseTDSReportController extends Controller
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
        return view('admin-main.admin.purchaseTDSReport.first', compact('parties'));
    }

    public function preview(Request $request)
    {
        $invoices = AccountPurchaseInvoice::with('partyName') // important
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
            <h4 style="text-align:center; font-weight:bold;">PURCHASE TDS REPORT <span style="font-size:14px;">(Dated - ' . now()->format('d/m/Y') . ')</span></h4>
            
            <div>
                <div class="dropdown mb-3">
                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        Download
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="'.route('purchase-tds-report.download', ['format' => 'pdf']).'" target="_blank">Download PDF</a></li>
                        <li><a class="dropdown-item" href="'.route('purchase-tds-report.download', ['format' => 'excel']) .'" target="_blank">Download Excel</a></li>
                        <li><a class="dropdown-item" href="'.route('purchase-tds-report.download', ['format' => 'word']) .'" target="_blank">Download Word</a></li>
                    </ul>
                </div>
            </div>

            <table border="1" width="100%" cellspacing="0" cellpadding="5" style="border-collapse: collapse;" class="table">
                <thead>
                    <tr style="background-color: #f4e9d8; text-align: center; font-weight: bold;">
                        <th>Party Name</th>
                        <th>Job No</th>
                        <th>Invoice No</th>
                        <th>INV DT</th>
                        <th>Bill Amount</th>
                        <th>Basic Amount</th>
                        <th>TDS AMT</th>
                        <th>TDS %</th>
                        <th>Payable Amt</th>
                        <th>PAN No</th>
                    </tr>
                </thead>
                <tbody>';

            // Totals
            $totalBill = 0;
            $totalBasic = 0;
            $totalTds = 0;
            $totalPayable = 0;

            foreach ($invoices as $item) {
                $billAmount = $item->amount ?? 0;
                $basicAmount = $item->basic_amount ?? 0;
                $tdsAmt = $item->tds_amount ?? 0;
                $tdsPercent = $item->tds ?? 0;
                $payableAmt = $billAmount - $tdsAmt;
                $panNo = $item->partyName->pan_no ?? '--';

                $totalBill += $billAmount;
                $totalBasic += $basicAmount;
                $totalTds += $tdsAmt;
                $totalPayable += $payableAmt;

                $html .= '<tr style="text-align: center;">
                    <td>' . ($item->partyName->party_name ?? '--') . '</td>
                    <td>' . ($item->job_no ?? '--') . '</td>
                    <td>' . ($item->invoice_no ?? '--') . '</td>
                    <td>' . optional($item->invoice_date)->format('d-m-Y') . '</td>
                    <td align="right">' . number_format($billAmount, 2) . '</td>
                    <td align="right">' . number_format($basicAmount, 2) . '</td>
                    <td align="right">' . number_format($tdsAmt, 2) . '</td>
                    <td>' . number_format($tdsPercent, 2) . '%</td>
                    <td align="right">' . number_format($payableAmt, 2) . '</td>
                    <td>' . $panNo . '</td>
                </tr>';
            }

        $html .= '
            <tr style="font-weight: bold; background-color: #f9f9f9; text-align: center;">
                <td colspan="4">GRAND TOTAL :</td>
                <td align="right">' . number_format($totalBill, 2) . '</td>
                <td align="right">' . number_format($totalBasic, 2) . '</td>
                <td align="right">' . number_format($totalTds, 2) . '</td>
                <td></td>
                <td align="right">' . number_format($totalPayable, 2) . '</td>
                <td></td>
            </tr>
        </tbody>
        </table>';

        $html .= '<div class="mt-3">' . $invoices->withQueryString()->links('pagination::bootstrap-5') . '</div>';

        return response()->json(['html' => $html]);
    }

    public function download($format)
    {
        $query = AccountPurchaseInvoice::where('company_id', $this->company_id)->get();

        if ($format == 'pdf') {
            $html = View::make('admin-main.admin.purchaseTDSReport.report', compact('query'))->render();

            $dompdf = new Dompdf();
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'landscape');
            $dompdf->render();
            return response($dompdf->output(), 200)
                    ->header('Content-Type', 'application/pdf')
                    ->header('Content-Disposition', 'attachment; filename="repost.pdf"');
        }

        if ($format == 'excel') {
            return Excel::download(new PurchaseTDSReportExport($query), 'Purchase-TDS-report.xlsx');
        }

        if ($format == 'word') {
            $html = View::make('admin-main.admin.purchaseTDSReport.report', compact('query'))->render();
            return response($html)
                ->header('Content-Type', 'application/msword')
                ->header('Content-Disposition', 'attachment; filename="loading-list.doc"');
        }

        return redirect()->back()->with('error', 'Invalid format selected');
    }

    
}
