@extends('admin-main.layouts.default')
@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li>
                <h5 class="bc-title">GST Report</h5>
            </li>
        </ol>
        <!--<a class="text-primary fs-13" href="{{ url('admin/GstPayableReport/index') }}">Go List -></a>-->
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
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <button class="btn btn-primary" type="button">Preview</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                        <div class="col-xl-12 active-p">
                        <div class="card">
                            <div class="card-body p-0">
                                <div class="table-responsive active-projects shorting">
            
                                    <div class="tbl-caption">
                                        <h4 class="heading mb-0">Sales Invoice Register</h4>
                                    </div>
                                    <table id="projects-tblss" class="table ItemsCheckboxSec">
                                        <thead>
                                            <tr>
                                                <th>JOBNO</th>
                                                <th>JOB DT</th>
                                                <th>NON TAXABLE</th>
                                                <th>TAXABLE AMT</th>
                                                <th>SGST 2.5%</th>
                                                <th>CGST 2.5%</th>
                                                <th>IGST 5%</th>
                                                <th>SGST 6%</th>
                                                <th>CGST 6%</th>
                                                <th>IGST 12%</th>
                                                <th>SGST 9%</th>
                                                <th>CGST 9%</th>
                                                <th>IGST 18%</th>
                                                <th>TOTAL AMT</th>
                                                <th>NON TAXABLE AMT</th>
                                                <th>AMOUNT</th>
                                                <th>SGST(2.5%)</th>
                                                <th>CGST(2.5%)</th>
                                                <th>IGST(5%)</th>
                                                <th>SGST (6%)</th>
                                                <th>CGST(6%)</th>
                                                <th>IGST(12%)</th>
                                                <th>SGST (9%)</th>
                                                <th>CGST (9%)</th>
                                                <th>IGST (18%)</th>
                                                <th>TOTAL AMT</th>
                                                <th>CGST 2.5%</th>
                                                <th>SGST 2.5%</th>
                                                <th>IGST 5%</th>
                                                <th>CGST 6%</th>
                                                <th>SGST 6%</th>
                                                <th>IGST 12%</th>
                                                <th>CGST 9%</th>
                                                <th>SGST 9%</th>
                                                <th>IGST 18%</th>
                                                <th>GST PAYABLE</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>HCM/0001/MAY/2025-26</td>
                                                <td></td>
                                                <td>0.00</td>
                                                <td>0.00</td>
                                                <td>0.00</td>
                                                <td>0.00</td>
                                                <td>0.00</td>
                                                <td>0.00</td>
                                                <td>0.00</td>
                                                <td>0.00</td>
                                                <td>0.00</td>
                                                <td>0.00</td>
                                                <td>0.00</td>
                                                <td>0.00</td>
                                                <td>0.00</td>
                                                <td>0.00</td>
                                                <td>0.00</td>
                                                <td>0.00</td>
                                                <td>0.00</td>
                                                <td>0.00</td>
                                                <td>0.00</td>
                                                <td>0.00</td>
                                                <td>0.00</td>
                                                <td>0.00</td>
                                                <td>0.00</td>
                                                <td>0.00</td>
                                                <td>0.00</td>
                                                <td>0.00</td>
                                                <td>0.00</td>
                                                <td>0.00</td>
                                                <td>0.00</td>
                                                <td>0.00</td>
                                                <td>0.00</td>
                                                <td>0.00</td>
                                                <td>0.00</td>
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
