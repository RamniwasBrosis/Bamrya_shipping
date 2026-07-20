@extends('admin-main.layouts.default')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li><h5 class="bc-title">Tally Invoice</h5></li>
    </ol>
</div>
<div class="container-fluid p-2">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header py-3 d-sm-flex d-block">
                    <h4 class="card-title mb-2">Tally Invoice</h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive active-projects style-1">
                        <table id="empoloyees-tblwrapper" class="table" id="example">
                            <thead>
                                <tr>
                                    <th>Voucher No</th>
                                    <th>Party Name</th>
                                    <th>Voucher Date</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($invoices as $inv)
                                    <tr>
                                        <td>{{ $inv->voucher_no }}</td>
                                        <td>{{ $inv->party_name }}</td>
                                        <td>{{ $inv->voucher_date }}</td>
                                        <td>{{ number_format($inv->amount, 2) }}</td>
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
    <!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>-->
    <!--<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>-->
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Select an option",
                allowClear: true
            });
        });
    </script>
    
    <!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>-->
    

@endpush