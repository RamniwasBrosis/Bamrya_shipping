@extends('admin-main.layouts.default')
@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">DSR Report</a></li>
        </ol>
        <!--<a class="text-primary fs-13" href="{{ url('admin/DSRReport/index') }}"><- Go Back</a>-->
    </div>
    <div class="container-fluid p-2">
        <!-- row -->
        <div class="row">
            <div class="col-xl-12 col-xxl-12">
                <div class="card">
                    <div class="card-header">
                        <!--<h4 class="card-title">Add New Invoice</h4>-->
                    </div>
                    <div class="card-body">
                        <div id="smartwizard" class="form-wizard order-create">
                            <div class="row form-material">
                                <div class="mb-3 col-xl-9 col-xxl-12 col-md-12 row">
                                    <label class="col-sm-2 col-form-label">Activity Type:</label>
                                    <div class="col-sm-12 col-md-9 col-lg-9 col-xl-9 col-xxl-9">
                                        <div class="row gap-3">
                                            <div class="col-sm-2 form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="lcl">
                                                <label class="form-check-label" for="lcl">
                                                    ALL
                                                </label>
                                            </div>
                                            <div class="col-sm-2 form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="lcl">
                                                <label class="form-check-label" for="lcl">
                                                    AIR IMPORTS
                                                </label>
                                            </div>
                                            <div class="col-sm-2 form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="fcl20">
                                                <label class="form-check-label" for="fcl20">
                                                    AIR EXPORTS
                                                </label>
                                            </div>
                                            <div class="col-sm-2 form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="fcl20">
                                                <label class="form-check-label" for="fcl20">
                                                    SEA IMPORTS
                                                </label>
                                            </div>
                                            <div class="col-sm-2 form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="fcl20">
                                                <label class="form-check-label" for="fcl20">
                                                    SEA EXPORTS
                                                </label>
                                            </div>
                                            <div class="col-sm-2 form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="fcl20">
                                                <label class="form-check-label" for="fcl20">
                                                    TRANSPORT
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3 col-xl-3 col-xxl-12 col-md-6 row">
                                    <label class="col-sm-3 col-form-label">Party:</label>
                                    <div class="col-sm-9">
                                        <div class="d-flex gap-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="lcl">
                                                <label class="form-check-label" for="lcl">
                                                    ALL
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="lcl">
                                                <label class="form-check-label" for="lcl">
                                                    Shipper
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="fcl20">
                                                <label class="form-check-label" for="fcl20">
                                                    Consignee
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-validation">
                                    <form class="needs-validation" novalidate>
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="mb-3 row">
                                                    <label class="col-sm-3 col-form-label">From Date:</label>
                                                    <div class="col-sm-9">
                                                        <input type="date" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="mb-3 row">
                                                    <div class="col-sm-9">
                                                        <select class="default-select form-control wide me-2" placeholder="Select">
                                                            <option value="vessel1">1/S.A.R.L.ART ET ANTIQUITIES</option>
                                                            <option value="vessel2">3PEX EXPRESS PVT LTD</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="mb-3 row">
                                                    <label class="col-sm-3 col-form-label">To Date:</label>
                                                    <div class="col-sm-9">
                                                        <input type="date" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="button" class="btn btn-primary btn-sm">SHOW REPORT</button>
                            </div>
                        <div class="col-xl-6 active-p">
                        <div class="card">
                            <div class="card-body p-0">
                                <div class="table-responsive active-projects shorting">
            
                                    <div class="tbl-caption">
                                        <h4 class="heading mb-0">Daily Sales Report (DSR)</h4>
                                    </div>
                                    <table id="projects-tblss" class="table ItemsCheckboxSec">
                                        <thead>
                                            <tr>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    No Records Found in Productivity Report!
                                                </td>
                                            </tr>
            
                                        </tbody>
            
                                    </table>
                                </div>
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
