@extends('admin-main.layouts.default')
@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Sales Invoice</a></li>
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
                                <hr>
                                <div class="form-validation">
                                    <form method="POST" action="{{route('sales-invoices.store')}}" id="salesInvoiceForm" class="needs-validation">
                                        @csrf
                                        <input type="hidden" name="Inv_cat" />
                                        <input type="hidden" name="job_no" id="hidden_job_no">
                                        <input type="hidden" name="full_job_no" id="full_job_no">
                                        <div class="row">
                                            <!-- Row 1 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Job No: <span class="text-danger">*</span></label>
                                                <select name="" id="option" class="form-control select2">
                                                    <option value="">Select</option>
                                                    {{-- Populate with @foreach if needed --}}
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Invoice No: <span class="text-danger">*</span></label>
                                                <input type="text" name="invoice_no" class="form-control">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Inv Date: <span class="text-danger">*</span></label>
                                                <input type="date" name="invoice_date" class="form-control" value="{{ date('Y-m-d') }}">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Inv Due Date:</label>
                                                <input type="date" name="invoice_due_date" class="form-control" value="">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Invoice Type:</label>
                                                <select name="invoice_type" class="form-control select2">
                                                    <option value="">Select</option>
                                                    <option value="DEBITNOTE(Rs)">DEBITNOTE(Rs)</option>
                                                    <option value="CREDITNOTE(Rs)">CREDITNOTE(Rs)</option>
                                                    <option value="DEBITNOTE(Ovr.)">DEBITNOTE(Ovr.)</option>
                                                    <option value="CREDITNOTE(Ovr.)">CREDITNOTE(Ovr.)</option>
                                                    <option value="COMMISSION/REBATE">COMMISSION/REBATE</option>
                                                    <option value="SEZ">SEZ</option>
                                                    <option value="FRT(IGST)">FRT(IGST)</option>
                                                    <option value="FRT(CreditNote)">FRT(CreditNote)</option>
                                                    <option value="BILLOFSUPPLY">BILL OF SUPPLY</option>
                                                    <option value="Tax Invoice">Tax Invoice</option>
                                                </select>
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
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">ETA DATE:</label>
                                                <input type="text" name="eta_date" class="form-control" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">ETD DATE:</label>
                                                <input type="text" name="etd_date" class="form-control" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <!--<div class="col-md-4 mb-3">-->
                                            <!--    <label class="form-label">BL / NO:</label>-->
                                            <!--    <input type="text" name="bl_no" class="form-control" style="background: #eee; cursor: not-allowed;">-->
                                            <!--</div>-->

                                            <!-- Row 2 -->
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
                                                <label class="form-label">Consignee / Consigner:</label>
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
                                                <label class="form-label">Party Type:</label>
                                                <select name="party_type" class="form-control">
                                                    <option value="">Select</option>
                                                    <option value="shipper">Shipper</option>
                                                    <option value="consignee">Consignee</option>
                                                    <option value="other">Others</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Shipper Inv No:</label>
                                                <input type="text" name="full_invoice_no" id="full_invoice_no" class="form-control">
                                            </div>  
                                            
                                            
                                            <!--<div class="col-md-4 mb-3">-->
                                            <!--    <label class="form-label">Ovrs Exch. Rate:</label>-->
                                            <!--    <input type="text" name="overseas_exchange_rate" class="form-control">-->
                                            <!--</div>-->

                                            <!-- Row 5 -->
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
                                                <label class="form-label">GST Type: <span class="text-danger">*</span></label>
                                                <select name="gst_type" class="form-control">
                                                    <option value="">Select</option>
                                                    <option value="local">LOCAL</option>
                                                    <option value="otherState">Other State</option>
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
                                                <input type="text" name="sales_person" class="form-control" value="{{ old('sales_person', $salesInvoice->sales_person ?? '') }}" style="background: #eee;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Vessel Name/Air Line:</label>
                                                <input type="text" name="vessel_name" class="form-control" value="{{ old('vessel_name', $salesInvoice->vessel_name ?? '') }}" style="background: #eee;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">AWB / BL NO:</label>
                                                <input type="text" name="awb_bl_no" class="form-control" value="{{ old('awb_bl_no', $salesInvoice->awb_bl_no ?? '') }}" style="background: #eee;">
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
                                                <input type="text" name="sale_purchase" class="form-control" value="SALE">
                                            </div>
                                        </div>

                                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                            <!--<button type="button" class="btn btn-danger btn-sm">Add Charges From Performa</button>-->
                                            <button type="button" class="btn btn-warning btn-sm">Cancel</button>
                                            <!--<a href="#" type="button" class="btn btn-success btn-sm">Print</a>-->
                                            <button type="submit" class="btn btn-primary btn-sm">Save</button>
                                        </div>
                                
                                    </form>
                                    <div id="form-messages"></div>
                                </div>
                            </div>
                        </div>


                        <h4>Charges</h4>
                        <hr>
                        <div class="form-validation">
                            <!--container-->
                            <form class="needs-validation" id="salesInvoiceSection" method="POST" action="{{ route('sales-invoices.salesInvoiceChargeContainer') }}">
                                @csrf
                                <input type="hidden" name="sales_invoice_id" id="salesInvoice_id">
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
                                                <select name="currency" class="form-control wide me-2 select2">
                                                    <option value="">Select currency</option>
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
                                            <label class="col-sm-3 col-form-label">Rate Per Unit/Per Cont/Per Kg:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="per_unit" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <!--total unit-->
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
                                                <input type="text" name="freight" id="freight" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    <!-- GST -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Output GST %:</label>
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
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Charge Description:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="charge_desc" class="form-control">
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
                                                <input type="text" name="total" id="total" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <button type="submit" class="btn btn-primary btn-sm">ADD/UPDATE CHARGES</button>
                                </div>
                            </form>
                            
                            <div id="purchaseInvoiceChargesList"></div>

                        </div>

                        <h4>File Upload</h4>
                        <hr>
                        <div class="form-validation">
                            <form class="ajaxFileUpload" data-related="sales_invoice" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="file_related" value="sales_invoice">
                                <input type="hidden" name="sales_invoice_id" class="sales_invoice_id">
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

                            <!--<form method="post" id="searchSalesInvoiceFile">-->
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
@include('admin-main.admin.commonModelForms.modelPartyDetails')

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

            
            // Get job no data according to Bl
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

            $('#searchForm').on('submit', function (e) {
                e.preventDefault(); // prevent default form submission
        
                const data = $(this).serialize();
               
                $.ajax({
                    url: '{{ route('sales-invoices.getJobNo') }}',
                    type: 'POST',
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function (res) {
                        if (res.status === 'success') {
                            $('#option').html(res.result);
                            $('input[name="Inv_cat"]').val(res.Inv_cat);
                        }
                    },
                    error: function (xhr) {
                        console.log('Error:', xhr.responseText);
                    }
                });
            });
            
            // According to job no get data
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
                
                // Proceed with your AJAX
                $.ajax({
                    url: '{{ route("sales-invoices.getInvoiceRecord") }}',
                    type: 'post',
                    data: { id: selectedValue, type: type },
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function (res) {
                        console.log("res res res", res);
                        if (res.status == 'success') {
                            if (res.result.voyage_no) {
                                $('input[name="voyage_code"]').val(res.result.voyage_no);
                            }
                            $('input[name="pod"]').val(res.result.discharge_port_name.port_name);
                            $('input[name="pol"]').val(res.loadingPort);
                            $('input[name="pkgType"]').val(res.packageName);
                            $('input[name="packages"]').val(res.packageValue);
                            $('input[name="bl_no"]').val(res.blNo);
                            $('input[name="container"]').val(res.result.container_id ?? 0);
                            $('input[name="consignee"]').val(res.consigneeName);
                            $('input[name="full_invoice_no"]').val(res.result.customer_inv_no);
                            $('input[name="cbm"]').val(res.result.cbm ?? 0);
                            $('input[name="gross_weight"]').val(res.result.gross_weight);
                            $('input[name="awb_bl_no"]').val(res.mbl_no);
                            $('input[name="hawb_no"]').val(res.result.hawb_no);
                            $('input[name="hbl_no"]').val(res.result.hbl_no);
                            $('input[name="mawb_no"]').val(res.result.mawb_no);
                            $('input[name="vessel_name"]').val(res.airLineAndVasselName);
                            if (res.result.chg_weight) {
                                $('input[name="chargeable_weight"]').val(res.result.chg_weight);
                            } else {
                                $('input[name="chargeable_weight"]').val(res.result.chargable_weight);
                            }
                        
                            $('input[name="shipping_no"]').val(res.sbill_no);
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
            
            // First form submit
            $("#salesInvoiceForm").on("submit", function (e) {
                e.preventDefault();
                
                let form = $(this);
                let url = form.attr("action");
                let formData = form.serialize();
        
                $.ajax({
                    type: "POST",
                    url: url,
                    data: formData,
                    success: function (response) {
                        if(response.status){
                            $("#form-messages").html(
                                `<div class="alert alert-success">${response.message}</div>`
                            );
                            $('#salesInvoice_id').val(response.salesInvoice.id);
                            $('.sales_invoice_id').val(response.salesInvoice.id);
                            $('#gst_type').val(response.salesInvoice.gst_type);
                        }else{
                            $("#form-messages").html(
                                `<div class="alert alert-danger">${response.message}</div>`
                            );
                        }
                        // Optionally reset form
                        // form.trigger("reset");
                    },
                    error: function (xhr) {
                        let errorHtml = '<div class="alert alert-danger"><ul>';
                    
                        if (xhr.status === 422) {
                            // Try to parse errors from responseJSON
                            let errors = xhr.responseJSON?.errors;
                    
                            if (errors) {
                                $.each(errors, function (key, value) {
                                    errorHtml += "<li>" + value[0] + "</li>";
                                    // Highlight input
                                    $("[name='" + key + "']").addClass("is-invalid");
                                });
                            } else if (xhr.responseJSON?.message) {
                                // Sometimes Laravel returns a single message instead of errors array
                                errorHtml += "<li>" + xhr.responseJSON.message + "</li>";
                            } else {
                                errorHtml += "<li>Validation failed. Please check your input.</li>";
                            }
                        } else if (xhr.responseJSON?.message) {
                            // Non-422 errors with JSON message
                            errorHtml += "<li>" + xhr.responseJSON.message + "</li>";
                        } else {
                            // Fallback for HTML errors or other
                            errorHtml += "<li>Something went wrong. Status: " + xhr.status + "</li>";
                        }
                        errorHtml += "</ul></div>";
                        $("#form-messages").html(errorHtml);
                    },

                });
            });
            
            $('#salesInvoiceSection').on('submit', function(e) {
                e.preventDefault(); // prevent normal form submission
            
                let form = $(this);
                let url = form.attr('action');
                let formData = form.serialize();
            
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val()
                    },
                    success: function(res) {
                        if(res.status) {
                            form[0].reset();
                            
                            let charge = res.salesInvoiceContainer;
                            
                            // console.log('test', charge); return;
                            
                            let html = `
                            <div class="alert alert-secondary">
                            <strong>${charge.charge_name.charge_name || '-'}</strong> |
                               AMOUNT: ${charge.amount || 0} |
                               TOTAL : ${charge.total || 0} |
                               GST: ${charge.gst || 0}%
                            </div>
                             `;
                            $('#purchaseInvoiceChargesList').prepend(html);
                            
                        } else {
                            alert(res.message); // show error
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>
    
    <script>
        //mourya
        $(document).ready(function(){
            
            // --- Calculate TDS amount ---
            function calculateTds() {
                let tdsPercent = $('#tds').val() || 0;
                let amountWithoutTax = $('#freight').val() || 0;
                let total = $('#total').val() || 0;
                
                let tdsAmount = (amountWithoutTax * tdsPercent) / 100;
                $('#tds_amount').val(tdsAmount.toFixed(3))
                    .css('background', '#ded9d9')
                    .prop('readonly', true);
        
                let finalTotal = total - tdsAmount;
                let roundedTotal = finalTotal;
                $('#total').val(roundedTotal);
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
                let gstType = $('select[name="gst_type"]').val();        // local / otherState
                let perUnit = parseFloat($('input[name="per_unit"]').val()) || 0;
                let totalUnit = parseFloat($('input[name="total_unit"]').val()) || 0;
                let exchRate = parseFloat($('input[name="exchange_rate"]').val()) || 0;
                let gstPercent = parseFloat($('input[name="gst"]').val()) || 0;
                let gstApplicable = $('select[name="gst_applicable"]').val(); // Y or N
        
                //  Calculate Total Charges
                let totalCharges = perUnit * totalUnit * exchRate;
                $('input[name="freight"]').val(totalCharges.toFixed(3))
                    .css('background', '#ded9d9');
        
                // Reset GST fields first
                let cgst = 0, sgst = 0, igst = 0;
        
                // Apply GST only if applicable
                if (gstApplicable === 'Y') {
                    if (gstType === 'local') {
                        cgst = (gstPercent / 2) * totalCharges / 100;
                        sgst = (gstPercent / 2) * totalCharges / 100;
                        igst = 0;
                    } else if (gstType === 'otherState' || gstType === 'otherstate' || gstType === 'other_state') {
                        igst = (gstPercent * totalCharges) / 100;
                        cgst = 0;
                        sgst = 0;
                    }
                } else {
                    gstPercent = 0;
                    cgst = 0;
                    sgst = 0;
                    igst = 0;
                }
                
                let amountWithGST = totalCharges + cgst + sgst + igst;
        
                // Update GST fields
                $('input[name="cgst"]').val(cgst.toFixed(3))
                    .css('background', '#ded9d9');
                $('input[name="sgst"]').val(sgst.toFixed(3))
                    .css('background', '#ded9d9');
                $('input[name="igst"]').val(igst.toFixed(3))
                    .css('background', '#ded9d9');
        
                //  Amount before GST = totalCharges
                $('input[name="amount"]').val(amountWithGST.toFixed(3))
                    .css('background', '#ded9d9');
        
                //  Calculate Total (including GST)
                let total = totalCharges + cgst + sgst + igst;
                $('input[name="total"]').val(total.toFixed(3))
                    .css('background', '#ded9d9');
        
                // Recalculate TDS automatically if entered
                if ($('#tds').val() !== '') {
                    calculateTds();
                }
            }
        });
        
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
        document.getElementById('searchSalesInvoiceFile').addEventListener('submit', function(e) {
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
@endpush
