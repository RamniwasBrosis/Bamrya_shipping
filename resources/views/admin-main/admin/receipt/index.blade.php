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
                        <table id="employees-tblwrapper" class="table">
                            <thead>
                                <tr>
                                    <th>Receipt No</th>
                                    <th>Billing Party</th>
                                    <th>Invoice Type</th>
                                    <th>Invoice No</th>
                                    <th>Receipt Date</th>
                                    <th>Debit</th>
                                    <th>Credit</th>
                                    <th>Updated By</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($receipt_lists as $receipt_list)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $receipt_list->billingParty->party_name ?? '' }}</td>
                                        <td>{{ $receipt_list->invoice_type ?? '' }}</td>
                                        <td>{{ $receipt_list->invoice_no ?? '' }}</td>
                                        <td>{{ $receipt_list->receipt_date ? \Carbon\Carbon::parse($receipt_list->receipt_date)->format('d-F-Y') : '' }}</td>
                        
                                        {{-- Conditional Debit / Credit --}}
                                        <td>
                                            @if ($receipt_list->invoice_type === 'Sales')
                                                {{ number_format($receipt_list->amount, 2) }}
                                            @elseif($receipt_list->invoice_type === 'Payment')
                                                {{ number_format($receipt_list->amount, 2) }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            @if ($receipt_list->invoice_type === 'Receipt')
                                                {{ number_format($receipt_list->amount, 2) }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>{{ $receipt_list->user->name ?? '' }}</td>
                                        <td>
                                            <a class="badge badge-info light border-0" href="{{ url('admin/receipts/'.$receipt_list->uuid.'/edit') }}">Edit</a>
                        
                                            <form action="{{ route('receipts.destroy', $receipt_list->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="badge badge-danger light border-0"
                                                        onclick="return confirm('Are you sure you want to delete this receipt?')">
                                                    Delete
                                                </button>
                                            </form>
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
        let id = $(this).data('id');
    
        if (!id) return console.log("⚠️ No ID found!");
    
        let url = "{{ route('receipts.destroy', ':id') }}";
        url = url.replace(':id', id);
    
        Swal.fire({
            title: 'Delete Receipt?',
            text: "Are you sure you want to delete this receipt permanently?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        _method: "DELETE"
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            text: response.success,
                            timer: 1500,
                            showConfirmButton: false
                        });
    
                        $(`.delete-receipt[data-id='${id}']`).closest('tr').fadeOut(500, function() {
                            $(this).remove();
                        });
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: xhr.responseJSON?.message || 'Failed to delete receipt. Try again later!'
                        });
                    }
                });
            }
        });
    });
    </script>




@endpush