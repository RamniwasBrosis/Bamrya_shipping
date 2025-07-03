@extends('admin-main.layouts.default')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li><h5 class="bc-title">Manage User</h5></li>
    </ol>
    <a class="text-primary fs-13" href="{{url('admin/users/create')}}">+ Add Users</a>
</div>
<div class="container-fluid p-2">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header py-3 d-sm-flex d-block">
                    <h4 class="card-title mb-2">users Details</h4>
                </div>
                <div class="card-header d-block pb-2">
                    <form class="row align-items-end" method="get" action="{{route('users.index')}}">
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Search by name</label>
                            <select id="statusFilter" name="name" class="form-control default-select">
                                <option value="">select</option>
                                @foreach ($userNames as $userName)
                                    <option value="{{$userName->name}}">{{$userName->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <button id="applyFilter" class="btn btn-primary" type="submit">Apply</button>
                            <a href="{{route('users.index')}}" id="resetFilter" class="btn btn-danger light ms-2" type="button">Reset</a>
                        </div>
                    </form>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive active-projects style-1">
                        <table id="empoloyees-tblwrapper" class="table">
                            <thead>
                                <tr>
                                    <th>User Name</th>
                                    <th>Email ID</th>
                                    <th>Role Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->role}}</td>
                                        
                                        <td>
                                            <a class="badge badge-info light border-0" href="{{url('admin/users/'.$user->id.'/edit')}}">Edit</a>
                                            <a class="badge badge-danger light border-0 delete-user" href="javascript:void(0);" data-id="{{$user->id}}">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $users->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@push('scripts')
    <script>
        $(document).on('click', '.delete-user', function(e) {
            e.preventDefault();
            if (!confirm('Are you sure you want to delete this user?')) return;

            const userId = $(this).data('id');

            $.ajax({
                url: '/admin/users/' + userId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert('user deleted successfully.');
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