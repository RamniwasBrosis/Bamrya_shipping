@extends('admin-main.layouts.default')
@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Receipt</a></li>
        </ol>
        <a class="text-primary fs-13" href="{{ url('admin/receipts') }}"><- Go Back</a>
    </div>


    <div id="alert-container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="mb-2">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>


    <div class="container-fluid p-2">
        <!-- row -->
        <div class="row">
            <div class="col-xl-12 col-xxl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add New Receipt</h4>
                    </div>
                    <div class="card-header">
                        <h4 class="card-title">Select Invoice Details</h4>
                    </div>
                    <div class="card-body">
                        <div id="smartwizard" class="form-wizard order-create">
                            <div class="row form-material">
                                <div class="form-validation">
                                    <form id="receiptForm" class="needs-validation" method="post" action="{{ route('receipts.store') }}" autocomplete="off">
                                        @csrf
                                        
                                        <div class="row g-3">
                                            <!-- Billing Party -->
                                            <div class="col-xl-6">
                                                <label class="form-label">Billing Party:</label>
                                                <div class="d-flex">
                                                    <select class="form-control me-2 select2" name="billing_party_id">
                                                        <option value="">Select</option>
                                                        @foreach ($parties->where('party_type', 10) as $party)
                                                            <option value="{{ $party->id }}">{{ $party->party_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <button type="button" class="btn btn-sm btn-outline-primary"
                                                        data-bs-toggle="modal" data-bs-target="#partyDetailsModal"
                                                        data-target-field="billing_party_id">
                                                        <i class="bi bi-plus-lg">+</i>
                                                    </button>
                                                </div>
                                            </div>
                                    
                                            <!-- Receipt Date -->
                                            <div class="col-xl-6">
                                                <label class="form-label">Receipt. Date:</label>
                                                <input type="date" class="form-control" name="receipt_date">
                                            </div>
                                    
                                            <div class="mb--xl-6">
                                                <label for="invoice_type" class="col-sm-4 col-form-label">Invoice Type:<span class="text-danger">*</span></label>
                                                <div class="col-sm-6">
                                                    <select class="default-select form-control wide" id="invoice_type" name="invoice_type">
                                                        <option value="">Select Invoice Type</option>
                                                        <option value="Sales">Sales</option>
                                                        <option value="Payment">Payment</option>
                                                        <option value="Receipt">Receipt</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <label class="form-label">Invoice No:</label>
                                                <input type="text" class="form-control" name="invoice_no">
                                            </div>
                                            
                                            <div class="col-xl-6">
                                                <label class="form-label">Amount:</label>
                                                <input type="text" class="form-control" name="amount">
                                            </div>
                                            
                                            <!-- Buttons -->
                                            <div class="d-flex justify-content-end mt-4">
                                                <a href="{{ route('receipts.index') }}" class="btn btn-warning btn-sm me-2">Cancel</a>
                                                <button type="submit" class="btn btn-primary btn-sm">Save</button>
                                            </div>
                                    </form>

                                </div>
                            </div>

                            <!--<h4>Enter Payment Details</h4>-->
                            <!--<hr>-->
                            <!--<div class="row">-->
                            <!--    <div class="col-xl-6">-->
                            <!--        <div class="mb-3 row">-->
                            <!--            <label class="col-sm-3 col-form-label">Inv. Type:<span-->
                            <!--                    class="text-danger">*</span></label>-->
                            <!--            <div class="col-sm-9">-->
                            <!--                <select class="default-select form-control wide" placeholder="Select"></select>-->
                            <!--            </div>-->
                            <!--        </div>-->
                            <!--    </div>-->

                            <!--    <div class="col-xl-6">-->
                            <!--        <div class="mb-3 row">-->
                            <!--            <label class="col-sm-3 col-form-label">Inv. No:</label>-->
                            <!--            <div class="col-sm-9">-->
                            <!--                <input type="text" class="form-control">-->
                            <!--            </div>-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--</div>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

<!--party model-->
@include('admin-main.admin.commonModelForms.modelPartyDetails')

@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: 'Select a value',
                'allowClear': true,
                width: '100%'
            })
        })
        
        // When Billing Party changes, set Received From Party
        $('select[name="billing_party_id"]').on('change', function() {
            let selectedText = $(this).find('option:selected').text().trim();
        
            if (selectedText && selectedText.toLowerCase() !== 'select') {
                $('input[name="received_from_party"]').val(selectedText);
            } else {
                $('input[name="received_from_party"]').val('');
            }
        });

    </script>
    <script>
        // party details model
        let targetField = null;
    
        // Capture which button triggered the modal
        $(document).on('click', '[data-bs-target="#partyDetailsModal"]', function () {
            targetField = $(this).data('target-field'); // e.g. 'billing_party_id', 'notify_id', etc.
        });
        
        // Handle form submission
        $('#modelPartyDetails').on('submit', function (e) {
            e.preventDefault();
        
            $.ajax({
                url: "{{ route('new-party.store') }}",
                method: 'POST',
                data: $(this).serialize(),
                success: function (response) {
                    if (response.success) {
                        const partyId = response.party.id;
                        const partyName = response.party.name;
                        const activeSelect = $('select[name="' + targetField + '"]');

                        if (activeSelect.find('option[value="' + partyId + '"]').length === 0) {
                            const newOption = new Option(partyName, partyId, true, true);
                            activeSelect.append(newOption).trigger('change');
                        }
        
                        $('#modelPartyDetails')[0].reset();
                        $('#partyDetailsModal').modal('hide');
                        toastr.success('Party added successfully!');
                    } else {
                        toastr.error(response.message || 'Something went wrong.');
                    }
                },
                error: function (xhr) {
                    toastr.error('Failed to add party details.');
                    console.error('Error:', xhr.responseText);
                }
            });
        });
        
        // Reset target field after modal closes
        $('#partyDetailsModal').on('hidden.bs.modal', function () {
            targetField = null;
        });
    </script>
    
    <script>
        $(document).ready(function() {
            $('#smartwizard').smartWizard();
        });
        
        $(document).ready(function () {
            function toggleBankDetails() {
                // Check which radio is selected
                const selectedType = $('input[name="radio_type"]:checked').next('label').text().trim();

                if (selectedType === 'NEFT/CASH') {
                    $('#Bank_Details').show();
                } else {
                    $('#Bank_Details').hide();
                }
            }

            // Initially run on page load
            toggleBankDetails();

            // Bind change event
            $('input[name="radio_type"]').on('change', function () {
                toggleBankDetails();
            });
        });

    </script>
    <script>
        $(document).ready(function() {
        
            $('#receiptForm').on('submit', function(e) {
                e.preventDefault();
        
                let form = $(this);
                let formData = form.serialize();
                let actionUrl = form.attr('action');
        
                $.ajax({
                    url: actionUrl,
                    method: 'POST',
                    data: formData,
                    beforeSend: function() {
                        // Optional: disable submit button during request
                        form.find('button[type="submit"]').prop('disabled', true);
                    },
                    success: function(response) {
                        // show success alert dynamically
                        $('#alert-container').html(`
                            <div class="alert alert-success">${response.message}</div>
                        `);
        
                        // Reset form fields
                        form[0].reset();
                        form.find('select.select2').val(null).trigger('change');
                        
                        $('#Bank_Details').hide(); // hide bank details section again
                        form.find('button[type="submit"]').prop('disabled', false);
                    },
                    error: function(xhr) {
                        form.find('button[type="submit"]').prop('disabled', false);
        
                        if (xhr.status === 422) {
                            // Laravel validation errors
                            let errors = xhr.responseJSON.errors;
                            let errorMessages = Object.values(errors).flat().join('\n');
                            alert(errorMessages);
                        } else {
                            alert('Something went wrong! Please try again.');
                        }
                    }
                });
            });
        });
    </script>

@endpush
