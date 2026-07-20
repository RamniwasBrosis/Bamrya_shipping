@extends('admin-main.layouts.default')
@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Proforma Invoice</a></li>
        </ol>
        <a class="text-primary fs-13" href="{{ url('admin/proforma-invoices') }}"><- Go Back</a>
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
                                                    <input class="form-check-input" type="radio" value="AI" name="search_by" {{optional($proforma_invoice)->inv_cat == 'AI'? 'checked' : 'disabled'}}>
                                                    <label class="form-check-label" for="lcl">
                                                        Air Import
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="AE" name="search_by" {{optional($proforma_invoice)->inv_cat == 'AE'? 'checked' : 'disabled'}}>
                                                    <label class="form-check-label" for="fcl20">
                                                        Air Export
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="SI" name="search_by" {{optional($proforma_invoice)->inv_cat == 'SI'? 'checked' : 'disabled'}}>
                                                    <label class="form-check-label" for="fcl40">
                                                        Sea Import
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="SE" name="search_by" {{optional($proforma_invoice)->inv_cat == 'SE'? 'checked' : 'disabled'}}>
                                                    <label class="form-check-label" for="air">
                                                        Sea Export
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="TR" name="search_by" {{optional($proforma_invoice)->inv_cat == 'TR'? 'checked' : 'disabled'}}>
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
                                    <form method="POST" action="{{route('proforma-invoices.update', $proforma_invoice->id)}}" class="needs-validation">
                                        @csrf
                                        @method('PUT')
                                        {{-- <input type="hidden" name="Inv_cat" /> --}}
                                        <input type="hidden" name="job_no" id="job_no" value="{{$proforma_invoice->job_no}}">
                                        <div class="row">
                                            <!-- Row 1 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Job No: <span class="text-danger">*</span></label>
                                                <input type="text" value="{{$proforma_invoice->full_job_no}}" readonly class="form-control" name="full_job_no" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Invoice No:</label>
                                                <input type="text" name="invoice_no" class="form-control" value="{{$proforma_invoice->invoice_no}}">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Inv Date:</label>
                                                <input type="date" name="invoice_date" class="form-control" value="{{ date('Y-m-d'), $proforma_invoice->invoice_date }}">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">GST Type:</label>
                                                <select name="gst_type" class="form-control select2">
                                                    <option value="">Select</option>
                                                    <option value="local" {{$proforma_invoice->gst_type == 'local'? 'selected' : ''}}>LOCAL</option>
                                                    <option value="outstation" {{$proforma_invoice->gst_type == 'outstation'? 'selected' : ''}}>OUTSTATION</option>
                                                </select>
                                            </div>
                                            
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Voyage Code:</label>
                                                <input type="text" name="voyage_date" class="form-control" value="{{$proforma_invoice->voyage_date}}" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">POD:</label>
                                                <input type="text" name="pod" class="form-control" value="{{$proforma_invoice->pod}}" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">POL:</label>
                                                <input type="text" name="pol" class="form-control" value="{{$proforma_invoice->pol}}" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                          
                                            <!-- Row 2 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Container:</label>
                                                <input type="text" name="container" class="form-control" value="{{$proforma_invoice->container}}" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Consignee / Consigner:</label>
                                                <input type="text" name="consignee" class="form-control" value="{{$proforma_invoice->consignee}}" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">CBM:</label>
                                                <input type="text" name="cbm" class="form-control" value="{{$proforma_invoice->cbm}}" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Package Type:</label>
                                                <input type="text" name="pkgType" value="{{$proforma_invoice->pkgType}}" class="form-control" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Packages:</label>
                                                <input type="text" name="packages" value="{{$proforma_invoice->packages}}" class="form-control" style="background: #eee; cursor: not-allowed;">
                                            </div>

                                            <!-- Row 3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Gross WT:</label>
                                                <input type="text" name="gross_weight" class="form-control" value="{{$proforma_invoice->gross_weight}}" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Chg WT:</label>
                                                <input type="text" name="chargeable_weight" class="form-control" value="{{$proforma_invoice->chargeable_weight}}" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Vessel / Air Line:</label>
                                                <input type="text" name="vessel_name" class="form-control" value="{{ $proforma_invoice->vessel_name }}" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">SBill No/Dt:</label>
                                                <input type="text" name="shipping_no" class="form-control" value="{{ $proforma_invoice->shipping_no }}" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">BOE Date:</label>
                                                <input type="text" name="boe_date" class="form-control" value="{{ $proforma_invoice->boe_date }}" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">AWB / BL NO:</label>
                                                <input type="text" name="awb_bl_no" class="form-control" value="{{ $proforma_invoice->awb_bl_no }}" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            
                                            
                                            
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Party Type:</label>
                                                <select name="party_type" class="form-control select2">
                                                    <option value="">Select</option>
                                                    <option value="customer" {{$proforma_invoice->party_type == 'customer'? 'selected' : ''}}>Customer</option>
                                                    <option value="other" {{$proforma_invoice->party_type == 'other'? 'selected' : ''}}>Other Billing Party</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Invoice Type:</label>
                                                <select name="invoice_type" class="form-control select2">
                                                    <option value="">Select</option>
                                                    <option value="PRO-FORMA INVOICE" selected >PRO-FORMA INVOICE</option>
                                                    <!--<option value="DEBITNOTE(Rs)" {{$proforma_invoice->invoice_type == 'DEBITNOTE(Rs)'? 'selected' : ''}}>DEBITNOTE(Rs)</option>-->
                                                    <!--<option value="CREDITNOTE(Rs)" {{$proforma_invoice->invoice_type == 'CREDITNOTE(Rs)'? 'selected' : ''}}>CREDITNOTE(Rs)</option>-->
                                                    <!--<option value="DEBITNOTE(Ovr.)" {{$proforma_invoice->invoice_type == 'DEBITNOTE(Ovr.)'? 'selected' : ''}}>DEBITNOTE(Ovr.)</option>-->
                                                    <!--<option value="CREDITNOTE(Ovr.)" {{$proforma_invoice->invoice_type == 'CREDITNOTE(Ovr.)'? 'selected' : ''}}>CREDITNOTE(Ovr.)</option>-->
                                                   
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Account No:</label>
                                                <select name="bank_id" class="form-control select2">
                                                    <option value="">Select</option>
                                                    @foreach ($account_numbers as $account_number)
                                                        <option value="{{$account_number->id}}" {{$proforma_invoice->bank_id == $account_number->id? 'selected' :''}}>{{$account_number->account_no}}</option>
                                                    @endforeach
                                                </select>
                                            </div> 
                                            
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Billing Party:</label>
                                                <select name="billing_party_id" class="form-control select2">
                                                    <option value="">Select</option>
                                                    @foreach ($parties as $party)
                                                        <option value="{{$party->id}}" {{$proforma_invoice->billing_party_id == $party->id? 'selected' : ''}}>{{$party->party_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                           
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Sale / Purchase:</label>
                                                <input type="text" name="sale_purchase" class="form-control" value="{{ $proforma_invoice->sale_purchase }}">
                                            </div>
                                        
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Sales Person:<span class="text-danger">*</span></label>
                                                <select name="sales_person_id" class="form-control select2" required>
                                                    <option value="">Select</option>
                                                    @foreach ($salesPerson as $salePerson)
                                                        <option value="{{$salePerson->id}}" {{ $proforma_invoice->sales_person_id == $salePerson->id ? 'selected' : '' }}>{{$salePerson->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                            <!--<button type="button" class="btn btn-danger btn-sm">Add Charges From Performa</button>-->
                                            <button type="button" class="btn btn-warning btn-sm">Cancel</button>
                                            <a href="{{ route('ImportProformaInvoice.import', $proforma_invoice->id) }}" type="button" class="btn btn-success btn-sm">Print</a>
                                            <button type="submit" class="btn btn-primary btn-sm">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>                            
                        </div>

                        
                        <h4>Charges</h4>
                        <hr>
                        <div class="form-validation">
                            <form class="needs-validation" id="" method="POST" action="{{ route('proforma-invoices.UpdateProformaInvoiceCharge', $proforma_invoice->id) }}">
                            @csrf
                            @method('PUT')
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
                                                <option value="US" >US</option>
                                                <option value="USD">USD</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                        
                                <!-- Rate Basis -->
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Rate_Basis:</label>
                                        <div class="col-sm-9">
                                            <select name="rate_basis" class="select2 form-control wide me-2">
                                                <option value="">select</option>
                                                <option value="LUMPSUM">LUMPSUM</option>
                                                <option value="CBMWISE">CBMWISE</option>
                                                <option value="PERCONT">PER CONTAINER</option>
                                                <option value="GWTWISE">GWTWISE</option>
                                                <option value="CHGWTWISE">CHGWTWISE</option>
                                                <option value="PERKG">PER KG</option>
                                                <option value="PERCBM">PER CBM</option>
                                                <option value="PERINVOICE">PER INVOICE</option>
                                                <option value="PERUNIT" selected>PER UNIT</option>
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
                                        <!--Per Unit changed to total unit--> 
                                        <label class="col-sm-3 col-form-label">Per Unit:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="per_unit" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <!--Per Unit changed to total unit--> 
                                        <label class="col-sm-3 col-form-label">Total Unit:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="total_unit" class="form-control" value="">
                                        </div>
                                    </div>
                                </div>
                        
                                <!-- Freight -->
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Total Taxable Charges:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="freight" id="gst" class="form-control">
                                        </div>
                                    </div>
                                </div>
                        
                                <!-- GST -->
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">GST:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="gst" id="gst" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <!-- GST Applicable -->
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">GST(Y/N):</label>
                                        <div class="col-sm-9">
                                            <select name="gst_applicable" class="select2 form-control wide me-2">
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
                                            <input type="text" name="igst" id="igst" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <!-- SGST -->
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">SGST:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="sgst" id="sgst" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <!-- CGST -->
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">CGST:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="cgst" id="cgst" class="form-control">
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
                        
                                <!-- Prepaid/Collect -->
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Prep/Coll:</label>
                                        <div class="col-sm-9">
                                            <select name="prepaid_coll" class="select2 form-control wide me-2">
                                                <option value="">select</option>
                                                <option value="C">C</option>
                                                <option value="P">P</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                        
                                
                        
                                <!-- Rate -->
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Rate:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="rate_per_unit" class="form-control">
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
                        
                                <!-- CAF % -->
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">CAF %:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="caf_percent" class="form-control">
                                        </div>
                                    </div>
                                </div>
                        
                                <!-- BAF % -->
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">BAF %:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="baf_percent" class="form-control">
                                        </div>
                                    </div>
                                </div>
                        
                                <!-- CC % -->
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">CC %:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="cc_percent" class="form-control">
                                        </div>
                                    </div>
                                </div>
                        
                                <!-- CC Apply -->
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">CC Apply:</label>
                                        <div class="col-sm-9">
                                            <select name="cc_apply" class="select2 form-control wide me-2">
                                                <option value="">select</option>
                                                <option value="N">N</option>
                                                <option value="Y">Y</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                        
                                <!-- CAF Amount -->
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">CAF. Amt:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="caf_amount" class="form-control">
                                        </div>
                                    </div>
                                </div>
                        
                                <!-- BAF Amount -->
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">BAF. Amt:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="baf_amount" class="form-control">
                                        </div>
                                    </div>
                                </div>
                        
                                <!-- CC Amount -->
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">CC. Amt:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="cc_amount" class="form-control">
                                        </div>
                                    </div>
                                </div>
                        
                                <!-- CAF Apply -->
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">CAF_Apply:</label>
                                        <div class="col-sm-9">
                                            <select name="caf_apply" class="select2 form-control wide me-2">
                                                <option value="">select</option>
                                                <option value="N">N</option>
                                                <option value="Y">Y</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                        
                                <!-- Total -->
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Total:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="total" id="total" class="form-control">
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
                                
                                <input type="hidden" name="file_related" value="proforma_invoice">
                                <input type="hidden" name="proforma_invoice_id" class="" value="{{ $proforma_invoice->id }}">
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
                                      <th scope="col">DELETE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($chargeDetails as $chargeDetail)
                                        <tr>
                                          <th scope="row">{{ $chargeDetail->id }}</th>
                                          <td>{{ $chargeDetail?->purchaseInvoice?->full_job_no }}</td>
                                          <td>{{ $chargeDetail?->purchaseInvoice?->invoice_no }}</td>
                                          <td>{{ $chargeDetail?->charge?->charge_name }}</td>

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
    </div>

    <!-- Charge Name Details -->
@include('admin-main.admin.commonModelForms.charge_name_model')

@endsection
@push('scripts')
<script>
        //store the files
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
            $(document).on('click', '.editChargeBtn', function() {
                const chargeId = $(this).data('id');
            
                // Fetch charge detail using AJAX
                $.ajax({
                    url: "{{ route('proforma-invoices.getChargeDetail', '') }}/" + chargeId,
                    method: "GET",
                    success: function(response) {
                        
                        // Fill form fields
                        $('#charge_edit_id').val(response.id);
                        $('#charge_name').val(response.charge_id).trigger('change');
                        $('select[name="currency"]').val(response.currency);
                        $('#rate_basis').val(response.rate_basis).trigger('change');
                        $('input[name="per_unit"]').val(response.per_unit);
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
                    url: "{{ route('proforma-invoices.deleteChargeDetail', '') }}/" + chargeId,
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
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                'width' : '100%'
            })
            $('#smartwizard').smartWizard();
        });
    </script>
    <script>
        //charge form model
        $(document).ready(function () {

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
        
        
        //mourya
        $(document).ready(function(){
    
            // --- Calculate TDS amount separately (optional trigger) ---
            function calculateTds() {
                let tdsPercent = parseFloat($('#tds').val()) || 0;
                let freight = parseFloat($('input[name="freight"]').val()) || 0;
            
                let tdsAmount = (freight * tdsPercent) / 100;
                $('#tds_amount').val(tdsAmount.toFixed(2))
                    .css('background', '#ded9d9')
                    .prop('readonly', true);
            
                // Freight after TDS
                let freightAfterTds = freight - tdsAmount;
            
                // Recalculate GST
                let gstType = $('select[name="gst_type"]').val();
                let gstPercent = parseFloat($('input[name="gst"]').val()) || 0;
                let cgst = 0, sgst = 0, igst = 0;
            
                if (gstPercent > 0) {
                    if (gstType === 'local') {
                        cgst = (gstPercent / 2) * freightAfterTds / 100;
                        sgst = (gstPercent / 2) * freightAfterTds / 100;
                    } else {
                        igst = (gstPercent * freightAfterTds) / 100;
                    }
                }
            
                $('input[name="cgst"]').val(cgst.toFixed(2))
                    .css('background', '#ded9d9')
                    .prop('readonly', true);
                $('input[name="sgst"]').val(sgst.toFixed(2))
                    .css('background', '#ded9d9')
                    .prop('readonly', true);
                $('input[name="igst"]').val(igst.toFixed(2))
                    .css('background', '#ded9d9')
                    .prop('readonly', true);
            
                let finalTotal = freightAfterTds + cgst + sgst + igst;
                let roundedTotal = Math.round(finalTotal);
                $('input[name="total"]').val(roundedTotal.toFixed(2))
                    .css('background', '#ded9d9')
                    .prop('readonly', true);
            
                $('input[name="amount"]').val(finalTotal.toFixed(2))
                    .css('background', '#ded9d9')
                    .prop('readonly', true);
            }
            
            // Trigger TDS recalculation on blur
            $('#tds').on('blur', function () {
                calculateTotals();
            });
            
            
            // --- When charge_name changes ---
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
            
            
            // --- Recalculate whenever relevant fields change ---
            $('select[name="gst_type"], input[name="per_unit"], input[name="total_unit"], input[name="exchange_rate"], select[name="gst_applicable"], input[name="tds"], input[name="gst"]').on('change keyup', function () {
                calculateTotals();
            });
            
            
            // === MAIN CALCULATION FUNCTION ===
            function calculateTotals() {
                let gstType = $('select[name="gst_type"]').val(); // local / otherState
                let perUnit = parseFloat($('input[name="per_unit"]').val()) || 0;
                let totalUnit = parseFloat($('input[name="total_unit"]').val()) || 0;
                let exchRate = parseFloat($('input[name="exchange_rate"]').val()) || 0;
                let gstPercent = parseFloat($('input[name="gst"]').val()) || 0;
                let gstApplicable = $('select[name="gst_applicable"]').val(); // Y or N
                let tdsPercent = parseFloat($('#tds').val()) || 0;
        
                // --- Step 1: Base Amount ---
                let baseAmount = perUnit * totalUnit * exchRate;
                $('input[name="freight"]').val(baseAmount.toFixed(2))
                    .css('background', '#ded9d9')
                    .prop('readonly', true);
        
                // --- Step 2: GST Calculation (on base) ---
                let cgst = 0, sgst = 0, igst = 0;
                if (gstApplicable === 'Y') {
                    if (gstType === 'local') {
                        cgst = (gstPercent / 2) * baseAmount / 100;
                        sgst = (gstPercent / 2) * baseAmount / 100;
                    } else {
                        igst = (gstPercent * baseAmount) / 100;
                    }
                }
        
                $('input[name="cgst"]').val(cgst.toFixed(2))
                    .css('background', '#ded9d9')
                    .prop('readonly', true);
                $('input[name="sgst"]').val(sgst.toFixed(2))
                    .css('background', '#ded9d9')
                    .prop('readonly', true);
                $('input[name="igst"]').val(igst.toFixed(2))
                    .css('background', '#ded9d9')
                    .prop('readonly', true);
        
                // --- Step 3: TDS Calculation (on base only) ---
                let tdsAmount = 0;
                if (tdsPercent > 0) {
                    tdsAmount = (baseAmount * tdsPercent) / 100;
                }
                $('#tds_amount').val(tdsAmount.toFixed(2))
                    .css('background', '#ded9d9')
                    .prop('readonly', true);
        
                // --- Step 4: Final Total = (Base + GST) - TDS ---
                let finalTotal = baseAmount + cgst + sgst + igst - tdsAmount;
                let amountWithGst = baseAmount + cgst + sgst + igst ;
                
                $('input[name="amount"]').val(amountWithGst.toFixed(2))
                    .css('background', '#ded9d9')
                    .prop('readonly', true);
                    
                let roundedTotal = Math.round(finalTotal);    
        
                $('input[name="total"]').val(roundedTotal.toFixed(2))
                    .css('background', '#ded9d9')
                    .prop('readonly', true);
            }

        });
    </script>
    <script>
        // $('#charge_name').on('change', function () {
        //     const chargeId = $(this).val();
        //     const invoiceId = "{{ $proforma_invoice->id }}"; // current invoice id
        
        //     if (!chargeId) {
        //         $('form input, form select').not('#charge_name').val('');
        //         return;
        //     }
        
        //     $.ajax({
        //         url: `/proforma-invoices/get-charge-details/${chargeId}/${invoiceId}`,
        //         type: 'GET',
        //         success: function (res) {
        //             if (res.status) {
        //                 const container = res.data.container || {};
        //                 const master = res.data.master || {};
        
        //                 //  Fill form fields
        //                 $('[name="currency"]').val(container.currency || master.currency || '');
        //                 $('[name="rate_basis"]').val(container.rate_basis || master.rate_basis || '');
        //                 $('[name="per_unit"]').val(container.per_unit || '');
        //                 $('[name="total_unit"]').val(container.total_unit || '');
        //                 $('[name="exchange_rate"]').val(container.exchange_rate || '');
        //                 $('[name="freight"]').val(container.freight || '');
        //                 $('[name="remarks"]').val(container.remarks || master.remarks || '');
        //                 $('[name="gst"]').val(container.gst || '');
        //                 $('[name="prepaid_coll"]').val(container.prepaid_coll || '');
        //                 $('[name="gst_applicable"]').val(container.gst_applicable || '');
        //                 $('[name="rate_per_unit"]').val(container.rate_per_unit || '');
        //                 $('[name="amount"]').val(container.amount || '');
        //                 $('[name="caf_percent"]').val(container.caf_percent || '');
        //                 $('[name="baf_percent"]').val(container.baf_percent || '');
        //                 $('[name="cc_percent"]').val(container.cc_percent || '');
        //                 $('[name="cc_apply"]').val(container.cc_apply || '');
        //                 $('[name="cgst"]').val(container.cgst || '');
        //                 $('[name="igst"]').val(container.igst || '');
        //                 $('[name="caf_amount"]').val(container.caf_amount || '');
        //                 $('[name="baf_amount"]').val(container.baf_amount || '');
        //                 $('[name="cc_amount"]').val(container.cc_amount || '');
        //                 $('[name="caf_apply"]').val(container.caf_apply || '');
        //                 $('[name="sac_code"]').val(container.sac_code || '');
        //                 $('[name="sgst"]').val(container.sgst || '');
        //                 $('[name="total"]').val(container.total || '');
        
        //                 // ✅ Auto-select currency if exists
        //                 const currency = container.currency || master.currency;
        //                 if (currency) {
        //                     $('[name="currency"]').val(currency);
        //                 }
        //             } else {
        //                 alert(res.message);
        //             }
        //         },
        //         error: function (xhr) {
        //             console.error(xhr.responseText);
        //         }
        //     });
        // });
    </script>
@endpush
