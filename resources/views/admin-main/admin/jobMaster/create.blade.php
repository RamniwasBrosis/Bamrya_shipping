@extends('admin-main.layouts.default')
@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Add New Job Master</a></li>
        </ol>
        <a class="text-primary fs-13" href="{{ route('job-masters.index') }}">+ Back Job Master</a>
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
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>


    <div class="container-fluid p-2">
        <div class="row">
            <div class="col-xl-12 col-xxl-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('job-masters.store') }}" method="POST">
                            @csrf
                            <div class="row form-material">

                                <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                    <label class="col-sm-3 col-form-label">BL Issued By:</label>
                                    <div class="col-sm-9">
                                        <div class="d-flex gap-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" value="Nominated"
                                                    id="lcl" name="bl_issue">
                                                <label class="form-check-label" for="lcl">
                                                    Nominated
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" value="Enquiry"
                                                    id="fcl20" name="bl_issue" checked>
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
                                        <input type="text" disabled style="cursor: not-allowed;" name="job_no" class="form-control" value="0">
                                    </div>
                                </div>

                                <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                    <label class="col-sm-3 col-form-label">Job Date:<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="date" name="job_date" class="form-control" value={{old('job_date')}} required>
                                    </div>
                                </div>

                                <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                    <label class="col-sm-3 col-form-label">Job Activity:<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <select name="job_activity" class="form-control" value={{old('job_activity')}} required>
                                            <option value="">Select</option>
                                            <option value="SEAIMP.FWD">SEAIMP.FWD</option>
                                            <option value="SEAEXP.FWD">SEAEXP.FWD</option>
                                            <option value="AIRIMP.FWD">AIRIMP.FWD</option>
                                            <option value="AIREXP.FWD">AIREXP.FWD</option>
                                            <option value="SEAIMP.NVOCC">SEAIMP.NVOCC</option>
                                            <option value="SEAEXP.NVOCC">SEAEXP.NVOCC</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Job Party:<span class="text-danger">*</span></label>
                                    <div class="col-sm-9 d-flex align-items-center">
                                        <select name="job_party_id" class="form-control me-2" required>
                                            <option value="">Select</option>
                                            @foreach($parties as $party)
                                                <option value="{{ $party->id }}">{{ $party->party_name }}</option>
                                            @endforeach
                                        </select>
                                        <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#partyDetailsModal">+</button>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Job Remarks:</label>
                                    <div class="col-sm-9">
                                        <textarea name="job_remarks" class="form-control" rows="2">{{ old('job_remarks') }}</textarea>
                                    </div>
                                </div>

                                <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                    <label class="col-sm-3 col-form-label">Term:</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="term" class="form-control" value="{{ old('term') }}">
                                    </div>
                                </div>

                                <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                    <label class="col-sm-3 col-form-label">Enquiry Reference No:</label>
                                    <div class="col-sm-9">                            
                                        <select name="enquiry_reference_no" class="form-control" id="">
                                            <option value="">select</option> 
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                    <label class="col-sm-3 col-form-label">Job Activity Type:</label>
                                    <div class="col-sm-9 d-flex gap-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="job_activity_type" value="1" checked>
                                            <label class="form-check-label">Single Hbl</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="job_activity_type" value="2">
                                            <label class="form-check-label">Multi Hbl</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                    <label class="col-sm-3 col-form-label">Shipment Type:</label>
                                    <div class="col-sm-9 d-flex gap-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="shipment_type" value="FCL" checked>
                                            <label class="form-check-label">FCL</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="shipment_type" value="LCL">
                                            <label class="form-check-label">LCL</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="shipment_type" value="AIR">
                                            <label class="form-check-label">AIR</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                    <label class="col-sm-3 col-form-label">Job Status:</label>
                                    <div class="col-sm-9 d-flex gap-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="job_status" value="O" checked>
                                            <label class="form-check-label">OPEN</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="job_status" value="C">
                                            <label class="form-check-label">CLOSED</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                    <label class="col-sm-3 col-form-label">Insurance:</label>
                                    <div class="col-sm-9 d-flex gap-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="insurance" value="Y" checked>
                                            <label class="form-check-label">Yes</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="insurance" value="N">
                                            <label class="form-check-label">No</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                    <label class="col-sm-3 col-form-label">Clearance:</label>
                                    <div class="col-sm-9 d-flex gap-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="clearance" value="Y" checked>
                                            <label class="form-check-label">Yes</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="clearance" value="N">
                                            <label class="form-check-label">No</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                    <label class="col-sm-3 col-form-label">Transportation:</label>
                                    <div class="col-sm-9 d-flex gap-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="transportation" value="Y" checked>
                                            <label class="form-check-label">Yes</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="transportation" value="N">
                                            <label class="form-check-label">No</label>
                                        </div>
                                    </div>
                                </div>

                                <hr class="my-4">

                                <h4>Pre-Shipment Details</h4>

                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Booking Date:</label>
                                    <div class="col-sm-9">
                                        <input type="date" name="booking_date" class="form-control">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Cargo Ready Date:</label>
                                    <div class="col-sm-9">
                                        <input type="date" name="cargo_ready_date" class="form-control">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Pickup Date:</label>
                                    <div class="col-sm-9">
                                        <input type="date" name="pickup_date" class="form-control">
                                    </div>
                                </div>

                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <a href="{{ route('job-masters.index') }}" class="btn btn-warning btn-sm">Cancel</a>
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
                    <form id="oceanVslForm" method="post" action="{{route('new-party.store')}}">
                        @csrf
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Party Code:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="party_code">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Party Name:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="party_name">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Address Line 1:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="address_1">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Address Line 2:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="address_2">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Address Line 3:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="address_3">
                            </div>
                        </div>
                        {{-- <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Address Line 4:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="">
                            </div>
                        </div> --}}
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">City:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="city">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Pincode:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="pincode">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Party Type:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <select class="default-select  form-control wide" name="party_type" placeholder="Select">
                                    <option value="">select</option>
                                    @foreach($party_lists as $party_list)
                                        <option value="{{$party_list->id}}">{{$party_list->party_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Contact Person:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="contact_person">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Tel / Contact No:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="tel_no">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Email:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="email">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">GSTIN NO:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="gstin">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">PAN No:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="pan_no">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">CIN No:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="cin_no">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Credit Days:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="credit_days">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">TDS %:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="tds_percent">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Status:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <select class="default-select  form-control wide" name="status" placeholder="Active">
                                    <option value="">select</option>
                                    <option value="1">Active</option>
                                    <option value="0">Deactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="d-grid d-md-flex justify-content-md-end">
                            <button class="btn btn-outline-primary" type="submit">Save</button>
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
