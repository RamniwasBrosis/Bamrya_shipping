@extends('admin-main.layouts.default')

@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Add New BL Type</a></li>
    </ol>
    <a class="text-primary fs-13" href="{{ url('admin/bl-types') }}">+ Back BL Type</a>
</div>

<div class="container-fluid p-2">
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('bl-types.store') }}" method="POST">
                        @csrf
                        <div id="smartwizard" class="form-wizard order-create">
                            <div class="row form-material">

                                <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                    <label class="form-label">BL Description: <span class="text-danger">*</span></label>
                                    <input type="text" name="bl_description" class="form-control" value="{{ old('bl_description') }}">
                                    @error('bl_description')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                    <label class="form-label">Status: <span class="text-danger">*</span></label>
                                    <select name="status" class="form-control default-select wide">
                                        <option value="">Select Status</option>
                                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('status')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-4 mt-2">
                                <button type="submit" class="btn btn-info">Save</button>
                            </div>
                        </div>
                    </form>
                </div> <!-- card-body -->
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
