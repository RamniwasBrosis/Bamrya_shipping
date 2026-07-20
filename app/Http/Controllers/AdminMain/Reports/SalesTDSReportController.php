<?php

namespace App\Http\Controllers\AdminMain\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Carbon\Carbon;
use Dompdf\Dompdf;
use App\Models\MasterImportParty;
use App\Models\MasterParty;

use App\Exports\SalesOutstandingExport;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PurchaseTDSReportExport;
use App\Models\Accounts\AccountSaleInvoice;

class SalesTDSReportController extends Controller
{
    public $company_id ;

    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->company_id = Auth::user()->company_id;
            return $next($request);
        });
    }

    
    public function index(){

        $parties = MasterImportParty::where('company_id', $this->company_id)->where('party_type', 10)->get();
        $sales_invoices = AccountSaleInvoice::where('company_id', $this->company_id)
                            ->whereNotNull('full_job_no')
                            ->select('full_job_no')
                            ->distinct()
                            ->orderBy('full_job_no')
                            ->get();
        return view('admin-main.admin.salesTDSReport.first', compact(['parties','sales_invoices']));
    }

    public function preview(Request $request)
    {
        $sales_invoices = AccountSaleInvoice::with(['partyName', 'chargesContainer']) // important
        ->where('company_id', $this->company_id)
        ->when($request->filled('from_date') && $request->filled('to_date'), function ($q) use ($request) {
            $from = Carbon::parse($request->from_date)->startOfDay();   // 00:00:00
            $to   = Carbon::parse($request->to_date)->endOfDay();
            $q->whereBetween('created_at', [$from, $to]);
        })
        ->when($request->filled('party_id'), function ($q) use ($request) {
            $q->where('billing_party_id', $request->party_id);
        })
        ->when($request->filled('full_job_no'), function ($q) use ($request) {
            $q->where('full_job_no', $request->full_job_no);
        })
        ->orderBy('created_at', 'desc')
        ->paginate(25);
        
        $html = '
            <h4 style="text-align:center;">Sales Invoice</h4>
           <div>
                <div class="dropdown mb-3">
                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        Download
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="'.route('sales-tds-report.download', [
                            'format'      => 'pdf',
                            'party_id'    => $request->party_id,
                            'full_job_no' => $request->full_job_no,
                            'from_date'   => $request->from_date,
                            'to_date'     => $request->to_date,
                        ]).'" target="_blank">Download PDF</a></li>
                        
                        <li><a class="dropdown-item" href="'.route('sales-tds-report.download', [
                            'format'      => 'excel',
                            'party_id'    => $request->party_id,
                            'full_job_no' => $request->full_job_no,
                            'from_date'   => $request->from_date,
                            'to_date'     => $request->to_date,
                        ]).'" target="_blank">Download Excel</a></li>
                        
                        <li><a class="dropdown-item" href="'.route('sales-tds-report.download', [
                            'format'      => 'word',
                            'party_id'    => $request->party_id,
                            'full_job_no' => $request->full_job_no,
                            'from_date'   => $request->from_date,
                            'to_date'     => $request->to_date,
                        ]).'" target="_blank">Download Word</a></li>
                    </ul>
                </div>
           </div>

            <table border="1" width="100%" cellspacing="0" cellpadding="5" style="border-collapse: collapse;" class="table">
                <thead style="background-color: #d2ebf9;">
                    <tr style="background-color: #f4e9d8; text-align: center; font-weight: bold;">
                        <th>Party Name</th>
                        <th>Job No</th>
                        <th>Invoice No</th>
                        <th>Inv DT</th>
                        <th>GSTIN No</th>
                        <th>Taxable Amount</th>
                        <th>GST Amount</th>
                        <th>Total Amount</th>
                        
                    </tr>
                </thead>
                <tbody>'              
            ;
                
            // Totals
            $totalBill = 0;
            $totalBasic = 0;
            $totalTds = 0;
            $totalPayable = 0;
            $totalTaxableAmount = 0;
            $totalGstAmount = 0;

            foreach ($sales_invoices as $item) {
                $charges = $item['chargesContainer'];
                if ($charges->isEmpty()) continue;
            
                $cgstAmount  = $charges->sum('cgst');
                $sgstAmount  = $charges->sum('sgst');
                $igstAmount  = $charges->sum('igst');
                $gstAmount = $igstAmount + $sgstAmount + $cgstAmount;
                $billAmount  = $charges->sum('amount');
                $taxableAmount  = $charges->sum('freight');
                $basicAmount = $charges->sum('basic_amount'); 
                $tdsAmt      = $charges->sum('tds_amount');
                $tdsPercent  = $charges->avg('tds'); // Average TDS %
                $payableAmt  = $billAmount - $tdsAmt;
                // $payableAmt  = $charges->sum('total');
                $panNo       = $item->partyName->gstin ?? '--';
       
                $totalBill     += $billAmount;
                // $totalBasic    += $basicAmount;
                $totalTds      += $tdsAmt;
                $totalPayable  += $payableAmt;
                $totalTaxableAmount  += $taxableAmount;
                $totalGstAmount += $gstAmount;
            
                $html .= '<tr style="text-align: center;">
                    <td>' . ($item->partyName->party_name ?? '--') . '</td>
                    <td>' . ($item->operationJob->job_no ?? '--') . '</td>
                    <td>' . ($item->invoice_no ?? '--') . '</td>
                    <td>'. ($item->invoice_date ? \Carbon\Carbon::parse($item->invoice_date)->format('d-m-Y') : '' ).'</td>
                    <td>' . $panNo . '</td>
                    <td align="right">' . number_format($taxableAmount, 2) . '</td>
                    <td align="right">' . number_format($gstAmount, 2) . '</td>
                    <td align="right">' . number_format($billAmount, 2) . '</td>
                </tr>';
            }


        $html .= '
        <tr style="font-weight: bold; background-color: #f9f9f9; text-align: center;">
            <td align="right" colspan="5">GRAND TOTAL :</td>
            <td align="right">' . number_format($totalTaxableAmount, 2) . '</td>
            <td align="right">' . number_format($totalGstAmount, 2) . '</td>
            <td align="right">' . number_format(round($totalBill), 2) . '</td>
            <td></td>
        </tr>
        </tbody></table>';
        $html .= '<div class="mt-3">' . $sales_invoices->withQueryString()->links('pagination::bootstrap-5') . '</div>';


        return response()->json(['html' => $html]);
    }

    public function download($format, Request $request)
    {
        $query = AccountSaleInvoice::with(['partyName', 'chargesContainer'])
            ->where('company_id', $this->company_id)
    
            ->when($request->filled('party_id'), function ($q) use ($request) {
                $q->where('billing_party_id', $request->party_id);
            })
    
            ->when($request->filled('full_job_no'), function ($q) use ($request) {
                $q->where('full_job_no', $request->full_job_no);
            })
    
            ->when($request->filled('from_date') && $request->filled('to_date'), function ($q) use ($request) {
                $q->whereBetween('created_at', [
                    Carbon::parse($request->from_date)->startOfDay(),
                    Carbon::parse($request->to_date)->endOfDay(),
                ]);
            })
    
            ->get();

        if ($format == 'pdf') {
            $html = View::make('admin-main.admin.salesTDSReport.report', compact('query'))->render();

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
            
            $html = View::make('admin-main.admin.salesTDSReport.report', compact('query'))->render();
            return response($html)
                ->header('Content-Type', 'application/msword')
                ->header('Content-Disposition', 'attachment; filename="loading-list.doc"');
        }

        return redirect()->back()->with('error', 'Invalid format selected');
    }
}
