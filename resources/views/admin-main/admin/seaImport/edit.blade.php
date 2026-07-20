@extends('admin-main.layouts.default')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active"><a href="#">Edit Sea Import BL</a></li>
    </ol>
    <a href="{{ url('admin/sea-imports') }}" class="text-primary"><- Go Back</a>
</div>

@if (session('success'))
<div class="alert alert-success">
    {{session('success')}}
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
                    <h4 class="card-title">Edit BL</h4>
                </div><br>
                <div class="card-body">
                    <form action="{{ route('sea-imports.update', $sea_import->id) }}" method="POST" class="needs-validation">
                        @csrf
                        @method('PUT')
                        <div class="row form-material">
                            <div class="mb-3 row col-xl-3 col-xxl-12 col-xl-6 row">
                                <label class="col-sm-3 col-form-label">BL Issued By:<span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <div class="d-flex gap-3">

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="lcl" value="1" name="bl_issue_by" {{$sea_import->bl_issue_by == '1' ? 'checked' : ''}}>
                                            <label class="form-check-label" for="lcl">
                                                Forwarder
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="2" id="fcl20" name="bl_issue_by" {{$sea_import->bl_issue_by == '2' ? 'checked' : ''}}>
                                            <label class="form-check-label" for="fcl20">
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
                                            <select name="job_no" class="select2 form-control wide me-2">
                                                <option value="">select</option>
                                                @foreach ($jobNumbers as $jobNumber)
                                                <option value="{{$jobNumber->id}}" {{$sea_import->job_no == $jobNumber->id ? 'selected' : ''}}>{{$jobNumber->job_no}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">MBL No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="mbl_no" class="form-control" value="{{$sea_import->mbl_no ?? ''}}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">HBL No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="hbl_no" class="form-control" value="{{$sea_import->hbl_no ?? ''}}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">IGM No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="igm_no" class="form-control" value="{{$sea_import->igm_no ?? ''}}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Item No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="item_no" class="form-control" value="{{$sea_import->item_no ?? ''}}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Vessel Name:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="vessel_name" name="" value="{{ $sea_import->vessel_name ?? '' }}" class="form-control">
                                            <!--<select name="vessel_id" class="select2 form-control wide me-2">-->
                                            <!--    <option value="">select</option>-->
                                            <!--    @foreach ($vessels as $vessel)-->
                                            <!--    <option value="{{$vessel->id}}" {{$sea_import->vessel_id == $vessel->id ? 'selected' : ''}}>{{$vessel->vessel_name}}</option>-->
                                            <!--    @endforeach-->
                                            <!--</select>-->
                                            <!--<button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#oceanVslModal">-->
                                            <!--    <i class="bi bi-plus-lg">+</i>-->
                                            <!--</button>-->
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Enquiry Reference No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="enquiry_reference_no" class="form-control" value="{{$sea_import->enquiry_reference_no ?? ''}}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">ETA Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy" name="eta_date" class="form-control" value="{{$sea_import->eta_date ?? ''}}">
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Booking No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="booking_no" value="{{ $sea_import->booking_no ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Reg No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="reg_no" value="{{ $sea_import->reg_no }}" class="form-control">
                                        </div>
                                    </div>
                                    <!--<div class="mb-3 row">-->
                                    <!--    <label class="col-sm-3 col-form-label">Agent Seal No:</label>-->
                                    <!--    <div class="col-sm-9">-->
                                    <!--        <input type="text" name="agentSealNo" class="form-control" value="{{$sea_import->agentSealNo ?? ''}}">-->
                                    <!--    </div>-->
                                    <!--</div>-->

                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Cargo(Cust):</label>
                                        <div class="col-sm-9">
                                            <select name="cargo_type" class="default-select form-control wide me-2">
                                                <option value="">select</option>
                                                <option value="FCL" {{$sea_import?->cargo_type == 'FCL' ? 'selected' : ''}}>FCL</option>
                                                <option value="LCL" {{$sea_import?->cargo_type == 'LCL' ? 'selected' : ''}}>LCL</option>
                                                <option value="ETY" {{$sea_import?->cargo_type == 'ETY' ? 'selected' : ''}}>ETY</option>
                                                <option value="AIR" {{$sea_import?->cargo_type == 'AIR' ? 'selected' : ''}}>AIR</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">MBL Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy" name="mbl_date" class="form-control" value="{{$sea_import->mbl_date ?? ''}}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">HBL Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy" name="hbl_date" class="form-control" value="{{$sea_import->hbl_date ?? ''}}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">IGM Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy" name="igm_date" class="form-control" value="{{$sea_import->igm_date ?? ''}}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Sub Item No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="sub_item_no" class="form-control" value="{{$sea_import->sub_item_no ?? ''}}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Voy. No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="voyage_no" class="form-control" value="{{$sea_import->voyage_no ?? ''}}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Arrival Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy" name="arrival_date" class="form-control" value="{{$sea_import->arrival_date ?? ''}}">
                                        </div>
                                    </div>

                                    
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">ETD Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy" name="etd_date" class="form-control" value="{{$sea_import->etd_date ?? ''}}">
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Booking Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control" name="booking_date" value="{{ $sea_import->booking_date ?? '' }}">
                                        </div>
                                    </div>
                                    <!--<div class="mb-3 row">-->
                                    <!--    <label class="col-sm-3 col-form-label">SOB Date:</label>-->
                                    <!--    <div class="col-sm-9">-->
                                    <!--        <input type="date" placeholder="dd/mm/yy" name="sob_date" value="{{ $sea_import->sob_date }}" class="form-control">-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                    
                                    <!--<div class="mb-3 row">-->
                                    <!--    <label class="col-sm-3 col-form-label">SOB Date:</label>-->
                                    <!--    <div class="col-sm-9">-->
                                    <!--        <input type="date" placeholder="dd/mm/yy" name="sobDate" class="form-control" value="{{$sea_import->sobDate ?? ''}}">-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                </div>
                            </div>
                            
                             <h4>Party Details</h4>
                            <hr>
                            <div class="row">
                                <div class="col-xl-6 col-xxl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Shipper:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select name="shipper_id" class="select2 form-control wide me-2">
                                                <option value="">Select Shipper</option>
                                                @foreach ($exportParites as $party)
                                                <option value="{{$party->id}}" {{$sea_import?->shipper_id == $party->id ? 'selected' : ''}}>{{$party->party_name}}</option>
                                                @endforeach
                                            </select>
                                            <!--<button type="button" class="btn btn-sm btn-outline-primary"-->
                                            <!--    data-bs-toggle="modal" data-bs-target="#exportPartyDetails">-->
                                            <!--    <i class="bi bi-plus-lg">+</i>-->
                                            <!--</button>-->
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Consignee:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select name="consignee_id" class="select2 form-control wide me-2">
                                                <option value="">Select Consignee</option>
                                                @foreach ($parties->where('party_type', 1) as $party)
                                                <option value="{{$party->id}}" {{$sea_import?->consignee_id == $party->id ? 'selected' : ''}}>{{$party->party_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-xxl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Notify:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select name="notify_id" class="select2 form-control wide me-2">
                                                <option value="">Select Notify</option>
                                                @foreach ($parties as $party)
                                                <option value="{{$party->id}}" {{$sea_import?->notify_id == $party->id ? 'selected' : ''}}>{{$party->party_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Notify 2:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="select2 form-control wide me-2" name="notify2_id" placeholder="Select">
                                                <option value="">Select Notify 2</option>
                                                @foreach ($parties as $party)
                                                <option value="{{$party->id}}" {{$sea_import?->notify2_id == $party->id ? "selected" : ''}}>{{$party->party_name}}</option>
                                                @endforeach
                                            </select>
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
                                                <option value="{{$party->id}}" {{$sea_import?->cha_id == $party->id ? 'selected' : ''}}>{{$party->party_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-xl-6 col-xxl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Forwarder:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="select2 form-control wide me-2" name="forwarder_id" placeholder="Select">
                                                <option value="">Select Forwarder</option>
                                                @foreach ($forwarders as $party)
                                                <option value="{{$party->id}}" {{$sea_import?->forwarder_id == $party->id ? "selected" : ''}}>{{$party->party_name}}</option>
                                                @endforeach
                                            </select>
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
                                            <select name="loading_port_id" class="select2 form-control wide me-2">
                                                <option value="">Select Loading</option>
                                                @foreach ($ports as $port)
                                                <option value="{{$port->id}}" {{$sea_import?->loading_port_id == $port->id ? 'selected' : ''}}>{{$port->port_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Discharge Port:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select name="discharge_port_id" class="select2 form-control wide me-2">
                                                <option value="">Select Discharge</option>
                                                @foreach ($ports as $port)
                                                <option value="{{$port->id}}" {{$sea_import?->discharge_port_id == $port->id ? 'selected' : ''}}>{{$port->port_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Shipping Line:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select name="shipping_line_id" class="select2 form-control wide me-2">
                                                <option value="">Select Shipping Line</option>
                                                @foreach ($shippingLines as $shippingLines)
                                                <option value="{{$shippingLines->id}}" {{$sea_import?->shipping_line_id == $shippingLines->id ? 'selected' : ''}}>{{$shippingLines->shipping_line_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">CFS Yard:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select name="cfs_yard_id" class="select2 form-control wide me-2">
                                                <option value="">Select CFS Yard</option>
                                                @foreach ($parties->where('party_type', 7) as $party)
                                                <option value="{{$party->id}}" {{$sea_import?->cfs_yard_id == $party->id ? 'selected' : ''}}>{{$party->party_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Empty Yard:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select name="empty_yard_id" class="select2 form-control wide me-2">
                                                <option value="">Select Empty Yard</option>
                                                @foreach ($parties->where('party_type', 5) as $party)
                                                <option value="{{$party->id}}" {{$sea_import?->empty_yard_id == $party->id ? 'selected' : ''}}>{{$party->party_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">CoLoader:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select name="coloader_id" class="select2 form-control wide me-2">
                                                <option value="">Select CoLoader</option>
                                                @foreach ($parties->where('party_type', 19) as $party)
                                                <option value="{{$party->id}}" {{$sea_import?->coloader_id == $party->id ? 'selected' : ''}}>{{$party->party_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="col-xl-6 col-xxl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Place of Destination:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select name="destination_port_id" class="select2 form-control wide me-2">
                                                <option value="">Select Destination</option>
                                                @foreach ($ports as $port)
                                                <option value="{{$port->id}}" {{ $port->id == $sea_import?->destination_port_id ? 'selected' : ''}}>{{$port->port_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Receipt Port:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="select2 form-control wide me-2" name="receipt_port_id" placeholder="Select">
                                                <option value="">Select Receipt</option>
                                                @foreach ($ports as $port)
                                                <option value="{{$port->id}}" {{$sea_import->receipt_port_id == $port->id ? "selected" : ''}}>{{$port->port_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Delivery Port:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select name="delivery_port_id" class="select2 form-control wide me-2">
                                                <option value="">Select Delivery</option>
                                                @foreach ($ports as $port)
                                                <option value="{{$port->id}}" {{$sea_import->delivery_port_id == $port->id ? 'selected' : ''}}>{{$port->port_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Agent Name:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select name="agent_id" class="select2 form-control wide me-2">
                                                <option value="">Select Overseas</option>
                                                @foreach ($parties->where('party_type', 4) as $party)
                                                <option value="{{$party->id}}" {{$sea_import?->agent_id == $party->id ? 'selected' : ''}}>{{$party->party_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Delivery Agent Name:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select name="delivery_agent_id" class="select2 form-control wide me-2">
                                                <option value="">Select</option>
                                                @foreach ($parties->whereIn('party_type', [22, 4]) as $party)
                                                <option value="{{$party->id}}" {{$sea_import?->delivery_agent_id == $party->id ? 'selected' : ''}}>
                                                    {{ $party->party_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Sales Person:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select name="sales_person_id" class="select2 form-control wide me-2">
                                                <option value="">Select Sales Person</option>
                                                @foreach ($salePersons as $salePerson)
                                                <option value="{{$salePerson->id}}" {{ $salePerson->id == $sea_import?->sales_person_id ? 'selected' : ''}}>{{$salePerson->name}}</option>
                                                @endforeach
                                            </select>
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
                                            <input type="text" name="quantity" class="form-control" value="{{$sea_import->quantity}}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Freight:</label>
                                        <div class="col-sm-9">
                                            <select name="freight" class="default-select form-control wide me-2">
                                                <option value="">select</option>
                                                <option value="P" {{$sea_import->freight == 'P' ? 'selected' : ''}}>Prepaid</option>
                                                <option value="C" {{$sea_import->freight == 'C' ? 'selected' : ''}}>Collect</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Movement:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="form-control wide" name="movement">
                                                <option value="">Select Movement</option>
                                                <option value="CY/CY" {{$sea_import->movement == 'CY/CY'? 'selected' : ''}}>CY/CY</option>
                                                <option value="CY/CFS" {{$sea_import->movement == 'CY/CFS'? 'selected' : ''}}>CY/CFS</option>
                                                <option value="CFS/CY" {{$sea_import->movement == 'CFS/CY'? 'selected' : ''}}>CFS/CY</option>
                                                <option value="CFS/CFS" {{$sea_import->movement == 'CFS/CFS'? 'selected' : ''}}>CFS/CFS</option>
                                                <option value="CY/DOOR" {{$sea_import->movement == 'CY/DOOR'? 'selected' : ''}}>CY/DOOR</option>
                                                <option value="DOOR/DOOR" {{$sea_import->movement == 'DOOR/DOOR'? 'selected' : ''}}>DOOR/DOOR</option>
                                                <option value="PORT/DOOR" {{$sea_import->movement == 'PORT/DOOR'? 'selected' : ''}}>PORT/DOOR</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!--<div class="mb-3 row">-->
                                    <!--    <label class="col-sm-3 col-form-label">CBM:<span class="text-danger">*</span></label>-->
                                    <!--    <div class="col-sm-9">-->
                                    <!--        <input type="text" name="cbm" class="form-control" value="{{$sea_import->cbm}}">-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Material:</label>
                                        <div class="col-sm-9 d-flex align-items-center gap-3">
                                            <div class="form-check">
                                                <input type="radio" name="is_hazardous" value="1" {{$sea_import->is_hazardous == '1' ? 'checked' : ''}} class="form-check-input">
                                                <label class="form-check-label">HAZ</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" name="is_hazardous" value="0" {{$sea_import->is_hazardous == '0' ? 'checked' : ''}} class="form-check-input">
                                                <label class="form-check-label">NON-HAZ</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">IMO CD:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="imo_cd" class="form-control" value="{{$sea_import->imo_cd}}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">FreeDays:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="free_days" class="form-control" value="{{$sea_import->free_days}}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Insurance:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="insurance" class="form-control" value="{{$sea_import->insurance}}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Transportation:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="transportation" class="form-control" value="{{$sea_import->transportation}}">
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Delivery Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy" name="delivery_order_date" class="form-control" value="{{$sea_import->delivery_order_date}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Package Type:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select name="package_id" class="select2 form-control wide me-2">
                                                <option value="">select</option>
                                                @foreach ($packages as $package)
                                                <option value="{{$package->id}}" {{$sea_import->package_id == $package->id ? 'selected' : ''}}>{{$package->package_code}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Gross Wt:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="gross_weight" class="form-control" value="{{$sea_import->gross_weight}}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">new Wt:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="net_weight" class="form-control" value="{{$sea_import->net_weight}}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Cargo Type:</label>
                                        <div class="col-sm-9">
                                            <select name="cargo" class="default-select form-control wide me-2">
                                                <option value="">Select Cargo</option>
                                                <option value="LOCAL" {{$sea_import->cargo == 'LOCAL' ? 'selected' : ''}}>LOCAL</option>
                                                <option value="SMTP" {{$sea_import->cargo == 'SMTP' ? 'selected' : ''}}>SMTP</option>
                                                <option value="TP" {{$sea_import->cargo == 'TP' ? 'selected' : ''}}>TP</option>
                                                <option value="UB" {{$sea_import->cargo == 'UB' ? 'selected' : ''}}>UB</option>
                                                <option value="GOVT" {{$sea_import->cargo == 'GOVT' ? 'selected' : ''}}>GOVT</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Del. Type:</label>
                                        <div class="col-sm-9">
                                            <select name="delivery_type" class="default-select form-control wide me-2">
                                                <option value="">select</option>
                                                <option value="F" {{$sea_import->delivery_type == 'F' ? 'selected' : ''}}>FACTORY</option>
                                                <option value="D" {{$sea_import->delivery_type == 'D' ? 'selected' : ''}}>DOCK</option>
                                                <option value="L" {{$sea_import->delivery_type == 'L' ? 'selected' : ''}}>LCL</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">UNO CD:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="uno_cd" class="form-control" value="{{$sea_import->uno_cd}}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">BL Type:</label>
                                        <div class="col-sm-9">
                                            <select name="hbl_type" class="form-control wide me-2">
                                                <option value="">select</option>
                                                @foreach ($master_bl_types as $master_bl_type)
                                                    <option value="{{$master_bl_type->id}}" {{ $sea_import->hbl_type == $master_bl_type->id ? 'selected' : '' }}>
                                                        {{$master_bl_type->bl_description}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">F.Premium.Amt:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="fpa_amount" class="form-control" value="{{$sea_import->fpa_amount}}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Transportation Details:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="transportation_details" class="form-control" value="{{$sea_import->transportation_details}}">
                                        </div>
                                    </div>
                                    <!--<div class="mb-3 row">-->
                                    <!--    <label class="col-sm-3 col-form-label">Bill of Entry:</label>-->
                                    <!--    <div class="col-sm-9">-->
                                    <!--        <input type="text" name="bill_of_entry" class="form-control" value="{{$sea_import->bill_of_entry}}">-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                    
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Clearance:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="clearance" class="form-control" value="{{$sea_import->clearance}}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xl-6 col-xxl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Sub Job No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="sub_job_no" class="form-control" value="{{$sea_import->sub_job_no}}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Obl No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="obl_no" class="form-control" value="{{$sea_import->obl_no}}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Ref. No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="ref_no" class="form-control" value="{{$sea_import->ref_no}}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Invoice Ref. No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="inv_ref_no" class="form-control" value="{{$sea_import->inv_ref_no}}">
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
                                                <option value="{{$party->id}}" {{$sea_import->surveyor_id == $party->id ? 'selected' : ''}}>{{$party->party_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Obl Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy" name="obl_date" class="form-control" value="{{$sea_import->obl_date}}">
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Validity Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy" name="validity_date" class="form-control" value="{{$sea_import->validity_date}}">
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
                                            <input type="text" name="remarks" class="form-control" value="{{$sea_import->remarks}}" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">User Name:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="username" class="form-control" value="{{$sea_import->username}}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Ex Work:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="ex_work" class="form-control" value="{{$sea_import->ex_work??''}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Prealert Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy" name="prealert_date" class="form-control" value="{{$sea_import->prealert_date}}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Amount:</label>
                                        <div class="col-sm-9">
                                            <input type="text" placeholder="" name="amount" class="form-control" value="{{$sea_import->amount}}">
                                        </div>
                                    </div>
                                    <!--<div class="mb-3 row">-->
                                    <!--    <label class="col-sm-3 col-form-label">Inv No Full:</label>-->
                                    <!--    <div class="col-sm-9">-->
                                    <!--        <input type="text" name="inv_no_full" class="form-control" value="{{$sea_import->inv_no_full}}">-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('bl.sea-imports.freightCertificateDetails', $sea_import->id) }}" class="btn btn-info btn-sm" type="button">FREIGHT CRETIFICATE</a>
                                <a href="{{ route('bl.sea-imports.cargoArrivelDetails', $sea_import->id) }}" class="btn btn-success btn-sm" type="button">CARGO ARRIVAL NOTICE</a>
                                <a href="{{ route('bl.draft.option.import',$sea_import->id ) }}" class="btn btn-primary btn-sm" type="button">BL PRINT</a>
                                <a href="{{route('sea-imports.index')}}" class="btn btn-warning btn-sm" type="button">Cancel</a>
                                <!--<button class="btn btn-success btn-sm" type="button">Print</button>-->
                                <button class="btn btn-primary btn-sm" type="submit">Update</button>
                            </div>
                        </div>
                    </form>

                    <h4>Container Details</h4>
                    <hr>
                    <div class="form-validation">
                        <form class="needs-validation" id="seaImportContainerForm">
                            @csrf
                            <input type="hidden" name="container_id" id="container_id" value="">
                            <input type="hidden" name="sea_import_id" id="sea_import_id" value="{{ $sea_import->id }}">
                            <div class="row">
                                <!--<div class="col-xl-6">-->
                                <!--    <div class="mb-3 row row">-->
                                <!--        <label class="col-sm-3 col-form-label">Cont_Hbl:</label>-->
                                <!--        <div class="col-sm-9">-->
                                <!--            <input type="text" name="cont_hbl" value="" class="form-control">-->
                                <!--        </div>-->
                                <!--    </div>-->
                                <!--</div>-->
                                <div class="col-xl-6">
                                    <div class="mb-3 row row">
                                        <label class="col-sm-3 col-form-label">Gross Weight:<span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="gross_weight" value="" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row row">
                                        <label class="col-sm-3 col-form-label">Net Weight:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="net_weight" value="" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row row">
                                        <label class="col-sm-3 col-form-label">Total Package:<span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="total_package" value="" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row row">
                                        <label class="col-sm-3 col-form-label">Ground Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy" name="ground_date" value="" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row row">
                                        <label class="col-sm-3 col-form-label">TP/ICD(T/I):</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="tp_icd" value="" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row row">
                                        <label class="col-sm-3 col-form-label">Printed:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="printed" value="" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row row">
                                        <label class="col-sm-3 col-form-label">Container No:<span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="container_no" value="" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row row">
                                        <label class="col-sm-3 col-form-label">CBM:<span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="cbm" value="" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row row">
                                        <label class="col-sm-3 col-form-label">Cargo Type:</label>
                                        <div class="col-sm-9">
                                            <select class="form-control wide me-2" name="cargo_type" id="cargo_type" placeholder="Select">
                                                <option value="">select</option>
                                                <option value="GEN">GEN</option>
                                                <option value="HAZ">HAZ</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row row">
                                        <label class="col-sm-3 col-form-label">Ground Days:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="ground_days" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row row">
                                        <label class="col-sm-3 col-form-label">SOC(Y/N):</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="soc_yn" value="" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row row">
                                        <label class="col-sm-3 col-form-label">Selected:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="selected" value="" class="form-control">
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
                                <div class="col-xl-6">
                                    <div class="mb-3 row row">
                                        <label class="col-sm-3 col-form-label">Refer(Y/N):</label>
                                        <div class="col-sm-9">
                                            <select class="form-control wide me-2" name="refer" placeholder="Select">
                                                <option value="">select</option>
                                                <option value="Y">Y</option>
                                                <option value="N">N</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row row">
                                        <label class="col-sm-3 col-form-label">Detent Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy" name="detent_date" value="" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row row">
                                        <label class="col-sm-3 col-form-label">Imo Code:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="imo_code" value="" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row row">
                                        <label class="col-sm-3 col-form-label">Disposal:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="disposal" value="" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row row">
                                        <label class="col-sm-3 col-form-label">Sector:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="sector" value="" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <!--<div class="col-xl-6">-->
                                <!--    <div class="mb-3 row row">-->
                                <!--        <label class="col-sm-3 col-form-label">Seal No:<span class="text-danger">*</span></label>-->
                                <!--        <div class="col-sm-9">-->
                                <!--            <input type="text" name="seal_no" value="" class="form-control">-->
                                <!--        </div>-->
                                <!--    </div>-->
                                <!--</div>-->
                                <div class="col-xl-6">
                                    <div class="mb-3 row row">
                                        <label class="col-sm-3 col-form-label">FCL/LCL:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select class="form-control wide me-2" name="fcl_lcl" placeholder="Select">
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
                                    <div class="mb-3 row row">
                                        <label class="col-sm-3 col-form-label">Freedays_Cont:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="freedays_cont" value="" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row row">
                                        <label class="col-sm-3 col-form-label">Uno No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="uno_no" value="" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row row">
                                        <label class="col-sm-3 col-form-label">Remarks:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="remarks" value="" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row row">
                                        <label class="col-sm-3 col-form-label">Prev_Days:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="previous_days" value="" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Agent Seal No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="agentSealNo" name="" value="" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Cust Seal No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="cust_seal_no">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">SOB Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" placeholder="dd/mm/yy"  name="sobDate" value="" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Ex-rate:</label>
                                        <div class="col-sm-9">
                                            <input type="number" step="0.001" min="0" name="ex_rate" class="form-control" pattern="^\d+(\.\d{1,3})?$">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Rate:</label>
                                        <div class="col-sm-9">
                                            <input type="number" step="0.001" min="0" name="rate" class="form-control" pattern="^\d+(\.\d{1,3})?$">
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
                                            <label class="col-sm-3 col-form-label">Bill of entry (BOE):</label>
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
                                                <input type="date" placeholder="dd/mm/yy" name="do_date" class="form-control" value="">
                                            </div>
                                        </div>
                                    </div>
    
                                </div>
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <a href="{{route('sea-imports.index')}}" class="btn btn-warning btn-sm" type="button">Reset</a>
                                    <button class="btn btn-primary btn-sm" type="submit">Add CONTAINER</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">Container no</th>
                                  <th scope="col">Agent Seal no.</th>
                                  <th scope="col">Gross Weight</th>
                                  <th scope="col">Size.</th>
                                  <th scope="col">Total Package</th>
                                  <th scope="col">FCL/LCL</th>
                                  
                                  <th scope="col">Inv No/Date</th>
                                  <th scope="col">Check List Dt.</th>
                                  <th scope="col">BOE</th>
                                  <th scope="col">Destuffing Dt.</th>
                                  <th scope="col">Cut of Charge</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sea_import_containers as $sea_import_container)
                                    <tr>
                                      <th scope="row">{{ $sea_import_container->id }}</th>
                                      <td>{{ $sea_import_container?->container_no }}</td>
                                      <td>{{ $sea_import_container?->agentSealNo }}</td>
                                      <td>{{ $sea_import_container?->gross_weight }}</td>
                                      <td>{{ $sea_import_container?->size }}</td>
                                      <td>{{ $sea_import_container?->total_package }}</td>
                                      <td>{{ $sea_import_container?->fcl_lcl }}</td>
                                      
                                      <td>{{ $sea_import_container?->customer_inv_no }}</td>
                                      <td>{{ $sea_import_container?->check_list_date }}</td>
                                      <td>{{ $sea_import_container?->bill_of_entry_date }}</td>
                                      <td>{{ $sea_import_container?->destuffing_date }}</td>
                                      <td>{{ $sea_import_container?->out_off_charge_date }}</td>
                                      
                                      <td><a class="btn btn-sm btn-primary editChargeBtn" data-id="{{ $sea_import_container->id }}">Edit</a></td>
                                      <td><a class="btn btn-sm btn-danger deleteChargeBtn" data-id="{{ $sea_import_container->id }}">DELETE</a></td>
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
                            <input type="hidden" name="file_related" value="sea_import">
                            <input type="hidden" name="job_no" id="job_no_hidden" value="{{ $sea_import->job_no }}">
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


<!-- sales person model -->
@include('admin-main.admin.commonModelForms.salesperson_modal')
<!-- vessel model  -->
@include('admin-main.admin.commonModelForms.addOceanVslModel')
<!-- Add new export Modal -->
@include('admin-main.admin.commonModelForms.addExportPartiesModel')

@endsection
@push('scripts')
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
</script>

<script>
    $(document).ready(function() {
    
        // Clear form helper
        function clearForm() {
            $('#seaImportContainerForm')[0].reset();
            $('#seaImportContainerForm').find('input, select, textarea').val('');
            $('#seaImportContainerForm').attr('data-id', '');
        }
    
        // Fill form for editing
        $(document).on('click', '.editChargeBtn', function() {
            let id = $(this).data('id');
                $.get('/sea-imports/getContainerDetail/' + id, function(res) {
                    $('#container_id').val(res.id); // <-- Set container_id here
                    $('input[name="cont_hbl"]').val(res.cont_hbl);
                    $('input[name="gross_weight"]').val(res.gross_weight);
                    $('input[name="net_weight"]').val(res.net_weight);
                    $('input[name="total_package"]').val(res.total_package);
              
                    $('input[name="tp_icd"]').val(res.tp_icd);
                    $('input[name="printed"]').val(res.printed);
                    $('input[name="container_no"]').val(res.container_no);
                    $('input[name="cbm"]').val(res.cbm);
                    $('#cargo_type').val(res.cargo_type?.trim().toUpperCase()).trigger('change');
                    $('input[name="ground_days"]').val(res.ground_days);
                    $('input[name="soc_yn"]').val(res.soc_yn);
                    $('input[name="selected"]').val(res.selected);
                    if (res.size) {
                        let sizeVal = res.size.toString().trim();
                    
                        $('select[name="size"]')
                            .val(sizeVal)
                            .trigger('change.select2');
                    }
                    $('select[name="refer"]').val(res.refer);
                    $('input[name="cust_seal_no"]').val(res.cust_seal_no);
              
                    $('input[name="imo_code"]').val(res.imo_code);
                    $('input[name="disposal"]').val(res.disposal);
                    $('input[name="sector"]').val(res.sector);
                    $('input[name="seal_no"]').val(res.seal_no);
                    $('select[name="fcl_lcl"]').val(res.fcl_lcl);
                    $('input[name="freedays_cont"]').val(res.freedays_cont);
                    $('input[name="uno_no"]').val(res.uno_no);
                    $('input[name="remarks"]').val(res.remarks);
                    $('input[name="previous_days"]').val(res.previous_days);
                    $('input[name="agentSealNo"]').val(res.agentSealNo);
                    $('input[name="bill_of_entry_date"]').val(res.bill_of_entry_date);
                   
                    $('textarea[name="mark_and_numbers"]').val(res.mark_and_numbers);
                    $('textarea[name="goods_description"]').val(res.goods_description);
                    $('textarea[name="customer_inv_no"]').val(res.customer_inv_no);
                    $('textarea[name="sbill_no"]').val(res.sbill_no);
                    $('input[name="ex_rate"]').val(res.ex_rate);
                    $('input[name="rate"]').val(res.rate);
                    
                    document.querySelector('input[name="check_list_date"]')._flatpickr.setDate(res.check_list_date);
                    document.querySelector('input[name="destuffing_date"]')._flatpickr.setDate(res.destuffing_date);
                    document.querySelector('input[name="do_date"]')._flatpickr.setDate(res.do_date);
                    document.querySelector('input[name="out_off_charge_date"]')._flatpickr.setDate(res.out_off_charge_date);
                    document.querySelector('input[name="sobDate"]')._flatpickr.setDate(res.sobDate);
                    document.querySelector('input[name="detent_date"]')._flatpickr.setDate(res.detent_date);
                    document.querySelector('input[name="ground_date"]')._flatpickr.setDate(res.ground_date);
                });
        });
    
        // Form submit
        $('#seaImportContainerForm').on('submit', function(e) {
            e.preventDefault();
        
            let containerId = $('#container_id').val(); // <- Must be set on edit
            let seaImportId = $('#sea_import_id').val();
            let url = containerId 
                ? '/sea-imports/update-container/' + containerId
                : '/sea-imports/add-container';
            let method = containerId ? 'PUT' : 'POST';
        
            let formData = $(this).serializeArray();
            let dataObj = {};
            formData.forEach(f => dataObj[f.name] = f.value);
        
            if (!containerId) {
                dataObj['sea_import_id'] = seaImportId;
            }
        
            $.ajax({
                url: url,
                type: method,
                data: dataObj,
                success: function(res) {
                    if (res.status) {
                        clearForm(); 
                        window.location.reload();
                        // loadContainerTable(); // reload table dynamically
                    } else {
                        alert(res.message || 'Something went wrong!');
                    }
                },
                error: function(xhr) {
                    if(xhr.status === 422){
                        let errors = xhr.responseJSON.errors;
                        for (const [field, msgs] of Object.entries(errors)) {
                            let input = $('[name="'+field+'"]');
                            input.addClass('is-invalid');
                            if(input.next('.invalid-feedback').length === 0){
                                input.after('<div class="invalid-feedback">'+msgs[0]+'</div>');
                            } else {
                                input.next('.invalid-feedback').text(msgs[0]);
                            }
                        }
                    } else {
                        alert('Error submitting form.');
                    }
                }
            });
        });



    
        // Delete container
        $(document).on('click', '.deleteChargeBtn', function(e) {
            e.preventDefault();
            if(!confirm('Are you sure to delete this container?')) return;
    
            let containerId = $(this).data('id');
            let btn = $(this);
    
            $.ajax({
                url: '/sea-imports/delete-container/' + containerId,
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
    
        // Load table dynamically
        // function loadContainerTable() {
        //     $.ajax({
        //         url: '{{ route("bl.sea-imports.cargoArrivelDetails", $sea_import->id ?? 0) }}', // Adjust route if needed
        //         type: 'GET',
        //         success: function(res) {
        //             console.log('res res', res)
        //             let tbody = '';
        //             res.forEach(function(row, index) {
        //                 tbody += `<tr>
        //                     <th>${row.id}</th>
        //                     <td>${row.container_no || ''}</td>
        //                     <td>${row.agent_seal_no || ''}</td>
        //                     <td>${row.cust_seal_no || ''}</td>
        //                     <td>${row.size || ''}</td>
        //                     <td>${row.total_package || ''}</td>
        //                     <td>${row.fcl_lcl || ''}</td>
        //                     <td><a class="btn btn-sm btn-primary editChargeBtn" data-id="${row.id}">Edit</a></td>
        //                     <td><a class="btn btn-sm btn-danger deleteChargeBtn" data-id="${row.id}">DELETE</a></td>
        //                 </tr>`;
        //             });
        //             $('table tbody').html(tbody);
        //         }
        //     });
        // }
    
    });
</script>

@endpush