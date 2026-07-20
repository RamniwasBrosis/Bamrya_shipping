@extends('admin-main.layouts.default')
@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Purchase Payment</a></li>
        </ol>
        <a class="text-primary fs-13" href="{{ url('admin/purchase-payment') }}"><- Go Back</a>
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
                        <h4 class="card-title">Edit Purchase Payment</h4>
                    </div>
                    <div class="card-body">
                        <div id="smartwizard" class="form-wizard order-create">
                            <div class="row form-material">
                                <div class="form-validation">
                                    <form id="purchasePaymentUpdateForm" method="post" action="{{ route('purchase-payment.update', $purchase_payment->id) }}">
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
                                                                {{ $purchase_payment->billing_party_id == $party->id ? 'selected' : '' }}>
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
                                    
                                            <!-- Purchase Date -->
                                            <div class="col-xl-6">
                                                <label class="form-label">Purchase Date:</label>
                                                <input type="date" class="form-control" name="purchase_date"
                                                       value="{{ $purchase_payment->purchase_date }}" required>
                                            </div>
                                    
                                            <!-- Invoice Type -->
                                            <div class="col-xl-6">
                                                <label for="invoice_type" class="form-label">Invoice Type: <span class="text-danger">*</span></label>
                                                <select class="form-control" id="invoice_type" name="invoice_type" required>
                                                    <option value="">Select Invoice Type</option>
                                                    <option value="Purchase" {{ $purchase_payment->invoice_type == 'Purchase' ? 'selected' : '' }}>Purchase</option>
                                                    <option value="Journal" {{ $purchase_payment->invoice_type == 'Journal' ? 'selected' : '' }}>Journal</option>
                                                </select>
                                            </div>
                                    
                                            <!-- Invoice No -->
                                            <div class="col-xl-6">
                                                <label class="form-label">Invoice No:</label>
                                                <input type="text" class="form-control" name="invoice_no" value="{{ $purchase_payment->invoice_no }}">
                                            </div>
                                    
                                            <!-- Amount -->
                                            <div class="col-xl-6">
                                                <label class="form-label">Amount:</label>
                                                <input type="text" class="form-control" name="amount" value="{{ $purchase_payment->amount }}">
                                            </div>
                                        </div>
                                    
                                        <!-- Buttons -->
                                        <div class="col-12 d-flex justify-content-end gap-2">
                                            <a href="{{ route('purchase-payment.index') }}" class="btn btn-warning btn-sm">Cancel</a>
                                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                        </div>
                                
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
        
        $(document).ready(function() {
            // When Billing Party changes, set Received From Party
            $('select[name="billing_party_id"]').on('change', function() {
                let selectedText = $(this).find('option:selected').text().trim();
        
                if (selectedText && selectedText.toLowerCase() !== 'select') {
                    $('input[name="received_from_party"]').val(selectedText); // <- here
                } else {
                    $('input[name="received_from_party"]').val('');
                }
            });
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
            $('#purchasePaymentUpdateForm').on('submit', function(e) {
                e.preventDefault();
        
                let form = $(this);
                let url = form.attr('action');
                let formData = form.serialize();
        
                $.ajax({
                    url: url,
                    type: form.attr('method'), // 👈 this ensures PUT method is respected
                    data: formData,
                    success: function(response) {
                        $('#alert-container').html(`
                            <div class="alert alert-success">${response.message}</div>
                        `);
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON?.errors;
                        let errorHtml = '<div class="alert alert-danger"><ul>';
                        if(errors) {
                            $.each(errors, function(key, value) {
                                errorHtml += '<li>' + value[0] + '</li>';
                            });
                        } else {
                            errorHtml += '<li>Something went wrong!</li>';
                        }
                        errorHtml += '</ul></div>';
                        $('#alert-container').html(errorHtml);
                    }
                });
            });
        });
    </script>


@endpush
