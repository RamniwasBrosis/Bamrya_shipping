@extends('super-admin-main.layouts.default')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Front Settings</a></li>
    </ol>
</div>
<div class="container-fluid  p-3">

    <!-- row -->
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Footer Settings</h4>
                </div>
                <div class="card-body">
                    <div id="smartwizard" class="form-wizard order-create">
                        <div class="row form-material">
                            <div class="col-xl-8 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">Footer Copyright Text</label>
                                <input type="text" id="date-format" class="form-control">
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