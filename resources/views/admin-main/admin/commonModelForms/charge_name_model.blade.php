<div class="modal fade" id="chargesNames" tabindex="-1" aria-labelledby="oceanVslModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="oceanVslModalLabel">Party</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('addChargesName.store') }}" method="POST" id="chargeForm" autocomplete="off">
                        @csrf
                        <div id="smartwizard" class="form-wizard order-create">
                            
                            <div class="row form-material">

                                <div class="col-xl-6 col-md-6 mb-3">
                                    <label class="form-label">HSN Code / Charge Code: <span class="text-danger">*</span></label>
                                    <input type="text" name="charge_code" class="form-control" value="{{ old('charge_code') }}">
                                    @error('charge_code') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="col-xl-6 col-md-6 mb-3">
                                    <label class="form-label">Charge Name: <span class="text-danger">*</span></label>
                                    <input type="text" name="charge_name" class="form-control" value="{{ old('charge_name') }}">
                                    @error('charge_name') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="col-xl-6 col-md-6 mb-3">
                                    <label class="form-label">Tally Ledger (Name):</label>
                                    <input type="text" name="tally_ledger_name" class="form-control" value="{{ old('tally_ledger_name') }}">
                                    @error('tally_ledger_name') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="col-xl-6 col-md-6 mb-3">
                                    <label class="form-label">Currency (I/U): <span class="text-danger">*</span></label>
                                    <select name="currency" class="form-control">
                                        <option value="">select</option>
                                        <option value="AED">AED</option>
                                        <option value="AUD">AUD</option>
                                        <option value="BGN">BGN</option>
                                        <option value="BRL">BRL</option>
                                        <option value="CAD">CAD</option>
                                        <option value="CHF">CHF</option>
                                        <option value="CNY">CNY</option>
                                        <option value="CSD">CSD</option>
                                        <option value="CZK">CZK</option>
                                        <option value="DKK">DKK</option>
                                        <option value="EEK">EEK</option>
                                        <option value="EGP">EGP</option>
                                        <option value="EUR">EUR</option>
                                        <option value="GBP">GBP</option>
                                        <option value="HKD">HKD</option>
                                        <option value="HRK">HRK</option>
                                        <option value="HUF">HUF</option>
                                        <option value="IDR">IDR</option>
                                        <option value="ILS">ILS</option>
                                        <option value="INR">INR</option>
                                        <option value="ISK">ISK</option>
                                        <option value="JPY">JPY</option>
                                        <option value="MXP">MXP</option>
                                        <option value="MYR">MYR</option>
                                        <option value="NOK">NOK</option>
                                        <option value="NZD">NZD</option>
                                        <option value="PHP">PHP</option>
                                        <option value="PLN">PLN</option>
                                        <option value="ROL">ROL</option>
                                        <option value="RUR">RUR</option>
                                        <option value="SAR">SAR</option>
                                        <option value="SEK">SEK</option>
                                        <option value="SGD">SGD</option>
                                        <option value="SIT">SIT</option>
                                        <option value="SKK">SKK</option>
                                        <option value="THB">THB</option>
                                        <option value="TRL">TRL</option>
                                        <option value="TWD">TWD</option>
                                        <option value="UAH">UAH</option>
                                        <option value="US">US</option>
                                        <option value="USD">USD</option>
                                    </select>
                                    @error('currency') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="col-xl-6 col-md-6 mb-3">
                                    <label class="form-label">Charge Type:</label>
                                    <select name="charge_type" class="form-control">
                                        <option value="">Select Service</option>
                                        <option value="Service" selected>Service</option>
                                        <option value="Freight">Freight</option>
                                        <option value="Normal">Normal</option>
                                    </select>
                                    @error('charge_type') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="col-xl-6 col-md-6 mb-3">
                                    <label class="form-label">GST Applicable: <span class="text-danger">*</span></label>
                                    <select name="gst_applicable" class="form-control">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                    @error('gst_applicable') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="col-xl-6 col-md-6 mb-3">
                                    <label class="form-label">GST %: <span class="text-danger">*</span></label>
                                    <select name="gst_percentage" class="form-control">
                                        <option value="0">0%</option>
                                        <option value="5">5%</option>
                                        <option value="12">12%</option>
                                        <option value="18">18%</option>
                                        <option value="28">28%</option>
                                    </select>
                                    @error('gst_percentage') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="col-xl-6 col-md-6 mb-3">
                                    <label class="form-label">Formula (Y/N):</label>
                                    <select name="has_formula" class="form-control">
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                    @error('has_formula') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="col-xl-6 col-md-6 mb-3">
                                    <label class="form-label">Limit:</label>
                                    <input type="text" name="limit" class="form-control" value="{{ old('limit') }}">
                                    @error('limit') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="col-xl-6 col-md-6 mb-3">
                                    <label class="form-label">Percentage:</label>
                                    <input type="text" name="percentage" class="form-control" value="{{ old('percentage') }}">
                                    @error('percentage') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                
                                <!--<div class="col-xl-6 col-md-6 mb-3">-->
                                <!--    <label class="form-label">SAC Code: <span class="text-danger">*</span></label>-->
                                <!--    <input type="text" name="sac_code" class="form-control" value="{{ old('sac_code') }}">-->
                                <!--    @error('sac_code') <small class="text-danger">{{ $message }}</small> @enderror-->
                                <!--</div>-->

                                <div class="col-xl-6 col-md-6 mb-3">
                                    <label class="form-label">Status: <span class="text-danger">*</span></label>
                                    <select name="status" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">In-Active</option>
                                    </select>
                                    @error('status') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                            </div>

                            <div class="col-4">
                                <button type="submit" class="btn btn-info">Save</button>
                            </div>

                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: 'Select a value',
            allowClear: true,
            width: '100%'
        })
    })
</script>
