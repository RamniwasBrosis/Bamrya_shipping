@extends('admin-main.layouts.default')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li><h5 class="bc-title">Manage Bank Details</h5></li>
    </ol>
    <a class="text-primary fs-13" href="{{url('admin/banks/create')}}">+ Add Bank Details</a>
</div>
<div class="container-fluid p-2">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header py-3 d-sm-flex d-block">
                    <h4 class="card-title mb-2">Bank Details</h4>
                </div>
                <div class="card-header d-block pb-2">
                    <form class="row align-items-end" method="get" action="{{route('banks.index')}}">
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Search</label>
                            <input type="text" class="form-control" placeholder="search by beneficiary name" name="beneficiary_name" value="{{request('beneficiary_name')}}">
                        </div>
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Search</label>
                            <input type="text" class="form-control" placeholder="search by account no" name="account_no" value="{{request('account_no')}}">
                        </div>
                        
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <button id="applyFilter" class="btn btn-primary" type="submit">Apply</button>
                            <a href="{{route('banks.index')}}" id="resetFilter" class="btn btn-danger light ms-2">Reset</a>
                        </div>
                    </form>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive active-projects style-1">
                        <table id="empoloyees-tblwrapper" class="table">
                            <thead>
                                <tr>
                                    <th>Bank Name</th>
                                    <th>Beneficiary Name</th>
                                    <th>Branch</th>
                                    <th>Account No</th>
                                    <th>IFSC Code</th>
                                    <th>Account Type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($banks as $bank)
                                    <tr>
                                        <td>{{$bank->bank_name}}</td>
                                        <td>{{$bank->beneficiary_name}}</td>
                                        <td>{{$bank->branch_name}}</td>
                                        <td>{{$bank->account_no}}</td>
                                        <td>{{$bank->ifsc_code}}</td>
                                        <td>
                                            @if ($bank->account_type == 'Saving Account')
                                                Saving
                                            @else
                                                Current
                                            @endif                                           
                                        </td>
                                        <td>
                                            <a class="badge badge-info light border-0" href="{{url('admin/banks/'.$bank->id.'/edit')}}">Edit</a>
                                            <a class="badge badge-danger light border-0 delete-bank" href="javascript:void(0);" data-id="{{$bank->id}}">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach                              
                            </tbody>
                        </table>
                    </div>
                    {{ $banks->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@push('scripts')
    <script>
        $(document).on('click', '.delete-bank', function(e) {
            e.preventDefault();
            if (!confirm('Are you sure you want to delete this bank record?')) return;

            const voyageId = $(this).data('id');

            $.ajax({
                url: '/admin/banks/' + voyageId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert('bank record deleted successfully.');
                    location.reload();
                },
                error: function(xhr) {
                    alert('Failed to delete bank record.');
                    console.log(xhr.responseText);
                }
            });
        });
    </script>

@endpush