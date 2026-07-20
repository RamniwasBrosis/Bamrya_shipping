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
        font-weight: bold;
    }
</style>

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h5 class="text-primary mb-0">
                <i class="fas fa-file-invoice"></i> PUR INV BL REPORT - (BL JOB NO: {{ $purchaseInvoice->full_job_no ?? '' }})
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
            <div class="row align-items-center mb-3">
                <!--<div class="col-md-2">-->
                <!--    <label class="fw-bold">Account No:</label>-->
                <!--</div>-->
                <!--<div class="col-md-6">-->
                <!--    <div class="form-check form-check-inline">-->
                <!--        <input class="form-check-input" type="radio" name="account_no" id="na1" value="na" checked>-->
                <!--        <label class="form-check-label" for="na1">NA</label>-->
                <!--    </div>-->
                <!--    <div class="form-check form-check-inline">-->
                <!--        <input class="form-check-input" type="radio" name="account_no" id="na2" value="na2">-->
                <!--        <label class="form-check-label" for="na2">NA</label>-->
                <!--    </div>-->
                <!--</div>-->

                <!--{{-- ADVANCE INPUT --}}-->
                <!--<div class="col-md-2 text-end">-->
                <!--    <label class="fw-bold">Advance:</label>-->
                <!--</div>-->
                <!--<div class="col-md-2">-->
                <!--    <input type="number" class="form-control" id="advance" value="0" min="0">-->
                <!--</div>-->
            </div>

            {{-- BUTTONS --}}
            <div class="row mt-3">
                <div class="col-md-12 text-start">
                    <button class="btn btn-primary" id="previewBtn">Preview Report</button> 
                    <!--<button class="btn btn-warning text-white">GENERATE E-INVOICE</button>-->
                    <!--<a href="{{ route('purchaseInvoice.printPurchaseInvoice', $purchaseInvoice->id) }}" -->
                    <!--   class="btn btn-warning text-white" -->
                    <!--   target="_blank">-->
                    <!--   PRINT INVOICE-->
                    <!--</a>-->

                    <a href="{{ url('/admin/purchase-invoices') }}" class="btn btn-outline-warning float-end">Purchase List</a>
                </div>
            </div>
            {{-- PREVIEW SECTION --}}
            <div id="previewSection" class="mt-5" style="display: none;">
                <h3 class="invoice-title">
                    {{ $purchaseInvoice->invoice_type }}
                </h3>
                <hr>
            
                 <!--HEADER: Logo + Company Info -->
                <table class="header-table">
                    <tr>
                        <td width="30%" class="text-center">
                            <img src="{{ $logoUrl }}" alt="Logo" style="width:180px;">
                        </td>
                        <td width="70%" class="text-end">
                            <div class="company-name">{{ $company->company_name }}</div>
                            <div>{{ $company->address }}</div>
                            <div>PAN: {{ $company->companySetting->pan_no }} | GSTIN: {{ $company->companySetting->gstin_no }} | TAN: {{ $company->companySetting->tan_no }}</div>
                            <div>CIN: {{ $company->companySetting->cin_no }}</div>
                            <div>PHONE: {{ $company->companySetting->phone }} | EMAIL: {{ $company->companySetting->email }}</div>
                        </td>
                    </tr>
                </table>
            
                 <!--SHIPPER & INVOICE INFO -->
                <table>
                    <tr>
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
                        <td rowspan="4">
                            <strong>Bill From</strong><br><br>
                            <span class="text-center">
                                <strong>{{ $purchaseInvoice->partyName->party_name ?? '' }}</strong><br>
                                {{ $purchaseInvoice->partyName->address_line1 ?? '' }}<br>
                                {{ $purchaseInvoice->partyName->address_line2 ?? '' }}<br>
                                {{ $purchaseInvoice->partyName->address_line2 ?? '' }}<br>
                                {{ $purchaseInvoice->partyName->city ?? '' }}<br>
                                <br><br>GSTIN: {{ $purchaseInvoice->partyName->gstin ?? '' }}
                            </span>
                        </td>
                        <td><strong>INVOICE NO. </strong>{{ $purchaseInvoice->invoice_no ?? '' }}</td>
                        <td><strong>INVOICE DATE : </strong>{{ \Carbon\Carbon::parse($purchaseInvoice->invoice_date)->format('d-m-Y') }}</td>
                    </tr>
                    <tr>
                        <th><strong>JOB NO. </strong>{{ $purchaseInvoice->full_job_no ?? '' }}</th>
                        <td><strong>JOB DATE: </strong>{{$purchaseInvoice->job_date??''}}</td>
                    </tr>
                    <tr>
                        <th><strong>SHIPPER NAME: </strong>{{$purchaseInvoice->shipper_name??''}}</th>
                        <td><strong>SALES PERSON: </strong>{{$purchaseInvoice->sales_person??''}}</td>
                    </tr>
                    <tr>
                        <th><strong>PORT OF LOADING: </strong>{{ $purchaseInvoice->pol ?? '' }}</th>
                        <td><strong>PORT OF DISCHARGE: </strong>{{ $purchaseInvoice->pod ?? '' }}</td>
                    </tr>
            
                    <tr>
                        <td><strong>SHIPPER INV. NO:</strong> {{ $purchaseInvoice->full_invoice_no ?? '' }}</td>
                        <td><strong>CHARGABLE WEIGHT: </strong>{{ $purchaseInvoice->chargeable_weight ?? '' }}</td>
                        <td><strong>NO OF PKGS: </strong>{{ $purchaseInvoice->packages ?? 0 }}</td>
                    </tr>
            
                    <tr>
                        <td><strong>S.BILL/BOE NO. & DATE:</strong>{{ $purchaseInvoice->shipping_no ?? '' }}</td>
                        <td><strong>MBL/MAWB: </strong>{{ $purchaseInvoice->mawb_no ? $purchaseInvoice->mawb_no : $purchaseInvoice->awb_bl_no }}</td>
                        <td><strong>HBL/HAWB: </strong>{{ $purchaseInvoice->hbl_no ? $purchaseInvoice->hbl_no : $purchaseInvoice->hawb_no }}</td>
                    </tr>
            
                    <tr>
                        <td><strong>CBM:</strong> {{ $purchaseInvoice->cbm ?? '' }}</td>
                        <td><strong>ETD/ETA: </strong>{{ $purchaseInvoice->etd_date ?? '' }} / {{ $purchaseInvoice->eta_date ?? '' }}</td>
                        <td><strong>SHIPMENT TYPE: </strong>{{ $purchaseInvoice->remarks ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>VESSEL & VOY / AIRLINE:</strong> {{ $purchaseInvoice->vessel_name ?? '' }}</td>
                        <td><strong>CONTAINER NO: </strong>{{ $purchaseInvoice->container ?? '' }}</td>
                        <td><strong>CONTAINER QTY: </strong>{{ $purchaseInvoice->container_qty ?? '0' }}</td>
                    </tr>
                    
                    <tr>
                        <td colspan="3"><strong>CONSIGNEE NAME: </strong>{{ $purchaseInvoice->consignee ?? '' }}</td>
                    </tr>
                </table>
            
                 <!--CHARGES TABLE -->
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
                            <td>{{ $charge->chargeName->charge_name??'' }}</td>
                            <td class="text-center">{{ $charge->chargeName->charge_code??'' }}</td>
                            <td class="text-center">{{ $charge->total_unit }}</td>
                            <td class="text-center">{{ $charge->currency }}</td>
                            <td class="text-center">{{ $charge->exchange_rate }}</td>
                            <td class="text-center">{{ $charge->per_unit ?? '' }}</td>
                    
                            <!-- Taxable Amount (Correct) -->
                            <td class="text-right">{{ number_format($charge->freight, 2) }}</td>
                    
                            <!-- GST % and components -->
                            <td class="text-right">{{ number_format($charge->gst, 2) }}</td>
                            <td class="text-right">{{ number_format($charge->cgst, 2) }}</td>
                            <td class="text-right">{{ number_format($charge->sgst, 2) }}</td>
                            <td class="text-right">{{ number_format($charge->igst, 2) }}</td>
                    
                            <!-- Total Amount including GST (Correct) -->
                            <td class="text-right">{{ number_format($totalWithGST, 2) }}</td>
                        </tr>
                    @endforeach
                        <tr style="font-weight:bold; background:#f5f5f5;height:0px;">
                            <td colspan="7" class="text-right">
                                TOTAL
                            </td>
                    
                            <!-- Total Taxable Amount -->
                            <td class="text-right">
                                {{ number_format($totalAmount, 2) }}
                            </td>
                        
                            <!-- GST Rate -->
                            <td></td>
                        
                            <!-- CGST -->
                            <td class="text-right">
                                {{ number_format($chargeDetails->sum('cgst'), 2) }}
                            </td>
                        
                            <!-- SGST -->
                            <td class="text-right">
                                {{ number_format($chargeDetails->sum('sgst'), 2) }}
                            </td>
                        
                            <!-- IGST -->
                            <td class="text-right">
                                {{ number_format($chargeDetails->sum('igst'), 2) }}
                            </td>
                        
                            <!-- Total Amount -->
                            <td class="text-right">
                                {{ number_format($finalAmount, 2) }}
                            </td>
                        </tr>

                        @if(!empty($purchaseInvoice->charges))
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
                    <tr>
                        <td colspan="2" width="70%">
                            <br>
                            Company's GSTIN: <strong>{{ $purchaseInvoice->partyName->gstin ?? '' }}</strong>
                        </td>
                        <td width="30%" class="text-center" style="vertical-align: bottom;">
                            <br><strong>{{ $purchaseInvoice->partyName->party_name ?? '' }}</strong><br><br>
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
    document.getElementById('previewBtn').addEventListener('click', function() {
        const previewSection = document.getElementById('previewSection');
        previewSection.style.display = 'block';
        previewSection.scrollIntoView({ behavior: 'smooth' });
    });
</script>

@endpush

