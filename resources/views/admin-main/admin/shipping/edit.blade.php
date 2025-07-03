@extends('admin-main.layouts.default')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Edit ShippingLine</a></li>
    </ol>
    <a class="text-primary fs-13" href="{{ url('admin/shippings') }}">+ Back Shipping</a>
</div>
<div class="container-fluid p-2">
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('shippings.update', $MasterShipping->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="company_id" value="{{ $MasterShipping->company_id }}">
                        <div id="smartwizard" class="form-wizard order-create">
                            <div class="row form-material">
                                <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                    <label class="form-label">Shipping Line Code: <span class="text-danger">*</span></label>
                                    <input type="text" name="shipping_line_code" class="form-control" value="{{ $MasterShipping->shipping_line_code }}" required>
                                </div>
                                <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                    <label class="form-label">Shipping Line Name: <span class="text-danger">*</span></label>
                                    <input type="text" name="shipping_line_name" class="form-control" value="{{ $MasterShipping->shipping_line_name }}" required>
                                </div>
                                <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                    <label class="form-label">Address Line 1: <span class="text-danger">*</span></label>
                                    <input type="text" name="address_line_1" class="form-control" value="{{ $MasterShipping->address_line_1 }}" required>
                                </div>
                                <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                    <label class="form-label">Address Line 2:</label>
                                    <input type="text" name="address_line_2" class="form-control" value="{{ $MasterShipping->address_line_2 }}">
                                </div>
                                <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                    <label class="form-label">Agent Code:</label>
                                    <input type="text" name="agent_code" class="form-control" value="{{ $MasterShipping->agent_code }}">
                                </div>
                                <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                    <label class="form-label">Line Code:</label>
                                    <input type="text" name="line_code" class="form-control" value="{{ $MasterShipping->line_code }}">
                                </div>
                                <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                    <label class="form-label">ShippingLine Type: <span class="text-danger">*</span></label>
                                    <select class="default-select form-control wide" name="shipping_line_type" required>
                                        <option value="">Select</option>
                                        <option value="1" {{ $MasterShipping->shipping_line_type == 1 ? 'selected' : '' }}>Indian</option>
                                        <option value="2" {{ $MasterShipping->shipping_line_type == 2 ? 'selected' : '' }}>Overseas</option>
                                    </select>
                                </div>
                                <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                    <label class="form-label">Status: <span class="text-danger">*</span></label>
                                    <select class="default-select form-control wide" name="status" required>
                                        <option value="1" {{ $MasterShipping->status == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $MasterShipping->status == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-info">Update</button>
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
