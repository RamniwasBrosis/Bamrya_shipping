@extends('admin-main.layouts.default')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li><h5 class="bc-title"> MANAGE Transport</h5></li>
    </ol>
    <a class="text-primary fs-13" href="{{url('admin/transports/create')}}">+ Add Transport</a>
</div>
<div class="container-fluid p-2">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header py-3 d-sm-flex d-block">
                    {{-- <h4 class="card-title mb-2">Packages</h4> --}}
                </div>
                <div class="card-header d-block pb-2">
                    <form class="row align-items-end" method="get" action="{{route('transports.index')}}">
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Search By Full Job No.</label>
                            <select name="full_job_no" class="form-control default-select">
                                <option value="">select</option>
                                @foreach ($transportDetails as $transportDetail)
                                    <option value="{{$transportDetail->full_job_no}}">{{$transportDetail->full_job_no}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Search By Booking No.</label>
                            <select name="booking_no" class="form-control default-select">
                                <option value="">select</option>
                                @foreach ($transportDetails as $transportDetail)
                                    <option value="{{$transportDetail->booking_no}}">{{$transportDetail->booking_no}}</option>
                                @endforeach
                            </select>
                        </div>                       

                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Search By Shipping Bill No.</label>
                            <select name="shipping_bill_no" class="form-control default-select">
                                <option value="">select</option>
                                @foreach ($transportDetails as $transportDetail)
                                    <option value="{{$transportDetail->shipping_bill_no}}">{{$transportDetail->shipping_bill_no}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <button id="applyFilter" class="btn btn-primary" type="submit">Apply</button>
                            <a href="{{route('transports.index')}}" id="resetFilter" class="btn btn-danger light ms-2" type="button">Reset</a>
                        </div>
                    </form>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive active-projects style-1">
                        <table id="empoloyees-tblwrapper" class="table">
                            <thead>
                                <tr>
                                    <th>Transport ID</th>
                                    <th>FullJobno</th>
                                    <th>From Party Name</th>
                                    <th>Booking No</th>
                                    <th>Cust. Inv. No</th>
                                    <th>Shipping Bill No</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transportDetails as $transportDetail)
                                    <tr>
                                        <td>{{$transportDetail->id}}</td>
                                        <td>{{$transportDetail->full_job_no}}</td>
                                        <td>{{$transportDetail->importParty->party_name}}</td>
                                        <td>{{$transportDetail->booking_no}}</td>
                                        <td>{{$transportDetail->customer_inv_no}}</td>
                                        <td>{{$transportDetail->shipping_bill_no}}</td>
                                        <td>
                                            <a class="badge badge-info light border-0" href="{{url('admin/transports/'.$transportDetail->uuid.'/edit')}}">Edit</a>
                                            <a class="badge badge-danger light border-0 delete-transport" href="javascript:void(0);" data-id="{{$transportDetail->id}}">Delete</a>
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
        $(document).on('click', '.delete-transport', function(e) {
            e.preventDefault();
            if (!confirm('Are you sure you want to delete this transport record?')) return;

            const transportId = $(this).data('id');

            $.ajax({
                url: '/admin/transports/' + transportId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert('transport record deleted successfully.');
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

@endpush