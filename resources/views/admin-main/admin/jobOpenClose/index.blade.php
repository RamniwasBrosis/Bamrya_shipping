@extends('admin-main.layouts.default')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li><h5 class="bc-title">MANAGE Job Open Close</h5></li>
    </ol>
    <a class="text-primary fs-13" href="{{url('admin/job-open-close')}}"> <- Go Back</a>
</div>
<div class="container-fluid p-2">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header py-3 d-sm-flex d-block">
                    <h4 class="card-title mb-2">Job Open Close Details</h4>
                </div>
                
                <!--<div class="card-header d-block pb-2">-->
                <!--    <form class="row align-items-end">-->
                <!--        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">-->
                <!--            <label class="form-label">Search</label>-->
                <!--            <input type="text" class="form-control" id="searchFilter">-->
                <!--        </div>-->
                <!--        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">-->
                <!--            <label class="form-label">Status</label>-->
                <!--            <select id="statusFilter" class="form-control default-select">-->
                <!--                <option value="">All</option>-->
                <!--                <option value="Active">Active</option>-->
                <!--                <option value="Inactive">Inactive</option>-->
                <!--                <option value="Pending">Pending</option>-->
                <!--            </select>-->
                <!--        </div>-->
                <!--        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">-->
                <!--            <button id="applyFilter" class="btn btn-primary" type="button">Apply</button>-->
                <!--            <button id="resetFilter" class="btn btn-danger light ms-2" type="button">Reset</button>-->
                <!--        </div>-->
                <!--    </form>-->
                <!--</div>-->
                
                <form action="{{ route('job-open-close.bulkUpdate') }}" method="POST">
                    @csrf
                    <div class="m-3">
                        <div class="mb-3 row d-flex">
                            <label class="col-sm-3 col-form-label">JOB STATUS:</label>
                            <div class="col-sm-9 d-flex align-items-center">
                                <select class="default-select form-control wide me-2" name="job_status">
                                    <option value="">Select</option>
                                    <option value="O">Open</option>
                                    <option value="C">Close</option>
                                </select>
                                <button type="submit" class="btn btn-primary btn-sm">UPDATE</button><br>
                            </div>                            
                        </div>            
                    </div>
                
                    <div class="card-body p-0">
                        <div class="table-responsive active-projects style-1">
                        <table id="empoloyees-tblwrapper" class="table">
                            <thead>
                                <tr>
                                    <th>Select All</th>
                                    <th>Job No</th>
                                    <th>Party Name</th>
                                    <th>Job Date</th>
                                    <th>Activity</th>
                                    <th>Open/Close</th>
                                  
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($results as $result)
                                    {!! $result['result'] !!}
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    </div>
                </form>
                
                
            </div>
        </div>
    </div>

</div>

@endsection
