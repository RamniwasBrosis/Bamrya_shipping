@extends('admin-main.layouts.default')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Add New User</a></li>
    </ol>
    <a class="text-primary fs-13" href="{{url('admin/users')}}">+ Back User</a>
</div>
<div class="container-fluid p-2">
    <!-- row -->
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-body">
                    <form id="addUserForm" action="{{route('users.store')}}" method="POST" onsubmit="return false;">
                        @csrf
                        <div id="smartwizard" class="form-wizard order-create">
                            <div class="row form-material">

                                <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                    <label class="col-sm-3 col-form-label">Name:<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="name">
                                        <span class="text-danger error-text name_error"></span>
                                    </div>
                                    
                                </div>
                                
                                <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                    <label class="col-sm-3 col-form-label">Email ID:<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="email">
                                        <span class="text-danger error-text email_error"></span>
                                    </div>
                                    
                                </div>
                                <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                    <label class="col-sm-3 col-form-label">Password:<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" name="password">
                                        <span class="text-danger error-text password_error"></span>
                                    </div>
                                    
                                </div>
                                <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                    <label class="col-sm-3 col-form-label">Retype Password:<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control"  name="password_confirmation">
                                    </div>
                                    <span class="text-danger error-text password_confirmation_error"></span>
                                </div>
                                <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                    <label class="col-sm-3 col-form-label">Role:<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <select class="default-select  form-control wide" placeholder="Select" name="role_name">
                                            <option value="">select</option>
                                            @foreach ($roles as $role)                                                
                                                <option value="{{$role->name}}">{{$role->name}}</option>
                                            @endforeach
                                        </select> 
                                        <span class="text-danger error-text role_name_error"></span>
                                    </div>
                                </div>
                                <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                    <label class="col-sm-3 col-form-label">Company:<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <select class="default-select  form-control wide" placeholder="Select" name="company_id"></select> 
                                    </div>
                                </div>
                                <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                    <label class="col-sm-3 col-form-label">Status:<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <select class="default-select  form-control wide" placeholder="Select" name="status">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select> 
                                        <span class="text-danger error-text status_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <button class="btn btn-info" type="submit" id="btnSub">Submit</button>
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
    // $('#smartwizard').smartWizard();

    $('#addUserForm').on('submit', function(e) {
        e.preventDefault();
        
        $('#btnSub').html('<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Loading...');
        $('#btnSub').prop('disabled', true);

        let formData = $(this).serialize();

        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: formData,
            success: function(response) {
                $('#btnSub').html('').text('Submit');
                $('#btnSub').prop('disabled', false);
                
                window.location.href = "{{ url('admin/users') }}";
            },
            error: function(xhr) {
                $('.error-text').text(''); 
                $('#btnSub').html('').text('Submit');
                $('#btnSub').prop('disabled', false);

                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;

                    $.each(errors, function(key, value) {
                        $(`.${key}_error`).text(value[0]);
                    });
                } else {
                    alert(xhr.responseJSON.message ?? 'Unknown error occurred.');
                }
            }
        });
        
    });
});
</script>
@endpush