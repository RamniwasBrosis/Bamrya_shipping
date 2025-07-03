<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Loading-list Report</title>
</head>
<body>
    <h2 style="text-align: center;">DN SHIPPING & LOGISTICS</h2>
    <p style="text-align: center;">
        Plot No.14B, Sector -19, Opp. to Dana Bandar<br>
        APMC, Vashi, NaviMumbai - 400 705<br>
        Tel: +91 22 49705707 Email: akram@oecc.in<br>
        Website: www.oecc.in
    </p>

    <hr>

    <div class="d-flex justify-content-between">
        <div>
            <h4>SUBJECT: LOADING LIST</h4>
            <p><strong>VESSEL:</strong> {{ $vessel_name ?? '' }}</p>
            <p><strong>VOY:</strong> {{ $voyage_no ?? '' }}</p>
            <p><strong>TERMINAL PORT:</strong> {{ $terminal_port ?? '' }}</p>
        </div>
    </div>

    <table border="1" width="100%" cellspacing="0" cellpadding="5" class="table">
        <thead>
            <tr>
                <th>Booking No</th>
                <th>Container No</th>
                <th>Cont Size</th>
                <th>Type</th>
                <th>VGM WT</th>
                <th>POL</th>
                <th>POD</th>
                <th>TEM</th>
                <th>Remark (Hum & Vent)</th>
                <th>Commodity</th>
            </tr>
        </thead>
        <tbody>
            @foreach($query as $item)
                <tr>
                    <td>{{ $item->booking_no }}</td>
                    <td>{{ $item->container_no }}</td>
                    <td>{{ $item->size }}</td>
                    <td>{{ $item->cont_category }}</td>
                    <td>{{ $item->vgm_wt }}</td>
                    <td>{{ $item->port_loading_id }}</td>
                    <td>{{ $item->port_discharge_id }}</td>
                    <td>{{ $item->tem }}</td>
                    <td>{{ $item->remark }}</td>
                    <td>{{ $item->commodity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
   
</body>
</html>