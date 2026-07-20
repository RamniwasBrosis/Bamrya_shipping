<div class="modal fade" id="AddNewPackageModal" tabindex="-1" aria-labelledby="oceanVslModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="oceanVslModalLabel">Add New Package</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addNewPackageModel" method="post" action="{{route('new-package.store')}}" autocomplete="off">
                    @csrf
                    <div class="mb-3 row">
                        <label for="password" class="col-sm-4 col-form-label">Package Code:<span
                                class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name='package_code'>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="password" class="col-sm-4 col-form-label">Description:</label>
                        <div class="col-sm-8">
                            <textarea class="form-control h-100" id="validationCustom04" rows="2" name='description'></textarea>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="password" class="col-sm-4 col-form-label">Status:<span
                                class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <select class="default-select  form-control wide" name='status'>
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