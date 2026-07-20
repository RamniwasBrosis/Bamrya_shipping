<div class="modal fade" id="shippingModelDetails" tabindex="-1" aria-labelledby="oceanVslModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="oceanVslModalLabel">Add New Shipping Line</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('new-shipping-line.store') }}" method="POST" id="shippingLineForm" autocomplete="off">
                    @csrf
                
                    <div class="row form-material">
                        <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                            <label class="form-label">Shipping Line Code:</label>
                            <input type="text" name="shipping_line_code" class="form-control">
                        </div>
                        <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                            <label class="form-label">Shipping Line Name: <span class="text-danger">*</span></label>
                            <input type="text" name="shipping_line_name" class="form-control" required>
                        </div>
                        <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                            <label class="form-label">Address Line 1: <span class="text-danger">*</span></label>
                            <input type="text" name="address_line_1" class="form-control" required>
                        </div>
                        <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                            <label class="form-label">Address Line 2:</label>
                            <input type="text" name="address_line_2" class="form-control">
                        </div>
                        <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                            <label class="form-label">Agent Code:</label>
                            <input type="text" name="agent_code" class="form-control">
                        </div>
                        <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                            <label class="form-label">Line Code:</label>
                            <input type="text" name="line_code" class="form-control">
                        </div>
                        <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                            <label class="form-label">ShippingLine Type: <span class="text-danger">*</span></label>
                            <select name="shipping_line_type" class="form-control" required>
                                <option value="">Select</option>
                                <option value="1">Indian</option>
                                <option value="2">Overseas</option>
                            </select>
                        </div>
                        <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                            <label class="form-label">Status: <span class="text-danger">*</span></label>
                            <select name="status" class="form-control" required>
                                <option value="">Select</option>
                                <option value="1" selected>Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-info">Save</button>
                    </div>
                </form>
                <div id="shipping-error-msg"></div>
            </div>
        </div>
    </div>
</div>