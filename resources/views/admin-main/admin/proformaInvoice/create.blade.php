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
                        <h4 class="card-title">Add New Invoice</h4>
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
                                                    <input class="form-check-input" type="radio" value="AI" name="search_by" id="airImport">
                                                    <label class="form-check-label" for="airImport">
                                                        Air Import
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="AE" name="search_by" id="airExport">
                                                    <label class="form-check-label" for="airExport">
                                                        Air Export
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="SI" name="search_by" id="seaImport">
                                                    <label class="form-check-label" for="seaImport">
                                                        Sea Import
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="SE" name="search_by" id="seaExport">
                                                    <label class="form-check-label" for="seaExport">
                                                        Sea Export
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="TR" name="search_by" id="transport">
                                                    <label class="form-check-label" for="transport">
                                                        Transport
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <hr>
                                <div class="form-validation">
                                    <form method="POST" action="{{route('proforma-invoices.store')}}" class="needs-validation" id="proformaForm">
                                        @csrf
                                        <input type="hidden" name="Inv_cat" />
                                        <input type="hidden" name="full_job_no" id="full_job_no">
                                        <div class="row">
                                            <!-- Row 1 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Job No: <span class="text-danger">*</span></label>
                                                <select name="job_no" id="option" class="form-control select2" required>
                                                    <option value="">Select</option>
                                                    {{-- Populate with @foreach if needed --}}
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Proforma Invoice No:</label>
                                                <input type="text" name="invoice_no" class="form-control">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Inv Date: <span class="text-danger">*</span></label>
                                                <input type="date" name="invoice_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">GST Type: <span class="text-danger">*</span></label>
                                                <select name="gst_type" class="form-control" required>
                                                    <option value="">Select</option>
                                                    <option value="local" selected>LOCAL</option>
                                                    <option value="otherState">Other State</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Invoice Type:</label>
                                                <select name="invoice_type" class="form-control select2">
                                                    <option value="">Select</option>
                                                    <option value="PRO-FORMA INVOICE" Selected>PRO-FORMA INVOICE</option>
                                                    <option value="DEBITNOTE(Rs)">DEBITNOTE(Rs)</option>
                                                    <option value="CREDITNOTE(Rs)">CREDITNOTE(Rs)</option>
                                                    <option value="DEBITNOTE(Ovr.)">DEBITNOTE(Ovr.)</option>
                                                    <option value="CREDITNOTE(Ovr.)">CREDITNOTE(Ovr.)</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Bill To: <span class="text-danger">*</span></label>
                                                <div class="d-flex">
                                                    <select class="form-control wide me-2 select2"
                                                        name="billing_party_id">
                                                        <option value="">Select Billing_Party</option>
                                                        @foreach ($parties->where('party_type', 10) as $party)
                                                        <option value="{{$party->id}}" {{ old('billing_party_id') == $party->id ? 'selected' : '' }}>{{$party->party_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <button type="button" class="btn btn-sm btn-outline-primary"
                                                        data-bs-toggle="modal" data-bs-target="#partyDetailsModal" data-target-field="billing_party_id">
                                                        <i class="bi bi-plus-lg">+</i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Party Type:</label>
                                                <select name="party_type" class="form-control">
                                                    <option value="">Select</option>
                                                    <option value="customer" selected>Customer</option>
                                                    <option value="other">Other Billing Party</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Shipper Name:</label>
                                                <input type="text" name="shipper_name" class="form-control" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Job Date:</label>
                                                <input type="text" name="job_date" class="form-control" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Voyage Code:</label>
                                                <input type="text" name="voyage_code" class="form-control" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">POD:</label>
                                                <input type="text" name="pod" class="form-control" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">POL:</label>
                                                <input type="text" name="pol" class="form-control" style="background: #eee; cursor: not-allowed;">
                                            </div>

                                            <!-- Row 2 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Container:</label>
                                                <input type="text" name="container" class="form-control" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Consignee:</label>
                                                <input type="text" name="consignee" class="form-control" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">CBM:</label>
                                                <input type="text" name="cbm" class="form-control" style="background: #eee; cursor: not-allowed;">
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Package Type:</label>
                                                <input type="text" name="pkgType" class="form-control" style="background: #eee; cursor: not-allowed;">
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Packages:</label>
                                                <input type="text" name="packages" class="form-control" style="background: #eee; cursor: not-allowed;">
                                            </div>

                                            <!-- Row 3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Gross WT:</label>
                                                <input type="text" name="gross_weight" class="form-control" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Chg WT:</label>
                                                <input type="text" name="chargeable_weight" class="form-control" style="background: #eee; cursor: not-allowed;">
                                            </div>

                                           <div class="col-md-4 mb-3">
                                                <label class="form-label">Vessel / Air Line:</label>
                                                <input type="text" name="vessel_name" class="form-control" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Shipping bill No/Dt:</label>
                                                <input type="text" name="shipping_no" class="form-control" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">BOE Date:</label>
                                                <input type="text" name="boe_date" class="form-control" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">AWB / BL NO: <span class="text-danger">*</span></label>
                                                <input type="text" name="awb_bl_no" required class="form-control" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <!-- Row 4 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Account No:</label>
                                                <select name="bank_id" class="form-control select2">
                                                    <option value="">Select</option>
                                                    @foreach ($account_numbers as $account_number)
                                                        <option value="{{$account_number->id}}" >{{$account_number->account_no}}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                            <!-- Row 5 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Sale / Purchase / Proforma:</label>
                                                <input type="text" name="sale_purchase" class="form-control" value="Proforma">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Shipper Invoice No:</label>
                                                <input type="text" name="shipper_invoice_no" class="form-control" value="{{ old('shipper_invoice_no', $salesInvoice->shipper_invoice_no ?? '') }}">
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Sales Person:<span class="text-danger">*</span></label>
                                                <div class="col-sm-12 d-flex align-items-center">
                                                    <select name="sales_person_id" class="form-control select2" required>
                                                        <option value="">Select</option>
                                                        @foreach ($salesPerson as $salePerson)
                                                            <option value="{{$salePerson->id}}">{{$salePerson->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <button type="button" class="btn btn-sm btn-outline-primary"
                                                        data-bs-toggle="modal" data-bs-target="#salespersonModal">
                                                        <i class="bi bi-plus-lg">+</i>
                                                    </button>
                                                </div>
                                            </div>

                                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                            <!--<button type="button" class="btn btn-danger btn-sm">Add Charges From Performa</button>-->
                                            <a type="button" href="{{ url('admin/proforma-invoices') }}" class="btn btn-warning btn-sm">Cancel</a>
                                            <!--<button type="button" class="btn btn-success btn-sm">Print</button>-->
                                            <button type="submit" class="btn btn-primary btn-sm">Save</button>
                                        </div>
                                    </form>
                                    <div id="msg"></div>
                                </div>
                            </div>
                        </div>


                        <h4>Charges</h4>
                        <hr>
                        <div class="form-validation">
                            <form class="needs-validation" method="POST" action="{{ route('proforma-invoices.proformaInvoiceCharge') }}" id="proformaChargeForm">
                                @csrf
                                <input type="hidden" name="proforma_invoice_id" value="">
                                <input type="hidden" name="" id="gst_type">
                                <div class="row">
                                    <!-- Charge Name -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Charge_Name:<span class="text-danger">*</span></label>
                                            <div class="col-sm-9 d-flex align-items-center gap-2">
                                                <select name="charge_id" id="charge_name" class="form-control wide me-2 select2">
                                                    <option value="">select</option>
                                                    @foreach ($charges as $charge)
                                                        <option value="{{$charge->id}}">{{$charge->charge_name}}</option>
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
                                                <select name="currency" class="form-control me-2 select2">
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
                                                <select name="rate_basis" class="form-control wide me-2 select2 ">
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
                                            <label class="col-sm-3 col-form-label">Per Unit:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="per_unit" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <!--Total Unit-->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Total Unit:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="total_unit" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Freight -----  changed to total charges  -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Total Taxable Charges:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="freight" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- GST -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">GST:</label>
                                            <div class="col-sm-9">
                                                <input type="text" id="gst" name="gst" class="form-control">
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
                                                <input type="text" name="igst" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- CGST -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">CGST:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="cgst" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- SGST -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">SGST:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="sgst" class="form-control">
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

                                    <!-- Full Invoice No -->
                                    <!--<div class="col-xl-6">-->
                                    <!--    <div class="mb-3 row">-->
                                    <!--        <label class="col-sm-3 col-form-label">Fullinvno:</label>-->
                                    <!--        <div class="col-sm-9">-->
                                    <!--            <input type="text" name="charge_full_invoice_no" class="form-control">-->
                                    <!--        </div>-->
                                    <!--    </div>-->
                                    <!--</div>-->

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
                                                <select name="prepaid_coll" class="default-select form-control wide me-2">
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
                                    <!--            <input type="text" name="rate_per_unit" class="form-control">-->
                                    <!--        </div>-->
                                    <!--    </div>-->
                                    <!--</div>-->

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
                                                <select name="cc_apply" class="default-select form-control wide me-2">
                                                    <option value="">select</option>
                                                    <option value="N">N</option>
                                                    <option value="Y">Y</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- GSTIN -->
                                    <!--<div class="col-xl-6">-->
                                    <!--    <div class="mb-3 row">-->
                                    <!--        <label class="col-sm-3 col-form-label">GSTIN:</label>-->
                                    <!--        <div class="col-sm-9">-->
                                    <!--            <input type="text" name="gstin" class="form-control">-->
                                    <!--        </div>-->
                                    <!--    </div>-->
                                    <!--</div>-->





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
                                                <select name="caf_apply" class="default-select form-control wide me-2">
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
                                                <input type="text" name="total" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <button type="submit" id="saveBtn" class="btn btn-primary btn-sm">ADD/UPDATE CHARGES</button>
                                </div>
                            </form>

                            <div id="purchaseInvoiceChargesList"></div>
                        </div>


                        <h4>File Upload</h4>
                        <hr>
                        <div class="form-validation">
                            <form class="ajaxFileUpload" action="{{route('file-upload.updateFileUpload')}}" method="post" enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="file_related" value="proforma_invoice">
                                <input type="hidden" name="proforma_invoice_id" class="proforma_invoice_id">
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

                            <!--<form method="post" id="searchProformaInvoiceFile">-->
                            <!--    @csrf-->
                            <!--    <div class="col-xl-9">-->
                            <!--        <div class="mb-3 row row">-->
                            <!--            <label class="col-sm-3 col-form-label">Find PDF File:<span-->
                            <!--                class="text-danger">*</span></label>-->
                            <!--            <div class="col-sm-9">-->
                            <!--                <div class="d-flex">-->
                            <!--                    <select class="default-select form-control wide me-2"-->
                            <!--                        placeholder="Select" name="search_query">-->
                            <!--                            <option value="">select</option>-->
                            <!--                            @foreach ($files as $file)-->
                            <!--                                <option value="{{$file->id}}">{{$file->file_name}}</option>-->
                            <!--                            @endforeach-->
                            <!--                    </select>-->
                            <!--                    <button type="submit" class="btn btn-primary btn-sm">Search</button>-->
                            <!--                </div>-->
                            <!--            </div>-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--</form>-->
                        </div>
                    </div>

                    <div id="searchFile"></div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Charge Name Details -->
@include('admin-main.admin.commonModelForms.charge_name_model')
@include('admin-main.admin.commonModelForms.modelPartyDetails')
@include('admin-main.admin.commonModelForms.salesperson_modal')
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
        $(document).ready(function () {

            $('.select2').select2({
                width: '100%'
            })

            //first form
            // Handle first form (Proforma Invoice)
            $('#proformaForm').on('submit', function (e) {
                e.preventDefault();

                var job_id = $("select[name='job_no'] option:selected").attr('job_id');

                let form = $(this);
                let formData = form.serialize() + '&job_id=' + encodeURIComponent(job_id);


                $.ajax({
                    url: form.attr('action'),
                    method: 'POST',
                    data: formData,
                    success: function (res) {

                        if (res.status === false) {
                            $('#msg').text(res.message).css('color', 'red');

                            setTimeout(()=>{
                               $('#msg').text('').css({color:'',background:'',padding:''});
                            }, 3000)
                            return;
                        }

                        if (res.success) {
                            $('#msg').text(res.message).css({'color': 'green', 'background' : '#90ee90','padding' : '10px',});
                            // Store the invoice ID into the second form hidden field
                            $('input[name="proforma_invoice_id"]').val(res.id);
                            $('#gst_type').val(response.salesInvoice.gst_type);
                        }
                    },
                    error: function (xhr) {
                        alert('Error saving invoice');
                        alert(xhr.responseText);
                    }
                });
            });
        });
    </script>
    <script>
        //charge form
        $(document).ready(function () {
            $('#proformaChargeForm').on('submit', function (e) {
                e.preventDefault();
                $('#saveBtn').prop('disabled', true).text('Saving...');

                let form = $(this);
                $.ajax({
                    url: form.attr('action'),
                    method: 'POST',
                    data: form.serialize(),
                    success: function (res) {
                        console.log(res);
                        if (res.success) {

                            $('#saveBtn').prop('disabled', false).text('ADD/UPDATE CHARGES');
                            let charge = res.proformaInvoiceCharges;
                            let html = `
                                <div class="alert alert-secondary">
                                    <strong>${charge.charge_name || '-'}</strong> |
                                    Amount: ${charge.amount || 0} |
                                    GST: ${charge.gst || 0}%
                                </div>
                            `;
                            $('#purchaseInvoiceChargesList').prepend(html);

                            form.trigger('reset'); // optional
                        }
                    },
                    error: function (xhr) {
                        alert('Error saving charge');
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>
    <script>
        // party details model
        let targetField = null;

        // Capture which button triggered the modal
        $(document).on('click', '[data-bs-target="#partyDetailsModal"]', function () {
            targetField = $(this).data('target-field'); // e.g. 'billing_party_id', 'notify_id', etc.
        });

        // Handle form submission
        $('#modelPartyDetails').on('submit', function (e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('new-party.store') }}",
                method: 'POST',
                data: $(this).serialize(),
                success: function (response) {
                    if (response.success) {
                        const partyId = response.party.id;
                        const partyName = response.party.name;
                        const activeSelect = $('select[name="' + targetField + '"]');

                        if (activeSelect.find('option[value="' + partyId + '"]').length === 0) {
                            const newOption = new Option(partyName, partyId, true, true);
                            activeSelect.append(newOption).trigger('change');
                        }

                        $('#modelPartyDetails')[0].reset();
                        $('#partyDetailsModal').modal('hide');
                        toastr.success('Party added successfully!');
                    } else {
                        toastr.error(response.message || 'Something went wrong.');
                    }
                },
                error: function (xhr) {
                    toastr.error('Failed to add party details.');
                    console.error('Error:', xhr.responseText);
                }
            });
        });

        // Reset target field after modal closes
        $('#partyDetailsModal').on('hidden.bs.modal', function () {
            targetField = null;
        });
    </script>

    <script>
        $(document).ready(function(){

            // $(document).on('submit', '#billingPartyAdd', function (e) {
            //     e.preventDefault(); // stop reload

            //     const form = $(this);
            //     const btn = form.find('button[type="submit"]');
            //     btn.prop('readonly', true).text('Saving...');

            //     $.ajax({
            //         url: "{{ route('new-billing-party.store') }}",
            //         type: "POST",
            //         data: form.serialize(),
            //         success: function (res) {
            //             btn.prop('readonly', false).text('Save');

            //             if (res.success) {
            //                 const shipperSelect = $('#shipper_id');
            //                 const newOption = new Option(res.party.name, res.party.id, true, true);
            //                 shipperSelect.append(newOption).trigger('change');

            //                 form[0].reset();
            //                 $('#exportPartyDetails').modal('hide');
            //             } else {
            //                 alert(res.message || 'Failed to save export party.');
            //             }
            //         },
            //         error: function (xhr) {
            //             btn.prop('readonly', false).text('Save');
            //             let msg = 'Failed to add export party.';
            //             if (xhr.responseJSON?.errors) {
            //                 msg = Object.values(xhr.responseJSON.errors).flat().join("\n");
            //             }
            //             alert(msg);
            //         }
            //     });
            // });


            $('input[name="search_by"]').on('change', function() {

                let selected = $('input[name="search_by"]:checked').val();
                if (!selected) {
                    // Clear dropdown and hidden input
                    $('#option').html('<option value="">Select</option>');
                    $('input[name="Inv_cat"]').val('');
                    return;
                }
                $('#searchForm').submit();
            });

            $('#searchForm').on('submit', function(e){
                e.preventDefault();
                var data = $(this).serialize();

                $.ajax({
                    url : '{{ route('proforma-invoices.getJobNo') }}',
                    type : 'POST',
                    data : data,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success : function(res){
                        if(res.status === 'success'){
                            $('#option').html(res.result);
                            $('input[name="Inv_cat"]').val(res.Inv_cat);
                        }
                    },
                    error: function(xhr){
                        console.log('Error:', xhr.responseText);
                    }
                });
            });

            $('#option').on('change', function (e) {
                e.preventDefault();

                let selectedOption = $(this).find('option:selected');
                let selectedValue = selectedOption.val();
                let type = selectedOption.data('type');
                let fullJobNo = selectedOption.data('fulljob');
                let originalJob = selectedOption.data('job_id');
                let jobDate = selectedOption.data('jobdate');
                let shipperName = selectedOption.data('shippername');

                console.log(shipperName);

                $('input[name="full_job_no"]').val(fullJobNo);
                $('input[name="Inv_cat"]').val(type);
                $('input[name="job_no"]').val(originalJob); // hidden input
                $('#hidden_job_no').val(originalJob);
                $('input[name="job_date"]').val(jobDate);
                $('input[name="shipper_name"]').val(shipperName);

                $.ajax({
                    url: '{{route("proforma-invoices.getInvoiceRecord")}}',
                    type: 'post',
                    data: {'id': selectedValue, 'type' : type},
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(res){

                        console.log('res,res', res);

                        if(res.status == 'success'){

                            $('input[name="pod"]').val(res.deliveryPort);
                            $('input[name="pol"]').val(res.loadingPort);
                            $('input[name="pkgType"]').val(res.packageType);
                            $('input[name="packages"]').val(res.packages);

                            $('input[name="container"]').val(res.containerNo);
                            $('input[name="consignee"]').val(res.consigneeName);
                            $('input[name="cbm"]').val(res.cbm);
                            $('input[name="gross_weight"]').val(res.grossWeight);
                            $('input[name="voyage_code"]').val(res.voyageNo);

                            $('input[name="awb_bl_no"]').val(res.Awb_BlNo);
                            $('input[name="shipping_no"]').val(res.shippingBillNoDt);
                            $('input[name="vessel_name"]').val(res.vessel_airLine);
                            $('input[name="boe_date"]').val(res.boe);

                            $('input[name="chargeable_weight"]').val(res.chargeWeight);
                            $('input[name="shipper_invoice_no"]').val(res.customer_inv_no || '');

                            // if(res.result.full_job_no){
                            //     $('#full_job_no').val(res.result.full_job_no);
                            // }
                        }
                    },
                    error: function(xhr){
                        console.log('Error:', xhr.responseText);
                    }
                });
            });

        });

    </script>

    <script>
        document.getElementById('searchProformaInvoiceFile').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            fetch("{{ route('file-upload.searchFile') }}", {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
                },
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                console.log(data);

                document.getElementById('searchFile').innerHTML = data;
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });

        function clearSearchFile() {
            document.getElementById("searchFile").innerHTML = "";
        }
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
                            $('#chargesNames').modal('hide');
                            $('#chargeForm')[0].reset();

                            const newOption = new Option(res.data.charge_name, res.data.id, true, true);
                            $('select[name="charge_id"]').append(newOption).trigger('change');

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
        $(document).ready(function() {

            // --- MAIN CALCULATION FUNCTION ---
            function calculateTotals() {
                let gstType = $('select[name="gst_type"]').val(); // local / otherState
                let perUnit = parseFloat($('input[name="per_unit"]').val()) || 1;
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

                $('input[name="cgst"]').val(cgst.toFixed(3))
                    .css('background', '#ded9d9')
                    .prop('readonly', true);
                $('input[name="sgst"]').val(sgst.toFixed(3))
                    .css('background', '#ded9d9')
                    .prop('readonly', true);
                $('input[name="igst"]').val(igst.toFixed(3))
                    .css('background', '#ded9d9')
                    .prop('readonly', true);


                let amountWithTax = baseAmount + cgst + sgst + igst;
                $('input[name="amount"]').val(amountWithTax.toFixed(3))
                    .css('background', '#ded9d9')
                    .prop('readonly', true);

                // --- Step 3: TDS Calculation (on base only) ---
                let tdsAmount = 0;
                if (tdsPercent > 0) {
                    tdsAmount = (baseAmount * tdsPercent) / 100;
                }
                $('#tds_amount').val(tdsAmount.toFixed(3))
                    .css('background', '#ded9d9')
                    .prop('readonly', true);

                // --- Step 4: Final Total = (Base + GST) - TDS ---
                let finalTotal = baseAmount + cgst + sgst + igst - tdsAmount;
                let roundedTotal = finalTotal;
                $('input[name="total"]').val(roundedTotal.toFixed(3))
                    .css('background', '#ded9d9')
                    .prop('readonly', true);
            }

            // --- Trigger recalculation whenever relevant fields change ---
            $('select[name="gst_type"], input[name="per_unit"], input[name="total_unit"], input[name="exchange_rate"], select[name="gst_applicable"], input[name="tds"], input[name="gst"]').on('change keyup', function () {
                calculateTotals();
            });

            // --- When charge_name changes (fetch GST & SAC code) ---
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

            // --- Trigger calculation when TDS input loses focus ---
            $('#tds').on('blur', function () {
                calculateTotals();
            });

        });

        // sales person submit using ajax
        $(document).ready(function() {
            $('#salespersonForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('salesperson.store') }}", // route name
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        // Add the new option to select dropdowns
                        $('select[name="sales_person_id"]').each(function() {
                            $(this).append(`<option value="${response.id}" selected>${response.name}</option>`);
                        });

                        // Close modal and reset form
                        $('#salespersonForm')[0].reset();
                        $('#salespersonModal').modal('hide');
                    },
                    error: function(xhr) {
                        alert("You can't enter duplicate sales person name.");

                        // Properly log the full error
                        console.error('Error:', xhr.responseText);

                        // Optional: Show the Laravel validation errors if exist
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            let messages = '';
                            Object.values(xhr.responseJSON.errors).forEach(function(errorArray) {
                                messages += errorArray.join("\n") + "\n";
                            });
                            alert(messages);
                        }
                    }
                });
            });

        });

    </script>
@endpush
