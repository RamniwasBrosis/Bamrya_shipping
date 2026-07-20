@extends('admin-main.layouts.default')
@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Edit Sales Invoice</a></li>
        </ol>
        <a class="text-primary fs-13" href="{{ url('admin/sales-invoices') }}"><- Go Back</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{session('success')}}    
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{session('error')}}    
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input:
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container-fluid p-2">
        <!-- row -->
        <div class="row">
            <div class="col-xl-12 col-xxl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add New BL</h4>
                    </div>
                    <div class="card-body">
                        <div id="smartwizard" class="form-wizard order-create">
                            <div class="row form-material">
                                <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                    <label class="col-sm-3 col-form-label">Activity Type:</label>
                                    <div class="col-sm-9">
                                        <form method="POST" id="searchForm">
                                            @csrf
                                            <div class="mb-6 row">
                                                <div class="d-flex gap-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" value="AI" name="search_by" {{optional($sales_invoice)->inv_cat == 'AI'? 'checked' : 'disabled'}}>
                                                        <label class="form-check-label" for="lcl">
                                                            Air Import
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" value="AE" name="search_by" {{optional($sales_invoice)->inv_cat == 'AE'? 'checked' : 'disabled'}}>
                                                        <label class="form-check-label" for="fcl20">
                                                            Air Export
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" value="SI" name="search_by" {{optional($sales_invoice)->inv_cat == 'SI'? 'checked' : 'disabled'}}>
                                                        <label class="form-check-label" for="fcl40">
                                                            Sea Import
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" value="SE" name="search_by" {{optional($sales_invoice)->inv_cat == 'SE'? 'checked' : 'disabled'}}>
                                                        <label class="form-check-label" for="air">
                                                            Sea Export
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" value="TR" name="search_by" {{optional($sales_invoice)->inv_cat == 'TR'? 'checked' : 'disabled'}}>
                                                        <label class="form-check-label" for="air">
                                                            Transport
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-validation">
                                    <form method="POST" action="{{route('sales-invoices.update', $sales_invoice->id)}}" class="needs-validation">
                                        @csrf
                                        @method('PUT')
                                        {{-- <input type="hidden" name="Inv_cat" /> --}}
                                        <input type="hidden" name="job_no" id="full_job_no" value="{{$sales_invoice->job_no}}">
                                        <div class="row">
                                            <!-- Row 1 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Job No: <span class="text-danger">*</span></label>
                                                <input type="text" value="{{$sales_invoice->full_job_no}}" class="form-control" name="full_job_no" readonly>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Invoice No: <span class="text-danger">*</span></label>
                                                <input type="text" name="invoice_no" class="form-control" value="{{$sales_invoice->invoice_no}}" required />
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Inv Date: <span class="text-danger">*</span></label>
                                                <input type="date" name="invoice_date" class="form-control" value="{{ $sales_invoice->invoice_date }}" required>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Inv Due Date:</label>
                                                <input type="date" name="invoice_due_date" class="form-control" value="{{$sales_invoice->invoice_due_date}}">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Invoice Type:</label>
                                                <select name="invoice_type" class="form-control select2">
                                                    <option value="">Select</option>
                                                    <option value="DEBITNOTE(Rs)" {{$sales_invoice->invoice_type == 'DEBITNOTE(Rs)'? 'selected' : ''}}>DEBITNOTE(Rs)</option>
                                                    <option value="CREDITNOTE(Rs)" {{$sales_invoice->invoice_type == 'CREDITNOTE(Rs)'? 'selected' : ''}}>CREDITNOTE(Rs)</option>
                                                    <option value="DEBITNOTE(Ovr.)" {{$sales_invoice->invoice_type == 'DEBITNOTE(Ovr.)'? 'selected' : ''}}>DEBITNOTE(Ovr.)</option>
                                                    <option value="CREDITNOTE(Ovr.)" {{$sales_invoice->invoice_type == 'CREDITNOTE(Ovr.)'? 'selected' : ''}}>CREDITNOTE(Ovr.)</option>
                                                    <option value="COMMISSION/REBATE" {{$sales_invoice->invoice_type == 'COMMISSION/REBATE'? 'selected' : ''}}>COMMISSION/REBATE</option>
                                                    <option value="SEZ" {{$sales_invoice->invoice_type == 'SEZ'? 'selected' : ''}}>SEZ</option>
                                                    <option value="FRT(IGST)" {{$sales_invoice->invoice_type == 'FRT(IGST)'? 'selected' : ''}}>FRT(IGST)</option>
                                                    <option value="FRT(CreditNote)" {{$sales_invoice->invoice_type == 'FRT(CreditNote)'? 'selected' : ''}}>FRT(CreditNote)</option>
                                                    <option value="BILLOFSUPPLY" {{$sales_invoice->invoice_type == 'BILLOFSUPPLY'? 'selected' : ''}}>BILL OF SUPPLY</option>
                                                    <option value="Tax Invoice" {{$sales_invoice->invoice_type == 'Tax Invoice'? 'selected' : ''}}>Tax Invoice</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Voyage Code:</label>
                                                <input type="text" name="voyage_code" class="form-control" value="{{$sales_invoice->voyage_code}}" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Job Date:</label>
                                                <input type="text" name="job_date" class="form-control" value="{{$sales_invoice->job_date}}" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">POD:</label>
                                                <input type="text" name="pod" class="form-control" value="{{$sales_invoice->pod}}" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">POL:</label>
                                                <input type="text" name="pol" class="form-control" value="{{$sales_invoice->pol}}" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">ETA DATE:</label>
                                                <input type="text" name="eta_date" class="form-control" value="{{$sales_invoice->eta_date}}" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">ETD DATE:</label>
                                                <input type="text" name="etd_date" class="form-control" value="{{$sales_invoice->etd_date}}" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <!--<div class="col-md-4 mb-3">-->
                                            <!--    <label class="form-label">BL / NO:</label>-->
                                            <!--    <input type="text" name="bl_no" class="form-control" value="{{$sales_invoice->bl_no}}" style="background: #eee; cursor: not-allowed;">-->
                                            <!--</div>-->

                                            <!-- Row 2 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Container No:</label>
                                                <input type="text" name="container" class="form-control" value="{{$sales_invoice->container}}" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Container Qty:</label>
                                                <input type="text" name="container_qty" class="form-control" value="{{$sales_invoice->container_qty}}">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Shipper Name:</label>
                                                <input type="text" name="shipper_name" class="form-control" value="{{$sales_invoice->shipper_name}}" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Consignee / Consigner:</label>
                                                <input type="text" name="consignee" class="form-control" value="{{$sales_invoice->consignee}}" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">CBM:</label>
                                                <input type="text" name="cbm" class="form-control" value="{{$sales_invoice->cbm}}" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Package Type:</label>
                                                <input type="text" name="pkgType" class="form-control" value="{{$sales_invoice->pkgType}}" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Packages:</label>
                                                <input type="text" name="packages" class="form-control" value="{{$sales_invoice->packages}}" style="background: #eee; cursor: not-allowed;">
                                            </div>

                                            <!-- Row 3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Gross WT:</label>
                                                <input type="text" name="gross_weight" class="form-control" value="{{$sales_invoice->gross_weight}}" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Chg WT:</label>
                                                <input type="text" name="chargeable_weight" class="form-control" value="{{$sales_invoice->chargeable_weight}}" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Party Type:</label>
                                                <select name="party_type" class="form-control">
                                                    <option value="">Select</option>
                                                    <option value="shipper" {{$sales_invoice->party_type == 'shipper'? 'selected' : ''}}>Shipper</option>
                                                    <option value="consignee" {{$sales_invoice->party_type == 'consignee'? 'selected' : ''}}>Consignee</option>
                                                    <option value="other" {{$sales_invoice->party_type == 'other'? 'selected' : ''}}>Others</option>
                                                </select>
                                            </div>

                                            <!-- Row 4 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Shipper Inv No:</label>
                                                <input type="text" name="full_invoice_no" class="form-control" value="{{$sales_invoice->full_invoice_no}}">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Shipping Bill No/Date:</label>
                                                <input type="text" name="shipping_no" class="form-control" value="{{$sales_invoice->shipping_no}}">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Remarks:</label>
                                                <input type="text" name="remarks" class="form-control" value="{{$sales_invoice->remarks}}">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Freight Terms:</label>
                                                <input type="text" name="freight_terms" class="form-control" value="{{$sales_invoice->freight_terms}}" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <!--<div class="col-md-4 mb-3">-->
                                            <!--    <label class="form-label">Ovrs Exch. Rate:</label>-->
                                            <!--    <input type="text" name="overseas_exchange_rate" class="form-control" value="{{$sales_invoice->overseas_exchange_rate}}">-->
                                            <!--</div>-->

                                            <!-- Row 5 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Bill To: <span class="text-danger">*</span></label>
                                                <select name="billing_party_id" class="form-control select2" required>
                                                    <option value="">Select</option>
                                                    @foreach ($parties->where('party_type', 10) as $party)
                                                        <option value="{{$party->id}}" {{$sales_invoice->billing_party_id == $party->id? 'selected' : ''}}>{{$party->party_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">GST Type: <span class="text-danger">*</span></label>
                                                <select name="gst_type" class="form-control" required>
                                                    <option value="">Select</option>
                                                    <option value="local" {{$sales_invoice->gst_type == 'local'? 'selected' : ''}}>LOCAL</option>
                                                    <option value="otherState" {{$sales_invoice->gst_type == 'otherState'? 'selected' : ''}}>Other State</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Account No:</label>
                                                <select name="bank_id" class="form-control select2">
                                                    <option value="">Select</option>
                                                    @foreach ($account_numbers as $account_number)
                                                        <option value="{{$account_number->id}}" {{$sales_invoice->bank_id == $account_number->id? 'selected' : '' }}>{{$account_number->account_no}}</option>
                                                    @endforeach
                                                </select>
                                            </div>  
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Sales Person:</label>
                                                <input type="text" name="sales_person" class="form-control" value="{{ $sales_invoice->sales_person }}" style="background: #eee; cursor: not-allowed;">
                                            </div>

                                            <!-- Row 6 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Vessel Name/Air Line:</label>
                                                <input type="text" name="vessel_name" class="form-control" value="{{ $sales_invoice->vessel_name }}">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">AWB / BL NO:</label>
                                                <input type="text" name="awb_bl_no" class="form-control" value="{{ $sales_invoice->awb_bl_no }}">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">MAWB NO:</label>
                                                <input type="text" name="mawb_no" class="form-control" value="{{ $sales_invoice->mawb_no }}" style="background: #eee;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">HAWB NO:</label>
                                                <input type="text" name="hawb_no" class="form-control" value="{{ $sales_invoice->hawb_no }}" style="background: #eee;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">HBL NO:</label>
                                                <input type="text" name="hbl_no" class="form-control" value="{{ $sales_invoice->hbl_no }}" style="background: #eee;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Sale / Purchase:</label>
                                                <input type="text" name="sale_purchase" class="form-control" value="{{ $sales_invoice->sale_purchase }}">
                                            </div>
                                        </div>

                                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                            <!--<button type="button" class="btn btn-danger btn-sm">Add Charges From Performa</button>-->
                                            <button type="button" class="btn btn-warning btn-sm">Cancel</button>
                                            <a href="{{ route('salesInvoice.import', $sales_invoice->id) }}" type="button" class="btn btn-success btn-sm">Print</a>
                                            <button type="submit" class="btn btn-primary btn-sm">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


                        <h4>Charges</h4>
                        <hr>
                        <div class="form-validation">
                            <form class="needs-validation" method="POST" action="{{ route('sales-invoices.UpdateSalesInvoiceCharge', $sales_invoice->id) }}">
                                @csrf
                                @method('PUT')
                                
                                <input type="hidden" name="" id="gst_type" value="{{$sales_invoice->gst_type}}">
                                <input type="hidden" name="charge_edit_id" id="charge_edit_id">
        
                                <div class="row">
                                    <!-- Charge Name -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Charge Name:<span class="text-danger">*</span></label>
                                            <div class="col-sm-9 d-flex align-items-center gap-2">
                                                <select name="charge_id" id="charge_name" class=" form-control wide me-2 select2">
                                                    <option value="">Select</option>
                                                    @foreach ($charges as $charge)
                                                        <option value="{{ $charge->id }}" data-container-id="{{ $charge->id }}">
                                                            {{ $charge->charge_name }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#chargesNames">
                                                    <i class="bi bi-plus-lg">+</i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Currency -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Currency:</label>
                                            <div class="col-sm-9">
                                                <select name="currency" class="form-control wide me-2 select2">
                                                    <option value="">select</option>
                                                    <option value="AED" {{$sales_invoice->currency == 'AED'? 'selected' : ''}}>AED</option>
                                                    <option value="AUD" {{$sales_invoice->currency == 'AUD'? 'selected' : ''}}>AUD</option>
                                                    <option value="BGN" {{$sales_invoice->currency == 'BGN'? 'selected' : ''}}>BGN</option>
                                                    <option value="BRL" {{$sales_invoice->currency == 'BRL'? 'selected' : ''}}>BRL</option>
                                                    <option value="CAD" {{$sales_invoice->currency == 'CAD'? 'selected' : ''}}>CAD</option>
                                                    <option value="CHF" {{$sales_invoice->currency == 'CHF'? 'selected' : ''}}>CHF</option>
                                                    <option value="CNY" {{$sales_invoice->currency == 'CNY'? 'selected' : ''}}>CNY</option>
                                                    <option value="CSD" {{$sales_invoice->currency == 'CSD'? 'selected' : ''}}>CSD</option>
                                                    <option value="CZK" {{$sales_invoice->currency == 'CZK'? 'selected' : ''}}>CZK</option>
                                                    <option value="DKK" {{$sales_invoice->currency == 'DKK'? 'selected' : ''}}>DKK</option>
                                                    <option value="EEK" {{$sales_invoice->currency == 'EEK'? 'selected' : ''}}>EEK</option>
                                                    <option value="EGP" {{$sales_invoice->currency == 'EGP'? 'selected' : ''}}>EGP</option>
                                                    <option value="EUR" {{$sales_invoice->currency == 'EUR'? 'selected' : ''}}>EUR</option>
                                                    <option value="GBP" {{$sales_invoice->currency == 'GBP'? 'selected' : ''}}>GBP</option>
                                                    <option value="HKD" {{$sales_invoice->currency == 'HKD'? 'selected' : ''}}>HKD</option>
                                                    <option value="HRK" {{$sales_invoice->currency == 'HRK'? 'selected' : ''}}>HRK</option>
                                                    <option value="HUF" {{$sales_invoice->currency == 'HUF'? 'selected' : ''}}>HUF</option>
                                                    <option value="IDR" {{$sales_invoice->currency == 'IDR'? 'selected' : ''}}>IDR</option>
                                                    <option value="ILS" {{$sales_invoice->currency == 'ILS'? 'selected' : ''}}>ILS</option>

                                                    <option value="INR" {{$sales_invoice->currency == 'INR'? 'selected' : ''}}>INR</option>
                                                    <option value="ISK" {{$sales_invoice->currency == 'ISK'? 'selected' : ''}}>ISK</option>
                                                    <option value="JPY" {{$sales_invoice->currency == 'JPY'? 'selected' : ''}}>JPY</option>
                                                    <option value="MXP" {{$sales_invoice->currency == 'MXP'? 'selected' : ''}}>MXP</option>
                                                    <option value="MYR" {{$sales_invoice->currency == 'MYR'? 'selected' : ''}}>MYR</option>
                                                    <option value="NOK" {{$sales_invoice->currency == 'NOK'? 'selected' : ''}}>NOK</option>
                                                    <option value="NZD" {{$sales_invoice->currency == 'NZD'? 'selected' : ''}}>NZD</option>
                                                    <option value="PHP" {{$sales_invoice->currency == 'PHP'? 'selected' : ''}}>PHP</option>
                                                    <option value="PLN" {{$sales_invoice->currency == 'PLN'? 'selected' : ''}}>PLN</option>
                                                    <option value="ROL" {{$sales_invoice->currency == 'ROL'? 'selected' : ''}}>ROL</option>
                                                    <option value="RUR" {{$sales_invoice->currency == 'RUR'? 'selected' : ''}}>RUR</option>
                                                    <option value="SAR" {{$sales_invoice->currency == 'SAR'? 'selected' : ''}}>SAR</option>
                                                    <option value="SEK" {{$sales_invoice->currency == 'SEK'? 'selected' : ''}}>SEK</option>
                                                    <option value="SGD" {{$sales_invoice->currency == 'SGD'? 'selected' : ''}}>SGD</option>
                                                    <option value="SIT" {{$sales_invoice->currency == 'SIT'? 'selected' : ''}}>SIT</option>

                                                    <option value="SKK" {{$sales_invoice->currency == 'SKK'? 'selected' : ''}}>SKK</option>
                                                    <option value="THB" {{$sales_invoice->currency == 'THB'? 'selected' : ''}}>THB</option>
                                                    <option value="TRL" {{$sales_invoice->currency == 'TRL'? 'selected' : ''}}>TRL</option>
                                                    <option value="TWD" {{$sales_invoice->currency == 'TWD'? 'selected' : ''}}>TWD</option>
                                                    <option value="UAH" {{$sales_invoice->currency == 'UAH'? 'selected' : ''}}>UAH</option>
                                                    <option value="US" {{$sales_invoice->currency == 'US'? 'selected' : ''}}>US</option>
                                                    <option value="USD" {{$sales_invoice->currency == 'USD'? 'selected' : ''}}>USD</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Rate Basis -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Rate_Basis:</label>
                                            <div class="col-sm-9">
                                                <select name="rate_basis" class=" form-control wide me-2">
                                                    <option value="">select</option>
                                                    <option value="LUMPSUM" {{$sales_invoice->rate_basis == 'LUMPSUM'? 'selected' : ''}}>LUMPSUM</option>
                                                    <option value="PERAIRWAYBILL" {{$sales_invoice->rate_basis == 'PERAIRWAYBILL'? 'selected' : ''}}>PER AIRWAY BILL</option>
                                                    <option value="PERBL" {{$sales_invoice->rate_basis == 'PERBL'? 'selected' : ''}}>PER BL</option>
                                                    <option value="CBMWISE" {{$sales_invoice->rate_basis == 'CBMWISE'? 'selected' : ''}}>CBMWISE</option>
                                                    <option value="PERCONT" {{$sales_invoice->rate_basis == 'PERCONT'? 'selected' : ''}}>PER CONTAINER</option>
                                                    <option value="GWTWISE" {{$sales_invoice->rate_basis == 'GWTWISE'? 'selected' : ''}}>GWTWISE</option>
                                                    <option value="CHGWTWISE" {{$sales_invoice->rate_basis == 'CHGWTWISE'? 'selected' : ''}}>CHGWTWISE</option>
                                                    <option value="RECEIPTED" {{$sales_invoice->rate_basis == 'RECEIPTED'? 'selected' : ''}}>RECEIPTED</option>
                                                    <option value="PERKG" {{$sales_invoice->rate_basis == 'PERKG'? 'selected' : 'selected'}}>PER KG</option>
                                                    <option value="PERCBM" {{$sales_invoice->rate_basis == 'PERCBM'? 'selected' : 'selected'}}>PER CBM</option>
                                                    <option value="PERINVOICE" {{$sales_invoice->rate_basis == 'PERINVOICE'? 'selected' : 'selected'}}>PER INVOICE</option>
                                                    <option value="PERSET" {{$sales_invoice->rate_basis == 'PERSET'? 'selected' : 'selected'}}>PER SET</option>
                                                    <option value="PERPACKAGE" {{$sales_invoice->rate_basis == 'PERPACKAGE'? 'selected' : 'selected'}}>PER PACKAGE</option>
                                                    <option value="PERUNIT" {{$sales_invoice->rate_basis == 'PERUNIT'? 'selected' : 'selected'}}>PER UNIT</option>
                                                    <option value="PERDAY" {{$sales_invoice->rate_basis == 'PERDAY'? 'selected' : 'selected'}}>PER DAY</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Exchange Rate -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Exch.Rate:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="exchange_rate" class="form-control" value="{{$sales_invoice->exchange_rate}}">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Per Unit -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <!--Per Unit changed to total unit--> 
                                            <label class="col-sm-3 col-form-label">Rate Per Unit/Per Cont/Per Kg:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="per_unit" class="form-control" value="{{$sales_invoice->per_unit}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <!--Per Unit changed to total unit--> 
                                            <label class="col-sm-3 col-form-label">Total Unit:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="total_unit" class="form-control" value="{{$sales_invoice->total_unit}}">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Total Charges -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Total Taxable Charges:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="freight" id="freight" class="form-control" value="{{$sales_invoice->freight}}">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- GST -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Output GST:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="gst" id="gst" class="form-control" value="{{$sales_invoice->gst}}">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- GST Applicable -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">GST(Y/N):</label>
                                            <div class="col-sm-9">
                                                <select name="gst_applicable" class=" form-control wide me-2">
                                                    <option value="">select</option>
                                                    <option value="Y" selected>Y</option>
                                                    <option value="N">N</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                     <!-- IGST -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">IGST:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="igst" class="form-control" value="{{$sales_invoice->igst}}">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- CGST -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">CGST:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="cgst" class="form-control" value="{{$sales_invoice->cgst}}">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- SGST -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">SGST:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="sgst" class="form-control" value="{{$sales_invoice->sgst}}">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Amount -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Amount:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="amount" id="amount" class="form-control" value="{{$sales_invoice->amount}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Charge Description:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="charge_desc" class="form-control" value="{{$sales_invoice->charge_desc}}">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- TDS -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">TDS %:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="tds" id="tds" class="form-control">
                                            </div>
                                        </div> 
                                    </div>
                                    <!-- TDS Amt. -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">TDS Amt:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="tds_amount" id="tds_amount" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- SAC Code -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">SAC_Code:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="sac_code" class="form-control" value="{{$sales_invoice->sac_code}}">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Full Invoice No -->
                                    <!--<div class="col-xl-6">-->
                                    <!--    <div class="mb-3 row">-->
                                    <!--        <label class="col-sm-3 col-form-label">Fullinvno:</label>-->
                                    <!--        <div class="col-sm-9">-->
                                    <!--            <input type="text" name="charge_full_invoice_no" class="form-control" value="{{$sales_invoice->charge_full_invoice_no}}">-->
                                    <!--        </div>-->
                                    <!--    </div>-->
                                    <!--</div>-->

                                    <!-- Remarks -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Remarks:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="remarks" class="form-control" value="{{$sales_invoice->remarks}}">
                                            </div>
                                        </div>
                                    </div>

                                    

                                    <!-- Prepaid/Collect -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Prep/Coll:</label>
                                            <div class="col-sm-9">
                                                <select name="prepaid_coll" class=" form-control wide me-2">
                                                    <option value="">select</option>
                                                    <option value="C">C</option>
                                                    <option value="P">P</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Rate -->
                                    <!--<div class="col-xl-6">-->
                                    <!--    <div class="mb-3 row">-->
                                    <!--        <label class="col-sm-3 col-form-label">Rate:</label>-->
                                    <!--        <div class="col-sm-9">-->
                                    <!--            <input type="text" name="rate_per_unit" class="form-control" value="{{$sales_invoice->rate_per_unit}}">-->
                                    <!--        </div>-->
                                    <!--    </div>-->
                                    <!--</div>-->

                                    

                                    <!-- CAF % -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">CAF %:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="caf_percent" class="form-control" value="{{$sales_invoice->caf_percent}}">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- BAF % -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">BAF %:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="baf_percent" class="form-control" value="{{$sales_invoice->baf_percent}}">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- CC % -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">CC %:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="cc_percent" class="form-control" value="{{$sales_invoice->cc_percent}}">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- CC Apply -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">CC Apply:</label>
                                            <div class="col-sm-9">
                                                <select name="cc_apply" class=" form-control wide me-2">
                                                    <option value="">select</option>
                                                    <option value="N" {{$sales_invoice->cc_apply == 'N'? 'selected' : ''}}>N</option>
                                                    <option value="Y" {{$sales_invoice->cc_apply == 'Y'? 'selected' : ''}}>Y</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- GSTIN -->
                                    <!--<div class="col-xl-6">-->
                                    <!--    <div class="mb-3 row">-->
                                    <!--        <label class="col-sm-3 col-form-label">GSTIN:</label>-->
                                    <!--        <div class="col-sm-9">-->
                                    <!--            <input type="text" name="gstin" class="form-control" value="{{$sales_invoice->gstin}}">-->
                                    <!--        </div>-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                    <!-- CAF Amount -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">CAF. Amt:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="caf_amount" class="form-control" value="{{$sales_invoice->caf_amount}}">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- BAF Amount -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">BAF. Amt:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="baf_amount" class="form-control" value="{{$sales_invoice->baf_amount}}">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- CC Amount -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">CC. Amt:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="cc_amount" class="form-control" value="{{$sales_invoice->cc_amount}}">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- CAF Apply -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">CAF_Apply:</label>
                                            <div class="col-sm-9">
                                                <select name="caf_apply" class=" form-control wide me-2">
                                                    <option value="">select</option>
                                                    <option value="N" {{$sales_invoice->caf_apply == 'N'? 'selected' : ''}}>N</option>
                                                    <option value="Y" {{$sales_invoice->caf_apply == 'Y'? 'selected' : ''}}>Y</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Total -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Total:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="total" id="total" class="form-control" value="{{$sales_invoice->total}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <button type="submit" class="btn btn-primary btn-sm">ADD/UPDATE CHARGES</button>
                                </div>
                            </form>
                        </div>
                        
                        
                        <h4>File Upload</h4>
                        <hr>
                        <div class="form-validation">
                            <form class="ajaxFileUpload" action="{{route('file-upload.updateFileUpload')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                
                                <input type="hidden" name="file_related" value="sales_invoice">
                                <input type="hidden" name="sales_invoice_id" class="sales_invoice_id" value="{{ $sales_invoice->id }}">
                                <div class="row">
                                    <div class="col-xl-9">
                                        <div class="mb-3 row row">
                                            <label class="col-sm-3 col-form-label">Choose File:<span
                                                class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <div class="d-flex">
                                                    <input type="file" name="file[]" class="form-control me-2" multiple accept=".pdf,.doc,.docx,.xls,.xlsx" />
                                                    <button type="submit" class="btn btn-warning btn-sm" style="width: 200px;">UploadFile</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                
                                </div>
                            </form>
                            <form id="searchProformaInvoiceFile" method="post">
                                @csrf
                                <div class="col-xl-9">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Find PDF File:</label>
                                        <div class="col-sm-9">
                                            <div class="d-flex">
                                                <select class="select2 form-control wide me-2" name="search_query">
                                                    <option value="">Select</option>
                                                    @foreach ($files as $file)
                                                        <option value="{{ $file->id }}">{{ $file->file_name }}</option>
                                                    @endforeach
                                                </select>
                                                <button type="submit" class="btn btn-primary btn-sm" style="width:180px;">Search</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            
                            <div id="searchFile"></div>
                        </div>
                        
                        
                    </div>
                    
                    <div>
                        <table class="table">
                            <thead>
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">Job No.</th>
                                  <th scope="col">Invoice No.</th>
                                  <th scope="col">Charge Name</th>
                                  <!--<th scope="col">Currency</th>-->
                                  <!--<th scope="col">Exch. Rate</th>-->
                                  <!--<th scope="col">Per unit</th>-->
                                  <!--<th scope="col">Total unit</th>-->
                                  <!--<th scope="col">Charge Amount</th>-->
                                  <!--<th scope="col">GST(Y/N)</th>-->
                                  <!--<th scope="col">SGST</th>-->
                                  <!--<th scope="col">CGST</th>-->
                                  <!--<th scope="col">IGST</th>-->
                                  <th scope="col">Total Amt.</th>
                                  <th scope="col">EDIT</th>
                                  <th scope="col">DELETE</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($chargeDetails as $chargeDetail)
                                    <tr>
                                      <th scope="row">{{ $chargeDetail->id }}</th>
                                      <td>{{ $chargeDetail?->salesInvoice->operationJob->job_no }}</td>
                                      <td>{{ $chargeDetail?->salesInvoice->invoice_no }}</td>
                                      <td>{{ $chargeDetail?->chargeName->charge_name }}</td>
                                      
                                      <!--<td>{{ $chargeDetail?->currency }}</td>-->
                                      <!--<td>{{ $chargeDetail?->exchange_rate }}</td>-->
                                      <!--<td>{{ $chargeDetail?->per_unit }}</td>-->
                                      <!--<td>{{ $chargeDetail?->total_unit }}</td>-->
                                      <!--<td>{{ $chargeDetail?->freight }}</td>-->
                                    
                                      <!--<td>{{ $chargeDetail?->gst_applicable }}</td>-->
                                      <!--<td>{{ $chargeDetail?->sgst }}</td>-->
                                      <!--<td>{{ $chargeDetail?->cgst }}</td>-->
                                      <!--<td>{{ $chargeDetail?->igst }}</td>-->
                                      <td>{{ $chargeDetail?->total }}</td>
                                      
                                      <td><a class="btn btn-sm btn-primary editChargeBtn" data-id="{{ $chargeDetail->id }}">Edit</a></td>
                                      <td><a class="btn btn-sm btn-danger deleteChargeBtn" data-id="{{ $chargeDetail->id }}">DELETE</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    
<!-- Charge Name Details -->
@include('admin-main.admin.commonModelForms.charge_name_model')  


@endsection
@push('scripts')
    <script>
        $(document).ready(function() {

            $('.ajaxFileUpload').on('submit', function(e) {
                e.preventDefault();
        
                let form = $(this);
                let formData = new FormData();
        
                // Append file_related
                let fileRelated = form.find('input[name="file_related"]').val();
                formData.append('file_related', fileRelated);
        
                // Append correct invoice ID automatically
                form.find('input[type="hidden"]').each(function() {
                    formData.append($(this).attr('name'), $(this).val());
                });
        
                // Append multiple files
                let files = form.find('input[type="file"]')[0].files;
                if (files.length === 0) {
                    alert("Please select at least one file.");
                    return;
                }
        
                $.each(files, function(i, file) {
                    formData.append('file[]', file);
                });
        
                $.ajax({
                    url: "{{ route('account.file-upload.uploadFileUpload') }}",
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.success) {
                            alert("Files uploaded successfully!");
                            form[0].reset();
                        } else {
                            alert(response.message || 'Upload failed.');
                        }
                    },
                    error: function(xhr) {
                        if(xhr.status === 422){
                            let errors = xhr.responseJSON.errors;
                            let messages = '';
                            Object.values(errors).forEach(arr => arr.forEach(msg => messages += msg + "\n"));
                            alert(messages);
                        } else {
                            alert('Something went wrong.');
                        }
                    }
                });
        
            });
        
        });
    </script>
    <script>
        document.getElementById('searchProformaInvoiceFile').addEventListener('submit', function(e) {
            e.preventDefault();
    
            const formData = new FormData(this);
            const id = formData.get('search_query');
    
            fetch("{{ route('file-upload.searchFile') }}", {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
                    },
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    // const deleteUrl = `/multi-file-upload/${id}`;
                    document.getElementById('searchFile').innerHTML = data;
                    document.getElementById('delete_td').innerHTML = `
                        <button class="btn btn-sm btn-danger" onclick="clearSearchFile()">×</button> 
                        <button class="btn btn-sm btn-danger" onclick="deleteSearchFile(${id})">Delete</button>
                    `;
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });

        function clearSearchFile() {
            document.getElementById("searchFile").innerHTML = "";
        }
        
        function clearSearchFile() {
            document.getElementById("searchFile").innerHTML = "";
        }
        
        const deleteFileUrl = "{{ route('file-upload.destroy', ['id' => ':id']) }}"; // placeholder :id
        // Placeholder for delete function
        function deleteSearchFile(id) {
            if (!confirm("Are you sure you want to delete this file?")) return;
    
            // Replace :id with actual file id
            const url = deleteFileUrl.replace(':id', id);
    
            fetch(url, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value,
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                alert(data.message);
                location.reload();
                clearSearchFile();
            })
            .catch(err => console.error(err));
        }

    </script>
    <script>
        //mourya
        $(document).ready(function(){
            $('.select2').select2({
                width: '100%'
            })
            
            // Submit charge form via AJAX
            $('#chargeForm').on('submit', function (e) {
                e.preventDefault();
        
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function (res) {
                        if (res.status) {
        
                            // Close modal
                            $('#chargesNames').modal('hide');
        
                            // Reset the form fields
                            $('#chargeForm')[0].reset();
        
                            // Create a new option in the select box
                            const newOption = new Option(res.data.charge_name, res.data.id, true, true);
        
                            // Add to select2 and trigger change
                            $('#charge_name').append(newOption).trigger('change');
        
                            // Optional: show a small alert
                            alert('Charge added successfully!');
                        } else {
                            alert(res.message || 'Failed to add charge.');
                        }
                    },
                    error: function (xhr) {
                        console.error(xhr.responseText);
                        alert('Error while saving charge.');
                    }
                });
            });
            
            // Calculate TDS amount
            function calculateTds() {
                let tdsPercent = parseFloat($('#tds').val()) || 0;
                let amountWithoutTax = parseFloat($('#freight').val()) || 0;
                let total = parseFloat($('#total').val()) || 0;
                
                if (tdsPercent === 0) {
                    let amount = parseFloat($('#amount').val()) || 0;
                    let roundedTotal = amount;
                    
                    $('#tds_amount').val("0.00");
                    $('#total').val(roundedTotal.toFixed(3));
                    return; 
                }
        
                let tdsAmount = (amountWithoutTax * tdsPercent) / 100;
                $('#tds_amount').val(tdsAmount.toFixed(3));
                $('#tds_amount').css('background', '#ded9d9')
                    .prop('readonly', true);
        
                let finalTotal = total - tdsAmount;
                let roundedTotal = finalTotal;
                $('#total').val(roundedTotal.toFixed(3));
            }
        
            $('#tds').on('blur', function() {
                calculateTds();
            });
    
            // --- when charge_name changes ---
            $('#charge_name').on('change', function (e) {
                e.preventDefault();
        
                let selectedValue = $(this).val();
        
                $.ajax({
                    url: '{{ route("sales-invoices.getCharge") }}',
                    type: 'post',
                    data: {'id': selectedValue},
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(res){
                        if(res.status){
                            if(res.data.gst_percentage){
                                $('input[name="gst"]').val(res.data.gst_percentage)
                                    .css('background', '#ded9d9')
                                    .prop('readonly', true);
                            }
        
                            $('input[name="sac_code"]').val(res.data.sac_code)
                                .css('background', '#ded9d9')
                                .prop('readonly', true);
                        }
        
                        calculateTotals();
                    },
                    error: function(xhr){
                        console.log('Error:', xhr.responseText);
                    }
                });
            });
        
        
            // --- when any of these change, recalculate ---
            $('select[name="gst_type"], input[name="per_unit"], input[name="total_unit"], input[name="exchange_rate"]').on('change keyup', function(){
                calculateTotals();
            });
        
            $('select[name="gst_applicable"]').on('change', function() {
                calculateTotals();
            });
        
            // === MAIN FUNCTION ===
            function calculateTotals() {

                let gstType = $('select[name="gst_type"]').val();
            
                let perUnitVal = $('input[name="per_unit"]').val();
                let totalUnitVal = $('input[name="total_unit"]').val();
                let exchRateVal = $('input[name="exchange_rate"]').val();
            
                let gstPercent = parseFloat($('input[name="gst"]').val()) || 0;
            
                let gstApplicable = $('select[name="gst_applicable"]').val();
            
                // STOP auto calculation if important fields are empty
                if (
                    perUnitVal === '' ||
                    totalUnitVal === '' ||
                    exchRateVal === ''
                ) {
                    return;
                }
            
                let perUnit = parseFloat(perUnitVal);
                let totalUnit = parseFloat(totalUnitVal);
                let exchRate = parseFloat(exchRateVal);
            
                // Invalid numbers protection
                if (
                    isNaN(perUnit) ||
                    isNaN(totalUnit) ||
                    isNaN(exchRate)
                ) {
                    return;
                }
            
                // Calculate Total Charges
                let totalCharges = perUnit * totalUnit * exchRate;
            
                $('input[name="freight"]').val(totalCharges.toFixed(3));
            
                let cgst = 0,
                    sgst = 0,
                    igst = 0;
            
                // GST calculation
                if (gstApplicable === 'Y') {
            
                    if (gstType === 'local') {
            
                        cgst = ((gstPercent / 2) * totalCharges) / 100;
                        sgst = ((gstPercent / 2) * totalCharges) / 100;
            
                    } else if (
                        gstType === 'otherState' ||
                        gstType === 'otherstate' ||
                        gstType === 'other_state'
                    ) {
            
                        igst = (gstPercent * totalCharges) / 100;
                    }
                }
            
                let total = totalCharges + cgst + sgst + igst;
            
                $('input[name="cgst"]').val(cgst.toFixed(3));
            
                $('input[name="sgst"]').val(sgst.toFixed(3));
            
                $('input[name="igst"]').val(igst.toFixed(3));
            
                $('input[name="amount"]').val(total.toFixed(3));
            
                $('input[name="total"]').val(total.toFixed(3));
            
                // TDS calculation
                if ($('#tds').val() !== '') {
                    calculateTds();
                }
            }
        });
    </script>
    
    
    <script>
        $(document).on('click', '.editChargeBtn', function() {
            const chargeId = $(this).data('id');
        
            // Fetch charge detail using AJAX
            $.ajax({
                url: "{{ route('sales-invoices.getChargeDetail', '') }}/" + chargeId,
                method: "GET",
                success: function(response) {
                    
                    // Fill form fields
                    $('#charge_edit_id').val(response.id);
                    $('#charge_name').val(response.charge_id).trigger('change');
                    $('select[name="currency"]').val(response.currency).trigger('change');
                    $('#rate_basis').val(response.rate_basis).trigger('change');
                    $('input[name="per_unit"]').val(response.per_unit || '');
                    $('input[name="exchange_rate"]').val(response.exchange_rate);
                    $('input[name="total_unit"]').val(response.total_unit);
                    $('input[name="freight"]').val(response.freight);
                    $('input[name="remarks"]').val(response.remarks);
                    $('input[name="gst"]').val(response.gst);
                    $('select[name="prepaid_coll"]').val(response.prepaid_coll);
                    $('select[name="gst_applicable"]').val(response.gst_applicable);
                    $('input[name="rate_per_unit"]').val(response.rate_per_unit);
                    $('input[name="amount"]').val(response.amount);
                    $('input[name="tds"]').val(response.tds);
                    $('input[name="tds_amount"]').val(response.tds_amount);
                    $('input[name="caf_percent"]').val(response.caf_percent);
                    $('input[name="baf_percent"]').val(response.baf_percent);
                    $('input[name="cc_percent"]').val(response.cc_percent);
                    $('select[name="cc_apply"]').val(response.cc_apply);
                    $('input[name="gstin"]').val(response.gstin);
                    $('input[name="cgst"]').val(response.cgst);
                    $('input[name="igst"]').val(response.igst);
                    $('input[name="caf_amount"]').val(response.caf_amount);
                    $('input[name="baf_amount"]').val(response.baf_amount);
                    $('input[name="cc_amount"]').val(response.cc_amount);
                    $('select[name="caf_apply"]').val(response.caf_apply);
                    $('input[name="sac_code"]').val(response.sac_code);
                    $('input[name="charge_desc"]').val(response.charge_desc);
                    $('input[name="sgst"]').val(response.sgst);
                    $('input[name="total"]').val(response.total);
        
                    // Scroll smoothly to the form
                    $('html, body').animate({
                        scrollTop: $(".form-validation").offset().top - 100
                    }, 500);
                },
                error: function(xhr) {
                    alert('Error fetching charge details.');
                }
            });
        });
        
        $(document).on('click', '.deleteChargeBtn', function(e){
            e.preventDefault();
           
            let chargeId = $(this).data('id'); // get the id from button
            if (!confirm('Are you sure you want to delete this charge?')) return;
    
            $.ajax({
                url: "{{ route('sales-invoices.deleteChargeDetail', '') }}/" + chargeId,
                type: "DELETE",
                data: {
                    _token: "{{ csrf_token() }}" 
                },
                success: function(response) {
                    setTimeout(() => location.reload(), 500);
                },
                error: function(xhr) {
                    alert('Error fetching charge details.');
                }
            })
        })
    </script>
@endpush
