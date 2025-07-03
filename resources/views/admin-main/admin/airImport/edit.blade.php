@extends('admin-main.layouts.default')
@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="#">Edit MAWB</a></li>
        </ol>
        <a href="{{ url('admin/air-imports') }}" class="text-primary"><- Go Back</a>
    </div>

    @if (session('success'))        
        <div class="alert alert-success">{{session('success')}}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <div class="mb-2">{{$error}}</div>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container-fluid p-2">
        <div class="row">
            <div class="col-lg-12">
                <div class="card px-3">
                    <div class="card-header">
                        <h4 class="card-title">Edit MAWB</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-validation">
                            <form method="POST" action="{{ route('air-imports.update', $airImport->id) }}" novalidate>
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <h4>MAWB Details</h4>
                                    <hr>
                                    <input type="hidden" name="mawb_details" value="0">
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">MAWB No:<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" value="{{$airImport->mawb_no}}" name="mawb_no">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">MAWB Date:<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" value="{{$airImport->mawb_date}}" name="mawb_date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Flight No:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" value="{{$airImport->flight_no}}" name="flight_no">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Flight Date:</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" value="{{$airImport->flight_date}}" name="flight_date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">IGM No:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" value="{{$airImport->igm_no}}" name="igm_no">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">IGM Date:</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" value="{{$airImport->igm_date}}" name="igm_date">
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
                                                        <option value="{{$port->id}}" {{$port->id == $airImport->origin_port? 'selected' : ''}}>{{$port->port_name}}</option>
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
                                                        <option value="{{$port->id}}" {{$port->id == $airImport->dest_port? 'selected' : ''}}>{{$port->port_name}}</option>
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
                                                <select class="form-control"  name="shipment">
                                                    <option value="" class="has-arrow">Select</option>
                                                    <option value="1" {{$airImport->shipment == 1? 'selected' : ''}}>Total</option>
                                                    <option value="2" {{$airImport->shipment == 2? 'selected' : ''}}>Part</option>
                                                    <option value="3" {{$airImport->shipment == 3? 'selected' : ''}}>Split</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Packages:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" value="{{$airImport->package}}" name="package">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Weight:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" value="{{$airImport->weight}}" name="weight">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Description:</label>
                                            <div class="col-sm-9">
                                                <input type="text" disabled style="cursor: not-allowed; background-color:#e9ecef;" class="form-control" value="{{$airImport->description}}" name="description" value="CONSOLIDATION">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Username:</label>
                                            <div class="col-sm-9">
                                                <input type="text" disabled style="cursor: not-allowed; background-color:#e9ecef;" class="form-control" value="" name="username">
                                            </div>
                                        </div>
                                    </div>                                 
                                    
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Remarks/BOE:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" value="{{$airImport->remark}}" name="remark">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">FullJobno:</label>
                                            <div class="col-sm-9">
                                                <input type="text" disabled style="cursor: not-allowed; background-color:#e9ecef;" class="form-control" value="{{$airImport->full_job_no}}" name="full_job_no">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">ETA Date:</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" value="{{$airImport->eta_date}}" name="eta_date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">ETD Date:</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" value="{{$airImport->etd_date}}" name="etd_date">
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    <h4>HAWB Details</h4>
                                    <hr>                        
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Job No:<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <select class="default-select form-control wide me-2 select2"
                                                    name="job_no">
                                                    <option value="">select</option>
                                                    @foreach ($jobNumbers as $jobNumber)
                                                        <option value="{{$jobNumber->id}}" {{$jobNumber->id == $airImport->job_no ? 'selected' : '' }}>{{$jobNumber->job_no}}</option>
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
                                                <input type="text" class="form-control" value="{{$airImport->hbl_no}}" name="hbl_no">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">HBL Date:<span
                                                    class="text-danger" >*</span></label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" value="{{$airImport->hbl_date}}" name="hbl_date">
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
                                                        <option value="{{$port->id}}" {{$port->id == $airImport->hawb_origin_port? 'selected' : ''}}>{{$port->port_name}}</option>
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
                                                        <option value="{{$port->id}}" {{$port->id == $airImport->hawb_dest_port? 'selected' : ''}}>{{$port->port_name}}</option>
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
                                                <select class="form-control"  name="hawb_shipment">
                                                    <option value="" class="has-arrow">Select</option>
                                                    <option value="1" {{$airImport->hawb_shipment == 1? 'selected' : ''}}>Total</option>
                                                    <option value="2" {{$airImport->hawb_shipment == 2? 'selected' : ''}}>Part</option>
                                                    <option value="3" {{$airImport->hawb_shipment == 3? 'selected' : ''}}>Split</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Packages:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" value="{{$airImport->package}}" name="package">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Weight:<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" value="{{$airImport->weight}}" name="weight">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Enquiry Reference No:</label>
                                            <div class="col-sm-9">
                                                <input type="date" disabled style="cursor: not-allowed; background-color:#e9ecef;" class="form-control"  name="enquiry_reference_no">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Description:<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control h-100" id="validationCustom04" rows="2" name="descriptions">{{$airImport->descriptions}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">fullJobno:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control"  name="full_job_no" disabled style="cursor: not-allowed; background-color:#e9ecef;">
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    <hr>
                                    <div class="col-xl-6 col-xxl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Freight:</label>
                                            <div class="col-sm-9">
                                                <select class="form-control"  name="freight">
                                                    <option value="" class="has-arrow">Select</option>
                                                    <option value="C" {{$airImport->freight == 'C' ? 'selected' : '' }}>C</option>
                                                    <option value="P" {{$airImport->freight == 'P' ? 'selected' : '' }}>P</option>
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
                                                    <option value="AED" {{$airImport->currency == 'AED' ? 'selected' : '' }}>AED</option>
                                                    <option value="AUD" {{$airImport->currency == 'AUD' ? 'selected' : '' }}>AUD</option>
                                                    <option value="BGN" {{$airImport->currency == 'BGN' ? 'selected' : '' }}>BGN</option>
                                                    <option value="BRL" {{$airImport->currency == 'BRL' ? 'selected' : '' }}>BRL</option>
                                                    <option value="CAD" {{$airImport->currency == 'CAD' ? 'selected' : '' }}>CAD</option>
                                                    <option value="CHF" {{$airImport->currency == 'CHF' ? 'selected' : '' }}>CHF</option>
                                                    <option value="CNY" {{$airImport->currency == 'CNY' ? 'selected' : '' }}>CNY</option>
                                                    <option value="CSD" {{$airImport->currency == 'CSD' ? 'selected' : '' }}>CSD</option>
                                                    <option value="CZK" {{$airImport->currency == 'CZK' ? 'selected' : '' }}>CZK</option>
                                                    <option value="DKK" {{$airImport->currency == 'DKK' ? 'selected' : '' }}>DKK</option>
                                                    <option value="EEK" {{$airImport->currency == 'EEK' ? 'selected' : '' }}>EEK</option>
                                                    <option value="EGP" {{$airImport->currency == 'EGP' ? 'selected' : '' }}>EGP</option>
                                                    <option value="EUR" {{$airImport->currency == 'EUR' ? 'selected' : '' }}>EUR</option>
                                                    <option value="GBP" {{$airImport->currency == 'GBP' ? 'selected' : '' }}>GBP</option>
                                                    <option value="HKD" {{$airImport->currency == 'HKD' ? 'selected' : '' }}>HKD</option>
                                                    <option value="HRK" {{$airImport->currency == 'HRK' ? 'selected' : '' }}>HRK</option>
                                                    <option value="HUF" {{$airImport->currency == 'HUF' ? 'selected' : '' }}>HUF</option>
                                                    <option value="IDR" {{$airImport->currency == 'IDR' ? 'selected' : '' }}>IDR</option>
                                                    <option value="ILS" {{$airImport->currency == 'ILS' ? 'selected' : '' }}>ILS</option>
                                                    <option value="INR" {{$airImport->currency == 'INR' ? 'selected' : '' }}>INR</option>
                                                    <option value="ISK" {{$airImport->currency == 'ISK' ? 'selected' : '' }}>ISK</option>
                                                    <option value="JPY" {{$airImport->currency == 'JPY' ? 'selected' : '' }}>JPY</option>
                                                    <option value="MXP" {{$airImport->currency == 'MXP' ? 'selected' : '' }}>MXP</option>
                                                    <option value="MYR" {{$airImport->currency == 'MYR' ? 'selected' : '' }}>MYR</option>
                                                    <option value="NOK" {{$airImport->currency == 'NOK' ? 'selected' : '' }}>NOK</option>
                                                    <option value="NZD" {{$airImport->currency == 'NZD' ? 'selected' : '' }}>NZD</option>
                                                    <option value="PHP" {{$airImport->currency == 'PHP' ? 'selected' : '' }}>PHP</option>
                                                    <option value="PLN" {{$airImport->currency == 'PLN' ? 'selected' : '' }}>PLN</option>
                                                    <option value="ROL" {{$airImport->currency == 'ROL' ? 'selected' : '' }}>ROL</option>
                                                    <option value="RUR" {{$airImport->currency == 'RUR' ? 'selected' : '' }}>RUR</option>
                                                    <option value="SAR" {{$airImport->currency == 'SAR' ? 'selected' : '' }}>SAR</option>
                                                    <option value="SEK" {{$airImport->currency == 'SEK' ? 'selected' : '' }}>SEK</option>
                                                    <option value="SGD" {{$airImport->currency == 'SGD' ? 'selected' : '' }}>SGD</option>
                                                    <option value="SIT" {{$airImport->currency == 'SIT' ? 'selected' : '' }}>SIT</option>
                                                    <option value="SKK" {{$airImport->currency == 'SKK' ? 'selected' : '' }}>SKK</option>
                                                    <option value="THB" {{$airImport->currency == 'THB' ? 'selected' : '' }}>THB</option>
                                                    <option value="TRL" {{$airImport->currency == 'TRL' ? 'selected' : '' }}>TRL</option>
                                                    <option value="TWD" {{$airImport->currency == 'TWD' ? 'selected' : '' }}>TWD</option>
                                                    <option value="UAH" {{$airImport->currency == 'UAH' ? 'selected' : '' }}>UAH</option>
                                                    <option value="US" {{$airImport->currency == 'US' ? 'selected' : '' }}>US</option>
                                                    <option value="USD" {{$airImport->currency == 'USD' ? 'selected' : '' }}>USD</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Exch.Rate:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" value="{{$airImport->exchange_rate}}" name="exchange_rate">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">CC Perc.:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" value="{{$airImport->cc_perc}}" name="cc_perc">
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
                                                    <option value="AED" {{$airImport->cc_currency == 'AED' ? 'selected' : '' }}>AED</option>
                                                    <option value="AUD" {{$airImport->cc_currency == 'AUD' ? 'selected' : '' }}>AUD</option>
                                                    <option value="BGN" {{$airImport->cc_currency == 'BGN' ? 'selected' : '' }}>BGN</option>
                                                    <option value="BRL" {{$airImport->cc_currency == 'BRL' ? 'selected' : '' }}>BRL</option>
                                                    <option value="CAD" {{$airImport->cc_currency == 'CAD' ? 'selected' : '' }}>CAD</option>
                                                    <option value="CHF" {{$airImport->cc_currency == 'CHF' ? 'selected' : '' }}>CHF</option>
                                                    <option value="CNY" {{$airImport->cc_currency == 'CNY' ? 'selected' : '' }}>CNY</option>
                                                    <option value="CSD" {{$airImport->cc_currency == 'CSD' ? 'selected' : '' }}>CSD</option>
                                                    <option value="CZK" {{$airImport->cc_currency == 'CZK' ? 'selected' : '' }}>CZK</option>
                                                    <option value="DKK" {{$airImport->cc_currency == 'DKK' ? 'selected' : '' }}>DKK</option>
                                                    <option value="EEK" {{$airImport->cc_currency == 'EEK' ? 'selected' : '' }}>EEK</option>
                                                    <option value="EGP" {{$airImport->cc_currency == 'EGP' ? 'selected' : '' }}>EGP</option>
                                                    <option value="EUR" {{$airImport->cc_currency == 'EUR' ? 'selected' : '' }}>EUR</option>
                                                    <option value="GBP" {{$airImport->cc_currency == 'GBP' ? 'selected' : '' }}>GBP</option>
                                                    <option value="HKD" {{$airImport->cc_currency == 'HKD' ? 'selected' : '' }}>HKD</option>
                                                    <option value="HRK" {{$airImport->cc_currency == 'HRK' ? 'selected' : '' }}>HRK</option>
                                                    <option value="HUF" {{$airImport->cc_currency == 'HUF' ? 'selected' : '' }}>HUF</option>
                                                    <option value="IDR" {{$airImport->cc_currency == 'IDR' ? 'selected' : '' }}>IDR</option>
                                                    <option value="ILS" {{$airImport->cc_currency == 'ILS' ? 'selected' : '' }}>ILS</option>
                                                    <option value="INR" {{$airImport->cc_currency == 'INR' ? 'selected' : '' }}>INR</option>
                                                    <option value="ISK" {{$airImport->cc_currency == 'ISK' ? 'selected' : '' }}>ISK</option>
                                                    <option value="JPY" {{$airImport->cc_currency == 'JPY' ? 'selected' : '' }}>JPY</option>
                                                    <option value="MXP" {{$airImport->cc_currency == 'MXP' ? 'selected' : '' }}>MXP</option>
                                                    <option value="MYR" {{$airImport->cc_currency == 'MYR' ? 'selected' : '' }}>MYR</option>
                                                    <option value="NOK" {{$airImport->cc_currency == 'NOK' ? 'selected' : '' }}>NOK</option>
                                                    <option value="NZD" {{$airImport->cc_currency == 'NZD' ? 'selected' : '' }}>NZD</option>
                                                    <option value="PHP" {{$airImport->cc_currency == 'PHP' ? 'selected' : '' }}>PHP</option>
                                                    <option value="PLN" {{$airImport->cc_currency == 'PLN' ? 'selected' : '' }}>PLN</option>
                                                    <option value="ROL" {{$airImport->cc_currency == 'ROL' ? 'selected' : '' }}>ROL</option>
                                                    <option value="RUR" {{$airImport->cc_currency == 'RUR' ? 'selected' : '' }}>RUR</option>
                                                    <option value="SAR" {{$airImport->cc_currency == 'SAR' ? 'selected' : '' }}>SAR</option>
                                                    <option value="SEK" {{$airImport->cc_currency == 'SEK' ? 'selected' : '' }}>SEK</option>
                                                    <option value="SGD" {{$airImport->cc_currency == 'SGD' ? 'selected' : '' }}>SGD</option>
                                                    <option value="SIT" {{$airImport->cc_currency == 'SIT' ? 'selected' : '' }}>SIT</option>
                                                    <option value="SKK" {{$airImport->cc_currency == 'SKK' ? 'selected' : '' }}>SKK</option>
                                                    <option value="THB" {{$airImport->cc_currency == 'THB' ? 'selected' : '' }}>THB</option>
                                                    <option value="TRL" {{$airImport->cc_currency == 'TRL' ? 'selected' : '' }}>TRL</option>
                                                    <option value="TWD" {{$airImport->cc_currency == 'TWD' ? 'selected' : '' }}>TWD</option>
                                                    <option value="UAH" {{$airImport->cc_currency == 'UAH' ? 'selected' : '' }}>UAH</option>
                                                    <option value="US" {{$airImport->cc_currency == 'US' ? 'selected' : '' }}>US</option>
                                                    <option value="USD" {{$airImport->cc_currency == 'USD' ? 'selected' : '' }}>USD</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">CCExch.Rt:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" value="{{$airImport->cc_exch_rate}}" name="cc_exch_rate">
                                            </div>
                                        </div>
                                    </div>                                    
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Caf Perc.:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" value="{{$airImport->caf_perc}}" name="caf_perc">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Chg. Wt:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" value="{{$airImport->chg_weight}}" name="chg_weight">
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
                                                       <option value="{{$party->id}}" {{$party->id == $airImport->consignee_id ? 'selected' : ''}}>{{$party->party_name}}</option>
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
                                                <select class="default-select form-control wide me-2 select2"
                                                    name="shipper_id">
                                                    <option value="">select</option>
                                                   @foreach ($parties as $party)
                                                       <option value="{{$party->id}}" {{$party->id == $airImport->shipper_id ? 'selected' : ''}}>{{$party->party_name}}</option>
                                                   @endforeach
                                                </select>
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
                                                       <option value="{{$party->id}}" {{$party->id == $airImport->billing_party_id ? 'selected' : ''}}>{{$party->party_name}}</option>
                                                   @endforeach
                                                </select>
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
                                            <label class="col-sm-3 col-form-label">Sales_Person:<span
                                                class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <select class="default-select form-control wide me-2 select2"
                                                    name="sales_person_id">
                                                    <option value="">select</option>
                                                    @foreach ($parties as $party)
                                                        <option value="{{$party->id}}" {{$party->id == $airImport->sales_person_id ? 'selected' : ''}}>{{$party->party_name}}</option>
                                                    @endforeach
                                                </select>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Insurance:</label>
                                            <div class="col-sm-9">
                                                <input type="text" disabled style="cursor: not-allowed; background-color:#e9ecef;" class="form-control"  name="insurance">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">F.Premium.Amt:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" value="{{$airImport->fpa_amount}}" name="fpa_amount">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Bill of Entry:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" value="{{$airImport->bill_of_entry}}" name="bill_of_entry">
                                            </div>
                                        </div>
                                    </div>                                    
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Transportation:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control"  disabled style="cursor: not-allowed; background-color:#e9ecef;" name="transportation">
                                            </div>
                                        </div>
                                    </div>                              
                                                                    
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Transportation Details:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" value="{{$airImport->transportation_details}}" name="transportation_details">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Clearance:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control"  disabled style="cursor: not-allowed; background-color:#e9ecef;" name="clearance">
                                            </div>
                                        </div>
                                    </div>                                    
                                </div>

                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <a href="{{route('air-imports.index')}}" class="btn btn-warning" type="button">Cancle</a>
                                    <button class="btn btn-primary" type="submit">Save</button>
                                </div>
                               
                            </form>
                        </div>                        
                    </div>

                    <div class="row px-2">
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
                </div>
                
                <div id="searchFile"></div>
                
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
                    <form id="oceanVslForm">
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Port Code:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" >
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Port Name:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" >
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">EDI Code:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" >
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">JNPT Code:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" >
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">NSICT Code:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" >
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">NSICT GROUP Code:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" >
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">GTI Code:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" >
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">GTI GROUP Code:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" >
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">NSI GT Code:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" >
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
                                <input type="text" class="form-control" >
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Party Name:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" >
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Address Line 1:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" >
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Address Line 2:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" >
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Address Line 3:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" >
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Address Line 4:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" >
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">City:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" >
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Pincode:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" >
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
                                <input type="text" class="form-control" >
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Tel / Contact No:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" >
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Email:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" >
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">GSTIN NO:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" >
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">PAN No:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" >
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">CIN No:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" >
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Credit Days:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" >
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">TDS %:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" >
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
            const id = formData.get('search_query');

            fetch("{{ route('multi-file-upload.searchFile') }}", {
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
        
        function deleteSearchFile(id) {
            if (!confirm('Are you sure you want to delete this file?')) return;
        
            fetch(`/multi-file-upload/${id}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
                }
            })
            .then(response => {
                if (!response.ok) throw new Error('Failed to delete file.');
                return response.json();
            })
            .then(data => {
                alert(data.message);
                clearSearchFile();
                location.reload();
            })
            .catch(error => {
                console.error('Delete error:', error);
                alert('Error deleting file.');
            });
        }
    </script>
@endpush
