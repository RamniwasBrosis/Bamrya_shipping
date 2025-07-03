@extends('admin-main.layouts.default')
@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="#">BOOKING</a></li>
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
                                            <select name="vessel_id" class="default-select form-control wide me-2" placeholder="Select">
                                                <option value="">select</option>
                                                @foreach ($vessels as $vessel)
                                                    <option value="{{$vessel->id}}" {{$vessel->id == $bookingList->vessel_id? 'selected' : ''}}>{{$vessel->vessel_name}}</option>
                                                @endforeach
                                            </select>
                                            <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#partyDetailsModal">
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
                                            <select name="shipper" class="default-select form-control wide me-2" placeholder="Select">
                                                <option value="">select</option>
                                                    @foreach ($parties as $party)
                                                        <option value="{{$party->id}}" {{$party->id == $bookingList->shipper_id ? 'selected' : ''}}>{{$party->party_name}}</option>
                                                    @endforeach
                                            </select>
                                            <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#partyDetailsModal">
                                                <i class="bi bi-plus-lg">+</i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Sales Person:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select name="sales_person" class="default-select form-control wide me-2" placeholder="Select">
                                                <option value="">select</option>
                                                    @foreach ($parties as $party)
                                                        <option value="{{$party->id}}" {{$party->id == $bookingList->sales_person_id  ? 'selected' : ''}}>{{$party->party_name}}</option>
                                                    @endforeach
                                            </select>
                                            <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#partyDetailsModal">
                                                <i class="bi bi-plus-lg">+</i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Empty Yard:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select name="empty_yard" class="default-select form-control wide me-2" placeholder="Select">
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
                                            <select name="surveyors" class="default-select form-control wide me-2" placeholder="Select">
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
                                            <select name="shipping_line" class="default-select form-control wide me-2" placeholder="Select">
                                                <option value="">select</option>
                                                    @foreach ($parties as $party)
                                                        <option value="{{$party->id}}" {{$party->id == $bookingList->shipping_line_id  ? 'selected' : ''}}>{{$party->party_name}}</option>
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
                                            <select class="default-select form-control wide me-2"
                                                placeholder="Select" name="port_loading_id">
                                                <option value="">select</option>
                                                    @foreach ($ports as $port)
                                                        <option value="{{$port->id}}" {{$port->id == $bookingList->port_loading_id ? 'selected' : ''}}>{{$port->port_name}}</option>
                                                    @endforeach
                                            </select>
                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                data-bs-toggle="modal" data-bs-target="#portDetailsModal">
                                                <i class="bi bi-plus-lg">+</i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Port Of Discharge:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="default-select form-control wide me-2"
                                                placeholder="Select" name="port_discharge_id">
                                                <option value="">select</option>
                                                    @foreach ($ports as $port)
                                                        <option value="{{$port->id}}" {{$port->id == $bookingList->port_discharge_id ? 'selected' : ''}}>{{$port->port_name}}</option>
                                                    @endforeach
                                            </select>
                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                data-bs-toggle="modal" data-bs-target="#portDetailsModal">
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
                                            <select class="default-select form-control wide me-2"
                                                placeholder="Select" name="port_transhipment_id">
                                                <option value="">select</option>
                                                    @foreach ($ports as $port)
                                                        <option value="{{$port->id}}" {{$port->id == $bookingList->port_destination_id ? 'selected' : ''}}>{{$port->port_name}}</option>
                                                    @endforeach
                                            </select>
                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                data-bs-toggle="modal" data-bs-target="#portDetailsModal">
                                                <i class="bi bi-plus-lg">+</i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Transhipment Port:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="default-select form-control wide me-2"
                                                placeholder="Select" name="port_destination_id">
                                                <option value="">select</option>
                                                    @foreach ($ports as $port)
                                                        <option value="{{$port->id}}" {{$port->id == $bookingList->port_transhipment_id    ? 'selected' : ''}}>{{$port->port_name}}</option>
                                                    @endforeach
                                            </select>
                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                data-bs-toggle="modal" data-bs-target="#portDetailsModal">
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
                                                <option value="1" {{$bookingList->cargo_type == '1' ? 'selected' : ''}}>Non-Haz</option>
                                                <option value="2" {{$bookingList->cargo_type == '2'  ? 'selected' : ''}}>Haz</option>
                                                <option value="3" {{$bookingList->cargo_type == '3'  ? 'selected' : ''}}>Refeer</option>
                                                <option value="4" {{$bookingList->cargo_type == '4'  ? 'selected' : ''}}>Special Eq</option>
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
                                <button class="btn btn-primary me-md-2" type="button">Booking Print</button>
                                <a href="{{route('bookings.index')}}" class="btn btn-warning" type="button">Cancle</a>
                                <button class="btn btn-primary" type="submit">Update</button>
                            </div>

                        </form>

                        <hr>
                        <div class="form-validation">
                            <form action="{{ route('bookings.updateContainer',$bookingList->id ) }}" method="POST" class="needs-validation" >
                                @csrf
                                @method('PUT')
                                <div class="row">                                    
                                    <!-- Container Category -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Cont_Cat:<span class="text-danger">*</span></label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select name="container_category" class="default-select form-control wide me-2" required>
                                                    <option value="">Select</option>
                                                    <option value="TK" {{$bookingList->cont_category == 'TK' ? 'selected' : ''}}>TK</option>
                                                    <option value="HD" {{$bookingList->cont_category == 'HD' ? 'selected' : ''}}>HD</option>
                                                    <option value="HQ" {{$bookingList->cont_category == 'HQ' ? 'selected' : ''}}>HQ</option>
                                                    <option value="GP" {{$bookingList->cont_category == 'GP' ? 'selected' : ''}}>GP</option>
                                                    <option value="OT" {{$bookingList->cont_category == 'OT' ? 'selected' : ''}}>OT</option>
                                                    <option value="RF" {{$bookingList->cont_category == 'RF' ? 'selected' : ''}}>RF</option>
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
                                                    <option value="1" {{$bookingList->size == '1' ? 'selected' : ''}}>0</option>
                                                    <option value="20 GP" {{$bookingList->size == '20 GP' ? 'selected' : ''}}>20 GP</option>
                                                    <option value="40 GP" {{$bookingList->size == '40 GP' ? 'selected' : ''}}>40 GP</option>
                                                    <option value="40 HQ" {{$bookingList->size == '40 HQ' ? 'selected' : ''}}>40 HQ</option>
                                                    <option value="20 OT" {{$bookingList->size == '20 OT' ? 'selected' : ''}}>20 OT</option>
                                                    <option value="40 OT" {{$bookingList->size == '40 OT' ? 'selected' : ''}}>40 OT</option>
                                                    <option value="20 FR" {{$bookingList->size == '20 FR' ? 'selected' : ''}}>20 FR</option>
                                                    <option value="40 FR" {{$bookingList->size == '40 FR' ? 'selected' : ''}}>40 FR</option>
                                                    <option value="20 TK" {{$bookingList->size == '20 TK' ? 'selected' : ''}}>20 TK</option>
                                                    <option value="40 TK" {{$bookingList->size == '40 TK' ? 'selected' : ''}}>40 TK</option>
                                                    <option value="20 RF" {{$bookingList->size == '20 RF' ? 'selected' : ''}}>20 RF</option>
                                                    <option value="40 RF" {{$bookingList->size == '40 RF' ? 'selected' : ''}}>40 RF</option>
                                                    <option value="20 ODO" {{$bookingList->size == '20 ODO' ? 'selected' : ''}}>20 ODO</option>
                                                    <option value="40 ODO" {{$bookingList->size == '40 ODO' ? 'selected' : ''}}>40 ODO</option>
                                                    <option value="40" {{$bookingList->size == '40' ? 'selected' : ''}}>40</option>
                                                    <option value="45" {{$bookingList->size == '45' ? 'selected' : ''}}>45</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Container No -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Container No:<span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" name="container_no" class="form-control" value="{{$bookingList->container_no}}" required>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Custom Seal No -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Cust_Seal No:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="seal_no" class="form-control" value="{{$bookingList->customer_seal_no}}">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Cont DO No -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Cont_DO No:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="do_no" class="form-control" value="{{$bookingList->cont_do_no}}">
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
                            <form class="needs-validation" novalidate>
                                <div class="row">
                                    <div class="col-xl-9">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Choose File:</label>
                                            <div class="col-sm-9">
                                                <div class="d-flex">
                                                    <input type="file" class="form-control me-2" />
                                                    <button type="button" class="btn btn-warning">UploadFile</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-9">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Find PDF File:</label>
                                            <div class="col-sm-9">
                                                <div class="d-flex">
                                                    <input type="search" class="form-control me-2" />
                                                    <button type="button" class="btn btn-primary">Search</button>
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


    <!-- Modal Ocean Vsl -->
    <div class="modal fade" id="oceanVslModal" tabindex="-1" aria-labelledby="oceanVslModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="oceanVslModalLabel">Add New Vessel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="oceanVslForm">
                        <div class="mb-3 row">  
                            <label for="password" class="col-sm-4 col-form-label">Vessel Name:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" >
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Vessel Call Sign:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" >
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">IMO Code:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" >
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Status:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <select class="default-select  form-control wide" placeholder="Select"></select>
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

    <!-- Modal Port Details -->
    <div class="modal fade" id="portDetailsModal" tabindex="-1" aria-labelledby="oceanVslModalLabel"
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
                            <label for="password" class="col-sm-4 col-form-label">Address Line 1:</label>
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
@endpush
