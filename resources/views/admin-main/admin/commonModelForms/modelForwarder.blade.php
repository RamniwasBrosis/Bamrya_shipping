<div class="modal fade" id="modelForwarderDetails" tabindex="-1" aria-labelledby="oceanVslModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="oceanVslModalLabel">Add New Fordwarder</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                    <form action="{{ route('forwarder.store') }}" method="POST" id="modelForwarderForms" autocomplete="off">
                        @csrf
                        <div class="row form-material">
                            {{-- col-xl-3 col-md-6 mb-3 --}}
                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">Party Code:</label>
                                <input type="text" class="form-control" name="party_code">
                            </div>
                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">Party Name:</label><span class="text-danger">*</span>
                                <input type="text" class="form-control" name="party_name" required>
                            </div>
                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">Ledger Name (Tally):</label><span class="text-danger">*</span>
                                <input type="text" class="form-control" name="tally_ledger" required>
                            </div>
                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">Address Line 1:</label>
                                <input type="text" class="form-control" name="address_line1">
                            </div>
                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">Address Line 2:</label>
                                <input type="text" class="form-control" name="address_line2">
                            </div>
                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">Address Line 3:</label>
                                <input type="text" class="form-control" name="address_line3">
                            </div>
                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">City:</label>
                                <input type="text" class="form-control" name="city">
                            </div>
                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">Pincode:</label>
                                <input type="text" class="form-control" name="pincode">
                            </div>
                            <!--<div class="col-xl-3 col-xxl-12 col-md-6 mb-3">-->
                            <!--    <label class="form-label">Party Type:</label><span class="text-danger">*</span>-->
                            <!--    <select class="default-select  form-control wide" name="party_type">-->
                            <!--        <option value="">--select--</option>-->
                            <!--        @foreach ($party_lists as $party)-->
                            <!--            <option value="{{$party->id}}">{{$party->party_name}}</option>                                        -->
                            <!--        @endforeach-->
                            <!--    </select>-->
                            <!--</div>-->
                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">Contact Person:</label>
                                <input type="text" class="form-control" name="contact_person">
                            </div>
                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">Tel / Contact No:</label>
                                <input type="text" class="form-control" name="tel_no">
                            </div>
                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">Email:</label>
                                <input type="email" class="form-control" name="email">
                            </div>
                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">GSTIN No:</label>
                                <input type="text" class="form-control" name="gstin">
                            </div>
                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">PAN No:</label>
                                <input type="text" class="form-control" name="pan_no">
                            </div>
                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">CIN No:</label>
                                <input type="text" class="form-control" name="cin_no">
                            </div>
                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">Credit Days:</label>
                                <input type="number" class="form-control" name="credit_days">
                            </div>
                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">TDS %:</label>
                                <input type="text" class="form-control" name="tds_percent">
                            </div>
                            <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                                <label class="form-label">Status:</label><span class="text-danger">*</span>
                                <select class="form-control" name="status" required>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-info">Save</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>