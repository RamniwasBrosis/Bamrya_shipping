@extends('admin-main.layouts.default')
@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">DSR Report</a></li>
        </ol>
        <!--<a class="text-primary fs-13" href="{{ url('admin/DSRReport/index') }}"><- Go Back</a>-->
    </div>
    
    
    <div class="container-fluid p-2">
        <form id="dsrReport" method="POST">
            @csrf
            <div class="row">
                <div class="col-xl-12 col-xxl-12">
                    <div class="card">
                        <div class="card-header">
                            <!-- Optional Title -->
                        </div>
                        <div class="card-body">
                            <div id="smartwizard" class="form-wizard order-create">
                                <div class="row form-material">
    
                                    <!-- Activity Type -->
                                    <div class="mb-3 col-12 row">
                                        <label class="col-sm-2 col-form-label">Activity Type:</label>
                                        <div class="col-sm-10">
                                            <div class="row gap-3">
                                                <div class="col-sm-2 form-check">
                                                    <input class="form-check-input" type="radio" name="activity_type" checked value="all" id="activity_all">
                                                    <label class="form-check-label" for="activity_all">ALL</label>
                                                </div>
                                                <div class="col-sm-2 form-check">
                                                    <input class="form-check-input" type="radio" name="activity_type" value="AI" id="activity_air_imports">
                                                    <label class="form-check-label" for="activity_air_imports">AIR IMPORTS</label>
                                                </div>
                                                <div class="col-sm-2 form-check">
                                                    <input class="form-check-input" type="radio" name="activity_type" value="AE" id="activity_air_exports">
                                                    <label class="form-check-label" for="activity_air_exports">AIR EXPORTS</label>
                                                </div>
                                                <div class="col-sm-2 form-check">
                                                    <input class="form-check-input" type="radio" name="activity_type" value="SI" id="activity_sea_imports">
                                                    <label class="form-check-label" for="activity_sea_imports">SEA IMPORTS</label>
                                                </div>
                                                <div class="col-sm-2 form-check">
                                                    <input class="form-check-input" type="radio" name="activity_type" value="SE" id="activity_sea_exports">
                                                    <label class="form-check-label" for="activity_sea_exports">SEA EXPORTS</label>
                                                </div>
                                                <!--<div class="col-sm-2 form-check">-->
                                                <!--    <input class="form-check-input" type="radio" name="activity_type" value="TR" id="activity_transport">-->
                                                <!--    <label class="form-check-label" for="activity_transport">TRANSPORT</label>-->
                                                <!--</div>-->
                                            </div>
                                        </div>
                                    </div>
    
                                    <hr>
    
                                    <!-- Party Type -->
                                    <div class="mb-3 col-12 row">
                                        <label class="col-sm-2 col-form-label">Party:</label>
                                        <div class="col-sm-2">
                                            <div class="d-flex gap-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="party_type" value="all" id="party_all">
                                                    <label class="form-check-label" for="party_all">ALL</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4" id="shipper_cont" style="display:none;">
                                            <!--<input class="form-check-input" type="radio" name="party_type" value="shipper" id="party_shipper">-->
                                            <label class="form-check-label" for="party_shipper">Shipper</label>
                                            
                                            <select class="form-control wide me-2 select2 " name="shipper" id="shipper">
                                                <option value="">Select</option>
                                                @foreach ($shipper_parties as $shipper_party)
                                                    <option value="{{$shipper_party->id}}" >
                                                        {{ $shipper_party->party_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-4" id="consignee_cont" style="display:none;">
                                            <!--<input class="form-check-input" type="radio" name="party_type" value="shipper" id="party_shipper">-->
                                            <label class="form-check-label" for="party_shipper">Consignee</label>
                                            
                                            <select class="form-control wide me-2 select2 " name="consignee" id="consignee">
                                                <option value="">Select</option>
                                                @foreach ($consignee_parties as $consignee_party)
                                                    <option value="{{$consignee_party->id}}">
                                                        {{ $consignee_party->party_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Date Range + Dropdown -->
                                    <div class="form-validation">
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="mb-3 row">
                                                    <label class="col-sm-3 col-form-label">From Date:</label>
                                                    <div class="col-sm-9">
                                                        <input type="date" name="from_date" class="form-control" value="{{ date('Y-m-01') }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--<div class="col-xl-6">-->
                                            <!--    <div class="mb-3 row">-->
                                            <!--        <label class="col-sm-3 col-form-label">Select:</label>-->
                                            <!--        <div class="col-sm-9">-->
                                            <!--            <select name="select_option" class="form-control wide me-2">-->
                                            <!--                <option>select</option>-->
                                            <!--                <option value="vessel1">1/S.A.R.L.ART ET ANTIQUITIES</option>-->
                                            <!--                <option value="vessel2">3PEX EXPRESS PVT LTD</option>-->
                                            <!--            </select>-->
                                            <!--        </div>-->
                                            <!--    </div>-->
                                            <!--</div>-->
                                            <div class="col-xl-6">
                                                <div class="mb-3 row">
                                                    <label class="col-sm-3 col-form-label">To Date:</label>
                                                    <div class="col-sm-9">
                                                        <input type="date" value="{{ now()->format('Y-m-d') }}" name="to_date" class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
    
                                    <!-- Submit Button -->
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <button type="submit" class="btn btn-primary btn-sm">SHOW REPORT</button>
                                    </div>
    
                                </div> <!-- End form-material -->
                            </div> <!-- End smartwizard -->
                        </div> <!-- End card-body -->
                    </div>
                </div>
            </div>
    </form>
    </div>

    <div id="reportPreview" class="mt-4 bg-slate-400 p-3 border border-dark" style="display: none;" ></div>
    
    
@endsection
@push('scripts')
    <script>
        $(document).ready(function(){
            
            flatpickr("input[type='date']", {
                altInput: true,
                altFormat: "d/m/Y",   // what user sees
                dateFormat: "Y-m-d",  // what is submitted
                allowInput: true
            });

            $('#dsrReport').on('submit', function(e){
                e.preventDefault();

                var data = $(this).serialize();
                var page = 1;
                
                $.ajax({
                    url: '{{route('dsr-report.preview')}}?page='+ page,
                    type: 'post',
                    data: data,
                    success: function(res){
                        $('#reportPreview').css('display', 'block').html(res.html);
                    },
                    error: function(xhr){
                        alert('An error occurred while fetching data.');
                console.log(xhr.responseText);
                    }
                });
            });
            
            $(document).on('click', '.pagination a', function(e){
                e.preventDefault();
            
                var page = $(this).attr('href').split('page=')[1];
                var formData = $('#dsrReport').serialize();
            
                loadPreview(page, formData);
            });
            
            function loadPreview(page, formData) {
                $.ajax({
                    url: '{{ route('dsr-report.preview') }}?page=' + page,
                    type: 'post',
                    data: formData,
                    success: function(res){
                        $('#reportPreview').css('display', 'block').html(res.html);
                    },
                    error: function(xhr){
                alert('An error occurred while fetching data.');
                console.log(xhr.responseText);
                    }
                });
            }
            
            $('.select2').select2({
                width: '100%'
            })
            
            
            
            $('input[name="activity_type"]').on('change', function () {
                let activityType = $(this).val();
        
                if (activityType === 'all') {
                    $('#shipper_cont').hide();
                    $('#consignee_cont').hide();
        
                    // Optional: reset selected values
                    $('#shipper').val(null).trigger('change');
                    $('#consignee').val(null).trigger('change');
                } else {
                    $('#shipper_cont').show();
                    $('#consignee_cont').show();
                }
            });
            
        });
    </script>
@endpush
