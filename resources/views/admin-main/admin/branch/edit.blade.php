@extends('admin-main.layouts.default')
@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Edit Branch</a></li>
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
        <div class="row">
            <div class="col-xl-12 col-xxl-12">
                <div class="card">
                    <div class="card-body">
                        <form id="editBranchForm" action="{{ route('branches.update', $branch->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row form-material">
                                <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                    <label class="col-sm-4 col-form-label">Branch Code:<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="branch_code" class="form-control" value="{{ $branch->branch_code }}">
                                    </div>
                                </div>

                                <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                    <label class="col-sm-4 col-form-label">Branch Name:<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="branch_name" class="form-control" value="{{ $branch->branch_name }}">
                                    </div>
                                </div>

                                <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                    <label class="col-sm-4 col-form-label">Status:<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <select name="status" class="form-control">
                                            <option value="1" {{ $branch->status == 1 ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ $branch->status == 0 ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-4 mt-3">
                                <button type="submit" class="btn btn-info" id='subBtn'>Update</button>
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
        $('#editBranchForm').on('submit', function (e) {
            e.preventDefault();
            
            $('#subBtn').html('<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Loading...');
            $('#subBtn').prop('disabled', true);

            let form = $(this);
            let url = form.attr('action');
            let formData = new FormData(this);

            $.ajax({
                url: url,
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $('.text-danger').remove(); 
                },
                success: function (res) {
                    if (res.success) {
                        $('#subBtn').prop('disabled', false);
                        $('#subBtn').html('').text('Update');
                    
                        window.location.href = "{{ url('admin/branches') }}";
                    }
                },
                error: function (xhr) {
                    
                    $('#subBtn').prop('disabled', false);
                    $('#subBtn').html('').text('Save');
                    
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function (key, value) {
                            $('[name="' + key + '"]').after(`<span class="text-danger">${value[0]}</span>`);
                        });
                    } 
                }
            });
        });
    });
</script>
@endpush
