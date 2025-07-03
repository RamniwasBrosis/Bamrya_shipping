@extends('admin-main.layouts.default')
@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="#">Import BL</a></li>
        </ol>
        <a href="{{ url('admin/sea-imports') }}" class="text-primary"><- Go Back</a>
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
                        <h4 class="card-title">Add New BL</h4>
                    </div><br>
                    <div class="card-body">
                        <form action="{{ route('sea-imports.store') }}" method="POST" class="needs-validation" novalidate>
                            @csrf
                            <div class="row form-material">
                                <div class="mb-3 row col-xl-3 col-xxl-12 col-xl-6 row">
                                    <label class="col-sm-3 col-form-label">BL Issued By:</label>
                                    <div class="col-sm-9">
                                        <div class="d-flex gap-3">

                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" value="1" checked name="bl_issue_by">
                                                <label class="form-check-label" for="lcl">
                                                    Forwarder
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" value="2" id="fcl20" name="bl_issue_by">
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
                                                <select name="job_no" class="form-control wide me-2" id="job_numbers">
                                                    <option value="">select</option>
                                                    @foreach ($job_numbers as $job_number)
                                                        <option value="{{$job_number->id}}">{{$job_number->job_no}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>    
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">MBL No:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="mbl_no" name="" value="{{old('')}}" class="form-control">
                                            </div>
                                        </div>                                    
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">HBL No:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="hbl_no" name="" value="{{old('')}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">IGM No:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="igm_no" name="" value="{{old('')}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Item No:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="item_no" name="" value="{{old('')}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Voy. No:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="voyage_no" name="" value="{{old('')}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Enquiry Reference No:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="enquiry_reference_no" name="" value="{{old('')}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">ETA Date:</label>
                                            <div class="col-sm-9">
                                                <input type="date" name="eta_date" name="" value="{{old('')}}" class="form-control">
                                            </div>
                                        </div>
            
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Cargo(Cust):</label>
                                            <div class="col-sm-9">
                                                <select name="cargo_type" class="default-select form-control wide me-2">
                                                    <option value="">select</option>
                                                    <option value="FCL">FCL</option>
                                                    <option value="LCL">LCL</option>
                                                    <option value="ETY">ETY</option>
                                                    <option value="AIR">AIR</option>
                                
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">MBL Date:</label>
                                            <div class="col-sm-9">
                                                <input type="date" name="mbl_date" name="" value="{{old('')}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">HBL Date:</label>
                                            <div class="col-sm-9">
                                                <input type="date" name="hbl_date" name="" value="{{old('')}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">IGM Date:</label>
                                            <div class="col-sm-9">
                                                <input type="date" name="igm_date" name="" value="{{old('')}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Sub Item No:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="item_no" name="" value="{{old('')}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Arrival Date:</label>
                                            <div class="col-sm-9">
                                                <input type="date" name="arrival_date" name="" value="{{old('')}}" class="form-control">
                                            </div>
                                        </div>
                        
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Vessel Name:</label>
                                            <div class="col-sm-9">
                                                <select name="vessel_id" class="default-select form-control wide me-2">
                                                    <option value="">select</option>
                                                    @foreach ($vessels as $vessel)
                                                        <option value="{{$vessel->id}}">{{$vessel->vessel_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">ETD Date:</label>
                                            <div class="col-sm-9">
                                                <input type="date" name="etd_date" name="" value="{{old('')}}" class="form-control">
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
                                                <input type="text" name="quantity" name="" value="{{old('')}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Freight:</label>
                                            <div class="col-sm-9">
                                                <select name="freight" class="default-select form-control wide me-2">
                                                    <option value="">select</option>
                                                    <option value="P">P</option>
                                                    <option value="C">C</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">CBM:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="cbm" name="" value="{{old('')}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Material:</label>
                                            <div class="col-sm-9 d-flex align-items-center gap-3">
                                                <div class="form-check">
                                                    <input type="radio" name="is_hazardous" value="1" class="form-check-input">
                                                    <label class="form-check-label">HAZ</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" name="is_hazardous" value="0" checked class="form-check-input">
                                                    <label class="form-check-label">NON-HAZ</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">IMO CD:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="imo_cd" name="" value="{{old('')}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">FreeDays:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="free_days" name="" value="{{old('')}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Insurance:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="insurance" name="" value="{{old('')}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Transportation:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="transportation" name="" value="{{old('')}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Clearance:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="clearance" name="" value="{{old('')}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Delivery Order:</label>
                                            <div class="col-sm-9">
                                                <input type="date" name="delivery_order_date" name="" value="{{old('')}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Package:</label>
                                            <div class="col-sm-9">
                                                <select name="package_id" class="form-control wide me-2">
                                                    <option value="">select</option>
                                                    @foreach ($packages as $packages)
                                                        <option value="{{$packages->id}}">{{$packages->package_code}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Gross Wt:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="gross_weight" name="" value="{{old('')}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Cargo:</label>
                                            <div class="col-sm-9">
                                                <select name="cargo" class="default-select form-control wide me-2">
                                                    <option value="">select</option>
                                                    <option value="LOCAL">LOCAL</option>
                                                    <option value="SMTP">SMTP</option>
                                                    <option value="TP">TP</option>
                                                    <option value="UB">UB</option>
                                                    <option value="GOVT">GOVT</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Del. Type:</label>
                                            <div class="col-sm-9">
                                                <select name="delivery_type" class="default-select form-control wide me-2">
                                                    <option value="">select</option>
                                                    <option value="F">FACTORY</option>
                                                    <option value="D">DOCK</option>
                                                    <option value="L">LCL</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">UNO CD:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="uno_cd" name="" value="{{old('')}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">HBLType:</label>
                                            <div class="col-sm-9">
                                                <select name="hbl_type" class="default-select form-control wide me-2">
                                                    <option value="">select</option>
                                                    <option value="SUR">SURRENDER</option>
                                                    <option value="ORI">ORIGINAL</option>
                                                    <option value="SEA">SEAWAY</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">F.Premium.Amt:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="fpa_amount" name="" value="{{old('')}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Transportation Details:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="transportation_details" name="" value="{{old('')}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Bill of Entry:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="bill_of_entry" name="" value="{{old('')}}" class="form-control">
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
                                                        <option value="{{$port->id}}">{{$port->port_name}}</option>
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
                                                        <option value="{{$port->id}}">{{$port->port_name}}</option>
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
                                                        <option value="{{$party->id}}">{{$party->party_name}}</option>
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
                                                        <option value="{{$party->id}}">{{$party->party_name}}</option>
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
                                                        <option value="{{$party->id}}">{{$party->party_name}}</option>
                                                    @endforeach
                                                </select>
                                                <button type="button" class="btn btn-sm btn-outline-primary"
                                                     data-bs-toggle="modal" data-bs-target="#salespersonModal">
                                                    <i class="bi bi-plus-lg">+</i>
                                                </button>
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
                                                        <option value="{{$port->id}}">{{$port->port_name}}</option>
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
                                                        <option value="{{$port->id}}">{{$port->port_name}}</option>
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
                                                        <option value="{{$party->id}}">{{$party->party_name}}</option>
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
                                                        <option value="{{$party->id}}">{{$party->party_name}}</option>
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
                                                        <option value="{{$party->id}}">{{$party->party_name}}</option>
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
                                                <select name="shipper_id" id="shipper_id" class="form-control wide me-2">
                                                    <option value="">select</option>
                                                    @foreach ($parties as $party)
                                                        <option value="{{$party->id}}">{{$party->party_name}}</option>
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
                                                        <option value="{{$party->id}}">{{$party->party_name}}</option>
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
                                                        <option value="{{$party->id}}">{{$party->party_name}}</option>
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
                                                        <option value="{{$party->id}}">{{$party->party_name}}</option>
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
                                                <textarea name="mark_and_numbers" class="form-control h-100" rows="2"></textarea>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Sub Job No:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="sub_job_no" value="{{old('')}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Obl No:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="obl_no" name="" value="{{old('')}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Ref. No/BOE:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="ref_no" name="" value="{{old('')}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-xxl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Goods Description:</label>
                                            <div class="col-sm-9">
                                                <textarea name="goods_description" class="form-control h-100" rows="2"></textarea>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Surveyor:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select name="surveyor_id" class="default-select form-control wide me-2">
                                                    <option value="">select</option>
                                                    @foreach ($parties as $party)
                                                        <option value="{{$party->id}}">{{$party->party_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Obl Date:</label>
                                            <div class="col-sm-9">
                                                <input type="date" name="obl_date" name="" value="{{old('')}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Do Date:</label>
                                            <div class="col-sm-9">
                                                <input type="date" name="do_date" name="" value="{{old('')}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Validity Date:</label>
                                            <div class="col-sm-9">
                                                <input type="date" name="validity_date" name="" value="{{old('')}}" class="form-control">
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
                                                <input type="text" name="remarks" name="" value="{{old('')}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">User Name:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="username" name="" value="{{old('')}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Prealert Date:</label>
                                            <div class="col-sm-9">
                                                <input type="date" name="prealert_date" name="" value="{{old('')}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Inv No Full:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="inv_no_full" name="" value="{{old('')}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <button class="btn btn-success btn-sm" type="button">CARGO ARRIVAL NOTICE</button>
                                    <button class="btn btn-warning btn-sm" type="button">Cancel</button>
                                    <button class="btn btn-success btn-sm" type="button">Print</button>
                                    <button class="btn btn-primary btn-sm" type="submit">Save</button>
                                </div>
                            </div>
                        </form>


                        <hr>
                        <div class="form-validation">
                            <form class="needs-validation" method="POST" action="{{route('sea-imports.addContainer')}}">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="mb-3 row row">
                                            <label class="col-sm-3 col-form-label">Sea Import ID :<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <select class="default-select form-control wide me-2" name="sea_import_id" placeholder="Select">
                                                    <option value="">select</option>
                                                    @foreach ($sea_imports as $sea_import)
                                                        <option value="{{$sea_import->id}}">{{$sea_import->id}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row row">
                                            <label class="col-sm-3 col-form-label">Cont_Hbl:<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" name="cont_hbl" value="{{old('cont_hbl')}}" class="form-control" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row row">
                                            <label class="col-sm-3 col-form-label">Gross Weight:<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" name="gross_weight" value="{{old('gross_weight')}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row row">
                                            <label class="col-sm-3 col-form-label">Total Package:<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" name="total_package" value="{{old('total_package')}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row row">
                                            <label class="col-sm-3 col-form-label">Ground Date:</label>
                                            <div class="col-sm-9">
                                                <input type="date" name="ground_date" value="{{old('ground_date')}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row row">
                                            <label class="col-sm-3 col-form-label">TP/ICD(T/I):</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="tp_icd" value="{{old('tp_icd')}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row row">
                                            <label class="col-sm-3 col-form-label">Printed:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="printed" value="{{old('printed')}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row row">
                                            <label class="col-sm-3 col-form-label">Container No:<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" name="container_no" value="{{old('container_no')}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row row">
                                            <label class="col-sm-3 col-form-label">CBM:<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" name="cbm" value="{{old('cbm')}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row row">
                                            <label class="col-sm-3 col-form-label">Cargo Type:</label>
                                            <div class="col-sm-9">
                                                <select class="default-select form-control wide me-2" name="cargo_type" placeholder="Select">
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
                                                <input type="text" name="ground_days" value="{{old('ground_days')}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row row">
                                            <label class="col-sm-3 col-form-label">SOC(Y/N):</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="soc_yn" value="{{old('soc_yn')}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row row">
                                            <label class="col-sm-3 col-form-label">Selected:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="selected" value="{{old('selected')}}" class="form-control">
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
                                                <select class="default-select form-control wide me-2" name="refer" placeholder="Select">
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
                                                <input type="date" name="detent_date" value="{{old('detent_date')}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row row">
                                            <label class="col-sm-3 col-form-label">Imo Code:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="imo_code" value="{{old('imo_code')}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row row">
                                            <label class="col-sm-3 col-form-label">Disposal:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="disposal" value="{{old('disposal')}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row row">
                                            <label class="col-sm-3 col-form-label">Sector:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="sector" value="{{old('sector')}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row row">
                                            <label class="col-sm-3 col-form-label">Seal No:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="seal_no" value="{{old('seal_no')}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row row">
                                            <label class="col-sm-3 col-form-label">FCL/LCL:</label>
                                            <div class="col-sm-9">
                                                <select class="default-select form-control wide me-2" name="fcl_lcl" placeholder="Select">
                                                    <option value=""></option>
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
                                                <input type="text" name="freedays_cont" value="{{old('freedays_cont')}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row row">
                                            <label class="col-sm-3 col-form-label">Uno No:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="uno_no" value="{{old('uno_no')}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row row">
                                            <label class="col-sm-3 col-form-label">Remarks:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="remarks" value="{{old('remarks')}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row row">
                                            <label class="col-sm-3 col-form-label">Prev_Days:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="previous_days" value="{{old('previous_days')}}" class="form-control">
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
                            <form id="SeaImportFormData" method="post"> 
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
                    <form id="oceanVslForm" method="post" action="{{route('new-package.store')}}">
                        @csrf
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Package Code:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name='package_code'>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Description:</label>
                            <div class="col-sm-8">
                                <textarea class="form-control h-100" id="validationCustom04" rows="2" name='description'></textarea>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Status:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <select class="default-select  form-control wide" name='status' >
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
        document.getElementById('SeaImportFormData').addEventListener('submit', function(e) {
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
        
        $('#job_numbers').on('change', function (e) {
            e.preventDefault();
            var selectNumber = $(this).val();
            alert(selectNumber);
            if (selectNumber) {
                $.ajax({
                    url: '/get-job-details', // Update this URL based on your route
                    method: 'POST',
                    data: {
                        job_id: selectNumber,
                        _token: $('meta[name="csrf-token"]').attr('content') // CSRF token for Laravel
                    },
                    success: function (response) {
                        console.log(response);
                        // 1. Set the value
                        $('#shipper_id').val(response.job_party_id);
        
                        // 2. Trigger change for select2 or other plugin to update UI
                        $('#shipper_id').trigger('change');
        
                        // 3. If you're using Bootstrap Select
                        if ($('#shipper_id').hasClass('selectpicker')) {
                            $('#shipper_id').selectpicker('refresh');
                        }
                        $('#shipper_id').css('border', '1px solid green');
                        
                    },
                    error: function (xhr) {
                        console.log(xhr.responseText);
                    }
                });
            }
        });
        
        
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
