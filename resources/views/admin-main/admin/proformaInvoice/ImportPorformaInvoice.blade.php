@extends('admin-main.layouts.default')
@section('content')
<style>
    body {
        font-family: 'DejaVu Sans', sans-serif;
        font-size: 12px;
        color: #000;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 10px;
    }

    th, td {
        border: 1px solid #000;
        padding: 6px 8px;
        vertical-align: top;
        font-size: 12px;
    }

    .no-border th, .no-border td {
        border: none !important;
    }

    .text-center { text-align: center; }
    .text-right { text-align: right; }
    .text-left { text-align: left; }

    .header-table td {
        border: none !important;
        padding: 10px;
        vertical-align: top;
    }

    .invoice-title {
        text-align: center;
        font-weight: bold;
        text-transform: uppercase;
        font-size: 16px;
        margin-bottom: 10px;
    }

    .company-name {
        color: #004080;
        font-weight: bold;
        font-size: 22px;
    }

    .section-title {
        background: #f3f3f3;
        font-weight: bold;
        padding: 5px;
    }

    .charges th {
        /*text-align: center;*/
        background: #f2f2f2;
        padding: 6px 8px;
    }

    .charges td {
        /*padding: 0px 2px;*/
    }

    .totals-table th, .totals-table td {
        padding: 6px 8px;
    }

    .bank-details {
        font-size: 11px;
        border: 1px solid #000;
        padding: 8px;
    }

    /* Highlighting Amount in Words box */
    .amount-words {
        border: 1px solid #000;
        padding: 8px;
        min-height: 50px;
        font-weight: bold;
    }
</style>

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h5 class="text-primary mb-0">
                <i class="fas fa-file-invoice"></i> IMP INV BL REPORT - (BL JOB NO: {{ $porformaInvoice->job_no ?? '' }})
            </h5>
        </div>

        <div class="card-body">
            {{-- BUTTONS --}}
            <div class="row mt-3">
                <div class="col-md-12 text-start">
                    <button class="btn btn-primary" id="previewBtn">PREVIEW</button>
                    <!--<button class="btn btn-warning text-white">GENERATE E-INVOICE</button>-->
                    <a href="{{ route('proformaInvoice.printProformaInvoice', $porformaInvoice->id) }}"
                       class="btn btn-warning text-white"
                       target="_blank">
                       PRINT PROFORMA
                    </a>

                    <a href="{{ url('/admin/proforma-invoices') }}" class="btn btn-outline-warning float-end">Proforma List</a>
                </div>
            </div>

            {{-- PREVIEW SECTION --}}
            <div id="previewSection" class="mt-5" style="display: none;">
                <h3 class="invoice-title">
                    {{ $porformaInvoice->invoice_type }}
                </h3>
                <hr>

                <!-- HEADER: Logo + Company Info -->
                <table class="header-table">
                    <tr>
                        <td width="30%" class="text-center">
                            <img src="{{ $logoUrl }}" alt="Logo" style="width:180px;">
                        </td>
                        <td width="70%" class="text-end">
                            <div class="company-name">{{ $company->company_name }}</div>
                            <div>{{ $porformaInvoice->branch->address ?? $company->address }}</div>
                            <div>PAN: {{ $porformaInvoice->branch->pan_no ?? $company->companySetting->pan_no }} | GSTIN: {{ $porformaInvoice->branch->gstin_no ?? $company->companySetting->gstin_no }} | TAN: {{ $porformaInvoice->branch->tan_no ?? $company->companySetting->tan_no }}</div>
                            <div>CIN: {{ $porformaInvoice->branch->cin_no ?? $company->companySetting->cin_no }}</div>
                            <div>PHONE: {{ $porformaInvoice->branch->phone ?? $company->companySetting->phone }} | EMAIL: {{ $company->companySetting->email }}</div>
                        </td>
                    </tr>
                </table>

                <!-- SHIPPER & INVOICE INFO -->
                <table>
                    <!--<tr>-->
                    <!--    <th width="40%">SHIPPER</th>-->
                    <!--    <th width="20%">INVOICE NO.</th>-->
                    <!--    <th width="20%">DATE</th>-->
                    <!--</tr>-->
                    @php
                        $fullJobNo = $purchaseInvoice->operationJob->airExport->full_job_no
                            ?? $purchaseInvoice->operationJob->airImport->full_job_no
                            ?? $purchaseInvoice->operationJob->seaExport->full_job_no
                            ?? $purchaseInvoice->operationJob->seaImport->full_job_no
                            ?? '';

                        $shippingBill = $purchaseInvoice->operationJob->airExport->shipping_bill
                            ?? $purchaseInvoice->operationJob->airImport->shipping_bill
                            ?? $purchaseInvoice->operationJob->seaExport->shipping_bill
                            ?? $purchaseInvoice->operationJob->seaImport->shipping_bill
                            ?? '';

                        $grossWeight = $purchaseInvoice->operationJob->airExport->gross_weight
                            ?? $purchaseInvoice->operationJob->airImport->gross_weight
                            ?? $purchaseInvoice->operationJob->seaExport->gross_weight
                            ?? $purchaseInvoice->operationJob->seaImport->gross_weight
                            ?? '';

                        $cbm = $purchaseInvoice->operationJob->airExport->cbm
                            ?? $purchaseInvoice->operationJob->airImport->cbm
                            ?? $purchaseInvoice->operationJob->seaExport->cbm
                            ?? $purchaseInvoice->operationJob->seaImport->cbm
                            ?? '';

                        $package = $purchaseInvoice->operationJob->airExport->package
                            ?? $purchaseInvoice->operationJob->airImport->package
                            ?? $purchaseInvoice->operationJob->seaExport->package
                            ?? $purchaseInvoice->operationJob->seaImport->package
                            ?? '';

                        $mawb_no = $purchaseInvoice->operationJob->airExport->mawb_no
                            ?? $purchaseInvoice->operationJob->airImport->mawb_no
                            ?? $purchaseInvoice->operationJob->seaExport->mawb_no
                            ?? $purchaseInvoice->operationJob->seaImport->mawb_no
                            ?? '';
                    @endphp
                    <tr>
                        <td rowspan="5">
                            <strong>SHIPPER</strong><br><br>
                            <span class="text-center">
                                <strong>{{ $porformaInvoice->partyName->party_name ?? '' }}</strong><br>
                                {{ $porformaInvoice->partyName->address_line1 ?? '' }}<br>
                                {{ $porformaInvoice->partyName->address_line2 ?? '' }}<br>
                                {{ $porformaInvoice->partyName->city ?? '' }}<br>
                                <br><br>GSTIN: {{ $porformaInvoice->partyName->gstin ?? '' }}
                            </span>
                        </td>
                        <td><strong>INVOICE NO. </strong>{{ $porformaInvoice->invoice_no ?? '' }}</td>
                        <td><strong>DATE : </strong>{{ $porformaInvoice->invoice_date ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>JOB NO. </th>
                        <td>{{ $porformaInvoice->full_job_no }}</td>
                    </tr>
                    <tr>
                        <th>PORT OF LOADING</th>
                        <td>{{ $porformaInvoice->pol ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>PORT OF DISHARGE</th>
                        <td>{{ $porformaInvoice->pod ?? '' }}</td>
                    </tr>

                    <tr>
                        <td><strong>SB/BOE BILL NO :</strong> {{ $porformaInvoice->shipping_no ?? '' }}</td>
                        <td><strong>GROSS WEIGHT : </strong>{{ $porformaInvoice->gross_weight ?? '' }}</td>
                    </tr>

                    <tr>
                        <th>CBM</th>
                        <th>NO OF PKGS</th>
                        <th>EQUIPMENT SIZE</th>
                    </tr>
                    <tr>
                        <td>{{ $porformaInvoice->cbm ?? 0 }}</td>
                        <td>{{ $porformaInvoice->packages ?? 0 }}</td>
                        <td>{{ $porformaInvoice->equipment_size ?? 0 }}</td>
                    </tr>

                    <tr>
                        <td><strong>VESSEL & VOY / AIRLINE :</strong> {{ $porformaInvoice->vessel_name ?? '' }}</td>
                        <td><strong>CONTAINER NO. :</strong> {{ $porformaInvoice->container ?? '' }}</td>
                        <td><strong>AWB / BL NO. :</strong> {{ $porformaInvoice->awb_bl_no ?? '' }}</td>
                    </tr>
                    <tr>
                        <td colspan="1"><strong>Shipper Invoice No:</strong>{{ $porformaInvoice->shipper_invoice_no ?? '' }}</td>
                        <td colspan="2"><strong>Chargeable Weight : </strong>{{ $porformaInvoice->chargeable_weight ?? '' }}</td>
                    </tr>
                    <tr>
                        <td colspan="3"><strong>CONSIGNEE / Consigner:</strong>{{ $porformaInvoice->consignee ?? '' }}</td>
                    </tr>
                </table>

                <!-- CHARGES TABLE -->
                <table class="charges" style="min-height: 200px;">
                    <thead>
                        <tr>
                            <th>S.NO</th>
                            <th>PARTICULARS</th>
                            <th>HAN/SAC CODE</th>
                            <th>UNIT</th>
                            <th>CUR</th>
                            <th>EX-RATE</th>
                            <th>RATE</th>
                            <th>TAXABLE AMOUNT</th>
                            <th>GST RATE</th>
                            <th>CGST %</th>
                            <th>SGST %</th>
                            <th>IGST %</th>
                            <th>TOTAL AMOUNT</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @php
                            $totalAmount = 0;
                            $finalAmount = 0;
                            $totalTdsPercent = 0;
                            $totalTdsAmount = 0;
                            $gstAmount = 0;
                        @endphp
                        @foreach($chargeDetails as $charge)
                        @php
                            $taxableAmount = $charge->total;
                            $gstValue = $charge->cgst + $charge->sgst + $charge->igst;
                            $totalWithGST = $charge->total;

                            $totalAmount += $charge->freight;
                            $finalAmount += $totalWithGST;

                            $totalTdsPercent += $charge->tds;
                            $totalTdsAmount += $charge->tds_amount;

                            $gstAmount += $gstValue;
                        @endphp

                        <tr>
                            <td class="text-center">{{ $i++ }}</td>
                            <td>{{ $charge->charge->charge_name }}</td>
                            <td class="text-center">{{ $charge->charge->charge_code }}</td>
                            <td class="text-center">{{ $charge->total_unit }}</td>
                            <td class="text-center">{{ $charge->currency }}</td>
                            <td class="text-center">{{ $charge->exchange_rate }}</td>
                            <td class="text-center">{{ $charge->per_unit ?? 0 }}</td>

                            <!-- Taxable Amount (Correct) -->
                            <td class="text-right">{{ number_format($charge->freight, 2) }}</td>

                            <!-- GST % and components -->
                            <td class="text-right">{{ number_format($charge->gst, 2) }}</td>
                            <td class="text-right">{{ number_format($charge->cgst, 2) }}</td>
                            <td class="text-right">{{ number_format($charge->sgst, 2) }}</td>
                            <td class="text-right">{{ number_format($charge->igst, 2) }}</td>

                            <!-- Total Amount including GST (Correct) -->
                            <td class="text-right">{{ $totalWithGST }}</td>
                        </tr>
                    @endforeach

                        @if(!empty($salesInvoice->charges))
                            <tr>
                                <td class="text-center"></td>
                                <td></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-right"></td>
                                <td class="text-right"></td>
                                <td class="text-right"></td>
                                <td class="text-right"></td>
                                <td class="text-right"></td>
                            </tr>
                        @endif
                    </tbody>
                </table>

                <!-- TAX & TOTALS -->
                <table class="totals-table">
                    @php
                        // FINAL BEFORE ROUND OFF
                        $finalAmountWithTds = $finalAmount - $totalTdsAmount;

                        // ROUND OFF LOGIC
                        $decimal = $finalAmountWithTds - floor($finalAmountWithTds);

                        if ($decimal < 0.50) {
                            // ROUND DOWN
                            $roundedTotal = floor($finalAmountWithTds);
                            $roundOff = $roundedTotal - $finalAmountWithTds;   // negative
                        } else {
                            // ROUND UP
                            $roundedTotal = ceil($finalAmountWithTds);
                            $roundOff = $roundedTotal - $finalAmountWithTds;   // positive
                        }

                        // AMOUNT IN WORDS
                        $f = new \NumberFormatter('en_IN', \NumberFormatter::SPELLOUT);
                        $amountInWords = ucfirst($f->format($roundedTotal)) . ' only';
                    @endphp

                    <tr>
                        <td width="70%" rowspan="6" class="amount-words">
                            <strong>Amount in Words:</strong><br>
                            {{ $amountInWords ?? '' }}
                        </td>

                        <th  colspan="2">WITHOUT GST AMOUNT</th>
                        <td class="text-right">{{ number_format($totalAmount ?? 0, 2) }}</td>
                    </tr>

                    <tr>
                        <th  colspan="2">GST</th>
                        <td class="text-right">{{ number_format($gstAmount ?? 0, 2) }}</td>
                    </tr>

                    <tr>
                        <th  colspan="2">TOTAL AMOUNT</th>
                        <td class="text-right">{{ number_format($finalAmount ?? 0, 2) }}</td>
                    </tr>

                    <tr>
                        <th  colspan="2">ROUND OFF</th>
                        <td class="text-right">{{ number_format($roundOff, 2) }}</td>
                    </tr>

                    <tr>
                        <th colspan="2" class="text-right">GRAND TOTAL Rs</th>
                        <td class="text-right"><strong>{{ number_format($roundedTotal ?? 0, 2) }}</strong></td>
                    </tr>
                </table>

                <!-- BANK DETAILS -->
                <table class="bank-details">
                    <tr>
                        <td width="70%">
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
                        <td width="30%" class="text-center" style="vertical-align: bottom;">
                            <strong>{{ $company->company_name }}</strong><br><br><br>
                            AUTHORISED SIGNATORY
                        </td>
                    </tr>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection



@push('scripts')
<script>
    const today = new Date();

    let day = String(today.getDate()).padStart(2, '0');
    let month = String(today.getMonth() + 1).padStart(2, '0');
    let year = today.getFullYear();

    let formattedDate = day + '-' + month + '-' + year;

    document.getElementById('currentDate').innerText = formattedDate;
</script>
    <script>
    document.getElementById('previewBtn').addEventListener('click', function() {
        const previewSection = document.getElementById('previewSection');
        previewSection.style.display = 'block';
        previewSection.scrollIntoView({ behavior: 'smooth' });
    });
</script>

@endpush

