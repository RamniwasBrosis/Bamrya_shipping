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
                    <h4 class="card-title">Edit Transport</h4>
                </div>
                <div class="card-body">
                    <h4>General Details</h4>
                    <hr>
                    <div class="form-validation">
                        <form class="needs-validation" novalidate method="post" action="{{route('transports.update', $trasportDetail->id)}}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Job No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="job_no" style="cursor: not-allowed; background: #eee;">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">From Party:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="select2 form-control wide me-2"
                                                placeholder="Select" name="from_party_id">
                                                <option value="">select</option>
                                                @foreach ($parties as $partie)
                                                <option value="{{$partie->id}}" {{$partie->id == $trasportDetail->from_party_id ? 'selected' : ''}}>{{$partie->party_name}}</option>
                                                @endforeach
                                            </select>
                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                data-bs-toggle="modal" data-bs-target="#partyDetailsModal">
                                                <i class="bi bi-plus-lg">+</i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">From:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="select2 form-control wide me-2"
                                                placeholder="Select" name="from_place_id">
                                                <option value="">select</option>
                                                @foreach ($ports as $port)
                                                <option value="{{$port->id}}" {{$port->id == $trasportDetail->from_place_id? 'selected' : ''}}>{{$port->port_name}}</option>
                                                @endforeach
                                            </select>
                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                data-bs-toggle="modal" data-bs-target="#addNewPortDetails">
                                                <i class="bi bi-plus-lg">+</i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Booking No:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="booking_no" value="{{$trasportDetail->booking_no}}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Booking Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control" name="booking_date" value="{{$trasportDetail->booking_date}}">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">PICK UP DT:</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control" name="pickup_date" value="{{$trasportDetail->pickup_date}}">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Gate IN DT:</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control" name="gate_in_date" value="{{$trasportDetail->gate_in_date}}">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Sales Person:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="select2 form-control wide me-2"
                                                placeholder="Select" name="sales_person_id">
                                                <option value="">select</option>
                                                @foreach ($salePersons as $salesPerson)
                                                <option value="{{$salesPerson->id}}" {{$salesPerson->id == $trasportDetail->sales_person_id ? 'selected' : ''}}>{{$salesPerson->name}}</option>
                                                @endforeach
                                            </select>
                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                data-bs-toggle="modal" data-bs-target="#salespersonModal">
                                                <i class="bi bi-plus-lg">+</i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Shipping Bill No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="shipping_bill_no" value="{{$trasportDetail->shipping_bill_no}}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Quantity:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="quantity" value="{{$trasportDetail->quantity}}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Gross Wt:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="gross_weight" value="{{$trasportDetail->gross_weight}}">
                                        </div>
                                    </div>
                                </div>


                                <div class="col-xl-6">

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">FullJobNo:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="full_job_no" style="cursor: not-allowed; background: #eee;">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">CHA / Trans:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="select2 form-control wide me-2"
                                                placeholder="Select" name="cha_trans_id">
                                                <option value="">select</option>
                                                @foreach ($parties as $partie)
                                                <option value="{{$partie->id}}" {{$partie->id == $trasportDetail->cha_trans_id ? 'selected' : ''}}>{{$partie->party_name}}</option>
                                                @endforeach

                                            </select>
                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                data-bs-toggle="modal" data-bs-target="#partyDetailsModal">
                                                <i class="bi bi-plus-lg">+</i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">To:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="select2 form-control wide me-2"
                                                placeholder="Select" name="to_place_id">
                                                <option value="">select</option>
                                                @foreach ($ports as $port)
                                                <option value="{{$port->id}}" {{$port->id == $trasportDetail->to_place_id ? 'selected' : ''}}>{{$port->port_name}}</option>
                                                @endforeach
                                            </select>
                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                data-bs-toggle="modal" data-bs-target="#addNewPortDetails">
                                                <i class="bi bi-plus-lg">+</i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Customer Inv No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="customer_inv_no" value="{{$trasportDetail->customer_inv_no}}">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Custom Clearance/Movement Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control" name="ccm_date" value="{{$trasportDetail->ccm_date}}">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">STUFFING DT:</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control" name="stuffing_date" value="{{$trasportDetail->stuffing_date}}">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Port IN Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control" name="port_in_date" value="{{$trasportDetail->port_in_date}}">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Transporter:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="select2 form-control wide me-2"
                                                placeholder="Select" name="transporter_id">
                                                <option value="">select</option>
                                                @foreach ($parties as $partie)
                                                <option value="{{$partie->id}}" {{$trasportDetail->transporter_id == $partie->id ? 'selected' : ''}}>{{$partie->party_name}}</option>
                                                @endforeach
                                            </select>
                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                data-bs-toggle="modal" data-bs-target="#partyDetailsModal">
                                                <i class="bi bi-plus-lg">+</i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Description:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="description" value="{{$trasportDetail->description}}">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Package:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select name="package_id" class="select2 form-control wide me-2">
                                                <option value="">select</option>
                                                @foreach ($packages as $package)
                                                <option value="{{$package->id}}" {{$trasportDetail->package_id == $package->id ? 'selected' : ''}}>{{$package->package_code}}</option>
                                                @endforeach
                                            </select>
                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                data-bs-toggle="modal" data-bs-target="#AddNewPackageModal">
                                                <i class="bi bi-plus-lg">+</i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Remarks:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="remarks" value="{{$trasportDetail->remarks}}">
                                        </div>
                                    </div>


                                </div>
                                <hr>
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <button class="btn btn-primary me-md-2" type="button">Booking Print</button>
                                    <button class="btn btn-warning" type="button">Cancle</button>
                                    <button class="btn btn-primary" type="submit">Save</button>
                                </div>

                            </div>
                        </form>
                    </div>

                    <hr>
                    <div class="form-validation">
                        <form id="containerForm" method="POST" action="{{ route('transports.saveContainer') }}">
                            @csrf
                            <input type="hidden" name="container_id" id="container_id">
                            <input type="hidden" name="transport_id" id="transport_id" value={{ $trasportDetail->id }}>

                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Cont_No:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="container_no" class="form-control" value="{{$trasportDetail->container_no}}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Vehicle No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="vehicle_no" class="form-control" value="{{$trasportDetail->vehicle_no}}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">LR NO.:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="lr_no" class="form-control" value="{{$trasportDetail->lr_no}}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">CVC Plate Details:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="cvc_plate" class="form-control" value="{{$trasportDetail->cvc_plate}}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Customer Seal No.:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="customer_seal_no" class="form-control" value="{{$trasportDetail->customer_seal_no}}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Net Wt:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="net_weight" class="form-control" value="{{$trasportDetail->net_weight}}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Transporter:</label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select name="transporter" class="select2 form-control wide me-2" placeholder="Select">
                                                <option value="">select</option>
                                                @foreach ($parties as $partie)
                                                <option value="{{$partie->id}}" {{$trasportDetail->transporter == $partie->id ? 'selected' : ''}}>{{$partie->party_name}}</option>
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
                                        <label class="col-sm-3 col-form-label">Size:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select name="size" class="form-control select2 wide me-2">
                                                <option value="">Select</option>
                                                <option value="1" {{$trasportDetail->size == '1' ? 'selected' : ''}}>0</option>
                                                <option value="20 GP" {{$trasportDetail->size == '20 GP' ? 'selected' : ''}}>20 GP</option>
                                                <option value="40 GP" {{$trasportDetail->size == '40 GP' ? 'selected' : ''}}>40 GP</option>
                                                <option value="40 HQ" {{$trasportDetail->size == '40 HQ' ? 'selected' : ''}}>40 HQ</option>
                                                <option value="20 OT" {{$trasportDetail->size == '20 OT' ? 'selected' : ''}}>20 OT</option>
                                                <option value="40 OT" {{$trasportDetail->size == '40 OT' ? 'selected' : ''}}>40 OT</option>
                                                <option value="20 FR" {{$trasportDetail->size == '20 FR' ? 'selected' : ''}}>20 FR</option>
                                                <option value="40 FR" {{$trasportDetail->size == '40 FR' ? 'selected' : ''}}>40 FR</option>
                                                <option value="20 TK" {{$trasportDetail->size == '20 TK' ? 'selected' : ''}}>20 TK</option>
                                                <option value="40 TK" {{$trasportDetail->size == '40 TK' ? 'selected' : ''}}>40 TK</option>
                                                <option value="20 RF" {{$trasportDetail->size == '20 RF' ? 'selected' : ''}}>20 RF</option>
                                                <option value="40 RF" {{$trasportDetail->size == '40 RF' ? 'selected' : ''}}>40 RF</option>
                                                <option value="20 ODO" {{$trasportDetail->size == '20 ODO' ? 'selected' : ''}}>20 ODO</option>
                                                <option value="40 ODO" {{$trasportDetail->size == '40 ODO' ? 'selected' : ''}}>40 ODO</option>
                                                <option value="40" {{$trasportDetail->size == '40' ? 'selected' : ''}}>40</option>
                                                <option value="45" {{$trasportDetail->size == '45' ? 'selected' : ''}}>45</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Gross Weight:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="cont_gross_weight" class="form-control" value="{{$trasportDetail->cont_gross_weight}}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Tare Wt:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="tare_weight" class="form-control" value="{{$trasportDetail->tare_weight}}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Stuffing Point:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="stuffing_point" class="form-control" value="{{$trasportDetail->stuffing_point}}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Agent Seal No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="agent_seal_no" class="form-control" value="{{$trasportDetail->agent_seal_no}}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Cargo:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="cargo" class="form-control" value="{{$trasportDetail->cargo}}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Cont_Job No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="container_job_no" class="form-control" value="{{$trasportDetail->container_job_no}}">
                                        </div>
                                    </div>

                                </div>

                                <hr>
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <button class="btn btn-primary me-md-2" type="button">Booking Print</button>
                                    <a href="{{route('transports.index')}}" class="btn btn-warning" type="reset">Cancel</a>
                                    <button class="btn btn-primary" type="submit">Add/Update</button>
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
                                            <select class="select2 form-control wide me-2"
                                                placeholder="Select" name="search_query">
                                                <option value="">select</option>
                                                @foreach ($files as $file)
                                                <option value="{{$file->id}}" {{ old('search_query') == $file->id ? 'selected' : '' }}>
                                                    {{$file->file_name}}
                                                </option>
                                                @endforeach
                                            </select>
                                            <button type="submit" class="btn btn-primary btn-sm" style="width:180px;">Search</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div id="searchFile"></div>

                    <div id="containerTableWrapper">
                        @include('admin-main.admin.transport.container_table')
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<!-- sales person model -->
@include('admin-main.admin.commonModelForms.salesperson_modal')

<!-- Modal Party Details -->
@include('admin-main.admin.commonModelForms.modelPartyDetails')

<!-- Modal Package Details -->
@include('admin-main.admin.commonModelForms.addNewPackageModel')

<!-- port model details  -->
@include('admin-main.admin.commonModelForms.addNewPort_modal')

@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        $('.select2').select2({
            // placeholder: 'Select a value',
            // allowClear: true,
            width: '100%'
        })
    })
</script>
<script>
    $(document).ready(function() {
        // ---------- EDIT CONTAINER ----------
        $(document).on('click', '.editContainerBtn', function () {
            let id = $(this).data('id');
        
            $.ajax({
                url: "{{ route('transports.getContainer', '') }}/" + id,
                method: "GET",
                success: function(res){
                    if(res.success){
                        let c = res.container;
        
                        $("#container_id").val(c.id);
                        $("[name=container_no]").val(c.container_no);
                        $("[name=size]").val(c.size).trigger("change");
                        $("[name=vehicle_no]").val(c.vehicle_no);
                        $("[name=lr_no]").val(c.lr_no);
                        $("[name=cvc_plate]").val(c.cvc_plate);
                        $("[name=customer_seal_no]").val(c.customer_seal_no);
                        $("[name=agent_seal_no]").val(c.agent_seal_no);
                        $("[name=stuffing_point]").val(c.stuffing_point);
                        $("[name=net_weight]").val(c.net_weight);
                        $("[name=cont_gross_weight]").val(c.cont_gross_weight);
                        $("[name=tare_weight]").val(c.tare_weight);
                        $("[name=cargo]").val(c.cargo);
                        $("[name=transporter]").val(c.transporter).trigger("change");
                    }
                }
            });
        });

        $(document).on('click', '.deleteContainerBtn', function () {

            if (!confirm("Are you sure you want to delete this container?")) {
                return;
            }
        
            let id = $(this).data('id');
        
            $.ajax({
                url: "{{ route('transports.deleteContainer', '') }}/" + id,
                method: "DELETE",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function (res) {
                    if (res.success) {
                        alert("Deleted successfully!");
                        window.location.reload();
                    }
                },
                error: function (xhr) {
                    alert("Failed to delete container.");
                    // console.log(xhr.responseText);
                }
            });
        
        });

        
        
        // ---------- SAVE OR UPDATE ----------
        $(document).on('submit', '#containerForm', function (e) {
            e.preventDefault();
        
            let formData = new FormData(this);
        
            $.ajax({
                url: "{{ route('transports.saveContainer') }}",
                method: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (res) {
                    if (res.success) {
        
                        // Update the table
                        $("#containerTableWrapper").html(res.html);
        
                        // Reset form
                        $("#container_id").val("");
                        $("#containerForm")[0].reset();
        
                        alert(res.message);
                    }
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                    alert("Error saving container");
                }
            });
        });


    })
</script>
<script>
    // file table
    document.getElementById('TransportsFileForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);
        const id = formData.get('search_query');

        fetch("{{ route('multi-file-upload.searchFile') }}", {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
                },
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                // const deleteUrl = `/multi-file-upload/${id}`;
                document.getElementById('searchFile').innerHTML = data;
                document.getElementById('delete_td').innerHTML = `
                    <button class="btn btn-sm btn-danger" onclick="clearSearchFile()">×</button> 
                    <button class="btn btn-sm btn-danger" onclick="deleteSearchFile(${id})">Delete</button>
                `;
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });

    function clearSearchFile() {
        document.getElementById("searchFile").innerHTML = "";
    }
</script>
// delete file
<script>
    function deleteSearchFile(id) {
        if (!confirm('Are you sure you want to delete this file?')) return;

        fetch(`/multi-file-upload/${id}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
                }
            })
            .then(response => {
                if (!response.ok) throw new Error('Failed to delete file.');
                return response.json();
            })
            .then(data => {
                alert(data.message);
                clearSearchFile();
                location.reload();
            })
            .catch(error => {
                console.error('Delete error:', error);
                alert('Error deleting file.');
            });
    }
</script>

<script>
    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()

    // party model details
    $('#modelPartyDetails').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: "{{ route('new-party.store') }}", // route name
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                // Add the new option to select dropdowns
                /* $('select[name="sales_person_id"]').each(function() {
                    $(this).append(`<option value="${response.id}" selected>${response.name}</option>`);
                }); */

                // Close modal and reset form
                $('#modelPartyDetails')[0].reset();
                $('#partyDetailsModal').modal('hide');
            },
            error: function(xhr) {
                alert('Failed to add party details');

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

    // sales person
    $('#salespersonForm').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: "{{ route('salesperson.store') }}", // route name
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                // Add the new option to select dropdowns
                $('select[name="sales_person_id"]').each(function() {
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

    // add new package
    $('#addNewPackageModel').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: "{{ route('new-package.store') }}", // route name
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                // Add the new option to select dropdowns
                /* $('select[name="sales_person_id"]').each(function() {
                    $(this).append(`<option value="${response.id}" selected>${response.name}</option>`);
                }); */

                // Close modal and reset form
                $('#addNewPackageModel')[0].reset();
                $('#AddNewPackageModal').modal('hide');
            },
            error: function(xhr) {
                alert('Failed to add package');

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

    // port model
    $('#portDetailsModel').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: "{{ route('new-port.store') }}", // route name
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                // Add the new option to select dropdowns
                /* $('select[name="sales_person_id"]').each(function() {
                    $(this).append(`<option value="${response.id}" selected>${response.name}</option>`);
                }); */

                // Close modal and reset form
                $('#portDetailsModel')[0].reset();
                $('#addNewPortDetails').modal('hide');
            },
            error: function(xhr) {
                alert('Failed to add port details');

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