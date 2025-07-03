@extends('admin-main.layouts.default')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li><h5 class="bc-title">MANAGE IMPORT INVOICE</h5></li>
    </ol>
    <a class="text-primary fs-13" href="{{url('admin/SallesRegister/create')}}">+ Add IMPORT INVOICE</a>
</div>
<div class="container-fluid p-2">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header py-3 d-sm-flex d-block">
                    <h4 class="card-title mb-2">IMPORT BL Details</h4>
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
                                    <th>Job No</th>
                                    <th>Invoice NO</th>
                                    <th>Full Inv No</th>
                                    <th>INV_DT</th>
                                    <th>AckNo</th>
                                    <th>AckDt</th>
                                    <th>HBL No</th>
                                    <th>Party Name</th>
                                    <th>FinYear</th>
                                    <th>Inv Type</th>
                                    <th>Inv Cat</th>
                                    <th>FEinv</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>AE/BSCPL/2222/2025-26</td>
                                    <td>4</td>
                                    <td>BSCPL/005/25-26</td>
                                    <td>01-05-2025</td>
                                    <td>25133213</td>
                                    <td>2025-26</td>
                                    <td>775-8014-4816</td>
                                    <td>M/S. KINGWORLDS OVERSEAS & INDUSTRIES LIMITED</td>
                                    <td>2025-26</td>
                                    <td>DebitNote(Rs.)</td>
                                    <td>AIR EXPORTS</td>
                                    <td>False</td>
                                    <td>
                                        <a class="badge badge-info light border-0" href="{{url('admin/SallesRegister/{id}/edit')}}">Edit</a>
                                        <a class="badge badge-danger light border-0" href="#">Delete</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

