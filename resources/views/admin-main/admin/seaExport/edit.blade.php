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
                        <h4 class="card-title">Edit BL</h4>
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
                                                    <input class="form-check-input" type="radio" value="Packinglist"  name="entry_by" {{$sea_export->entry_by == 'Packinglist'? 'checked' : ''}}>
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
                                                <select class="default-select form-control wide me-2" name="job_no" required>
                                                    <option value="">select</option>
                                                    @foreach ($jobNumbers as $jobNumber)
                                                        <option value="{{$jobNumber->id}}" {{$sea_export->job_no == $jobNumber->id? 'selected' : ''}}>{{$jobNumber->job_no}}</option>
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
                                                <select class="default-select form-control wide me-2" name="vessel_id">
                                                    <option value="">select</option>
                                                    @foreach ($vessels as $vessel)
                                                        <option value="{{$vessel->id}}" {{$sea_export->vessel_id == $vessel->id? 'selected' : ''}}>{{$vessel->vessel_name}}</option>
                                                    @endforeach
                                                </select>
                                                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#AddNewVesselModal">
                                                    <i class="bi bi-plus-lg">+</i>
                                                </button>
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
                                                <input type="date" class="form-control" value="{{$sea_export->booking_date}}" name="booking_date">
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
                                                <select class="default-select form-control wide me-2" name="freight">
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
                                                <select class="default-select form-control wide" name="movement">
                                                    <option value="">select</option>
                                                    <option value="CY/CY" {{$sea_export->movement == 'CY/CY'? 'selected' : ''}}>CY/CY</option>
                                                    <option value="CY/CFS" {{$sea_export->movement == 'CY/CFS'? 'selected' : ''}}>CY/CFS</option>
                                                    <option value="CFS/CY" {{$sea_export->movement == 'CFS/CY'? 'selected' : ''}}>CFS/CY</option>
                                                    <option value="CFS/CFS" {{$sea_export->movement == 'CFS/CFS'? 'selected' : ''}}>CFS/CFS</option>
                                                    <option value="CY/DOOR" {{$sea_export->movement == 'CY/DOOR'? 'selected' : ''}}>CY/DOOR</option>
                                                    <option value="DOOR/DOOR" {{$sea_export->movement == 'DOOR/DOOR'? 'selected' : ''}}>DOOR/DOOR</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">ETA Date:</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" value="{{$sea_export->eta_date}}" name="eta_date">
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
                                                <input type="text" class="form-control" value="{{$sea_export->port_cutoff}}" name="port_cutoff">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">DOCUMENT CUTOFF:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" value="{{$sea_export->document_cutoff}}" name="document_cutoff">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">REMARKS:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" value="{{$sea_export->remarks}}" name="remarks">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6">

                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Package:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select name="package_id" class="form-control wide me-2">
                                                    <option value="">select</option>
                                                    @foreach ($packages as $package)
                                                        <option value="{{$package->id}}" {{$sea_export->package_id == $package->id ? 'selected' : ''}}>{{$package->package_code}}</option>
                                                    @endforeach
                                                </select>
                                                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#AddNewPackageModal">
                                                    <i class="bi bi-plus-lg">+</i>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Frt Charges:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" value="{{$sea_export->freight_charges}}" name="freight_charges">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Net Wt:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" value="{{$sea_export->net_weight}}" name="net_weight">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Volume:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="default-select form-control wide me-2" name="volume_unit">
                                                    <option value="">select</option>
                                                    <option value="KGS" {{$sea_export->volume_unit == 'KGS'? 'selected' : ''}}>KGS</option>
                                                    <option value="MTS" {{$sea_export->volume_unit == 'MTS'? 'selected' : ''}}>MTS</option>
                                                    
                                                </select>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Cargo Type:<span class="text-danger">*</span></label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="default-select form-control wide me-2" name="cargo_type" required>
                                                    <option value="">select</option>
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
                                                <input type="date" class="form-control" value="{{$sea_export->etd_date}}" name="etd_date">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">SOB Date:</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" value="{{$sea_export->sob_date}}" name="sob_date">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">SI CUTOFF:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" value="{{$sea_export->si_cutoff}}" name="si_cutoff">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">VGM CUTOFF:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" value="{{$sea_export->vgm_cutoff}}" name="vgm_cutoff">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Overseas Agent Details --}}
                                <div class="row">
                                    <h4>Overseas Agent Details</h4>
                                    <hr>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Agent Name:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="default-select form-control wide me-2" name="overseas_agent_id" placeholder="Select">
                                                    <option value="">select</option>
                                                    @foreach ($parties as $party)
                                                        <option value="{{$party->id}}" {{$sea_export->overseas_agent_id == $party->id ? "selected" : ''}}>{{$party->party_name}}</option>
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
                                                <input type="date" class="form-control" value="{{$sea_export->place_of_acceptance}}" name="place_of_acceptance">
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
                                            <label class="col-sm-3 col-form-label">Shipping:</label>
                                            <div class="col-sm-9">
                                                <select class="default-select form-control wide me-2" name="shipping_line_id" placeholder="Select">
                                                    <option value="">select</option>
                                                    @foreach ($parties as $party)
                                                        <option value="{{$party->id}}" {{$sea_export->shipping_line_id == $party->id ? "selected" : ''}}>{{$party->party_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">BL Issued Date:</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" value="{{$sea_export->bl_issued_date}}" name="bl_issued_date">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">BL Type:</label>
                                            <div class="col-sm-9">
                                                <select class="default-select form-control wide me-2" name="bl_type" placeholder="Select">
                                                   <option value="">select</option>
                                                   <option value="ORIGINAL" {{$sea_export->bl_type == 'ORIGINAL' ? "selected" : ''}}>ORIGINAL</option>
                                                   <option value="SURRENDER" {{$sea_export->bl_type == 'SURRENDER' ? "selected" : ''}}>SURRENDER</option>
                                                   <option value="SEAWAY" {{$sea_export->bl_type == 'SEAWAY' ? "selected" : ''}}>SEAWAY</option>
                                                   <option value="TELEX RELEASE" {{$sea_export->bl_type == 'TELEX RELEASE' ? "selected" : ''}}>TELEX RELEASE</option>
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
                                                <select class="default-select form-control wide me-2" name="sales_person_id" placeholder="Select">
                                                    <option value="">select</option>
                                                    @foreach ($parties as $party)
                                                        <option value="{{$party->id}}" {{$sea_export->sales_person_id == $party->id ? "selected" : ''}}>{{$party->party_name}}</option>
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
                                            <label class="col-sm-3 col-form-label">CHA:<span class="text-danger">*</span></label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="default-select form-control wide me-2" name="cha_id" placeholder="Select">
                                                    <option value="">select</option>
                                                    @foreach ($parties as $party)
                                                        <option value="{{$party->id}}" {{$sea_export->cha_id == $party->id ? "selected" : ''}}>{{$party->party_name}}</option>
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
                                            <label class="col-sm-3 col-form-label">Forwarder:</label>
                                            <div class="col-sm-9">
                                                <select class="default-select form-control wide me-2" name="forwarder_id" placeholder="Select">
                                                    <option value="">select</option>
                                                    @foreach ($parties as $party)
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
                                                <input type="date" class="form-control" value="{{$sea_export->vgm_issued_date}}" name="vgm_issued_date">
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
                                                <select class="default-select form-control wide me-2" name="shipper_id" placeholder="Select">
                                                    <option value="">select</option>
                                                    @foreach ($parties as $party)
                                                        <option value="{{$party->id}}" {{$sea_export->shipper_id == $party->id ? "selected" : ''}}>{{$party->party_name}}</option>
                                                    @endforeach
                                                </select>
                                                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#partyDetailsModal">
                                                    <i class="bi bi-plus-lg">+</i>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Consignee:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="default-select form-control wide me-2" name="consignee_id" placeholder="Select">
                                                    <option value="">select</option>
                                                    @foreach ($parties as $party)
                                                        <option value="{{$party->id}}" {{$sea_export->consignee_id == $party->id ? "selected" : ''}}>{{$party->party_name}}</option>
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
                                            <label class="col-sm-3 col-form-label">Notify:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="default-select form-control wide me-2" name="notify_id" placeholder="Select">
                                                    <option value="">select</option>
                                                    @foreach ($parties as $party)
                                                        <option value="{{$party->id}}" {{$sea_export->notify_id == $party->id ? "selected" : ''}}>{{$party->party_name}}</option>
                                                    @endforeach
                                                </select>
                                                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#partyDetailsModal">
                                                    <i class="bi bi-plus-lg">+</i>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Notify 2:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="default-select form-control wide me-2" name="notify2_id" placeholder="Select">
                                                    <option value="">select</option>
                                                    @foreach ($parties as $party)
                                                        <option value="{{$party->id}}" {{$sea_export->notify2_id == $party->id ? "selected" : ''}}>{{$party->party_name}}</option>
                                                    @endforeach
                                                </select>
                                                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#partyDetailsModal">
                                                    <i class="bi bi-plus-lg">+</i>
                                                </button>
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
                                                <select class="default-select form-control wide me-2" name="port_loading_id" placeholder="Select">
                                                    <option value="">select</option>
                                                    @foreach ($ports as $port)
                                                        <option value="{{$port->id}}" {{$sea_export->port_loading_id == $port->id ? "selected" : ''}}>{{$port->port_name}}</option>
                                                    @endforeach
                                                </select>
                                                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#portDetailsModal">
                                                    <i class="bi bi-plus-lg">+</i>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Discharge Port:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="default-select form-control wide me-2" name="port_discharge_id" placeholder="Select">
                                                    <option value="">select</option>
                                                    @foreach ($ports as $port)
                                                        <option value="{{$port->id}}" {{$sea_export->port_discharge_id == $port->id ? "selected" : ''}}>{{$port->port_name}}</option>
                                                    @endforeach
                                                </select>
                                                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#portDetailsModal">
                                                    <i class="bi bi-plus-lg">+</i>
                                                </button>
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
                                                <select class="default-select form-control wide me-2" name="port_destination_id" placeholder="Select">
                                                    <option value="">select</option>
                                                    @foreach ($ports as $port)
                                                        <option value="{{$port->id}}" {{$sea_export->port_destination_id == $port->id ? "selected" : ''}}>{{$port->port_name}}</option>
                                                    @endforeach
                                                </select>
                                                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#portDetailsModal">
                                                    <i class="bi bi-plus-lg">+</i>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Delivery Port:<span class="text-danger">*</span></label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="default-select form-control wide me-2" name="port_delivery_id" placeholder="Select">
                                                    <option value="">select</option>
                                                    @foreach ($ports as $port)
                                                        <option value="{{$port->id}}" {{$sea_export->port_delivery_id == $port->id ? "selected" : ''}}>{{$port->port_name}}</option>
                                                    @endforeach
                                                </select>
                                                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#portDetailsModal">
                                                    <i class="bi bi-plus-lg">+</i>
                                                </button>
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

                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Shipping Bill:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" value="{{$sea_export->shipping_bill}}" name="shipping_bill">
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
                                                <textarea class="form-control h-100" name="mark_number" rows="2">{{$sea_export->mark_number}}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Goods Description:</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control h-100" name="goods_description" rows="2">{{$sea_export->goods_description}}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Customer Inv No:</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control h-100" name="customer_inv_no" rows="2">{{$sea_export->customer_inv_no}}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Sbill No / Sbill Date:</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control h-100" name="sbill_no" rows="2">{{$sea_export->sbill_no}}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Commodity:</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control h-100" name="commodity" rows="2">{{$sea_export->commodity}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <button class="btn btn-primary btn-sm" type="button">LOADING CONFIRMATION</button>
                                    <button class="btn btn-primary btn-sm" type="button">HBL PRINT</button>
                                    <a href="{{route('sea-exports.index')}}" class="btn btn-warning btn-sm" type="button">Cancel</a>
                                    <button class="btn btn-primary btn-sm" type="submit">Update</button>
                                </div>
                            </form>
                        </div>

                        {{-- Containser Details --}}
                        <hr>
                        <div class="form-validation">
                            <form action="{{ route('sea-exports.updateContainer', $sea_export->container->id ?? '') }}" method="POST" class="needs-validation" novalidate>
                                @csrf
                                @method('PUT')
                                <div class="row">

                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Cont_Hbl:<span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" name="cont_hbl" class="form-control" value="{{ isset($sea_export->container) ? $sea_export->container->cont_hbl : '' }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Gross Weight:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="gross_weight" class="form-control" value="{{ isset($sea_export->container) ? $sea_export->container->gross_weight : '' }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Total Package:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="total_package" class="form-control" value="{{ isset($sea_export->container) ? $sea_export->container->total_package : '' }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Ground Date:</label>
                                            <div class="col-sm-9">
                                                <input type="date" name="ground_date" class="form-control" value="{{ isset($sea_export->container) ? $sea_export->container->ground_date : '' }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Temp:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="temp" class="form-control" value="{{ isset($sea_export->container) ? $sea_export->container->temp : '' }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Remarks:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="remarks" class="form-control" value="{{ isset($sea_export->container) ? $sea_export->container->remarks : '' }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Cont_Job No:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="cont_job_no" class="form-control" value="{{ isset($sea_export->container) ? $sea_export->container->cont_job_no : '' }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Container_No:<span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" name="container_no" class="form-control" value="{{ isset($sea_export->container) ? $sea_export->container->container_no : '' }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">CBM:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="cbm" class="form-control" value="{{ isset($sea_export->container) ? $sea_export->container->cbm : '' }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Cargo Type:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="cargo_type" class="form-control" value="{{ isset($sea_export->container) ? $sea_export->container->cargo_type : '' }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">VGM WT:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="vgm_wt" class="form-control" value="{{ isset($sea_export->container) ? $sea_export->container->vgm_wt : '' }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">SOC(Y/N):</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="soc" class="form-control" value="{{ isset($sea_export->container) ? $sea_export->container->soc : '' }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Commodity:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="commodity" class="form-control" value="{{ isset($sea_export->container) ? $sea_export->container->commodity : '' }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Size:</label>
                                            <div class="col-sm-9">
                                                <select name="size" class="form-control default-select wide me-2">
                                                    <option value="">Select</option>
                                                    <option value="1" {{ optional($sea_export->container)->size == '1' ? 'selected' : '' }}>0</option>
                                                    <option value="20 GP" {{ optional($sea_export->container)->size == '20 GP' ? 'selected' : '' }}>20 GP</option>
                                                    <option value="40 GP" {{ optional($sea_export->container)->size == '40 GP' ? 'selected' : '' }}>40 GP</option>
                                                    <option value="40 HQ" {{ optional($sea_export->container)->size == '40 HQ' ? 'selected' : '' }}>40 HQ</option>
                                                    <option value="20 OT" {{ optional($sea_export->container)->size == '20 OT' ? 'selected' : '' }}>20 OT</option>
                                                    <option value="40 OT" {{ optional($sea_export->container)->size == '40 OT' ? 'selected' : '' }}>40 OT</option>
                                                    <option value="20 FR" {{ optional($sea_export->container)->size == '20 FR' ? 'selected' : '' }}>20 FR</option>
                                                    <option value="40 FR" {{ optional($sea_export->container)->size == '40 FR' ? 'selected' : '' }}>40 FR</option>
                                                    <option value="20 TK" {{ optional($sea_export->container)->size == '20 TK' ? 'selected' : '' }}>20 TK</option>
                                                    <option value="40 TK" {{ optional($sea_export->container)->size == '40 TK' ? 'selected' : '' }}>40 TK</option>
                                                    <option value="20 RF" {{ optional($sea_export->container)->size == '20 RF' ? 'selected' : '' }}>20 RF</option>
                                                    <option value="40 RF" {{ optional($sea_export->container)->size == '40 RF' ? 'selected' : '' }}>40 RF</option>
                                                    <option value="20 ODO" {{ optional($sea_export->container)->size == '20 ODO' ? 'selected' : '' }}>20 ODO</option>
                                                    <option value="40 ODO" {{ optional($sea_export->container)->size == '40 ODO' ? 'selected' : '' }}>40 ODO</option>
                                                    <option value="40" {{ optional($sea_export->container)->size == '40' ? 'selected' : '' }}>40</option>
                                                    <option value="45" {{ optional($sea_export->container)->size == '45' ? 'selected' : '' }}>45</option>
                                                </select>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Refer(Y/N):</label>
                                            <div class="col-sm-9">
                                                <select name="refer" class="form-control default-select wide me-2">
                                                    <option value="">Select</option>
                                                    <option value="Y" {{ optional($sea_export->container)->refer == 'Y' ? 'selected' : '' }}>Y</option>
                                                    <option value="N" {{ optional($sea_export->container)->refer == 'N' ? 'selected' : '' }}>N</option>                    
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Agent Seal No:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="agent_seal_no" class="form-control" value="{{ isset($sea_export->container) ? $sea_export->container->agent_seal_no : '' }}" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Imo Code:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="imo_code" class="form-control" value="{{ isset($sea_export->container) ? $sea_export->container->imo_code : '' }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Disposal:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="disposal" class="form-control" value="{{ isset($sea_export->container) ? $sea_export->container->disposal : '' }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Sector:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="sector" class="form-control" value="{{ isset($sea_export->container) ? $sea_export->container->sector : '' }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Cust_Seal No:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="cust_seal_no" class="form-control" value="{{ isset($sea_export->container) ? $sea_export->container->cust_seal_no : '' }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">FCL/LCL:</label>
                                            <div class="col-sm-9">
                                                <select name="fcl_lcl" class="form-control default-select wide me-2">
                                                    <option value="">Select</option>
                                                    <option value="FCL" {{ optional($sea_export->container)->fcl_lcl == 'FCL' ? 'selected' : '' }}>FCL</option>
                                                    <option value="LCL" {{ optional($sea_export->container)->fcl_lcl == 'LCL' ? 'selected' : '' }}>LCL</option>
                                                    <option value="ETY" {{ optional($sea_export->container)->fcl_lcl == 'ETY' ? 'selected' : '' }}>ETY</option>
                                                    <option value="AIR" {{ optional($sea_export->container)->fcl_lcl == 'AIR' ? 'selected' : '' }}>AIR</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Net Weight:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="net_weight" class="form-control" value="{{ isset($sea_export->container) ? $sea_export->container->net_weight : '' }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Uno No:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="uno_no" class="form-control" value="{{ isset($sea_export->container) ? $sea_export->container->uno_no : '' }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Detent Date:</label>
                                            <div class="col-sm-9">
                                                <input type="date" name="detent_date" class="form-control" value="{{ isset($sea_export->container) ? $sea_export->container->detent_date : '' }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Prev_Days:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="prev_days" class="form-control" value="{{ isset($sea_export->container) ? $sea_export->container->prev_days : '' }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
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
                                <input type="hidden" name="file_related" value="sea_export">
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
