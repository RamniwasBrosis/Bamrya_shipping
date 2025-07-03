@extends('admin-main.layouts.default')

@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Add New Charge</a></li>
    </ol>
    <a class="text-primary fs-13" href="{{ route('charges.index') }}">+ Back Charge</a>
</div>

<div class="container-fluid p-2">
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('charges.store') }}" method="POST">
                        @csrf
                        <div id="smartwizard" class="form-wizard order-create">
                            
                            <div class="row form-material">

                                <div class="col-xl-3 col-md-6 mb-3">
                                    <label class="form-label">Charge Code: <span class="text-danger">*</span></label>
                                    <input type="text" name="charge_code" class="form-control" value="{{ old('charge_code') }}">
                                    @error('charge_code') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="col-xl-3 col-md-6 mb-3">
                                    <label class="form-label">Charge Name: <span class="text-danger">*</span></label>
                                    <input type="text" name="charge_name" class="form-control" value="{{ old('charge_name') }}">
                                    @error('charge_name') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="col-xl-3 col-md-6 mb-3">
                                    <label class="form-label">Tally Ledger (Name): <span class="text-danger">*</span></label>
                                    <input type="text" name="tally_ledger_name" class="form-control" value="{{ old('tally_ledger_name') }}">
                                    @error('tally_ledger_name') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="col-xl-3 col-md-6 mb-3">
                                    <label class="form-label">Currency (I/U): <span class="text-danger">*</span></label>
                                    <select name="currency" class="form-control">
                                        <option value="INR">INR</option>
                                        <option value="USD">USD</option>
                                        <option value="OTH">Other</option>
                                    </select>
                                    @error('currency') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="col-xl-3 col-md-6 mb-3">
                                    <label class="form-label">Charge Type:</label>
                                    <select name="charge_type" class="form-control">
                                        <option value="Freight">Freight</option>
                                        <option value="Normal">Normal</option>
                                    </select>
                                    @error('charge_type') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="col-xl-3 col-md-6 mb-3">
                                    <label class="form-label">GST Applicable: <span class="text-danger">*</span></label>
                                    <select name="gst_applicable" class="form-control">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                    @error('gst_applicable') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="col-xl-3 col-md-6 mb-3">
                                    <label class="form-label">GST %: <span class="text-danger">*</span></label>
                                    <select name="gst_percentage" class="form-control">
                                        <option value="0">0%</option>
                                        <option value="5">5%</option>
                                        <option value="12">12%</option>
                                        <option value="18">18%</option>
                                        <option value="28">28%</option>
                                    </select>
                                    @error('gst_percentage') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="col-xl-3 col-md-6 mb-3">
                                    <label class="form-label">Formula (Y/N):</label>
                                    <select name="has_formula" class="form-control">
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                    @error('has_formula') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="col-xl-3 col-md-6 mb-3">
                                    <label class="form-label">Limit:</label>
                                    <input type="text" name="limit" class="form-control" value="{{ old('limit') }}">
                                    @error('limit') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="col-xl-3 col-md-6 mb-3">
                                    <label class="form-label">Percentage:</label>
                                    <input type="text" name="percentage" class="form-control" value="{{ old('percentage') }}">
                                    @error('percentage') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="col-xl-3 col-md-6 mb-3">
                                    <label class="form-label">SAC Code: <span class="text-danger">*</span></label>
                                    <input type="text" name="sac_code" class="form-control" value="{{ old('sac_code') }}">
                                    @error('sac_code') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="col-xl-3 col-md-6 mb-3">
                                    <label class="form-label">Status: <span class="text-danger">*</span></label>
                                    <select name="status" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">In-Active</option>
                                    </select>
                                    @error('status') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                            </div>

                            <div class="col-4">
                                <button type="submit" class="btn btn-info">Save</button>
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
