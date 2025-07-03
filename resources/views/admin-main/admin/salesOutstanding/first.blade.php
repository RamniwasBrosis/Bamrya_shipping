@extends('admin-main.layouts.default')
@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li>
                <h5 class="bc-title">Sales Outstanding Report</h5>
            </li>
        </ol>
        <!--<a class="text-primary fs-13" href="{{ url('admin/SalesOutstanding/index') }}">Go List -></a>-->
    </div>
    <div class="container-fluid p-2">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-validation">
                            @php
                                $fromDate = \Carbon\Carbon::now()->startOfMonth()->format('Y-m-d'); // 01-06-2025
                                $toDate = \Carbon\Carbon::now()->format('Y-m-d'); // 26-06-2025
                            @endphp
                            <form class="needs-validation" method="POST" id="loadingList" novalidate>
                                @csrf
                                <div class="row">
                                    {{-- From Date --}}
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">From Date:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <input type="date" name="from_date" class="form-control"  value="{{ $fromDate }}" required>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- To Date --}}
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">To Date:</label>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <input type="date" name="to_date" class="form-control"  value="{{ $toDate }}" required>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Party Wise --}}
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <div class="form-check col-sm-3 d-flex align-items-center">
                                                <input class="form-check-input" type="checkbox" id="partyWiseCheckbox">
                                                <label class="form-check-label" for="partyWiseCheckbox">
                                                    Party Wise:
                                                </label>
                                            </div>
                                            <div class="col-sm-9 d-flex align-items-center">
                                                <select name="party_id" class="form-control wide me-2" id="partySelect" disabled>
                                                    <option value="">-- Select Party --</option>
                                                    @foreach ($parties as $party)
                                                        <option value="{{$party->id}}">{{$party->party_name}}</option>
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
                        
                        <div id="reportPreview" class="mt-5 border border-dark p-4" style="display: none;">
                      
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
    <script>
        document.getElementById('partyWiseCheckbox').addEventListener('change', function () {
            document.getElementById('partySelect').disabled = !this.checked;
        });

        $(document).ready(function(){

            function fetchPage(page = 1) {
                var data = $('#loadingList').serialize();

                $.ajax({
                    url: '{{ route("sales-outstanding.preview") }}?page=' + page,
                    type: 'POST',
                    data: data,
                    success: function(res) {
                        $('#reportPreview').css('display', 'block').html(res.html);
                    },
                    error: function(xhr) {
                        alert('An error occurred while fetching data.');
                        console.log(xhr.responseText);
                    }
                });
            }

            // Form submit
            $('#loadingList').on('submit', function(e){
                e.preventDefault();
                fetchPage(1); // Always go to first page on new search
            });

            // Pagination click (dynamically bind using .on)
            $(document).on('click', '.pagination a', function(e){
                e.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                fetchPage(page);
            });

        });

    </script>
@endpush
