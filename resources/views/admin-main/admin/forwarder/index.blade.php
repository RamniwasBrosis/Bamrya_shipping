@extends('admin-main.layouts.default')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li><h5 class="bc-title">FORWARDER</h5></li>
    </ol>
    <a class="text-primary fs-13" href="{{url('admin/forwarders/create')}}">+ Add FORWARDER</a>
</div>
<div class="container-fluid p-2">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header py-3 d-sm-flex d-block">
                    <h4 class="card-title mb-2">IMPORT PARTY</h4>
                </div>
                <div class="card-header d-block pb-2">
                    <form class="row align-items-end" method="GET" action="{{ route('forwarders.index') }}">
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Search by Party Name</label>
                            <input type="text" class="form-control" id="party_name" name="party_name" value="{{ request('party_name') }}">
                        </div>
                        
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <button id="applyFilter" class="btn btn-primary" type="submit">Apply</button>
                            <a href="{{ route('forwarders.index') }}" class="btn btn-danger light ms-2">Reset</a>
                        </div>
                    </form>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive active-projects style-1">
                        <table id="empoloyees-tblwrapper" class="table">
                            <thead>
                                <tr>
                                    <th>IMPORT PARTY</th>
                                    <th>Party Name</th>
                                    <th>Email</th>
                                    <th>PAN No</th>
                                    <th>Status</th>
                                    <th>Updated By</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($masterForwarder as $forwarder)
                                    <tr>
                                        <td>{{$forwarder->party_code}}</td>
                                        <td>{{$forwarder->party_name}}</td>
                                        <td>{{$forwarder->email}}</td>
                                        <td>{{$forwarder->pan_no}}</td>
                                        <td>
                                            @if ($forwarder->status == 1)
                                                <span class="badge badge-success light border-0">Active</span>                                 
                                            @else
                                                <span class="badge badge-danger light border-0">Deactive</span>
                                            @endif
                                        </td>
                                        <td>{{$forwarder->user->name??''}}</td>
                                        <td>
                                            <a class="badge badge-info light border-0" href="{{url('admin/forwarders/'.$forwarder->id.'/edit')}}">Edit</a>
                                            <a class="badge badge-danger light border-0 delete-forwarder" href="javascript:void(0);" data-id="{{$forwarder->id}}">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        {!! $masterForwarder->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
    <script>
        $(document).on('click', '.delete-forwarder', function(e) {
            e.preventDefault();
            if (!confirm('Are you sure you want to delete this Forwarder?')) return;

            const partyId = $(this).data('id');

            $.ajax({
                url: '/admin/forwarders/' + partyId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert('Forwarder Record deleted successfully.');
                    location.reload();
                },
                error: function(xhr) {
                    alert('Failed to delete Forwarder Record.');
                    // console.log(xhr.responseText);
                }
            });
        });
    </script>

@endpush
