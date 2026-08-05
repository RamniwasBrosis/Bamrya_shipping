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
use App\Models\Accounts\AccountOnAccount;
use App\Models\CompanyBranch;

class SalesOutstandingController extends Controller
{

    public $company_id ;

    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->company_id = Auth::user()->company_id;
            return $next($request);
        });
    }


    public function index()
    {
        $branches = CompanyBranch::where('company_id', $this->company_id)
            ->where('status',1)
            ->orderBy('branch_name')
            ->get();
        $parties = MasterImportParty::where('company_id', $this->company_id)->where('party_type', 10)->get();
        return view('admin-main.admin.salesOutstanding.first', compact('parties','branches'));
    }

    public function preview(Request $request)
    {
        $branch_id = $request->branch_id;
        $sales_invoices = AccountSaleInvoice::with(['partyName', 'chargesContainer']) // important
        ->where('company_id', $this->company_id)
        ->when($branch_id != 'all', function ($q) use ($branch_id) {
            $q->where('branch_id', $branch_id);
        })
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

        $get_round_of_amounts = AccountOnAccount::where('company_id', $this->company_id)->where('party_id', $request->party_id)->get();
        $round_of_amount = 0;
        $total_get_amount_by_party = 0;
        foreach($get_round_of_amounts as $amount){
            $round_of_amount += $amount->round_of_amount;
            $total_get_amount_by_party += $amount->amount;
        }


        $html = '
            <h4 style="text-align:center;">Outstanding Report - Sales Invoice &nbsp;&nbsp;&nbsp;(Dated - ' . now()->format('d/m/Y') . ')</h4>
           <div>
                <div class="dropdown mb-3">
                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        Download
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="'.route('sales-outstanding.download', ['format' => 'pdf', 'id' => $request->party_id, 'branch_id' => $request->branch_id,]).'" target="_blank">Download PDF</a></li>
                        <li><a class="dropdown-item" href="'.route('sales-outstanding.download', ['format' => 'excel', 'id' => $request->party_id, 'branch_id' => $request->branch_id,]) .'" target="_blank">Download Excel</a></li>
                        <li><a class="dropdown-item" href="'.route('sales-outstanding.download', ['format' => 'word', 'id' => $request->party_id, 'branch_id' => $request->branch_id,]) .'" target="_blank">Download Word</a></li>
                    </ul>
                </div>
           </div>

            <div style="overflow-x:auto; width:100%;">
            <table border="1" width="100%" cellspacing="0" cellpadding="5" style="border-collapse: collapse; width:100%; white-space: nowrap;" class="table table-bordered table-striped">
                <thead style="background-color: #d2ebf9;">
                    <tr>
                        <th>Job No</th>
                        <th>Branch</th>
                        <th>Inv No</th>
                        <th>Party Name</th>
                        <th>Port name</th>
                        <th>inv type</th>

                        <th>Inv Date</th>
                        <th>Invoice Amt</th>
                        <th>Amount Received</th>
                        <th>Outstanding Amount</th>
                        <th>Credit Amount</th>
                    </tr>
                </thead>
                <tbody>'
            ;

            $totalInvoiceAmt = 0;
            $totalRecievedAmt = 0;
            $totalOutstandingAmt = 0;
            $credit_amount = 0;

            foreach ($sales_invoices as $item) {

                // echo "<pre>";
                // print_r($item);
                // exit();

                $invoice_amount = 0;
                foreach($item['chargesContainer'] as $res){
                    $invoice_amount = $invoice_amount + $res->total;
                }


                $totalInvoiceAmt += $invoice_amount;
                $totalRecievedAmt += $item->recieved_amount;
                $totalOutstandingAmt += $item->outstanding_amount;

                if($item->recieved_amount == null || $item->recieved_amount <= 0){
                    $totalOutstandingAmt += $invoice_amount;
                }


                $invoiceAmt = number_format($item->amount ?? 0, 2);
                $amountReceived = number_format($item->amount_received ?? 0, 2);
                $outstandingAmt = number_format(($item->invoice_amount - $item->amount_received), 2);
                $days = \Carbon\Carbon::parse($item->invoice_date)->diffInDays(now());
                $html .= '<tr>
                    <td>'.( $item->operationJob->full_job_no ?? '--') .'</td>
                    <td>'.( $item->branch->branch_name ?? '--') .'</td>
                    <td>'. ($item->invoice_no  ?? '--') .'</td>
                    <td>'. ($item->partyName->party_name ?? '--') .'</td>
                    <td>'. ($item->pod ?? '--') .'</td>
                    <td>'. ($item->invoice_type ?? '--') .'</td>

                    <td>'. ($item->invoice_date ? \Carbon\Carbon::parse($item->invoice_date)->format('d-m-Y') : '') .'</td>
                    <td align="right">'.( round($invoice_amount) ?? '--' ).'</td>
                    <td align="right">'. ($item->recieved_amount ?? 00) .'</td>
                    <td align="right" style="color:red;"><strong>'
                        . (
                            $round_of_amount
                                ? '0.00'
                                : (
                                    $item->recieved_amount == 0
                                        ? ""
                                        : round(($item->outstanding_amount ?? 0))
                                  )
                          ) .
                    '</strong></td>
                    <td></td>
                </tr>';
            }

            if ($total_get_amount_by_party > $totalInvoiceAmt) {
                $credit_amount = $total_get_amount_by_party - $totalInvoiceAmt;
                // echo $credit_amount; exit();

                if (!empty($round_of_amount)) {
                    $credit_amount += $round_of_amount;
                }
            }



        $html .= '
            <tr style="font-weight: bold; background-color: #f9f9f9; text-align: center;">
                <td colspan="7">GRAND TOTAL :</td>
                <td align="right">' . round($totalInvoiceAmt) . '</td>
                <td align="right">' . round($totalRecievedAmt) . '</td>
                <td align="right">' . ($round_of_amount ?? '00' ) . '</td>
                <td align="right">' . ($credit_amount ? $credit_amount : 00) . '</td>
            </tr>';

        if($round_of_amount > 0){

            $closingAmt = $totalInvoiceAmt - ($round_of_amount + $total_get_amount_by_party);
            $html .= '
            <tr style="font-weight: bold; background-color: #f9f9f9; text-align: center;">
                <td colspan="2">Round of amount in this bill :</td>
                <td colspan="1"> INV AMT <br>' . round($totalInvoiceAmt) . '</td>
                <td colspan="1"> - </td>
                <td colspan="1"> ROUND OF AMT <br>' . round($round_of_amount) . '</td>
                <td colspan="1"> + </td>
                <td colspan="1"> RECEIVED AMT <br>' . round($total_get_amount_by_party) . '</td>
                <td colspan="1"> = </td>
                <td colspan="1"> Closing AMT <br>' . round($closingAmt) . '</td>
            </tr>';
        }

        $html .= '</tbody></table> </div>';
        $html .= '<div class="mt-3">' . $sales_invoices->withQueryString()->links('pagination::bootstrap-5') . '</div>';



        return response()->json(['html' => $html]);
    }

    public function download(Request $request, $format)
    {
        // $query = AccountSaleInvoice::where('company_id', $this->company_id)->get();

        $sales_invoices = AccountSaleInvoice::with(['partyName', 'chargesContainer'])
        ->where('company_id', $this->company_id)
        ->when($request->branch_id != 'all', function ($q) use ($request) {
            $q->where('branch_id', $request->branch_id);
        })
        // ->where('billing_party_id', $id)
        ->orderBy('created_at', 'desc')
        ->get();

        $get_round_of_amounts = AccountOnAccount::where('company_id', $this->company_id)->get();
        $round_of_amount = 0;
        $total_get_amount_by_party = 0;
        foreach($get_round_of_amounts as $amount){
            $round_of_amount += $amount->round_of_amount;
            $total_get_amount_by_party += $amount->amount;
        }

        if ($format == 'pdf') {
            $html = View::make('admin-main.admin.salesOutstanding.report', compact('sales_invoices', 'round_of_amount', 'total_get_amount_by_party'))->render();

            $dompdf = new Dompdf();
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'landscape');
            $dompdf->render();
            return response($dompdf->output(), 200)
                    ->header('Content-Type', 'application/pdf')
                    ->header('Content-Disposition', 'attachment; filename="repost.pdf"');
        }

        if ($format == 'excel') {
            return Excel::download(new SalesOutstandingExport($sales_invoices), 'Sales-Outstanding.xlsx');
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
