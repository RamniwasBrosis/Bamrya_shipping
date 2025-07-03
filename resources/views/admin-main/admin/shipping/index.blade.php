@extends('admin-main.layouts.default')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li><h5 class="bc-title">MANAGE SHIPPING LINE</h5></li>
    </ol>
    <a class="text-primary fs-13" href="{{url('admin/shippings/create')}}">+ Add Shipping</a>
</div>
<div class="container-fluid p-2">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header py-3 d-sm-flex d-block">
                    <h4 class="card-title mb-2">Shipping</h4>
                </div>
                <div class="card-header d-block pb-2">
                    <form class="row align-items-end" method="GET" action="{{ route('shippings.index') }}">
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Search by shipping line code</label>
                            <input type="text" class="form-control" id="shipping_line_code" name="shipping_line_code">
                        </div>
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Search by shipping line name</label>
                            <input type="text" class="form-control" id="shipping_line_name" name="shipping_line_name">
                        </div>
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Search bt shipping line type</label>
                            <input type="text" class="form-control" id="shipping_line_type" name="shipping_line_type">
                        </div>
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <button id="applyFilter" class="btn btn-primary" type="submit">Apply</button>
                            <a href="{{ route('vessels.index') }}" id="resetFilter" class="btn btn-danger light ms-2">Reset</a>
                        </div>
                    </form>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive active-projects style-1">
                        <table id="empoloyees-tblwrapper" class="table">
                            <thead>
                                <tr>
                                    <th>Shipping Line Code</th>
                                    <th>Shipping Line Name</th>
                                    <th>Address</th>
                                    <th>Shipping Line Type</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($MasterShippings as $MasterShipping)
                                    <tr>
                                        <td>{{$MasterShipping->shipping_line_code}}</td>
                                        <td>{{$MasterShipping->shipping_line_name}}</td>
                                        <td>{{$MasterShipping->address_line_1}}</td>
                                        <td>
                                            @if ($MasterShipping->shipping_line_type == 1)
                                                Indian
                                            @else
                                                Overseas
                                            @endif                                        
                                        </td>
                                        <td>
                                            @if ($MasterShipping->status == 1)
                                                <span class="badge badge-success light border-0">Active</span>
                                            @else
                                                <span class="badge badge-danger light border-0">In-active</span>
                                            @endif  
                                            
                                        </td>
                                        <td>
                                            <a class="badge badge-info light border-0" href="{{url('admin/shippings/'.$MasterShipping->id.'/edit')}}">Edit</a>
                                            <a class="badge badge-danger light border-0 delete-shipping" href="javascript:void(0);" data-id="{{ $MasterShipping->id }}">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                     {{ $MasterShippings->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@push('scripts')
    <script>
        $(document).on('click', '.delete-shipping', function(e) {
            e.preventDefault();
            if (!confirm('Are you sure you want to delete this shipping line?')) return;

            const shippingId = $(this).data('id');

            $.ajax({
                url: '/admin/shippings/' + shippingId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert('shipping deleted successfully.');
                    location.reload();
                },
                error: function(xhr) {
                    alert('Failed to delete shipping.');
                    console.log(xhr.responseText);
                }
            });
        });
    </script>

@endpush
