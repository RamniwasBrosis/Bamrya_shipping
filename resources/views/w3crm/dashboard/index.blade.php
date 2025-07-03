@extends('super-admin-main.layouts.default')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li>
            <h5 class="bc-title">Dashboard</h5>
        </li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">
                <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M2.125 6.375L8.5 1.41667L14.875 6.375V14.1667C14.875 14.5424 14.7257 14.9027 14.4601 15.1684C14.1944 15.4341 13.8341 15.5833 13.4583 15.5833H3.54167C3.16594 15.5833 2.80561 15.4341 2.53993 15.1684C2.27426 14.9027 2.125 14.5424 2.125 14.1667V6.375Z"
                        stroke="#2C2C2C" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M6.375 15.5833V8.5H10.625V15.5833" stroke="#2C2C2C" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                Home </a>
        </li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Dashboard</a></li>
    </ol>
</div>
<div class="container-fluid p-2">
    <div class="row">
        <div class="col-xl-9 wid-100">
            <div class="row">

                <div class="col-xl-3 col-sm-6">
                    <div class="card box-hover">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="icon-box icon-box-lg bg-success-light rounded-circle">
                                    <svg width="46" height="46" viewBox="0 0 46 46" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M22.9715 29.3168C15.7197 29.3168 9.52686 30.4132 9.52686 34.8043C9.52686 39.1953 15.6804 40.331 22.9715 40.331C30.2233 40.331 36.4144 39.2328 36.4144 34.8435C36.4144 30.4543 30.2626 29.3168 22.9715 29.3168Z"
                                            stroke="#3AC977" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M22.9714 23.0537C27.7304 23.0537 31.5875 19.1948 31.5875 14.4359C31.5875 9.67694 27.7304 5.81979 22.9714 5.81979C18.2125 5.81979 14.3536 9.67694 14.3536 14.4359C14.3375 19.1787 18.1696 23.0377 22.9107 23.0537H22.9714Z"
                                            stroke="#3AC977" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <div class="total-projects ms-3">
                                    <h3 class="text-success count">24</h3>
                                    <span>Total Completed</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card box-hover">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="icon-box icon-box-lg bg-primary-light rounded-circle">
                                    <svg width="46" height="46" viewBox="0 0 46 46" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M32.8961 26.5849C34.1612 26.5849 35.223 27.629 35.0296 28.8783C33.8947 36.2283 27.6026 41.6855 20.0138 41.6855C11.6178 41.6855 4.8125 34.8803 4.8125 26.4862C4.8125 19.5704 10.0664 13.1283 15.9816 11.6717C17.2526 11.3579 18.5553 12.252 18.5553 13.5605C18.5553 22.4263 18.8533 24.7197 20.5368 25.9671C22.2204 27.2145 24.2 26.5849 32.8961 26.5849Z"
                                            stroke="var(--primary)" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M41.1733 19.2019C41.2739 13.5059 34.2772 4.32428 25.7509 4.48217C25.0877 4.49402 24.5568 5.04665 24.5272 5.70783C24.3121 10.3914 24.6022 16.4605 24.764 19.2118C24.8134 20.0684 25.4864 20.7414 26.341 20.7907C29.1693 20.9526 35.4594 21.1736 40.0759 20.4749C40.7035 20.3802 41.1634 19.8355 41.1733 19.2019Z"
                                            stroke="var(--primary)" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>

                                </div>
                                <div class="total-projects ms-3">
                                    <h3 class="text-primary count">12</h3>
                                    <span>Total In Progress</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card box-hover">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="icon-box icon-box-lg bg-purple-light rounded-circle">
                                    <svg width="46" height="46" viewBox="0 0 46 46" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M22.9717 41.0539C22.9717 41.0539 37.3567 36.6983 37.3567 24.6908C37.3567 12.6814 37.878 11.7439 36.723 10.5889C35.5699 9.43391 24.858 5.69891 22.9717 5.69891C21.0855 5.69891 10.3736 9.43391 9.21863 10.5889C8.0655 11.7439 8.58675 12.6814 8.58675 24.6908C8.58675 36.6983 22.9717 41.0539 22.9717 41.0539Z"
                                            stroke="#BB6BD9" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M26.4945 26.4642L19.4482 19.4179" stroke="#BB6BD9" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M19.4487 26.4642L26.495 19.4179" stroke="#BB6BD9" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <div class="total-projects ms-3">
                                    <h3 class="text-purple count">07</h3>
                                    <span>Total Not Started</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card box-hover">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="icon-box icon-box-lg bg-danger-light rounded-circle">
                                    <svg width="46" height="46" viewBox="0 0 46 46" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M34.0396 20.974C36.6552 20.6065 38.6689 18.364 38.6746 15.6471C38.6746 12.9696 36.7227 10.7496 34.1633 10.3296"
                                            stroke="#FF5E5E" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M37.4912 27.262C40.0243 27.6407 41.7925 28.5276 41.7925 30.3557C41.7925 31.6139 40.96 32.4314 39.6137 32.9451"
                                            stroke="#FF5E5E" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M22.7879 28.0373C16.7616 28.0373 11.6147 28.9504 11.6147 32.5973C11.6147 36.2423 16.7297 37.1817 22.7879 37.1817C28.8141 37.1817 33.9591 36.2779 33.9591 32.6292C33.9591 28.9804 28.846 28.0373 22.7879 28.0373Z"
                                            stroke="#FF5E5E" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M22.7876 22.8325C26.742 22.8325 29.9483 19.6281 29.9483 15.6719C29.9483 11.7175 26.742 8.51123 22.7876 8.51123C18.8333 8.51123 15.627 11.7175 15.627 15.6719C15.612 19.6131 18.7939 22.8194 22.7351 22.8325H22.7876Z"
                                            stroke="#FF5E5E" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M11.5344 20.974C8.91691 20.6065 6.90504 18.364 6.89941 15.6471C6.89941 12.9696 8.85129 10.7496 11.4107 10.3296"
                                            stroke="#FF5E5E" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M8.0825 27.262C5.54937 27.6407 3.78125 28.5276 3.78125 30.3557C3.78125 31.6139 4.61375 32.4314 5.96 32.9451"
                                            stroke="#FF5E5E" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <div class="total-projects ms-3">
                                    <h3 class="text-danger count">05</h3>
                                    <span>Total Not Started</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6">
                    <div class="card box-hover">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="icon-box icon-box-lg bg-danger-light rounded-circle">
                                    <svg width="46" height="46" viewBox="0 0 46 46" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M34.0396 20.974C36.6552 20.6065 38.6689 18.364 38.6746 15.6471C38.6746 12.9696 36.7227 10.7496 34.1633 10.3296"
                                            stroke="#FF5E5E" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M37.4912 27.262C40.0243 27.6407 41.7925 28.5276 41.7925 30.3557C41.7925 31.6139 40.96 32.4314 39.6137 32.9451"
                                            stroke="#FF5E5E" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M22.7879 28.0373C16.7616 28.0373 11.6147 28.9504 11.6147 32.5973C11.6147 36.2423 16.7297 37.1817 22.7879 37.1817C28.8141 37.1817 33.9591 36.2779 33.9591 32.6292C33.9591 28.9804 28.846 28.0373 22.7879 28.0373Z"
                                            stroke="#FF5E5E" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M22.7876 22.8325C26.742 22.8325 29.9483 19.6281 29.9483 15.6719C29.9483 11.7175 26.742 8.51123 22.7876 8.51123C18.8333 8.51123 15.627 11.7175 15.627 15.6719C15.612 19.6131 18.7939 22.8194 22.7351 22.8325H22.7876Z"
                                            stroke="#FF5E5E" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M11.5344 20.974C8.91691 20.6065 6.90504 18.364 6.89941 15.6471C6.89941 12.9696 8.85129 10.7496 11.4107 10.3296"
                                            stroke="#FF5E5E" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M8.0825 27.262C5.54937 27.6407 3.78125 28.5276 3.78125 30.3557C3.78125 31.6139 4.61375 32.4314 5.96 32.9451"
                                            stroke="#FF5E5E" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <div class="total-projects ms-3">
                                    <h3 class="text-danger count">05</h3>
                                    <span>Total Not Started</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!--<div class="col-xl-6 active-p">-->
        <!--    <div class="row">-->
        <!--        <div class="col-12 col-md-12 col-xxl-12 t-earn">-->
        <!--            <div class="card">-->
        <!--                <div class="card-header border-0 pb-0">-->
        <!--                    <h4 class="heading mb-0">Total Earning</h4>-->
        <!--                </div>-->
        <!--                <div class="card-body px-0 overflow-hidden">-->
        <!--                    <div class="total-earning">-->
        <!--                        <h2>$6,743.00</h2>-->
        <!--                        <ul class="nav nav-pills mb-3 earning-tab earning-chart" id="pills-tab1" role="tablist">-->
        <!--                            <li class="nav-item" role="presentation">-->
        <!--                                <button class="nav-link active" data-series="day" id="pills-day-tab1"-->
        <!--                                    data-bs-toggle="pill" data-bs-target="#pills-day1" type="button" role="tab"-->
        <!--                                    aria-selected="true">Day</button>-->
        <!--                            </li>-->
        <!--                            <li class="nav-item" role="presentation">-->
        <!--                                <button class="nav-link" id="pills-week-tab1" data-series="week"-->
        <!--                                    data-bs-toggle="pill" data-bs-target="#pills-week1" type="button" role="tab"-->
        <!--                                    aria-selected="false">Week</button>-->
        <!--                            </li>-->
        <!--                            <li class="nav-item" role="presentation">-->
        <!--                                <button class="nav-link" id="pills-month-tab1" data-series="month"-->
        <!--                                    data-bs-toggle="pill" data-bs-target="#pills-month1" type="button"-->
        <!--                                    role="tab" aria-selected="false">Month</button>-->
        <!--                            </li>-->
        <!--                            <li class="nav-item" role="presentation">-->
        <!--                                <button class="nav-link" id="pills-year-tab1" data-series="year"-->
        <!--                                    data-bs-toggle="pill" data-bs-target="#pills-year1" type="button" role="tab"-->
        <!--                                    aria-selected="false">Year</button>-->
        <!--                            </li>-->
        <!--                        </ul>-->
        <!--                        <div id="earningChart"></div>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->
        
       <!-- <div class="col-xl-12">-->
							<!--	<div class="card overflow-hidden">-->
							<!--		<div class="card-header border-0 pb-0 flex-wrap">-->
							<!--			<h4 class="heading mb-0">Recent Earnings</h4>-->
							<!--			<ul class="nav nav-pills mix-chart-tab" id="pills-tab" role="tablist">-->
							<!--			  <li class="nav-item" role="presentation">-->
							<!--				<button class="nav-link active" data-series="week" id="pills-week-tab" data-bs-toggle="pill" data-bs-target="#pills-week" type="button" role="tab"  aria-selected="true">Week</button>-->
							<!--			  </li>-->
							<!--			  <li class="nav-item" role="presentation">-->
							<!--				<button class="nav-link" data-series="month" id="pills-month-tab" data-bs-toggle="pill" data-bs-target="#pills-month" type="button" role="tab"  aria-selected="false">Month</button>-->
							<!--			  </li>-->
							<!--			  <li class="nav-item" role="presentation">-->
							<!--				<button class="nav-link" data-series="year" id="pills-year-tab" data-bs-toggle="pill" data-bs-target="#pills-year" type="button" role="tab"  aria-selected="false">Year</button>-->
							<!--			  </li>-->
							<!--			   <li class="nav-item" role="presentation">-->
							<!--				<button class="nav-link" data-series="all" id="pills-all-tab" data-bs-toggle="pill" data-bs-target="#pills-all" type="button" role="tab" aria-selected="false">All</button>-->
							<!--			  </li>-->
							<!--			</ul>-->
							<!--		</div>-->
							<!--		<div class="card-body  p-0">-->
							<!--				<div id="overiewChart"></div>-->
							<!--			<div class="ttl-project">-->
							<!--				<div class="pr-data">-->
							<!--					<h5>12,721</h5>-->
							<!--					<span>Number of Projects</span>-->
							<!--				</div>-->
							<!--				<div class="pr-data">-->
							<!--					<h5 class="text-primary">721</h5>-->
							<!--					<span>Active Projects</span>-->
							<!--				</div>-->
							<!--				<div class="pr-data">-->
							<!--					<h5>$2,50,523</h5>-->
							<!--					<span>Revenue</span>-->
							<!--				</div>-->
							<!--				<div class="pr-data">-->
							<!--					<h5 class="text-success">12,275h</h5>-->
							<!--					<span>Working Hours</span>-->
							<!--				</div>-->
							<!--			</div>-->
							<!--		</div>-->
							<!--	</div>-->
							<!--</div>-->

        <div class="col-xl-6 active-p">
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive active-projects shorting">

                        <div class="tbl-caption">
                            <h4 class="heading mb-0">Recent Registered Companies</h4>
                        </div>
                        <table id="projects-tbl" class="table ItemsCheckboxSec">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Packages</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Batman</td>
                                    <td>Batman@gmail.com</td>
                                    <td>Trial (Monthly)</td>
                                    <td>Apr 28, 2025</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>sohan</td>
                                    <td>sohan@gmail.com</td>
                                    <td>Trial (Monthly)</td>
                                    <td>Apr 29, 2025</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>ram</td>
                                    <td>ram@gmail.com</td>
                                    <td>Trial (Monthly)</td>
                                    <td>Apr 30, 2025</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>raman</td>
                                    <td>raman@gmail.com</td>
                                    <td>Trial (Monthly)</td>
                                    <td>may 1, 2025</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>ritu</td>
                                    <td>ritu@gmail.com</td>
                                    <td>Trial (Monthly)</td>
                                    <td>may 2, 2025</td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 active-p">
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive active-projects shorting">

                        <div class="tbl-caption">
                            <h4 class="heading mb-0">Recent Subscriptions</h4>
                        </div>
                        <table id="projects-tbl" class="table ItemsCheckboxSec">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Packages</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <td>No record found.</td>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 active-p">
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive active-projects shorting">

                        <div class="tbl-caption">
                            <h4 class="heading mb-0">Recent Licence Expired Companies</h4>
                        </div>
                        <table id="projects-tbl" class="table ItemsCheckboxSec">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Company Name</th>
                                    <th>Packages</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>20</td>
                                    <td>Mantis Club</td>
                                    <td>Default (Monthly)</td>
                                    <td>Aug 12, 2024</td>
                                </tr>
                                <tr>
                                    <td>19</td>
                                    <td>Aaryan</td>
                                    <td>Default (Monthly)</td>
                                    <td>Aug 26, 2024</td>
                                </tr>
                                <tr>
                                    <td>21</td>
                                    <td>KALSA EDUCATION SKILL DEVELOPMENT & RESEARCH FOUNDATION</td>
                                    <td>Default (Monthly)</td>
                                    <td>Aug 27, 2024</td>
                                </tr>
                                <tr>
                                    <td>16</td>
                                    <td>Harimohan Thakuriya</td>
                                    <td>Default (Monthly)</td>
                                    <td>Aug 23, 2024</td>
                                </tr>
                                <tr>
                                    <td>58</td>
                                    <td>Green Roof Decor</td>
                                    <td>Default (Monthly)</td>
                                    <td>Aug 26, 2024</td>
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
                        @csrf
                        <svg width="41" height="40" viewBox="0 0 41 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M27.1666 26.6667L20.4999 20L13.8333 26.6667" stroke="#DADADA" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M20.5 20V35" stroke="#DADADA" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path
                                d="M34.4833 30.6501C36.1088 29.7638 37.393 28.3615 38.1331 26.6644C38.8731 24.9673 39.027 23.0721 38.5703 21.2779C38.1136 19.4836 37.0724 17.8926 35.6111 16.7558C34.1497 15.619 32.3514 15.0013 30.4999 15.0001H28.3999C27.8955 13.0488 26.9552 11.2373 25.6498 9.70171C24.3445 8.16614 22.708 6.94647 20.8634 6.1344C19.0189 5.32233 17.0142 4.93899 15.0001 5.01319C12.9861 5.0874 11.015 5.61722 9.23523 6.56283C7.45541 7.50844 5.91312 8.84523 4.7243 10.4727C3.53549 12.1002 2.73108 13.9759 2.37157 15.959C2.01205 17.9421 2.10678 19.9809 2.64862 21.9222C3.19047 23.8634 4.16534 25.6565 5.49994 27.1667"
                                stroke="#DADADA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M27.1666 26.6667L20.4999 20L13.8333 26.6667" stroke="#DADADA" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" />
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
                        <label for="exampleFormControlInput1" class="form-label">Employee ID <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
                    </div>
                    <div class="col-xl-6 mb-3">
                        <label for="exampleFormControlInput2" class="form-label">Employee Name<span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="exampleFormControlInput2" placeholder="">
                    </div>
                    <div class="col-xl-6 mb-3">
                        <label for="exampleFormControlInput3" class="form-label">Employee Email<span
                                class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="exampleFormControlInput3" placeholder="">
                    </div>
                    <div class="col-xl-6 mb-3">
                        <label for="exampleFormControlInput4" class="form-label">Password<span
                                class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="exampleFormControlInput4" placeholder="">
                    </div>
                    <div class="col-xl-6 mb-3">
                        <label class="form-label">Designation<span class="text-danger">*</span></label>
                        <select class="default-select style-1 form-control">
                            <option data-display="Select">Please select</option>
                            <option value="html">Software Engineer</option>
                            <option value="css">Civil Engineer</option>
                            <option value="javascript">Web Doveloper</option>
                        </select>
                    </div>
                    <div class="col-xl-6 mb-3">
                        <label class="form-label">Department<span class="text-danger">*</span></label>
                        <select class="default-select style-1 form-control">
                            <option data-display="Select">Please select</option>
                            <option value="html">Software</option>
                            <option value="css">Doit</option>
                            <option value="javascript">Designing</option>
                        </select>
                    </div>
                    <div class="col-xl-6 mb-3">
                        <label class="form-label">Country<span class="text-danger">*</span></label>
                        <select class="default-select style-1 form-control">
                            <option data-display="Select">Please select</option>
                            <option value="html">Ind</option>
                            <option value="css">USA</option>
                            <option value="javascript">UK</option>
                        </select>
                    </div>
                    <div class="col-xl-6 mb-3">
                        <label for="exampleFormControlInput88" class="form-label">Mobile<span
                                class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="exampleFormControlInput88" placeholder="">
                    </div>
                    <div class="col-xl-6 mb-3">
                        <label class="form-label">Gender<span class="text-danger">*</span></label>
                        <select class="default-select style-1 form-control">
                            <option data-display="Select">Please select</option>
                            <option value="html">Male</option>
                            <option value="css">Female</option>
                            <option value="javascript">Other</option>
                        </select>
                    </div>
                    <div class="col-xl-6 mb-3">
                        <label for="exampleFormControlInput99" class="form-label">Joining Date<span
                                class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="exampleFormControlInput99">
                    </div>
                    <div class="col-xl-6 mb-3">
                        <label for="exampleFormControlInput8" class="form-label">Date of Birth<span
                                class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="exampleFormControlInput8">
                    </div>
                    <div class="col-xl-6 mb-3">
                        <label for="exampleFormControlInput10" class="form-label">Reporting To<span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="exampleFormControlInput10" placeholder="">
                    </div>
                    <div class="col-xl-6 mb-3">
                        <label class="form-label">Language Select<span class="text-danger">*</span></label>
                        <select class="default-select style-1 form-control">
                            <option data-display="Select">Please select</option>
                            <option value="html">English</option>
                            <option value="css">Hindi</option>
                            <option value="javascript">Canada</option>
                        </select>
                    </div>
                    <div class="col-xl-6 mb-3">
                        <label class="form-label">User Role<span class="text-danger">*</span></label>
                        <select class="default-select style-1 form-control">
                            <option data-display="Select">Please select</option>
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
                            <input type="email" class="form-control " placeholder="+ invite">
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