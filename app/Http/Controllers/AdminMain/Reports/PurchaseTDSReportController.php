<?php

namespace App\Http\Controllers\AdminMain\Reports;

use Carbon\Carbon;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use App\Models\MasterImportParty;
use App\Models\Accounts\PurchaseParties;
use App\Models\MasterParty;
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

        $parties = PurchaseParties::where('company_id', $this->company_id)->get();
        $party_lists  = MasterParty::all();
        $invoices = AccountPurchaseInvoice::where('company_id', $this->company_id)
                            ->whereNotNull('full_job_no')
                            ->select('full_job_no')
                            ->distinct()
                            ->orderBy('full_job_no')
                            ->get();
        
        return view('admin-main.admin.purchaseTDSReport.first', compact(['parties', 'party_lists','invoices']));
    }

    public function preview(Request $request)
    {
        $invoices = AccountPurchaseInvoice::with(['partyName', 'chargesContainer']) // important
        ->where('company_id', $this->company_id)
        ->when($request->filled('from_date') && $request->filled('to_date'), function ($q) use ($request) {
            $from = Carbon::parse($request->from_date)->startOfDay();  
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
            <h4 style="text-align:center; font-weight:bold;">PURCHASE REPORT <span style="font-size:14px;"></span></h4>
            
            <div>
                <div class="dropdown mb-3">
                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        Download
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="'.route('purchase-tds-report.download', [
                            'format'      => 'pdf',
                            'party_id'    => $request->party_id,
                            'full_job_no' => $request->full_job_no,
                            'from_date'   => $request->from_date,
                            'to_date'     => $request->to_date,
                        ]).'" target="_blank">Download PDF</a></li>
                        
                        <li><a class="dropdown-item" href="'.route('purchase-tds-report.download', [
                            'format'      => 'excel',
                            'party_id'    => $request->party_id,
                            'full_job_no' => $request->full_job_no,
                            'from_date'   => $request->from_date,
                            'to_date'     => $request->to_date,
                        ]).'" target="_blank">Download Excel</a></li>
                        
                        <li><a class="dropdown-item" href="'.route('purchase-tds-report.download', [
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
                <thead>
                    <tr style="background-color: #f4e9d8; text-align: center; font-weight: bold;">
                        <th>Party Name</th>
                        <th>Job No</th>
                        <th>Invoice No</th>
                        <th>INV DT</th>
                        <th>GSTIN No</th>
                        <th>Taxable Amount</th>
                        <th>GST Amount</th>
                        <th>Total Amount</th>
                    </tr>
                </thead>
                <tbody>';

            // Totals
            $totalBill = 0;
            $totalBasic = 0;
            $totalTds = 0;
            $totalPayable = 0;
            $totalTaxableAmount = 0;
            $totalGstAmount = 0;

            foreach ($invoices as $item) {
                $charges = $item['chargesContainer'];
                if ($charges->isEmpty()) continue;
                
                $cgstAmount  = $charges->sum('cgst');
                $sgstAmount  = $charges->sum('sgst');
                $igstAmount  = $charges->sum('igst');
                $gstAmount = $igstAmount + $sgstAmount + $cgstAmount;
            
                $taxableAmount  = $charges->sum('freight');
                $payableAmt  = $taxableAmount + $gstAmount;
                
                $panNo       = $item->partyName->gstin ?? '--';

                $totalPayable  += $payableAmt;
                $totalTaxableAmount += $taxableAmount;
                $totalGstAmount += $gstAmount;
            
                $html .= '<tr style="text-align: center;">
                    <td>' . ($item->partyName->party_name ?? '--') . '</td>
                    <td>' . ($item->operationJob->job_no ?? '--') . '</td>
                    <td>' . ($item->invoice_no ?? '--') . '</td>
                    <td>'. ($item->invoice_date ? \Carbon\Carbon::parse($item->invoice_date)->format('d-m-Y') : '' ).'</td>
                    <td>' . $panNo . '</td>
                    <td>' . number_format($taxableAmount, 2) . '</td>
                    <td>' . number_format($gstAmount, 2) . '</td>
                    <td>' . number_format($payableAmt, 2) . '</td>
                    
                </tr>';
            }

        $html .= '
            <tr style="font-weight: bold; background-color: #f9f9f9; text-align: center;">
                <td align="right" colspan="5">GRAND TOTAL :</td>
                <td>' . number_format($totalTaxableAmount, 2) . '</td>
                <td>' . number_format($totalGstAmount, 2) . '</td>
                <td>' . number_format(round($totalPayable), 2) . '</td>
                <td></td>
            </tr>
        </tbody>
        </table>';

        $html .= '<div class="mt-3">' . $invoices->withQueryString()->links('pagination::bootstrap-5') . '</div>';

        return response()->json(['html' => $html]);
    }

    public function download(Request $request, $format)
    {
        $query = AccountPurchaseInvoice::with(['partyName', 'chargesContainer'])
            ->where('company_id', $this->company_id)
    
            ->when($request->filled('from_date') && $request->filled('to_date'), function ($q) use ($request) {
                $from = Carbon::parse($request->from_date)->startOfDay();
                $to   = Carbon::parse($request->to_date)->endOfDay();
    
                $q->whereBetween('created_at', [$from, $to]);
            })
    
            ->when($request->filled('party_id'), function ($q) use ($request) {
                $q->where('billing_party_id', $request->party_id);
            })
    
            ->when($request->filled('full_job_no'), function ($q) use ($request) {
                $q->where('full_job_no', $request->full_job_no);
            })
    
            ->get();

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
            return Excel::download(new PurchaseTDSReportExport($query), 'Purchase-report.xlsx');
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
