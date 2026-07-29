@extends('admin-main.layouts.default')
@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Purchase Invoice</a></li>
        </ol>
        <a class="text-primary fs-13" href="{{ url('admin/purchase-invoices') }}"><- Go Back</a>
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
                        <h4 class="card-title">Edit Invoice</h4>
                    </div>
                    <div class="card-body">
                        <div id="smartwizard" class="form-wizard order-create">
                            <div class="row form-material">
                                <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                    <label class="col-sm-3 col-form-label">Activity Type:</label>
                                    <form method="POST" id="searchForm">
                                        @csrf
                                        <div class="mb-6 row">
                                            <div class="d-flex gap-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="AI" name="search_by" {{optional($purchase_invoice)->inv_cat == 'AI'? 'checked' : 'disabled'}}>
                                                    <label class="form-check-label" for="lcl">
                                                        Air Import
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="AE" name="search_by" {{optional($purchase_invoice)->inv_cat == 'AE'? 'checked' : 'disabled'}}>
                                                    <label class="form-check-label" for="fcl20">
                                                        Air Export
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="SI" name="search_by" {{optional($purchase_invoice)->inv_cat == 'SI'? 'checked' : 'disabled'}}>
                                                    <label class="form-check-label" for="fcl40">
                                                        Sea Import
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="SE" name="search_by" {{optional($purchase_invoice)->inv_cat == 'SE'? 'checked' : 'disabled'}}>
                                                    <label class="form-check-label" for="air">
                                                        Sea Export
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="TR" name="search_by" {{optional($purchase_invoice)->inv_cat == 'TR'? 'checked' : 'disabled'}}>
                                                    <label class="form-check-label" for="air">
                                                        Transport
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <hr>
                                <div class="form-validation">
                                    <form method="POST" action="{{route('purchase-invoices.update', $purchase_invoice->id)}}" class="needs-validation">
                                        @csrf
                                        @method('PUT')
                                        {{-- <input type="hidden" name="Inv_cat" /> --}}
                                        <input type="hidden" name="job_no" value="{{$purchase_invoice->job_no}}">
                                        <div class="row">
                                            <!-- Row 1 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Job No: </label>
                                                <input type="text" value="{{$purchase_invoice->operationJob->full_job_no??''}}" readonly class="form-control" name="full_job_no" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Inv No: <span class="text-danger">*</span></label>
                                                <input type="text" name="invoice_no" class="form-control" value="{{$purchase_invoice->invoice_no}}">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Inv Date: <span class="text-danger">*</span></label>
                                                <input type="date" name="invoice_date" class="form-control" value="{{ $purchase_invoice->invoice_date }}">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Inv Due Date:</label>
                                                <input type="date" name="invoice_due_date" class="form-control" value="{{$purchase_invoice->invoice_due_date}}">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Invoice Type:</label>
                                                <select name="invoice_type" class="form-control select2">
                                                    <option value="">Select</option>
                                                    <option value="PURCHASE" {{$purchase_invoice->invoice_type == 'PURCHASE'? 'selected' : ''}}>PURCHASE</option>
                                                    <option value="PURCHASE(OVR.)" {{$purchase_invoice->invoice_type == 'PURCHASE(OVR.)'? 'selected' : ''}}>PURCHASE(OVR.)</option>
                                                    <option value="PURCHASE(CN.RS.)" {{$purchase_invoice->invoice_type == 'PURCHASE(CN.RS.)'? 'selected' : ''}}>PURCHASE(CN.RS.)</option>
                                                    <option value="PURCHASE(CN.OVR.)" {{$purchase_invoice->invoice_type == 'PURCHASE(CN.OVR.)'? 'selected' : ''}}>PURCHASE(CN.OVR.)</option> 
                                                </select>
                                            </div>
                                        
                                            <!-- Row 2 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Voyage Code:</label>
                                                <input type="text" name="voyage_code" class="form-control" value="{{$purchase_invoice->voyage_code}}" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Job Date:</label>
                                                <input type="text" name="job_date" class="form-control" value="{{$purchase_invoice->job_date}}" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">POD:</label>
                                                <input type="text" name="pod" class="form-control" value="{{$purchase_invoice->pod}}" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">POL:</label>
                                                <input type="text" name="pol" class="form-control" value="{{$purchase_invoice->pol}}" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">ETA DATE:</label>
                                                <input type="text" name="eta_date" class="form-control" value="{{$purchase_invoice->eta_date}}" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">ETD DATE:</label>
                                                <input type="text" name="etd_date" class="form-control" value="{{$purchase_invoice->etd_date}}" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Container No:</label>
                                                <input type="text" name="container" class="form-control" value="{{$purchase_invoice->container}}" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Container Qty:</label>
                                                <input type="text" name="container_qty" class="form-control" value="{{$purchase_invoice->container_qty}}">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Shipper Name:</label>
                                                <input type="text" name="shipper_name" class="form-control" value="{{$purchase_invoice->shipper_name}}" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Consignee/Consigner:</label>
                                                <input type="text" name="consignee" class="form-control" value="{{$purchase_invoice->consignee}}" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">CBM:</label>
                                                <input type="text" name="cbm" class="form-control" value="{{$purchase_invoice->cbm}}" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Package Type:</label>
                                                <input type="text" name="pkgType" class="form-control" value="{{$purchase_invoice->pkgType}}" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Packages:</label>
                                                <input type="text" name="packages" class="form-control" value="{{$purchase_invoice->packages}}" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Gross WT:</label>
                                                <input type="text" name="gross_weight" class="form-control" value="{{$purchase_invoice->gross_weight}}" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Chg WT:</label>
                                                <input type="text" name="chargeable_weight" class="form-control" value="{{$purchase_invoice->chargeable_weight}}" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Party Type: </label>
                                                <select name="party_type" class="form-control select2">
                                                    <option value="">Select</option>
                                                    <option value="cha" {{$purchase_invoice->party_type == 'cha'? 'selected' : ''}}>CHA</option>
                                                    <option value="forwarder" {{$purchase_invoice->party_type == 'forwarder'? 'selected' : ''}}>Forwarder</option>
                                                    <option value="transporter" {{$purchase_invoice->party_type == 'transporter'? 'selected' : ''}}>Transporter</option>
                                                    <option value="chaforwarder" {{$purchase_invoice->party_type == 'chaforwarder'? 'selected' : ''}}>CHA & Forwarder</option>
                                                    <option value="others" {{$purchase_invoice->party_type == 'others'? 'selected' : ''}}>Others</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Shipper Inv No:</label>
                                                <input type="text" name="full_invoice_no" class="form-control" value="{{$purchase_invoice->full_invoice_no}}">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Shipping Bill No/Date:</label>
                                                <input type="text" name="shipping_no" class="form-control" value="{{$purchase_invoice->shipping_no}}">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Remarks:</label>
                                                <input type="text" name="remarks" class="form-control" value="{{$purchase_invoice->remarks}}">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Freight Terms:</label>
                                                <input type="text" name="freight_terms" class="form-control" value="{{$purchase_invoice->freight_terms}}" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Bill From: <span class="text-danger">*</span></label>
                                                <select name="billing_party_id" class="form-control select2">
                                                    <option value="">Select</option>
                                                    @foreach ($parties as $party)
                                                        <option value="{{$party->id}}" {{$purchase_invoice->billing_party_id == $party->id? 'selected' : ''}}>{{$party->party_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">GST Type: <span class="text-danger">*</span></label>
                                                <select name="gst_type" class="form-control">
                                                    <option value="">Select</option>
                                                    <option value="local" {{$purchase_invoice->gst_type == 'local'? 'selected' : ''}}>LOCAL</option>
                                                    <option value="outstation" {{$purchase_invoice->gst_type == 'outstation'? 'selected' : ''}}>OUTSTATION</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Account No: </label>
                                                <select name="bank_id" class="form-control select2">
                                                    <option value="">Select</option>
                                                    @foreach ($account_numbers as $account_number)
                                                        <option value="{{$account_number->id}}" {{$purchase_invoice->bank_id == $account_number->id ? 'selected' : ''}} >{{$account_number->account_no}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Sales Person:</label>
                                                <input type="text" name="sales_person" class="form-control" value="{{ $purchase_invoice->sales_person }}" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Vessel Name/Air Line:</label>
                                                <input type="text" name="vessel_name" class="form-control" value="{{ old('vessel_name', $purchase_invoice->vessel_name ?? '') }}">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">AWB / BL NO: <span class="text-danger">*</span></label>
                                                <input type="text" name="awb_bl_no" class="form-control" value="{{ old('awb_bl_no', $purchase_invoice->awb_bl_no ?? '') }}">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">MAWB NO:</label>
                                                <input type="text" name="mawb_no" class="form-control" value="{{ $purchase_invoice->mawb_no }}" style="background: #eee;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">HAWB NO:</label>
                                                <input type="text" name="hawb_no" class="form-control" value="{{ $purchase_invoice->hawb_no }}" style="background: #eee;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">HBL NO:</label>
                                                <input type="text" name="hbl_no" class="form-control" value="{{ $purchase_invoice->hbl_no }}" style="background: #eee;">
                                            </div>
                                            <!--<div class="col-md-4 mb-3">-->
                                            <!--    <label class="form-label">SB/BOE Date:</label>-->
                                            <!--    <input type="date" name="shipping_bill_date" value="{{$purchase_invoice->shipping_bill_date}}" class="form-control">-->
                                            <!--</div>-->
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Sale / Purchase:</label>
                                                <input type="text" name="sale_purchase" class="form-control" value="{{ old('sale_purchase', $purchase_invoice->sale_purchase ?? '') }}">
                                            </div>
                                        </div>
                                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                            <!--<button type="button" class="btn btn-danger btn-sm">Add Charges From Performa</button>-->
                                            <button type="button" class="btn btn-warning btn-sm">Cancel</button>
                                            <a href="{{ route('ImportPurchaseInvoice.import', $purchase_invoice->id) }}" type="button" class="btn btn-success btn-sm">Print</a>
                                            <button type="submit" class="btn btn-primary btn-sm">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>                           
                        </div>

                        
                        <h4>Charges</h4>
                        <hr>
                        <div class="form-validation">
                            <form class="needs-validation" method="POST" action="{{ route('purchase-invoices.UpdatePurchaseInvoiceCharge', $purchase_invoice->id) }}">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="" id="gst_type" value="{{$purchase_invoice->gst_type}}">
                                <input type="hidden" name="charge_edit_id" id="charge_edit_id">
                                <div class="row">
                                    <!-- Charge Name -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Charge_Name:<span class="text-danger">*</span></label>
                                            <div class="col-sm-9 d-flex align-items-center gap-2">
                                                <select name="charge_id" id="charge_name" class="form-control wide me-2 select2">
                                                    <option value="">select</option>
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
                                                    <option value="AED">AED</option>
                                                    <option value="AUD">AUD</option>
                                                    <option value="BGN">BGN</option>
                                                    <option value="BRL">BRL</option>
                                                    <option value="CAD">CAD</option>
                                                    <option value="CHF">CHF</option>
                                                    <option value="CNY">CNY</option>
                                                    <option value="CSD">CSD</option>
                                                    <option value="CZK">CZK</option>
                                                    <option value="DKK">DKK</option>
                                                    <option value="EEK">EEK</option>
                                                    <option value="EGP">EGP</option>
                                                    <option value="EUR">EUR</option>
                                                    <option value="GBP">GBP</option>
                                                    <option value="HKD">HKD</option>
                                                    <option value="HRK">HRK</option>
                                                    <option value="HUF">HUF</option>
                                                    <option value="IDR">IDR</option>
                                                    <option value="ILS">ILS</option>
                                                    <option value="INR" selected>INR</option>
                                                    <option value="ISK">ISK</option>
                                                    <option value="JPY">JPY</option>
                                                    <option value="MXP">MXP</option>
                                                    <option value="MYR">MYR</option>
                                                    <option value="NOK">NOK</option>
                                                    <option value="NZD">NZD</option>
                                                    <option value="PHP">PHP</option>
                                                    <option value="PLN">PLN</option>
                                                    <option value="ROL">ROL</option>
                                                    <option value="RUR">RUR</option>
                                                    <option value="SAR">SAR</option>
                                                    <option value="SEK">SEK</option>
                                                    <option value="SGD">SGD</option>
                                                    <option value="SIT">SIT</option>

                                                    <option value="SKK">SKK</option>
                                                    <option value="THB">THB</option>
                                                    <option value="TRL">TRL</option>
                                                    <option value="TWD">TWD</option>
                                                    <option value="UAH">UAH</option>
                                                    <option value="US">US</option>
                                                    <option value="USD"}>USD</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Rate Basis -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Rate_Basis:</label>
                                            <div class="col-sm-9">
                                                <select name="rate_basis" id="rate_basis" class=" form-control wide me-2">
                                                    <option value="">select</option>
                                                    <option value="LUMPSUM" {{$purchase_invoice->rate_basis == 'LUMPSUM'? 'selected' : ''}}>LUMPSUM</option>
                                                    <option value="PERAIRWAYBILL" {{$purchase_invoice->rate_basis == 'PERAIRWAYBILL'? 'selected' : ''}}>PER AIRWAY BILL</option>
                                                    <option value="PERBL" {{$purchase_invoice->rate_basis == 'PERBL'? 'selected' : ''}}>PER BL</option>
                                                    <option value="CBMWISE" {{$purchase_invoice->rate_basis == 'CBMWISE'? 'selected' : ''}}>CBMWISE</option>
                                                    <option value="PERCONT" {{$purchase_invoice->rate_basis == 'PERCONT'? 'selected' : ''}}>PER CONTAINER</option>
                                                    <option value="GWTWISE" {{$purchase_invoice->rate_basis == 'GWTWISE'? 'selected' : ''}}>GWTWISE</option>
                                                    <option value="CHGWTWISE" {{$purchase_invoice->rate_basis == 'CHGWTWISE'? 'selected' : ''}}>CHGWTWISE</option>
                                                    <option value="RECEIPTED" {{$purchase_invoice->rate_basis == 'RECEIPTED'? 'selected' : ''}}>RECEIPTED</option>
                                                    <option value="PERKG" {{$purchase_invoice->rate_basis == 'PERKG'? 'selected' : 'selected'}}>PER KG</option>
                                                    <option value="PERCBM" {{$purchase_invoice->rate_basis == 'PERCBM'? 'selected' : 'selected'}}>PER CBM</option>
                                                    <option value="PERINVOICE" {{$purchase_invoice->rate_basis == 'PERINVOICE'? 'selected' : 'selected'}}>PER INVOICE</option>
                                                    <option value="PERSET" {{$purchase_invoice->rate_basis == 'PERSET'? 'selected' : 'selected'}}>PER SET</option>
                                                    <option value="PERPACKAGE" {{$purchase_invoice->rate_basis == 'PERPACKAGE'? 'selected' : 'selected'}}>PER PACKAGE</option>
                                                    <option value="PERUNIT" {{$purchase_invoice->rate_basis == 'PERUNIT'? 'selected' : 'selected'}}>PER UNIT</option>
                                                    <option value="PERDAY" {{$purchase_invoice->rate_basis == 'PERDAY'? 'selected' : 'selected'}}>PER DAY</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Exchange Rate -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Exch.Rate:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="exchange_rate" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Per Unit -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Per Unit:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="per_unit" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Total Unit -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Total Unit:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="total_unit" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Freight change to total charges -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Total Taxable Charges:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="freight" class="form-control" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- GST -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Input GST%:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="gst" class="form-control" value="{{$purchase_invoice->gst}}">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- GST Applicable -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">GST(Y/N):</label>
                                            <div class="col-sm-9">
                                                <select name="gst_applicable" class="form-control wide me-2">
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
                                            <label class="col-sm-3 col-form-label">IGST ₹:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="igst" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- SGST -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">SGST ₹:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="sgst" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- CGST -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">CGST ₹:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="cgst" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Amount -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Amount:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="amount" id="amount" class="form-control">
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
                                                <input type="text" name="sac_code" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- GSTIN -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">GSTIN:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="gstin" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Remarks -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Remarks:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="remarks" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    

                                    <!-- Prepaid/Collect -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Prep/Coll:</label>
                                            <div class="col-sm-9">
                                                <select name="prepaid_coll" class="form-control wide me-2">
                                                    <option value="">select</option>
                                                    <option value="C" {{$purchase_invoice->prepaid_coll == 'C'? 'selected' : ''}}>C</option>
                                                    <option value="P" {{$purchase_invoice->prepaid_coll == 'P'? 'selected' : ''}}>P</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    

                                    <!-- Rate -->
                                    <!--<div class="col-xl-6">-->
                                    <!--    <div class="mb-3 row">-->
                                    <!--        <label class="col-sm-3 col-form-label">Rate:</label>-->
                                    <!--        <div class="col-sm-9">-->
                                    <!--            <input type="text" name="rate_per_unit" class="form-control" value="{{$purchase_invoice->rate_per_unit}}">-->
                                    <!--        </div>-->
                                    <!--    </div>-->
                                    <!--</div>-->

                                    

                                    <!-- CAF % -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">CAF %:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="caf_percent" class="form-control" value="{{$purchase_invoice->caf_percent}}">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- BAF % -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">BAF %:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="baf_percent" class="form-control" value="{{$purchase_invoice->baf_percent}}">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- CC % -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">CC %:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="cc_percent" class="form-control" value="{{$purchase_invoice->cc_percent}}">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- CC Apply -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">CC Apply:</label>
                                            <div class="col-sm-9">
                                                <select name="cc_apply" class="form-control wide me-2">
                                                    <option value="">select</option>
                                                    <option value="N" {{$purchase_invoice->cc_apply == 'N'? 'selected' : ''}}>N</option>
                                                    <option value="Y" {{$purchase_invoice->cc_apply == 'Y'? 'selected' : ''}}>Y</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- CAF Amount -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">CAF. Amt:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="caf_amount" class="form-control" value="{{$purchase_invoice->caf_amount}}">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- BAF Amount -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">BAF. Amt:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="baf_amount" class="form-control" value="{{$purchase_invoice->baf_amount}}">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- CC Amount -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">CC. Amt:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="cc_amount" class="form-control" value="{{$purchase_invoice->cc_amount}}">
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
                                                    <option value="N" {{$purchase_invoice->caf_apply == 'N'? 'selected' : ''}}>N</option>
                                                    <option value="Y" {{$purchase_invoice->caf_apply == 'Y'? 'selected' : ''}}>Y</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Total -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Total:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="total" id="total" class="form-control" value="{{$purchase_invoice->total}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <button type="submit" id="saveBtn" class="btn btn-primary btn-sm">ADD/UPDATE CHARGES</button>
                                </div>
                            </form>
                        </div>


                        <h4>File Upload</h4>
                        <hr>
                        <div class="form-validation">
                            <form class="ajaxFileUpload" action="{{route('file-upload.updateFileUpload')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                
                                <input type="hidden" name="file_related" value="purchase_invoice">
                                <input type="hidden" name="purchase_invoice_id" class="" value="{{ $purchase_invoice->id }}">
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
                                  <th scope="col">Currency</th>
                                  <th scope="col">Amount</th>
                                  <th scope="col">GST(Y/N)</th>
                                  <th scope="col">SGST</th>
                                  <th scope="col">CGST</th>
                                  <th scope="col">IGST</th>
                                  <th scope="col">TOTAL</th>
                                  <th scope="col">EDIT</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($chargeDetails as $chargeDetail)
                                    <tr>
                                      <th scope="row">{{ $chargeDetail->id }}</th>
                                      <td>{{ $chargeDetail?->purchaseInvoice?->operationJob->job_no??'' }}</td>
                                      <td>{{ $chargeDetail?->purchaseInvoice?->invoice_no }}</td>
                                      <td>{{ $chargeDetail?->chargeName?->charge_name }}</td>
                                      
                                      <td>{{ $chargeDetail?->currency }}</td>
                                      <td>{{ $chargeDetail?->amount }}</td>
                                      <td>{{ $chargeDetail?->gst_applicable }}</td>
                                      <td>{{ $chargeDetail?->sgst }}</td>
                                      <td>{{ $chargeDetail?->cgst }}</td>
                                      <td>{{ $chargeDetail?->igst }}</td>
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
        $(document).ready(function() {

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
        $(document).ready(function() {
            $('.select2').select2({
                width: '100%'
            })
            
            $('#smartwizard').smartWizard();
        });
        
    </script>
    <script>
        //mourya
        $(document).ready(function(){
    
            // === MAIN FUNCTION ===
            function calculateTotals() {
                let gstType = $('select[name="gst_type"]').val(); // local / otherState
                let perUnit = parseFloat($('input[name="per_unit"]').val()) || 0;
                let totalUnit = parseFloat($('input[name="total_unit"]').val()) || 0;
                let exchRate = parseFloat($('input[name="exchange_rate"]').val()) || 0;
                let gstPercent = parseFloat($('input[name="gst"]').val()) || 0;
                let gstApplicable = $('select[name="gst_applicable"]').val(); // Y or N
                let tdsPercent = parseFloat($('#tds').val()) || 0;
            
                // ================================
                //  BASE FREIGHT
                // ================================
                let baseAmount = perUnit * totalUnit * exchRate;
                $('input[name="freight"]').val(baseAmount.toFixed(2))
                    .css('background', '#ded9d9').prop('readonly', true);
            
                // ================================
                //  GST CALCULATION ON BASE
                // ================================
                let cgst = 0, sgst = 0, igst = 0;
            
                if (gstApplicable === 'Y') {
                    if (gstType === 'local') {
                        cgst = (gstPercent / 2) * baseAmount / 100;
                        sgst = (gstPercent / 2) * baseAmount / 100;
                    } else {
                        igst = (gstPercent * baseAmount) / 100;
                    }
                }
            
                $('input[name="cgst"]').val(cgst.toFixed(2)).css('background', '#ded9d9').prop('readonly', true);
                $('input[name="sgst"]').val(sgst.toFixed(2)).css('background', '#ded9d9').prop('readonly', true);
                $('input[name="igst"]').val(igst.toFixed(2)).css('background', '#ded9d9').prop('readonly', true);
            
                let gstTotal = cgst + sgst + igst;
            
                // ================================
                //  TOTAL BEFORE TDS
                // ================================
                let totalBeforeTds = baseAmount + gstTotal;
                $('input[name="amount"]').val(totalBeforeTds.toFixed(2))
                    .css('background', '#ded9d9').prop('readonly', true);
            
                // ================================
                //  TDS CALCULATION (on BASE ONLY)
                // ================================
                let tdsAmount = 0;
            
                if (tdsPercent > 0) {
                    tdsAmount = (baseAmount * tdsPercent) / 100;
                    $('#tds_amount').val(tdsAmount.toFixed(2))
                        .css('background', '#ded9d9').prop('readonly', true);
                } else {
                    $('#tds_amount').val('');
                }
            
                // ================================
                //  FINAL TOTAL = TOTAL BEFORE TDS - TDS AMOUNT
                // ================================
                let finalTotal = totalBeforeTds - tdsAmount;
                finalTotal = finalTotal;
                
                $('input[name="total"]').val(finalTotal.toFixed(2))
                    .css('background', '#ded9d9').prop('readonly', true);
            }
        
            // Trigger recalculation when inputs change
            $('#tds, #charge_name, select[name="gst_type"], input[name="per_unit"], input[name="total_unit"], input[name="exchange_rate"], select[name="gst_applicable"]').on('change keyup', function () {
                calculateTotals();
            });
        
            // === CHARGE NAME AJAX ===
            $('#charge_name').on('change', function (e) {
                e.preventDefault();
                let selectedValue = $(this).val();
        
                $.ajax({
                    url: '{{ route("sales-invoices.getCharge") }}',
                    type: 'post',
                    data: { 'id': selectedValue },
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    success: function (res) {
                        if (res.status) {
                            if (res.data.gst_percentage) {
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
                    error: function (xhr) {
                        console.log('Error:', xhr.responseText);
                    }
                });
            });
        
        });
    </script>

    <script>
        $(document).on('click', '.editChargeBtn', function() {
            const chargeId = $(this).data('id');
        
            // Fetch charge detail using AJAX
            $.ajax({
                url: "{{ route('purchase-invoices.getChargeDetail', '') }}/" + chargeId,
                method: "GET",
                success: function(response) {
                    console.log('response', response);
                    
                    // Fill form fields
                    $('#charge_edit_id').val(response.id);
                    $('#charge_name').val(response.charge_id).trigger('change');
                    $('select[name="currency"]').val(response.currency);
                    $('#rate_basis').val(response.rate_basis).trigger('change');
                    $('input[name="per_unit"]').val(response.per_unit);
                    $('input[name="exchange_rate"]').val(response.exchange_rate);
                    $('input[name="total_unit"]').val(response.total_unit);
                    // $('input[name="freight"]').val(response.freight);
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
                url: "{{ route('purchase-invoices.deleteChargeDetail', '') }}/" + chargeId,
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
