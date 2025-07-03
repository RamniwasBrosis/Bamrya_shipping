@extends('super-admin-main.layouts.default')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Admin FAQ</a></li>
    </ol>
    <a class="text-primary fs-13" href="{{url('super-admin/admin-faq')}}">Back FAQ +</a>
</div>
<div class="container-fluid p-3">

    <!-- row -->
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add Admin FAQ Category</h4>
                </div>
                <div class="card-body">
                    <div id="smartwizard" class="form-wizard order-create">
                        <div class="row form-material">
                            <div class="col-xl-8 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Add FAQ Category</label>
                                <span class="text-danger">*</span>
                                <select class="default-select  form-control wide"></select>
                            </div>
                            <div class="col-xl-8 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Title</label>
                                <span class="text-danger">*</span>
                                <input type="text" id="date-format" class="form-control">
                            </div>
                            <div class="col-xl-8 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control h-100" id="validationCustom04" rows="4"
                                    placeholder="Its a default package and cannot be deleted" required></textarea>
                            </div>
                            <div class="col-xl-8 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">File</label>
                                <span class="text-danger">*</span>
                                <input type="file" id="date-format" class="form-control">
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