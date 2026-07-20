<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Sales-Purchase Aggregated Report</title>
    <style>
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #555; padding: 6px 8px; text-align: center; vertical-align: middle; }
        th { background-color: #e2f0fb; font-weight: bold; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        tfoot tr { font-weight: bold; background-color: #e8e8e8; }
        .sale-row { background-color: #f0f8ff; }
        .purchase-row { background-color: #fff5f5; }
        .profit-positive { color: green; font-weight: bold; }
        .profit-negative { color: red; font-weight: bold; }
    </style>
</head>
<body>
    <h4 class="text-center">SALES - PURCHASE AGGREGATED REPORT</h4>
    <table>
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
        <tbody>
            @php
                $grandTaxable = 0;
                $grandGst = 0;
                $grandTotal = 0;
                $grandProfit = 0;
            @endphp
            @forelse($rows as $row)
                @php
                    $grandTaxable += $row->taxable;
                    $grandGst += $row->gst;
                    $grandTotal += $row->total;
                    if ($row->is_first && $row->profit !== null) {
                        $grandProfit += $row->profit;
                    }
                @endphp
                <tr class="{{ $row->type == 'Sale' ? 'sale-row' : 'purchase-row' }}">
                    @if($row->is_first)
                        <td rowspan="{{ $row->rowspan }}">{{ $row->job_no }}</td>
                    @endif
                    <td>{{ $row->type }}</td>
                    <td>{{ $row->party_name }}</td>
                    <td>{{ $row->invoices }}</td>
                    <td class="text-right">{{ number_format($row->taxable, 2) }}</td>
                    <td class="text-right">{{ number_format($row->gst, 2) }}</td>
                    <td class="text-right">{{ number_format($row->total, 2) }}</td>
                    @if($row->is_first)
                        @php
                            $profit = $row->profit;
                            $profitClass = '';
                            if ($profit !== null) {
                                $profitClass = $profit >= 0 ? 'profit-positive' : 'profit-negative';
                            }
                        @endphp
                        <td rowspan="{{ $row->rowspan }}" class="text-right {{ $profitClass }}">
                            {{ $profit !== null ? number_format($profit, 2) : '--' }}
                        </td>
                    @endif
                </tr>
            @empty
                <tr><td colspan="8" class="text-center">No records found.</td></tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" class="text-right">GRAND TOTAL</td>
                <td class="text-right">{{ number_format($grandTaxable, 2) }}</td>
                <td class="text-right">{{ number_format($grandGst, 2) }}</td>
                <td class="text-right">{{ number_format($grandTotal, 2) }}</td>
                <td class="text-right">{{ number_format($grandProfit, 2) }}</td>
            </tr>
        </tfoot>
    </table>
</body>
</html>