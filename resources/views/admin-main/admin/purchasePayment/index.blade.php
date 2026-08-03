@extends('admin-main.layouts.default')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li><h5 class="bc-title">MANAGE PURCHASE Payments</h5></li>
    </ol>
    <a class="text-primary fs-13" href="{{url('admin/purchase-payment/create')}}">+ Add Purchase Payment</a>
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
                <div class="card-header d-block pb-2">
                    <form class="row align-items-end">
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Search</label>
                            <input type="text" class="form-control" id="searchFilter">
                        </div>
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Status</label>
                            <select id="statusFilter" class="form-control default-select">
                                <option value="">All</option>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                                <option value="Pending">Pending</option>
                            </select>
                        </div>
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Department</label>
                            <select id="departmentFilter" class="form-control default-select">
                                <option value="">All</option>
                                <option value="Computer Science">Computer Science</option>
                                <option value="Web Designer">Web Designer</option>
                            </select>
                        </div>
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Gender</label>
                            <select id="genderFilter" class="form-control default-select">
                                <option value="">All</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Location</label>
                            <select id="locationFilter" class="form-control default-select">
                                <option value="">All</option>
                                <option value="Delhi">Delhi</option>
                                <option value="Bengaluru">Bengaluru</option>
                                <option value="Hyderabad">Hyderabad</option>
                                <option value="Mumbai">Mumbai</option>
                                <option value="Ahmedabad">Ahmedabad</option>
                                <option value="Kolkata">Kolkata</option>
                                <option value="Chennai">Chennai</option>
                            </select>
                        </div>
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <button id="applyFilter" class="btn btn-primary" type="button">Apply</button>
                            <button id="resetFilter" class="btn btn-danger light ms-2" type="button">Reset</button>
                        </div>
                    </form>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive active-projects style-1">
                        <<table id="employees-tblwrapper" class="table">
                            <thead>
                                <tr>
                                    <th>Purchase No</th>
                                    <th>Billing Party</th>
                                    <th>Invoice Type</th>
                                    <th>Invoice No</th>
                                    <th>Purchase Date</th>
                                    <th>Debit</th>
                                    <th>Credit</th>
                                    <th>Updated By</th>
                                    <th>Branch</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($purchase_payments as $purchase_payment)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{$purchase_payment->partyName->party_name??''}}</td>
                                        <td>{{ $purchase_payment->invoice_type ?? '' }}</td>
                                        <td>{{ $purchase_payment->invoice_no ?? '' }}</td>
                                        <td>{{ $purchase_payment->purchase_date ? \Carbon\Carbon::parse($purchase_payment->purchase_date)->format('d-F-Y') : '' }}</td>

                                        {{-- Conditional Debit / Credit --}}
                                        <td>
                                            @if ($purchase_payment->invoice_type === 'Journal')
                                                {{ number_format($purchase_payment->amount, 2) }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            @if ($purchase_payment->invoice_type === 'Purchase')
                                                {{ number_format($purchase_payment->amount, 2) }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>{{ $purchase_payment->user->name ?? '' }}</td>
                                        <td>{{ $purchase_payment->branch->branch_name ?? '' }}</td>
                                        <td>
                                            <a class="badge badge-info light border-0" href="{{url('admin/purchase-payment/'.$purchase_payment->uuid.'/edit')}}">Edit</a>

                                            <form action="{{ route('purchase-payment.destroy', $purchase_payment->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="badge badge-danger light border-0"
                                                        onclick="return confirm('Are you sure you want to delete this payment?')">
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
        $(document).on('click', '.delete-purchase_payment', function(e) {
            e.preventDefault();
            if (!confirm('Are you sure you want to delete this Purchase Payment record?')) return;

            const purchaseId = $(this).data('id');

            $.ajax({
                url: '/admin/purchase-payment/' + purchaseId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert('Purchase Payment record deleted successfully.');
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
