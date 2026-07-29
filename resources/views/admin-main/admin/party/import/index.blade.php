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
                                    <option value="{{ $partyName->party_name }}"
                                        {{ request('party_name') == $partyName->party_name ? 'selected' : '' }}>
                                        {{ $partyName->party_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Party Type</label>
                            <select name="party_type" id="party_type" class="form-control select2">
                                <option value="">Select Party Type</option>
                                <option value="1" {{ request('party_type') == '1' ? 'selected' : '' }}>Consignee</option>
                                <option value="3" {{ request('party_type') == '3' ? 'selected' : '' }}>CHA</option>
                                <option value="10" {{ request('party_type') == '10' ? 'selected' : '' }}>Billing Party</option>
                                <!--<option value="2">Shipper</option>-->
                                <option value="4" {{ request('party_type') == '4' ? 'selected' : '' }}>Agent Name</option>
                                <option value="5" {{ request('party_type') == '5' ? 'selected' : '' }}>Empty Yard</option>
                                <option value="6" {{ request('party_type') == '6' ? 'selected' : '' }}>Notify Party</option>
                                <option value="7" {{ request('party_type') == '7' ? 'selected' : '' }}>CFS Yard</option>
                                <option value="8" {{ request('party_type') == '8' ? 'selected' : '' }}>Shipping Line/Air Line</option>
                                <option value="9" {{ request('party_type') == '9' ? 'selected' : '' }}>Sales Person</option>
                                <option value="11" {{ request('party_type') == '11' ? 'selected' : '' }}>PIC</option>
                                <option value="15" {{ request('party_type') == '15' ? 'selected' : '' }}>IATA Agent</option>
                                <option value="19" {{ request('party_type') == '19' ? 'selected' : '' }}>Co-loader</option>
                                <option value="21" {{ request('party_type') == '21' ? 'selected' : '' }}>Surveyor</option>
                                <option value="22" {{ request('party_type') == '22' ? 'selected' : '' }}>Delivery Agent Name</option>
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
                        {!! $importParties->withQueryString()->links('pagination::bootstrap-5') !!}
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
