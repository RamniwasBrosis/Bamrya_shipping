@php
use Carbon\Carbon;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cargo Arrival</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 10px;
            color: #000;
        }
        .invoice-container {
            width: 700px;
            margin: 0 auto;
            padding: 10px;
        }
        .bold { font-weight: bold; }
        .center { text-align: center; }

        /* Header */
        .header-table {
            width: 100%;
            border-bottom: 2px solid #000;
            margin-bottom: 5px;
        }
        .header-table td {
            vertical-align: top;
        }
        .logo-text {
            font-size: 22px;
            font-weight: bold;
            color: #0d99ff;
            letter-spacing: -1px;
        }
        .logo-text span { color: #0d99ff; }
        .company-details {
            text-align: right;
            font-size: 9px;
            line-height: 1.4;
        }

        .invoice-title {
            text-align: center;
            font-size: 11px;
            font-weight: bold;
            border: 1px solid #000;
            padding: 5px;
            margin: 8px 0;
        }

        /* Two-column section */
        .two-col {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 8px;
        }
        .two-col td {
            vertical-align: top;
            padding: 2px;
        }

        .box {
            border: 1px solid #000;
            padding: 4px;
            font-size: 9px;
            line-height: 1.3;
            min-height: 105px;
        }
        .box-title {
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 4px;
            display: block;
        }

        /* Reference and shipment tables */
        .ref-table, .ship-table {
            width: 100%;
            border: 1px solid #000;
            border-collapse: collapse;
            font-size: 9px;
            min-height: 100px;
        }
        .ref-table td, .ship-table td {
            /*border: 1px solid #000;*/
            padding: 3px;
            vertical-align: top;
            padding: 6px 1px;
        }
        .label { font-weight: bold; width: 50px; }

        /* Items table */
        .items-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 9px;
        }
        .items-table th, .items-table td {
            border: 1px solid #000;
            padding: 4px;
            text-align: center;
        }
        .items-table thead th {
            background: #f2f2f2;
        }

        /* Footer */
        .footer-notes {
            font-size: 9px;
            margin-top: 15px;
            line-height: 1.5;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <table class="header-table">
            <tr>
                <td>
                    <div class="logo-text">{{ $company->company_name }}</div>
                </td>
                <td class="company-details">
                    <div class="bold">{{ $company->company_name }}</div>
                    {{ $seaImport->branch->address ?? $company->address }}<br>
                    <span class="bold">PAN NO.:</span> {{ $seaImport->branch->pan_no ?? $company->companySetting->pan_no }}
                    <span class="bold">GSTIN:</span> {{ $seaImport->branch->gstin_no ?? $company->companySetting->gstin_no }}<br>
                    <span class="bold">CIN:</span> {{ $seaImport->branch->cin_no ?? $company->companySetting->cin_no }}<br>
                    <span class="bold">PHONE:</span> {{ $seaImport->branch->phone ?? $company->companySetting->phone }}
                    <span class="bold">EMAIL:</span> {{ $company->companySetting->email ?? '' }}
                </td>
            </tr>
        </table>

        <div class="invoice-title">CARGO ARRIVAL NOTICE / PERFORMA INVOICE</div>

        <table class="two-col">
            <tr>
                <td width="50%">
                    <div class="box">
                        <span class="box-title">Notify Party (Broker)</span>
                        {{ $seaImport->notifyName->party_name ?? '' }}<br>
                        {{ $seaImport->notifyName->address_line1 ?? '' }}<br>
                        {{ $seaImport->notifyName->address_line2 ?? '' }}<br>
                        <b>GST ID:</b> {{ $seaImport->notifyName->gstin ?? '' }}
                        <b>STATE Code:</b> 08
                    </div>

                    <div class="box">
                        <span class="box-title">Consignee</span>
                        {{ $seaImport->consignee->party_name ?? '' }}<br>
                        {{ $seaImport->consignee->address_line1 ?? '' }}<br>
                        {{ $seaImport->consignee->address_line2 ?? '' }}<br>
                        <b>GST ID:</b> {{ $seaImport->consignee->gstin ?? '' }}
                        <b>STATE Code:</b> 08
                    </div>

                    <div class="box">
                        <span class="box-title">Shipper</span>
                        {{ $seaImport->shipperName->party_name ?? '' }}<br>
                        {{ $seaImport->shipperName->address_line1 ?? '' }}<br>
                        {{ $seaImport->shipperName->address_line2 ?? '' }}
                    </div>
                </td>

                <td width="50%" class="cargo-second-box">
                    <table class="ref-table">
                        <tr><td class="label"></td><td></td></tr>
                        <tr><td style="font-weight: bold; width: 80px;">Job Ref No.</td><td>{{ ($seaImport->ref_no ?? '') . '/' . (\Carbon\Carbon::parse($seaImport->hbl_date)->format('d-m-Y')) }}</td></tr>
                        <tr><td style="font-weight: bold; width: 80px;">Invoice Ref No.</td><td>{{ $seaImport->inv_ref_no }}</td></tr>
                        <tr><td style="font-weight: bold; width: 80px;">IGM NO / DT</td><td>{{ $seaImport->igm_no ?? '' }} / {{ (\Carbon\Carbon::parse($seaImport->igm_date)->format('d-m-Y')) }}</td></tr>
                        <tr><td class="label"></td><td></td></tr>
                    </table>

                    <table class="ship-table">
                        <tr>
                          <td class="label">PO #</td>
                          <td></td>
                          <td class="label"></td>
                          <td></td>
                        </tr>
                       <tr>
                          <td class="label">HBL No</td>
                          <td>: {{ $seaImport->hbl_no ?? '' }}</td>
                          <td class="label">DATE</td>
                          <td>: {{ \Carbon\Carbon::parse($seaImport->hbl_date)->format('d-m-Y') ?? '' }}</td>
                       </tr>
                       <tr>
                          <td class="label">ORIGIN</td>
                          <td>: {{ $seaImport->receiptPortName->port_name ?? '' }}</td>
                          <td class="label">Carrier</td>
                          <td>: {{$seaImport->shippingLine->shipping_line_name??''}}</td>
                       </tr>
                       <tr>
                          <td class="label">Vsl/Voy</td>
                          <td>: {{ $seaImport->vessel_name ?? '' }} / {{ $seaImport->voyage_no ?? '' }}</td>
                          <td class="label">Service</td>
                          <td>: {{ $seaImport->container->first()->fcl_lcl ?? '' }}</td>
                       </tr>
                       <tr>
                          <td class="label">Booking No</td>
                          <td>: {{$seaImport->booking_no??''}}</td>
                          <td class="label">Arrival Date</td>
                          <td>: {{ \Carbon\Carbon::parse($seaImport->arrival_date)->format('d-m-Y') ?? '' }}</td>
                       </tr>
                       <tr>
                          <td class="label">OBL No</td>
                          <td>: {{ $seaImport->obl_no ?? '' }}</td>
                          <td class="label">DATE</td>
                          <td>: {{ \Carbon\Carbon::parse($seaImport->obl_date)->format('d-m-Y') ?? '' }}</td>
                       </tr>
                       <tr>
                          <td class="label">POL</td>
                          <td>: {{ $seaImport->loadingPortName->port_name ?? '' }}</td>
                          <td class="label">ETA</td>
                          <td>: {{ \Carbon\Carbon::parse($seaImport->etd_date)->format('d-m-Y') ?? '' }}</td>
                       </tr>
                       <tr>
                          <td class="label">POD</td>
                          <td>: {{ $seaImport->dischargePortName->port_name ?? '' }}</td>
                          <td class="label">ETA</td>
                          <td>: {{ \Carbon\Carbon::parse($seaImport->eta_date)->format('d-m-Y') ?? '' }}</td>
                       </tr>
                       <tr>
                          <td class="label">Final Dest.</td>
                          <td>: {{ $seaImport->deliveryPortName->port_name ?? '' }}</td>
                          <td class="label">Item No.</td>
                          <td>: {{ $seaImport->item_no ?? '' }}</td>
                       </tr>
                       <tr>
                          <td class="label">Warehouse</td>
                          <td>: {{$seaImport->cfsYardName->party_name??''}}</td>
                          <td class="label">Sub Item</td>
                          <td>: {{ $seaImport->sub_item_no ?? '' }}</td>
                       </tr>
                    </table>
                </td>
            </tr>
        </table>

        <table class="items-table" border="1" cellspacing="0" cellpadding="5" style="margin-bottom:1.5rem; width:100%; border-collapse:collapse; font-family:Arial, sans-serif; font-size:12px; text-align:center;">
            <thead>
                <tr style="background-color:#f2f2f2;">
                    <th>Marks & Numbers</th>
                    <th>Description</th>
                    <th>Container</th>
                    <th>Seal</th>
                    <th>
                        @php
                            $code = $seaImport->packageName->package_code ?? null;

                            switch ($code) {
                                case 'PKGS': echo 'PKG'; break;
                                case 'PALLETS': echo 'PLT'; break;
                                case 'CTN': echo 'CTN'; break;
                                case 'ROLLS': echo 'ROLLS'; break;
                                default: echo 'Qty';
                            }
                        @endphp
                    </th>
                    <th>Weight</th>
                    <th>Volume</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalQuantity = 0;
                    $totalWeight = 0;
                    $totalVolume = 0;
                @endphp

                @foreach($seaImport->container as $cont)
                    <tr>
                        <td>{{ $cont->mark_and_numbers ?? '' }}</td>
                        <td>{{ $cont->goods_description ?? '' }}</td>
                        <td>{{ $cont->container_no ?? '' }}</td>
                        <td>{{ $cont->agentSealNo ?? '' }}</td>
                        <td>{{ $cont->total_package ?? '' }}</td>
                        <td>{{ $cont->gross_weight ?? '' }}</td>
                        <td>{{ $cont->cbm ?? '' }}</td>
                    </tr>

                    @php
                        $totalQuantity += $cont->total_package ?? 0;
                        $totalWeight += $cont->gross_weight ?? 0;
                        $totalVolume += $cont->cbm ?? 0;
                    @endphp
                @endforeach

                <tr>
                    <td colspan="4" class="bold" style="text-align:right;">Total :</td>
                    <td class="bold">{{ $totalQuantity }}</td>
                    <td class="bold">{{ $totalWeight }}</td>
                    <td class="bold">{{ $totalVolume }}</td>
                </tr>
            </tbody>
        </table>

        <div class="footer-notes">
            <p>Kindly submit the ORIGINAL BILL OF LADING with endorsements to release the shipment.</p>
            <p>The above mentioned vessel is expected to arrive on or about {{ $seaImport->delivery_order_date }} at <b>{{ $seaImport->loadingPortName->port_name ?? '' }}</b>.</p>
            <p>Payment should be by Demand Draft / Pay order favoring {{ $company->company_name }}. We are at your service for the task of custom clearing through us per contract basis.</p>
            <p>We thank you for using our services and assure you of our best attention, at all times.</p>
            <p>Please note that cargoes remaining undelivered for 30 days from the date of arrival will be listed for auction upon completion of Customs & CFS Formalities.</p>
        </div>
    </div>

</body>
</html>
