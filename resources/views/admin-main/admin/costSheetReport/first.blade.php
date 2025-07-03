@extends('admin-main.layouts.default')
@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="#">COSTSHEET Report : Job No :</a></li>
        </ol>
        <a href="{{ url('/admin/SalesInvoice') }}" class="text-primary">Go -></a>
    </div>
    <div class="container-fluid p-2">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
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
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="TR" name="search_by">
                                        <label class="form-check-label" for="air">
                                            Transport
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="form-validation">
                            <form method="POST" id="costSheetForm">
                                @csrf                                
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Job No:<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="job_no" id="option" required>
                                            <option value="">-- Select Job No --</option>
                                        </select>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary btn-sm">Generate Report</button>
                            </form>

                            <div id="costSheetResult" class="mt-4"></div>

                        </div>
                    </div>
                </div>                
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        $(document).ready(function(){
            $('#costSheetForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: '{{ route("cost-sheet-report.preview") }}',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#costSheetResult').html(response.html);
                    },
                    error: function(err) {
                        alert('Something went wrong.');
                    }
                });
            });

            $('input[name="search_by"]').on('change', function() {
                $('#searchForm').submit();
            });

            $('#searchForm').on('submit', function(e){
                e.preventDefault(); // prevent default form submission
                var data = $(this).serialize();

                $.ajax({
                    url : '{{ route('sales-invoices.getJobNo') }}',
                    type : 'POST',
                    data : data,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success : function(res){
                        if(res.status === 'success'){                         
                            $('#option').html(res.result);
                            $('input[name="Inv_cat"]').val(res.Inv_cat);
                        }
                    },
                    error: function(xhr){
                        console.log('Error:', xhr.responseText);
                    }
                });
            });
        });
    </script>
@endpush