@extends('admin-main.layouts.default')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Edit Bank Details</a></li>
    </ol>
    <a class="text-primary fs-13" href="{{url('admin/banks')}}">+ Back Bank Details</a>
</div>

<div class="container-fluid p-2">
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('banks.update', $bank->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div id="smartwizard" class="form-wizard order-create">
                            <input type="hidden" name="company_id" value="{{$bank->company_id}}">
                            <div class="row form-material">

                                <!-- Bank Name -->
                                <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                    <label class="form-label">Bank Name:</label>
                                    <span class="text-danger">*</span>
                                    <input type="text" class="form-control" name="bank_name" value="{{ old('bank_name', $bank->bank_name) }}">
                                </div>

                                <!-- Beneficiary Name -->
                                <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                    <label class="form-label">Beneficiary Name:</label>
                                    <span class="text-danger">*</span>
                                    <input type="text" class="form-control" name="beneficiary_name" value="{{ old('beneficiary_name', $bank->beneficiary_name) }}">
                                </div>

                                <!-- Branch Name -->
                                <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                    <label class="form-label">Branch Name:</label>
                                    <input type="text" class="form-control" name="branch_name" value="{{ old('branch_name', $bank->branch_name) }}">
                                </div>

                                <!-- Account No -->
                                <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                    <label class="form-label">Account No:</label>
                                    <input type="text" class="form-control" name="account_no" value="{{ old('account_no', $bank->account_no) }}">
                                </div>

                                <!-- IFSC Code -->
                                <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                    <label class="form-label">IFSC Code:</label>
                                    <input type="text" class="form-control" name="ifsc_code" value="{{ old('ifsc_code', $bank->ifsc_code) }}">
                                </div>

                                <!-- Account Type -->
                                <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                    <label class="form-label">Account Type:</label>
                                    <select class="form-control" name="account_type">
                                        <option value="">Select</option>
                                        <option value="Saving Account" {{ $bank->account_type == 'Saving Account' ? 'selected' : '' }}>Savings</option>
                                        <option value="Current Account" {{ $bank->account_type == 'Current Account' ? 'selected' : '' }}>Current</option>
                                    </select>
                                </div>

                                <!-- Swift Code -->
                                <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                    <label class="form-label">Swift Code:</label>
                                    <input type="text" class="form-control" name="swift_code" value="{{ old('swift_code', $bank->swift_code) }}">
                                </div>

                                <!-- GSTIN -->
                                <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                    <label class="form-label">GSTIN (Company):</label>
                                    <input type="text" class="form-control" name="gstin_no" value="{{ old('gstin_no', $bank->gstin_no_company) }}">
                                </div>

                                <!-- Company PAN -->
                                <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                    <label class="form-label">Company PAN:</label>
                                    <input type="text" class="form-control" name="company_pan" value="{{ old('company_pan', $bank->company_pan) }}">
                                </div>

                                <!-- Company Name -->
                                <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                    <label class="form-label">Company Name:</label>
                                    <input type="text" class="form-control" name="company_name" value="{{ old('company_name', $bank->company_name) }}">
                                </div>

                                <!-- Addresses -->
                                @for ($i = 1; $i <= 3; $i++)
                                <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                    <label class="form-label">Branch Company Address {{ $i }}:</label>
                                    <textarea class="form-control" name="address{{ $i }}" rows="2">{{ old("address1", $bank->branch_company_address1) }}</textarea>
                                </div>
                                @endfor

                                <!-- Contact No -->
                                <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                    <label class="form-label">Contact No:</label>
                                    <input type="text" class="form-control" name="contact_no" value="{{ old('contact_no', $bank->contact_no) }}">
                                </div>

                                <!-- Notes 1 to 10 -->
                                @for ($i = 1; $i <= 10; $i++)
                                <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                    <label class="form-label">Notes {{ $i }}:</label>
                                    <textarea class="form-control" name="notes{{ $i }}" rows="2">{{ old("notes$i", $bank["notes$i"]) }}</textarea>
                                </div>
                                @endfor
                            </div>

                            <div class="col-4">
                                <button type="submit" class="btn btn-info">Update</button>
                            </div>
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
        $('#smartwizard').smartWizard();
    });
</script>
@endpush
