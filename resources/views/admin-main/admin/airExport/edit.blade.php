@extends('admin-main.layouts.default')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active"><a href="#">Edit Air Export BL</a></li>
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

<div class="container-fluid p-2">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Air Export BL</h4>
                </div>
                <div class="card-body">
                    <form class="needs-validation" method="POST" id="airExportEditForm" action="{{route('air-exports.update', $air_export->id )}}">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <h4>General Details</h4>
                            <hr>
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Job No:<span class="text-danger">*</span></label>
                                    <div class="col-sm-9 d-flex align-items-center">
                                        <input type="hidden" name="job_no" value="{{ old('job_no', $air_export->job_no ?? '') }}">
                                        <select class="form-control wide me-2 select2"
                                            placeholder="Select" name="job_no" id="job_numbers" readonly>
                                            <option value="">select</option>
                                            @foreach ($job_numbers as $job_number)
                                            <option value="{{ $job_number->id }}"
                                                {{ old('job_no', $air_export->job_no ?? '') == $job_number->id ? 'selected' : '' }}>
                                                {{ $job_number->job_no }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <!-- <input type="text" class="form-control" value="{{$air_export->job_no}}" name="job_no"> -->
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Booking No:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="{{$air_export->booking_no}}" name="booking_no">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">MAWB No:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="{{$air_export->mawb_no}}" name="mawb_no">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">ETA DATE:</label>
                                    <div class="col-sm-9">
                                        <input type="date" placeholder="dd/mm/yy"  class="form-control" value="{{$air_export->eta_date}}" name="eta_date">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Enquiry Reference No:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="{{$air_export->enquiry_reference_no}}" name="enquiry_reference_no">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Accounting Information:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="accountingInformation" value="{{ $air_export->accountingInformation }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">FullJobNo:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="{{$air_export->full_job_no}}" name="full_job_no" readonly>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">BookingDate:</label>
                                    <div class="col-sm-9">
                                        <input type="date" placeholder="dd/mm/yy"  placeholder="dd/mm/yy"  class="form-control" value="{{$air_export->booking_date}}" name="booking_date">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">HAWB No:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="{{$air_export->hawb_no}}" name="hawb_no">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">ETD Date:</label>
                                    <div class="col-sm-9">
                                        <input type="date" placeholder="dd/mm/yy"  class="form-control" value="{{$air_export->etd_date}}" name="etd_date">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">SOB Date:</label>
                                    <div class="col-sm-9">
                                        <input type="date" placeholder="dd/mm/yy"  class="form-control" value="{{$air_export->sobDate}}" name="sobDate">
                                    </div>
                                </div>
                           
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Account No:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="accountNo" value="{{ $air_export->accountNo }}">
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
                                        <input type="text" class="form-control" value="{{$air_export->flight_name_1}}" name="flight_name_1">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">FlightDate1:</label>
                                    <div class="col-sm-9">
                                        <input type="date" placeholder="dd/mm/yy"  class="form-control" value="{{$air_export->flight_date_1}}" name="flight_date_1">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">FlightNumber1:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="{{$air_export->flight_number_1}}" name="flight_number_1">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Flight Name 3:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="{{$air_export->flight_name_3}}" name="flight_name_3">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Flight Number 3:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="{{$air_export->flight_number_3}}" name="flight_number_3">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">GrossWeight:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="{{$air_export->gross_weight}}" name="gross_weight">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">TareWeight:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="{{$air_export->tare_weight}}" class="tare_weight">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Movement:</label>
                                    <div class="col-sm-9 d-flex align-items-center">
                                        <select class="default-select form-control wide me-2"
                                            placeholder="Select" name="movement">
                                            <option value="">select</option>
                                            <option value="AIRPORTTOAIRPORT" {{$air_export->movement == 'AIRPORTTOAIRPORT'? 'selected' : ''}}>AIR PORT TO AIR PORT</option>
                                            <option value="AIRPORTTODOOR" {{$air_export->movement == 'AIRPORTTODOOR'? 'selected' : ''}}>AIR PORT TO DOOR</option>
                                            <option value="DOORTODOOR" {{$air_export->movement == 'DOORTODOOR'? 'selected' : ''}}>DOOR TO DOOR</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Package:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="{{$air_export->package}}" name="package">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">SHIPPER ( Sales Person ):<span class="text-danger">*</span></label>
                                    <div class="col-sm-9 d-flex align-items-center">
                                        <select class="select2 form-control wide me-2"
                                            placeholder="Select" name="sales_person_id">
                                            <option value="">Select SHIPPER ( Sales Person )</option>
                                            @foreach ($salePersons as $salePerson)
                                            <option value="{{$salePerson->id}}" {{$air_export->sales_person_id == $salePerson->id ? 'selected' : ''}}>{{$salePerson->name}}</option>
                                            @endforeach
                                        </select>
                                       
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">FlightName2:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="{{$air_export->flight_name_2}}" name="flight_name_2">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">FlightDate2:</label>
                                    <div class="col-sm-9">
                                        <input type="date" placeholder="dd/mm/yy"  class="form-control" value="{{$air_export->flight_date_2}}" name="flight_date_2">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">FlightNumber2:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="{{$air_export->flight_number_2}}" name="flight_number_2">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Flight Date 3:</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" value="{{$air_export->flight_date_3}}" name="flight_date_3">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Chargable_Wt:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="{{$air_export->chargable_weight}}" name="chargable_weight">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Net Weight:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="{{$air_export->net_weight}}" name="net_weight">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">IssuePlace:<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="{{$air_export->issue_place}}" name="issue_place">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Iata Agent:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="{{$air_export->iata_agent}}" name="iata_agent">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Pkg Type:</label>
                                    <div class="col-sm-9 d-flex align-items-center">
                                        <select name="package_id" class="select2 form-control wide me-2">
                                            <option value="">Select Pkg Type</option>
                                            @foreach ($packages as $package)
                                            <option value="{{$package->id}}" {{$air_export->package_id == $package->id ? 'selected' : ''}}>{{$package->package_code}}</option>
                                            @endforeach
                                        </select>
                                      
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Issue Date:<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="date" placeholder="dd/mm/yy"  class="form-control" value="{{$air_export->issue_date}}" name="issue_date">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Customer Acc No.:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="{{$air_export->customer_acc_no}}" name="customer_acc_no">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <h4>Party Details</h4>
                            <hr>
                            <div class="col-xl-6 col-xxl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">SHIPPER:</label>
                                    <div class="col-sm-9 d-flex align-items-center">
                                        <select class="select2 form-control wide me-2"
                                            placeholder="Select" name="shipper_id">
                                            <option value="">Select Shipper</option>
                                            @foreach ($exportParites as $party)
                                            <option value="{{$party->id}}" {{$air_export->shipper_id == $party->id ? 'selected' : ''}}>{{$party->party_name}}</option>
                                            @endforeach
                                        </select>
                                        
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Consignee:</label>
                                    <div class="col-sm-9 d-flex align-items-center">
                                        <select class="select2 form-control wide me-2"
                                            placeholder="Select" name="consignee_id">
                                            <option value="">Select Consignee</option>
                                            @foreach ($parties->where('party_type', 1) as $party)
                                            <option value="{{$party->id}}" {{$air_export->consignee_id == $party->id ? 'selected' : ''}}>{{$party->party_name}}</option>
                                            @endforeach
                                        </select>
                                      
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6 col-xxl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Iata Agent:</label>
                                    <div class="col-sm-9 d-flex align-items-center">
                                        <select class="select2 form-control wide me-2"
                                            placeholder="Select" name="lata_agent">
                                            <option value="">Select Iata Agent</option>
                                            @foreach ($parties->where('party_type', 15) as $party)
                                            <option value="{{$party->id}}" {{$air_export->lata_agent == $party->id ? 'selected' : ''}}>{{$party->party_name}}</option>
                                            @endforeach
                                        </select>
                                       
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">OverSeas_Agent:</label>
                                    <div class="col-sm-9 d-flex align-items-center">
                                        <select class="select2 form-control wide me-2"
                                            placeholder="Select" name="overSeas_agent">
                                            <option value="">Select OverSeas_Agent</option>
                                            @foreach ($parties->where('party_type', 14) as $party)
                                            <option value="{{$party->id}}" {{$air_export->overSeas_agent == $party->id ? 'selected' : ''}}>{{$party->party_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-xxl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Notify:</label>
                                    <div class="col-sm-9 d-flex align-items-center">
                                        <select class="select2 form-control wide me-2" name="notify_id" placeholder="Select">
                                            <option value="">Select Notify</option>
                                            @foreach ($parties as $party)
                                            <option value="{{$party->id}}" {{$air_export->notify_id == $party->id ? "selected" : ''}}>{{$party->party_name}}</option>
                                            @endforeach
                                        </select>
                                     
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-xxl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Notify 2:</label>
                                    <div class="col-sm-9 d-flex align-items-center">
                                        <select class="select2 form-control wide me-2" name="notify2_id" placeholder="Select">
                                            <option value="">Select Notify 2</option>
                                            @foreach ($parties as $party)
                                            <option value="{{$party->id}}" {{$air_export->notify2_id == $party->id ? "selected" : ''}}>{{$party->party_name}}</option>
                                            @endforeach
                                        </select>
                                       
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
                                            <option value="{{$party->id}}" {{$air_export->forwarder_id == $party->id ? "selected" : ''}}>{{$party->party_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">CHA:</label>
                                    <div class="col-sm-9 d-flex align-items-center">
                                        <select class="select2 form-control wide me-2"
                                            placeholder="Select" name="cha_party_id">
                                            <option value="">Select CHA</option>
                                            @foreach ($parties->where('party_type', 3) as $party)
                                            <option value="{{$party->id}}" {{$air_export->cha_party_id == $party->id ? 'selected' : ''}}>{{$party->party_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                                
                        </div>
                        <div class="row">
                            <h4>Port Details</h4>
                            <hr>
                            <div class="col-xl-6 col-xxl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Loading Port:</label>
                                    <div class="col-sm-9 d-flex align-items-center">
                                        <select class="select2 form-control wide me-2"
                                            placeholder="Select" name="loading_port_id">
                                            <option value="">Select Loading Port</option>
                                            @foreach ($ports as $port)
                                            <option value="{{$port->id}}" {{$air_export->loading_port_id == $port->id ? 'selected' : ''}}>{{$port->port_name}}</option>
                                            @endforeach
                                        </select>
                                       
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Discharge Port:</label>
                                    <div class="col-sm-9 d-flex align-items-center">
                                        <select class="select2 form-control wide me-2"
                                            placeholder="Select" name="discharge_port_id">
                                            <option value="">Select Discharge Port</option>
                                            @foreach ($ports as $port)
                                            <option value="{{$port->id}}" {{$air_export->discharge_port_id == $port->id ? 'selected' : ''}}>{{$port->port_name}}</option>
                                            @endforeach
                                        </select>
                                       
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Insurance:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="{{$air_export->insurance}}" name="insurance">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">F.Premium.Amt:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="{{$air_export->fpa_amount}}" name="fpa_amount">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Transportation:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="{{$air_export->transportation}}" name="transportation">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-xxl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Receipt Port:<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9 d-flex align-items-center">
                                        <select class="select2 form-control wide me-2"
                                            placeholder="Select" name="receipt_port_id">
                                            <option value="">Select Receipt Port</option>
                                            @foreach ($ports as $port)
                                            <option value="{{$port->id}}" {{$air_export->receipt_port_id == $port->id ? 'selected' : ''}}>{{$port->port_name}}</option>
                                            @endforeach
                                        </select>
                                       
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Delivery Port:</label>
                                    <div class="col-sm-9 d-flex align-items-center">
                                        <select class="select2 form-control wide me-2"
                                            placeholder="Select" name="delivery_port_id">
                                            <option value="">Select Delivery Port</option>
                                            @foreach ($ports as $port)
                                            <option value="{{$port->id}}" {{$air_export->delivery_port_id == $port->id ? 'selected' : ''}}>{{$port->port_name}}</option>
                                            @endforeach
                                        </select>
                                       
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Port of Destination:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="form-control wide me-2 select2"
                                                name="destination_port_id">
                                                <option value="">Select Dest_Port</option>
                                                @foreach ($ports as $port)
                                                <option value="{{$port->id}}" {{$port->id == $air_export->destination_port_id? 'selected' : ''}}>{{$port->port_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Transportation Details:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="{{$air_export->transportation_details}}" name="transportation_details">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Clearance:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="{{$air_export->clearance}}" name="clearance">
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                        
                        <div class="row">
                            <h4>Air Waybill Details</h4>
                            <hr>
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Freight:<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="freight" value="{{ $air_export->freight }}">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">TO:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="to_air" value="{{ $air_export->to_air }}">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">By First Carrier:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="by_first_carrier" value="{{ $air_export->by_first_carrier }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Currency:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="currency" value="{{ $air_export->currency }}">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Declared Value for Carrier:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="declared_value_by_carrier" value="{{ $air_export->declared_value_by_carrier }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Declared Value for Customs:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="declared_value_by_customs" value="{{ $air_export->declared_value_by_customs }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Routing and Destination:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="routing_destination" value="{{ $air_export->routing_destination }}">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">CHGS Code:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="chgs_code" value="{{ $air_export->chgs_code }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Reference Number:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="reference_number" value="{{ $air_export->reference_number }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Shipper or his Agent:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="shipper_agent" value="{{ $air_export->shipper_agent }}">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Executed By:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="executed_by" value="{{$air_export->executed_by}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Rate/Charges:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="rate_charges" value="{{ $air_export->rate_charges }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Total Other Charges Due Agent:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="other_charges_due_agent" value="{{ $air_export->other_charges_due_agent }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Total Other Charges Due Carrier:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="other_charges_due_carrier" value="{{ $air_export->other_charges_due_carrier }}">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Other Charges:</label>
                                    <div class="col-sm-9">
                                        <textarea type="text" class="form-control" name="other_charges">{{ $air_export->other_charges }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <h4>Other Details</h4>
                            <hr>
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Marks And No's:</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control h-100" id="validationCustom04" rows="2" name="mark_number">{{$air_export->mark_number}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Goods description:</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control h-100" id="validationCustom04" rows="2" name="goods_description">{{$air_export->goods_description}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Handling Information:</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control h-100" id="validationCustom04" rows="2" name="handling_information">{{$air_export->handling_information}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Dimension:</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control h-100" id="validationCustom04" rows="2" name="dimention">{{$air_export->dimention}}</textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Inv No / Inv Dt:</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control h-100" name="customer_inv_no" rows="2">{{$air_export->customer_inv_no}}</textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Check List Date:</label>
                                    <div class="col-sm-9">
                                        <!--<input type="date" class="form-control" placeholder="dd/mm/yy" name="check_list_date" value="{{$air_export->check_list_date}}">-->
                                        <textarea class="form-control h-100" name="check_list_date" rows="3">{{ $air_export->check_list_date }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Cartining Date:</label>
                                    <div class="col-sm-9">
                                        <!--<input type="date" class="form-control" placeholder="dd/mm/yy" name="cartining_date" value="{{$air_export->cartining_date}}">-->
                                        <textarea class="form-control h-100" name="cartining_date" rows="3">{{ $air_export->cartining_date }}</textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Sbill No / Sbill Date:</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control h-100" name="sbill_no" rows="2">{{$air_export->sbill_no}}</textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">LEO Date:</label>
                                    <div class="col-sm-9">
                                        <!--<input type="date" class="form-control" placeholder="dd/mm/yy" name="leo_date" value="{{$air_export->leo_date}}">-->
                                        <textarea class="form-control h-100" name="leo_date" rows="3">{{ $air_export->leo_date }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Remarks:<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="remarks" value="{{$air_export->remarks}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Flight Status:</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control h-100" name="flight_status" rows="3">{{$air_export->flight_status}}</textarea>
                                    </div>
                                </div>
                            </div>
                            
                            
                            
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('hawb.draft.option',$air_export->id ) }}" class="btn btn-primary btn-sm " type="button">HAWB Bill</a>
                                <a href="{{ route('awb.draft.option',$air_export->id ) }}" class="btn btn-primary btn-sm " type="button">AirWay Bill PRINT</a>
                                <a href="{{route('air-exports.index')}}" class="btn btn-warning btn-sm" type="button">Cancel</a>
                                <button class="btn btn-primary btn-sm" type="submit">update</button>
                            </div>
                        </div>
                    </form>
                    <div id="form-messages"></div>


                    <h4>File Upload</h4>
                    <hr>
                    <div class="form-validation">
                        <form class="needs-validation" action="{{route('multi-file-upload.updateFileUpload')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="file_related" value="air_export">
                            <input type="hidden" name="job_no" id="job_no_hidden" value="{{ $air_export->job_no }}">
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
                        <!--<form id="AirExportFileForm" method="post">-->
                        <!--    @csrf-->
                        <!--    <div class="col-xl-9">-->
                        <!--        <div class="mb-3 row">-->
                        <!--            <label class="col-sm-3 col-form-label">Find PDF File:</label>-->
                        <!--            <div class="col-sm-9">-->
                        <!--                <div class="d-flex">-->
                        <!--                    <select class="select2 form-control wide me-2"-->
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

                <!--<div id="searchFile"></div>-->

            </div>
        </div>
    </div>
</div>


<!-- Modal Port Details -->
@include('admin-main.admin.commonModelForms.addNewPort_modal')

<!-- Modal package Details -->
@include('admin-main.admin.commonModelForms.addNewPackageModel')

<!-- Modal Party Details -->
@include('admin-main.admin.commonModelForms.modelPartyDetails')
<!-- Add new export Modal -->
@include('admin-main.admin.commonModelForms.addExportPartiesModel')
<!--add sales person-->
@include('admin-main.admin.commonModelForms.salesperson_modal')

@endsection
@push('scripts')
<script>
    $(document).ready(function() {
    
        $('.select2').select2({
            
            width: '100%'
        })
        
        
         $("#airExportEditForm").on("submit", function (e) {
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
    // file table
    document.getElementById('AirExportFileForm').addEventListener('submit', function(e) {
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

<script>
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

    // package details
    $('#addNewPackageModel').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: "{{ route('new-package.store') }}", // route name
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                // Add the new option to select dropdowns
                /* $('select[name="sales_person_id"]').each(function() {
                    $(this).append(`<option value="${response.id}" selected>${response.name}</option>`);
                }); */

                // Close modal and reset form
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

    // add party model
    let targetField = null;

    $('#partyDetailsModal').on('show.bs.modal', function (event) {
        const button = $(event.relatedTarget); 
        targetField = button.data('target-field');
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
    
    //sale person
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
</script>
@endpush