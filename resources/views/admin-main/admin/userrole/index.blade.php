@extends('admin-main.layouts.default')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li><h5 class="bc-title">Manage Role</h5></li>
    </ol>
    <a class="text-primary fs-13" href="{{url('admin/user-role/create')}}">+ Add Role</a>
</div>
<div class="container-fluid p-2">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header py-3 d-sm-flex d-block">
                    <h4 class="card-title mb-2">Role Details</h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive active-projects style-1">
                        <table id="empoloyees-tblwrapper" class="table">
                            <thead>
                                <tr>
                                    <th>Role</th>
                                    <th>Permissions</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                    <tr>
                                        <td>{{$role->name}}</td>
                                        <td>
                                            @foreach ($role->permissions as $permission)
                                                <span class="badge badge-success light border-0">{{ $permission->name }}</span>
                                            @endforeach
                                        </td>
                                      
                                        <td>
                                            <a class="badge badge-info light border-0" href="{{url('admin/user-role/'.$role->id.'/edit')}}">Edit</a>
                                            <a class="badge badge-danger light border-0 delete-permission" href="javascript:void(0);" data-id="{{$role->id}}">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach                                
                            </tbody>
                        </table>
                    </div>
                     {{ $roles->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@push('scripts')
    <script>
        $(document).on('click', '.delete-permission', function(e) {
            e.preventDefault();
            if (!confirm('Are you sure you want to delete this permission?')) return;

            const userId = $(this).data('id');

            $.ajax({
                url: '/admin/user-role/' + userId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert('permission deleted successfully.');
                    location.reload();
                },
                error: function(xhr) {
                $('.error-text').text(''); // Clear all error texts

                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                } else {
                    alert(xhr.responseJSON.message ?? 'Unknown error occurred.');
                }
            }
            });
        });
    </script>

@endpush