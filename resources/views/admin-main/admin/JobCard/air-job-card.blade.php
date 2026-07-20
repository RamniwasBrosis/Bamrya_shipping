@extends('admin-main.layouts.default')
@section('content')

<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Air Job Card</a></li>
    </ol>
</div>

<div class="container-fluid p-2">
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('airJobCard.print') }}" method="POST">
                        @csrf
                        <div class="row form-material">
                            <div class="col-xl-6 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Air Job No:</label>
                                <input type="text" class="form-control" name="air_job_no">
                            </div>
                            <div class="col-xl-6 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Air Job Date:</label>
                                <input type="date" class="form-control" name="air_job_date">
                            </div>
                            <div class="col-xl-6 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Bill No:</label>
                                <input type="text" class="form-control" name="bill_no">
                            </div>
                            <div class="col-xl-6 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Bill Date:</label>
                                <input type="date" class="form-control" name="bill_date">
                            </div>
                            <div class="col-xl-6 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Sale:</label>
                                <input type="text" class="form-control" name="sale">
                            </div>
                            <div class="col-xl-6 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Purchase:</label>
                                <input type="text" class="form-control" name="purchase">
                            </div>
                            <div class="col-xl-6 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Custom Clearance:</label>
                                <input type="text" class="form-control" name="custom_clearance">
                            </div>
                            <div class="col-xl-6 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Exporter Name:</label>
                                <input type="text" class="form-control" name="exporter_name">
                            </div>
                            <div class="col-xl-6 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Consignee Name:</label>
                                <input type="text" class="form-control" name="consignee_name">
                            </div>
                            <div class="col-xl-6 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Invoice No:</label>
                                <input type="text" class="form-control" name="invoice">
                            </div>
                            <div class="col-xl-6 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Invoice Date:</label>
                                <input type="date" class="form-control" name="invoice_date">
                            </div>
                            <div class="col-xl-6 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Box No:</label>
                                <input type="text" class="form-control" name="box_no">
                            </div>
                            <div class="col-xl-6 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Box Size:</label>
                                <input type="text" class="form-control" name="box_size">
                            </div>
                            <div class="col-xl-6 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Weight:</label>
                                <input type="text" class="form-control" name="weight">
                            </div>
                            <div class="col-xl-6 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">G. Weight:</label>
                                <input type="text" class="form-control" name="g_weight">
                            </div>
                            <div class="col-xl-6 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">V. Weight:</label>
                                <input type="text" class="form-control" name="v_weight">
                            </div>
                            <div class="col-xl-6 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Cbm:</label>
                                <input type="text" class="form-control" name="cbm">
                            </div>
                            <div class="col-xl-6 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Port Of Loading:</label>
                                <input type="text" class="form-control" name="pol">
                            </div>
                            <div class="col-xl-6 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Stuffing Date:</label>
                                <input type="date" class="form-control" name="stuffing_date">
                            </div>
                            <div class="col-xl-6 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Port Of Discharge:</label>
                                <input type="text" class="form-control" name="pod">
                            </div>
                            <div class="col-xl-6 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Air Line Name:</label>
                                <input type="text" class="form-control" name="air_line_name">
                            </div>
                            <div class="col-xl-6 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Vessel/Voy/Name:</label>
                                <input type="text" class="form-control" name="vessel_voy_name">
                            </div>
                            <div class="col-xl-6 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Awb No:</label>
                                <input type="text" class="form-control" name="awb_no">
                            </div>
                            <div class="col-xl-6 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Bl No:</label>
                                <input type="text" class="form-control" name="bl_no">
                            </div>
                            <div class="col-xl-6 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Container No. & Seal No.:</label>
                                <input type="text" class="form-control" name="container_seal_no">
                            </div>
                            <div class="col-xl-6 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Freight.:</label>
                                <input type="text" class="form-control" name="freight">
                            </div>
                            <div class="col-xl-6 col-xxl-6 col-md-6 mb-3 d-flex">
                                <label class="form-label d-block">Mode Of Shipment:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                            
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="mode_of_shipment" id="shipmentAir" value="Air">
                                    <label class="form-check-label" for="shipmentAir">
                                        Air
                                    </label>
                                </div>&nbsp;&nbsp;&nbsp;&nbsp;
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="mode_of_shipment" id="shipmentSea" value="Sea">
                                    <label class="form-check-label" for="shipmentSea">
                                        Sea
                                    </label>
                                </div>&nbsp;&nbsp;&nbsp;&nbsp;
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="mode_of_shipment" id="shipmentLCL" value="LCL">
                                    <label class="form-check-label" for="shipmentLCL">
                                        LCL
                                    </label>
                                </div>&nbsp;&nbsp;&nbsp;&nbsp;
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="mode_of_shipment" id="shipment2040" value="20/40">
                                    <label class="form-check-label" for="shipment2040">
                                        20/40
                                    </label>
                                </div>&nbsp;&nbsp;&nbsp;&nbsp;
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="mode_of_shipment" id="shipmentImport" value="Import">
                                    <label class="form-check-label" for="shipmentImport">
                                        Import
                                    </label>
                                </div>&nbsp;
                            </div>
                            <div class="col-xl-6 col-xxl-6 col-md-6 mb-3 d-flex">
                                <label class="form-label d-block">GSP:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gsp" id="gsp_yes" value="yes">
                                    <label class="form-check-label" for="gsp_yes">
                                        Yes
                                    </label>
                                </div>&nbsp;&nbsp;&nbsp;&nbsp;
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gsp" id="gsp_no" value="no">
                                    <label class="form-check-label" for="gsp_no">
                                        No
                                    </label>
                                </div>
                            </div>
                            <div class="col-xl-6 col-xxl-6 col-md-6 mb-3 d-flex">
                                <label class="form-label d-block">COC:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="coc" id="coc_yes" value="yes">
                                    <label class="form-check-label" for="coc_yes">
                                        Yes
                                    </label>
                                </div>&nbsp;&nbsp;&nbsp;&nbsp;
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="coc" id="coc_no" value="no">
                                    <label class="form-check-label" for="coc_no">
                                        No
                                    </label>
                                </div>
                            </div>
                            <div class="col-xl-6 col-xxl-6 col-md-6 mb-3 d-flex">
                                <label class="form-label d-block">Fumication:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="fumication" id="fumication_yes" value="yes">
                                    <label class="form-check-label" for="fumication_yes">
                                        Yes
                                    </label>
                                </div>&nbsp;&nbsp;&nbsp;&nbsp;
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="fumication" id="fumication_no" value="no">
                                    <label class="form-check-label" for="fumication_no">
                                        No
                                    </label>
                                </div>
                            </div>
                            <div class="col-xl-6 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">S/Bill No:</label>
                                <input type="text" class="form-control" name="s_bill_no">
                            </div>
                            <div class="col-xl-6 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">S/Bill Date:</label>
                                <input type="date" class="form-control" name="s_bill_date">
                            </div>
                            <div class="col-xl-6 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">EP Copy:</label>
                                <input type="text" class="form-control" name="ep_copy">
                            </div>
                            <div class="col-xl-6 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Forwarder Name:</label>
                                <input type="text" class="form-control" name="freight_forwarder_name">
                            </div>
                            <div class="col-xl-6 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">CHA Name:</label>
                                <input type="text" class="form-control" name="cha_name">
                            </div>
                            <div class="col-xl-6 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Debit Note No:</label>
                                <input type="text" class="form-control" name="debit_note_no">
                            </div>
                            <div class="col-xl-6 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Debit Note Date:</label>
                                <input type="date" class="form-control" name="debit_note_date">
                            </div>
                            <div class="col-xl-6 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Amounts:</label>
                                <input type="text" class="form-control" name="amounts">
                            </div>
                            <div class="col-xl-6 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Payment Condition:</label>
                                <input type="text" class="form-control" name="payment_condition">
                            </div>
                            <div class="col-xl-6 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Flight Details:</label>
                                <input type="text" class="form-control" name="flight_details">
                            </div>
                            <div class="col-xl-6 col-xxl-6 col-md-6 mb-3 d-flex">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="awb" id="awb" value="awb">
                                    <label class="form-check-label" for="awb">
                                        AWB
                                    </label>
                                </div>&nbsp;&nbsp;&nbsp;&nbsp;
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="leo" id="leo" value="leo">
                                    <label class="form-check-label" for="leo">
                                        LEO
                                    </label>
                                </div>&nbsp;&nbsp;&nbsp;&nbsp;
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="purchase_bill" id="purchase_bill" value="purchase_bill">
                                    <label class="form-check-label" for="purchase_bill">
                                        Purchase Bill
                                    </label>
                                </div>&nbsp;&nbsp;&nbsp;&nbsp;
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="sale_bill" id="sale_bill" value="sale_bill">
                                    <label class="form-check-label" for="sale_bill">
                                        Sale Bill
                                    </label>
                                </div>&nbsp;&nbsp;&nbsp;&nbsp;
                            </div>
                            <div class="col-xl-6 col-xxl-6 col-md-6 mb-3">
                                <label class="form-label">Remark:</label>
                                <input type="text" class="form-control" name="remark">
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-info">Print</button>
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
