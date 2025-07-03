@extends('admin-main.layouts.default')
@section('content')

<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Edit Export Party</a></li>
    </ol>
    <a class="text-primary fs-13" href="{{ url('admin/export-parties') }}">+ Back Export Party</a>
</div>

<div class="container-fluid p-2">
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('export-parties.update', $exportParty->id ) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="company_id" value="{{ $exportParty->company_id }}">
                        <div class="row form-material">
                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">Party Code:</label>
                                <input type="text" class="form-control" name="party_code" value="{{ old('party_code', $exportParty->party_code) }}">
                            </div>
                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">Party Name:</label><span class="text-danger">*</span>
                                <input type="text" class="form-control" name="party_name" required value="{{ old('party_name', $exportParty->party_name) }}">
                            </div>
                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">Address Line 1:</label>
                                <input type="text" class="form-control" name="address_1" value="{{ old('address_1', $exportParty->address_line1) }}">
                            </div>
                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">Address Line 2:</label>
                                <input type="text" class="form-control" name="address_2" value="{{ old('address_2', $exportParty->address_line2) }}">
                            </div>
                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">Address Line 3:</label>
                                <input type="text" class="form-control" name="address_3" value="{{ old('address_3', $exportParty->address_line3) }}">
                            </div>
                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">City:</label>
                                <input type="text" class="form-control" name="city" value="{{ old('city', $exportParty->city) }}">
                            </div>
                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">Pincode:</label>
                                <input type="text" class="form-control" name="pincode" value="{{ old('pincode', $exportParty->pincode) }}">
                            </div>
                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">Party Type:</label><span class="text-danger">*</span>
                                <select class="form-control" name="party_type" required>
                                    <option value="">--select--</option>
                                    @foreach ($parties as $party)
                                        <option value="{{ $party->id }}" {{ old('party_type', $exportParty->party_type) == $party->id ? 'selected' : '' }}>
                                            {{ $party->party_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">Contact Person:</label>
                                <input type="text" class="form-control" name="contact_person" value="{{ old('contact_person', $exportParty->contact_person) }}">
                            </div>
                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">Tel / Contact No:</label>
                                <input type="text" class="form-control" name="tel_no" value="{{ old('tel_no', $exportParty->tel_no) }}">
                            </div>
                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">Email:</label>
                                <input type="email" class="form-control" name="email" value="{{ old('email', $exportParty->email) }}">
                            </div>
                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">GSTIN No:</label>
                                <input type="text" class="form-control" name="gstin" value="{{ old('gstin', $exportParty->gstin) }}">
                            </div>
                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">PAN No:</label>
                                <input type="text" class="form-control" name="pan_no" value="{{ old('pan_no', $exportParty->pan_no) }}">
                            </div>
                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">CIN No:</label>
                                <input type="text" class="form-control" name="cin_no" value="{{ old('cin_no', $exportParty->cin_no) }}">
                            </div>
                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">Credit Days:</label>
                                <input type="number" class="form-control" name="credit_days" value="{{ old('credit_days', $exportParty->credit_days) }}">
                            </div>
                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">TDS %:</label>
                                <input type="text" class="form-control" name="tds_percent" value="{{ old('tds_percent', $exportParty->tds_percent) }}">
                            </div>
                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">Status:</label><span class="text-danger">*</span>
                                <select class="form-control" name="status" required>
                                    <option value="1" {{ old('status', $exportParty->status) == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('status', $exportParty->status) == 0 ? 'selected' : '' }}>Inactive</option>
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
