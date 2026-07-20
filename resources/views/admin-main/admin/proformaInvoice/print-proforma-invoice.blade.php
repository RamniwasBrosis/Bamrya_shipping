@php
    // Pre-calc totals & GST behaviour (defensive defaults)
    $totalAmount = $chargeDetails->sum('freight') ?? 0;
    $finalAmount = $chargeDetails->sum('total') ?? 0;
    $totalTdsPercent = $chargeDetails->sum('tds') ?? 0;
    $totalTdsAmount = $chargeDetails->sum('tds_amount') ?? 0;

    // GST total (combined)
    $gstAmount = 0;
    foreach ($chargeDetails as $charge) {
        if (($porformaInvoice->gst_type ?? 'local') === 'local') {
            $gstAmount += ($charge->cgst ?? 0) + ($charge->sgst ?? 0);
        } else {
            $gstAmount += ($charge->igst ?? 0);
        }
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
    <title>Porforma Invoice - {{ $porformaInvoice->invoice_no ?? '' }}</title>

    <style>
        /* Page size and margins */
        @page { size: A4 portrait; margin: 28mm 14mm; }

        /* Base */
        html, body {
            font-family: "DejaVu Sans", DejaVuSans, sans-serif;
            font-size: 10px;
            color: #000;
            margin: 0px 5px;
            padding: 0;
        }

        /* Prevent table breaks inside rows */
        table { border-collapse: collapse; width: 100%; table-layout: fixed; word-break: break-word; }
        tr, td, th { page-break-inside: avoid; }

        /* Header */
        .header-table { margin-bottom: 2px; }
        .header-left { width: 50%; vertical-align: top; padding: 6px; }
        .header-right { width: 50%; vertical-align: top; padding: 6px; text-align: left; }

        .logo { max-width: 180px; height: auto; display: block; margin-bottom: 6px; }
        .company-name { color: #004080; font-weight: 800; font-size: 22px; letter-spacing: 0.2px; }
        .company-address { font-size: 11px; margin-top: 4px; line-height: 1.2; }

        .invoice-title { text-align: center; font-weight: 700; text-transform: uppercase; font-size: 15px; margin: 8px 0; }

        /* Info grid */
        .info-table th, .info-table td {
            border: 1px solid #000;
            padding: 3px 3px;
            font-size: 11px;
            vertical-align: top;
        }
        .info-left { width: 40%; }
        .info-mid { width: 30%; }
        .info-right { width: 30%; }

        /* Charges table */
        .charges thead th {
            background: #f3f3f3;
            font-weight: 700;
            padding: 3px 3px;
            border: 1px solid #000;
            font-size: 10.8px;
            text-align: center;
        }
        .charges tbody{
            min-height: 200px !important;
        }
        .charges tbody td {
            border: 1px solid #000;
            font-size: 10.8px;
            vertical-align: top;
            padding: 2px;
        }

        /* Explicit column widths for Dompdf */
        .charges thead th:nth-child(1){ width: 4%; }   /* S.NO */
        .charges thead th:nth-child(2){ width: 20%; }  /* PARTICULARS */
        .charges thead th:nth-child(3){ width: 9%; }   /* HAN/SAC */
        .charges thead th:nth-child(4){ width: 6%; }   /* UNIT */
        .charges thead th:nth-child(5){ width: 5%; }   /* CUR */
        .charges thead th:nth-child(6){ width: 7%; }   /* EX-RATE */
        .charges thead th:nth-child(7){ width: 7%; }   /* RATE */
        .charges thead th:nth-child(8){ width: 10%; }  /* TAXABLE AMOUNT */
        .charges thead th:nth-child(9){ width: 6%; }   /* GST RATE */
        .charges thead th:nth-child(10){ width: 6%; }  /* CGST */
        .charges thead th:nth-child(11){ width: 6%; }  /* SGST */
        .charges thead th:nth-child(12){ width: 6%; }  /* IGST */
        .charges thead th:nth-child(13){ width: 8%; }  /* TOTAL AMOUNT */

        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .text-left { text-align: left; }

        /* Totals area */
        .totals-table { margin-top: 8px; width: 100%; border-collapse: collapse; }
        .totals-table th, .totals-table td {
            border: 1px solid #000;
            padding: 3px 3px;
            font-size: 11px;
        }
        .amount-words {
            border: 1px solid #000;
            padding: 6px;
            min-height: 70px;
            font-weight: 700;
            font-size: 11px;
            line-height: 1.35;
        }

        /* Bank details */
        .bank-details {
            font-size: 10.5px;
            border: 1px solid #000;
            padding: 8px;
            margin-top: 8px;
        }

        /* Minor helpers */
        .no-border { border: none !important; }
        .small { font-size: 10px; }

        /* Avoid breaking the totals box across pages */
        .totals-table, .bank-details { page-break-inside: avoid; }

    </style>
</head>
<body>

    <div class="invoice-title">{{ $porformaInvoice->invoice_type ?? 'TAX INVOICE' }}</div>

    {{-- Header: Logo + Company Info --}}
    <table class="header-table">
        <tr>
            <td class="header-left">
                <img class="logo" src="file://{{ $logoUrl }}" alt="Logo">
            </td>
            <td class="header-right">
                <div class="company-name">{{ $company->company_name }}</div>
                <div class="company-address">
                    {{ $company->address }}<br>
                    PAN: {{ $company->companySetting->pan_no }} | GSTIN: {{ $company->companySetting->gstin_no }} | TAN: {{ $company->companySetting->tan_no }} <br>
                    PHONE: {{ $company->companySetting->phone }} | CIN: {{ $company->companySetting->cin }}
                    <br> EMAIL: {{ $company->companySetting->email }}
                </div>
            </td>
        </tr>
    </table>

    {{-- Invoice & Shipper Info --}}
    <table class="info-table" style="margin-bottom:6px;">
        <tr>
            <td class="info-left" rowspan="5">
                <strong>PROFROMA TO</strong><br><br>
                <strong>{{ $porformaInvoice->partyName->party_name ?? '' }}</strong><br>
                {!! nl2br(e($porformaInvoice->partyName->address ?? $porformaInvoice->partyName->address_line1 ?? '')) !!}<br>
                {{ $porformaInvoice->partyName->city ?? '' }}<br><br>
                GSTIN: {{ $porformaInvoice->partyName->gstin ?? '' }}
            </td>
            <td class="info-mid"><strong>INVOICE NO:</strong></td>
            <td class="info-right">{{ $porformaInvoice->invoice_no ?? '' }}</td>
        </tr>
        <tr>
            <td class="info-mid"><strong>DATE:</strong></td>
            <td class="info-right">{{ $porformaInvoice->invoice_date ?? now()->format('Y-m-d') }}</td>
        </tr>
        <tr>
            <td class="info-mid"><strong>JOB NO:</strong></td>
            <td class="info-right">{{ $porformaInvoice->full_job_no ?? '' }}</td>
        </tr>
        <tr>
            <td class="info-mid"><strong>PORT OF LOADING:</strong></td>
            <td class="info-right">{{ $porformaInvoice->pol ?? '' }}</td>
        </tr>

        <tr>
            <td class="info-mid"><strong>PORT OF DELIVERY:</strong></td>
            <td class="info-right">{{ $porformaInvoice->pod ?? '' }}</td>
        </tr>
        <tr>
            <td class="info-left"><strong>S.BILL/BOE NO:</strong> {{ $porformaInvoice->shipping_no ?? '' }}</td>
            <td class="info-mid"><strong>GROSS WEIGHT:</strong></td>
            <td class="info-right">{{ $porformaInvoice->gross_weight ?? '' }}</td>
        </tr>
        <tr>
            <td class="info-left"><strong>CBM:</strong> {{ $porformaInvoice->cbm ?? '' }}</td>
            <td class="info-mid"><strong>NO OF PKGS:</strong></td>
            <td class="info-right">{{ $porformaInvoice->packages ?? 0 }}</td>
        </tr>
        <tr>
            <td class="info-left"><strong>VESSEL & VOY / AIRLINE:</strong> {{ $porformaInvoice->vessel_name ?? '' }}</td>
            <td class="info-mid"><strong>CONTAINER NO:</strong></td>
            <td class="info-right">{{ $porformaInvoice->container_no ?? '' }}</td>
        </tr>
        <tr>
            <td colspan="1"><strong>AWB/BL NO: </strong> {{ $porformaInvoice->awb_bl_no ?? '' }}</td>
            <td colspan="2"><strong>CHARGEABLE WEIGHT : </strong> {{ $porformaInvoice->chargeable_weight ?? '' }}</td>
            <!--<td colspan="2"><strong>Shipper Invoice NO: </strong> {{ $porformaInvoice->shipper_invoice_no ?? '' }}</td>-->
        </tr>
        <tr>
            <td colspan="3"><strong>CONSIGNEE / CONSIGNER: </strong> {{ $porformaInvoice->consignee ?? '' }}</td>
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
        <tbody>
            @php $i = 1; @endphp
            @foreach ($chargeDetails as $charge)
                @php
                    $taxable = $charge->freight ?? $charge->total ?? 0;
                    $gstRate = $charge->gst ?? 0;
                    $cgst = $charge->cgst ?? 0;
                    $sgst = $charge->sgst ?? 0;
                    $igst = $charge->igst ?? 0;
                    $totalWithGST = $charge->total ?? ($taxable + (($cgst+$sgst+$igst) ?? 0));
                @endphp
                <tr>
                    <td class="text-center">{{ $i++ }}</td>
                    <td class="text-left">{{ $charge->charge->charge_name ?? '' }}</td>
                    <td class="text-center">{{ $charge->charge->charge_code ?? '' }}</td>
                    <td class="text-center">{{ $charge->total_unit ?? '' }}</td>
                    <td class="text-center">{{ $charge->currency ?? 'INR' }}</td>
                    <td class="text-center">{{ $charge->exchange_rate ?? '' }}</td>
                    <td class="text-center">{{ fmt($charge->per_unit ?? 0) }}</td>
                    <td class="text-right">{{ fmt($taxable) }}</td>
                    <td class="text-center">{{ fmt($gstRate) }}</td>
                    <td class="text-right">{{ fmt($cgst) }}</td>
                    <td class="text-right">{{ fmt($sgst) }}</td>
                    <td class="text-right">{{ fmt($igst) }}</td>
                    <td class="text-right">{{ fmt($totalWithGST) }}</td>
                </tr>
            @endforeach
    
            {{-- If you want blank rows to keep table height similar to preview, uncomment and adjust --}}
            {{-- @for($r = count($chargeDetails); $r < 6; $r++)
                <!--<tr>-->
                <!--    <td class="text-center">&nbsp;</td>-->
                <!--    <td>&nbsp;</td>-->
                <!--    <td class="text-center">&nbsp;</td>-->
                <!--    <td class="text-center">&nbsp;</td>-->
                <!--    <td class="text-center">&nbsp;</td>-->
                <!--    <td class="text-center">&nbsp;</td>-->
                <!--    <td class="text-center">&nbsp;</td>-->
                <!--    <td class="text-right">&nbsp;</td>-->
                <!--    <td class="text-center">&nbsp;</td>-->
                <!--    <td class="text-right">&nbsp;</td>-->
                <!--    <td class="text-right">&nbsp;</td>-->
                <!--    <td class="text-right">&nbsp;</td>-->
                <!--    <td class="text-right">&nbsp;</td>-->
                <!--</tr>-->
            @endfor --}}
        </tbody>
    </table>

    {{-- Totals & Amount in Words --}}
    <table class="totals-table">
        <tr>
            <td style="width:70%;" rowspan="6" class="amount-words">
                <strong>Amount in Words:</strong><br>
                {{ $amountInWords }}
            </td>
            <th colspan="2" class="small">WITHOUT GST AMOUNT</th>
            <td class="text-right">{{ fmt($totalAmount) }}</td>
        </tr>
        <tr>
            <th colspan="2" class="small">GST</th>
            <td class="text-right">{{ fmt($gstAmount) }}</td>
        </tr>
        <tr>
            <th colspan="2" class="small">TOTAL AMOUNT</th>
            <td class="text-right">{{ fmt($finalAmount) }}</td>
        </tr>
        <tr>
            <th colspan="2" class="small">ROUND OFF</th>
            <td class="text-right">{{ fmt($roundOff) }}</td>
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


<script>
    const today = new Date();

    let day = String(today.getDate()).padStart(2, '0');
    let month = String(today.getMonth() + 1).padStart(2, '0');
    let year = today.getFullYear();

    let formattedDate = day + '-' + month + '-' + year;

    document.getElementById('currentDate').innerText = formattedDate;
</script>
</body>
</html>
