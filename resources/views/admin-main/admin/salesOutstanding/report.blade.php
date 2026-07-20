<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sales Outstandig Report</title>
    
     <style>
        @page {
            size: A4 landscape;
            margin: 10px;
        }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 11px;
            color: #000;
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
            table-layout: auto;
             word-wrap: break-word;
        }

        th, td {
            border: 1px solid #555;
            padding: 6px 8px;
            text-align: center;
            white-space: nowrap;
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
        
        .scale {
            transform: scale(0.93);
            transform-origin: top left;
        }
    </style>
    
    
</head>
<body>
    <h4 class="text-center">
        Outstanding Report - Sales Invoice &nbsp;&nbsp;&nbsp;(Dated - {{ now()->format('d/m/Y') }})
    </h4>


    <div style="overflow-x: auto; width: 100%;" class="scale">
        <table border="1" cellspacing="0" cellpadding="5" 
               style="border-collapse: collapse; width:100%;" 
               class="table table-bordered table-striped">
    
            <thead style="background-color: #d2ebf9;">
                <tr>
                    <th>Job No</th>
                    <th>Inv No</th>
                    <th>Party Name</th>
                    <th>Inv Date</th>
                    <th>Invoice Amt</th>
                    <th>Amount Received</th>
                    <th>Outstanding Amount</th>
                    <th>Credit Amount</th>
                </tr>
            </thead>
    
            <tbody>
                @php
                    $totalInvoiceAmt = 0;
                    $totalRecievedAmt = 0;
                    $totalOutstandingAmt = 0;
                    $credit_amount = 0;
                @endphp
    
                @foreach ($sales_invoices as $item)
                    @php
                        // Calculate invoice amount from charge container
                        $invoice_amount = $item->chargesContainer->sum('total');
    
                        $totalInvoiceAmt += $invoice_amount;
                        $totalRecievedAmt += $item->recieved_amount ?? 0;
                        $totalOutstandingAmt += $item->outstanding_amount ?? 0;
    
                        if ($total_get_amount_by_party > $totalInvoiceAmt) {
                            $credit_amount = $total_get_amount_by_party - $totalInvoiceAmt;
                        }
                    @endphp
    
                    <tr>
                        <td>{{ optional($item->operationJob)->job_no ?? '--' }}</td>
                        <td>{{ $item->invoice_no ?? '--' }}</td>
                        <td>{{ optional($item->partyName)->party_name ?? '--' }}</td>
                        <td>{{ $item->invoice_date ? \Carbon\Carbon::parse($item->invoice_date)->format('d-m-Y') : '--' }}</td>
                        <td align="right">{{ number_format($invoice_amount, 2) }}</td>
                        <td align="right">{{ number_format($item->recieved_amount ?? 0, 2) }}</td>
                        <td align="right" style="color:red;">
                            <strong>{{ $round_of_amount ? '00' : number_format($item->outstanding_amount ?? 0, 2) }}</strong>
                        </td>
                        <td align="right"></td>
                    </tr>
                @endforeach
            </tbody>
    
            <tfoot>
                <tr style="font-weight: bold; background-color: #f9f9f9; text-align: center;">
                    <td colspan="4">GRAND TOTAL :</td>
                    <td align="right">{{ number_format($totalInvoiceAmt, 2) }}</td>
                    <td align="right">{{ number_format($totalRecievedAmt, 2) }}</td>
                    <td align="right">{{ $round_of_amount ? '00' : number_format($totalOutstandingAmt, 2) }}</td>
                    <td align="right">{{ number_format($credit_amount ?? 0, 2) }}</td>
                </tr>
    
                @if(!empty($round_of_amount) && $round_of_amount > 0)
                    @php
                        $closingAmt = $totalInvoiceAmt - ($round_of_amount + $total_get_amount_by_party);
                    @endphp
                    <tr style="font-weight: bold; background-color: #f9f9f9; text-align: center;">
                        <td colspan="2">Round of amount in this bill :</td>
                        <td colspan="1">INV AMT <br>{{ number_format($totalInvoiceAmt, 2) }}</td>
                        <td colspan="1"> - </td>
                        <td colspan="2"> 
                            ROUND OF AMT <br> {{ number_format($round_of_amount, 2) }} + RECEIVED AMT <br>{{ number_format($total_get_amount_by_party, 2) }}
                        </td>
                        <td colspan="1"> = </td>
                        <td colspan="1">Closing AMT <br>{{ number_format($closingAmt, 2) }}</td>
                    </tr>
                @endif
            </tfoot>
    
        </table>
    </div>



</body>
</html>