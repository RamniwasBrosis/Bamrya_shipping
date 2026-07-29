@extends('admin-main.layouts.default')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active"><a href="#">Export BL</a></li>
    </ol>
    <a href="{{ url('admin/sea-exports') }}" class="text-primary"><- Go Back</a>
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

<div class="container-fluid p-2">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Sea-Export BL</h4>
                </div><br>
                <div class="card-body">
                    <div class="form-validation">
                        <form method="POST" action="{{ route('sea-exports.update', $sea_export->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="row form-material">
                                <div class="mb-3 row col-xl-3 col-xxl-12 col-xl-6 row">
                                    <label class="col-sm-3 col-form-label">Entry By:</label>
                                    <div class="col-sm-9">
                                        <div class="d-flex gap-3">

                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" value="Packinglist" name="entry_by" {{$sea_export->entry_by == 'Packinglist'? 'checked' : ''}}>
                                                <label class="form-check-label" for="lcl">
                                                    Packinglist
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" value="nominated" id="fcl20" name="entry_by" {{$sea_export->entry_by == 'nominated'? 'checked' : ''}}>
                                                <label class="form-check-label" for="fcl20">
                                                    nominated
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
                                            <select class="select2 form-control wide me-2" name="job_no" required>
                                                <option value="">select</option>
                                                @foreach ($jobNumbers as $jobNumber)
                                                <option value="{{ $jobNumber->id }}"
                                                    {{ old('job_no', $sea_export->job_no ?? '') == $jobNumber->id ? 'selected' : '' }}>
                                                    {{ $jobNumber->job_no }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Booking No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{$sea_export->booking_no}}" name="booking_no">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Vessel Name:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <input type="text" name="vessel_name" name="" value="{{ $sea_export->vessel_name }}" class="form-control">
                                            <!--<select class="select2 form-control wide me-2" name="vessel_id">-->
                                            <!--    <option value="">select</option>-->
                                            <!--    @foreach ($vessels as $vessel)-->
                                            <!--    <option value="{{$vessel->id}}" {{$sea_export->vessel_id == $vessel->id? 'selected' : ''}}>{{$vessel->vessel_name}}</option>-->
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
                                            <input type="text" class="form-control" value="{{$sea_export->mbl_no}}" name="mbl_no">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Enquiry Reference No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{$sea_export->enquiry_ref_no}}" name="enquiry_ref_no">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Full Job No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{$sea_export->full_job_no}}" name="full_job_no">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Booking Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy" class="form-control" value="{{$sea_export->booking_date}}" name="booking_date">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Voyage No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{$sea_export->voyage_no}}" name="voyage_no">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">HBL No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{$sea_export->hbl_no}}" name="hbl_no">
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
                                        <label class="col-sm-3 col-form-label">Shipper:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="select2 form-control wide me-2" name="shipper_id" placeholder="Select">
                                                <option value="">Select</option>
                                                @foreach ($exportParites as $party)
                                                <option value="{{$party->id}}" {{$sea_export->shipper_id == $party->id ? "selected" : ''}}>{{$party->party_name}}</option>
                                                @endforeach
                                            </select>
                                            <!--<button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exportPartyDetails">-->
                                            <!--    <i class="bi bi-plus-lg">+</i>-->
                                            <!--</button>-->
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Consignee:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="select2 form-control wide me-2" name="consignee_id" placeholder="Select">
                                                <option value="">Select</option>
                                                @foreach ($parties->whereIn('party_type', [1, 6]) as $party)
                                                <option value="{{$party->id}}" {{$sea_export->consignee_id == $party->id ? "selected" : ''}}>{{$party->party_name}}</option>
                                                @endforeach
                                            </select>
                                            <!--<button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#partyDetailsModal" data-target-field="consignee_id">-->
                                            <!--    <i class="bi bi-plus-lg">+</i>-->
                                            <!--</button>-->
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
                                                <option value="{{$party->id}}" {{$sea_export->notify_id == $party->id ? "selected" : ''}}>{{$party->party_name}}</option>
                                                @endforeach
                                            </select>
                                            <!--<button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#partyDetailsModal" data-target-field="notify_id">-->
                                            <!--    <i class="bi bi-plus-lg">+</i>-->
                                            <!--</button>-->
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Notify 2:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="select2 form-control wide me-2" name="notify2_id" placeholder="Select">
                                                <option value="">Select</option>
                                                @foreach ($parties->whereIn('party_type', [1, 6]) as $party)
                                                <option value="{{$party->id}}" {{$sea_export->notify2_id == $party->id ? "selected" : ''}}>{{$party->party_name}}</option>
                                                @endforeach
                                            </select>
                                            <!--<button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#partyDetailsModal" data-target-field="notify2_id">-->
                                            <!--    <i class="bi bi-plus-lg">+</i>-->
                                            <!--</button>-->
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
                                            <select class="select2 form-control wide me-2" name="loading_port_id" placeholder="Select">
                                                <option value="">Select</option>
                                                @foreach ($ports as $port)
                                                <option value="{{$port->id}}" {{$sea_export->loading_port_id == $port->id ? "selected" : ''}}>{{$port->port_name}}</option>
                                                @endforeach
                                            </select>
                                            <!--<button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addNewPortDetails">-->
                                            <!--    <i class="bi bi-plus-lg">+</i>-->
                                            <!--</button>-->
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Discharge Port:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="select2 form-control wide me-2" name="discharge_port_id" placeholder="Select">
                                                <option value="">Select</option>
                                                @foreach ($ports as $port)
                                                <option value="{{$port->id}}" {{$sea_export->discharge_port_id == $port->id ? "selected" : ''}}>{{$port->port_name}}</option>
                                                @endforeach
                                            </select>
                                            <!--<button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addNewPortDetails">-->
                                            <!--    <i class="bi bi-plus-lg">+</i>-->
                                            <!--</button>-->
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Place of Destination:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select name="destination_port_id" class="select2 form-control wide me-2">
                                                <option value="">Select Destination</option>
                                                @foreach ($ports as $port)
                                                <option value="{{$port->id}}" {{ $port->id == $sea_export?->destination_port_id ? 'selected' : ''}}>{{$port->port_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Insurance:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <input type="text" class="form-control" value="{{$sea_export->insurance}}" name="insurance">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">F. Premium Amt:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{$sea_export->fpa_amount}}" name="fpa_amount">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Transportation:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{$sea_export->transportation}}" name="transportation">
                                        </div>
                                    </div>

                                </div>

                                <div class="col-xl-6 col-xxl-6">

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Receipt Port:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="select2 form-control wide me-2" name="receipt_port_id" placeholder="Select">
                                                <option value="">Select</option>
                                                @foreach ($ports as $port)
                                                <option value="{{$port->id}}" {{$sea_export->receipt_port_id == $port->id ? "selected" : ''}}>{{$port->port_name}}</option>
                                                @endforeach
                                            </select>
                                            <!--<button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addNewPortDetails">-->
                                            <!--    <i class="bi bi-plus-lg">+</i>-->
                                            <!--</button>-->
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Delivery Port:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="select2 form-control wide me-2" name="delivery_port_id" placeholder="Select">
                                                <option value="">Select</option>
                                                @foreach ($ports as $port)
                                                <option value="{{$port->id}}" {{$sea_export->delivery_port_id == $port->id ? "selected" : ''}}>{{$port->port_name}}</option>
                                                @endforeach
                                            </select>
                                            <!--<button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addNewPortDetails">-->
                                            <!--    <i class="bi bi-plus-lg">+</i>-->
                                            <!--</button>-->
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Transportation Details:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{$sea_export->transportation_details}}" name="transportation_details">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Clearance:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{$sea_export->clearance}}" name="clearance">
                                        </div>
                                    </div>

                                    <!--<div class="mb-3 row">-->
                                    <!--    <label class="col-sm-3 col-form-label">Shipping Bill:</label>-->
                                    <!--    <div class="col-sm-9">-->
                                    <!--        <input type="text" class="form-control" value="{{$sea_export->shipping_bill}}" name="shipping_bill">-->
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
                                        <label class="col-sm-3 col-form-label">Quantity:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{$sea_export->quantity}}" name="quantity">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Freight:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="form-control wide me-2" name="freight">
                                                <option value="">select</option>
                                                <option value="Prepaid" {{$sea_export->freight == 'Prepaid' ? 'selected' : ''}}>Prepaid</option>
                                                <option value="Collect" {{$sea_export->freight == 'Collect' ? 'selected' : ''}}>Collect</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Gross Wt:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{$sea_export->gross_weight}}" name="gross_weight">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Tare Wt:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{$sea_export->tare_weight}}" name="tare_weight">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Movement:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="form-control wide" name="movement">
                                                <option value="">Select Movement</option>
                                                <option value="CY/CY" {{$sea_export->movement == 'CY/CY'? 'selected' : ''}}>CY/CY</option>
                                                <option value="CY/CFS" {{$sea_export->movement == 'CY/CFS'? 'selected' : ''}}>CY/CFS</option>
                                                <option value="CFS/CY" {{$sea_export->movement == 'CFS/CY'? 'selected' : ''}}>CFS/CY</option>
                                                <option value="CFS/CFS" {{$sea_export->movement == 'CFS/CFS'? 'selected' : ''}}>CFS/CFS</option>
                                                <option value="CY/DOOR" {{$sea_export->movement == 'CY/DOOR'? 'selected' : ''}}>CY/DOOR</option>
                                                <option value="DOOR/DOOR" {{$sea_export->movement == 'DOOR/DOOR'? 'selected' : ''}}>DOOR/DOOR</option>
                                                <option value="PORT/DOOR" {{$sea_export->movement == 'PORT/DOOR'? 'selected' : ''}}>PORT/DOOR</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">ETA Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy" class="form-control" value="{{$sea_export->eta_date}}" name="eta_date">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">CBM:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{$sea_export->cbm}}" name="cbm">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">PORT CUTOFF:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy" class="form-control" value="{{$sea_export->port_cutoff}}" name="port_cutoff">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">DOCUMENT CUTOFF:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy" class="form-control" value="{{$sea_export->document_cutoff}}" name="document_cutoff">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">REMARKS:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{$sea_export->remarks}}" name="remarks" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Package:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select name="package_id" class="select2 form-control wide me-2">
                                                <option value="">Select Package</option>
                                                @foreach ($packages as $package)
                                                <option value="{{$package->id}}" {{$sea_export->package_id == $package->id ? 'selected' : ''}}>{{$package->package_code}}</option>
                                                @endforeach
                                            </select>
                                            <!--<button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#AddNewPackageModal">-->
                                            <!--    <i class="bi bi-plus-lg">+</i>-->
                                            <!--</button>-->
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Frt Charges:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{$sea_export->freight_charges}}" name="freight_charges">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Net Wt:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{$sea_export->net_weight}}" name="net_weight">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Volume:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="form-control wide me-2" name="volume_unit">
                                                <option value="">select</option>
                                                <option value="KGS" {{$sea_export->volume_unit == 'KGS'? 'selected' : ''}}>KGS</option>
                                                <option value="MTS" {{$sea_export->volume_unit == 'MTS'? 'selected' : ''}}>MTS</option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Cargo Type:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class=" form-control wide me-2" name="cargo_type" required>
                                                <option value="">Select Cargo Type</option>
                                                <option value="FCL/FCL" {{$sea_export->cargo_type == 'FCL/FCL'? 'selected' : ''}}>FCL/FCL</option>
                                                <option value="FCL/LCL" {{$sea_export->cargo_type == 'FCL/LCL'? 'selected' : ''}}>FCL/LCL</option>
                                                <option value="LCL/FCL" {{$sea_export->cargo_type == 'LCL/FCL'? 'selected' : ''}}>LCL/FCL</option>
                                                <option value="LCL/LCL" {{$sea_export->cargo_type == 'LCL/LCL'? 'selected' : ''}}>LCL/LCL</option>
                                                <option value="PART OF FCL" {{$sea_export->cargo_type == 'PART OF FCL'? 'selected' : ''}}>PART OF FCL</option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">ETD Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy" class="form-control" value="{{$sea_export->etd_date}}" name="etd_date">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">SI CUTOFF:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy" class="form-control" value="{{$sea_export->si_cutoff}}" name="si_cutoff">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">VGM CUTOFF:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy" class="form-control" value="{{$sea_export->vgm_cutoff}}" name="vgm_cutoff">
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
                                            <select class="select2 form-control wide me-2" name="agent_id" placeholder="Select">
                                                <option value="">Select</option>
                                                @foreach ($parties->where('party_type', 4) as $party)
                                                <option value="{{$party->id}}" {{$sea_export->agent_id == $party->id ? "selected" : ''}}>{{$party->party_name}}</option>
                                                @endforeach
                                            </select>
                                            <!--<button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#partyDetailsModal" data-target-field="overseas_agent_id">-->
                                            <!--    <i class="bi bi-plus-lg">+</i>-->
                                            <!--</button>-->
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Delivery Agent Name:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="select2 form-control wide me-2" name="delivery_agent_id" placeholder="Select">
                                                <option value="">Select</option>
                                                @foreach ($parties->where('party_type', 22) as $party)
                                                <option value="{{$party->id}}" {{$sea_export->delivery_agent_id == $party->id ? "selected" : ''}}>{{$party->party_name}}</option>
                                                @endforeach
                                            </select>
                                            <!--<button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#partyDetailsModal" data-target-field="overseas_agent_id">-->
                                            <!--    <i class="bi bi-plus-lg">+</i>-->
                                            <!--</button>-->
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Issue Place:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{$sea_export->issue_place}}" name="issue_place">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Place Of Acceptance:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{$sea_export->place_of_acceptance}}" name="place_of_acceptance">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Stuffing Point:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{$sea_export->stuffing_point}}" name="stuffing_point">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Stuffing Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control" value="{{$sea_export->stuffingDate}}" name="stuffingDate">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Shipping line:</label>
                                        <div class="col-sm-9">
                                            <select class="select2 form-control wide me-2" name="shipping_line_id" placeholder="Select"> 
                                                <option value="">select</option>
                                                @foreach ($shipping_lines as $shipping_line) 
                                                <option value="{{$shipping_line->id}}" {{$sea_export->shipping_line_id == $shipping_line->id ? "selected" : ''}}>{{$shipping_line->shipping_line_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">BL Issued Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy" class="form-control" value="{{$sea_export->bl_issued_date}}" name="bl_issued_date">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">BL Type:</label>
                                        <div class="col-sm-9">
                                            <select class="form-control wide me-2" name="bl_type" placeholder="Select">
                                                <option value="">select</option>
                                                @foreach ($master_bl_types as $master_bl_type)
                                                    <option value="{{$master_bl_type->id}}" {{ $sea_export->bl_type == $master_bl_type->id ? 'selected' : '' }}>
                                                        {{$master_bl_type->bl_description}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">No Of Origin:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{$sea_export->no_of_origin}}" name="no_of_origin">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Sales Person:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="select2 form-control wide me-2" name="sales_person_id" placeholder="Select">
                                                <option value="">Select Sales Person</option>
                                                @foreach ($salePersons as $salePerson)
                                                <option value="{{$salePerson->id}}" {{ $salePerson->id == $sea_export->sales_person_id ? 'selected' : ''}}>{{$salePerson->name}}</option>
                                                @endforeach
                                            </select>
                                            <!--<button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#salespersonModal">-->
                                            <!--    <i class="bi bi-plus-lg">+</i>-->
                                            <!--</button>-->
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">CHA:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="select2 form-control wide me-2" name="cha_id" placeholder="Select">
                                                <option value="">Select CHA</option>
                                                @foreach ($parties->where('party_type', 3) as $party)
                                                <option value="{{$party->id}}" {{$sea_export->cha_id == $party->id ? "selected" : ''}}>{{$party->party_name}}</option>
                                                @endforeach
                                            </select>
                                            <!--<button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#partyDetailsModal" data-target-field="cha_id">-->
                                            <!--    <i class="bi bi-plus-lg">+</i>-->
                                            <!--</button>-->
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
                                                <option value="{{$party->id}}" {{$sea_export->forwarder_id == $party->id ? "selected" : ''}}>{{$party->party_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">VGM Issued Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy" class="form-control" value="{{$sea_export->vgm_issued_date}}" name="vgm_issued_date">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Goods Description:</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control h-100" name="goods_description" rows="3">{{$sea_export->goods_description}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('bl.loadingConfirmation-seaExp', $sea_export->id ) }}" class="btn btn-primary btn-sm" type="button">LOADING CONFIRMATION</a>
                                <a href="{{ route('bl.draft.option',$sea_export->id ) }}" class="btn btn-primary btn-sm" type="button">BL PRINT</a>
                                <a href="{{route('sea-exports.index')}}" class="btn btn-warning btn-sm" type="button">Cancel</a>
                                <button class="btn btn-primary btn-sm" type="submit">Update</button>
                            </div>
                        </form>
                    </div>

                    {{-- Containser Details --}}
                    <hr>
                    <div class="form-validation">
                        <form action="{{ route('sea-exports.updateContainer', $sea_export->id ?? '') }}" method="POST" class="needs-validation" id="needs-validation">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="sea_export_cont_id" id="sea_export_cont">
                            <div class="row">

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Cont_Hbl:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="cont_hbl" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Gross Weight:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="gross_weight" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Total Package:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="total_package" class="form-control" >
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Ground Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy" name="ground_date" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Temp:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="temp" class="form-control" >
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Remarks:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="remarks" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Cont_Job No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="cont_job_no" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Container_No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="container_no" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">CBM:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="cbm" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Cargo Type:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="cargo_type" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">VGM WT:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="vgm_wt" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">SOC(Y/N):</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="soc" class="form-control">
                                        </div>
                                    </div>
                                </div>
                             
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Size:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select name="size" class="form-control select2 wide me-2">
                                                <option value="">Select Size</option>
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
                                                <option value="40" >40</option>
                                                <option value="45" >45</option>
                                            </select>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Refer(Y/N):</label>
                                        <div class="col-sm-9">
                                            <select name="refer" class="form-control wide me-2">
                                                <option value="">Select</option>
                                                <option value="Y" >Y</option>
                                                <option value="N">N</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Agent Seal No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="agent_seal_no" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Imo Code:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="imo_code" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Disposal:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="disposal" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Sector:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="sector" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Cust_Seal No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="cust_seal_no" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">FCL/LCL:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select name="fcl_lcl" class="form-control wide me-2">
                                                <option value="">Select</option>
                                                <option value="FCL">FCL</option>
                                                <option value="LCL">LCL</option>
                                                <option value="ETY">ETY</option>
                                                <option value="AIR">AIR</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Net Weight:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="net_weight" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Uno No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="uno_no" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Detent Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy" name="detent_date" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Prev_Days:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="prev_days" class="form-control">
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
                                        <label class="col-sm-3 col-form-label">Mark & Numbers:</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control h-100" name="mark_number" rows="2"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Goods Description:</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control h-100" name="goods_description" rows="2"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Inv No / Inv Dt:</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control h-100" name="customer_inv_no" rows="2"></textarea>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Check List Date:</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control h-100" name="check_list_date" rows="2"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Sbill No / Sbill Date:</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control h-100" name="sbill_no" rows="2"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Cartining Date:</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control h-100" name="cartining_date" rows="2"></textarea>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">LEO Date:</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control h-100" name="leo_date" rows="2"></textarea>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">SOB Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy" class="form-control" name="sob_date">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Commodity:</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control h-100" name="commodity" rows="2"></textarea>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button class="btn btn-primary btn-sm" type="submit">Add/Update CONTAINER</button>
                            </div>
                        </form>
                    </div>
                    <div id="formErrorBox" class="alert alert-danger d-none"></div>
                    <div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">Container no</th>
                                  <th scope="col">Agent Seal no.</th>
                                  <th scope="col">Cust Seal no.</th>
                                  <th scope="col">Size.</th>
                                  <th scope="col">Total Package</th>
                                  <th scope="col">FCL/LCL</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sea_export_containers as $sea_export_container)
                                    <tr>
                                      <th scope="row">{{ $loop->iteration }}</th>
                                      <td>{{ $sea_export_container?->container_no }}</td>
                                      <td>{{ $sea_export_container?->agent_seal_no }}</td>
                                      <td>{{ $sea_export_container?->cust_seal_no }}</td>
                                      <td>{{ $sea_export_container?->size }}</td>
                                      <td>{{ $sea_export_container?->total_package }}</td>
                                      <td>{{ $sea_export_container?->fcl_lcl }}</td>
                                      
                                      <td><a class="btn btn-sm btn-primary editChargeBtn" data-id="{{ $sea_export_container->id }}">Edit</a></td>
                                      <td><a class="btn btn-sm btn-danger deleteChargeBtn" data-id="{{ $sea_export_container->id }}">DELETE</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- shipment line  --}}
                    <form id="shipmentLineForm" action="{{ route('sea-exports.updateShipmentLine',$sea_export->id ?? '') }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="shipment_sea_export_id" name="sea_export_id" value="{{ $sea_export->id }}">
                        <input type="hidden" id="shipment_line_id" name="shipment_line_id">

                        <div class="row">
                            <h4>Shipment Details</h4>
                            <hr>

                            <!-- Container -->
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Container:<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <select name="sea_export_cont_id" id="shipment_sea_export_cont_id" class="form-control select2 wide me-2" required>
                                            <option value="">Select Container</option>
                                            @foreach ($sea_export_containers as $sea_export_container)
                                                <option value="{{ $sea_export_container->id }}" {{ old('consignee_id') == $sea_export_container->id ? 'selected' : '' }}>
                                                    {{ $sea_export_container->container_no }}
                                                </option>
                                            @endforeach
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
                                        <input type="text" name="invoice_no" class="form-control" id="shipment_invoice_no"
                                            value="{{ old('invoice_no') }}">
                                    </div>
                                </div>
                            </div>

                            <!-- Invoice Date -->
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Invoice Date:</label>
                                    <div class="col-sm-9">
                                        <input type="date" name="invoice_date" id="shipment_invoice_date" class="form-control"
                                            value="{{ old('invoice_date') }}">
                                    </div>
                                </div>
                            </div>

                            <!-- Shipping Bill No -->
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Shipping Bill No:</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="shipping_bill_no" class="form-control" id="shipment_shipping_bill_no"
                                            value="{{ old('shipping_bill_no') }}">
                                    </div>
                                </div>
                            </div>

                            <!-- Shipping Bill Date -->
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Shipping Bill Date:</label>
                                    <div class="col-sm-9">
                                        <input type="date" name="shipping_bill_date" class="form-control" id="shipment_shipping_bill_date"
                                            value="{{ old('shipping_bill_date') }}">
                                    </div>
                                </div>
                            </div>

                            <!-- LEO Date -->
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">LEO Date:</label>
                                    <div class="col-sm-9">
                                        <input type="date" name="leo_date" class="form-control" id="shipment_leo_date"
                                            value="{{ old('leo_date') }}">
                                    </div>
                                </div>
                            </div>

                            <!-- Carting Date -->
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Carting Date:</label>
                                    <div class="col-sm-9">
                                        <input type="date" name="carting_date" class="form-control" id="shipment_carting_date"
                                            value="{{ old('carting_date') }}">
                                    </div>
                                </div>
                            </div>

                            <!-- Check List Date -->
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Check List Date:</label>
                                    <div class="col-sm-9">
                                        <input type="date" name="check_list_date" class="form-control" id="shipment_check_list_date"
                                            value="{{ old('check_list_date') }}">
                                    </div>
                                </div>
                            </div>

                            <!-- Packages -->
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Packages:</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="packages" class="form-control" id="shipment_packages"
                                            value="{{ old('packages') }}">
                                    </div>
                                </div>
                            </div>

                            <!-- Gross Weight -->
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Gross Weight:</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="gross_weight" class="form-control" id="shipment_gross_weight"
                                            value="{{ old('gross_weight') }}">
                                    </div>
                                </div>
                            </div>

                            <!-- CBM -->
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">CBM:</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="cbm" class="form-control" id="shipment_cbm"
                                            value="{{ old('cbm') }}">
                                    </div>
                                </div>
                            </div>

                            <!-- Goods Description -->
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Goods Description:</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control h-100" id="shipment_goods_description" name="goods_description" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Mark & Number -->
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Mark & Number:</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control h-100" name="mark_number" id="shipment_mark_number" rows="3">{{ old('mark_number') }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Remarks -->
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Remarks:</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control h-100" name="remarks" id="shipment_remarks" rows="3">{{ old('remarks') }}</textarea>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button class="btn btn-warning" type="submit">
                                Add/Update
                            </button>
                        </div>
                    </form>
                    <div id="shipmentLineList"></div>
                    <div>
                        <h3>Shipment List</h3>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">Container no</th>
                                  <th scope="col">Invoice No</th>
                                  <th scope="col">Shipping Bill No</th>
                                  <th scope="col">Packages</th>
                                  <th scope="col">Gross Weight</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sea_export_shipment_line as $sea_export_shipment)
                                    <tr>
                                      <th scope="row">{{ $loop->iteration }}</th>
                                      <td>{{ $sea_export_shipment->container->container_no }}</td>
                                      <td>{{ $sea_export_shipment->invoice_no }}</td>
                                      <td>{{ $sea_export_shipment->shipping_bill_no }}</td>
                                      <td>{{ $sea_export_shipment->packages }}</td>
                                      <td>{{ $sea_export_shipment->gross_weight }}</td>

                                      <td><a class="btn btn-sm btn-primary editShipmentBtn" data-id="{{ $sea_export_shipment->id }}">Edit</a>
                                      <a class="btn btn-sm btn-danger deleteShipmentBtn" data-id="{{ $sea_export_shipment->id }}">DELETE</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <h4>File Upload</h4>
                    <hr>
                    <div class="form-validation">
                        <form class="needs-validation" action="{{route('multi-file-upload.updateFileUpload')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="file_related" value="sea_export">
                            <input type="hidden" name="job_no" id="job_no_hidden" value="{{ $sea_export->job_no }}">
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
                        <!--<form id="AirExportFileForm" method="post" data-job-no="{{ $sea_export->id }}" data-file-related="sea_export">-->
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

                <div id="searchFile"></div>
            </div>
        </div>
    </div>
</div>


<!-- Add New Vessel Models -->
@include('admin-main.admin.commonModelForms.addOceanVslModel')

<!-- Add New Port Details -->
@include('admin-main.admin.commonModelForms.addNewPort_modal')

<!-- Add new Package Modal -->
@include('admin-main.admin.commonModelForms.addNewPackageModel')

<!-- Modal Party Details -->
@include('admin-main.admin.commonModelForms.modelPartyDetails')
<!-- Add new export Modal -->
@include('admin-main.admin.commonModelForms.addExportPartiesModel')

@endsection
@push('scripts')
<script>
    $(document).ready(function(){
        $('#needs-validation').on('submit', function(e) {
            e.preventDefault();
        
            let form = $(this);
            let formData = form.serialize();
        
            $('#formErrorBox').addClass('d-none').html(""); // reset error box
        
            $.ajax({
                url: form.attr('action'),
                type: "POST",
                data: formData,
                success: function(response) {
                    // If success → redirect manually
                    window.location.reload();
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        let errorHtml = "<ul>";
        
                        $.each(errors, function(key, value) {
                            errorHtml += "<li>" + value[0] + "</li>";
                        });
        
                        errorHtml += "</ul>";
        
                        $('#formErrorBox')
                            .removeClass('d-none')
                            .html(errorHtml);
                    }
                }
            });
        });

    })
</script>
<script>
    $(document).ready(function() {
        
        $(document).on('click', '.editChargeBtn', function() {
            const chargeId = $(this).data('id');
            let url = "{{ url('sea-exports/getContainerDetail', ['id' => '__id__']) }}";
            url = url.replace('__id__', chargeId);
            // Fetch charge detail using AJAX
            $.ajax({
                url: url,
                method: "GET",
                success: function(response) {
                    // Fill form fields
                    $('#sea_export_cont').val(response.id);
                 
                    $('input[name="cont_hbl"]').val(response.cont_hbl);
                    $('input[name="gross_weight"]').val(response.gross_weight);
                    $('input[name="total_package"]').val(response.total_package);
                    
                    // $('input[name="ground_date"]').val(response.ground_date ? response.ground_date.substring(0, 10) : '');
                    $('input[name="temp"]').val(response.temp);
                    $('input[name="remarks"]').val(response.remarks);
                    $('input[name="cont_job_no"]').val(response.cont_job_no );
                    $('input[name="container_no"]').val(response.container_no );
                    $('input[name="cbm"]').val(response.cbm);
                    $('input[name="cargo_type"]').val(response.cargo_type);
                    $('input[name="vgm_wt"]').val(response.vgm_wt);
                    $('input[name="soc"]').val(response.soc);
                    $('input[name="commodity"]').val(response.commodity);
                    
                    $('select[name="size"]').val(response.size).trigger('change');
                    $('select[name="refer"]').val(response.refer);
                    
                    $('input[name="cust_seal_no"]').val(response.cust_seal_no);
                    $('input[name="sector"]').val(response.sector);
                    $('input[name="disposal"]').val(response.disposal);
                    $('input[name="imo_code"]').val(response.imo_code);
                    $('input[name="agent_seal_no"]').val(response.agent_seal_no);
                    
                    $('select[name="fcl_lcl"]').val(response.fcl_lcl);
                    
                    $('input[name="prev_days"]').val(response.prev_days);
                    $('input[name="detent_date"]').val(response.detent_date);
                    $('input[name="uno_no"]').val(response.uno_no);
                    $('input[name="net_weight"]').val(response.net_weight);
                
                    $('textarea[name="mark_number"]').val(response.mark_number);
                    $('textarea[name="goods_description"]').val(response.goods_description);
                    $('textarea[name="customer_inv_no"]').val(response.customer_inv_no);
                    $('textarea[name="sbill_no"]').val(response.sbill_no);
                    $('textarea[name="commodity"]').val(response.commodity);
                    
                    $('textarea[name="leo_date"]').val(response.leo_date);
                    $('textarea[name="cartining_date"]').val(response.cartining_date);
                    $('textarea[name="check_list_date"]').val(response.check_list_date);
                    
                    document.querySelector('input[name="ground_date"]')._flatpickr.setDate(response.ground_date);
                    document.querySelector('input[name="detent_date"]')._flatpickr.setDate(response.detent_date);
                    document.querySelector('input[name="sob_date"]')._flatpickr.setDate(response.sob_date);
                    
                    // Scroll smoothly to the form
                    // $('html, body').animate({
                    //     scrollTop: $(".form-validation").offset().top - 100
                    // }, 500);
                },
                error: function(xhr) {
                    alert('Error fetching charge details.');
                }
            });
        });
        
        $(document).on('click', '.deleteChargeBtn', function(e) {
            e.preventDefault();
            if(!confirm('Are you sure to delete this container?')) return;
    
            let containerId = $(this).data('id');
            let btn = $(this);
    
            $.ajax({
                url: '/sea-exports/delete-container/' + containerId,
                type: 'DELETE',
                data: {_token: '{{ csrf_token() }}'},
                success: function(res) {
                    btn.closest('tr').remove();
                },
                error: function() {
                    alert('Failed to delete container');
                }
            });
        });
        
        flatpickr("input[type='date']", {
            altInput: true,
            altFormat: "d/m/Y",   // what user sees
            dateFormat: "Y-m-d",  // what is submitted
            allowInput: true
        });
        $('.select2').select2({
            width: '100%'
        })
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

    // ocean vassel model
    $('#oceanVslForm').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: "{{ route('new-vessels.store') }}", // route name
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                // Add the new option to select dropdowns
                 $('select[name="vessel_id"]').each(function() {
                    $(this).append(`<option value="${response.id}" selected>${response.vessel_name}</option>`);
                });

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

    // add new package
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
</script>
{{-- shipment details edit/udate  --}}
<script>
    $(document).ready(function() {

        $(document).on('click', '.editShipmentBtn', function() {
            const chargeId = $(this).data('id');
            let url = "{{ url('sea-exports/getShipmentDetail', ['id' => '__id__']) }}";
            url = url.replace('__id__', chargeId);
            // Fetch charge detail using AJAX
            $.ajax({
                url: url,
                method: "GET",
                success: function(response) {
                    console.log(response);
                    // Fill form fields
                    $('#shipment_line_id').val(response.id);
                    $('#shipment_sea_export_id').val(response.sea_export_id);
                    $('#shipment_sea_export_cont_id').val(response.sea_export_cont_id).trigger('change');
                    $('#consignee_select').val(response.consignee_id).trigger('change');
                    $('#shipment_invoice_no').val(response.invoice_no);
                    $('#shipment_shipping_bill_no').val(response.shipping_bill_no);
                    $('#shipment_packages').val(response.packages);
                    $('#shipment_gross_weight').val(response.gross_weight);
                    $('#shipment_cbm').val(response.cbm);
                    $('#shipment_goods_description').val(response.goods_description);
                    $('#shipment_mark_number').val(response.mark_number);
                    $('#shipment_remarks').val(response.remarks);

                    document.querySelector('#shipment_invoice_date')._flatpickr.setDate(response.invoice_date);
                    document.querySelector('#shipment_shipping_bill_date')._flatpickr.setDate(response.shipping_bill_date);
                    document.querySelector('#shipment_leo_date')._flatpickr.setDate(response.leo_date);
                    document.querySelector('#shipment_carting_date')._flatpickr.setDate(response.carting_date);
                    document.querySelector('#shipment_check_list_date')._flatpickr.setDate(response.check_list_date);

                    // Scroll smoothly to the form
                    // $('html, body').animate({
                    //     scrollTop: $(".form-validation").offset().top - 100
                    // }, 500);
                },
                error: function(xhr) {
                    alert('Error fetching shipment details.');
                }
            });
        });

        $(document).on('click', '.deleteShipmentBtn', function(e) {
            e.preventDefault();
            if(!confirm('Are you sure to delete this shipment line?')) return;

            let shipmentId = $(this).data('id');
            let btn = $(this);

            $.ajax({
                url: '/sea-exports/delete-shipment/' + shipmentId,
                type: 'DELETE',
                data: {_token: '{{ csrf_token() }}'},
                success: function(res) {
                    btn.closest('tr').remove();
                },
                error: function() {
                    alert('Failed to delete shipment');
                }
            });
        });

        flatpickr("input[type='date']", {
            altInput: true,
            altFormat: "d/m/Y",   // what user sees
            dateFormat: "Y-m-d",  // what is submitted
            allowInput: true
        });
        $('.select2').select2({
            width: '100%'
        })
    })
</script>

@endpush