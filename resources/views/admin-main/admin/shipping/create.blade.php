@extends('admin-main.layouts.default')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Add New ShippingLine</a></li>
    </ol>
    <a class="text-primary fs-13" href="{{ url('admin/shippings') }}">+ Back Shipping</a>
</div>

    @if (session('success'))
        <div class="alert alert-success">{{session('success')}}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="mb-2">{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif



<div class="container-fluid p-2">
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-body">
                    <div id="smartwizard" class="form-wizard order-create">
                        <form action="{{ route('shippings.store') }}" method="POST">
                            @csrf
                        
                            <div class="row form-material">
                                <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                    <label class="form-label">Shipping Line Code: <span class="text-danger">*</span></label>
                                    <input type="text" name="shipping_line_code" class="form-control" required>
                                </div>
                                <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                    <label class="form-label">Shipping Line Name: <span class="text-danger">*</span></label>
                                    <input type="text" name="shipping_line_name" class="form-control" required>
                                </div>
                                <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                    <label class="form-label">Address Line 1: <span class="text-danger">*</span></label>
                                    <input type="text" name="address_line_1" class="form-control" required>
                                </div>
                                <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                    <label class="form-label">Address Line 2:</label>
                                    <input type="text" name="address_line_2" class="form-control">
                                </div>
                                <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                    <label class="form-label">Agent Code:</label>
                                    <input type="text" name="agent_code" class="form-control">
                                </div>
                                <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                    <label class="form-label">Line Code:</label>
                                    <input type="text" name="line_code" class="form-control">
                                </div>
                                <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                    <label class="form-label">ShippingLine Type: <span class="text-danger">*</span></label>
                                    <select name="shipping_line_type" class="form-control" required>
                                        <option value="">Select</option>
                                        <option value="1">Indian</option>
                                        <option value="2">Overseas</option>
                                    </select>
                                </div>
                                <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                    <label class="form-label">Status: <span class="text-danger">*</span></label>
                                    <select name="status" class="form-control" required>
                                        <option value="">Select</option>
                                        <option value="1" selected>Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-info">Save</button>
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
