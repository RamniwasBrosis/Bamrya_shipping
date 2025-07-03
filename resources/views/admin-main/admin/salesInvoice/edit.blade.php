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
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="mb-2">{{$error}}</li>
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
                                        <div class="row">
                                            <!-- Row 1 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Job No: <span class="text-danger">*</span></label>
                                                <input type="text" value="{{$sales_invoice->job_no}}" class="form-control" name="job_no" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Voyage Code:</label>
                                                <input type="text" name="voyage_date" class="form-control" value="{{$sales_invoice->voyage_date}}" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">POD:</label>
                                                <input type="text" name="pod" class="form-control" value="{{$sales_invoice->pod}}" style="background: #eee; cursor: not-allowed;">
                                            </div>

                                            <!-- Row 2 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Container:</label>
                                                <input type="text" name="container" class="form-control" value="{{$sales_invoice->container}}" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Consignee:</label>
                                                <input type="text" name="consignee" class="form-control" value="{{$sales_invoice->consignee}}" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">CBM:</label>
                                                <input type="text" name="cbm" class="form-control" value="{{$sales_invoice->cbm}}" style="background: #eee; cursor: not-allowed;">
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
                                                    <option value="customer" {{$sales_invoice->party_type == 'customer'? 'selected' : ''}}>Customer</option>
                                                    <option value="other" {{$sales_invoice->party_type == 'other'? 'selected' : ''}}>Other Billing Party</option>
                                                </select>
                                            </div>

                                            <!-- Row 4 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Invoice Type:</label>
                                                <select name="invoice_type" class="form-control">
                                                    <option value="">Select</option>
                                                    <option value="1" {{$sales_invoice->invoice_type == '1'? 'selected' : ''}}>DEBITNOTE(Rs)</option>
                                                    <option value="2" {{$sales_invoice->invoice_type == '2'? 'selected' : ''}}>CREDITNOTE(Rs)</option>
                                                    <option value="3" {{$sales_invoice->invoice_type == '3'? 'selected' : ''}}>DEBITNOTE(Ovr.)</option>
                                                    <option value="4" {{$sales_invoice->invoice_type == '4'? 'selected' : ''}}>CREDITNOTE(Ovr.)</option>
                                                    <option value="5" {{$sales_invoice->invoice_type == '5'? 'selected' : ''}}>COMMISSION/REBATE</option>
                                                    <option value="6" {{$sales_invoice->invoice_type == '6'? 'selected' : ''}}>SEZ</option>
                                                    <option value="7" {{$sales_invoice->invoice_type == '7'? 'selected' : ''}}>FRT(IGST)</option>
                                                    <option value="8" {{$sales_invoice->invoice_type == '8'? 'selected' : ''}}>FRT(CreditNote)</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Full Inv No:</label>
                                                <input type="text" name="full_invoice_no" class="form-control" value="{{$sales_invoice->full_invoice_no}}">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Ovrs Exch. Rate:</label>
                                                <input type="text" name="overseas_exchange_rate" class="form-control" value="{{$sales_invoice->overseas_exchange_rate}}">
                                            </div>

                                            <!-- Row 5 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Billing Party:</label>
                                                <select name="billing_party_id" class="form-control">
                                                    <option value="">Select</option>
                                                    @foreach ($parties as $party)
                                                        <option value="{{$party->id}}" {{$sales_invoice->billing_party_id == $party->id? 'selected' : ''}}>{{$party->party_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">GST Type:</label>
                                                <select name="gst_type" class="form-control">
                                                    <option value="">Select</option>
                                                    <option value="local" {{$sales_invoice->gst_type == 'local'? 'selected' : ''}}>LOCAL</option>
                                                    <option value="outstation" {{$sales_invoice->gst_type == 'outstation'? 'selected' : ''}}>OUTSTATION</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Account No:</label>
                                                <select name="bank_id" class="form-control">
                                                    <option value="">Select</option>
                                                    @foreach ($account_numbers as $account_number)
                                                        <option value="{{$account_number->id}}" {{$sales_invoice->bank_id == $account_number->id? 'selected' : '' }}>{{$account_number->account_no}}</option>
                                                    @endforeach
                                                </select>
                                            </div>  

                                            <!-- Row 6 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Inv No:</label>
                                                <input type="text" name="invoice_no" class="form-control" value="{{$sales_invoice->invoice_no}}">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Inv Date:</label>
                                                <input type="date" name="invoice_date" class="form-control" value="{{ date('Y-m-d'), $sales_invoice->invoice_date }}">
                                            </div>
                                        </div>

                                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                            <button type="button" class="btn btn-danger btn-sm">Add Charges From Performa</button>
                                            <button type="button" class="btn btn-warning btn-sm">Cancel</button>
                                            <button type="button" class="btn btn-success btn-sm">Print</button>
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
                                <div class="row">
                                    <!-- Charge Name -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Charge_Name:<span class="text-danger">*</span></label>
                                            <div class="col-sm-9 d-flex align-items-center gap-2">
                                                <select name="charge_name" class="default-select form-control wide me-2">
                                                    <option value="">select</option>
                                                    @foreach ($charges as $charge)
                                                        <option value="{{$charge->id}}" {{$sales_invoice->charge_name == $charge->id? 'selected' : ''}}>{{$charge->charge_name}}</option>
                                                    @endforeach
                                                </select>
                                                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#">
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
                                                <select name="currency" class="default-select form-control wide me-2">
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
                                                <select name="rate_basis" class="default-select form-control wide me-2">
                                                    <option value="">select</option>
                                                    <option value="LUMPSUM" {{$sales_invoice->rate_basis == 'LUMPSUM'? 'selected' : ''}}>LUMPSUM</option>
                                                    <option value="CBMWISE" {{$sales_invoice->rate_basis == 'CBMWISE'? 'selected' : ''}}>CBMWISE</option>
                                                    <option value="PERCONT" {{$sales_invoice->rate_basis == 'PERCONT'? 'selected' : ''}}>PERCONT</option>
                                                    <option value="GWTWISE" {{$sales_invoice->rate_basis == 'GWTWISE'? 'selected' : ''}}>GWTWISE</option>
                                                    <option value="CHGWTWISE" {{$sales_invoice->rate_basis == 'CHGWTWISE'? 'selected' : ''}}>CHGWTWISE</option>
                                                    <option value="PERUNIT" {{$sales_invoice->rate_basis == 'PERUNIT'? 'selected' : ''}}>PERUNIT</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Per Unit -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Per Unit:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="per_unit" class="form-control" value="{{$sales_invoice->per_unit}}">
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

                                    <!-- Freight -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Freight:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="freight" class="form-control" value="{{$sales_invoice->freight}}">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Full Invoice No -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Fullinvno:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="charge_full_invoice_no" class="form-control" value="{{$sales_invoice->charge_full_invoice_no}}">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Remarks -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Remarks:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="remarks" class="form-control" value="{{$sales_invoice->remarks}}">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- GST -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">GST:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="gst" class="form-control" value="{{$sales_invoice->gst}}">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Prepaid/Collect -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Prep/Coll:</label>
                                            <div class="col-sm-9">
                                                <select name="prepaid_coll" class="default-select form-control wide me-2">
                                                    <option value="">select</option>
                                                    <option value="C" {{$sales_invoice->prepaid_coll == 'C'? 'selected' : ''}}>C</option>
                                                    <option value="P" {{$sales_invoice->prepaid_coll == 'P'? 'selected' : ''}}>P</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- GST Applicable -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">GST(Y/N):</label>
                                            <div class="col-sm-9">
                                                <select name="gst_applicable" class="default-select form-control wide me-2">
                                                    <option value="">select</option>
                                                    <option value="Y" {{$sales_invoice->gst_applicable == 'Y'? 'selected' : ''}}>Y</option>
                                                    <option value="N" {{$sales_invoice->gst_applicable == 'N'? 'selected' : ''}}>N</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Rate -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Rate:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="rate_per_unit" class="form-control" value="{{$sales_invoice->rate_per_unit}}">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Amount -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Amount:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="amount" class="form-control" value="{{$sales_invoice->amount}}">
                                            </div>
                                        </div>
                                    </div>

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
                                                <select name="cc_apply" class="default-select form-control wide me-2">
                                                    <option value="">select</option>
                                                    <option value="N" {{$sales_invoice->cc_apply == 'N'? 'selected' : ''}}>N</option>
                                                    <option value="Y" {{$sales_invoice->cc_apply == 'Y'? 'selected' : ''}}>Y</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- GSTIN -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">GSTIN:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="gstin" class="form-control" value="{{$sales_invoice->gstin}}">
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

                                    <!-- IGST -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">IGST:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="igst" class="form-control" value="{{$sales_invoice->igst}}">
                                            </div>
                                        </div>
                                    </div>

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
                                                <select name="caf_apply" class="default-select form-control wide me-2">
                                                    <option value="">select</option>
                                                    <option value="N" {{$sales_invoice->caf_apply == 'N'? 'selected' : ''}}>N</option>
                                                    <option value="Y" {{$sales_invoice->caf_apply == 'Y'? 'selected' : ''}}>Y</option>
                                                </select>
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

                                    <!-- SGST -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">SGST:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="sgst" class="form-control" value="{{$sales_invoice->sgst}}">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Total -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Total:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="total" class="form-control" value="{{$sales_invoice->total}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <button type="submit" class="btn btn-primary btn-sm">ADD/UPDATE CHARGES</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Modal Party Details -->
    <div class="modal fade" id="partyDetailsModal" tabindex="-1" aria-labelledby="oceanVslModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="oceanVslModalLabel">Party</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="oceanVslForm">
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Party Code:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Party Name:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Address Line 1:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Address Line 2:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Address Line 3:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Address Line 4:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">City:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Pincode:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Party Type:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <select class="default-select  form-control wide" placeholder="Select"></select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Contact Person:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Tel / Contact No:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Email:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">GSTIN NO:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">PAN No:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">CIN No:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Credit Days:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">TDS %:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Status:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <select class="default-select  form-control wide" placeholder="Active"></select>
                            </div>
                        </div>
                        <div class="d-grid d-md-flex justify-content-md-end">
                            <button class="btn btn-outline-primary" type="button">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#smartwizard').smartWizard();
        });
    </script>
@endpush
