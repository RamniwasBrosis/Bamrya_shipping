@extends('admin-main.layouts.default')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active"><a href="#">Add Air Export BL</a></li>
    </ol>
    <a href="{{ url('admin/air-exports') }}" class="text-primary"><- Go Back</a>
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
                    <h4 class="card-title">Add New BL</h4>
                </div>
                <div class="card-body">
                    <div class="form-validation">
                        <form class="needs-validation" method="POST" id="airExportForm" action="{{route('air-exports.store')}}">
                            @csrf
                            <div class="row">
                                <h4>General Details</h4>
                                <hr>
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

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Job No:<span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="form-control wide me-2 select2 " name="job_no" id="job_numbers" onchange="updateFullJobNo(this)">
                                                <option value="">Select</option>
                                                @foreach ($job_numbers as $job_number)
                                                    <option value="{{$job_number->id}}" data-jobno="{{ $job_number->job_no }}" data-jobActivity="{{ $job_number->job_activity }}" {{ old('job_no') == $job_number->job_no ? 'selected' : '' }}>
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
                                        <label class="col-sm-3 col-form-label">MAWB No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="mawb_no" value="{{ old('mawb_no') }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">ETA DATE:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy" class="form-control" name="eta_date" value="{{ old('eta_date') }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Enquiry Reference No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="enquiry_reference_no" value="{{ old('enquiry_reference_no') }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Accounting Information:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="accountingInformation" value="{{ old('accountingInformation') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">FullJobNo:</label>
                                        <div class="col-sm-9">
                                            <input type="hidden" name="full_job_no" id="full_job_no_hidden_input" >
                                            <input type="text" class="form-control" name="full_job_no" id="full_job_no" value="{{ old('full_job_no') }}" readonly>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">BookingDate:<span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy" class="form-control" name="booking_date" value="{{ old('booking_date') }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">HAWB No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="hawb_no" value="{{ old('hawb_no') }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">ETD Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy" class="form-control" name="etd_date" value="{{ old('etd_date') }}">
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Sob Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy" class="form-control" name="sobDate" value="{{ old('sobDate') }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Account No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="accountNo" value="{{ old('accountNo') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <h4>Flight Details</h4>
                                <hr>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">FlightName1:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="flight_name_1" value="{{ old('flight_name_1') }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">FlightDate1:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy" class="form-control" name="flight_date_1" value="{{ old('flight_date_1') }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">FlightNumber1:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="flight_number_1" value="{{ old('flight_number_1') }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Flight Name 3:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="flight_name_3" value="{{ old('flight_name_3') }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Flight Number 3:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="flight_number_3" value="{{ old('flight_number_3') }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">GrossWeight:<span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="gross_weight" value="{{ old('gross_weight') }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">TareWeight:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="tare_weight" value="{{ old('tare_weight') }}" readonly style="background: #e7e9eb;">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Movement:<span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="default-select form-control wide me-2"
                                                placeholder="Select" name="movement">
                                                <option value="">select</option>
                                                <option value="AIRPORTTOAIRPORT" {{ old('movement') == 'AIRPORTTOAIRPORT' ? 'selected' : '' }}>AIR PORT TO AIR PORT</option>
                                                <option value="AIRPORTTODOOR" {{ old('movement') == 'CY/CFS' ? 'selected' : '' }}>AIR PORT TO DOOR</option>
                                                <option value="DOORTODOOR" {{ old('movement') == 'CFS/CY' ? 'selected' : '' }}>DOOR TO DOOR</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Package:<span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="package" value="{{ old('package') }}">
                                            
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Customer Acc No.:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="customer_acc_no" value="{{ old('customer_acc_no') }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">SHIPPER ( Sales Person ):<span class="text-danger">*</span></label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="form-control wide me-2 select2"
                                                placeholder="Select" name="sales_person_id">
                                                <option value="">Select SHIPPER ( Sales Person )</option>
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
                                        <label class="col-sm-3 col-form-label">FlightName2:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="flight_name_2" value="{{ old('flight_name_2') }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">FlightDate2:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy" class="form-control" name="flight_date_2" value="{{ old('flight_date_2') }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">FlightNumber2:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="flight_number_2" value="{{ old('flight_number_2') }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Flight Date 3:</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control" name="flight_date_3" value="{{ old('flight_date_3') }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Chargable_Wt:<span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="chargable_weight" value="{{ old('chargable_weight') }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Net Weight:<span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="net_weight" value="{{ old('net_weight') }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">IssuePlace:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="issue_place" value="{{ old('issue_place') }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Iata Agent Code:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="iata_agent" value="{{ old('iata_agent') }}">
                                        </div>
                                    </div>
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
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Issue Date:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy" class="form-control" name="issue_date" value="{{ old('issue_date') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <h4>Party Details</h4>
                                <hr>
                                <div class="col-xl-6 col-xxl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">
                                            Shipper:<span class="text-danger">*</span>
                                        </label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <input type="hidden" id="shipper_id_hidden_input" name="shipper_id" >
                                            <select class="select2 form-control me-2" name="shipper_id" id="shipper_id" required>
                                                <option value="">Select</option>
                                                @foreach ($exportParites as $party)
                                                <option value="{{ $party->id }}" {{ old('shipper_id') == $party->id ? 'selected' : '' }}>
                                                    {{ $party->party_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                            <!--<button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exportPartyDetails">-->
                                            <!--    <i class="bi bi-plus-lg">+</i>-->
                                            <!--</button>-->
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Consignee:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="form-control wide me-2 select2"
                                                placeholder="Select" name="consignee_id" id="consignee_id">
                                                <option value="">Select Consignee</option>
                                                @foreach ($parties->where('party_type', 1) as $party)
                                                <option value="{{ $party->id }}" {{ old('consignee_id') == $party->id ? 'selected' : '' }}>{{$party->party_name}}</option>
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
                                        <label class="col-sm-3 col-form-label">Iata Agent:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="form-control wide me-2 select2"
                                                placeholder="Select" name="lata_agent">
                                                <option value="">Select Iata Agent</option>
                                                @foreach ($parties->where('party_type', 15) as $party)
                                                <option value="{{ $party->id }}" {{ old('lata_agent') == $party->id ? 'selected' : '' }}>{{$party->party_name}}</option>
                                                @endforeach
                                            </select>
                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                data-bs-toggle="modal" data-bs-target="#partyDetailsModal" data-target-field="lata_agent">
                                                <i class="bi bi-plus-lg">+</i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">OverSeas_Agent:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="form-control wide me-2 select2"
                                                placeholder="Select" name="overSeas_agent">
                                                <option value="">Select OverSeas_Agent</option>
                                                @foreach ($parties->where('party_type', 14) as $party)
                                                <option value="{{ $party->id }}" {{ old('overSeas_agent') == $party->id ? 'selected' : '' }}>{{$party->party_name}}</option>
                                                @endforeach
                                            </select>
                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                data-bs-toggle="modal" data-bs-target="#partyDetailsModal" data-target-field="overSeas_agent">
                                                <i class="bi bi-plus-lg">+</i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!--notify-->
                                <div class="col-xl-6 col-xxl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Notify:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="select2 form-control wide me-2" name="notify_id" placeholder="Select">
                                                <option value="">Select Notify</option>
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
                                </div>
                                <div class="col-xl-6 col-xxl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Notify 2:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="select2 form-control wide me-2" name="notify2_id" placeholder="Select">
                                                <option value="">Select Notify 2</option>
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
                                <div class="col-xl-6 col-xxl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">CHA:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="form-control wide me-2 select2"
                                                placeholder="Select" name="cha_party_id" id="cha_party_id">
                                                <option value="">Select CHA</option>
                                                @foreach ($parties->where('party_type', 3) as $party)
                                                <option value="{{ $party->id }}" {{ old('cha_party_id') == $party->id ? 'selected' : '' }}>{{$party->party_name}}</option>
                                                @endforeach
                                            </select>
                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                data-bs-toggle="modal" data-bs-target="#partyDetailsModal" data-target-field="cha_party_id">
                                                <i class="bi bi-plus-lg">+</i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>

                            <div class="row">
                                <h4>Port Details</h4>
                                <hr>
                                <div class="col-xl-6 col-xxl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Loading Port:<span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="form-control wide me-2 select2"
                                                placeholder="Select" name="loading_port_id">
                                                <option value="">Select Loading Port</option>
                                                @foreach ($ports as $port)
                                                <option value="{{ $port->id }}" {{ old('loading_port_id') == $port->id ? 'selected' : '' }}>{{$port->port_name}}</option>
                                                @endforeach
                                            </select>
                                            <button type="button" class="btn btn-sm btn-outline-primary" data-target-select="loading_port_id"
                                                data-bs-toggle="modal" data-bs-target="#addNewPortDetails">
                                                <i class="bi bi-plus-lg">+</i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Discharge Port:<span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="select2 form-control wide me-2"
                                                placeholder="Select" name="discharge_port_id">
                                                <option value="">Select Discharge Port</option>
                                                @foreach ($ports as $port)
                                                <option value="{{ $port->id }}" {{ old('discharge_port_id') == $port->id ? 'selected' : '' }}>{{$port->port_name}}</option>
                                                @endforeach
                                            </select>
                                            <button type="button" class="btn btn-sm btn-outline-primary" data-target-select="discharge_port_id"
                                                data-bs-toggle="modal" data-bs-target="#addNewPortDetails">
                                                <i class="bi bi-plus-lg">+</i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Insurance:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="insurance" name="insurance" value="{{ old('insurance') }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">F.Premium.Amt:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="fpa_amount" value="{{ old('fpa_amount') }}">
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
                                        <label class="col-sm-3 col-form-label">Receipt Port:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="select2 form-control wide me-2"
                                                placeholder="Select" name="receipt_port_id">
                                                <option value="">Select Receipt Port</option>
                                                @foreach ($ports as $port)
                                                <option value="{{$port->id}}" {{ old('receipt_port_id') == $port->id ? 'selected' : '' }}>
                                                    {{ $port->port_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                            <button type="button" class="btn btn-sm btn-outline-primary" data-target-select="receipt_port_id"
                                                data-bs-toggle="modal" data-bs-target="#addNewPortDetails">
                                                <i class="bi bi-plus-lg">+</i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Delivery Port:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="select2 form-control wide me-2"
                                                placeholder="Select" name="delivery_port_id">
                                                <option value="">Select Delivery Port</option>
                                                @foreach ($ports as $port)
                                                <option value="{{$port->id}}" {{ old('delivery_port_id') == $port->id ? 'selected' : '' }}>
                                                    {{ $port->port_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                            <button type="button" class="btn btn-sm btn-outline-primary" data-target-select="delivery_port_id"
                                                data-bs-toggle="modal" data-bs-target="#addNewPortDetails">
                                                <i class="bi bi-plus-lg">+</i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Port of Destination:</label>
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
                                    <!--    <label class="col-sm-3 col-form-label">Bill of Entry:</label>-->
                                    <!--    <div class="col-sm-9">-->
                                    <!--        <input type="text" class="form-control" name="shipping_bill" value="{{ old('shipping_bill') }}">-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                </div>
                            </div>
                            
                            <div class="row">
                                <h4>Air Waybill Details</h4>
                                <hr>
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
                                        <label class="col-sm-3 col-form-label">TO:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="to_air" value="{{ old('to_air') }}">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">By(second):</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="by_second" value="{{old('by_second')}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">TO(second):</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="to_air_sec" value="{{ old('to_air_sec') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">By(third):</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="by_third" value="{{old('by_third')}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">TO(third):</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="to_air_third" value="{{ old('to_air_third') }}">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Freight:<span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="freight" value="{{ old('freight') }}">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Currency:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="currency" value="{{ old('currency') }}">
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
                                            <input type="text" class="form-control" name="executed_by" value="{{ old('executed_by') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Rate/Charges:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="rate_charges" value="{{ old('rate_charges', 'as agreed') }}">
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

                            <div class="row">
                                <h4>Other Details</h4>
                                <hr>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Marks And No's:<span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control h-100" id="validationCustom04" rows="2" name="mark_number">{{ old('mark_number') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Goods description:<span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control h-100" id="validationCustom04" rows="2" name="goods_description">{{ old('goods_description') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Handling Information:</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control h-100" id="validationCustom04" rows="2" name="handling_information">{{ old('handling_information') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Dimension:</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control h-100" id="validationCustom04" rows="2" name="dimention">{{ old('dimention') }}</textarea>
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
                                            <!--<input type="date" class="form-control" placeholder="dd/mm/yy" name="check_list_date" value="{{ old('check_list_date') }}">-->
                                            <textarea class="form-control h-100" name="check_list_date" rows="3">{{ old('check_list_date') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Cartining Date:</label>
                                        <div class="col-sm-9">
                                            <!--<input type="date" class="form-control" placeholder="dd/mm/yy" name="cartining_date" value="{{ old('cartining_date') }}">-->
                                            <textarea class="form-control h-100" name="cartining_date" rows="3">{{ old('cartining_date') }}</textarea>
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
                                        <label class="col-sm-3 col-form-label">LEO Date:</label>
                                        <div class="col-sm-9">
                                            <!--<input type="date" class="form-control" placeholder="dd/mm/yy" name="leo_date" value="{{ old('leo_date') }}">-->
                                            <textarea class="form-control h-100" name="leo_date" rows="3">{{ old('leo_date') }}</textarea>
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
                                
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <a href="{{route('air-exports.index')}}" class="btn btn-warning" type="button">Cancel</a>
                                    <button class="btn btn-primary" type="submit">Save</button>
                                </div>
                            </div>

                        </form>
                        <div id="form-messages"></div>
                    </div>

                    <h4>File Upload</h4>
                    <hr>
                    <div class="form-validation">
                        <form class="needs-validation" action="{{route('multi-file-upload.updateFileUpload')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="file_related" value="air_export">
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
                        <!--<form id="AirExportFileForm" method="post">-->
                        <!--    @csrf-->
                        <!--    <div class="col-xl-9">-->
                        <!--        <div class="mb-3 row">-->
                        <!--            <label class="col-sm-3 col-form-label">Find PDF File:<span class="text-danger">*</span></label>-->
                        <!--            <div class="col-sm-9">-->
                        <!--                <div class="d-flex">-->
                        <!--                    <select class="select2 form-control wide me-2"-->
                        <!--                        placeholder="Select" name="search_query">-->
                        <!--                        <option value="">select</option>-->
                        <!--                        @foreach ($files as $file)-->
                        <!--                        <option value="{{$file->id}}" {{ old('search_query') == $file->id ? 'selected' : ''  }}>{{$file->file_name}}</option>-->
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

@include('admin-main.admin.commonModelForms.salesperson_modal')


<!-- Modal Port Details -->
@include('admin-main.admin.commonModelForms.addNewPort_modal')

<!-- Modal Package Details -->
@include('admin-main.admin.commonModelForms.addNewPackageModel')

<!-- Modal Party Details -->
@include('admin-main.admin.commonModelForms.modelPartyDetails')
<!-- Add new export Modal -->
@include('admin-main.admin.commonModelForms.addExportPartiesModel')
<!-- Add new Forwarder Modal -->
@include('admin-main.admin.commonModelForms.modelForwarder')

@endsection
@push('scripts')
<script>
    $(document).ready(function () {
        
        flatpickr("input[type='date']", {
            altInput: true,
            altFormat: "d/m/Y",   
            dateFormat: "Y-m-d", 
            allowInput: true
        });
        
        $("#airExportForm").on("submit", function (e) {
            e.preventDefault();
    
            let form = $(this);
            let url = form.attr("action");
            let formData = form.serialize();
    
            $.ajax({
                type: "POST",
                url: url,
                data: formData,
                success: function (response) {
                    $("#form-messages").html(
                        `<div class="alert alert-success">${response.message}</div>`
                    );
                    // Optionally reset form
                    form.trigger("reset");
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
                        $("#form-messages").html(errorHtml);
                    } else {
                        $("#form-messages").html(
                            `<div class="alert alert-danger">Something went wrong.</div>`
                        );
                    }
                },
            });
        });
    });








    function updateFullJobNo(selectElement) {
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        const selectedJobId = selectedOption ? selectedOption.value : ''; // job_number->id
        const selectedJobNo = selectedOption ? selectedOption.dataset.jobno : ''; // job_number->job_no
        const selectedJobActivity = selectedOption ? selectedOption.dataset.jobactivity : '';
 
        // Set hidden inputs
        document.getElementById('job_no_hidden').value = selectedJobId;
    
        const jobHidden = document.getElementById('full_job_no');
        jobHidden.style.cursor = 'not-allowed';
        jobHidden.style.backgroundColor = '#e9ecef';
        
        // update hidden field in file upload form
        let uploadHidden = document.querySelector('form[action="{{route('multi-file-upload.updateFileUpload')}}"] #job_no_hidden');
        if (uploadHidden) {
            uploadHidden.value = selectedJobId; // use job ID instead of job_no
        }
        
     
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
    $(document).ready(function() {
        $('.select2').select2({
            // placeholder: 'Select a value',
            // 'allowClear': true,
            width: '100%'
        })
    })

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
        
        // add export party using ajax
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
        
        //get job numbers
        $('#job_numbers').on('change', function(e) {
            e.preventDefault();
            
            var selectId = $(this).val();
            var selectJobActivity = $(this).find(':selected').data('jobactivity');
            
            if (selectId) {
                $.ajax({
                    url: '/get-job-details', // Update this URL based on your route
                    method: 'POST',
                    data: {
                        job_id: selectId,
                        job_activity: selectJobActivity,
                        _token: $('meta[name="csrf-token"]').attr('content') // CSRF token for Laravel
                    },
                    success: function(response) {
                        console.log(response) 
                        
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
                  
                        // 1. Set the value
                        $('#shipper_id').val(response.job_party_id);
                        $('#shipper_id_hidden_input').val(response.job_party_id);
    
                        // 2. Trigger change for select2 or other plugin to update UI
                        $('#shipper_id').trigger('change');
    
                        // 3. If you're using Bootstrap Select
                        $('#input_shipper_id').val(response.job_party_id);
                        $('#shipper_id')
                        .prop('disabled', true)
                        .css({
                            'cursor': 'not-allowed',
                            'background-color': '#e9ecef'
                        });
                        
                        $('#full_job_no').val(response.jobMasterData.full_job_no);
                        $('#full_job_no_hidden_input').val(response.jobMasterData.full_job_no);
                    },
                    error: function(xhr) {
                        let msg = "Something went wrong!";

                        // If backend returns { "error": "Job already exists" }
                        if (xhr.responseJSON && xhr.responseJSON.error) {
                            msg = xhr.responseJSON.error;
                        }
                    
                        $("#jobErrorBox").hide().html(msg).fadeIn();
                        $('#airExportForm')[0].reset();
                    }
                });
            }
        });
        
        // sales person submit using ajax
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
        
        // forwareder model form
        $('#modelForwarderForms').on('submit', function(e) {
            e.preventDefault();
        
            $.ajax({
                url: "{{ route('forwarder.store') }}",
                method: 'POST',
                data: $(this).serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        $('select[name="forwarder_id"]').each(function() {
                            $(this).append(`<option value="${response.party.id}" selected>${response.party.name}</option>`);
                            $(this).trigger('change'); // refresh Select2 if used
                        });
        
                        $('#modelForwarderForms')[0].reset();
                        $('#modelForwarderDetails').modal('hide');
                    }
                },
                error: function(xhr) {
                    alert('Failed to add forwarder details');
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
    $(document).ready(function() {
        $('#addNewPackageModel').on('submit', function(e) {
            e.preventDefault(); // stops normal form submission
    
            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    const newOption = new Option(response.package.name, response.package.id, true, true);
                    $('select[name="package_id"]').append(newOption).trigger('change');
    
                    // Hide Bootstrap 5 modal
                    var modalEl = document.getElementById('AddNewPackageModal');
                    var modal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
                    modal.hide();
    
                    $('#addNewPackageModel')[0].reset();
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });
        });
    });

</script>
<script>
    $(document).ready(function() {
        let targetField = null;
    
        $('#partyDetailsModal').on('show.bs.modal', function (event) {
            const button = $(event.relatedTarget); 
            targetField = button.data('target-field'); // e.g. 'consignee_id'
        });
    
        $('#modelPartyDetails').on('submit', function(e) {
            e.preventDefault();
    
            $.ajax({
                url: "{{ route('new-party.store') }}",
                method: 'POST',
                data: $(this).serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                
                        const partyId = response.party.id;
                        const partyName = response.party.name;
                
                        // Step 1: all dropdowns that must receive the new party
                        const dropdowns = [
                            'consignee_id',
                            'notify_id',
                            'notify2_id',
                            'cha_party_id'
                        ];
                
                        // Step 2: append option to ALL select fields
                        dropdowns.forEach(function(field) {
                            const selectEl = $('select[name="' + field + '"]');
                
                            // avoid duplicate option
                            if (selectEl.find('option[value="' + partyId + '"]').length === 0) {
                                selectEl.append(new Option(partyName, partyId, false, false));
                            }
                        });
                
                        // Step 3: SELECT only the dropdown from where the + was clicked
                        if (targetField) {
                            $('select[name="' + targetField + '"]')
                                .val(partyId)
                                .trigger('change');
                        }
                
                        // Reset form & close modal
                        $('#modelPartyDetails')[0].reset();
                        $('#partyDetailsModal').modal('hide');
                    }
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
    });
</script>

<script>
    $(document).ready(function() {
       
        //add-port-details-y
        let activePortSelect = null;
        $(document).on('click', '[data-target-select]', function () {
            activePortSelect = $(this).data('target-select'); // e.g. 'loading_port_id'
        });
        
        // port details model
        $('#portDetailsModel').on('submit', function (e) {
            e.preventDefault();
        
            $.ajax({
                url: "{{ route('new-port.store') }}",
                type: 'POST',
                data: $(this).serialize(),
                success: function (response) {
                    if (response.success) {
                        const portId = response.port.id;
                        const portName = response.port.name; // ✅ Make sure backend key is `name`
        
                        // ✅ Step 1: Add new option to all port dropdowns
                        $('select[name$="_port_id"]').each(function () {
                            const select = $(this);
        
                            // Add only if doesn't already exist
                            if (select.find('option[value="' + portId + '"]').length === 0) {
                                const newOption = new Option(portName, portId, false, false);
                                select.append(newOption);
                            }
        
                            // ✅ Refresh Select2
                            if (select.hasClass('select2')) {
                                select.trigger('change.select2');
                            }
                        });
        
                        // ✅ Step 2: Select the new port in the one that triggered the modal
                        if (activePortSelect) {
                            const activeSelect = $('select[name="' + activePortSelect + '"]');
        
                            if (activeSelect.length) {
                                activeSelect.val(portId).trigger('change');
                            }
                        }
        
                        // ✅ Step 3: Reset form + modal
                        $('#portDetailsModel')[0].reset();
                        $('#addNewPortDetails').modal('hide');
        
                        toastr.success('Port added successfully!');
                    } else {
                        toastr.error('Something went wrong: ' + JSON.stringify(response));
                    }
                },
                error: function (xhr) {
                    toastr.error('Failed to add new port.');
                    console.error(xhr.responseText);
                }
            });
        });
        
        // Reset after modal closed
        $('#addNewPortDetails').on('hidden.bs.modal', function () {
            activePortSelect = null;
        });
       
        
    });

</script>
<script>
    document.getElementById('AirExportFileForm').addEventListener('submit', function(e) {
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