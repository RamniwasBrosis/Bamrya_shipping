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
                        <h4 class="card-title">Edit BL</h4>
                    </div>
                    <div class="card-body">
                        <form class="needs-validation" method="POST" action="{{route('air-exports.update', $air_export->id )}}">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <h4>General Details</h4>
                                    <hr>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Job No:<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="default-select form-control wide me-2"
                                                    placeholder="Select" name="job_no">
                                                    <option value="">select</option>
                                                    @foreach ($job_numbers as $job_number)
                                                        <option value="{{$job_number->id}}" {{$job_number->id == $air_export->job_no? 'selected' : ''}}>{{$job_number->job_no}}</option>
                                                    @endforeach
                                                </select>
                                                <button type="button" class="btn btn-sm btn-outline-primary"
                                                    data-bs-toggle="modal" data-bs-target="#partyDetailsModal">
                                                    <i class="bi bi-plus-lg">+</i>
                                                </button>
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
                                                <input type="date" class="form-control" value="{{$air_export->eta_date}}" name="eta_date">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Enquiry Reference No:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" value="{{$air_export->enquiry_reference_no}}" name="enquiry_reference_no">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">FullJobNo:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" value="{{$air_export->full_job_no}}" name="full_job_no">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">BookingDate:</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" value="{{$air_export->booking_date}}" name="booking_date">
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
                                                <input type="date" class="form-control" value="{{$air_export->etd_date}}" name="etd_date">
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
                                                <input type="date" class="form-control" value="{{$air_export->flight_date_1}}" name="flight_date_1">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">FlightNumber1:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" value="{{$air_export->flight_number_1}}" name="flight_number_1">
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
                                                    <option value="AIRPORTTOAIRPORT" {{$air_export->movement == 'AIRPORTTOAIRPORT'? 'selected' : ''}}>AIRPORTTOAIRPORT</option>
                                                    <option value="CY/CFS" {{$air_export->movement == 'CY/CFS'? 'selected' : ''}}>CY/CFS</option>
                                                    <option value="CFS/CY" {{$air_export->movement == 'CFS/CY'? 'selected' : ''}}>CFS/CY</option>
                                                    <option value="CFS/CFS" {{$air_export->movement == 'CFS/CFS'? 'selected' : ''}}>CFS/CFS</option>
                                                    <option value="CY/DOOR" {{$air_export->movement == 'CY/DOOR'? 'selected' : ''}}>CY/DOOR</option>
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
                                            <label class="col-sm-3 col-form-label" >Customer Acc No.:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" value="{{$air_export->customer_acc_no}}" name="customer_acc_no">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">SHIPPER ( Sales Person ):</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="default-select form-control wide me-2"
                                                    placeholder="Select" name="sales_person_id">
                                                    <option value="">select</option>
                                                    @foreach ($parties as $party)
                                                        <option value="{{$party->id}}" {{$air_export->sales_person_id == $party->id ? 'selected' : ''}}>{{$party->party_name}}</option>
                                                    @endforeach
                                                </select>
                                                <button type="button" class="btn btn-sm btn-outline-primary"
                                                    data-bs-toggle="modal" data-bs-target="#partyDetailsModal">
                                                    <i class="bi bi-plus-lg">+</i>
                                                </button>
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
                                                <input type="date" class="form-control" value="{{$air_export->flight_date_2}}" name="flight_date_2">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">FlightNumber2:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" value="{{$air_export->flight_number_2}}" name="flight_number_2">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Chargable_Wt:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" value="{{$air_export->chargable_weight}}" name="chargable_weight">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">IssuePlace:</label>
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
                                                <select name="package_id" class="form-control wide me-2">
                                                    <option value="">select</option>
                                                    @foreach ($packages as $package)
                                                        <option value="{{$package->id}}" {{$air_export->package_id == $package->id ? 'selected' : ''}}>{{$package->package_code}}</option>
                                                    @endforeach
                                                </select>
                                                <button type="button" class="btn btn-sm btn-outline-primary"
                                                    data-bs-toggle="modal" data-bs-target="#AddNewPackageModal">
                                                    <i class="bi bi-plus-lg">+</i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Issue Date:</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" value="{{$air_export->issue_date}}" name="issue_date">
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
                                                <select class="default-select form-control wide me-2"
                                                    placeholder="Select" name="shipper_id">
                                                    <option value="">select</option>
                                                    @foreach ($parties as $party)
                                                        <option value="{{$party->id}}" {{$air_export->shipper_id == $party->id ? 'selected' : ''}}>{{$party->party_name}}</option>
                                                    @endforeach
                                                </select>
                                                <button type="button" class="btn btn-sm btn-outline-primary"
                                                    data-bs-toggle="modal" data-bs-target="#partyDetailsModal">
                                                    <i class="bi bi-plus-lg">+</i>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Consignee:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="default-select form-control wide me-2"
                                                    placeholder="Select" name="consignee_id">
                                                    <option value="">select</option>
                                                    @foreach ($parties as $party)
                                                        <option value="{{$party->id}}" {{$air_export->consignee_id == $party->id ? 'selected' : ''}}>{{$party->party_name}}</option>
                                                    @endforeach
                                                </select>
                                                <button type="button" class="btn btn-sm btn-outline-primary"
                                                    data-bs-toggle="modal" data-bs-target="#partyDetailsModal">
                                                    <i class="bi bi-plus-lg">+</i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-xxl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Iata Agent:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="default-select form-control wide me-2"
                                                    placeholder="Select" name="lata_agent">
                                                    <option value="">select</option>
                                                    @foreach ($parties as $party)
                                                        <option value="{{$party->id}}" {{$air_export->lata_agent == $party->id ? 'selected' : ''}}>{{$party->party_name}}</option>
                                                    @endforeach
                                                </select>
                                                <button type="button" class="btn btn-sm btn-outline-primary"
                                                    data-bs-toggle="modal" data-bs-target="#partyDetailsModal">
                                                    <i class="bi bi-plus-lg">+</i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">OverSeas_Agent:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="default-select form-control wide me-2"
                                                    placeholder="Select" name="overSeas_agent">
                                                    <option value="">select</option>
                                                    @foreach ($parties as $party)
                                                        <option value="{{$party->id}}" {{$air_export->overSeas_agent == $party->id ? 'selected' : ''}}>{{$party->party_name}}</option>
                                                    @endforeach
                                                </select>
                                                <button type="button" class="btn btn-sm btn-outline-primary"
                                                    data-bs-toggle="modal" data-bs-target="#partyDetailsModal">
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
                                            <label class="col-sm-3 col-form-label">Loading Port:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="default-select form-control wide me-2"
                                                    placeholder="Select" name="loading_port_id">
                                                    <option value="">select</option>
                                                    @foreach ($ports as $port)
                                                        <option value="{{$port->id}}" {{$air_export->loading_port_id == $port->id ? 'selected' : ''}}>{{$port->port_name}}</option>
                                                    @endforeach
                                                </select>
                                                <button type="button" class="btn btn-sm btn-outline-primary"
                                                    data-bs-toggle="modal" data-bs-target="#portDetailsModal">
                                                    <i class="bi bi-plus-lg">+</i>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Discharge Port:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="default-select form-control wide me-2"
                                                    placeholder="Select" name="discharge_port_id">
                                                    <option value="">select</option>
                                                    @foreach ($ports as $port)
                                                        <option value="{{$port->id}}" {{$air_export->discharge_port_id == $port->id ? 'selected' : ''}}>{{$port->port_name}}</option>
                                                    @endforeach
                                                </select>
                                                <button type="button" class="btn btn-sm btn-outline-primary"
                                                    data-bs-toggle="modal" data-bs-target="#portDetailsModal">
                                                    <i class="bi bi-plus-lg">+</i>
                                                </button>
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
                                                <select class="default-select form-control wide me-2"
                                                    placeholder="Select" name="receipt_port_id">
                                                    <option value="">select</option>
                                                    @foreach ($ports as $port)
                                                        <option value="{{$port->id}}" {{$air_export->receipt_port_id == $port->id ? 'selected' : ''}}>{{$port->port_name}}</option>
                                                    @endforeach
                                                </select>
                                                <button type="button" class="btn btn-sm btn-outline-primary"
                                                    data-bs-toggle="modal" data-bs-target="#portDetailsModal">
                                                    <i class="bi bi-plus-lg">+</i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Delivery Port:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="default-select form-control wide me-2"
                                                    placeholder="Select" name="delivery_port_id">
                                                    <option value="">select</option>
                                                    @foreach ($ports as $port)
                                                        <option value="{{$port->id}}" {{$air_export->delivery_port_id == $port->id ? 'selected' : ''}}>{{$port->port_name}}</option>
                                                    @endforeach
                                                </select>
                                                <button type="button" class="btn btn-sm btn-outline-primary"
                                                    data-bs-toggle="modal" data-bs-target="#portDetailsModal">
                                                    <i class="bi bi-plus-lg">+</i>
                                                </button>
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
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Bill of Entry:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" value="{{$air_export->shipping_bill}}" name="shipping_bill">
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
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <a href="{{route('air-exports.index')}}" class="btn btn-warning" type="button">Cancle</a>
                                        <button class="btn btn-primary" type="submit">update</button>
                                    </div>
                                </div>
                            </form>
                        

                        <h4>File Upload</h4>
                        <hr>
                        <div class="form-validation">
                            <form class="needs-validation" action="{{route('multi-file-upload.updateFileUpload')}}" method="post" enctype="multipart/form-data">
                                @csrf 
                                <input type="hidden" name="file_related" value="air_export">
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
                            <form id="AirExportFileForm" method="post"> 
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

    <!-- Modal Party Details -->
    <div class="modal fade" id="AddNewPackageModal" tabindex="-1" aria-labelledby="oceanVslModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="oceanVslModalLabel">Add New Package</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="oceanVslForm">
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Package Code:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" >
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Description:</label>
                            <div class="col-sm-8">
                                <textarea class="form-control h-100" id="validationCustom04" rows="2"></textarea>
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
@endpush
