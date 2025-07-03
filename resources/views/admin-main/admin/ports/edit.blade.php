@extends('admin-main.layouts.default')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Update Ports</a></li>
    </ol>
    <a class="text-primary fs-13" href="{{url('admin/ports')}}">+ Back Port</a>
</div>
<div class="container-fluid p-2">
    <!-- row -->
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" id="update_port_form" action="{{ route('ports.update', $port->id) }}">
                        @csrf
                        @method('put')
                        <div id="smartwizard" class="form-wizard order-create">
                            <div class="row form-material">
                                <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                    <label class="form-label">Port Code:</label>
                                    <span class="text-danger">*</span>
                                    <input type="text" class="form-control" name="port_code" value="{{$port->port_code}}">
                                </div>
                                <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                    <label class="form-label">Port Name:</label>
                                    <span class="text-danger">*</span>
                                    <input type="text" class="form-control" name="port_name" value="{{$port->port_name}}">
                                </div>
                                <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                    <label class="form-label">EDI Code:</label>
                                    <input type="text" class="form-control" name="edi_code" value="{{$port->edi_code}}">
                                </div>
                                <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                    <label class="form-label">JNPT Code:</label>
                                    <input type="text" class="form-control" name="jnpt_code" value={{$port->jnpt_code}}>
                                </div>
                                <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                    <label class="form-label">NSICT Code:</label>
                                    <input type="text" class="form-control" name="nsict_code" value={{$port->nsict_code}}>
                                </div>
                                <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                    <label class="form-label">NSICT GROUP Code:</label>
                                    <input type="text" class="form-control" name="nsict_group_code" value={{$port->nsict_group_code}}>
                                </div>
                                <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                    <label class="form-label">GTI Code:</label>
                                    <input type="text" class="form-control" name="gti_code" value={{$port->gti_code}}>
                                </div>
                                <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                    <label class="form-label">GTI GROUP Code:</label>
                                    <input type="text" class="form-control" name="gti_group_code" value={{$port->gti_group_code}}>
                                </div>
                                <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                    <label class="form-label">NSI GT Code:</label>
                                    <input type="text" class="form-control" name="nsi_gt_code" value={{$port->nsi_gt_code}}>
                                </div>
                                <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                    <label class="form-label">Status:</label>
                                    <span class="text-danger">*</span>
                                    <select class="default-select  form-control wide" name="status">
                                        <option value="1" {{ $port->status == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $port->status == 0 ? 'selected' : '' }}>Deactive</option>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <button type="submit" class="btn btn-info" id="update_port">Update</button>
                                </div>
                            </div>
                            
                        </div>
                    </form>
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