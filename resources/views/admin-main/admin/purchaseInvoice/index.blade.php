@extends('admin-main.layouts.default')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li><h5 class="bc-title">MANAGE PURCHASE INVOICE</h5></li>
    </ol>
    <a class="text-primary fs-13" href="{{url('admin/purchase-invoices/create')}}">+ Add Purchase Invoice</a>
</div>
<div class="container-fluid p-2">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header py-3 d-sm-flex d-block">
                    {{-- <h4 class="card-title mb-2">Packages</h4> --}}
                </div>
                <div class="card-header d-block pb-2">
                    <form class="row align-items-end" method="get" action="{{route('purchase-invoices.index')}}">                   
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Search By Job No.</label>
                            <select id="statusFilter" class="form-control default-select" name="job_no">
                                <option value="">select</option>
                                @foreach ($job_nums as $job_no => $display)
                                    <option value="{{ $job_no }}" {{ request('job_no') == $job_no ? 'selected' : '' }}>{{ $display }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Search By Invoice No.</label>
                            <select id="departmentFilter" class="form-control default-select" name="invoice_no">
                                <option value="">select</option>
                                @foreach ($purchase_invoices as $purchase_invoice)
                                    <option value="{{$purchase_invoice->invoice_no}}">{{$purchase_invoice->invoice_no}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Search By Party Name</label>
                            <select id="genderFilter" class="form-control default-select" name="billing_party_id">
                                <option value="">select</option>
                                @foreach ($purchase_invoices as $purchase_invoice)
                                    <option value="{{$purchase_invoice->billing_party_id}}">{{$purchase_invoice->partyName->party_name}}</option>
                                @endforeach
                            </select>
                        </div>                       
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <button id="applyFilter" class="btn btn-primary" type="submit">Apply</button>
                            <a href="{{route('purchase-invoices.index')}}" class="btn btn-danger light ms-2" type="button">Reset</a>
                        </div>
                    </form>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive active-projects style-1">
                        <table id="empoloyees-tblwrapper" class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Job NO</th>
                                    <th>Invoice NO</th>
                                    <th>Party Type</th>
                                    <th>Party Name</th>
                                    <th>FinYear</th>
                                    <th>Inv Cat</th>
                                    <th>INR/USD</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($purchase_invoices as $purchase_invoice)
                                    @php
                                        $year = $purchase_invoice->created_at->format('Y');
                                        $month = $purchase_invoice->created_at->format('m');

                                        if ((int)$month < 4) {
                                            // If Jan-Mar, financial year is previous year
                                            $fyStart = $year - 1;
                                            $fyEnd = $year;
                                        } else {
                                            $fyStart = $year;
                                            $fyEnd = $year + 1;
                                        }

                                        $fy = $fyStart . '-' . substr($fyEnd, -2);

                                        switch ($purchase_invoice->party_type) {
                                            case 'customer':
                                                $party_Type = 'Customer';
                                                break;                                                                                                                           
                                            default:
                                                $party_Type = 'OtherBillingPARTY';
                                                break;
                                        }

                                        switch ($purchase_invoice->inv_cat) {
                                            case 'AI':
                                                $Inv_cat = 'AIR IMPORT';
                                                break;
                                            case 'AE':
                                                $Inv_cat = 'AIR EXPORT';
                                                break;
                                            case 'SI':
                                                $Inv_cat = 'SEA IMPORT';
                                                break;
                                            case 'SE':
                                                $Inv_cat = 'SEA EXPORT';
                                                break;                                                                                      
                                            default:
                                                $Inv_cat = '--';
                                                break;
                                        }
                                    @endphp

                                    <tr>
                                        <td>{{$purchase_invoice->id}}</td>
                                        <td>{{$purchase_invoice->inv_cat}}/{{$purchase_invoice->job_no ?? '--'}}/{{$fy}}</td>
                                        <td>{{$purchase_invoice->invoice_no ?? '--'}}</td>
                                        <td>{{$party_Type ?? '--'}}</td>
                                        <td>{{$purchase_invoice->partyName->party_name ?? '--'}}</td>
                                        <td>{{$fy}}</td>
                                        <td>{{$Inv_cat ?? '--'}}</td>
                                        <td>{{$purchase_invoice->currency}}</td>
                                        <td>
                                            <a class="badge badge-info light border-0" href="{{url('admin/purchase-invoices/'.$purchase_invoice->uuid.'/edit')}}">Edit</a>
                                            <a class="badge badge-danger light border-0 delete-purchaseInvoice" href="javascript:void(0);" data-id="{{$purchase_invoice->id}}">Delete</a>
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
        $(document).on('click', '.delete-purchaseInvoice', function(e) {
            e.preventDefault();
            if (!confirm('Are you sure you want to delete this Purchase Invoice record?')) return;

            const purInvoiceId = $(this).data('id');

            $.ajax({
                url: '/admin/purchase-invoices/' + purInvoiceId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    location.reload();
                },
                error: function(xhr) {
                    let errorMessage = 'An error occurred.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    } else if (xhr.responseText) {
                        errorMessage = xhr.responseText;
                    }
                }
            });
        });
    </script>

@endpush