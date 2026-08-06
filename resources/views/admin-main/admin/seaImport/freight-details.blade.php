@extends('admin-main.layouts.default')
@section('content')

@php
use Carbon\Carbon;
@endphp

<style>
/* Center page like your screenshot */
.invoice-container {
    width: 850px;
    margin: 0 auto;
    background: #fff;
    padding: 25px 35px;
    border: 1px solid #ccc;
    box-shadow: 0 0 5px #aaa;
    min-height: 800px;
}

/* Real A4 print size */
@media print {
    body {
        -webkit-print-color-adjust: exact !important;
    }
    .invoice-container {
        width: 100%;
        padding: 20mm;
        border: none !important;
        box-shadow: none !important;
    }
}

/* Header design */
.invoice-header {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 2px solid #000;
}

.logo-text {
    font-size: 28px;
    font-weight: bold;
    color: #0076D7;
}

.logo-text span {
    color: #000;
}

.company-details {
    text-align: right;
    font-size: 13px;
    line-height: 18px;
}

.company-name {
    font-size: 15px;
    font-weight: bold;
}

.title {
    text-align: center;
    font-size: 20px;
    font-weight: bold;
    text-decoration: underline;
    margin: 25px 0;
}

.details ul {
    list-style: none;
    padding: 0;
    line-height: 22px;
    font-size: 14px;
}

.right-info {
    float: right;
    font-weight: bold;
}

.signature {
    margin-top: 40px;
    font-size: 14px;
}

.signature img {
    height: 80px;
}

.download-buttons {
    display: flex;
    justify-content: flex-end;
    margin-bottom: 1rem;
}

.export-dropdown {
    position: relative;
    display: inline-block;
}

.export-dropdown select {
    appearance: none;
    background-color: gray;
    color: #fff;
    padding: 10px 40px 10px 15px;
    border-radius: 6px;
    cursor: pointer;
    border: none;
}

.export-dropdown::after {
    content: "▼";
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: white;
    font-size: 10px;
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


<!-- EXPORT BUTTON -->
<div class="download-buttons">
    <div class="export-dropdown">
        <form id="exportForm" action="{{ route('bl.freightCertificateExport-seaImp', $seaImport->id) }}" method="GET">
            <select name="format" onchange="document.getElementById('exportForm').submit();">
                <option value="">Export</option>
                <option value="pdf">📄 PDF</option>
                <option value="word">📝 Word</option>
            </select>
        </form>
    </div>
</div>

<!-- MAIN PAGE PREVIEW -->
<section class="invoice-container">

    <!-- HEADER -->
    <div class="invoice-header">
        <div class="logo-text">
            {{ $company->company_name }}
        </div>

        <div class="company-details">
            <div class="company-name">
                {{ $company->companySetting->company_name ?? $company->company_name }}
            </div>

            <div>
                {{ $seaImport->branch->address ?? $company->address }}
            </div>

            <div>
                <b>PAN NO:</b> {{ $seaImport->branch->pan_no ?? $company->companySetting->pan_no }}
                &nbsp;
                <b>GSTIN:</b> {{ $seaImport->branch->gstin_no ?? $company->companySetting->gstin_no }}
            </div>

            <div>
                <b>CIN:</b> {{ $seaImport->branch->cin_no ?? $company->companySetting->cin_no }}
            </div>
            <div>
                <b>Phone:</b> {{ $seaImport->branch->phone ?? $company->companySetting->phone }} &nbsp;&nbsp; <b>Email:</b> {{ $company->companySetting->email ?? '' }}
            </div>
        </div>
    </div>


    <!-- TITLE -->
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
    <!-- DETAILS -->
    <div class="details">
        <ul>
            <li>• <strong>MBL NO</strong>: {{ $seaImport->mbl_no }} <span class="right-info">MBL DATE: {{ $seaImport->mbl_date }}</span></li>
            <li>• <strong>HBL NO</strong>: {{ $seaImport->hbl_no }} <span class="right-info">HBL DATE: {{ $seaImport->hbl_date }}</span></li>
            <li>• <strong>PORT OF LOADING</strong>: {{ $seaImport->loadingPortName->port_name }}</li>
            <li>• <strong>PORT OF DELIVERY</strong>: {{ $seaImport->deliveryPortName->port_name ?? '' }}</li>
            <li>• <strong>PACKAGES</strong>: {{ $seaImport->quantity }}</li>
            <li>• <strong>WEIGHT / VOLUME</strong>: {{ $seaImport->gross_weight }} KGS / {{ $totalCbm }} CBM</li>
            <li>• <strong>TYPE OF CARGO</strong>: {{ $seaImport->cargo_type }}</li>
            <li>• <strong>FREIGHT</strong>:
                @if($seaImport->freight == 'C')
                    Collect
                @else
                    Prepaid
                @endif
            </li>
            <!--<li>• <strong>FREIGHT AMOUNT</strong>: {{ $seaImport->amount }}</li>-->
            @if($seaImport->ex_work != '')
                <li>• <strong>EX WORK</strong>: {{ $seaImport->ex_work }}</li>
                <li>•
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

    <!-- SIGN -->
    <div class="signature">
        For {{ $company->company_name }}<br><br>
        <br><br><br><br><br>
        Authorized Signatory<br>
        Place: Jaipur<br>
        Date: {{ date('d-m-Y') }}
    </div>

</section>

@endsection
