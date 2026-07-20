<div class="modal fade" id="oceanVslModal" tabindex="-1" aria-labelledby="oceanVslModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="oceanVslModalLabel">Add New Vessel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="oceanVslForm" method="POST" action="{{ route('new-vessels.store') }}" autocomplete="off">
                    @csrf
                    <div class="mb-3 row">
                        <label for="vessel_name" class="col-sm-4 col-form-label">Vessel Name:<span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" name="vessel_name" id="vessel_name" class="form-control" placeholder="Enter vessel name" required value="{{ old('vessel_name') }}">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="vessel_call_sign" class="col-sm-4 col-form-label">Vessel Call Sign:</label>
                        <div class="col-sm-8">
                            <input type="text" name="vessel_call_sign" id="vessel_call_sign" class="form-control" placeholder="Enter call sign" value="{{ old('vessel_call_sign') }}">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="imo_code" class="col-sm-4 col-form-label">IMO Code:</label>
                        <div class="col-sm-8">
                            <input type="text" name="imo_code" id="imo_code" class="form-control" placeholder="Enter IMO code" value="{{ old('imo_code') }}">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="status" class="col-sm-4 col-form-label">Status:<span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <select name="status" id="status" class="form-control default-select wide" required>
                                <option value="1" selected>Active</option>
                                <option value="0">Inactive</option>
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