<!-- Modal Port Details -->
<div class="modal fade" id="addNewPortDetails" tabindex="-1" aria-labelledby="oceanVslModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="oceanVslModalLabel">Add New PORT</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="portDetailsModel" method="post" action="{{route('new-port.store')}}" autocomplete="off">
                    @csrf
                    <div class="mb-3 row">
                        <label for="password" class="col-sm-4 col-form-label">Port Code:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="port_code">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="password" class="col-sm-4 col-form-label">Port Name:<span
                                class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="port_name">
                        </div>
                    </div>
                    {{-- <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Address Line 1:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="">
                            </div>
                        </div> --}}
                    <div class="mb-3 row">
                        <label for="password" class="col-sm-4 col-form-label">EDI Code:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="edi_code">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="password" class="col-sm-4 col-form-label">JNPT Code:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="jnpt_code">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="password" class="col-sm-4 col-form-label">NSICT Code:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="nsict_code">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="password" class="col-sm-4 col-form-label">NSICT GROUP Code:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="nsict_group_code">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="password" class="col-sm-4 col-form-label">GTI Code:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="gti_code">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="password" class="col-sm-4 col-form-label">GTI GROUP Code:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="gti_group_code">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="password" class="col-sm-4 col-form-label">NSI GT Code:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="nsi_gt_code">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="password" class="col-sm-4 col-form-label">Status:<span
                                class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <select class="default-select  form-control wide" name="status">
                                <option value="1" selected>Active</option>
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