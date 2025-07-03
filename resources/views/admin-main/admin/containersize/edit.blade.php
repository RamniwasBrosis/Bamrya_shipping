@extends('admin-main.layouts.default')

@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Edit Container Size</a></li>
    </ol>
    <a class="text-primary fs-13" href="{{ url('admin/container-sizes') }}">+ Back Container Size</a>
</div>

<div class="container-fluid p-2">
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('container-sizes.update', $containerSize->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="company_id" value="{{$containerSize->company_id}}">
                        <div id="smartwizard" class="form-wizard order-create">
                            <div class="row form-material">
                                <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                    <label class="form-label">Cont Type: <span class="text-danger">*</span></label>
                                    <input type="text" name="cont_type" class="form-control" value="{{ old('cont_type', $containerSize->cont_type) }}">
                                    @error('cont_type')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                    <label class="form-label">Description:</label>
                                    <input type="text" name="description" class="form-control" value="{{ old('description', $containerSize->description) }}">
                                    @error('description')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                    <label class="form-label">ISO Code:</label>
                                    <input type="text" name="iso_code" class="form-control" value="{{ old('iso_code', $containerSize->iso_code) }}">
                                    @error('iso_code')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                    <label class="form-label">Status: <span class="text-danger">*</span></label>
                                    <select name="status" class="form-control default-select wide">
                                        <option value="1" {{ old('status', $containerSize->status) == '1' ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('status', $containerSize->status) == '0' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('status')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-4">
                                    <button type="submit" class="btn btn-info">Update</button>
                                </div>
                            </div> <!-- row -->
                        </div> <!-- smartwizard -->
                    </form>
                </div> <!-- card-body -->
            </div> <!-- card -->
        </div> <!-- col -->
    </div> <!-- row -->
</div> <!-- container -->
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#smartwizard').smartWizard();
});
</script>
@endpush
