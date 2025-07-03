@extends('admin-main.layouts.default')

@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Add New Bank Details</a></li>
    </ol>
    <a class="text-primary fs-13" href="{{ url('admin/banks') }}">+ Back Bank Details</a>
</div>

<div class="container-fluid p-2">
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('banks.store') }}" method="POST">
                        @csrf
                        <div class="row form-material">
                            <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Bank Name:<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="bank_name" required>
                            </div>
                            <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Beneficiary Name:<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="beneficiary_name" required>
                            </div>
                            <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Branch Name:<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="branch_name" required>
                            </div>
                            <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Account No:<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="account_no" required>
                            </div>
                            <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">IFSC Code:<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="ifsc_code" required>
                            </div>
                            <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Account Type:<span class="text-danger">*</span></label>
                                <select class="form-control" name="account_type" required>
                                    <option value="">--Select--</option>
                                    <option value="Saving Account">Saving</option>
                                    <option value="Current Account">Current</option>
                                </select>
                            </div>
                            <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Swift Code:</label>
                                <input type="text" class="form-control" name="swift_code">
                            </div>
                            <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">GSTIN No (Company):</label>
                                <input type="text" class="form-control" name="gstin_no">
                            </div>
                            <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Company PAN:</label>
                                <input type="text" class="form-control" name="company_pan">
                            </div>
                            <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Company Name:</label>
                                <input type="text" class="form-control" name="company_name">
                            </div>
                            <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Branch Address 1:</label>
                                <textarea class="form-control" name="address1" rows="2"></textarea>
                            </div>
                            <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Branch Address 2:</label>
                                <textarea class="form-control" name="address2" rows="2"></textarea>
                            </div>
                            <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Branch Address 3:</label>
                                <textarea class="form-control" name="address3" rows="2"></textarea>
                            </div>
                            <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Contact No:</label>
                                <input type="text" class="form-control" name="contact_no">
                            </div>

                            @for ($i = 1; $i <= 10; $i++)
                            <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Notes{{ $i }}:</label>
                                <textarea class="form-control" name="notes{{ $i }}" rows="2"></textarea>
                            </div>
                            @endfor
                        </div>

                        <div class="col-4">
                            <button type="submit" class="btn btn-info">Save</button>
                        </div>
                    </form>
                </div> <!-- card-body -->
            </div> <!-- card -->
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
