@extends('admin-main.layouts.default')
@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li>
                <h5 class="bc-title">Add New Job Open CLose</h5>
            </li>
        </ol>
        <a class="text-primary fs-13" href="{{ route('job-open-close.create') }}"><- Close Jobs</a>
    </div>
    <div class="container-fluid p-2">
        <div class="row">
            <div class="col-xl-6 col-xxl-12">
                <form method="POST" id="searchForm">
                    @csrf
                    <div class="mb-6 row">
                        <div class="d-flex gap-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="AI" name="search_by">
                                <label class="form-check-label" for="lcl">
                                    Air Import
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="AE" name="search_by">
                                <label class="form-check-label" for="fcl20">
                                    Air Export
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="SI" name="search_by">
                                <label class="form-check-label" for="fcl40">
                                    Sea Import
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="SE" name="search_by">
                                <label class="form-check-label" for="air">
                                    Sea Export
                                </label>
                            </div>
                        </div>
                    </div>
                </form>
                
                <hr>
                <form method="post" id="filter_record">
                    @csrf
                    <div class="row d-flex">
                        <div class="mb-6 col-sm-5">
                            <label class="col-sm-3 col-form-label">Full Job No:</label>
                            <div class="col-sm-9">
                                <div class="d-flex align-items-center">
                                    <select class="form-control me-2" id="full_job_nums" name="job_no">
                                        <option value="">select</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 col-sm-5">
                            <label class="col-sm-3 col-form-label">Party Name :</label>
                            <div class="col-sm-9 d-flex align-items-center">
                                <select class="form-control me-2" id="job_party_id" name="job_party_id">
                                    <option value="">select</option>
                                </select>                                
                            </div>                            
                        </div>      
                        <div class="col-md-2 mb-3 d-flex align-items-center justify-content-center">
                            <button type="submit" class="btn btn-sm btn-outline-primary w-100">
                                <i class="bi bi-search me-1"></i> Search
                            </button>
                            <button type="button" id="resetFilter" class="btn btn-sm btn-secondary w-100 ms-2">
                                <i class="bi bi-x-circle me-1"></i> Reset
                            </button>
                        </div>     
                        <br>                        
                    </div>                    
                </form>
                               
            </div>
        </div>


        <form action="{{ route('job-open-close.bulkUpdate') }}" method="POST">
            @csrf
            <div>
                <div class="mb-3 row d-flex">
                    <label class="col-sm-3 col-form-label">JOB STATUS:</label>
                    <div class="col-sm-9 d-flex align-items-center">
                        <select class="default-select form-control wide me-2" name="job_status">
                            <option value="">Select</option>
                            <option value="O">Open</option>
                            <option value="C">Close</option>
                        </select>
                        <button type="submit" class="btn btn-primary btn-sm">UPDATE</button><br>
                    </div>                            
                </div>            
            </div> 


            <div class="card-body p-0">
                <div class="table-responsive active-projects style-1">
                    <table id="empoloyees-tblwrapper" class="table">
                        <thead>
                            <tr>
                                <th>Select All</th>
                                <th>Job No</th>
                                <th>Party Name</th>
                                <th>Date</th>
                                <th>Activity</th>
                                <th>Open/Close</th>
                            </tr>
                        </thead>
                        <tbody id="table">
                                            
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function(){
            $('input[name="search_by"]').on('change', function() {
                $('#searchForm').submit();
            });

            $('#searchForm').on('submit', function(e){
                e.preventDefault(); // prevent default form submission
                var data = $(this).serialize();

                $.ajax({
                    url : '{{ route('job-open-close.store') }}',
                    type : 'POST',
                    data : data,
                    success : function(res){
                        if(res.status === 'success'){
                            $('#table').html(res.result);
                            $('#full_job_nums').html(res.full_job_nums);
                            $('#job_party_id').html(res.party_name);
                        }
                    },
                    error: function(xhr){
                        console.log('Error:', xhr.responseText);
                    }
                });
            });

            $('#filter_record').on('submit', function(e){
                e.preventDefault();

                var data = $(this).serialize();

                $.ajax({
                    url : '{{ route("job-open-close.filter") }}',
                    type : 'POST',
                    data : data,
                    success : function(res){
                        if(res.status === 'success'){
                            $('#table').html(res.result);
                        }
                    },
                    error: function(xhr){
                        console.log('Error:', xhr.responseText);
                    }
                });
            });

            $('#resetFilter').on('click', function () {
                // Reset form fields
                $('#filter_record')[0].reset();

                // Clear select options (if you want to reset dropdowns manually)
                $('#full_job_nums').val('');
                $('#job_party_id').val('');

                // Trigger AJAX to reload all data
                $.ajax({
                    url: '{{ route("job-open-close.store") }}', // Same as initial load
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}', // CSRF token for POST
                        search_by: $('input[name="search_by"]:checked').val() || 'AI' // fallback to AI
                    },
                    success: function (res) {
                        if (res.status === 'success') {
                            $('#table').html(res.result);
                            $('#full_job_nums').html(res.full_job_nums);
                            $('#job_party_id').html(res.party_name);
                        }
                    },
                    error: function (xhr) {
                        console.log('Error:', xhr.responseText);
                    }
                });
            });


        });
    </script>

@endpush