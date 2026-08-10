@php
    // Pre-calc totals & GST behaviour (defensive defaults)
    $totalAmount = $chargeDetails->sum('freight') ?? 0;
    $finalAmount = $chargeDetails->sum('total') ?? 0;
    $totalTdsPercent = $chargeDetails->sum('tds') ?? 0;
    $totalTdsAmount = $chargeDetails->sum('tds_amount') ?? 0;

    // GST total (combined)
    $gstAmount = 0;
    $cgstAmount = 0;
    $sgstAmount = 0;
    $igstAmount = 0;
    foreach ($chargeDetails as $charge) {
        if (($porformaInvoice->gst_type ?? 'local') === 'local') {
            $gstAmount += ($charge->cgst ?? 0) + ($charge->sgst ?? 0);
        } else {
            $gstAmount += ($charge->igst ?? 0);
        }
        $cgstAmount += $charge->cgst ?? 0;
        $sgstAmount += $charge->sgst ?? 0;
        $igstAmount += $charge->igst ?? 0;
    }

    // Final amount before rounding (subtract TDS amount if applicable)
    $finalAmountWithTds = $finalAmount - $totalTdsAmount;

    // Round off logic: same as your preview logic
    $decimal = $finalAmountWithTds - floor($finalAmountWithTds);
    if ($decimal < 0.50) {
        $roundedTotal = floor($finalAmountWithTds);
    } else {
        $roundedTotal = ceil($finalAmountWithTds);
    }
    $roundOff = $roundedTotal - $finalAmountWithTds;

    // Amount in words using en_IN spellout (use fully-qualified class name)
    try {
        $f = new \NumberFormatter('en_IN', \NumberFormatter::SPELLOUT);
        $amountInWords = ucfirst($f->format($roundedTotal)) . ' only';
    } catch (\Throwable $e) {
        // fallback if intl extension is not available
        $amountInWords = '';
    }

    // Helpers to format numbers consistently
    function fmt($v) {
        return number_format((float) $v, 2, '.', ',');
    }
@endphp


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Proforma Invoice - {{ $porformaInvoice->invoice_no ?? '' }}</title>

    <style>
        /* Page size and margins */
        @page {
            size: A4 portrait;
            margin:8mm 8mm;
        }

        /* Base */
        html, body {
            margin: 5px;
            padding: 5px;
        }

        /* Prevent table breaks inside rows */
        table { border-collapse: collapse; width: 100%; table-layout: fixed; word-break: break-word; }
        tr, td, th { page-break-inside: avoid; }

        /* Header */
        .header-table { margin-bottom: 1px; border-left: 1px solid #000;border-right: 1px solid #000;border-top: 1px solid #000;border-bottom: none;}
        .header-left { width: 30%; vertical-align: top; padding: 3px; }
        .header-right { width: 70%; vertical-align: top; padding: 15px 6px 6px 6px; text-align: center; }

        .logo { max-width: 160px; height: auto; display: block; margin-bottom: 1px; }
        .company-name { color: #004080; font-weight: 800; font-size: 24px; letter-spacing: 0.3px; }
        .company-address { font-size: 12px; margin-top: 3px; line-height: 1.4; }

        .invoice-title { text-align: center; font-weight: 700; text-transform: uppercase; font-size: 18px; margin: 3px 0; }

        /* Info grid */
        .info-table th, .info-table td {
            border: 1px solid #000;
            padding: 3px 3px;
            font-size: 10px;
            vertical-align: top;
        }
        .info-left { width: 40%; }
        .info-mid { width: 30%; }
        .info-right { width: 30%; }

        /* Charges table */
        .charges {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;

            /* outer box */
            border-top: 1px solid #000;
            border-bottom: 1px solid #000;
            border-left: 1px solid #000;
            border-right: 1px solid #000;
        }
        .charges thead th {
            border-top: 1px solid #000;
            border-bottom: 1px solid #000;
            border-right: 1px solid #000;
            background: #f3f3f3;
            font-weight: 700;
            font-size: 10.8px;
            padding: 4px 3px;
            text-align: center;
        }
        .charges tbody td {
            border-right: 1px solid #000;
            font-size: 10.8px;
            padding: 2px 2px;
            vertical-align: top;
        }

        /* VERTICAL COLUMN LINES ONLY */
        .charges tbody td:not(:last-child) {
            border-right: 1px solid #000;
        }

        /* Explicit column widths for Dompdf */
        .charges thead th:nth-child(1){ width: 4%; }   /* S.NO */
        .charges thead th:nth-child(2){ width: 20%; }  /* PARTICULARS */
        .charges thead th:nth-child(3){ width: 7%; }   /* HAN/SAC */
        .charges thead th:nth-child(4){ width: 6%; }   /* UNIT */
        .charges thead th:nth-child(5){ width: 5%; }   /* CUR */
        .charges thead th:nth-child(6){ width: 7%; }   /* EX-RATE */
        .charges thead th:nth-child(7){ width: 7%; }   /* RATE */
        .charges thead th:nth-child(8){ width: 10%; }  /* TAXABLE AMOUNT */
        .charges thead th:nth-child(9){ width: 6%; }   /* GST RATE */
        .charges thead th:nth-child(10){ width: 7%; }  /* CGST */
        .charges thead th:nth-child(11){ width: 7%; }  /* SGST */
        .charges thead th:nth-child(12){ width: 6%; }  /* IGST */
        .charges thead th:nth-child(13){ width: 8%; }  /* TOTAL AMOUNT */

        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .text-left { text-align: left; }

        /* Totals area */
        .totals-table { margin-top: 3px; width: 100%; border-collapse: collapse; }
        .totals-table th, .totals-table td {
            border: 1px solid #000;
            padding: 3px 3px;
            font-size: 10px;
        }
        .amount-words {
            border: 1px solid #000;
            padding: 6px;
            min-height: 70px;
            font-weight: 700;
            font-size: 10px;
            line-height: 1.35;
        }

        /* Bank details */
        .bank-details {
            font-size: 10.5px;
            border: 1px solid #000;
            padding: 8px;
            margin-top: 4px;
        }

        /* Minor helpers */
        .no-border { border: none !important; }
        .small { font-size: 10px; }

        /* Avoid breaking the totals box across pages */
        .totals-table, .bank-details { page-break-inside: avoid; }

    </style>
</head>
<body>

    <div class="invoice-title">{{ $porformaInvoice->invoice_type ?? 'PROFORMA INVOICE' }}</div>

    {{-- Header: Logo + Company Info --}}
    <table class="header-table">
        <tr>
            <td class="header-left">
                <img class="logo" src="file://{{ $logoUrl }}" alt="Logo">
            </td>
            <td class="header-right">
                <div class="company-name">{{ $company->company_name }}</div>
                <div class="company-address">
                    {{ $porformaInvoice->operationJob->branch->address ?? $company->address }}<br>
                    PAN: {{ $porformaInvoice->operationJob->branch->pan_no ?? $company->companySetting->pan_no }} | GSTIN: {{ $porformaInvoice->operationJob->branch->gstin_no ?? $company->companySetting->gstin_no }} | TAN: {{ $porformaInvoice->operationJob->branch->tan_no ?? $company->companySetting->tan_no }} <br>
                    PHONE: {{ $porformaInvoice->operationJob->branch->phone ?? $company->companySetting->phone }} | LandLine: {{ $porformaInvoice->operationJob->branch->landline_phone ?? $company->companySetting->land_line_ph }}
                    <br>CIN: {{ $porformaInvoice->operationJob->branch->cin_no ?? $company->companySetting->cin_no }} | EMAIL: {{ $company->companySetting->email }}
                </div>
            </td>
        </tr>
    </table>

    {{-- Invoice & Shipper Info --}}
    <table class="info-table" style="margin-bottom:5px;">
        <tr>
            <td class="info-left" rowspan="4">
                <strong>PROFORMA TO</strong><br><br>
                <strong>{{ $porformaInvoice->partyName->party_name ?? '' }}</strong><br>
                {!! nl2br(e($porformaInvoice->partyName->address ?? $porformaInvoice->partyName->address_line1 ?? '')) !!}<br>
                {!! nl2br(e($porformaInvoice->partyName->address_line2 ?? '')) !!}<br>
                {{ $porformaInvoice->partyName->city ?? '' }} &nbsp;{{ $porformaInvoice->partyName->state ?? '' }} - {{ $porformaInvoice->partyName->pincode ?? '' }}<br>
                State Code - ({{ $porformaInvoice->partyName->state_code ?? '' }})&nbsp;&nbsp;&nbsp;&nbsp;GSTIN: {{ $porformaInvoice->partyName->gstin ?? '' }}
            </td>
            <td class="info-mid"><strong>INVOICE NO: {{ $porformaInvoice->invoice_no ?? '' }}</strong></td>
            <td class="info-right"><strong>INVOICE DATE: {{ \Carbon\Carbon::parse($porformaInvoice->invoice_date)->format('d-m-Y') }}</strong></td>
        </tr>
        <tr>
            <td class="info-mid"><strong>JOB NO: {{ $porformaInvoice->full_job_no ?? '' }}</strong></td>
            <td class="info-right"><strong>JOB DATE: {{$porformaInvoice->job_date??''}}</strong></td>
        </tr>
        <tr>
            <td class="info-mid"><strong>SHIPPER NAME: {{$porformaInvoice->shipper_name??''}}</strong></td>
            <td class="info-right"><strong>SALES PERSON: {{$porformaInvoice->salesPerson->name??''}}</strong></td>
        </tr>
        <tr>
            <td class="info-mid"><strong>LOADING PORT: {{ $porformaInvoice->pol ?? '' }}</strong></td>
            <td class="info-right"><strong>DISCHARGE PORT: {{ $porformaInvoice->pod ?? '' }}</strong></td>
        </tr>

        <tr>
            <td class="info-left"><strong>SHIPPER INV. NO: {{ $porformaInvoice->shipper_invoice_no ?? '' }}</strong></td>
            <td class="info-mid"><strong>CHARGEABLE WEIGHT: {{ $porformaInvoice->chargeable_weight ?? '' }}</strong></td>
            <td class="info-right"><strong>NO OF PKGS: {{ $porformaInvoice->packages ?? 0 }}</strong></td>
        </tr>
        <tr>
            <td class="info-left"><strong>S.BILL/BOE NO. & DATE: {{ $porformaInvoice->shipping_no ?? '' }}</strong></td>
            <td class="info-mid"><strong>MBL/MAWB: {{ $porformaInvoice->awb_bl_no ?? '' }}</strong></td>
            {{-- <td class="info-right"><strong>HBL/HAWB: {{ $porformaInvoice->hawb_no ?? '' }}</strong></td> --}}
            <td class="info-left"><strong>CBM: {{ $porformaInvoice->cbm ?? '' }}</strong></td>

        </tr>
        {{-- <tr>
            <td class="info-left"><strong>CBM: {{ $porformaInvoice->cbm ?? '' }}</strong></td>
            <td class="info-mid"><strong>ETD/ETA: {{ $porformaInvoice->etd_date ?? '' }} / {{ $porformaInvoice->eta_date ?? '' }}</strong></td>
            <td class="info-right"><strong>SHIPMENT TYPE: {{ $porformaInvoice->remarks ?? '' }}</strong></td>
        </tr> --}}
        <tr>
            <td class="info-left"><strong>VESSEL & VOY / AIRLINE: {{ $porformaInvoice->vessel_name ?? '' }}</strong></td>
            <td class="info-mid"><strong>CONTAINER NO: {{ $porformaInvoice->container_no ?? '' }}</strong></td>
            <td class="info-right"><strong>CONTAINER QTY: {{ $porformaInvoice->container_qty ?? '0' }}</strong></td>
        </tr>
        <tr>
            <td colspan="3"><strong>CONSIGNEE / CONSIGNER: {{ $porformaInvoice->consignee ?? '' }}</strong></td>
        </tr>
    </table>

    {{-- Charges Table --}}
    <table class="charges" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th class="text-center">S.NO</th>
                <th class="text-left">PARTICULARS</th>
                <th class="text-center">HAN/SAC CODE</th>
                <th class="text-center">UNIT</th>
                <th class="text-center">CUR</th>
                <th class="text-center">EX-RATE</th>
                <th class="text-center">RATE</th>
                <th class="text-right">TAXABLE AMOUNT</th>
                <th class="text-center">GST RATE</th>
                <th class="text-right">CGST %</th>
                <th class="text-right">SGST %</th>
                <th class="text-right">IGST %</th>
                <th class="text-right">TOTAL AMOUNT</th>
            </tr>
        </thead>
        @php
            $minRows = 12; // adjust based on your preview height
            $currentRows = count($chargeDetails);
        @endphp

        <tbody>
            @php $i = 1; @endphp

            @foreach ($chargeDetails as $charge)
                <tr>
                    <td class="text-center">{{ $i++ }}</td>
                    <td>
                        {{ $charge->charge->charge_name ?? '' }}<br>
                        @if(!empty($charge->charge_desc))
                            ({{ $charge->charge_desc }})
                        @endif
                    </td>
                    <td class="text-center">{{ $charge->charge->charge_code ?? '' }}</td>
                    <td class="text-center">{{ $charge->total_unit ?? '' }}</td>
                    <td class="text-center">{{ $charge->currency ?? 'INR' }}</td>
                    <td class="text-center">{{ number_format((float) ($charge->exchange_rate ?? 0), 2) }}</td>
                    <td class="text-center">{{ number_format((float) ($charge->per_unit ?? 0), 2) }}</td>
                    <td class="text-right">{{ fmt($charge->freight ?? 0) }}</td>
                    <td class="text-center">{{ number_format((float) ($charge->gst ?? 0), 2) }}</td>
                    <td class="text-right">{{ fmt($charge->cgst ?? 0) }}</td>
                    <td class="text-right">{{ fmt($charge->sgst ?? 0) }}</td>
                    <td class="text-right">{{ fmt($charge->igst ?? 0) }}</td>
                    <td class="text-right">{{ fmt($charge->total ?? 0) }}</td>
                </tr>
            @endforeach

            {{-- FILL EMPTY ROWS --}}
            @for ($r = $currentRows; $r < $minRows; $r++)
                <tr>
                    <td class="text-center">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td class="text-center">&nbsp;</td>
                    <td class="text-center">&nbsp;</td>
                    <td class="text-center">&nbsp;</td>
                    <td class="text-center">&nbsp;</td>
                    <td class="text-center">&nbsp;</td>
                    <td class="text-right">&nbsp;</td>
                    <td class="text-center">&nbsp;</td>
                    <td class="text-right">&nbsp;</td>
                    <td class="text-right">&nbsp;</td>
                    <td class="text-right">&nbsp;</td>
                    <td class="text-right">&nbsp;</td>
                </tr>
            @endfor
            <tr style="border-top: 1px solid #000;">
                <td style="text-align:right;"><strong>Total</strong></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="text-align:right;"><strong>{{ number_format($totalAmount ?? 0, 2) }}</strong></td>
                <td></td>
                <td style="text-align:right;"><strong>{{number_format($cgstAmount ?? 0, 2)}}</strong></td>
                <td style="text-align:right;"><strong>{{number_format($sgstAmount ?? 0, 2)}}</strong></td>
                <td style="text-align:right;"><strong>{{number_format($igstAmount ?? 0, 2)}}</strong></td>
                <td style="text-align:right;"><strong>{{number_format($finalAmount ?? 0, 2)}}</strong></td>
            </tr>
        </tbody>

    </table>

    {{-- Totals & Amount in Words --}}
    <table class="totals-table">
        <tr>
            <td style="width:70%;" rowspan="6" class="amount-words">
                <strong style="font-size:11px!important;">Amount in Words:</strong><br>
                <span style="font-size:11px!important;">{{ $amountInWords }}</span><br><br>
                <strong>BANK DETAILS :</strong><br>
                A/C NAME : {{ $accountDetails->beneficiary_name ?? 'N/A' }}<br>
                BANK NAME : {{ $accountDetails->bank_name ?? 'N/A' }}<br>
                BRANCH : {{ $accountDetails->branch_name ?? 'N/A' }}<br>
                A/C NO. : {{ $accountDetails->account_no ?? 'N/A' }}<br>
                IFSC CODE : {{ $accountDetails->ifsc_code ?? 'N/A' }}<br>
            </td>
            <th class="small">WITHOUT GST AMOUNT</th>
            <td class="text-right">{{ fmt($totalAmount) }}</td>
        </tr>
        <tr>
            <th class="small">GST</th>
            <td class="text-right">{{ fmt($gstAmount) }}</td>
        </tr>
        <tr>
            <th class="small">TOTAL AMOUNT</th>
            <td class="text-right">{{ fmt($finalAmount) }}</td>
        </tr>
        <tr>
            <th class="small">ROUND OFF</th>
            <td class="text-right">{{ fmt($roundOff) }}</td>
        </tr>
        <tr>
            <th class="small">TDS %</th>
            <td class="text-right">{{ fmt($totalTdsPercent) }}</td>
        </tr>
        <tr>
            <th class="small">TDS AMOUNT</th>
            <td class="text-right">{{ fmt($totalTdsAmount) }}</td>
        </tr>
        <tr>
            <th colspan="2" class="text-right">GRAND TOTAL Rs</th>
            <td class="text-right"><strong>{{ fmt($roundedTotal) }}</strong></td>
        </tr>
    </table>

    {{-- Bank details --}}
    <table style="width:100%; margin-top:8px;">
        <tr>
            <td style="width:70%;" class="bank-details">
                <strong>BANK DETAILS :</strong><br>
                A/C NAME : {{ $accountDetails->beneficiary_name ?? 'N/A' }}<br>
                BANK NAME : {{ $accountDetails->bank_name ?? 'N/A' }}<br>
                BRANCH : {{ $accountDetails->branch_name ?? 'N/A' }}<br>
                A/C NO. : {{ $accountDetails->account_no ?? 'N/A' }}<br>
                IFSC CODE : {{ $accountDetails->ifsc_code ?? 'N/A' }}<br><br>
                ALL SUBJECT TO JAIPUR JURISDICTION<br>
                ALL CHEQUES/DD TO BE ISSUED IN FAVOUR OF <strong>"{{ $company->company_name }}"</strong><br><br>
                Ref: <span>{{$currentDate}}</span> by {{ $porformaInvoice->salesPerson->name ?? '' }}
            </td>
            <td style="width:30%; text-align:center; vertical-align: bottom;border: 1px solid #000;">
                <strong>{{ $company->company_name }}</strong><br><br><br>
                AUTHORISED SIGNATORY
            </td>
        </tr>
    </table>

</body>
</html>
