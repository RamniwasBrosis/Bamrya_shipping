@extends('admin-main.layouts.default')
@section('content')

<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Edit Purchase Party</a></li>
    </ol>
    <a class="text-primary fs-13" href="{{ url('admin/purchase-parties') }}">+ Back Purchase Party</a>
</div>
    
<div class="container-fluid p-2">
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('purchase-parties.update', $purchaseParty->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="company_id" value="{{ $purchaseParty->company_id }}">
                        <div class="row form-material">
                            <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Party Code:</label>
                                <input type="text" name="party_code" class="form-control" value="{{ old('party_code', $purchaseParty->party_code) }}">
                            </div>
                            <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Party Name: <span class="text-danger">*</span></label>
                                <input type="text" name="party_name" class="form-control" value="{{ old('party_name', $purchaseParty->party_name) }}">
                            </div>
                            <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Ledger Name (Tally):</label>
                                <input type="text" name="tally_ledger" class="form-control" value="{{ old('tally_ledger', $purchaseParty->tally_ledger) }}">
                            </div>
                            <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Address Line 1:</label>
                                <input type="text" name="address_1" class="form-control" value="{{ old('address_line1', $purchaseParty->address_line1) }}">
                            </div>
                            <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Address Line 2:</label>
                                <input type="text" name="address_2" class="form-control" value="{{ old('address_line2', $purchaseParty->address_line2) }}">
                            </div>
                            <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">City:</label>
                                <input type="text" name="city" class="form-control" value="{{ old('city', $purchaseParty->city) }}">
                            </div>
                            <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Pincode:</label>
                                <input type="text" name="pincode" class="form-control" value="{{ old('pincode', $purchaseParty->pincode) }}">
                            </div>
                            <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Party Type: <span class="text-danger">*</span></label>
                                <select name="party_type" class="default-select form-control wide">
                                    <option value="">select</option>
                                    <option value="cha" value="{{ $purchaseParty->party_type }}" {{ old('party_type', $purchaseParty->party_type) == 'cha' ? 'selected' : '' }}>CHA</option>
                                    <option value="forwarder" value="{{ $purchaseParty->party_type }}" {{ old('party_type', $purchaseParty->party_type) == 'forwarder' ? 'selected' : '' }}>Forwarder</option>
                                    <option value="transporter" value="{{ $purchaseParty->party_type }}" {{ old('party_type', $purchaseParty->party_type) == 'transporter' ? 'selected' : '' }}>Transporter</option>
                                    <option value="others" value="{{ $purchaseParty->party_type }}" {{ old('party_type', $purchaseParty->party_type) == 'others' ? 'selected' : '' }}>Others</option>
                                </select>
                            </div>
                            <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Contact Person:</label>
                                <input type="text" name="contact_person" class="form-control" value="{{ old('contact_person', $purchaseParty->contact_person) }}">
                            </div>
                            <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Tel / Contact No:</label>
                                <input type="text" name="tel_no" class="form-control" value="{{ old('tel_no', $purchaseParty->tel_no) }}">
                            </div>
                            <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Email:</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $purchaseParty->email) }}">
                            </div>
                            <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">GSTIN No:</label>
                                <input type="text" name="gstin" class="form-control" value="{{ old('gstin', $purchaseParty->gstin) }}">
                            </div>
                            <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">PAN No:</label>
                                <input type="text" name="pan_no" class="form-control" value="{{ old('pan_no', $purchaseParty->pan_no) }}">
                            </div>
                            <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">CIN No:</label>
                                <input type="text" name="cin_no" class="form-control" value="{{ old('cin_no', $purchaseParty->cin_no) }}">
                            </div>
                            <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Credit Days:</label>
                                <input type="number" name="credit_days" class="form-control" value="{{ old('credit_days', $purchaseParty->credit_days) }}">
                            </div>
                            <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">TDS %:</label>
                                <input type="number" name="tds_percent" class="form-control" value="{{ old('tds_percent', $purchaseParty->tds_percent) }}">
                            </div>
                            <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">State:</label>
                                <input type="text" name="state" class="form-control" value="{{ old('state', $purchaseParty->state) }}">
                            </div>
                            <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">State Code:</label>
                                <input type="text" name="state_code" class="form-control" value="{{ old('state_code', $purchaseParty->state_code) }}">
                            </div>
                            <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Status: <span class="text-danger">*</span></label>
                                <select name="status" class="default-select form-control wide">
                                    <option value="1" {{ old('status', $purchaseParty->status) == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('status', $purchaseParty->status) == 0 ? 'selected' : '' }}>Deactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-info">Update</button>
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
$(document).ready(function() {
    $('#smartwizard').smartWizard();
});
</script>
@endpush
