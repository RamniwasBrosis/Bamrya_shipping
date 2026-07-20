<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Freight Certificate</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 13px;
        }

        .container {
            width: 100%;
            padding: 20px;
        }

        .header {
            width: 100%;
            border-bottom: 2px solid #000;
            margin-bottom: 20px;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #0076D7;
            width: 40%;
        }

        .company-details {
            text-align: right;
            font-size: 12px;
            width: 60%;
        }

        .title {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            text-decoration: underline;
            margin: 20px 0;
        }

        .details {
            font-size: 13px;
            line-height: 1.8;
        }

        .details ul {
            list-style: none;
            padding: 0;
        }

        .details li {
            margin-bottom: 5px;
        }

        .right-info {
            float: right;
        }

        .signature {
            margin-top: 50px;
            font-size: 14px;
        }
        .charges-table{
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border: 1px solid #000;
        }
        
        .charges-table th,
        .charges-table td{
            border: 1px solid #000;
            padding: 5px;
            font-size: 13px;
            text-align: center;
        }
        
        .charges-table thead{
            background: #f2f2f2;
            font-weight: bold;
        }
        
        .charges-table tbody tr{
            height: 35px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <table width="100%">
            <tr>
                <td class="logo">{{ $company->company_name }}</td>
                <td class="company-details">
                    <strong>{{ $company->company_name }}</strong><br>
                    {{ $company->address }}<br>
                    <b>PAN NO:</b> {{ $company->companySetting->pan_no ?? '' }} &nbsp; <b>GSTIN:</b> {{ $company->companySetting->gstin_no ?? '' }}<br>
                    <b>CIN:</b> {{ $company->companySetting->cin_no ?? '' }} <br>
                    <b>Phone:</b> {{ $company->companySetting->phone ?? '' }} &nbsp; <b>Email:</b> {{ $company->companySetting->email ?? '' }}
                </td>
            </tr>
        </table>
    </div>

    <div class="title">FREIGHT CERTIFICATE</div>
    @php
        $countExRate = 0;
        $countRate = 0;
        $countContainer = count($seaImport->container);
        $totalCbm = 0;
        
        foreach($seaImport->container as $container){
            $countExRate = $container->ex_rate;
            $countRate = $container->rate;
            $totalCbm += $container->cbm;
        }
        $currAmount = $countContainer * $countRate;
        $totalAmount = $countExRate * $currAmount;
    @endphp
    <div class="details">
        <ul>
            <li><strong>MBL NO:</strong> {{ $seaImport->mbl_no }} <span class="right-info">MBL DATE: {{ $seaImport->mbl_date }}</span></li>
            <li><strong>HBL NO:</strong> {{ $seaImport->hbl_no }} <span class="right-info">HBL DATE: {{ $seaImport->hbl_date }}</span></li>
            <li><strong>PORT OF LOADING:</strong> {{ $seaImport->loadingPortName->port_name ?? '' }}</li>
            <li><strong>PORT OF DELIVERY:</strong> {{ $seaImport->deliveryPortName->port_name ?? '' }}</li>
            <li><strong>PACKAGES:</strong> {{ $seaImport->quantity }}</li>
            <li><strong>WEIGHT / VOLUME</strong>: {{ $seaImport->gross_weight }} KGS / {{ $totalCbm }} CBM</li>
            <li><strong>TYPE OF CARGO:</strong> {{ $seaImport->cargo_type }}</li>
            <li><strong>FREIGHT</strong>: 
                @if($seaImport->freight == 'C')
                    Collect
                @else
                    Prepaid
                @endif
            </li>
            <!--<li><strong>FREIGHT AMOUNT</strong>: {{ $seaImport->amount }}</li>-->
            @if($seaImport->ex_work != '')
                <li><strong>EX WORK</strong>: {{ $seaImport->ex_work }}</li>
                <li>
                    <strong>TOTAL AMOUNT</strong>:
                    {{ $seaImport->amount + (float) filter_var($seaImport->ex_work, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) }} USD
                </li>
            @endif
        </ul>
    </div>
    
    @if(!empty($seaImport->container))
    <table class="charges-table">
        <thead>
            <td>Charge Name</td>
            <td>Currency</td>
            <td>Ex Rate</td>
            <td>Rate</td>
            <td>Qty</td>
            <td>Freight Amount(USD)</td>
            <td>Amount(INR)</td>
        </thead>
        <tbody>
        <tr>
            <td>FREIGHT CHARGE</td>
            <td>USD</td>
            <td>{{$countExRate}}</td>
            <td>{{$countRate}}</td>
            <td>{{$countContainer}}</td>
            <td>{{$currAmount}}</td>
            <td>{{$totalAmount}}</td>
        </tr>
    </tbody>
    </table>
    @endif
    
    <div class="signature">
        For {{ $company->company_name }}<br><br><br><br>
        Authorized Signatory<br>
        Place: Jaipur<br>
        Date: {{ date('d-m-Y') }}
    </div>
</div>

</body>
</html>
