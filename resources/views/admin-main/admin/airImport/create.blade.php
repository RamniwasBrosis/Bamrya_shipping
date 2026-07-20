@extends('admin-main.layouts.default')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active"><a href="#">Add New Air Import BL</a></li>
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
<div id="jobErrorBox" class="alert alert-danger" style="display:none;"></div>

<div class="container-fluid p-2">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <!--<div class="card-header">-->
                <!--    <h4 class="card-title">Add New MAWB</h4>-->
                <!--</div>-->
                <div id="alert-message" class="" role="alert">
                </div>
                <div class="card-body">
                    <h4>General Details</h4>
                    <hr>
                    <div class="form-validation">
                        <form id="mawbForm" method="post">
                            @csrf
                            <div class="row">
                                <input type="hidden" name="mawb_details" value="0">

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Job No:<span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select class="form-control wide me-2 select2"
                                                name="job_no" id="job_numbers">
                                                <option value="">select</option>
                                                @foreach ($job_numbers as $job_number)
                                                <option value="{{$job_number->id}}" data-jobno="{{ $job_number->job_no }}" data-jobActivity="{{ $job_number->job_activity }}" {{ old('job_numbers') == $job_number->id ? 'selected' : '' }}>{{ $job_number->job_no }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">FullJobno:</label>
                                        <div class="col-sm-9">
                                            <input type="hidden" name="full_job_no" id="full_job_no_hidden_field" />
                                            <input type="text" readonly style="cursor: not-allowed; background-color:#e9ecef;" class="form-control" id="full_job_no" name="full_job_no" value="{{ old('full_job_no') }}">
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">MAWB No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="mawb_no" value="{{ old('mawb_no') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">MAWB Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy" class="form-control" name="mawb_date"  value="{{ old('mawb_date') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">HAWB No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="hbl_no" value="{{ old('hbl_no') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">HAWB Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy" class="form-control" name="hbl_date" value="{{ old('hbl_date') }}">
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Booking No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="booking_no" value="{{ old('booking_no') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Booking Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy" class="form-control" name="booking_date" value="{{ old('booking_date') }}">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Air Line Name 1:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="airLineName" value="{{ old('airLineName') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Flight No 1:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="flight_no" value="{{ old('flight_no') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Flight Date 1:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy" class="form-control" name="flight_date" value="{{ old('flight_date') }}">
                                        </div>
                                    </div>
                                </div>
                                <!--flight details 2-->
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Air Line Name 2:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="airLineName2" value="{{ old('airLineName2') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Flight No 2:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="flight_no2" value="{{ old('flight_no2') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Flight Date 2:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy" class="form-control" name="flight_date2" value="{{ old('flight_date2') }}">
                                        </div>
                                    </div>
                                </div>
                                <!--flight details 3-->
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Air Line Name 3:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="airLineName3" value="{{ old('airLineName3') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Flight No 3:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="flight_no3" value="{{ old('flight_no3') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Flight Date 3:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy" class="form-control" name="flight_date3" value="{{ old('flight_date3') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">IGM No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="igm_no" value="{{ old('igm_no') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">IGM Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy" class="form-control" name="igm_date" value="{{ old('igm_date') }}">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">ETA Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy" class="form-control" name="eta_date" value="{{ old('eta_date') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">SOB Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy" class="form-control" name="sobDate" value="{{ old('sobDate') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">ETD Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy" class="form-control" name="etd_date" value="{{ old('etd_date') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Movement:<span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="form-control wide me-2"
                                                placeholder="Select" name="movement">
                                                <option value="">select</option>
                                                <option value="AIRPORTTOAIRPORT" {{ old('movement') == 'AIRPORTTOAIRPORT' ? 'selected' : '' }}>AIR PORT TO AIR PORT</option>
                                                <option value="AIRPORTTODOOR" {{ old('movement') == 'CY/CFS' ? 'selected' : '' }}>AIR PORT TO DOOR</option>
                                                <option value="DOORTODOOR" {{ old('movement') == 'CFS/CY' ? 'selected' : '' }}>DOOR TO DOOR</option>
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
                                                <option value="{{ $port->id }}" {{ old('loading_port_id') == $port->id ? 'selected' : '' }}>
                                                    {{ $port->port_name }}
                                                </option>
                                                <!-- <option value="{{$port->id}}">{{$port->port_name}}</option> -->
                                                @endforeach
                                            </select>
                                            <button type="button" class="btn btn-sm btn-outline-primary" data-target-select="loading_port_id"
                                                data-bs-toggle="modal" data-bs-target="#addNewPortDetails">
                                                <i class="bi bi-plus-lg">+</i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Port of Destination:<span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="form-control wide me-2 select2" name="destination_port_id">
                                                <option value="">Select Dest_Port</option>
                                                @foreach ($ports as $port)
                                                <option value="{{$port->id}}" {{ old('destination_port_id') == $port->id ? 'selected' : '' }}>{{ $port->port_name }}</option>
                                                @endforeach
                                            </select>
                                            <button type="button" class="btn btn-sm btn-outline-primary" data-target-select="destination_port_id"
                                                data-bs-toggle="modal" data-bs-target="#addNewPortDetails">
                                                <i class="bi bi-plus-lg">+</i>
                                            </button>
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
                                                <option value="{{$port->id}}" {{ old('discharge_port_id') == $port->id ? 'selected' : '' }}>{{ $port->port_name }}</option>
                                                @endforeach
                                            </select>
                                            <button type="button" class="btn btn-sm btn-outline-primary" data-target-select="discharge_port_id"
                                                data-bs-toggle="modal" data-bs-target="#addNewPortDetails">
                                                <i class="bi bi-plus-lg">+</i>
                                            </button>
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
                                                <option value="{{$port->id}}" {{ old('delivery_port_id') == $port->id ? 'selected' : '' }}>{{ $port->port_name }}</option>
                                                @endforeach
                                            </select>
                                            <button type="button" class="btn btn-sm btn-outline-primary" data-target-select="delivery_port_id"
                                                data-bs-toggle="modal" data-bs-target="#addNewPortDetails">
                                                <i class="bi bi-plus-lg">+</i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-xl-6 col-xxl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Shipment:</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="shipment">
                                                <option value="" class="has-arrow">Select</option>
                                                <option value="1" {{ old('shipment') == 'Total' ? 'selected' : '' }}>Total</option>
                                                <option value="2" {{ old('shipment') == 'Part' ? 'selected' : '' }}>Part</option>
                                                <option value="3" {{ old('shipment') == 'Split' ? 'selected' : '' }}>Split</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Package:<span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="package" value="{{ old('package') }}">
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Pkg Type:<span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select name="package_id" class="form-control wide me-2 select2">
                                                <option value="">Select Pkg Type</option>
                                                @foreach ($packages as $packages)
                                                <option value="{{$packages->id}}" {{ old('package_id') == $packages->id ? 'selected' : '' }}>{{$packages->package_code}}</option>
                                                @endforeach
                                            </select>
                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                data-bs-toggle="modal" data-bs-target="#AddNewPackageModal">
                                                <i class="bi bi-plus-lg">+</i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Weight:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="weight" value="{{ old('weight') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Gross Weight:<span
                                                    class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="gross_weight" value="{{ old('gross_weight') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Net Weight:<span
                                                    class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="net_weight" value="{{ old('net_weight') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Description:</label>
                                        <div class="col-sm-9">
                                            <input type="text" readonly style="cursor: not-allowed; background-color:#e9ecef;" class="form-control" name="description" value="{{ old('description') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Username:</label>
                                        <div class="col-sm-9">
                                            <input type="text" readonly style="cursor: not-allowed; background-color:#e9ecef;" class="form-control" name="username" value="{{ old('username') }}">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Forwarder:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="select2 form-control wide me-2" name="forwarder_id">
                                                <option value="">Select Forwarder</option>
                                                @foreach ($forwarders as $forwarder)
                                                <option value="{{$forwarder->id}}" {{ old('forwarder_id') == $forwarder->id ? 'selected' : '' }}>
                                                    {{$forwarder->party_name}}
                                                </option>
                                                @endforeach
                                            </select>
                                            <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modelForwarderDetails">
                                                <i class="bi bi-plus-lg">+</i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Nature and Quantity of Goods:</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control h-100" id="" rows="2" name="nature_qty_goods">{{ old('nature_qty_goods') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Remarks:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="remarks" value="{{ old('remarks') }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Flight Status:</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control h-100" name="flight_status" rows="3">{{ old('flight_status') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                
                                <!--<div class="col-xl-6">-->
                                <!--    <div class="mb-3 row">-->
                                <!--        <label class="col-sm-3 col-form-label">Remarks/BOE:</label>-->
                                <!--        <div class="col-sm-9">-->
                                <!--            <input type="text" class="form-control" name="remark" value="{{ old('remark') }}">-->
                                <!--        </div>-->
                                <!--    </div>-->
                                <!--</div>-->
                                
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <a href="{{route('air-imports.index')}}" class="btn btn-warning" type="button">Cancel</a>
                                    <button class="btn btn-primary" type="submit">Save</button>
                                </div>
                            </div>
                        </form>
                        <div id="form-message"></div>
                    </div>


                    <!--<h4>HAWB Details</h4>-->
                    <!--<hr>-->
                    <!--<div class="form-validation">-->
                    <!--    <form class="needs-validation" id="hawbForm">-->
                    <!--        @csrf-->
                    <!--        @method('PUT')-->
                    <!--        <div class="row">-->
                    <!--            <input type="hidden" name="mawb_id" id="mawb_id" >-->

                    <!--            <div class="col-xl-6">-->
                    <!--                <div class="mb-3 row">-->
                    <!--                    <label class="col-sm-3 col-form-label">HAWB No:<span-->
                    <!--                            class="text-danger">*</span></label>-->
                    <!--                    <div class="col-sm-9">-->
                    <!--                        <input type="text" class="form-control" name="hbl_no" value="{{ old('hbl_no') }}">-->
                    <!--                    </div>-->
                    <!--                </div>-->
                    <!--            </div>-->
                    <!--            <div class="col-xl-6">-->
                    <!--                <div class="mb-3 row">-->
                    <!--                    <label class="col-sm-3 col-form-label">HAWB Date:<span-->
                    <!--                            class="text-danger">*</span></label>-->
                    <!--                    <div class="col-sm-9">-->
                    <!--                        <input type="date" placeholder="dd/mm/yy" class="form-control" name="hbl_date" value="{{ old('hbl_date') }}">-->
                    <!--                    </div>-->
                    <!--                </div>-->
                    <!--            </div>-->
                    <!--            <div class="col-xl-6">-->
                    <!--                <div class="mb-3 row">-->
                    <!--                    <label class="col-sm-3 col-form-label">Loading Port:<span-->
                    <!--                            class="text-danger">*</span></label>-->
                    <!--                    <div class="col-sm-9 d-flex align-items-center">-->
                    <!--                        <select class="form-control wide me-2 select2"-->
                    <!--                            name="hawb_loading_port_id">-->
                    <!--                            <option value="">Select Origin Port</option>-->
                    <!--                            @foreach ($ports as $port)-->
                    <!--                            <option value="{{$port->id}}" {{ old('hawb_loading_port_id') == $port->id ? 'selected' : '' }}>{{$port->port_name}}</option>-->
                                                <!-- <option value="{{$port->id}}">{{$port->port_name}}</option> -->
                    <!--                            @endforeach-->

                    <!--                        </select>-->
                    <!--                        <button type="button" class="btn btn-sm btn-outline-primary"-->
                    <!--                            data-bs-toggle="modal" data-bs-target="#addNewPortDetails">-->
                    <!--                            <i class="bi bi-plus-lg">+</i>-->
                    <!--                        </button>-->
                    <!--                    </div>-->
                    <!--                </div>-->
                    <!--            </div>-->
                    <!--            <div class="col-xl-6">-->
                    <!--                <div class="mb-3 row">-->
                    <!--                    <label class="col-sm-3 col-form-label">Destination Port:</label>-->
                    <!--                    <div class="col-sm-9 d-flex align-items-center">-->
                    <!--                        <select class="form-control wide me-2 select2"-->
                    <!--                            name="hawb_destination_port_id">-->
                    <!--                            <option value="">Select Dest_Port</option>-->
                    <!--                            @foreach ($ports as $port)-->
                    <!--                            <option value="{{$port->id}}" {{ old('hawb_destination_port_id') == $port->id ? 'selected' : '' }}>{{ $port->port_name }}</option>-->
                    <!--                            @endforeach-->
                    <!--                        </select>-->
                    <!--                        <button type="button" class="btn btn-sm btn-outline-primary"-->
                    <!--                            data-bs-toggle="modal" data-bs-target="#addNewPortDetails">-->
                    <!--                            <i class="bi bi-plus-lg">+</i>-->
                    <!--                        </button>-->
                    <!--                    </div>-->
                    <!--                </div>-->
                    <!--            </div>-->
                    <!--            <div class="col-xl-6">-->
                    <!--                <div class="mb-3 row">-->
                    <!--                    <label class="col-sm-3 col-form-label">Discharge Port:<span-->
                    <!--                            class="text-danger">*</span></label>-->
                    <!--                    <div class="col-sm-9 d-flex align-items-center">-->
                    <!--                        <select class="form-control wide me-2 select2"-->
                    <!--                            name="hawb_discharge_port_id">-->
                    <!--                            <option value="">Select Dest_Port</option>-->
                    <!--                            @foreach ($ports as $port)-->
                    <!--                            <option value="{{$port->id}}" {{ old('hawb_discharge_port_id') == $port->id ? 'selected' : '' }}>{{ $port->port_name }}</option>-->
                    <!--                            @endforeach-->
                    <!--                        </select>-->
                    <!--                        <button type="button" class="btn btn-sm btn-outline-primary"-->
                    <!--                            data-bs-toggle="modal" data-bs-target="#addNewPortDetails">-->
                    <!--                            <i class="bi bi-plus-lg">+</i>-->
                    <!--                        </button>-->
                    <!--                    </div>-->
                    <!--                </div>-->
                    <!--            </div>-->
                                
                    <!--            <div class="col-xl-6 col-xxl-6">-->
                    <!--                <div class="mb-3 row">-->
                    <!--                    <label class="col-sm-3 col-form-label">Shipment:</label>-->
                    <!--                    <div class="col-sm-9">-->
                    <!--                        <select class="form-control" name="hawb_shipment">-->
                    <!--                            <option value="" class="has-arrow">Select</option>-->
                    <!--                            <option value="1" {{ old('hawb_shipment') == '1' ? 'selected' : '' }}>Total</option>-->
                    <!--                            <option value="2" {{ old('hawb_shipment') == '2' ? 'selected' : '' }}>Part</option>-->
                    <!--                            <option value="3" {{ old('hawb_shipment') == '3' ? 'selected' : '' }}>Split</option>-->
                    <!--                        </select>-->
                    <!--                    </div>-->
                    <!--                </div>-->
                    <!--            </div>-->
                    <!--            <div class="col-xl-6">-->
                    <!--                <div class="mb-3 row">-->
                    <!--                    <label class="col-sm-3 col-form-label">Total Packages:</label>-->
                    <!--                    <div class="col-sm-9">-->
                    <!--                        <input type="text" class="form-control" name="hawb_package" value="{{ old('hawb_package') }}">-->
                    <!--                    </div>-->
                    <!--                </div>-->
                    <!--            </div>-->
                    <!--            <div class="col-xl-6">-->
                    <!--                <div class="mb-3 row">-->
                    <!--                    <label class="col-sm-3 col-form-label">Weight:<span-->
                    <!--                            class="text-danger">*</span></label>-->
                    <!--                    <div class="col-sm-9">-->
                    <!--                        <input type="text" class="form-control" name="hawb_weight" value="{{ old('hawb_weight') }}">-->
                    <!--                    </div>-->
                    <!--                </div>-->
                    <!--            </div>-->
                    <!--            <div class="col-xl-6">-->
                    <!--                <div class="mb-3 row">-->
                    <!--                    <label class="col-sm-3 col-form-label">Enquiry Reference No:</label>-->
                    <!--                    <div class="col-sm-9">-->
                    <!--                        <input type="date" placeholder="dd/mm/yy" readonly style="cursor: not-allowed; background-color:#e9ecef;" class="form-control" name="enquiry_reference_no" value="{{ old('enquiry_reference_no') }}">-->
                    <!--                    </div>-->
                    <!--                </div>-->
                    <!--            </div>-->
                    <!--            <div class="col-xl-6">-->
                    <!--                <div class="mb-3 row">-->
                    <!--                    <label class="col-sm-3 col-form-label">Description:<span-->
                    <!--                            class="text-danger">*</span></label>-->
                    <!--                    <div class="col-sm-9">-->
                    <!--                        <textarea class="form-control h-100" id="validationCustom04" rows="2" name="descriptions">{{ old('descriptions') }}</textarea>-->
                    <!--                    </div>-->
                    <!--                </div>-->
                    <!--            </div>-->
                        
                    <!--            <div class="d-grid gap-2 d-md-flex justify-content-md-end">-->
                    <!--                <a href="{{route('air-imports.index')}}" class="btn btn-warning" type="button">Cancel</a>-->
                    <!--                <button class="btn btn-primary" type="submit">ADD/UPDATE HAWB</button>-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--    </form>-->
                    <!--    <div id="form-hawb"></div>-->
                    <!--</div>-->
                    
                    <div class="form-validation">
                        <form class="needs-validation" id="otherForm" novalidate method="POST" action="{{ route('air-imports.updateother') }}">
                            @csrf
                            @method('PUT')
                            
                            <div class="row">
                                <h4>Air Waybill Details</h4>
                                <hr>
                                
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">TO:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="to_air" value="{{ old('to_air') }}">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">By First Carrier:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="by_first_carrier" value="{{ old('by_first_carrier') }}">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Declared Value for Carrier:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="declared_value_by_carrier" value="{{ old('declared_value_by_carrier') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Declared Value for Customs:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="declared_value_by_customs" value="{{ old('declared_value_by_customs') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Routing and Destination:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="routing_destination" value="{{ old('routing_destination') }}">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">CHGS Code:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="chgs_code" value="{{ old('chgs_code') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Reference Number:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="reference_number" value="{{ old('reference_number') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Shipper or his Agent:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="shipper_agent" value="{{ old('shipper_agent') }}">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Executed By:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="executed_by" value="{{old('executed_by')}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Rate/Charges:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="rate_charges" value="{{ old('rate_charges') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Total Other Charges Due Agent:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="other_charges_due_agent" value="{{ old('other_charges_due_agent') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Total Other Charges Due Carrier:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="other_charges_due_carrier" value="{{ old('other_charges_due_carrier') }}">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Other Charges:</label>
                                        <div class="col-sm-9">
                                            <textarea type="text" class="form-control" name="other_charges">{{ old('other_charges') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <h4>Other Details</h4>
                            <hr>
                            <div class="row">
                                <input type="hidden" name="mawb_id" id="other_mawb_id" >
                                <div class="col-xl-6 col-xxl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Freight:<span
                                                    class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="freight">
                                                <option value="" class="has-arrow">Select</option>
                                                <option value="C" {{ old('freight') == 'C' ? 'selected' : '' }}>C</option>
                                                <option value="P" {{ old('freight') == 'P' ? 'selected' : '' }}>P</option>
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
                                                <option value="AED" {{ old('currency') == 'AED' ? 'selected' : '' }}>AED</option>
                                                <option value="AUD" {{ old('currency') == 'AUD' ? 'selected' : '' }}>AUD</option>
                                                <option value="BGN" {{ old('currency') == 'BGN' ? 'selected' : '' }}>BGN</option>
                                                <option value="BRL" {{ old('currency') == 'BRL' ? 'selected' : '' }}>BRL</option>
                                                <option value="CAD" {{ old('currency') == 'CAD' ? 'selected' : '' }}>CAD</option>
                                                <option value="CHF" {{ old('currency') == 'CHF' ? 'selected' : '' }}>CHF</option>
                                                <option value="CNY" {{ old('currency') == 'CNY' ? 'selected' : '' }}>CNY</option>
                                                <option value="CSD" {{ old('currency') == 'CSD' ? 'selected' : '' }}>CSD</option>
                                                <option value="CZK" {{ old('currency') == 'CZK' ? 'selected' : '' }}>CZK</option>
                                                <option value="DKK" {{ old('currency') == 'DKK' ? 'selected' : '' }}>DKK</option>
                                                <option value="EEK" {{ old('currency') == 'EEK' ? 'selected' : '' }}>EEK</option>
                                                <option value="EGP" {{ old('currency') == 'EGP' ? 'selected' : '' }}>EGP</option>
                                                <option value="EUR" {{ old('currency') == 'EUR' ? 'selected' : '' }}>EUR</option>
                                                <option value="GBP" {{ old('currency') == 'GBP' ? 'selected' : '' }}>GBP</option>
                                                <option value="HKD" {{ old('currency') == 'HKD' ? 'selected' : '' }}>HKD</option>
                                                <option value="HRK" {{ old('currency') == 'HRK' ? 'selected' : '' }}>HRK</option>
                                                <option value="HUF" {{ old('currency') == 'HUF' ? 'selected' : '' }}>HUF</option>
                                                <option value="IDR" {{ old('currency') == 'IDR' ? 'selected' : '' }}>IDR</option>
                                                <option value="ILS" {{ old('currency') == 'ILS' ? 'selected' : '' }}>ILS</option>
                                                <option value="INR" {{ old('currency') == 'INR' ? 'selected' : '' }}>INR</option>
                                                <option value="ISK" {{ old('currency') == 'ISK' ? 'selected' : '' }}>ISK</option>
                                                <option value="JPY" {{ old('currency') == 'JPY' ? 'selected' : '' }}>JPY</option>
                                                <option value="MXP" {{ old('currency') == 'MXP' ? 'selected' : '' }}>MXP</option>
                                                <option value="MYR" {{ old('currency') == 'MYR' ? 'selected' : '' }}>MYR</option>
                                                <option value="NOK" {{ old('currency') == 'NOK' ? 'selected' : '' }}>NOK</option>
                                                <option value="NZD" {{ old('currency') == 'NZD' ? 'selected' : '' }}>NZD</option>
                                                <option value="PHP" {{ old('currency') == 'PHP' ? 'selected' : '' }}>PHP</option>
                                                <option value="PLN" {{ old('currency') == 'PLN' ? 'selected' : '' }}>PLN</option>
                                                <option value="ROL" {{ old('currency') == 'ROL' ? 'selected' : '' }}>ROL</option>
                                                <option value="RUR" {{ old('currency') == 'RUR' ? 'selected' : '' }}>RUR</option>
                                                <option value="SAR" {{ old('currency') == 'SAR' ? 'selected' : '' }}>SAR</option>
                                                <option value="SEK" {{ old('currency') == 'SEK' ? 'selected' : '' }}>SEK</option>
                                                <option value="SGD" {{ old('currency') == 'SGD' ? 'selected' : '' }}>SGD</option>
                                                <option value="SIT" {{ old('currency') == 'SIT' ? 'selected' : '' }}>SIT</option>
                                                <option value="SKK" {{ old('currency') == 'SKK' ? 'selected' : '' }}>SKK</option>
                                                <option value="THB" {{ old('currency') == 'THB' ? 'selected' : '' }}>THB</option>
                                                <option value="TRL" {{ old('currency') == 'TRL' ? 'selected' : '' }}>TRL</option>
                                                <option value="TWD" {{ old('currency') == 'TWD' ? 'selected' : '' }}>TWD</option>
                                                <option value="UAH" {{ old('currency') == 'UAH' ? 'selected' : '' }}>UAH</option>
                                                <option value="US" {{ old('currency') == 'US' ? 'selected' : '' }}>US</option>
                                                <option value="USD" {{ old('currency') == 'USD' ? 'selected' : '' }}>USD</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Exch.Rate:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="exchange_rate" value="{{ old('exchange_rate') }}">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Chargeable. Wt:<span
                                                    class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="chargable_weight" value="{{ old('chargable_weight') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Iata Code:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="iata_code" value="{{ old('iata_code') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Issued By:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="issued_by" value="{{ old('issued_by') }}">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Handling Information:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="handling_information" value="{{ old('handling_information') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Accounting Information:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="accounting_information" value="{{ old('accounting_information') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Account No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="account_no" value="{{ old('account_no') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Issue Carrier Agent Name(IATA):</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="select2 form-control wide me-2" name="agent_id">
                                                <option value="">Select</option>
                                                @foreach ($parties->whereIn('party_type', 13) as $party)
                                                <option value="{{$party->id}}" {{ old('agent_id') == $party->id ? 'selected' : '' }}>
                                                    {{$party->party_name}}
                                                </option>
                                                @endforeach
                                            </select>
                                            <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#partyDetailsModal" data-target-field="agent_id">
                                                <i class="bi bi-plus-lg">+</i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Consignee:<span
                                                    class="text-danger">*</span></label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <input type="hidden" id="consignee_id_hidden_input" name="consignee_id" >
                                            <select class="form-control wide me-2 select2"
                                                name="consignee_id" id="consignee_id">
                                                <option value="">Select Consignee</option>
                                                @foreach ($parties->where('party_type', 1) as $party)
                                                <option value="{{$party->id}}" {{ old('consignee_id') == $party->id ? 'selected' : '' }}>{{$party->party_name}}</option>
                                                @endforeach
                                            </select>
                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                data-bs-toggle="modal" data-bs-target="#partyDetailsModal" data-target-field="consignee_id">
                                                <i class="bi bi-plus-lg">+</i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">
                                            Shipper:<span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="select2 form-control me-2" name="shipper_id" id="shipper_id" required>
                                                <option value="">Select</option>
                                                @foreach ($exportParites as $party)
                                                <option value="{{ $party->id }}" {{ old('shipper_id') == $party->id ? 'selected' : '' }}>
                                                    {{ $party->party_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                            <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exportPartyDetails">
                                                <i class="bi bi-plus-lg">+</i>
                                            </button>
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
                                                <option value="{{$party->id}}" {{ old('billing_party_id') == $party->id ? 'selected' : '' }}>{{$party->party_name}}</option>
                                                @endforeach
                                            </select>
                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                data-bs-toggle="modal" data-bs-target="#partyDetailsModal" data-target-field="billing_party_id">
                                                <i class="bi bi-plus-lg">+</i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Notify:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="select2 form-control wide me-2" name="notify_id" placeholder="Select">
                                                <option value="">Select Notify</option>
                                                @foreach ($parties->whereIn('party_type', [6, 1]) as $party)
                                                <option value="{{$party->id}}" {{ old('notify_id') == $party->id ? 'selected' : '' }}>
                                                    {{$party->party_name}}
                                                </option>
                                                @endforeach
                                            </select>
                                            <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#partyDetailsModal" data-target-field="notify_id">
                                                <i class="bi bi-plus-lg">+</i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Notify 2:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="select2 form-control wide me-2" name="notify2_id" placeholder="Select">
                                                <option value="">Select Notify 2</option>
                                                @foreach ($parties->whereIn('party_type', [6, 1]) as $party)
                                                <option value="{{$party->id}}" {{ old('notify2_id') == $party->id ? 'selected' : '' }}>
                                                    {{$party->party_name}}
                                                </option>
                                                @endforeach
                                            </select>
                                            <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#partyDetailsModal" data-target-field="notify2_id">
                                                <i class="bi bi-plus-lg">+</i>
                                            </button>
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
                                                <option value="{{$party->id}}" {{ old('cha_party_id') == $party->id ? 'selected' : '' }}>{{$party->party_name}}</option>
                                                @endforeach
                                            </select>
                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                data-bs-toggle="modal" data-bs-target="#partyDetailsModal" data-target-field="cha_party_id">
                                                <i class="bi bi-plus-lg">+</i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Sales Person: <span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="form-control wide me-2 select2"
                                                name="sales_person_id">
                                                <option value="">Select Sales Person</option>
                                                @foreach ($salePersons as $salePerson)
                                                <option value="{{$salePerson->id}}" {{ old('sales_person_id') == $salePerson->id ? 'selected' : '' }}>{{$salePerson->name}}</option>
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
                                            <input type="text" readonly style="cursor: not-allowed; background-color:#e9ecef;" class="form-control" id="insurance" name="insurance" value="{{ old('insurance') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">F.Premium.Amt:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="fpa_amount" value="{{ old('fpa_amount') }}">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Transportation:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" readonly style="cursor: not-allowed; background-color:#e9ecef;" id="transportation" name="transportation" value="{{ old('transportation') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Transportation Details:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="transportation_details" value="{{ old('transportation_details') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Clearance:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" readonly style="cursor: not-allowed; background-color:#e9ecef;" id="clearance" name="clearance" value="{{ old('clearance') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">CC Perc.:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="cc_perc" value="{{ old('cc_perc') }}">
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
                                                <option value="AED" {{ old('cc_currency') == 'AED' ? 'selected' : '' }}>AED</option>
                                                <option value="AUD" {{ old('cc_currency') == 'AUD' ? 'selected' : '' }}>AUD</option>
                                                <option value="BGN" {{ old('cc_currency') == 'BGN' ? 'selected' : '' }}>BGN</option>
                                                <option value="BRL" {{ old('cc_currency') == 'BRL' ? 'selected' : '' }}>BRL</option>
                                                <option value="CAD" {{ old('cc_currency') == 'CAD' ? 'selected' : '' }}>CAD</option>
                                                <option value="CHF" {{ old('cc_currency') == 'CHF' ? 'selected' : '' }}>CHF</option>
                                                <option value="CNY" {{ old('cc_currency') == 'CNY' ? 'selected' : '' }}>CNY</option>
                                                <option value="CSD" {{ old('cc_currency') == 'CSD' ? 'selected' : '' }}>CSD</option>
                                                <option value="CZK" {{ old('cc_currency') == 'CZK' ? 'selected' : '' }}>CZK</option>
                                                <option value="DKK" {{ old('cc_currency') == 'DKK' ? 'selected' : '' }}>DKK</option>
                                                <option value="EEK" {{ old('cc_currency') == 'EEK' ? 'selected' : '' }}>EEK</option>
                                                <option value="EGP" {{ old('cc_currency') == 'EGP' ? 'selected' : '' }}>EGP</option>
                                                <option value="EUR" {{ old('cc_currency') == 'EUR' ? 'selected' : '' }}>EUR</option>
                                                <option value="GBP" {{ old('cc_currency') == 'GBP' ? 'selected' : '' }}>GBP</option>
                                                <option value="HKD" {{ old('cc_currency') == 'HKD' ? 'selected' : '' }}>HKD</option>
                                                <option value="HRK" {{ old('cc_currency') == 'HRK' ? 'selected' : '' }}>HRK</option>
                                                <option value="HUF" {{ old('cc_currency') == 'HUF' ? 'selected' : '' }}>HUF</option>
                                                <option value="IDR" {{ old('cc_currency') == 'IDR' ? 'selected' : '' }}>IDR</option>
                                                <option value="ILS" {{ old('cc_currency') == 'ILS' ? 'selected' : '' }}>ILS</option>
                                                <option value="INR" {{ old('cc_currency') == 'INR' ? 'selected' : '' }}>INR</option>
                                                <option value="ISK" {{ old('cc_currency') == 'ISK' ? 'selected' : '' }}>ISK</option>
                                                <option value="JPY" {{ old('cc_currency') == 'JPY' ? 'selected' : '' }}>JPY</option>
                                                <option value="MXP" {{ old('cc_currency') == 'MXP' ? 'selected' : '' }}>MXP</option>
                                                <option value="MYR" {{ old('cc_currency') == 'MYR' ? 'selected' : '' }}>MYR</option>
                                                <option value="NOK" {{ old('cc_currency') == 'NOK' ? 'selected' : '' }}>NOK</option>
                                                <option value="NZD" {{ old('cc_currency') == 'NZD' ? 'selected' : '' }}>NZD</option>
                                                <option value="PHP" {{ old('cc_currency') == 'PHP' ? 'selected' : '' }}>PHP</option>
                                                <option value="PLN" {{ old('cc_currency') == 'PLN' ? 'selected' : '' }}>PLN</option>
                                                <option value="ROL" {{ old('cc_currency') == 'ROL' ? 'selected' : '' }}>ROL</option>
                                                <option value="RUR" {{ old('cc_currency') == 'RUR' ? 'selected' : '' }}>RUR</option>
                                                <option value="SAR" {{ old('cc_currency') == 'SAR' ? 'selected' : '' }}>SAR</option>
                                                <option value="SEK" {{ old('cc_currency') == 'SEK' ? 'selected' : '' }}>SEK</option>
                                                <option value="SGD" {{ old('cc_currency') == 'SGD' ? 'selected' : '' }}>SGD</option>
                                                <option value="SIT" {{ old('cc_currency') == 'SIT' ? 'selected' : '' }}>SIT</option>
                                                <option value="SKK" {{ old('cc_currency') == 'SKK' ? 'selected' : '' }}>SKK</option>
                                                <option value="THB" {{ old('cc_currency') == 'THB' ? 'selected' : '' }}>THB</option>
                                                <option value="TRL" {{ old('cc_currency') == 'TRL' ? 'selected' : '' }}>TRL</option>
                                                <option value="TWD" {{ old('cc_currency') == 'TWD' ? 'selected' : '' }}>TWD</option>
                                                <option value="UAH" {{ old('cc_currency') == 'UAH' ? 'selected' : '' }}>UAH</option>
                                                <option value="US" {{ old('cc_currency') == 'US' ? 'selected' : '' }}>US</option>
                                                <option value="USD" {{ old('cc_currency') == 'USD' ? 'selected' : '' }}>USD</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">CCExch.Rt:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="cc_exch_rate" value="{{ old('cc_exch_rate') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Caf Perc.:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="caf_perc" value="{{ old('caf_perc') }}">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            
                            <div class="row">
                                
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Inv No / Inv Dt:</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control h-100" placeholder="DDP-178 L78 / 24-10-2025" name="customer_inv_no" rows="2">{{ old('customer_inv_no') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Check List Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control" name="check_list_date" value="{{ old('check_list_date') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Bill of entry no/date:</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control h-100" placeholder="DDP-178 L78 / 24-10-2025" name="bill_of_entry_date" rows="2">{{ old('bill_of_entry_date') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                         
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Out Off Charge Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control" name="out_off_charge_date" value="{{ old('out_off_charge_date') }}">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Arriaval Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control" name="arrival_date" value="{{ old('arrival_date') }}">
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            
                            
                            
                            
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button class="btn btn-primary" type="submit">Save Details</button>
                            </div>
                        </form>
                        <div id="form-other"></div>
                    </div>


                    <h4>File Upload</h4>
                    <hr>
                    <div class="form-validation">
                        <form class="needs-validation" action="{{route('multi-file-upload.updateFileUpload')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="file_related" value="air_import">
                            <!-- ðŸ‘‡ hidden job_no (or mawb_no) -->
                            <input type="hidden" name="job_no" id="job_no_hidden">
                            <div class="row">
                                <div class="col-xl-9">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Choose File:<span class="text-danger">*</span></label>
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
                        <!--                        <option value="{{$file->id}}" {{ old('search_query') == $file->id ? 'selected' : '' }}>{{$file->file_name}}</option>-->
                        <!--                        @endforeach-->
                        <!--                    </select>-->
                        <!--                    <button type="submit" class="btn btn-primary btn-sm" style="width:180px;">Search</button>-->
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

@php
    $month = date('n');
    $year = date('Y');

    if ($month < 4) {
        $fyStart = $year - 1;
        $fyEnd = $year;
    } else {
        $fyStart = $year;
        $fyEnd = $year + 1;
    }

    $financialYear = $fyStart . '-' . substr($fyEnd, -2);
@endphp

@include('admin-main.admin.commonModelForms.modelPartyDetails')

@include('admin-main.admin.commonModelForms.addNewPort_modal')

@include('admin-main.admin.commonModelForms.salesperson_modal')
<!-- Add new Package Modal -->
@include('admin-main.admin.commonModelForms.addNewPackageModel')
<!-- Add new export Modal -->
@include('admin-main.admin.commonModelForms.addExportPartiesModel')
<!-- Add new Forwarder Modal -->
@include('admin-main.admin.commonModelForms.modelForwarder')

@endsection




@push('scripts')
<script>

$(document).ready(function () {
    $('html, body').animate({
        scrollTop: $('#alert-message').offset().top - 80
    }, 500);

    $('#mawb_no_dropdown').select2(); 

    $('#mawbForm').on('submit', function (e) {
        e.preventDefault();
        
        var formData = new FormData(this);
    
        $.ajax({
            url: "{{ route('air-imports.store') }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            success: function (response) {
                if(response.status){
                    $("#form-message").html(
                        `<div class="alert alert-success">${response.message}</div>`
                    );
                }else{
                    $("#form-message").html(
                        `<div class="alert alert-danger">${response.message}</div>`
                    );
                }
                    
                const mawbId = response.data.id;
                const mawbNo = response.data.mawb_no;
                $('#job_no_hidden').val($('#job_numbers').val());
                $('#mawb_id').val(mawbId);
                $('#other_mawb_id').val(mawbId);
    
                // ✅ Append to MAWB dropdown in HAWB form if not exists
                // const hawbDropdown = $('#hawb_mawb_no_dropdown');
                // if (hawbDropdown.find(`option[value="${mawbId}"]`).length === 0) {
                //     hawbDropdown.append(new Option(mawbNo, mawbId));
                // }
    
                // ✅ Select the newly added MAWB No
                // hawbDropdown.val(mawbId).trigger('change');
    
                // Optional: Reset or highlight something
                $('#alert-message').addClass('alert-success').removeClass('alert-danger');
    
                // Hide alert after few seconds
                setTimeout(() => {
                    $('#alert-message').addClass('d-none').removeClass('alert-success');
                }, 8000);
    
                // Optional: fill other fields from response.data if needed
                // fillForm(response.data);
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    let errorHtml = '<div class="alert alert-danger"><ul>';

                    $.each(errors, function (key, value) {
                        errorHtml += "<li>" + value[0] + "</li>";
                        // highlight input
                        $("[name='" + key + "']").addClass("is-invalid");
                    });

                    errorHtml += "</ul></div>";
                    $("#form-message").html(errorHtml);
                } else {
                    $("#form-message").html(
                        `<div class="alert alert-danger">Something went wrong.</div>`
                    );
                }
            },
        });
    });
    
    $('#hawbForm').on('submit', function (e) {
        e.preventDefault();
    
        var formData = new FormData(this);
    
        $.ajax({
            url: "{{ route('air-imports.updateHawb') }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            success: function (response) {
                if(response.status){
                    $("#form-hawb").html(
                        `<div class="alert alert-success">${response.message}</div>`
                    );
                }else{
                    $("#form-hawb").html(
                        `<div class="alert alert-danger">${response.message}</div>`
                    );
                }
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    let errorHtml = '<div class="alert alert-danger"><ul>';

                    $.each(errors, function (key, value) {
                        errorHtml += "<li>" + value[0] + "</li>";
                        // highlight input
                        $("[name='" + key + "']").addClass("is-invalid");
                    });

                    errorHtml += "</ul></div>";
                    $("#form-hawb").html(errorHtml);
                } else {
                    $("#form-hawb").html(
                        `<div class="alert alert-danger">Something went wrong.</div>`
                    );
                }
            },
        });
    });
    
    $('#otherForm').on('submit', function (e) {
        e.preventDefault();
    
        var formData = new FormData(this);
    
        $.ajax({
            url: "{{ route('air-imports.updateother') }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            success: function (response) {
                if(response.status){
                    $("#form-other").html(
                        `<div class="alert alert-success">${response.message}</div>`
                    );
                    // Optionally reset form
                    // form.trigger("reset");
                }else{
                    $("#form-other").html(
                        `<div class="alert alert-danger">${response.message}</div>`
                    );
                }
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    let errorHtml = '<div class="alert alert-danger"><ul>';

                    $.each(errors, function (key, value) {
                        errorHtml += "<li>" + value[0] + "</li>";
                        // highlight input
                        $("[name='" + key + "']").addClass("is-invalid");
                    });

                    errorHtml += "</ul></div>";
                    $("#form-other").html(errorHtml);
                } else {
                    $("#form-other").html(
                        `<div class="alert alert-danger">Something went wrong.</div>`
                    );
                }
            },
        });
    });

    
    function fillForm(data) {
        for (const key in data) {
            const input = $('[name="' + key + '"]');
            if (input.is('select')) {
                input.val(data[key]).trigger('change');
            } else {
                input.val(data[key]);
            }
        }
    }
});


</script>

<script>
    $(document).ready(function() {
        
        // flatpickr("input[type='date']", {
        //     dateFormat: "d/m/Y", // shows as 07/11/2025
        //     allowInput: true
            
        // });
        
        $('.select2').select2({
            // placeholder: 'Select a value',
            // allowClear: true,
            width: '100%'
        });
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
    //all model forms
    $(document).ready(function() {
        
        //export party form
        $(document).on('submit', '#exportPartyDetailsForm', function (e) {
            e.preventDefault(); // stop reload
    
            const form = $(this);
            const btn = form.find('button[type="submit"]');
            btn.prop('readonly', true).text('Saving...');
    
            $.ajax({
                url: "{{ route('new-party.store') }}",
                type: "POST",
                data: form.serialize(),
                success: function (res) {
                    btn.prop('readonly', false).text('Save');
    
                    if (res.success) {
                        const shipperSelect = $('#shipper_id');
                        const newOption = new Option(res.party.name, res.party.id, true, true);
                        shipperSelect.append(newOption).trigger('change');
    
                        form[0].reset();
                        $('#exportPartyDetails').modal('hide');
                    } else {
                        alert(res.message || 'Failed to save export party.');
                    }
                },
                error: function (xhr) {
                    btn.prop('readonly', false).text('Save');
                    let msg = 'Failed to add export party.';
                    if (xhr.responseJSON?.errors) {
                        msg = Object.values(xhr.responseJSON.errors).flat().join("\n");
                    }
                    alert(msg);
                }
            });
        });
        
        // get job numbers
        $('#job_numbers').on('change', function(e) {
            e.preventDefault();
    
            var selectNumber = $(this).val();
            var selectJobActivity = $(this).find(':selected').data('jobactivity');
        
            let job_no = $(this).find('option:selected').data('jobno');
            let financialYear = "{{ $financialYear }}";
            $('#consignee_id').next('.select2').find('.select2-selection').css('border-color', '');
            // $('#shipper_id').next('.select2').find('.select2-selection').css('border-color', '');
     
            if (selectNumber) {
                $.ajax({
                    url: '/get-job-details', // Update this URL based on your route
                    method: 'POST',
                    data: {
                        job_id: selectNumber,
                        job_activity: selectJobActivity,
                        _token: $('meta[name="csrf-token"]').attr('content') // CSRF token for Laravel
                    },
                    success: function(response) {
                        
                        if(response.jobMasterData.insurance == 'Y'){
                            $('#insurance')
                            .prop('readonly', false)
                            .css({
                                'cursor': '',
                                'background-color': ''
                            });
                        }else{
                            $('#insurance')
                            .prop('readonly', true)
                            .css({
                                'cursor': 'not-allowed',
                                'background-color': '#e9ecef'
                            });
                        }
                        
                        if(response.jobMasterData.clearance == 'Y'){
                            $('#clearance')
                            .prop('readonly', false)
                            .css({
                                'cursor': '',
                                'background-color': ''
                            });
                        }else{
                            $('#clearance')
                            .prop('readonly', true)
                            .css({
                                'cursor': 'not-allowed',
                                'background-color': '#e9ecef'
                            });
                        }
                        
                        if(response.jobMasterData.transportation == 'Y'){
                            $('#transportation')
                            .prop('readonly', false)
                            .css({
                                'cursor': '',
                                'background-color': ''
                            });
                        }else{
                            $('#transportation')
                            .prop('readonly', true)
                            .css({
                                'cursor': 'not-allowed',
                                'background-color': '#e9ecef'
                            });
                        }
                    
                        $('#consignee_id').val(response.job_party_id);
                        $('#consignee_id_hidden_input').val(response.job_party_id);
                        $('#consignee_id').trigger('change');
                        $('#consignee_id')
                        .prop('readonly', true)
                        .css({
                            'cursor': 'not-allowed',
                            'background-color': '#e9ecef'
                        });
                        
                        $('#full_job_no').val(response.jobMasterData.full_job_no);
                        $('#full_job_no_hidden_field').val(response.jobMasterData.full_job_no);
                    },
                    error: function(xhr) {
                        let msg = "Something went wrong!";

                        // If backend returns { "error": "Job already exists" }
                        if (xhr.responseJSON && xhr.responseJSON.error) {
                            msg = xhr.responseJSON.error;
                        }
                    
                        $("#jobErrorBox").hide().html(msg).fadeIn();
                        ('#mawbForm$')[0].reset();
                    }
                });
            }
            
           
        });
    
        // model sales person
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
    
        //add new port
        $('#portDetailsModel').on('submit', function(e) {
            e.preventDefault();
        
            $.ajax({
                url: "{{ route('new-port.store') }}",
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        const portId = response.port.id;
                        const portName = response.port.name;
        
                        // ✅ Loop through all selects with port-related names
                        $('select[name$="_port"], select[name$="_port_id"]').each(function () {
                            const select = $(this);
        
                            // store current value before change
                            const currentVal = select.val();
        
                            // add new option if missing
                            if (select.find('option[value="' + portId + '"]').length === 0) {
                                const newOption = new Option(portName, portId, false, false);
                                select.append(newOption);
                            }
        
                            // reselect previous value
                            if (currentVal && currentVal !== '') {
                                select.val(currentVal).trigger('change');
                            }
                        });
    
                        $('#portDetailsModel')[0].reset();
                        $('#addNewPortDetails').modal('hide');
        
                        toastr.success('Port added successfully!');
                    } else {
                        alert('Something went wrong: ' + JSON.stringify(response));
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    alert('Failed to add new port');
                }
            });
        });
        
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
        
                        $('select[name$="_id"]').each(function () {
                            const select = $(this);
                            if (select.find('option[value="' + partyId + '"]').length === 0) {
                                const newOption = new Option(partyName, partyId, false, false);
                                select.append(newOption);
                            }
                            if (select.hasClass('select2')) {
                                select.trigger('change.select2');
                            }
                        });
    
                        if (targetField) {
                            const activeSelect = $('select[name="' + targetField + '"]');
                            if (activeSelect.length) {
                                activeSelect.val(partyId).trigger('change');
                            }
                        }
        
                        $('#modelPartyDetails')[0].reset();
                        $('#partyDetailsModal').modal('hide');
                        toastr.success('Party added successfully!');
                    } else {
                        $('#partyNameError').text(response.message).addClass('alert alert-danger');
                    }
                },
                error: function (xhr) {
                    let errors = xhr.responseJSON.errors;
                    let errorHtml = '';
        
                    $.each(errors, function (field, messages) {
                        messages.forEach(function (message) {
                            errorHtml += `<li>${message}</li>`;
                        });
                    });
        
                    $('#partyNameError').html(`<ul>${errorHtml}</ul>`).show();
                    console.error('Error:', xhr.responseText);
                }
            });
        });
        
        // Reset target field after modal closes
        $('#partyDetailsModal').on('hidden.bs.modal', function () {
            targetField = null;
        });
        
        // add new package
        $('#addNewPackageModel').on('submit', function(e) {
            e.preventDefault();
    
            $.ajax({
                url: "{{ route('new-package.store') }}", // route name
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    // Use the correct keys: response.package.id and response.package.name
                    const newOption = new Option(response.package.name, response.package.id, true, true);
                
                    // Append and select it
                    let $packageSelect = $('select[name="package"]');
                    $packageSelect.append(newOption).trigger('change');  
                
                    // Reset and hide modal
                    $('#addNewPackageModel')[0].reset();
                
                    // Bootstrap 5 modal hide
                    var modalEl = document.getElementById('AddNewPackageModal');
                    var modal = bootstrap.Modal.getInstance(modalEl);
                    modal.hide();
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
        
        
        // model forwarder
        $('#modelForwarderForms').on('submit', function(e) {
            e.preventDefault();
    
            $.ajax({
                url: "{{ route('forwarder.store') }}", // route name
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        // const newOption = new Option(response.party.name, response.party.id, true, true);
                        // $('select[name="consignee_id"]').append(newOption).trigger('change');
                        $('select[name="forwarder_id"]').each(function() {
                            $(this).append(`<option value="${response.id}" selected>${response.name}</option>`);
                        });
                        
                        const partyId = response.party.id;
                        const partyName = response.party.name;
    
                        const dropdownNames = ['shipper_id', 'consignee_id', 'lata_agent', 'overSeas_agent', 'forwarder_id'];
    
                        dropdownNames.forEach(function(name) {
                            const select = $('select[name="' + name + '"]');
                            if (select.length) {
                                const newOption = new Option(partyName, partyId, true, true);
                                select.append(newOption).trigger('change');
                            }
                        });
                
                    }
                    $('#modelForwarderForms')[0].reset();
                    $('#modelForwarderDetails').modal('hide');
                },
                error: function(xhr) {
                    alert('Failed to forwarder details');
    
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

    


    

    
</script>


@endpush