<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            width:100%;
            border-collapse: collapse;
        }
        table, th, td {
            border:1px solid #000;
        }
        th, td {
            padding:6px;
            font-size:14px;
        }
        h2, h4, p {
            margin:0;
            padding:0;
            text-align:center;
        }
        hr {
            margin:10px 0;
        }
    </style>
</head>
<body>

<h2>{{ $company->company_name }}</h2>
<p>
    {{ $company->address }}<br>
    Email: {{ $company->company_email }}
</p>
<hr>

<h2 style="margin-top:-15px;">{{ $partyName }}</h2>
<h4>Ledger Account</h4>
<p>{{ $partyAddress }}<br>{{ $partyCity }}</p>
<hr>

<table>
    <thead>
        <tr>
            <th>Receipt Date</th>
            <th>Party Name</th>
            <th>Invoice Type</th>
            <th>Invoice No</th>
            <th>Debit</th>
            <th>Credit</th>
        </tr>
    </thead>
    <tbody>
        @php
            $totalDebit = 0;
            $totalCredit = 0;
        @endphp

        @foreach($receipt_lists as $item)
            @php
                if(in_array($item->invoice_type, ['Sales', 'Payment'])) {
                    $debit = $item->amount;
                    $credit = 0;
                    $totalDebit += $debit;
                } elseif($item->invoice_type == 'Receipt') {
                    $debit = 0;
                    $credit = $item->amount;
                    $totalCredit += $credit;
                } else {
                    $debit = 0;
                    $credit = 0;
                }
            @endphp
            <tr>
                <td>{{ $item->receipt_date }}</td>
                <td>{{ $item->billingParty->party_name }}</td>
                <td>{{ $item->invoice_type }}</td>
                <td>{{ $item->invoice_no }}</td>
                <td>{{ $debit ? number_format($debit,2) : '-' }}</td>
                <td>{{ $credit ? number_format($credit,2) : '-' }}</td>
            </tr>
        @endforeach
    </tbody>
    
    @php
        $closingBalance = $totalDebit - $totalCredit;
    @endphp
    
    <tfoot>
        <tr>
            <td colspan="4"><b>Total</b></td>
            <td><b>{{ number_format($totalDebit,2) }}</b></td>
            <td><b>{{ number_format($totalCredit,2) }}</b></td>
        </tr>
        <tr>
            <td colspan="4"><b>Closing Balance</b></td>
            <td colspan="2"><b>{{ number_format($closingBalance,2) }}</b></td>
        </tr>
    </tfoot>
</table>

</body>
</html>
