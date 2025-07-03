@extends('admin-main.layouts.default')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Add New Vessel</a></li>
    </ol>
    <a class="text-primary fs-13" href="{{url('admin/vessels')}}">+ Back Vessel</a>
</div>
<div class="container-fluid p-2">
    <!-- row -->
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" id="smartwizard" action="{{ route('vessels.store') }}">
                        @csrf
                        <div class="form-wizard order-create">
                            <div class="row form-material">
                                <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                    <label class="form-label">Vessel Name:</label>
                                    <span class="text-danger">*</span>
                                    <input type="text" name="vessel_name" class="form-control" id="mdate">
                                </div>
                                <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                    <label class="form-label">Vessel Call Sign:</label>
                                    <input type="text" name="call_sign" class="form-control" id="mdate">
                                </div>
                                <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                    <label class="form-label">IMO Code:</label>
                                    <input type="text" name="imo_code" class="form-control" id="mdate">
                                </div>
                                <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                    <label class="form-label">Status:</label>
                                    <span class="text-danger">*</span>
                                    <select class="default-select  form-control wide" name="status">
                                        <option value="1">Active</option>
                                        <option value="0">Deactive</option>
                                        <option value="2">Pending</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <button class="btn btn-info" id="Submit_vessels">Save</button>
                            </div>
                        </div>
                    </form>
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


    $('#smartwizard').on('submit', function(e){
        e.preventDefault();
        var FormData = $(this).serialize();
        var url = "{{ route('vessels.store') }}";

        $.ajax({
            url: url,
            type: 'post',
            data: FormData,
            success: function(response){
                window.location.href = "{{ route('vessels.index') }}";
            },
            error: function(error){
                console.log(error);
            }
        })
    });
});
</script>
@endpush