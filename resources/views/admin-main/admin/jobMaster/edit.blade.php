@extends('admin-main.layouts.default')
@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Edit Job Master</a></li>
        </ol>
        <a class="text-primary fs-13" href="{{ url('admin/job-masters') }}">+ Back Job Master</a>
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
        <!-- row -->
        <div class="row">
            <div class="col-xl-12 col-xxl-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('job-masters.update', $jobMaster->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div id="smartwizard" class="form-wizard order-create">
                                
                                <div class="row form-material">
                                    <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                        <label class="col-sm-3 col-form-label">BL Issued By:</label>
                                        <div class="col-sm-9">
                                            <div class="d-flex gap-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="Nominated"
                                                        id="lcl" name="bl_issue" {{$jobMaster->issued_by == 'Nominated'? 'checked' : ''}}>
                                                    <label class="form-check-label" for="lcl">
                                                        Nominated
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="Enquiry"
                                                        id="fcl20" name="bl_issue" {{$jobMaster->issued_by == 'Enquiry'? 'checked' : ''}}>
                                                    <label class="form-check-label" for="fcl20">
                                                        Enquiry
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                        <label class="col-sm-3 col-form-label">Job No:</label>
                                        <div class="col-sm-9">
                                            <input type="text"  disabled style="cursor: not-allowed;" value="{{$jobMaster->job_no}}" class="form-control" name="job_no">
                                        </div>
                                    </div>
                                    <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                        <label class="col-sm-3 col-form-label">Job Date:<span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control" name="job_date" value="{{$jobMaster->job_date}}">
                                        </div>
                                    </div>
                                    <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                        <label class="col-sm-3 col-form-label">Job Activity:<span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select class="default-select form-control wide" name="job_activity">
                                                <option value="">Select</option>
                                                <option value="SEAIMP.FWD" @if($jobMaster->job_activity == 'SEAIMP.FWD') selected @endif>SEAIMP.FWD</option>

                                                <option value="SEAEXP.FWD" @if($jobMaster->job_activity == 'SEAEXP.FWD') selected @endif>SEAEXP.FWD</option>

                                                <option value="AIRIMP.FWD" @if($jobMaster->job_activity == 'AIRIMP.FWD') selected @endif>AIRIMP.FWD</option>

                                                <option value="AIREXP.FWD" @if($jobMaster->job_activity == 'AIREXP.FWD') selected @endif>AIREXP.FWD</option>

                                                <option value="SEAIMP.NVOCC" @if($jobMaster->job_activity == 'SEAIMP.NVOCC') selected @endif>SEAIMP.NVOCC</option>

                                                <option value="SEAEXP.NVOCC" @if($jobMaster->job_activity == 'SEAEXP.NVOCC') selected @endif>SEAEXP.NVOCC</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Job Party:<span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <select class="default-select form-control wide me-2" name="job_party_id">
                                                @foreach ($parties as $partie)
                                                    <option value="{{$partie->id}}" {{$partie->id == $jobMaster->job_party_id ? 'selected' : ''}}>{{$partie->party_name }}</option>
                                                @endforeach
                                            </select>

                                            <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                                data-bs-target="#partyDetailsModal">
                                                <i class="bi bi-plus-lg">+</i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Job Remarks:</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control h-100" name="job_remarks" id="validationCustom04" rows="2">{{$jobMaster->job_remarks}}</textarea>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                        <label class="col-sm-3 col-form-label">Term:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="term" value="{{$jobMaster->term}}">
                                        </div>
                                    </div>
                                    <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                        <label class="col-sm-3 col-form-label">Enquiry Reference No:</label>
                                        <div class="col-sm-9">
                                            <select class="default-select  form-control wide" name="enquiry_reference_no" placeholder="Select"></select>
                                        </div>
                                    </div>

                                    <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                        <label class="col-sm-3 col-form-label">Job Activity:</label>
                                        <div class="col-sm-9">
                                            <div class="d-flex gap-3">

                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="job_activity_type" value="1"
                                                        id="lcl" {{$jobMaster->job_activity_type == 1? 'checked' : ''}}>
                                                    <label class="form-check-label" for="lcl">
                                                        Single Hbl
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="job_activity_type" value="2"
                                                        id="fcl20" {{$jobMaster->job_activity_type == 2 ? 'checked' : ''}}>
                                                    <label class="form-check-label" for="fcl20">
                                                        Multi Hbl
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                        <label class="col-sm-3 col-form-label">Shipment Type:</label>
                                        <div class="col-sm-9">
                                            <div class="d-flex gap-3">

                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="shipment_type" value="FCL"
                                                        id="lcl" {{$jobMaster->shipment_type == 'FCL'? 'checked' : ''}}>
                                                    <label class="form-check-label" for="lcl">
                                                        FCL
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="shipment_type" value="LCL"
                                                        id="fcl20" {{$jobMaster->shipment_type == 'LCL'? 'checked' : ''}}>
                                                    <label class="form-check-label" for="fcl20">
                                                        LCL
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="shipment_type" value="AIR"
                                                        id="fcl20" {{$jobMaster->shipment_type == 'AIR'? 'checked' : ''}}>
                                                    <label class="form-check-label" for="fcl20">
                                                        AIR
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                        <label class="col-sm-3 col-form-label">Job Status:</label>
                                        <div class="col-sm-9">
                                            <div class="d-flex gap-3">

                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="job_status" value="O"
                                                        id="lcl" {{$jobMaster->job_status == 'O'? 'checked' : ''}}>
                                                    <label class="form-check-label" for="lcl">
                                                        OPEN
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="job_status" value="C"
                                                        id="fcl20" {{$jobMaster->job_status == 'C'? 'checked' : ''}}>
                                                    <label class="form-check-label" for="fcl20">
                                                        CLOSED
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                        <label class="col-sm-3 col-form-label">Insurance:</label>
                                        <div class="col-sm-9">
                                            <div class="d-flex gap-3">

                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="insurance" value="Y"
                                                        id="lcl" {{$jobMaster->insurance == 'Y'? 'checked' : ''}}>
                                                    <label class="form-check-label" for="lcl">
                                                        Yes
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="insurance" value="N"
                                                        id="fcl20" {{$jobMaster->insurance == 'N'? 'checked' : ''}}>
                                                    <label class="form-check-label" for="fcl20">
                                                        No
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                        <label class="col-sm-3 col-form-label">Clearance:</label>
                                        <div class="col-sm-9">
                                            <div class="d-flex gap-3">

                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="clearance" value="Y" 
                                                        id="lcl" {{$jobMaster->clearance == 'Y'? 'checked' : ''}}>
                                                    <label class="form-check-label" for="lcl">
                                                        Yes
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="clearance" value="N"
                                                        id="fcl20" {{$jobMaster->clearance == 'N'? 'checked' : ''}}>
                                                    <label class="form-check-label" for="fcl20">
                                                        No
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                        <label class="col-sm-3 col-form-label">Transportation:</label>
                                        <div class="col-sm-9">
                                            <div class="d-flex gap-3">

                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="transportation" value="Y"
                                                        id="lcl" {{$jobMaster->transportation == 'Y'? 'checked' : ''}}>
                                                    <label class="form-check-label" for="lcl">
                                                        Yes
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="transportation" value="N"
                                                        id="fcl20" {{$jobMaster->transportation == 'N'? 'checked' : ''}}>
                                                    <label class="form-check-label" for="fcl20">
                                                        No
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>
                                    <h3>Pre-Shipment Details</h3>
                                    <div class="row">
                                        <div class="col-xl-6 col-xxl-12">
                                            <div class="mb-3 row">
                                                <label class="col-sm-3 col-form-label">Booking Date:</label>
                                                <div class="col-sm-9">
                                                    <input type="date" class="form-control" name="booking_date" value="{{$jobMaster->booking_date}}">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-sm-3 col-form-label">Cargo Ready Date:</label>
                                                <div class="col-sm-9">
                                                    <input type="date" class="form-control" name="cargo_ready_date" value="{{$jobMaster->cargo_ready_date}}">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-sm-3 col-form-label">Pickup Date:</label>
                                                <div class="col-sm-9">
                                                    <input type="date" class="form-control" name="pickup_date" value="{{$jobMaster->pickup_date}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <a href="{{route('job-masters.index')}}" type="button" class="btn btn-warning btn-sm">Cancle</a>
                                    <button type="submit" class="btn btn-primary btn-sm">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Party Details -->
    <div class="modal fade" id="partyDetailsModal" tabindex="-1" aria-labelledby="oceanVslModalLabel"
        aria-hidden="true">
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
                            <button class="btn btn-outline-primary" type="button">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#smartwizard').smartWizard();
        });
    </script>
@endpush
