@extends('admin-main.layouts.default')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li><h5 class="bc-title">MANAGE EXPORT BL</h5></li>
    </ol>
    <a class="text-primary fs-13" href="{{url('admin/sea-exports/create')}}">+ Add Export BL</a>
</div>
<div class="container-fluid p-2">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header py-3 d-sm-flex d-block">
                    {{-- <h4 class="card-title mb-2">Packages</h4> --}}
                </div>
                <div class="card-header d-block pb-2">
                    <form class="row align-items-end" method="GET" action="{{route('sea-exports.index')}}">
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Search By Full Job No.</label>
                            <select id="statusFilter" class="form-control default-select" name="full_job_no">
                                <option value="">select</option>
                                @foreach ($full_job_nums as $full_job_num)
                                    <option value="{{$full_job_num->full_job_no}}">{{$full_job_num->full_job_no}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Search By Job No.</label>
                            <select id="statusFilter" class="form-control default-select" name="job_no">
                                <option value="">select</option>
                                @foreach ($job_nums as $job_num)
                                    <option value="{{$job_num->job_no}}">{{$job_num->job_no}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Search By Booking No.</label>
                            <select id="statusFilter" class="form-control default-select" name="booking_no">
                                <option value="">select</option>
                                @foreach ($booking_nums as $booking_num)
                                    <option value="{{$booking_num->booking_no}}">{{$booking_num->booking_no}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <button id="applyFilter" class="btn btn-primary" type="submit">Apply</button>
                            <a href="{{route('sea-exports.index')}}" id="resetFilter" class="btn btn-danger light ms-2" type="button">Reset</a>
                        </div>
                    </form>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive active-projects style-1">
                        <table id="empoloyees-tblwrapper" class="table">
                            <thead>
                                <tr>
                                    <th>Sea Export ID</th>
                                    <th>FullJobno</th>
                                    <th>Job No</th>
                                    <th>Booking No</th>
                                    <th>Shipper Name</th>
                                    <th>MBL No</th>
                                    <th>HBL No</th>
                                   
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sea_exports as $sea_export)
                                    <tr>
                                        <td>{{$sea_export->id}}</td>
                                        <td>{{$sea_export->full_job_no}}</td>
                                        <td>{{$sea_export->job_no}}</td>
                                        <td>{{$sea_export->booking_no}}</td>
                                        <td>{{$sea_export->shipper_id}}</td>
                                        <td>{{$sea_export->mbl_no}}</td>
                                        <td>{{$sea_export->hbl_no}}</td>
                                      
                                        <td>
                                            <a class="badge badge-info light border-0" href="{{url('admin/sea-exports/'.$sea_export->uuid.'/edit')}}">Edit</a>
                                            <a class="badge badge-danger light border-0 delete-sea-export" href="javascript:void(0);" data-id="{{$sea_export->id}}">Delete</a>
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
        $(document).on('click', '.delete-sea-export', function(e) {
            e.preventDefault();
            if (!confirm('Are you sure you want to delete this Sea Export record?')) return;

            const seaExportId = $(this).data('id');

            $.ajax({
                url: '/admin/sea-exports/' + seaExportId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert('Sea Export record deleted successfully.');
                    location.reload();
                },
                error: function(xhr) {
                $('.error-text').text(''); // Clear all error texts

                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                } else {
                    alert(xhr.responseJSON.message ?? 'Unknown error occurred.');
                }
            }
            });
        });
    </script>

@endpush