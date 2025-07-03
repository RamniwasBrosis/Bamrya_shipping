@extends('admin-main.layouts.default')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Edit Role</a></li>
    </ol>
    <a class="text-primary fs-13" href="{{ url('admin/user-role') }}">+ Back Role</a>
</div>

<div class="my-8">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</div>

<div class="container-fluid p-2">
    <form id="updateRoleForm" action="{{ route('user-role.update', $role->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xl-4 mb-3">
                <label class="form-label">Role Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="name" value="{{ $role->name }}" required>
                <small class="text-danger name_error"></small>
            </div>
        </div>

        <h4 class="heading mb-2">Permissions:</h4>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="selectAll">
            <label class="form-check-label" for="selectAll">Select All</label>
        </div>

        <div class="row">
            @foreach($permissions as $permission)
                <div class="col-xl-3 mb-2">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="permissions[]" value="{{ $permission->name }}"
                            {{ $role->permissions->contains('name', $permission->name) ? 'checked' : '' }} id="perm_{{ $permission->id }}">
                        <label class="form-check-label" for="perm_{{ $permission->id }}">{{ ucfirst($permission->name) }}</label>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-grid d-md-flex justify-content-md-end mt-4">
            <button class="btn btn-primary" type="submit">Update</button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    // Select All Permissions Toggle
    $('#selectAll').on('change', function () {
        $('input[name="permissions[]"]').prop('checked', this.checked);
    });

    // AJAX Submit Form
    $('#updateRoleForm').on('submit', function(e) {
        e.preventDefault();

        let form = $(this);
        let actionUrl = form.attr('action');
        let formData = form.serialize();

        $('.name_error').text('');

        $.ajax({
            url: actionUrl,
            method: 'POST', // method should be POST because _method=PUT is sent in formData
            data: formData,
            success: function(response) {
                alert('Role updated successfully!');
                // Optionally redirect:
                window.location.href = "{{ url('admin/user-role') }}";
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    if (errors.name) {
                        $('.name_error').text(errors.name[0]);
                    }
                } else {
                    alert('Something went wrong.');
                }
            }
        });
    });
</script>
@endpush
