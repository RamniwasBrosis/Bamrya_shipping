@extends('admin-main.layouts.default')

@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Add New Container</a></li>
    </ol>
    <a class="text-primary fs-13" href="{{ route('containers.index') }}">+ Back Container</a>
</div>

<div class="container-fluid p-2">
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('containers.store') }}" method="POST">
                        @csrf
                    
                        <div id="smartwizard" class="form-wizard order-create">
                            <div class="row form-material">
                                <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                    <label class="form-label">Container No:</label>
                                    <span class="text-danger">*</span>
                                    <input type="text" name="container_no" value="{{ old('container_no') }}" class="form-control" required>
                                </div>
                                <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                    <label class="form-label">Size:</label>
                                    <input type="text" name="size" value="{{ old('size') }}" class="form-control">
                                </div>
                                <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                    <label class="form-label">Category:</label>
                                    <input type="text" name="category" value="{{ old('category') }}" class="form-control">
                                </div>
                                <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                    <label class="form-label">Status:</label>
                                    <span class="text-danger">*</span>
                                    <select name="status" class="default-select form-control wide" required>
                                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>

                                <div class="col-4">
                                    <button type="submit" class="btn btn-info">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div> <!-- card-body -->
            </div> <!-- card -->
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
