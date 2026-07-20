@extends('admin-main.layouts.default')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li><h5 class="bc-title">MANAGE SEA IMPORT BL</h5></li>
    </ol>
    <a class="text-primary fs-13" href="{{url('admin/sea-imports/create')}}">+ Add Sea Import</a>
</div>
<div class="container-fluid p-2">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header py-3 d-sm-flex d-block">
                    {{-- <h4 class="card-title mb-2">Packages</h4> --}}
                </div>
                <div class="card-header d-block pb-2">
                    <form class="row align-items-end" method="GET" action="{{route('sea-imports.index')}}">
                  
                        <!-- Job No -->
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Search By Job No.</label>
                            <select name="job_no" class="form-control select2">
                                <option value="">select</option>
                                @foreach ($job_nums as $num)
                                    <option value="{{ $num->jobMaster->id }}" {{ request('job_no') == $num ? 'selected' : '' }}>{{ $num->jobMaster->job_no }}</option>
                                @endforeach
                            </select>
                        </div>
                    
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
                            <label class="form-label">Search By Consignee Name.</label>
                            <select name="consignee_id" class="form-control select2">
                                <option value="">select</option>
                                @foreach ($consigneeNames as $consignee)
                                    <option value="{{ $consignee->id }}" {{ request('consignee_id') == $consignee->id ? 'selected' : '' }}>
                                        {{ $consignee->party_name }}
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
                            <a href="{{ route('sea-imports.index') }}" class="btn btn-danger light ms-2">Reset</a>
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
                                    <th>BOE</th>
                                    <th>Out Of Charge</th>
                                    <th>Do Date</th>
                                    <th>Updated By</th>
                                    <th>Documents</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php $i = 1; @endphp
                            
                            @foreach ($sea_imports as $sea_import)
                            
                                {{-- CASE 1: Containers exist --}}
                                @if ($sea_import->container->count() > 0)
                            
                                    @foreach ($sea_import->container as $cont)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $sea_import->jobMaster->job_no ?? 'N/A' }}</td>
                                            <td>{{ $sea_import->ConsigneeName->party_name ?? 'N/A' }}</td>
                                            <td>{{ $sea_import->booking_no ?? 'N/A' }}</td>
                                            <td>{{ $cont->cbm ?? 'N/A' }}</td>
                                            <td>{{ $cont->customer_inv_no ?? 'N/A' }}</td>
                                            <td>{{ $cont->check_list_date ?? 'N/A' }}</td>
                                            <td>{{ $cont->bill_of_entry_date ?? 'N/A' }}</td>
                                            <td>{{ $cont->out_off_charge_date ?? 'N/A' }}</td>
                                            <td>{{ $cont->do_date ?? 'N/A' }}</td>
                                            <td>{{ $sea_import->user->name ?? '' }}</td>
                                            <td>
                                                @if(in_array($sea_import->job_no, $uploadedJobs))
                                                    Yes
                                                @else
                                                    No
                                                @endif
                                            </td>
                                            <td>
                                                @if($sea_import->jobMaster->job_status == 'O')
                                                    <a class="badge badge-info light border-0"
                                                       href="{{ url('admin/sea-imports/'.$sea_import->uuid.'/edit') }}">
                                                        Edit
                                                    </a>
                                                    <a class="badge badge-danger light border-0 delete-sea-import"
                                                       href="javascript:void(0);"
                                                       data-id="{{ $sea_import->id }}">
                                                        Delete
                                                    </a>
                                                @else
                                                    <span class="btn btn-sm btn-danger">Closed</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                            
                                {{-- CASE 2: NO container --}}
                                @else
                            
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $sea_import->jobMaster->job_no ?? 'N/A' }}</td>
                                        <td>{{ $sea_import->ConsigneeName->party_name ?? 'N/A' }}</td>
                                        <td>{{ $sea_import->booking_no ?? 'N/A' }}</td>
                            
                                        <td colspan="8" class="text-center text-muted">
                                            No container added
                                        </td>
                            
                                        <td>
                                            <a class="badge badge-info light border-0"
                                               href="{{ url('admin/sea-imports/'.$sea_import->uuid.'/edit') }}">
                                                Edit
                                            </a>
                                            <a class="badge badge-danger light border-0 delete-sea-import"
                                               href="javascript:void(0);"
                                               data-id="{{ $sea_import->id }}">
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                            
                                @endif
                            
                            @endforeach
                            </tbody>

                        </table>
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        {!! $sea_imports->links('pagination::bootstrap-5') !!}
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
        $(document).on('click', '.delete-sea-import', function(e) {
            e.preventDefault();
            if (!confirm('Are you sure you want to delete this Sea Import record?')) return;

            const seaImportId = $(this).data('id');

            $.ajax({
                url: '/admin/sea-imports/' + seaImportId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert('Sea Import record deleted successfully.');
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