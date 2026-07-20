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
                            <select id="statusFilter" class="form-control select2" name="job_no">
                                <option value="">select</option>
                                @foreach ($all_invoices as $all_invoice)
                                    <option value="{{ $all_invoice->job_no }}" {{ request('job_no') == $all_invoice->job_no ? 'selected' : '' }}>{{ $all_invoice->operationJob->full_job_no ?? '' }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Search By Invoice No.</label>
                            <select id="departmentFilter" class="form-control select2" name="invoice_no">
                                <option value="">select</option>
                                @foreach ($sales_invoices as $sales_invoice)
                                    <option value="{{$sales_invoice->invoice_no}}">{{$sales_invoice->invoice_no}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Search By Party Name</label>
                            <select id="genderFilter" class="form-control select2" name="billing_party_id">
                                <option value="">select</option>
                                @php
                                    $uniqueParties = $sales_invoices->unique('billing_party_id');
                                @endphp
        
        
                                @foreach ($uniqueParties as $sales_invoice)
                                    <option value="{{$sales_invoice->billing_party_id}}">{{$sales_invoice->partyName->party_name ?? ''}}</option>
                                @endforeach
                            </select>
                        </div>
                        <!--<div class="col-xl-2 col-sm-6 col-lg-4 mb-3">-->
                        <!--    <label class="form-label">Start Date</label>-->
                        <!--    <input type="date" placeholder="dd/mm/yy" class="form-control" name="start_date" value="{{ request('start_date') }}">-->
                        <!--</div>-->
                        
                        <!--<div class="col-xl-2 col-sm-6 col-lg-4 mb-3">-->
                        <!--    <label class="form-label">End Date</label>-->
                        <!--    <input type="date" placeholder="dd/mm/yy" class="form-control" name="end_date" value="{{ request('end_date') }}">-->
                        <!--</div>-->
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
                                    <th>Party Name</th>
                                    <th>Job NO</th>
                                    <th>Invoice NO</th>
                                    <th>INV_DT</th>
                                    <th>Inv Type</th>
                                    <th>Inv Cat</th>
                                    <!--<th>HBL No</th>-->
                                    <!--<th>Shipper Inv No</th>-->
                                    <th>FinYear</th>
                                    <th>Inv Amt</th>
                                    <th>Updated By</th>
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
                                    @php
                                        $latestCharge = $sales_invoice->chargesContainer
                                            ->sortByDesc('updated_at')
                                            ->first();
                                    
                                        if (
                                            $latestCharge &&
                                            $latestCharge->updated_at > $sales_invoice->updated_at
                                        ) {
                                            $userName = optional($latestCharge->user)->name;
                                        } else {
                                            $userName = optional($sales_invoice->user)->name;
                                        }
                                    @endphp

                                    <tr>
                                        <td>{{$loop->iteration ?? '--'}}</td>
                                        <!--<td>{{$sales_invoice->inv_cat}}/{{$sales_invoice->job_no ?? '--'}}/{{$fy}}</td>                 gajendra  -->
                                        
                                        <td>{{$sales_invoice->partyName->party_name ?? '--'}}</td>
                                        <td>{{$sales_invoice->inv_cat}}/{{$sales_invoice->operationJob->job_no ?? '--'}}/{{$fy}}</td>  
                                        <td>{{$sales_invoice->invoice_no ?? '--'}}</td>
                                        <td>{{$sales_invoice->invoice_date ? \Carbon\Carbon::parse($sales_invoice->invoice_date)->format('d-m-Y') :'--'}}</td>
                                        <td>{{ $sales_invoice->invoice_type ?? '--'}}</td>
                                        <td>{{ $Inv_cat ?? '--'}}</td>
                                        <!--<td>{{$sales_invoice->awb_bl_no ?? '--'}}</td>-->
                                        <!--<td>{{$sales_invoice->full_invoice_no ?? '--'}}</td>-->
                                        <td>{{$fy ?? '--'}}</td>
                                        <td style="color:red;">
                                            {{
                                                $sales_invoice->chargesContainer->sum('total') !== null
                                                ? (
                                                    ($sales_invoice->chargesContainer->sum('total') - floor($sales_invoice->chargesContainer->sum('total'))) < 0.50
                                                        ? floor($sales_invoice->chargesContainer->sum('total'))
                                                        : ceil($sales_invoice->chargesContainer->sum('total'))
                                                )
                                                : '--'
                                            }}
                                        </td>
                                        <td>{{ $userName ?? '-' }}</td>
                                        <td>
                                            <a class="badge badge-info light border-0" href="{{url('admin/sales-invoices/'.$sales_invoice->uuid.'/edit')}}">Edit</a>
                                            <a class="badge badge-danger light border-0 delete-salesInvoice" href="javascript:void(0);" data-id="{{$sales_invoice->id}}">Delete</a>
                                            
                                            <!--<form action="{{ route('sales-invoices.destroy', $sales_invoice->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this record?');">-->
                                            <!--    @csrf-->
                                            <!--    @method('DELETE')-->
                                            <!--    <button type="submit" class="badge badge-danger light border-0">Delete</button>-->
                                            <!--</form>-->
                                        </td>
                                    </tr>                                    
                                @endforeach
                                
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center mt-3">
                            {{ $sales_invoices->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
                
                <div id="error-div"></div>
            </div>
        </div>
    </div>

</div>

@endsection



@push('scripts')
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                width: '100%'
            })
        })
    
        $(document).on('click', '.delete-salesInvoice', function(e) {
            e.preventDefault();
            if (!confirm('Are you sure you want to delete this Sales Invoice record?')) return;

            const salesInvoiceId = $(this).data('id');
            let url = "{{ route('sales-invoices.destroy', ':id') }}";
            url = url.replace(':id', salesInvoiceId);
            
            $.ajax({
                url: url,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // console.log(response);
                    // return;
                    if(response.status){
                        $('#error-div').text(response.message).css('color', 'green');
                    }else{
                        $('#error-div').text(response.message).css('color', 'red');
                    }
                    
                    setTimeout(()=>{
                        $('#error-div').text('')
                    }, 3000)
                    // location.reload();
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