@extends('super-admin-main.layouts.default')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Companies</a></li>
    </ol>
    <a class="text-primary fs-13" href="{{ url('super-admin/companies') }}">Back Companies +</a>

</div>
<div class="container-fluid p-3">

    <!-- row -->
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Company Details</h4>
                </div>
                <div class="card-body">
                    <div id="smartwizard" class="form-wizard order-create">
                        <div class="row form-material">
                            <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Company Name</label>
                                <span class="text-danger">*</span>
                                <input type="text" class="form-control" id="mdate">
                            </div>
                            <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Company Email</label>
                                <span class="text-danger">*</span>
                                <input type="text" id="date-format" class="form-control">
                            </div>
                            <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Company Phone</label>
                                <span class="text-danger">*</span>
                                <input type="text" class="form-control" id="mdate">
                            </div>
                            <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Company Website</label>
                                <select class="default-select  form-control wide"></select>
                            </div>
                            <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                <label for="formFile" class="form-label">Logo</label>
                                <input class="form-control" type="file" id="formFile">
                            </div>
                            <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Company Address</label>
                                <span class="text-danger">*</span>
                                <textarea class="form-control h-100" id="validationCustom04" rows="4"
                                    placeholder="   " required></textarea>
                            </div>
                        </div>

                        <div class="row form-material">
                            <div class="col-xl-3 col-xxl-6 col-md-3 mb-3">
                                <label class="form-label">Default Currency</label>
                                <select class="default-select  form-control wide"></select>
                            </div>
                            <div class="col-xl-3 col-xxl-6 col-md-3 mb-3">
                                <label class="form-label">Default Timezone</label>
                                <select class="default-select  form-control wide"></select>
                            </div>
                            <div class="col-xl-3 col-xxl-6 col-md-3 mb-3">
                                <label class="form-label">Change Language</label>
                                <select class="default-select  form-control wide"></select>
                            </div>
                            <div class="col-xl-3 col-xxl-6 col-md-3 mb-3">
                                <label class="form-label">Status</label>
                                <select class="default-select  form-control wide"></select>
                            </div>
                        </div>

                        <h4>Admin Account Details</h4>
                        <div class="row form-material">
                            <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <span class="text-danger">*</span>
                                <input type="text" class="form-control" id="mdate">
                            </div>
                            <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Password</label>
                                <span class="text-danger">*</span>
                                <input type="text" id="date-format" class="form-control">
                            </div>
                        </div>
                        <hr>
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