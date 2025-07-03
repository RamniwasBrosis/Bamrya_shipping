@extends('admin-main.layouts.default')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li><h5 class="bc-title">MANAGE On Account</h5></li>
    </ol>
    <a class="text-primary fs-13" href="{{url('admin/on-accounts/create')}}">+ Add OnAcount</a>
</div>
<div class="container-fluid p-2">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-block pb-2">
                    <form class="row align-items-end" method="GET" action="{{route('on-accounts.index')}}">            
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Search By Party Name</label>
                            <select id="statusFilter" class="form-control default-select" name="party_id">
                                <option value="">select</option>
                                @foreach ($parties as $party)
                                    <option value="{{$party->id}}">{{$party->party_name}}</option>
                                @endforeach
                            </select>
                        </div>                        
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <button id="applyFilter" class="btn btn-primary" type="submit">Apply</button>
                            <a href="{{route('on-accounts.index')}}" id="resetFilter" class="btn btn-danger light ms-2" type="button">Reset</a>
                        </div>
                    </form>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive active-projects style-1">
                        <table id="empoloyees-tblwrapper" class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Party Name</th>
                                    <th>Amount</th>
                                    <th>Balance Amt</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($on_accounts as $on_account)
                                    <tr>
                                        <td>{{$on_account->id}}</td>
                                        <td>{{$on_account->sales_date}}</td>
                                        <td>{{$on_account->partyName->party_name}}</td>
                                        <td>{{$on_account->amount}}</td>
                                        <td>{{$on_account->balance_amout}}</td>
                                        <td>
                                            <a class="badge badge-info light border-0" href="{{url('admin/on-accounts/'.$on_account->uuid.'/edit')}}">Edit</a>
                                            <a class="badge badge-danger light border-0 delete-onAccount" href="javascript:void(0);" data-id="{{$on_account->id}}">Delete</a>
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
        $(document).on('click', '.delete-onAccount', function(e) {
            e.preventDefault();
            if (!confirm('Are you sure you want to delete this onAccount record?')) return;

            const onAccountId = $(this).data('id');

            $.ajax({
                url: '/admin/on-accounts/' + onAccountId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert('onAccount Record deleted successfully.');
                    location.reload();
                },
                error: function(xhr) {
                    alert('Failed to delete onAccount record.');
                    console.log(xhr.responseText);
                }
            });
        });
    </script>

@endpush