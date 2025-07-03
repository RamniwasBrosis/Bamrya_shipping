<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cost Sheet Report</title>
</head>
<body>
    <h4 style="text-align:center; font-weight:bold;">
        COSTSHEET REPORT : JOB NO : {{ request('job_no') }}
    </h4>

    <table class="table table-bordered">
        <thead>
            <tr style="background: #eee;">
                <th colspan="2">  
                    <div class="text-end d-flex justify-content-between">
                        <div>  CostSheet Report </div>
                        @if ($download)
                            <div class="dropdown mb-3">
                                <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    Download
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{route('cost-sheet-report.download',  ['format' => 'pdf', 'job_no' => request('job_no')])}}" target="_blank">Download PDF</a></li>
                                    <li><a class="dropdown-item" href="{{route('cost-sheet-report.download', ['format' => 'excel', 'job_no' => request('job_no')])}}" target="_blank">Download Excel</a></li>
                                    <li><a class="dropdown-item" href="{{route('cost-sheet-report.download', ['format' => 'word', 'job_no' => request('job_no')])}}" target="_blank">Download Word</a></li>
                                </ul>
                            </div>
                        @endif                         
                    </div>
                
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td width="50%">
                    <strong>Sale (Receivables)</strong><br>
                    @forelse($sales as $sale)
                        <div>{{ $sale->invoice_no }} - ₹{{ number_format($sale->amount, 2) }}</div>
                    @empty
                        <div>No Record Found in Sale</div>
                    @endforelse
                </td>
                <td width="50%">
                    <strong>Purchase (Payables)</strong><br>
                    @forelse($purchases as $purchase)
                        <div>{{ $purchase->invoice_no }} - ₹{{ number_format($purchase->amount, 2) }}</div>
                    @empty
                        <div>No Record Found in Purchase</div>
                    @endforelse
                </td>
            </tr>
            <tr style="background: #f9f9f9;">
                <td colspan="2">
                    <strong>TOTAL RECEIVABLES:</strong> ₹{{ number_format($totalReceivable, 2) }}<br>
                    <strong>TOTAL PAYABLES:</strong> ₹{{ number_format($totalPayable, 2) }}<br>
                    <strong>NET PROFIT/(LOSS):</strong> ₹{{ number_format($netProfit, 3) }}<br>
                    <strong>(%)PROFIT/(LOSS):</strong> {{ number_format($percentageProfit, 2) }}%
                </td>
            </tr>
        </tbody>
    </table>

    <div class="text-end mt-2">
        <small>Print Date & Time: {{ now()->format('d/m/Y h:i:s A') }}</small>
    </div>

</body>
</html>