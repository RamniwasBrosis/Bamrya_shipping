@extends('admin-main.layouts.default')
@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Add New Role</a></li>
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
        <form method="POST" action="{{ route('user-role.store') }}">
            @csrf

            <div class="row">
                <div class="col-xl-4 mb-3">
                    <label class="form-label">Role Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name" required>
                </div>
            </div>

            <h4 class="heading mb-2">Permissions:</h4>

            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="selectAll">
                <label class="form-check-label" for="selectAll">Select All</label>
            </div>

            <div class="table-responsive">
                <table class="table role-tble">
                    <thead>
                        <tr>
                            <th>permissions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($allPermissions as $module )
                            <tr>
                                <td class="text-end">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="permissions[]" value="{{ $module->name }}" id="{{ $module->name }}">
                                        <label class="form-check-label" for="{{ $module->name }}">{{ ucfirst($module->name) }}</label>
                                    </div>
                                </td>               
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="form-group mt-4">
                <button type="submit" class="btn btn-primary">Save Role</button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('selectAll').addEventListener('change', function () {
            let checkboxes = document.querySelectorAll('input[type="checkbox"][name="permissions[]"]');
            checkboxes.forEach(cb => cb.checked = this.checked);
        });
    </script>
@endsection
