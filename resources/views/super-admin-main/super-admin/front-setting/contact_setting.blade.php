@extends('super-admin-main.layouts.default')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Front Settings</a></li>
    </ol>
</div>
<div class="container-fluid p-3">

    <!-- row -->
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Contact Detail</h4>
                </div>
                <div class="card-body">
                    <div id="smartwizard" class="form-wizard order-create">
                        <div class="row form-material">
                            <div class="col-xl-8 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="text" id="date-format" class="form-control">
                            </div>
                            <div class="col-xl-8 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Company Phone</label>
                                <input type="text" id="date-format" class="form-control">
                            </div>
                            <div class="col-xl-8 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">Company Address</label>
                                <textarea class="form-control h-100" id="validationCustom04" rows="4"
                                    placeholder="" required></textarea>
                            </div>
                            <div class="col-xl-8 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">Html/Embed for contact page</label>
                                <textarea class="form-control h-100" id="validationCustom04" rows="8"
                                    placeholder="" required></textarea>
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