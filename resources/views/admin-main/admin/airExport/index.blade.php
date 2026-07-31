@extends('admin-main.layouts.default')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li><h5 class="bc-title">MANAGE AIR EXPORT BL</h5></li>
    </ol>
    <a class="text-primary fs-13" href="{{url('admin/air-exports/create')}}">+ Add EXPORT AIR BL</a>
</div>
<div class="container-fluid p-2">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header py-3 d-sm-flex d-block">
                    <h4 class="card-title mb-2">EXPORT AIR BL DETAILS</h4>
                </div>
                <div class="card-header d-block pb-2">
                    <form class="row align-items-end" method="get" action="{{route('air-exports.index')}}">
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Search By Job No. </label>
                            <select id="statusFilter" class="form-control  select2" name="job_no">
                                <option value="">select</option>
                                @foreach ($filter_records as $filter_record)
                                    <option value="{{$filter_record->job_no}}">{{$filter_record->jobMaster->job_no ?? ''}}</option>
                                @endforeach
                            </select>
                        </div>
                        <!--<div class="col-xl-2 col-sm-6 col-lg-4 mb-3">-->
                        <!--    <label class="form-label">Search By Booking No.</label>-->
                        <!--    <select id="" class="form-control  select2" name="booking_no">-->
                        <!--        <option value="">select</option>-->
                        <!--        @foreach ($filter_records as $filter_record)-->
                        <!--            <option value="{{$filter_record->booking_no}}">{{$filter_record->booking_no ?? ''}}</option>-->
                        <!--        @endforeach-->
                        <!--    </select>-->
                        <!--</div>-->

                        <!--<div class="col-xl-2 col-sm-6 col-lg-4 mb-3">-->
                        <!--    <label class="form-label">Search By MAWB No.</label>-->
                        <!--    <select id="departmentFilter" class="form-control  select2" name="mawb_no">-->
                        <!--        <option value="">select</option>-->
                        <!--        @foreach ($filter_records as $filter_record)-->
                        <!--            <option value="{{$filter_record->mawb_no}}">{{$filter_record->mawb_no ?? ''}}</option>-->
                        <!--        @endforeach-->
                        <!--    </select>-->
                        <!--</div>-->
                        <!--<div class="col-xl-2 col-sm-6 col-lg-4 mb-3">-->
                        <!--    <label class="form-label">Search By HAWB No.</label>-->
                        <!--    <select id="genderFilter" class="form-control  select2"  name="hawb_no">-->
                        <!--        <option value="">select</option>-->
                        <!--        @foreach ($filter_records as $filter_record)-->
                        <!--            <option value="{{$filter_record->hawb_no}}">{{$filter_record->hawb_no ?? ''}}</option>-->
                        <!--        @endforeach-->
                        <!--    </select>-->
                        <!--</div>-->
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Search By Shipper Party. </label>
                            <select id="" class="form-control  select2" name="shipper_id">
                                <option value="">select</option>
                                @foreach ($filter_records as $filter_record)
                                    <option value="{{$filter_record->shipper_id}}">{{$filter_record->shipperName->party_name ?? ''}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Start Date</label>
                            <input type="date" placeholder="dd/mm/yy" class="form-control" name="start_date" value="{{ request('start_date') }}">
                        </div>

                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">End Date</label>
                            <input type="date" placeholder="dd/mm/yy" class="form-control" name="end_date" value="{{ request('end_date') }}">
                        </div>
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <button id="applyFilter" class="btn btn-primary" type="submit">Apply</button>
                            <a href="{{route('air-exports.index')}}" id="resetFilter" class="btn btn-danger light ms-2" type="button">Reset</a>
                        </div>
                    </form>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive active-projects style-1">
                        <table id="empoloyees-tblwrapper" class="table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Job No</th>
                                    <th>Booking No</th>
                                    <th>Shipper Name</th>

                                    <th>Packages</th>
                                    <th>Chargeable weight</th>

                                    <th>Invoice</th>
                                    <th>AWB No</th>
                                    <th>Flight Status</th>
                                    <th>Check List</th>
                                    <th>Carting Date</th>
                                    <th>S Bill No/Dt</th>
                                    <th>LEO</th>
                                    <th>Updated By</th>
                                    <th>Branch</th>
                                    <th>Documents</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($air_exports as $air_export)

                                    <tr>
                                        <td>{{ $loop->iteration}}</td>
                                        <td>{{ $air_export->jobMaster?->job_no ?? ''}}</td>
                                        <td>{{$air_export->booking_no ?? ''}}</td>
                                        <td>{{$air_export->shipperName->party_name ?? 'N/A'}}</td>
                                        <td>{{$air_export->package ?? ''}}</td>
                                        <td>{{$air_export->chargable_weight ?? ''}}</td>

                                        <td>{{$air_export->customer_inv_no ?? ''}}</td>
                                        <td>{{$air_export->mawb_no ?? ''}}</td>
                                        <td>
                                            <span class="flight-status short-text">
                                                {{ Str::limit($air_export->flight_status, 15, '...') }}
                                            </span>

                                            <span class="flight-status full-text d-none">
                                                {{ $air_export->flight_status }}
                                            </span>

                                            @if(strlen($air_export->flight_status ?? '') > 15)
                                                <a href="javascript:void(0)" class="toggle-flight-status">
                                                    More
                                                </a>
                                            @endif
                                        </td>
                                        <td>{{$air_export->check_list_date ?? ''}}</td>
                                        <td>{{$air_export->cartining_date ?? ''}}</td>
                                        <td>{{$air_export->sbill_no ?? ''}}</td>
                                        <td>{{$air_export->leo_date ?? ''}}</td>
                                        <td>{{$air_export->user->name ?? ''}}</td>
                                        <td>{{$air_export->branch->branch_name ?? '-'}}</td>
                                        <td>
                                            @if(in_array($air_export->job_no, $uploadedJobs))
                                                Yes
                                            @else
                                                No
                                            @endif
                                        </td>

                                        <td>
                                            @if($air_export->jobMaster->job_status == 'O')
                                                <a class="badge badge-info light border-0" href="{{url('admin/air-exports/'.$air_export->uuid.'/edit')}}">Edit</a>
                                                <a class="badge badge-danger light border-0 delete-air-export" href="javascript:void(0);" data-id="{{$air_export->id}}">Delete</a>
                                            @else
                                                <span class="btn btn-sm btn-danger">Closed</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        {!! $air_exports->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-3">
                                <label>Start Date</label>
                                <input type="date" id="start_date" class="form-control">
                            </div>

                            <div class="col-md-3">
                                <label>End Date</label>
                                <input type="date" id="end_date" class="form-control">
                            </div>

                            <div class="col-md-2">
                                <label>&nbsp;</label>
                                <button id="showChargableWeight"
                                    class="btn btn-primary form-control">
                                    Show
                                </button>
                            </div>

                        </div>

                        <hr>

                        <h5>
                            Total Cargo Weight:
                            <span id="chargableWeightTotal">0</span>
                        </h5>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
    <script>
        $(document).on('click', '.toggle-flight-status', function () {

            let td = $(this).closest('td');

            td.find('.short-text').toggleClass('d-none');
            td.find('.full-text').toggleClass('d-none');

            if ($(this).text() === 'Show More') {
                $(this).text('Show More');
            } else {
                $(this).text('Show Less');
            }
        });
    </script>
    <script>
        $(document).on('click', '.delete-air-export', function(e) {
            e.preventDefault();
            if (!confirm('Are you sure you want to delete this Air Export?')) return;

            const airExportId = $(this).data('id');

            $.ajax({
                url: '/admin/air-exports/' + airExportId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    location.reload();
                },
                error: function(xhr) {
                    let errorMessage = 'An error occurred.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    } else if (xhr.responseText) {
                        errorMessage = xhr.responseText;
                    }
                }
            });
        });

        $(document).ready(function() {
            $('.select2').select2({
                placeholder: 'Select a value',
                'allowClear': true,
                width: '100%'
            })
        })

    </script>
    <!--get the sum of the gross weight -->
    <script>
        $('#showChargableWeight').on('click', function() {

            let startDate = $('#start_date').val();
            let endDate = $('#end_date').val();

            $.ajax({
                url: "{{ route('air-exports.chargableWeightTotal') }}",
                type: "POST",

                data: {
                    _token: "{{ csrf_token() }}",
                    start_date: startDate,
                    end_date: endDate
                },

                success: function(response) {

                    $('#chargableWeightTotal').text(response.total+' kg');

                },

                error: function() {

                    alert('Error fetching weight total');

                }
            });

        });
    </script>
@endpush
