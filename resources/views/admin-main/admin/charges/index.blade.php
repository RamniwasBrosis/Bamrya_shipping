@extends('admin-main.layouts.default')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li><h5 class="bc-title">MANAGE CHARGE</h5></li>
    </ol>
    <a class="text-primary fs-13" href="{{url('admin/charges/create')}}">+ ADD CHARGE</a>
</div>
<div class="container-fluid p-2">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header py-3 d-sm-flex d-block">
                    <h4 class="card-title mb-2">CHARGE</h4>
                </div>
                <div class="card-header d-block pb-2">
                    <form class="row align-items-end" method="get" action="{{Route('charges.index')}}">
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Search</label>
                            <input type="text" class="form-control" name="charge_code" id="charge_code" placeholder="search by charge code" value="{{request('charge_code')}}">
                        </div>
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Search</label>
                            <input type="text" class="form-control" name="charge_name" id="charge_name" placeholder="search by charge name" value="{{request('charge_name')}}">
                        </div>
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Search</label>
                            <input type="text" class="form-control" name="limit" id="limit" placeholder="search by limit" value="{{request('limit')}}">
                        </div>
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Search</label>
                            <input type="text" class="form-control" name="percentage" id="percentage" placeholder="search by percentage" value="{{request('percentage')}}">
                        </div>
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <div>
                                <label class="form-label">Status by charge type</label>
                                <select name="charge_type" class="form-control default-select" value="{{request('charge_type')}}">
                                    <option value="">--select--</option>
                                    <option value="Freight">Freight</option>
                                    <option value="Normal">Normal</option>
                                </select>
                            </div> 
                            
                            <div>
                                <label class="form-label">Formula :</label>
                                <select name="has_formula" class="form-control default-select">
                                    <option value="">--select--</option>
                                    <option value="0">N</option>
                                    <option value="1">Y</option>
                                </select>
                            </div>

                        </div>
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <div>
                                <label class="form-label">Service Tax:</label>
                                <select name="gst_applicable" id="departmentFilter" class="form-control default-select">
                                    <option value="">--select--</option>
                                    <option value="1">Y</option>
                                    <option value="0">N</option>
                                </select>
                            </div>
                            <div>
                                <label class="form-label">Ser. Tax Per.</label>
                                <select name="" class="form-control default-select">
                                    <option value="">--select--</option>
                                    <option value="15">15</option>
                                    <option value="4.50">4.50</option>
                                </select>
                            </div>   
                        </div>
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Currency:</label>
                            <select  class="form-control default-select" name="currency">
                                <option value="">--select--</option>
                                <option value="INR">INR</option>
                                <option value="USD">USD</option>
                                <option value="OTH">OTH</option>
                            </select>
                        </div>
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <button id="applyFilter" class="btn btn-primary" type="submit">Apply</button>
                            <a href="{{ route('charges.index') }}"  class="btn btn-danger light ms-2" type="button">Reset</a>
                        </div>
                    </form>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive active-projects style-1">
                        <table id="empoloyees-tblwrapper" class="table">
                            <thead>
                                <tr>
                                    <th>Charge Code</th>
                                    <th>Charge Name</th>
                                    <th>Currency</th>
                                    <th>Charge Type</th>
                                    <th>GST</th>
                                    <th>GST Per%</th>
                                    <th>Fromula</th>
                                    <th>Limit</th>
                                    <th>Per.</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($charges as $charge)
                                    <tr>
                                        <td>{{$charge->charge_code}}</td>
                                        <td>{{$charge->charge_name}}</td>
                                        <td>{{$charge->currency}}</td>
                                        <td>{{$charge->charge_type}}</td>
                                        <td>
                                            @if ($charge->gst_applicable == 1)
                                                Y
                                            @else
                                                N
                                            @endif
                                        </td>
                                        <td>{{$charge->gst_percentage}} %</td>
                                        <td>
                                            @if ($charge->has_formula == 1)
                                                Y
                                            @else
                                                N
                                            @endif
                                        </td>
                                        <td>{{$charge->limit}}</td>
                                        <td>{{$charge->percentage}}</td>
                                        <td>
                                            @if ($charge->status == 1)
                                                <span class="badge badge-success light border-0">Active</span>                                                
                                            @else
                                                <span class="badge badge-danger light border-0">Deactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a class="badge badge-info light border-0" href="{{url('admin/charges/'.$charge->id.'/edit')}}">Edit</a>
                                            <a class="badge badge-danger light border-0 delete-charge" href="javascript:void(0);" data-id="{{$charge->id}}">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $charges->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@push('scripts')
    <script>
        $(document).on('click', '.delete-charge', function(e) {
            e.preventDefault();
            if (!confirm('Are you sure you want to delete this charge?')) return;

            const chargeId = $(this).data('id');

            $.ajax({
                url: '/admin/charges/' + chargeId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert('charge deleted successfully.');
                    location.reload();
                },
                error: function(xhr) {
                    alert('Failed to delete charge.');
                    console.log(xhr.responseText);
                }
            });
        });
    </script>

@endpush