@extends('admin-main.layouts.default')
@section('content')

<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Edit IMPORT Party</a></li>
    </ol>
    <a class="text-primary fs-13" href="{{ url('admin/import-parties') }}">+ Back IMPORT Party</a>
</div>

<div class="container-fluid p-2">
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('import-parties.update', $importParty->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="company_id" value="2">
                        <div class="row form-material">
                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">Party Code:</label>
                                <input type="text" name="party_code" class="form-control" value="{{ old('party_code', $importParty->party_code) }}">
                            </div>
                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">Party Name: <span class="text-danger">*</span></label>
                                <input type="text" name="party_name" class="form-control" value="{{ old('party_name', $importParty->party_name) }}">
                            </div>
                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">Ledger Name (Tally):</label>
                                <input type="text" name="ledger_name" class="form-control" value="{{ old('tally_ledger', $importParty->tally_ledger) }}">
                            </div>
                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">Address Line 1:</label>
                                <input type="text" name="address_1" class="form-control" value="{{ old('address_line1', $importParty->address_line1) }}">
                            </div>
                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">Address Line 2:</label>
                                <input type="text" name="address_2" class="form-control" value="{{ old('address_line2', $importParty->address_line2) }}">
                            </div>
                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">Address Line 3:</label>
                                <input type="text" name="address_3" class="form-control" value="{{ old('address_line3', $importParty->address_line3) }}">
                            </div>
                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">City:</label>
                                <input type="text" name="city" class="form-control" value="{{ old('city', $importParty->city) }}">
                            </div>
                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">Pincode:</label>
                                <input type="text" name="pincode" class="form-control" value="{{ old('pincode', $importParty->pincode) }}">
                            </div>
                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">Party Type: <span class="text-danger">*</span></label>
                                <select name="party_type" class="default-select form-control wide">
                                    <option value="">-- Select --</option>
                                    @foreach($partyTypes as $type)
                                        <option value="{{ $type->id }}" {{ old('party_type', $importParty->party_type) == $type->id ? 'selected' : '' }}>
                                            {{ $type->party_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">Contact Person:</label>
                                <input type="text" name="contact_person" class="form-control" value="{{ old('contact_person', $importParty->contact_person) }}">
                            </div>
                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">Tel / Contact No:</label>
                                <input type="text" name="tel_no" class="form-control" value="{{ old('tel_no', $importParty->tel_no) }}">
                            </div>
                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">Email:</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $importParty->email) }}">
                            </div>
                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">GSTIN No:</label>
                                <input type="text" name="gstin" class="form-control" value="{{ old('gstin', $importParty->gstin) }}">
                            </div>
                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">PAN No:</label>
                                <input type="text" name="pan_no" class="form-control" value="{{ old('pan_no', $importParty->pan_no) }}">
                            </div>
                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">CIN No:</label>
                                <input type="text" name="cin_no" class="form-control" value="{{ old('cin_no', $importParty->cin_no) }}">
                            </div>
                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">Credit Days:</label>
                                <input type="number" name="credit_days" class="form-control" value="{{ old('credit_days', $importParty->credit_days) }}">
                            </div>
                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">TDS %:</label>
                                <input type="number" name="tds_percent" class="form-control" value="{{ old('tds_percent', $importParty->tds_percent) }}">
                            </div>
                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">Status: <span class="text-danger">*</span></label>
                                <select name="status" class="default-select form-control wide">
                                    <option value="1" {{ old('status', $importParty->status) == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('status', $importParty->status) == 0 ? 'selected' : '' }}>Deactive</option>
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
