@extends('admin-main.layouts.default')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li><h5 class="bc-title">MANAGE SEA EXPORT BL</h5></li>
    </ol>
    <a class="text-primary fs-13" href="{{url('admin/sea-exports/create')}}">+ Add Export BL</a>
</div>
<div class="container-fluid p-2">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header py-3 d-sm-flex d-block">
                    {{-- <h4 class="card-title mb-2">Packages</h4> --}}
                </div>
                <div class="card-header d-block pb-2">
                    <form class="row align-items-end" method="GET" action="{{route('sea-exports.index')}}">
                        <!-- Full Job No -->
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Search By Full Job No.</label>
                            <select name="full_job_no" class="form-control select2">
                                <option value="">select</option>
                                @foreach ($full_job_nums as $num)
                                    <option value="{{ $num }}" {{ request('full_job_no') == $num ? 'selected' : '' }}>{{ $num }}</option>
                                @endforeach
                            </select>
                        </div>
                    
                        <!-- Job No -->
                        <!--<div class="col-xl-2 col-sm-6 col-lg-4 mb-3">-->
                        <!--    <label class="form-label">Search By Job No.</label>-->
                        <!--    <select name="job_no" class="form-control default-select">-->
                        <!--        <option value="">select</option>-->
                        <!--        @foreach ($job_nums as $num)-->
                        <!--            <option value="{{ $num->jobMaster->id }}" {{ request('job_no') == $num ? 'selected' : '' }}>{{ $num->jobMaster->job_no }}</option>-->
                        <!--        @endforeach-->
                        <!--    </select>-->
                        <!--</div>-->
                    
                        <!-- Booking No -->
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Search By Booking No.</label>
                            <select name="booking_no" class="form-control select2">
                                <option value="">select</option>
                                @foreach ($booking_nums as $num)
                                    <option value="{{ $num }}" {{ request('booking_no') == $num ? 'selected' : '' }}>{{ $num }}</option>
                                @endforeach
                            </select>
                        </div>
                    
                        <!-- Shipper Name -->
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Search By Shipper Name.</label>
                            <select name="shipper_id" class="form-control select2">
                                <option value="">select</option>
                                @foreach ($shipperNames as $shipper)
                                    <option value="{{ $shipper->id }}" {{ request('shipper_id') == $shipper->id ? 'selected' : '' }}>
                                        {{ $shipper->party_name }}
                                    </option>
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
                    
                        <!-- Apply & Reset Buttons -->
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <button class="btn btn-primary" type="submit">Apply</button>
                            <a href="{{ route('sea-exports.index') }}" class="btn btn-danger light ms-2">Reset</a>
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
                                    <th>Consignee Name</th>
                                    <th>Booking No</th>
                                    <th>CBM</th>
                                    
                                    <th>Invoice</th>
                                    <th>Check List</th>
                                    <th>S Bill No/Dt</th>
                                    <th>LEO</th>
                                    <th>SOB Date</th>
                                    <th>Updated By</th>
                                    <th>Documents</th>
                                   
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1; @endphp
                                
                                @foreach ($sea_exports as $sea_export)
                                
                                    {{-- CASE 1: Containers exist --}}
                                    @if ($sea_export->container->count() > 0)
                                
                                        @foreach ($sea_export->container as $cont)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $sea_export->jobMaster->job_no ?? 'N/A' }}</td>
                                                <td>{{ $sea_export->shipperName->party_name ?? 'N/A' }}</td>
                                                <td>{{ $sea_export->booking_no ?? 'N/A' }}</td>
                                                <td>{{ $cont->cbm ?? 'N/A' }}</td>
                                                <td>{{ $cont->customer_inv_no ?? 'N/A' }}</td>
                                                <td>{{ $cont->check_list_date ?? 'N/A' }}</td>
                                                <td>{{ $cont->sbill_no ?? 'N/A' }}</td>
                                                <td>{{ $cont->leo_date ?? 'N/A' }}</td>
                                                <td>{{ $cont->sob_date ?? 'N/A' }}</td>
                                                <td>{{ $sea_export->user->name ?? '' }}</td>
                                                <td>
                                                    @if(in_array($sea_export->job_no, $uploadedJobs))
                                                        Yes
                                                    @else
                                                        No
                                                    @endif
                                                </td>
                                                <td>
                                                    <a class="badge badge-info light border-0"
                                                       href="{{ url('admin/sea-exports/'.$sea_export->uuid.'/edit') }}">
                                                        Edit
                                                    </a>
                                                    <a class="badge badge-danger light border-0 delete-sea-export"
                                                       href="javascript:void(0);"
                                                       data-id="{{ $sea_export->id }}">
                                                        Delete
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                
                                    {{-- CASE 2: NO container --}}
                                    @else
                                
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $sea_export->jobMaster->job_no ?? 'N/A' }}</td>
                                            <td>{{ $sea_export->shipperName->party_name ?? 'N/A' }}</td>
                                            <td>{{ $sea_export->booking_no ?? 'N/A' }}</td>
                                            <td colspan="8" class="text-center text-muted">
                                                No container added
                                            </td>
                                            <td>
                                                @if($sea_export->jobMaster->job_status == 'O')
                                                    <a class="badge badge-info light border-0"
                                                       href="{{ url('admin/sea-exports/'.$sea_export->uuid.'/edit') }}">
                                                        Edit
                                                    </a>
                                                    <a class="badge badge-danger light border-0 delete-sea-export"
                                                       href="javascript:void(0);"
                                                       data-id="{{ $sea_export->id }}">
                                                        Delete
                                                    </a>
                                                @else
                                                    <span class="btn btn-sm btn-danger">Closed</span>
                                                @endif
                                            </td>
                                        </tr>
                                
                                    @endif
                                
                                @endforeach
                                </tbody>

                        </table>
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        {{ $sea_exports->links('pagination::bootstrap-5') }}
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
                                <button id="showGrossWeight"
                                    class="btn btn-primary form-control">
                                    Show
                                </button>
                            </div>
                
                        </div>
                
                        <hr>
                
                        <h5>
                            Total Gross Weight:
                            <span id="grossWeightTotal">0</span>
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
        $('.select2').select2({
            'width' : '100%'
        })
    
        $(document).on('click', '.delete-sea-export', function(e) {
            e.preventDefault();
            if (!confirm('Are you sure you want to delete this Sea Export record?')) return;

            const seaExportId = $(this).data('id');

            $.ajax({
                url: '/admin/sea-exports/' + seaExportId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert('Sea Export record deleted successfully.');
                    location.reload();
                },
                error: function(xhr) {
                $('.error-text').text(''); // Clear all error texts

                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                } else {
                    alert(xhr.responseJSON.message ?? 'Unknown error occurred.');
                }
            }
            });
        });
    </script>
    <!--get the sum of the gross weight -->
    <script>
        $('#showGrossWeight').on('click', function() {
    
            let startDate = $('#start_date').val();
            let endDate = $('#end_date').val();
        
            $.ajax({
                url: "{{ route('sea-exports.grossWeightTotal') }}",
                type: "POST",
        
                data: {
                    _token: "{{ csrf_token() }}",
                    start_date: startDate,
                    end_date: endDate
                },
        
                success: function(response) {
        
                    $('#grossWeightTotal').text(response.total+' kg');
        
                },
        
                error: function() {
        
                    alert('Error fetching gross weight total');
        
                }
            });
        
        });
    </script>

@endpush