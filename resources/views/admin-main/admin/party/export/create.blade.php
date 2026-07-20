@extends('admin-main.layouts.default')
@section('content')

<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Add New Export Party</a></li>
    </ol>
    <a class="text-primary fs-13" href="{{ url('admin/export-parties') }}">+ Back Export Party</a>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container-fluid p-2">
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-body">
                    <form id="exportPartyForm" action="{{ route('export-parties.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row form-material">

                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">Party Code:</label>
                                <input type="text" class="form-control" name="party_code">
                                <small class="text-danger error-party_code"></small>
                            </div>

                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">Party Name:</label><span class="text-danger">*</span>
                                <input type="text" class="form-control" name="party_name" required>
                                <small class="text-danger error-party_name"></small>
                            </div>

                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">Address Line 1:</label>
                                <input type="text" class="form-control" name="address_1">
                                <small class="text-danger error-address_1"></small>
                            </div>

                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">Address Line 2:</label>
                                <input type="text" class="form-control" name="address_2">
                                <small class="text-danger error-address_2"></small>
                            </div>

                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">City:</label>
                                <input type="text" class="form-control" name="city">
                                <small class="text-danger error-city"></small>
                            </div>

                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">Pincode:</label>
                                <input type="text" class="form-control" name="pincode">
                                <small class="text-danger error-pincode"></small>
                            </div>

                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">Party Type:</label><span class="text-danger">*</span>
                                <select class="default-select form-control wide" name="party_type" required>
                                    <option value="">--select--</option>
                                    @foreach ($partyTypes as $type)
                                        <option value="{{ $type->party_type }}">{{ $type->party_name }}</option>
                                    @endforeach
                                </select>
                                <small class="text-danger error-party_type"></small>
                            </div>
                            
                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3 d-none" id="party_mode">
                                <label for="password" class="col-sm-4 col-form-label">Party Mode:<span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-12">
                                    <select class="form-control" name="party_mode">
                                        <option value="" selected>select</option>
                                        <option value="local" >Local</option>
                                        <option value="foreign">Foreign</option>
                                    </select>
                                    <small class="text-danger error-party_mode"></small>
                                </div>
                            </div>
                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3 d-none" id="document">
                                <label for="file" class="col-sm-4 col-form-label">Document <span class="text-danger">*</span></label>
                                <div class="col-sm-12">
                                    <input type="file" class="form-control" name="documents[]" multiple>
                                    <small class="text-danger error-documents"></small>
                                </div>
                            </div>


                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">Contact Person:</label>
                                <input type="text" class="form-control" name="contact_person">
                                <small class="text-danger error-contact_person"></small>
                            </div>

                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">Tel / Contact No:</label>
                                <input type="text" class="form-control" name="tel_no">
                                <small class="text-danger error-tel_no"></small>
                            </div>

                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">Email:</label>
                                <input type="email" class="form-control" name="email">
                                <small class="text-danger error-email"></small>
                            </div>

                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">GSTIN No:</label>
                                <input type="text" class="form-control" name="gstin">
                                <small class="text-danger error-gstin"></small>
                            </div>

                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">PAN No:</label>
                                <input type="text" class="form-control" name="pan_no">
                                <small class="text-danger error-pan_no"></small>
                            </div>

                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">CIN No:</label>
                                <input type="text" class="form-control" name="cin_no">
                                <small class="text-danger error-cin_no"></small>
                            </div>

                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">Credit Days:</label>
                                <input type="number" class="form-control" name="credit_days">
                            </div>

                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">TDS %:</label>
                                <input type="text" class="form-control" name="tds_percent">
                            </div>
                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">State:</label>
                                <input type="text" class="form-control" name="state">
                            </div>
                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">State Code:</label>
                                <input type="text" class="form-control" name="state_code">
                            </div>

                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">Status:</label><span class="text-danger">*</span>
                                <select class="form-control" name="status" required>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>

                        </div>

                        <div class="col-4">
                            <button type="submit" class="btn btn-info">Save</button>
                        </div>
                    </form>
                </div>
                
                <small id="errorBox"></small>
                
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $(document).on('submit', '#exportPartyForm', function(e) {
        e.preventDefault();
    
        let form = this;
        let formData = new FormData(form);
    
        // clear old errors
        $('.text-danger').text('');
    
        $.ajax({
            url: $(form).attr('action'),
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
    
                if(response.success){
                  
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Party Created Successfully'
                    });
    
                    form.reset(); // reset only on success
                }else{
                    $('#errorBox').text(response.message).addClass('alert alert-danger');
                    
                    setTimeout(function () {
                        $('#errorBox')
                            .text('')
                            .removeClass('alert alert-danger');
                    }, 3000);
                }
            },
            error: function(xhr){
    
                if(xhr.status === 422){
                    let errors = xhr.responseJSON.errors;
    
                    $.each(errors, function(key, value){
                        
                        let cleanKey = key.replace(/\./g, '_');
                        $('.error-' + cleanKey).text(value[0]);
                        
                        // $('.error-' + key).text(value[0]);
                        
                    });
                }
                else{
                    alert('Something went wrong');
                }
            }
        });
    });
});
</script>
@endpush
