@php
use Carbon\Carbon;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Loading Confirmation Report</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            margin: 15px;
        }
        h2 {
            text-align: center;
            margin-bottom: 10px;
            text-transform: uppercase;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #333;
            padding: 3px 4px;
            text-align: left;
        }
        th {
            background: #f5f5f5;
        }
        .section {
            margin-top: 5px;
        }
        .section-title {
            font-weight: bold;
            font-size: 14px;
            border-bottom: 2px solid #000;
            margin-bottom: 5px;
        }

        /* --- Company Header Styling --- */
        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
        .company-logo img {
            width: 100px;        /* adjust as needed */
            height: auto;
        }
        .logo-text {
            font-size: 18px;
            font-weight: bold;
            color: #004080;
            letter-spacing: 1px;
            margin-top: 10px;
        }
        .logo-text span {
            color: #000;
        }
        .company-details {
            text-align: right;
            font-size: 12px;
            line-height: 1.4;
            margin-left: 138px;
        }
        .company-name {
            font-weight: bold;
            font-size: 14px;
        }
        .bold {
            font-weight: bold;
        }
        hr {
            opacity: 1;
            width: 100%;
            border-width: 2px;
            margin: 10px 0 25px 0;
        }
    </style>
</head>
<body>
    <!-- ✅ Company Header -->
    <table border="0" width="100%" style="margin-bottom: 5px;">
        <tr>
            <!-- Left: Logo -->
            <td style="width: 25%; vertical-align: top; border: 0px;">
                <img src="{{ $logoPath }}" style="width:120px; height:auto;" alt="Company logo">
            </td>
    
            <!-- Right: Company Details -->
            <td style="text-align: right; width: 75%; vertical-align: top;border: 0px;">
                <div style="font-size:16px; font-weight:bold; color:#004080;">
                    {{ $company->company_name }}
                </div>
                <div>{{$company->address}}</div>
                <div><strong>PAN NO.:</strong> {{$company->companySetting->pan_no}} &nbsp;&nbsp; 
                     <strong>GSTIN:</strong> {{$company->companySetting->gstin_no}}
                </div>
                <div><strong>CIN:</strong> {{$company->companySetting->cin_no}}</div>
            </td>
        </tr>
    </table>
    <hr>

    <h2>Loading Confirmation Report</h2>

    <div class="section">
        <div class="section-title">Loading Confirmation Details</div>
        <table style="margin-bottom: 15px;">
            <tr><th>Job No.</th><td>{{ $seaExport->jobMaster->job_no ?? '' }}</td></tr>
            <tr><th>HBL No.</th><td>{{ $seaExport->hbl_no ?? '' }}</td></tr>
            <tr><th>MBL No.</th><td>{{ $seaExport->mbl_no ?? '' }}</td></tr>
            <tr><th>Shipper</th><td>{{ $seaExport->shipperName->party_name ?? '' }}</td></tr>
            <tr><th>Consignee / Notify</th><td>{{ $seaExport->ConsigneeName->party_name ?? '' }}</td></tr>
            <tr><th>Customer Invoice No.</th><td>{{ optional($seaExport->container->first())->customer_inv_no ?? '' }}</td></tr>
            <tr><th>S/Bill No. / Date</th><td>{{ optional($seaExport->container->first())->sbill_no ?? '' }}</td></tr>
            <!--<tr><th>No. of Packages</th><td>{{ $seaExport->container->first()->total_package ?? '' }}</td></tr>-->
            <tr><th>CBM</th><td>{{ $seaExport->cbm ?? '' }}</td></tr>
            <tr><th>NT / GR WT</th><td>{{ ($seaExport->net_weight ?? '') . ' / ' . ($seaExport->gross_weight ?? '') }}</td></tr>
            <tr><th>PORT OF DISCHARGE / FPOD</th><td>{{ ($seaExport->dischargePortName->port_name ?? '') . ' / ' . ($seaExport->deliveryPortName->port_name ?? '') }}</td></tr>
            <tr><th>VSL / VOY</th><td>{{ ($seaExport->vessel_name ?? '') . ' / ' . ($seaExport->voyage_no ?? '') }}</td></tr>
            <tr><th>Load Port</th><td>{{ $seaExport->loadingPortName->port_name ?? '' }}</td></tr>
            <tr><th>ETD / SAIL ON Date</th><td>{{ $seaExport->etd_date ? Carbon::parse($seaExport->etd_date)->format('d/m/Y') : '' }}</td></tr>
            <!--<tr><th>SOB</th><td>{{ $seaExport->sob_date ? Carbon::parse($seaExport->sob_date)->format('d/m/Y') : '' }}</td></tr>-->
        </table>
    </div>

    <div class="section">
        <div class="section-title">Container Details</div>
        <!--1-->
        <!--1-->
        <table>
            <thead>
                <tr>
                    <th>POL // ETD</th>
                    <th>POD // ETA</th>
                    <th>VESSEL NAME</th>
                    <th>VOYAGE NO.</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $seaExport->loadingPortName->port_name ?? '' }} // {{ $seaExport->etd_date ?? '' }}</td>
                    <td>{{ $seaExport->dischargePortName->port_name ?? '' }} // {{ $seaExport->eta_date ?? '' }}</td>
                    <td>{{ $seaExport->vessel_name }}</td>
                    <td>{{ $seaExport->voyage_no }}</td>
                </tr>
            </tbody>
        </table>
        
        <!--2-->
        <table>
            <thead>
                <tr>
                    <th>GROSS WT.(IN KGS)</th>
                    <th>VOLUME</th>
                    <th>PACKAGE COUNT</th>
                    <th>PACKAGE TYPE</th>
                    <th>SHIPPING BILL NO // DATE</th>
                    <th>STUFFING POINT/DATE</th>
                </tr>
            </thead>
            <tbody>
                @if($seaExport->container && $seaExport->container->count() > 0)
                    @foreach($seaExport->container as $container)
                        <tr>
                            <td>{{ $container->gross_weight ?? '' }}</td>
                            <td>{{ $seaExport->volume_unit ?? '' }}</td>
                            <td>{{ $container->total_package }}</td>
                            <td>{{ $seaExport->packageName->package_code ?? '' }}</td>
                            <td>{{ $container->sbill_no ?? '' }}</td>
                            <td>{{ $seaExport->stuffing_point ?? '' }}/{{ $seaExport->stuffingDate ? Carbon::parse($seaExport->stuffingDate)->format('d/m/Y') : '' }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" style="text-align:center;">No container data available</td>
                    </tr>
                @endif
            </tbody>
        </table>
        
        <!--3-->
        <table>
            <thead>
                <tr>
                    <th>Container No</th>
                    <th>Custom Seal No</th>
                    <th>Agent Seal No</th>
                    <th>Size</th>
                    <th>Container Type</th>
                    <th>No of Packages</th>
                </tr>
            </thead>
            <tbody>
                @if($seaExport->container && $seaExport->container->count() > 0)
                    @foreach($seaExport->container as $container)
                        <tr>
                            <td>{{ $container->container_no }}</td>
                            <td>{{ $container->cust_seal_no }}</td>
                            <td>{{ $container->agent_seal_no }}</td>
                            <td>{{ $container->size }}</td>
                            <td>{{ $container->fcl_lcl }}</td>
                            <td>{{ $container->total_package }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" style="text-align:center;">No container data available</td>
                    </tr>
                @endif
            </tbody>
        </table>

    </div>

</body>
</html>
