<!-- resources/views/common/salesperson_modal.blade.php -->

<div class="modal fade" id="salespersonModal" tabindex="-1" aria-labelledby="salespersonModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="salespersonForm">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Sales Person</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="salesperson_name" class="form-label">Name<span class="text-danger">*</span></label>
                    <input type="text" name="name" id="salesperson_name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" >
                </div><div class="mb-3">
                    <label for="number" class="form-label">Phone</label>
                    <input type="number" name="number" id="number" class="form-control" >
                </div>
                <div class="mb-3">
                    <label for="designation" class="form-label">Designation</label>
                    <input type="text" name="designation" id="designation" class="form-control" >
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
  </div>
</div>
