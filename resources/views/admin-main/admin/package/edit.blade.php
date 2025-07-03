@extends('admin-main.layouts.default')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Edit Package</a></li>
    </ol>
    <a class="text-primary fs-13" href="{{ route('packages.index') }}">+ Back to Packages</a>
</div>

<div class="container-fluid p-2">
    <!-- row -->
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-body">
                    <div id="smartwizard" class="form-wizard order-create">

                        <form action="{{ route('packages.update', $package->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <input type="hidden" name="company_id" value="{{$package->company_id}}">
                            <div class="row form-material">
                                <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                    <label class="form-label">Package Code:</label>
                                    <span class="text-danger">*</span>
                                    <input type="text" name="package_code" class="form-control"
                                           value="{{ old('package_code', $package->package_code) }}" required maxlength="6">
                                    @error('package_code')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                    <label class="form-label">Description:</label>
                                    <textarea name="description" class="form-control h-100" rows="4">{{ old('description', $package->description) }}</textarea>
                                    @error('description')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                    <label class="form-label">Status:</label>
                                    <span class="text-danger">*</span>
                                    <select name="status" class="default-select form-control wide" required>
                                        <option value="">-- Select Status --</option>
                                        <option value="1" {{ old('status', $package->status) == '1' ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('status', $package->status) == '0' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('status')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
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
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('#smartwizard').smartWizard();
    });
</script>
@endpush
