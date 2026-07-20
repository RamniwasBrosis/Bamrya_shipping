@extends('admin-main.layouts.default')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active"><a href="#">ADD NEW BOOKING</a></li>
    </ol>
    <a href="{{url('admin/bookings')}}" class="text-primary"><- Go Back</a>
</div>

@if (session('success'))
<div class="alert alert-success">
    <span>{{ session('success') }}</span>
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="container-fluid p-2">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add New BOOKING</h4>
                </div>
                <div class="card-body">
                    <form class="needs-validation" action="{{route('bookings.store')}}" method="post">
                        @csrf
                        <div class="row">
                            <h4>General Details</h4>
                            <hr>
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Booking No:<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="booking_no" class="form-control" value="">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Ocean_Vsl:</label>
                                    <div class="col-sm-9 d-flex align-items-center">
                                        <!-- <select name="vessel_id" class="default-select form-control wide me-2" placeholder="Select">
                                            <option value="">select</option>
                                            @foreach ($vessels as $vessel)
                                            <option value="{{ $vessel->id }}" {{ old('vessel_id') == $vessel->id ? 'selected' : '' }}>
                                                {{ $vessel->vessel_name }}
                                            </option>
                                            @endforeach
                                        </select> -->
                                        <select id="vesselSelect" name="vessel_id" class="form-control select2">
                                            <option value="">Select a vessel</option>
                                            @foreach($vessels as $vessel)
                                            <option value="{{ $vessel->id }}" {{ old('vessel_id') == $vessel->id ? 'selected' : '' }}>
                                                {{ $vessel->vessel_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#oceanVslModal">
                                            <i class="bi bi-plus-lg">+</i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Voy_No:</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="voy_no" class="form-control" value="{{ old('voy_no') }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Cargo Details -->
                        <div class="row">
                            <h4>Cargo Deails</h4>
                            <hr>
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">ETA_Date:</label>
                                    <div class="col-sm-9">
                                        <input type="date" name="eta_date" class="form-control" value="{{ old('eta_date') }}">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Booking ValidityDays:</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="validity_days" class="form-control" value="{{ old('validity_days') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Entry Date:<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="date" name="entry_date" class="form-control" value="{{ old('entry_date') }}">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Booking Validity_Dt:</label>
                                    <div class="col-sm-9">
                                        <input type="date" name="validity_date" class="form-control" value="{{old('validity_date')}}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Party Details -->
                        <div class="row">
                            <h4>Party Details</h4>
                            <hr>
                            <div class="col-xl-6 col-xxl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">SHIPPER:</label>
                                    <div class="col-sm-9 d-flex align-items-center">
                                        <select id="shipper_id" name="shipper_id" class="form-control select2">
                                            <option value="">Select shipper</option>
                                            @foreach ($exportParites as $party)
                                                <option value="{{$party->id}}" {{ old('shipper_id') == $party->id ? 'selected' : '' }}>
                                                    {{$party->party_name}}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exportPartyDetails">
                                            <i class="bi bi-plus-lg">+</i>
                                        </button>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Sales Person:</label>
                                    <div class="col-sm-9 d-flex align-items-center">
                                        <select name="sales_person_id" class="form-control wide me-2 select2">
                                            <option value="">select</option>
                                            @foreach ($salePersons as $salesPerson)
                                            <option value="{{ $salesPerson->id }}" {{ old('sales_person_id') == $salesPerson->id ? 'selected' : '' }}>
                                                {{ $salesPerson->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <button type="button" class="btn btn-sm btn-outline-primary"
                                            data-bs-toggle="modal" data-bs-target="#salespersonModal">
                                            <i class="bi bi-plus-lg">+</i>
                                        </button>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Empty Yard:</label>
                                    <div class="col-sm-9 d-flex align-items-center">
                                        <select name="empty_yard_id" class="form-control wide me-2 select2" placeholder="Select">
                                            <option value="">select</option>
                                            @foreach ($parties->where('party_type', 5) as $partie)
                                            <option value="{{ $partie->id }}" {{ old('empty_yard_id') == $partie->id ? 'selected' : '' }}>
                                                {{ $partie->party_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#partyDetailsModal" data-target-field="empty_yard_id">
                                            <i class="bi bi-plus-lg">+</i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-xxl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">SURVEYORS:</label>
                                    <div class="col-sm-9 d-flex align-items-center">
                                        <select name="surveyor_id" class="form-control wide me-2 select2" placeholder="Select">
                                            <option value="">select</option>
                                            @foreach ($parties->where('party_type', 21) as $partie)
                                            <option value="{{ $partie->id }}" {{ old('surveyor_id') == $partie->id ? 'selected' : '' }}>
                                                {{ $partie->party_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#partyDetailsModal" data-target-field="surveyor_id">
                                            <i class="bi bi-plus-lg">+</i>
                                        </button>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Shipping Line:</label>
                                    <div class="col-sm-9 d-flex align-items-center">
                                        <select name="shipping_line_id" class="form-control wide me-2 select2" placeholder="Select">
                                            <option value="">select</option>
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
                            </div>
                        </div>

                        {{-- Port Details --}}
                        <div class="row">
                            <h4>Port Details</h4>
                            <hr>
                            <div class="col-xl-6 col-xxl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Port Of Loading:</label>
                                    <div class="col-sm-9 d-flex align-items-center">
                                        <select class="form-control wide me-2 select2"
                                            placeholder="Select" name="port_loading_id">
                                            <option value="">select</option>
                                            @foreach ($ports as $port)
                                            <option value="{{ $port->id }}" {{ old('port_loading_id') == $port->id ? 'selected' : '' }}>
                                                {{ $port->port_name }}
                                            </option>
                                            <!-- <option value="{{$port->id}}">{{$port->port_name}}</option> -->
                                            @endforeach
                                        </select>
                                        <button type="button" class="btn btn-sm btn-outline-primary"
                                            data-bs-toggle="modal" data-target-field="port_loading_id" data-bs-target="#addNewPortDetails">
                                            <i class="bi bi-plus-lg">+</i>
                                        </button>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Port Of Discharge:</label>
                                    <div class="col-sm-9 d-flex align-items-center">
                                        <select class="form-control wide me-2 select2"
                                            placeholder="Select" name="port_discharge_id">
                                            <option value="">select</option>
                                            @foreach ($ports as $port)
                                            <option value="{{ $port->id }}" {{ old('port_discharge_id') == $port->id ? 'selected' : '' }}>
                                                {{ $port->port_name }}
                                            </option>
                                            <!-- <option value="{{$port->id}}">{{$port->port_name}}</option> -->
                                            @endforeach
                                        </select>
                                        <button type="button" class="btn btn-sm btn-outline-primary"
                                            data-bs-toggle="modal" data-target-field="port_discharge_id"  data-bs-target="#addNewPortDetails">
                                            <i class="bi bi-plus-lg">+</i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-xxl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Port Of Final Destination:<span class="text-danger">*</span></label>
                                    <div class="col-sm-9 d-flex align-items-center">
                                        <select class="form-control wide me-2 select2"
                                            placeholder="Select" name="port_transhipment_id">
                                            <option value="">select</option>
                                            @foreach ($ports as $port)
                                            <option value="{{ $port->id }}" {{ old('port_transhipment_id') == $port->id ? 'selected' : '' }}>
                                                {{ $port->port_name }}
                                            </option>
                                            <!-- <option value="{{$port->id}}">{{$port->port_name}}</option> -->
                                            @endforeach
                                        </select>
                                        <button type="button" class="btn btn-sm btn-outline-primary"
                                            data-bs-toggle="modal" data-target-field="port_transhipment_id"  data-bs-target="#addNewPortDetails">
                                            <i class="bi bi-plus-lg">+</i>
                                        </button>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Transhipment Port:</label>
                                    <div class="col-sm-9 d-flex align-items-center">
                                        <select class="form-control wide me-2 select2"
                                            placeholder="Select" name="port_destination_id">
                                            <option value="">select</option>
                                            @foreach ($ports as $port)
                                            <option value="{{ $port->id }}" {{ old('port_destination_id') == $port->id ? 'selected' : '' }}>
                                                {{ $port->port_name }}
                                            </option>
                                            <!-- <option value="{{$port->id}}">{{$port->port_name}}</option> -->
                                            @endforeach
                                        </select>
                                        <button type="button" class="btn btn-sm btn-outline-primary"
                                            data-bs-toggle="modal" data-target-field="port_destination_id" data-bs-target="#addNewPortDetails">
                                            <i class="bi bi-plus-lg">+</i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Overseas Agent Details --}}
                        <div class="row">
                            <h4>Overseas Agent Details</h4>
                            <hr>
                            <div class="col-xl-6 col-xxl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">CargoType:</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="cargo_type">
                                            <option value="" class="has-arrow">Select</option>
                                            <option value="BK001" {{ old('cargo_type') == 'BK001' ? 'selected' : '' }}>BK001</option>
                                            <option value="BK002" {{ old('cargo_type') == 'BK002' ? 'selected' : '' }}>BK002</option>
                                            <option value="BK003" {{ old('cargo_type') == 'BK003' ? 'selected' : '' }}>BK003</option>
                                        </select>

                                        <!-- <select class="form-control" name="cargo_type">
                                            <option value="" class="has-arrow">Select</option>
                                            <option value="BK001">BK001</option>
                                            <option value="BK002">BK002</option>
                                            <option value="BK003">BK003</option>
                                        </select> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-xxl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Shipment Terms:</label>
                                    <div class="col-sm-9 d-flex align-items-center">
                                        <select class="default-select form-control wide me-2"
                                            placeholder="Select" name="shipment_terms">
                                            <option value="CNF" {{ old('shipment_terms') == 'CNF' ? 'selected' : '' }}>CNF</option>
                                            <option value="EXW" {{ old('shipment_terms') == 'EXW' ? 'selected' : '' }}>EXW</option>
                                            <option value="FCA" {{ old('shipment_terms') == 'FCA' ? 'selected' : '' }}>FCA</option>
                                            <option value="FAS" {{ old('shipment_terms') == 'FAS' ? 'selected' : '' }}>FAS</option>
                                            <option value="FOB" {{ old('shipment_terms') == 'FOB' ? 'selected' : '' }}>FOB</option>
                                            <option value="CFR" {{ old('shipment_terms') == 'CFR' ? 'selected' : '' }}>CFR</option>
                                            <option value="CIF" {{ old('shipment_terms') == 'CIF' ? 'selected' : '' }}>CIF</option>
                                            <option value="CPT" {{ old('shipment_terms') == 'CPT' ? 'selected' : '' }}>CPT</option>
                                            <option value="CIP" {{ old('shipment_terms') == 'CIP' ? 'selected' : '' }}>CIP</option>
                                            <option value="DPU" {{ old('shipment_terms') == 'DPU' ? 'selected' : '' }}>DPU</option>
                                            <option value="DAP" {{ old('shipment_terms') == 'DAP' ? 'selected' : '' }}>DAP</option>
                                            <option value="DDP" {{ old('shipment_terms') == 'DDP' ? 'selected' : '' }}>DDP</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Gate Open:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="gate_open" value="{{ old('gate_open') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Container Volume:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="container_volume" value="{{ old('container_volume') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Plugging:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="plugging" value="{{ old('plugging') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-xxl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">DO Cancel:</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="do_cancel">
                                            <option value="" class="has-arrow">Select</option>
                                            <option value="1" {{ old('do_cancel') == 'Yes' ? 'selected' : '' }}>Yes</option>
                                            <option value="0" {{ old('do_cancel') == 'No' ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Cargo_Wt:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="cargo_wt" value="{{ old('cargo_wt') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Cont_Wt:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="cont_wt" value="{{ old('cont_wt') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Ventilation:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="ventilation" value="{{ old('ventilation')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Temperature:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="temperature" value="{{ old('temperature') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Commodity:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="commodity" value="{{ old('commodity') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Package:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="package" value="{{ old('package') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Humidity:</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control h-100" id="validationCustom04" rows="2" name="humidity">{{ old('humidity') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Spcecial Eq.Remarks:</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control h-100" id="validationCustom04" rows="2" name="special_eq_remarks">{{ old('special_eq_remarks') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Class:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="class" value="{{ old('class') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Sub-Class:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="sub_class" value="{{ old('sub_class') }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Other Details --}}
                        <div class=" row">
                            <h4>Other Details</h4>
                            <hr>
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">IMO CD:</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control h-100" id="validationCustom04" rows="2" name="imo_cd">{{ old('imo_cd') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">UNO CD:</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control h-100" name="uno_cd" id="validationCustom04" rows="2">{{ old('uno_cd') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Cancel Remark:</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control h-100" name="cancel_remark" id="validationCustom04" rows="2">{{ old('cancel_remark') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Special Remark:</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control h-100" name="special_remark" id="validationCustom04" rows="2">{{ old('special_remark') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">FullDO No:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="full_do_no" value="{{ old('full_do_no') }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <!--<button class="btn btn-primary me-md-2 btn-sm" type="button">Booking Print</button>-->
                            <a href="{{route('bookings.index')}}" class="btn btn-warning btn-sm" type="button">Cancel</a>
                            <button class="btn btn-primary btn-sm" type="submit">Save</button>
                        </div>

                    </form>
                    <hr>
                    <div class="form-validation">
                        <form id="addContainerForm" action="{{ route('bookings.addContainer') }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>
                            @csrf
                            <input type="hidden" name="booking_id" id="booking_id_for_containers">
                            <div class="row">
                                <!-- Container Category -->
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Cont_Cat:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select name="container_category" class="default-select form-control wide me-2" required>
                                                <option value="">Select</option>
                                                <option value="TK" {{ old('container_category') == 'TK' ? 'selected' : ''}}>TK</option>
                                                <option value="HD" {{ old('container_category') == 'HD' ? 'selected' : ''}}>HD</option>
                                                <option value="HQ" {{ old('container_category') == 'HQ' ? 'selected' : ''}}>HQ</option>
                                                <option value="GP" {{ old('container_category') == 'GP' ? 'selected' : ''}}>GP</option>
                                                <option value="OT" {{ old('container_category') == 'OT' ? 'selected' : ''}}>OT</option>
                                                <option value="RF" {{ old('container_category') == 'RF' ? 'selected' : ''}}>RF</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Container Size -->
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Size:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select name="size" class="default-select form-control wide me-2" required>
                                                <option value="">Select</option>
                                                <option value="1">0</option>
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
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Container No -->
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Container No:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="container_no" class="form-control" required value="{{ old('container_no') }}">
                                        </div>
                                    </div>
                                </div>

                                <!-- Custom Seal No -->
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Cust_Seal No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="seal_no" class="form-control" value="{{ old('seal_no') }}">
                                        </div>
                                    </div>
                                </div>

                                <!-- Cont DO No -->
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Cont_DO No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="do_no" class="form-control" value="{{ old('do_no') }}">
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="d-grid d-md-flex justify-content-md-end">
                                    <button class="btn btn-primary me-md-2 btn-sm" type="submit">Add Container</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <h4>File Upload</h4>
                    <hr>
                    <div class="form-validation">
                        <form class="needs-validation" action="{{route('file-upload.uploadFileUpload')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="booking_no" id="booking_no" value="">
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
                    <div id="containerSuccessBox" class="alert alert-secondary mt-3 d-none"></div>
                </div>

                <div id="searchFile"></div>
            </div>
        </div>
    </div>
</div>

<!--@include('admin-main.admin.commonModelForms.salesperson_modal')-->

<!-- Modal Ocean Vsl -->
@include('admin-main.admin.commonModelForms.addOceanVslModel')

<!-- model package  -->
@include('admin-main.admin.commonModelForms.salesperson_modal')

<!-- Modal Party Details -->
@include('admin-main.admin.commonModelForms.modelPartyDetails')
<!-- Add new export Modal -->
@include('admin-main.admin.commonModelForms.addExportPartiesModel')
<!-- Modal Port Details -->
@include('admin-main.admin.commonModelForms.addNewPort_modal')
<!--shipping line-->
@include('admin-main.admin.commonModelForms.shippinglineModel')

@endsection


@push('scripts')
<!-- Select2 CSS -->
<!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> -->
<!-- jQuery and Select2 JS -->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->
<script>
    $(document).ready(function() { 
        // ocean vassel model
        $('#oceanVslForm').on('submit', function(e) {
            e.preventDefault();
    
            $.ajax({
                url: "{{ route('new-vessels.store') }}",
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    let newOption = new Option(response.vessel_name, response.id, false, true);
                    $('#vesselSelect').append(newOption).trigger('change');
    
                    // Reset form and close modal
                    $('#oceanVslForm')[0].reset();
                    var modalEl = document.getElementById('oceanVslModal');
                    var modal = bootstrap.Modal.getInstance(modalEl);
                    modal.hide();
                },
                error: function(xhr) {
                    alert('Failed to add vessel');
    
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        let messages = '';
                        Object.values(xhr.responseJSON.errors).forEach(function(errorArray) {
                            messages += errorArray.join("\n") + "\n";
                        });
                        alert(messages);
                    }
    
                    console.error('Error:', xhr.responseText);
                }
            });
        });
        
        //export parties
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
        
        // party model details
        
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
        
        // port model
        let targetPortField = null;
    
        // Track which "+" button opened the modal
        $('[data-bs-toggle="modal"][data-bs-target="#addNewPortDetails"]').on('click', function() {
            targetPortField = $(this).data('target-field');
        });
        
        // When submitting the add-new-port form
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
        
                        const portSelectNames = [
                            'port_loading_id',
                            'port_discharge_id',
                            'port_transhipment_id',
                            'port_destination_id'
                        ];
        
                        portSelectNames.forEach(function(name) {
                            const select = $('select[name="' + name + '"]');
                            if (select.length) {
                                // Append new option if not exists
                                if (select.find('option[value="' + portId + '"]').length === 0) {
                                    const newOption = new Option(portName, portId, false, false);
                                    select.append(newOption);
                                }
        
                                // Select the correct dropdown that triggered the modal
                                if (targetPortField === name) {
                                    select.val(portId).trigger('change');
                                } else {
                                    select.trigger('change.select2');
                                }
                            }
                        });
                    }
        
                    // ✅ Properly reset and close the modal form
                    $('#portDetailsModel')[0].reset();
                    $('#addNewPortDetails').modal('hide');
                },
                error: function(xhr) {
                    console.error('Error:', xhr.responseText);
                    alert('Failed to add port details');
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
    $('#addContainerForm').submit(function (e) {
        e.preventDefault();
    
        let formData = new FormData(this);
    
        $.ajax({
            url: "{{ route('bookings.addContainer') }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
    
            success: function (response) {
    
                $('#containerSuccessBox')
                    .removeClass('d-none')
                    .removeClass('alert-danger')
                    .addClass('alert-secondary')
                    .append(
                        `Container No: <b>${response.data.container_no}</b> |
                         Size: <b>${response.data.size}</b><br>`
                    );
    
                $('#addContainerForm')[0].reset();
            },
    
            error: function (xhr) {
                let error = "Something went wrong";
    
                if (xhr.status === 422) {
                    error = Object.values(xhr.responseJSON.errors)
                        .flat()
                        .join("<br>");
                }
    
                $('#containerSuccessBox')
                    .removeClass('d-none')
                    .removeClass('alert-secondary')
                    .addClass('alert-danger')
                    .html(error);
            }
        });
    });


</script>
<script>
    // Clone first row to add new container
    $(document).on('click', '#addContainerRowBtn', function () {
        let $firstRow = $('#containerRows .container-row').first();
        let $clone = $firstRow.clone();

        // clear values
        $clone.find('select, input').val('');
        $('#containerRows').append($clone);
    });

    // Remove specific container row
    $(document).on('click', '.remove-row', function () {
        let rowsCount = $('#containerRows .container-row').length;
        if (rowsCount > 1) {
            $(this).closest('.container-row').remove();
        } else {
            // just clear if it's the last one
            $(this).closest('.container-row').find('select, input').val('');
        }
    });

    // AJAX submit for containers (one request for all)
    $('#containerForm').on('submit', function (e) {
        e.preventDefault();

        let bookingId = $('#booking_id_for_containers').val();
        if (!bookingId) {
            alert('Please save the Booking first, then add containers.');
            return;
        }

        let containers = [];

        $('#containerRows .container-row').each(function () {
            let category = $(this).find('.container_category').val();
            let size     = $(this).find('.size').val();
            let contNo   = $(this).find('.container_no').val();
            let sealNo   = $(this).find('.seal_no').val();
            let doNo     = $(this).find('.do_no').val();

            // skip completely empty rows
            if (!category && !size && !contNo && !sealNo && !doNo) {
                return;
            }

            // basic client-side validation
            if (!category || !size || !contNo) {
                alert('Container Category, Size and Container No are required in each filled row.');
                throw 'validation_error'; // break out
            }

            containers.push({
                container_category: category,
                size: size,
                container_no: contNo,
                seal_no: sealNo,
                do_no: doNo,
            });
        });

        if (containers.length === 0) {
            alert('Please add at least one container.');
            return;
        }

        $.ajax({
            url: "{{ route('bookings.saveContainers') }}",
            type: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                booking_id: bookingId,
                containers: containers
            },
            beforeSend: function () {
                $('#containerForm button[type="submit"]').prop('disabled', true).text('Saving...');
            },
            success: function (response) {
                if (response.success) {
                    alert(response.message);
                } else {
                    alert('Something went wrong while saving containers.');
                }
            },
            error: function (xhr) {
                if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                    let errors = xhr.responseJSON.errors;
                    let msg = Object.values(errors).map(e => e.join(', ')).join("\n");
                    alert("Validation Error:\n" + msg);
                } else {
                    alert('Error saving containers.');
                    console.error(xhr.responseText);
                }
            },
            complete: function () {
                $('#containerForm button[type="submit"]').prop('disabled', false).text('Save Containers');
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('.select2').select2({
            // placeholder: 'Select a value',
            // allowClear: true,
            width: '100%'
        });
    });
    
    //first form
    $(document).ready(function() {
        $('form[action="{{ route('bookings.store') }}"]').on('submit', function(e) {
            e.preventDefault();
    
            let form = $(this);
            let formData = form.serialize();
    
            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: formData,
                beforeSend: function() {
                    form.find('button[type="submit"]').prop('disabled', true).text('Saving...');
                },
                success: function(response) {
                    if (response.success) {
                        alert(response.message);
                    
                        // ✅ Set booking_id for containers form
                        $('#booking_id_for_containers').val(response.booking_id);
                    
                        // (optional) If you still keep a select for booking_id somewhere, update it too
                    
                        // ✅ Set booking_no in the file upload form
                        const fileUploadForm = $('form[action="{{ route('file-upload.uploadFileUpload') }}"]');
                        fileUploadForm.find('input[name="booking_no"]').val(response.booking_no);
                    
                        form.trigger('reset');
                    } else {
                        alert('Something went wrong.');
                    }

                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        let msg = Object.values(errors).map(e => e.join(', ')).join('\n');
                        alert("Validation Error:\n" + msg);
                    } else {
                        alert('Error saving booking.');
                    }
                },
                complete: function() {
                    form.find('button[type="submit"]').prop('disabled', false).text('Save');
                }
            });
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
    document.getElementById('BookingFileForm').addEventListener('submit', function(e) {
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