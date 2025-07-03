@extends('admin-main.layouts.default')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li><h5 class="bc-title">MANAGE EXPORT AIR BL</h5></li>
    </ol>
    <a class="text-primary fs-13" href="{{url('admin/air-exports/create')}}">+ Add EXPORT AIR BL</a>
</div>
<div class="container-fluid p-2">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header py-3 d-sm-flex d-block">
                    <h4 class="card-title mb-2">EXPORT AIR BL DETAILS</h4>
                </div>
                <div class="card-header d-block pb-2">
                    <form class="row align-items-end" method="get" action="{{route('air-exports.index')}}">
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Search By Booking No.</label>
                            <select id="statusFilter" class="form-control default-select" name="booking_no">
                                <option value="">select</option>
                                @foreach ($filter_records as $filter_record)
                                    <option value="{{$filter_record->booking_no}}">{{$filter_record->booking_no}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Search By Full Job No. </label>
                            <select id="statusFilter" class="form-control default-select" name="full_job_no">
                                <option value="">select</option>
                                @foreach ($filter_records as $filter_record)
                                    <option value="{{$filter_record->full_job_no}}">{{$filter_record->full_job_no}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Search By MAWB No.</label>
                            <select id="departmentFilter" class="form-control default-select" name="mawb_no">
                                <option value="">select</option>
                                @foreach ($filter_records as $filter_record)
                                    <option value="{{$filter_record->mawb_no}}">{{$filter_record->mawb_no}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Search By HAWB No.</label>
                            <select id="genderFilter" class="form-control default-select"  name="hawb_no">
                                <option value="">select</option>
                                @foreach ($filter_records as $filter_record)
                                    <option value="{{$filter_record->hawb_no}}">{{$filter_record->hawb_no}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <button id="applyFilter" class="btn btn-primary" type="submit">Apply</button>
                            <a href="{{route('air-exports.index')}}" id="resetFilter" class="btn btn-danger light ms-2" type="button">Reset</a>
                        </div>
                    </form>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive active-projects style-1">
                        <table id="empoloyees-tblwrapper" class="table">
                            <thead>
                                <tr>
                                    <th>FullJob No</th>
                                    <th>Booking No</th>
                                    <th>Shipper Name</th>
                                    <th>MAWB No</th>
                                    <th>HAWB No</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($air_exports as $air_export)
                                    <tr>
                                        <td>{{$air_export->full_job_no}}</td>
                                        <td>{{$air_export->booking_no}}</td>
                                        <td>{{$air_export->salesPerson->party_name ?? 'N/A'}}</td>
                                        <td>{{$air_export->mawb_no}}</td>
                                        <td>{{$air_export->hawb_no}}</td>
                                        <td>
                                            <aspan class="badge badge-success light border-0">Active</span>
                                        </td>
                                        <td>
                                            <a class="badge badge-info light border-0" href="{{url('admin/air-exports/'.$air_export->uuid.'/edit')}}">Edit</a>
                                            <a class="badge badge-danger light border-0 delete-air-export" href="javascript:void(0);" data-id="{{$air_export->id}}">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@push('scripts')
    <script>
        $(document).on('click', '.delete-air-export', function(e) {
            e.preventDefault();
            if (!confirm('Are you sure you want to delete this Air Export?')) return;

            const airExportId = $(this).data('id');

            $.ajax({
                url: '/admin/air-exports/' + airExportId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    location.reload();
                },
                error: function(xhr) {
                    let errorMessage = 'An error occurred.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    } else if (xhr.responseText) {
                        errorMessage = xhr.responseText;
                    }
                }
            });
        });
    </script>
@endpush