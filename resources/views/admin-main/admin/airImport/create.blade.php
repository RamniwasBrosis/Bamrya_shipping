@extends('admin-main.layouts.default')
@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="#">Add New MAWB</a></li>
        </ol>
        <a href="{{ url('admin/air-imports') }}" class="text-primary"><- Go Back</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container-fluid p-2">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add New MAWB</h4>
                    </div>
                    <div class="card-body">
                        <h4>MAWB Details</h4>
                        <hr>
                        <div class="form-validation">
                            <form method="POST" action="{{ route('air-imports.store') }}" novalidate>
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="mawb_details" value="0">
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">MAWB No:<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="mawb_no">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">MAWB Date:<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" name="mawb_date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Flight No:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="flight_no">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Flight Date:</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" name="flight_date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">IGM No:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="igm_no">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">IGM Date:</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" name="igm_date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Org Port:<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="default-select form-control wide me-2 select2"
                                                    name="origin_port">
                                                    <option value="">select</option>
                                                    @foreach ($ports as $port)
                                                        <option value="{{$port->id}}">{{$port->port_name}}</option>
                                                    @endforeach
                                                </select>
                                                <button type="button" class="btn btn-sm btn-outline-primary"
                                                    data-bs-toggle="modal" data-bs-target="#addnewportDetailsModal">
                                                    <i class="bi bi-plus-lg">+</i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Dest_Port:<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="default-select form-control wide me-2 select2"
                                                   name="dest_port">
                                                   <option value="">select</option>
                                                    @foreach ($ports as $port)
                                                        <option value="{{$port->id}}">{{$port->port_name}}</option>
                                                    @endforeach
                                                </select>
                                                <button type="button" class="btn btn-sm btn-outline-primary"
                                                    data-bs-toggle="modal" data-bs-target="#addnewportDetailsModal">
                                                    <i class="bi bi-plus-lg">+</i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-xxl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Shipment:</label>
                                            <div class="col-sm-9">
                                                <select class="form-control select2" name="shipment">
                                                    <option value="" class="has-arrow">Select</option>
                                                    <option value="1">Total</option>
                                                    <option value="2">Part</option>
                                                    <option value="3">Split</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Packages:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="package">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Weight:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="weight">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Description:</label>
                                            <div class="col-sm-9">
                                                <input type="text" disabled style="cursor: not-allowed; background-color:#e9ecef;" class="form-control" name="description" value="CONSOLIDATION">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Username:</label>
                                            <div class="col-sm-9">
                                                <input type="text" disabled style="cursor: not-allowed; background-color:#e9ecef;" class="form-control" name="username">
                                            </div>
                                        </div>
                                    </div>                                 
                                    
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Remarks/BOE:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="remark">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">FullJobno:</label>
                                            <div class="col-sm-9">
                                                <input type="text" disabled style="cursor: not-allowed; background-color:#e9ecef;" class="form-control" name="full_job_no">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">ETA Date:</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" name="eta_date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">ETD Date:</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" name="etd_date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <a href="{{route('air-imports.index')}}" class="btn btn-warning" type="button">Cancle</a>
                                        <button class="btn btn-primary" type="submit">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>


                        <h4>HAWB Details</h4>
                        <hr>
                        <div class="form-validation">
                            <form class="needs-validation" novalidate method="POST" action="{{ route('air-imports.updateHawb') }}">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">MAWB No:<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <select class="default-select form-control wide me-2 select2 select2"
                                                    name="mawb_no">
                                                    <option value="">select</option>
                                                    @foreach ($airImports as $airImport)
                                                        <option value="{{$airImport->id}}">{{$airImport->mawb_no}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Job No:<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <select class="default-select form-control wide me-2 select2"
                                                    name="job_no" id="job_numbers">
                                                    <option value="">select</option>
                                                    @foreach ($job_numbers as $job_number)
                                                        <option value="{{$job_number->id}}">{{$job_number->job_no}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">HBL No:<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="hbl_no">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">HBL Date:<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" name="hbl_date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Origin Port:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="default-select form-control wide me-2 select2"
                                                    name="hawb_origin_port">
                                                    <option value="">select</option>
                                                    @foreach ($ports as $port)
                                                        <option value="{{$port->id}}">{{$port->port_name}}</option>
                                                    @endforeach

                                                </select>
                                                <button type="button" class="btn btn-sm btn-outline-primary"
                                                    data-bs-toggle="modal" data-bs-target="#addnewportDetailsModal">
                                                    <i class="bi bi-plus-lg">+</i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Dest_Port:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="default-select form-control wide me-2 select2"
                                                    name="hawb_dest_port">
                                                    <option value="">select</option>
                                                    @foreach ($ports as $port)
                                                        <option value="{{$port->id}}">{{$port->port_name}}</option>
                                                    @endforeach
                                                </select>
                                                <button type="button" class="btn btn-sm btn-outline-primary"
                                                    data-bs-toggle="modal" data-bs-target="#addnewportDetailsModal">
                                                    <i class="bi bi-plus-lg">+</i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-xxl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Shipment:</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="hawb_shipment ">
                                                    <option value="" class="has-arrow">Select</option>
                                                    <option value="1">Total</option>
                                                    <option value="2">Part</option>
                                                    <option value="3">Split</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Packages:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="hawb_package">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Weight:<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="hawb_weight">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Enquiry Reference No:</label>
                                            <div class="col-sm-9">
                                                <input type="date" disabled style="cursor: not-allowed; background-color:#e9ecef;" class="form-control" name="enquiry_reference_no">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Description:<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control h-100" id="validationCustom04" rows="2" name="descriptions"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">fullJobno:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="full_job_no" disabled style="cursor: not-allowed; background-color:#e9ecef;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <a href="{{route('air-imports.index')}}" class="btn btn-warning" type="button">Cancle</a>
                                        <button class="btn btn-primary" type="submit">ADD/UPDATE HAWB</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <hr>
                        <div class="form-validation">
                            <form class="needs-validation" novalidate method="POST" action="{{ route('air-imports.updateother') }}">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">MAWB No:<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <select class="default-select form-control wide me-2 select2"
                                                    name="mawb_no">
                                                    <option value="">select</option>
                                                    @foreach ($airImports as $airImport)
                                                        <option value="{{$airImport->id}}">{{$airImport->mawb_no}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-xxl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Freight:</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="freight">
                                                    <option value="" class="has-arrow">Select</option>
                                                    <option value="C">C</option>
                                                    <option value="P">P</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Currency:</label>
                                            <div class="col-sm-9">
                                                <select class="default-select form-control wide me-2 select2"
                                                    name="currency">
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
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Exch.Rate:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="exchange_rate">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">CC Perc.:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="cc_perc">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">CC Curr.:</label>
                                            <div class="col-sm-9">
                                                <select class="default-select form-control wide me-2 select2"
                                                    placeholder="Select" name="cc_currency">
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
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">CCExch.Rt:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="cc_exch_rate">
                                            </div>
                                        </div>
                                    </div>                                    
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Caf Perc.:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="caf_perc">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Chg. Wt:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="chg_weight">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Consignee:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="default-select form-control wide me-2 select2"
                                                   name="consignee_id">
                                                   <option value="">select</option>
                                                   @foreach ($parties as $party)
                                                       <option value="{{$party->id}}">{{$party->party_name}}</option>
                                                   @endforeach
                                                </select>
                                                <button type="button" class="btn btn-sm btn-outline-primary"
                                                    data-bs-toggle="modal" data-bs-target="#partyDetailsModal">
                                                    <i class="bi bi-plus-lg">+</i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Shipper:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="form-control wide me-2 select2"
                                                    name="shipper_id" id="shipper_id">
                                                    <option value="">select</option>
                                                   @foreach ($parties as $party)
                                                       <option value="{{$party->id}}">{{$party->party_name}}</option>
                                                   @endforeach
                                                </select>
                                                <button type="button" class="btn btn-sm btn-outline-primary"
                                                    data-bs-toggle="modal" data-bs-target="#partyDetailsModal">
                                                    <i class="bi bi-plus-lg">+</i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Billing_Party:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="default-select form-control wide me-2 select2"
                                                   name="billing_party_id">
                                                   <option value="">select</option>
                                                   @foreach ($parties as $party)
                                                       <option value="{{$party->id}}">{{$party->party_name}}</option>
                                                   @endforeach
                                                </select>
                                                <button type="button" class="btn btn-sm btn-outline-primary"
                                                    data-bs-toggle="modal" data-bs-target="#partyDetailsModal">
                                                    <i class="bi bi-plus-lg">+</i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Sales Person:<span
                                                class="text-danger">*</span></label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="default-select form-control wide me-2 select2"
                                                    name="sales_person_id">
                                                    <option value="">select</option>
                                                   @foreach ($parties as $party)
                                                       <option value="{{$party->id}}">{{$party->party_name}}</option>
                                                   @endforeach
                                                </select>
                                                <button type="button" class="btn btn-sm btn-outline-primary"
                                                 data-bs-toggle="modal" data-bs-target="#salespersonModal">
                                                    <i class="bi bi-plus-lg">+</i>
                                                </button>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Insurance:</label>
                                            <div class="col-sm-9">
                                                <input type="text" disabled style="cursor: not-allowed; background-color:#e9ecef;" class="form-control" name="insurance">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">F.Premium.Amt:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="fpa_amount">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Bill of Entry:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="bill_of_entry">
                                            </div>
                                        </div>
                                    </div>                                    
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Transportation:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" disabled style="cursor: not-allowed; background-color:#e9ecef;" name="transportation">
                                            </div>
                                        </div>
                                    </div>                              
                                                                    
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Transportation Details:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="transportation_details">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Clearance:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" disabled style="cursor: not-allowed; background-color:#e9ecef;" name="clearance">
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <button class="btn btn-primary" type="submit">Save Details</button>
                                </div>
                            </form> 
                        </div>
                        

                        <h4>File Upload</h4>
                        <hr>
                        <div class="form-validation">
                            <form class="needs-validation" action="{{route('multi-file-upload.updateFileUpload')}}" method="post" enctype="multipart/form-data">
                                @csrf 
                                <input type="hidden" name="file_related" value="air_import">
                                <div class="row">
                                    <div class="col-xl-9">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Choose File:</label>
                                            <div class="col-sm-9">
                                                <div class="d-flex">
                                                    <input type="file" class="form-control me-2" name="file[]" multiple />
                                                    <button type="submit" class="btn btn-warning" style="width:180px;">UploadFile</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                    
                                </div>
                            </form>
                            <form id="AirImportFileForm" method="post"> 
                                @csrf
                                <div class="col-xl-9">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Find PDF File:</label>
                                        <div class="col-sm-9">
                                            <div class="d-flex">
                                                <select class="default-select form-control wide me-2"
                                                    placeholder="Select" name="search_query">
                                                        <option value="">select</option>
                                                        @foreach ($files as $file)
                                                            <option value="{{$file->id}}">{{$file->file_name}}</option>
                                                        @endforeach
                                                </select>
                                                <button type="submit" class="btn btn-primary btn-sm" style="width:180px;">Search</button>
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
                    <form id="oceanVslForm" method="post" action="{{route('new-party.store')}}">
                        @csrf
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Party Code:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="party_code">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Party Name:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="party_name">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Address Line 1:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="address_1">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Address Line 2:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="address_2">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Address Line 3:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="address_3">
                            </div>
                        </div>
                        {{-- <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Address Line 4:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="">
                            </div>
                        </div> --}}
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">City:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="city">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Pincode:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="pincode">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Party Type:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <select class="default-select  form-control wide select2" name="party_type" placeholder="Select">
                                    <option value="">select</option>
                                    @foreach($party_lists as $party_list)
                                        <option value="{{$party_list->id}}">{{$party_list->party_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Contact Person:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="contact_person">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Tel / Contact No:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="tel_no">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Email:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="email">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">GSTIN NO:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="gstin">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">PAN No:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="pan_no">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">CIN No:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="cin_no">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Credit Days:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="credit_days">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">TDS %:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="tds_percent">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Status:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <select class="default-select  form-control wide" name="status" placeholder="Active">
                                    <option value="">select</option>
                                    <option value="1">Active</option>
                                    <option value="0">Deactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="d-grid d-md-flex justify-content-md-end">
                            <button class="btn btn-outline-primary" type="submit">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Port Details -->
    <div class="modal fade" id="addnewportDetailsModal" tabindex="-1" aria-labelledby="oceanVslModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="oceanVslModalLabel">Add New PORT</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="oceanVslForm" method="post" action="{{route('new-port.store')}}">
                        @csrf
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Port Code:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="port_code">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Port Name:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="port_name">
                            </div>
                        </div>
                        {{-- <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Address Line 1:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="">
                            </div>
                        </div> --}}
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">EDI Code:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="edi_code">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">JNPT Code:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="jnpt_code">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">NSICT Code:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nsict_code">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">NSICT GROUP Code:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nsict_group_code">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">GTI Code:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="gti_code">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">GTI GROUP Code:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="gti_group_code">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">NSI GT Code:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nsi_gt_code">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Status:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <select class="default-select  form-control wide" name="status">
                                    <option value="1">Active</option>
                                    <option value="0">Deactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="d-grid d-md-flex justify-content-md-end">
                            <button class="btn btn-outline-primary" type="submit">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    @include('admin-main.admin.addSalesPerson.salesperson_modal')


@endsection




@push('scripts')
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
    <script>
        (function() {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()

    </script>

    <script>
        document.getElementById('AirImportFileForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            fetch("{{ route('multi-file-upload.searchFile') }}", {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
                },
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                document.getElementById('searchFile').innerHTML = data;
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });

        function clearSearchFile() {
            document.getElementById("searchFile").innerHTML = "";
        }
        
        $('#job_numbers').on('change', function (e) {
            e.preventDefault();
        
            var selectNumber = $(this).val();
        
            if (selectNumber) {
                $.ajax({
                    url: '/get-job-details', // Update this URL based on your route
                    method: 'POST',
                    data: {
                        job_id: selectNumber,
                        _token: $('meta[name="csrf-token"]').attr('content') // CSRF token for Laravel
                    },
                    success: function (response) {
                        console.log(response);
                         // 1. Set the value
                            $('#shipper_id').val(response.job_party_id);
            
                            // 2. Trigger change for select2 or other plugin to update UI
                            $('#shipper_id').trigger('change');
            
                            // 3. If you're using Bootstrap Select
                            if ($('#shipper_id').hasClass('selectpicker')) {
                                $('#shipper_id').selectpicker('refresh');
                            }
                    },
                    error: function (xhr) {
                        console.log(xhr.responseText);
                    }
                });
            }
        });
        
        
        $('#salespersonForm').on('submit', function(e) {
            e.preventDefault();
        
            $.ajax({
                url: "{{ route('salesperson.store') }}", // route name
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    // Add the new option to select dropdowns
                    $('select[name="sales_person_id"]').each(function () {
                        $(this).append(`<option value="${response.id}" selected>${response.name}</option>`);
                    });
        
                    // Close modal and reset form
                    $('#salespersonForm')[0].reset();
                    $('#salespersonModal').modal('hide');
                },
                error: function(xhr) {
                    alert('Failed to add salesperson');
                
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
    </script>
    
    
@endpush
