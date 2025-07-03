@extends('admin-main.layouts.default')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li><h5 class="bc-title">MANAGE BL Type</h5></li>
    </ol>
    <a class="text-primary fs-13" href="{{url('admin/bl-types/create')}}">+ Add Bl Type</a>
</div>
<div class="container-fluid p-2">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header py-3 d-sm-flex d-block">
                    <h4 class="card-title mb-2">BL Type</h4>
                </div>
                <div class="card-header d-block pb-2">
                    <form class="row align-items-end" method="get" action="{{route('bl-types.index')}}">
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Search</label>
                            <input type="text" class="form-control" name="bl_description" value="{{request('bl_description')}}">
                        </div>
                
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <button id="applyFilter" class="btn btn-primary" type="submit">Apply</button>
                            <a href="{{route('bl-types.index')}}" id="resetFilter" class="btn btn-danger light ms-2">Reset</a>
                        </div>
                    </form>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive active-projects style-1">
                        <table id="empoloyees-tblwrapper" class="table">
                            <thead>
                                <tr>
                                    <th>BL Descrition</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($blTypes as $blType)
                                    <tr>
                                        <td>{{$blType->bl_description}}</td>
                                        <td>
                                            @if ($blType->status == 1)
                                                <span class="badge badge-success light border-0">Active</span>
                                            @else
                                                <span class="badge badge-danger light border-0">Deactive</span>
                                            @endif
                                            
                                        </td>
                                        <td>
                                            <a class="badge badge-info light border-0" href="{{url('admin/bl-types/'.$blType->id.'/edit')}}">Edit</a>
                                            <a class="badge badge-danger light border-0 delete-blType" href="javascript:void(0);" data-id="{{$blType->id}}">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $blTypes->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@push('scripts')
    <script>
        $(document).on('click', '.delete-blType', function(e) {
            e.preventDefault();
            if (!confirm('Are you sure you want to delete this charge?')) return;

            const blTypeId = $(this).data('id');

            $.ajax({
                url: '/admin/bl-types/' + blTypeId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert('blType deleted successfully.');
                    location.reload();
                },
                error: function(xhr) {
                    alert('Failed to delete blType.');
                    console.log(xhr.responseText);
                }
            });
        });
    </script>

@endpush