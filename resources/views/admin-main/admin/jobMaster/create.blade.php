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
        
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
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
                        
                        <form   id="jobMasterForm" action="{{ route('job-masters.store') }}" method="POST">
                            @csrf
                            <div class="row form-material">

                                <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                    <label class="col-sm-3 col-form-label">BL Issued By:</label>
                                    <div class="col-sm-9">
                                        <div class="d-flex gap-3">
                                            
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" value="{{  $company_code->company_code; }}"
                                                    id="lcl" name="bl_issue" checked>
                                                <label class="form-check-label" for="lcl">
                                                    {{  $company_code->company_code; }}
                                                </label>
                                            </div>
                                            
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" value="Nominated"
                                                    id="lcl10" name="bl_issue">
                                                <label class="form-check-label" for="lcl10">
                                                    Nominated
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" value="Enquiry"
                                                    id="fcl20" name="bl_issue">
                                                <label class="form-check-label" for="fcl20">
                                                    Enquiry
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                    <label class="col-sm-3 col-form-label">Job No:<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" disabled style="cursor: not-allowed;" name="job_no" class="form-control" value="{{$nextJobNo}}">
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
                                    <select name="job_activity" id="job_activity" class="form-control select2" required>
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
                                        <select name="job_party_id" id="job_party_id" class="form-control me-2 select2" required>
                                            <option value="">Select</option>
                                            <!-- Initially blank; JavaScript will populate it -->
                                        </select>
                                        <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addNewPartyModal">+</button>
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
                                        <select name="enquiry_reference_no" class="form-control" id="enquiry_reference_no">
                                            <option value="">select</option> 
                                            @foreach($enquiries as $enquiry)
                                                <option value="{{$enquiry->id}}">{{$enquiry->enquiry_no}}</option> 
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                    <label class="col-sm-3 col-form-label">Job Activity Type:<span class="text-danger">*</span></label>
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
                                    <label class="col-sm-3 col-form-label">Shipment Type:<span class="text-danger">*</span></label>
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
                                    <label class="col-sm-3 col-form-label">Job Status:<span class="text-danger">*</span></label>
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
                                    <label class="col-sm-3 col-form-label">Insurance:<span class="text-danger">*</span></label>
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
                                    <label class="col-sm-3 col-form-label">Clearance:<span class="text-danger">*</span></label>
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
                                    <label class="col-sm-3 col-form-label">Transportation:<span class="text-danger">*</span></label>
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
                                    <label class="col-sm-3 col-form-label">Booking Date:<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="date" name="booking_date" class="form-control">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Cargo Dispatch Date:</label>
                                    <div class="col-sm-9">
                                        <input type="date" name="cargo_ready_date" class="form-control">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Pickup Date:<span class="text-danger">*</span></label>
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
                    <div id="responseMessage"></div>
                    <div id="enquiryResponse"></div>
                </div>
            </div>
        </div>
    </div>
    
    <!--Model-->
    <div class="modal fade" id="addNewPartyModal" tabindex="-1" aria-labelledby="oceanVslModalLabel"
    aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="oceanVslModalLabel">Party</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="modelPartyDetails" method="post" action="{{route('new-party.store')}}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="party_mode" value="local" />
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
                            <label for="password" class="col-sm-4 col-form-label">Address Line 1:<span
                                    class="text-danger">*</span></label>
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
                                <select class="form-control" name="party_type">
                                    <option value="">select</option>
                                    @foreach($party_lists as $type)
                                    <option value="{{ $type->party_type }}">{{ $type->party_name }}</option>
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
                            <label for="file" class="col-sm-4 col-form-label">Document <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="file" class="form-control" name="documents[]" multiple>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Status:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <select class="form-control" name="status" required>
                                    <option value="1" selected>Active</option>
                                    <option value="0">Deactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="d-grid d-md-flex justify-content-md-end">
                            <button class="btn btn-outline-primary" type="submit">Save</button>
                        </div>
                        
            
                        <small id="partyNameError" class="text-danger"></small>
    
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
<!--<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>-->
    <script>
        $(document).ready(function() {
            
            $('.select2').select2({
                width: '100%'
            })
    
            const importParties = @json($importParties);
            const exportParties = @json($exportParties);
        
            const importTypes = ['SEAIMP.FWD', 'AIRIMP.FWD', 'SEAIMP.NVOCC'];
            const exportTypes = ['SEAEXP.FWD', 'AIREXP.FWD', 'SEAEXP.NVOCC'];
        
            $('#job_activity').on('change', function () {
                const selected = $(this).val();
                const partySelect = $('#job_party_id');
                partySelect.empty().append('<option value="">Select</option>');
        
                let relevantParties = [];
        
                if (importTypes.includes(selected)) {
                    relevantParties = importParties;
                } else if (exportTypes.includes(selected)) {
                    relevantParties = exportParties;
                }
        
                relevantParties.forEach(party => {
                    partySelect.append(`<option value="${party.id}">${party.party_name}</option>`);
                });
        
                partySelect.trigger('change'); 
                if (selected === "AIRIMP.FWD" || selected === "AIREXP.FWD") {
                    $('input[name="shipment_type"][value="AIR"]').prop('checked', true);
                } else {
                    // Otherwise select FCL by default (optional)
                    $('input[name="shipment_type"][value="FCL"]').prop('checked', true);
                }
                
            });
            
            
            $('#modelPartyDetails').on('submit', function(e) {
                e.preventDefault();
                
                $('#subBtn').text('submitting form').prop('disabled', true);
            
                let formData = new FormData(this);
            
                $.ajax({
                    url: "{{ route('job-master.new-party.store') }}",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(res) {
            
                        if(res.status === 'success') {
            
                            const { id, name } = res.party;
                
                            $('select[name="job_party_id"]').each(function() {
                                $(this).append(`<option value="${id}" selected>${name}</option>`);
                            });
            
                            // Reset form and hide modal
                            $('#modelPartyDetails')[0].reset();
                            var modalEl = document.getElementById('addNewPartyModal');
                            var modal = bootstrap.Modal.getInstance(modalEl);
                            modal.hide();
                            
                            $('#subBtn').text('save').prop('disabled', flase);
            
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: res.message,
                                timer: 2000,
                                showConfirmButton: false
                            });
                            
                        }else{
                            $('#partyNameError').text(res.message).addClass('alert alert-danger');
                        }
                        
                    },
                    error: function (xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            let errorHtml = '';
                
                            $.each(errors, function (field, messages) {
                                messages.forEach(function (message) {
                                    errorHtml += `<li>${message}</li>`;
                                });
                            });
                
                            $('#partyNameError').html(`<ul>${errorHtml}</ul>`).show();
                        }
                    }
                });
            });

        
        })
    </script>
    <script>
        $(document).ready(function() {
            $("#jobMasterForm").on('submit', function(e) {
                e.preventDefault();
        
                let form = $(this);
                let formData = new FormData(this);
        
                $.ajax({
                    url: form.attr('action'),
                    method: "POST",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
        
                    beforeSend: function() {
                        $("#responseMessage").html(
                            '<div class="alert alert-info">Please wait... Saving data...</div>'
                        );
                    },
        
                    success: function(response) {
                        if (response.status === false) {
                            toastr.error(response.message);
                        } else {
                            toastr.success("Job created successfully");
                        }

                    },
        
                    error: function(xhr) {
                        let errors = xhr.'esponseJSON.errors;
                        let errorHtml = '<div class="alert alert-danger"><ul>';
        
                        $.each(errors, function(key, value) {
                            errorHtml += '<li>' + value[0] + '</li>';
                        });
        
                        errorHtml += '</ul></div>';
        
                        $("#responseMessage").html(errorHtml);
                    }
                });
            });
            
            $('select[name="job_activity"]').on('change', function () {
                let jobActivity = $(this).val();
                
                if (jobActivity === 'AIRIMP.FWD' || jobActivity === 'AIREXP.FWD') {
                    $('input[name="shipment_type"][value="AIR"]').prop('checked', true);
                } else {
                    $('input[name="shipment_type"][value="FCL"]').prop('checked', true);
                }
            });
        
            // Trigger change event on page load (if old value is present)
            $('select[name="job_activity"]').trigger('change');
        });
        
    </script>
    <script>
        $(document).ready(function() {
            let targetField = null;
            $('#partyDetailsModal').on('show.bs.modal', function(event) {
                const button = $(event.relatedTarget);
                targetField = button.data('target-field');
            });
            
        });

    </script>
    <script>
        $(document).ready(function(){
            $(document).on('change', '#enquiry_reference_no', function () {

            let enquiryId = $(this).val();
        
            if (enquiryId == '') {
                $('#enquiryResponse').html('');
                return;
            }
        
            $.ajax({
                url: "{{ route('job-master.get-enquiry-details', '') }}/" + enquiryId,
                type: "GET",
                success: function (response) {
        
                    if(response.status){
        
                        let enquiry = response.data;
        
                        let html = `
                        <div class="card mt-3">
                            <div class="card-header">
                                <strong>Enquiry Details</strong>
                            </div>
        
                            <div class="card-body">
        
                                <div class="row">
        
                                    <div class="col-md-4 mb-2">
                                        <strong>Reference No :</strong><br>
                                        ${enquiry.reference_id ?? '-'}
                                    </div>
        
                                    <div class="col-md-4 mb-2">
                                        <strong>Loading Port :</strong><br>
                                        ${enquiry.loading_port?.port_name ?? '-'}
                                    </div>
        
                                    <div class="col-md-4 mb-2">
                                        <strong>Discharge Port :</strong><br>
                                        ${enquiry.discharge_port?.port_name ?? '-'}
                                    </div>
        
                                    <div class="col-md-4 mb-2">
                                        <strong>Consignee :</strong><br>
                                        ${enquiry.consignee?.party_name ?? '-'}
                                    </div>
        
                                    <div class="col-md-4 mb-2">
                                        <strong>Gross Weight :</strong><br>
                                        ${enquiry.gross_weight ?? '-'}
                                    </div>
        
                                    <div class="col-md-4 mb-2">
                                        <strong>Chargeable Weight :</strong><br>
                                        ${enquiry.chargeable_weight ?? '-'}
                                    </div>
        
                                    <div class="col-md-4 mb-2">
                                        <strong>No. of Packages :</strong><br>
                                        ${enquiry.no_of_pkgs ?? '-'}
                                    </div>
        
                                    <div class="col-md-4 mb-2">
                                        <strong>No. of Containers :</strong><br>
                                        ${enquiry.no_of_container ?? '-'}
                                    </div>
        
                                    <div class="col-md-4 mb-2">
                                        <strong>CBM :</strong><br>
                                        ${enquiry.cbm ?? '-'}
                                    </div>
        
                                    <div class="col-md-4 mb-2">
                                        <strong>Buying Rate :</strong><br>
                                        ${enquiry.buying_rate ?? '-'}
                                    </div>
        
                                    <div class="col-md-4 mb-2">
                                        <strong>Selling Rate :</strong><br>
                                        ${enquiry.selling_rate ?? '-'}
                                    </div>
        
                                    <div class="col-md-4 mb-2">
                                        <strong>Shipment Type :</strong><br>
                                        ${enquiry.shipment_type ?? '-'}
                                    </div>
        
                                    <div class="col-md-4 mb-2">
                                        <strong>ETA / ETD :</strong><br>
                                        ${enquiry.eta_etd ?? '-'}
                                    </div>
        
                                    <div class="col-md-4 mb-2">
                                        <strong>Commodity :</strong><br>
                                        ${enquiry.commodity_desc ?? '-'}
                                    </div>
        
                                </div>
        
                            </div>
                        </div>`;
        
                        $('#enquiryResponse').html(html);
        
                    }
        
                }
            });
        
        });
        });
    </script>
    
@endpush
