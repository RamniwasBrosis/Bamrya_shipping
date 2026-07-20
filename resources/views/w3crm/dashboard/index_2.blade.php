@extends('admin-main.layouts.default')
@section('content')


 <!-- row -->
	<div class="page-titles">
		<ol class="breadcrumb">
			<li><h5 class="bc-title">Dashboard</h5></li>
			<li class="breadcrumb-item"><a href="javascript:void(0)">
				<svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M2.125 6.375L8.5 1.41667L14.875 6.375V14.1667C14.875 14.5424 14.7257 14.9027 14.4601 15.1684C14.1944 15.4341 13.8341 15.5833 13.4583 15.5833H3.54167C3.16594 15.5833 2.80561 15.4341 2.53993 15.1684C2.27426 14.9027 2.125 14.5424 2.125 14.1667V6.375Z" stroke="#2C2C2C" stroke-linecap="round" stroke-linejoin="round"/>
					<path d="M6.375 15.5833V8.5H10.625V15.5833" stroke="#2C2C2C" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
				Home </a>
			</li>
			<li class="breadcrumb-item active"><a href="javascript:void(0)">Dashboard</a></li>
		</ol>
		<!--<a class="text-primary fs-13" data-bs-toggle="offcanvas" href="#offcanvasExample1" role="button" aria-controls="offcanvasExample1">+ Add Task</a>-->
	</div>
			
	{{-- Display success message --}}
    @if (session('success'))
        <div class="alert alert-success mt-2">
            {{ session('success') }}
        </div>
    @endif
	<div class="container-fluid p-2">
		<div class="row">
			<div class="col-xl-9 wid-100">
				<div class="row">
					<div class="col-xl-3 mb-0 col-sm-6 mb-0">
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
										<h3 class="text-success count">{{ $seaExport  ?? 0 }}</h3>
										<span>Sea Export <br><small class="text-warning">Month Wise</small> </span>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-xl-3 mb-0 col-sm-6 mb-0">
                        <div class="card box-hover ">
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
                                        <h3 class="text-purple count">{{ $seaImport  ?? 0}}</h3>
                                        <span>Sea Import <br><small class="text-warning">Month Wise</small></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xl-3 mb-0 col-sm-6 mb-0">
                        <div class="card box-hover ">
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
                                        <h3 class="text-danger count">{{ $airExport  ?? 0}}</h3>
                                        <span>Air Export <br><small class="text-warning">Month Wise</small></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

					<div class="col-xl-3 mb-0 col-sm-6 mb-0">
                        <div class="card box-hover ">
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
                                        <h3 class="text-primary count">{{ $airImport  ?? 0}}</h3>
                                        <span>Air Import <br><small class="text-warning">Month Wise</small></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        
                    <div class="col-xl-3 m-0 col-sm-6 m-0">
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
                                        <h3 class="text-primary count">{{ $totalJobs  ?? 0}}</h3>
                                        <span>Total Jobs <br><small class="text-warning">Month Wise</small></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xl-3 m-0 col-sm-6 m-0">
                        <div class="card box-hover" style="cursor:pointer;" data-bs-toggle="modal" data-bs-target="#pendingJobsModal" id="pendingJobsCard">
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
                                        <h3 class="text-danger count">{{ $pendingJobs ?? 0 }}</h3>
                                        <span>Pre Shipment <br><small class="text-warning">Pending Jobs Year  Wise</small></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--//pop model-->
                    <!-- Pending Jobs Modal -->
                    <div class="modal fade" id="pendingJobsModal" tabindex="-1" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-scrollable" style="max-width:70%;">
                        <div class="modal-content" style="min-height:60vh;">
                          <div class="modal-header">
                            <h5 class="modal-title">Pending Jobs</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body" id="pendingJobsContent">
                            <p class="text-center">Loading...</p>
                          </div>
                        </div>
                      </div>
                    </div>
        
                    <div class="col-xl-3 m-0 col-sm-6 m-0">
                        <div class="card box-hover" style="cursor:pointer;" data-bs-toggle="modal" data-bs-target="#closeJobsModal" id="closeJobsCard">
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
                                        <h3 class="text-success count">{{ $closeJobs ?? 0}}</h3>
                                       
                                        <span>Closed Jobs <br><small class="text-warning">Year Wise</small></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--pending bills month wise-->
                    <div class="col-xl-3 m-0 col-sm-6 m-0">
                        <div class="card box-hover" style="cursor:pointer;" data-bs-toggle="modal" data-bs-target="#pendingBillsModel" id="closeJobsCard">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="icon-box icon-box-lg bg-success-light rounded-circle">
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
                                        <h3 class="text-success count">{{ $pendingBillsCount }}</h3>
                                       
                                        <span>Pending Bills<br><small class="text-warning">Month Wise</small></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--pending bills previous month-->
                    <div class="col-xl-3 m-0 col-sm-6 m-0">
                        <div class="card box-hover" style="cursor:pointer;" data-bs-toggle="modal" data-bs-target="#pendingPreviousMonthBillsModel" id="closeJobsCard">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="icon-box icon-box-lg bg-success-light rounded-circle">
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
                                        <h3 class="text-success count">{{ $previousMonthPendingBillsCount }}</h3>
                                        
                                        <span>Pending Bills<br><small class="text-warning">Previous Month</small></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--pending bills month Total-->
                    <div class="col-xl-3 m-0 col-sm-6 m-0">
                        <div class="card box-hover" style="cursor:pointer;" data-bs-toggle="modal" data-bs-target="#pendingBillsTotalModel" id="closeJobsCard">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="icon-box icon-box-lg bg-success-light rounded-circle">
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
                                        <h3 class="text-success count">{{ $pendingBillsCountTotal }}</h3>
                                       
                                        <span>Pending Bills<br><small class="text-warning">Total</small></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6">
                        <div class="card box-hover"
                             style="cursor:pointer;"
                             data-bs-toggle="modal"
                             data-bs-target="#needToCloseJobModal">
                    
                            <div class="card-body">
                    
                                <div class="d-flex align-items-center">
                    
                                    <div class="icon-box icon-box-lg bg-danger-light rounded-circle">
                    
                                        <svg width="46" height="46" viewBox="0 0 24 24" fill="none">
                                            <path d="M12 8V12L15 15"
                                                stroke="#dc3545"
                                                stroke-width="2"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"/>
                                            <circle cx="12" cy="12" r="9"
                                                stroke="#dc3545"
                                                stroke-width="2"/>
                                        </svg>
                    
                                    </div>
                    
                                    <div class="total-projects ms-3">
                    
                                        <h3 class="text-danger">
                                            {{ $needToCloseJobsCount }}
                                        </h3>
                    
                                        <span>
                                            Need To Close Job
                                            <br>
                                            <small class="text-warning">
                                                FY 2026-27 Onwards
                                            </small>
                                        </span>
                    
                                    </div>
                    
                                </div>
                    
                            </div>
                        </div>
                    </div>
                    <!-- Close Jobs Modal -->
                    <div class="modal fade" id="closeJobsModal" tabindex="-1" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-scrollable" style="max-width:70%;">
                        <div class="modal-content" style="min-height:60vh;">
                          <div class="modal-header">
                            <h5 class="modal-title">Close Jobs</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body" id="closeJobsContent">
                            <p class="text-center">Loading...</p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!--pending bills month wise pop up model-->
                    <div class="modal fade" id="pendingBillsModel" tabindex="-1" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-scrollable" style="max-width:70%;">
                        <div class="modal-content" style="min-height:60vh;">
                          <div class="modal-header">
                            <h5 class="modal-title">Pending Bills</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">

                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th width="5%">#</th>
                                        <th>Job No</th>
                                        <th>Job Date</th>
                                        <th>Customer</th>
                                    </tr>
                                </thead>
                        
                                <tbody>
                                    @forelse($pendingBillsJobs as $job)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <strong>{{ $job->full_job_no }}</strong>
                                            </td>
                                            <td>
                                                {{ date('d-m-Y', strtotime($job->job_date)) }}
                                            </td>
                                            <td>
                                                @if(str_contains($job->job_activity, 'EXP'))
                                                    {{ $job->shipperName->party_name ?? '-' }}
                                                @else
                                                    {{ $job->consigneeName->party_name ?? '-' }}
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-success">
                                                No Pending Bills Found
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        
                        </div>
                        </div>
                      </div>
                    </div>
                    <!--pending bills previous month pop up model-->
                    <div class="modal fade" id="pendingPreviousMonthBillsModel" tabindex="-1" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-scrollable" style="max-width:70%;">
                        <div class="modal-content" style="min-height:60vh;">
                          <div class="modal-header">
                            <h5 class="modal-title">Pending Bills Of Previous Month</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">

                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th width="5%">#</th>
                                        <th>Job No</th>
                                        <th>Job Date</th>
                                        <th>Customer</th>
                                    </tr>
                                </thead>
                        
                                <tbody>
                                    @forelse($previousMonthPendingBills as $job)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <strong>{{ $job->full_job_no }}</strong>
                                            </td>
                                            <td>
                                                {{ date('d-m-Y', strtotime($job->job_date)) }}
                                            </td>
                                            <td>
                                                @if(str_contains($job->job_activity, 'EXP'))
                                                    {{ $job->shipperName->party_name ?? '-' }}
                                                @else
                                                    {{ $job->consigneeName->party_name ?? '-' }}
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-success">
                                                No Pending Bills Found
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        
                        </div>
                        </div>
                      </div>
                    </div>
                    <!--total pending total bills pop up model-->
                    <div class="modal fade" id="pendingBillsTotalModel" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable" style="max-width:70%;">
                            <div class="modal-content" style="min-height:60vh;">
                    
                                <div class="modal-header">
                                    <h5 class="modal-title">Financial Year Wise Pending Bills</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                    
                                <div class="modal-body">
                    
                                    @forelse($pendingBillsFY as $fy => $jobs)
                    
                                        <div class="card mb-4 shadow-sm">
                                            <div class="card-header bg-primary text-white d-flex justify-content-between">
                                                <strong>Financial Year : {{ $fy }}</strong>
                                                <strong>Total Bills : {{ $jobs->count() }}</strong>
                                            </div>
                    
                                            <div class="card-body p-0">
                    
                                                <table class="table table-bordered table-hover mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th width="5%">#</th>
                                                            <th>Job No</th>
                                                            <th>Job Date</th>
                                                            <th>Customer</th>
                                                        </tr>
                                                    </thead>
                    
                                                    <tbody>
                                                        @foreach($jobs as $job)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                    
                                                                <td>
                                                                    <strong>{{ $job->full_job_no }}</strong>
                                                                </td>
                    
                                                                <td>
                                                                    {{ date('d-m-Y', strtotime($job->job_date)) }}
                                                                </td>
                    
                                                                <td>
                                                                    @if(str_contains($job->job_activity, 'EXP'))
                                                                        {{ $job->shipperName->party_name ?? '-' }}
                                                                    @else
                                                                        {{ $job->consigneeName->party_name ?? '-' }}
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                    
                                            </div>
                                        </div>
                    
                                    @empty
                    
                                        <div class="alert alert-success text-center">
                                            No Pending Bills Found
                                        </div>
                    
                                    @endforelse
                    
                                </div>
                    
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal fade" id="needToCloseJobModal" tabindex="-1">
                        <div class="modal-dialog modal-dialog-scrollable" style="max-width:70%;">
                            <div class="modal-content" style="min-height:60vh;">
                                <div class="modal-header">
                                    <h5 class="modal-title">
                                        Need To Close Job
                                    </h5>
                                    <button type="button"
                                            class="btn-close"
                                            data-bs-dismiss="modal">
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Job No</th>
                                                <th>Job Date</th>
                                                <th>Customer</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($needToCloseJobs as $job)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <strong>{{ $job->full_job_no }}</strong>
                                                    </td>
                                                    <td>
                                                        {{ date('d-m-Y', strtotime($job->job_date)) }}
                                                    </td>
                                                    <td>
                                                        @if(str_contains($job->job_activity,'EXP'))
                                                            {{ $job->shipperName->party_name ?? '-' }}
                                                        @else
                                                            {{ $job->consigneeName->party_name ?? '-' }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <button
                                                            class="btn btn-sm btn-danger closeJobBtn"
                                                            data-id="{{ $job->id }}">
                                                            Open
                                                        </button>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center text-success">
                                                        No Open Jobs Found
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xl-3 m-0 col-sm-6 m-0">
                        <div class="card box-hover" data-bs-toggle="modal" data-bs-target="#leoDateModal" style="cursor:pointer;">
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
                                        <h3 class="text-purple count">{{ $leo_pending ?? 0 }}</h3>
                                        <span>Leo Date/Out Of Charge Status</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--// leo date status pop model-->
                    <div class="modal fade" id="leoDateModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable" style="max-width:70%;">
                            <div class="modal-content" style="min-height:60vh;">
                                <div class="modal-header">
                                    <h5 class="modal-title">Pending LEO Date</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                    
                                <div class="modal-body" id="leoDateContent">
                                    <p class="text-center">Loading...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!--// Operation Complate-->
                    <div class="col-xl-3 m-0 col-sm-6 m-0">
                        <div class="card box-hover" data-bs-toggle="modal" data-bs-target="#ComplateOperationModal" style="cursor:pointer;">
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
                                        <h3 class="text-purple count">{{ $complate_operation ?? 0 }}</h3>
                                        <span>Operation Complate</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--// Operation Complate status pop model-->
                    <div class="modal fade" id="ComplateOperationModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable" style="max-width:70%;">
                            <div class="modal-content" style="min-height:60vh;">
                                <div class="modal-header">
                                    <h5 class="modal-title">All Complete Operations</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                    
                                <div class="modal-body" id="ComplateOperationContent">
                                    <p class="text-center">Loading...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    

                    @can('accounts')
					<div class="col-xl-12">
					    
					    @php
                            // Current Financial Year auto detect
                            $year = date('m') >= 4 ? date('Y') : date('Y') - 1;
                            $financialYear = $year . '-' . ($year + 1);
                        @endphp
					    
					    
						<div class="card overflow-hidden">
							<div class="card-header border-0 pb-0 d-flex align-items-center">
								<h4 class="heading mb-0 w-50">Recent Earnings</h4>
                                <select class="form-select form-select-sm px-1 w-25" id="financial-year">
                                    <option value="">select</option>
                                    @foreach($financialYears as $fy)
                                        <option value="{{ $fy }}">FY {{ $fy }}</option>
                                    @endforeach
                                </select>
							</div>
							<div class="card-body  p-0">
									<div id="overiewChart"></div>
								<div class="ttl-project">
									<div class="pr-data">
										<h5 id="totalJobs"></h5>
										<span>Total Jobs (Year Wise)</span>
									</div>
									<div class="pr-data">
										<h5 class="text-primary" id="totalSales">₹</h5>
										<span>Total sales (Year Wise)</span>
									</div>
									<div class="pr-data">
										<h5 id="totalPurchases">₹</h5>
										<span>Total Purchase (Year Wise)</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					@endcan
					<div class="col-xl-12">
					    
					    @php
                            // Current Financial Year auto detect
                            $year = date('m') >= 4 ? date('Y') : date('Y') - 1;
                            $financialYear = $year . '-' . ($year + 1);
                        @endphp
					    
					    
						<div class="card overflow-hidden">
							<div class="card-header border-0 pb-0 d-flex align-items-center">
								<h4 class="heading mb-0 w-50">Month Wise Jobs</h4>
                               
							</div>
							<div class="card-body  p-0">
								<div id="monthWise_overiewChart"></div>
							</div>
						</div>
					</div>
					
					<div class="col-xl-12 col-lg-10">
        				<div class="card">
        					<div class="card-header  border-0 pb-0">
        						<h4 class="card-title">Overdue Tasks</h4>
        					</div>
        					<div class="card-body p-0">
        						<div id="DZ_W_Todo1" class="widget-media dz-scroll height600 my-4 px-4">
        							<ul class="timeline">
        								@if(isset($pendingBlLists) && $pendingBlLists->count() > 0)
                                            @foreach($pendingBlLists as $job)
                                               @php
                                                if($job->prefix == 'AI'){
                                                    $url = route('air-imports.edit', $job->uuid);
                                                }
                                                if($job->prefix == 'AE'){
                                                    $url = route('air-exports.edit', $job->uuid);
                                                }
                                                if($job->seaImport?->prefix == 'SI'){
                                                    $url = route('sea-imports.edit', $job->seaImport->uuid);
                                                }
                                                if($job->seaExport?->prefix == 'SE'){
                                                    
                                                    $url = route('sea-exports.edit', $job->seaExport->uuid);
                                                }
                                               @endphp
                                                <li>
                                                    <div class="timeline-badge {{ $loop->iteration % 6 == 0 ? 'dark' : ($loop->iteration % 5 == 0 ? 'warning' : ($loop->iteration % 4 == 0 ? 'success' : ($loop->iteration % 3 == 0 ? 'danger' : ($loop->iteration % 2 == 0 ? 'info' : 'primary')))) }}"></div>
                                                    <a class=" text-muted" href="{{ $url }}" style="padding:1px;">
                                                        <span class="mb-0">
                                                            @if($job->prefix == 'AI')
                                                                FulljobNumber: <strong class="text-primary">{{ $job->jobMaster->full_job_no ?? 'N/A' }} &nbsp;</strong><span style="color:#000;">Consignee: {{ $job->ConsigneeName->party_name ?? '' }} | </span>
                                                            @elseif($job->prefix == 'AE')
                                                                FulljobNumber: <strong class="text-primary">{{ $job->jobMaster->full_job_no ?? 'N/A' }} &nbsp;</strong><span style="color:#000;">Shipper: {{ $job->shipperName->party_name ?? '' }} | </span>
                                                            @elseif($job->seaImport?->prefix == 'SI')
                                                                FulljobNumber: <strong class="text-primary">{{ $job->seaImport->jobMaster->full_job_no ?? 'N/A' }} &nbsp;</strong><span style="color:#000;">Consignee: {{$job->seaImport->consignee->party_name ?? ''}} |</span>
                                                            @else
                                                                FulljobNumber: <strong class="text-primary">{{ $job->seaExport->jobMaster->full_job_no ?? 'N/A' }} &nbsp;</strong><span style="color:#000;">Shipper: {{$job->seaExport->shipperName->party_name}} | </span>
                                                            @endif
                                                        </span>
                                                        @php
                                                            $missingFields = [];
                                                            if(isset($job) && $job->prefix == 'AI') {
                                                                if(empty($job->eta_date)) $missingFields[] = 'ETA Date';
                                                                if(empty($job->etd_date)) $missingFields[] = 'ETD Date';
                                                                if(empty($job->out_off_charge_date)) $missingFields[] = 'Out of Charge Date';
                                                                if(empty($job->check_list_date)) $missingFields[] = 'Check List Date';
                                                                if(empty($job->bill_of_entry_date)) $missingFields[] = 'Bill of entry Date';
                                                                if(empty($job->customer_inv_no)) $missingFields[] = 'Cust Inv No/Date';
                                                                if(empty($job->arrival_date)) $missingFields[] = 'Arriaval Date';
                                                                
                                                            } else if(isset($job) && $job->prefix == 'AE') {
                                                                if(empty($job->eta_date)) $missingFields[] = 'ETA Date';
                                                                if(empty($job->etd_date)) $missingFields[] = 'ETD Date';
                                                                if(empty($job->leo_date)) $missingFields[] = 'LEO Date';
                                                                if(empty($job->check_list_date)) $missingFields[] = 'Check List Date';
                                                                if(empty($job->cartining_date)) $missingFields[] = 'Cartining Date';
                                                                if(empty($job->sbill_no)) $missingFields[] = 'Sbill No/Date';
                                                                if(empty($job->customer_inv_no)) $missingFields[] = 'Cust Inv No/Date';
                                                                
                                                            }else if(isset($job) && $job->seaImport?->prefix == 'SI') {
                                                                if(empty($job->seaImport->eta_date)) $missingFields[] = 'ETA Date';
                                                                if(empty($job->seaImport->etd_date)) $missingFields[] = 'ETD Date';
                                                                if(empty($job->out_off_charge_date)) $missingFields[] = 'Out of Charge Date';
                                                                if(empty($job->check_list_date)) $missingFields[] = 'Check List Date';
                                                                if(empty($job->bill_of_entry_date)) $missingFields[] = 'Bill of entry Date';
                                                                if(empty($job->customer_inv_no)) $missingFields[] = 'Cust Inv No/Date';
                                                                if(empty($job->destuffing_date)) $missingFields[] = 'Destuffing Date';
                                                              
                                                            }else if(isset($job) && $job->seaExport?->prefix == 'SE') {
                                                                if(empty($job->seaExport->eta_date)) $missingFields[] = 'ETA Date';
                                                                if(empty($job->seaExport->etd_date)) $missingFields[] = 'ETD Date';
                                                                if(empty($job->leo_date)) $missingFields[] = 'LEO Date';
                                                                if(empty($job->check_list_date)) $missingFields[] = 'Check List Date';
                                                                if(empty($job->cartining_date)) $missingFields[] = 'Cartining Date';
                                                                if(empty($job->sbill_no)) $missingFields[] = 'Sbill No/Date';
                                                                if(empty($job->customer_inv_no)) $missingFields[] = 'Cust Inv No/Date';
                                                                
                                                            }
                                                        @endphp
                                                        <span style="color:#000;"> Pending Values :  {{ implode(', ', $missingFields) }} </span>
        
                                                        <!--<span>&nbsp;&nbsp; {{ $job->created_at->diffForHumans() }}</span>-->
                                                    </a>
                                                </li>
                                            @endforeach
                                        @else
                                            <li>
                                                <div class="timeline-badge secondary"></div>
                                                <a class="timeline-panel text-muted" href="javascript:void(0);">
                                                    <span>No pending jobs</span>
                                                    <h6 class="mb-0">All jobs are up to date</h6>
                                                    <p class="mb-0">There are no jobs with missing dates at the moment.</p>
                                                </a>
                                            </li>   
                                        @endif
        							</ul>
        						</div>
        					</div>
        				</div>
        			</div>
				</div>
			</div>
			
			<div class="col-xl-3 col-md-6 up-shd">
				<div class="card">
					<div class="card-header border-0 pb-1">
						<h4 class="heading mb-0">Leaves</h4>
					</div>
					<div class="card-body schedules-cal p-2">
						<input type="text" class="form-control d-none" id="datetimepicker1">
						<!--<div class="events">-->
						<!--	<h6>events</h6>-->
						<!--	<div class="dz-scroll event-scroll">-->
						<!--		<div class="event-media">-->
						<!--			<div class="d-flex align-items-center">-->
						<!--				<div class="event-box">-->
						<!--					<h5 class="mb-0">20</h5>-->
						<!--					<span>Mon</span>-->
						<!--				</div>-->
						<!--				<div class="event-data ms-2">-->
						<!--					<h5 class="mb-0"><a href="javascript:void(0)">Development planning</a></h5>-->
						<!--					<span>w3it Technologies</span>-->
						<!--				</div>-->
						<!--			</div>-->
						<!--			<span class="text-secondary">12:05 PM</span>-->
						<!--		</div>-->
						<!--		<div class="event-media">-->
						<!--			<div class="d-flex align-items-center">-->
						<!--				<div class="event-box">-->
						<!--					<h5 class="mb-0">20</h5>-->
						<!--					<span>Mon</span>-->
						<!--				</div>-->
						<!--				<div class="event-data ms-2">-->
						<!--					<h5 class="mb-0"><a href="javascript:void(0)">Development planning</a></h5>-->
						<!--					<span>w3it Technologies</span>-->
						<!--				</div>-->
						<!--			</div>-->
						<!--			<span class="text-secondary">12:05 PM</span>-->
						<!--		</div>-->
						<!--		<div class="event-media">-->
						<!--			<div class="d-flex align-items-center">-->
						<!--				<div class="event-box">-->
						<!--					<h5 class="mb-0">20</h5>-->
						<!--					<span>Mon</span>-->
						<!--				</div>-->
						<!--				<div class="event-data ms-2">-->
						<!--					<h5 class="mb-0"><a href="javascript:void(0)">Development planning</a></h5>-->
						<!--					<span>w3it Technologies</span>-->
						<!--				</div>-->
						<!--			</div>-->
						<!--			<span class="text-secondary">12:05 PM</span>-->
						<!--		</div>-->
						<!--	</div>-->
						<!--</div>-->
					</div>
				</div>
			</div>
			
			
			
			
			<!--<div class="col-xl-3 col-md-6 up-shd">-->
			<!--	<div class="card">-->
			<!--		<div class="card-header pb-0 border-0">-->
			<!--			<h4 class="heading mb-0">New Tickets</h4>-->
			<!--		</div>-->
			<!--		<div class="card-body">-->
			<!--			<div id="" class="project-chart">No ticket found.</div>-->
			<!--			<div class="project-date">-->
							
			<!--			</div>-->
			<!--		</div>-->
			<!--	</div>-->
			<!--</div>-->
			
			
            
			
			
	
			<!--<div class="col-xl-6 col-lg-6">-->
			<!--	<div class="card">-->
			<!--		<div class="card-header  border-0 pb-0">-->
			<!--			<h4 class="card-title">Pending FollowUp</h4>-->
			<!--		</div>-->
			<!--		<div class="card-body p-0">-->
			<!--			<div id="DZ_W_Todo1" class="widget-media dz-scroll height600 my-4 px-4">-->
			<!--				<ul class="timeline">-->
			<!--					<li>-->
			<!--						<div class="timeline-panel">-->
			<!--							<div class="media me-2">-->
			<!--								<img alt="image" width="50" src="{{asset('images/avatar/1.jpg')}}">-->
			<!--							</div>-->
			<!--							<div class="media-body">-->
			<!--								<h5 class="mb-1">Dr sultads Send you Photo</h5>-->
			<!--							</div>-->
			<!--							<small class="d-block">29 July 2020 - 02:26 PM</small>-->
			<!--						</div>-->
			<!--					</li>-->
			<!--					<li>-->
			<!--						<div class="timeline-panel">-->
			<!--							<div class="media me-2 media-info">-->
			<!--								KG-->
			<!--							</div>-->
			<!--							<div class="media-body">-->
			<!--								<h5 class="mb-1">Resport created successfully</h5>-->
			<!--							</div>-->
			<!--							<small class="d-block">29 July 2020 - 02:26 PM</small>-->
			<!--						</div>-->
			<!--					</li>-->
			<!--					<li>-->
			<!--						<div class="timeline-panel">-->
			<!--							<div class="media me-2 media-success">-->
			<!--								<i class="fa fa-home"></i>-->
			<!--							</div>-->
			<!--							<div class="media-body">-->
			<!--								<h5 class="mb-1">Reminder : Treatment Time!</h5>-->
			<!--							</div>-->
			<!--							<small class="d-block">29 July 2020 - 02:26 PM</small>-->
			<!--						</div>-->
			<!--					</li>-->
			<!--					<li>-->
			<!--						<div class="timeline-panel">-->
			<!--							<div class="media me-2">-->
			<!--								<img alt="image" width="50" src="{{asset('images/avatar/1.jpg')}}">-->
			<!--							</div>-->
			<!--							<div class="media-body">-->
			<!--								<h5 class="mb-1">Dr sultads Send you Photo</h5>-->
			<!--							</div>-->
			<!--							<small class="d-block">29 July 2020 - 02:26 PM</small>-->
			<!--						</div>-->
			<!--					</li>-->
			<!--					<li>-->
			<!--						<div class="timeline-panel">-->
			<!--							<div class="media me-2 media-info">-->
			<!--								KG-->
			<!--							</div>-->
			<!--							<div class="media-body">-->
			<!--								<h5 class="mb-1">Resport created successfully</h5>-->
			<!--							</div>-->
			<!--							<small class="d-block">29 July 2020 - 02:26 PM</small>-->
			<!--						</div>-->
			<!--					</li>-->
			<!--					<li>-->
			<!--						<div class="timeline-panel">-->
			<!--							<div class="media me-2">-->
			<!--								<img alt="image" width="50" src="{{asset('images/avatar/1.jpg')}}">-->
			<!--							</div>-->
			<!--							<div class="media-body">-->
			<!--								<h5 class="mb-1">Dr sultads Send you Photo</h5>-->
			<!--							</div>-->
			<!--							<small class="d-block">29 July 2020 - 02:26 PM</small>-->
			<!--						</div>-->
			<!--					</li>-->
			<!--					<li>-->
			<!--						<div class="timeline-panel">-->
			<!--							<div class="media me-2 media-info">-->
			<!--								KG-->
			<!--							</div>-->
			<!--							<div class="media-body">-->
			<!--								<h5 class="mb-1">Resport created successfully</h5>-->
			<!--							</div>-->
			<!--							<small class="d-block">29 July 2020 - 02:26 PM</small>-->
			<!--						</div>-->
			<!--					</li>-->
			<!--					<li>-->
			<!--						<div class="timeline-panel">-->
			<!--							<div class="media me-2">-->
			<!--								<img alt="image" width="50" src="{{asset('images/avatar/1.jpg')}}">-->
			<!--							</div>-->
			<!--							<div class="media-body">-->
			<!--								<h5 class="mb-1">Dr sultads Send you Photo</h5>-->
			<!--							</div>-->
			<!--							<small class="d-block">29 July 2020 - 02:26 PM</small>-->
			<!--						</div>-->
			<!--					</li>-->
			<!--					<li>-->
			<!--						<div class="timeline-panel">-->
			<!--							<div class="media me-2 media-danger">-->
			<!--								KG-->
			<!--							</div>-->
			<!--							<div class="media-body">-->
			<!--								<h5 class="mb-1">Resport created successfully</h5>-->
			<!--							</div>-->
			<!--							<small class="d-block">29 July 2020 - 02:26 PM</small>-->
			<!--						</div>-->
			<!--					</li>-->
			<!--					<li>-->
			<!--						<div class="timeline-panel">-->
			<!--							<div class="media me-2 media-primary">-->
			<!--								<i class="fa fa-home"></i>-->
			<!--							</div>-->
			<!--							<div class="media-body">-->
			<!--								<h5 class="mb-1">Reminder : Treatment Time!</h5>-->
			<!--							</div>-->
			<!--							<small class="d-block">29 July 2020 - 02:26 PM</small>-->
			<!--						</div>-->
			<!--					</li>-->
			<!--					<li>-->
			<!--						<div class="timeline-panel">-->
			<!--							<div class="media me-2">-->
			<!--								<img alt="image" width="50" src="{{asset('images/avatar/1.jpg')}}">-->
			<!--							</div>-->
			<!--							<div class="media-body">-->
			<!--								<h5 class="mb-1">Dr sultads Send you Photo</h5>-->
			<!--							</div>-->
			<!--							<small class="d-block">29 July 2020 - 02:26 PM</small>-->
			<!--						</div>-->
			<!--					</li>-->
			<!--					<li>-->
			<!--						<div class="timeline-panel">-->
			<!--							<div class="media me-2 media-info">-->
			<!--								KG-->
			<!--							</div>-->
			<!--							<div class="media-body">-->
			<!--								<h5 class="mb-1">Resport created successfully</h5>-->
			<!--							</div>-->
			<!--							<small class="d-block">29 July 2020 - 02:26 PM</small>-->
			<!--						</div>-->
			<!--					</li>-->
			<!--					<li>-->
			<!--						<div class="timeline-panel">-->
			<!--							<div class="media me-2">-->
			<!--								<img alt="image" width="50" src="{{asset('images/avatar/1.jpg')}}">-->
			<!--							</div>-->
			<!--							<div class="media-body">-->
			<!--								<h5 class="mb-1">Dr sultads Send you Photo</h5>-->
			<!--							</div>-->
			<!--							<small class="d-block">29 July 2020 - 02:26 PM</small>-->
			<!--						</div>-->
			<!--					</li>-->
			<!--					<li>-->
			<!--						<div class="timeline-panel">-->
			<!--							<div class="media me-2 media-info">-->
			<!--								KG-->
			<!--							</div>-->
			<!--							<div class="media-body">-->
			<!--								<h5 class="mb-1">Resport created successfully</h5>-->
			<!--							</div>-->
			<!--							<small class="d-block">29 July 2020 - 02:26 PM</small>-->
			<!--						</div>-->
			<!--					</li>-->
			<!--				</ul>-->
			<!--			</div>-->
			<!--		</div>-->
			<!--	</div>-->
			<!--</div>-->
	
			<!--<div class="col-xl-6  col-lg-6">-->
			<!--	<div class="card">-->
			<!--		<div class="card-header border-0 pb-0">-->
			<!--			<h4 class="card-title">Project Activity Timeline</h4>-->
			<!--		</div>-->
			<!--		<div class="card-body p-0">-->
			<!--			<div id="DZ_W_TimeLine" class="widget-timeline dz-scroll height600 my-4 px-4">-->
			<!--				<ul class="timeline">-->
			<!--					<li>-->
			<!--						<div class="timeline-badge primary"></div>-->
			<!--						<a class="timeline-panel " href="#">-->
			<!--							<span>10 minutes ago</span>-->
			<!--							<h6 class="mb-0">Youtube, a video-sharing website, goes live <strong-->
			<!--									class="text-primary">$500</strong>.</h6>-->
			<!--						</a>-->
			<!--					</li>-->
			<!--					<li>-->
			<!--						<div class="timeline-badge info">-->
			<!--						</div>-->
			<!--						<a class="timeline-panel " href="#">-->
			<!--							<span>20 minutes ago</span>-->
			<!--							<h6 class="mb-0">New order placed <strong class="text-info">#XF-2356.</strong></h6>-->
			<!--							<p class="mb-0">Quisque a consequat ante Sit amet magna at volutapt...</p>-->
			<!--						</a>-->
			<!--					</li>-->
			<!--					<li>-->
			<!--						<div class="timeline-badge danger">-->
			<!--						</div>-->
			<!--						<a class="timeline-panel " href="#">-->
			<!--							<span>30 minutes ago</span>-->
			<!--							<h6 class="mb-0">john just buy your product <strong class="text-warning">Sell-->
			<!--									$250</strong></h6>-->
			<!--						</a>-->
			<!--					</li>-->
			<!--					<li>-->
			<!--						<div class="timeline-badge success">-->
			<!--						</div>-->
			<!--						<a class="timeline-panel" href="#">-->
			<!--							<span>15 minutes ago</span>-->
			<!--							<h6 class="mb-0">StumbleUpon is acquired by eBay. </h6>-->
			<!--						</a>-->
			<!--					</li>-->
			<!--					<li>-->
			<!--						<div class="timeline-badge primary"></div>-->
			<!--						<a class="timeline-panel " href="#">-->
			<!--							<span>10 minutes ago</span>-->
			<!--							<h6 class="mb-0">Youtube, a video-sharing website, goes live <strong-->
			<!--									class="text-primary">$500</strong>.</h6>-->
			<!--						</a>-->
			<!--					</li>-->
			<!--					<li>-->
			<!--						<div class="timeline-badge info">-->
			<!--						</div>-->
			<!--						<a class="timeline-panel " href="#">-->
			<!--							<span>20 minutes ago</span>-->
			<!--							<h6 class="mb-0">New order placed <strong class="text-info">#XF-2356.</strong></h6>-->
			<!--							<p class="mb-0">Quisque a consequat ante Sit amet magna at volutapt...</p>-->
			<!--						</a>-->
			<!--					</li>-->
			<!--					<li>-->
			<!--						<div class="timeline-badge warning">-->
			<!--						</div>-->
			<!--						<a class="timeline-panel" href="#">-->
			<!--							<span>20 minutes ago</span>-->
			<!--							<h6 class="mb-0">Mashable, a news website and blog, goes live.</h6>-->
			<!--						</a>-->
			<!--					</li>-->
			<!--					<li>-->
			<!--						<div class="timeline-badge dark">-->
			<!--						</div>-->
			<!--						<a class="timeline-panel" href="#">-->
			<!--							<span>20 minutes ago</span>-->
			<!--							<h6 class="mb-0">Mashable, a news website and blog, goes live.</h6>-->
			<!--						</a>-->
			<!--					</li>-->
			<!--					<li>-->
			<!--						<div class="timeline-badge primary"></div>-->
			<!--						<a class="timeline-panel " href="#">-->
			<!--							<span>10 minutes ago</span>-->
			<!--							<h6 class="mb-0">Youtube, a video-sharing website, goes live <strong-->
			<!--									class="text-primary">$500</strong>.</h6>-->
			<!--						</a>-->
			<!--					</li>-->
			<!--					<li>-->
			<!--						<div class="timeline-badge info">-->
			<!--						</div>-->
			<!--						<a class="timeline-panel " href="#">-->
			<!--							<span>20 minutes ago</span>-->
			<!--							<h6 class="mb-0">New order placed <strong class="text-info">#XF-2356.</strong></h6>-->
			<!--							<p class="mb-0">Quisque a consequat ante Sit amet magna at volutapt...</p>-->
			<!--						</a>-->
			<!--					</li>-->
			<!--				</ul>-->
			<!--			</div>-->
			<!--		</div>-->
			<!--	</div>-->
			<!--</div>-->
	
			<!--<div class="col-xl-6 col-lg-6">-->
			<!--	<div class="card">-->
			<!--		<div class="card-header border-0 pb-0">-->
			<!--			<h4 class="card-title">User Activity Timeline</h4>-->
			<!--		</div>-->
			<!--		<div class="card-body p-0">-->
			<!--			<div id="DZ_W_TimeLine11" class="widget-timeline dz-scroll style-1 height600 my-4 px-4">-->
			<!--				<ul class="timeline">-->
			<!--					<li>-->
			<!--						<div class="timeline-badge primary"></div>-->
			<!--						<a class="timeline-panel" href="#">-->
			<!--							<span>10 minutes ago</span>-->
			<!--							<h6 class="mb-0">Youtube, a video-sharing website, goes live <strong-->
			<!--									class="text-primary">$500</strong>.</h6>-->
			<!--						</a>-->
			<!--					</li>-->
			<!--					<li>-->
			<!--						<div class="timeline-badge info">-->
			<!--						</div>-->
			<!--						<a class="timeline-panel" href="#">-->
			<!--							<span>20 minutes ago</span>-->
			<!--							<h6 class="mb-0">New order placed <strong class="text-info">#XF-2356.</strong></h6>-->
			<!--							<p class="mb-0">Quisque a consequat ante Sit amet magna at volutapt...</p>-->
			<!--						</a>-->
			<!--					</li>-->
			<!--					<li>-->
			<!--						<div class="timeline-badge danger">-->
			<!--						</div>-->
			<!--						<a class="timeline-panel" href="#">-->
			<!--							<span>30 minutes ago</span>-->
			<!--							<h6 class="mb-0">john just buy your product <strong class="text-warning">Sell-->
			<!--									$250</strong></h6>-->
			<!--						</a>-->
			<!--					</li>-->
			<!--					<li>-->
			<!--						<div class="timeline-badge success">-->
			<!--						</div>-->
			<!--						<a class="timeline-panel " href="#">-->
			<!--							<span>15 minutes ago</span>-->
			<!--							<h6 class="mb-0">StumbleUpon is acquired by eBay. </h6>-->
			<!--						</a>-->
			<!--					</li>-->
			<!--					<li>-->
			<!--						<div class="timeline-badge info">-->
			<!--						</div>-->
			<!--						<a class="timeline-panel" href="#">-->
			<!--							<span>20 minutes ago</span>-->
			<!--							<h6 class="mb-0">New order placed <strong class="text-info">#XF-2356.</strong></h6>-->
			<!--							<p class="mb-0">Quisque a consequat ante Sit amet magna at volutapt...</p>-->
			<!--						</a>-->
			<!--					</li>-->
			<!--					<li>-->
			<!--						<div class="timeline-badge danger">-->
			<!--						</div>-->
			<!--						<a class="timeline-panel" href="#">-->
			<!--							<span>30 minutes ago</span>-->
			<!--							<h6 class="mb-0">john just buy your product <strong class="text-warning">Sell-->
			<!--									$250</strong></h6>-->
			<!--						</a>-->
			<!--					</li>-->
			<!--					<li>-->
			<!--						<div class="timeline-badge warning">-->
			<!--						</div>-->
			<!--						<a class="timeline-panel " href="#">-->
			<!--							<span>20 minutes ago</span>-->
			<!--							<h6 class="mb-0">Mashable, a news website and blog, goes live.</h6>-->
			<!--						</a>-->
			<!--					</li>-->
			<!--					<li>-->
			<!--						<div class="timeline-badge dark">-->
			<!--						</div>-->
			<!--						<a class="timeline-panel " href="#">-->
			<!--							<span>20 minutes ago</span>-->
			<!--							<h6 class="mb-0">Mashable, a news website and blog, goes live.</h6>-->
			<!--						</a>-->
			<!--					</li>-->
			<!--					<li>-->
			<!--						<div class="timeline-badge info">-->
			<!--						</div>-->
			<!--						<a class="timeline-panel" href="#">-->
			<!--							<span>20 minutes ago</span>-->
			<!--							<h6 class="mb-0">New order placed <strong class="text-info">#XF-2356.</strong></h6>-->
			<!--							<p class="mb-0">Quisque a consequat ante Sit amet magna at volutapt...</p>-->
			<!--						</a>-->
			<!--					</li>-->
			<!--					<li>-->
			<!--						<div class="timeline-badge danger">-->
			<!--						</div>-->
			<!--						<a class="timeline-panel" href="#">-->
			<!--							<span>30 minutes ago</span>-->
			<!--							<h6 class="mb-0">john just buy your product <strong class="text-warning">Sell-->
			<!--									$250</strong></h6>-->
			<!--						</a>-->
			<!--					</li>-->
			<!--				</ul>-->
			<!--			</div>-->
			<!--		</div>-->
			<!--	</div>-->
			<!--</div>-->
		</div>

	</div>
 @endsection

@push('scripts')
<script>
    jQuery(document).ready(function(){
        setTimeout(function(){
            dzSettingsOptions.version = 'light';
            new dzSettings(dzSettingsOptions);
        },1500)
    });
</script>
<script>
    $(document).on('click', '.closeJobBtn', function () {

        var button = $(this);
        var jobId = button.data('id');
    
        Swal.fire({
            title: 'Close this Job?',
            text: "This will change the Job Status to Close.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, Close it',
            cancelButtonText: 'Cancel'
        }).then((result) => {
    
            if (result.isConfirmed) {
    
                $.ajax({
    
                    url: '/dashboard/close-job/' + jobId,
    
                    type: 'POST',
    
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
    
                    success: function (response) {
    
                        if (response.success) {
    
                            Swal.fire(
                                'Closed!',
                                response.message,
                                'success'
                            );
    
                            // Remove row
                            button.closest('tr').fadeOut(300, function () {
                                $(this).remove();
                            });
    
                            // Update card count
                            var count = parseInt($('.needToCloseCount').text());
                            $('.needToCloseCount').text(count - 1);
                        }
                    }
    
                });
    
            }
    
        });
    
    });
</script>
  
<script>
    // pending jobs
    $(document).ready(function(){
        $('#pendingJobsModal').on('show.bs.modal', function () {
            $('#pendingJobsContent').html('<p class="text-center">Loading...</p>');
            
            $.ajax({
                url: "{{ route('dashboard.pendingJobs') }}",
                type: 'GET',
                success: function(data) {
                    // Inject the partial HTML into modal body
                    $('#pendingJobsContent').html(data);
                },
                error: function(xhr, status, error) {
                    $('#pendingJobsContent').html('<p class="text-danger text-center">Failed to load data!</p>');
                    console.error(error);
                }
            });
        });
    });
    
    // close jobs
    $(document).ready(function(){
        $('#closeJobsModal').on('show.bs.modal', function () {
            $('#closeJobsContent').html('<p class="text-center">Loading...</p>');
            
            $.ajax({
                url: "{{ route('dashboard.closeJobs') }}",
                type: 'GET',
                success: function(data) {
                    // Inject the partial HTML into modal body
                    $('#closeJobsContent').html(data);
                },
                error: function(xhr, status, error) {
                    $('#closeJobsContent').html('<p class="text-danger text-center">Failed to load data!</p>');
                    console.error(error);
                }
            });
        });
    });
    
    // leo date model
    $(document).ready(function(){
        $('#leoDateModal').on('show.bs.modal', function(){
            $('#leoDateContent').html('<p class="text-center">Loading...</p>');
    
            $.ajax({
                url: "{{ route('dashboard.leoPending') }}",
                type: "GET",
                success: function(data){
                    $('#leoDateContent').html(data);
                },
                error: function(){
                    $('#leoDateContent').html('<p class="text-danger text-center">Failed to load data!</p>');
                }
            }); 
        });
        
        $('#ComplateOperationModal').on('show.bs.modal', function(){
            $('#ComplateOperationContent').html('<p class="text-center">Loading...</p>');
    
            $.ajax({
                url: "{{ route('dashboard.complateOperation') }}",
                type: "GET",
                success: function(data){
                    $('#ComplateOperationContent').html(data);
                },
                error: function(){
                    $('#ComplateOperationContent').html('<p class="text-danger text-center">Failed to load data!</p>');
                }
            });
        });
    });
</script>
@endpush
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

