@extends('admin-main.layouts.default')
@section('content')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="page-titles">
    <ol class="breadcrumb">
        <li><h5 class="bc-title">MANAGE Enquiry</h5></li>
    </ol>
    <a class="text-primary fs-13" href="{{url('admin/Enquiry/create')}}">+ Add Enquiry</a>
</div>
<div class="container-fluid p-2">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header py-3 d-sm-flex d-block">
                    <h4 class="card-title mb-2">Enquiry</h4>
                </div>
                <div class="card-header d-block pb-2">
                    <form class="row align-items-end">
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Search</label>
                            <input type="text" class="form-control" id="searchFilter">
                        </div>
                        <!--<div class="col-xl-2 col-sm-6 col-lg-4 mb-3">-->
                        <!--    <label class="form-label">Status</label>-->
                        <!--    <select id="statusFilter" class="form-control default-select">-->
                        <!--        <option value="">All</option>-->
                        <!--        <option value="Active">Active</option>-->
                        <!--        <option value="Inactive">Inactive</option>-->
                        <!--        <option value="Pending">Pending</option>-->
                        <!--    </select>-->
                        <!--</div>-->
                        <!--<div class="col-xl-2 col-sm-6 col-lg-4 mb-3">-->
                        <!--    <label class="form-label">Department</label>-->
                        <!--    <select id="departmentFilter" class="form-control default-select">-->
                        <!--        <option value="">All</option>-->
                        <!--        <option value="Computer Science">Computer Science</option>-->
                        <!--        <option value="Web Designer">Web Designer</option>-->
                        <!--    </select>-->
                        <!--</div>-->
                        <!--<div class="col-xl-2 col-sm-6 col-lg-4 mb-3">-->
                        <!--    <label class="form-label">Gender</label>-->
                        <!--    <select id="genderFilter" class="form-control default-select">-->
                        <!--        <option value="">All</option>-->
                        <!--        <option value="Male">Male</option>-->
                        <!--        <option value="Female">Female</option>-->
                        <!--    </select>-->
                        <!--</div>-->
                        <!--<div class="col-xl-2 col-sm-6 col-lg-4 mb-3">-->
                        <!--    <label class="form-label">Location</label>-->
                        <!--    <select id="locationFilter" class="form-control default-select">-->
                        <!--        <option value="">All</option>-->
                        <!--        <option value="Delhi">Delhi</option>-->
                        <!--        <option value="Bengaluru">Bengaluru</option>-->
                        <!--        <option value="Hyderabad">Hyderabad</option>-->
                        <!--        <option value="Mumbai">Mumbai</option>-->
                        <!--        <option value="Ahmedabad">Ahmedabad</option>-->
                        <!--        <option value="Kolkata">Kolkata</option>-->
                        <!--        <option value="Chennai">Chennai</option>-->
                        <!--    </select>-->
                        <!--</div>-->
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
                                    <th>Fixed Charge ID</th>
                                    <th>Party</th>
                                    <th>LCL/FCL</th>
                                    <th>Buying Rate</th>
                                    <th>Charge Name</th>
                                    <th>RATE BASIS</th>
                                    <th>CURRENCY</th>
                                    <th>Updated By</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($enquiries as $enquiry)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                
                                        <td>
                                            {{ optional($enquiry->importPartyDetails)->party_name ?? '-' }}
                                        </td>
                                
                                        <td>{{ $enquiry->lcl_fcl ?? '-' }}</td>
                                
                                        <td>{{ $enquiry->buying_rate ?? '-' }}</td>
                                
                                        <td>
                                            {{ optional($enquiry->BuyChargeDetails)->charge_name ?? '-' }}
                                        </td>
                                
                                        <td>{{ $enquiry->buy_rate_basic ?? '-' }}</td>
                                
                                        <td>{{ $enquiry->buy_currency ?? '-' }}</td>
                                        <td>{{ $enquiry->user->name ?? '-' }}</td>
                                
                                        <td>
                                            <a class="badge badge-info light border-0"
                                               href="{{ route('enquiry.edit', $enquiry->id) }}">
                                                Edit
                                            </a>
                                
                                            <form action="{{ route('enquiry.destroy', $enquiry->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                            
                                                <button type="submit" class="badge badge-danger light border-0"
                                                        onclick="return confirm('Are you sure you want to delete this enquiry?')">
                                                    Delete
                                                </button>
                                            </form>
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

