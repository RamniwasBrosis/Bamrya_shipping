@extends('admin-main.layouts.default')
@section('content')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="#">Edit Enquiry</a></li>
        </ol>
        <a href="{{ url('admin/Enquiry') }}" class="text-primary"><- Go Back</a>
    </div>
    <div class="container-fluid p-2">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-validation">
                            <form class="needs-validation" action="{{ route('Enquiry.update', $enquiry->id) }}" method="Post">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="enquiry_id" class="enquiry_id">
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Enquiry No:<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="enquiry_no" value="{{$enquiry->enquiry_no}}" readonly>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Reference ID:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" value="{{$enquiry->reference_id}}" name="reference_id">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Job Activity:<span
                                                class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <select class="select2 form-control wide" name="job_activity">
                                                    <option value="">Select</option>
                                                    <option value="SEAIMP.FWD" @if($enquiry?->job_activity == 'SEAIMP.FWD') selected @endif>SEAIMP.FWD</option>
    
                                                    <option value="SEAEXP.FWD" @if($enquiry?->job_activity == 'SEAEXP.FWD') selected @endif>SEAEXP.FWD</option>
    
                                                    <option value="AIRIMP.FWD" @if($enquiry?->job_activity == 'AIRIMP.FWD') selected @endif>AIRIMP.FWD</option>
    
                                                    <option value="AIREXP.FWD" @if($enquiry?->job_activity == 'AIREXP.FWD') selected @endif>AIREXP.FWD</option>
    
                                                    <option value="SEAIMP.NVOCC" @if($enquiry?->job_activity == 'SEAIMP.NVOCC') selected @endif>SEAIMP.NVOCC</option>

                                                    <option value="SEAEXP.NVOCC" @if($enquiry?->job_activity == 'SEAEXP.NVOCC') selected @endif>SEAEXP.NVOCC</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Port of Discharge:<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="form-control select2 wide me-2" placeholder="Select" name="discharge_port_id">
                                                    <option value="">Select Discharge Port</option>
                                                    @foreach ($ports as $port)
                                                    <option value="{{$port->id}}" {{$port->id == $enquiry->discharge_port_id? 'selected' : ''}}>{{$port->port_name}}</option>
                                                    @endforeach
                                                </select>
                                                <button type="button" class="btn btn-sm btn-outline-primary"
                                                    data-target-select="discharge_port_id"
                                                    data-bs-toggle="modal" data-bs-target="#addNewPortDetails">
                                                    <i class="bi bi-plus-lg">+</i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Consignee:<span class="text-danger">*</span></label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="form-control wide me-2 select2" name="consignee_id" id="consignee_id">
                                                    <option value="">Select Consignee</option>
                                                    @foreach ($parties->where('party_type', 1) as $party)
                                                        <option value="{{$party->id}}" {{$party->id == $enquiry->consignee_id? 'selected' : ''}}>{{$party->party_name}}</option>
                                                    @endforeach
                                                </select>
                                                <button type="button" class="btn btn-sm btn-outline-primary"
                                                    data-bs-toggle="modal" data-bs-target="#partyDetailsModal"
                                                    data-target-field="consignee_id">
                                                    <i class="bi bi-plus-lg">+</i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Inco Terms:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="select2 form-control wide me-2" name="inco_terms" placeholder="Select">
                                                    <option value="">Select Inco Terms</option>
                                                    <option value="EXW (Ex Works)" {{$enquiry->inco_terms == 'EXW (Ex Works)' ? 'selected' : ''}}>EXW (Ex Works)</option>
                                                    <option value="FOB" {{$enquiry->inco_terms == 'FOB' ? 'selected' : ''}}>FOB</option>
                                                    <option value="C&F" {{$enquiry->inco_terms == 'C&F' ? 'selected' : ''}}>C&F</option>
                                                    <option value="CIF" {{$enquiry->inco_terms == 'CIF' ? 'selected' : ''}}>CIF</option>
                                                    <option value="FCA (Free Carrier)" {{$enquiry->inco_terms == 'FCA (Free Carrier)' ? 'selected' : ''}}>FCA (Free Carrier)</option>
                                                    <option value="CPT (Carriage Paid To)" {{$enquiry->inco_terms == 'CPT (Carriage Paid To)' ? 'selected' : ''}}>CPT (Carriage Paid To)</option>
                                                    <option value="CIP (Carriage and Insurance Paid To)" {{$enquiry->inco_terms == 'CIP (Carriage and Insurance Paid To)' ? 'selected' : ''}}>CIP (Carriage and Insurance Paid To)</option>
                                                    <option value="DAP (Delivered at Place)" {{$enquiry->inco_terms == 'DAP (Delivered at Place)' ? 'selected' : ''}}>DAP (Delivered at Place)</option>
                                                    <option value="DPU (Delivered at Place Unloaded)" {{$enquiry->inco_terms == 'DPU (Delivered at Place Unloaded)' ? 'selected' : ''}}>DPU (Delivered at Place Unloaded)</option>
                                                    <option value="DDP (Delivered Duty Paid)" {{$enquiry->inco_terms == 'DDP (Delivered Duty Paid)'? 'selected' : ''}}>DDP (Delivered Duty Paid)</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Gross Weight:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="gross_weight" value="{{$enquiry->gross_weight}}">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Buying Rate:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="buying_rate" value="{{$enquiry->buying_rate}}">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Shipment Type:<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="select2 form-control wide me-2" placeholder="Select" name="shipment_type">
                                                    <option value="{{$enquiry->shipment_type}}" {{$enquiry->shipment_type == 1? 'selected' : ''}}>Total</option>
                                                    <option value="{{$enquiry->shipment_type}}" {{$enquiry->shipment_type == 2? 'selected' : ''}}>Part</option>
                                                    <option value="{{$enquiry->shipment_type}}" {{$enquiry->shipment_type == 3? 'selected' : ''}}>Split</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">ETA/ETD:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="eta_etd" value="{{$enquiry->eta_etd}}">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">SHIPPER ( Sales Person ):<span class="text-danger">*</span></label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="form-control wide me-2 select2" name="sales_person_id">
                                                    <option value="">Select SHIPPER ( Sales Person )</option>
                                                    @foreach ($salePersons as $salePerson)
                                                        <option value="{{$salePerson->id}}" {{$salePerson->id == $enquiry->sales_person_id? 'selected' : ''}}>{{$salePerson->name}}</option>
                                                    @endforeach
                                                </select>
                                                <button type="button" class="btn btn-sm btn-outline-primary"
                                                    data-bs-toggle="modal" data-bs-target="#salespersonModal">
                                                    <i class="bi bi-plus-lg">+</i>
                                                </button>
                                            </div>
                                        </div>
                                        
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Chargeable Weight:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="chargeable_weight" value="{{$enquiry->chargeable_weight}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Enquiry Date:</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" name="enquiry_date" value={{$enquiry->enquiry_date}}>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Loading Port:<span class="text-danger">*</span></label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="form-control wide me-2 select2" name="loading_port_id">
                                                    <option value="">Select Loading Port</option>
                                                    @foreach ($ports as $port)
                                                    <option value="{{$port->id}}" {{$port->id == $enquiry->loading_port_id? 'selected' : ''}}>{{$port->port_name}}</option>
                                                    @endforeach
                                                </select>
                                                <button type="button" class="btn btn-sm btn-outline-primary"
                                                    data-target-select="loading_port_id"
                                                    data-bs-toggle="modal" data-bs-target="#addNewPortDetails">
                                                    <i class="bi bi-plus-lg">+</i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Contact Details:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="contact_details" value="{{$enquiry->contact_details}}">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Commodity Desc:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="commodity_desc" value="{{$enquiry->commodity_desc}}">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">KGS/MTS:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="select2 form-control wide me-2" placeholder="Select" name="kgs_mts">
                                                    <option value="{{$enquiry->kgs_mts}}" {{$enquiry->kgs_mts == $enquiry->kgs_mts ? 'selected' : ''}}>KGS</option>
                                                    <option value="{{$enquiry->kgs_mts}}" {{$enquiry->kgs_mts == $enquiry->kgs_mts ? 'selected' : ''}}>MTS</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">No of Pkgs:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="no_of_pkgs" value="{{$enquiry->no_of_pkgs}}"> 
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Selling Rate:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <input type="text" class="form-control" name="selling_rate" value="{{$enquiry->selling_rate}}">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Enquiry Status:</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="enquiry_status" value="{{$enquiry->enquiry_status}}">
                                                    <option value="" class="has-arrow">Select</option>
                                                    <option value="Active" {{ $enquiry->enquiry_status == 'Active' ? 'selected' : '' }}>Active</option>
                                                    <option value="Order" {{ $enquiry->enquiry_status == 'Order' ? 'selected' : '' }}>Order</option>
                                                    <option value="Lost" {{ $enquiry->enquiry_status == 'Lost' ? 'selected' : '' }}>Lost</option>
                                                    <option value="Complete" {{ $enquiry->enquiry_status == 'Complete' ? 'selected' : '' }}>Complete</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">No of container:<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="no_of_container" value="{{$enquiry->no_of_container}}">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">LCL/FCL:<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="select2 form-control wide me-2" placeholder="Select" name="lcl_fcl">
                                                    <option value="">Select</option>
                                                    <option value="lcl" {{ $enquiry->lcl_fcl == 'lcl' ? 'selected' : '' }}>LCL</option>
                                                    <option value="fcl" {{ $enquiry->lcl_fcl == 'fcl' ? 'selected' : '' }}>FCL</option>
                                                    <option value="air" {{ $enquiry->lcl_fcl == 'air' ? 'selected' : '' }}>AIR</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">CBM:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="cbm" value="{{$enquiry->cbm}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-2 col-form-label">Follow-Up:</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control h-100" id="validationCustom04" rows="2" name="follow_up">{{$enquiry->follow_up}}</textarea>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-2 col-form-label">Lost Enquiry Remarks:</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control h-100" id="validationCustom04" rows="2" name="lost_enquiry_remarks">{{$enquiry->lost_enquiry_remarks}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <h4>CBM CALCULATOR</h4>
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Length:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="length" value="{{$enquiry->length}}">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Width:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="width" value="{{$enquiry->width}}">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Height:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="height" value="{{$enquiry->height}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Quantity: </label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="quantity" value="{{$enquiry->quantity}}">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Total CBM:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="total_cbm" value="{{$enquiry->total_cbm}}">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Total Chg Wt:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="total_chg_wt" value="{{$enquiry->total_chg_wt}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if($enquiry->enquiry_status != 'Complete')
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <button class="btn btn-warning me-md-2" type="button">Cancel</button>
                                        <button class="btn btn-primary" type="submit">Update</button>
                                    </div>
                                @endif
                            </form>
                        </div>

                        <!--<h4>CBM CALCULATOR</h4>-->
                        <!--<hr>-->
                        <!--<div class="form-validation">-->
                        <!--    <form class="needs-validation" novalidate>-->
                        <!--        <br>-->
                                <!--<div class="d-grid gap-2 d-md-flex justify-content-md-end">-->
                                <!--    <button class="btn btn-warning me-md-2" type="button">Cancel</button>-->
                                <!--    <button class="btn btn-primary" type="button">ADD CBM</button>-->
                                <!--</div>-->
                        <!--    </form>-->
                        <!--</div>-->

                        <!--<hr>-->
                        <!--<div class="form-validation">-->
                        <!--    <form class="needs-validation" novalidate>-->
                        <!--        <div class="row">-->
                        <!--            <div class="col-xl-6 col-xxl-6">-->
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">Total Selling Rate:</label>-->
                        <!--                    <div class="col-sm-9">-->
                        <!--                        <input type="text" class="form-control" name="total_selling_rate" value="{{$enquiry->total_selling_rate}}">-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">Total Buy Rate:</label>-->
                        <!--                    <div class="col-sm-9">-->
                        <!--                        <input type="text" class="form-control" name="total_buy_rate" value="{{$enquiry->total_buy_rate}}">-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--            <div class="col-xl-6 col-xxl-6">-->
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">Estimated Profit:</label>-->
                        <!--                    <div class="col-sm-9">-->
                        <!--                        <input type="text" class="form-control" name="estimated_profit" value="{{$enquiry->estimated_profit}}">-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--    </form>-->
                        <!--</div>-->

                        <!--<hr>-->
                        <!--<h4>Selling Rate</h4>-->
                        <!--<hr>-->
                        <!--<div class="form-validation">-->
                        <!--    <h5>Other Details</h5>-->
                        <!--    <form class="needs-validation" novalidate>-->
                        <!--        <div class="row">-->
                        <!--            <div class="col-xl-6 col-xxl-6">-->
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">Ref Id Enquiry:</label>-->
                        <!--                    <div class="col-sm-9">-->
                        <!--                        <input type="text" class="form-control" name="buy_ref_id_enquiry" value="{{$enquiry->buy_ref_id_enquiry}}">-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">From Valid Dt:</label>-->
                        <!--                    <div class="col-sm-9">-->
                        <!--                        <input type="date" class="form-control" name="selling_from_valid_dt" value="{{$enquiry->selling_from_valid_dt}}">-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">To Valid Date:</label>-->
                        <!--                    <div class="col-sm-9">-->
                        <!--                        <input type="date" class="form-control" name="buy_to_valid_date" value="{{$enquiry->buy_to_valid_date}}">-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--            <div class="col-xl-6 col-xxl-6">-->
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">Shipping Line/Air Line:<span-->
                        <!--                            class="text-danger">*</span></label>-->
                        <!--                    <div class="col-sm-9 d-flex align-items-center">-->
                        <!--                        <select class="select2 form-control wide me-2" name="shipping_line_id">-->
                        <!--                            <option value="">Select Shipping Line</option>-->
                        <!--                            @foreach ($shipping_lines as $shipping_line)-->
                        <!--                                <option value="{{$shipping_line->id}}" {{ $shipping_line->id == $shipping_line->id ? 'selected' : '' }}>-->
                        <!--                                    {{$shipping_line->shipping_line_name}}-->
                        <!--                                </option>-->
                        <!--                            @endforeach-->
                        <!--                        </select>-->
                        <!--                        <button type="button" class="btn btn-sm btn-outline-primary"-->
                        <!--                            data-bs-toggle="modal" data-bs-target="#shippingModelDetails">-->
                        <!--                            <i class="bi bi-plus-lg">+</i>-->
                        <!--                        </button>-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">Activity:</label>-->
                        <!--                    <div class="col-sm-9 d-flex align-items-center">-->
                        <!--                        <select class="select form-control wide me-2" name="selling_activity" placeholder="Select">-->
                                                    
                        <!--                        </select>-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--    </form>-->
                        <!--    <hr>-->
                        <!--    <h5>Container Size & Type Details</h5>-->
                        <!--    <form class="needs-validation" novalidate>-->
                        <!--        <div class="row">-->
                        <!--            <div class="col-xl-6 col-xxl-6">-->
                        <!--                <div class="mb-6 row">-->
                        <!--                    <div class="d-flex gap-3">-->
                        <!--                        <div class="form-check">-->
                        <!--                            <input class="form-check-input" type="checkbox" id="lcl" name="selling_lcl" value="" {{$enquiry->selling_lcl == 1 ? 'checked' : '' }}>-->
                        <!--                            <label class="form-check-label" for="lcl">-->
                        <!--                                LCL-->
                        <!--                            </label>-->
                        <!--                        </div>-->
                        <!--                        <div class="form-check">-->
                        <!--                            <input class="form-check-input" type="checkbox" id="fcl20" name="selling_fcl_20" value="" {{$enquiry->selling_fcl_20 == 1 ? 'checked' : '' }}>-->
                        <!--                            <label class="form-check-label" for="fcl20">-->
                        <!--                                20 FCL-->
                        <!--                            </label>-->
                        <!--                        </div>-->
                        <!--                        <div class="form-check">-->
                        <!--                            <input class="form-check-input" type="checkbox" id="fcl40" name="selling_fcl_40" value="" {{$enquiry->selling_fcl_40 == 1 ? 'checked' : '' }}>-->
                        <!--                            <label class="form-check-label" for="fcl40">-->
                        <!--                                40 FCL-->
                        <!--                            </label>-->
                        <!--                        </div>-->
                        <!--                        <div class="form-check">-->
                        <!--                            <input class="form-check-input" type="checkbox" id="air" name="selling_air" value="selling_" {{$enquiry->selling_air == 1 ? 'checked' : '' }}>-->
                        <!--                            <label class="form-check-label" for="air">-->
                        <!--                                AIR-->
                        <!--                            </label>-->
                        <!--                        </div>-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">Container Type:</label>-->
                        <!--                    <div class="col-sm-9 d-flex align-items-center">-->
                        <!--                        <select class="default-select form-control wide me-2" name="selling_container_type" value={{$enquiry->selling_container_type}} -->
                        <!--                            placeholder="Select"></select>-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">FreeDays:</label>-->
                        <!--                    <div class="col-sm-9">-->
                        <!--                        <input type="date" class="form-control" name="selling_free_days" value={{$enquiry->selling_free_days}}>-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">GSTIN:</label>-->
                        <!--                    <div class="col-sm-9">-->
                        <!--                        <input type="text" class="form-control" name="selling_gstin" value={{$enquiry->selling_gstin}}>-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">SAC_Code:</label>-->
                        <!--                    <div class="col-sm-9">-->
                        <!--                        <input type="text" class="form-control" name="selling_sac_code" value={{$enquiry->selling_sac_code}}>-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--            </div>-->

                        <!--            <div class="col-xl-6 col-xxl-6">-->
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">CGST:</label>-->
                        <!--                    <div class="col-sm-9">-->
                        <!--                        <input type="text" class="form-control" name="container_cgst" value={{$enquiry->container_cgst}}>-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">SGST:</label>-->
                        <!--                    <div class="col-sm-9">-->
                        <!--                        <input type="text" class="form-control" name="container_sgst" value={{$enquiry->container_sgst}}>-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">IGST:</label>-->
                        <!--                    <div class="col-sm-9">-->
                        <!--                        <input type="text" class="form-control" name="container_igst" value={{$enquiry->container_igst}}>-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">Total:</label>-->
                        <!--                    <div class="col-sm-9">-->
                        <!--                        <input type="text" class="form-control" name="container_total" value={{$enquiry->container_total}}>-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--    </form>-->
                        <!--    <hr>-->
                        <!--    <h5>Charges</h5>-->
                        <!--    <form class="needs-validation" novalidate>-->
                        <!--        <div class="row">-->
                        <!--            <div class="col-xl-6 col-xxl-6">-->
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-4 col-form-label">-->
                        <!--                        Charge_Name:<span class="text-danger">*</span>-->
                        <!--                    </label>-->
                        <!--                    <div class="col-sm-8 d-flex align-items-center gap-2">-->
                        <!--                        <select name="selling_charge_id" id="selling_charge_name"-->
                        <!--                            class="form-control select2">-->
                        <!--                            <option value="">Select</option>-->
                        <!--                            @foreach ($charges as $charge)-->
                        <!--                                <option value="{{ $charge->id }}" {{$enquiry->selling_charge_id == $charge->id ? 'selected' : '' }}>-->
                        <!--                                    {{ $charge->charge_name }}-->
                        <!--                                </option>-->
                        <!--                            @endforeach-->
                        <!--                        </select>-->
                        <!--                        <button type="button" class="btn btn-sm btn-outline-primary"-->
                        <!--                            data-bs-toggle="modal" data-bs-target="#chargesNames">-->
                        <!--                            +-->
                        <!--                        </button>-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">Currency:</label>-->
                        <!--                    <div class="col-sm-9 d-flex align-items-center">-->
                        <!--                        <select class="select2 form-control wide me-2" placeholder="Select" name="selling_currency">-->
                        <!--                            <option value="">Select currency</option>-->
                        <!--                            <option value="AED" {{$enquiry->selling_currency==$enquiry->selling_currency ? 'selected' : ''}}>AED</option>-->
                        <!--                            <option value="AUD" {{$enquiry->selling_currency==$enquiry->selling_currency ? 'selected' : ''}}>AUD</option>-->
                        <!--                            <option value="BGN" {{$enquiry->selling_currency==$enquiry->selling_currency ? 'selected' : ''}}>BGN</option>-->
                        <!--                            <option value="BRL" {{$enquiry->selling_currency==$enquiry->selling_currency ? 'selected' : ''}}>BRL</option>-->
                        <!--                            <option value="CAD" {{$enquiry->selling_currency==$enquiry->selling_currency ? 'selected' : ''}}>CAD</option>-->
                        <!--                            <option value="CHF" {{$enquiry->selling_currency==$enquiry->selling_currency ? 'selected' : ''}}>CHF</option>-->
                        <!--                            <option value="CNY" {{$enquiry->selling_currency==$enquiry->selling_currency ? 'selected' : ''}}>CNY</option>-->
                        <!--                            <option value="CSD" {{$enquiry->selling_currency==$enquiry->selling_currency ? 'selected' : ''}}>CSD</option>-->
                        <!--                            <option value="CZK" {{$enquiry->selling_currency==$enquiry->selling_currency ? 'selected' : ''}}>CZK</option>-->
                        <!--                            <option value="DKK" {{$enquiry->selling_currency==$enquiry->selling_currency ? 'selected' : ''}}>DKK</option>-->
                        <!--                            <option value="EEK" {{$enquiry->selling_currency==$enquiry->selling_currency ? 'selected' : ''}}>EEK</option>-->
                        <!--                            <option value="EGP" {{$enquiry->selling_currency==$enquiry->selling_currency ? 'selected' : ''}}>EGP</option>-->
                        <!--                            <option value="EUR" {{$enquiry->selling_currency==$enquiry->selling_currency ? 'selected' : ''}}>EUR</option>-->
                        <!--                            <option value="GBP" {{$enquiry->selling_currency==$enquiry->selling_currency ? 'selected' : ''}}>GBP</option>-->
                        <!--                            <option value="HKD" {{$enquiry->selling_currency==$enquiry->selling_currency ? 'selected' : ''}}>HKD</option>-->
                        <!--                            <option value="HRK" {{$enquiry->selling_currency==$enquiry->selling_currency ? 'selected' : ''}}>HRK</option>-->
                        <!--                            <option value="HUF" {{$enquiry->selling_currency==$enquiry->selling_currency ? 'selected' : ''}}>HUF</option>-->
                        <!--                            <option value="IDR" {{$enquiry->selling_currency==$enquiry->selling_currency ? 'selected' : ''}}>IDR</option>-->
                        <!--                            <option value="ILS" {{$enquiry->selling_currency==$enquiry->selling_currency ? 'selected' : ''}}>ILS</option>-->
                        <!--                            <option value="INR" {{$enquiry->selling_currency==$enquiry->selling_currency ? 'selected' : ''}}>INR</option>-->
                        <!--                            <option value="ISK" {{$enquiry->selling_currency==$enquiry->selling_currency ? 'selected' : ''}}>ISK</option>-->
                        <!--                            <option value="JPY" {{$enquiry->selling_currency==$enquiry->selling_currency ? 'selected' : ''}}>JPY</option>-->
                        <!--                            <option value="MXP" {{$enquiry->selling_currency==$enquiry->selling_currency ? 'selected' : ''}}>MXP</option>-->
                        <!--                            <option value="MYR" {{$enquiry->selling_currency==$enquiry->selling_currency ? 'selected' : ''}}>MYR</option>-->
                        <!--                            <option value="NOK" {{$enquiry->selling_currency==$enquiry->selling_currency ? 'selected' : ''}}>NOK</option>-->
                        <!--                            <option value="NZD" {{$enquiry->selling_currency==$enquiry->selling_currency ? 'selected' : ''}}>NZD</option>-->
                        <!--                            <option value="PHP" {{$enquiry->selling_currency==$enquiry->selling_currency ? 'selected' : ''}}>PHP</option>-->
                        <!--                            <option value="PLN" {{$enquiry->selling_currency==$enquiry->selling_currency ? 'selected' : ''}}>PLN</option>-->
                        <!--                            <option value="ROL" {{$enquiry->selling_currency==$enquiry->selling_currency ? 'selected' : ''}}>ROL</option>-->
                        <!--                            <option value="RUR" {{$enquiry->selling_currency==$enquiry->selling_currency ? 'selected' : ''}}>RUR</option>-->
                        <!--                            <option value="SAR" {{$enquiry->selling_currency==$enquiry->selling_currency ? 'selected' : ''}}>SAR</option>-->
                        <!--                            <option value="SEK" {{$enquiry->selling_currency==$enquiry->selling_currency ? 'selected' : ''}}>SEK</option>-->
                        <!--                            <option value="SGD" {{$enquiry->selling_currency==$enquiry->selling_currency ? 'selected' : ''}}>SGD</option>-->
                        <!--                            <option value="SIT" {{$enquiry->selling_currency==$enquiry->selling_currency ? 'selected' : ''}}>SIT</option>-->
                        <!--                            <option value="SKK" {{$enquiry->selling_currency==$enquiry->selling_currency ? 'selected' : ''}}>SKK</option>-->
                        <!--                            <option value="THB" {{$enquiry->selling_currency==$enquiry->selling_currency ? 'selected' : ''}}>THB</option>-->
                        <!--                            <option value="TRL" {{$enquiry->selling_currency==$enquiry->selling_currency ? 'selected' : ''}}>TRL</option>-->
                        <!--                            <option value="TWD" {{$enquiry->selling_currency==$enquiry->selling_currency ? 'selected' : ''}}>TWD</option>-->
                        <!--                            <option value="UAH" {{$enquiry->selling_currency==$enquiry->selling_currency ? 'selected' : ''}}>UAH</option>-->
                        <!--                            <option value="US" {{$enquiry->selling_currency==$enquiry->selling_currency ? 'selected' : ''}}>US</option>-->
                        <!--                            <option value="USD" {{$enquiry->selling_currency==$enquiry->selling_currency ? 'selected' : ''}}>USD</option>-->
                        <!--                        </select>-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">Rate_Basis:</label>-->
                        <!--                    <div class="col-sm-9 d-flex align-items-center">-->
                        <!--                        <select class="select2 form-control wide me-2" placeholder="Select" name="selling_rate_basis">-->
                        <!--                            <option value="">select</option>-->
                        <!--                            <option value="LUMPSUM" {{$enquiry->selling_rate_basis == $enquiry->selling_rate_basis ? 'selected' : ''}}>LUMPSUM</option>-->
                        <!--                            <option value="CBMWISE" {{$enquiry->selling_rate_basis == $enquiry->selling_rate_basis ? 'selected' : ''}}>CBMWISE</option>-->
                        <!--                            <option value="PERCONT" {{$enquiry->selling_rate_basis == $enquiry->selling_rate_basis ? 'selected' : ''}}>PER CONTAINER</option>-->
                        <!--                            <option value="GWTWISE" {{$enquiry->selling_rate_basis == $enquiry->selling_rate_basis ? 'selected' : ''}}>GWTWISE</option>-->
                        <!--                            <option value="CHGWTWISE" {{$enquiry->selling_rate_basis == $enquiry->selling_rate_basis ? 'selected' : ''}}>CHGWTWISE</option>-->
                        <!--                            <option value="PERKG" {{$enquiry->selling_rate_basis == $enquiry->selling_rate_basis ? 'selected' : ''}}>PER KG</option>-->
                        <!--                            <option value="PERCBM" {{$enquiry->selling_rate_basis == $enquiry->selling_rate_basis ? 'selected' : ''}}>PER CBM</option>-->
                        <!--                            <option value="PERINVOICE" {{$enquiry->selling_rate_basis == $enquiry->selling_rate_basis ? 'selected' : ''}}>PER INVOICE</option>-->
                        <!--                            <option value="PERUNIT" {{$enquiry->selling_rate_basis == $enquiry->selling_rate_basis ? 'selected' : ''}}>PER UNIT</option>-->
                        <!--                        </select>-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">Origin_Dest:</label>-->
                        <!--                    <div class="col-sm-9 d-flex align-items-center">-->
                        <!--                        <select class="select2 form-control wide me-2" placeholder="Select" name="selling_origin_dest">-->
                        <!--                            <option value="origin" {{$enquiry->selling_origin_dest == $enquiry->selling_origin_dest ? 'selected' : ''}}>Origin</option>-->
                        <!--                            <option value="destination" {{$enquiry->selling_origin_dest == $enquiry->selling_origin_dest ? 'selected' : ''}}>Destination</option>-->
                        <!--                        </select>-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">Exch.Rate:</label>-->
                        <!--                    <div class="col-sm-9">-->
                        <!--                        <input type="text" class="form-control" name="selling_exchange_rate" value="{{$enquiry->selling_exchange_rate}}">-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">Freight:</label>-->
                        <!--                    <div class="col-sm-9">-->
                        <!--                        <input type="text" class="form-control" name="selling_freight" value="{{$enquiry->selling_freight}}">-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--            </div>-->

                        <!--            <div class="col-xl-6 col-xxl-6">-->
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">GST:</label>-->
                        <!--                    <div class="col-sm-9">-->
                        <!--                        <input type="text" class="form-control" name="selling_gst" value="{{$enquiry->selling_gst}}">-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">Prep/Coll:</label>-->
                        <!--                    <div class="col-sm-9">-->
                        <!--                        <select class="form-control">-->
                        <!--                            <option>Select</option>-->
                        <!--                            <option value="c">C</option>-->
                        <!--                            <option value="p">P</option>-->
                        <!--                        </select>-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">GST(Y/N):<span-->
                        <!--                            class="text-danger">*</span></label>-->
                        <!--                    <div class="col-sm-9 d-flex align-items-center">-->
                        <!--                        <select class="form-control wide me-2" name="selling_gst_applicable" placeholder="Select">-->
                        <!--                            <option value="">Select</option>-->
                        <!--                            <option value="Y" {{$enquiry->selling_gst_applicable == $enquiry->selling_gst_applicable ? 'selected' : '' }}>Yes</option>-->
                        <!--                            <option value="N" {{$enquiry->selling_gst_applicable == $enquiry->selling_gst_applicable ? 'selected' : '' }}>No</option>-->
                        <!--                        </select>-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">PerUnit:</label>-->
                        <!--                    <div class="col-sm-9">-->
                        <!--                        <input type="text" class="form-control" name="selling_per_unit" value="{{$enquiry->selling_per_unit}}">-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">Rate:</label>-->
                        <!--                    <div class="col-sm-9">-->
                        <!--                        <input type="text" class="form-control" name="selling_total_unit" value="{{$enquiry->selling_total_unit}}">-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">Amount:<span-->
                        <!--                            class="text-danger">*</span></label>-->
                        <!--                    <div class="col-sm-9">-->
                        <!--                        <input type="text" class="form-control" name="selling_total" value="{{$enquiry->selling_total}}">-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--        </div>  -->
                        <!--        <button type="button" class="btn btn-primary btn-sm">ADD / UPDATE SELLING RATE</button>-->
                        <!--        <button type="button" class="btn btn-primary btn-sm">PRINT QUOTATION</button>-->
                        <!--        <button type="button" class="btn btn-danger btn-sm">ADD CHARGES FROM FIXED-->
                        <!--            CHARGE</button>-->
                        <!--    </form>-->
                        <!--</div>-->
                        <!--<hr>-->
                        <!--<h3>Buy Rate</h3>-->
                        <!--<form class="needs-validation" novalidate>-->
                        <!--    <hr>-->
                        <!--    <h4>Other Details Buy Rate</h4>-->
                        <!--    <hr>-->
                        <!--    <div class="row">-->
                        <!--        <div class="col-xl-6 col-xxl-6">-->
                        <!--            <div class="mb-3 row">-->
                        <!--                <label class="col-sm-3 col-form-label">Ref Id Enquiry:</label>-->
                        <!--                <div class="col-sm-9">-->
                        <!--                    <input type="text" class="form-control" name="buy_ref_id_enquiry" value="{{$enquiry->buy_ref_id_enquiry}}">-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--            <div class="mb-3 row">-->
                        <!--                <label class="col-sm-3 col-form-label">To Valid Date:</label>-->
                        <!--                <div class="col-sm-9">-->
                        <!--                    <input type="date" class="form-control" name="buy_to_valid_date" value="{{$enquiry->buy_to_valid_date}}">-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--            <div class="mb-3 row">-->
                        <!--                <label class="col-sm-3 col-form-label">Vendor:</label>-->
                        <!--                <div class="col-sm-9 d-flex align-items-center">-->
                        <!--                    <input type="text" class="form-control" name="buy_vendor" name="{{$enquiry->buy_vendor}}">-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--        <div class="col-xl-6 col-xxl-6">-->
                        <!--            <div class="mb-3 row">-->
                        <!--                <label class="col-sm-3 col-form-label">From Valid Dt:</label>-->
                        <!--                <div class="col-sm-9">-->
                        <!--                    <input type="date" class="form-control" name="buy_from_valid_dt" value="{{$enquiry->buy_from_valid_dt}}">-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--            <div class="mb-3 row">-->
                        <!--                <label class="col-sm-3 col-form-label">Activity:</label>-->
                        <!--                <div class="col-sm-9">-->
                        <!--                    <select class="form-control" name="buy_activity">-->
                        <!--                        <option value="">Select</option>-->
                        <!--                        <option value="c" {{$enquiry->buy_activity == $enquiry->buy_activity ? 'selected' : '' }}>C</option>-->
                        <!--                        <option value="p" {{$enquiry->buy_activity == $enquiry->buy_activity ? 'selected' : '' }}>P</option>-->
                        <!--                    </select>-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--    </div>-->


                        <!--    <hr>-->
                        <!--    <h4>Container Size & Type Details</h4>-->
                        <!--    <hr>-->
                        <!--    <div class="row">-->
                        <!--        <div class="col-xl-6 col-xxl-6">-->
                        <!--            <div class="mb-6 row">-->
                        <!--                <div class="d-flex gap-3">-->
                        <!--                    <div class="form-check">-->
                        <!--                        <input class="form-check-input" type="checkbox" id="lcl" name="buy_lcl" {{$enquiry->buy_lcl == 1 ? 'checked' : ''}}>-->
                        <!--                        <label class="form-check-label" for="lcl">-->
                        <!--                            LCL-->
                        <!--                        </label>-->
                        <!--                    </div>-->
                        <!--                    <div class="form-check">-->
                        <!--                        <input class="form-check-input" type="checkbox" id="fcl20" name="buy_fcl20" {{$enquiry->buy_fcl20 == 1 ? 'checked' : ''}}>-->
                        <!--                        <label class="form-check-label" for="fcl20">-->
                        <!--                            20 FCL-->
                        <!--                        </label>-->
                        <!--                    </div>-->
                        <!--                    <div class="form-check">-->
                        <!--                        <input class="form-check-input" type="checkbox" id="fcl40" name="buy_fcl40" {{$enquiry->buy_fcl40 == 1 ? 'checked' : ''}}>-->
                        <!--                        <label class="form-check-label" for="fcl40">-->
                        <!--                            40 FCL-->
                        <!--                        </label>-->
                        <!--                    </div>-->
                        <!--                    <div class="form-check">-->
                        <!--                        <input class="form-check-input" type="checkbox" id="air" name="buy_air" {{$enquiry->buy_air == 1 ? 'checked' : ''}}>-->
                        <!--                        <label class="form-check-label" for="air">-->
                        <!--                            AIR-->
                        <!--                        </label>-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--            <div class="mb-3 row">-->
                        <!--                <label class="col-sm-3 col-form-label">Container Type:</label>-->
                        <!--                <div class="col-sm-9 d-flex align-items-center">-->
                        <!--                    <select class="default-select form-control wide me-2" name="buy_container"-->
                        <!--                        placeholder="Select"></select>-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--            <div class="mb-3 row">-->
                        <!--                <label class="col-sm-3 col-form-label">FreeDays:</label>-->
                        <!--                <div class="col-sm-9">-->
                        <!--                    <input type="date" class="form-control" name="buy_free_days" value="{{$enquiry->buy_free_days}}">-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--            <div class="mb-3 row">-->
                        <!--                <label class="col-sm-3 col-form-label">GSTIN:</label>-->
                        <!--                <div class="col-sm-9">-->
                        <!--                    <input type="text" class="form-control" name="buy_gstin" value="{{$enquiry->buy_gstin}}">-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--            <div class="mb-3 row">-->
                        <!--                <label class="col-sm-3 col-form-label">SAC_Code:</label>-->
                        <!--                <div class="col-sm-9">-->
                        <!--                    <input type="text" class="form-control">-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--        <div class="col-xl-6 col-xxl-6">-->
                        <!--            <div class="mb-3 row">-->
                        <!--                <label class="col-sm-3 col-form-label">CGST:</label>-->
                        <!--                <div class="col-sm-9">-->
                        <!--                    <input type="text" class="form-control" name="buy_cgst" value="{{$enquiry->buy_cgst}}">-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--            <div class="mb-3 row">-->
                        <!--                <label class="col-sm-3 col-form-label">SGST:</label>-->
                        <!--                <div class="col-sm-9">-->
                        <!--                    <input type="text" class="form-control" name="buy_sgst" value="{{$enquiry->buy_sgst}}">-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--            <div class="mb-3 row">-->
                        <!--                <label class="col-sm-3 col-form-label">IGST:</label>-->
                        <!--                <div class="col-sm-9">-->
                        <!--                    <input type="text" class="form-control" name="buy_igst" value="{{$enquiry->buy_igst}}">-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--            <div class="mb-3 row">-->
                        <!--                <label class="col-sm-3 col-form-label">Total:</label>-->
                        <!--                <div class="col-sm-9">-->
                        <!--                    <input type="text" class="form-control" name="buy_total">-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</form>-->
                        <!--<hr>-->
                        <!--<h5>Charges</h5>-->
                        <!--<form class="needs-validation" novalidate>-->
                        <!--    <div class="row">-->
                        <!--        <div class="col-xl-6 col-xxl-6">-->
                        <!--            <div class="mb-3 row">-->
                        <!--                <label class="col-sm-3 col-form-label">Charge_Name:</label>-->
                        <!--                <div class="col-sm-9 d-flex align-items-center gap-2">-->
                        <!--                    <select name="buy_charge_id" id="buy_charge_name" class="form-control wide me-2 select2">-->
                        <!--                        <option value="">select</option>-->
                        <!--                        @foreach ($charges as $charge)-->
                        <!--                            <option value="{{$charge->id}}" {{$charge->id == $enquiry->buy_charge_id ? 'selected' : ''}}>{{$charge->charge_name}}</option>-->
                        <!--                        @endforeach-->
                        <!--                    </select>-->
                        <!--                    <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#chargesNames">-->
                        <!--                        <i class="bi bi-plus-lg">+</i>-->
                        <!--                    </button>-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--            <div class="mb-3 row">-->
                        <!--                <label class="col-sm-3 col-form-label">Currency:</label>-->
                        <!--                <div class="col-sm-9 d-flex align-items-center">-->
                        <!--                    <select class="select2 form-control wide me-2" name="buy_currency" placeholder="Select">-->
                        <!--                        <option value="">Select currency</option>-->
                        <!--                        <option value="AED" {{$enquiry->buy_currency == $enquiry->buy_currency ? 'selected' : ''}}>AED</option>-->
                        <!--                        <option value="AUD" {{$enquiry->buy_currency == $enquiry->buy_currency ? 'selected' : ''}}>AUD</option>-->
                        <!--                        <option value="BGN" {{$enquiry->buy_currency == $enquiry->buy_currency ? 'selected' : ''}}>BGN</option>-->
                        <!--                        <option value="BRL" {{$enquiry->buy_currency == $enquiry->buy_currency ? 'selected' : ''}}>BRL</option>-->
                        <!--                        <option value="CAD" {{$enquiry->buy_currency == $enquiry->buy_currency ? 'selected' : ''}}>CAD</option>-->
                        <!--                        <option value="CHF" {{$enquiry->buy_currency == $enquiry->buy_currency ? 'selected' : ''}}>CHF</option>-->
                        <!--                        <option value="CNY" {{$enquiry->buy_currency == $enquiry->buy_currency ? 'selected' : ''}}>CNY</option>-->
                        <!--                        <option value="CSD" {{$enquiry->buy_currency == $enquiry->buy_currency ? 'selected' : ''}}>CSD</option>-->
                        <!--                        <option value="CZK" {{$enquiry->buy_currency == $enquiry->buy_currency ? 'selected' : ''}}>CZK</option>-->
                        <!--                        <option value="DKK" {{$enquiry->buy_currency == $enquiry->buy_currency ? 'selected' : ''}}>DKK</option>-->
                        <!--                        <option value="EEK" {{$enquiry->buy_currency == $enquiry->buy_currency ? 'selected' : ''}}>EEK</option>-->
                        <!--                        <option value="EGP" {{$enquiry->buy_currency == $enquiry->buy_currency ? 'selected' : ''}}>EGP</option>-->
                        <!--                        <option value="EUR" {{$enquiry->buy_currency == $enquiry->buy_currency ? 'selected' : ''}}>EUR</option>-->
                        <!--                        <option value="GBP" {{$enquiry->buy_currency == $enquiry->buy_currency ? 'selected' : ''}}>GBP</option>-->
                        <!--                        <option value="HKD" {{$enquiry->buy_currency == $enquiry->buy_currency ? 'selected' : ''}}>HKD</option>-->
                        <!--                        <option value="HRK" {{$enquiry->buy_currency == $enquiry->buy_currency ? 'selected' : ''}}>HRK</option>-->
                        <!--                        <option value="HUF" {{$enquiry->buy_currency == $enquiry->buy_currency ? 'selected' : ''}}>HUF</option>-->
                        <!--                        <option value="IDR" {{$enquiry->buy_currency == $enquiry->buy_currency ? 'selected' : ''}}>IDR</option>-->
                        <!--                        <option value="ILS" {{$enquiry->buy_currency == $enquiry->buy_currency ? 'selected' : ''}}>ILS</option>-->
                        <!--                        <option value="INR" {{$enquiry->buy_currency == $enquiry->buy_currency ? 'selected' : ''}}>INR</option>-->
                        <!--                        <option value="ISK" {{$enquiry->buy_currency == $enquiry->buy_currency ? 'selected' : ''}}>ISK</option>-->
                        <!--                        <option value="JPY" {{$enquiry->buy_currency == $enquiry->buy_currency ? 'selected' : ''}}>JPY</option>-->
                        <!--                        <option value="MXP" {{$enquiry->buy_currency == $enquiry->buy_currency ? 'selected' : ''}}>MXP</option>-->
                        <!--                        <option value="MYR" {{$enquiry->buy_currency == $enquiry->buy_currency ? 'selected' : ''}}>MYR</option>-->
                        <!--                        <option value="NOK" {{$enquiry->buy_currency == $enquiry->buy_currency ? 'selected' : ''}}>NOK</option>-->
                        <!--                        <option value="NZD" {{$enquiry->buy_currency == $enquiry->buy_currency ? 'selected' : ''}}>NZD</option>-->
                        <!--                        <option value="PHP" {{$enquiry->buy_currency == $enquiry->buy_currency ? 'selected' : ''}}>PHP</option>-->
                        <!--                        <option value="PLN" {{$enquiry->buy_currency == $enquiry->buy_currency ? 'selected' : ''}}>PLN</option>-->
                        <!--                        <option value="ROL" {{$enquiry->buy_currency == $enquiry->buy_currency ? 'selected' : ''}}>ROL</option>-->
                        <!--                        <option value="RUR" {{$enquiry->buy_currency == $enquiry->buy_currency ? 'selected' : ''}}>RUR</option>-->
                        <!--                        <option value="SAR" {{$enquiry->buy_currency == $enquiry->buy_currency ? 'selected' : ''}}>SAR</option>-->
                        <!--                        <option value="SEK" {{$enquiry->buy_currency == $enquiry->buy_currency ? 'selected' : ''}}>SEK</option>-->
                        <!--                        <option value="SGD" {{$enquiry->buy_currency == $enquiry->buy_currency ? 'selected' : ''}}>SGD</option>-->
                        <!--                        <option value="SIT" {{$enquiry->buy_currency == $enquiry->buy_currency ? 'selected' : ''}}>SIT</option>-->
                        <!--                        <option value="SKK" {{$enquiry->buy_currency == $enquiry->buy_currency ? 'selected' : ''}}>SKK</option>-->
                        <!--                        <option value="THB" {{$enquiry->buy_currency == $enquiry->buy_currency ? 'selected' : ''}}>THB</option>-->
                        <!--                        <option value="TRL" {{$enquiry->buy_currency == $enquiry->buy_currency ? 'selected' : ''}}>TRL</option>-->
                        <!--                        <option value="TWD" {{$enquiry->buy_currency == $enquiry->buy_currency ? 'selected' : ''}}>TWD</option>-->
                        <!--                        <option value="UAH" {{$enquiry->buy_currency == $enquiry->buy_currency ? 'selected' : ''}}>UAH</option>-->
                        <!--                        <option value="US" {{$enquiry->buy_currency == $enquiry->buy_currency ? 'selected' : ''}}>US</option>-->
                        <!--                        <option value="USD" {{$enquiry->buy_currency == $enquiry->buy_currency ? 'selected' : ''}}>USD</option>-->
                        <!--                    </select>-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--            <div class="mb-3 row">-->
                        <!--                <label class="col-sm-3 col-form-label">Rate_Basis:</label>-->
                        <!--                <div class="col-sm-9 d-flex align-items-center">-->
                        <!--                    <select class="select2 form-control wide me-2" name="buy_rate_basic"placeholder="Select">-->
                        <!--                        <option value="">select</option>-->
                        <!--                        <option value="LUMPSUM" {{$enquiry->buy_rate_basic == $enquiry->buy_rate_basic ? 'selected' : '' }}>LUMPSUM</option>-->
                        <!--                        <option value="CBMWISE" {{$enquiry->buy_rate_basic == $enquiry->buy_rate_basic ? 'selected' : '' }}>CBMWISE</option>-->
                        <!--                        <option value="PERCONT" {{$enquiry->buy_rate_basic == $enquiry->buy_rate_basic ? 'selected' : '' }}>PER CONTAINER</option>-->
                        <!--                        <option value="GWTWISE" {{$enquiry->buy_rate_basic == $enquiry->buy_rate_basic ? 'selected' : '' }}>GWTWISE</option>-->
                        <!--                        <option value="CHGWTWISE" {{$enquiry->buy_rate_basic == $enquiry->buy_rate_basic ? 'selected' : '' }}>CHGWTWISE</option>-->
                        <!--                        <option value="PERKG" {{$enquiry->buy_rate_basic == $enquiry->buy_rate_basic ? 'selected' : '' }}>PER KG</option>-->
                        <!--                        <option value="PERCBM" {{$enquiry->buy_rate_basic == $enquiry->buy_rate_basic ? 'selected' : '' }}>PER CBM</option>-->
                        <!--                        <option value="PERINVOICE" {{$enquiry->buy_rate_basic == $enquiry->buy_rate_basic ? 'selected' : '' }}>PER INVOICE</option>-->
                        <!--                        <option value="PERUNIT" {{$enquiry->buy_rate_basic == $enquiry->buy_rate_basic ? 'selected' : '' }}>PER UNIT</option>-->
                        <!--                    </select>-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--            <div class="mb-3 row">-->
                        <!--                <label class="col-sm-3 col-form-label">Origin_Dest:</label>-->
                        <!--                <div class="col-sm-9 d-flex align-items-center">-->
                        <!--                    <select class="default-select form-control wide me-2" name="buy_origin_dest"-->
                        <!--                        placeholder="Select"></select>-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--            <div class="mb-3 row">-->
                        <!--                <label class="col-sm-3 col-form-label">Exch.Rate:</label>-->
                        <!--                <div class="col-sm-9">-->
                        <!--                    <input type="text" class="form-control" name="buy_exchange_rate">-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--            <div class="mb-3 row">-->
                        <!--                <label class="col-sm-3 col-form-label">Freight:</label>-->
                        <!--                <div class="col-sm-9">-->
                        <!--                    <input type="text" class="form-control" name="buy_freight" value="{{$enquiry->buy_freight}}">-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--        </div>-->

                        <!--        <div class="col-xl-6 col-xxl-6">-->
                        <!--            <div class="mb-3 row">-->
                        <!--                <label class="col-sm-3 col-form-label">GST:</label>-->
                        <!--                <div class="col-sm-9">-->
                        <!--                    <input type="text" class="form-control" name="buy_gst" value="{{$enquiry->buy_gst}}">-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--            <div class="mb-3 row">-->
                        <!--                <label class="col-sm-3 col-form-label">Prep/Coll:</label>-->
                        <!--                <div class="col-sm-9">-->
                        <!--                    <select class="form-control" name="buy_prep_coll" value="{{$enquiry->buy_prep_coll}}">-->
                        <!--                        <option>Select</option>-->
                        <!--                        <option value="c">C</option>-->
                        <!--                        <option value="p">P</option>-->
                        <!--                    </select>-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--            <div class="mb-3 row">-->
                        <!--                <label class="col-sm-3 col-form-label">GST(Y/N):<span-->
                        <!--                        class="text-danger">*</span></label>-->
                        <!--                <div class="col-sm-9 d-flex align-items-center">-->
                        <!--                    <select class="form-control wide me-2" placeholder="Select" name="buy_gst_y_n">-->
                        <!--                        <option value="">Select</option>-->
                        <!--                        <option value="Y" name="buy_gst_y_n" {{$enquiry->buy_gst_y_n == $enquiry->buy_gst_y_n ? 'selected' : '' }}>Yes</option>-->
                        <!--                        <option value="N" name="buy_gst_y_n" {{$enquiry->buy_gst_y_n == $enquiry->buy_gst_y_n ? 'selected' : '' }}>No</option>-->
                        <!--                    </select>-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--            <div class="mb-3 row">-->
                        <!--                <label class="col-sm-3 col-form-label">PerUnit:<span-->
                        <!--                    class="text-danger">*</span></label>-->
                        <!--                <div class="col-sm-9">-->
                        <!--                    <input type="text" class="form-control" name="buy_per_unit" value="{{$enquiry->buy_per_unit}}">-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--            <div class="mb-3 row">-->
                        <!--                <label class="col-sm-3 col-form-label">Rate:</label>-->
                        <!--                <div class="col-sm-9">-->
                        <!--                    <input type="text" class="form-control" name="buy_rate" value="{{$enquiry->buy_rate}}">-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--            <div class="mb-3 row">-->
                        <!--                <label class="col-sm-3 col-form-label">Amount:<span-->
                        <!--                        class="text-danger">*</span></label>-->
                        <!--                <div class="col-sm-9">-->
                        <!--                    <input type="text" class="form-control" name="buy_amount" value="{{$enquiry->buy_amount}}">-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--    <button type="button" class="btn btn-primary btn-sm">ADD / UPDATE BUY RATE</button>-->
                        <!--</form>-->
                    </div>
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
<!--shipping line-->
@include('admin-main.admin.commonModelForms.shippinglineModel')
<!-- Charge Name Details -->
@include('admin-main.admin.commonModelForms.charge_name_model')  

@endsection
@push('scripts')
<script>
        $(document).ready(function() {
        $('.select2').select2({
            // placeholder: 'Select a value',
            // 'allowClear': true,
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
        document.addEventListener('DOMContentLoaded', function () {
        
            const lengthEl   = document.querySelector('[name="length"]');
            const widthEl    = document.querySelector('[name="width"]');
            const heightEl   = document.querySelector('[name="height"]');
            const qtyEl      = document.querySelector('[name="quantity"]');
            const cbmEl      = document.querySelector('[name="total_cbm"]');
            const chgWtEl    = document.querySelector('[name="total_chg_wt"]');
        
            function calculateCBM() {
                const length  = parseFloat(lengthEl.value) || 0;
                const width   = parseFloat(widthEl.value) || 0;
                const height  = parseFloat(heightEl.value) || 0;
                const qty     = parseFloat(qtyEl.value) || 0;
        
                if (length && width && height && qty) {
                    // CBM calculation (cm → m³)
                    const cbm = (length * width * height * qty) / 1000000;
                    cbmEl.value = cbm.toFixed(3);
        
                    // Chargeable weight (Air standard: 1 CBM = 1000 KG)
                    const chargeableWeight = (length * width * height * qty) / 6000;
                    chgWtEl.value = chargeableWeight.toFixed(2);
                } else {
                    cbmEl.value = '';
                    chgWtEl.value = '';
                }
            }
        
            [lengthEl, widthEl, heightEl, qtyEl].forEach(el => {
                el.addEventListener('input', calculateCBM);
            });
        
        });
    </script>
    <script>
        $(document).ready(function () {

            // Submit charge form via AJAX
            $('#chargeForm').on('submit', function (e) {
                e.preventDefault();
        
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function (res) {
                        if (res.status) {
        
                            // Close modal
                            $('#chargesNames').modal('hide');
        
                            // Reset the form fields
                            $('#chargeForm')[0].reset();
        
                            // Create a new option in the select box
                            const newOption = new Option(res.data.charge_name, res.data.id, true, true);
        
                            // Add to select2 and trigger change
                            $('#charge_name').append(newOption).trigger('change');
        
                            // Optional: show a small alert
                            // alert('Charge added successfully!');
                        } else {
                            alert(res.message || 'Failed to add charge.');
                        }
                    },
                    error: function (xhr) {
                        console.error(xhr.responseText);
                        alert('Error while saving charge.');
                    }
                });
            });
        });
        
        $('#charge_name').on('change', function (e) {
            e.preventDefault();
            let selectedValue = $(this).val();
    
            $.ajax({
                url: '{{ route("enquiry.getCharge") }}',
                type: 'post',
                data: {'id': selectedValue},
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(res){
                    if(res.status){
                        if(res.data.gst_percentage){
                            $('input[name="gst"]').val(res.data.gst_percentage)
                                .css('background', '#ded9d9')
                                .prop('readonly', true);
                        }
    
                        $('input[name="sac_code"]').val(res.data.sac_code)
                            .css('background', '#ded9d9')
                            .prop('readonly', true);
                    }
    
                    calculateTotals();
                },
                error: function(xhr){
                    console.log('Error:', xhr.responseText);
                }
            });
        });
        //buy
        $('#buy_charge_name').on('change', function (e) {
            e.preventDefault();
            let selectedValue = $(this).val();
    
            $.ajax({
                url: '{{ route("enquiry.getCharge") }}',
                type: 'post',
                data: {'id': selectedValue},
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(res){
                    if(res.status){
                        if(res.data.gst_percentage){
                            $('input[name="buy_gst"]').val(res.data.gst_percentage)
                                .css('background', '#ded9d9')
                                .prop('readonly', true);
                        }
    
                        $('input[name="buy_sac_code"]').val(res.data.sac_code)
                            .css('background', '#ded9d9')
                            .prop('readonly', true);
                    }
    
                    calculateTotals();
                },
                error: function(xhr){
                    console.log('Error:', xhr.responseText);
                }
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            
            function calculateBuyTotals() {
        
                let perUnit   = parseFloat($('input[name="buy_per_unit"]').val()) || 0;
                let rate      = parseFloat($('input[name="buy_rate"]').val()) || 0;
                let exchRate  = parseFloat($('input[name="buy_exchange_rate"]').val()) || 1;
                let gstPct    = parseFloat($('input[name="buy_gst"]').val()) || 0;
                let gstYN     = $('select[name="buy_gst_y_n"]').val();
        
                // =========================
                // Freight Calculation
                // =========================
                let freight = perUnit * rate * exchRate;
        
                $('input[name="buy_freight"]')
                    .val(freight.toFixed(2))
                    .css('background', '#ded9d9')
                    .prop('readonly', true);
        
                // =========================
                // GST Calculation
                // =========================
                let cgst = 0, sgst = 0, igst = 0;
        
                if (gstYN === 'Y') {
                    cgst = (gstPct / 2) * freight / 100;
                    sgst = (gstPct / 2) * freight / 100;
                }
        
                // =========================
                // Final Amount
                // =========================
                let amount = freight + cgst + sgst + igst;
        
                $('input[name="buy_amount"]')
                    .val(amount.toFixed(2))
                    .css('background', '#ded9d9')
                    .prop('readonly', true);
            }
        
            // Recalculate whenever BUY fields change
            $('input[name^="buy_"], select[name^="buy_"]').on('keyup change', function () {
                calculateBuyTotals();
            });
        
        });
    </script>
@endpush
