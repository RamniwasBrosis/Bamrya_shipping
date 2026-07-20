@extends('admin-main.layouts.default')
@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li>
                <h5 class="bc-title">Sales By Persons</h5>
            </li>
        </ol>
    </div>
    <div class="container-fluid p-2">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-validation">
                            <form class="needs-validation" id="SalesPersonReport" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-6 my-2">
                                        <label for="">Persons Name</label>
                                        <select class="form-control wide me-2 select2" name="sales_person_id"> 
                                            <option value="">Select</option>
                                            @foreach ($salesPersons as $salesPerson)
                                                @if($salesPerson)
                                                    <option value="{{ $salesPerson->id }}">{{ $salesPerson->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>

                                    </div>
                                    <div class="col-xl-6 my-2 pt-5 text-center">
                                        <button class="btn btn-primary me-md-2 btn-md" type="submit">PREVIEW</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                   <div id="reportPreview" class="mt-4 bg-slate-400 p-3 border border-dark" style="display: none;" ></div>
                </div>                
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: 'Select a value',
                'allowClear': true,
                width: '100%'
            })
        })
    </script>
    <script>
        $(document).ready(function() {
            $('#SalesPersonReport').on('submit', function(e){
                e.preventDefault();
            
                $.ajax({
                    url: "{{ route('sales.person.report') }}",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function(response){
            
                        let html = `
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Invoice No</th>
                                        <th>Billing Date</th>
                                        <th>Full Job No</th>
                                        <th>Billing Party</th>
                                        <th>Consignee</th>
                                        <th>Total Sales</th>
                                        <th>Total Purchase</th>
                                        <th>Profit/Loss</th>
                                    </tr>
                                </thead>
                                <tbody>
                        `;
                
                        response.data.forEach(function(row){
                            html += `
                                <tr>
                                    <td>${row.invoice_no}</td>
                                    <td>${row.invoice_date}</td>
                                    <td>${row.full_job_no}</td>
                                    <td>${row.party_name ?? '-'}</td>
                                    <td>${row.consignee}</td>
                                    <td>${row.sales_total}</td>
                                    <td>${row.purchase_total}</td>
                                    <td style="color:${row.profit_loss >= 0 ? 'green' : 'red'}">
                                        ${row.profit_loss}
                                    </td>
                                </tr>
                                `;
                        });
            
                        html += `
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="2">Grand Total Sales</th>
                                        <th>${response.grand_sales}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        `;
            
                        $('#reportPreview').html(html).show();
                    }
                });
            });

        })
    </script>
@endpush
