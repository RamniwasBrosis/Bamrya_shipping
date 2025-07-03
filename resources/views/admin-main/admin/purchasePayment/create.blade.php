@extends('admin-main.layouts.default')
@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Purchase Payment</a></li>
        </ol>
        <a class="text-primary fs-13" href="{{ url('admin/purchase-payment') }}"><- Go Back</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="mb-2">{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif



    <div class="container-fluid p-2">
        <!-- row -->
        <div class="row">
            <div class="col-xl-12 col-xxl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add New Purchase Payment</h4>
                    </div>
                    <div class="card-header">
                        <h4 class="card-title">Select Invoice Details</h4>
                    </div>
                    <div class="card-body">
                        <div id="smartwizard" class="form-wizard order-create">
                            <div class="row form-material">
                                <div class="form-validation">
                                    <form class="needs-validation" method="post" action="{{route('purchase-payment.store')}}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="mb-3 row">
                                                    <label class="col-sm-3 col-form-label">Billing Party:</label>
                                                    <div class="col-sm-9">
                                                        <div class="d-flex">
                                                            <select class="form-control me-2" placeholder="Select" name="billing_party_id">
                                                                <option value="">select</option>
                                                                @foreach ($parties as $party)
                                                                    <option value="{{$party->id}}">{{$party->party_name}}"</option>
                                                                @endforeach
                                                            </select>
                                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                                data-bs-toggle="modal" data-bs-target="#partyDetailsModal">
                                                                <i class="bi bi-plus-lg">+</i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-xl-6">
                                                <div class="mb-3 row">
                                                    <label class="col-sm-3 col-form-label">Invoice F-Year:</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control me-2" placeholder="Select" name="invoice_f_year">
                                                            <option value="">select</option>
                                                            <option value="2020-21">2020-21</option>
                                                            <option value="2021-22">2021-22</option>
                                                            <option value="2022-23">2022-23</option>
                                                            <option value="2023-24">2023-24</option>
                                                            <option value="2024-25">2024-25</option>
                                                            <option value="2025-26">2025-26</option>
                                                            <option value="2026-27">2026-27</option>
                                                            <option value="2027-28">2027-28</option>
                                                            <option value="2028-29">2028-29</option>
                                                            <option value="2029-30">2029-30</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="mb-3 row">
                                                    <label class="col-sm-3 col-form-label">P.P. Date:</label>
                                                    <div class="col-sm-9">
                                                        <input type="date" class="form-control" name="pp_date" value="{{date('Y-m-d')}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-12 d-flex">
                                                <div class="me-4">
                                                    <input type="radio" name="radio_type" id="onaccount" value="onaccount" checked>
                                                    <label for="">ONACCOUTN</label>
                                                </div>
                                                <div>
                                                    <input type="radio" name="radio_type" id="neft_cash" value="neft_cash" >
                                                    <label for="">NEFT/CASH</label>
                                                </div>
                                                
                                            </div>
                                            <div id="Bank_Details" style="display: none;">
                                                <div class="row">
                                                    <div class="col-xl-4">
                                                        <label class="col-form-label">Cash/Bank/Neft Details:</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" name="neft_details" >
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4">
                                                        <label class=" col-form-label">Neft/Cheque Date:</label>
                                                        <div class="col-sm-9">
                                                            <input type="date" class="form-control" name="neft_date" >
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4">
                                                        <label class="col-form-label">Bank Name:</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" name="bank_name" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <label class="col-form-label">Total Amount Payable:</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" name="total_amount_payable" >
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <label class="col-form-label">Billing Party:</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" name="billing_party" >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                                <a href="{{route('purchase-payment.index')}}" type="button" class="btn btn-warning btn-sm">Cancle</a>
                                                <button type="submit" class="btn btn-primary btn-sm">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <h4>Enter Payment Details</h4>
                            <hr>
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Inv. Type:<span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select class="default-select form-control wide" placeholder="Select"></select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Pur. Inv. No:<span
                                            class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Modal Party Details -->
    <div class="modal fade" id="partyDetailsModal" tabindex="-1" aria-labelledby="oceanVslModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="oceanVslModalLabel">Party</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="oceanVslForm" method="post" action="{{route('new-party.store')}}">
                        @csrf
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Party Code:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="party_code">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Party Name:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="party_name">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Address Line 1:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="address_1">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Address Line 2:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="address_2">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Address Line 3:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="address_3">
                            </div>
                        </div>
                        {{-- <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Address Line 4:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="">
                            </div>
                        </div> --}}
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">City:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="city">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Pincode:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="pincode">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Party Type:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <select class="default-select  form-control wide" name="party_type" placeholder="Select">
                                    <option value="">select</option>
                                    @foreach ($partyNames as $partyName)
                                        <option value="{{$partyName->id}}">{{$partyName->party_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Contact Person:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="contact_person">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Tel / Contact No:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="tel_no">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Email:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="email">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">GSTIN NO:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="gstin">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">PAN No:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="pan_no">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">CIN No:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="cin_no">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Credit Days:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="credit_days">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">TDS %:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="tds_percent">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Status:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <select class="default-select  form-control wide" name="status" placeholder="Active">
                                    <option value="">select</option>
                                    <option value="1">Active</option>
                                    <option value="0">Deactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="d-grid d-md-flex justify-content-md-end">
                            <button class="btn btn-outline-primary" type="submit">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add New Charge Details -->
    <div class="modal fade" id="AddNewChargeDetailsModal" tabindex="-1" aria-labelledby="oceanVslModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="oceanVslModalLabel">Party</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="oceanVslForm">
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Party Code:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Charge Name:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Tally Ledger(Name):<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Rs/Other Currency(I/U):</label>
                            <div class="col-sm-8">
                                <select class="default-select form-control wide me-2" placeholder="Select"></select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Type CHG:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <select class="default-select form-control wide me-2" placeholder="Select"></select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">GST:</label>
                            <div class="col-sm-8">
                                <select class="default-select form-control wide me-2" placeholder="Select"></select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">GST %:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <select class="default-select form-control wide me-2" placeholder="Select"></select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Formula (Y/N):</label>
                            <div class="col-sm-8">
                                <select class="default-select form-control wide me-2" placeholder="Select"></select>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Limit:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Percentage:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">SAC Code:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Status:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <select class="default-select  form-control wide" placeholder="Active"></select>
                            </div>
                        </div>
                        <div class="d-grid d-md-flex justify-content-md-end">
                            <button class="btn btn-outline-primary" type="button">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        $(document).ready(function() {
            $('#smartwizard').smartWizard();
        });

        $(document).ready(function () {
            function toggleBankDetails() {
                // Check which radio is selected
                const selectedType = $('input[name="radio_type"]:checked').next('label').text().trim();

                if (selectedType === 'NEFT/CASH') {
                    $('#Bank_Details').show();
                } else {
                    $('#Bank_Details').hide();
                }
            }

            // Initially run on page load
            toggleBankDetails();

            // Bind change event
            $('input[name="radio_type"]').on('change', function () {
                toggleBankDetails();
            });
        });

    </script>
@endpush
