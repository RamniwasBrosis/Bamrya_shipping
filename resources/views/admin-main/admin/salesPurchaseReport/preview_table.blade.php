<h4 class="text-center font-weight-bold">SALES - PURCHASE REPORT</h4>

<div class="dropdown mb-3">
    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
        Download
    </button>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="{{ route('sale-purchase-report.download', ['format'=>'pdf', 'full_job_no'=>request('full_job_no'), 'from_date'=>request('from_date'), 'to_date'=>request('to_date')]) }}" target="_blank">PDF</a></li>
        <li><a class="dropdown-item" href="{{ route('sale-purchase-report.download', ['format'=>'excel', 'full_job_no'=>request('full_job_no'), 'from_date'=>request('from_date'), 'to_date'=>request('to_date')]) }}" target="_blank">Excel</a></li>
        <li><a class="dropdown-item" href="{{ route('sale-purchase-report.download', ['format'=>'word', 'full_job_no'=>request('full_job_no'), 'from_date'=>request('from_date'), 'to_date'=>request('to_date')]) }}" target="_blank">Word</a></li>
    </ul>
</div>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Type</th>
            <th>Party Name</th>
            <th>Job No</th>
            <th>Invoice No</th>
            <th>INV DT</th>
            <th>GSTIN</th>
            <th>Taxable Amount</th>
            <th>GST Amount</th>
            <th>Total Amount</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($invoices as $item)
            @php
                $charges = $item->chargesContainer;
                if ($charges->isEmpty()) continue;
                $cgst   = $charges->sum('cgst');
                $sgst   = $charges->sum('sgst');
                $igst   = $charges->sum('igst');
                $gst    = $igst + $sgst + $cgst;
                $taxable = $charges->sum('freight');
                $total   = $taxable + $gst;
            @endphp
            <tr>
                <td>{{ $item->type }}</td>
                <td>{{ optional($item->partyName)->party_name ?? '--' }}</td>
                <td>{{ optional($item->operationJob)->job_no ?? '--' }}</td>
                <td>{{ $item->invoice_no ?? '--' }}</td>
                <td>{{ $item->invoice_date ? \Carbon\Carbon::parse($item->invoice_date)->format('d-m-Y') : '' }}</td>
                <td>{{ optional($item->partyName)->gstin ?? '--' }}</td>
                <td class="text-right">{{ number_format($taxable, 2) }}</td>
                <td class="text-right">{{ number_format($gst, 2) }}</td>
                <td class="text-right">{{ number_format($total, 2) }}</td>
            </tr>
        @empty
            <tr><td colspan="9" class="text-center">No invoices found.</td></tr>
        @endforelse
    </tbody>
    <tfoot>
        {{-- Sales Totals --}}
        <tr style="background-color: #d4edda; font-weight: bold;">
            <td colspan="6" class="text-right">SALES GRAND TOTAL</td>
            <td>{{ number_format($totals['sales']['taxable'], 2) }}</td>
            <td>{{ number_format($totals['sales']['gst'], 2) }}</td>
            <td>{{ number_format($totals['sales']['total'], 2) }}</td>
        </tr>
        {{-- Purchase Totals --}}
        <tr style="background-color: #f8d7da; font-weight: bold;">
            <td colspan="6" class="text-right">PURCHASE GRAND TOTAL</td>
            <td>{{ number_format($totals['purchase']['taxable'], 2) }}</td>
            <td>{{ number_format($totals['purchase']['gst'], 2) }}</td>
            <td>{{ number_format($totals['purchase']['total'], 2) }}</td>
        </tr>
        {{-- If one side is empty, show a message row --}}
        @if($invoices->where('type','Sale')->isEmpty())
            <tr><td colspan="9" class="text-center text-warning">No Sales found for this Job.</td></tr>
        @endif
        @if($invoices->where('type','Purchase')->isEmpty())
            <tr><td colspan="9" class="text-center text-warning">No Purchases found for this Job.</td></tr>
        @endif
    </tfoot>
</table>

{{-- Pagination is not needed here because we are not using paginate() on the combined collection --}}
{{-- If you want pagination, you would need to paginate the merged collection --}}