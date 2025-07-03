@extends('admin-main.layouts.default')
@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="#">BOOKING</a></li>
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
                                            <input type="text" name="booking_no" class="form-control" value="{{ $nextBookingNo }}" readonly>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Ocean_Vsl:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select name="vessel_id" class="default-select form-control wide me-2" placeholder="Select">
                                                <option value="">select</option>
                                                @foreach ($vessels as $vessel)
                                                    <option value="{{$vessel->id}}">{{$vessel->vessel_name}}</option>
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
                                            <input type="text" name="voy_no" class="form-control">
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
                                            <input type="date" name="eta_date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Booking ValidityDays:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="validity_days" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Entry Date:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="date" name="entry_date" class="form-control">
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
                                            <select name="shipper" class="default-select form-control wide me-2" placeholder="Select">
                                                <option value="">select</option>
                                                    @foreach ($parties as $partie)
                                                        <option value="{{$partie->id}}">{{$partie->party_name}}</option>
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
                                                    @foreach ($parties as $partie)
                                                        <option value="{{$partie->id}}">{{$partie->party_name}}</option>
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
                                            <select name="empty_yard" class="default-select form-control wide me-2" placeholder="Select">
                                                <option value="">select</option>
                                                    @foreach ($parties as $partie)
                                                        <option value="{{$partie->id}}">{{$partie->party_name}}</option>
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
                                                    @foreach ($parties as $partie)
                                                        <option value="{{$partie->id}}">{{$partie->party_name}}</option>
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
                                                    @foreach ($parties as $partie)
                                                        <option value="{{$partie->id}}">{{$partie->party_name}}</option>
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
                                                        <option value="{{$port->id}}">{{$port->port_name}}</option>
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
                                                        <option value="{{$port->id}}">{{$port->port_name}}</option>
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
                                                        <option value="{{$port->id}}">{{$port->port_name}}</option>
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
                                                        <option value="{{$port->id}}">{{$port->port_name}}</option>
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
                                                <option value="BK001">BK001</option>
                                                <option value="BK002">BK002</option>
                                                <option value="BK003">BK003</option>
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
                                                <option value="CNF">CNF</option>
                                                <option value="EXW">EXW</option>
                                                <option value="FCA">FCA</option>
                                                <option value="FAS">FAS</option>
                                                <option value="FOB">FOB</option>
                                                <option value="CFR">CFR</option>
                                                <option value="CIF">CIF</option>
                                                <option value="CPT">CPT</option>
                                                <option value="CIP">CIP</option>
                                                <option value="DPU">DPU</option>
                                                <option value="DAP">DAP</option>
                                                <option value="DDP">DDP</option>
                             
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Gate Open:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="gate_open">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Container Volume:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="container_volume">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Plugging:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="plugging">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-xxl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">DO Cancel:</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="do_cancel">
                                                <option value="" class="has-arrow">Select</option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Cargo_Wt:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="cargo_wt">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Cont_Wt:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="cont_wt">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Ventilation:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="ventilation">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Temperature:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="temperature">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Commodity:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="commodity">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Package:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="package">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Humidity:</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control h-100" id="validationCustom04" rows="2" name="humidity"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Spcecial Eq.Remarks:</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control h-100" id="validationCustom04" rows="2" name="special_eq_remarks"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Class:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="class">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Sub-Class:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="sub_class">
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
                                            <textarea class="form-control h-100" id="validationCustom04" rows="2" name="imo_cd"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">UNO CD:</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control h-100" name="uno_cd" id="validationCustom04" rows="2"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Cancel Remark:</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control h-100" name="cancel_remark" id="validationCustom04" rows="2"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Special Remark:</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control h-100" name="special_remark" id="validationCustom04" rows="2"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">FullDO No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="full_do_no">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button class="btn btn-primary me-md-2 btn-sm" type="button">Booking Print</button>
                                <a href="{{route('bookings.index')}}" class="btn btn-warning btn-sm" type="button">Cancle</a>
                                <button class="btn btn-primary btn-sm" type="submit">Save</button>
                            </div>

                        </form>

                        <hr>
                        <div class="form-validation">
                            <form action="{{ route('bookings.addContainer') }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>
                                @csrf
                                <div class="row">
                                    <!-- Booking No -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Booking No:<span class="text-danger">*</span></label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select name="booking_id" class="default-select form-control wide me-2" required>
                                                    <option value="">Select</option>
                                                    @foreach ($booking_nums as $booking_num)
                                                        <option value="{{ $booking_num->id }}">{{ $booking_num->booking_no }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Container Category -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Cont_Cat:<span class="text-danger">*</span></label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select name="container_category" class="default-select form-control wide me-2" required>
                                                    <option value="">Select</option>
                                                    <option value="TK">TK</option>
                                                    <option value="HD">HD</option>
                                                    <option value="HQ">HQ</option>
                                                    <option value="GP">GP</option>
                                                    <option value="OT">OT</option>
                                                    <option value="RF">RF</option>
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
                                                    <option value="20 GP">20 GP</option>
                                                    <option value="40 GP">40 GP</option>
                                                    <option value="40 HQ">40 HQ</option>
                                                    <option value="20 OT">20 OT</option>
                                                    <option value="40 OT">40 OT</option>
                                                    <option value="20 FR">20 FR</option>
                                                    <option value="40 FR">40 FR</option>
                                                    <option value="20 TK">20 TK</option>
                                                    <option value="40 TK">40 TK</option>
                                                    <option value="20 RF">20 RF</option>
                                                    <option value="40 RF">40 RF</option>
                                                    <option value="20 ODO">20 ODO</option>
                                                    <option value="40 ODO">40 ODO</option>
                                                    <option value="40">40</option>
                                                    <option value="45">45</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Container No -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Container No:<span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" name="container_no" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Custom Seal No -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Cust_Seal No:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="seal_no" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Cont DO No -->
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Cont_DO No:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="do_no" class="form-control">
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
                            <form class="needs-validation" action="{{route('multi-file-upload.updateFileUpload')}}" method="post" enctype="multipart/form-data">
                                @csrf 
                                <input type="hidden" name="file_related" value="booking">
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
                            <form id="BookingFileForm" method="post"> 
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
    
    @include('admin-main.admin.addSalesPerson.salesperson_modal')


    <!-- Modal Ocean Vsl -->
    <div class="modal fade" id="oceanVslModal" tabindex="-1" aria-labelledby="oceanVslModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="oceanVslModalLabel">Add New Vessel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="oceanVslForm" method="POST" action="{{ route('new-vessels.store') }}">
                        @csrf
                        <div class="mb-3 row">
                            <label for="vessel_name" class="col-sm-4 col-form-label">Vessel Name:<span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" name="vessel_name" id="vessel_name" class="form-control" placeholder="Enter vessel name" required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="vessel_call_sign" class="col-sm-4 col-form-label">Vessel Call Sign:</label>
                            <div class="col-sm-8">
                                <input type="text" name="vessel_call_sign" id="vessel_call_sign" class="form-control" placeholder="Enter call sign">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="imo_code" class="col-sm-4 col-form-label">IMO Code:</label>
                            <div class="col-sm-8">
                                <input type="text" name="imo_code" id="imo_code" class="form-control" placeholder="Enter IMO code">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="status" class="col-sm-4 col-form-label">Status:<span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <select name="status" id="status" class="form-control default-select wide" required>
                                    <option value="">Select</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
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
                                <select class="default-select  form-control wide" name="party_type" placeholder="Select">
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
                                <select class="default-select  form-control wide" name="status">
                                    <option value=''>select</option>
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
    <div class="modal fade" id="portDetailsModal" tabindex="-1" aria-labelledby="oceanVslModalLabel"
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
                                    <option value=''>select</option>
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
