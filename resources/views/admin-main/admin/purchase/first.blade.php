@extends('admin-main.layouts.default')
@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li>
                <h5 class="bc-title">Export In excel For Tally - Purchase</h5>
            </li>
        </ol>
        {{-- <a class="text-primary fs-13" href="{{ url('admin/Sales/index') }}">Go List -></a> --}}
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
                                            <label class="col-sm-3 col-form-label">From Date:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <input type="date" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">To Date:</label>
                                            <div class="col-sm-9">
                                                <div class="d-flex align-items-center">
                                                    <input type="date" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <button class="btn btn-primary me-md-2 btn-sm" type="button">Preview</button>
                                    </div>
                                </div>
                            </form>
                            <hr>
                            <button class="btn btn-warning me-md-2 btn-sm" type="button">Download Excel File</button>
                        </div>
                        
                        <div class="col-xl-6 active-p">
                            <div class="card">
                                <div class="card-body p-0">
                                    <div class="table-responsive active-projects shorting">
                
                                        <div class="tbl-caption">
                                            <!--<h4 class="heading mb-0">Outstanding Report - Sales Invoice</h4>-->
                                        </div>
                                        <table id="projects-tblss" class="table ItemsCheckboxSec">
                                            <thead>
                                                <tr>
                                                    <th>Invoice No.</th>
                                                    <th>Invoice Dt</th>
                                                    <th>Ledger Name</th>
                                                    <th>DR/CR</th>
                                                    <th>Amount</th>
                                                    <th>Remarks</th>
                                                    <th>CONTNO</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>00024</td>
                                                    <td>04/04/2024</td>
                                                    <td>SKY BARGE FREIGHT PVT LTD</td>
                                                    <td>CR</td>
                                                    <td>157211.10</td>
                                                    <td>AE/BSCPL/1800/2024-25</td>
                                                    <td>AIR EXPORT</td>
                                                </tr>
                                                
                                                <tr>
                                                    <td>00024</td>
                                                    <td>04/04/2024</td>
                                                    <td>AIR FREIGHT</td>
                                                    <td>DR</td>
                                                    <td>128100.00</td>
                                                    <td>AE/BSCPL/1800/2024-25</td>
                                                    <td>AIR EXPORT</td>
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
