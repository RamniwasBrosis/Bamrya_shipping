@extends('admin-main.layouts.default')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li><h5 class="bc-title">MANAGE EXPORT PARTY</h5></li>
    </ol>
    <a class="text-primary fs-13" href="{{url('admin/export-parties/create')}}">+ Add EXPORT PARTY</a>
</div>
<div class="container-fluid p-2">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header py-3 d-sm-flex d-block">
                    <h4 class="card-title mb-2">EXPORT PARTY</h4>
                </div>
                <div class="card-header d-block pb-2">
                    <form class="row align-items-end" method="get" action="{{route('export-parties.index')}}">
                        <!--<div class="col-xl-2 col-sm-6 col-lg-4 mb-3">-->
                        <!--    <label class="form-label">Search</label>-->
                        <!--    <input type="text" class="form-control" id="searchFilter">-->
                        <!--</div>-->
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Search by party name</label>
                            <select id="party_name" name="party_name" class="form-control select2">
                                <option value="">--select--</option>
                                @foreach ($partyNameList as $partyName)
                                    <option value="{{$partyName->party_name}}">{{$partyName->party_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Party Mode</label>
                            <select name="party_mode" class="form-control">
                                <option value="all" {{ request('party_mode', 'all') == 'all' ? 'selected' : '' }}>
                                    All
                                </option>
                        
                                <option value="local" {{ request('party_mode') == 'local' ? 'selected' : '' }}>
                                    Local
                                </option>
                        
                                <option value="foreign" {{ request('party_mode') == 'foreign' ? 'selected' : '' }}>
                                    Foreign
                                </option>
                            </select>
                        </div>
                        <!--export -->
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Export</label>
                            <select name="export_type" class="form-control">
                                <option value="">Select</option>
                                <option value="pdf" {{ request('export_type') == 'pdf' ? 'selected' : '' }}>
                                    PDF
                                </option>
                                
                                <option value="excel" {{ request('export_type') == 'excel' ? 'selected' : '' }}>
                                    Excel
                                </option>
                            </select>
                        </div>
                        
                        <div class="col-xl-3 col-sm-6 col-lg-4 mb-3">
                            <button id="applyFilter" class="btn btn-primary" type="submit" name="action" value="filter">Apply</button>
                            <button type="submit" name="action" value="export" class="btn btn-success">Export</button>
                            <a id="resetFilter" class="btn btn-danger light ms-2" href="{{route('export-parties.index')}}">Reset</a>
                        </div>
                    </form>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive active-projects style-1">
                        <table id="empoloyees-tblwrapper" class="table">
                            <thead>
                                <tr>
                                    <th>Party Code</th>
                                    <th>Party Name</th>
                                    <th>Email</th>
                                    <th>PAN No</th>
                                    <th>Status</th>
                                    <th>Updated By</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($exportParties as $exportParty)
                                    <tr>                            
                                        <td>{{$exportParty->party_code}}</td>
                                        <td>{{$exportParty->party_name}}</td>
                                        <td>{{$exportParty->email}}</td>
                                        <td>{{$exportParty->pan_no}}</td>
                                        <td>
                                            @if ($exportParty->status == 1)
                                                <span class="badge badge-success light border-0">Active</span>
                                            @else
                                                <span class="badge badge-danger light border-0">Deactive</span>
                                            @endif
                                        </td>
                                        <td>{{$exportParty->user->name??''}}</td>
                                        <td>
                                            <a class="badge badge-info light border-0" href="{{url('admin/export-parties/'.$exportParty->id.'/edit')}}">Edit</a>
                                            <a class="badge badge-danger light border-0 delete-export-party" href="javascript:void(0);" data-id="{{$exportParty->id}}">Delete</a>
                                        </td>                               
                                    </tr>    
                                @endforeach                            
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        {!! $exportParties->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: 'Select a value',
                'allowClear': true,
                width: '100%'
            })
        })
    </script>
    <script>
        $(document).on('click', '.delete-export-party', function(e) {
            e.preventDefault();
            if (!confirm('Are you sure you want to delete this export Party?')) return;

            const partyId = $(this).data('id');

            $.ajax({
                url: '/admin/export-parties/' + partyId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert('Export Party Record deleted successfully.');
                    location.reload();
                },
                error: function(xhr) {
                    alert('Failed to delete Export Party Record.');
                    console.log(xhr.responseText);
                }
            });
        });
    </script>

@endpush