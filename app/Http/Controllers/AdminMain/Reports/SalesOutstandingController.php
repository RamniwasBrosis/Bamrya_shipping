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
use App\Exports\SalesOutstandingExport;
use App\Models\Accounts\AccountSaleInvoice;

class SalesOutstandingController extends Controller
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
        return view('admin-main.admin.salesOutstanding.first', compact('parties'));
    }

    public function preview(Request $request)
    {
        $sales_invoices = AccountSaleInvoice::with('partyName') // important
        ->where('company_id', $this->company_id)
        ->when($request->filled('from_date') && $request->filled('to_date'), function ($q) use ($request) {
            $from = Carbon::parse($request->from_date)->startOfDay();   // 00:00:00
            $to   = Carbon::parse($request->to_date)->endOfDay();
            $q->whereBetween('created_at', [$from, $to]);
        })
        ->when($request->filled('party_id'), function ($q) use ($request) {
            $q->where('billing_party_id', $request->party_id);
        })
        ->orderBy('created_at', 'desc')
        ->paginate(25);


        $html = '
            <h4 style="text-align:center;">Outstanding Report - Sales Invoice &nbsp;&nbsp;&nbsp;(Dated - ' . now()->format('d/m/Y') . ')</h4>
           <div>
                <div class="dropdown mb-3">
                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        Download
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="'.route('sales-outstanding.download', ['format' => 'pdf']).'" target="_blank">Download PDF</a></li>
                        <li><a class="dropdown-item" href="'.route('sales-outstanding.download', ['format' => 'excel']) .'" target="_blank">Download Excel</a></li>
                        <li><a class="dropdown-item" href="'.route('sales-outstanding.download', ['format' => 'word']) .'" target="_blank">Download Word</a></li>
                    </ul>
                </div>
           </div>

            <table border="1" width="100%" cellspacing="0" cellpadding="5" style="border-collapse: collapse;" class="table">
                <thead style="background-color: #d2ebf9;">
                    <tr>
                        <th>Party Name</th>
                        <th>Job No</th>
                        <th>Port name</th>
                        <th>HBLNo</th>
                        <th>inv type</th>
                        <th>Inv No</th>
                        <th>Inv Date</th>
                        <th>Invoice Amt</th>
                        <th>Amount Received</th>
                        <th>Outstanding Amount</th>
                        <th>Days</th>
                    </tr>
                </thead>
                <tbody>'              
            ;
                
            foreach ($sales_invoices as $item) {
                $invoiceAmt = number_format($item->amount ?? 0, 2);
                $amountReceived = number_format($item->amount_received ?? 0, 2);
                $outstandingAmt = number_format(($item->invoice_amount - $item->amount_received), 2);
                $invoiceDate = optional($item->invoice_date)->format('d/m/Y');
                $days = \Carbon\Carbon::parse($item->invoice_date)->diffInDays(now());

                $html .= '<tr>
                    <td>'. ($item->partyName->party_name ?? '--') .'</td>
                    <td>'.( $item->job_no ?? '--') .'</td>
                    <td>'. ($item->pod ?? '--') .'</td>
                    <td>'. ($item->hbl_no ?? '--') .'</td>
                    <td>'. ($item->invoice_type ?? '--') .'</td>
                    <td>'. ($item->invoice_no  ?? '--') .'</td>
                    <td>'. ($invoiceDate ?? '--') .'</td>
                    <td align="right">'.( $invoiceAmt ?? '--' ).'</td>
                    <td align="right">'. ($amountReceived ?? '--') .'</td>
                    <td align="right" style="color:red;"><strong>'. ($outstandingAmt ?? '--' ).'</strong></td>
                    <td align="center">'.( $days ?? '--') .'</td>
                </tr>';
            }

        $html .= '</tbody></table>';
        $html .= '<div class="mt-3">' . $sales_invoices->withQueryString()->links('pagination::bootstrap-5') . '</div>';



        return response()->json(['html' => $html]);
    }

    public function download($format)
    {
        $query = AccountSaleInvoice::where('company_id', $this->company_id)->get();

        if ($format == 'pdf') {
            $html = View::make('admin-main.admin.salesOutstanding.report', compact('query'))->render();

            $dompdf = new Dompdf();
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'landscape');
            $dompdf->render();
            return response($dompdf->output(), 200)
                    ->header('Content-Type', 'application/pdf')
                    ->header('Content-Disposition', 'attachment; filename="repost.pdf"');
        }

        if ($format == 'excel') {
            return Excel::download(new SalesOutstandingExport($query), 'Sales-Outstanding.xlsx');
        }

        if ($format == 'word') {
            $html = View::make('admin-main.admin.salesOutstanding.report', compact('query'))->render();
            return response($html)
                ->header('Content-Type', 'application/msword')
                ->header('Content-Disposition', 'attachment; filename="loading-list.doc"');
        }

        return redirect()->back()->with('error', 'Invalid format selected');
    }

}
