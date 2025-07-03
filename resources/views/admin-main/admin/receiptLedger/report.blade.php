<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Purchase TDS Report</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }
        h4 {
            text-align: center;
            font-weight: bold;
            margin-bottom: 10px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            font-size: 12px;
        }
        th, td {
            border: 1px solid #333;
            padding: 5px;
            text-align: center;
        }
        th {
            background-color: #f4e9d8;
            font-weight: bold;
        }
        .text-right {
            text-align: right;
        }
        .grand-total {
            font-weight: bold;
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>

<h4>PURCHASE TDS REPORT <span style="font-size: 14px;">(Dated - {{ now()->format('d/m/Y') }})</span></h4>

<table>
    <thead>
        <tr>
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
            <tr>
                <td>{{ $item->partyName->party_name ?? '--' }}</td>
                <td>{{ $item->job_no ?? '--' }}</td>
                <td>{{ $item->invoice_no ?? '--' }}</td>
                <td>{{ optional($item->invoice_date)->format('d-m-Y') ?? '--' }}</td>
                <td class="text-right">{{ number_format($billAmount, 2) }}</td>
                <td class="text-right">{{ number_format($basicAmount, 2) }}</td>
                <td class="text-right">{{ number_format($tdsAmt, 2) }}</td>
                <td>{{ number_format($tdsPercent, 2) }}%</td>
                <td class="text-right">{{ number_format($payableAmt, 2) }}</td>
                <td>{{ $item->partyName->pan_no ?? '--' }}</td>
            </tr>
        @endforeach

        <tr class="grand-total">
            <td colspan="4">GRAND TOTAL :</td>
            <td class="text-right">{{ number_format($totalBill, 2) }}</td>
            <td class="text-right">{{ number_format($totalBasic, 2) }}</td>
            <td class="text-right">{{ number_format($totalTds, 2) }}</td>
            <td></td>
            <td class="text-right">{{ number_format($totalPayable, 2) }}</td>
            <td></td>
        </tr>
    </tbody>
</table>

</body>
</html>
