<div class="modal fade" id="partyDetailsModal" tabindex="-1" aria-labelledby="oceanVslModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="oceanVslModalLabel">Party</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="modelPartyDetailsEdit" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $partyDetails->id ?? '' }}">
                        <div class="mb-3 row">
                            <label for="" class="col-sm-4 col-form-label">Party Code:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="party_code" value="{{$partyDetails->party_code ?? ''}}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-4 col-form-label">Party Name:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="party_name" value="{{$partyDetails->party_name ?? ''}}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-4 col-form-label">Address Line 1:<span
                                class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="address_1" value="{{$partyDetails->address_line1 ?? ''}}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-4 col-form-label">Address Line 2:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="address_2" value="{{$partyDetails->address_line2 ?? ''}}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-4 col-form-label">City:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="city" value="{{$partyDetails->city ?? ''}}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-4 col-form-label">Pincode:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="pincode" value="{{$partyDetails->pincode ?? ''}}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-4 col-form-label">Party Type:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <select class="form-control wide" name="party_type" placeholder="Select">
                                    @foreach($party_lists as $party_list)
                                        <option value="{{ $party_list->id }}"
                                            {{ $party_list->id == ($partyDetails?->party_type) ? 'selected' : '' }}>
                                            {{ $party_list->party_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-4 col-form-label">Contact Person:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="contact_person" value="{{$partyDetails->contact_person ?? ''}}">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="" class="col-sm-4 col-form-label">Tel / Contact No:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="tel_no" value="{{$partyDetails->tel_no ?? ''}}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-4 col-form-label">Email:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="email" value="{{$partyDetails->email ?? ''}}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-4 col-form-label">GSTIN NO:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="gstin" value="{{$partyDetails->gstin ?? ''}}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-4 col-form-label">PAN No:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="pan_no" value="{{$partyDetails->pan_no ?? ''}}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-4 col-form-label">CIN No:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="cin_no" value="{{$partyDetails->cin_no ?? ''}}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-4 col-form-label">Credit Days:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="credit_days" value="{{$partyDetails->credit_days ?? ''}}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-4 col-form-label">State:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="state" value="{{$partyDetails->state ?? ''}}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-4 col-form-label">State Code:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="state_code" value="{{$partyDetails->state_code ?? ''}}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-4 col-form-label">TDS %:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="tds_percent" value="{{$partyDetails->tds_percent ?? ''}}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="file" class="col-sm-4 col-form-label">Document <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="file" class="form-control" name="documents[]" multiple>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-4 col-form-label">Status:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <select class="default-select  form-control wide" placeholder="Active" name="status">
                                    <option value="1" {{$partyDetails?->status == 1? 'selected' : ''}} >Active</option>
                                    <option value="0" {{$partyDetails?->status == 0? 'selected' : ''}}>Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="d-grid d-md-flex justify-content-md-end">
                            <button class="btn btn-outline-primary" type="submit">Update</button>
                        </div>
                    </form>
                    <div id="partyEditMessage"></div>
                </div>
            </div>
        </div>
    </div>