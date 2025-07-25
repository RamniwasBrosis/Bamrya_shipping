@extends('super-admin-main.layouts.default')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li><h5 class="bc-title">Employee</h5></li>
        <li class="breadcrumb-item"><a href="{{ url('index') }}">
            <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M2.125 6.375L8.5 1.41667L14.875 6.375V14.1667C14.875 14.5424 14.7257 14.9027 14.4601 15.1684C14.1944 15.4341 13.8341 15.5833 13.4583 15.5833H3.54167C3.16594 15.5833 2.80561 15.4341 2.53993 15.1684C2.27426 14.9027 2.125 14.5424 2.125 14.1667V6.375Z" stroke="#2C2C2C" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M6.375 15.5833V8.5H10.625V15.5833" stroke="#2C2C2C" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Home</a>
        </li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Employee</a></li>
    </ol>
    <a class="text-primary fs-13" data-bs-toggle="offcanvas" href="#offcanvasExample1" role="button" aria-controls="offcanvasExample1">+ Add Task</a>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header py-3 d-sm-flex d-block">
                    <h4 class="card-title mb-2">Employees</h4>
                    <div>
                        <a class="btn btn-primary btn-sm" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">+ Add Employee</a>
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal1">+ Invite Employee</button>
                    </div>
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
                                    <th>Employee ID</th>
                                    <th>Employee Name</th>
                                    <th>Department</th>
                                    <th>Email Address</th>
                                    <th>Contact Number</th>
                                    <th>Gender</th>
                                    <th>Location</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><span>01</span></td>
                                    <td>
                                        <div class="products">
                                            <img src="images/contacts/pic2.jpg" class="avatar avatar-md" alt="">
                                            <div>
                                                <h6>Liam Antony</h6>
                                                <span>Web Designer</span>   
                                            </div>  
                                        </div>
                                    </td>
                                    <td><span>Computer Science</span></td>
                                    <td><span class="text-primary">abc@gmail.com</span></td>
                                    <td>
                                        <span>+91 123 456 7890</span>
                                    </td>
                                    <td>
                                        <span>Male</span>
                                    </td>   
                                    <td>
                                        <span>Delhi</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-success light border-0">Active</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span>02</span></td>
                                    <td>
                                        <div class="products">
                                            <img src="images/contacts/pic1.jpg" class="avatar avatar-md" alt="">
                                            <div>
                                                <h6>Noah Oliver</h6>
                                                <span>Web Designer</span>   
                                            </div>  
                                        </div>
                                    </td>
                                    <td><span>Computer Science</span></td>
                                    <td><span class="text-primary">abc@gmail.com</span></td>
                                    <td>
                                        <span>+91 123 456 7890</span>
                                    </td>
                                    <td>
                                        <span>Female</span>
                                    </td>   
                                    <td>
                                        <span>Bengaluru</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-danger light border-0">Inactive</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span>03</span></td>
                                    <td>
                                        <div class="products">
                                            <img src="images/contacts/pic3.jpg" class="avatar avatar-md" alt="">
                                            <div>
                                                <h6>Elijah James</h6>
                                                <span>Web Designer</span>   
                                            </div>  
                                        </div>
                                    </td>
                                    <td><span>Computer Science</span></td>
                                    <td><span class="text-primary">abc@gmail.com</span></td>
                                    <td>
                                        <span>+91 123 456 7890</span>
                                    </td>
                                    <td>
                                        <span>Male</span>
                                    </td>   
                                    <td>
                                        <span>Hyderabad</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-success light border-0">Active</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span>04</span></td>
                                    <td>
                                        <div class="products">
                                            <img src="images/contacts/pic3.jpg" class="avatar avatar-md" alt="">
                                            <div>
                                                <h6>James Antony</h6>
                                                <span>Web Designer</span>   
                                            </div>  
                                        </div>
                                    </td>
                                    <td><span>Computer Science</span></td>
                                    <td><span class="text-primary">abc@gmail.com</span></td>
                                    <td>
                                        <span>+91 123 456 7890</span>
                                    </td>
                                    <td>
                                        <span>Male</span>
                                    </td>   
                                    <td>
                                        <span>Mumbai</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-success light border-0">Active</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span>05</span></td>
                                    <td>
                                        <div class="products">
                                            <img src="images/contacts/pic1.jpg" class="avatar avatar-md" alt="">
                                            <div>
                                                <h6>William Sokli</h6>
                                                <span>Web Designer</span>   
                                            </div>  
                                        </div>
                                    </td>
                                    <td><span>Computer Science</span></td>
                                    <td><span class="text-primary">abc@gmail.com</span></td>
                                    <td>
                                        <span>+91 123 456 7890</span>
                                    </td>
                                    <td>
                                        <span>Female</span>
                                    </td>   
                                    <td>
                                        <span>Ahmedabad</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-success light border-0">Active</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span>06</span></td>
                                    <td>
                                        <div class="products">
                                            <img src="images/contacts/pic2.jpg" class="avatar avatar-md" alt="">
                                            <div>
                                                <h6>William Sokli</h6>
                                                <span>Web Designer</span>   
                                            </div>  
                                        </div>
                                    </td>
                                    <td><span>Computer Science</span></td>
                                    <td><span class="text-primary">abc@gmail.com</span></td>
                                    <td>
                                        <span>+91 123 456 7890</span>
                                    </td>
                                    <td>
                                        <span>Male</span>
                                    </td>   
                                    <td>
                                        <span>Kolkata</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-danger light border-0">Inactive</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span>07</span></td>
                                    <td>
                                        <div class="products">
                                            <img src="images/contacts/pic2.jpg" class="avatar avatar-md" alt="">
                                            <div>
                                                <h6>Benjamin Chaa</h6>
                                                <span>Web Designer</span>   
                                            </div>  
                                        </div>
                                    </td>
                                    <td><span>Computer Science</span></td>
                                    <td><span class="text-primary">abc@gmail.com</span></td>
                                    <td>
                                        <span>+91 123 456 7890</span>
                                    </td>
                                    <td>
                                        <span>Male</span>
                                    </td>   
                                    <td>
                                        <span>Chennai</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-success light border-0">Active</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span>08</span></td>
                                    <td>
                                        <div class="products">
                                            <img src="images/contacts/pic1.jpg" class="avatar avatar-md" alt="">
                                            <div>
                                                <h6>William Sokli</h6>
                                                <span>Web Designer</span>   
                                            </div>  
                                        </div>
                                    </td>
                                    <td><span>Computer Science</span></td>
                                    <td><span class="text-primary">abc@gmail.com</span></td>
                                    <td>
                                        <span>+91 123 456 7890</span>
                                    </td>
                                    <td>
                                        <span>Female</span>
                                    </td>   
                                    <td>
                                        <span>Chennai</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-danger light border-0">Inactive</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span>09</span></td>
                                    <td>
                                        <div class="products">
                                            <img src="images/contacts/pic3.jpg" class="avatar avatar-md" alt="">
                                            <div>
                                                <h6>Ricky Antony</h6>
                                                <span>Web Designer</span>   
                                            </div>  
                                        </div>
                                    </td>
                                    <td><span>Computer Science</span></td>
                                    <td><span class="text-primary">abc@gmail.com</span></td>
                                    <td>
                                        <span>+91 123 456 7890</span>
                                    </td>
                                    <td>
                                        <span>Male</span>
                                    </td>   
                                    <td>
                                        <span>Kolkata</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-success light border-0">Active</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span>10</span></td>
                                    <td>
                                        <div class="products">
                                            <img src="images/contacts/pic3.jpg" class="avatar avatar-md" alt="">
                                            <div>
                                                <h6>William Sokli</h6>
                                                <span>Web Designer</span>   
                                            </div>  
                                        </div>
                                    </td>
                                    <td><span>Computer Science</span></td>
                                    <td><span class="text-primary">abc@gmail.com</span></td>
                                    <td>
                                        <span>+91 123 456 7890</span>
                                    </td>
                                    <td>
                                        <span>Male</span>
                                    </td>   
                                    <td>
                                        <span>Delhi</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-success light border-0">Active</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span>11</span></td>
                                    <td>
                                        <div class="products">
                                            <img src="images/contacts/pic1.jpg" class="avatar avatar-md" alt="">
                                            <div>
                                                <h6>Ricky Antony</h6>
                                                <span>Web Designer</span>   
                                            </div>  
                                        </div>
                                    </td>
                                    <td><span>Computer Science</span></td>
                                    <td><span class="text-primary">abc@gmail.com</span></td>
                                    <td>
                                        <span>+91 123 456 7890</span>
                                    </td>
                                    <td>
                                        <span>Female</span>
                                    </td>   
                                    <td>
                                        <span>Pune</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-success light border-0">Active</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span>12</span></td>
                                    <td>
                                        <div class="products">
                                            <img src="images/contacts/pic2.jpg" class="avatar avatar-md" alt="">
                                            <div>
                                                <h6>William Sokli</h6>
                                                <span>Web Designer</span>   
                                            </div>  
                                        </div>
                                    </td>
                                    <td><span>Computer Science</span></td>
                                    <td><span class="text-primary">abc@gmail.com</span></td>
                                    <td>
                                        <span>+91 123 456 7890</span>
                                    </td>
                                    <td>
                                        <span>Male</span>
                                    </td>   
                                    <td>
                                        <span>Ahmedabad</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-danger light border-0">Inactive</span>
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
<div class="offcanvas offcanvas-end customeoff" tabindex="-1" id="offcanvasExample">
    <div class="offcanvas-header">
    <h5 class="modal-title" id="#gridSystemModal">Add Employee</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
          <i class="fa-solid fa-xmark"></i>
      </button>
    </div>
    <div class="offcanvas-body">
      <div class="container-fluid">
          <div>
              <label>Profile Picture</label>
              <div class="dz-default dlab-message upload-img mb-3">
                  <form action="#" class="dropzone">
                      <svg width="41" height="40" viewBox="0 0 41 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M27.1666 26.6667L20.4999 20L13.8333 26.6667" stroke="#DADADA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                          <path d="M20.5 20V35" stroke="#DADADA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                          <path d="M34.4833 30.6501C36.1088 29.7638 37.393 28.3615 38.1331 26.6644C38.8731 24.9673 39.027 23.0721 38.5703 21.2779C38.1136 19.4836 37.0724 17.8926 35.6111 16.7558C34.1497 15.619 32.3514 15.0013 30.4999 15.0001H28.3999C27.8955 13.0488 26.9552 11.2373 25.6498 9.70171C24.3445 8.16614 22.708 6.94647 20.8634 6.1344C19.0189 5.32233 17.0142 4.93899 15.0001 5.01319C12.9861 5.0874 11.015 5.61722 9.23523 6.56283C7.45541 7.50844 5.91312 8.84523 4.7243 10.4727C3.53549 12.1002 2.73108 13.9759 2.37157 15.959C2.01205 17.9421 2.10678 19.9809 2.64862 21.9222C3.19047 23.8634 4.16534 25.6565 5.49994 27.1667" stroke="#DADADA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                          <path d="M27.1666 26.6667L20.4999 20L13.8333 26.6667" stroke="#DADADA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                      </svg>
                      <div class="fallback">
                          <input name="file" type="file" multiple>

                      </div>
                  </form>
              </div>
          </div>
          <form>
            @csrf
              <div class="row">
                  <div class="col-xl-6 mb-3">
                      <label for="exampleFormControlInput1" class="form-label">Employee ID <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
                  </div>
                  <div class="col-xl-6 mb-3">
                      <label for="exampleFormControlInput2" class="form-label">Employee Name<span class="text-danger">*</span></label>
                      <input type="text" class="form-control" id="exampleFormControlInput2" placeholder="">
                  </div>
                  <div class="col-xl-6 mb-3">
                      <label for="exampleFormControlInput3" class="form-label">Employee Email<span class="text-danger">*</span></label>
                      <input type="email" class="form-control" id="exampleFormControlInput3" placeholder="">
                  </div>
                  <div class="col-xl-6 mb-3">
                      <label for="exampleFormControlInput4" class="form-label">Password<span class="text-danger">*</span></label>
                      <input type="password" class="form-control" id="exampleFormControlInput4" placeholder="">
                  </div>
                  <div class="col-xl-6 mb-3">
                      <label class="form-label">Designation<span class="text-danger">*</span></label>
                      <select class="default-select style-1 form-control">
                          <option  data-display="Select">Please select</option>
                          <option value="html">Software Engineer</option>
                          <option value="css">Civil Engineer</option>
                          <option value="javascript">Web Doveloper</option>
                      </select>
                  </div>
                  <div class="col-xl-6 mb-3">
                      <label class="form-label">Department<span class="text-danger">*</span></label>
                      <select class="default-select style-1 form-control">
                          <option  data-display="Select">Please select</option>
                          <option value="html">Software</option>
                          <option value="css">Doit</option>
                          <option value="javascript">Designing</option>
                      </select>
                  </div>
                  <div class="col-xl-6 mb-3">
                      <label class="form-label">Country<span class="text-danger">*</span></label>
                      <select class="default-select style-1 form-control">
                          <option  data-display="Select">Please select</option>
                          <option value="html">Ind</option>
                          <option value="css">USA</option>
                          <option value="javascript">UK</option>
                      </select>
                  </div>
                  <div class="col-xl-6 mb-3">
                      <label for="exampleFormControlInput88" class="form-label">Mobile<span class="text-danger">*</span></label>
                      <input type="number" class="form-control" id="exampleFormControlInput88" placeholder="">
                  </div>
                  <div class="col-xl-6 mb-3">
                      <label class="form-label">Gender<span class="text-danger">*</span></label>
                      <select class="default-select style-1 form-control">
                          <option  data-display="Select">Please select</option>
                          <option value="html">Male</option>
                          <option value="css">Female</option>
                          <option value="javascript">Other</option>
                      </select>
                  </div>
                  <div class="col-xl-6 mb-3">
                      <label for="exampleFormControlInput99" class="form-label">Joining Date<span class="text-danger">*</span></label>
                      <input type="date" class="form-control" id="exampleFormControlInput99">
                  </div>
                  <div class="col-xl-6 mb-3">
                      <label for="exampleFormControlInput8" class="form-label">Date of Birth<span class="text-danger">*</span></label>
                      <input type="date" class="form-control" id="exampleFormControlInput8">
                  </div>
                  <div class="col-xl-6 mb-3">
                      <label for="exampleFormControlInput10" class="form-label">Reporting To<span class="text-danger">*</span></label>
                      <input type="text" class="form-control" id="exampleFormControlInput10" placeholder="">
                  </div>
                  <div class="col-xl-6 mb-3">
                      <label class="form-label">Language Select<span class="text-danger">*</span></label>
                      <select class="default-select style-1 form-control">
                          <option  data-display="Select">Please select</option>
                          <option value="html">English</option>
                          <option value="css">Hindi</option>
                          <option value="javascript">Canada</option>
                      </select>
                  </div>
                  <div class="col-xl-6 mb-3">
                      <label class="form-label">User Role<span class="text-danger">*</span></label>
                      <select class="default-select style-1 form-control">
                          <option  data-display="Select">Please select</option>
                          <option value="html">Parmanent</option>
                          <option value="css">Parttime</option>
                          <option value="javascript">Per Hours</option>
                      </select>
                  </div>
                  <div class="col-xl-12 mb-3">
                      <label class="form-label">Address<span class="text-danger">*</span></label>
                      <textarea rows="3" class="form-control"></textarea>
                  </div>
                  <div class="col-xl-12 mb-3">
                      <label class="form-label">About<span class="text-danger">*</span></label>
                      <textarea rows="3" class="form-control"></textarea>
                  </div>
              </div>
              <div>
                  <button class="btn btn-danger light ms-1">Cancel</button>
                  <button class="btn btn-primary me-1">Submit</button>
              </div>
          </form>
        </div>
    </div>
  </div>

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
                      <label for="exampleFormControlInputfirst" class="form-label">Title<span class="text-danger">*</span></label>
                      <input type="text" class="form-control" id="exampleFormControlInputfirst" placeholder="Title">
                  </div>
                  <div class="col-xl-6 mb-3">
                      <label class="form-label">Project<span class="text-danger">*</span></label>
                      <select class="default-select style-1 form-control">
                          <option  data-display="Select">Project</option>
                          <option value="html">Salesmate</option>
                          <option value="css">ActiveCampaign</option>
                          <option value="javascript">Insightly</option>
                      </select>
                  </div>
                  <div class="col-xl-6 mb-3">
                      <label for="exampleFormControlInputthree" class="form-label">Start Date<span class="text-danger">*</span></label>
                      <input type="date" class="form-control" id="exampleFormControlInputthree">
                  </div>
                  <div class="col-xl-6 mb-3">
                      <label for="exampleFormControlInputfour" class="form-label">End Date<span class="text-danger">*</span></label>
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
                          <option  data-display="Select">Status</option>
                          <option value="html">In Progess</option>
                          <option value="css">Pending</option>
                          <option value="javascript">Completed</option>
                      </select>
                  </div>
                  <div class="col-xl-6 mb-3">
                      <label class="form-label">priority<span class="text-danger">*</span></label>
                      <select class="default-select style-1 form-control">
                          <option  data-display="Select">priority</option>
                          <option value="html">Hight</option>
                          <option value="css">Medium</option>
                          <option value="javascript">Low</option>
                      </select>
                  </div>
                  <div class="col-xl-6 mb-3">
                      <label class="form-label">Category<span class="text-danger">*</span></label>
                      <select class="default-select style-1 form-control">
                          <option  data-display="Select">Category</option>
                          <option value="html">Designing</option>
                          <option value="css">Development</option>
                          <option value="javascript">react developer</option>
                      </select>
                  </div>
                  <div class="col-xl-6 mb-3">
                      <label class="form-label">Permission<span class="text-danger">*</span></label>
                      <select class="default-select style-1 form-control">
                          <option  data-display="Select">Permission</option>
                          <option value="html">Public</option>
                          <option value="css">Private</option>
                      </select>
                  </div>
                  <div class="col-xl-6 mb-3">
                      <label class="form-label">Deadline add<span class="text-danger">*</span></label>
                      <select class="default-select style-1 form-control">
                          <option  data-display="Select">Deadline</option>
                          <option value="html">Yes</option>
                          <option value="css">No</option>
                      </select>
                  </div>
                  <div class="col-xl-6 mb-3">
                      <label class="form-label">Assigned to<span class="text-danger">*</span></label>
                      <select class="default-select style-1 form-control">
                          <option  data-display="Select">Assigned</option>
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
  <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-center">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel1">Invite Employee</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
              <div class="row">
                  <div class="col-xl-12">
                      <label class="form-label">Email ID<span class="text-danger">*</span></label>
                      <input type="email" class="form-control" placeholder="hello@gmail.com">
                      <label class="form-label mt-3">Employment date<span class="text-danger">*</span></label>
                      <input class="form-control" type="date">
                      <div class="row">
                          <div class="col-xl-6">
                              <label class="form-label mt-3">First Name<span class="text-danger">*</span></label>
                              <div class="input-group">
                                  <input type="text" class="form-control" placeholder="Name">
                              </div>
                          </div>
                          <div class="col-xl-6">
                              <label class="form-label mt-3">Last Name<span class="text-danger">*</span></label>
                              <div class="input-group">
                                  <input type="text" class="form-control" placeholder="Surname">
                              </div>
                          </div>
                      </div>
                      <div class="mt-3 invite">
                          <label class="form-label">Send invitation email<span class="text-danger">*</span></label>
                          <input type ="email" class="form-control " placeholder="+ invite">
                      </div>


                  </div>
              </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
@endpush

