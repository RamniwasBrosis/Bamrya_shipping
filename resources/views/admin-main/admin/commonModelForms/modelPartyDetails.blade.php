<!-- Modal Party Details -->
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="modal fade" id="partyDetailsModal" tabindex="-1" aria-labelledby="oceanVslModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="oceanVslModalLabel">Party</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="modelPartyDetails" method="post" action="{{route('new-party.store')}}" enctype="multipart/form-data">
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
                        <label for="password" class="col-sm-4 col-form-label">Address Line 1:<span
                                class="text-danger">*</span></label>
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
                            <select class="form-control" name="party_type">
                                <option value="">select</option>
                                @foreach($party_lists as $type)
                                <option value="{{ $type->party_type }}">{{ $type->party_name }}</option>
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
                        <label for="" class="col-sm-4 col-form-label">State:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="state">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="" class="col-sm-4 col-form-label">State Code:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="state_code">
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
                            <select class="form-control" name="status" required>
                                <option value="1" selected>Active</option>
                                <option value="0">Deactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-grid d-md-flex justify-content-md-end">
                        <button class="btn btn-outline-primary" type="submit">Save</button>
                    </div>
                    
        
                    <small id="partyNameError" class="text-danger"></small>

                </form>
            </div>
        </div>
    </div>
</div>

