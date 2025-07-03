@extends('admin-main.layouts.default')

@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Edit Company</a></li>
        </ol>
        <a class="text-primary fs-13" href="{{ url('admin/company-settings') }}">+ Back Company</a>
    </div>

    <div class="container-fluid p-2">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <div class="col-xl-12 col-xxl-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('company-settings.update', $company->id) }}">
                            @csrf
                            @method('PUT')

                            <div id="smartwizard" class="form-wizard order-create">
                                <div class="row form-material">

                                    <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                        <label class="col-sm-3 col-form-label">Company Name:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="company_name" value="{{ old('company_name', $company->company_name) }}" class="form-control" >
                                        </div>
                                    </div>

                                    <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                        <label class="col-sm-3 col-form-label">Company Email:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="email" name="company_email" value="{{ old('company_email', $company->company_email) }}" class="form-control" >
                                        </div>
                                    </div>

                                    <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                        <label class="col-sm-3 col-form-label">Company phone:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="company_phone" value="{{ old('company_phone', $company->company_phone) }}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                        <label class="col-sm-3 col-form-label">Address:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="address" value="{{ old('address', $company->address) }}" class="form-control" >
                                        </div>
                                    </div>

                                    <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                        <label class="col-sm-3 col-form-label">Branch:</label>
                                        <div class="col-sm-9">
                                            <select name="branch" class="form-control default-select wide">
                                                <option value="">-- Select--</option>
                                                @foreach ($branches as $branche)
                                                    <option value="{{$branche->branch_name}}" {{$branche->branch_name == $company->companySetting->branches ? 'selected' : ''}}>{{$branche->branch_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                        <label class="col-sm-3 col-form-label">Reg No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="reg_no" value="{{ old('reg_no', $company->companySetting->reg_no ?? '') }}" class="form-control" >
                                        </div>
                                    </div>

                                    <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                        <label class="col-sm-3 col-form-label">IceGate No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="icegate_no" value="{{ old('icegate_no', $company->companySetting->icegate_no ?? '') }}" class="form-control" >
                                        </div>
                                    </div>

                                    <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                        <label class="col-sm-3 col-form-label">Carn No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="carn_no" value="{{ old('icegate_no', $company->companySetting->carn_no ?? '') }}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                        <label class="col-sm-3 col-form-label">MLO Code:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="mlo_code" value="{{ old('icegate_no', $company->companySetting->mlo_code ?? '') }}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                        <label class="col-sm-3 col-form-label">JNPT Code:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="jnpt_code" value="{{ old('icegate_no', $company->companySetting->jnpt_code ?? '') }}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                        <label class="col-sm-3 col-form-label">GTI Code:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="gti_code" value="{{ old('icegate_no', $company->companySetting->gti_code ?? '') }}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                        <label class="col-sm-3 col-form-label">NSICT Code:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="nsict_code" value="{{ old('icegate_no', $company->companySetting->nsict_code ?? '') }}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                        <label class="col-sm-3 col-form-label">NSGIT Code:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="nsgit_code" value="{{ old('icegate_no', $company->companySetting->nsgit_code ?? '') }}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                        <label class="col-sm-3 col-form-label">Status:<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select name="status" class="form-control default-select wide" >
                                                <option value="">-- Select Status --</option>
                                                <option value="1" {{ old('status', optional($company->companySetting)->status) == '1' ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ old('status', optional($company->companySetting)->status) == '0' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 mt-3">
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
        $(document).ready(function () {
            // $('#smartwizard').smartWizard();
        });
    </script>
@endpush
