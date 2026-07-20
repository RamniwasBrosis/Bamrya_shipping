<?php

namespace App\Http\Controllers\AdminMain\TotalSales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Operations\OperationSalesPerson;
use App\Models\Accounts\AccountProformaInvoice;
use App\Models\Accounts\AccountPurchaseInvoice;
use App\Models\Accounts\AccountPurchaseInvoiceContainer;

class TotalSalesByPersonController extends Controller
{
    
    public $company_id ;

    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->company_id = Auth::user()->company_id;
            return $next($request);
        });
    }
    
    public function listUsers()
    {
        $salesPersons = OperationSalesPerson::where('company_id', $this->company_id)->get();
        return view('admin-main.admin.TotalSaleByPerson.salesPerson', compact('salesPersons'));
    }
    
    public function salesPersonReport(Request $request)
    {
        $salesPersonId = $request->sales_person_id;
    
        $invoices = AccountProformaInvoice::with(['partyName', 'chargesContainer'])
            ->where('company_id', $this->company_id)
            ->where('sales_person_id', $salesPersonId)
            ->get();
    
        $reportData = [];
        $grandTotalSales = 0;
        $grandTotalPurchase = 0;
        $grandProfitLoss = 0;
    
        foreach ($invoices as $invoice) {
    
            $jobNo = $invoice->job_no;
    
            $salesTotal = $invoice->chargesContainer->sum('total');
    
            $purchaseInvoices = AccountPurchaseInvoice::where('company_id', $this->company_id)
                ->where('job_no', $jobNo)
                ->pluck('id');
    
            $purchaseTotal = AccountPurchaseInvoiceContainer::whereIn('purchase_invoice_id', $purchaseInvoices)
                ->sum('total');
    
            $profitLoss = $salesTotal - $purchaseTotal;
    
            $grandTotalSales += $salesTotal;
            $grandTotalPurchase += $purchaseTotal;
            $grandProfitLoss += $profitLoss;
            
            $reportData[] = [
                'invoice_no'   => $invoice->invoice_no,
                'full_job_no'  => $invoice->full_job_no,
                'invoice_date'    => $invoice->invoice_date,
                'consignee'    => $invoice->consignee,
                'party_name'   => optional($invoice->partyName)->party_name,
                'sales_total'  => $salesTotal,
                'purchase_total' => $purchaseTotal,
                'profit_loss'  => $profitLoss,
            ];
        }
    
        return response()->json([
            'data' => $reportData,
            'grand_sales' => $grandTotalSales,
            'grand_purchase' => $grandTotalPurchase,
            'grand_profit_loss' => $grandProfitLoss
        ]);
    }
    
}
