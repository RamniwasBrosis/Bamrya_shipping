@extends('admin-main.layouts.default')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li><h5 class="bc-title">MANAGE CONTAINER SIZE</h5></li>
    </ol>
    <a class="text-primary fs-13" href="{{url('admin/container-sizes/create')}}">+ ADD CONTAINER SIZE</a>
</div>
<div class="container-fluid p-2">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header py-3 d-sm-flex d-block">
                    <h4 class="card-title mb-2">CONTAINER SIZE</h4>
                </div>
                <div class="card-header d-block pb-2">
                    <form class="row align-items-end" method="get" action="{{route('container-sizes.index')}}">
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Search</label>
                            <input type="text" class="form-control" placeholder="search by cont. type" name="cont_type" value="{{request('cont_type')}}">
                        </div>   
                        
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Search</label>
                            <input type="text" class="form-control" placeholder="search by ISO code" name="iso_code" value="{{request('iso_code')}}">
                        </div> 
                                                
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <button id="applyFilter" class="btn btn-primary" type="submit">Apply</button>
                            <a href="{{route('container-sizes.index')}}" id="resetFilter" class="btn btn-danger light ms-2">Reset</a>
                        </div>
                    </form>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive active-projects style-1">
                        <table id="empoloyees-tblwrapper" class="table">
                            <thead>
                                <tr>
                                    <th>Container Type</th>
                                    <th>Description</th>
                                    <th>ISO Code</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($containerSizes as $containerSize)
                                    <tr>
                                        <td>{{$containerSize->cont_type}}</td>
                                        <td>{{$containerSize->description}}</td>
                                        <td>{{$containerSize->iso_code}}</td>
                                        <td>
                                            @if ($containerSize->status == 1)
                                                <span class="badge badge-success light border-0">Active</span>                                                
                                            @else
                                                <span class="badge badge-danger light border-0">Deactive</span> 
                                            @endif
                                        </td>
                                        <td>
                                            <a class="badge badge-info light border-0" href="{{url('admin/container-sizes/'.$containerSize->id.'/edit')}}">Edit</a>
                                            <a class="badge badge-danger light border-0 delete-container-size" href="javascript:void(0);" data-id="{{$containerSize->id}}">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $containerSizes->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@push('scripts')
    <script>
        $(document).on('click', '.delete-container-size', function(e) {
            e.preventDefault();
            if (!confirm('Are you sure you want to delete this container-size?')) return;

            const voyageId = $(this).data('id');

            $.ajax({
                url: '/admin/container-sizes/' + voyageId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert('container-size deleted successfully.');
                    location.reload();
                },
                error: function(xhr) {
                    alert('Failed to delete container-size.');
                    console.log(xhr.responseText);
                }
            });
        });
    </script>

@endpush