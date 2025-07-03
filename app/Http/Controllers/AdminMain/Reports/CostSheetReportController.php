<?php

namespace App\Http\Controllers\AdminMain\Reports;

use Dompdf\Dompdf;
use Illuminate\Http\Request;
use App\Exports\CostSheetExport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Accounts\AccountSaleInvoice;
use App\Models\Accounts\AccountPurchaseInvoice;

class CostSheetReportController extends Controller
{

    public $company_id ;

    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->company_id = Auth::user()->company_id;
            return $next($request);
        });
    }
    
    public function index(){

        return view('admin-main.admin.costSheetReport.first');
    }

    public function preview(Request $request)
    {
        $request->validate([
            'job_no' => 'required',
        ]);

        $jobNo = $request->job_no;

        $sales = AccountSaleInvoice::where('job_no', $jobNo)->get(); // Receivables
        $purchases = AccountPurchaseInvoice::where('job_no', $jobNo)->get(); // Payables

        $totalReceivable = $sales->sum('amount');
        $totalPayable = $purchases->sum('amount');

        $netProfit = $totalReceivable - $totalPayable;
        $percentageProfit = $totalReceivable > 0 ? ($netProfit / $totalReceivable) * 100 : 0;

        $download = true;

        return response()->json([
            'html' => view('admin-main.admin.costSheetReport.report', compact(
                'sales', 'purchases', 'totalReceivable', 'totalPayable', 'netProfit', 'percentageProfit', 'download'
            ))->render()
        ]);
    }

    public function download($format, Request $request)
    {
        $jobNo = $request->job_no;
        $sales = AccountSaleInvoice::where('job_no', $jobNo)->get();
        $purchases = AccountPurchaseInvoice::where('job_no', $jobNo)->get();

        $totalReceivable = $sales->sum('amount');
        $totalPayable = $purchases->sum('amount');
        $netProfit = $totalReceivable - $totalPayable;
        $percentageProfit = $totalReceivable > 0 ? ($netProfit / $totalReceivable) * 100 : 0;
        $download = false;

        $viewData = compact('sales', 'purchases', 'totalReceivable', 'totalPayable', 'netProfit', 'percentageProfit', 'download');

        if ($format == 'pdf') {
            $html = View::make('admin-main.admin.costSheetReport.report', $viewData)->render();
            $pdf = new Dompdf();
            $pdf->loadHtml($html);
            $pdf->setPaper('A4', 'portrait');
            $pdf->render();
            return response($pdf->output(), 200)
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'attachment; filename="CostSheet.pdf"');
        }

        if ($format == 'excel') {
            return Excel::download(new CostSheetExport($sales, $purchases), 'CostSheet.xlsx');
        }

        if ($format == 'word') {
            $html = View::make('admin-main.admin.costSheetReport.report', $viewData)->render();
            return response($html)
                ->header('Content-Type', 'application/msword')
                ->header('Content-Disposition', 'attachment; filename="CostSheet.doc"');
        }

        return redirect()->back()->with('error', 'Invalid format');
    }



}
