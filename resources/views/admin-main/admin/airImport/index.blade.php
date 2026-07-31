@extends('admin-main.layouts.default')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li><h5 class="bc-title">Manage AIR IMPORT BL</h5></li>
    </ol>
    <a class="text-primary fs-13" href="{{url('admin/air-imports/create')}}">+ Add MAWB</a>
</div>
<div class="container-fluid p-2">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header py-3 d-sm-flex d-block">
                    <h4 class="card-title mb-2">MAWB DETAILS</h4>
                </div>
                <div class="card-header d-block pb-2">
                    <form class="row align-items-end" method="get" action="{{route('air-imports.index')}}">

                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Search By Job No.</label>
                            <select id="" class="form-control  select2" name="job_no">
                                <option value="">select</option>
                                @foreach ($airImports as $airImport)
                                    <option value="{{$airImport->job_no}}">{{$airImport->jobMaster->job_no ?? ''}}</option>
                                @endforeach
                            </select>
                        </div>

                        <!--<div class="col-xl-2 col-sm-6 col-lg-4 mb-3">-->
                        <!--    <label class="form-label">Search By Booking No.</label>-->
                        <!--    <select id="" class="form-control  select2" name="booking_no">-->
                        <!--        <option value="">select</option>-->
                        <!--        @foreach ($airImports as $airImport)-->
                        <!--            <option value="{{$airImport->booking_no}}">{{$airImport->booking_no ?? ''}}</option>-->
                        <!--        @endforeach-->
                        <!--    </select>-->
                        <!--</div>-->

                        <!--<div class="col-xl-2 col-sm-6 col-lg-4 mb-3">-->
                        <!--    <label class="form-label">Search By MBL No.</label>-->
                        <!--    <select id="" class="form-control  select2" name="hbl_no">-->
                        <!--        <option value="">select</option> -->
                        <!--        @foreach ($airImports as $airImport)-->
                        <!--            <option value="{{$airImport->hbl_no}}">{{$airImport->hbl_no ?? ''}}</option>-->
                        <!--        @endforeach -->
                        <!--    </select>-->
                        <!--</div>-->

                        <!--<div class="col-xl-2 col-sm-6 col-lg-4 mb-3">-->
                        <!--    <label class="form-label">Search By HBL No.</label>-->
                        <!--    <select id="departmentFilter" class="form-control select2" name="hbl_no">-->
                        <!--        <option value="">select</option> -->
                        <!--        @foreach ($airImports as $airImport)-->
                        <!--            <option value="{{$airImport->hbl_no}}">{{$airImport->hbl_no ?? ''}}</option>-->
                        <!--        @endforeach                              -->
                        <!--    </select>-->
                        <!--</div>  -->

                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Search By Consignee Party.</label>
                            <select id="" class="form-control  select2" name="consignee_id">
                                <option value="">select</option>
                                @foreach ($airImports as $airImport)
                                    <option value="{{$airImport->consignee_id}}">{{$airImport->ConsigneeName->party_name ?? ''}}</option>
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
                            <a href="{{route('air-imports.index')}}" class="btn btn-danger light ms-2" type="button">Reset</a>
                        </div>
                    </form>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive active-projects style-1">
                        <table id="empoloyees-tblwrapper" class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Job No</th>
                                    <th>Booking No</th>
                                    <th>Consignee Party</th>
                                    <th>Packages</th>
                                    <th>Chargeable Weight</th>
                                    <th>Invoice No</th>
                                    <th>AWB No</th>
                                    <th>Flight Status</th>
                                    <th>Check List</th>
                                    <th>BOE</th>
                                    <th>Out Of Charge</th>
                                    <th>Arrival Date</th>
                                    <th>Updated By</th>
                                    <th>Branch</th>
                                    <th>Documents</th>

                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($airImports as $airImport)
                                    @php
                                        switch($airImport->shipment){
                                            case 1:
                                                $shipment_type = 'Total';
                                                break;
                                            case 2:
                                                $shipment_type = 'Part';
                                                break;
                                            case 3:
                                                $shipment_type = 'Split';
                                                break;
                                            default:
                                                $shipment_type = '';
                                        }

                                    @endphp
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$airImport->jobMaster->job_no ?? 'N/A'}}</td>
                                        <td>{{$airImport->booking_no ?? 'N/A'}}</td>
                                        <td>{{$airImport->ConsigneeName->party_name ?? 'N/A'}}</td>
                                        <td>{{$airImport->package ?? 'N/A'}}</td>
                                        <td>{{$airImport->chargable_weight ?? 'N/A'}}</td>

                                        <td>{{$airImport->customer_inv_no ?? 'N/A'}}</td>
                                        <td>{{$airImport->mawb_no ?? 'N/A'}}</td>
                                        <td>
                                            <span class="flight-status short-text">
                                                {{ Str::limit($airImport->flight_status, 15, '...') }}
                                            </span>

                                            <span class="flight-status full-text d-none">
                                                {{ $airImport->flight_status }}
                                            </span>

                                            @if(strlen($airImport->flight_status ?? '') > 15)
                                                <a href="javascript:void(0)" class="toggle-flight-status">
                                                    More
                                                </a>
                                            @endif
                                        </td>
                                        <td>{{$airImport->check_list_date ?? 'N/A'}}</td>
                                        <td>{{$airImport->bill_of_entry_date ?? 'N/A'}}</td>
                                        <td>{{$airImport->out_off_charge_date ?? 'N/A'}}</td>
                                        <td>{{$airImport->arrival_date ?? 'N/A'}}</td>
                                        <td>{{$airImport->user->name ?? '-'}}</td>
                                        <td>{{$airImport->branch->branch_name ?? '-'}}</td>
                                        <td>
                                            @if(in_array($airImport->job_no, $uploadedJobs))
                                                Yes
                                            @else
                                                No
                                            @endif
                                        </td>
                                        <td>
                                            @if($airImport->jobMaster->job_status == 'O')
                                                <a class="badge badge-info light border-0" href="{{url('admin/air-imports/'.$airImport->uuid.'/edit')}}">Edit</a>
                                                <a class="badge badge-danger light border-0 delete-air-import" href="javascript:void(0);" data-id="{{$airImport->id}}">Delete</a>
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
                        {!! $airImports->links('pagination::bootstrap-5') !!}
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
        $(document).on('click', '.delete-air-import', function(e) {
            e.preventDefault();
            if (!confirm('Are you sure you want to delete this Air Import?')) return;

            const airExportId = $(this).data('id');

            $.ajax({
                url: '/admin/air-imports/' + airExportId,
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
                url: "{{ route('air-imports.chargableWeightTotal') }}",
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

                    alert('Error fetching gross weight total');

                }
            });

        });
    </script>

@endpush
