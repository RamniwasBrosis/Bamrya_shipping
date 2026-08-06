@extends('admin-main.layouts.default')
@section('content')
@php
use Carbon\Carbon;
@endphp
<style>
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
    -webkit-appearance: none;
    -moz-appearance: none;
    background-color: gray;
    color: #fff;
    border: none;
    padding: 10px 40px 10px 15px;
    border-radius: 6px;
    font-size: 14px;
    cursor: pointer;
    font-weight: 500;
    outline: none;
    transition: background-color 0.2s ease;
}

.export-dropdown select:hover {
    background-color: #0056b3;
}

.export-dropdown::after {
    content: "▼";
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: white;
    pointer-events: none;
    font-size: 10px;
}
</style>

<div class="download-buttons">
    <div class="export-dropdown">
        <form id="exportForm" action="{{ route('bl.cargoArrivalDetails-seaImp', $seaImport->id) }}" method="GET">
            <select name="format" onchange="document.getElementById('exportForm').submit();">
                <option value="">Export</option>
                <option value="pdf">📄 PDF</option>
                <!--<option value="excel">📊 Excel</option>-->
                <!--<option value="word">📝 Word</option>-->
            </select>
        </form>
    </div>
</div>

<section class="invoice-container">
    <style>
        .invoice-container {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 10px;
            color: #000;
            background-color: #fff;
            padding: 20px;
            max-width: 850px;
            margin: auto;
        }
        .bold { font-weight: bold; }

        /* Header & Title (Full Width) */
        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 2px solid #000;
            padding-bottom: 5px;
            margin-bottom: 5px;
        }
        .invoice-header .logo-text {
            font-size: 22px;
            font-weight: bold;
            color: #0d99ff;
            letter-spacing: -1px;
        }
        .invoice-header .logo-text span { color: #0d99ff; }
        .invoice-header .company-details {
            text-align: right;
            font-size: 9px;
            line-height: 1.3;
        }
        .invoice-header .company-name { font-weight: bold; font-size: 11px; }
        .invoice-title-box {
            text-align: center;
            font-size: 11px;
            font-weight: bold;
            border: 1px solid #000;
            padding: 4px;
            margin: 8px 0;
        }

        /* NEW: Two-Column Main Layout */
        .main-content-grid {
            display: flex;
            gap: 8px; /* Space between left and right columns */
            margin-bottom: 8px;
        }
        .left-column, .right-column {
            width: 50%;
            display: flex;
            flex-direction: column;
            gap: 8px; /* Space between boxes within a column */
        }

        /* Box Styling */
        .party-box {
            border: 1px solid #000;
            padding: 5px;
            font-size: 9px;
            line-height: 1.3;
            min-height: 107px;
        }
        .party-box-label {
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 4px;
            display: block;
        }
        .reference-box {
            border: 1px solid #000;
            font-size: 9px;
        }
        .reference-box .ref-row {
            display: flex;
            padding: 4px 5px;
            border-bottom: 1px solid #000;
        }
        .reference-box .ref-row:last-child { border-bottom: none; }
        .reference-box .ref-label {
            width: 70px;
            font-weight: bold;
            flex-shrink: 0;
        }

        /* Shipment Details Box */
        .shipment-details {
            border: 1px solid #000;
            /*padding: 5px;*/
            display: flex;
            font-size: 9px;
        }
        .shipment-details-col { width: 50%; }
        .shipment-details-item {
            display: flex;
            /*border-bottom: 1px solid #ccc;*/
            /*padding: 1px 0;*/
            min-height: 16px;
        }
        .shipment-details-item .label {
            width: 75px;
            font-weight: bold;
            flex-shrink: 0;
            /*padding-left: 2px;*/
        }
        /*.shipment-details-item .value { padding-left: 2px; }*/

        /* Full Width Items Table */
        .items-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 9px;
        }
        .items-table th, .items-table td {
            border: 1px solid #000;
            padding: 4px;
            text-align: left;
        }
        .items-table thead th {
            font-weight: bold;
            background-color: #f2f2f2;
        }
        .items-table .text-right { text-align: right; }
        .items-table .total-label { font-weight: bold; text-align: right; }

        /* Footer */
        .footer-notes {
            margin-top: 15px;
            font-size: 9px;
            line-height: 1.5;
        }
        .footer-notes p { margin: 5px 0; }
    </style>

    <div class="invoice-header">
        <div class="logo-text">{{ $company->company_name }}</div>
        <div class="company-details">
            <div class="company-name">{{ $company->company_name }}</div>
            <div>{{ $seaImport->branch->address ?? $company->address }}</div>
            <div><span class="bold">PAN NO.:</span> {{ $seaImport->branch->pan_no ?? $company->companySetting->pan_no }} <span class="bold">GSTIN:</span> {{ $seaImport->branch->gstin_no ?? $company->companySetting->gstin_no }}</div>
            <div><span class="bold">CIN:</span> {{ $seaImport->branch->cin_no ?? $company->companySetting->cin_no }}</div>
            <div><span class="bold">PHONE:</span> {{ $seaImport->branch->phone ?? $company->companySetting->phone }} &nbsp; <b>Email:</b>{{ $company->companySetting->email ?? '' }}</div>
        </div>
    </div>
    <div class="invoice-title-box">CARGO ARRIVAL NOTICE/PERFORMA INVOICE</div>

    <div class="main-content-grid">
        <div class="left-column">
            <div class="party-box">
                <span class="party-box-label">Notify Party (Broker)</span>
                <div>{{ $seaImport->notifyName->party_name ?? '' }}</div>
                <div>{{ $seaImport->notifyName->address_line1 ?? '' }}</div>
                <div>{{ $seaImport->notifyName->address_line2 ?? '' }}</div>
                <div style="margin-top: 5px;"><span class="bold">GST ID:{{ $seaImport->notifyName->gstin ?? '' }}</span> <span class="bold">STATE Code:</span> 08</div>
            </div>
            <div class="party-box">
                <span class="party-box-label">Consignee</span>
                <div>{{ $seaImport->consignee->party_name }}</div>
                <div>{{ $seaImport->consignee->address_line1 ?? '' }}</div>
                <div>{{ $seaImport->consignee->address_line2 ?? '' }}</div>
                <div style="margin-top: 5px;"><span class="bold">GST ID:{{ $seaImport->consignee->gstin ?? '' }}</span> <span class="bold">STATE Code:</span> 08</div>
            </div>
            <div class="party-box">
                <span class="party-box-label">Shipper</span>
                <div>{{ $seaImport->shipperName->party_name }}</div>
                <div>{{ $seaImport->shipperName->address_line1 }}</div>
                <div>{{ $seaImport->shipperName->address_line2 }}</div>
                <!--<div style="margin-top: 5px;"><span class="bold">Sales Ref.:</span> 8591017</div>-->
            </div>
        </div>

        <div class="right-column">
            <div class="reference-box">
                <div class="ref-row"><div class="ref-label">Job Ref No.</div><div class="ref-value">: {{ ($seaImport->ref_no ?? '') . ' . / . ' . (\Carbon\Carbon::parse($seaImport->hbl_date)->format('d-m-Y')) }}</div></div>
                <div class="ref-row"><div class="ref-label">Invoice Ref No.</div><div class="ref-value">: {{ $seaImport->inv_ref_no }}</div></div>
                <div class="ref-row"><div class="ref-label">IGM NO / DT</div><div class="ref-value">: {{ $seaImport->igm_no . ' . / . ' . (\Carbon\Carbon::parse($seaImport->igm_date)->format('d-m-Y'))}}</div></div>
            </div>
            <div class="shipment-details">
                <table style="width:100%; border-collapse:collapse; font-size:9px;height: 260px;">
                    <tr>
                        <td style="width:75px; font-weight:bold; padding:2px 4px;">PO #</td>
                        <td style="padding:2px 4px; border-right:1px solid #ccc;"></td>
                        <td style="width:75px; font-weight:bold; padding:2px 4px;"></td>
                        <td style="padding:2px 4px;"></td>
                    </tr>
                    <tr>
                        <td style="width:75px; font-weight:bold; padding:2px 4px;">HBL No</td>
                        <td style="padding:2px 4px; border-right:1px solid #ccc;">: {{ $seaImport->hbl_no ?? '' }}</td>
                        <td style="width:75px; font-weight:bold; padding:2px 4px;">DATE</td>
                        <td style="padding:2px 4px;">: {{ \Carbon\Carbon::parse($seaImport->hbl_date)->format('d-m-Y') ?? '' }}</td>
                    </tr>
                    <tr>
                        <td style="width:75px; font-weight:bold; padding:2px 4px;">ORIGIN</td>
                        <td style="padding:2px 4px; border-right:1px solid #ccc;">: {{ $seaImport->receiptPortName->port_name ?? '' }}</td>
                        <td style="width:75px; font-weight:bold; padding:2px 4px;">Carrier Name</td>
                        <td style="padding:2px 4px;">: {{ $seaImport->shippingLine->shipping_line_name ?? '' }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold; padding:2px 4px;">Vsl/Voy</td>
                        <td style="padding:2px 4px; border-right:1px solid #ccc;">: {{ $seaImport->vessel_name ?? '' }} / {{ $seaImport->voyage_no ?? '' }}</td>
                        <td style="font-weight:bold; padding:2px 4px;">Service</td>
                        <td style="padding:2px 4px;">: {{ $seaImport->container->first()->fcl_lcl ?? '' }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold; padding:2px 4px;">Booking No</td>
                        <td style="padding:2px 4px; border-right:1px solid #ccc;">: {{ $seaImport->booking_no ?? '' }}</td>
                        <td style="font-weight:bold; padding:2px 4px;">Arrival Date</td>
                        <td style="padding:2px 4px;">: {{ \Carbon\Carbon::parse($seaImport->arrival_date)->format('d-m-Y') ?? '' }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold; padding:2px 4px;">OBL No</td>
                        <td style="padding:2px 4px; border-right:1px solid #ccc;">: {{ $seaImport->obl_no ?? '' }}</td>
                        <td style="font-weight:bold; padding:2px 4px;">DATE</td>
                        <td style="padding:2px 4px;">: {{ \Carbon\Carbon::parse($seaImport->obl_date)->format('d-m-Y') ?? '' }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold; padding:2px 4px;">POL</td>
                        <td style="padding:2px 4px; border-right:1px solid #ccc;">: {{ $seaImport->loadingPortName->port_name ?? '' }}</td>
                        <td style="font-weight:bold; padding:2px 4px;">ETD</td>
                        <td style="padding:2px 4px;">: {{ \Carbon\Carbon::parse($seaImport->etd_date)->format('d-m-Y') ?? '' }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold; padding:2px 4px;">POD</td>
                        <td style="padding:2px 4px; border-right:1px solid #ccc;">: {{ $seaImport->dischargePortName->port_name ?? '' }}</td>
                        <td style="font-weight:bold; padding:2px 4px;">ETA</td>
                        <td style="padding:2px 4px;">: {{ \Carbon\Carbon::parse($seaImport->eta_date)->format('d-m-Y') ?? '' }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold; padding:2px 4px;">Final Dest.</td>
                        <td style="padding:2px 4px; border-right:1px solid #ccc;">: {{ $seaImport->deliveryPortName->port_name ?? '' }}</td>
                        <td style="font-weight:bold; padding:2px 4px;">Item No</td>
                        <td style="padding:2px 4px;">: {{ $seaImport->item_no ?? '' }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold; padding:2px 4px;">Warehouse</td>
                        <td style="padding:2px 4px; border-right:1px solid #ccc;">: {{ $seaImport->cfsYardName->party_name ?? '' }}</td>
                        <td style="font-weight:bold; padding:2px 4px;">Sub Item No</td>
                        <td style="padding:2px 4px;">: {{ $seaImport->sub_item_no ?? '' }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold; padding:2px 4px;"></td>
                        <td style="padding:2px 4px; border-right:1px solid #ccc;"></td>
                        <td style="font-weight:bold; padding:2px 4px;"></td>
                        <td style="padding:2px 4px; border-right:1px solid #ccc;"></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

        @php
            // Fix package code label
            $code = $seaImport->packageName->package_code ?? null;

            switch ($code) {
                case 'PKGS':   $pkgLabel = 'PKG'; break;
                case 'PALLETS':$pkgLabel = 'PLT'; break;
                case 'CTN':    $pkgLabel = 'CTN'; break;
                case 'ROLLS':  $pkgLabel = 'ROLLS'; break;
                default:       $pkgLabel = 'Qty';
            }

            // Totals
            $totalQty = 0;
            $totalGross = 0;
            $totalCbm = 0;
        @endphp

        <table border="1" cellspacing="0" cellpadding="5" style="width:100%; border-collapse:collapse; font-family:Arial, sans-serif; font-size:12px; text-align:center;">
            <thead>
                <tr style="background-color:#f2f2f2;">
                    <th style="width:15%;">Marks & Numbers</th>
                    <th style="width:20%;">Description</th>
                    <th style="width:20%;">Container</th>
                    <th style="width:10%;">Seal</th>
                    <th style="width:5%;">{{ $pkgLabel }}</th>
                    <th style="width:15%;">Weight</th>
                    <th style="width:15%;">Volume</th>
                </tr>
            </thead>

            <tbody>

                @foreach($seaImport->container as $c)

                    @php
                        $totalQty   += $c->total_package ?? 0;
                        $totalGross += $c->gross_weight ?? 0;
                        $totalCbm   += $c->cbm ?? 0;
                    @endphp

                    <tr>
                        <td>{{ $c->mark_and_numbers ?? '' }}</td>

                        <td>
                            {{ $c->goods_description ?? '' }}<br>
                            Cus Inv: {{ $c->customer_inv_no ?? '' }}
                        </td>

                        <td>
                            {{ $c->container_no ?? '' }} <br>
                            <small>Size: {{ $c->size ?? '' }}</small>
                        </td>

                        <td>
                            {{ $c->agentSealNo ?? '' }}
                        </td>

                        <td>{{ $c->total_package ?? '0' }}</td>

                        <td>{{ $c->gross_weight ?? '0' }} KGS</td>

                        <td>{{ $c->cbm ?? '0' }} CBM</td>
                    </tr>

                @endforeach

                <!-- Totals Row -->
                <tr style="font-weight:bold;">
                    <td colspan="4" style="text-align:right;">Total :</td>
                    <td>{{ $totalQty }}</td>
                    <td>{{ $totalGross }} KGS</td>
                    <td>{{ $totalCbm }} CBM</td>
                </tr>

            </tbody>
        </table>
        <br><br>

    <div class="footer-notes">
        <p>Kindly submit the ORIGINAL BILL OF LADING with endorsements to release the shipment.</p>
        <p>The above mentioned vessel is expected to arrive on or about {{ $seaImport->delivery_order_date }} at <span class="bold">{{ $seaImport->loadingPortName->port_name ?? '' }}</span></p>
        <p>Payment should be by Demand Draft /Pay order favoring {{ $company->company_name }}. We are at your service for the task of custom clearing through us per contract basis. We are sending Notice to you so that you can make all arrangements for speedy clearance of cargo on arrival of the vessel and avoid payment of port demurrage charges or container detention charges. You are requested to obtain delivery order from our office by surrendering the Original bill of Lading received by you after the payment of relevant charges.</p>
        <p>We thank you for using our services and assure you of our best attention, at all times.</p>
        <p>Please note that cargoes remaining undelivered for 30 days from the date of arrival will be listed for auction and will be duly auctioned upon completion of Customs & CFS Formalities.</p>
    </div>
</section>

@endsection

@push('scripts')

@endpush
