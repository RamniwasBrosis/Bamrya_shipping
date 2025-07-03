@extends('admin-main.layouts.default')
@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="#">Edit Import BL</a></li>
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
                        <form action="{{ route('sea-imports.update', $sea_import->id) }}" method="POST" class="needs-validation" >
                            @csrf
                            @method('PUT')
                            <div class="row form-material">
                                <div class="mb-3 row col-xl-3 col-xxl-12 col-xl-6 row">
                                    <label class="col-sm-3 col-form-label">BL Issued By:</label>
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
                                            <label class="col-sm-3 col-form-label">Job No:</label>
                                            <div class="col-sm-9">
                                                <select name="job_no" class="default-select form-control wide me-2">
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
                                                <input type="text" name="mbl_no" class="form-control" value="{{$sea_import->mbl_no}}">
                                            </div>
                                        </div>                                    
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">HBL No:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="hbl_no" class="form-control" value="{{$sea_import->hbl_no}}">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">IGM No:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="igm_no" class="form-control" value="{{$sea_import->igm_no}}">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Item No:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="item_no" class="form-control" value="{{$sea_import->item_no}}">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Voy. No:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="voyage_no" class="form-control" value="{{$sea_import->voyage_no}}">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Enquiry Reference No:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="enquiry_reference_no" class="form-control" value="{{$sea_import->enquiry_reference_no}}">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">ETA Date:</label>
                                            <div class="col-sm-9">
                                                <input type="date" name="eta_date" class="form-control" value="{{$sea_import->eta_date}}">
                                            </div>
                                        </div>
            
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Cargo(Cust):</label>
                                            <div class="col-sm-9">
                                                <select name="cargo_type" class="default-select form-control wide me-2">
                                                    <option value="">select</option>
                                                    <option value="FCL" {{$sea_import->cargo_type == 'FCL' ? 'selected' : ''}}>FCL</option>
                                                    <option value="LCL" {{$sea_import->cargo_type == 'LCL' ? 'selected' : ''}}>LCL</option>
                                                    <option value="ETY" {{$sea_import->cargo_type == 'ETY' ? 'selected' : ''}}>ETY</option>
                                                    <option value="AIR" {{$sea_import->cargo_type == 'AIR' ? 'selected' : ''}}>AIR</option>
                                
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">MBL Date:</label>
                                            <div class="col-sm-9">
                                                <input type="date" name="mbl_date" class="form-control" value="{{$sea_import->mbl_date}}">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">HBL Date:</label>
                                            <div class="col-sm-9">
                                                <input type="date" name="hbl_date" class="form-control" value="{{$sea_import->hbl_date}}">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">IGM Date:</label>
                                            <div class="col-sm-9">
                                                <input type="date" name="igm_date" class="form-control" value="{{$sea_import->igm_date}}">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Sub Item No:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="item_no" class="form-control" value="{{$sea_import->item_no}}">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Arrival Date:</label>
                                            <div class="col-sm-9">
                                                <input type="date" name="arrival_date" class="form-control" value="{{$sea_import->arrival_date}}">
                                            </div>
                                        </div>
                        
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Vessel Name:</label>
                                            <div class="col-sm-9">
                                                <select name="vessel_id" class="default-select form-control wide me-2">
                                                    <option value="">select</option>
                                                    @foreach ($vessels as $vessel)
                                                        <option value="{{$vessel->id}}" {{$sea_import->vessel_id == $vessel->id ? 'selected' : ''}}>{{$vessel->vessel_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">ETD Date:</label>
                                            <div class="col-sm-9">
                                                <input type="date" name="etd_date" class="form-control" value="{{$sea_import->etd_date}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <h4>Shipment Details</h4>
                                <hr>
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Quantity:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="quantity" class="form-control" value="{{$sea_import->quantity}}">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Freight:</label>
                                            <div class="col-sm-9">
                                                <select name="freight" class="default-select form-control wide me-2">
                                                    <option value="">select</option>
                                                    <option value="P" {{$sea_import->freight == 'P' ? 'selected' : ''}}>P</option>
                                                    <option value="C" {{$sea_import->freight == 'C' ? 'selected' : ''}}>C</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">CBM:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="cbm" class="form-control" value="{{$sea_import->cbm}}">
                                            </div>
                                        </div>
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
                                            <label class="col-sm-3 col-form-label">Clearance:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="clearance" class="form-control" value="{{$sea_import->clearance}}">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Delivery Order:</label>
                                            <div class="col-sm-9">
                                                <input type="date" name="delivery_order_date" class="form-control" value="{{$sea_import->delivery_order_date}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Package:</label>
                                            <div class="col-sm-9">
                                                <select name="package_id" class="form-control wide me-2">
                                                    <option value="">select</option>
                                                    @foreach ($packages as $package)
                                                        <option value="{{$package->id}}" {{$sea_import->package_id == $package->id ? 'selected' : ''}}>{{$package->package_code}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Gross Wt:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="gross_weight" class="form-control" value="{{$sea_import->gross_weight}}">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Cargo:</label>
                                            <div class="col-sm-9">
                                                <select name="cargo" class="default-select form-control wide me-2">
                                                    <option value="">select</option>
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
                                                    <option value="F"  {{$sea_import->delivery_type == 'F' ? 'selected' : ''}}>FACTORY</option>
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
                                            <label class="col-sm-3 col-form-label">HBLType:</label>
                                            <div class="col-sm-9">
                                                <select name="hbl_type" class="default-select form-control wide me-2">
                                                    <option value="">select</option>
                                                    <option value="SUR" {{$sea_import->hbl_type == 'SUR' ? 'selected' : ''}}>SURRENDER</option>
                                                    <option value="ORI" {{$sea_import->hbl_type == 'ORI' ? 'selected' : ''}}>ORIGINAL</option>
                                                    <option value="SEA" {{$sea_import->hbl_type == 'SEA' ? 'selected' : ''}}>SEAWAY</option>
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
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Bill of Entry:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="bill_of_entry" class="form-control" value="{{$sea_import->bill_of_entry}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <h4>Port Details</h4>
                                <hr>
                                <div class="row">
                                    <div class="col-xl-6 col-xxl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Loading:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select name="loading_port_id" class="default-select form-control wide me-2">
                                                    <option value="">select</option>
                                                    @foreach ($ports as $port)
                                                        <option value="{{$port->id}}" {{$sea_import->loading_port_id == $port->id ? 'selected' : ''}}>{{$port->port_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Discharge:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select name="discharge_port_id" class="default-select form-control wide me-2">
                                                    <option value="">select</option>
                                                    @foreach ($ports as $port)
                                                        <option value="{{$port->id}}" {{$sea_import->discharge_port_id == $port->id ? 'selected' : ''}}>{{$port->port_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Shipping Line:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select name="shipping_line_id" class="default-select form-control wide me-2">
                                                    <option value="">select</option>
                                                    @foreach ($parties as $party)
                                                        <option value="{{$party->id}}" {{$sea_import->shipping_line_id == $party->id ? 'selected' : ''}}>{{$party->party_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">CFS Yard:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select name="cfs_yard_id" class="default-select form-control wide me-2">
                                                    <option value="">select</option>
                                                    @foreach ($parties as $party)
                                                        <option value="{{$party->id}}" {{$sea_import->cfs_yard_id == $party->id ? 'selected' : ''}}>{{$party->party_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Sales Person:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select name="sales_person_id" class="default-select form-control wide me-2">
                                                    <option value="">select</option>
                                                    @foreach ($parties as $party)
                                                        <option value="{{$party->id}}" {{$sea_import->sales_person_id == $party->id ? 'selected' : ''}}>{{$party->party_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-xxl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Destination:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select name="destination_port_id" class="default-select form-control wide me-2">
                                                    <option value="">select</option>
                                                    @foreach ($ports as $port)
                                                        <option value="{{$port->id}}" {{$sea_import->destination_port_id == $port->id ? 'selected' : ''}}>{{$port->port_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Delivery:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select name="delivery_port_id" class="default-select form-control wide me-2">
                                                    <option value="">select</option>
                                                    @foreach ($ports as $port)
                                                        <option value="{{$port->id}}" {{$sea_import->delivery_port_id == $port->id ? 'selected' : ''}}>{{$port->port_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Overseas:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select name="overseas_agent_id" class="default-select form-control wide me-2">
                                                    <option value="">select</option>
                                                    @foreach ($parties as $party)
                                                        <option value="{{$party->id}}" {{$sea_import->overseas_agent_id == $party->id ? 'selected' : ''}}>{{$party->party_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Empty Yard:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select name="empty_yard_id" class="default-select form-control wide me-2">
                                                    <option value="">select</option>
                                                    @foreach ($parties as $party)
                                                        <option value="{{$party->id}}" {{$sea_import->empty_yard_id == $party->id ? 'selected' : ''}}>{{$party->party_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">CoLoader:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select name="coloader_id" class="default-select form-control wide me-2">
                                                    <option value="">select</option>
                                                    @foreach ($parties as $party)
                                                        <option value="{{$party->id}}" {{$sea_import->coloader_id == $party->id ? 'selected' : ''}}>{{$party->party_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <h4>Party Details</h4>
                                <hr>
                                <div class="row">
                                    <div class="col-xl-6 col-xxl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Shipper:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select name="shipper_id" class="default-select form-control wide me-2">
                                                    <option value="">select</option>
                                                    @foreach ($parties as $party)
                                                        <option value="{{$party->id}}" {{$sea_import->shipper_id == $party->id ? 'selected' : ''}}>{{$party->party_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Consignee:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select name="consignee_id" class="default-select form-control wide me-2">
                                                    <option value="">select</option>
                                                    @foreach ($parties as $party)
                                                        <option value="{{$party->id}}" {{$sea_import->consignee_id == $party->id ? 'selected' : ''}}>{{$party->party_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-xxl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Notify:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select name="notify_id" class="default-select form-control wide me-2">
                                                    <option value="">select</option>
                                                    @foreach ($parties as $party)
                                                        <option value="{{$party->id}}" {{$sea_import->notify_id == $party->id ? 'selected' : ''}}>{{$party->party_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">CHA:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select name="cha_id" class="default-select form-control wide me-2">
                                                    <option value="">select</option>
                                                    @foreach ($parties as $party)
                                                        <option value="{{$party->id}}" {{$sea_import->cha_id == $party->id ? 'selected' : ''}}>{{$party->party_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xl-6 col-xxl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Mark And Numbers:</label>
                                            <div class="col-sm-9">
                                                <textarea name="mark_and_numbers" class="form-control h-100" rows="2">{{$sea_import->mark_and_numbers}}</textarea>
                                            </div>
                                        </div>
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
                                            <label class="col-sm-3 col-form-label">Ref. No/BOE:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="ref_no" class="form-control" value="{{$sea_import->ref_no}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-xxl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Goods Description:</label>
                                            <div class="col-sm-9">
                                                <textarea name="goods_description" class="form-control h-100" rows="2">{{$sea_import->goods_description}}</textarea>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Surveyor:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select name="surveyor_id" class="default-select form-control wide me-2">
                                                    <option value="">select</option>
                                                    @foreach ($parties as $party)
                                                        <option value="{{$party->id}}" {{$sea_import->surveyor_id == $party->id ? 'selected' : ''}}>{{$party->party_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Obl Date:</label>
                                            <div class="col-sm-9">
                                                <input type="date" name="obl_date" class="form-control" value="{{$sea_import->obl_date}}">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Do Date:</label>
                                            <div class="col-sm-9">
                                                <input type="date" name="do_date" class="form-control" value="{{$sea_import->do_date}}">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Validity Date:</label>
                                            <div class="col-sm-9">
                                                <input type="date" name="validity_date" class="form-control" value="{{$sea_import->validity_date}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <h4>Other Details</h4>
                                <hr>
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Remarks:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="remarks" class="form-control" value="{{$sea_import->remarks}}">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">User Name:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="username" class="form-control" value="{{$sea_import->username}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Prealert Date:</label>
                                            <div class="col-sm-9">
                                                <input type="date" name="prealert_date" class="form-control" value="{{$sea_import->prealert_date}}">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Inv No Full:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="inv_no_full" class="form-control" value="{{$sea_import->inv_no_full}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <button class="btn btn-success btn-sm" type="button">CARGO ARRIVAL NOTICE</button>
                                    <a href="{{route('sea-imports.index')}}" class="btn btn-warning btn-sm" type="button">Cancel</a>
                                    <button class="btn btn-success btn-sm" type="button">Print</button>
                                    <button class="btn btn-primary btn-sm" type="submit">Update</button>
                                </div>
                            </div>
                        </form>

                        <hr>
                        <div class="form-validation">
                            <form class="needs-validation" method="POST" action="{{route('sea-imports.updateContainer', $sea_import->container->id  ?? '')}}">
                                @csrf
                                @method('PUT')
                                <div class="row">                                   
                                    <div class="col-xl-6">
                                        <div class="mb-3 row row">
                                            <label class="col-sm-3 col-form-label">Cont_Hbl:<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" name="cont_hbl" value="{{ old('cont_hbl', $sea_import->container->cont_hbl ?? '') }}" class="form-control" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row row">
                                            <label class="col-sm-3 col-form-label">Gross Weight:<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" name="gross_weight" value="{{old('gross_weight', $sea_import->container->gross_weight ?? '')}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row row">
                                            <label class="col-sm-3 col-form-label">Total Package:<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" name="total_package" value="{{ old('total_package', $sea_import->container->total_package ?? '') }}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row row">
                                            <label class="col-sm-3 col-form-label">Ground Date:</label>
                                            <div class="col-sm-9">
                                                <input type="date" name="ground_date" value="{{old('ground_date', $sea_import->container->ground_date ?? '')}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row row">
                                            <label class="col-sm-3 col-form-label">TP/ICD(T/I):</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="tp_icd" value="{{old('tp_icd', $sea_import->container->tp_icd ?? '')}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row row">
                                            <label class="col-sm-3 col-form-label">Printed:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="printed" value="{{old('printed', $sea_import->container->printed ?? '')}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row row">
                                            <label class="col-sm-3 col-form-label">Container No:<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" name="container_no" value="{{old('container_no', $sea_import->container->container_no ?? '')}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row row">
                                            <label class="col-sm-3 col-form-label">CBM:<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" name="cbm" value="{{old('cbm', $sea_import->container->cbm ?? '')}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row row">
                                            <label class="col-sm-3 col-form-label">Cargo Type:</label>
                                            <div class="col-sm-9">
                                                <select class="default-select form-control wide me-2" name="cargo_type" placeholder="Select">
                                                    <option value="">select</option>
                                                    <option value="GEN" {{optional($sea_import->container)->cargo_type == 'GEN'? 'selected' : ''}}>GEN</option>
                                                    <option value="HAZ" {{optional($sea_import->container)->cargo_type == 'HAZ'? 'selected' : ''}}>HAZ</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row row">
                                            <label class="col-sm-3 col-form-label">Ground Days:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="ground_days" value="{{old('ground_days', $sea_import->container->ground_days ?? '')}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row row">
                                            <label class="col-sm-3 col-form-label">SOC(Y/N):</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="soc_yn" value="{{old('soc_yn', $sea_import->container->soc_yn ?? '')}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row row">
                                            <label class="col-sm-3 col-form-label">Selected:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="selected" value="{{old('selected', $sea_import->container->selected ?? '')}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row row">
                                            <label class="col-sm-3 col-form-label">Size:<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <select class="default-select form-control wide me-2" name="size" placeholder="Select">
                                                    <option value="">Select</option>
                                                    <option value="1" {{ optional($sea_import->container)->size == '1' ? 'selected' : '' }}>0</option>
                                                    <option value="20 GP" {{ optional($sea_import->container)->size == '20 GP' ? 'selected' : '' }}>20 GP</option>
                                                    <option value="40 GP" {{ optional($sea_import->container)->size == '40 GP' ? 'selected' : '' }}>40 GP</option>
                                                    <option value="40 HQ" {{ optional($sea_import->container)->size == '40 HQ' ? 'selected' : '' }}>40 HQ</option>
                                                    <option value="20 OT" {{ optional($sea_import->container)->size == '20 OT' ? 'selected' : '' }}>20 OT</option>
                                                    <option value="40 OT" {{ optional($sea_import->container)->size == '40 OT' ? 'selected' : '' }}>40 OT</option>
                                                    <option value="20 FR" {{ optional($sea_import->container)->size == '20 FR' ? 'selected' : '' }}>20 FR</option>
                                                    <option value="40 FR" {{ optional($sea_import->container)->size == '40 FR' ? 'selected' : '' }}>40 FR</option>
                                                    <option value="20 TK" {{ optional($sea_import->container)->size == '20 TK' ? 'selected' : '' }}>20 TK</option>
                                                    <option value="40 TK" {{ optional($sea_import->container)->size == '40 TK' ? 'selected' : '' }}>40 TK</option>
                                                    <option value="20 RF" {{ optional($sea_import->container)->size == '20 RF' ? 'selected' : '' }}>20 RF</option>
                                                    <option value="40 RF" {{ optional($sea_import->container)->size == '40 RF' ? 'selected' : '' }}>40 RF</option>
                                                    <option value="20 ODO" {{ optional($sea_import->container)->size == '20 ODO' ? 'selected' : '' }}>20 ODO</option>
                                                    <option value="40 ODO" {{ optional($sea_import->container)->size == '40 ODO' ? 'selected' : '' }}>40 ODO</option>
                                                    <option value="40" {{ optional($sea_import->container)->size == '40' ? 'selected' : '' }}>40</option>
                                                    <option value="45" {{ optional($sea_import->container)->size == '45' ? 'selected' : '' }}>45</option>

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
                                                    <option value="Y" {{optional($sea_import->container)->refer == 'Y'? 'selected' : ''}}>Y</option>
                                                    <option value="N" {{optional($sea_import->container)->refer == 'N'? 'selected' : ''}}>N</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row row">
                                            <label class="col-sm-3 col-form-label">Detent Date:</label>
                                            <div class="col-sm-9">
                                                <input type="date" name="detent_date" value="{{old('detent_date', $sea_import->container->detent_date ?? '')}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row row">
                                            <label class="col-sm-3 col-form-label">Imo Code:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="imo_code" value="{{old('imo_code', $sea_import->container->imo_code ?? '')}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row row">
                                            <label class="col-sm-3 col-form-label">Disposal:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="disposal" value="{{old('disposal', $sea_import->container->disposal ?? '')}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row row">
                                            <label class="col-sm-3 col-form-label">Sector:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="sector" value="{{old('sector', $sea_import->container->sector ?? '')}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row row">
                                            <label class="col-sm-3 col-form-label">Seal No:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="seal_no" value="{{old('seal_no', $sea_import->container->seal_no ?? '')}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row row">
                                            <label class="col-sm-3 col-form-label">FCL/LCL:</label>
                                            <div class="col-sm-9">
                                                <select class="default-select form-control wide me-2" name="fcl_lcl" placeholder="Select">
                                                    <option value=""></option>
                                                    <option value="FCL" {{optional($sea_import->container)->fcl_lcl == 'FCL'? 'selected' : ''}}>FCL</option>
                                                    <option value="LCL" {{optional($sea_import->container)->fcl_lcl == 'LCL'? 'selected' : ''}}>LCL</option>
                                                    <option value="ETY" {{optional($sea_import->container)->fcl_lcl == 'ETY'? 'selected' : ''}}>ETY</option>
                                                    <option value="AIR" {{optional($sea_import->container)->fcl_lcl == 'AIR'? 'selected' : ''}}>AIR</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row row">
                                            <label class="col-sm-3 col-form-label">Freedays_Cont:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="freedays_cont" value="{{old('freedays_cont', $sea_import->container->freedays_cont ?? '')}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row row">
                                            <label class="col-sm-3 col-form-label">Uno No:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="uno_no" value="{{old('uno_no', $sea_import->container->uno_no ?? '')}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row row">
                                            <label class="col-sm-3 col-form-label">Remarks:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="remarks" value="{{old('remarks', $sea_import->container->remarks ?? '')}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row row">
                                            <label class="col-sm-3 col-form-label">Prev_Days:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="previous_days" value="{{old('previous_days', $sea_import->container->previous_days ?? '')}}" class="form-control">
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

                        <h4>File Upload</h4>
                        <hr>
                        <div class="form-validation">
                            <form class="needs-validation" action="{{route('multi-file-upload.updateFileUpload')}}" method="post" enctype="multipart/form-data">
                                @csrf 
                                <input type="hidden" name="file_related" value="sea_import">
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


    <!-- Add New Vessel Models -->
    <div class="modal fade" id="AddNewVesselModal" tabindex="-1" aria-labelledby="oceanVslModalLabel"
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

    <!-- Add New Port Details -->
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

    <!-- Add new Package Modal -->
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
