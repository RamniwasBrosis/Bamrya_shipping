@extends('super-admin-main.layouts.default')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Form</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Wizard</a></li>
    </ol>
    <a class="text-primary fs-13" href="{{ url('super-admin/packages') }}">Back Packages +</a>
</div>
<div class="container-fluid p-3">

    <!-- row -->
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add Package Info</h4>
                </div>
                <div class="card-body">
                    <div id="smartwizard" class="form-wizard order-create">
                        <div class="row form-material">
                            <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Name</label>
                                <span class="text-danger">*</span>
                                <input type="text" class="form-control" id="mdate">
                            </div>
                            <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Max Employees</label>
                                <span class="text-danger">*</span>
                                <input type="text" id="date-format" class="form-control">
                            </div>
                        </div>

                        <h5>Storage</h5>
                        <div class="row form-material">
                            <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Max Storage Size</label>
                                <span class="text-danger">*</span>
                                <input type="text" class="form-control" id="mdate">
                                <p>Set -1 for unlimited storage size</p>
                            </div>
                            <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Storage Unit</label>
                                <span class="text-danger">*</span>
                                <select class="default-select  form-control wide">
                                </select>
                            </div>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="checkChecked">
                            <label class="form-check-label" for="checkChecked">Free Plan</label>
                        </div><br>
                        <div class="row form-material">
                            <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Position No.</label>
                                <input type="number" class="form-control" id="mdate">
                            </div>
                        </div>

                        <h4>Payment Gateway Plans</h4>
                        <div class="row form-material">
                            <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Monthly Price (₹)</label>
                                <span class="text-danger">*</span>
                                <input type="number" class="form-control" id="mdate">
                            </div>
                            <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Annual Price (₹)</label>
                                <span class="text-danger">*</span>
                                <input type="number" class="form-control" id="mdate">
                            </div>
                            <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Stripe Monthly Plan ID</label>
                                <input type="text" class="form-control" id="mdate">
                            </div>
                            <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Stripe Annual Plan ID</label>
                                <input type="text" class="form-control" id="mdate">
                            </div>
                            <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Razorpay Monthly Plan ID</label>
                                <input type="text" class="form-control" id="mdate">
                            </div>
                            <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Razorpay Annual Plan ID</label>
                                <input type="text" class="form-control" id="mdate">
                            </div>
                            <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Paystack Monthly Plan ID</label>
                                <input type="text" class="form-control" id="mdate">
                            </div>
                            <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Paystack Annual Plan ID</label>
                                <input type="text" class="form-control" id="mdate">
                            </div>
                        </div>

                        <div class="row form-material">
                            <div class="col-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="checkChecked">
                                    <label class="form-check-label" for="checkChecked">Make Private</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="checkChecked">
                                    <label class="form-check-label" for="checkChecked">Mark as recommended ?
                                    </label>
                                </div>
                            </div>
                        </div><br>

                        <h4>Select Module</h4>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="checkChecked">
                                <label class="form-check-label" for="checkChecked">Select All </label>
                            </div>
                        </div>
                        <hr>

                        <div class="row form-material">
                            <div class=" col-xl-3 col-xxl-2 col-md-2 col-sm-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="checkChecked" checked>
                                    <label class="form-check-label" for="checkChecked">Clients</label>
                                </div>
                            </div>
                            <div class=" col-xl-3 col-xxl-2 col-md-2 col-sm-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="checkChecked" checked>
                                    <label class="form-check-label" for="checkChecked">Employees</label>
                                </div>
                            </div>
                            <div class=" col-xl-3 col-xxl-2 col-md-2 col-sm-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="checkChecked" checked>
                                    <label class="form-check-label" for="checkChecked">Projects</label>
                                </div>
                            </div>
                            <div class=" col-xl-3 col-xxl-2 col-md-2 col-sm-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="checkChecked" checked>
                                    <label class="form-check-label" for="checkChecked">Attendance</label>
                                </div>
                            </div>
                            <div class=" col-xl-3 col-xxl-2 col-md-2 col-sm-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="checkChecked" checked>
                                    <label class="form-check-label" for="checkChecked">Tasks</label>
                                </div>
                            </div>
                            <div class=" col-xl-3 col-xxl-2 col-md-2 col-sm-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="checkChecked" checked>
                                    <label class="form-check-label" for="checkChecked">Estimates</label>
                                </div>
                            </div>
                        </div>
                        <div class="row form-material">
                            <div class=" col-xl-3 col-xxl-2 col-md-2 col-sm-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="checkChecked" checked>
                                    <label class="form-check-label" for="checkChecked">Invoices</label>
                                </div>
                            </div>
                            <div class=" col-xl-3 col-xxl-2 col-md-2 col-sm-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="checkChecked" checked>
                                    <label class="form-check-label" for="checkChecked">Payments</label>
                                </div>
                            </div>
                            <div class=" col-xl-3 col-xxl-2 col-md-2 col-sm-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="checkChecked" checked>
                                    <label class="form-check-label" for="checkChecked">Time Logs</label>
                                </div>
                            </div>
                            <div class=" col-xl-3 col-xxl-2 col-md-2 col-sm-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="checkChecked" checked>
                                    <label class="form-check-label" for="checkChecked">Tickets</label>
                                </div>
                            </div>
                            <div class=" col-xl-3 col-xxl-2 col-md-2 col-sm-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="checkChecked" checked>
                                    <label class="form-check-label" for="checkChecked">Events</label>
                                </div>
                            </div>
                            <div class=" col-xl-3 col-xxl-2 col-md-2 col-sm-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="checkChecked" checked>
                                    <label class="form-check-label" for="checkChecked">Messages</label>
                                </div>
                            </div>
                        </div>
                        <div class="row form-material">
                            <div class=" col-xl-3 col-xxl-2 col-md-2 col-sm-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="checkChecked" checked>
                                    <label class="form-check-label" for="checkChecked">Notices</label>
                                </div>
                            </div>
                            <div class=" col-xl-3 col-xxl-2 col-md-2 col-sm-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="checkChecked" checked>
                                    <label class="form-check-label" for="checkChecked">Leaves</label>
                                </div>
                            </div>
                            <div class=" col-xl-3 col-xxl-2 col-md-2 col-sm-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="checkChecked" checked>
                                    <label class="form-check-label" for="checkChecked">Leads</label>
                                </div>
                            </div>
                            <div class=" col-xl-3 col-xxl-2 col-md-2 col-sm-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="checkChecked" checked>
                                    <label class="form-check-label" for="checkChecked">Holidays</label>
                                </div>
                            </div>
                            <div class=" col-xl-3 col-xxl-2 col-md-2 col-sm-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="checkChecked" checked>
                                    <label class="form-check-label" for="checkChecked">Products</label>
                                </div>
                            </div>
                            <div class=" col-xl-3 col-xxl-2 col-md-2 col-sm-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="checkChecked" checked>
                                    <label class="form-check-label" for="checkChecked">Expenses</label>
                                </div>
                            </div>
                        </div>
                        <div class="row form-material">
                            <div class=" col-xl-3 col-xxl-2 col-md-2 col-sm-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="checkChecked">
                                    <label class="form-check-label" for="checkChecked">Contracts</label>
                                </div>
                            </div>
                            <div class=" col-xl-3 col-xxl-2 col-md-2 col-sm-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="checkChecked">
                                    <label class="form-check-label" for="checkChecked">Reports</label>
                                </div>
                            </div>
                            <div class=" col-xl-3 col-xxl-2 col-md-2 col-sm-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="checkChecked">
                                    <label class="form-check-label" for="checkChecked">Ticket Support</label>
                                </div>
                            </div>
                        </div>
                        <div class="row form-material">
                            <div class="col-xl-12 col-xxl-12 col-md-12 mb-3">
                                <label class="form-label">Description</label>
                                <span class="text-danger">*</span>
                                <textarea class="form-control h-100" id="validationCustom04" rows="4"
                                    placeholder="Its a default package and cannot be deleted" required></textarea>
                            </div>
                        </div>
                        <div class="col-4">
                            <button class="btn btn-info">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@push('scripts')
<script>
$(document).ready(function() {
    $('#smartwizard').smartWizard();
});
</script>
@endpush