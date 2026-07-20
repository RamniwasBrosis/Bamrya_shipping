<!-- resources/views/common/salesperson_modal.blade.php -->

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="modal fade" id="BlTypeModule" tabindex="-1" aria-labelledby="BlTypeModule" aria-hidden="true">
    <div class="modal-dialog">
        <form id="blTypeForm" autocomplete="off">
            @csrf
            <div id="smartwizard" class="form-wizard order-create modal-content px-5 py-5">
                <div class="row form-material">

                    <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                        <label class="form-label">BL Description: <span class="text-danger">*</span></label>
                        <input type="text" name="bl_description" class="form-control" value="{{ old('bl_description') }}">
                        @error('bl_description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-xl-3 col-xxl-12 col-md-6 mb-3">
                        <label class="form-label">Status: <span class="text-danger">*</span></label>
                        <select name="status" class="form-control default-select wide">
                            <!--<option value="">Select Status</option>-->
                            <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                </div>
                <div class="col-4 mt-2">
                    <button type="submit" class="btn btn-info">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>