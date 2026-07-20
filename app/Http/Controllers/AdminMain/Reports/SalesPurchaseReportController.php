<?php

namespace App\Http\Controllers\AdminMain\Reports;

use Carbon\Carbon;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use App\Models\Operations\OperationJobMaster;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SalesPurchaseAggregatedExport;
use App\Models\Accounts\AccountPurchaseInvoice;
use App\Models\Accounts\AccountSaleInvoice;
use Illuminate\Pagination\LengthAwarePaginator;

class SalesPurchaseReportController extends Controller
{
    public $company_id;

    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->company_id = Auth::user()->company_id;
            return $next($request);
        });
    }

    public function index()
    {
        $jobs = OperationJobMaster::where('company_id', $this->company_id)
            ->select('id', 'full_job_no')
            ->orderBy('full_job_no')
            ->get();
    
        return view('admin-main.admin.salesPurchaseReport.first', compact('jobs'));
    }

    public function preview(Request $request)
    {
        $from = Carbon::parse($request->from_date)->startOfDay();
        $to   = Carbon::parse($request->to_date)->endOfDay();

        // Fetch sales invoices
        $sales = AccountSaleInvoice::with(['partyName', 'chargesContainer'])
            ->where('company_id', $this->company_id)
            ->whereBetween('created_at', [$from, $to])
            ->when($request->filled('full_job_no'), function ($q) use ($request) {
                return $q->where('full_job_no', $request->full_job_no);
            })
            ->get();

        // Fetch purchase invoices
        $purchase = AccountPurchaseInvoice::with(['partyName', 'chargesContainer'])
            ->where('company_id', $this->company_id)
            ->whereBetween('created_at', [$from, $to])
            ->when($request->filled('full_job_no'), function ($q) use ($request) {
                return $q->where('full_job_no', $request->full_job_no);
            })
            ->get();

        // Group by job_no and type
        $grouped = [];

        // Process Sales
        foreach ($sales as $inv) {
            $job = $inv->full_job_no;
            if (!isset($grouped[$job])) {
                $grouped[$job] = ['sales' => null, 'purchase' => null];
            }
            if (!isset($grouped[$job]['sales'])) {
                $grouped[$job]['sales'] = [
                    'party_name' => optional($inv->partyName)->party_name ?? '--',
                    'invoices' => [],
                    'taxable' => 0,
                    'gst' => 0,
                    'total' => 0,
                ];
            }
            $charges = $inv->chargesContainer;
            $cgst = $charges->sum('cgst');
            $sgst = $charges->sum('sgst');
            $igst = $charges->sum('igst');
            $gst = $igst + $sgst + $cgst;
            $taxable = $charges->sum('freight');
            $total = $taxable + $gst;

            $grouped[$job]['sales']['invoices'][] = $inv->invoice_no ?? '--';
            $grouped[$job]['sales']['taxable'] += $taxable;
            $grouped[$job]['sales']['gst'] += $gst;
            $grouped[$job]['sales']['total'] += $total;
        }

        // Process Purchase
        foreach ($purchase as $inv) {
            $job = $inv->full_job_no;
            if (!isset($grouped[$job])) {
                $grouped[$job] = ['sales' => null, 'purchase' => null];
            }
            if (!isset($grouped[$job]['purchase'])) {
                $grouped[$job]['purchase'] = [
                    'party_name' => optional($inv->partyName)->party_name ?? '--',
                    'invoices' => [],
                    'taxable' => 0,
                    'gst' => 0,
                    'total' => 0,
                ];
            }
            $charges = $inv->chargesContainer;
            $cgst = $charges->sum('cgst');
            $sgst = $charges->sum('sgst');
            $igst = $charges->sum('igst');
            $gst = $igst + $sgst + $cgst;
            $taxable = $charges->sum('freight');
            $total = $taxable + $gst;

            $grouped[$job]['purchase']['invoices'][] = $inv->invoice_no ?? '--';
            $grouped[$job]['purchase']['taxable'] += $taxable;
            $grouped[$job]['purchase']['gst'] += $gst;
            $grouped[$job]['purchase']['total'] += $total;
        }

        // Build flat list of rows for pagination
        $rows = [];
        foreach ($grouped as $job => $types) {
            $hasSale = !is_null($types['sales']);
            $hasPurchase = !is_null($types['purchase']);
            $rowspan = ($hasSale && $hasPurchase) ? 2 : 1;
            
            // Calculate profit: taxable sale - taxable purchase (if both exist)
            $profit = null;
            if ($hasSale && $hasPurchase) {
                $profit = $types['sales']['taxable'] - $types['purchase']['taxable'];
            }

            if ($hasSale) {
                $rows[] = (object) [
                    'job_no' => $job,
                    'rowspan' => $rowspan,
                    'type' => 'Sale',
                    'party_name' => $types['sales']['party_name'],
                    'invoices' => implode(', ', $types['sales']['invoices']),
                    'taxable' => $types['sales']['taxable'],
                    'gst' => $types['sales']['gst'],
                    'total' => $types['sales']['total'],
                    'is_first' => true,
                    'profit' => $profit,
                ];
            }
            if ($hasPurchase) {
                $rows[] = (object) [
                    'job_no' => $job,
                    'rowspan' => $rowspan,
                    'type' => 'Purchase',
                    'party_name' => $types['purchase']['party_name'],
                    'invoices' => implode(', ', $types['purchase']['invoices']),
                    'taxable' => $types['purchase']['taxable'],
                    'gst' => $types['purchase']['gst'],
                    'total' => $types['purchase']['total'],
                    'is_first' => false,
                    'profit' => null, // profit only shown in first row
                ];
            }
        }

        // Sort by job_no
        usort($rows, function($a, $b) {
            return strcmp($a->job_no, $b->job_no);
        });

        // Paginate
        $page = $request->get('page', 1);
        $perPage = 25;
        $offset = ($page - 1) * $perPage;
        $paginatedRows = array_slice($rows, $offset, $perPage);
        $totalRows = count($rows);

        $paginator = new LengthAwarePaginator(
            $paginatedRows,
            $totalRows,
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        $html = $this->generateAggregatedTableHtml($paginator, $request, $rows);

        return response()->json(['html' => $html]);
    }

    private function generateAggregatedTableHtml($paginator, $request, $allRows)
    {
        // Grand totals from all rows
        $grandTaxable = 0;
        $grandGst = 0;
        $grandTotal = 0;
        $grandProfit = 0;
        foreach ($allRows as $row) {
            $grandTaxable += $row->taxable;
            $grandGst += $row->gst;
            $grandTotal += $row->total;
            // Only sum profit from sale rows (first rows) because purchase rows have null
            if ($row->is_first && $row->profit !== null) {
                $grandProfit += $row->profit;
            }
        }

        $html = '
            <h4 class="text-center font-weight-bold">SALES - PURCHASE DETAIL REPORT</h4>
            <div class="dropdown mb-3">
                <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    Download
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="'.route('sale-purchase-report.download', [
                        'format' => 'pdf',
                        'full_job_no' => $request->full_job_no,
                        'from_date' => $request->from_date,
                        'to_date' => $request->to_date,
                    ]).'" target="_blank">PDF</a></li>
                    <li><a class="dropdown-item" href="'.route('sale-purchase-report.download', [
                        'format' => 'excel',
                        'full_job_no' => $request->full_job_no,
                        'from_date' => $request->from_date,
                        'to_date' => $request->to_date,
                    ]).'" target="_blank">Excel</a></li>
                    <li><a class="dropdown-item" href="'.route('sale-purchase-report.download', [
                        'format' => 'word',
                        'full_job_no' => $request->full_job_no,
                        'from_date' => $request->from_date,
                        'to_date' => $request->to_date,
                    ]).'" target="_blank">Word</a></li>
                </ul>
            </div>

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Job No</th>
                        <th>Type</th>
                        <th>Party Name</th>
                        <th>Invoice No(s)</th>
                        <th>Taxable Amount</th>
                        <th>GST Amount</th>
                        <th>Total Amount</th>
                        <th>Profit</th>
                    </tr>
                </thead>
                <tbody>';

        if (count($paginator) > 0) {
            foreach ($paginator as $idx => $row) {
                $html .= '<tr>';
                // Job No cell with rowspan if it's the first row for this job
                if ($row->is_first) {
                    $html .= '<td rowspan="'.$row->rowspan.'">'.e($row->job_no).'</td>';
                }
                $html .= '
                    <td>'.e($row->type).'</td>
                    <td>'.e($row->party_name).'</td>
                    <td>'.e($row->invoices).'</td>
                    <td class="text-right">'.number_format($row->taxable, 2).'</td>
                    <td class="text-right">'.number_format($row->gst, 2).'</td>
                    <td class="text-right">'.number_format($row->total, 2).'</td>';

                // Profit cell: only on first row (sale) with rowspan
                if ($row->is_first) {
                    $profit = $row->profit;
                    if ($profit !== null) {
                        $color = $profit >= 0 ? 'green' : 'red';
                        $formattedProfit = number_format($profit, 2);
                        $html .= '<td rowspan="'.$row->rowspan.'" style="color: '.$color.'; font-weight: bold;">'.$formattedProfit.'</td>';
                    } else {
                        // Only one side exists, profit is N/A or 0?
                        $html .= '<td rowspan="'.$row->rowspan.'">--</td>';
                    }
                } else {
                    // Purchase row: profit cell is already covered by rowspan from sale row
                    // so we do nothing (skip)
                }

                $html .= '</tr>';
            }
        } else {
            $html .= '<tr><td colspan="8" class="text-center">No records found.</td></tr>';
        }

        $html .= '
                </tbody>
                <tfoot>
                    <tr style="font-weight: bold; background-color: #e9ecef;">
                        <td colspan="4" class="text-right">GRAND TOTAL</td>
                        <td class="text-right">'.number_format($grandTaxable, 2).'</td>
                        <td class="text-right">'.number_format($grandGst, 2).'</td>
                        <td class="text-right">'.number_format($grandTotal, 2).'</td>
                        <td class="text-right">'.number_format($grandProfit, 2).'</td>
                    </tr>
                </tfoot>
            </table>
            <div class="mt-3">'.$paginator->links('pagination::bootstrap-5').'</div>';

        return $html;
    }

    public function download(Request $request, $format)
    {
        // Reuse the same aggregation logic (without pagination)
        $from = Carbon::parse($request->from_date)->startOfDay();
        $to   = Carbon::parse($request->to_date)->endOfDay();

        $sales = AccountSaleInvoice::with(['partyName', 'chargesContainer'])
            ->where('company_id', $this->company_id)
            ->whereBetween('created_at', [$from, $to])
            ->when($request->filled('full_job_no'), function ($q) use ($request) {
                return $q->where('full_job_no', $request->full_job_no);
            })
            ->get();

        $purchase = AccountPurchaseInvoice::with(['partyName', 'chargesContainer'])
            ->where('company_id', $this->company_id)
            ->whereBetween('created_at', [$from, $to])
            ->when($request->filled('full_job_no'), function ($q) use ($request) {
                return $q->where('full_job_no', $request->full_job_no);
            })
            ->get();

        $grouped = [];
        foreach ($sales as $inv) {
            $job = $inv->full_job_no;
            if (!isset($grouped[$job])) $grouped[$job] = ['sales' => null, 'purchase' => null];
            if (!isset($grouped[$job]['sales'])) {
                $grouped[$job]['sales'] = ['party_name' => optional($inv->partyName)->party_name ?? '--', 'invoices' => [], 'taxable' => 0, 'gst' => 0, 'total' => 0];
            }
            $charges = $inv->chargesContainer;
            $cgst = $charges->sum('cgst');
            $sgst = $charges->sum('sgst');
            $igst = $charges->sum('igst');
            $gst = $igst + $sgst + $cgst;
            $taxable = $charges->sum('freight');
            $total = $taxable + $gst;
            $grouped[$job]['sales']['invoices'][] = $inv->invoice_no ?? '--';
            $grouped[$job]['sales']['taxable'] += $taxable;
            $grouped[$job]['sales']['gst'] += $gst;
            $grouped[$job]['sales']['total'] += $total;
        }

        foreach ($purchase as $inv) {
            $job = $inv->full_job_no;
            if (!isset($grouped[$job])) $grouped[$job] = ['sales' => null, 'purchase' => null];
            if (!isset($grouped[$job]['purchase'])) {
                $grouped[$job]['purchase'] = ['party_name' => optional($inv->partyName)->party_name ?? '--', 'invoices' => [], 'taxable' => 0, 'gst' => 0, 'total' => 0];
            }
            $charges = $inv->chargesContainer;
            $cgst = $charges->sum('cgst');
            $sgst = $charges->sum('sgst');
            $igst = $charges->sum('igst');
            $gst = $igst + $sgst + $cgst;
            $taxable = $charges->sum('freight');
            $total = $taxable + $gst;
            $grouped[$job]['purchase']['invoices'][] = $inv->invoice_no ?? '--';
            $grouped[$job]['purchase']['taxable'] += $taxable;
            $grouped[$job]['purchase']['gst'] += $gst;
            $grouped[$job]['purchase']['total'] += $total;
        }

        $rows = [];
        foreach ($grouped as $job => $types) {
            $hasSale = !is_null($types['sales']);
            $hasPurchase = !is_null($types['purchase']);
            $rowspan = ($hasSale && $hasPurchase) ? 2 : 1;
            $profit = null;
            if ($hasSale && $hasPurchase) {
                $profit = $types['sales']['taxable'] - $types['purchase']['taxable'];
            }

            if ($hasSale) {
                $rows[] = (object) [
                    'job_no' => $job,
                    'rowspan' => $rowspan,
                    'type' => 'Sale',
                    'party_name' => $types['sales']['party_name'],
                    'invoices' => implode(', ', $types['sales']['invoices']),
                    'taxable' => $types['sales']['taxable'],
                    'gst' => $types['sales']['gst'],
                    'total' => $types['sales']['total'],
                    'is_first' => true,
                    'profit' => $profit,
                ];
            }
            if ($hasPurchase) {
                $rows[] = (object) [
                    'job_no' => $job,
                    'rowspan' => $rowspan,
                    'type' => 'Purchase',
                    'party_name' => $types['purchase']['party_name'],
                    'invoices' => implode(', ', $types['purchase']['invoices']),
                    'taxable' => $types['purchase']['taxable'],
                    'gst' => $types['purchase']['gst'],
                    'total' => $types['purchase']['total'],
                    'is_first' => false,
                    'profit' => null,
                ];
            }
        }

        usort($rows, function($a, $b) {
            return strcmp($a->job_no, $b->job_no);
        });

        if ($format == 'pdf') {
            $html = View::make('admin-main.admin.salesPurchaseReport.report', compact('rows'))->render();
            $dompdf = new Dompdf();
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'landscape');
            $dompdf->render();
            return response($dompdf->output(), 200)
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'attachment; filename="sales-purchase.pdf"');
        }

        if ($format == 'excel') {
            return Excel::download(new SalesPurchaseAggregatedExport($rows), 'sales-purchase.xlsx');
        }

        if ($format == 'word') {
            $html = View::make('admin-main.admin.salesPurchaseReport.report', compact('rows'))->render();
            return response($html)
                ->header('Content-Type', 'application/msword')
                ->header('Content-Disposition', 'attachment; filename="sales-purchase.doc"');
        }

        return redirect()->back()->with('error', 'Invalid format selected');
    }
}