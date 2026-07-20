<table border="1" cellpadding="5" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Date</th>
            <th>Party Name</th>
            <th>Invoice Type</th>
            <th>Amount</th>
            <th>Payment</th>
        </tr>
    </thead>
    <tbody>
        @foreach($receipts as $receipt)
        <tr>
            <td>{{ $receipt->date }}</td>
            <td>{{ $receipt->billingParty->name ?? '' }}</td>
            <td>{{ $receipt->invoice_type }}</td>
            <td>{{ $receipt->amount }}</td>
            <td>{{ $receipt->invoice_type === 'payment' ? $receipt->amount : 0 }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
