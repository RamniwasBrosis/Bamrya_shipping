@extends('admin-main.layouts.default')

@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Add New Branch</a></li>
    </ol>
    <a class="text-primary fs-13" href="{{ url('admin/branches') }}">+ Back Branch</a>
</div>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="container-fluid p-2">
    <!-- row -->
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('branches.store') }}" method="POST" id="branchForm">
                        @csrf
                        <div id="smartwizard" class="form-wizard order-create">
                            <div class="row form-material">
                                <!-- Branch Code -->
                                <div class="mb-3 col-xl-6 col-md-6 row">
                                    <label class="col-sm-4 col-form-label">
                                        Branch Code <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="text" name="branch_code" class="form-control"
                                            value="{{ old('branch_code', $branch->branch_code ?? '') }}">
                                    </div>
                                </div>

                                <!-- Branch Name -->
                                <div class="mb-3 col-xl-6 col-md-6 row">
                                    <label class="col-sm-4 col-form-label">
                                        Branch Name <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="text" name="branch_name" class="form-control"
                                            value="{{ old('branch_name', $branch->branch_name ?? '') }}">
                                    </div>
                                </div>

                                <!-- Manager -->
                                <div class="mb-3 col-xl-6 col-md-6 row">
                                    <label class="col-sm-4 col-form-label">
                                        Manager Name
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="text" name="manager_name" class="form-control"
                                            value="{{ old('manager_name', $branch->manager_name ?? '') }}">
                                    </div>
                                </div>

                            </div>
                            {{-- address  --}}
                            <div class="row form-material">
                                <div class="mb-3 col-xl-12 row">
                                    <label class="col-sm-2 col-form-label">
                                        Address
                                    </label>

                                    <div class="col-sm-10">
                                        <textarea name="address" class="form-control" rows="3">{{ old('address', $branch->address ?? '') }}</textarea>
                                    </div>
                                </div>

                            </div>
                            {{-- location  --}}
                            <div class="row form-material">
                                <div class="mb-3 col-xl-6 col-md-6 row">
                                    <label class="col-sm-4 col-form-label">City</label>

                                    <div class="col-sm-8">
                                        <input type="text" name="city" class="form-control"
                                            value="{{ old('city', $branch->city ?? '') }}">
                                    </div>
                                </div>

                                <div class="mb-3 col-xl-6 col-md-6 row">
                                    <label class="col-sm-4 col-form-label">State</label>

                                    <div class="col-sm-8">
                                        <input type="text" name="state" class="form-control"
                                            value="{{ old('state', $branch->state ?? '') }}">
                                    </div>
                                </div>

                                <div class="mb-3 col-xl-6 col-md-6 row">
                                    <label class="col-sm-4 col-form-label">Country</label>

                                    <div class="col-sm-8">
                                        <input type="text" name="country" class="form-control"
                                            value="{{ old('country', $branch->country ?? '') }}">
                                    </div>
                                </div>

                                <div class="mb-3 col-xl-6 col-md-6 row">
                                    <label class="col-sm-4 col-form-label">Pincode</label>

                                    <div class="col-sm-8">
                                        <input type="text" name="pincode" class="form-control"
                                            value="{{ old('pincode', $branch->pincode ?? '') }}">
                                    </div>
                                </div>

                            </div>
                            {{-- contact information --}}
                            <div class="row form-material">
                                <div class="mb-3 col-xl-6 col-md-6 row">
                                    <label class="col-sm-4 col-form-label">
                                        Phone
                                    </label>

                                    <div class="col-sm-8">
                                        <input type="text" name="phone" class="form-control"
                                            value="{{ old('phone', $branch->phone ?? '') }}">
                                    </div>
                                </div>

                                <div class="mb-3 col-xl-6 col-md-6 row">
                                    <label class="col-sm-4 col-form-label">
                                        Landline
                                    </label>

                                    <div class="col-sm-8">
                                        <input type="text" name="landline_phone" class="form-control"
                                            value="{{ old('landline_phone', $branch->landline_phone ?? '') }}">
                                    </div>
                                </div>

                                <div class="mb-3 col-xl-6 col-md-6 row">
                                    <label class="col-sm-4 col-form-label">
                                        Email
                                    </label>

                                    <div class="col-sm-8">
                                        <input type="email" name="email" class="form-control"
                                            value="{{ old('email', $branch->email ?? '') }}">
                                    </div>
                                </div>

                            </div>
                            {{-- Registration Information --}}
                            <div class="row form-material">
                                <div class="mb-3 col-xl-6 col-md-6 row">
                                    <label class="col-sm-4 col-form-label">
                                        GSTIN
                                    </label>

                                    <div class="col-sm-8">
                                        <input type="text" name="gstin_no" class="form-control"
                                            value="{{ old('gstin_no', $branch->gstin_no ?? '') }}">
                                    </div>
                                </div>

                                <div class="mb-3 col-xl-6 col-md-6 row">
                                    <label class="col-sm-4 col-form-label">
                                        PAN
                                    </label>

                                    <div class="col-sm-8">
                                        <input type="text" name="pan_no" class="form-control"
                                            value="{{ old('pan_no', $branch->pan_no ?? '') }}">
                                    </div>
                                </div>

                                <div class="mb-3 col-xl-6 col-md-6 row">
                                    <label class="col-sm-4 col-form-label">
                                        TAN
                                    </label>

                                    <div class="col-sm-8">
                                        <input type="text" name="tan_no" class="form-control"
                                            value="{{ old('tan_no', $branch->tan_no ?? '') }}">
                                    </div>
                                </div>

                                <div class="mb-3 col-xl-6 col-md-6 row">
                                    <label class="col-sm-4 col-form-label">
                                        CIN
                                    </label>

                                    <div class="col-sm-8">
                                        <input type="text" name="cin_no" class="form-control"
                                            value="{{ old('cin_no', $branch->cin_no ?? '') }}">
                                    </div>
                                </div>

                            </div>
                            {{-- logo --}}
                            <div class="row form-material">
                                <div class="mb-3 col-xl-6 row">
                                    <label class="col-sm-3 col-form-label">
                                        Branch Logo
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="file"
                                            name="logo"
                                            class="form-control">
                                        @isset($branch)
                                            @if($branch->logo)
                                                <div class="mt-2">
                                                    <img src="{{ asset('uploads/branch_logo/'.$branch->logo) }}"
                                                        width="120">
                                                </div>
                                            @endif
                                        @endisset
                                    </div>
                                </div>
                                <div class="mb-3 col-xl-6 col-md-6 row">
                                    <label class="col-sm-4 col-form-label">
                                        Status
                                    </label>
                                    <div class="col-sm-8">
                                        <select name="status" class="form-control">
                                            <option value="1"
                                                {{ old('status', $branch->status ?? 1) == 1 ? 'selected' : '' }}>
                                                Active
                                            </option>
                                            <option value="0"
                                                {{ old('status', $branch->status ?? 1) == 0 ? 'selected' : '' }}>
                                                Inactive
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-info" id='subBtn'>Save</button>
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
    $(document).ready(function () {
        $('#branchForm').on('submit', function (e) {
            e.preventDefault();

            $('#subBtn').html('<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Loading...');
            $('#subBtn').prop('disabled', true);

            let formData = new FormData(this);

            $.ajax({
                url: $(this).attr('action'),
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $('.text-danger').text(''); // Clear old errors
                },
                success: function (response) {
                    if (response.success) {
                        $('#subBtn').prop('disabled', false);
                        $('#subBtn').html('').text('Save');
                        window.location.href = "{{ url('admin/branches') }}";
                    }
                },
                error: function (xhr) {

                    $('#subBtn').prop('disabled', false);
                    $('#subBtn').html('').text('Save');

                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function (key, value) {
                            $(`[name="${key}"]`).after(`<span class="text-danger">${value[0]}</span>`);
                        });
                    }
                }
            });
        });
    });
</script>
@endpush

