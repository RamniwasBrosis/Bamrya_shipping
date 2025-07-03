@extends('admin-main.layouts.default')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li><h5 class="bc-title">MANAGE RECEIPTS</h5></li>
    </ol>
    <a class="text-primary fs-13" href="{{url('admin/receipts/create')}}">+ Add Receipts</a>
</div>

@if (session('success'))
    <div class="alert alert-success">
        {{session('success')}}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{session('error')}}
    </div>
@endif

<div class="container-fluid p-2">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-block pb-2 row">
                    <form class="row align-items-end" method="get" action="{{route('receipts.index')}}">
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Search By Billing Party</label>
                            <select id="statusFilter" class="form-control default-select" name="billing_party_id">
                                <option value="">All</option>
                                @foreach ($parties as $party)
                                    <option value="{{$party->id}}">{{$party->party_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Search By OnAccount/Neft</label>
                            <select id="departmentFilter" class="form-control default-select" name="radio_type">
                                <option value="">All</option>
                                <option value="onaccount">ONACCOUTN</option>
                                <option value="neft_cash">NEFT/CASH</option>
                            </select>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Search By Receipt Date</label>
                            <div class="d-flex ">
                                <div class="mx-2">
                                    <label for="">Form Date:</label>
                                    <input type="date" name="form_date" class="form-control">
                                </div>
                                <div>
                                    <label for="">To Date:</label>
                                    <input type="date" name="to_date" class="form-control">
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <button id="applyFilter" class="btn btn-primary" type="submit">Apply</button>
                            <a href="{{route('receipts.index')}}" id="resetFilter" class="btn btn-danger light ms-2" type="button">Reset</a>
                        </div>
                    </form>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive active-projects style-1">
                        <table id="empoloyees-tblwrapper" class="table">
                            <thead>
                                <tr>
                                    <th>Receipt No</th>
                                    <th>Billing Party</th>
                                    <th>Receipt Date</th>
                                    <th>Received Amount</th>
                                    <th>OnAccount/Neft</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($receipt_lists as $receipt_list)
                                    <tr>
                                        <td>{{$receipt_list->id}}</td>
                                        <td>{{$receipt_list->billingParty->party_name}}</td>
                                        <td>{{ \Carbon\Carbon::parse($receipt_list->receipt_date)->format('Y-F-d') }}</td>
                                        <td>{{$receipt_list->total_amount_received ?? 'N/A'}}</td>
                                        <td>{{$receipt_list->radio_type}}</td>
                                        <td>
                                            <a class="badge badge-info light border-0" href="{{url('admin/receipts/'.$receipt_list->uuid.'/edit')}}">Edit</a>
                                            <a class="badge badge-danger light border-0 delete-receipt" href="javascript:void(0);" data-id="{{$receipt_list->id}}">Delete</a>
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
        $(document).on('click', '.delete-receipt', function(e) {
            e.preventDefault();
            if (!confirm('Are you sure you want to delete this Receipt?')) return;

            const ReceiptId = $(this).data('id');

            $.ajax({
                url: '/admin/receipts/' + ReceiptId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert('Receipt record deleted successfully.');
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