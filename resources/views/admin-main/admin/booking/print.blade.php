<!DOCTYPE html>
<html>
<head>
    <title>Booking Print</title>
    <style>
        body { font-family: Arial; }
        .header { text-align: center; margin-bottom: 20px; }
        .details { width: 100%; border-collapse: collapse; }
        .details td, .details th { border: 1px solid #000; padding: 8px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Booking Details</h2>
    </div>

    <table class="details">
        <tr>
            <th>Booking No</th>
            <td>{{ $booking->booking_no }}</td>
        </tr>
        <tr>
            <th>Booking Date</th>
            <td>{{ $booking->created_at }}</td>
        </tr>
        <tr>
            <th>Vessel</th>
            <td>{{ $booking->vessel->vessel_name ?? 'N/A' }}</td>
        </tr>
        <!--<tr>-->
        <!--    <th>Voyage</th>-->
        <!--    <td>{{ $booking->voyage->voyage_code ?? 'N/A' }}</td>-->
        <!--</tr>-->
        <tr>
            <th>Party</th>
            <td>{{ $booking->party->party_name ?? 'N/A' }}</td>
        </tr>
        <!-- Add more fields as needed -->
    </table>

    <br>
    <button onclick="window.print()">Print</button>
</body>
</html>
