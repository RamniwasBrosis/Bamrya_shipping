@extends('admin-main.layouts.default')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li><h5 class="bc-title">MANAGE EXPORT DELIVERY ORDER</h5></li>
    </ol>
    <a class="text-primary fs-13" href="{{url('admin/bookings/create')}}">+ Add Booking</a>
</div>
<div class="container-fluid p-2">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header py-3 d-sm-flex d-block">
                    <h4 class="card-title mb-2">Booking Details</h4>
                </div>
                <div class="card-header d-block pb-2">
                    <form class="row align-items-end" method="get" action="{{route('bookings.index')}}">
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Search By Booking Number</label>
                            <select id="statusFilter" class="form-control default-select select2" name="booking_no">
                                <option value="">select</option>
                                @foreach ($filters as $filter)
                                    <option value="{{$filter->booking_no}}">{{$filter->booking_no}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Search By Cargo Type</label>
                            <select id="departmentFilter" class="form-control default-select" name="cargo_type">
                                <option value="">select</option>
                                @foreach ($filters as $filter)
                                    <option value="{{$filter->cargo_type}}">{{$filter->cargo_type}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Search By Entry Date</label>
                            <div class="d-flex">                            
                                <div>Form Date : <input type="date" name="from_date" class="form-control"></div>
                                <div>To Date : <input type="date" name="to_date" class="form-control"></div>
                            </div>                            
                        </div>
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <button id="applyFilter" class="btn btn-primary" type="submit">Apply</button>
                            <a href="{{route('bookings.index')}}" id="resetFilter" class="btn btn-danger light ms-2" type="button">Reset</a>
                        </div>
                    </form>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive active-projects style-1">
                        <table id="empoloyees-tblwrapper" class="table" id="example">
                            <thead>
                                <tr>
                                    <th>Booking No</th>
                                    <th>Voy_No</th>
                                    <th>Ocean_Vsl</th>
                                    <th>CargoType</th>
                                    <th>Entry Date</th>
                                    <th>Action</th>
                                    <th>Print</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bookingLists as $bookingList)
                                    <tr>
                                        <td>{{$bookingList->booking_no}}</td>
                                        <td>{{$bookingList->voy_no}}</td>
                                        <td>{{$bookingList->vessel->vessel_name ?? '-'  }}</td>
                                        <td>{{$bookingList->cargo_type}}</td>
                                        <td>
                                            {{$bookingList->entry_date}}
                                        </td>
                                        <td>
                                            <a class="badge badge-info light border-0" href="{{url('admin/bookings/'.$bookingList->uuid.'/edit')}}">Edit</a>
                                            <a class="badge badge-danger light border-0 delete-booking" href="javascript:void(0);" data-id="{{$bookingList->id}}">Delete</a>
                                            
                                        </td>
                                        <td>
                                            <a href="{{ route('booking.print', $bookingList->id) }}" class="btn btn-secondary btn-sm" target="_blank">
                                                Print
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@push('scripts')
    <script>
        $(document).on('click', '.delete-booking', function(e) {
            e.preventDefault();
            if (!confirm('Are you sure you want to delete this booking?')) return;

            const branchId = $(this).data('id');

            $.ajax({
                url: '/admin/bookings/' + branchId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert('Booking Record deleted successfull');
                    location.reload();
                },
                error: function(xhr) {
                    let errorMessage = 'An error occurred.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    } else if (xhr.responseText) {
                        errorMessage = xhr.responseText;
                    }

                    $('#Emsg').css('display', 'block').text(errorMessage);
                }
            });
        });
        
    </script>
    <!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>-->
    <!--<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>-->
    <!--<script>-->
    <!--    $(document).ready(function() {-->
    <!--        $('.select2').select2({-->
    <!--            placeholder: "Select an option",-->
    <!--            allowClear: true-->
    <!--        });-->
    <!--    });-->
    <!--</script>-->
    
    <!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>-->
    

@endpush