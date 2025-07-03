@extends('admin-main.layouts.default')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li><h5 class="bc-title">MANAGE PACKAGE</h5></li>
    </ol>
    <a class="text-primary fs-13" href="{{url('admin/packages/create')}}">+ Add Package</a>
</div>
<div class="container-fluid p-2">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header py-3 d-sm-flex d-block">
                    <h4 class="card-title mb-2">Packages</h4>
                </div>
                <div class="card-header d-block pb-2">
                    <form class="row align-items-end" method="get" action="{{route('packages.index')}}">
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Search by package code</label>
                            <input type="text" class="form-control" id="searchFilter" name="package_code" value="{{ request('package_code') }}">
                        </div>
                        
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <button id="applyFilter" class="btn btn-primary" type="submit">Apply</button>
                            <a href="{{route('packages.index')}}" id="resetFilter" class="btn btn-danger light ms-2" >Reset</a>
                        </div>
                    </form>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive active-projects style-1">
                        <table id="empoloyees-tblwrapper" class="table">
                            <thead>
                                <tr>
                                    <th>Package Code</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($packages as $package)
                                    <tr>
                                        <td>{{$package->package_code}}</td>
                                        <td>{{$package->description}}</td>
                                        <td>
                                            @if ($package->status == 1)
                                                <span class="badge badge-success light border-0">Active</span>
                                            @else
                                                <span class="badge badge-danger light border-0">Deactive</span>
                                            @endif
                                            
                                        </td>
                                        <td>
                                            <a class="badge badge-info light border-0" href="{{url('admin/packages/'.$package->id.'/edit')}}">Edit</a>
                                            <a class="badge badge-danger light border-0 delete-package" href="javascript:void(0);" data-id="{{$package->id}}">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $packages->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@push('scripts')
    <script>
        $(document).on('click', '.delete-package', function(e) {
            e.preventDefault();
            if (!confirm('Are you sure you want to delete this package?')) return;

            const packageId = $(this).data('id');

            $.ajax({
                url: '/admin/packages/' + packageId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert('package deleted successfully.');
                    location.reload();
                },
                error: function(xhr) {
                    alert('Failed to delete package.');
                    console.log(xhr.responseText);
                }
            });
        });
    </script>

@endpush
