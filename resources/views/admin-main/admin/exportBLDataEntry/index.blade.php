@extends('admin-main.layouts.default')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li><h5 class="bc-title">MANAGE EXPORT BL</h5></li>
    </ol>
    <a class="text-primary fs-13" href="{{url('admin/export-bl-entry/create')}}">+ Add EXPORT BL</a>
</div>
<div class="container-fluid p-2">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header py-3 d-sm-flex d-block">
                    <h4 class="card-title mb-2">EXPORT BL Details</h4>
                </div>
                <div class="card-header d-block pb-2">
                    <form class="row align-items-end">
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Search</label>
                            <input type="text" class="form-control" id="searchFilter">
                        </div>
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Status</label>
                            <select id="statusFilter" class="form-control default-select">
                                <option value="">All</option>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                                <option value="Pending">Pending</option>
                            </select>
                        </div>
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Department</label>
                            <select id="departmentFilter" class="form-control default-select">
                                <option value="">All</option>
                                <option value="Computer Science">Computer Science</option>
                                <option value="Web Designer">Web Designer</option>
                            </select>
                        </div>
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Gender</label>
                            <select id="genderFilter" class="form-control default-select">
                                <option value="">All</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Location</label>
                            <select id="locationFilter" class="form-control default-select">
                                <option value="">All</option>
                                <option value="Delhi">Delhi</option>
                                <option value="Bengaluru">Bengaluru</option>
                                <option value="Hyderabad">Hyderabad</option>
                                <option value="Mumbai">Mumbai</option>
                                <option value="Ahmedabad">Ahmedabad</option>
                                <option value="Kolkata">Kolkata</option>
                                <option value="Chennai">Chennai</option>
                            </select>
                        </div>
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <button id="applyFilter" class="btn btn-primary" type="button">Apply</button>
                            <button id="resetFilter" class="btn btn-danger light ms-2" type="button">Reset</button>
                        </div>
                    </form>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive active-projects style-1">
                        <table id="empoloyees-tblwrapper" class="table">
                            <thead>
                                <tr>
                                    <th>FullJobno</th>
                                    <th>Job No</th>
                                    <th>Booking No</th>
                                    <th>Shipper Name</th>
                                    <th>MBL No</th>
                                    <th>HBL No</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($exportBlEntries as $exportBlEntrie)
                                    <tr>
                                        <td>{{$exportBlEntrie->full_job_no}}</td>
                                        <td>{{$exportBlEntrie->job_no}}</td>
                                        <td>{{$exportBlEntrie->booking_no}}</td>
                                        <td>{{$exportBlEntrie->shipper->party_name}}</td>
                                        <td>{{$exportBlEntrie->mbl_no}}</td>
                                        <td>{{$exportBlEntrie->hbl_no}}</td>
                                        <td>Active</td>
                                        <td>
                                            <a class="badge badge-info light border-0" href="{{url('admin/export-bl-entry/'.$exportBlEntrie->uuid.'/edit')}}">Edit</a>
                                            <a class="badge badge-danger light border-0 delete-export-bl" href="javascript:void(0);" data-id="{{$exportBlEntrie->id}}">Delete</a>
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
        $(document).on('click', '.delete-export-bl', function(e) {
            e.preventDefault();
            if (!confirm('Are you sure you want to delete this BL record?')) return;

            const BlId = $(this).data('id');

            $.ajax({
                url: '/admin/export-bl-entry/' + BlId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert('BL Record deleted successfully.');
                    location.reload();
                },
                error: function(xhr) {
                    alert('Failed to delete BL record.');
                    console.log(xhr.responseText);
                }
            });
        });
    </script>

@endpush