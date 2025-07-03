@extends('admin-main.layouts.default')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li><h5 class="bc-title">MANAGE IMPORT INVOICE</h5></li>
    </ol>
    <a class="text-primary fs-13" href="{{url('admin/sales-invoices/create')}}">+ Add Import Invoice</a>
</div>
<div class="container-fluid p-2">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header py-3 d-sm-flex d-block">
                    {{-- <h4 class="card-title mb-2">Packages</h4> --}}
                </div>
                <div class="card-header d-block pb-2">
                    <form class="row align-items-end" method="get" action="{{route('sales-invoices.index')}}">                   
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
                                @foreach ($sales_invoices as $sales_invoice)
                                    <option value="{{$sales_invoice->invoice_no}}">{{$sales_invoice->invoice_no}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Search By Party Name</label>
                            <select id="genderFilter" class="form-control default-select" name="billing_party_id">
                                <option value="">select</option>
                                @foreach ($sales_invoices as $sales_invoice)
                                    <option value="{{$sales_invoice->billing_party_id}}">{{$sales_invoice->partyName->party_name}}</option>
                                @endforeach
                            </select>
                        </div>                       
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <button id="applyFilter" class="btn btn-primary" type="submit">Apply</button>
                            <a href="{{route('sales-invoices.index')}}" class="btn btn-danger light ms-2" type="button">Reset</a>
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
                                    <th>Full Inv No</th>

                                    <th>INV_DT</th>
                                    <th>AckNo</th>
                                    <th>AckDt</th>

                                    <th>HBL No</th>
                                    <th>Party Name</th>
                                    <th>FinYear</th>

                                    <th>Inv Type</th>
                                    <th>Inv Cat</th>
                                    <th>FEinv</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sales_invoices as $sales_invoice)
                                    @php
                                        $year = $sales_invoice->created_at->format('Y');
                                        $month = $sales_invoice->created_at->format('m');

                                        if ((int)$month < 4) {
                                            // If Jan-Mar, financial year is previous year
                                            $fyStart = $year - 1;
                                            $fyEnd = $year;
                                        } else {
                                            $fyStart = $year;
                                            $fyEnd = $year + 1;
                                        }

                                        $fy = $fyStart . '-' . substr($fyEnd, -2);

                                        switch ($sales_invoice->invoice_type) {
                                            case '1':
                                                $Inv_Type = 'DEBITNOTE(Rs.)';
                                                break;
                                            case '2':
                                                $Inv_Type = 'CREDITNOTE(Rs.)';
                                                break;
                                            case '3':
                                                $Inv_Type = 'DEBITNOTE(Ovr.)';
                                                break;
                                            case '4':
                                                $Inv_Type = 'CREDITNOTE(Ovr.)';
                                                break;
                                            case '5':
                                                $Inv_Type = 'COMMISSION/REBATE';
                                                break;
                                            case '6':
                                                $Inv_Type = 'SEZ';
                                                break;
                                            case '7':
                                                $Inv_Type = 'FRT(IGST)';
                                                break;
                                            case '8':
                                                $Inv_Type = 'FRT(CreditNote)';
                                                break;                                            
                                            default:
                                          
                                                break;
                                        }

                                        switch ($sales_invoice->inv_cat) {
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
                                        <td>{{$sales_invoice->id ?? '--'}}</td>
                                        <td>{{$sales_invoice->inv_cat}}/{{$sales_invoice->job_no ?? '--'}}/{{$fy}}</td>
                                        <td>{{$sales_invoice->invoice_no ?? '--'}}</td>
                                        <td>{{$sales_invoice->full_invoice_no ?? '--'}}</td>

                                        <td>{{$sales_invoice->invoice_date ?? '--'}}</td>
                                        <td></td>
                                        <td></td>

                                        <td></td>
                                        <td>{{$sales_invoice->partyName->party_name ?? '--'}}</td>
                                        <td>{{$fy ?? '--'}}</td>

                                        <td>{{ $Inv_Type ?? '--'}}</td>
                                        <td>{{ $Inv_cat ?? '--'}}</td>
                                        <td></td>
                                        <td>
                                            <a class="badge badge-info light border-0" href="{{url('admin/sales-invoices/'.$sales_invoice->uuid.'/edit')}}">Edit</a>
                                            <a class="badge badge-danger light border-0 delete-salesInvoice" href="javascript:void(0);" data-id="{{$sales_invoice->id}}">Delete</a>
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
        $(document).on('click', '.delete-salesInvoice', function(e) {
            e.preventDefault();
            if (!confirm('Are you sure you want to delete this Sales Invoice record?')) return;

            const salesInvoiceId = $(this).data('id');

            $.ajax({
                url: '/admin/sales-invoices/' + salesInvoiceId,
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