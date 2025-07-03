<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
          <h4 style="text-align:center; font-weight:bold;">
    PURCHASE TDS REPORT <span style="font-size:14px;">(Dated - {{ now()->format('d/m/Y') }})</span>
</h4>

<table border="1" width="100%" cellspacing="0" cellpadding="5" style="border-collapse: collapse;" class="table">
    <thead>
        <tr style="background-color: #f4e9d8; text-align: center; font-weight: bold;">
            <th>Party Name</th>
            <th>Job No</th>
            <th>Invoice No</th>
            <th>INV DT</th>
            <th>Bill Amount</th>
            <th>Basic Amount</th>
            <th>TDS AMT</th>
            <th>TDS %</th>
            <th>Payable Amt</th>
            <th>PAN No</th>
        </tr>
    </thead>
    <tbody>
        @php
            $totalBill = $totalBasic = $totalTds = $totalPayable = 0;
        @endphp

        @foreach ($query as $item)
            @php
                $billAmount = $item->amount ?? 0;
                $basicAmount = $item->basic_amount ?? 0;
                $tdsAmt = $item->tds_amount ?? 0;
                $tdsPercent = $item->tds ?? 0;
                $payableAmt = $billAmount - $tdsAmt;
                $totalBill += $billAmount;
                $totalBasic += $basicAmount;
                $totalTds += $tdsAmt;
                $totalPayable += $payableAmt;
            @endphp
            <tr style="text-align: center;">
                <td>{{ $item->partyName->party_name ?? '--' }}</td>
                <td>{{ $item->job_no ?? '--' }}</td>
                <td>{{ $item->invoice_no ?? '--' }}</td>
                <td>{{ optional($item->invoice_date)->format('d-m-Y') }}</td>
                <td align="right">{{ number_format($billAmount, 2) }}</td>
                <td align="right">{{ number_format($basicAmount, 2) }}</td>
                <td align="right">{{ number_format($tdsAmt, 2) }}</td>
                <td>{{ number_format($tdsPercent, 2) }}%</td>
                <td align="right">{{ number_format($payableAmt, 2) }}</td>
                <td>{{ $item->partyName->pan_no ?? '--' }}</td>
            </tr>
        @endforeach

        <tr style="font-weight: bold; background-color: #f9f9f9; text-align: center;">
            <td colspan="4">GRAND TOTAL :</td>
            <td align="right">{{ number_format($totalBill, 2) }}</td>
            <td align="right">{{ number_format($totalBasic, 2) }}</td>
            <td align="right">{{ number_format($totalTds, 2) }}</td>
            <td></td>
            <td align="right">{{ number_format($totalPayable, 2) }}</td>
            <td></td>
        </tr>
    </tbody>
</table>


</body>
</html>