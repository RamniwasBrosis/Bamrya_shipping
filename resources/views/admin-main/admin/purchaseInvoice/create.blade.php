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
                        <h4 class="card-title">Add New Purchase</h4>
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
                                                    <input class="form-check-input" type="radio" value="AI" name="search_by">
                                                    <label class="form-check-label" for="lcl">
                                                        Air Import
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="AE" name="search_by">
                                                    <label class="form-check-label" for="fcl20">
                                                        Air Export
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="SI" name="search_by">
                                                    <label class="form-check-label" for="fcl40">
                                                        Sea Import
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="SE" name="search_by">
                                                    <label class="form-check-label" for="air">
                                                        Sea Export
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="TR" name="search_by">
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
                                    <form method="POST" action="{{route('purchase-invoices.store')}}" class="needs-validation" id="purchaseForm">
                                        @csrf
                                        <input type="hidden" name="Inv_cat" />
                                        <input type="hidden" name="job_no" id="hidden_job_no">
                                        <input type="hidden" name="full_job_no" id="full_job_no">

                                        <div class="row">
                                            <!-- Row 1 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Job No: <span class="text-danger">*</span></label>
                                                <select name="" id="option" class="form-control select2" required>
                                                    <option value="">Select</option>
                                                    {{-- Populate with @foreach if needed --}}
                                                </select>
                                            </div>
                                            
                                            <!-- Row 2 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Inv No: <span class="text-danger">*</span></label>
                                                <input type="text" name="invoice_no" class="form-control" required>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Inv Date: <span class="text-danger">*</span></label>
                                                <input type="date" name="invoice_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Inv Due Date:</label>
                                                <input type="date" name="invoice_due_date" class="form-control" value="">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Invoice Type:</label>
                                                <select name="invoice_type" class="form-control select2">
                                                    <option value="">Select</option>
                                                    <option value="PURCHASE">PURCHASE</option>
                                                    <option value="PURCHASE(OVR.)">PURCHASE(OVR.)</option>
                                                    <option value="PURCHASE(CN.RS.)">PURCHASE(CN.RS.)</option>
                                                    <option value="PURCHASE(CN.OVR.)">PURCHASE(CN.OVR.)</option>                                                   
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Job Date:</label>
                                                <input type="text" name="job_date" class="form-control" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            
                                            <!-- Row 3 -->
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
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">ETA DATE:</label>
                                                <input type="text" name="eta_date" class="form-control" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">ETD DATE:</label>
                                                <input type="text" name="etd_date" class="form-control" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <!--<div class="col-md-4 mb-3">-->
                                            <!--    <label class="form-label">BL NO:</label>-->
                                            <!--    <input type="text" name="bl_no" class="form-control" style="background: #eee; cursor: not-allowed;">-->
                                            <!--</div>-->
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Container No:</label>
                                                <input type="text" name="container" class="form-control" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Container Qty:</label>
                                                <input type="text" name="container_qty" class="form-control">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Shipper Name:</label>
                                                <input type="text" name="shipper_name" class="form-control" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Consignee/Consigner:</label>
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
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Gross WT:</label>
                                                <input type="text" name="gross_weight" class="form-control" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Chg WT:</label>
                                                <input type="text" name="chargeable_weight" class="form-control" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Shipping Bill No/Date:</label>
                                                <input type="text" name="shipping_no" class="form-control" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Remarks:</label>
                                                <input type="text" name="remarks" class="form-control" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Freight Terms:</label>
                                                <input type="text" name="freight_terms" class="form-control" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Party Type:<span class="text-danger">*</span><</label>
                                                <select name="party_type" class="form-control">
                                                    <option value="">Select</option>
                                                    <option value="cha">CHA</option>
                                                    <option value="forwarder">Forwarder</option>
                                                    <option value="chaforwarder">CHA & Forwarder</option>
                                                    <option value="transporter">Transporter</option>
                                                    <option value="others">Others</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Shipper Inv No:</label>
                                                <input type="text" name="full_invoice_no" id="full_invoice_no" class="form-control">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Bill From: <span class="text-danger">*</span></label>
                                                <div class="d-flex">
                                                    
                                                    <select name="billing_party_id" class="form-control select2" required>
                                                        <option value="">Select</option>
                                                        @foreach ($parties as $party)
                                                            <option value="{{$party->id}}">{{$party->party_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    
                                                    <button type="button" class="btn btn-sm btn-outline-primary"
                                                        data-bs-toggle="modal" data-bs-target="#purchasePartyModal" data-target-field="billing_party_id">
                                                        <i class="bi bi-plus-lg">+</i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">GST Type: <span class="text-danger">*</span></label>
                                                <select name="gst_type" class="form-control" required>
                                                    <option value="">Select</option>
                                                    <option value="local">LOCAL</option>
                                                    <option value="outstation">OUTSTATION</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Account No: </label>
                                                <select name="bank_id" class="form-control select2">
                                                    <option value="">Select</option>
                                                    @foreach ($account_numbers as $account_number)
                                                        <option value="{{$account_number->id}}" >{{$account_number->account_no}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Sales Person:</label>
                                                <input type="text" name="sales_person" class="form-control" value="{{ old('sales_person') }}" style="background: #eee;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Vessel Name/Air Line:</label>
                                                <input type="text" name="vessel_name" class="form-control" value="{{ old('vessel_name', $salesInvoice->vessel_name ?? '') }}">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">AWB / BL NO: <span class="text-danger">*</span></label>
                                                <input type="text" name="awb_bl_no" required class="form-control" value="{{ old('awb_bl_no', $salesInvoice->awb_bl_no ?? '') }}">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">MAWB NO:</label>
                                                <input type="text" name="mawb_no" class="form-control" value="" style="background: #eee;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">HAWB NO:</label>
                                                <input type="text" name="hawb_no" class="form-control" value="{{ old('hawb_no', $salesInvoice->hawb_no ?? '') }}" style="background: #eee;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">HBL NO:</label>
                                                <input type="text" name="hbl_no" class="form-control" value="{{ old('hbl_no', $salesInvoice->hbl_no ?? '') }}" style="background: #eee;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Sale / Purchase:</label>
                                                <input type="text" name="sale_purchase" class="form-control" value="PURCHASE">
                                            </div>
                                            
                                        </div>

                                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                            <!--<button type="button" class="btn btn-danger btn-sm">Add Charges From Performa</button>-->
                                            <button type="button" class="btn btn-warning btn-sm">Cancel</button>
                                            <!--<button type="button" class="btn btn-success btn-sm">Print</button>-->
                                            <button type="submit" class="btn btn-primary btn-sm">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <div id="success-box"></div>
                        <div id="error-box"></div>

                        <h4>Charges</h4>
                        <hr>
                        <div class="form-validation">
                            <form class="needs-validation" id="purchaseInvoiceContainerForm" method="POST" action="{{ route('purchase-invoices.purchaseInvoiceCharge') }}">
                                @csrf
                                <input type="hidden" name="purchase_invoice_id" id="purchase_invoice_id">
                                <input type="hidden" name="" id="gst_type">
                                <div class="row">
                                    <!-- Charge Name -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Charge_Name:<span class="text-danger">*</span></label>
                                            <div class="col-sm-9 d-flex align-items-center gap-2">
                                                <select name="charge_id" id="charge_name" class="select2 form-control wide me-2">
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
                                                    <option value="PERAIRWAYBILL">PER AIRWAY BILL</option>
                                                    <option value="PERBL">PER BL</option>
                                                    <option value="CBMWISE">CBMWISE</option>
                                                    <option value="PERCONT">PER CONTAINER</option>
                                                    <option value="GWTWISE">GWTWISE</option>
                                                    <option value="CHGWTWISE">CHGWTWISE</option>
                                                    <option value="RECEIPTED">RECEIPTED</option>
                                                    <option value="PERKG">PER KG</option>
                                                    <option value="PERCBM">PER CBM</option>
                                                    <option value="PERINVOICE">PER INVOICE</option>
                                                    <option value="PERSET">PER SET</option>
                                                    <option value="PERPACKAGE">PER PACKAGE</option>
                                                    <option value="PERDAY">PER DAY</option>
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
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Total Unit:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="total_unit" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Freight -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Total Taxable charges:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="freight" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    <!-- GST -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Input GST%:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="gst" class="form-control">
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
                                    
                                    <!-- Total taxable charges -->
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
                
                                    
                                    

                                    <!-- GSTIN -->
                                    <!-- <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">GSTIN:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="gstin" class="form-control">
                                            </div>
                                        </div>
                                    </div> -->

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
                                    <button type="submit" id="saveBtn" class="btn btn-primary btn-sm">ADD/UPDATE CHARGES</button>
                                </div>
                            </form>
                        </div>
                        <!-- Display saved charges -->
                        <div id="purchaseInvoiceChargesList"></div>


                        <h4>File Upload</h4>
                        <hr>
                        <div class="form-validation">
                            <form class="ajaxFileUpload" data-related="purchase_invoice" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="file_related" value="purchase_invoice">
                                <input type="hidden" name="purchase_invoice_id" class="purchase_invoice_id">
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

                            <!--<form method="post" id="searchPurchaseInvoiceFile">-->
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
    <!--party model-->
    @include('admin-main.admin.commonModelForms.purchasePartyModel')
@endsection



@push('scripts')
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
    </script>
    <script>
        $(document).ready(function(){
            
            $('.select2').select2({
                width: '100%'
            })

            // purchase invoice Main form submit
            $('#purchaseForm').on('submit', function(e){
                e.preventDefault();
            
                let form = $(this);
                let formData = form.serialize();
            
                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: formData,
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    success: function(res) {
                        // Do not print raw JSON
                        if (res.status === true) {
                            // Clear previous messages
                            $("#error-box").html("");
                            $("#success-box").html(`<div class="alert alert-success">${res.message}</div>`);
            
                            // Set hidden purchase_invoice_id for second form
                            $('#purchase_invoice_id').val(res.purchase_invoice_id);
                            $('.purchase_invoice_id').val(res.purchase_invoice_id);
                            $('#gst_type').val(res.purchaseInvoice.gst_type);
            
                            // Optional: enable second form inputs
                            // $('#purchaseInvoiceContainerForm :input').prop('disabled', false);
                        } else {
                            $("#success-box").html("");
                            $("#error-box").html(`<div class="alert alert-danger">${res.message}</div>`);
                        }
                    },
                    error: function(xhr){
                        console.log(xhr.responseText);
                        alert("Something went wrong! Please reload the page.");
                    }
                });
            });

            
            //charge form
            $('#purchaseInvoiceContainerForm').on('submit', function(e){
                e.preventDefault();
                
                $('#saveBtn').prop('disabled', true).text('Saving...');
            
                let form = $(this);
                let formData = form.serialize();
            
                $.ajax({
                    url: '{{ route("purchase-invoices.purchaseInvoiceCharge") }}', // your controller route
                    type: 'POST',
                    data: formData,
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    success: function(res){
                        if(res.status === true){
                            // Show success message
                            // alert(res.message);
            
                            // Reset form fields
                            form[0].reset();
            
                            $('#saveBtn').prop('disabled', false).text('Save');
                
                            // Append new record to charges list
                            let charge = res.purchaseInvoiceContainer;
                            // console.log('rtet0', charge); return;
                            let html = `
                                <div class="alert alert-success">
                                    <strong>${charge.charge_name.charge_name || '-'}</strong> |
                                    Amount: ${charge.amount || 0} |
                                    GST: ${charge.gst || 0}%
                                </div>
                            `;
                            $('#purchaseInvoiceChargesList').prepend(html);
                        } else {
                            alert(res.message || "Failed to save charges.");
                            $('#saveBtn').prop('disabled', false).text('Save');
                        }
                    },
                    error: function(xhr){
                        console.log(xhr.responseText);
                        alert("Something went wrong! Please reload the page.");
                    }
                });
            });


        })
    </script>
<script>
        $(document).ready(function() {
            // party details model
            let targetField = null;
        
            // Capture which button triggered the modal
            $(document).on('click', '[data-bs-target="#purchasePartyModal"]', function () {
                targetField = $(this).data('target-field'); // e.g. 'billing_party_id', 'notify_id', etc.
            });
            
            // Handle form submission
            $('#modelPurchaseDetails').on('submit', function (e) {
                e.preventDefault();
            
                $.ajax({
                    url: "{{ route('new-purchase-party.store') }}",
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
            
                            $('#modelPurchaseDetails')[0].reset();
                            $('#purchasePartyModal').modal('hide');
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
            $('#purchasePartyModal').on('hidden.bs.modal', function () {
                targetField = null;
            });
        
        });
    </script>
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
        $(document).ready(function(){

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
                e.preventDefault(); // prevent default form submission
                var data = $(this).serialize();

                $.ajax({
                    url : '{{ route('purchase-invoices.getJobNo') }}',
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

            // Auto-load Job Data
            $('#option').on('change', function (e) {
                e.preventDefault();
            
                let selectedOption = $(this).find('option:selected'); 
                let selectedValue = selectedOption.val();
                let type = selectedOption.data('type');
                let fullJobNo = selectedOption.data('fulljob');
                let originalJob = selectedOption.data('originaljob'); // now works
                let jobDate = selectedOption.data('jobdate');
                let shipperName = selectedOption.data('shippername');
                let salesPerson = selectedOption.data('salesperson');
                
                $('input[name="full_job_no"]').val(fullJobNo);
                $('input[name="Inv_cat"]').val(type);
                $('input[name="job_no"]').val(originalJob); // hidden input
                $('#hidden_job_no').val(originalJob);
                $('input[name="job_date"]').val(jobDate);
                $('input[name="shipper_name"]').val(shipperName);
                $('input[name="sales_person"]').val(salesPerson);
    
                $.ajax({
                    url: '{{ route("purchase-invoices.getInvoiceRecord") }}',
                    type: 'post',
                    data: { id: selectedValue, type: type },
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function (res) {
                        console.log(res);
                        if (res.status == 'success') {
                            if (res.result.voyage_no) {
                                $('input[name="voyage_code"]').val(res.result.voyage_no);
                            }
                            $('input[name="pod"]').val(res.deliveryPort);
                            $('input[name="pol"]').val(res.loadingPort);
                            $('input[name="bl_no"]').val(res.blNo);
                            $('input[name="pkgType"]').val(res.packageName);
                            $('input[name="packages"]').val(res.packageValue);
                            
                            let containerNo = '';
                            if (res.result.container && res.result.container.length > 0) {
                                containerNo = res.result.container[0].container_no;
                            }
                            
                            $('input[name="container"]').val(containerNo);
                            $('input[name="consignee"]').val(res.consigneeName);
                            $('input[name="cbm"]').val(res.totalCbm ?? 0);
                            $('input[name="gross_weight"]').val(res.result.gross_weight);
                            $('input[name="shipping_no"]').val(res.sbill_no);
                            $('input[name="full_invoice_no"]').val(res.result.customer_inv_no);
                            $('input[name="hawb_no"]').val(res.result.hawb_no);
                            $('input[name="awb_bl_no"]').val(res.mbl_no);
                            $('input[name="hbl_no"]').val(res.result.hbl_no);
                            $('input[name="mawb_no"]').val(res.result.mawb_no);
                            $('input[name="vessel_name"]').val(res.airLineAndVasselName);
                            if (res.result.chg_weight) {
                                $('input[name="chargeable_weight"]').val(res.result.chg_weight);
                            } else {
                                $('input[name="chargeable_weight"]').val(res.result.chargable_weight);
                            }
                            $('input[name="remarks"]').val(res.result.remarks);
                            if (res.result.freight == 'P' || res.result.freight == 'PREPAID') {
                                $('input[name="freight_terms"]').val('PREPAID');
                            } else if (res.result.freight == 'C' || res.result.freight == 'COLLECT') {
                                $('input[name="freight_terms"]').val('COLLECT');
                            }
                            if (res.result.bill_of_entry_date) {
                                let rawDate = res.result.bill_of_entry_date;
                                let formattedDate = new Date(rawDate).toISOString().split('T')[0];
                                // $('input[name="shipping_no"]').val(formattedDate);
                            }
                            if (res.result.eta_date) {
                                let etaDate = new Date(res.result.eta_date).toISOString().split('T')[0];
                                $('input[name="eta_date"]').val(etaDate);
                            }
                            
                            if (res.result.etd_date) {
                                let etdDate = new Date(res.result.etd_date).toISOString().split('T')[0];
                                $('input[name="etd_date"]').val(etdDate);
                            }
                        }
                    },
                    error: function (xhr) {
                        console.log('Error:', xhr.responseText);
                    }
                });
            });

        });
    </script>

    <script>
        // document.getElementById('searchPurchaseInvoiceFile').addEventListener('submit', function(e) {
        //     e.preventDefault();
          
        //     const formData = new FormData(this);

        //     fetch("{{ route('file-upload.searchFile') }}", {
        //         method: "POST",
        //         headers: {
        //             'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
        //         },
        //         body: formData
        //     })
        //     .then(response => response.text())
        //     .then(data => {
        //         console.log(data);
                
        //         document.getElementById('searchFile').innerHTML = data;
        //     })
        //     .catch(error => {
        //         console.error('Error:', error);
        //     });
        // });

        function clearSearchFile() {
            document.getElementById("searchFile").innerHTML = "";
        }
    </script>
    
    <script>
        $(document).ready(function () {

            // === MAIN FUNCTION ===
            function calculateTotals() {

                let rateBasis = $('select[name="rate_basis"]').val();
            
                // If Rate Basis is empty stop calculation
                if (!rateBasis) {
            
                    $('input[name="freight"]').val('');
                    $('input[name="cgst"]').val('');
                    $('input[name="sgst"]').val('');
                    $('input[name="igst"]').val('');
                    $('input[name="amount"]').val('');
                    $('input[name="total"]').val('');
                    $('#tds_amount').val('');
            
                    return;
                }
            
                let gstType = $('select[name="gst_type"]').val();
                let perUnit = parseFloat($('input[name="per_unit"]').val()) || 1;
                let totalUnit = parseFloat($('input[name="total_unit"]').val()) || 1;
                let exchRate = parseFloat($('input[name="exchange_rate"]').val()) || 1;
                let gstPercent = parseFloat($('input[name="gst"]').val()) || 1;
                let gstApplicable = $('select[name="gst_applicable"]').val();
            
                // Total Taxable Charges
                let totalCharges = perUnit * totalUnit * exchRate;
            
                $('input[name="freight"]').val(totalCharges.toFixed(3))
                    .css('background', '#ded9d9')
                    .prop('readonly', true);
            
                let cgst = 0;
                let sgst = 0;
                let igst = 0;
            
                if (gstApplicable === 'Y') {
            
                    if (gstType === 'local') {
            
                        cgst = ((gstPercent / 2) * totalCharges) / 100;
                        sgst = ((gstPercent / 2) * totalCharges) / 100;
            
                    } else if (
                        gstType === 'outstation' ||
                        gstType === 'otherState' ||
                        gstType === 'otherstate'
                    ) {
            
                        igst = (gstPercent * totalCharges) / 100;
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
            
                let amountWithGST = totalCharges + cgst + sgst + igst;
            
                $('input[name="amount"]').val(amountWithGST.toFixed(3))
                    .css('background', '#ded9d9')
                    .prop('readonly', true);
            
                $('input[name="total"]').val(amountWithGST.toFixed(3))
                    .css('background', '#ded9d9')
                    .prop('readonly', true);
            
                // TDS Calculation
                let tdsPercent = parseFloat($('#tds').val()) || 0;
            
                if (tdsPercent > 0) {
            
                    let tdsAmount = (totalCharges * tdsPercent) / 100;
            
                    $('#tds_amount').val(tdsAmount.toFixed(3))
                        .css('background', '#ded9d9')
                        .prop('readonly', true);
            
                    let finalTotal = amountWithGST - tdsAmount;
            
                    $('input[name="total"]').val(finalTotal.toFixed(3));
            
                } else {
            
                    $('#tds_amount').val('');
                }
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
@endpush
