@extends('admin-main.layouts.default')
@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li>
                <h5 class="bc-title">Delivery Advice</h5>
            </li>
        </ol>
        <!--<a class="text-primary fs-13" href="{{ url('admin/DeliveryAdviceReport/index') }}">Go List -></a>-->
    </div>
    <div class="container-fluid p-2">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-validation">
                            <form class="needs-validation" novalidate>
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">HBL No.:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="default-select form-control wide me-2" placeholder="Select">
                                                    <option value="vessel1">32133225</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">DO Date:</label>
                                            <div class="col-sm-9">
                                                <div class="d-flex align-items-center">
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Do No.:</label>
                                            <div class="col-sm-9">
                                                <div class="d-flex align-items-center">
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">CHA:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="default-select form-control wide me-2" placeholder="Select">
                                                    <option value="vessel1">1/S.A.R.L. ART ET ANTIQUITIES</option>
                                                    <option value="vessel2">3PEX EXPRESS PVT LTD</option>
                                                    <option value="vessel3">A&C HOMESTORE ENTERPRISE STREET</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <button class="btn btn-primary" type="button">PREVIEW   </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                        <!--<div class="col-xl-12 col-lg-12 col-sm-12 active-p">-->
                        <!--    <div class="card">-->
                        <!--        <div class="card-body p-0">-->
                        <!--            <div class="table-responsive active-projects shorting">-->
                
                        <!--                <div class="tbl-caption">-->
                        <!--                    <h4 class="heading mb-0">SUBJECT : LOADING LIST</h4>-->
                        <!--                </div>-->
                        <!--                <table id="projects-tblss" class="table ItemsCheckboxSec">-->
                        <!--                    <thead>-->
                        <!--                        <tr>-->
                        <!--                            <th></th>-->
                        <!--                        </tr>-->
                        <!--                    </thead>-->
                        <!--                    <tbody>-->
                        <!--                        <tr>-->
                        <!--                            <td>Job No : SI/BSCPL/2278/1/MAY/2025-26</td>-->
                        <!--                        </tr>-->
                        <!--                    </tbody>-->
                        <!--                </table>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <br>
                        <div class="col-xl-12 col-lg-12 col-sm-12 active-p">
                            <div class="card">
                                <form class="needs-validation" novalidate>
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <div class="mb-3 row">
                                                <label class="col-sm-3 col-form-label">Job No : SI/BSCPL/2278/1/MAY/2025-26</label>
                                                <div class="col-sm-9 d-flex align-items-center">
                                                    
                                                </div>
                                            </div>
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
@endsection
@push('scripts')
    <script>
        (function() {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
@endpush
