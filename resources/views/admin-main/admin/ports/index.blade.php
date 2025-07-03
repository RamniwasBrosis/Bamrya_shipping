@extends('admin-main.layouts.default')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li><h5 class="bc-title">MANAGE PORT</h5></li>
    </ol>
    <a class="text-primary fs-13" href="{{url('admin/ports/create')}}">+ Add Port</a>
</div>
<div class="container-fluid p-2">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header py-3 d-sm-flex d-block">
                    <h4 class="card-title mb-2">Ports</h4>
                </div>
                <div class="card-header d-block pb-2">
                    <form class="row align-items-end" method="GET" action="{{ route('ports.index') }}">
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Search By Port code</label>
                            <input type="text" placeholder="Enter code" class="form-control" name="port_code" id="port_code" value="{{ request('port_code') }}">
                        </div>
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">search by port name</label>
                            <input type="text" placeholder="Enter Name" class="form-control" name="port_name" id="port_name" value="{{ request('port_name') }}">
                        </div>

                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">search by EDI code</label>
                            <input type="text" placeholder="Enter edi code" class="form-control" name="edi_code" id="edi_code" value="{{ request('edi_code') }}">
                        </div>
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">search by JNPT code </label>
                            <input type="text" placeholder="Enter jnpt code " class="form-control" name="jnpt_code " id="jnpt_code " value="{{ request('jnpt_code ') }}">
                        </div>

                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">search by NSICT code</label>
                            <input type="text" placeholder="Enter Name" class="form-control" name="nsict_code" id="nsict_code" value="{{ request('nsict_code') }}">
                        </div>
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">search by GTI code</label>
                            <input type="text" placeholder="Enter Name" class="form-control" name="gti_code" id="gti_code" value="{{ request('gti_code') }}">
                        </div>

                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <button id="applyFilter" class="btn btn-primary" type="submit">Apply</button>
                            <a href="{{ route('ports.index') }}" class="btn btn-danger light ms-2" type="button">Reset</a>
                        </div>
                    </form>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive active-projects style-1">
                        <table id="empoloyees-tblwrapper" class="table">
                            <thead>
                                <tr>
                                    <th>Port Code</th>
                                    <th>Port Name</th>
                                    <th>EDI Code</th>
                                    <th>JNPT Code</th>
                                    <th>NSICT CODE</th>
                                    <th>NSICT GROUP Code</th>
                                    <th>GTI Code</th>
                                    <th>GTI GROUP Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ports as $port)
                                    <tr>
                                        <td>{{$port->port_code}}</td>
                                        <td>{{$port->port_name}}</td>
                                        <td>{{$port->edi_code}}</td>
                                        <td>{{$port->jnpt_code}}</td>
                                        <td>{{$port->nsict_code}}</td>
                                        <td>{{$port->nsict_group_code}}</td>
                                        <td>{{$port->gti_code}}</td>
                                        <td>{{$port->gti_group_code}}</td>
                                        <td>
                                            @if ($port->status == 1)
                                                <span class="badge badge-success light border-0">Active</span>
                                            @else
                                                <span class="badge badge-danger light border-0">Deactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a class="badge badge-info light border-0" href="{{url('admin/ports/'.$port->id.'/edit')}}">Edit</a>
                                            <a href="javascript:void(0);" class="badge badge-danger light border-0 delete-port" data-id='{{$port->id}}'>Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                    {{ $ports->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@push('scripts')
    <script>
        $(document).on('click', '.delete-port', function(e) {
            e.preventDefault();
            if (!confirm('Are you sure you want to delete this port record?')) return;

            const portId = $(this).data('id');

            $.ajax({
                url: '/admin/ports/' + portId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert('Port Record deleted successfully.');
                    location.reload();
                },
                error: function(xhr) {
                    alert('Failed to delete port record.');
                    console.log(xhr.responseText);
                }
            });
        });
    </script>

@endpush

