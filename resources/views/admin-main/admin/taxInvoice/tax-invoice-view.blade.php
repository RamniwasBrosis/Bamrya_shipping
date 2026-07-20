@extends('admin-main.layouts.default')
@section('content')

    <div class="container-fluid p-2">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">View Tax Invoice</h4>
                </div>
                <div class="card-body">
                    <div class="form-validation">
                        <form method="POST" id="searchForm">
                            @csrf
                            <div class="mb-6 row">
                                <div class="d-flex gap-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="AI" name="search_by">
                                        <label class="form-check-label" for="lcl">
                                            Air Import
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="AE" name="search_by">
                                        <label class="form-check-label" for="fcl20">
                                            Air Export
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="SI" name="search_by">
                                        <label class="form-check-label" for="fcl40">
                                            Sea Import
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="SE" name="search_by">
                                        <label class="form-check-label" for="air">
                                            Sea Export
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="TR" name="search_by">
                                        <label class="form-check-label" for="air">
                                            Transport
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <hr>
                    </div>
                </div>
                
                <div class="form-validation">
                    <form method="POST" action="{{route('sales-invoices.store')}}" id="taxInvoiceForm" class="needs-validation">
                        @csrf
                        <div class="row px-3">
                            <!-- Row 1 -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Job No: <span class="text-danger">*</span></label>
                                <select name="job_id" id="option" class="form-control select2" required>
                                    <option value="">Select</option>
                                    {{-- Populate with @foreach if needed --}}
                                </select>
                            </div>
                        </div>
                        
                        <div class="row px-3">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Invoice Type:</label>
                                <select name="invoice_type" class="form-control select2">
                                    <option value="">Select</option>
                                    <option value="Tax Invoice">Tax Invoice</option>
                                    <option value="DEBITNOTE(Rs)">DEBITNOTE(Rs)</option>
                                    <option value="CREDITNOTE(Rs)">CREDITNOTE(Rs)</option>
                                    <option value="DEBITNOTE(Ovr.)">DEBITNOTE(Ovr.)</option>
                                    <option value="CREDITNOTE(Ovr.)">CREDITNOTE(Ovr.)</option>
                                    <option value="COMMISSION/REBATE">COMMISSION/REBATE</option>
                                    <option value="SEZ">SEZ</option>
                                    <option value="FRT(IGST)">FRT(IGST)</option>
                                    <option value="FRT(CreditNote)">FRT(CreditNote)</option>
                                </select>
                            </div>
                            
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Invoice No: <span class="text-danger">*</span></label>
                                <input type="text" name="invoice_no" class="form-control">
                            </div>
                        </div>
                        
                        <div class="text-end p-4">
                            <button class="btn btn-sm btn-primary">submit</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
    </div>                 


@endsection
@push('scripts')

    <script>
        $(document).ready(function () {

            $('.select2').select2({
                width: '100%'
            })
    
    
            $('input[name="search_by"]').on('change', function() {
                let selected = $('input[name="search_by"]:checked').val();
                if (!selected) {
                    // Clear dropdown and hidden input
                    $('#option').html('<option value="">Select</option>');
                    $('input[name="Inv_cat"]').val('');
                    return;
                }
                $('#searchForm').submit();
            });

            $('#searchForm').on('submit', function (e) {
                e.preventDefault(); // prevent default form submission
        
                const data = $(this).serialize();
               
                $.ajax({
                    url: '{{ route('sales-invoices.getJobNo') }}',
                    type: 'POST',
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function (res) {
                        if (res.status === 'success') {
                            $('#option').html(res.result);
                            $('input[name="Inv_cat"]').val(res.Inv_cat);
                        }
                    },
                    error: function (xhr) {
                        console.log('Error:', xhr.responseText);
                    }
                });
            });
            
            $('#taxInvoiceForm').on('submit', function (e) {
                e.preventDefault(); // prevent default form submission
                
                var job_id = $("select[name='job_id'] option:selected").data('originaljob');
                var invoice_type = $("select[name='invoice_type'] option:selected").val();
                var invoice_no = $("input[name='invoice_no']").val();

                if(!job_id){
                    Swal.fire({
                        title: 'Error',
                        text: 'Please select Job No!',
                        icon: 'error'
                    });
                    
                    return;
                }
                const data = $(this).serialize();
               
                $.ajax({
                    url: '{{ route('tax-invoices.store') }}',
                    type: 'POST',
                    data: {jobId: job_id, invoice_type: invoice_type,  invoice_no: invoice_no},
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function (res) {
                        if (res.status === 'success') {
                            Swal.fire({
                                title: 'Success',
                                text: 'Invoice Type and Number Updated Successfully!',
                                icon: 'success'
                            });
                        }else{
                            Swal.fire({
                                title: 'Error',
                                text: 'Invoice Type and Number Not Updated Successfully!',
                                icon: 'error'
                            });
                        }
                    },
                    error: function (xhr) {
                        console.log('Error:', xhr.responseText);
                    }
                });
            });
        
            $('#option').on('change', function () {

                let selectedOption = $(this).find('option:selected');
                let originalJob = selectedOption.data('originaljob');
                let type = selectedOption.data('type');
            
           
                let url = "{{ route('tax-invoices.getTaxInvoice') }}"
                    + "?jobId=" + originalJob
                    + "&type=" + type;
                   
                window.open(url, '_blank');
            });
            
          
        });
    </script>

@endpush