@extends('admin-main.layouts.default')
@section('content')
<style>
    .input-error {
        border: 1px solid red !important;
    }
    select.input-error {
        border-color: red !important;
    }
</style>
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active"><a href="#">Add New Sea-Export BL</a></li>
    </ol>
    <a href="{{ url('admin/sea-exports') }}" class="text-primary"><- Go Back</a>
</div>
@if (session('success'))
<div class="alert alert-success">{{session('success')}}</div>
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

<div id="jobErrorBox" class="alert alert-danger" style="display:none;"></div>

<div class="container-fluid p-2">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add New Sea-Export BL</h4>
                </div><br>

                <div class="card-body">
                    <div class="form-validation">
                        <form class="needs-validation" novalidate id="seaExportForm" >
                            @csrf
                            <div class="row form-material">
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
                                <div class="mb-3 row col-xl-3 col-xxl-12 col-xl-6 row">
                                    <label class="col-sm-3 col-form-label">Entry By:<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <div class="d-flex gap-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" value="Packinglist" name="entry_by"
                                                    {{ old('entry_by') == 'Packinglist' ? 'checked' : '' }} required>
                                                <label class="form-check-label" for="lcl">
                                                    Packinglist
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" value="nominated" name="entry_by"
                                                    {{ old('entry_by', 'nominated') == 'nominated' ? 'checked' : '' }} required>
                                                <label class="form-check-label" for="fcl20">
                                                    Nominated
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <h4>General Details</h4>
                                <hr>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Job No:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select class="form-control wide me-2 select2" name="job_no" id="job_numbers" required onchange="updateFullJobNo(this)">
                                                <option value="">select</option>
                                                @foreach ($job_numbers as $job_number)
                                                    <option value="{{ $job_number->id }}" data-jobno="{{ $job_number->job_no }}" data-jobActivity="{{ $job_number->job_activity }}"
                                                            data-party-id="{{ $job_number->consigneeName?->id }}"  {{-- use relation --}}
                                                            {{ old('job_no') == $job_number->job_no ? 'selected' : '' }}>
                                                        {{ $job_number->job_no }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Booking No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="booking_no" value="{{ old('booking_no') }}">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Vessel Name:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <input type="text" name="vessel_name" name="" value="{{old('vessel_name')}}" class="form-control">
                                            <!--<select class="select2 form-control wide me-2" name="vessel_id" id="vesselDropdown">-->
                                            <!--    <option value="">select</option>-->
                                            <!--    @foreach ($vessels as $vessel)-->
                                            <!--    <option value="{{$vessel->id}}" {{ old('vessel_id') == $vessel->id ? 'selected' : '' }}>-->
                                            <!--        {{$vessel->vessel_name}}-->
                                            <!--    </option>-->
                                            <!--    @endforeach-->
                                            <!--</select>-->
                                            <!--<button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#oceanVslModal">-->
                                            <!--    <i class="bi bi-plus-lg">+</i>-->
                                            <!--</button>-->
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">MBL No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="mbl_no" value="{{ old('mbl_no') }}">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Enquiry Reference No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="enquiry_ref_no" value="{{ old('enquiry_ref_no') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Full Job No:</label>
                                        <div class="col-sm-9">
                                            <!--<input type="text" class="form-control" name="full_job_no" value="{{ old('full_job_no') }}">-->
                                            <input type="text" class="form-control" name="full_job_no" id="full_job_no" value="{{ old('full_job_no') }}" style="background: #e3e3e3;" readonly>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Booking Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy" class="form-control" name="booking_date" value="{{ old('booking_date') }}">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Voyage No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="voyage_no" value="{{ old('voyage_no') }}">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">HBL No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="hbl_no" value="{{ old('hbl_no') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                             {{-- party details --}}
                            <div class="row">
                                <h4>Party Details</h4>
                                <hr>
                                <div class="col-xl-6 col-xxl-6">

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">
                                            Shipper:<span class="text-danger">*</span>
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


                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Consignee:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="select2 form-control wide me-2" name="consignee_id" id="consignee_select" required>
                                                <option value="">Select</option>
                                                @foreach ($parties->whereIn('party_type', [1, 6]) as $party)
                                                    <option value="{{ $party->id }}" {{ old('consignee_id') == $party->id ? 'selected' : '' }}>
                                                        {{ $party->party_name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#partyDetailsModal" data-target-field="consignee_id">
                                                <i class="bi bi-plus-lg">+</i>
                                            </button>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-xl-6 col-xxl-6">

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Notify:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="select2 form-control wide me-2" name="notify_id" placeholder="Select">
                                                <option value="">Select</option>
                                                @foreach ($parties->whereIn('party_type', [1, 6]) as $party)
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

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Notify 2:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="select2 form-control wide me-2" name="notify2_id" placeholder="Select">
                                                <option value="">Select</option>
                                                @foreach ($parties->whereIn('party_type', [1, 6]) as $party)
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
                            </div>
                            {{-- Port details --}}
                            <div class="row">
                                <h4>Port Details</h4>
                                <hr>
                                <div class="col-xl-6 col-xxl-6">

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Loading Port:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="select2 form-control wide me-2" name="loading_port_id" placeholder="Select" required>
                                                <option value="">Select</option>
                                                @foreach ($ports as $port)
                                                <option value="{{$port->id}}" {{ old('loading_port_id') == $port->id ? 'selected' : '' }}>
                                                    {{$port->port_name}}
                                                </option>
                                                @endforeach
                                            </select>
                                            <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-target-field="loading_port_id" data-bs-target="#addNewPortDetails">
                                                <i class="bi bi-plus-lg">+</i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Discharge Port:<span class="text-danger">*</spna></label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="select2 form-control wide me-2" name="discharge_port_id" placeholder="Select" required>
                                                <option value="">Select</option>
                                                @foreach ($ports as $port)
                                                <option value="{{$port->id}}" {{ old('discharge_port_id') == $port->id ? 'selected' : '' }}>
                                                    {{$port->port_name}}
                                                </option>
                                                @endforeach
                                            </select>
                                            <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-target-field="discharge_port_id" data-bs-target="#addNewPortDetails">
                                                <i class="bi bi-plus-lg">+</i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Insurance:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <input type="text" class="form-control" id="insurance" name="insurance" value="{{ old('insurance') }}">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">F. Premium Amt:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" placeholder="0.00" name="fpa_amount" value="{{ old('fpa_amount') }}">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Transportation:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="transportation" name="transportation" value="{{ old('transportation') }}">
                                        </div>
                                    </div>

                                </div>
                                <div class="col-xl-6 col-xxl-6">

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Receipt Port:<span class="text-danger">*</spna></label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="select2 form-control wide me-2" name="receipt_port_id" placeholder="Select" required>
                                                <option value="">Select</option>
                                                @foreach ($ports as $port)
                                                <option value="{{$port->id}}" {{ old('receipt_port_id') == $port->id ? 'selected' : '' }}>
                                                    {{$port->port_name}}
                                                </option>
                                                @endforeach
                                            </select>
                                            <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-target-field="receipt_port_id" data-bs-target="#addNewPortDetails">
                                                <i class="bi bi-plus-lg">+</i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Delivery Port:<span class="text-danger">*</span>
                                        </label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="select2 form-control wide me-2" name="delivery_port_id" placeholder="Select" required>
                                                <option value="">Select</option>
                                                @foreach ($ports as $port)
                                                <option value="{{$port->id}}" {{ old('delivery_port_id') == $port->id ? 'selected' : '' }}>
                                                    {{$port->port_name}}
                                                </option>
                                                @endforeach
                                            </select>
                                            <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-target-field="delivery_port_id" data-bs-target="#addNewPortDetails">
                                                <i class="bi bi-plus-lg">+</i>
                                            </button>
                                        </div>
                                    </div>  
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Place of Destination:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select name="destination_port_id" class="select2 form-control wide me-2" required>
                                                <option value="">Select Destination</option>
                                                @foreach ($ports as $port)
                                                <option value="{{$port->id}}" {{ old('destination_port_id') == $port->id ? 'selected' : '' }}>
                                                    {{ $port->port_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                data-bs-toggle="modal" data-bs-target="#addNewPortDetails" data-target-field="destination_port_id">
                                                <i class="bi bi-plus-lg">+</i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Transportation Details:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="transportation_details" value="{{ old('transportation_details') }}">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Clearance:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="clearance" name="clearance" value="{{ old('clearance') }}">
                                        </div>
                                    </div>

                                    <!--<div class="mb-3 row">-->
                                    <!--    <label class="col-sm-3 col-form-label">Shipping Bill:</label>-->
                                    <!--    <div class="col-sm-9">-->
                                    <!--        <input type="text" class="form-control" name="shipping_bill" value="{{ old('shipping_bill') }}">-->
                                    <!--    </div>-->
                                    <!--</div>-->

                                </div>
                            </div>

                            {{-- cargo detail --}}
                            <div class="row">
                                <h4>Cargo Deails</h4>
                                <hr>
                                <div class="col-xl-6">

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">
                                            Packages:<span class="text-danger">*</span>
                                            <small>(Total PKG of all Containers)</small>
                                        </label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="quantity" value="{{ old('quantity') }}" required>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Freight:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="select2 form-control wide me-2" name="freight">
                                                <option value="">select</option>
                                                <option value="Prepaid" {{ old('freight') == 'Prepaid' ? 'selected' : '' }}>Prepaid</option>
                                                <option value="Collect" {{ old('freight') == 'Collect' ? 'selected' : '' }}>Collect</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Gross Wt:<span class="text-danger">*</span><br><small>(Total G.Weight)</small></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="gross_weight" required value="{{ old('gross_weight') }}">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Tare Wt: <small>(Total Tare Wt)</small></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="tare_weight" value="{{ old('tare_weight') }}">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Movement:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="select2 form-control wide" name="movement">
                                                <option value="">select</option>
                                                <option value="CY/CY" {{ old('movement') == 'CY/CY' ? 'selected' : '' }}>CY/CY</option>
                                                <option value="CY/CFS" {{ old('movement') == 'CY/CFS' ? 'selected' : '' }}>CY/CFS</option>
                                                <option value="CFS/CY" {{ old('movement') == 'CFS/CY' ? 'selected' : '' }}>CFS/CY</option>
                                                <option value="CFS/CFS" {{ old('movement') == 'CFS/CFS' ? 'selected' : '' }}>CFS/CFS</option>
                                                <option value="CY/DOOR" {{ old('movement') == 'CY/DOOR' ? 'selected' : '' }}>CY/DOOR</option>
                                                <option value="DOOR/DOOR" {{ old('movement') == 'DOOR/DOOR' ? 'selected' : '' }}>DOOR/DOOR</option>
                                                <option value="PORT/DOOR" {{ old('movement') == 'PORT/DOOR' ? 'selected' : '' }}>PORT/DOOR</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">ETA Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy" class="form-control" name="eta_date" value="{{ old('eta_date') }}">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">CBM:<small>(Total cbm)</small></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="cbm" value="{{ old('cbm') }}">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">PORT CUTOFF:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy" class="form-control" name="port_cutoff" value="{{ old('port_cutoff') }}">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">DOCUMENT CUTOFF:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy" class="form-control" name="document_cutoff" value="{{ old('document_cutoff') }}">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">REMARKS:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="remarks" value="{{ old('remarks') }}" required>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">BL Type:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="form-control wide me-2 select2" name="bl_type" placeholder="Select">
                                                <option value="">select</option>
                                                
                                                @foreach ($master_bl_types as $master_bl_type)
                                                <option value="{{$master_bl_type->id}}" {{ old('bl_type') == $master_bl_type->id ? 'selected' : '' }}>
                                                    {{$master_bl_type->bl_description}}
                                                </option>
                                                @endforeach
                                            </select>
                                            
                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                data-bs-toggle="modal" data-bs-target="#BlTypeModule" data-target-field="bl_type">
                                                <i class="bi bi-plus-lg">+</i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Package:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select name="package_id" class="select2 form-control wide me-2" required>
                                                <option value="">Select Package</option>
                                                @foreach ($packages as $packages)
                                                <option value="{{$packages->id}}" {{ old('package_id') == $packages->id ? 'selected' : '' }}>
                                                    {{$packages->package_code}}
                                                </option>
                                                @endforeach
                                            </select>
                                            <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#AddNewPackageModal">
                                                <i class="bi bi-plus-lg">+</i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Frt Charges:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="freight_charges" value="{{ old('freight_charges') }}">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Net Wt:<span class="text-danger">*</span><small>(Total Net Wt.)</small></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="net_weight" value="{{ old('net_weight') }}" required>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Volume:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="select2 form-control wide me-2" name="volume_unit">
                                                <option value="">select</option>
                                                <option value="KGS" {{ old('volume_unit') == 'KGS' ? 'selected' : '' }}>KGS</option>
                                                <option value="MTS" {{ old('volume_unit') == 'MTS' ? 'selected' : '' }}>MTS</option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Cargo Type:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="select2 form-control wide me-2" name="cargo_type" required>
                                                <option value="">select</option>
                                                <option value="FCL/FCL" {{ old('cargo_type') == 'FCL/FCL' ? 'selected' : '' }}>FCL/FCL</option>
                                                <option value="FCL/LCL" {{ old('cargo_type') == 'FCL/LCL' ? 'selected' : '' }}>FCL/LCL</option>
                                                <option value="LCL/FCL" {{ old('cargo_type') == 'LCL/FCL' ? 'selected' : '' }}>LCL/FCL</option>
                                                <option value="LCL/LCL" {{ old('cargo_type') == 'LCL/LCL' ? 'selected' : '' }}>LCL/LCL</option>
                                                <option value="PART OF FCL" {{ old('cargo_type') == 'PART OF FCL' ? 'selected' : '' }}>PART OF FCL</option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">ETD Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy" class="form-control" name="etd_date" value="{{ old('etd_date') }}">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">SI CUTOFF:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy" class="form-control" name="si_cutoff" value="{{ old('si_cutoff') }}">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">VGM CUTOFF:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy" class="form-control" name="vgm_cutoff" value="{{ old('vgm_cutoff') }}">
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">VGM Issued Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy" class="form-control" name="vgm_issued_date">
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">BL Issued Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy" class="form-control" name="bl_issued_date" value="{{ old('bl_issued_date') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Overseas Agent Details --}}
                            <div class="row">
                                <h4>Agent Details</h4>
                                <hr>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Agent Name:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="select2 form-control wide me-2" name="agent_id">
                                                <option value="">Select</option>
                                                @foreach ($parties->whereIn('party_type', [4]) as $party)
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
                                        <label class="col-sm-3 col-form-label">Delivery Agent Name:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="select2 form-control wide me-2" name="delivery_agent_id">
                                                <option value="">Select</option>
                                                @foreach ($parties->whereIn('party_type', [22]) as $party)
                                                <option value="{{$party->id}}" {{ old('delivery_agent_id') == $party->id ? 'selected' : '' }}>
                                                    {{$party->party_name}}
                                                </option>
                                                @endforeach
                                            </select>
                                            <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#partyDetailsModal" data-target-field="delivery_agent_id">
                                                <i class="bi bi-plus-lg">+</i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Issue Place:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="issue_place" value="{{ old('issue_place') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Place Of Acceptance:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="place_of_acceptance" value="{{ old('place_of_acceptance') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Stuffing Point:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="stuffing_point" value="{{ old('stuffing_point') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Stuffing Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control" placeholder="dd/mm/yy" name="stuffingDate" value="{{ old('stuffingDate') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Shipping Line:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="select2 form-control wide me-2" name="shipping_line_id">
                                                <option value="">Select Shipping Line</option>
                                                @foreach ($shipping_lines as $shipping_line)
                                                <option value="{{$shipping_line->id}}" {{ old('shipping_line_id') == $shipping_line->id ? 'selected' : '' }}>
                                                    {{$shipping_line->shipping_line_name}}
                                                </option>
                                                @endforeach
                                            </select>
                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                data-bs-toggle="modal" data-bs-target="#shippingModelDetails">
                                                <i class="bi bi-plus-lg">+</i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">No Of Origin:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="no_of_origin" value="{{ old('no_of_origin') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Sales Person:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="select2 form-control wide me-2" name="sales_person_id" placeholder="Select" required>
                                                <option value="">Select Sales Person</option>
                                                @foreach ($salePersons as $salePerson)
                                                <option value="{{$salePerson->id}}" {{ old('sales_person_id') == $salePerson->id ? 'selected' : '' }}>
                                                    {{$salePerson->name}}
                                                </option>
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
                                        <label class="col-sm-3 col-form-label">CHA:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="select2 form-control wide me-2" name="cha_id" placeholder="Select" >
                                                <option value="">Select CHA</option>
                                                @foreach ($parties->whereIn('party_type', [3]) as $party)
                                                <option value="{{$party->id}}" {{ old('cha_id') == $party->id ? 'selected' : '' }}>
                                                    {{$party->party_name}}
                                                </option>
                                                @endforeach
                                            </select>
                                            <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#partyDetailsModal" data-target-field="cha_id">
                                                <i class="bi bi-plus-lg">+</i>
                                            </button>
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
                                        <label class="col-sm-3 col-form-label">Goods Description:</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control h-100" name="goods_description" rows="3">{{ old('goods_description') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button class="btn btn-primary btn-sm" type="button">LOADING CONFIRMATION</button>
                                <button class="btn btn-primary btn-sm" type="button">HBL PRINT</button>
                                <a href="{{route('sea-exports.index')}}" class="btn btn-warning btn-sm" type="button">Cancel</a>
                                <button class="btn btn-primary btn-sm" type="submit">Save</button>
                            </div>
                            <div style="display:none" id="error-msg"></div>
                            <div id="form-msg"></div>
                            
                        </form>
                    </div>


                    <hr>
                    <div class="form-validation">
                        <form id="seaExportContainerForm" class="needs-validation" novalidate>
                            @csrf
                            <div class="row">
                                <h4>Container Details</h4>
                        
                                <!--<div class="col-xl-6">-->
                                <!--    <div class="mb-3 row">-->
                                <!--        <label class="col-sm-3 col-form-label">Sea Export ID:<span-->
                                <!--                class="text-danger">*</span></label>-->
                                <!--        <div class="col-sm-9">-->
                                <!--            <select name="sea_export_id" id="" class="select2 form-control wide me-2">-->
                                <!--                <option value="">select</option>-->
                                <!--                @foreach ($sea_exports as $sea_export)-->
                                <!--                <option value="{{$sea_export->id}}" {{ old('sea_export_id') == $sea_export->id ? 'selected' : '' }}>-->
                                <!--                    {{ $sea_export->id }}-->
                                <!--                </option>-->
                                <!--                <option value="{{$sea_export->id}}">{{$sea_export->id}}</option>-->
                                <!--                @endforeach-->
                                <!--            </select>-->
                                <!--        </div>-->
                                <!--    </div>-->
                                <!--</div>-->
                                <!--value="{{session('id')}}"-->
                                <input type="hidden" id="sea_export_id" value="{{session('id')}}"  name="sea_export_id" />

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Cont_Hbl:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="cont_hbl" class="form-control" value="{{ old('cont_hbl') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Gross Weight:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="gross_weight" class="form-control" value="{{ old('gross_weight') }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Total Package:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="total_package" class="form-control" value="{{ old('total_package') }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Ground Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy" name="ground_date" class="form-control" value="{{ old('ground_date') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Temp:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="temp" class="form-control" value="{{ old('temp') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Remarks:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="remarks" class="form-control" value="{{ old('remarks') }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Cont_Job No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="cont_job_no" class="form-control" value="{{ old('cont_job_no') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Container_No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="container_no" class="form-control" value="{{ old('container_no') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">CBM:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="cbm" class="form-control" value="{{ old('cbm') }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Cargo Type:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="cargo_type" class="form-control" value="{{ old('cargo_type') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">VGM WT:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="vgm_wt" class="form-control" value="{{ old('vgm_wt') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">SOC(Y/N):</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="soc" class="form-control" value="{{ old('soc') }}">
                                        </div>
                                    </div>
                                </div>

                                <!--<div class="col-xl-6">-->
                                <!--    <div class="mb-3 row">-->
                                <!--        <label class="col-sm-3 col-form-label">Commodity:</label>-->
                                <!--        <div class="col-sm-9">-->
                                <!--            <input type="text" name="commodity" class="form-control" value="{{ old('commodity') }}">-->
                                <!--        </div>-->
                                <!--    </div>-->
                                <!--</div>-->

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Size:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select name="size" class="form-control select2 wide me-2" required>
                                                <option value="">Select Size</option>
                                                <option value="1" {{ old('size') == '0' ? 'selected' : '' }}>0</option>
                                                <option value="20 GP" {{ old('size') == '20 GP' ? 'selected' : '' }}>20 GP</option>
                                                <option value="40 GP" {{ old('size') == '40 GP' ? 'selected' : '' }}>40 GP</option>
                                                <option value="40 HQ" {{ old('size') == '40 HQ' ? 'selected' : '' }}>40 HQ</option>
                                                <option value="20 OT" {{ old('size') == '20 OT' ? 'selected' : '' }}>20 OT</option>
                                                <option value="40 OT" {{ old('size') == '40 OT' ? 'selected' : '' }}>40 OT</option>
                                                <option value="20 FR" {{ old('size') == '20 FR' ? 'selected' : '' }}>20 FR</option>
                                                <option value="40 FR" {{ old('size') == '40 FR' ? 'selected' : '' }}>40 FR</option>
                                                <option value="20 TK" {{ old('size') == '20 TK' ? 'selected' : '' }}>20 TK</option>
                                                <option value="40 TK" {{ old('size') == '40 TK' ? 'selected' : '' }}>40 TK</option>
                                                <option value="20 RF" {{ old('size') == '20 RF' ? 'selected' : '' }}>20 RF</option>
                                                <option value="40 RF" {{ old('size') == '40 RF' ? 'selected' : '' }}>40 RF</option>
                                                <option value="20 ODO" {{ old('size') == '20 ODO' ? 'selected' : '' }}>20 ODO</option>
                                                <option value="40 ODO" {{ old('size') == '40 ODO' ? 'selected' : '' }}>40 ODO</option>
                                                <option value="40" {{ old('size') == '40' ? 'selected' : '' }}>40</option>
                                                <option value="45" {{ old('size') == '45' ? 'selected' : '' }}>45</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Refer(Y/N):</label>
                                        <div class="col-sm-9">
                                            <select name="refer" class="form-control select2 wide me-2">
                                                <option value="">Select</option>
                                                <option value="Y" {{ old('refer') == 'Y' ? 'selected' : '' }}>Y</option>
                                                <option value="N" {{ old('refer') == 'N' ? 'selected' : '' }}>N</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Agent Seal No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="agent_seal_no" class="form-control" value="{{ old('agent_seal_no') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Imo Code:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="imo_code" class="form-control" value="{{ old('imo_code') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Disposal:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="disposal" class="form-control" value="{{ old('disposal') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Sector:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="sector" class="form-control" value="{{ old('sector') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Cust_Seal No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="cust_seal_no" class="form-control" value="{{ old('cust_seal_no') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">FCL/LCL:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select name="fcl_lcl" class="form-control select2 wide me-2" required>
                                                <option value="">Select</option>
                                                <option value="FCL" {{ old('fcl_lcl') == 'FCL' ? 'selected' : '' }}>FCL</option>
                                                <option value="LCL" {{ old('fcl_lcl') == 'LCL' ? 'selected' : '' }}>LCL</option>
                                                <option value="ETY" {{ old('fcl_lcl') == 'ETY' ? 'selected' : '' }}>ETY</option>
                                                <option value="AIR" {{ old('fcl_lcl') == 'AIR' ? 'selected' : '' }}>AIR</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Net Weight:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="net_weight" class="form-control" value="{{ old('net_weight') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Uno No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="uno_no" class="form-control" value="{{ old('uno_no') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Detent Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy" name="detent_date" class="form-control" value="{{ old('detent_date') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Prev_Days:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="prev_days" class="form-control" value="{{ old('prev_days') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            {{-- Other Details --}}
                            <div class="row">
                                <h4>Other Details</h4>
                                <hr>
                                
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Mark & Numbers:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control h-100" name="mark_number" rows="2">{{ old('mark_number') }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Goods Description:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control h-100" name="goods_description" rows="2">{{ old('goods_description') }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Inv No / Inv Dt:</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control h-100" name="customer_inv_no" rows="2">{{ old('customer_inv_no') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Check List Date:</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control h-100" name="check_list_date" rows="2">{{ old('check_list_date') }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Sbill No / Sbill Date:</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control h-100" name="sbill_no" rows="2">{{ old('sbill_no') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Cartining Date:</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control h-100" name="cartining_date" rows="2">{{ old('cartining_date') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">LEO Date:</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control h-100" name="leo_date" rows="2">{{ old('leo_date') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">SOB Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy" class="form-control" name="sob_date" value="{{ old('sob_date') }}">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Commodity:</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control h-100" name="commodity" rows="2">{{ old('commodity') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button class="btn btn-primary" type="submit">Add CONTAINER</button>
                            </div>
                        </form>
                        
                        <div id="container_list">
                            <div id="searchFile"></div>
                        </div>

                    </div>
                    {{-- shipment form  --}}

                    <form id="shipmentLineForm" class="needs-validation" novalidate>
                        @csrf

                        <input type="hidden" id="shipment_sea_export_id" name="sea_export_id">

                        <div class="row">
                            <h4>Shipment Details</h4>
                            <hr>

                            <!-- Container -->
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Container:<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <select name="sea_export_cont_id" class="form-control select2 wide me-2" required>
                                            <option value="">Select Container</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Consignee -->
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Consignee:</label>
                                    <div class="col-sm-9">
                                        <select class="select2 form-control wide me-2" name="consignee_id" id="consignee_select">
                                            <option value="">Select</option>
                                            @foreach ($parties->whereIn('party_type', [1, 6]) as $party)
                                                <option value="{{ $party->id }}" {{ old('consignee_id') == $party->id ? 'selected' : '' }}>
                                                    {{ $party->party_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Invoice No -->
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Invoice No:</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="invoice_no" class="form-control"
                                            value="{{ old('invoice_no') }}">
                                    </div>
                                </div>
                            </div>

                            <!-- Invoice Date -->
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Invoice Date:</label>
                                    <div class="col-sm-9">
                                        <input type="date" name="invoice_date" class="form-control"
                                            value="{{ old('invoice_date') }}">
                                    </div>
                                </div>
                            </div>

                            <!-- Shipping Bill No -->
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Shipping Bill No:</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="shipping_bill_no" class="form-control"
                                            value="{{ old('shipping_bill_no') }}">
                                    </div>
                                </div>
                            </div>

                            <!-- Shipping Bill Date -->
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Shipping Bill Date:</label>
                                    <div class="col-sm-9">
                                        <input type="date" name="shipping_bill_date" class="form-control"
                                            value="{{ old('shipping_bill_date') }}">
                                    </div>
                                </div>
                            </div>

                            <!-- LEO Date -->
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">LEO Date:</label>
                                    <div class="col-sm-9">
                                        <input type="date" name="leo_date" class="form-control"
                                            value="{{ old('leo_date') }}">
                                    </div>
                                </div>
                            </div>

                            <!-- Carting Date -->
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Carting Date:</label>
                                    <div class="col-sm-9">
                                        <input type="date" name="carting_date" class="form-control"
                                            value="{{ old('carting_date') }}">
                                    </div>
                                </div>
                            </div>

                            <!-- Check List Date -->
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Check List Date:</label>
                                    <div class="col-sm-9">
                                        <input type="date" name="check_list_date" class="form-control"
                                            value="{{ old('check_list_date') }}">
                                    </div>
                                </div>
                            </div>

                            <!-- Packages -->
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Packages:</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="packages" class="form-control"
                                            value="{{ old('packages') }}">
                                    </div>
                                </div>
                            </div>

                            <!-- Gross Weight -->
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Gross Weight:</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="gross_weight" class="form-control"
                                            value="{{ old('gross_weight') }}">
                                    </div>
                                </div>
                            </div>

                            <!-- CBM -->
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">CBM:</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="cbm" class="form-control"
                                            value="{{ old('cbm') }}">
                                    </div>
                                </div>
                            </div>

                            <!-- Goods Description -->
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Goods Description:</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control h-100" name="goods_description" rows="3">{{ old('goods_description') }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Mark & Number -->
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Mark & Number:</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control h-100" name="mark_number" rows="3">{{ old('mark_number') }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Remarks -->
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Remarks:</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control h-100" name="remarks" rows="3">{{ old('remarks') }}</textarea>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button class="btn btn-warning" type="submit">
                                Add Shipment
                            </button>
                        </div>
                    </form>
                    <div id="shipmentLineList"></div>

                    <h4>File Upload</h4>
                    <hr>
                    <div class="form-validation">
                        <form class="needs-validation" action="{{route('multi-file-upload.updateFileUpload')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="file_related" value="sea_export">
                            <input type="hidden" name="job_no" id="job_no_hidden">
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
                        <!--<form id="SeaExportFileForm" method="post">-->
                        <!--    @csrf-->
                        <!--    <div class="col-xl-9">-->
                        <!--        <div class="mb-3 row">-->
                        <!--            <label class="col-sm-3 col-form-label">Find PDF File:<span class="text-danger">*</span></label>-->
                        <!--            <div class="col-sm-9">-->
                        <!--                <div class="d-flex">-->
                        <!--                    <select class="select2 form-control wide me-2"-->
                        <!--                        placeholder="Select" name="search_query" required>-->
                        <!--                        <option value="">select</option>-->
                        <!--                        @foreach ($files as $file)-->
                        <!--                        <option value="{{$file->id}}" {{ old('search_query') == $file->id ? 'selected' : '' }}>-->
                        <!--                            {{$file->file_name}}-->
                        <!--                        </option>-->
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

            </div>
        </div>
    </div>
</div>

<!-- sales person model  -->
@include('admin-main.admin.commonModelForms.salesperson_modal')

<!-- vessel model  -->
@include('admin-main.admin.commonModelForms.addOceanVslModel')


<!-- Add New Vessel Models -->


<!-- Add New Port Details -->
@include('admin-main.admin.commonModelForms.addNewPort_modal')

<!-- Add new Package Modal -->
@include('admin-main.admin.commonModelForms.addNewPackageModel')

<!-- Modal Party Details -->
@include('admin-main.admin.commonModelForms.modelPartyDetails')
<!-- Add new export Modal -->
@include('admin-main.admin.commonModelForms.addExportPartiesModel')
<!-- Add new Forwarder Modal -->
@include('admin-main.admin.commonModelForms.modelForwarder')
<!-- Add new Bl Type Module -->
@include('admin-main.admin.commonModelForms.moduleBlType')
<!--shipping line-->
@include('admin-main.admin.commonModelForms.shippinglineModel')

@endsection
@push('scripts')
<script>

    $(document).ready(function () {
        flatpickr("input[type='date']", {
            altInput: true,
            altFormat: "d/m/Y",   // what user sees
            dateFormat: "Y-m-d",  // what is submitted
            allowInput: true
        });

        $('.select2').select2({
            'width' : '100%'
        })

        $('#seaExportForm').on('submit', function (e) {
            e.preventDefault();

            let form = $(this);
            let isValid = true;

            // Remove previous error borders
            form.find('.input-error').removeClass('input-error');

            // Check required fields
            form.find('[required]').each(function() {
                if ($(this).val().trim() === '') {
                    $(this).addClass('input-error');
                    isValid = false;
                }
            });

            // Stop submission if invalid
            if (!isValid) {
                alert('Please fill all required fields.');
                return;
            }
            let formData = form.serialize() ;

            let submitBtn = form.find('button[type="submit"]');
            submitBtn.prop('disabled', true).text('Saving...');

            $.ajax({
                url: "{{ route('sea-exports.store') }}",
                type: "POST",
                data: formData,
                success: function (response) {
                    if(response.status){
                        // alert("Form saved successfully!");
                        $('#form-msg').text('Form saved successfully!').css({'color': 'green', 'padding': '8px'}).addClass('alert alert-success');
                        $('#sea_export_id').val(response.id)
                        $('#shipment_sea_export_id').val(response.id)
                    }else{
                        $('#error-msg')
                        .css({display: 'block', 'color': 'danger', 'padding': '8px'})
                        .text(response.message);
                    }

                    setTimeout(()=>{
                        $('#error-msg')
                        .css({display: ''})
                        .text('');
                    }, 3000)

                },
                error: function (xhr) {
                    console.log(xhr.responseText);

                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        let errorMessages = '';
                        $.each(errors, function (key, value) {
                            errorMessages += value[0] + '\n';
                        });
                        alert(errorMessages);
                    }
                },
                complete: function() {
                    submitBtn.prop('disabled', false).text('Save');
                }
            });
        });
    });

    $(document).ready(function () {
        $('#seaExportContainerForm').on('submit', function (e) {
            e.preventDefault();

            let form = $(this);
            let formData = form.serialize();

            let submitBtn = form.find('button[type="submit"]');
            submitBtn.prop('disabled', true).text('Saving...');

            $.ajax({
                url: "{{ route('sea-exports.addContainer') }}",
                type: "POST",
                data: formData,
                dataType: "json",
                success: function (response) {
                    console.log(response);
                    if(response.status){
                        let html = `
                        <div class="alert alert-secondary">
                        <strong>${response.data.container_no || '-'}</strong> |
                           Agent seal no: ${response.data.agent_seal_no || 0} |
                           Cust seal no : ${response.data.cust_seal_no || 0} |
                           size: ${response.data.size || 0}
                        </div>
                         `;
                        $('#searchFile').prepend(html);
                        // ADD CONTAINER TO SHIPMENT DROPDOWN
                        $('select[name="sea_export_cont_id"]').append(
                            `<option value="${response.data.id}">
                                ${response.data.container_no}
                            </option>`
                        );

                        form[0].reset();

                    }else{
                        alert("Please submit the general details form first. Otherwise, edit this form!");
                        $('#error-msg')
                        .text(response.message);

                    }
                },
                error: function (xhr) {
                    console.log(xhr.responseText);

                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        let errorMessages = '';
                        $.each(errors, function (key, value) {
                            errorMessages += value[0] + '\n';
                        });
                        alert(errorMessages);
                    }
                },
                complete: function() {
                    submitBtn.prop('disabled', false).text('Save');
                }
            });
        });
    });

    function updateFullJobNo(selectElement) {
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        const selectedJobId = selectedOption ? selectedOption.value : ''; // ✅ job_number->id
        const selectedJobNo = selectedOption ? selectedOption.dataset.jobno : '';
        const selectedJobActivity = selectedOption ? selectedOption.dataset.jobactivity : '';
        const financialYear = "{{ $financialYear }}"; // from backend

        // Update hidden job_no in first form
        const jobHidden = document.getElementById('job_no_hidden');
        if (jobHidden) jobHidden.value = selectedJobId; // ✅ set the job_number->id

        // Update hidden job_no in file upload form
        const uploadHidden = document.querySelector(
            'form[action="{{ route('multi-file-upload.updateFileUpload') }}"] #job_no_hidden'
        );
        if (uploadHidden) uploadHidden.value = selectedJobId; // ✅ set the job_number->id
    }

    // Optional: call on page load if old value exists
    window.addEventListener('DOMContentLoaded', function () {
        const select = document.getElementById('job_numbers');
        if (select.value) {
            updateFullJobNo(select);
        }
    });
</script>
<script>
    (function() {
        'use strict'

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
    $(document).ready(function() {
        
        // new export party model
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
        
        // party model details
        let targetField = null;
    
        // Detect which field opened the modal
        $('#partyDetailsModal').on('show.bs.modal', function (event) {
            const button = $(event.relatedTarget);
            targetField = button.data('target-field');
        });
        
        // Handle new import party form submission
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
                        
                        // ✅ Include all dropdown names here
                        const partySelectNames = [
                            'consignor_id',
                            'consignee_id',
                            'notify_id',
                            'notify2_id',
                            'agent_id',
                            'delivery_agent_id',
                            'cha_id'
                        ];
        
                        partySelectNames.forEach(function(name) {
                            const select = $('select[name="' + name + '"]');
                            if (select.length) {
                                // Add new option if not exists
                                if (select.find('option[value="' + partyId + '"]').length === 0) {
                                    const newOption = new Option(partyName, partyId, false, false);
                                    select.append(newOption);
                                }
        
                                // ✅ Select only the triggered one
                                if (targetField === name) {
                                    select.val(partyId).trigger('change');
                                } else {
                                    // Refresh others (so new option appears)
                                    select.trigger('change.select2');
                                }
                            }
                        });
                    } else {
                        $('#partyNameError').text(response.message).show();
                    }
        
                    // Reset and close modal
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
        
        // port model
        let targetPortField = null;
    
        // Capture which select opened the modal
        $('#addNewPortDetails').on('show.bs.modal', function (event) {
            const button = $(event.relatedTarget);
            targetPortField = button.data('target-field'); // e.g. loading_port_id
        });
        
        // Handle form submit
        $('#portDetailsModel').on('submit', function(e) {
            e.preventDefault();
        
            $.ajax({
                url: "{{ route('new-port.store') }}",
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        const portId = response.port.id;
                        const portName = response.port.name;
        
                        // List of all select names
                        const portSelectNames = [
                            'loading_port_id',
                            'discharge_port_id',
                            'receipt_port_id',
                            'delivery_port_id',
                            'destination_port_id'
                        ];
        
                        portSelectNames.forEach(function(name) {
                            const select = $('select[name="' + name + '"]');
                            if (select.length) {
                                // Check if this option already exists
                                if (select.find('option[value="' + portId + '"]').length === 0) {
                                    const newOption = new Option(portName, portId, false, false);
                                    select.append(newOption);
                                }
        
                                // Only select it in the field that opened the modal
                                if (targetPortField === name) {
                                    select.val(portId).trigger('change');
                                } else {
                                    // Just refresh select2 so it shows the latest options
                                    select.trigger('change.select2');
                                }
                            }
                        });
                    }
        
                    // Reset and close modal
                    $('#portDetailsModel')[0].reset();
                    $('#addNewPortDetails').modal('hide');
                },
                error: function(xhr) {
                    alert('Failed to add port details');
                    console.error('Error:', xhr.responseText);
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
                    const newOption = new Option(response.package.name, response.package.id, true, true);
                    $('select[name="package_id"]').append(newOption).trigger('change');
                        
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

        // Add new Bl Type Module
        $('#blTypeForm').on('submit', function(e) {
            e.preventDefault();
    
            $.ajax({
                url: "{{ route('bltype.store') }}", 
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    // Add the new option to select dropdowns
                    $('select[name="bl_type"]').each(function() {
                        $(this).append(`<option value="${response.bltype.id}" selected>${response.bltype.name}</option>`);
                    });
    
                    // Close modal and reset form
                    $('#blTypeForm')[0].reset();
                    $('#BlTypeModule').modal('hide');
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
        
        // ocean vassel model
        $('#oceanVslForm').on('submit', function(e) {
            e.preventDefault();
    
            $.ajax({
                url: "{{ route('new-vessels.store') }}", // route name
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    // Append the new vessel to the select dropdown
                    // const newOption = new Option(response.vessel_name, response.id, true, true);
                    // $('#vesselDropdown').append(newOption).trigger('change');
                    $('select[name="vessel_id"]').each(function() {
                        $(this).append(`<option value="${response.id}" selected>${response.vessel_name}</option>`);
                    });
    
                    // Close modal and reset form
                    $('#oceanVslForm')[0].reset();
                    $('#oceanVslModal').modal('hide');
                },
                error: function(xhr) {
                    alert('Failed to add vessel details');
    
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
    
        // add sales person
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
        
        // shipping line
        $('#shippingLineForm').on('submit', function(e) {
            e.preventDefault();
    
            $.ajax({
                url: "{{ route('new-shipping-line.store') }}", // route name
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    
                    if(!response.status){
                        $('#shipping-error-msg').text(response.message).css('color', 'red');
                        return;
                    }
                    
                    // Add the new option to select dropdowns
                    $('select[name="shipping_line_id"]').each(function() {
                        $(this).append(`<option value="${response.id}" selected>${response.shipping_line_name}</option>`);
                    });
    
                    // Close modal and reset form
                    $('#shippingLineForm')[0].reset();
                    $('#shippingModelDetails').modal('hide');
                },
                error: function(xhr) {
                    alert('Failed to add Shipping line');
    
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

        //change the job numbers
        $('#job_numbers').on('change', function(e) {
            e.preventDefault();
    
            var selectNumber = $(this).val();
            // let job_no = $(this).find('option:selected').data('jobno');
            var selectJobActivity = $(this).find(':selected').data('jobactivity');
             
            $('#consignee_id').next('.select2').find('.select2-selection').css('border-color', '');
            $('#shipper_id').next('.select2').find('.select2-selection').css('border-color', '');
    
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
                      
                        $('#shipper_id').val(response.job_party_id);
                        
                        $('#shipper_id').trigger('change');
                        
                        $('#shipper_id').next('.select2-container')
                        .find('.select2-selection')
                        .css({
                            'cursor': 'not-allowed',
                            'background-color': '#e9ecef'
                        });
                        
                        $('#hidden_shipper_id').val(response.job_party_id);
                        $('#full_job_no').val(response.jobMasterData.full_job_no);
                    },
                    error: function(xhr) {
                        let msg = "Something went wrong!";

                        // If backend returns { "error": "Job already exists" }
                        if (xhr.responseJSON && xhr.responseJSON.error) {
                            msg = xhr.responseJSON.error;
                        }
                    
                        $("#jobErrorBox").hide().html(msg).fadeIn();
			            $('#seaExportForm')[0].reset();
                    }
                });
            }
            
            
        });
        
    });

</script>
<script>
    document.getElementById('SeaExportFileForm').addEventListener('submit', function(e) {
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
                console.log(data);

                document.getElementById('searchFile').innerHTML = data;
            })
            .catch(error => {
                // console.error('Error:', error);
            });
    });

    function clearSearchFile() {
        document.getElementById("searchFile").innerHTML = "";
    }

    // Reset target after modal closes
    $('#partyDetailsModal').on('hidden.bs.modal', function () {
        targetField = null;
    });
    
</script>
<script>
    $(document).ready(function () {
        $('#shipmentLineForm').on('submit', function (e) {
            e.preventDefault();

            let form = $(this);
            let formData = form.serialize();

            let submitBtn = form.find('button[type="submit"]');
            submitBtn.prop('disabled', true).text('Saving...');

            $.ajax({
                url: "{{ route('sea-exports.addShipmentLine') }}",
                type: "POST",
                data: formData,
                dataType: "json",
                success: function (response) {
                    if(response.status){
                        let html = `
                        <div class="alert alert-secondary">
                        <strong>${response.consigneeName || '-'}</strong> |
                           Invoice no: ${response.data.invoice_no || 0} |
                           Shipping no : ${response.data.shipping_bill_no || 0} |
                           Packages: ${response.data.packages || 0}
                        </div>
                         `;
                        $('#shipmentLineList').prepend(html);
                        form[0].reset();
                    }else{
                        alert("Please submit the general details form first. Otherwise, edit this form!");
                        $('#error-msg')
                        .text(response.message);

                    }
                },
                error: function (xhr) {
                    console.log(xhr.responseText);

                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        let errorMessages = '';
                        $.each(errors, function (key, value) {
                            errorMessages += value[0] + '\n';
                        });
                        alert(errorMessages);
                    }
                },
                complete: function() {
                    submitBtn.prop('disabled', false).text('Save');
                }
            });
        });
    });
</script>
@endpush