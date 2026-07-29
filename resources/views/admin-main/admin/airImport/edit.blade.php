@extends('admin-main.layouts.default')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active"><a href="#">Edit Air Import BL</a></li>
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
                        <form method="POST" autocomplete="off" action="{{ route('air-imports.update', $airImport->id) }}" novalidate>
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <h4>General Details</h4>
                                <hr>
                                <input type="hidden" name="mawb_details" value="0">

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Job No:<span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select class="form-control wide me-2 select2"
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
                                        <label class="col-sm-3 col-form-label">FullJobno:</label>
                                        <div class="col-sm-9">
                                            <input type="hidden" name="full_job_no" id="full_job_no_hidden_field" value="{{$airImport->full_job_no}}"/>
                                            <input type="text" disabled style="cursor: not-allowed; background-color:#e9ecef;" class="form-control" value="{{$airImport->full_job_no}}" name="full_job_no">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">MAWB No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{$airImport->mawb_no}}" name="mawb_no">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">MAWB Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy"  placeholder="dd/mm/yy"  class="form-control" value="{{$airImport->mawb_date}}" name="mawb_date">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">HBL No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{$airImport->hbl_no}}" name="hbl_no">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">HBL Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy"  class="form-control" value="{{$airImport->hbl_date}}" name="hbl_date">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Booking No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="booking_no" value="{{ $airImport->booking_no }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Booking Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control" name="booking_date" value="{{ $airImport->booking_date }}">
                                        </div>
                                    </div>
                                </div>
                                
                                
                                
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Air Line Name 1:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{$airImport->airLineName}}" name="airLineName">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Flight No 1:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{$airImport->flight_no}}" name="flight_no">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Flight Date 1:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy"  class="form-control" value="{{$airImport->flight_date}}" name="flight_date">
                                        </div>
                                    </div>
                                </div>
                                <!--flight details 2-->
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Air Line Name 2:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="airLineName2" value="{{$airImport->airLineName2}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Flight No 2:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="flight_no2" value="{{$airImport->flight_no2}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Flight Date 2:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy" class="form-control" name="flight_date2" value="{{$airImport->flight_date2}}">
                                        </div>
                                    </div>
                                </div>
                                <!--flight details 3-->
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Air Line Name 3:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="airLineName3" value="{{$airImport->airLineName3}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Flight No 3:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="flight_no3" value="{{$airImport->flight_no3}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Flight Date 3:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy" class="form-control" name="flight_date3" value="{{$airImport->flight_date3}}">
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
                                            <input type="date" placeholder="dd/mm/yy"  class="form-control" value="{{$airImport->igm_date}}" name="igm_date">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">ETA Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy"  class="form-control" value="{{$airImport->eta_date}}" name="eta_date">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">SOB Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy"  class="form-control" value="{{$airImport->sobDate}}" name="sobDate">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">ETD Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy"  class="form-control" value="{{$airImport->etd_date}}" name="etd_date">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Movement:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="default-select form-control wide me-2"
                                                placeholder="Select" name="movement">
                                                <option value="">select</option>
                                                <option value="AIRPORTTOAIRPORT" {{$airImport->movement == 'AIRPORTTOAIRPORT'? 'selected' : ''}}>AIR PORT TO AIR PORT</option>
                                                <option value="AIRPORTTODOOR" {{$airImport->movement == 'AIRPORTTODOOR'? 'selected' : ''}}>AIR PORT TO DOOR</option>
                                                <option value="DOORTODOOR" {{$airImport->movement == 'DOORTODOOR'? 'selected' : ''}}>DOOR TO DOOR</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Port of Loading (Origin):<span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="form-control wide me-2 select2"
                                                name="loading_port_id">
                                                <option value="">Select Org Port</option>
                                                @foreach ($ports as $port)
                                                <option value="{{$port->id}}" {{$port->id == $airImport->loading_port_id? 'selected' : ''}}>{{$port->port_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Port of Destination:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="form-control wide me-2 select2"
                                                name="destination_port_id">
                                                <option value="">Select Dest_Port</option>
                                                @foreach ($ports as $port)
                                                <option value="{{$port->id}}" {{$port->id == $airImport->destination_port_id? 'selected' : ''}}>{{$port->port_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Port of Discharge:<span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="form-control wide me-2 select2" name="discharge_port_id">
                                                <option value="">Select Discharge Port</option>
                                                @foreach ($ports as $port)
                                                <option value="{{$port->id}}" {{$port->id == $airImport->discharge_port_id? 'selected' : ''}}>{{ $port->port_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Port of Delivery:<span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="form-control wide me-2 select2" name="delivery_port_id">
                                                <option value="">Select delivery Port</option>
                                                @foreach ($ports as $port)
                                                <option value="{{$port->id}}" {{$port->id == $airImport->delivery_port_id? 'selected' : ''}}>{{ $port->port_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-xl-6 col-xxl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Shipment:</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="shipment">
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
                                        <label class="col-sm-3 col-form-label">Package:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{$airImport->package}}" name="package">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Pkg Type:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select name="package_id" class="select2 form-control wide me-2">
                                                <option value="">Select Pkg Type</option>
                                                @foreach ($packages as $package)
                                                <option value="{{$package->id}}" {{$airImport->package_id == $package->id ? 'selected' : ''}}>{{$package->package_code}}</option>
                                                @endforeach
                                            </select>
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
                                        <label class="col-sm-3 col-form-label">Gross Weight:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{$airImport->gross_weight}}" name="gross_weight">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Net Weight:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{$airImport->net_weight}}" name="net_weight">
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
                                        <label class="col-sm-3 col-form-label">Forwarder:</label>
                                        <div class="col-sm-9">
                                            <select class="select2 form-control wide me-2" name="forwarder_id" placeholder="Select">
                                                <option value="">Select Forwarder</option>
                                                @foreach ($forwarders as $party)
                                                <option value="{{$party->id}}" {{$airImport->forwarder_id == $party->id ? "selected" : ''}}>{{$party->party_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Remarks:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{$airImport->remarks}}" name="remarks" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Nature and Quantity of Goods:</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control h-100" id="" rows="2" name="nature_qty_goods">{{$airImport->nature_qty_goods}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Flight Status:</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control h-100" name="flight_status" rows="3">{{$airImport->flight_status}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!--<div class="col-xl-6">-->
                            <!--    <div class="mb-3 row">-->
                            <!--        <label class="col-sm-3 col-form-label">Remarks/BOE:</label>-->
                            <!--        <div class="col-sm-9">-->
                            <!--            <input type="text" class="form-control" value="{{$airImport->remark}}" name="remark">-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--</div>-->

                            <!--<div class="row">-->
                            <!--    <h4>HAWB Details</h4>-->
                            <!--    <hr>-->
                            <!--    <div class="col-xl-6">-->
                            <!--        <div class="mb-3 row">-->
                            <!--            <label class="col-sm-3 col-form-label">HBL No:<span-->
                            <!--                    class="text-danger">*</span></label>-->
                            <!--            <div class="col-sm-9">-->
                            <!--                <input type="text" class="form-control" value="{{$airImport->hbl_no}}" name="hbl_no">-->
                            <!--            </div>-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--    <div class="col-xl-6">-->
                            <!--        <div class="mb-3 row">-->
                            <!--            <label class="col-sm-3 col-form-label">HBL Date:<span-->
                            <!--                    class="text-danger">*</span></label>-->
                            <!--            <div class="col-sm-9">-->
                            <!--                <input type="date" placeholder="dd/mm/yy"  class="form-control" value="{{$airImport->hbl_date}}" name="hbl_date">-->
                            <!--            </div>-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--    <div class="col-xl-6">-->
                            <!--        <div class="mb-3 row">-->
                            <!--            <label class="col-sm-3 col-form-label">Loading Port:</label>-->
                            <!--            <div class="col-sm-9 d-flex align-items-center">-->
                            <!--                <select class="form-control wide me-2 select2"-->
                            <!--                    name="hawb_loading_port_id">-->
                            <!--                    <option value="">Select Origin Port</option>-->
                            <!--                    @foreach ($ports as $port)-->
                            <!--                    <option value="{{$port->id}}" {{$port->id == $airImport->hawb_loading_port_id? 'selected' : ''}}>{{$port->port_name}}</option>-->
                            <!--                    @endforeach-->
                            <!--                </select>-->
                            <!--            </div>-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--    <div class="col-xl-6">-->
                            <!--        <div class="mb-3 row">-->
                            <!--            <label class="col-sm-3 col-form-label">Destination Port:</label>-->
                            <!--            <div class="col-sm-9 d-flex align-items-center">-->
                            <!--                <select class="form-control wide me-2 select2"-->
                            <!--                    name="hawb_destination_port_id">-->
                            <!--                    <option value="">Select Dest_Port</option>-->
                            <!--                    @foreach ($ports as $port)-->
                            <!--                    <option value="{{$port->id}}" {{$port->id == $airImport->hawb_destination_port_id ? 'selected' : ''}}>{{$port->port_name}}</option>-->
                            <!--                    @endforeach-->
                            <!--                </select>-->
                            <!--            </div>-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--    <div class="col-xl-6">-->
                            <!--        <div class="mb-3 row">-->
                            <!--            <label class="col-sm-3 col-form-label">Discharge Port:<span-->
                            <!--                    class="text-danger">*</span></label>-->
                            <!--            <div class="col-sm-9 d-flex align-items-center">-->
                            <!--                <select class="form-control wide me-2 select2"-->
                            <!--                    name="hawb_discharge_port_id">-->
                            <!--                    <option value="">Select Dest_Port</option>-->
                            <!--                    @foreach ($ports as $port)-->
                            <!--                    <option value="{{$port->id}}" {{$port->id == $airImport->hawb_discharge_port_id ? 'selected' : ''}}>{{ $port->port_name }}</option>-->
                            <!--                    @endforeach-->
                            <!--                </select>-->
                            <!--                <button type="button" class="btn btn-sm btn-outline-primary"-->
                            <!--                    data-bs-toggle="modal" data-bs-target="#addNewPortDetails">-->
                            <!--                    <i class="bi bi-plus-lg">+</i>-->
                            <!--                </button>-->
                            <!--            </div>-->
                            <!--        </div>-->
                            <!--    </div>-->
                                
                            <!--    <div class="col-xl-6 col-xxl-6">-->
                            <!--        <div class="mb-3 row">-->
                            <!--            <label class="col-sm-3 col-form-label">Shipment:</label>-->
                            <!--            <div class="col-sm-9">-->
                            <!--                <select class="form-control" name="hawb_shipment">-->
                            <!--                    <option value="" class="has-arrow">Select</option>-->
                            <!--                    <option value="1" {{$airImport->hawb_shipment == 1? 'selected' : ''}}>Total</option>-->
                            <!--                    <option value="2" {{$airImport->hawb_shipment == 2? 'selected' : ''}}>Part</option>-->
                            <!--                    <option value="3" {{$airImport->hawb_shipment == 3? 'selected' : ''}}>Split</option>-->
                            <!--                </select>-->
                            <!--            </div>-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--    <div class="col-xl-6">-->
                            <!--        <div class="mb-3 row">-->
                            <!--            <label class="col-sm-3 col-form-label">Packages:</label>-->
                            <!--            <div class="col-sm-9">-->
                            <!--                <input type="text" class="form-control" value="{{$airImport->package}}" name="hawb_package">-->
                            <!--            </div>-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--    <div class="col-xl-6">-->
                            <!--        <div class="mb-3 row">-->
                            <!--            <label class="col-sm-3 col-form-label">Weight:<span-->
                            <!--                    class="text-danger">*</span></label>-->
                            <!--            <div class="col-sm-9">-->
                            <!--                <input type="text" class="form-control" value="{{$airImport->hawb_weight}}" name="hawb_weight">-->
                            <!--            </div>-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--    <div class="col-xl-6">-->
                            <!--        <div class="mb-3 row">-->
                            <!--            <label class="col-sm-3 col-form-label">Enquiry Reference No:</label>-->
                            <!--            <div class="col-sm-9">-->
                            <!--                <input type="date" placeholder="dd/mm/yy"  disabled style="cursor: not-allowed; background-color:#e9ecef;" class="form-control" name="enquiry_reference_no">-->
                            <!--            </div>-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--    <div class="col-xl-6">-->
                            <!--        <div class="mb-3 row">-->
                            <!--            <label class="col-sm-3 col-form-label">Description:<span-->
                            <!--                    class="text-danger">*</span></label>-->
                            <!--            <div class="col-sm-9">-->
                            <!--                <textarea class="form-control h-100" id="validationCustom04" rows="2" name="descriptions">{{$airImport->descriptions}}</textarea>-->
                            <!--            </div>-->
                            <!--        </div>-->
                            <!--    </div>-->
                           
                            <!--</div>-->
                            
                            <div class="row">
                                <h4>Air Waybill Details</h4>
                                <hr>
                                
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">By First Carrier:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="by_first_carrier" value="{{ $airImport->by_first_carrier }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">TO:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="to_air" value="{{ $airImport->to_air }}">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">By(second):</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="by_second" value="{{ $airImport->by_second }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">TO(second):</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="to_air_sec" value="{{ $airImport->to_air_sec }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">By(third):</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="by_third" value="{{ $airImport->by_third }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">TO(third):</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="to_air_third" value="{{ $airImport->to_air_third }}">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Declared Value for Carrier:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="declared_value_by_carrier" value="{{ $airImport->declared_value_by_carrier }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Declared Value for Customs:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="declared_value_by_customs" value="{{ $airImport->declared_value_by_customs }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Routing and Destination:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="routing_destination" value="{{ $airImport->routing_destination }}">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">CHGS Code:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="chgs_code" value="{{ $airImport->chgs_code }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Reference Number:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="reference_number" value="{{ $airImport->reference_number }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Shipper or his Agent:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="shipper_agent" value="{{ $airImport->shipper_agent }}">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Executed By:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="executed_by" value="{{$airImport->executed_by}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Rate/Charges:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="rate_charges" value="{{ $airImport->rate_charges }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Total Other Charges Due Agent:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="other_charges_due_agent" value="{{ $airImport->other_charges_due_agent }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Total Other Charges Due Carrier:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="other_charges_due_carrier" value="{{ $airImport->other_charges_due_carrier }}">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Other Charges:</label>
                                        <div class="col-sm-9">
                                            <textarea type="text" class="form-control" name="other_charges">{{ $airImport->other_charges }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <hr>
                                <div class="col-xl-6 col-xxl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Freight:<span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="freight">
                                                <option value="" class="has-arrow">Select</option>
                                                <option value="C" {{$airImport->freight == 'C' ? 'selected' : '' }}>C</option>
                                                <option value="P" {{$airImport->freight == 'P' ? 'selected' : '' }}>P</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Currency:<span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select class="form-control wide me-2 select2"
                                                name="currency">
                                                <option value="">Select Currency</option>
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
                                        <label class="col-sm-3 col-form-label">Chargeable. Wt:<span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{$airImport->chargable_weight}}" name="chargable_weight">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Iata Code:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="iata_code" value="{{$airImport->iata_code}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Issued By:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="issued_by" value="{{$airImport->issued_by}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Handling Information:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="handling_information" value="{{$airImport->handling_information}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Accounting Information:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="accounting_information" value="{{$airImport->accounting_information}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Account No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="account_no" value="{{$airImport->account_no}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Issue Carrier Agent Name(IATA):</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="select2 form-control wide me-2" name="agent_id" placeholder="Select">
                                                <option value="">Select</option>
                                                @foreach ($parties->whereIn('party_type', 13) as $party)
                                                <option value="{{$party->id}}" {{$airImport->agent_id == $party->id ? "selected" : ''}}>{{$party->party_name}}</option>
                                                @endforeach
                                            </select>
                                            <!--<button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#partyDetailsModal" data-target-field="overseas_agent_id">-->
                                            <!--    <i class="bi bi-plus-lg">+</i>-->
                                            <!--</button>-->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Consignee:<span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <input type="hidden" name="consignee_id" id="" value="{{$airImport->consignee_id}}"/>
                                            <select class="form-control wide me-2 select2"
                                                name="consignee_id" style="cursor: not-allowed; background-color:#e9ecef;" class="form-control">
                                                <option value="">Select Consignee</option>
                                                @foreach ($parties->where('party_type', 1) as $party)
                                                <option value="{{$party->id}}" {{$party->id == $airImport->consignee_id ? 'selected' : ''}}>{{$party->party_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Shipper:<span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="form-control wide me-2 select2"
                                                name="shipper_id">
                                                <option value="">Select Shipper</option>
                                                @foreach ($exportParites as $party)
                                                <option value="{{$party->id}}" {{$party->id == $airImport->shipper_id ? 'selected' : ''}}>{{$party->party_name}}</option>
                                                @endforeach
                                            </select>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Notify:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="select2 form-control wide me-2" name="notify_id" placeholder="Select">
                                                <option value="">Select Notify</option>
                                                @foreach ($parties as $party)
                                                <option value="{{$party->id}}" {{$airImport->notify_id == $party->id ? "selected" : ''}}>{{$party->party_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Notify 2:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="select2 form-control wide me-2" name="notify2_id" placeholder="Select">
                                                <option value="">Select Notify 2</option>
                                                @foreach ($parties as $party)
                                                <option value="{{$party->id}}" {{$airImport->notify2_id == $party->id ? "selected" : ''}}>{{$party->party_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Billing_Party:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="form-control wide me-2 select2"
                                                name="billing_party_id">
                                                <option value="">Select Billing_Party</option>
                                                @foreach ($parties->where('party_type', 10) as $party)
                                                <option value="{{$party->id}}" {{$party->id == $airImport->billing_party_id ? 'selected' : ''}}>{{$party->party_name}}</option>
                                                @endforeach
                                            </select>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">CHA:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="form-control wide me-2 select2"
                                                name="cha_party_id">
                                                <option value="">Select CHA</option>
                                                @foreach ($parties->where('party_type', 3) as $party)
                                                <option value="{{$party->id}}" {{$party->id == $airImport->cha_party_id ? 'selected' : ''}}>{{$party->party_name}}</option>
                                                @endforeach
                                            </select>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Sales_Person:<span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select class="form-control wide me-2 select2"
                                                name="sales_person_id">
                                                <option value="">Select Sales_Person</option>
                                                @foreach ($salePersons as $salePerson)
                                                <option value="{{$salePerson->id}}" {{$salePerson->id == $airImport->sales_person_id ? 'selected' : ''}}>{{$salePerson->name}}</option>
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
                                            <input type="text" disabled style="cursor: not-allowed; background-color:#e9ecef;" class="form-control" name="insurance">
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
                                            <input type="text" class="form-control" value="{{$airImport->transportation_details}}" name="transportation_details">
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
                                            <select class="form-control wide me-2 select2"
                                                placeholder="Select" name="cc_currency">
                                                <option value="">Select CC Curr</option>
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
                            </div>
                            
                            <div class="row">
                                
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Inv No / Inv Dt:</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control h-100" placeholder="AHP-101 K78 / 12-08-2025" name="customer_inv_no" rows="2">{{$airImport->customer_inv_no}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Check List Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control" name="check_list_date" value="{{$airImport->check_list_date}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Bill of entry no/date:</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control h-100" placeholder="DDP-178 L78 / 24-10-2025" name="bill_of_entry_date" rows="2">{{$airImport->bill_of_entry_date}}</textarea>
                                        </div>
                                    </div>
                                </div>
                          
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Out Off Charge Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control" name="out_off_charge_date" value="{{$airImport->out_off_charge_date}}">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Arrival Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control" name="arrival_date" value="{{$airImport->arrival_date}}">
                                        </div>
                                    </div>
                                </div>
                                
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('hawb.draft.import.option',$airImport->id ) }}" class="btn-primary btn-sm text-light" type="button">HAWB Bill</a>
                                <a href="{{ route('awb.draft.import.option',$airImport->id ) }}" class="btn-primary btn-sm text-light" type="button">AirWay Bill PRINT</a>
                                <a href="{{route('air-imports.index')}}" class="btn btn-warning btn-sm" type="button">Cancle</a>
                                <button class="btn btn-primary btn-sm" type="submit">Save</button>
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
                            <input type="hidden" name="job_no" id="job_no_hidden" value="{{ $airImport->job_no }}"> 
                            <div class="row">
                                <div class="col-xl-9">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Choose File:</label>
                                        <div class="col-sm-9">
                                            <div class="d-flex">
                                                <input type="file" class="form-control me-2" name="file[]" multiple />
                                                <button type="submit" class="btn btn-warning btn-sm" style="width:180px;">UploadFile</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!--<form id="AirImportFileForm" method="post">-->
                        <!--    @csrf-->
                        <!--    <div class="col-xl-9">-->
                        <!--        <div class="mb-3 row">-->
                        <!--            <label class="col-sm-3 col-form-label">Find PDF File:</label>-->
                        <!--            <div class="col-sm-9">-->
                        <!--                <div class="d-flex">-->
                        <!--                    <select class="form-control wide me-2 select2"-->
                        <!--                        placeholder="Select" name="search_query">-->
                        <!--                        <option value="">select</option>-->
                        <!--                        @foreach ($files as $file)-->
                        <!--                        <option value="{{$file->id}}">{{$file->file_name}}</option>-->
                        <!--                        @endforeach-->
                        <!--                    </select>-->
                        <!--                    <button type="submit" class="btn btn-primary btn-sm" style="width:180px;">Search</button>-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</form>-->
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>File ID</th>
                                        <th>File Name</th>
                                        <th>Download PDF</th>
                                        <th>Remove PDF</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($files as $file)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$file->file_name}}</td>
                                            <td><a href="{{route('multi-file-upload.downloadFile', $file->id)}}" target="_blank" class="text-success">Download</a></td>
                                            <td id="delete_td">
                                                <button type="button"
                                                        class="btn btn-sm btn-danger"
                                                        onclick="deleteSearchFile({{ $file->id }})">
                                                    ×
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!--<div id="searchFile"></div>-->

        </div>
    </div>
</div>
</div>

@include('admin-main.admin.commonModelForms.addNewPort_modal')

@include('admin-main.admin.commonModelForms.modelPartyDetails')
<!-- Add new Package Modal -->
@include('admin-main.admin.commonModelForms.addNewPackageModel')
<!-- Add new export Modal -->
@include('admin-main.admin.commonModelForms.addExportPartiesModel')

@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        // flatpickr("input[type='date']", {
        //     dateFormat: "d/m/Y",
        //     allowInput: true
        // });
        $('.select2').select2({
            // placeholder: 'Select a value',
            // allowClear: true,
            width: '100%'
        })
    })
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
        if (!confirm('Are you sure you want to delete this file?')) {
            return;
        }
    
        fetch(`/multi-file-upload/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
    
            alert(data.message);
    
            // Remove this for now
            // clearSearchFile();
    
            window.location.reload();
        })
        .catch(error => {
            console.error(error);
        });
    }

    //add new port
    $('#portDetailsModel').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: "{{ route('new-port.store') }}", // route name
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                // Add the new option to select dropdowns
                /* $('select[name="sales_person_id"]').each(function() {
                    $(this).append(`<option value="${response.id}" selected>${response.name}</option>`);
                }); */

                // Close modal and reset form
                $('#portDetailsModel')[0].reset();
                $('#addNewPortDetails').modal('hide');
            },
            error: function(xhr) {
                alert('Failed to add new port');

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
    
    $('#exportPartyDetails form').on('submit', function(e) {
        e.preventDefault();
    
        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                if (response.success) {
                    const partyId = response.party.id;
                    const partyName = response.party.name;
                    
                    const mawbNo = response.data.mawb_no;
    //             // âœ… Put mawb_no into third form hidden field
                    $('#job_no_hidden').val(mawbNo);

    
                    const dropdown = $('select[name="shipper_id"]'); 
                    if (dropdown.length) {
                        const newOption = new Option(partyName, partyId, true, true);
                        dropdown.append(newOption).trigger('change');
                    }
    
                    // reset + close modal
                    $('#exportPartyDetails form')[0].reset();
                    $('#exportPartyDetails').modal('hide');
                }
            },
            error: function(xhr) {
                let messages = '';
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    Object.values(xhr.responseJSON.errors).forEach(function(errArr) {
                        messages += errArr.join("\n") + "\n";
                    });
                } else {
                    messages = "Failed to add export party.";
                }
                alert(messages);
            }
        });
    });

    // party details model
    // $('#modelPartyDetails').on('submit', function(e) {
    //     e.preventDefault();

    //     $.ajax({
    //         url: "{{ route('new-party.store') }}",
    //         method: 'POST',
    //         data: $(this).serialize(),
    //         success: function(response) {
    //             if (response.status) {
    //                 var newOption1 = new Option(response.data.party_name, response.data.id, true, true);
    //                 var newOption2 = new Option(response.data.party_name, response.data.id, true, true);
    //                 var newOption3 = new Option(response.data.party_name, response.data.id, true, true);

    //                 $('select[name="consignee_id"]').append(newOption1).trigger('change');
    //                 $('select[name="shipper_id"]').append(newOption2).trigger('change');
    //                 $('select[name="billing_party_id"]').append(newOption3).trigger('change');

    //                 // Reset and hide modal
    //                 $('#modelPartyDetails')[0].reset();
    //                 $('#partyDetailsModal').modal('hide');
    //             }
    //         },
    //         error: function(xhr) {
    //             alert('Failed to add party details');

    //             if (xhr.responseJSON && xhr.responseJSON.errors) {
    //                 let messages = '';
    //                 Object.values(xhr.responseJSON.errors).forEach(function(errorArray) {
    //                     messages += errorArray.join("\n") + "\n";
    //                 });
    //                 alert(messages);
    //             }
    //         }
    //     });
    // });
    
    let targetField = null;

    $('#partyDetailsModal').on('show.bs.modal', function (event) {
        const button = $(event.relatedTarget); 
        targetField = button.data('target-field'); // e.g. 'consignee_id' or 'billing_party_id'
    });
    $('#modelPartyDetails').on('submit', function(e) {
        e.preventDefault();
    
        $.ajax({
            url: "{{ route('new-party.store') }}",
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                if (response.success) {
                    const partyId = response.party.id;
                    const partyName = response.party.name;
    
                    if (targetField) {
                        const select = $('select[name="' + targetField + '"]');
                        if (select.length) {
                            const newOption = new Option(partyName, partyId, true, true);
                            select.append(newOption).trigger('change');
                        }
                    }
                }
    
                // Reset and hide modal
                $('#modelPartyDetails')[0].reset();
                $('#partyDetailsModal').modal('hide');
            },
            error: function(xhr) {
                alert('Failed to add party details');
    
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

    // add new package
    $('#addNewPackageModel').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: "{{ route('new-package.store') }}", // route name
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                // const newOption = new Option(response.package.package_code, response.package.id, true, true);
                const newOption = new Option(response.package.package_code, response.package.package_code, true, true);
                $('select[name="package"]').append(newOption).trigger('change');
                    
                $('#addNewPackageModel')[0].reset();
                $('#AddNewPackageModal').modal('hide');
            },
            error: function(xhr) {
                alert('Failed to add package');

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