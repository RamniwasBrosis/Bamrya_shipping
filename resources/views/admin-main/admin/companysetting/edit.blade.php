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
                        <form method="POST" action="{{ route('company-settings.update', $company->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div id="smartwizard" class="form-wizard order-create">
                                <div class="row form-material">

                                    <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                        <label class="col-sm-3 col-form-label">Company logo:</label>
                                        <div class="col-sm-9">
                                            <input type="file" name="logo" class="form-control">
                                    
                                            @if($company->logo)
                                                <img src="{{ asset('public/uploads/company_logo/' . $company->logo) }}" 
                                                     alt="Company Logo"
                                                     style="width:100px; margin-top:10px;">
                                            @endif
                                        </div>
                                    </div>
                                    
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
                                        <label class="col-sm-3 col-form-label">Company phone:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="company_phone" value="{{ old('company_phone', $company->company_phone) }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                        <label class="col-sm-3 col-form-label">LandLine No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="land_line_ph" value="{{ old('land_line_ph', $company->companySetting->land_line_ph) }}" class="form-control">
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
                                        <label class="col-sm-3 col-form-label">Registration No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="reg_no" value="{{ old('reg_no', $company->companySetting->reg_no ?? '') }}" class="form-control" >
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                        <label class="col-sm-3 col-form-label">Job No From:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="job_no" value="{{ old('job_no', $company->companySetting->job_no ?? '') }}" class="form-control" >
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                        <label class="col-sm-3 col-form-label">Company Code:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="company_code" placeholder="Code" value="{{ old('company_code', $company->companySetting->company_code ?? '') }}" class="form-control" >
                                            <small class="form-text text-muted">
                                                Enter company code (e.g., Code For show in Full Job No. like SL/Code/2219/2025-26).
                                            </small>
                                        </div>
                                    </div>

                                    <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                        <label class="col-sm-3 col-form-label">Fax No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="fax_no" value="{{ old('fax_no', $company->companySetting->fax_no ?? '') }}" class="form-control" >
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                        <label class="col-sm-3 col-form-label">Pan No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="pan_no" value="{{ old('pan_no', $company->companySetting->pan_no ?? '') }}" class="form-control" >
                                        </div>
                                    </div>

                                    <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                        <label class="col-sm-3 col-form-label">Gstin No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="gstin_no" value="{{ old('gstin_no', $company->companySetting->gstin_no ?? '') }}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                        <label class="col-sm-3 col-form-label">Cin No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="cin_no" value="{{ old('cin_no', $company->companySetting->cin_no ?? '') }}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                        <label class="col-sm-3 col-form-label">Tan:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="tan_no" value="{{ old('tan_no', $company->companySetting->tan_no ?? '') }}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                        <label class="col-sm-3 col-form-label">Phone No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="phone" value="{{ old('phone', $company->companySetting->phone ?? '') }}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                        <label class="col-sm-3 col-form-label">Email:</label>
                                        <div class="col-sm-9">
                                            <input type="email" name="email" value="{{ old('email', $company->companySetting->email ?? '') }}" class="form-control">
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
