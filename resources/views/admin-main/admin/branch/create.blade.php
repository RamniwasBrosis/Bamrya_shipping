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
                                <div class="mb-3 col-xl-4 col-xxl-12 col-md-6 row">
                                    <label class="col-sm-3 col-form-label">Branch Code:<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="branch_code" value="{{ old('branch_code') }}" required>
                                        @error('branch_code')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Branch Name -->
                                <div class="mb-3 col-xl-4 col-xxl-12 col-md-6 row">
                                    <label class="col-sm-3 col-form-label">Branch Name:<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="branch_name" value="{{ old('branch_name') }}" required>
                                        @error('branch_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Status -->
                                <div class="mb-3 col-xl-4 col-xxl-12 col-md-6 row">
                                    <label class="col-sm-3 col-form-label">Status:<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="status" required>
                                            <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                        @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
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

