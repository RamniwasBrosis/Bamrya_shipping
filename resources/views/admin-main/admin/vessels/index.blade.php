@extends('admin-main.layouts.default')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li><h5 class="bc-title">MANAGE VESSELS</h5></li>
    </ol>
    <a class="text-primary fs-13" href="{{url('admin/vessels/create')}}">+ Add Vessel</a>
</div>
<div class="container-fluid p-2">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header py-3 d-sm-flex d-block">
                    <h4 class="card-title mb-2">VESSELS</h4>
                </div>
                <div class="card-header d-block pb-2">
                    <form class="row align-items-end" method="GET" action="{{ route('vessels.index') }}">
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Search by Vessel name</label>
                            <input type="text" class="form-control" id="vessel_name" name="vessel_name" value="{{ request('vessel_name') }}">
                        </div>
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Search by Call sign</label>
                            <input type="text" class="form-control" id="call_sign" name="call_sign" value="{{ request('call_sign') }}">
                        </div>
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <button class="btn btn-primary" type="submit">Apply</button>
                            <a href="{{ route('vessels.index') }}" class="btn btn-danger light ms-2">Reset</a>
                        </div>
                    </form>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive active-projects style-1">
                        <table id="empoloyees-tblwrapper" class="table">
                            <thead>
                                <tr>
                                    <th>Vessel Name</th>
                                    <th>Call Sign</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($vesselDatas as $vesselData)
                                    <tr>
                                    <td>{{$vesselData->vessel_name}}</td>
                                    <td>{{$vesselData->call_sign}}</td>
                                    <td>
                                        @if ($vesselData->status == 1)
                                            <span class="badge badge-success light border-0">Active</span>
                                        @elseif ($vesselData->status == 0)
                                            <span class="badge badge-danger light border-0">Deactive</span>
                                        @elseif ($vesselData->status == 2)
                                            <span class="badge badge-warning light border-0">Pending</span>
                                        @endif
                                        
                                    </td>
                                    <td>
                                        <a class="badge badge-info light border-0" href="{{url('admin/vessels/'.$vesselData->id.'/edit')}}">Edit</a>
                                        <a href="javascript:void(0);" class="badge badge-danger light border-0 delete-vessel" data-id="{{ $vesselData->id }}">Delete</a>
                                    </td>
                                </tr>
                                @endforeach                                
                            </tbody>
                        </table>
                        
                    </div>
                    {{ $vesselDatas->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
    <script>
        $(document).on('click', '.delete-vessel', function(e) {
            e.preventDefault();
            if (!confirm('Are you sure you want to delete this vessel?')) return;

            const vesselId = $(this).data('id');

            $.ajax({
                url: '/admin/vessels/' + vesselId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert('Vessel deleted successfully.');
                    location.reload();
                },
                error: function(xhr) {
                    alert('Failed to delete vessel.');
                    console.log(xhr.responseText);
                }
            });
        });
    </script>

@endpush

