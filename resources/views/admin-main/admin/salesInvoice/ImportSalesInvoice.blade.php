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
        font-size: 26px;
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
        /*font-weight: bold;*/
    }
    .company-address{
        font-size: 14px;
    }
</style>

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h5 class="text-primary mb-0">
                <i class="fas fa-file-invoice"></i> IMP INV BL REPORT - (BL JOB NO: {{ $salesInvoice->full_job_no ?? '' }})
            </h5>
        </div>

        <div class="card-body">
            {{-- URL TYPE --}}
            <!--<div class="row align-items-center mb-3">-->
            <!--    <div class="col-md-2">-->
            <!--        <label class="fw-bold">URL Type:</label>-->
            <!--    </div>-->
            <!--    <div class="col-md-10">-->
            <!--        <div class="form-check form-check-inline">-->
            <!--            <input class="form-check-input" type="radio" name="url_type" id="demo" value="demo">-->
            <!--            <label class="form-check-label" for="demo">DEMO</label>-->
            <!--        </div>-->
            <!--        <div class="form-check form-check-inline">-->
            <!--            <input class="form-check-input" type="radio" name="url_type" id="prd" value="prd" checked>-->
            <!--            <label class="form-check-label" for="prd">PRD</label>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->

            {{-- ACCOUNT NO --}}
            <!--<div class="row align-items-center mb-3">-->
            <!--    <div class="col-md-2">-->
            <!--        <label class="fw-bold">Account No:</label>-->
            <!--    </div>-->
            <!--    <div class="col-md-6">-->
            <!--        <div class="form-check form-check-inline">-->
            <!--            <input class="form-check-input" type="radio" name="account_no" id="na1" value="na" checked>-->
            <!--            <label class="form-check-label" for="na1">NA</label>-->
            <!--        </div>-->
            <!--        <div class="form-check form-check-inline">-->
            <!--            <input class="form-check-input" type="radio" name="account_no" id="na2" value="na2">-->
            <!--            <label class="form-check-label" for="na2">NA</label>-->
            <!--        </div>-->
            <!--    </div>-->

            <!--    {{-- ADVANCE INPUT --}}-->
            <!--    <div class="col-md-2 text-end">-->
            <!--        <label class="fw-bold">Advance:</label>-->
            <!--    </div>-->
            <!--    <div class="col-md-2">-->
            <!--        <input type="number" class="form-control" id="advance" value="0" min="0">-->
            <!--    </div>-->
            <!--</div>-->

            {{-- BUTTONS --}}
            <div class="row mt-3">
                <div class="col-md-12 text-start">
                    <button class="btn btn-primary" id="previewBtn">PREVIEW</button>
                    <!--<button class="btn btn-warning text-white">GENERATE E-INVOICE</button>-->
                    <a href="{{ route('salesInvoice.printSalesInvoice', $salesInvoice->id) }}"
                       class="btn btn-warning text-white"
                       target="_blank">
                       PRINT E-INVOICE
                    </a>

                    <a href="{{ url('/admin/sales-invoices') }}" class="btn btn-outline-warning float-end">Invoice List</a>
                </div>
            </div>

            {{-- PREVIEW SECTION --}}
            <div id="previewSection" class="mt-5" style="display: none;">
                <h3 class="invoice-title">
                    {{ $salesInvoice->invoice_type }}
                </h3>
                <hr>

                <!-- HEADER: Logo + Company Info -->
                <table class="header-table">
                    <tr>
                        <td width="30%" class="text-center">
                            <img src="{{ $logoUrl }}" alt="Logo" style="width:200px;">
                        </td>
                        <td width="70%" class="text-end">
                            <div class="company-name">{{$company->company_name }}</div>
                            <div class="company-address">{{ $salesInvoice->operationJob->branch->address ?? $company->address }}</div>
                            <div class="company-address">PAN: {{ $salesInvoice->operationJob->branch->pan_no ?? $company->companySetting->pan_no }} | GSTIN: {{ $salesInvoice->operationJob->branch->gstin_no ?? $company->companySetting->gstin_no }} | TAN: {{ $salesInvoice->operationJob->branch->tan_no ?? $company->companySetting->tan_no }}</div>
                            <div class="company-address">LandLine: {{ $salesInvoice->operationJob->branch->landline_phone ?? $company->companySetting->land_line_ph }} | CIN: {{ $salesInvoice->operationJob->branch->cin_no ?? $company->companySetting->cin_no }}</div>
                            <div class="company-address">PHONE: {{ $salesInvoice->operationJob->branch->phone ?? $company->companySetting->phone }} | EMAIL: {{ $company->companySetting->email }}</div>
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
                    <tr>
                        <td rowspan="4">
                            <strong>TO BILL</strong><br><br>
                            <span class="text-center">
                                <strong>{{ $salesInvoice->partyName->party_name ?? '' }}</strong><br>
                                {{ $salesInvoice->partyName->address_line1 ?? '' }}<br>
                                {{ $salesInvoice->partyName->address_line2 ?? '' }}<br>
                                {{ $salesInvoice->partyName->city ?? '' }} &nbsp;{{ $salesInvoice->partyName->state ?? '' }} - {{ $salesInvoice->partyName->pincode ?? '' }}<br>
                                State Code - ({{ $salesInvoice->partyName->state_code ?? '' }})&nbsp;&nbsp;&nbsp;GSTIN: {{ $salesInvoice->partyName->gstin ?? '' }}

                            </span>
                        </td>
                        <td><strong>INVOICE NO. </strong>{{ $salesInvoice->invoice_no ?? '' }}</td>
                        <td><strong>INVOICE DATE : </strong>{{ \Carbon\Carbon::parse($salesInvoice->invoice_date)->format('d-m-Y') }}</td>
                    </tr>
                    <tr>
                        <th><strong>JOB NO. </strong>{{ $salesInvoice->full_job_no ?? '' }}</th>
                        <td><strong>JOB DATE: </strong>{{$salesInvoice->job_date??''}}</td>
                    </tr>
                    <tr>
                        <th><strong>SHIPPER NAME: </strong>{{$salesInvoice->shipper_name??''}}</th>
                        <td><strong>SALES PERSON: </strong>{{$salesInvoice->sales_person??''}}</td>
                    </tr>
                    <tr>
                        <th><strong>PORT OF LOADING: </strong>{{ $salesInvoice->pol ?? '' }}</th>
                        <td><strong>PORT OF DISCHARGE: </strong>{{ $salesInvoice->pod ?? '' }}</td>
                    </tr>

                    <tr>
                        <td><strong>SHIPPER INV. NO:</strong> {{ $salesInvoice->full_invoice_no ?? '' }}</td>
                        <td><strong>CHARGABLE WEIGHT: </strong>{{ $salesInvoice->chargeable_weight ?? '' }}</td>
                        <td><strong>NO OF PKGS: </strong>{{ $salesInvoice->packages ?? 0 }}</td>
                    </tr>

                    <tr>
                        <td><strong>S.BILL/BOE NO. & DATE:</strong>{{ $salesInvoice->shipping_no ?? '' }}</td>
                        <td><strong>MBL/MAWB: </strong>{{ $salesInvoice->mawb_no ? $salesInvoice->mawb_no : $salesInvoice->awb_bl_no }}</td>
                        <td><strong>HBL/HAWB: </strong>{{ $salesInvoice->hbl_no ? $salesInvoice->hbl_no : $salesInvoice->hawb_no }}</td>
                    </tr>

                    <tr>
                        <td><strong>CBM:</strong> {{ $salesInvoice->cbm ?? '' }}</td>
                        <td><strong>ETD/ETA: </strong>{{ $salesInvoice->etd_date ?? '' }} / {{ $salesInvoice->eta_date ?? '' }}</td>
                        <td><strong>SHIPMENT TYPE: </strong>{{ $salesInvoice->remarks ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>VESSEL & VOY / AIRLINE:</strong> {{ $salesInvoice->vessel_name ?? '' }}</td>
                        <td><strong>CONTAINER NO: </strong>{{ $salesInvoice->container ?? '' }}</td>
                        <td><strong>CONTAINER QTY: </strong>{{ $salesInvoice->container_qty ?? '0' }}</td>
                    </tr>

                    <tr>
                        <td colspan="3"><strong>CONSIGNEE NAME: </strong>{{ $salesInvoice->consignee ?? '' }}</td>
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
                            $cgstAmount = 0;
                            $sgstAmount = 0;
                            $igstAmount = 0;
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
                            $cgstAmount += $charge->cgst;
                            $sgstAmount += $charge->sgst;
                            $igstAmount += $charge->igst;
                        @endphp

                        <tr>
                            <td class="text-center">{{ $i++ }}</td>
                            <td>
                                {{ $charge->chargeName->charge_name }}<br>

                                @if(!empty($charge->charge_desc))
                                    ({{ $charge->charge_desc }})
                                @endif
                            </td>
                            <td class="text-center">{{ $charge->chargeName->charge_code }}</td>
                            <td class="text-center">{{ $charge->total_unit }}</td>
                            <td class="text-center">{{ $charge->currency }}</td>
                            <td class="text-center">{{ number_format($charge->exchange_rate, 2) }}</td>
                            <td class="text-center">{{ number_format($charge->per_unit, 2) }}</td>

                            <!-- Taxable Amount (Correct) -->
                            <td class="text-right">{{ number_format($charge->freight, 2) }}</td>

                            <!-- GST % and components -->
                            <td class="text-right">{{ number_format($charge->gst, 0) }}</td>
                            <td class="text-right">{{ number_format($charge->cgst, 2) }}</td>
                            <td class="text-right">{{ number_format($charge->sgst, 2) }}</td>
                            <td class="text-right">{{ number_format($charge->igst, 2) }}</td>

                            <!-- Total Amount including GST (Correct) -->
                            <td class="text-right">{{ number_format($totalWithGST, 2) }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td><strong>Total</strong></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-right"><strong>{{ number_format($totalAmount ?? 0, 2) }}</strong></td>
                        <td></td>
                        <td class="text-right"><strong>{{number_format($cgstAmount ?? 0, 2)}}</strong></td>
                        <td class="text-right"><strong>{{number_format($sgstAmount ?? 0, 2)}}</strong></td>
                        <td class="text-right"><strong>{{number_format($igstAmount ?? 0, 2)}}</strong></td>
                        <td class="text-right"><strong>{{number_format($finalAmount ?? 0, 2)}}</strong></td>
                    </tr>

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
                            {{ $amountInWords ?? '' }}<br><br>

                            <strong>BANK DETAILS </strong><br>
                            <strong>A/C NAME :</strong> {{ $accountDetails->beneficiary_name ?? 'N/A' }}<br>
                            <strong>BANK NAME :</strong> {{ $accountDetails->bank_name ?? 'N/A' }}<br>
                            <strong>BRANCH :</strong> {{ $accountDetails->branch_name ?? 'N/A' }}<br>
                            <strong>A/C NO. :</strong> {{ $accountDetails->account_no ?? 'N/A' }}<br>
                            <strong>IFSC CODE :</strong> {{ $accountDetails->ifsc_code ?? 'N/A' }}<br><br>
                        </td>

                        <th>WITHOUT GST AMOUNT</th>
                        <td class="text-right">{{ number_format($totalAmount ?? 0, 2) }}</td>
                    </tr>

                    <tr>
                        <th>GST</th>
                        <td class="text-right">{{ number_format($gstAmount ?? 0, 2) }}</td>
                    </tr>

                    <tr>
                        <th>TOTAL AMOUNT</th>
                        <td class="text-right">{{ number_format($finalAmount ?? 0, 2) }}</td>
                    </tr>

                    <tr>
                        <th>ROUND OFF</th>
                        <td class="text-right">{{ number_format($roundOff, 2) }}</td>
                    </tr>

                    <tr>
                        <th>TDS %</th>
                        <td class="text-right">{{ number_format($totalTdsPercent ?? 0, 2) }}</td>
                    </tr>

                    <tr>
                        <th>TDS AMOUNT</th>
                        <td class="text-right">{{ number_format($totalTdsAmount ?? 0, 2) }}</td>
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
                            <span style="font-size: 14px;color: #888;font-weight: bold;">Terms & Conditions</span><br>
                            <span style="font-size: 10px;">1.Payments must be settled bill-wise. No deductions will be accepted without prior confirmation.</span><br>
                            <span style="font-size: 10px;">2.Payments should be made via NEFT/RTGS to the bank details provided above.</span><br>
                            <span style="font-size: 10px;">3.Cheque/Demand Draft payments must be issued in favour of {{ $company->company_name }}.</span><br>
                            <span style="font-size: 10px;">4.Any discrepancy in the invoice must be reported within seven (7) days from the date of receipt of the invoice.</span><br>
                            <span style="font-size: 10px;">5.Payment must be made within fifteen (15) days from the invoice receipt date.</span><br>
                            <span style="font-size: 10px;">6.If payment is not received within the stipulated period, interest @ 18% per annum will be charged for the delayed period.</span><br>
                            <span style="font-size: 10px;">7.The firm is registered under the MSME Act. To avoid any disallowance under the Income Tax Act, 1961, payment must be made as per Clause No. 5 above.</span><br>
                            <span style="font-size: 10px;">8.All disputes shall be subject to Jaipur jurisdiction only.</span><br>
                        </td>
                        <td style="
                            width:30%;
                            border:1px solid #000;
                            padding:8px;
                            height:160px;
                        ">

                            <div style="
                                display:flex;
                                flex-direction:column;
                                justify-content:space-between;
                                align-items:center;
                                height:100%;
                                text-align:center;
                            ">

                                <!-- Top Company Name -->
                                <div>
                                    <strong style="font-size: 18px;">{{ $company->company_name }}</strong>
                                </div>

                                <!-- Middle Signature Image -->
                                <div>
                                    <img src="{{ $salesInvoice->branch && $salesInvoice->operationJob->branch->seal_sign
                                        ? asset('public/uploads/branch_seal_sign/' . $salesInvoice->operationJob->branch->seal_sign)
                                        : asset('public/images/seal-sign.jpg') }}"
                                        style="height:103px; width:auto;">
                                </div>

                                <!-- Bottom Text -->
                                <div>
                                    AUTHORISED SIGNATORY
                                </div>

                            </div>

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
    document.getElementById('previewBtn').addEventListener('click', function() {
        const previewSection = document.getElementById('previewSection');
        previewSection.style.display = 'block';
        previewSection.scrollIntoView({ behavior: 'smooth' });
    });
</script>

@endpush

