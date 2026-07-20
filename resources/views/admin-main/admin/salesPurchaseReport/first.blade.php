@extends('admin-main.layouts.default')
@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li><h5 class="bc-title">Sales/Purchase Report</h5></li>
        </ol>  
    </div>
    <div class="container-fluid p-2">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-validation">
                            @php
                                $fromDate = \Carbon\Carbon::now()->startOfMonth()->format('Y-m-d');
                                $toDate = \Carbon\Carbon::now()->format('Y-m-d');
                            @endphp
                            <form action="{{ route('sale-purchase-report.preview') }}"
                                  method="POST"
                                  id="loadingList"
                                  class="needs-validation"
                                  novalidate>
                                @csrf
                                <div class="row">
                                    {{-- From Date --}}
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">From Date:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <input type="date" name="from_date" class="form-control" value="{{ $fromDate }}" required>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- To Date --}}
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">To Date:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <input type="date" name="to_date" class="form-control" value="{{ $toDate }}" required>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Job No (optional) --}}
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Job No:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select name="full_job_no" class="form-control select2">
                                                    <option value="">-- All Jobs --</option>
                                                    @foreach($jobs as $job)
                                                        <option value="{{ $job->full_job_no }}">{{ $job->full_job_no }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Submit Button --}}
                                    <div class="">
                                        <button class="btn btn-primary" type="submit">PREVIEW</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div id="reportPreview" class="mt-5 border border-dark p-4" style="display: none;"></div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.select2').select2({ width: '100%' });
        });

        (function() {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
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
        })();

        $(document).ready(function(){
            function fetchPage(page = 1) {
                $.ajax({
                    url: "{{ route('sale-purchase-report.preview') }}?page=" + page,
                    type: "POST",
                    data: $("#loadingList").serialize(),
                    success: function(response){
                        $("#reportPreview").show().html(response.html);
                    },
                    error: function(xhr){
                        console.log(xhr.responseText);
                    }
                });
            }

            $("#loadingList").submit(function(e){
                e.preventDefault();
                fetchPage();
            });

            $(document).on("click", ".pagination a", function(e){
                e.preventDefault();
                fetchPage($(this).attr("href").split("page=")[1]);
            });
        });
    </script>
@endpush