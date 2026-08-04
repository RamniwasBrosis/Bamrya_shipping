<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sales Outstandig Report</title>

     <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            color: #000;
            margin: 25px;
        }

        h2 {
            text-align: center;
            margin-bottom: 0;
            font-size: 16px;
            text-transform: uppercase;
        }

        .sub-header {
            text-align: center;
            margin-bottom: 20px;
            font-size: 13px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #555;
            padding: 6px 8px;
            text-align: center;
        }

        th {
            background-color: #e2f0fb;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tfoot tr {
            font-weight: bold;
            background-color: #e8e8e8;
        }

        .right {
            text-align: right;
        }

        .left {
            text-align: left;
        }

        .no-border {
            border: none !important;
        }
    </style>


</head>
<body>
    <h4 class="text-center">
        Outstanding Report - Sales Invoice &nbsp;&nbsp;&nbsp;(Dated - {{ now()->format('d/m/Y') }})
    </h4>


    <table>
        <thead>
            <tr>
                <th>Party Name</th>
                <th>Job No</th>
                <th>Branch</th>
                <th>Invoice No</th>
                <th>INV DT</th>
                <!--<th>Basic Amount</th>-->
                <th>GSTIN No</th>
                <th>Taxable Amount</th>
                <th>GST Amount</th>
                <th>Total Amount</th>

            </tr>
        </thead>
        <tbody>
            @php
                $totalBill = 0;
                $totalBasic = 0;
                $totalPayable = 0;
                $totalTaxableAmount = 0;
                $totalGstAmount = 0;
            @endphp

            @foreach ($query as $item)
                @php
                    $charges = $item['chargesContainer'];
                    if ($charges->isEmpty()) continue;

                    $cgstAmount  = $charges->sum('cgst');
                    $sgstAmount  = $charges->sum('sgst');
                    $igstAmount  = $charges->sum('igst');
                    $gstAmount = $igstAmount + $sgstAmount + $cgstAmount;

                    $billAmount  = $charges->sum('amount');
                    $taxableAmount  = $charges->sum('freight');

                    $tdsAmt      = $charges->sum('tds_amount');
                    $tdsPercent  = $charges->avg('tds');
                    $payableAmt  = $billAmount - $tdsAmt;
                    $panNo       = optional($item->partyName)->gstin ?? '--';

                    $totalBill     += $billAmount;
                    $totalPayable  += $payableAmt;
                    $totalTaxableAmount  += $taxableAmount;
                    $totalGstAmount += $gstAmount;
                @endphp
                <tr>
                    <td class="left">{{ optional($item->partyName)->party_name ?? '--' }}</td>
                    <td>{{ optional($item->operationJob)->full_job_no ?? '--' }}</td>
                    <td>{{ $item->branch->branch_name ?? '--' }}</td>
                    <td>{{ $item->invoice_no ?? '--' }}</td>
                    <td>{{ $item->invoice_date ? \Carbon\Carbon::parse($item->invoice_date)->format('d-m-Y') : ''  }}</td>
                    <td>{{ $panNo }}</td>
                    <td class="right">{{ number_format($taxableAmount, 2) }}</td>
                    <td class="right">{{ number_format($gstAmount, 2) }}</td>
                    <td class="right">{{ number_format($billAmount, 2) }}</td>

                </tr>
            @endforeach
        </tbody>

        <tfoot>
            <tr>
                <td colspan="6" class="right">GRAND TOTAL :</td>
                <td class="right">{{ number_format($totalTaxableAmount, 2) }}</td>
                <td class="right">{{ number_format($totalGstAmount, 2) }}</td>
                <td class="right">{{ number_format(round($totalBill), 2) }}</td>
            </tr>
        </tfoot>
    </table>


</body>
</html>
