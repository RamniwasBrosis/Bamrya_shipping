@extends('admin-main.layouts.default')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Edit User</a></li>
    </ol>
    <a class="text-primary fs-13" href="{{url('admin/users')}}">+ Back User</a>
</div>
<div class="container-fluid p-2">
    <!-- row -->
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('users.update',$user->id)}}" method="POST" id="EditForm">
                        @csrf
                        @method('PUT')
                        <div id="smartwizard" class="form-wizard order-create">
                            <div class="row form-material">
                                <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                    <label class="col-sm-3 col-form-label">Name:<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="name" value="{{$user->name}}">
                                        <span class="text-danger error-text name_error"></span>
                                    </div>
                                    
                                </div>
                               
                                <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                    <label class="col-sm-3 col-form-label">Email ID:<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="email" value="{{$user->email}}">
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
                                        <input type="password" class="form-control" name="password_confirmation">
                                    </div>
                                    <span class="text-danger error-text password_confirmation_error"></span>
                                </div>
                                <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                    <label class="col-sm-3 col-form-label">Role:<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <select class="default-select  form-control wide" name="role_name">
                                            @foreach ($roles as $role)
                                                <option value="{{$role->name}}" {{$user->role == $role->name ? 'selected' : ''}}>{{$role->name}}</option>
                                            @endforeach
                                        </select> 
                                        <span class="text-danger error-text role_name_error"></span>
                                    </div>
                                </div>
                                {{-- <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                    <label class="col-sm-3 col-form-label">Company:<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <select class="default-select  form-control wide" placeholder="Select"></select> 
                                    </div>
                                </div> --}}
                                <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                    <label class="col-sm-3 col-form-label">Status:<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <select class="default-select  form-control wide" placeholder="Select" name="status">
                                            <option value="1" {{$user->status == 1? 'selected' : ''}}>Active</option>
                                            <option value="0" {{$user->status == 0? 'selected' : ''}}>Deactive</option>
                                        </select> 
                                        <span class="text-danger error-text status_error"></span>
                                    </div>
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
</div>
@endsection
@push('scripts')
<script>
$(document).ready(function () {

    $('#EditForm').on('submit', function(e) {
        e.preventDefault();
        
        $('#btnSub').html('<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Loading...');
        $('#btnSub').prop('disabled', true);

        let form = $(this);
        let actionUrl = $(this).attr('action');
        let formData = form.serialize() + '&_method=PUT';

        $('.error-text').text(''); // Clear previous errors
    
        $.ajax({
            url: actionUrl,
            method: 'PUT',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                $('#btnSub').html('').text('Update');
                $('#btnSub').prop('disabled', false);
                window.location.href = "{{ url('admin/users') }}";
            },
            error: function(xhr) {
                $('#btnSub').html('').text('Submit');
                $('#btnSub').prop('disabled', false);
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function (key, val) {
                        $(`.${key}_error`).text(val[0]);
                    });
                } else {
                    alert(xhr.responseJSON.message ?? 'An error occurred.');
                }
            }
        });

    });
});
</script>
@endpush