@extends('admin-main.layouts.default')
@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Add New OnAccount</a></li>
        </ol>
        <a class="text-primary fs-13" href="{{ url('admin/on-accounts') }}"><- Go Back</a>
    </div>



    @if (session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="mb-2">{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="container-fluid p-2">
        <!-- row -->
        <div class="row">
            <div class="col-xl-12 col-xxl-12">
                <div class="card">
                    <div class="card-body">
                        <div id="smartwizard" class="form-wizard order-create">
                            <div class="row form-material">
                                <div class="form-validation">
                                    <form class="needs-validation" method="post" action="{{route('on-accounts.store')}}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-xl-6 col-xxl-12">
                                                <div class="mb-3 row">
                                                    <label class="col-sm-3 col-form-label">Date:<span class="text-danger">*</span></label>
                                                    <div class="col-sm-9">
                                                        <input type="date" class="form-control" name="sales_date" required>
                                                    </div>
                                                </div>
                                            </div>
                                           
                                            <div class="col-xl-6 col-xxl-12">
                                                <div class="mb-3 row">
                                                    <label class="col-sm-3 col-form-label">Party Name:<span class="text-danger">*</span></label>
                                                    <div class="col-sm-9">
                                                        <select class="default-select form-control wide" name="party_id" required>
                                                            <option value="">Select</option>
                                                            @foreach ($parties as $party)
                                                                <option value="{{$party->id}}">{{$party->party_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xl-6 col-xxl-12">
                                                <div class="mb-3 row">
                                                    <label class="col-sm-3 col-form-label">Amount:</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="amount">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xl-6 col-xxl-12">
                                                <div class="mb-3 row">
                                                    <label class="col-sm-3 col-form-label">Balance Amount:</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="balance_amout">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                                <a href="{{route('on-accounts.index')}}" type="button" class="btn btn-warning btn-sm">Cancel</a>
                                                <button type="submit" class="btn btn-primary btn-sm">Save</button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
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
