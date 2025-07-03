@extends('admin-main.layouts.default')
@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li>
                <h5 class="bc-title">SAC SUMMARY REPORT:</h5>
            </li>
        </ol>
        <!--<a class="text-primary fs-13" href="{{ url('admin/SacSummaryReport/index') }}">Go List -></a>-->
    </div>
    <div class="container-fluid p-2">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-validation">
                            <form class="needs-validation" novalidate>
                                <div class="row">
                                    <div class="col-xl-5">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">From Date:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <input type="date" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-5">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">To Date:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <input type="date" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                   
                                            
                                    <div class="col-xl-2">
                                        <div class="mb-3 row">
                                            
                                            <div class="form-check col-sm-3">
                                            <input class="form-check-input" type="checkbox">
                                            <label class="form-check-label" for="fcl20">
                                                Gst Wise:
                                            </label>
                                            </div>
                                           
                                        </div>
                                    </div>
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <button class="btn btn-primary" type="button">Show Report</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                        <div class="col-xl-6 active-p">
                        <div class="card">
                            <div class="card-body p-0">
                                <div class="table-responsive active-projects shorting">
            
                                    <div class="tbl-caption">
                                        <h4 class="heading mb-0">SAC SUMMARY REPORT</h4>
                                    </div>
                                    <table id="projects-tblss" class="table ItemsCheckboxSec">
                                        <thead>
                                            <tr>
                                                <th>Invoice No</th>
                                                <th>Sac Code</th>
                                                <th>INV DT</th>
                                                <th>Party Name</th>
                                                <th>Qty</th>
                                                <th>Rate</th>
                                                <th>CURRENCY</th>
                                                <th>Charge Name</th>
                                                <th>Amount in Invoice Currency</th>
                                                <th>exch rate</th>
                                                <th>Amount in Local Currency</th>
                                                <th>gst perc</th>
                                                <th>cgst</th>
                                                <th>sgst</th>
                                                <th>igst</th>
                                                <th>TOTAL</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>BSCPL/002/25-26</td>
                                                <td>5</td>
                                                <td>01/05/2025</td>
                                                <td>JD IMPEX</td>
                                                <td>1775</td>
                                                <td>1775</td>
                                                <td>USD</td>
                                                <td>OCEAN FREIGHT-EXP-REV-CUST</td>
                                                <td>160690.750</td>
                                                <td>90.53</td>
                                                <td>160690.750</td>
                                                <td>5</td>
                                                <td>4017.27</td>
                                                <td>4017.27</td>
                                                <td>0</td>
                                                <td>168725.29</td>
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
