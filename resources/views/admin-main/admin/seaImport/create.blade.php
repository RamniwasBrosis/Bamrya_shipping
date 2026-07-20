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
        <li class="breadcrumb-item active"><a href="#">Add Sea Import BL</a></li>
    </ol>
    <a href="{{ url('admin/sea-imports') }}" class="text-primary"><- Go Back</a>
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
@if($errors->any())
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
                    <h4 class="card-title">Add New BL</h4>
                </div><br>
                <div class="card-body">
                    <form class="needs-validation" id="seaImportForm" novalidate>
                        @csrf
                        <div class="row form-material">
                            <div class="mb-3 row col-xl-3 col-xxl-12 col-xl-6 row">
                                <label class="col-sm-3 col-form-label">BL Issued By:<span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <div class="d-flex gap-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="1" id="Forwarder" name="bl_issue_by"
                                                {{ old('bl_issue_by', '1') == '1' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="bl_issue_by_1">
                                                Forwarder
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="2" id="NVOCC" name="bl_issue_by"
                                                {{ old('bl_issue_by') == '2' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="bl_issue_by_2">
                                                NVOCC
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <h4>General Details</h4>
                            <hr>
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Job No:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select name="job_no" class="form-control wide me-2 select2" id="job_numbers" required>
                                                <option value="">select</option>
                                                @foreach ($job_numbers as $job_number)
                                                <option value="{{$job_number->id}}" data-jobno="{{ $job_number->job_no }}" data-jobActivity="{{ $job_number->job_activity }}"  {{ old('job_numbers') == $job_number->job_no ? 'selected' : '' }}>
                                                    {{$job_number->job_no}}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">MBL No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="mbl_no" name="" value="{{ old('mbl_no') }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">HBL No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="hbl_no" name="" value="{{old('hbl_no')}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">IGM No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="igm_no" name="" value="{{old('igm_no')}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Item No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="item_no" name="" value="{{old('item_no')}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Vessel Name:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <input type="text" name="vessel_name" name="" value="{{old('vessel_name')}}" class="form-control" required>
                                            <!--<select name="vessel_id" class="select2 form-control wide me-2">-->
                                            <!--    <option value="">select</option>-->
                                            <!--    @foreach ($vessels as $vessel)-->
                                            <!--        <option value="{{$vessel->id}}" {{ old('vessel_id') == $vessel->id ? 'selected' : '' }}>-->
                                            <!--            {{$vessel->vessel_name}}-->
                                            <!--        </option>-->
                                            <!--    @endforeach-->
                                            <!--</select>-->
                                            <!--<button type="button" class="btn btn-sm btn-outline-primary"-->
                                            <!--    data-bs-toggle="modal" data-bs-target="#oceanVslModal">-->
                                            <!--    <i class="bi bi-plus-lg">+</i>-->
                                            <!--</button>-->
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Enquiry Reference No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="enquiry_reference_no" name="" value="{{old('enquiry_reference_no')}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">ETA Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy"  name="eta_date" name="" value="{{old('eta_date')}}" class="form-control">
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Booking No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="booking_no" value="{{ old('booking_no') }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Reg No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="reg_no" name="" value="{{ old('reg_no') }}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Cargo(Cust):<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select name="cargo_type" class="default-select form-control wide me-2" required>
                                                <option value="">select</option>
                                                <option value="FCL" {{ old('cargo_type') == 'FCL' ? 'selected' : '' }}>FCL</option>
                                                <option value="LCL" {{ old('cargo_type') == 'LCL' ? 'selected' : '' }}>LCL</option>
                                                <option value="ETY" {{ old('cargo_type') == 'ETY' ? 'selected' : '' }}>ETY</option>
                                                <!--<option value="AIR" {{ old('cargo_type') == 'AIR' ? 'selected' : '' }}>AIR</option>-->

                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">MBL Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy"  name="mbl_date" name="" value="{{old('mbl_date')}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">HBL Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy"  name="hbl_date" name="" value="{{old('hbl_date')}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">IGM Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy"  name="igm_date" name="" value="{{old('igm_date')}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Sub Item No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="sub_item_no" name="" value="{{old('sub_item_no')}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Voy. No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="voyage_no" value="{{old('voyage_no')}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Arrival Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy"  name="arrival_date" value="{{old('arrival_date')}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">ETD Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy"  name="etd_date" value="{{old('etd_date')}}" class="form-control">
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Booking Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy"  name="booking_date" value="{{old('booking_date')}}" class="form-control">
                                        </div>
                                    </div>
                                    <!--<div class="mb-3 row">-->
                                    <!--    <label class="col-sm-3 col-form-label">SOB Date:</label>-->
                                    <!--    <div class="col-sm-9">-->
                                    <!--        <input type="date" placeholder="dd/mm/yy" name="sob_date" value="{{old('sob_date')}}" class="form-control">-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                    
                                </div>
                            </div>
                             <h4>Party Details</h4>
                            <hr>
                            <div class="row">
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
                                            <input type="hidden" name="consignee_id" id="consignee_id_hidden_input" />
                                            <select name="consignee_id" class="select2 form-control wide me-2" id="consignee_id" required>
                                                <option value="">Select Consignee</option>
                                                @foreach ($parties->whereIn('party_type', [1, 2]) as $party)
                                                <option value="{{$party->id}}" {{ old('consignee_id') == $party->id ? 'selected' : '' }}>
                                                    {{ $party->party_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                data-bs-toggle="modal" data-bs-target="#partyDetailsModal" data-target-field="consignee_id">
                                                <i class="bi bi-plus-lg">+</i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-xxl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Notify:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select name="notify_id" class="select2 form-control wide me-2">
                                                <option value="">Select Notify</option>
                                                @foreach ($parties->whereIn('party_type', [1, 2]) as $party)
                                                <option value="{{$party->id}}" {{ old('notify_id') == $party->id ? 'selected' : '' }}>
                                                    {{ $party->party_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                data-bs-toggle="modal" data-bs-target="#partyDetailsModal" data-target-field="notify_id">
                                                <i class="bi bi-plus-lg">+</i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Notify 2:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="select2 form-control wide me-2" name="notify2_id" placeholder="Select">
                                                <option value="">Select Notify 2</option>
                                                @foreach ($parties->whereIn('party_type', [1, 2]) as $party)
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
                                <div class="col-xl-6 col-xxl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">CHA:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select name="cha_id" class="select2 form-control wide me-2">
                                                <option value="">Select CHA</option>
                                                @foreach ($parties->where('party_type', 3) as $party)
                                                <option value="{{$party->id}}" {{ old('cha_id') == $party->id ? 'selected' : '' }}>
                                                    {{ $party->party_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                data-bs-toggle="modal" data-bs-target="#partyDetailsModal" data-target-field="cha_id">
                                                <i class="bi bi-plus-lg">+</i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-xl-6 col-xxl-6">
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
                            </div>
                            
                             <h4>Port Details</h4>
                            <hr>
                            <div class="row">
                                <div class="col-xl-6 col-xxl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Loading Port:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select name="loading_port_id" class="select2 form-control wide me-2" required>
                                                <option value="">Select Loading</option>
                                                @foreach ($ports as $port)
                                                <option value="{{$port->id}}" {{ old('loading_port_id') == $port->id ? 'selected' : '' }}>
                                                    {{$port->port_name}}
                                                </option>
                                                @endforeach
                                            </select>
                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                data-bs-toggle="modal" data-bs-target="#addNewPortDetails" data-target-field="loading_port_id">
                                                <i class="bi bi-plus-lg">+</i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Discharge Port:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select name="discharge_port_id" class="form-control wide me-2 select2" required>
                                                <option value="">Select Discharge</option>
                                                @foreach ($ports as $port)
                                                <option value="{{$port->id}}" {{ old('discharge_port_id') == $port->id ? 'selected' : '' }}>
                                                    {{$port->port_name}}
                                                </option>
                                                @endforeach
                                            </select>
                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                data-bs-toggle="modal" data-bs-target="#addNewPortDetails" data-target-field="discharge_port_id">
                                                <i class="bi bi-plus-lg">+</i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Shipping Line:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select name="shipping_line_id" class="select2 form-control wide me-2">
                                                <option value="">Select Shipping Line</option>
                                                @foreach ($shippingLines as $shippingLine)
                                                <option value="{{$shippingLine->id}}" {{ old('shipping_line_id') == $shippingLine->id ? 'selected' : '' }}>
                                                    {{ $shippingLine->shipping_line_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                data-bs-toggle="modal" data-bs-target="#shippingModelDetails">
                                                <i class="bi bi-plus-lg">+</i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">CFS Yard:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select name="cfs_yard_id" class="select2 form-control wide me-2">
                                                <option value="">Select CFS Yard</option>
                                                @foreach ($parties->where('party_type', 7) as $party)
                                                <option value="{{$party->id}}" {{ old('cfs_yard_id') == $party->id ? 'selected' : '' }}>
                                                    {{ $party->party_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                data-bs-toggle="modal" data-bs-target="#partyDetailsModal" data-target-field="cfs_yard_id">
                                                <i class="bi bi-plus-lg">+</i>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Empty Yard:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select name="empty_yard_id" class="select2 form-control wide me-2">
                                                <option value="">Select Empty Yard</option>
                                                @foreach ($parties->where('party_type', 5) as $party)
                                                <option value="{{$party->id}}" {{ old('empty_yard_id') == $party->id ? 'selected' : '' }}>
                                                    {{ $party->party_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                data-bs-toggle="modal" data-bs-target="#partyDetailsModal" data-target-field="empty_yard_id">
                                                <i class="bi bi-plus-lg">+</i>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">CoLoader:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select name="coloader_id" class="select2 form-control wide me-2">
                                                <option value="">Select CoLoader</option>
                                                @foreach ($parties->where('party_type', 19) as $party)
                                                <option value="{{$party->id}}" {{ old('coloader_id') == $party->id ? 'selected' : '' }}>
                                                    {{ $party->party_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                data-bs-toggle="modal" data-bs-target="#partyDetailsModal" data-target-field="coloader_id">
                                                <i class="bi bi-plus-lg">+</i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-xxl-6">
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
                                        <label class="col-sm-3 col-form-label">Place of Receipt:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="select2 form-control wide me-2" name="receipt_port_id" placeholder="Select" required>
                                                <option value="">Select Receipt</option>
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
                                        <label class="col-sm-3 col-form-label">Delivery Port:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select name="delivery_port_id" class="select2 form-control wide me-2" required>
                                                <option value="">Select Delivery</option>
                                                @foreach ($ports as $port)
                                                <option value="{{$port->id}}" {{ old('delivery_port_id') == $port->id ? 'selected' : '' }}>
                                                    {{ $port->port_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                data-bs-toggle="modal" data-bs-target="#addNewPortDetails" data-target-field="delivery_port_id">
                                                <i class="bi bi-plus-lg">+</i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Agent Name:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select name="agent_id" id="agent_id" class="select2 form-control wide me-2">
                                                <option value="">Select</option>
                                                @foreach ($parties->where('party_type', 4) as $party)
                                                <option value="{{$party->id}}" {{ old('agent_id') == $party->id ? 'selected' : '' }}>
                                                    {{ $party->party_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                data-bs-toggle="modal" data-bs-target="#partyDetailsModal" data-target-field="agent_id">
                                                <i class="bi bi-plus-lg">+</i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Delivery Agent Name:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select name="delivery_agent_id" id="delivery_agent_id" class="select2 form-control wide me-2">
                                                <option value="">Select</option>
                                                @foreach ($parties->whereIn('party_type', [22, 4]) as $party)
                                                    <option value="{{ $party->id }}" {{ old('delivery_agent_id') == $party->id ? 'selected' : '' }}>
                                                        {{ $party->party_name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                data-bs-toggle="modal" data-bs-target="#partyDetailsModal" data-target-field="delivery_agent_id">
                                                <i class="bi bi-plus-lg">+</i>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Sales Person:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select name="sales_person_id" class="select2 form-control wide me-2">
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
                            </div>

                            <h4>Cargo Details</h4>
                            <hr>
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Packages:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="quantity" name="" value="{{old('quantity')}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Freight:</label>
                                        <div class="col-sm-9">
                                            <select name="freight" class="default-select form-control wide me-2">
                                                <option value="">select</option>
                                                <option value="P" {{ old('freight') == 'P' ? 'selected' : '' }}>Prepaid</option>
                                                <option value="C" {{ old('freight') == 'C' ? 'selected' : '' }}>Collect</option>
                                            </select>
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
                                    <!--<div class="mb-3 row">-->
                                    <!--    <label class="col-sm-3 col-form-label">CBM:<span class="text-danger">*</span></label>-->
                                    <!--    <div class="col-sm-9">-->
                                    <!--        <input type="text" name="cbm" name="" value="{{old('cbm')}}" class="form-control">-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Material:</label>
                                        <div class="col-sm-9 d-flex align-items-center gap-3">
                                            <div class="form-check">
                                                <input type="radio" name="is_hazardous" value="1" class="form-check-input"
                                                    {{ old('is_hazardous') === '1' ? 'checked' : '' }}>
                                                <label class="form-check-label">HAZ</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" name="is_hazardous" value="0" class="form-check-input"
                                                    {{ old('is_hazardous', '0') === '0' ? 'checked' : '' }}>
                                                <label class="form-check-label">NON-HAZ</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">IMO CD:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="imo_cd" name="" value="{{old('imo_cd')}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">FreeDays:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="free_days" name="" value="{{old('free_days')}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Insurance:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="insurance" id="insurance" value="{{old('insurance')}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Transportation:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="transportation" id="transportation" value="{{old('transportation')}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Clearance:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="clearance" id="clearance" value="{{old('clearance')}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Delivery Order:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy"  name="delivery_order_date" value="{{old('delivery_order_date')}}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Package Type:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select name="package_id" class="select2 form-control wide me-2">
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
                                        <label class="col-sm-3 col-form-label">Gross Wt:<span
                                                class="text-danger">*</span> <small>(Total Of all Containers)</small></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="gross_weight" name="" value="{{old('gross_weight')}}" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Net Wt:<span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="net_weight" name="" value="{{old('net_weight')}}" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Cargo:</label>
                                        <div class="col-sm-9">
                                            <select name="cargo" class="default-select form-control wide me-2">
                                                <option value="">Select Cargo</option>
                                                <option value="LOCAL" {{ old('cargo') == 'LOCAL' ? 'selected' : '' }}>LOCAL</option>
                                                <option value="SMTP" {{ old('cargo') == 'SMTP' ? 'selected' : '' }}>SMTP</option>
                                                <option value="TP" {{ old('cargo') == 'TP' ? 'selected' : '' }}>TP</option>
                                                <option value="UB" {{ old('cargo') == 'UB' ? 'selected' : '' }}>UB</option>
                                                <option value="GOVT" {{ old('cargo') == 'GOVT' ? 'selected' : '' }}>GOVT</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Del. Type:</label>
                                        <div class="col-sm-9">
                                            <select name="delivery_type" class="default-select form-control wide me-2">
                                                <option value="">select</option>
                                                <option value="F" {{ old('delivery_type') == 'FACTORY' ? 'selected' : '' }}>FACTORY</option>
                                                <option value="D" {{ old('delivery_type') == 'DOCK' ? 'selected' : '' }}>DOCK</option>
                                                <option value="L" {{ old('delivery_type') == 'LCL' ? 'selected' : '' }}>LCL</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">UNO CD:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="uno_cd" name="" value="{{old('uno_cd')}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">BL Type:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select name="hbl_type" id="bl_type_" class="form-control wide me-2">
                                                <option value="">select</option>
                                                
                                                @foreach ($master_bl_types as $master_bl_type)
                                                <option value="{{$master_bl_type->id}}" {{ old('hbl_type') == $master_bl_type->id ? 'selected' : '' }}>
                                                    {{$master_bl_type->bl_description}}
                                                </option>
                                                @endforeach
                                                
                                                <!--<option value="SURRENDER" {{ old('hbl_type') == 'SURRENDER' ? 'selected' : '' }}>SURRENDER</option>-->
                                                <!--<option value="ORIGINAL" {{ old('hbl_type') == 'ORIGINAL' ? 'selected' : '' }}>ORIGINAL</option>-->
                                                <!--<option value="SEAWAY" {{ old('hbl_type') == 'SEAWAY' ? 'selected' : '' }}>SEAWAY</option>-->
                                            </select>
                                            
                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                data-bs-toggle="modal" data-bs-target="#BlTypeModule" data-target-field="hbl_type">
                                                <i class="bi bi-plus-lg">+</i>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">F.Premium.Amt:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="fpa_amount" name="" value="{{old('fpa_amount')}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Transportation Details:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="transportation_details" name="" value="{{old('transportation_details')}}" class="form-control">
                                        </div>
                                    </div>
                                    <!--<div class="mb-3 row">-->
                                    <!--    <label class="col-sm-3 col-form-label">Bill of Entry:</label>-->
                                    <!--    <div class="col-sm-9">-->
                                    <!--        <input type="text" name="bill_of_entry" name="" value="{{old('bill_of_entry')}}" class="form-control">-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xl-6 col-xxl-6">
                                    
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Sub Job No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="sub_job_no" value="{{old('sub_job_no')}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Obl No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="obl_no" name="" value="{{old('obl_no')}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Ref. No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="ref_no" name="" value="{{old('ref_no')}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Invoice Ref. No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="inv_ref_no" name="" value="{{old('inv_ref_no')}}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-xxl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Surveyor:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select name="surveyor_id" class="select2 form-control wide me-2">
                                                <option value="">Select Surveyor</option>
                                                @foreach ($parties as $party)
                                                <option value="{{ $party->id }}" {{ old('surveyor_id') == $party->id ? 'selected' : '' }}>
                                                    {{ $party->party_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Obl Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy"  name="obl_date" name="" value="{{old('obl_date')}}" class="form-control">
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Validity Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy"  name="validity_date" name="" value="{{old('validity_date')}}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h4>Other Details</h4>
                            <hr>
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Remarks:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="remarks" name="" value="{{old('remarks')}}" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">User Name:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="username" name="" value="{{old('username')}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Ex Work:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="ex_work" name="" value="{{old('ex_work')}}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Prealert Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy"  name="prealert_date" name="" value="{{old('prealert_date')}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Amount:</label>
                                        <div class="col-sm-9">
                                            <input type="text" placeholder=""  name="amount" value="{{old('amount')}}" class="form-control">
                                        </div>
                                    </div>
                                    <!--<div class="mb-3 row">-->
                                    <!--    <label class="col-sm-3 col-form-label">Inv No Full:</label>-->
                                    <!--    <div class="col-sm-9">-->
                                    <!--        <input type="text" name="inv_no_full" name="" value="{{old('inv_no_full')}}" class="form-control">-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button class="btn btn-success btn-sm" type="button">CARGO ARRIVAL NOTICE</button>
                                <button class="btn btn-warning btn-sm" type="button">Cancel</button>
                                <!--<button class="btn btn-success btn-sm" type="button">Print</button>-->
                                <button class="btn btn-primary btn-sm" type="submit">Save</button>
                            </div>
                        </div>
                        <div style="display:none" id="error-msg" class="alert alert-danger"></div>
                            <div style="display:none" id="success-msg" class="alert alert-success"></div>
                    </form>

                    <h4>Container Details</h4>
                    <hr>
                    <div class="form-validation">
                        <form class="needs-validation" id="seaImportContainerForm">
                            @csrf
                            <div class="row">
                             
                                <input type="hidden" id="sea_import_id" name="sea_import_id" />
                                <!--<div class="col-xl-6">-->
                                <!--    <div class="mb-3 row row">-->
                                <!--        <label class="col-sm-3 col-form-label">Cont_Hbl:</label>-->
                                <!--        <div class="col-sm-9">-->
                                <!--            <input type="text" name="cont_hbl" value="{{ old('cont_hbl') }}" class="form-control">-->
                                <!--        </div>-->
                                <!--    </div>-->
                                <!--</div>-->
                                <div class="col-xl-6">
                                    <div class="mb-3 row row">
                                        <label class="col-sm-3 col-form-label">Gross Weight:<span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="gross_weight" value="{{ old('gross_weight') }}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-xl-6">
                                    <div class="mb-3 row row">
                                        <label class="col-sm-3 col-form-label">Net Weight:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="net_weight" value="{{ old('net_weight') }}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row row">
                                        <label class="col-sm-3 col-form-label">Total Package:<span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="total_package" value="{{old('total_package')}}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row row">
                                        <label class="col-sm-3 col-form-label">Ground Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy"  name="ground_date" value="{{old('ground_date')}}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row row">
                                        <label class="col-sm-3 col-form-label">TP/ICD(T/I):</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="tp_icd" value="{{old('tp_icd')}}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row row">
                                        <label class="col-sm-3 col-form-label">Printed:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="printed" value="{{old('printed')}}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row row">
                                        <label class="col-sm-3 col-form-label">Container No:<span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="container_no" value="{{old('container_no')}}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row row">
                                        <label class="col-sm-3 col-form-label">CBM:<span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="cbm" value="{{old('cbm')}}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row row">
                                        <label class="col-sm-3 col-form-label">Cargo Type:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select class="default-select form-control wide me-2" name="cargo_type" placeholder="Select">
                                                <option value="">select</option>
                                                <option value="GEN" {{ old('cargo_type') == 'GEN' ? 'selected' : '' }}>GEN</option>
                                                <option value="HAZ" {{ old('cargo_type') == 'HAZ' ? 'selected' : '' }}>HAZ</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row row">
                                        <label class="col-sm-3 col-form-label">Ground Days:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="ground_days" value="{{old('ground_days')}}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row row">
                                        <label class="col-sm-3 col-form-label">SOC(Y/N):</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="soc_yn" value="{{old('soc_yn')}}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row row">
                                        <label class="col-sm-3 col-form-label">Selected:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="selected" value="{{old('selected')}}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row row">
                                        <label class="col-sm-3 col-form-label">Size:<span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select class="select2 form-control wide me-2" name="size" placeholder="Select">
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
                                    <div class="mb-3 row row">
                                        <label class="col-sm-3 col-form-label">Refer(Y/N):</label>
                                        <div class="col-sm-9">
                                            <select class="default-select form-control wide me-2" name="refer" placeholder="Select">
                                                <option value="">select</option>
                                                <option value="Y" {{ old('refer') == 'Y' ? 'selected' : '' }}>Y</option>
                                                <option value="N" {{ old('refer') == 'N' ? 'selected' : '' }}>N</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row row">
                                        <label class="col-sm-3 col-form-label">Detent Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy"  name="detent_date" value="{{old('detent_date')}}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row row">
                                        <label class="col-sm-3 col-form-label">Imo Code:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="imo_code" value="{{old('imo_code')}}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row row">
                                        <label class="col-sm-3 col-form-label">Disposal:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="disposal" value="{{old('disposal')}}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row row">
                                        <label class="col-sm-3 col-form-label">Sector:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="sector" value="{{old('sector')}}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <!--<div class="col-xl-6">-->
                                <!--    <div class="mb-3 row row">-->
                                <!--        <label class="col-sm-3 col-form-label">Seal No:<span class="text-danger">*</span></label>-->
                                <!--        <div class="col-sm-9">-->
                                <!--            <input type="text" name="seal_no" value="{{old('seal_no')}}" class="form-control">-->
                                <!--        </div>-->
                                <!--    </div>-->
                                <!--</div>-->
                                <div class="col-xl-6">
                                    <div class="mb-3 row row">
                                        <label class="col-sm-3 col-form-label">FCL/LCL:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select class="default-select form-control wide me-2" name="fcl_lcl" placeholder="Select">
                                                <option value=""></option>
                                                <option value="FCL" {{ old('fcl_lcl') == 'FCL' ? 'selected' : '' }}>FCL</option>
                                                <option value="LCL" {{ old('fcl_lcl') == 'LCL' ? 'selected' : '' }}>LCL</option>
                                                <option value="ETY" {{ old('fcl_lcl') == 'ETY' ? 'selected' : '' }}>ETY</option>
                                                <option value="AIR" {{ old('fcl_lcl') == 'AIR' ? 'selected' : '' }}>AIR</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row row">
                                        <label class="col-sm-3 col-form-label">Freedays_Cont:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="freedays_cont" value="{{old('freedays_cont')}}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row row">
                                        <label class="col-sm-3 col-form-label">Uno No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="uno_no" value="{{old('uno_no')}}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row row">
                                        <label class="col-sm-3 col-form-label">Remarks:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="remarks" value="{{old('remarks')}}" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row row">
                                        <label class="col-sm-3 col-form-label">Prev_Days:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="previous_days" value="{{old('previous_days')}}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row row">
                                        <label class="col-sm-3 col-form-label">Agent Seal No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="agentSealNo" name="" value="{{old('agentSealNo')}}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Cust Seal No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="cust_seal_no" value="{{ old('cust_seal_no') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row row">
                                        <label class="col-sm-3 col-form-label">SOB Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy"  name="sobDate" name="" value="{{old('sobDate')}}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row row">
                                        <label class="col-sm-3 col-form-label">Ex-Rate:</label>
                                        <div class="col-sm-9">
                                            <input type="number" step="0.001" min="0" name="ex_rate" value="{{old('ex_rate')}}" class="form-control" pattern="^\d+(\.\d{1,3})?$">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row row">
                                        <label class="col-sm-3 col-form-label">Rate:</label>
                                        <div class="col-sm-9">
                                            <input type="number" step="0.001" min="0" name="rate" value="{{old('rate')}}" class="form-control" pattern="^\d+(\.\d{1,3})?$">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <h4>Other Details</h4>
                                    <hr>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Mark And Numbers:<span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <textarea name="mark_and_numbers" class="form-control h-100" rows="2">{{ old('mark_and_numbers') }}</textarea>
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
                                                <input type="date" class="form-control" placeholder="dd/mm/yy" name="check_list_date" value="{{ old('check_list_date') }}">
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Bill of entry(BOE):</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="bill_of_entry_date" value="{{ old('bill_of_entry_date') }}">
                                            </div>
                                        </div>
                                    </div>
                            
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Destuffing Date:</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" placeholder="dd/mm/yy" name="destuffing_date" value="{{ old('destuffing_date') }}">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Out Off Charge Date:</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" placeholder="dd/mm/yy" name="out_off_charge_date" value="{{ old('out_off_charge_date') }}">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Do Date:</label>
                                            <div class="col-sm-9">
                                                <input type="date" placeholder="dd/mm/yy"  name="do_date" name="" value="{{old('do_date')}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <a href="{{route('sea-imports.index')}}" class="btn btn-warning btn-sm" type="button">Reset</a>
                                    <button class="btn btn-primary btn-sm" type="submit">Add CONTAINER</button>
                                </div>
                            </div>
                            <div style="display:none" id="error1-msg" class="alert alert-danger"></div>
                            <div style="display:none" id="success1-msg" class="alert alert-success"></div>
                            <div id="searchFile"></div>
                        </form>
                    </div>

                    <h4>File Upload</h4>
                    <hr>
                    <div class="form-validation">
                        <form class="needs-validation" action="{{route('multi-file-upload.updateFileUpload')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="file_related" value="sea_import">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- sales person model  -->
@include('admin-main.admin.commonModelForms.salesperson_modal')

@include('admin-main.admin.commonModelForms.modelPartyDetails')

@include('admin-main.admin.commonModelForms.addNewPort_modal')

@include('admin-main.admin.commonModelForms.addOceanVslModel')
<!-- Add new export Modal -->
@include('admin-main.admin.commonModelForms.addExportPartiesModel')
<!--shipping line-->
@include('admin-main.admin.commonModelForms.shippinglineModel')
<!-- Add new Forwarder Modal -->
@include('admin-main.admin.commonModelForms.modelForwarder')
<!-- Add new Bl Type Module -->
@include('admin-main.admin.commonModelForms.moduleBlType')

<!-- Add new Package Modal -->
@include('admin-main.admin.commonModelForms.addNewPackageModel')

@endsection
@push('scripts')
<script>
$(document).ready(function() {

    // Update hidden job_no in file upload form when dropdown changes
    $('#job_numbers').on('change', function() {
        let selectedJobId = $(this).val(); // ✅ this is job_number->id
        $('#job_no_hidden').val(selectedJobId);
    });

    // Optional: Initialize the hidden field on page load
    let initialJobId = $('#job_numbers').val();
    if (initialJobId) {
        $('#job_no_hidden').val(initialJobId);
    }


    // Initialize logic on page load (if old value exists)
    if ($('#agent_id').val()) {
        $('#delivery_agent_id').prop('readonly', true);
    }
    if ($('#delivery_agent_id').val()) {
        $('#agent_id').prop('readonly', true);
    }
    
    
    
});
</script>

<script>
    $(document).ready(function() {
        
        flatpickr("input[type='date']", {
            altInput: true,
            altFormat: "d/m/Y",   // what user sees
            dateFormat: "Y-m-d",  // what is submitted
            allowInput: true
        });

        $('.select2').select2({
            // placeholder: 'Select a value',
            // allowClear: true,
            width: '100%'
        })
        
        // ------------------------------
        // 1️⃣ MAIN SEA IMPORT FORM
        // ------------------------------
        $('#seaImportForm').on('submit', function(e) {
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
        
            let formData = form.serialize();
            let submitBtn = form.find('button[type="submit"]');
            submitBtn.prop('disabled', true).text('Saving...');
        
            $.ajax({
                url: "{{ route('sea-imports.store') }}",
                type: "POST",
                data: formData,
                success: function(response) {
                    $('#error-msg').hide().text('');
                    $('#success-msg').hide().text('');
        
                    if (response.status) {
                        $('#success-msg').show().text('Form saved successfully!');
                        $('#sea_import_id').val(response.id);
                        sessionStorage.setItem("sea_import_id", response.id);
                    } else {
                        $('#error-msg').show().text(response.message);
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
        
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
        
                        $.each(errors, function(key) {
                            $('[name="' + key + '"]').addClass('input-error');
                        });
                    }
                },
                complete: function() {
                    submitBtn.prop('disabled', false).text('Save');
                }
            });
        });

        
        
        // $('#seaImportForm').on('submit', function(e) {
        //     e.preventDefault();
        
        //     let form = $(this);
        //     let formData = form.serialize();
            
        //     let submitBtn = form.find('button[type="submit"]');
        //     submitBtn.prop('disabled', true).text('Saving...');
        
        //     $.ajax({
        //         url: "{{ route('sea-imports.store') }}",
        //         type: "POST",
        //         data: formData,
        //         success: function(response) {
        //             $('#error-msg').hide().text('');
        //             $('#success-msg').hide().text('');
        
        //             if (response.status) {
        //                 $('#success-msg').show().text('Form saved successfully!');
        
        //                 // SAVE THE RETURNED ID IN HIDDEN FIELD
        //                 $('#sea_import_id').val(response.id);
        
        //                 // Optional: store in session (if needed for page reloads)
        //                 sessionStorage.setItem("sea_import_id", response.id);
        //             }
        //             else {
        //                 $('#error-msg').show().text(response.message);
        //             }
        //         },
        //         error: function(xhr) {
        //             console.log(xhr.responseText);
        
        //             if (xhr.status === 422) {
        //                 let errors = xhr.responseJSON.errors;
        //                 let errorMessages = '';
        
        //                 $.each(errors, function(key, value) {
        //                     errorMessages += value[0] + '\n';
        //                 });
        //                 alert(errorMessages);
        //             }
        //         },
        //         complete: function() {
        //             // Enable button after request finishes
        //             submitBtn.prop('disabled', false).text('Save');
        //         }
        //     });
        // });
        
        
        
        // ------------------------------
        // 2️⃣ CONTAINER FORM
        // ------------------------------
        $('#seaImportContainerForm').on('submit', function (e) {
            e.preventDefault();
        
            // Get sea_import_id from hidden field or session
            let seaImportId = $('#sea_import_id').val();
        
            if (!seaImportId) {
                alert("Please submit the main form first!");
                return;
            }
        
            // Append the id manually in case it's missing
            let formData = $(this).serialize() + "&sea_import_id=" + seaImportId;
            
            // Disable button
            let form = $(this);
            let submitBtn = form.find('button[type="submit"]');
            submitBtn.prop('disabled', true).text('Saving...');
        
            $.ajax({
                url: "{{ route('sea-imports.addContainer') }}",
                type: "POST",
                data: formData,
                dataType: "json",
                success: function(response) {
                    if(response.status){
                        $('#success1-msg').show().text('Container added successfully!');
                        $('#seaImportContainerForm')[0].reset();
                        
                        let html = `
                        <div class="alert alert-secondary">
                        <strong>Container no: ${response.data.container_no || '-'}</strong> |
                           Agent seal no: ${response.data.agentSealNo || 0} |
                           Cust seal no : ${response.data.seal_no || 0} |
                           size: ${response.data.size || 0}
                        </div>
                         `;
                        $('#searchFile').prepend(html);
                        
                        
                    }
                    else {
                        $('#error1-msg').show().text(response.message);
                    }
                    
                    setTimeout(()=>{
                        
                        $('#error1-msg').hide().text('');
                        $('#success1-msg').hide().text('');
                        
                    }, 3000)
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
        
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        let errorMessages = '';
        
                        $.each(errors, function(key, value) {
                            errorMessages += value[0] + '\n';
                        });
                        alert(errorMessages);
                    }
                },
                complete: function() {
                    // Enable button after request finishes
                    submitBtn.prop('disabled', false).text('Add Container');
                }
            });
        });
        
        
        
        // ------------------------------
        // 3️⃣ IF PAGE RELOADS, RESTORE ID
        // ------------------------------
        $(document).ready(function() {
            let storedID = sessionStorage.getItem("sea_import_id");
        
            if (storedID) {
                $('#sea_import_id').val(storedID);
            }
        });


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
    // all model forms
    $(document).ready(function() {
        
        //export party details 
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
        
        // job numbers
        $('#job_numbers').on('change', function(e) {
            e.preventDefault();
            
            var selectNumber = $(this).val();
            var selectJobActivity = $(this).find(':selected').data('jobactivity');
            
            
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
                        console.log(response);
                        
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
                        
                        if (response.jobMasterData.job_activity === "SEAIMP.NVOCC") {
                            $('#NVOCC').prop('checked', true);
                        } else {
                            $('#Forwarder').prop('checked', true);
                        }
            
                        $('#consignee_id_hidden_input').val(response.job_party_id);
                        $('#consignee_id').val(response.job_party_id);
                        $('#consignee_id').trigger('change');
                        $('#consignee_id')
                        .prop('readonly', true)
                        .css({
                            'cursor': 'not-allowed',
                            'background-color': '#e9ecef'
                        });
    
                    },
                    error: function(xhr) {
                        let msg = "Something went wrong!";

                        // If backend returns { "error": "Job already exists" }
                        if (xhr.responseJSON && xhr.responseJSON.error) {
                            msg = xhr.responseJSON.error;
                        }
                    
                        $("#jobErrorBox").hide().html(msg).fadeIn();
			            $('#seaImportForm')[0].reset();
                    }
                });
            }
            
            
            // Get shipper and consign name according to selected job number
            if(selectNumber !== "") {
                $.ajax({
                    url: "{{ url('get-jobmaster-party-details') }}",
                    type: "GET",
                    data: { job_no: selectNumber },
                    success: function(response) {
                        console.log(response);
                        let partyId = response.data.job_party_id;
                        console.log("Party ID:", partyId, "Activity:", response.data.job_activity);
                    
                        if(response.data.job_activity == 'AIREXP.FWD' || response.data.job_activity == 'SEAEXP.FWD'){
                            $("#shipper_id").val(partyId).trigger("change.select2"); 
                            $('#shipper_id').next('.select2').find('.select2-selection').css('border-color', 'green');
                        } else {
                            $("#consignee_id").val(partyId).trigger("change.select2"); 
                            $('#consignee_id').next('.select2').find('.select2-selection').css('border-color', 'green');
                        }
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            }
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
                    $('select[name="hbl_type"]').each(function() {
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
    
        // sales person
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
        
        // shipping line
        $('#shippingLineForm').on('submit', function(e) {
            e.preventDefault();
    
            $.ajax({
                url: "{{ route('new-shipping-line.store') }}", // route name
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
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
        
    
        // import party details form
        let targetField = null;
        // Capture which select opened the modal
        $('#partyDetailsModal').on('show.bs.modal', function (event) {
            const button = $(event.relatedTarget);
            targetField = button.data('target-field'); // Example: 'notify2_id'
        });
    
        // Handle form submission (AJAX)
        $('#modelPartyDetails').on('submit', function (e) {
            e.preventDefault();
    
            $.ajax({
                url: "{{ route('new-party.store') }}",
                method: "POST",
                data: $(this).serialize(),
                success: function (response) {
                    if (response.success) {
                        const partyId = response.party.id;
                        const partyName = response.party.name;
    
                        // ✅ Update all relevant dropdowns (avoid duplicates)
                        const relevantSelects = [
                            //'shipper_id',
                            'consignee_id',
                            'notify_id',
                            'notify2_id',
                            'delivery_agent_id',
                            'agent_id',
                            'cfs_yard_id',
                            'empty_yard_id',
                            'coloader_id',
                            'cha_id'
                        ];
    
                        relevantSelects.forEach(function (name) {
                            const $select = $('select[name="' + name + '"]');
    
                            if ($select.length) {
                                // Add the option if it doesn’t already exist
                                if ($select.find('option[value="' + partyId + '"]').length === 0) {
                                    const newOption = new Option(partyName, partyId, false, false);
                                    $select.append(newOption);
                                }
    
                                // Select the correct dropdown that triggered the modal
                                if (name === targetField) {
                                    $select.val(partyId).trigger('change');
                                } else {
                                    $select.trigger('change.select2');
                                }
                            }
                        });
    
                        // ✅ Reset and close the modal
                        $('#modelPartyDetails')[0].reset();
                        $('#partyDetailsModal').modal('hide');
                    } else {
                        // Show validation or response message
                        $('#partyNameError').text(response.message).show();
                    }
                },
                error: function (xhr) {
                    alert("Failed to add party details");
    
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        let messages = "";
                        Object.values(xhr.responseJSON.errors).forEach(function (errorArray) {
                            messages += errorArray.join("\n") + "\n";
                        });
                        alert(messages);
                    }
                },
            });
        });
    
        // Reset the targetField when modal closes
        $('#partyDetailsModal').on('hidden.bs.modal', function () {
            targetField = null;
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
        
        
        // port Capture which select opened the modal
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
                            'destination_port_id',
                            'delivery_port_id'
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
        
        
        
    });

</script>
<script>
    document.getElementById('SeaImportFormData').addEventListener('submit', function(e) {
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
                console.error('Error:', error);
            });
    });

    function clearSearchFile() {
        document.getElementById("searchFile").innerHTML = "";
    }
    
</script>

@endpush