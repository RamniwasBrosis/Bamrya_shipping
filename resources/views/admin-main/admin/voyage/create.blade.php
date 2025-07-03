@extends('admin-main.layouts.default')

@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Add New Voyage</a></li>
    </ol>
    <a class="text-primary fs-13" href="{{ url('admin/voyages') }}">+ Back Voyage</a>
</div>

<div class="container-fluid p-2">
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('voyages.store') }}" method="POST">
                        @csrf
                        <div class="row form-material">
                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label for="voyage_code" class="form-label">Voyage Code: <span class="text-danger">*</span></label>
                                <input type="text" id="voyage_code" name="voyage_code" 
                                    class="form-control @error('voyage_code') is-invalid @enderror"
                                    value="{{ old('voyage_code') }}" maxlength="10" required>
                                @error('voyage_code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label for="voyage_number" class="form-label">Voyage Number: <span class="text-danger">*</span></label>
                                <input type="text" id="voyage_number" name="voyage_number"
                                    class="form-control @error('voyage_number') is-invalid @enderror"
                                    value="{{ old('voyage_number') }}" maxlength="10" required>
                                @error('voyage_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label for="m_vessel_id" class="form-label">M Vessel Name: <span class="text-danger">*</span></label>
                                <select id="m_vessel_id" name="m_vessel_id" 
                                    class="default-select form-control wide @error('m_vessel_id') is-invalid @enderror" required>
                                    <option value="">-- Select Vessel --</option>
                                    @foreach ($vessels as $vessel)
                                        <option value="{{ $vessel->id }}" 
                                            {{ old('m_vessel_id') == $vessel->id ? 'selected' : '' }}>
                                            {{ $vessel->vessel_name ?? $vessel->name ?? 'N/A' }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('m_vessel_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label for="arrival_date" class="form-label">Arrival Date:</label>
                                <input type="date" id="arrival_date" name="arrival_date"
                                    class="form-control @error('arrival_date') is-invalid @enderror"
                                    value="{{ old('arrival_date') }}">
                                @error('arrival_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label for="igm_number" class="form-label">IGM Number:</label>
                                <input type="text" id="igm_number" name="igm_number"
                                    class="form-control @error('igm_number') is-invalid @enderror"
                                    value="{{ old('igm_number') }}" maxlength="10">
                                @error('igm_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label for="igm_date" class="form-label">IGM Date:</label>
                                <input type="date" id="igm_date" name="igm_date"
                                    class="form-control @error('igm_date') is-invalid @enderror"
                                    value="{{ old('igm_date') }}">
                                @error('igm_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label for="shipping_line_id" class="form-label">Shipping Line: <span class="text-danger">*</span></label>
                                <select id="shipping_line_id" name="shipping_line_id" 
                                    class="default-select form-control wide @error('shipping_line_id') is-invalid @enderror" required>
                                    <option value="">-- Select Shipping Line --</option>
                                    @foreach ($shippings as $shipping)
                                        <option value="{{ $shipping->id }}" 
                                            {{ old('shipping_line_id') == $shipping->id ? 'selected' : '' }}>
                                            {{ $shipping->shipping_line_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('shipping_line_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label for="f_voyage_no" class="form-label">F Voyage No:</label>
                                <input type="text" id="f_voyage_no" name="f_voyage_no"
                                    class="form-control @error('f_voyage_no') is-invalid @enderror"
                                    value="{{ old('f_voyage_no') }}" maxlength="255">
                                @error('f_voyage_no')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label for="f_vessel_id" class="form-label">F Vessel Name: <span class="text-danger">*</span></label>
                                <select id="f_vessel_id" name="f_vessel_id"
                                    class="default-select form-control wide @error('f_vessel_id') is-invalid @enderror" required>
                                    <option value="">-- Select Vessel --</option>
                                    @foreach ($vessels as $vessel)
                                        <option value="{{ $vessel->id }}" 
                                            {{ old('f_vessel_id') == $vessel->id ? 'selected' : '' }}>
                                            {{ $vessel->vessel_name ?? $vessel->name ?? 'N/A' }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('f_vessel_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label for="mumbai_igm_no" class="form-label">Mumbai IGM No:</label>
                                <input type="text" id="mumbai_igm_no" name="mumbai_igm_no"
                                    class="form-control @error('mumbai_igm_no') is-invalid @enderror"
                                    value="{{ old('mumbai_igm_no') }}" maxlength="255">
                                @error('mumbai_igm_no')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label for="mumbai_igm_date" class="form-label">Mumbai IGM Date:</label>
                                <input type="date" id="mumbai_igm_date" name="mumbai_igm_date"
                                    class="form-control @error('mumbai_igm_date') is-invalid @enderror"
                                    value="{{ old('mumbai_igm_date') }}">
                                @error('mumbai_igm_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label for="overseas_agent_id" class="form-label">Overseas Agent: <span class="text-danger">*</span></label>
                                <input type="number" id="overseas_agent_id" name="overseas_agent_id"
                                    class="form-control @error('overseas_agent_id') is-invalid @enderror"
                                    value="{{ old('overseas_agent_id') }}" required>
                                @error('overseas_agent_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label for="status" class="form-label">Status: <span class="text-danger">*</span></label>
                                <select id="status" name="status" class="default-select form-control wide @error('status') is-invalid @enderror" required>
                                    <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-4">
                            <button type="submit" class="btn btn-info">Save</button>
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
    $('.default-select').selectpicker(); // if you use bootstrap-select or similar
});
</script>
@endpush
