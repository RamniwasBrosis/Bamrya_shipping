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
                        <h4 class="card-title">Edit Receipt</h4>
                    </div>
                    <div class="card-header">
                        <h4 class="card-title">Select Invoice Details</h4>
                    </div>
                    <div class="card-body">
                        <div id="smartwizard" class="form-wizard order-create">
                            <div class="row form-material">
                                <div class="form-validation">
                                    <form id="updateReceiptForm" class="needs-validation" method="POST" 
                                          action="{{ route('receipts.update', $receipt->id) }}" autocomplete="off">
                                        @csrf
                                        @method('PUT')
                                    
                                        <div class="row g-3">
                                            <!-- Billing Party -->
                                            <div class="col-xl-6">
                                                <label class="form-label">Billing Party:</label>
                                                <div class="d-flex">
                                                    <select class="form-control me-2 select2" name="billing_party_id" required>
                                                        <option value="">Select</option>
                                                        @foreach ($parties->where('party_type', 10) as $party)
                                                            <option value="{{ $party->id }}" 
                                                                {{ $receipt->billing_party_id == $party->id ? 'selected' : '' }}>
                                                                {{ $party->party_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <button type="button" class="btn btn-sm btn-outline-primary"
                                                        data-bs-toggle="modal" data-bs-target="#partyDetailsModal">
                                                        <i class="bi bi-plus-lg">+</i>
                                                    </button>
                                                </div>
                                            </div>
                                    
                                            <!-- Receipt Date -->
                                            <div class="col-xl-6">
                                                <label class="form-label">Receipt Date:</label>
                                                <input type="date" class="form-control" name="receipt_date"
                                                       value="{{ $receipt->receipt_date }}" required>
                                            </div>
                                    
                                            <!-- Invoice Type -->
                                            <div class="col-xl-6">
                                                <label for="invoice_type" class="form-label">Invoice Type: <span class="text-danger">*</span></label>
                                                <select class="form-control" id="invoice_type" name="invoice_type" required>
                                                    <option value="">Select Invoice Type</option>
                                                    <option value="Sales" {{ $receipt->invoice_type == 'Sales' ? 'selected' : '' }}>Sales</option>
                                                    <option value="Receipt" {{ $receipt->invoice_type == 'Receipt' ? 'selected' : '' }}>Receipt</option>
                                                    <option value="Payment" {{ $receipt->invoice_type == 'Payment' ? 'selected' : '' }}>Payment</option>
                                                </select>
                                            </div>
                                    
                                            <!-- Invoice No -->
                                            <div class="col-xl-6">
                                                <label class="form-label">Invoice No:</label>
                                                <input type="text" class="form-control" name="invoice_no" value="{{ $receipt->invoice_no }}">
                                            </div>
                                    
                                            <!-- Amount -->
                                            <div class="col-xl-6">
                                                <label class="form-label">Amount:</label>
                                                <input type="text" class="form-control" name="amount" value="{{ $receipt->amount }}">
                                            </div>
                                        </div>
                                    
                                        <!-- Buttons -->
                                        <div class="d-flex justify-content-end mt-4">
                                            <a href="{{ route('receipts.index') }}" class="btn btn-warning btn-sm me-2">Cancel</a>
                                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                        </div>
                                    </form>


                                </div>
                            </div>
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
            $('#updateReceiptForm').on('submit', function(e) {
                e.preventDefault();
        
                let form = $(this);
                let formData = form.serialize();
                let actionUrl = form.attr('action');
        
                $.ajax({
                    url: actionUrl,
                    method: 'POST', // Laravel requires POST for PUT (because of @method('PUT'))
                    data: formData,
                    beforeSend: function() {
                        form.find('button[type="submit"]').prop('disabled', true);
                    },
                    success: function(response) {
                        $('#alert-container').html(`
                            <div class="alert alert-success">${response.message}</div>
                        `);
        
                        form.find('button[type="submit"]').prop('disabled', false);
        
                        // Optionally auto-hide alert
                        setTimeout(() => {
                            $('#alert-container').fadeOut('slow', function() {
                                $(this).html('').show();
                            });
                        }, 3000);
                    },
                    error: function(xhr) {
                        form.find('button[type="submit"]').prop('disabled', false);
        
                        if (xhr.status === 422) {
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

