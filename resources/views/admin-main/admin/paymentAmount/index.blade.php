@extends('admin-main.layouts.default')
@section('content')

<div class="page-titles">
    <ol class="breadcrumb">
        <li><h5 class="bc-title">MANAGE On Payment Amount</h5></li>
    </ol>
    <a class="text-primary fs-13" href="{{url('admin/payment-amount/create')}}">+ Add New</a>
</div>
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
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
                                    <th>Bank Name</th>
                                    <th>Received Amount</th>
                                    <th>Round of Amt</th>
                                    
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($on_accounts as $on_account)
                                    <tr>
                                        <td>{{$on_account->id}}</td>
                                        <td>{{ \Carbon\Carbon::parse($on_account->sales_date)->format('d-m-Y')}}</td>
                                        <td>{{$on_account->partyName->party_name ?? ''}}</td>
                                        <td>{{$on_account->bankDetail->bank_name ?? ''}}</td>
                                        <td>{{$on_account->amount ?? ''}}</td>
                                        <td>{{$on_account->round_of_amount ?? ''}}</td>
                                        
                                        <td>
                                            <div class="d-flex justify-content-end">
                                                <!--<a class="badge badge-info light border-0" href="{{url('admin/on-accounts/'.$on_account->uuid.'/edit')}}">Edit</a>-->
                                               
                                                <form action="{{ route('payment-amount.destroy', $on_account->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this record?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="badge badge-danger light border-0">Delete</button>
                                                </form>
                                            </div>
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