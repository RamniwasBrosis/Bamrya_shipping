@extends('admin-main.layouts.default')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Edit Voyage</a></li>
    </ol>
    <a class="text-primary fs-13" href="{{ url('admin/voyages') }}">+ Back Voyage</a>
</div>
<div class="container-fluid p-2">
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('voyages.update', $MasterVoyage->id) }}">
                        @csrf
                        @method('PUT')
                        <div id="smartwizard" class="form-wizard order-create">
                            <input type="hidden" name="company_id" value="{{$MasterVoyage->company_id}}">
                            <div class="row form-material">
                                <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                    <label class="form-label">Voyage Code:</label>
                                    <span class="text-danger">*</span>
                                    <input type="text" name="voyage_code" class="form-control" value="{{ old('voyage_code', $MasterVoyage->voyage_code) }}" required>
                                </div>
                                <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                    <label class="form-label">Voyage Number:</label>
                                    <span class="text-danger">*</span>
                                    <input type="text" name="voyage_number" class="form-control" value="{{ old('voyage_number', $MasterVoyage->voyage_number) }}" required>
                                </div>
                                <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                    <label class="form-label">M Vessel Name:</label>
                                    <span class="text-danger">*</span>
                                    <select name="m_vessel_id" class="default-select form-control wide" required>
                                        <option value="">Select Vessel</option>
                                        @foreach($vessels as $vessel)
                                            <option value="{{ $vessel->id }}" {{ old('m_vessel_id', $MasterVoyage->m_vessel_id) == $vessel->id ? 'selected' : '' }}>
                                                {{ $vessel->vessel_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                    <label class="form-label">Arrival Date:</label>
                                    <input type="date" name="arrival_date" class="form-control" value="{{ old('igm_date', $MasterVoyage->arrival_date ? \Carbon\Carbon::parse($MasterVoyage->arrival_date)->format('Y-m-d') : '') }}">
                                </div>
                                <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                    <label class="form-label">IGM Number:</label>
                                    <input type="text" name="igm_number" class="form-control" value="{{ old('igm_number', $MasterVoyage->igm_number) }}">
                                </div>
                                <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                    <label class="form-label">IGM Date:</label>
                                    <input type="date" name="igm_date" class="form-control" value="{{ old('igm_date', $MasterVoyage->igm_date ? \Carbon\Carbon::parse($MasterVoyage->igm_date)->format('Y-m-d') : '') }}">
                                </div>
                                <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                    <label class="form-label">Shipping Line:</label>
                                    <span class="text-danger">*</span>
                                    <select name="shipping_line_id" class="default-select form-control wide" required>
                                        <option value="">Select Shipping Line</option>
                                        @foreach($shippings as $line)
                                            <option value="{{ $line->id }}" {{ old('shipping_line_id', $MasterVoyage->shipping_line_id) == $line->id ? 'selected' : '' }}>
                                                {{ $line->shipping_line_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                    <label class="form-label">F Voyage No:</label>
                                    <input type="text" name="f_voyage_no" class="form-control" value="{{ old('f_voyage_no', $MasterVoyage->f_voyage_no) }}">
                                </div>
                                <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                    <label class="form-label">F Vessel Name:</label>
                                    <span class="text-danger">*</span>
                                    <select name="f_vessel_id" class="default-select form-control wide" required>
                                        <option value="">Select Vessel</option>
                                        @foreach($vessels as $vessel)
                                            <option value="{{ $vessel->id }}" {{ old('f_vessel_id', $MasterVoyage->f_vessel_id) == $vessel->id ? 'selected' : '' }}>
                                                {{ $vessel->vessel_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                    <label class="form-label">Mumbai IGM No:</label>
                                    <input type="text" name="mumbai_igm_no" class="form-control" value="{{ old('mumbai_igm_no', $MasterVoyage->mumbai_igm_no) }}">
                                </div>
                                <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                    <label class="form-label">Mumbai IGM Date:</label>
                                    <input type="date" name="mumbai_igm_date" class="form-control" value="{{ old('igm_date', $MasterVoyage->mumbai_igm_date ? \Carbon\Carbon::parse($MasterVoyage->mumbai_igm_date)->format('Y-m-d') : '') }}">
                                </div>
                                <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                    <label class="form-label">Overseas Agent:</label>
                                    <span class="text-danger">*</span>
                                    <select name="overseas_agent_id" class="default-select form-control wide">
                                        {{-- <option value="">Select Agent</option> --}}
                                        {{-- @foreach($agents as $agent)
                                            <option value="{{ $agent->id }}" {{ old('overseas_agent_id', $MasterVoyage->overseas_agent_id) == $agent->id ? 'selected' : '' }}>
                                                {{ $agent->agent_name }}
                                            </option>
                                        @endforeach --}}
                                    </select>
                                </div>
                                <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                    <label class="form-label">Status:</label>
                                    <span class="text-danger">*</span>
                                    <select name="status" class="default-select form-control wide" required>
                                        <option value="1" {{ old('status', $MasterVoyage->status) == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('status', $MasterVoyage->status) == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
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
$(document).ready(function() {
    $('#smartwizard').smartWizard();
});
</script>
@endpush
