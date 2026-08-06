@extends('admin-main.layouts.default')
@section('content')
@php
use Carbon\Carbon;
@endphp

<style>
    .invoice-header {
        display: flex;
        /*justify-content: space-between;*/
        align-items: flex-start;
        /*border-bottom: 2px solid #000;*/
        padding-bottom: 10px;
        margin-bottom: 20px;
    }
    .logo-text {
        font-size: 26px;
        font-weight: bold;
        color: #004080;
        letter-spacing: 1px;
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

    .report-header {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 20px;
    }
    .export-dropdown {
        float: right;
        margin-bottom: 20px;
    }
    table {
        width: 80%;
        border-collapse: collapse;
        /*margin-bottom: 25px;*/
    }
    th, td {
        border: 1px solid #000;
        padding: 8px 10px;
        vertical-align: top;
    }
    th {
        background: #e7e7e7;
        text-align: left;
    }
    .section-title {
        font-weight: bold;
        margin-bottom: 10px;
        border-bottom: 2px solid #000;
        display: inline-block;
        padding-bottom: 4px;
    }
    .whole-container{
        width: 80%;
    }
</style>
<div class="whole-container" style="background: #ffffff;">
    <!-- ✅ Report Header -->
    <div class="report-header">
        <!--LOADING CONFIRM REPORT :-->&nbsp;
        <div class="export-dropdown">
            <form id="exportForm" action="{{ route('bl.exportLoadingConfirmation-seaExp', $seaExport->id) }}" method="GET">
                <select name="format" onchange="document.getElementById('exportForm').submit();">
                    <option value="">Export</option>
                    <option value="pdf">PDF</option>
                    <option value="excel">Excel</option>
                    <option value="word">Word</option>
                </select>
            </form>
        </div>
    </div>

    <!-- ✅ Company Header -->
    <table border="0" width="100%" style="margin-bottom: 10px;">
        <tr>
            <!-- Left: Logo -->
            <td style="width: 25%; vertical-align: top; border: 0px;">
                <img src="{{ $logoUrl }}"
                     alt="Company Logo"
                     style="width:120px; height:auto;">
            </td>

            <!-- Right: Company Details -->
            <td style="text-align: right; width: 75%; vertical-align: top;border: 0px;">
                <div style="font-size:16px; font-weight:bold; color:#004080;">
                    {{ $company->company_name }}
                </div>
                <div>{{ $seaExport->branch->address ?? $company->address}}</div>
                <div><strong>PAN NO.:</strong> {{ $seaExport->branch->pan_no ?? $company->companySetting->pan_no}} &nbsp;&nbsp;
                     <strong>GSTIN:</strong> {{ $seaExport->branch->gstin_no ?? $company->companySetting->gstin_no}}
                </div>
                <div><strong>CIN:</strong> {{ $seaExport->branch->cin_no ?? $company->companySetting->cin_no}}</div>
            </td>
        </tr>
    </table>
    <hr style="opacity: 1; width: 80%; border-width: 3px;">

    <!-- ✅ Loading Confirmation Details -->
    <div class="section-title">LOADING CONFIRMATION DETAILS :-</div>
    <table style="margin-bottom:25px;">
        <tr><th>JOB NO.</th><td>{{ $seaExport->jobMaster->job_no ?? '' }}</td></tr>
        <tr><th>HBL NO.</th><td>{{ $seaExport->hbl_no ?? '' }}</td></tr>
        <tr><th>MBL NO.</th><td>{{ $seaExport->mbl_no ?? '' }}</td></tr>
        <tr><th>SHIPPER</th><td>{{ $seaExport->shipperName->party_name ?? '' }}</td></tr>
        <tr><th>CONSIGNEE / NOTIFY</th><td>{{ $seaExport->ConsigneeName->party_name ?? '' }}</td></tr>
        <tr><th>CUST INVOICE NO.</th><td>{{ optional($seaExport->container->first())->customer_inv_no ?? '' }}</td></tr>
        <tr><th>S/BILL NO. / DATE</th><td>{{ optional($seaExport->container->first())->sbill_no ?? '' }}</td></tr>
        <!--<tr><th>NO. OF PKGS</th><td>{{ $seaExport->container->first()->total_package ?? '' }}</td></tr>-->
        <tr><th>CBM</th><td>{{ $seaExport->cbm ?? '' }}</td></tr>
        <tr><th>NT. / GR. WT.</th><td>{{ ($seaExport->net_weight ?? '') . ' / ' . ($seaExport->gross_weight ?? '') }}</td></tr>
        <tr><th>PORT OF LOADING</th><td>{{ $seaExport->loadingPortName->port_name ?? '' }}</td></tr>
        <tr><th>PORT OF DISCHARGE / FPOD</th><td>{{ ($seaExport->dischargePortName->port_name ?? '') . ' / ' . ($seaExport->deliveryPortName->port_name ?? '') }}</td></tr>
        <tr><th>VSL / VOY.</th><td>{{ ($seaExport->vessel_name ?? '') . ' / ' . ($seaExport->voyage_no ?? '') }}</td></tr>
        <!--<tr><th>SOB</th><td>{{ $seaExport->sob_date ? Carbon::parse($seaExport->sob_date)->format('d/m/Y') : '' }}</td></tr>-->
        <tr><th>ETD / SAIL ON DATE</th><td>{{ $seaExport->etd_date ? Carbon::parse($seaExport->etd_date)->format('d/m/Y') : '' }}</td></tr>
    </table>

    <!-- Container Details -->
    <div class="section-title">CONTAINER DETAILS:</div>
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
                @if($seaExport->container && $seaExport->container->count())
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
                        <td colspan="5" style="text-align:center;">No container data available</td>
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
                @if($seaExport->container && $seaExport->container->count())
                    @foreach($seaExport->container as $container)
                        <tr>
                            <td>{{ $container->container_no }}</td>
                            <td>{{ $container->cust_seal_no ?? '' }}</td>
                            <td>{{ $container->agent_seal_no ?? '' }}</td>
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
@endsection

@push('scripts')
@endpush
