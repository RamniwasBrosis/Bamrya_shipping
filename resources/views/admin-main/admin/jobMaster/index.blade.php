@extends('admin-main.layouts.default')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li><h5 class="bc-title">MANAGE Job Master</h5></li>
    </ol>
    <a class="text-primary fs-13" href="{{url('admin/job-masters/create')}}">+ Add Job Master</a>
</div>

<div class="my-8">
    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Error Message --}}
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</div>


<div class="container-fluid p-2">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header py-3 d-sm-flex d-block">
                    <h4 class="card-title mb-2">Job Master Details</h4>
                </div>
                <div class="card-header d-block pb-2">
                    <form class="row align-items-end" action="{{route('job-masters.index')}}" method="get"> 
                        <div class="col-xl-3 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">search by job date</label>
                            <div class="d-flex">
                                <div>
                                    <label for="">Start Date</label>
                                    <input type="date" name="start_date" class="form-control" value="{{request('start_date')}}">
                                </div>
                                <div>
                                    <label for="">End Date</label>
                                    <input type="date" name="end_date" class="form-control" value="{{request('end_date')}}">
                                </div>
                            </div>                        
                        </div>
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Search by Activity</label>
                            <select name="job_activity" class="form-control default-select" value="{{request('job_activity')}}">
                                <option value="">Select</option>
                                <option value="SEAIMP.FWD">SEAIMP.FWD</option>
                                <option value="SEAEXP.FWD">SEAEXP.FWD</option>
                                <option value="AIRIMP.FWD">AIRIMP.FWD</option>
                                <option value="AIREXP.FWD">AIREXP.FWD</option>
                                <option value="SEAIMP.NVOCC">SEAIMP.NVOCC</option>
                                <option value="SEAEXP.NVOCC">SEAEXP.NVOCC</option>
                            </select>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">search by booking date</label>
                            <div class="d-flex">
                                <div>
                                    <label for="">Start Date</label>
                                    <input type="date" name="booking_start_date" class="form-control" value="{{request('booking_start_date')}}">
                                </div>
                                <div>
                                    <label for="">End Date</label>
                                    <input type="date" name="booking_end_date" class="form-control" value="{{request('booking_end_date')}}">
                                </div>
                            </div>                        
                        </div>
                        
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <button id="applyFilter" class="btn btn-primary" type="submit">Apply</button>
                            <a href="{{route('job-masters.index')}}" id="resetFilter" class="btn btn-danger light ms-2" type="button">Reset</a>
                        </div>
                    </form>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive active-projects style-1">
                        <table id="empoloyees-tblwrapper" class="table">
                            <thead>
                                <tr>
                                    <th>Job No</th>
                                    <th>Job Date</th>
                                    <th>REF ID</th>
                                    <th>Activity</th>
                                    <th>Party Name</th>
                                    <th>Remarks</th>
                                    <th>Term</th>
                                    <th>Single_Multi</th>

                                    <th>finyear</th>
                                    <th>Insurance</th>
                                    <th>Clearance</th>
                                    <th>Transportation</th>
                                    <th>Booking Date</th>
                                    <th>Cargo Ready Date</th>
                                    <th>Pickup Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($job_masters as $job_master)
                                    <tr>
                                        {{-- job number is autoincrement as id --}}
                                        <td>{{$job_master->job_no}}</td> 
                                        <td>{{$job_master->job_date}}</td>
                                        <td>
                                            @if ($job_master->issued_by == 'Nominated')
                                                NOM
                                            @else
                                                EN
                                            @endif                                            
                                        </td>
                                        <td>{{$job_master->job_activity}}</td>
                                        <td>{{$job_master->job_party->party_name}}</td>
                                        <td>{{$job_master->job_remarks}}</td>
                                        <td>{{$job_master->term}}</td>
                                        <td>
                                            @if ($job_master->job_activity_type == 1)
                                                Single Hbl
                                            @else
                                                Multi Hbl
                                            @endif
                                        </td>

                                        <td>{{$job_master->job_activity_type}}</td>
                                        <td>{{$job_master->insurance}}</td>
                                        <td>{{$job_master->clearance}}</td>
                                        <td>{{$job_master->transportation}}</td>
                                        <td>{{$job_master->booking_date}}</td>
                                        <td>{{$job_master->cargo_ready_date}}</td>
                                        <td>{{$job_master->pickup_date}}</td>
                                    
                                        <td>
                                            <a class="badge badge-info light border-0" href="{{url('admin/job-masters/'.$job_master->id.'/edit')}}">Edit</a>
                                            <a class="badge badge-danger light border-0 delete-jobs" href="javascript:void(0);" data-id="{{$job_master->id}}">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $job_masters->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@push('scripts')
    <script>
        $(document).on('click', '.delete-jobs', function(e) {
            e.preventDefault();
            if (!confirm('Are you sure you want to delete this port record?')) return;

            const jobId = $(this).data('id');

            $.ajax({
                url: '/admin/job-masters/' + jobId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert('job Record deleted successfully.');
                    location.reload();
                },
                error: function(xhr) {
                    alert('Failed to delete job record.');
                    console.log(xhr.responseText);
                }
            });
        });
    </script>

@endpush