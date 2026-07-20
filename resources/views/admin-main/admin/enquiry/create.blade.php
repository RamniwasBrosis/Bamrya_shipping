@extends('admin-main.layouts.default')
@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="#">Add New Enquiry</a></li>
        </ol>
        <a href="{{ url('admin/Enquiry') }}" class="text-primary"><- Go Back</a>
    </div>
    <div class="container-fluid p-2">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-validation">
                            <form class="needs-validation" id="enquiryFirstForm" novalidate>
                                @csrf
                                <div class="row">
                                    <div class="col-xl-6">
                            
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Reference ID:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="reference_id">
                                            </div>
                                        </div>
                            
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Discharge Port:<span class="text-danger">*</span></label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="select2 form-control wide me-2" name="discharge_port_id">
                                                    <option value="">Select Discharge Port</option>
                                                    @foreach ($ports as $port)
                                                        <option value="{{ $port->id }}" {{ old('discharge_port_id') == $port->id ? 'selected' : '' }}>
                                                            {{$port->port_name}}
                                                        </option>
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
                                                        <option value="{{ $party->id }}" {{ old('consignee_id') == $party->id ? 'selected' : '' }}>
                                                            {{$party->party_name}}
                                                        </option>
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
                                                <select class="default-select form-control wide me-2" name="inco_terms"></select>
                                            </div>
                                        </div>
                            
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Gross Weight:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="gross_weight">
                                            </div>
                                        </div>
                            
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Buying Rate:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="buying_rate">
                                            </div>
                                        </div>
                            
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Shipment Type:<span class="text-danger">*</span></label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="default-select form-control wide me-2" name="shipment_type">
                                                    <option value="" class="has-arrow">Select</option>
                                                    <option value="1" {{ old('shipment') == 'Total' ? 'selected' : '' }}>Total</option>
                                                    <option value="2" {{ old('shipment') == 'Part' ? 'selected' : '' }}>Part</option>
                                                    <option value="3" {{ old('shipment') == 'Split' ? 'selected' : '' }}>Split</option>
                                                </select>
                                            </div>
                                        </div>
                            
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">ETA/ETD:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="eta_etd">
                                            </div>
                                        </div>
                            
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">SHIPPER ( Sales Person ):<span class="text-danger">*</span></label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="form-control wide me-2 select2" name="sales_person_id">
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
                            
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">No of Pkgs:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="no_of_pkgs">
                                            </div>
                                        </div>
                            
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Chargeable Weight:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="chargeable_weight">
                                            </div>
                                        </div>
                            
                                    </div>
                            
                                    <div class="col-xl-6">
                            
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Enquiry Date:</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" name="enquiry_date">
                                            </div>
                                        </div>
                            
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Loading Port:<span class="text-danger">*</span></label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="form-control wide me-2 select2" name="loading_port_id">
                                                    <option value="">Select Loading Port</option>
                                                    @foreach ($ports as $port)
                                                        <option value="{{ $port->id }}" {{ old('loading_port_id') == $port->id ? 'selected' : '' }}>
                                                            {{$port->port_name}}
                                                        </option>
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
                                                <input type="text" class="form-control" name="contact_details">
                                            </div>
                                        </div>
                            
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Commodity Desc:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="commodity_desc">
                                            </div>
                                        </div>
                            
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">KGS/MTS:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="default-select form-control wide me-2" name="kgs_mts">
                                                    <option value="kgs" {{ old('kgs_mts') == 'kgs' ? 'selected' : '' }}>KGS</option>
                                                    <option value="mts" {{ old('kgs_mts') == 'mts' ? 'selected' : '' }}>MTS</option>
                                                </select>
                                            </div>
                                        </div>
                            
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Selling Rate:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="selling_rate">
                                            </div>
                                        </div>
                            
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Enquiry Status:</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="enquiry_status">
                                                    <option value="">Select</option>
                                                    <option value="Active">Active</option>
                                                    <option value="Order">Order</option>
                                                    <option value="Lost">Lost</option>
                                                </select>
                                            </div>
                                        </div>
                            
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">No of container:<span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="no_of_container">
                                            </div>
                                        </div>
                            
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">LCL/FCL:<span class="text-danger">*</span></label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="default-select form-control wide me-2" name="lcl_fcl">
                                                    <option value="">Select</option>
                                                    <option value="lcl">LCL</option>
                                                    <option value="fcl">FCL</option>
                                                </select>
                                            </div>
                                        </div>
                            
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">CBM:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="cbm">
                                            </div>
                                        </div>
                            
                                    </div>
                            
                                    <div class="mb-3 row">
                                        <label class="col-sm-2 col-form-label">Follow-Up:</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control h-100" rows="2" name="follow_up"></textarea>
                                        </div>
                                    </div>
                            
                                    <div class="mb-3 row">
                                        <label class="col-sm-2 col-form-label">Lost Enquiry Remarks:</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control h-100" rows="2" name="lost_enquiry_remarks"></textarea>
                                        </div>
                                    </div>
                            
                                </div>
                            
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <button class="btn btn-warning me-md-2" type="button">Cancel</button>
                                    <button class="btn btn-primary" type="submit">Save</button>
                                </div>
                            </form>
                        </div>

                        <h4>CBM CALCULATOR</h4>
                        <hr>
                        <div class="form-validation">
                            <form class="needs-validation" novalidate id="enquiryCbmForm">
                                @csrf
                                <input type="hidden" name="enquiry_id" class="enquiry_id">
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">
                                                Enquiry No:<span class="text-danger">*</span>
                                            </label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="enquiry_no">
                                            </div>
                                        </div>
                            
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Length:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="length">
                                            </div>
                                        </div>
                            
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Width:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="width">
                                            </div>
                                        </div>
                            
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Height:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="height">
                                            </div>
                                        </div>
                                    </div>
                            
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Quantity:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="quantity">
                                            </div>
                                        </div>
                            
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Total CBM:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="total_cbm">
                                            </div>
                                        </div>
                            
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Total Chg Wt:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="total_chg_wt">
                                            </div>
                                        </div>
                                    </div>
                            
                                </div>
                            
                                <div class="d-grid justify-content-md-start">
                                    <!--<button class="btn btn-danger" type="button">-->
                                    <!--    UPDATE CBM/CHRG WT-->
                                    <!--</button>-->
                                </div>
                                <br>
                            
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <button class="btn btn-warning me-md-2" type="button">Cancel</button>
                                    <button class="btn btn-primary" type="submit">ADD CBM</button>
                                </div>
                            </form>
                        </div>
    
                        <!--<hr>-->
                        <!--<div class="form-validation">-->
                        <!--    <form class="needs-validation" method="POST" id="enquirySellingForm" novalidate>-->
                        <!--        @csrf-->
                        
                        <!--        <input type="hidden" name="enquiry_id" class="enquiry_id">-->
                        <!--        <div class="row">-->
                        <!--            <div class="col-xl-6 col-xxl-6">-->
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">Total Selling Rate:</label>-->
                        <!--                    <div class="col-sm-9">-->
                        <!--                        <input type="text" class="form-control" name="total_selling_rate">-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">Total Buy Rate:</label>-->
                        <!--                    <div class="col-sm-9">-->
                        <!--                        <input type="text" class="form-control" name="total_buy_rate">-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--            <div class="col-xl-6 col-xxl-6">-->
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">Estimated Profit:</label>-->
                        <!--                    <div class="col-sm-9">-->
                        <!--                        <input type="text" class="form-control" name="estimated_profit">-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        
                        <!--        <hr>-->
                        <!--        <h3>Selling Rate</h3>-->
                        <!--        <hr>-->
                        
                        <!--        {{-- ===================== OTHER DETAILS ===================== --}}-->
                        <!--        <h5>Other Details</h5>-->
                        <!--        <div class="row">-->
                        <!--            <div class="col-xl-6 col-xxl-6">-->
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">Ref Id Enquiry:</label>-->
                        <!--                    <div class="col-sm-9">-->
                        <!--                        <input type="text" class="form-control" name="selling_ref_id_enquiry">-->
                        <!--                    </div>-->
                        <!--                </div>-->
                            
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">From Valid Dt:</label>-->
                        <!--                    <div class="col-sm-9">-->
                        <!--                        <input type="date" class="form-control" name="selling_from_valid_dt">-->
                        <!--                    </div>-->
                        <!--                </div>-->
                            
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">To Valid Date:</label>-->
                        <!--                    <div class="col-sm-9">-->
                        <!--                        <input type="date" class="form-control" name="selling_to_valid_date">-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--            <div class="col-xl-6 col-xxl-6">-->
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">Shipping Line:</label>-->
                        <!--                    <div class="col-sm-9 d-flex align-items-center">-->
                        <!--                        <select class="select2 form-control wide me-2" name="shipping_line_id">-->
                        <!--                            <option value="">Select Shipping Line</option>-->
                        <!--                            @foreach ($shipping_lines as $shipping_line)-->
                        <!--                                <option value="{{$shipping_line->id}}" {{ old('shipping_line_id') == $shipping_line->id ? 'selected' : '' }}>-->
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
                        <!--                        <select class="default-select form-control wide me-2" name="selling_activity"></select>-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        
                        <!--        <hr>-->
                        <!--        <h5>Container Size & Type Details</h5>-->
                        
                        <!--        {{-- ===================== CONTAINER DETAILS ===================== --}}-->
                        <!--        <div class="row">-->
                        <!--            <div class="col-xl-6 col-xxl-6">-->
                        <!--                <div class="mb-6 row">-->
                        <!--                    <div class="d-flex gap-3">-->
                            
                        <!--                        <div class="form-check">-->
                        <!--                            <input class="form-check-input" type="checkbox" id="lcl" name="selling_lcl" value="selling_">-->
                        <!--                            <label class="form-check-label" for="lcl">LCL</label>-->
                        <!--                        </div>-->
                            
                        <!--                        <div class="form-check">-->
                        <!--                            <input class="form-check-input" type="checkbox" id="fcl20" name="selling_fcl_20" value="selling_">-->
                        <!--                            <label class="form-check-label" for="fcl20">20 FCL</label>-->
                        <!--                        </div>-->
                            
                        <!--                        <div class="form-check">-->
                        <!--                            <input class="form-check-input" type="checkbox" id="fcl40" name="selling_fcl_40" value="selling_">-->
                        <!--                            <label class="form-check-label" for="fcl40">40 FCL</label>-->
                        <!--                        </div>-->
                            
                        <!--                        <div class="form-check">-->
                        <!--                            <input class="form-check-input" type="checkbox" id="air" name="selling_air" value="selling_">-->
                        <!--                            <label class="form-check-label" for="air">AIR</label>-->
                        <!--                        </div>-->
                            
                        <!--                    </div>-->
                        <!--                </div>-->
                            
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">Container Type:</label>-->
                        <!--                    <div class="col-sm-9 d-flex align-items-center">-->
                        <!--                        <select class="default-select form-control wide me-2" name="selling_container_type"></select>-->
                        <!--                    </div>-->
                        <!--                </div>-->
                            
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">FreeDays:</label>-->
                        <!--                    <div class="col-sm-9">-->
                        <!--                        <input type="date" class="form-control" name="selling_free_days">-->
                        <!--                    </div>-->
                        <!--                </div>-->
                            
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">GSTIN:</label>-->
                        <!--                    <div class="col-sm-9">-->
                        <!--                        <input type="text" class="form-control" name="selling_gstin">-->
                        <!--                    </div>-->
                        <!--                </div>-->
                            
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">SAC_Code:</label>-->
                        <!--                    <div class="col-sm-9">-->
                        <!--                        <input type="text" class="form-control" name="selling_sac_code">-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--            </div>-->
                            
                        <!--            <div class="col-xl-6 col-xxl-6">-->
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">CGST:</label>-->
                        <!--                    <div class="col-sm-9">-->
                        <!--                        <input type="text" class="form-control" name="container_cgst">-->
                        <!--                    </div>-->
                        <!--                </div>-->
                            
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">SGST:</label>-->
                        <!--                    <div class="col-sm-9">-->
                        <!--                        <input type="text" class="form-control" name="container_sgst">-->
                        <!--                    </div>-->
                        <!--                </div>-->
                            
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">IGST:</label>-->
                        <!--                    <div class="col-sm-9">-->
                        <!--                        <input type="text" class="form-control" name="container_igst">-->
                        <!--                    </div>-->
                        <!--                </div>-->
                            
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">Total:</label>-->
                        <!--                    <div class="col-sm-9">-->
                        <!--                        <input type="text" class="form-control" name="container_total">-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        
                        <!--        <hr>-->
                        <!--        <h5>Charges</h5>-->
                        
                        <!--        {{-- ===================== CHARGES ===================== --}}-->
                        <!--        <div class="row">-->
                                    <!-- LEFT COLUMN -->
                        <!--            <div class="col-xl-6 col-xxl-6">-->
                            
                                        <!-- Charge Name -->
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-4 col-form-label">-->
                        <!--                        Charge_Name:<span class="text-danger">*</span>-->
                        <!--                    </label>-->
                        <!--                    <div class="col-sm-8 d-flex align-items-center gap-2">-->
                        <!--                        <select name="selling_charge_id" id="selling_charge_name"-->
                        <!--                            class="form-control select2">-->
                        <!--                            <option value="">Select</option>-->
                        <!--                            @foreach ($charges as $charge)-->
                        <!--                                <option value="{{ $charge->id }}">-->
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
                            
                                        <!-- Currency -->
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-4 col-form-label">Currency:</label>-->
                        <!--                    <div class="col-sm-8">-->
                        <!--                        <select name="selling_currency" class="form-control">-->
                        <!--                            <option value="">Select currency</option>-->
                        <!--                            <option value="AED">AED</option>-->
                        <!--                            <option value="AUD">AUD</option>-->
                        <!--                            <option value="BGN">BGN</option>-->
                        <!--                            <option value="BRL">BRL</option>-->
                        <!--                            <option value="CAD">CAD</option>-->
                        <!--                            <option value="CHF">CHF</option>-->
                        <!--                            <option value="CNY">CNY</option>-->
                        <!--                            <option value="CSD">CSD</option>-->
                        <!--                            <option value="CZK">CZK</option>-->
                        <!--                            <option value="DKK">DKK</option>-->
                        <!--                            <option value="EEK">EEK</option>-->
                        <!--                            <option value="EGP">EGP</option>-->
                        <!--                            <option value="EUR">EUR</option>-->
                        <!--                            <option value="GBP">GBP</option>-->
                        <!--                            <option value="HKD">HKD</option>-->
                        <!--                            <option value="HRK">HRK</option>-->
                        <!--                            <option value="HUF">HUF</option>-->
                        <!--                            <option value="IDR">IDR</option>-->
                        <!--                            <option value="ILS">ILS</option>-->
                        <!--                            <option value="INR" selected>INR</option>-->
                        <!--                            <option value="ISK">ISK</option>-->
                        <!--                            <option value="JPY">JPY</option>-->
                        <!--                            <option value="MXP">MXP</option>-->
                        <!--                            <option value="MYR">MYR</option>-->
                        <!--                            <option value="NOK">NOK</option>-->
                        <!--                            <option value="NZD">NZD</option>-->
                        <!--                            <option value="PHP">PHP</option>-->
                        <!--                            <option value="PLN">PLN</option>-->
                        <!--                            <option value="ROL">ROL</option>-->
                        <!--                            <option value="RUR">RUR</option>-->
                        <!--                            <option value="SAR">SAR</option>-->
                        <!--                            <option value="SEK">SEK</option>-->
                        <!--                            <option value="SGD">SGD</option>-->
                        <!--                            <option value="SIT">SIT</option>-->
                        <!--                            <option value="SKK">SKK</option>-->
                        <!--                            <option value="THB">THB</option>-->
                        <!--                            <option value="TRL">TRL</option>-->
                        <!--                            <option value="TWD">TWD</option>-->
                        <!--                            <option value="UAH">UAH</option>-->
                        <!--                            <option value="US">US</option>-->
                        <!--                            <option value="USD">USD</option>-->
                        <!--                        </select>-->
                        <!--                    </div>-->
                        <!--                </div>-->
                            
                                        <!-- Rate Basis -->
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-4 col-form-label">Rate_Basis:</label>-->
                        <!--                    <div class="col-sm-8">-->
                        <!--                        <select name="selling_rate_basis" class="form-control">-->
                        <!--                            <option value="">select</option>-->
                        <!--                            <option value="LUMPSUM">LUMPSUM</option>-->
                        <!--                            <option value="CBMWISE">CBMWISE</option>-->
                        <!--                            <option value="PERCONT">PER CONTAINER</option>-->
                        <!--                            <option value="GWTWISE">GWTWISE</option>-->
                        <!--                            <option value="CHGWTWISE">CHGWTWISE</option>-->
                        <!--                            <option value="PERKG">PER KG</option>-->
                        <!--                            <option value="PERCBM">PER CBM</option>-->
                        <!--                            <option value="PERINVOICE">PER INVOICE</option>-->
                        <!--                            <option value="PERUNIT" selected>PER UNIT</option>-->
                        <!--                        </select>-->
                        <!--                    </div>-->
                        <!--                </div>-->
                            
                                        <!-- Origin / Dest -->
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-4 col-form-label">Origin_Dest:</label>-->
                        <!--                    <div class="col-sm-8">-->
                        <!--                        <select name="selling_origin_dest" class="form-control">-->
                        <!--                            <option value="origin">Origin</option>-->
                        <!--                            <option value="destination">Destination</option>-->
                        <!--                        </select>-->
                        <!--                    </div>-->
                        <!--                </div>-->
                            
                                        <!-- Exchange Rate -->
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-4 col-form-label">Exch.Rate:</label>-->
                        <!--                    <div class="col-sm-8">-->
                        <!--                        <input type="text" class="form-control"-->
                        <!--                            name="selling_exchange_rate" value="1">-->
                        <!--                    </div>-->
                        <!--                </div>-->
                            
                                        <!-- Freight -->
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-4 col-form-label">Freight:</label>-->
                        <!--                    <div class="col-sm-8">-->
                        <!--                        <input type="text" class="form-control"-->
                        <!--                            name="selling_freight" readonly>-->
                        <!--                    </div>-->
                        <!--                </div>-->
                            
                                        <!-- Per Unit -->
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-4 col-form-label">PerUnit:</label>-->
                        <!--                    <div class="col-sm-8">-->
                        <!--                        <input type="text" class="form-control"-->
                        <!--                            name="selling_per_unit">-->
                        <!--                    </div>-->
                        <!--                </div>-->
                            
                                        <!-- Rate -->
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-4 col-form-label">Rate:</label>-->
                        <!--                    <div class="col-sm-8">-->
                        <!--                        <input type="text" class="form-control"-->
                        <!--                            name="selling_total_unit">-->
                        <!--                    </div>-->
                        <!--                </div>-->
                            
                        <!--            </div>-->
                            
                                    <!-- RIGHT COLUMN -->
                        <!--            <div class="col-xl-6 col-xxl-6">-->
                            
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-4 col-form-label">GSTIN:</label>-->
                        <!--                    <div class="col-sm-8">-->
                        <!--                        <input type="text" class="form-control"-->
                        <!--                            name="selling_gstin_charge">-->
                        <!--                    </div>-->
                        <!--                </div>-->
                            
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-4 col-form-label">SAC_Code:</label>-->
                        <!--                    <div class="col-sm-8">-->
                        <!--                        <input type="text" class="form-control"-->
                        <!--                            name="selling_sac_code_charge" readonly>-->
                        <!--                    </div>-->
                        <!--                </div>-->
                            
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-4 col-form-label">GST:</label>-->
                        <!--                    <div class="col-sm-8">-->
                        <!--                        <input type="text" class="form-control"-->
                        <!--                            name="selling_gst">-->
                        <!--                    </div>-->
                        <!--                </div>-->
                            
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-4 col-form-label">-->
                        <!--                        GST(Y/N):<span class="text-danger">*</span>-->
                        <!--                    </label>-->
                        <!--                    <div class="col-sm-8">-->
                        <!--                        <select name="selling_gst_applicable" class="form-control">-->
                        <!--                            <option value="">Select</option>-->
                        <!--                            <option value="Y" selected>Yes</option>-->
                        <!--                            <option value="N">No</option>-->
                        <!--                        </select>-->
                        <!--                    </div>-->
                        <!--                </div>-->
                            
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-4 col-form-label">CGST:</label>-->
                        <!--                    <div class="col-sm-8">-->
                        <!--                        <input type="text" class="form-control"-->
                        <!--                            name="selling_cgst" readonly>-->
                        <!--                    </div>-->
                        <!--                </div>-->
                            
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-4 col-form-label">SGST:</label>-->
                        <!--                    <div class="col-sm-8">-->
                        <!--                        <input type="text" class="form-control"-->
                        <!--                            name="selling_sgst" readonly>-->
                        <!--                    </div>-->
                        <!--                </div>-->
                            
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-4 col-form-label">IGST:</label>-->
                        <!--                    <div class="col-sm-8">-->
                        <!--                        <input type="text" class="form-control"-->
                        <!--                            name="selling_igst" readonly>-->
                        <!--                    </div>-->
                        <!--                </div>-->
                            
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-4 col-form-label">Total:</label>-->
                        <!--                    <div class="col-sm-8">-->
                        <!--                        <input type="text" class="form-control"-->
                        <!--                            name="selling_total" readonly>-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        
                        <!--        {{-- ===================== ACTION BUTTONS ===================== --}}-->
                        <!--        <div class="mt-4">-->
                        <!--            <button type="submit" class="btn btn-primary btn-sm">-->
                        <!--                ADD / UPDATE SELLING RATE-->
                        <!--            </button>-->
                        
                                    <!--<button type="button" class="btn btn-secondary btn-sm">-->
                                    <!--    PRINT QUOTATION-->
                                    <!--</button>-->
                        <!--        </div>-->
                        
                        <!--    </form>-->
                        <!--</div>-->
                        <!--<hr>-->
                        <!--<h3>Buy Rate</h3>-->

                        <!--<div class="form-validation">-->
                        <!--    <form class="needs-validation" method="POST" id="enquiryBuyForm" novalidate>-->
                        <!--        @csrf-->
                        <!--        <hr>-->
                        <!--        <h4>Other Details Buy Rate</h4>-->
                        <!--        <hr>-->
                            
                        <!--        <input type="hidden" name="enquiry_id" class="enquiry_id">-->
                        <!--        <div class="row">-->
                        <!--            <div class="col-xl-6 col-xxl-6">-->
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">Ref Id Enquiry:</label>-->
                        <!--                    <div class="col-sm-9">-->
                        <!--                        <input type="text" class="form-control" name="buy_ref_id_enquiry">-->
                        <!--                    </div>-->
                        <!--                </div>-->
                            
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">To Valid Date:</label>-->
                        <!--                    <div class="col-sm-9">-->
                        <!--                        <input type="date" class="form-control" name="buy_to_valid_date">-->
                        <!--                    </div>-->
                        <!--                </div>-->
                            
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">Vendor:</label>-->
                        <!--                    <div class="col-sm-9">-->
                        <!--                        <input type="text" class="form-control" name="buy_vendor">-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--            </div>-->
                            
                        <!--            <div class="col-xl-6 col-xxl-6">-->
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">From Valid Dt:</label>-->
                        <!--                    <div class="col-sm-9">-->
                        <!--                        <input type="date" class="form-control" name="buy_from_valid_dt">-->
                        <!--                    </div>-->
                        <!--                </div>-->
                            
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">Activity:</label>-->
                        <!--                    <div class="col-sm-9">-->
                        <!--                        <select class="form-control" name="buy_activity">-->
                        <!--                            <option value="">Select</option>-->
                        <!--                            <option value="c">C</option>-->
                        <!--                            <option value="p">P</option>-->
                        <!--                        </select>-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--        </div>-->
                            
                        <!--        <hr>-->
                        <!--        <h4>Container Size & Type Details</h4>-->
                        <!--        <hr>-->
                            
                        <!--        <div class="row">-->
                        <!--            <div class="col-xl-6 col-xxl-6">-->
                        <!--                <div class="d-flex gap-3 mb-3">-->
                        <!--                    <div class="form-check">-->
                        <!--                        <input class="form-check-input" type="checkbox" name="buy_lcl" value="1">-->
                        <!--                        <label class="form-check-label">LCL</label>-->
                        <!--                    </div>-->
                            
                        <!--                    <div class="form-check">-->
                        <!--                        <input class="form-check-input" type="checkbox" name="buy_fcl20" value="1">-->
                        <!--                        <label class="form-check-label">20 FCL</label>-->
                        <!--                    </div>-->
                            
                        <!--                    <div class="form-check">-->
                        <!--                        <input class="form-check-input" type="checkbox" name="buy_fcl40" value="1">-->
                        <!--                        <label class="form-check-label">40 FCL</label>-->
                        <!--                    </div>-->
                            
                        <!--                    <div class="form-check">-->
                        <!--                        <input class="form-check-input" type="checkbox" name="buy_air" value="1">-->
                        <!--                        <label class="form-check-label">AIR</label>-->
                        <!--                    </div>-->
                        <!--                </div>-->
                            
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">Container Type:</label>-->
                        <!--                    <div class="col-sm-9">-->
                        <!--                        <select class="default-select form-control" name="buy_container"></select>-->
                        <!--                    </div>-->
                        <!--                </div>-->
                            
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">FreeDays:</label>-->
                        <!--                    <div class="col-sm-9">-->
                        <!--                        <input type="date" class="form-control" name="buy_free_days">-->
                        <!--                    </div>-->
                        <!--                </div>-->
                            
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">GSTIN:</label>-->
                        <!--                    <div class="col-sm-9">-->
                        <!--                        <input type="text" class="form-control" name="buy_gstin">-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--            </div>-->
                            
                        <!--            <div class="col-xl-6 col-xxl-6">-->
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">CGST:</label>-->
                        <!--                    <div class="col-sm-9">-->
                        <!--                        <input type="text" class="form-control" name="buy_cgst">-->
                        <!--                    </div>-->
                        <!--                </div>-->
                            
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">SGST:</label>-->
                        <!--                    <div class="col-sm-9">-->
                        <!--                        <input type="text" class="form-control" name="buy_sgst">-->
                        <!--                    </div>-->
                        <!--                </div>-->
                            
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">IGST:</label>-->
                        <!--                    <div class="col-sm-9">-->
                        <!--                        <input type="text" class="form-control" name="buy_igst">-->
                        <!--                    </div>-->
                        <!--                </div>-->
                            
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">Total:</label>-->
                        <!--                    <div class="col-sm-9">-->
                        <!--                        <input type="text" class="form-control" name="buy_total">-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--        </div>-->
                                
                        <!--        <hr>-->
                        <!--        <h5>Charges</h5>-->
                            
                        <!--        <div class="row">-->
                        <!--            <div class="col-xl-6 col-xxl-6">-->
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">Charge_Name:<span class="text-danger">*</span></label>-->
                        <!--                    <div class="col-sm-9 d-flex align-items-center gap-2">-->
                        <!--                        <select name="buy_charge_id" id="buy_charge_name" class="form-control wide me-2 select2">-->
                        <!--                            <option value="">select</option>-->
                        <!--                            @foreach ($charges as $charge)-->
                        <!--                                <option value="{{$charge->id}}">{{$charge->charge_name}}</option>-->
                        <!--                            @endforeach-->
                        <!--                        </select>-->
                        <!--                        <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#chargesNames">-->
                        <!--                            <i class="bi bi-plus-lg">+</i>-->
                        <!--                        </button>-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">Currency:</label>-->
                        <!--                    <div class="col-sm-9 d-flex align-items-center">-->
                        <!--                        <select class="form-control wide me-2" name="buy_currency" placeholder="Select">-->
                        <!--                            <option value="">Select currency</option>-->
                        <!--                            <option value="AED">AED</option>-->
                        <!--                            <option value="AUD">AUD</option>-->
                        <!--                            <option value="BGN">BGN</option>-->
                        <!--                            <option value="BRL">BRL</option>-->
                        <!--                            <option value="CAD">CAD</option>-->
                        <!--                            <option value="CHF">CHF</option>-->
                        <!--                            <option value="CNY">CNY</option>-->
                        <!--                            <option value="CSD">CSD</option>-->
                        <!--                            <option value="CZK">CZK</option>-->
                        <!--                            <option value="DKK">DKK</option>-->
                        <!--                            <option value="EEK">EEK</option>-->
                        <!--                            <option value="EGP">EGP</option>-->
                        <!--                            <option value="EUR">EUR</option>-->
                        <!--                            <option value="GBP">GBP</option>-->
                        <!--                            <option value="HKD">HKD</option>-->
                        <!--                            <option value="HRK">HRK</option>-->
                        <!--                            <option value="HUF">HUF</option>-->
                        <!--                            <option value="IDR">IDR</option>-->
                        <!--                            <option value="ILS">ILS</option>-->
                        <!--                            <option value="INR" selected>INR</option>-->
                        <!--                            <option value="ISK">ISK</option>-->
                        <!--                            <option value="JPY">JPY</option>-->
                        <!--                            <option value="MXP">MXP</option>-->
                        <!--                            <option value="MYR">MYR</option>-->
                        <!--                            <option value="NOK">NOK</option>-->
                        <!--                            <option value="NZD">NZD</option>-->
                        <!--                            <option value="PHP">PHP</option>-->
                        <!--                            <option value="PLN">PLN</option>-->
                        <!--                            <option value="ROL">ROL</option>-->
                        <!--                            <option value="RUR">RUR</option>-->
                        <!--                            <option value="SAR">SAR</option>-->
                        <!--                            <option value="SEK">SEK</option>-->
                        <!--                            <option value="SGD">SGD</option>-->
                        <!--                            <option value="SIT">SIT</option>-->
                        <!--                            <option value="SKK">SKK</option>-->
                        <!--                            <option value="THB">THB</option>-->
                        <!--                            <option value="TRL">TRL</option>-->
                        <!--                            <option value="TWD">TWD</option>-->
                        <!--                            <option value="UAH">UAH</option>-->
                        <!--                            <option value="US">US</option>-->
                        <!--                            <option value="USD">USD</option>-->
                        <!--                        </select>-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">Rate_Basis:</label>-->
                        <!--                    <div class="col-sm-9 d-flex align-items-center">-->
                        <!--                        <select class="form-control wide me-2" name="buy_rate_basic" placeholder="Select">-->
                        <!--                            <option value="">select</option>-->
                        <!--                            <option value="LUMPSUM">LUMPSUM</option>-->
                        <!--                            <option value="CBMWISE">CBMWISE</option>-->
                        <!--                            <option value="PERCONT">PER CONTAINER</option>-->
                        <!--                            <option value="GWTWISE">GWTWISE</option>-->
                        <!--                            <option value="CHGWTWISE">CHGWTWISE</option>-->
                        <!--                            <option value="PERKG">PER KG</option>-->
                        <!--                            <option value="PERCBM">PER CBM</option>-->
                        <!--                            <option value="PERINVOICE">PER INVOICE</option>-->
                        <!--                            <option value="PERUNIT" selected>PER UNIT</option>-->
                        <!--                        </select>-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">Origin_Dest:</label>-->
                        <!--                    <div class="col-sm-9 d-flex align-items-center">-->
                        <!--                        <select class="form-control wide me-2" placeholder="Select" name="buy_origin_dest"></select>-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">Exch.Rate:</label>-->
                        <!--                    <div class="col-sm-9">-->
                        <!--                        <input type="text" class="form-control" name="buy_exchange_rate">-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">Freight:</label>-->
                        <!--                    <div class="col-sm-9">-->
                        <!--                        <input type="text" class="form-control" name="buy_freight">-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">SAC_Code:</label>-->
                        <!--                    <div class="col-sm-9">-->
                        <!--                        <input type="text" class="form-control" name="buy_sac_code">-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--            </div>-->
    
                        <!--            <div class="col-xl-6 col-xxl-6">-->
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">GST:</label>-->
                        <!--                    <div class="col-sm-9">-->
                        <!--                        <input type="text" class="form-control" name="buy_gst">-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">Prep/Coll:</label>-->
                        <!--                    <div class="col-sm-9">-->
                        <!--                        <select class="form-control" name="buy_prep_coll">-->
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
                        <!--                        <select class="form-control wide me-2" placeholder="Select" name="buy_gst_y_n">-->
                        <!--                            <option value="">Select</option>-->
                        <!--                            <option value="Y" selected>Yes</option>-->
                        <!--                            <option value="N">No</option>-->
                        <!--                        </select>-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">PerUnit:</label>-->
                        <!--                    <div class="col-sm-9">-->
                        <!--                        <input type="text" class="form-control" name="buy_per_unit">-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">Rate:</label>-->
                        <!--                    <div class="col-sm-9">-->
                        <!--                        <input type="text" class="form-control" name="buy_rate">-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--                <div class="mb-3 row">-->
                        <!--                    <label class="col-sm-3 col-form-label">Amount:</label>-->
                        <!--                    <div class="col-sm-9">-->
                        <!--                        <input type="text" class="form-control" name="buy_amount">-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--        </div>-->
                            
                        <!--        <button type="submit" class="btn btn-primary btn-sm">-->
                        <!--            ADD / UPDATE BUY RATE-->
                        <!--        </button>-->
                            
                        <!--    </form>-->
                        <!--</div>-->

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
                    const chargeableWeight = cbm * 1000;
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

    <script>
        $(document).ready(function () {

            function calculateTotals() {
        
                let perUnit = parseFloat($('input[name="selling_per_unit"]').val()) || 0;
                let rate = parseFloat($('input[name="selling_total_unit"]').val()) || 0;
                let exchRate = parseFloat($('input[name="selling_exchange_rate"]').val()) || 1;
                let gstPercent = parseFloat($('input[name="selling_gst"]').val()) || 0;
                let gstApplicable = $('select[name="selling_gst_applicable"]').val();
        
                // Freight calculation
                let freight = perUnit * rate * exchRate;
                $('input[name="selling_freight"]')
                    .val(freight.toFixed(2))
                    .css('background', '#ded9d9')
                    .prop('readonly', true);
        
                let cgst = 0, sgst = 0, igst = 0;
        
                // GST calculation
                if (gstApplicable === 'Y') {
                    cgst = (gstPercent / 2) * freight / 100;
                    sgst = (gstPercent / 2) * freight / 100;
                }
        
                let total = freight + cgst + sgst + igst;
        
                // Update GST breakup
                $('input[name="selling_cgst"]')
                    .val(cgst.toFixed(2))
                    .css('background', '#ded9d9')
                    .prop('readonly', true);
        
                $('input[name="selling_sgst"]')
                    .val(sgst.toFixed(2))
                    .css('background', '#ded9d9')
                    .prop('readonly', true);
        
                $('input[name="selling_igst"]')
                    .val(igst.toFixed(2))
                    .css('background', '#ded9d9')
                    .prop('readonly', true);
        
                // Final total
                $('input[name="selling_total"]')
                    .val(total.toFixed(2))
                    .css('background', '#ded9d9')
                    .prop('readonly', true);
            }
        
            // Recalculate on change
            $('input[name^="selling_"], select[name^="selling_"]').on('keyup change', function () {
                calculateTotals();
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
    </script>
    <script>
        $(document).ready(function () {

            // shipping line
            $('#shippingLineForm').on('submit', function(e) {
                e.preventDefault();
        
                $.ajax({
                    url: "{{ route('new-shipping-line.store') }}", // route name
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        
                        if(!response.status){
                            $('#shipping-error-msg').text(response.message).css('color', 'red');
                            return;
                        }
                        
                        // Add the new option to select dropdowns
                        $('select[name="shipping_line_id"]').each(function() {
                            $(this).append(`<option value="${response.id}" selected>${response.shipping_line_name}</option>`);
                        });
        
                        // Close modal and reset form
                        $('#shippingLineForm')[0].reset();
                        $('#shippingModelDetails').modal('hide');
                    },
                    error: function(xhr) {
                        alert('Failed to add Shipping line');
        
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
                            const portName = response.port.name; // make sure backend key is `name`
            
                            // Step 1: Add new option to all port dropdowns
                            $('select[name$="_port_id"]').each(function () {
                                const select = $(this);
            
                                // Add only if doesn't already exist
                                if (select.find('option[value="' + portId + '"]').length === 0) {
                                    const newOption = new Option(portName, portId, false, false);
                                    select.append(newOption);
                                }
            
                                // Refresh Select2
                                if (select.hasClass('select2')) {
                                    select.trigger('change.select2');
                                }
                            });
            
                            // Step 2: Select the new port in the one that triggered the modal
                            if (activePortSelect) {
                                const activeSelect = $('select[name="' + activePortSelect + '"]');
            
                                if (activeSelect.length) {
                                    activeSelect.val(portId).trigger('change');
                                }
                            }
            
                            // Step 3: Reset form + modal
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
                                'notify2_id'
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
        });
    </script>
    <script>
        $(document).ready(function () {
    
            $('#enquiryFirstForm').on('submit', function (e) {
                e.preventDefault();
        
                let formData = $(this).serialize();
        
                $.ajax({
                    url: "{{ route('enquiry.store') }}", // make sure route exists
                    type: "POST",
                    data: formData,
                    beforeSend: function () {
                        Swal.fire({
                            title: 'Saving...',
                            text: 'Please wait',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                    },
                    success: function (res) {
                        if (res.status) {
                            // store primary key for next forms
                            $('.enquiry_id').val(res.enquiry_id);
        
                            Swal.fire({
                                icon: 'success',
                                title: 'Saved',
                                text: 'Enquiry saved successfully'
                            });
                        }
                    },
                    error: function (xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Something went wrong'
                        });
                    }
                });
            });
        
        });
    </script>
    <script>
        $(document).ready(function () {

            $('#enquiryCbmForm').on('submit', function (e) {
                e.preventDefault();
            
                let data = $(this).serialize();
        
                $.ajax({
                    url: "{{ route('enquiry.cbm.update') }}",
                    type: "POST",
                    data: data,
                    beforeSend: function () {
                        Swal.fire({
                            title: 'Updating CBM...',
                            text: 'Please wait',
                            allowOutsideClick: false,
                            didOpen: () => Swal.showLoading()
                        });
                    },
                    success: function (res) {
                        if (res.status) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Updated',
                                text: res.message
                            });
                        }
                    },
                    error: function (xhr) {
        
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            let msg = '';
        
                            $.each(errors, function (k, v) {
                                msg += v[0] + '<br>';
                            });
        
                            Swal.fire({
                                icon: 'warning',
                                title: 'Validation Error',
                                html: msg
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Something went wrong'
                            });
                        }
                    }
                });
            });
        
        });

    </script>
    <script>
        $(document).ready(function () {
            $('#enquirySellingForm').on('submit', function (e) {
                e.preventDefault();
        
                let data = $(this).serialize();
        
                $.ajax({
                    url: "{{ route('enquiry.selling.update') }}",
                    type: "POST",
                    data: data,
                    beforeSend: function () {
                        Swal.fire({
                            title: 'Updating...',
                            text: 'Please wait',
                            allowOutsideClick: false,
                            didOpen: () => Swal.showLoading()
                        });
                    },
                    success: function (res) {
                        if (res.status) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Updated',
                                text: res.message
                            });
                        }
                    },
                    error: function (xhr) {
        
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            let msg = '';
        
                            $.each(errors, function (k, v) {
                                msg += v[0] + '<br>';
                            });
        
                            Swal.fire({
                                icon: 'warning',
                                title: 'Validation Error',
                                html: msg
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Something went wrong'
                            });
                        }
                    }
                });
            });
        
        });

    </script>
    <script>
        $(document).ready(function () {

            $('#enquiryBuyForm').on('submit', function (e) {
                e.preventDefault();
        
                let data = $(this).serialize();
        
                $.ajax({
                    url: "{{ route('enquiry.buy.update') }}",
                    type: "POST",
                    data: data,
                    beforeSend: function () {
                        Swal.fire({
                            title: 'Updating Buy Rate...',
                            text: 'Please wait',
                            allowOutsideClick: false,
                            didOpen: () => Swal.showLoading()
                        });
                    },
                    success: function (res) {
                        if (res.status) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Updated',
                                text: res.message
                            });
                        }
                    },
                    error: function (xhr) {
        
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            let msg = '';
        
                            $.each(errors, function (k, v) {
                                msg += v[0] + '<br>';
                            });
        
                            Swal.fire({
                                icon: 'warning',
                                title: 'Validation Error',
                                html: msg
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Something went wrong'
                            });
                        }
                    }
                });
            });
        
        });

    </script>

@endpush
