@extends('admin-main.layouts.default')
@section('content')
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
                            <form class="needs-validation" novalidate>
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Reference ID:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Port of Discharge:<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="default-select form-control wide me-2"
                                                    placeholder="Select"></select>
                                                <button type="button" class="btn btn-sm btn-outline-primary"
                                                    data-bs-toggle="modal" data-bs-target="#portDetailsModal">
                                                    <i class="bi bi-plus-lg">+</i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Party:<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="default-select form-control wide me-2"
                                                    placeholder="Select"></select>
                                                <button type="button" class="btn btn-sm btn-outline-primary"
                                                    data-bs-toggle="modal" data-bs-target="#partyDetailsModal">
                                                    <i class="bi bi-plus-lg">+</i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Inco Terms:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="default-select form-control wide me-2"
                                                    placeholder="Select"></select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Gross Weight:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Buying Rate:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Shipment Type:<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="default-select form-control wide me-2"
                                                    placeholder="Select"></select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">ETA/ETD:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Sales Person:<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="default-select form-control wide me-2"
                                                    placeholder="Select"></select>
                                                <button type="button" class="btn btn-sm btn-outline-primary"
                                                    data-bs-toggle="modal" data-bs-target="#partyDetailsModal">
                                                    <i class="bi bi-plus-lg">+</i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">No of Pkgs:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Chargeable Weight:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Enquiry Date:</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Port of Loading:<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="default-select form-control wide me-2"
                                                    placeholder="Select"></select>
                                                <button type="button" class="btn btn-sm btn-outline-primary"
                                                    data-bs-toggle="modal" data-bs-target="#portDetailsModal">
                                                    <i class="bi bi-plus-lg">+</i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Contact Details:</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Commodity Desc:</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">KGS/MTS:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="default-select form-control wide me-2"
                                                    placeholder="Select"></select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Selling Rate:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <input type="date" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-xxl-6">
                                            <div class="mb-3 row">
                                                <label class="col-sm-3 col-form-label">Enquiry Status:</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control">
                                                        <option value="" class="has-arrow">Select</option>
                                                        <option value="Active">Active</option>
                                                        <option value="Order">Order</option>
                                                        <option value="Lost">Lost</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">No of container:<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">LCL/FCL:<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="default-select form-control wide me-2"
                                                    placeholder="Select"></select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">CBM:</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-2 col-form-label">Follow-Up:</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control h-100" id="validationCustom04" rows="2"></textarea>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-2 col-form-label">Lost Enquiry Remarks:</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control h-100" id="validationCustom04" rows="2"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <button class="btn btn-warning me-md-2" type="button">Cancel</button>
                                    <button class="btn btn-primary" type="button">Save</button>
                                </div>
                            </form>
                        </div>

                        <h4>CBM CALCULATOR</h4>
                        <hr>
                        <div class="form-validation">
                            <form class="needs-validation" novalidate>
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Enquiry No:<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Length:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Width:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Height:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Quantity: </label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Total CBM:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Total Chg Wt:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-grid justify-content-md-start">
                                    <button class="btn btn-danger">UPDATE CBM/CHRG WT</button>
                                </div><br>
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <button class="btn btn-warning me-md-2" type="button">Cancel</button>
                                    <button class="btn btn-primary" type="button">ADD CBM</button>
                                </div>
                            </form>
                        </div>

                        <hr>
                        <div class="form-validation">
                            <form class="needs-validation" novalidate>
                                <div class="row">
                                    <div class="col-xl-6 col-xxl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Total Selling Rate:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Total Buy Rate:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-xxl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Estimated Profit:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <hr>
                        <h4>Selling Rate</h4>
                        <hr>
                        <div class="form-validation">
                            <h5>Other Details</h5>
                            <form class="needs-validation" novalidate>
                                <div class="row">
                                    <div class="col-xl-6 col-xxl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Ref Id Enquiry:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">From Valid Dt:</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">To Valid Date:</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-xxl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Shipping Line/Air Line:<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="default-select form-control wide me-2"
                                                    placeholder="Select"></select>
                                                <button type="button" class="btn btn-sm btn-outline-primary"
                                                    data-bs-toggle="modal" data-bs-target="#partyDetailsModal">
                                                    <i class="bi bi-plus-lg">+</i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Activity:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="default-select form-control wide me-2"
                                                    placeholder="Select"></select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <hr>
                            <h5>Container Size & Type Details</h5>
                            <form class="needs-validation" novalidate>
                                <div class="row">
                                    <div class="col-xl-6 col-xxl-6">
                                        <div class="mb-6 row">
                                            <div class="d-flex gap-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="lcl">
                                                    <label class="form-check-label" for="lcl">
                                                        LCL
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="fcl20">
                                                    <label class="form-check-label" for="fcl20">
                                                        20 FCL
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="fcl40">
                                                    <label class="form-check-label" for="fcl40">
                                                        40 FCL
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="air">
                                                    <label class="form-check-label" for="air">
                                                        AIR
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Container Type:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="default-select form-control wide me-2"
                                                    placeholder="Select"></select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">FreeDays:</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">GSTIN:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">SAC_Code:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-xxl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">CGST:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">SGST:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">IGST:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Total:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <hr>
                            <h5>Charges</h5>
                            <form class="needs-validation" novalidate>
                                <div class="row">
                                    <div class="col-xl-6 col-xxl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Charge_Name:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="default-select form-control wide me-2"
                                                    placeholder="Select"></select>
                                                <button type="button" class="btn btn-sm btn-outline-primary"
                                                    data-bs-toggle="modal" data-bs-target="#ChargeDetailsModal">
                                                    <i class="bi bi-plus-lg">+</i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Currency:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="default-select form-control wide me-2"
                                                    placeholder="Select"></select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Rate_Basis:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="default-select form-control wide me-2"
                                                    placeholder="Select"></select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Origin_Dest:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="default-select form-control wide me-2"
                                                    placeholder="Select"></select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Exch.Rate:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Freight:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-xxl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">GST:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Prep/Coll:</label>
                                            <div class="col-sm-9">
                                                <select class="form-control">
                                                    <option>Select</option>
                                                    <option value="c">C</option>
                                                    <option value="p">P</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">GST(Y/N):<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="default-select form-control wide me-2"
                                                    placeholder="Select"></select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">PerUnit:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Rate:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Amount:<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary btn-sm">ADD / UPDATE SELLING RATE</button>
                                <button type="button" class="btn btn-primary btn-sm">PRINT QUOTATION</button>
                                <button type="button" class="btn btn-danger btn-sm">ADD CHARGES FROM FIXED
                                    CHARGE</button>
                            </form>
                        </div>
                        <hr>
                        <h3>Buy Rate</h3>
                        <form class="needs-validation" novalidate>
                            <hr>
                            <h4>Other Details Buy Rate</h4>
                            <hr>
                            <div class="row">
                                <div class="col-xl-6 col-xxl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Ref Id Enquiry:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">To Valid Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Vendor:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="default-select form-control wide me-2"
                                                placeholder="Select"></select>
                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                data-bs-toggle="modal" data-bs-target="#partyDetailsModal">
                                                <i class="bi bi-plus-lg">+</i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-xxl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">From Valid Dt:</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Activity:</label>
                                        <div class="col-sm-9">
                                            <select class="form-control">
                                                <option>Select</option>
                                                {{-- <option value="c">C</option>
                                                <option value="p">P</option> --}}
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <hr>
                            <h4>Container Size & Type Details</h4>
                            <hr>
                            <div class="row">
                                <div class="col-xl-6 col-xxl-6">
                                    <div class="mb-6 row">
                                        <div class="d-flex gap-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="lcl">
                                                <label class="form-check-label" for="lcl">
                                                    LCL
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="fcl20">
                                                <label class="form-check-label" for="fcl20">
                                                    20 FCL
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="fcl40">
                                                <label class="form-check-label" for="fcl40">
                                                    40 FCL
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="air">
                                                <label class="form-check-label" for="air">
                                                    AIR
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Container Type:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="default-select form-control wide me-2"
                                                placeholder="Select"></select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">FreeDays:</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">GSTIN:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">SAC_Code:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-xxl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">CGST:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">SGST:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">IGST:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Total:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>


                        <hr>
                        <h5>Charges</h5>
                        <form class="needs-validation" novalidate>
                            <div class="row">
                                <div class="col-xl-6 col-xxl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Charge_Name:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="default-select form-control wide me-2"
                                                placeholder="Select"></select>
                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                data-bs-toggle="modal" data-bs-target="#ChargeDetailsModal">
                                                <i class="bi bi-plus-lg">+</i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Currency:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="default-select form-control wide me-2"
                                                placeholder="Select"></select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Rate_Basis:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="default-select form-control wide me-2"
                                                placeholder="Select"></select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Origin_Dest:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="default-select form-control wide me-2"
                                                placeholder="Select"></select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Exch.Rate:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Freight:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-xxl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">GST:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Prep/Coll:</label>
                                        <div class="col-sm-9">
                                            <select class="form-control">
                                                <option>Select</option>
                                                <option value="c">C</option>
                                                <option value="p">P</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">GST(Y/N):<span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="default-select form-control wide me-2"
                                                placeholder="Select"></select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">PerUnit:<span
                                            class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Rate:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Amount:<span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary btn-sm">ADD / UPDATE BUY RATE</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Ocean Vsl -->
    <div class="modal fade" id="oceanVslModal" tabindex="-1" aria-labelledby="oceanVslModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="oceanVslModalLabel">Add New Vessel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="oceanVslForm">
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Vessel Name:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Vessel Call Sign:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">IMO Code:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Status:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <select class="default-select  form-control wide" placeholder="Select"></select>
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
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Party Name:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Address Line 1:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Address Line 2:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Address Line 3:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Address Line 4:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">City:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Pincode:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
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
                                <input type="text" class="form-control">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Tel / Contact No:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Email:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">GSTIN NO:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">PAN No:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">CIN No:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Credit Days:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">TDS %:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
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
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Port Name:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Address Line 1:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">EDI Code:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">JNPT Code:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">NSICT Code:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">NSICT GROUP Code:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">GTI Code:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">GTI GROUP Code:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">NSI GT Code:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
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

    <!-- Modal New Charge Details -->
    <div class="modal fade" id="ChargeDetailsModal" tabindex="-1" aria-labelledby="oceanVslModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="oceanVslModalLabel">Add New Charge</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="oceanVslForm">
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Charge Code:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Charge Name:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Tally Ledger Name:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Rs/Other Currency(I/U):</label>
                            <div class="col-sm-8">
                                <select class="default-select  form-control wide" placeholder="Active"></select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Type CHG:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <select class="default-select  form-control wide" placeholder="Active"></select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">GST:</label>
                            <div class="col-sm-8">
                                <select class="default-select  form-control wide" placeholder="Active"></select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">GST %:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <select class="default-select  form-control wide" placeholder="Active"></select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Formula (Y/N):</label>
                            <div class="col-sm-8">
                                <select class="default-select  form-control wide" placeholder="Active"></select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Limit:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Percentage:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">SAC Code:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
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
@endpush
