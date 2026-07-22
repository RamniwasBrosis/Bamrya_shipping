@extends('admin-main.layouts.default')

@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Edit Charge</a></li>
    </ol>
    <a class="text-primary fs-13" href="{{ route('charges.index') }}">+ Back Charge</a>
</div>

<div class="container-fluid p-2">
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('charges.update', $charge->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div id="smartwizard" class="form-wizard order-create">
                            <input type="hidden" name="company_id" value="{{$charge->company_id}}">
                            <div class="row form-material">

                                <div class="col-xl-3 col-md-6 mb-3">
                                    <label class="form-label">HSN/SAC CODE: <span class="text-danger">*</span></label>
                                    <input type="text" name="charge_code" class="form-control" value="{{ old('charge_code', $charge->charge_code) }}">
                                    @error('charge_code') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="col-xl-3 col-md-6 mb-3">
                                    <label class="form-label">Charge Name: <span class="text-danger">*</span></label>
                                    <input type="text" name="charge_name" class="form-control" value="{{ old('charge_name', $charge->charge_name) }}">
                                    @error('charge_name') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="col-xl-3 col-md-6 mb-3">
                                    <label class="form-label">Tally Ledger (Name):</label>
                                    <input type="text" name="tally_ledger_name" class="form-control" value="{{ old('tally_ledger_name', $charge->tally_ledger_name) }}">
                                    @error('tally_ledger_name') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
    
                                <div class="col-xl-3 col-md-6 mb-3">
                                    <label class="form-label">Currency (I/U): <span class="text-danger">*</span></label>
                                    <select name="currency" class="form-control">
                                        <option value="AED" {{ $charge->currency == 'AED' ? 'selected' : '' }}>AED</option>
                                        <option value="AUD" {{ $charge->currency == 'AUD' ? 'selected' : '' }}>AUD</option>
                                        <option value="BGN" {{ $charge->currency == 'BGN' ? 'selected' : '' }}>BGN</option>
                                        <option value="BRL" {{ $charge->currency == 'BRL' ? 'selected' : '' }}>BRL</option>
                                        <option value="CAD" {{ $charge->currency == 'CAD' ? 'selected' : '' }}>CAD</option>
                                        <option value="CHF" {{ $charge->currency == 'CHF' ? 'selected' : '' }}>CHF</option>
                                        <option value="CNY" {{ $charge->currency == 'CNY' ? 'selected' : '' }}>CNY</option>
                                        <option value="CSD" {{ $charge->currency == 'CSD' ? 'selected' : '' }}>CSD</option>
                                        <option value="CZK" {{ $charge->currency == 'CZK' ? 'selected' : '' }}>CZK</option>
                                        <option value="DKK" {{ $charge->currency == 'DKK' ? 'selected' : '' }}>DKK</option>
                                        <option value="EEK" {{ $charge->currency == 'EEK' ? 'selected' : '' }}>EEK</option>
                                        <option value="EGP" {{ $charge->currency == 'EGP' ? 'selected' : '' }}>EGP</option>
                                        <option value="EUR" {{ $charge->currency == 'EUR' ? 'selected' : '' }}>EUR</option>
                                        <option value="GBP" {{ $charge->currency == 'GBP' ? 'selected' : '' }}>GBP</option>
                                        <option value="HKD" {{ $charge->currency == 'HKD' ? 'selected' : '' }}>HKD</option>
                                        <option value="HRK" {{ $charge->currency == 'HRK' ? 'selected' : '' }}>HRK</option>
                                        <option value="HUF" {{ $charge->currency == 'HUF' ? 'selected' : '' }}>HUF</option>
                                        <option value="IDR" {{ $charge->currency == 'IDR' ? 'selected' : '' }}>IDR</option>
                                        <option value="ILS" {{ $charge->currency == 'ILS' ? 'selected' : '' }}>ILS</option>
                                        <option value="INR" {{ $charge->currency == 'INR' ? 'selected' : '' }}>INR</option>
                                        <option value="ISK" {{ $charge->currency == 'ISK' ? 'selected' : '' }}>ISK</option>
                                        <option value="JPY" {{ $charge->currency == 'JPY' ? 'selected' : '' }}>JPY</option>
                                        <option value="MXP" {{ $charge->currency == 'MXP' ? 'selected' : '' }}>MXP</option>
                                        <option value="MYR" {{ $charge->currency == 'MYR' ? 'selected' : '' }}>MYR</option>
                                        <option value="NOK" {{ $charge->currency == 'NOK' ? 'selected' : '' }}>NOK</option>
                                        <option value="NZD" {{ $charge->currency == 'NZD' ? 'selected' : '' }}>NZD</option>
                                        <option value="PHP" {{ $charge->currency == 'PHP' ? 'selected' : '' }}>PHP</option>
                                        <option value="PLN" {{ $charge->currency == 'PLN' ? 'selected' : '' }}>PLN</option>
                                        <option value="ROL" {{ $charge->currency == 'ROL' ? 'selected' : '' }}>ROL</option>
                                        <option value="RUR" {{ $charge->currency == 'RUR' ? 'selected' : '' }}>RUR</option>
                                        <option value="SAR" {{ $charge->currency == 'SAR' ? 'selected' : '' }}>SAR</option>
                                        <option value="SEK" {{ $charge->currency == 'SEK' ? 'selected' : '' }}>SEK</option>
                                        <option value="SGD" {{ $charge->currency == 'SGD' ? 'selected' : '' }}>SGD</option>
                                        <option value="SIT" {{ $charge->currency == 'SIT' ? 'selected' : '' }}>SIT</option>
                                        <option value="SKK" {{ $charge->currency == 'SKK' ? 'selected' : '' }}>SKK</option>
                                        <option value="THB" {{ $charge->currency == 'THB' ? 'selected' : '' }}>THB</option>
                                        <option value="TRL" {{ $charge->currency == 'TRL' ? 'selected' : '' }}>TRL</option>
                                        <option value="TWD" {{ $charge->currency == 'TWD' ? 'selected' : '' }}>TWD</option>
                                        <option value="UAH" {{ $charge->currency == 'UAH' ? 'selected' : '' }}>UAH</option>
                                        <option value="US" {{ $charge->currency == 'US' ? 'selected' : '' }}>US</option>
                                        <option value="USD" {{ $charge->currency == 'USD' ? 'selected' : '' }}>USD</option>
                                        <option value="OTH" {{ $charge->currency == 'Others' ? 'selected' : '' }}>Others</option>
                                    </select>
                                    @error('currency') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="col-xl-3 col-md-6 mb-3">
                                    <label class="form-label">Charge Type:</label>
                                    <select name="charge_type" class="form-control">
                                        <option value="Freight" {{ $charge->charge_type == 'Freight' ? 'selected' : '' }}>Freight</option>
                                        <option value="Normal" {{ $charge->charge_type == 'Normal' ? 'selected' : '' }}>Normal</option>
                                    </select>
                                    @error('charge_type') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="col-xl-3 col-md-6 mb-3">
                                    <label class="form-label">GST Applicable: <span class="text-danger">*</span></label>
                                    <select name="gst_applicable" class="form-control">
                                        <option value="1" {{ $charge->gst_applicable == 1 ? 'selected' : '' }}>Yes</option>
                                        <option value="0" {{ $charge->gst_applicable == 0 ? 'selected' : '' }}>No</option>
                                    </select>
                                    @error('gst_applicable') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="col-xl-3 col-md-6 mb-3">
                                    <label class="form-label">GST %: <span class="text-danger">*</span></label>
                                    <select name="gst_percentage" class="form-control">
                                        <option value="0" {{ $charge->gst_percentage == 0 ? 'selected' : '' }}>0%</option>
                                        <option value="5" {{ $charge->gst_percentage == 5 ? 'selected' : '' }}>5%</option>
                                        <option value="12" {{ $charge->gst_percentage == 12 ? 'selected' : '' }}>12%</option>
                                        <option value="18" {{ $charge->gst_percentage == 18 ? 'selected' : '' }}>18%</option>
                                        <option value="28" {{ $charge->gst_percentage == 28 ? 'selected' : '' }}>28%</option>
                                    </select>
                                    @error('gst_percentage') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                
                                <div class="col-xl-3 col-md-6 mb-3">
                                    <label class="form-label">TDS%: </label>
                                    <input type="number" name="tds_percentage" class="form-control" value="{{ old('tds_percentage', $charge->tds_percentage) }}">
                                    @error('tds_percentage') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="col-xl-3 col-md-6 mb-3">
                                    <label class="form-label">Formula (Y/N):</label>
                                    <select name="has_formula" class="form-control">
                                        <option value="0" {{ $charge->has_formula == 0 ? 'selected' : '' }}>No</option>
                                        <option value="1" {{ $charge->has_formula == 1 ? 'selected' : '' }}>Yes</option>
                                    </select>
                                    @error('has_formula') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="col-xl-3 col-md-6 mb-3">
                                    <label class="form-label">Limit:</label>
                                    <input type="text" name="limit" class="form-control" value="{{ old('limit', $charge->limit) }}">
                                    @error('limit') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="col-xl-3 col-md-6 mb-3">
                                    <label class="form-label">Percentage:</label>
                                    <input type="text" name="percentage" class="form-control" value="{{ old('percentage', $charge->percentage) }}">
                                    @error('percentage') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <!--<div class="col-xl-3 col-md-6 mb-3">-->
                                <!--    <label class="form-label">SAC Code: <span class="text-danger">*</span></label>-->
                                <!--    <input type="text" name="sac_code" class="form-control" value="{{ old('sac_code', $charge->sac_code) }}">-->
                                <!--    @error('sac_code') <small class="text-danger">{{ $message }}</small> @enderror-->
                                <!--</div>-->

                                <div class="col-xl-3 col-md-6 mb-3">
                                    <label class="form-label">Status: <span class="text-danger">*</span></label>
                                    <select name="status" class="form-control">
                                        <option value="1" {{ $charge->status == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $charge->status == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('status') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                            </div>

                            <div class="col-4">
                                <button type="submit" class="btn btn-info">Update</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#smartwizard').smartWizard();
});
</script>
@endpush
