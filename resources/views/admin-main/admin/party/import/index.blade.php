@extends('admin-main.layouts.default')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li><h5 class="bc-title">MANAGE IMPORT PARTY</h5></li>
    </ol>
    <a class="text-primary fs-13" href="{{url('admin/import-parties/create')}}">+ Add IMPORT PARTY</a>
</div>
<div class="container-fluid p-2">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header py-3 d-sm-flex d-block">
                    <h4 class="card-title mb-2">IMPORT PARTY</h4>
                </div>
                <div class="card-header d-block pb-2">
                    <form class="row align-items-end" method="GET" action="{{ route('import-parties.index') }}">
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
                            <button id="applyFilter" class="btn btn-primary" type="submit">Apply</button>
                            <a href="{{ route('import-parties.index') }}" class="btn btn-danger light ms-2">Reset</a>
                        </div>
                    </form>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive active-projects style-1">
                        <table id="empoloyees-tblwrapper" class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Party Name</th>
                                    <th>Party Type</th>
                                    <th>Email</th>
                                    <th>PAN No</th>
                                    <th>Status</th>
                                    <th>Updated By</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $index = 1; @endphp
                                @foreach ($importParties as $importParty)
                                    <tr>
                                        <td>{{$index}}</td>
                                        <td>{{$importParty->party_name ?? ''}}</td>
                                        <td>{{$importParty->party->party_name ?? ''}}</td>
                                        <td>{{$importParty->email ?? ''}}</td>
                                        <td>{{$importParty->pan_no ?? ''}}</td>
                                        <td>
                                            @if ($importParty->status == 1)
                                                <span class="badge badge-success light border-0">Active</span>                                 
                                            @else
                                                <span class="badge badge-danger light border-0">Deactive</span>
                                            @endif
                                        </td>
                                        <td>{{$importParty->user->name ?? ''}}</td>
                                        <td>
                                            <a class="badge badge-info light border-0" href="{{url('admin/import-parties/'.$importParty->id.'/edit')}}">Edit</a>
                                            <a class="badge badge-danger light border-0 delete-import-party" href="javascript:void(0);" data-id="{{$importParty->id}}">Delete</a>
                                        </td>
                                    </tr>
                                @php $index = $index + 1 ; @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        {!! $importParties->links('pagination::bootstrap-5') !!}
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
        $(document).on('click', '.delete-import-party', function(e) {
            e.preventDefault();
            if (!confirm('Are you sure you want to delete this Import Party?')) return;

            const partyId = $(this).data('id');

            $.ajax({
                url: '/admin/import-parties/' + partyId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert('Import Party Record deleted successfully.');
                    location.reload();
                },
                error: function(xhr) {
                    alert('Failed to delete Import Party Record.');
                    console.log(xhr.responseText);
                }
            });
        });
    </script>

@endpush
