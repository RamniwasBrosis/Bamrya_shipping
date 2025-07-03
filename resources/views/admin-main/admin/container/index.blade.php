@extends('admin-main.layouts.default')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li><h5 class="bc-title">MANAGE CONTAINER</h5></li>
    </ol>
    <a class="text-primary fs-13" href="{{url('admin/containers/create')}}">+ ADD CONTAINER</a>
</div>
<div class="container-fluid p-2">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header py-3 d-sm-flex d-block">
                    <h4 class="card-title mb-2">CONTAINER</h4>
                </div>
                <div class="card-header d-block pb-2">
                    <form class="row align-items-end" method="get" action="{{route('containers.index')}}">
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Search by container no.</label>
                            <input type="text" class="form-control" placeholder="search.." id="container_no" name="container_no" value="{{request('container_no')}}">
                        </div>
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Search by size.</label>
                            <input type="text" class="form-control"  placeholder="search.." id="size" name="size" value="{{request('size')}}">
                        </div>
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Search by container type</label>
                            <input type="text" class="form-control" placeholder="search.." id="category" name="category" value="{{request('category')}}">
                        </div>
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <button id="applyFilter" class="btn btn-primary" type="submit">Apply</button>
                            <a href="{{route('containers.index')}}" id="resetFilter" class="btn btn-danger light ms-2">Reset</a>
                        </div>
                    </form>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive active-projects style-1">
                        <table id="empoloyees-tblwrapper" class="table">
                            <thead>
                                <tr>
                                    <th>Container No</th>
                                    <th>Container Size</th>
                                    <th>Container Type</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($containers as $container)
                                   <tr>
                                        <td>{{$container->container_no}}</td>
                                        <td>{{$container->size}}</td>
                                        <td>{{$container->category}}</td>
                                        <td>
                                            @if ($container->status == 1)
                                                <span class="badge badge-success light border-0">Active</span>                                                
                                            @else
                                                <span class="badge badge-danger light border-0">Deactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a class="badge badge-info light border-0" href="{{url('admin/containers/'.$container->id.'/edit')}}">Edit</a>
                                            <a class="badge badge-danger light border-0 delete-container" href="javascript:void(0);" data-id="{{$container->id}}">Delete</a>
                                        </td>
                                    </tr> 
                                @endforeach                              
                            </tbody>
                        </table>
                    </div>
                    {{ $containers->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@push('scripts')
    <script>
        $(document).on('click', '.delete-container', function(e) {
            e.preventDefault();
            if (!confirm('Are you sure you want to delete this container?')) return;

            const containerId = $(this).data('id');

            $.ajax({
                url: '/admin/containers/' + containerId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert('container deleted successfully.');
                    location.reload();
                },
                error: function(xhr) {
                    alert('Failed to delete container.');
                    console.log(xhr.responseText);
                }
            });
        });
    </script>

@endpush