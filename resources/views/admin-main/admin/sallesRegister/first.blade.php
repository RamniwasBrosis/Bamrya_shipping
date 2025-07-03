@extends('admin-main.layouts.default')
@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li>
                <h5 class="bc-title">Sales Register Report</h5>
            </li>
        </ol>
        <!--<a class="text-primary fs-13" href="{{ url('admin/SallesRegister/index') }}">Go List -></a>-->
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
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <input type="date" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <div class="form-check col-sm-3 d-flex align-items-center">
                                            <input class="form-check-input" type="checkbox">
                                            <label class="form-check-label" for="fcl20">
                                                Party Wise:
                                            </label>
                                            </div>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select class="default-select form-control wide me-2" placeholder="Select">
                                                    <option value="vessel1">1/S.A.R.L.ART ET ANTIQUITIES</option>
                                                    <option value="vessel2">3PEX EXPRESS PVT LTD</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <button class="btn btn-primary" type="button">Preview</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-xl-6 active-p">
                        <div class="card">
                            <div class="card-body p-0">
                                <div class="table-responsive active-projects shorting">
            
                                    <div class="tbl-caption">
                                        <h4 class="heading mb-0">Sales Invoice Register</h4>
                                    </div>
                                    <table id="projects-tblss" class="table ItemsCheckboxSec">
                                        <thead>
                                            <tr>
                                                <th>Invoice No</th>
                                                <th>INV DT</th>
                                                <th>Job No</th>
                                                <th>HBL No</th>
                                                <th>Party</th>
                                                <th>Gst no</th>
                                                <th>Inv Type</th>
                                                <th>NON TAXABLE</th>
                                                <th>TOTAL AMT</th>
                                                <th>Taxable Amount 5%</th>
                                                <th>SGST 2.5%</th>
                                                <th>CGST 2.5%</th>
                                                <th>IGST 5%</th>
                                                <th>Taxable Amount 12%</th>
                                                <th>SGST 6%</th>
                                                <th>CGST 6%</th>
                                                <th>IGST 12%</th>
                                                <th>Taxable Amount 18%</th>
                                                <th>SGST 9%</th>
                                                <th>CGST 9%</th>
                                                <th>IGST 18%</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>BSCPL/002/25-26</td>
                                                <td>2025-05-01</td>
                                                <td>SE/BSCPL/2183/2024-25</td>
                                                <td>BSC-2183</td>
                                                <td>JD IMPEX</td>
                                                <td>08ADFPA1334B1ZF</td>
                                                <td>DebitNote(Rs.)</td>
                                                <td>0.00</td>
                                                <td>207669.90</td>
                                                <td>160690.75</td>
                                                <td>4017.27</td>
                                                <td>4017.27</td>
                                                <td>0.00</td>
                                                <td>0.00</td>
                                                <td>0.00</td>
                                                <td>0.00</td>
                                                <td>0.00</td>
                                                <td>46979.15</td>
                                                <td>4228.12</td>
                                                <td>4228.12</td>
                                                <td>0.00</td>
                                            </tr>
                                            
                                            <tr>
                                                <td>BSCPL/003/25-26</td>
                                                <td>2025-05-01</td>
                                                <td>SE/BSCPL/2183/2024-25</td>
                                                <td>BSC-2183</td>
                                                <td>JD IMPEX</td>
                                                <td>08ADFPA1334B1ZF</td>
                                                <td>DebitNote(Rs.)</td>
                                                <td>0.00</td>
                                                <td>207669.90</td>
                                                <td>160690.75</td>
                                                <td>4017.27</td>
                                                <td>4017.27</td>
                                                <td>0.00</td>
                                                <td>0.00</td>
                                                <td>0.00</td>
                                                <td>0.00</td>
                                                <td>0.00</td>
                                                <td>46979.15</td>
                                                <td>4228.12</td>
                                                <td>4228.12</td>
                                                <td>0.00</td>
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
