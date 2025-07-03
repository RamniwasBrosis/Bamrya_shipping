@extends('super-admin-main.layouts.default')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li>
            <h5 class="bc-title">Invoices</h5>
        </li>
    </ol>
    {{-- <a class="text-primary fs-13" href="#">Add Invoices +</a> --}}

</div>
<div class="container-fluid p-3">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header py-3 d-sm-flex d-block">
                    <h4 class="card-title mb-2">Invoices</h4>
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
                                    <th>ID</th>
                                    <th>Company</th>
                                    <th>Package</th>
                                    <th>Transaction</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Next Payment Date</th>
                                    <th>Payment Gateway</th>
                                    <th>status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>01</td>
                                    <td>BroSis Technology</td>
                                    <td>Package</td>
                                    <td>successfully</td>
                                    <td>2.00</td>
                                    <td>5 Aug 2024</td>
                                    <td>5 Aug 2025</td>
                                    <td>Phone Pay</td>
                                    <td>
                                        <span class="badge badge-success light border-0">Active</span>
                                    </td>
                                    <td>
                                        <a href="#" class="badge badge-info light border-0">Edit</a>
                                        <a href="#" class="badge badge-danger light border-0">Delete</a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>02</td>
                                    <td>BroSis Technology</td>
                                    <td>Package</td>
                                    <td>successfully</td>
                                    <td>2.00</td>
                                    <td>5 Aug 2024</td>
                                    <td>5 Aug 2025</td>
                                    <td>Phone Pay</td>
                                    <td>
                                        <span class="badge badge-success light border-0">Active</span>
                                    </td>
                                    <td>
                                        <a href="#" class="badge badge-info light border-0">Edit</a>
                                        <a href="#" class="badge badge-danger light border-0">Delete</a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>03</td>
                                    <td>BroSis Technology</td>
                                    <td>Package</td>
                                    <td>successfully</td>
                                    <td>2.00</td>
                                    <td>5 Aug 2024</td>
                                    <td>5 Aug 2025</td>
                                    <td>Phone Pay</td>
                                    <td>
                                        <span class="badge badge-success light border-0">Active</span>
                                    </td>
                                    <td>
                                        <a href="#" class="badge badge-info light border-0">Edit</a>
                                        <a href="#" class="badge badge-danger light border-0">Delete</a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>04</td>
                                    <td>BroSis Technology</td>
                                    <td>Package</td>
                                    <td>successfully</td>
                                    <td>2.00</td>
                                    <td>5 Aug 2024</td>
                                    <td>5 Aug 2025</td>
                                    <td>Phone Pay</td>
                                    <td>
                                        <span class="badge badge-success light border-0">Active</span>
                                    </td>
                                    <td>
                                        <a href="#" class="badge badge-info light border-0">Edit</a>
                                        <a href="#" class="badge badge-danger light border-0">Delete</a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>05</td>
                                    <td>BroSis Technology</td>
                                    <td>Package</td>
                                    <td>successfully</td>
                                    <td>2.00</td>
                                    <td>5 Aug 2024</td>
                                    <td>5 Aug 2025</td>
                                    <td>Phone Pay</td>
                                    <td>
                                        <span class="badge badge-success light border-0">Active</span>
                                    </td>
                                    <td>
                                        <a href="#" class="badge badge-info light border-0">Edit</a>
                                        <a href="#" class="badge badge-danger light border-0">Delete</a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>06</td>
                                    <td>BroSis Technology</td>
                                    <td>Package</td>
                                    <td>successfully</td>
                                    <td>2.00</td>
                                    <td>5 Aug 2024</td>
                                    <td>5 Aug 2025</td>
                                    <td>Phone Pay</td>
                                    <td>
                                        <span class="badge badge-success light border-0">Active</span>
                                    </td>
                                    <td>
                                        <a href="#" class="badge badge-info light border-0">Edit</a>
                                        <a href="#" class="badge badge-danger light border-0">Delete</a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>07</td>
                                    <td>BroSis Technology</td>
                                    <td>Package</td>
                                    <td>successfully</td>
                                    <td>2.00</td>
                                    <td>5 Aug 2024</td>
                                    <td>5 Aug 2025</td>
                                    <td>Phone Pay</td>
                                    <td>
                                        <span class="badge badge-success light border-0">Active</span>
                                    </td>
                                    <td>
                                        <a href="#" class="badge badge-info light border-0">Edit</a>
                                        <a href="#" class="badge badge-danger light border-0">Delete</a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>08</td>
                                    <td>BroSis Technology</td>
                                    <td>Package</td>
                                    <td>successfully</td>
                                    <td>2.00</td>
                                    <td>5 Aug 2024</td>
                                    <td>5 Aug 2025</td>
                                    <td>Phone Pay</td>
                                    <td>
                                        <span class="badge badge-success light border-0">Active</span>
                                    </td>
                                    <td>
                                        <a href="#" class="badge badge-info light border-0">Edit</a>
                                        <a href="#" class="badge badge-danger light border-0">Delete</a>
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
@push('modals')


<div class="offcanvas offcanvas-end customeoff" tabindex="-1" id="offcanvasExample1">
    <div class="offcanvas-header">
        <h5 class="modal-title" id="#gridSystemModal1">Add New Task</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
    <div class="offcanvas-body">
        <div class="container-fluid">
            <form>
                @csrf
                <div class="row">
                    <div class="col-xl-6 mb-3">
                        <label for="exampleFormControlInputfirst" class="form-label">Title<span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="exampleFormControlInputfirst" placeholder="Title">
                    </div>
                    <div class="col-xl-6 mb-3">
                        <label class="form-label">Project<span class="text-danger">*</span></label>
                        <select class="default-select style-1 form-control">
                            <option data-display="Select">Project</option>
                            <option value="html">Salesmate</option>
                            <option value="css">ActiveCampaign</option>
                            <option value="javascript">Insightly</option>
                        </select>
                    </div>
                    <div class="col-xl-6 mb-3">
                        <label for="exampleFormControlInputthree" class="form-label">Start Date<span
                                class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="exampleFormControlInputthree">
                    </div>
                    <div class="col-xl-6 mb-3">
                        <label for="exampleFormControlInputfour" class="form-label">End Date<span
                                class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="exampleFormControlInputfour">
                    </div>
                    <div class="col-xl-6 mb-3">
                        <label class="form-label">Estimated Hour<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" class="form-control" value="09:30"><span class="input-group-text"><i
                                    class="fas fa-clock"></i></span>
                        </div>
                    </div>
                    <div class="col-xl-6 mb-3">
                        <label class="form-label">Status<span class="text-danger">*</span></label>
                        <select class="default-select style-1 form-control">
                            <option data-display="Select">Status</option>
                            <option value="html">In Progess</option>
                            <option value="css">Pending</option>
                            <option value="javascript">Completed</option>
                        </select>
                    </div>
                    <div class="col-xl-6 mb-3">
                        <label class="form-label">priority<span class="text-danger">*</span></label>
                        <select class="default-select style-1 form-control">
                            <option data-display="Select">priority</option>
                            <option value="html">Hight</option>
                            <option value="css">Medium</option>
                            <option value="javascript">Low</option>
                        </select>
                    </div>
                    <div class="col-xl-6 mb-3">
                        <label class="form-label">Category<span class="text-danger">*</span></label>
                        <select class="default-select style-1 form-control">
                            <option data-display="Select">Category</option>
                            <option value="html">Designing</option>
                            <option value="css">Development</option>
                            <option value="javascript">react developer</option>
                        </select>
                    </div>
                    <div class="col-xl-6 mb-3">
                        <label class="form-label">Permission<span class="text-danger">*</span></label>
                        <select class="default-select style-1 form-control">
                            <option data-display="Select">Permission</option>
                            <option value="html">Public</option>
                            <option value="css">Private</option>
                        </select>
                    </div>
                    <div class="col-xl-6 mb-3">
                        <label class="form-label">Deadline add<span class="text-danger">*</span></label>
                        <select class="default-select style-1 form-control">
                            <option data-display="Select">Deadline</option>
                            <option value="html">Yes</option>
                            <option value="css">No</option>
                        </select>
                    </div>
                    <div class="col-xl-6 mb-3">
                        <label class="form-label">Assigned to<span class="text-danger">*</span></label>
                        <select class="default-select style-1 form-control">
                            <option data-display="Select">Assigned</option>
                            <option value="html">Bernard</option>
                            <option value="css">Sergey Brin</option>
                            <option value="javascript"> Larry Ellison</option>
                        </select>
                    </div>
                    <div class="col-xl-6 mb-3">
                        <label class="form-label">Responsible Person<span class="text-danger">*</span></label>
                        <input name='tagify' class="form-control py-0 ps-0 h-auto" value='James, Harry'>

                    </div>
                    <div class="col-xl-12 mb-3">
                        <label class="form-label">Description<span class="text-danger">*</span></label>
                        <textarea rows="3" class="form-control"></textarea>
                    </div>
                    <div class="col-xl-12 mb-3">
                        <label class="form-label">Summary<span class="text-danger">*</span></label>
                        <textarea rows="3" class="form-control"></textarea>
                    </div>

                </div>
                <div>
                    <button class="btn btn-danger light ms-1">Cancel</button>
                    <button class="btn btn-primary me-1">Help Desk</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endpush