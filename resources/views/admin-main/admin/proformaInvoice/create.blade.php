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
                                    <form method="POST" action="{{route('proforma-invoices.store')}}" class="needs-validation">
                                        @csrf
                                        <input type="hidden" name="Inv_cat" />
                                        <div class="row">
                                            <!-- Row 1 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Job No: <span class="text-danger">*</span></label>
                                                <select name="job_no" id="option" class="form-control" required>
                                                    <option value="">Select</option>
                                                    {{-- Populate with @foreach if needed --}}
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Voyage Code:</label>
                                                <input type="text" name="voyage_date" class="form-control" style="background: #eee; cursor: not-allowed;">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">POD:</label>
                                                <input type="text" name="pod" class="form-control" style="background: #eee; cursor: not-allowed;">
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
                                                <label class="form-label">Party Type:</label>
                                                <select name="party_type" class="form-control">
                                                    <option value="">Select</option>
                                                    <option value="customer">Customer</option>
                                                    <option value="other">Other Billing Party</option>
                                                </select>
                                            </div>

                                            <!-- Row 4 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Invoice Type:</label>
                                                <select name="invoice_type" class="form-control">
                                                    <option value="">Select</option>
                                                    <option value="1">PURCHASE(RS)</option>
                                                    <option value="2">PURCHASE(OVR.)</option>
                                                    <option value="3">PURCHASE(CN.RS.)</option>
                                                    <option value="4">PURCHASE(CN.OVR.)</option>                                                   
                                                </select>
                                            </div>                                  
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Account No:</label>
                                                <select name="bank_id" class="form-control">
                                                    <option value="">Select</option>
                                                    @foreach ($account_numbers as $account_number)
                                                        <option value="{{$account_number->id}}" >{{$account_number->account_no}}</option>
                                                    @endforeach
                                                </select>
                                            </div>  
                                            <!-- Row 5 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Billing Party:</label>
                                                <select name="billing_party_id" class="form-control">
                                                    <option value="">Select</option>
                                                    @foreach ($parties as $party)
                                                        <option value="{{$party->id}}">{{$party->party_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">GST Type:</label>
                                                <select name="gst_type" class="form-control">
                                                    <option value="">Select</option>
                                                    <option value="local">LOCAL</option>
                                                    <option value="outstation">OUTSTATION</option>
                                                </select>
                                            </div>
                                            

                                            <!-- Row 6 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Inv No:</label>
                                                <input type="text" name="invoice_no" class="form-control">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Inv Date:</label>
                                                <input type="date" name="invoice_date" class="form-control" value="{{ date('Y-m-d') }}">
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
                            <form class="needs-validation" method="POST" action="{{ route('proforma-invoices.proformaInvoiceCharge') }}">
                                @csrf
                                <input type="hidden" name="proformaInvoice_id" value="{{session('id')}}">
                                <div class="row">
                                    <!-- Charge Name -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Charge_Name:<span class="text-danger">*</span></label>
                                            <div class="col-sm-9 d-flex align-items-center gap-2">
                                                <select name="charge_name" class="default-select form-control wide me-2">
                                                    <option value="">select</option>
                                                    @foreach ($charges as $charge)
                                                        <option value="{{$charge->id}}">{{$charge->charge_name}}</option>
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
                                                    <option value="INR">INR</option>
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
                                                <select name="rate_basis" class="default-select form-control wide me-2">
                                                    <option value="">select</option>
                                                    <option value="LUMPSUM">LUMPSUM</option>
                                                    <option value="CBMWISE">CBMWISE</option>
                                                    <option value="PERCONT">PERCONT</option>
                                                    <option value="GWTWISE">GWTWISE</option>
                                                    <option value="CHGWTWISE">CHGWTWISE</option>
                                                    <option value="PERUNIT">PERUNIT</option>
                                                </select>
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

                                    <!-- Exchange Rate -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Exch.Rate:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="exchange_rate" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Freight -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Freight:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="freight" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- TDS -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">TDS %:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="tds" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- GST -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">GST%:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="gst" class="form-control">
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

                                    <!-- GST Applicable -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">GST(Y/N):</label>
                                            <div class="col-sm-9">
                                                <select name="gst_applicable" class="default-select form-control wide me-2">
                                                    <option value="">select</option>
                                                    <option value="Y">Y</option>
                                                    <option value="N">N</option>
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

                                    <!-- Amount -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Amount:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="amount" class="form-control">
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
                                                <select name="cc_apply" class="default-select form-control wide me-2">
                                                    <option value="">select</option>
                                                    <option value="N">N</option>
                                                    <option value="Y">Y</option>
                                                </select>
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

                                    <!-- CGST -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">CGST:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="cgst" class="form-control">
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

                                    <!-- SAC Code -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">SAC_Code:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="sac_code" class="form-control">
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
                                    <button type="submit" class="btn btn-primary btn-sm">ADD/UPDATE CHARGES</button>
                                </div>
                            </form>
                        </div>


                        <h4>File Upload</h4>
                        <hr>
                        <div class="form-validation">
                            <form class="needs-validation" action="{{route('file-upload.updateFileUpload')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="file_related" value="proforma_invoice">
                                <div class="row">
                                    <div class="col-xl-9">
                                        <div class="mb-3 row row">
                                            <label class="col-sm-3 col-form-label">Choose File:<span
                                                class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <div class="d-flex">
                                                    <input type="file" name="file" class="form-control me-2" />
                                                    <button type="submit" class="btn btn-warning btn-sm" style="width: 200px;">UploadFile</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                
                                </div>
                            </form>

                            <form method="post" id="searchProformaInvoiceFile">
                                @csrf
                                <div class="col-xl-9">
                                    <div class="mb-3 row row">
                                        <label class="col-sm-3 col-form-label">Find PDF File:<span
                                            class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <div class="d-flex">
                                                <select class="default-select form-control wide me-2"
                                                    placeholder="Select" name="search_query">
                                                        <option value="">select</option>
                                                        @foreach ($files as $file)
                                                            <option value="{{$file->id}}">{{$file->file_name}}</option>
                                                        @endforeach
                                                </select>
                                                <button type="submit" class="btn btn-primary btn-sm">Search</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div id="searchFile"></div>
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

    <!-- Add New Charge Details -->
    <div class="modal fade" id="AddNewChargeDetailsModal" tabindex="-1" aria-labelledby="oceanVslModalLabel"
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
                            <label for="password" class="col-sm-4 col-form-label">Party Code:<span
                                class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Charge Name:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Tally Ledger(Name):<span
                                class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Rs/Other Currency(I/U):</label>
                            <div class="col-sm-8">
                                <select class="default-select form-control wide me-2" placeholder="Select"></select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Type CHG:<span
                                class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <select class="default-select form-control wide me-2" placeholder="Select"></select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">GST:</label>
                            <div class="col-sm-8">
                                <select class="default-select form-control wide me-2" placeholder="Select"></select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">GST %:<span
                                class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <select class="default-select form-control wide me-2" placeholder="Select"></select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Formula (Y/N):</label>
                            <div class="col-sm-8">
                                <select class="default-select form-control wide me-2" placeholder="Select"></select>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Limit:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Percentage:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">SAC Code:<span
                                class="text-danger">*</span></label>
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
        $(document).ready(function(){


            $('input[name="search_by"]').on('change', function() {
                $('#searchForm').submit();
            });

            $('#searchForm').on('submit', function(e){
                e.preventDefault(); // prevent default form submission
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

                let selectedValue = $(this).val();
                let type = $('#option option:selected').data('type'); 


                $.ajax({
                    url: '{{route("sales-invoices.getInvoiceRecord")}}',
                    type: 'post',
                    data: {'id': selectedValue, 'type' : type},
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(res){
                        if(res.status == 'success'){
                            if(res.result.voyage_no){
                                $('input[name="voyage"]').val(res.result.voyage_no);
                            }
                            $('input[name="pod"]').val(res.deliveryPort);
                            $('input[name="container"]').val(res.result.container_id ?? 0);
                            $('input[name="consignee"]').val(res.result.consignee_id);
                            $('input[name="cbm"]').val(res.result.cbm ?? 0);
                            $('input[name="gross_weight"]').val(res.result.gross_weight);
                            if(res.result.chg_weight){
                                $('input[name="chargeable_weight"]').val(res.result.chg_weight);
                            }else{
                                $('input[name="chargeable_weight"]').val(res.result.chargable_weight);           
                            }
                            
                        }
                    },
                    error: function(xhr){
                        console.log('Error:', xhr.responseText);
                    }
                })
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
@endpush
