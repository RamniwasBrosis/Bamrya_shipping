<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sales Outstandig Report</title>
</head>
<body>
    <h4 class="text-center">
        Outstanding Report - Sales Invoice &nbsp;&nbsp;&nbsp;(Dated - {{ now()->format('d/m/Y') }})
    </h4>


    <table class="table table-bordered" style="border-collapse: collapse;" width="100%" cellspacing="0" cellpadding="5">
        <thead style="background-color: #d2ebf9;">
            <tr>
                <th>Party Name</th>
                <th>Job No</th>
                <th>Port Name</th>
                <th>HBL No</th>
                <th>Inv Type</th>
                <th>Inv No</th>
                <th>Inv Date</th>
                <th>Invoice Amt</th>
                <th>Amount Received</th>
                <th>Outstanding Amount</th>
                <th>Days</th>
            </tr>
        </thead>
        <tbody>
            @foreach($query as $item)
                @php
                    $invoiceAmt = number_format($item->amount ?? 0, 2);
                    $amountReceived = number_format($item->amount_received ?? 0, 2);
                    $outstandingAmt = number_format(($item->invoice_amount - $item->amount_received), 2);
                    $invoiceDate = optional($item->invoice_date)->format('d/m/Y');
                    $days = $item->invoice_date ? \Carbon\Carbon::parse($item->invoice_date)->diffInDays(now()) : '--';
                @endphp
                <tr>
                    <td>{{ $item->partyName->party_name ?? '--' }}</td>
                    <td>{{ $item->job_no ?? '--' }}</td>
                    <td>{{ $item->pod ?? '--' }}</td>
                    <td>{{ $item->hbl_no ?? '--' }}</td>
                    <td>{{ $item->invoice_type ?? '--' }}</td>
                    <td>{{ $item->invoice_no ?? '--' }}</td>
                    <td>{{ $invoiceDate ?? '--' }}</td>
                    <td align="right">{{ $invoiceAmt }}</td>
                    <td align="right">{{ $amountReceived }}</td>
                    <td align="right" style="color:red;"><strong>{{ $outstandingAmt }}</strong></td>
                    <td align="center">{{ $days }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>