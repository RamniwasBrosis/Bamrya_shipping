@extends('admin-main.layouts.default')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Edit Vessel</a></li>
    </ol>
    <a class="text-primary fs-13" href="{{url('admin/vessels')}}">+ Back Vessel</a>
</div>
<div class="container-fluid p-2">
    <!-- row -->
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" id="smartwizard" action="{{ route('vessels.update', $editVessel->id) }}">
                        @csrf
                        @method('PUT')
                        <div id="smartwizard" class="form-wizard order-create">
                            <div class="row form-material">
                                <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                    <label class="form-label">Vessel Name:</label>
                                    <span class="text-danger">*</span>
                                    <input type="text" class="form-control" id="" name="vessel_name" value="{{$editVessel->vessel_name}}">
                                </div>
                                <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                    <label class="form-label">Vessel Call Sign:</label>
                                    <input type="text" class="form-control" id="" name="call_sign" value="{{$editVessel->call_sign}}">
                                </div>
                                <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                    <label class="form-label">IMO Code:</label>
                                    <input type="text" class="form-control" id=""  name="imo_code" value="{{$editVessel->imo_code}}">
                                </div>
                                <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                    <label class="form-label">Status:</label>
                                    <span class="text-danger">*</span>
                                    <select class="default-select  form-control wide" name="vessel_status">
                                        <option value="1" {{ $editVessel->status == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $editVessel->status == 0 ? 'selected' : '' }}>Deactive</option>
                                        <option value="2" {{ $editVessel->status == 2 ? 'selected' : '' }}>Pending</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <button class="btn btn-info">Update</button>
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
});
</script>
@endpush