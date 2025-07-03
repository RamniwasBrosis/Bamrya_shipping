@extends('admin-main.layouts.default')
@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="#">Transport</a></li>
        </ol>
        <a href="{{url('admin/transports')}}" class="text-primary"><- Go Back</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success px-3">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger px-3">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container-fluid p-2">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add New Transport</h4>
                    </div>
                    <div class="card-body">
                        <h4>General Details</h4>
                        <hr>
                        <div class="form-validation">
                            <form class="needs-validation" method="POST" action="{{ route('transports.store') }}" novalidate>
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="general_detail" value="1">
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Job No:<span
                                            class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" name="job_no" class="form-control" value="{{old('job_no')}}" style="cursor: not-allowed; background: #eee;">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">From Party:<span
                                            class="text-danger">*</span></label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select name="from_party_id" class="default-select form-control wide me-2" value="{{old('from_party_id')}}">
                                                    <option value="">select</option>
                                                    @foreach ($parties as $partie)
                                                        <option value="{{$partie->id}}">{{$partie->party_name}}</option>
                                                    @endforeach
                                                </select>
                                                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#partyDetailsModal">
                                                    <i class="bi bi-plus-lg">+</i>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">From:<span
                                            class="text-danger">*</span></label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select name="from_place_id" class="default-select form-control wide me-2">
                                                    <option value="">select</option>
                                                    @foreach ($ports as $port)
                                                        <option value="{{$port->id}}">{{$port->port_name}}</option>
                                                    @endforeach
                                                </select>
                                                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#partyDetailsModal">
                                                    <i class="bi bi-plus-lg">+</i>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Booking No:<span
                                            class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" name="booking_no" class="form-control" value="{{old('booking_no')}}">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Booking Date:<span
                                            class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="date" name="booking_date" class="form-control" value="{{old('booking_date')}}">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">PICK UP DT:</label>
                                            <div class="col-sm-9">
                                                <input type="date" name="pickup_date" class="form-control" value="{{old('pickup_dt')}}">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Gate IN DT:</label>
                                            <div class="col-sm-9">
                                                <input type="date" name="gate_in_date" class="form-control" value="{{old('gatein_dt')}}">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Sales Person:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select name="sales_person_id" class="default-select form-control wide me-2">
                                                    <option value="">select</option>
                                                    @foreach ($parties as $partie)
                                                        <option value="{{$partie->id}}">{{$partie->party_name}}</option>
                                                    @endforeach
                                                </select>
                                                <button type="button" class="btn btn-sm btn-outline-primary"
                                                 data-bs-toggle="modal" data-bs-target="#salespersonModal">
                                                    <i class="bi bi-plus-lg">+</i>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Shipping Bill No:<span
                                            class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" name="shipping_bill_no" class="form-control" value="{{old('shipping_bill_no')}}">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Quantity:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="quantity" class="form-control" value="{{old('quantity')}}">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Gross Wt:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="gross_weight" class="form-control" value="{{old('gross_weight')}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">FullJobNo:<span
                                            class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" name="full_job_no" class="form-control" value="{{old('full_job_no')}}" style="cursor: not-allowed; background: #eee;">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">CHA / Trans:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select name="cha_trans_id" class="default-select form-control wide me-2">
                                                    <option value="">select</option>
                                                    @foreach ($parties as $partie)
                                                        <option value="{{$partie->id}}">{{$partie->party_name}}</option>
                                                    @endforeach
                                                </select>
                                                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#partyDetailsModal">
                                                    <i class="bi bi-plus-lg">+</i>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">To:<span
                                            class="text-danger">*</span></label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select name="to_place_id" class="default-select form-control wide me-2">
                                                    <option value="">select</option>
                                                    @foreach ($ports as $port)
                                                        <option value="{{$port->id}}">{{$port->port_name}}</option>
                                                    @endforeach
                                                </select>
                                                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#partyDetailsModal">
                                                    <i class="bi bi-plus-lg">+</i>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Customer Inv No:<span
                                            class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" name="customer_inv_no" class="form-control" value="{{old('customer_inv_no')}}">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Custom Clearance/Movement Date:</label>
                                            <div class="col-sm-9">
                                                <input type="date" name="ccm_date" class="form-control" value="{{old('movement_date')}}">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">STUFFING DT:</label>
                                            <div class="col-sm-9">
                                                <input type="date" name="stuffing_date" class="form-control" value="{{old('stuffing_date')}}">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Port IN Date:</label>
                                            <div class="col-sm-9">
                                                <input type="date" name="port_in_date" class="form-control" value="{{old('port_in_date')}}">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Transporter:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select name="transporter_id" class="default-select form-control wide me-2">
                                                    <option value="">select</option>
                                                    @foreach ($parties as $partie)
                                                        <option value="{{$partie->id}}">{{$partie->party_name}}</option>
                                                    @endforeach
                                                </select>
                                                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#partyDetailsModal">
                                                    <i class="bi bi-plus-lg">+</i>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Description:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="description" class="form-control" value="{{old('description')}}">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Package:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select name="package_id" class="form-control wide me-2">
                                                    <option value="">select</option>
                                                    @foreach ($packages as $packages)
                                                        <option value="{{$packages->id}}">{{$packages->package_code}}</option>
                                                    @endforeach
                                                </select>
                                                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#partyDetailsModal">
                                                    <i class="bi bi-plus-lg">+</i>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Remarks:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="remarks" class="form-control" value="{{old('remarks')}}">
                                            </div>
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <button class="btn btn-primary me-md-2" type="button">Booking Print</button>
                                        <button class="btn btn-warning" type="reset">Cancel</button>
                                        <button class="btn btn-primary" type="submit">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <hr>
                        <div class="form-validation">
                            <form class="needs-validation" method="POST" action="{{ route('transports.addContainer') }}" >
                                @csrf
                                <div class="row">                               
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Transport ID: <span
                                            class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <select name="transport_id" class="default-select form-control wide me-2" placeholder="Select">
                                                    <option value="">select</option>
                                                    @foreach ($transports as $transport)
                                                        <option value="{{$transport->id}}">{{$transport->id}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>  

                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Cont_No:<span
                                            class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" name="container_no" class="form-control">
                                            </div>
                                        </div>                                        
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Vehicle No:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="vehicle_no" class="form-control">
                                            </div>
                                        </div>                                        
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">LR NO.:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="lr_no" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">CVC Plate Details:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="cvc_plate" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Customer Seal No.:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="customer_seal_no" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Net Wt:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="net_weight" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Transporter:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select name="cont_transporter_id" class="default-select form-control wide me-2" placeholder="Select">
                                                    <option value="">select</option>
                                                    @foreach ($parties as $partie)
                                                        <option value="{{$partie->id}}">{{$partie->party_name}}</option>
                                                    @endforeach
                                                </select>
                                                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#partyDetailsModal">
                                                    <i class="bi bi-plus-lg">+</i>
                                                </button>
                                            </div>
                                        </div>                                                                                         
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Size:<span
                                            class="text-danger">*</span></label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select name="size" class="form-control default-select wide me-2">
                                                    <option value="">Select</option>
                                                    <option value="1">0</option>
                                                    <option value="20 GP">20 GP</option>
                                                    <option value="40 GP">40 GP</option>
                                                    <option value="40 HQ">40 HQ</option>
                                                    <option value="20 OT">20 OT</option>
                                                    <option value="40 OT">40 OT</option>
                                                    <option value="20 FR">20 FR</option>
                                                    <option value="40 FR">40 FR</option>
                                                    <option value="20 TK">20 TK</option>
                                                    <option value="40 TK">40 TK</option>
                                                    <option value="20 RF">20 RF</option>
                                                    <option value="40 RF">40 RF</option>
                                                    <option value="20 ODO">20 ODO</option>
                                                    <option value="40 ODO">40 ODO</option>
                                                    <option value="40">40</option>
                                                    <option value="45">45</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Gross Weight:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="cont_gross_weight" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Tare Wt:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="tare_weight" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Stuffing Point:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="stuffing_point" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Agent Seal No:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="agent_seal_no" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Cargo:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="cargo" class="form-control">
                                            </div>
                                        </div>                                   
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Cont_Job No:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="container_job_no" class="form-control">
                                            </div>
                                        </div>
                                        
                                    </div>

                                    <hr>
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <button class="btn btn-primary me-md-2" type="button">Booking Print</button>
                                        <button class="btn btn-warning" type="reset">Cancel</button>
                                        <button class="btn btn-primary" type="submit">Save</button>
                                    </div>

                                </div>
                            </form>
                        </div>

                        <h4>File Upload</h4>
                        <hr>
                        <div class="form-validation">
                            <form class="needs-validation" action="{{route('multi-file-upload.updateFileUpload')}}" method="post" enctype="multipart/form-data">
                                @csrf 
                                <input type="hidden" name="file_related" value="transport">
                                <div class="row">
                                    <div class="col-xl-9">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Choose File:</label>
                                            <div class="col-sm-9">
                                                <div class="d-flex">
                                                    <input type="file" class="form-control me-2" name="file[]" multiple />
                                                    <button type="submit" class="btn btn-warning" style="width:180px;">UploadFile</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                    
                                </div>
                            </form>
                            <form id="TransportsFileForm" method="post"> 
                                @csrf
                                <div class="col-xl-9">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Find PDF File:</label>
                                        <div class="col-sm-9">
                                            <div class="d-flex">
                                                <select class="default-select form-control wide me-2"
                                                    placeholder="Select" name="search_query">
                                                        <option value="">select</option>
                                                        @foreach ($files as $file)
                                                            <option value="{{$file->id}}">{{$file->file_name}}</option>
                                                        @endforeach
                                                </select>
                                                <button type="submit" class="btn btn-primary btn-sm" style="width:180px;">Search</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div id="searchFile"></div>
                </div>
            </div>
        </div>
    </div>
    
    @include('admin-main.admin.addSalesPerson.salesperson_modal')


    <!-- Modal Ocean Vsl -->
    <div class="modal fade" id="oceanVslModal" tabindex="-1" aria-labelledby="oceanVslModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="oceanVslModalLabel">Add New Vessel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="oceanVslForm">
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Vessel Name:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Vessel Call Sign:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">IMO Code:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Status:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <select class="default-select  form-control wide" placeholder="Select"></select>
                            </div>
                        </div>
                        <div class="d-grid d-md-flex justify-content-md-end">
                            <button class="btn btn-outline-primary" type="button">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Party Details -->
    <div class="modal fade" id="partyDetailsModal" tabindex="-1" aria-labelledby="oceanVslModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="oceanVslModalLabel">Party</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="oceanVslForm">
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Party Code:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Party Name:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Address Line 1:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Address Line 2:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Address Line 3:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Address Line 4:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">City:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Pincode:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Party Type:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <select class="default-select  form-control wide" placeholder="Select"></select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Contact Person:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Tel / Contact No:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Email:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">GSTIN NO:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">PAN No:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">CIN No:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Credit Days:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">TDS %:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Status:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <select class="default-select  form-control wide" placeholder="Active"></select>
                            </div>
                        </div>
                        <div class="d-grid d-md-flex justify-content-md-end">
                            <button class="btn btn-outline-primary" type="button">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Port Details -->
    <div class="modal fade" id="portDetailsModal" tabindex="-1" aria-labelledby="oceanVslModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="oceanVslModalLabel">Add New PORT</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="oceanVslForm">
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Port Code:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Port Name:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Address Line 1:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">EDI Code:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">JNPT Code:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">NSICT Code:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">NSICT GROUP Code:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">GTI Code:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">GTI GROUP Code:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">NSI GT Code:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Status:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <select class="default-select  form-control wide" placeholder="Active"></select>
                            </div>
                        </div>
                        <div class="d-grid d-md-flex justify-content-md-end">
                            <button class="btn btn-outline-primary" type="button">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        (function () {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>

    <script>
        document.getElementById('TransportsFileForm').addEventListener('submit', function(e) {
            e.preventDefault();
          
            const formData = new FormData(this);

            fetch("{{ route('multi-file-upload.searchFile') }}", {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
                },
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                console.log(data);
                
                document.getElementById('searchFile').innerHTML = data;
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });

        function clearSearchFile() {
            document.getElementById("searchFile").innerHTML = "";
        }
        
        $('#salespersonForm').on('submit', function(e) {
            e.preventDefault();
        
            $.ajax({
                url: "{{ route('salesperson.store') }}", // route name
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    // Add the new option to select dropdowns
                    $('select[name="sales_person_id"]').each(function () {
                        $(this).append(`<option value="${response.id}" selected>${response.name}</option>`);
                    });
        
                    // Close modal and reset form
                    $('#salespersonForm')[0].reset();
                    $('#salespersonModal').modal('hide');
                },
                error: function(xhr) {
                    alert('Failed to add salesperson');
                
                    // Properly log the full error
                    console.error('Error:', xhr.responseText);
                
                    // Optional: Show the Laravel validation errors if exist
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        let messages = '';
                        Object.values(xhr.responseJSON.errors).forEach(function(errorArray) {
                            messages += errorArray.join("\n") + "\n";
                        });
                        alert(messages);
                    }
                }
            });
        });
    </script>
@endpush