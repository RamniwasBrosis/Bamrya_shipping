@extends('admin-main.layouts.default')
@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="#">Export BL</a></li>
        </ol>
        <a href="{{ url('admin/export-bl-entry') }}" class="text-primary"><- Go Back</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('export_bl_id'))
        <div class="alert alert-success">export Bl ID:  {{ session('export_bl_id') }}</div>
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
                    <div class="card-body">
                        <div class="form-validation">
                            <form class="needs-validation" novalidate action="{{ route('export-bl-entry.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="main_details" value="1"> 
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Entry By:</label>
                                    <div class="col-sm-9">
                                        <div class="d-flex gap-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="entryType" value="0"
                                                    id="lcl">
                                                <label class="form-check-label" for="lcl" >
                                                    Packinglist     
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="entryType" value="1"
                                                    id="fcl20" checked>
                                                <label class="form-check-label" for="fcl20">
                                                    Nominated 
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h4>General Details</h4>
                                <hr>
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Job No:<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <select class="default-select form-control wide me-2"
                                                    placeholder="Select" name="job_no">
                                                    <option value="">select</option>
                                                    @foreach ($job_masters as $job_master)
                                                        <option value="{{$job_master->id}}">{{$job_master->job_no}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Booking No:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control"  name="booking_no">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Ocean_Vsl:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="default-select form-control wide me-2"
                                                    placeholder="Select" name="vessel_id">

                                                    <option value="">select</option>
                                                    @foreach ($vessels as $vessel)
                                                        <option value="{{$vessel->id}}">{{$vessel->vessel_name}}</option>
                                                    @endforeach
                                                </select>
                                                <button type="button" class="btn btn-sm btn-outline-primary"
                                                    data-bs-toggle="modal" data-bs-target="#AddNewVesselModal">
                                                    <i class="bi bi-plus-lg">+</i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">MBL No:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="mbl_no">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Enquiry Reference No:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="enquiry_ref_no">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Full Job No:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="full_job_no">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Booking Date:</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" name="booking_date">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Voy_No:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="voyage_no">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">HBL No:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="hbl_no" placeholder="HBL Date">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <h4>Cargo Deails</h4>
                                <hr>
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Quantity:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="quantity">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Freight:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="default-select form-control wide me-2"
                                                    placeholder="Select" name="freight">
                                                    <option value="">select</option>
                                                    <option value="prepaid">Prepaid</option>
                                                    <option value="collect">Collect</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Gross_Wt:<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="gross_wt">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Tare_Wt:<span
                                            class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="tare_wt">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Movement:</label>
                                            <div class="col-sm-9">
                                                <select class="default-select form-control wide me-2"
                                                    placeholder="Select" name="movement">
                                                    <option value="">select</option>
                                                    <option value="CY/CY">CY/CY</option>
                                                    <option value="CY/CFS">CY/CFS</option>
                                                    <option value="CFS/CY">CFS/CY</option>
                                                    <option value="CFS/CFS">CFS/CFS</option>
                                                    <option value="CY/DOOR">CY/DOOR</option>
                                                    <option value="DOOR/DOOR">DOOR/DOOR</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">ETA_Date:</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" name="eta_date">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">CBM:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="cbm">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">PORT CUTOFF:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="port_cutoff">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">DOCUMENT CUTOFF:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="document_cutoff">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">REMARKS:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="remarks">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Package:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="default-select form-control wide me-2"
                                                    placeholder="Select" name="package_type_id">
                                                    <option value="">select</option>
                                                    <option value="1">CARTON</option>
                                                    <option value="2">PALLET</option>
                                                </select>
                                                <button type="button" class="btn btn-sm btn-outline-primary"
                                                    data-bs-toggle="modal" data-bs-target="#AddNewPackageModal">
                                                    <i class="bi bi-plus-lg">+</i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Frt_charges:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="freight_charges">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Net_Wt:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="net_wt">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Volume:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="default-select form-control wide me-2"
                                                    placeholder="Select" name="volume">
                                                    <option value="">select</option>
                                                    <option value="KGS">KGS</option>
                                                    <option value="MTS">MTS</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Cargo_Type:<span
                                            class="text-danger">*</span></label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="default-select form-control wide me-2"
                                                    placeholder="Select" name="cargo_type">
                                                    <option value="">select</option>
                                                    <option value="FCL/FCL">FCL/FCL</option>
                                                    <option value="FCL/LCL">FCL/LCL</option>
                                                    <option value="LCL/FCL">LCL/FCL</option>
                                                    <option value="LCL/LCL">LCL/LCL</option>
                                                    <option value="PART OF FCL">PART OF FCL</option>
                                                
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">ETD Date:<span
                                            class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" name="etd_date">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">SOB_Dt:</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" name="sob_dt">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">SI CUTOFF:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="si_cutoff">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">VGM CUTOFF:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="vgm_cutoff">
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <h4>Overseas Agent Details</h4>
                                <hr>
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Agent_Nm:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="default-select form-control wide me-2"
                                                    placeholder="Select" name="overseas_agent_id">
                                                    <option value="">select</option>
                                                    @foreach ($parties as $partie)
                                                        <option value="{{$partie->id}}">{{$partie->party_name}}</option>
                                                    @endforeach
                                                </select>
                                                <button type="button" class="btn btn-sm btn-outline-primary"
                                                    data-bs-toggle="modal" data-bs-target="#partyDetailsModal">
                                                    <i class="bi bi-plus-lg">+</i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Issue Place:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <input type="text" class="form-control" name="issue_place">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Place Of Acceptance:<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="place_of_acceptance">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Stuffing Point:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="stuffing_point">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Shipping:</label>
                                            <div class="col-sm-9">
                                                <select class="default-select form-control wide me-2"
                                                    placeholder="Select" name="shipping_line_id">
                                                    <option value="">select</option>
                                                    @foreach ($parties as $partie)
                                                        <option value="{{$partie->id}}">{{$partie->party_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">BL Issued Date:</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" name="bl_issued_date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">BL_Type:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="default-select form-control wide me-2"
                                                    placeholder="Select" name="bl_type">
                                                    <option value="">select</option>
                                                    <option value="1">ORIGINAL</option>
                                                    <option value="2">SURRENDER</option>
                                                    <option value="3">SEAWAY</option>
                                                    <option value="4">TELEX RELEASE</option>                                                
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">No Of Origin:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="no_of_origin">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Sales_Person:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="default-select form-control wide me-2"
                                                    placeholder="Select" name="sales_person_id">
                                                    <option value="">select</option>
                                                    @foreach ($parties as $partie)
                                                        <option value="{{$partie->id}}">{{$partie->party_name}}</option>
                                                    @endforeach
                                                </select>
                                                    <button type="button" class="btn btn-sm btn-outline-primary"
                                                    data-bs-toggle="modal" data-bs-target="#partyDetailsModal">
                                                    <i class="bi bi-plus-lg">+</i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">CHA:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="default-select form-control wide me-2"
                                                    placeholder="Select" name="cha_id">
                                                    <option value="">select</option>
                                                    @foreach ($parties as $partie)
                                                        <option value="{{$partie->id}}">{{$partie->party_name}}</option>
                                                    @endforeach
                                                </select>
                                                    <button type="button" class="btn btn-sm btn-outline-primary"
                                                    data-bs-toggle="modal" data-bs-target="#partyDetailsModal">
                                                    <i class="bi bi-plus-lg">+</i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Forwarder:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="default-select form-control wide me-2"
                                                    placeholder="Select" name="forwarder_id">
                                                    <option value="">select</option>
                                                    @foreach ($parties as $partie)
                                                        <option value="{{$partie->id}}">{{$partie->party_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">VGM Issued Date:</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" name="vgm_issued_date">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <h4>Party Details</h4>
                                <hr>
                                <div class="row">
                                    <div class="col-xl-6 col-xxl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">SHIPPER:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="default-select form-control wide me-2"
                                                    placeholder="Select" name="shipper_id">
                                                    <option value="">select</option>
                                                    @foreach ($parties as $partie)
                                                        <option value="{{$partie->id}}">{{$partie->party_name}}</option>
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
                                                    @foreach ($parties as $partie)
                                                        <option value="{{$partie->id}}">{{$partie->party_name}}</option>
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
                                            <label class="col-sm-3 col-form-label">Notify:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="default-select form-control wide me-2"
                                                    placeholder="Select" name="notify_id">
                                                    <option value="">select</option>
                                                    @foreach ($parties as $partie)
                                                        <option value="{{$partie->id}}">{{$partie->party_name}}</option>
                                                    @endforeach
                                                </select>
                                                <button type="button" class="btn btn-sm btn-outline-primary"
                                                    data-bs-toggle="modal" data-bs-target="#partyDetailsModal">
                                                    <i class="bi bi-plus-lg">+</i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Notify 2:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="default-select form-control wide me-2"
                                                    placeholder="Select" name="notify2_id">
                                                    <option value="">select</option>
                                                    @foreach ($parties as $partie)
                                                        <option value="{{$partie->id}}">{{$partie->party_name}}</option>
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

                                <h4>Port Details</h4>
                                <hr>
                                <div class="row">
                                    <div class="col-xl-6 col-xxl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Loading Port:<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="default-select form-control wide me-2"
                                                    placeholder="Select" name="loading_port_id">
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
                                            <label class="col-sm-3 col-form-label">Discharge Port:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="default-select form-control wide me-2"
                                                    placeholder="Select" name="discharge_port_id">
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
                                            <label class="col-sm-3 col-form-label">Insurance:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <input type="text" class="form-control" name="insurance">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">F.Premium.Amt:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <input type="text" class="form-control" name="fpa_amount">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Transportation:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <input type="text" class="form-control" name="transportation">
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
                                            <label class="col-sm-3 col-form-label">Delivery Port:<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="default-select form-control wide me-2"
                                                    placeholder="Select" name="delivery_port_id">
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
                                            <label class="col-sm-3 col-form-label">Transportation Details:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <input type="text" class="form-control" name="transportation_details">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Clearance:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <input type="text" class="form-control" name="clearance">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Shipping Bill:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <input type="text" class="form-control" name="shipping_bill">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <h4>Other Details</h4>
                                <hr>
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Mark & Numbers:</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control h-100" id="validationCustom04" rows="2"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Goods description:</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control h-100" id="validationCustom04" rows="2"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Customer Inv No:</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control h-100" id="validationCustom04" rows="2"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Sbill No/Sbill Date:</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control h-100" id="validationCustom04" rows="2"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Commodity:</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control h-100" id="validationCustom04" rows="2"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <button class="btn btn-primary btn-sm" type="button">LOADING CONFIRMATION</button>
                                    <button class="btn btn-primary btn-sm" type="button">HBL PRINT</button>
                                    <a href="{{route('export-bl-entry.index')}}" class="btn btn-warning btn-sm" type="button">Cancel </a>
                                    <button class="btn btn-primary btn-sm" type="submit">Save</button>
                                </div>
                            </form>
                        </div>
                        

                        <hr>
                        <div class="form-validation">
                            <form class="needs-validation" novalidate action="{{ route('export-bl-entry.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="other_details" value="2">
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Booking No:</label>
                                            <div class="col-sm-9">
                                                <select name="booking_no" class="default-select form-control wide me-2">
                                                    <option value="">select</option>
                                                    @foreach ($booking_nums as $booking_num)
                                                        <option value="{{$booking_num->booking_no}}">{{$booking_num->booking_no}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Cont_Hbl:<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" disabled style="cursor: not-allowed" class="form-control" name="cont_hbl">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Gross Weight:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="gross_weight">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Total Package:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="total_package">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Ground Date:</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" name="ground_date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Temp:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="temperature">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Remarks:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="remarks">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Cont_Job No:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="cont_job_no">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Container_No:<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="container_no">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">CBM:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="cbm">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Cargo Type:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="cargo_type">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">VGM WT:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="vgm_weight">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">SOC(Y/N):</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="soc">
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
                                            <label class="col-sm-3 col-form-label">Size:</label>
                                            <div class="col-sm-9">
                                                <select class="default-select form-control wide me-2" name="size">
                                                    <option value="">select</option>
                                                    <option value="0">0</option>
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
                                                    <option value="40 Rf">40 Rf</option>
                                                    <option value="20 ODO">20 ODO</option>
                                                    <option value="40 ODO">40 ODO</option>
                                                    <option value="40">40</option>
                                                    <option value="45">45</option>                                                
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Refer(Y/N):</label>
                                            <div class="col-sm-9">
                                                <select class="default-select form-control wide me-2" name="refer"></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Agent Seal No:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="agent_seal_no">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Imo Code:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="imo_code">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Disposal:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="disposal">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Sector:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="sector">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Cust_Seal No:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="cust_seal_no">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">FCL/LCL:</label>
                                            <div class="col-sm-9">
                                                <select class="default-select form-control wide me-2"
                                                    placeholder="Select" name="fcl_lcl"></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Net Weight:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="net_weight">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Uno No:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="uno_no">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Detent Date:</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" name="detention_date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Prev_Days:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="previous_days">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <button class="btn btn-primary" type="submit">Add CONTAINER</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <h4>File Upload</h4>
                        <hr>
                        <div class="form-validation">
                            <form class="needs-validation" action="{{route('multi-file-upload.updateFileUpload')}}" method="post" enctype="multipart/form-data">
                                @csrf 
                                <input type="hidden" name="file_related" value="exort_bl_data_ent">
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
                            <form id="ExportBlFileForm" method="post"> 
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
                                <input type="text" class="form-control" name="">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Vessel Call Sign:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">IMO Code:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="">
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
                                <input type="text" class="form-control" name="">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Port Name:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">EDI Code:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">JNPT Code:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">NSICT Code:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">NSICT GROUP Code:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">GTI Code:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">GTI GROUP Code:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">NSI GT Code:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="">
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
                                <input type="text" class="form-control" name="">
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
                                <input type="text" class="form-control" name="">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Party Name:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Address Line 1:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Address Line 2:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Address Line 3:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Address Line 4:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">City:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Pincode:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="">
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
                                <input type="text" class="form-control" name="">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Tel / Contact No:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Email:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">GSTIN NO:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">PAN No:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">CIN No:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Credit Days:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">TDS %:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="">
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
        document.getElementById('ExportBlFileForm').addEventListener('submit', function(e) {
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
