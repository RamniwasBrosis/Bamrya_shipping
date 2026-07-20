@extends('admin-main.layouts.default')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active"><a href="#">EDIT BOOKING</a></li>
    </ol>
    <a href="{{ url('admin/bookings') }}" class="text-primary"><- Go Back</a>
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
                    <h4 class="card-title">Edit BOOKING</h4>
                </div>
                <div class="card-body">
                    <form class="needs-validation" action="{{route('bookings.update', $bookingList->id)}}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <h4>General Details</h4>
                            <hr>
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Booking No:</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="booking_no" class="form-control" value="{{$bookingList->booking_no }}">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Ocean_Vsl:</label>
                                    <div class="col-sm-9 d-flex align-items-center">
                                        <select name="vessel_id" class="form-control wide me-2 select2" placeholder="Select">
                                            <option value="">select</option>
                                            @foreach ($vessels as $vessel)
                                            <option value="{{$vessel->id}}" {{$vessel->id == $bookingList->vessel_id? 'selected' : ''}}>{{$vessel->vessel_name}}</option>
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
                                        <input type="text" name="voy_no" class="form-control" value="{{$bookingList->voy_no }}">
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
                                        <input type="date" name="eta_date" class="form-control" value="{{$bookingList->eta_date }}">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Booking ValidityDays:</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="validity_days" class="form-control" value="{{$bookingList->validity_days }}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Entry Date:<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="date" name="entry_date" class="form-control" value="{{$bookingList->entry_date }}">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Booking Validity_Dt:</label>
                                    <div class="col-sm-9">
                                        <input type="date" name="validity_date" class="form-control" value="{{$bookingList->validity_date }}">
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
                                        <select id="" name="shipper_id" class="form-control select2">
                                            <option value="">Select a shipper</option>
                                            @foreach ($exportParites as $party)
                                                <option value="{{$party->id}}" {{$party->id == $bookingList->shipper_id ? 'selected' : ''}}>
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
                                            @foreach ($exportParites as $party)
                                                <option value="{{$party->id}}" {{$party->id == $bookingList->shipper_id ? 'selected' : ''}}>
                                                    {{$party->party_name}}
                                                </option>
                                            @endforeach
                                            
                                            @foreach ($salePersons as $salesPerson)
                                            <option value="{{ $salesPerson->id }}" {{$salesPerson->id == $bookingList->sales_person_id ? 'selected' : ''}}>{{ $salesPerson->name }}</option>
                                            @endforeach
                                        </select>
                                        <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#salespersonModal">
                                            <i class="bi bi-plus-lg">+</i>
                                        </button>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Empty Yard:</label>
                                    <div class="col-sm-9 d-flex align-items-center">
                                        <select name="empty_yard" class="form-control wide me-2 select2" placeholder="Select">
                                            <option value="">select</option>
                                            @foreach ($parties as $party)
                                            <option value="{{$party->id}}" {{$party->id == $bookingList->empty_yard_id  ? 'selected' : ''}}>{{$party->party_name}}</option>
                                            @endforeach
                                        </select>
                                        <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#partyDetailsModal">
                                            <i class="bi bi-plus-lg">+</i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-xxl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">SURVEYORS:</label>
                                    <div class="col-sm-9 d-flex align-items-center">
                                        <select name="surveyors" class="form-control wide me-2 select2" placeholder="Select">
                                            <option value="">select</option>
                                            @foreach ($parties as $party)
                                            <option value="{{$party->id}}" {{$party->id == $bookingList->surveyor_id  ? 'selected' : ''}}>{{$party->party_name}}</option>
                                            @endforeach
                                        </select>
                                        <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#partyDetailsModal">
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
                                            <option value="{{ $shippingLine->id }}" {{$shippingLine->id == $bookingList->shipping_line_id  ? 'selected' : ''}}>{{ $shippingLine->shipping_line_name }}</option>
                                            @endforeach
                                        </select>
                                        <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#partyDetailsModal">
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
                                        <select class="form-control wide me-2 select2" name="port_loading_id">
                                            <option value="">select</option>
                                            @foreach ($ports as $port)
                                            <option value="{{$port->id}}" {{$port->id == $bookingList->port_loading_id ? 'selected' : ''}}>{{$port->port_name}}</option>
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
                                        <select class="form-control wide me-2 select2" name="port_discharge_id">
                                            <option value="">select</option>
                                            @foreach ($ports as $port)
                                            <option value="{{$port->id}}" {{$port->id == $bookingList->port_discharge_id ? 'selected' : ''}}>{{$port->port_name}}</option>
                                            @endforeach
                                        </select>
                                        <button type="button" class="btn btn-sm btn-outline-primary"
                                            data-bs-toggle="modal" data-target-field="port_discharge_id" data-bs-target="#addNewPortDetails">
                                            <i class="bi bi-plus-lg">+</i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-xxl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Port Of Final Destination:<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9 d-flex align-items-center">
                                        <select class="form-control wide me-2 select2" name="port_transhipment_id">
                                            <option value="">select</option>
                                            @foreach ($ports as $port)
                                            <option value="{{$port->id}}" {{$port->id == $bookingList->port_destination_id ? 'selected' : ''}}>{{$port->port_name}}</option>
                                            @endforeach
                                        </select>
                                        <button type="button" class="btn btn-sm btn-outline-primary"
                                            data-bs-toggle="modal" data-target-field="port_destination_id" data-bs-target="#addNewPortDetails">
                                            <i class="bi bi-plus-lg">+</i>
                                        </button>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Transhipment Port:</label>
                                    <div class="col-sm-9 d-flex align-items-center">
                                        <select class="form-control wide me-2 select2" name="port_destination_id">
                                            <option value="">select</option>
                                            @foreach ($ports as $port)
                                            <option value="{{$port->id}}" {{$port->id == $bookingList->port_transhipment_id    ? 'selected' : ''}}>{{$port->port_name}}</option>
                                            @endforeach
                                        </select>
                                        <button type="button" class="btn btn-sm btn-outline-primary"
                                            data-bs-toggle="modal" data-target-field="port_transhipment_id" data-bs-target="#addNewPortDetails">
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
                                            <option value="BK001" {{$bookingList->cargo_type == 'BK001' ? 'selected' : ''}}>BK001</option>
                                            <option value="BK002" {{$bookingList->cargo_type == 'BK002'  ? 'selected' : ''}}>BK002</option>
                                            <option value="BK003" {{$bookingList->cargo_type == 'BK003'  ? 'selected' : ''}}>BK003</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-xxl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Shipment Terms:</label>
                                    <div class="col-sm-9 d-flex align-items-center">
                                        <select class="default-select form-control wide me-2"
                                            placeholder="Select" name="shipment_terms">
                                            <option value="CNF" {{$bookingList->shipment_terms == 'CNF'  ? 'selected' : ''}}>CNF</option>
                                            <option value="EXW" {{$bookingList->shipment_terms == 'EXW'  ? 'selected' : ''}}>EXW</option>
                                            <option value="FCA" {{$bookingList->shipment_terms == 'FCA'  ? 'selected' : ''}}>FCA</option>
                                            <option value="FAS" {{$bookingList->shipment_terms == 'FAS'  ? 'selected' : ''}}>FAS</option>
                                            <option value="FOB" {{$bookingList->shipment_terms == 'FOB'  ? 'selected' : ''}}>FOB</option>
                                            <option value="CFR" {{$bookingList->shipment_terms == 'CFR'  ? 'selected' : ''}}>CFR</option>
                                            <option value="CIF" {{$bookingList->shipment_terms == 'CIF'  ? 'selected' : ''}}>CIF</option>
                                            <option value="CPT" {{$bookingList->shipment_terms == 'CPT'  ? 'selected' : ''}}>CPT</option>
                                            <option value="CIP" {{$bookingList->shipment_terms == 'CIP'  ? 'selected' : ''}}>CIP</option>
                                            <option value="DPU" {{$bookingList->shipment_terms == 'DPU'  ? 'selected' : ''}}>DPU</option>
                                            <option value="DAP" {{$bookingList->shipment_terms == 'DAP'  ? 'selected' : ''}}>DAP</option>
                                            <option value="DDP" {{$bookingList->shipment_terms == 'DDP'  ? 'selected' : ''}}>DDP</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Gate Open:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="{{$bookingList->gate_open }}" name="gate_open">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Container Volume:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="{{$bookingList->container_volume }}" name="container_volume">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Plugging:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="{{$bookingList->plugging }}" name="plugging">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-xxl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">DO Cancel:</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="do_cancel">
                                            <option value="" class="has-arrow">Select</option>
                                            <option value="1" {{$bookingList->do_cancel == '1'  ? 'selected' : ''}}>Yes</option>
                                            <option value="0" {{$bookingList->do_cancel == '0'  ? 'selected' : ''}}>No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Cargo_Wt:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="{{$bookingList->cargo_wt }}" name="cargo_wt">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Cont_Wt:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="{{$bookingList->cont_wt }}" name="cont_wt">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Ventilation:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="{{$bookingList->ventilation }}" name="ventilation">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Temperature:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="{{$bookingList->temperature  }}" name="temperature">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Commodity:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="{{$bookingList->commodity }}" name="commodity">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Package:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="{{$bookingList->package }}" name="package">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Humidity:</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control h-100" id="validationCustom04" rows="2" name="humidity">{{$bookingList->humidity}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Spcecial Eq.Remarks:</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control h-100" id="validationCustom04" rows="2" name="special_eq_remarks">{{$bookingList->special_eq_remarks}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Class:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="{{$bookingList->class }}" name="class">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Sub-Class:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="{{$bookingList->sub_class }}" name="sub_class">
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
                                    <label class="col-sm-3 col-form-label">IMO CD:</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control h-100" id="validationCustom04" rows="2" name="imo_cd">{{$bookingList->imo_cd}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">UNO CD:</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control h-100" name="uno_cd" id="validationCustom04" rows="2">{{$bookingList->uno_cd}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Cancel Remark:</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control h-100" name="cancel_remark" id="validationCustom04" rows="2">{{$bookingList->cancel_remark}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Special Remark:</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control h-100" name="special_remark" id="validationCustom04" rows="2">{{$bookingList->special_remark}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">FullDO No:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="{{$bookingList->full_do_no }}" name="full_do_no">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <!--<button class="btn btn-primary me-md-2" type="button">Booking Print</button>-->
                            <a href="{{route('bookings.index')}}" class="btn btn-warning" type="button">Cancel</a>
                            <button class="btn btn-primary" type="submit">Update</button>
                        </div>

                    </form>

                    <hr>
                    <div class="form-validation">
                        <form id="containerForm" class="needs-validation" novalidate>
                            @csrf
                            <input type="hidden" name="container_id" id="container_id" value="">
                            <input type="hidden" name="booking_id" id="booking_id" value="{{ $bookingList->id }}">
                        
                            <div class="row">
                                <div class="col-xl-6">
                                    <label class="form-label">Cont_Cat</label>
                                    <select name="container_category" id="container_category" class="form-control" required>
                                        <option value="">Select</option>
                                        <option value="TK">TK</option>
                                        <option value="HD">HD</option>
                                        <option value="HQ">HQ</option>
                                        <option value="GP">GP</option>
                                        <option value="OT">OT</option>
                                        <option value="RF">RF</option>
                                    </select>
                                </div>
                        
                                <div class="col-xl-6">
                                    <label class="form-label">Size</label>
                                    <select name="size" id="size" class="form-control" required>
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
                        
                                <div class="col-xl-6">
                                    <label class="form-label">Container No</label>
                                    <input type="text" name="container_no" id="container_no" class="form-control" required>
                                </div>
                        
                                <div class="col-xl-6">
                                    <label class="form-label">Seal No</label>
                                    <input type="text" name="seal_no" id="seal_no" class="form-control">
                                </div>
                        
                                <div class="col-xl-6">
                                    <label class="form-label">DO No</label>
                                    <input type="text" name="do_no" id="do_no" class="form-control">
                                </div>
                        
                                <div class="col-xl-12 mt-2 text-end">
                                    <input type="reset" value="Reset Form" class="btn btn-sm btn-danger">
                                    <button type="submit" id="containerSubmitBtn" class="btn btn-sm btn-primary">
                                        Add Container
                                    </button>
                                </div>
                            </div>
                        
                        </form>

                    </div>

                    <h4>File Upload</h4>
                    <hr>
                    <div class="form-validation">
                        <form class="needs-validation" action="{{route('file-upload.uploadFileUpload')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="booking_no" value="{{ $bookingList->id }}">
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
                        <form id="bookingEditFileForm" method="post">
                            @csrf
                            <div class="col-xl-9">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Find PDF File:</label>
                                    <div class="col-sm-9">
                                        <div class="d-flex">
                                            <select class="form-control wide me-2 select2"
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
                <div>
                    <h4 class="mt-4">Container List</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>Size</th>
                                <th>Container No</th>
                                <th>Seal</th>
                                <th>DO No</th>
                                <th style="width:120px;">Action</th>
                            </tr>
                        </thead>
                    
                        <tbody id="containerTableBody">
                            @foreach($bookingList->containers as $c)
                            <tr id="row_{{ $c->id }}">
                                <td>{{ $c->container_category }}</td>
                                <td>{{ $c->size }}</td>
                                <td>{{ $c->container_no }}</td>
                                <td>{{ $c->seal_no }}</td>
                                <td>{{ $c->do_no }}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm editBtn" data-id="{{ $c->id }}">Edit</button>
                                    <button class="btn btn-danger btn-sm deleteBtn" data-id="{{ $c->id }}">Delete</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal Ocean Vsl -->
@include('admin-main.admin.commonModelForms.addOceanVslModel')

<!-- Modal Party Details -->
@include('admin-main.admin.commonModelForms.modelPartyDetails')

<!-- Modal Port Details -->
@include('admin-main.admin.commonModelForms.addNewPort_modal')

<!-- model sales person  -->
@include('admin-main.admin.commonModelForms.salesperson_modal')
<!-- Add new export Modal -->
@include('admin-main.admin.commonModelForms.addExportPartiesModel')

@endsection
@push('scripts')
<!-- select2  -->
<script>
    // ADD / UPDATE container
    $("#containerForm").on("submit", function(e) {
        e.preventDefault();
    
        $.ajax({
            url: "{{ route('container.save') }}",
            method: "POST",
            data: $("#containerForm").serialize(),
            success: function(res) {
                if (res.type === "create") {
                    alert("Container added successfully!");
                    loadContainerTable();
                } else {
                    alert("Container updated successfully!");
                    loadContainerTable();
                }
    
                resetContainerForm();
            }
        });
    });
    
    // Load updated table (AJAX refresh)
    function loadContainerTable() {
        $.get("{{ route('container.list', $bookingList->id) }}", function(html) {
            $("#containerTableBody").html(html);
        });
    }
    
    // Reset form after save
    function resetContainerForm() {
        $("#container_id").val("");
        $("#containerForm")[0].reset();
        $("#containerSubmitBtn").text("Add Container");
    }

    // EDIT
    $(document).on("click", ".editBtn", function() {
        let id = $(this).data("id");
    
        $.get(`/container/${id}`, function(c) {
            $("#container_id").val(c.id);
            $("#container_category").val(c.container_category);
            $("#size").val(c.size);
            $("#container_no").val(c.container_no);
            $("#seal_no").val(c.seal_no);
            $("#do_no").val(c.do_no);
            $("#containerSubmitBtn").text("Update Container");
        });
    });
    
    // DELETE
    $(document).on("click", ".deleteBtn", function() {
        if (!confirm("Delete container?")) return;
    
        let id = $(this).data("id");
    
        $.ajax({
            url: `/container/${id}`,
            method: "DELETE",
            data: { _token: "{{ csrf_token() }}" },
            success: function() {
                loadContainerTable();
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
</script>
<script>
    // file table
    document.getElementById('bookingEditFileForm').addEventListener('submit', function(e) {
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
</script>
// delete file
<script>
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

    // ocean vassel model
    $('#oceanVslForm').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: "{{ route('new-vessels.store') }}", // route name
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                // Add the new option to select dropdowns
                /* $('select[name="sales_person_id"]').each(function() {
                    $(this).append(`<option value="${response.id}" selected>${response.name}</option>`);
                }); */

                // Close modal and reset form
                $('#oceanVslForm')[0].reset();
                $('#oceanVslModal').modal('hide');
            },
            error: function(xhr) {
                alert('Failed to add port details');

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
    $('#modelPartyDetails').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: "{{ route('new-party.store') }}", // route name
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                // Add the new option to select dropdowns
                /* $('select[name="sales_person_id"]').each(function() {
                    $(this).append(`<option value="${response.id}" selected>${response.name}</option>`);
                }); */

                // Close modal and reset form
                $('#modelPartyDetails')[0].reset();
                $('#partyDetailsModal').modal('hide');
            },
            error: function(xhr) {
                alert('Failed to add party details');

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
    
    //export parties
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
</script>
@endpush