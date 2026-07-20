<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>Air Waybill</title>
<style>
  /* Only for print sizing - rest is inline */
    @page { size: A4; margin: 5mm; }
    @media print {
        /* Improve print quality */
        * {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
            color-adjust: exact !important;
        }
        
        body {
            font-smooth: always !important;
            -webkit-font-smoothing: antialiased !important;
            -moz-osx-font-smoothing: grayscale !important;
        }
        
        table, td, th {
            border-color: #000 !important;
            background-color: #fff !important;
        }
    }
    
    /* Ensure crisp fonts */
    .container, table, td, th, div, span {
        text-rendering: optimizeLegibility !important;
        -webkit-font-smoothing: antialiased !important;
        -moz-osx-font-smoothing: grayscale !important;
    }
    
    .border-crav {
        position: relative;
        display: inline-block;
        font-family: Arial, sans-serif;
        font-size: 14px;
        font-weight: bold;
        color: #333;
        text-align: center;
        border-bottom:1px solid #000;
    }

    .border-crav::before {
        content: "";
        position: absolute;
        top: -2px;
         left: -6px;
        right: -10px;
        background-color: #000;
        transform: rotate(-30deg);
        height:120%;
        width:1px;
        z-index: 1; 
    }
    .border-crav::after {
        content: "";
        position: absolute;
        top: -2px;
        right: -6px;
        background-color: #000;
        transform: rotate(30deg);
        height:120%;
        width:1px;
        z-index: 1;
    }
</style>
</head>
<body>
  <div class="container" style="font-family: Arial, sans-serif; font-size: 10px; max-width: 880px; margin: 0 auto; background-color: #fff; color: #000; line-height: 1.3;">
    
    <!-- Header Numbers -->
    <div style="display: flex; justify-content: space-between; margin-bottom: 3px; font-weight: bold; font-size: 18px;">
      <span>{{$airImportDraftData->hbl_no}}</span>
      <span>HAWB NO.-{{$airImportDraftData->hbl_no}}</span>
    </div>

    <!-- Main Table -->
    <table style="width: 100%; border-collapse: collapse; border: 1px solid #000;">
      <tbody>
        <!-- Row 1 -->
        <tr>
          <td rowspan="2" style="border: 1px solid #000; border-top: none;border-left: none; font-size: 10px; padding:4px 6px; vertical-align: top; width: 50%;">
            <div style="display: flex;">
                <div style="font-size: 10px; width:50%;padding: 4px 6px; color: #555; margin-bottom: 2px;">Shipper's Name and Address</div>
                <div style="font-size: 10px; width:50%;padding: 4px 6px; color: #555; margin-bottom: 2px; border-left:1px solid #000; border-bottom:1px solid #000">Shipper's Name and Address</div>
            </div>
            <div style="font-weight: bold; font-size: 11px;">{{$airImportDraftData->shipperName->party_name ?? ''}}</div>
            <div style="font-weight: normal; font-size: 10px;">{{$airImportDraftData->shipperName->address_line1 ?? ''}}</div>
            <div style="font-weight: normal; font-size: 10px;">{{$airImportDraftData->shipperName->address_line2 ?? ''}}</div>
            <div style="font-weight: normal; font-size: 10px;">{{$airImportDraftData->shipperName->city ?? ''}} &nbsp;-&nbsp; {{$airImportDraftData->shipperName->pincode ?? ''}}</div>
            <div style="font-weight: normal; font-size: 10px;">{{$airImportDraftData->shipperName->tel_no ?? ''}}</div>
          </td>
          <td style="border: 1px solid #000;border-left:none;border-top:none;border-bottom:none; padding: 4px 6px; font-size: 10px; vertical-align: top; width: 50%;">
              <div style="display: flex; width: 100%;">
                  <div style="width: 50%;">
                    <div style="color: #555; margin-bottom: 2px;">Not Negotiable</div>
                    <div style="font-weight: bold; font-size: 14px; margin-top: 3px;">Air Waybill</div>
                    <div style="margin-top: 5px;">
                      <span style="font-size:8px;">Issued by</span>
                      <br>
                          <table style="width:100%; font-size:8px; border-collapse:collapse;">
                            <tr>
                                <td style="vertical-align:top; width:100%;">
                                    <span style="font-weight:bold;">
                                        {{ $company->company_name }}
                                    </span><br>
                        
                                    {!! wordwrap($company->address, 43, '<br>', true) !!}<br>
                        
                                    CIN: {{ $company->companySetting->cin_no }}<br>
                        
                                    GSTIN: {{ $company->companySetting->gstin_no }}
                                </td>
                            </tr>
                        </table>
                    </div>  
                  </div>
                  <div style="width: 50%;">
                      <img
                        src="{{$companyLogo}}"
                        style="width:70%;margin-top: 20px;"
                    >
                  </div>
              </div>
          </td>
        </tr>
        <tr>
          <td colspan="2" style="border: 1px solid #000;border-left: none; padding: 4px 6px; font-size: 10px; vertical-align: top;">
            Copies 1, 2 and 3 of this Air Waybill are originals and have the same validity.
          </td>
        </tr>

        <!-- Row 2 - Consignee -->
        <tr>
          <td rowspan="2" style="border: 1px solid #000;border-top: none;border-left: none; padding: 4px 6px; font-size: 10px; vertical-align: top;">
            <div style="font-size: 10px; color: #555; margin-bottom: 2px;">Consignee's Name and Address</div><br>
            <div style="font-weight: bold; font-size: 10px;">{{$airImportDraftData->ConsigneeName->party_name ?? ''}}</div>
            <div>{{$airImportDraftData->ConsigneeName->address_line1 ?? ''}}</div>
            <div>{{$airImportDraftData->ConsigneeName->address_line2 ?? ''}}</div>
            <div>{{$airImportDraftData->ConsigneeName->tel_no ?? ''}} &nbsp; {{$airImportDraftData->ConsigneeName->email ?? ''}}</div>
          </td>
       
          <td rowspan="2" style="border: 1px solid #000;border-top: none;border-left: none; padding: 4px 6px; font-size: 8px; line-height: 1.2; vertical-align: top;">
            <span style="font-size:11px;">It is agreed that the goods described herein are accepted in apparent good order and condition
            (except as noted) for carriage </span> SUBJECT TO THE CONDITIONS OF CONTRACT ON THE REVERSE
            HEREOF. ALL GOODS MAY BE CARRIED BY ANY OTHER MEANS INCLUDING ROAD OR ANY OTHER
            CARRIER UNLESS SPECIFIC CONTRARY INSTRUCTIONS ARE GIVEN HEREON BY THE SHIPPER, AND
            SHIPPER AGREES THAT THE SHIPMENT MAY BE CARRIED VIA INTERMEDIATE STOPPING PLACES
            WHICH THE CARRIER DEEMS APPROPRIATE. THE SHIPPERS ATTENTION IS DRAWN TO THE NOTICE
            CONCERNING CARRIERS LIMITATION OF LIABILITY. <span style="font-size:11px;"> Shipper may increase such limitation of liability
            by declaring a higher value for carriage and paying a supplemental charge if required.
            </span>
          </td>
        </tr>

        <tr>
          <!--<td style="border: 1px solid #000; padding: 4px 6px; font-size: 10px; vertical-align: top;"></td>-->
        </tr>

        <!-- Row 3 - Issuing Carrier -->
        <tr>
          <td style="border: 1px solid #000;border-top: none;border-left: none; padding: 4px 6px; font-size: 10px; vertical-align: top;">
            <div style="font-size: 10px; color: #555; margin-bottom: 2px;">Issuing Carrier's Agent Name and City</div>
            <div style="font-size: 10px;">
                {{ $company->company_name }}
                <br> 
                {{ $company->address }}
            </div>
          </td>
          <td colspan="2" style="border: 1px solid #000;border-top: none;border-left: none;border-bottom: none; padding: 4px 6px; font-size: 10px; vertical-align: top;">
            <div style="font-size: 10px; color: #555; margin-bottom: 2px;">Accounting Information</div>
            <div style="font-weight: bold; font-size: 10px;">
                {{$airImportDraftData->accounting_information ?? ''}}<br>
                {{$airImportDraftData->mawb_no}}
            </div>
          </td>
        </tr>

        <!-- Row 4 - Agent IATA -->
        <tr>
          <td style="border: 1px solid #000;border-top: none;border-left: none; padding: 4px 6px; font-size: 10px; vertical-align: top;">
            <table style="width:100%; border-collapse: collapse;">
              <tbody>
                <tr>
                  <td style="width: 50%; padding-right: 10px; vertical-align: top;">
                    <div style="font-size: 10px; color: #555; margin-bottom: 2px;">Agent's IATA Code</div>
                    <div style="font-weight: bold; font-size: 10px;">{{$airImportDraftData->iata_code ?? 'N/A'}}</div>
                  </td>
                  <td style="width: 50%; border-left: 1px solid #000; padding-left: 10px; vertical-align: top;">
                    <div style="font-size: 10px; color: #555; margin-bottom: 2px;">Account No.</div>
                  </td>
                </tr>
              </tbody>
            </table>
          </td>
          <td colspan="2" style="border: 1px solid #000;border-top: none;border-left: none; padding: 4px 6px; font-size: 10px; vertical-align: top;"></td>
        </tr>

        <!-- Row 5 - Airport of Departure -->
        <tr>
          <td style="border: 1px solid #000;border-top: none;border-left: none; padding: 4px 6px; font-size: 10px; vertical-align: top;">
            <div style="font-size: 10px; color: #555; margin-bottom: 2px;">Airport of Departure (Addr. of First Carrier) and Requested Routing</div>
            <div style="font-weight: bold; font-size: 10px;">{{$airImportDraftData->loadingPortName->port_name ?? 'N/A'}}</div>
          </td>
          <td style="border: 1px solid #000;border-top: none;border-left: none;  font-size: 10px; vertical-align: top;padding: 0;" colspan="2">
              <div style=" padding: 0;display: flex;">
                <div style="width: 30%;"><div style="font-size: 10px; padding: 4px 10px; color: #555;">Reference Number</div> </div>
                <div colspan="2" style="width: 70%;"><div class="border-crav" style="font-size: 10px; padding: 4px 20px; color: #555;">Optional Shipping Information</div></div>
              </div>
              <div style=" padding: 0; display: flex;">
                <div style="width: 33%; border-right:1px solid #000;">&nbsp;</div>
                <div style="width: 33%;border-right:1px solid #000">&nbsp;</div>
                <div>&nbsp;</div>
              </div>
          </td>
        </tr>

        <!-- Row 6 - Routing -->
        <tr>
          <td style="border: 1px solid #000;border-top: none;border-left: none; padding: 0; vertical-align: top;">
            <table style="width:100%; height: 100%; border-collapse: collapse;" >
              <tbody>
                <tr style="height: 49px;">
                  <td style="width: 10%; border-bottom:none; padding:2px; text-align:center; width:10%;  text-align: left">
                    <div style="display: flex; flex-direction: column; justify-content: space-between;gap: 7px;">
                    <div style="font-size:11px; color: #555; ">to</div>
                    <div  style="font-size: 12px;">{{$airImportDraftData->to_air ?? ''}}</div>
                    </div>
                  </td>
                  <td style="border-left:1px solid #000; border-bottom:none; width: 50%; padding:4px; font-size:8px; text-align:center; position:relative; vertical-align: top; text-align: left">
                    <div style="display:flex;justify-content: space-between;">
                      <div style="font-size:10px; color: #555; ">By First Carrier</div>
                      <div class="border-crav" style="font-size: 8px; margin-right:10px; padding: 4px 0px; color: #555">Routing and Destination</div>
                    </div>
                    <div style="font-size: 12px;">{{$airImportDraftData->by_first_carrier ?? ''}}</div>
                  </td>
                  <td style="border-left:1px solid #000; border-bottom:none; width: 10%; padding:2px; font-size:10px; color: #555; text-align:center; width:10%;vertical-align: top; text-align: left">to</td>
                  <td style="border-left:1px solid #000; border-bottom:none; width: 10%; padding:2px; font-size:10px; color: #555; text-align:center; width:10%;vertical-align: top; text-align: left">by</td>
                  <td style="border-left:1px solid #000; border-bottom:none; width: 10%; padding:2px; font-size:10px; color: #555; text-align:center; width:10%;vertical-align: top; text-align: left">to</td>
                  <td style="border-bottom:none; width: 10%; padding:2px; font-size:10px; color: #555; text-align:center; width:10%;vertical-align: top; text-align: left;">by</td>
                </tr>
              </tbody>
            </table>
          </td>
    
          <td colspan="2" style="border:1px solid #000;border-top: none;border-left: none; padding:0; vertical-align: top;">
            <table style="width:100%; border-collapse: collapse;">
              <tbody>
                <tr>
                  <td style="border-bottom:1px solid #000; padding:2px; color: #555; font-size:10px; text-align:center;">Currency</td>
                  <td style="border-left:1px solid #000; padding:2px; color: #555; font-size:9px; text-align:center;">CHGS<br/>Code</td>
                  <td style="border-left:1px solid #000; padding:2px; color: #555; font-size:9px; text-align:center;">WT/VAL<br/><span style="font-size:6px;">PPD | CLT</span></td>
                  <td style="border-left:1px solid #000; padding:2px; color: #555; font-size:9px; text-align:center;">Other<br/><span style="font-size:6px;">PPD|CLT</span></td>
                  <td style="border-left:1px solid #000; padding:2px; color: #555; font-size:10px; text-align:center;">Declared Value for Carriage</td>
                  <td style="border-left:1px solid #000; padding:2px; color: #555; font-size:10px; text-align:center;">Declared Value for Customs</td>
                </tr>
           
                <tr>
                  <td style=" padding:4px; text-align:center;">{{$airImportDraftData->currency ?? ''}}</td>
                  <td style="border-top:1px solid #000; border-left:1px solid #000;  padding:4px; text-align:center;"></td>
                  <td style="border-top:1px solid #000; border-left:1px solid #000; padding:4px; text-align:center;">{{$airExpostFreight->freight ?? ''}}</td>
                  <td style="border-top:1px solid #000; border-left:1px solid #000; padding:4px; text-align:center;">{{$airExpostFreight->freight ?? ''}}</td>
                  <td style="border-top:1px solid #000; border-left:1px solid #000; padding:4px; text-align:center; font-weight:bold;">{{$airImportDraftData->declared_value_by_carrier ?? ''}}</td>
                  <td style="border-top:1px solid #000; border-left:1px solid #000; padding:4px; text-align:center; font-weight:bold;">{{$airImportDraftData->declared_value_by_customs ?? ''}}</td>
                </tr>
              </tbody>
            </table>
          </td>
        </tr>

        <!-- Row 7 - Airport of Destination -->
        <tr>
          <td style="border:1px solid #000;border-top: none;border-left: none; padding:0px; font-size:10px; vertical-align: top;">
            <table style="width:100%; border-collapse: collapse;">
              <tbody>
                <tr>
                  <td style="width:50%; padding-right:10px; vertical-align: center; text-align:center;">
                    <div style="font-size:10px; color:#555; margin-bottom:2px;">Airport of Destination</div>
                    <div style="font-weight:bold; font-size:10px;">{{$airImportDraftData->receiptPortName->port_name ?? ''}}</div>
                  </td>
                  <td style="width:50%; border-left:1px solid #000; padding-left:10px; vertical-align: top;">
                    <div style=" padding: 0;display: flex;">
                      <div style=" margin: 0px auto;"><div class="border-crav" style="font-size: 10px; padding: 4px 10px; color: #555;">Requested Flight/Date</div></div>
                    </div>
                    <div style=" padding: 0; display: flex;">
                      <div style="width: 50%; text-align: center; border-right:1px solid #000;">{{$airImportDraftData->flight_no ?? ''}}</div>
                      <div style="width: 50%; text-align: center;">{{$airImportDraftData->flight_date ?? ''}}</div>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </td>

          <td colspan="2" style="border:1px solid #000;border-top: none;border-left: none; padding:4px 6px; font-size:7px; vertical-align: top;">
            <div style="font-size:8px; color:#555; margin-bottom:2px;">Amount of Insurance</div>
            <div style="font-size:8px; ">INSURANCE - If carrier offers insurance, and such insurance is
            requested in accordance with the conditions thereof, indicate amount
            to be insured in figures in box marked "Amount of Insurance".</div>
          </td>
        </tr>

        <!-- Row 8 - Handling Information -->
        <tr>
          <td colspan="3" style="border:1px solid #000; border-top: none; padding:4px 6px; font-size:9px; vertical-align: top;">
              <div style="display: flex; width:100%;">
                <div style="width:40%;">
                    <span style="color:#555; margin-bottom:2px;">Handling Information</span>
                    <br>
                    <span>{{$airImportDraftData->handling_information ?? ''}}</span>
                </div>
                <div style="border-left: 1px solid #000;margin-left: 20px;width: 40%;">
                    <span style="color:#555; margin-bottom:2px;margin-left: 5px;">Notify Party</span>
                    <br>
                    <span style="margin-left: 5px;">{{$airImportDraftData->NotifyParty->party_name ?? ''}}</span>
                </div>
              </div>
          </td>
        </tr>

        <!-- Row 9 - Cargo Header -->
        <tr>
          <td colspan="3" style="border:1px solid #000;border-top: none;border-left: none; padding:0; vertical-align: top;">
            <table style="width:100%; border-collapse: collapse; position:relative;">
              <tbody>
                <tr>
                  <td rowspan="2" style="border-right:1px solid #000; padding:3px; font-size:10px; text-align:center; width:10%;">No. of<br/>Pieces</td>
                  <td rowspan="2" style="border-right:1px solid #000; padding:3px; font-size:10px; text-align:center; width:10%;">Gross<br/>Weight</td>
                  <td rowspan="2" style="border-right:1px solid #000; padding:3px; font-size:10px; text-align:center; width:1%;">kg<br/>lb</td>
                  <!--<td rowspan="2" style="border-right:1px solid #000; padding:3px; font-size:10px; text-align:center; width:1%;">&nbsp;</td>-->
                  <td colspan="2" style="border-right:1px solid #000; padding:3px; font-size:10px; text-align:left; width:10%;">Rate Class</td>
                  <!--<td  rowspan="2" style="border-right:1px solid #000; padding:3px; font-size:10px; text-align:center; width:1%;"></td>-->
                  <td rowspan="2" style="border-right:1px solid #000; padding:3px; font-size:10px; text-align:center; width:10%;">Chargeable<br/>Weight</td>
                  <!--<td rowspan="2" style="border-right:1px solid #000; padding:3px; font-size:10px; text-align:center; width:1%;"></td>-->
                  <td style="border-right:1px solid #000;text-align: left; padding:3px; font-size:10px; width:8%; position:relative;">
                    Rate
                  </td>
                  <!--<td rowspan="2" style="border-right:1px solid #000; padding:3px; font-size:8px; text-align:center; width:1%;"></td>-->
                  <td rowspan="2" style="border-right:1px solid #000; padding:3px; font-size:10px; text-align:center; width:10%;">Total</td>
                  <!--<td rowspan="2" style="border-right:1px solid #000; padding:3px; font-size:10px; text-align:center; width:1%;"></td>-->
                  <td rowspan="2" style="border-right:0px solid #000;border-left:none; padding:3px; font-size:10px; text-align:center; width:30%;">
                    Nature and Quantity of Goods<br/>(incl. Dimensions or Volume)
                  </td>
                </tr>
                <tr>
                  <td style="border:0px solid #000; padding:3px; font-size:10px; text-align:center; "></td>
                  <td style="border:1px solid #000;border-bottom: none; padding:3px; font-size:10px; text-align:center; ">Commodity<br/>Item No.</td>
                  <td  style="border-right:1px solid #000;  padding:3px; font-size:10px; text-align:right; position:relative;">
                    Charges
                  </td>
                </tr>
                @php
                    $totalChargableWeight = 0;

                    if (
                        is_numeric($airImportDraftData->chargable_weight) &&
                        is_numeric($airImportDraftData->rate_charges)
                    ) {
                        $totalChargableWeight =
                            (float) $airImportDraftData->chargable_weight *
                            (float) $airImportDraftData->rate_charges;
                    }
                    
                    $totalPieces = (int) ($airImportDraftData->package ?? 0);

                    $totalGrossWeight = is_numeric($airImportDraftData->gross_weight)
                        ? (float) $airImportDraftData->gross_weight
                        : 0;
            
                    $totalAmount = 0;
                    if (
                        is_numeric($airImportDraftData->chargable_weight) &&
                        is_numeric($airImportDraftData->rate_charges)
                    ) {
                        $totalAmount =
                            (float) $airImportDraftData->chargable_weight *
                            (float) $airImportDraftData->rate_charges;
                    }
                @endphp
                <tr>
                  <td style="border:1px solid #000;border-left:0px; padding:4px; text-align:center; font-weight:bold; height:160px; vertical-align: top;">{{$airImportDraftData->package ?? '0'}}</td>
                  <td style="border:1px solid #000;border-left: none; padding:4px; text-align:center; font-weight:bold; height:160px; vertical-align: top;">{{$airImportDraftData->gross_weight ?? '0.00'}}</td>
                  <td rowspan="2" style="border:1px solid #000;border-left: none; border-bottom:0px; padding:4px; text-align:center; height:160px; vertical-align: top;">K</td>
                  <!--<td rowspan="2" style="border:1px solid #000;border-left: none; border-bottom:0px; padding:4px; text-align:center; height:160px; vertical-align: top;"></td>-->
                  <td rowspan="2" style="border:1px solid #000;border-left: none; border-bottom:0px; padding:4px; text-align:center; height:160px; vertical-align: top;">Q</td>
                  <td rowspan="2" style="border:1px solid #000;border-left: none; border-bottom:0px; padding:4px; text-align:center; height:160px; vertical-align: top;"></td>
                  <!--<td rowspan="2" style="border:1px solid #000;border-left: none; border-bottom:0px; padding:4px; text-align:center; font-weight:bold; height:160px; vertical-align: top;"></td>-->
                  <td rowspan="2" style="border:1px solid #000;border-left: none; border-bottom:0px; padding:4px; text-align:center; font-weight:bold; height:160px; vertical-align: top;">{{$airImportDraftData->chargable_weight ?? '-'}}</td>
                  <!--<td rowspan="2" style="border:1px solid #000;border-left: none; border-bottom:0px; padding:4px; text-align:center; font-weight:bold; height:160px; vertical-align: top;"></td>-->
                  <td rowspan="2" style="border:1px solid #000;border-left: none; border-bottom:0px; padding:4px; text-align:center; font-weight:bold; height:160px; vertical-align: top;">{{$airImportDraftData->rate_charges ?? '-'}} {{$airImportDraftData->currency ?? ''}}</td>
                  <!--<td rowspan="2" style="border:1px solid #000;border-left: none; border-bottom:0px; padding:4px; text-align:center; font-weight:bold; height:160px; vertical-align: top;"></td>-->
                  <td style="border:1px solid #000; padding:8px;border-left: none; text-align:center; font-weight:bold; height:160px; vertical-align: top;">{{ $totalChargableWeight }}</td>
                  <!--<td rowspan="2" style="border:1px solid #000; border-bottom:0px;border-left: none; border-right:0px; padding:4px; text-align:center; font-weight:bold; height:160px; vertical-align: top;"></td>-->
                  <td rowspan="2" style="border:1px solid #000; font-size:9px; letter-spacing: 1px; border-right:0px;border-left:none; border-bottom:0px; padding:4px; text-align:center; font-weight:normal; height:160px; vertical-align: top;">
                    {{$airImportDraftData->nature_qty_goods ?? '-'}}
                  </td>
                </tr>
                <tr>
                  <td style="border-right:1px solid #000; padding:4px; text-align:center; font-weight:bold;">{{$totalPieces}}</td>
                  <td style="border:0px;border-right:1px solid #000; padding:4px; text-align:center; font-weight:bold;">{{ number_format($totalGrossWeight, 2) }}</td>
                  <td style="border:0px;border-right:1px solid #000; padding:4px; text-align:center; font-weight:bold;">{{ number_format($totalAmount, 2) }}</td>
                </tr>
                
                <tr style="position:absolute; bottom:70px; left:10px; width:400px; text:wrap; z-index:1111;">
                    <td>
                        {{$airImportDraftData->dimention ?? ''}}
                    </td>
                </tr>

              </tbody>
            </table>
          </td>

        </tr>

        <!-- Row 13 - Charges with diagonal -->
        @php
            $freightType = strtoupper($airImportDraftData->freight ?? '');
        
            // Example DB values (replace with your real columns)
            $weightCharge = 0;
            if (
                is_numeric($airImportDraftData->chargable_weight) &&
                is_numeric($airImportDraftData->rate_charges)
            ) {
                $weightCharge =
                    (float) $airImportDraftData->chargable_weight *
                    (float) $airImportDraftData->rate_charges;
            }
        
            $valuationCharge = $airImportDraftData->valuation_charge ?? 0;
            $taxCharge       = $airImportDraftData->tax_amount ?? 0;
            $otherAgent      = $airImportDraftData->other_charges_due_agent ?? 0;
            $otherCarrier    = $airImportDraftData->other_charges_due_carrier ?? 0;
        
            // Prepaid / Collect split
            $prepaid = ($freightType === 'P');
            $collect = ($freightType === 'C');
        @endphp
        <tr>
          <td colspan="3" style="border:1px solid #000;border-top:none;border-left: none; padding:0; vertical-align: top;">
            <table style="width:100%; border-collapse: collapse;">
              <tbody>
                <tr>
                  <td colspan="2" style="width:40%;border:0px solid #000; padding:0px; position:relative;">
                    <div style="display: flex; justify-content: space-between;">
                      <div class="border-crav" style="font-size:8px; color:#555; padding: 3px 0; margin-left: 10px;">Prepaid</div>
                      <div class="border-crav" style="font-size:8px; color:#555; padding: 3px 10px;">Weight Charge</div>
                      <div class="border-crav" style="font-size:8px; color:#555; padding: 3px 0; margin-right: 10px;">Collect</div>
                    </div>
                  </td>

                  <td colspan="2" rowspan="6" style="width:60%; border-left:1px solid #000;border-top: none; padding:5px; vertical-align: top;">
                    <div style="font-size:10px; color:#555; margin-bottom:2px;">Other Charges</div>
                    <div>
                        {{$airImportDraftData->other_charges ?? ''}}
                    </div>
                  </td>
                </tr>

                <tr>
                    <td style="border-right:1px solid #000; padding:5px;">
                        {{ $prepaid ? $weightCharge : '0.00' }}
                    </td>
                
                    <td style="border-right:1px solid #000;border-right: none; padding:5px;">
                        {{ $collect ? $weightCharge : '0.00' }}
                    </td>
                </tr>
                <tr>
                  <td colspan="2" style="border:1px solid #000; text-align: center;border-roght: none; border-bottom:0; border-left:0; position:relative;">
                      <div class="border-crav" style="font-size:8px; margin: 0px auto; color:#555; padding: 3px 20px;">Valuation Charge</div>
                  </td>
                </tr>
                <tr>
                    <td style="border-right:1px solid #000; padding:5px;">
                        {{ $prepaid ? $valuationCharge : '0.00' }}
                    </td>
                
                    <td style="border-right:1px solid #000;border-right: none; padding:5px;">
                        {{ $collect ? $valuationCharge : '0.00' }}
                    </td>
                </tr>
                <tr>
                  <td colspan="2" style="border-top:1px solid #000; text-align: center; padding:0px; position:relative;">
                      <div class="border-crav" style="font-size:8px; margin: 0px auto; color:#555; padding: 3px 20px;">Tax</div>
                  </td>
                </tr>
                <tr>
                    <td style="border-right:1px solid #000; padding:5px;">
                        {{ $prepaid ? $taxCharge : '0.00' }}
                    </td>
                
                    <td style="border-right:1px solid #000;border-right: none; padding:5px;">
                        {{ $collect ? $taxCharge : '0.00' }}
                    </td>
                </tr>

                <tr>
                  <td colspan="2" style="border-top:1px solid #000; padding:0; text-align: center; position:relative;">
                      <div class="border-crav" style="font-size:8px; margin: 0px auto; color:#555; padding: 3px 20px;">Total Other Charges Due Agent</div>
                  </td>
                  <td rowspan="5" colspan="2" style="border-top:1px solid #000; border-bottom:1px solid #000; border-left:1px solid #000; padding:5px; font-size:10px; vertical-align: top;">
                    <div>Shipper certifies that the particulars on the face hereof are correct and that insofar as any part of the
                    consignment contains dangerous goods, such part is properly described by name and is in proper condition for
                    carriage by air according to the applicable Dangerous Goods Regulations.</div>
                    <div style="font-weight:bold; text-align:center; font-size:12px; margin-top:10px;">{{ $company->company_name }}</div>
                    <div style="text-align:center; font-size:10px; margin-top:3px;">Signature of Shipper or his Agent</div>
                  </td>
                </tr>
                <tr>
                    <td style="border-right:1px solid #000; padding:5px;">
                        {{ $prepaid ? $otherAgent : '0.00' }}
                    </td>
                
                    <td style="border-right:1px solid #000;border-right: none; padding:5px;">
                        {{ $collect ? $otherAgent : '0.00' }}
                    </td>
                </tr>

                <tr>
                  <td colspan="2" style="border-top:1px solid #000; text-align: center; padding:0px; position:relative;">
                      <div class="border-crav" style="font-size:8px; margin: 0px auto; color:#555; padding: 3px 20px;">Total Other Charges Due Carrier</div>
                  </td>
                </tr>
                <tr>
                    <td style="border-right:1px solid #000; padding:5px;">
                        {{ $prepaid ? $otherCarrier : '0.00' }}
                    </td>
                
                    <td style="border-right:1px solid #000;border-right: none; padding:5px;">
                        {{ $collect ? $otherCarrier : '0.00' }}
                    </td>
                </tr>
                <tr>
                  <td style="border-right:1px solid #000;border-top:1px solid #000; padding:5px; position:relative;">
                      <div style="font-size:8px; color:#555; margin-bottom:2px;"></div>
                  </td>
                  <td style="border:1px solid #000;border-left: none;border-right: none; padding:5px; position:relative;">
                      <div style="font-size:8px; color:#555; margin-bottom:2px;"></div>
                  </td>
                </tr>
                
                @php
                    $weightCharge    = (float) ($weightCharge ?? 0);
                    $valuationCharge = (float) ($valuationCharge ?? 0);
                    $taxCharge       = (float) ($taxCharge ?? 0);
                    $otherAgent      = (float) ($otherAgent ?? 0);
                    $otherCarrier    = (float) ($otherCarrier ?? 0);
                
                    $grandTotal =
                        $weightCharge +
                        $valuationCharge +
                        $taxCharge +
                        $otherAgent +
                        $otherCarrier;
                @endphp

                <tr>
                  <td style="border-top:1px solid #000; border-bottom:1px solid #000; padding:0px; position:relative; text-align: center;">
                      <div class="border-crav" style="font-size:10px; margin: 0px auto; color:#555; padding: 3px 20px;">Total Prepaid</div>
                      <div style="font-weight:bold;">
                        {{ $prepaid ? number_format($grandTotal, 2) : '0.00' }}
                    </div>
                  </td>

                  <td style="border:1px solid #000;border-top: none; padding:0px; position:relative;text-align: center; vertical-align: top;">
                      <div class="border-crav" style="font-size:10px; margin: 0px auto; color:#555; padding: 3px 20px;">Total Collect</div>
                      <div style="font-weight:bold;">
                        {{ $collect ? number_format($grandTotal, 2) : '0.00' }}
                    </div>
                  </td>
                  <td rowspan="2" colspan="2" style="border-bottom:1px solid #000; padding:5px; vertical-align: bottom;">
                    <div style="display:flex; justify-content:space-between; align-items:flex-end;">
                      <div>
                        <div style="font-weight:bold;">{{$executedDate}}</div>
                        <div style="font-size:9px; color:#666;">Executed on (date)</div>
                      </div>
                      <div>
                        <div style="font-weight:bold;">{{$issuedPlace ?? ''}}</div>
                        <div style="font-size:9px; color:#666;">at (place)</div>
                      </div>
                      <div>
                        <div style="font-weight:bold;">{{$airImportDraftData->executed_by ?? ''}}</div>
                        <div style="font-size:9px; color:#666;">Executed By</div>
                      </div>
                      <div>
                        <div style="font-size:9px; color:#666;">Signature of Issuing Carrier or its Agent</div>
                      </div>
                    </div>
                  </td>
                </tr>
                

                <tr>
                  <td style="border-bottom:1px solid #000; padding:0px 0 10px; text-align: center; position:relative;">
                      <div class="border-crav" style="font-size:8px; margin: 0px auto; color:#555; padding: 3px 0px;">Currency Conversion Rates</div>
                  </td>
                  <td style="border:1px solid #000;border-top: none; padding:5px; position:relative;">
                  </td>

                </tr>

                <tr>
                  <td style=" padding:5px; position:relative;">
                      <div style="font-size:8px; color:#555; margin-bottom:2px;">For Carrier's Use only<br/>at Destination</div>
                  </td>

                  <td style="border-left:1px solid #000; padding:0px 0 10px; vertical-align: top; text-align: center; position:relative;">
                      <div class="border-crav" style="font-size:8px; margin: 0px auto; color:#555; padding: 3px 20px;">Charges at Destination</div>
                  </td>

                  <td style="padding:0px 0 10px; vertical-align: top; text-align: center; position:relative;">
                      <div class="border-crav" style="font-size:8px; margin: 0px auto; color:#555; padding: 3px 20px;">Total Collect Charges</div>
                  </td>

                  <td style="border-left:1px solid #000; padding:5px; text-align:center; vertical-align: middle;">
                    <div style="font-weight:bold; font-size:14px;">{{$hbl_type}}</div>
                  </td>
                </tr>

              </tbody>
            </table>
         </td>

        </tr>

      </tbody>
    </table>
    <!-- second page -->
    <br>
    <div style="width:740px; page-break-inside: avoid;">
        <div style="text-align:center; margin-top:18px;"><img src="{{ asset('public/images/Iata-icon.png') }}" width="70" height="70"></div>
        <h3 style="text-align:center; padding:0; margin:0;">NOTICE CONCERNING CARRIER S LIMITATION OF LIABILITY</h3>
        <div style="padding:0; margin:0;">
            <small style="color:#000; font-size:11px;">If the carriage involves an ultimate destination or stop in a country other than the country of departure, the Montreal Convention or the Warsaw Convention may be applicable to the liability
            of the Carrier in respect of loss of, damage or delay to cargo. Carrier s limitation of liability in accordance with those Conventions shall be as set forth in subparagraph 4 unless a higher value
            is declared.</small>
        </div>
        <h3 style="text-align:center; padding:0; margin:0;">CONDITIONS OF CONTRACT</h3>
        <div style="display:flex; justify-content:space-between; color:#000; font-size:10px; line-height:1.2;">
            <div style="flex: 1;">
                <div style="display: flex; align-items: flex-start; gap: 8px; margin-bottom: 2px;">
                    <span style="width: 35px; flex-shrink: 0; text-align: right;">1.</span>
                    <span style="display: block; flex: 1;">
                        In this contract and the Notices appearing hereon: <br>
                        <b>CARRIER</b>includes the air carrier issuing this air waybill and all carriers that
                        carry or undertake to carry the cargo or perform any other services related
                        to such carriage.<br>
                        <b>SPECIAL DRAWING RIGHT (SDR) </b>is a Special Drawing Right as defined by
                        the International Monetary Fund.<br>
                        <b>WARSAW CONVENTION</b> means whichever of the following instruments is
                        applicable to the contract of carriage:<br>
                        The Convention for the Unification of Certain Rules Relating to International
                        Carriage by Air, signed at Warsaw, 12 October 1929;<br>
                        That Convention as amended at The Hague on 28 September 1955;<br>
                        That Convention as amended at The Hague 1955 and by Montreal Protocol
                        No. 1, 2, or 4 (1975) as the case may be.<br>
                        <b>MONTREAL CONVENTION</b> means the Convention for the Unification of
                        Certain Rules for International Carriage by Air, done at Montreal on 28 May 1999.
                    </span>
                </div>
                <div style="display: flex; align-items: flex-start; gap: 8px; margin-bottom: 2px;">
                    <span style="width: 35px; flex-shrink: 0; text-align: right;">2./2.1</span>
                    <span style="display: block; flex: 1;">
                        Carriage is subject to the rules relating to liability established by the
                        Warsaw Convention or the Montreal Conventionunless such carriage is not
                        "international carriage" as defined by the applicable Conventions.
                    </span>
                </div>
                <div style="display: flex; align-items: flex-start; gap: 8px; margin-bottom: 2px;">
                    <span style="width: 35px; flex-shrink: 0; text-align: right;">2.2</span>
                    <span style="display: block; flex: 1;">
                        To the extent not in conflict with the foregoing, carriage and other related
                        services performed by each Carrier are subject to:
                    </span>
                </div>

                <div style="display: flex; align-items: flex-start; gap: 8px; margin-bottom: 2px;">
                    <span style="width: 35px; flex-shrink: 0; text-align: right;">2.2.1</span>
                    <span style="display: block; flex: 1;">
                        applicable laws and government regulations
                    </span>
                </div>
                <div style="display: flex; align-items: flex-start; gap: 8px; margin-bottom: 2px;">
                    <span style="width: 35px; flex-shrink: 0; text-align: right;">2.2.2</span>
                    <span style="display: block; flex: 1;">
                        Provisions contained in the air waybill, Carrier’s conditions of carriage and
                        related rules, regulations, and timetables (but not the times of departure
                        and arrival stated therein) and applicable tariffs of such Carrier, which are
                        made part hereof, and which may be inspected at any airports or other
                        cargo sales offices from which it operates regular services. When carriage is
                        to/from the USA, the shipper and the consignee are entitled, upon request,
                        to receiver a free copy of the Carrier’s conditions of carriage. The Carrier s
                        conditions of carriage include, but are not limited to:
                    </span>
                </div>
                <div style="display: flex; align-items: flex-start; gap: 8px; margin-bottom: 2px;">
                    <span style="width: 35px; flex-shrink: 0; text-align: right;">2.2.2.1</span>
                    <span style="display: block; flex: 1;">
                        Limits on the Carrier s liability for loss, damage or delay of goods, including
                        fragile or perishable goods.
                    </span>
                </div>

                <div style="display: flex; align-items: flex-start; gap: 8px; margin-bottom: 2px;">
                    <span style="width: 35px; flex-shrink: 0; text-align: right;">2.2.2.2</span>
                    <span style="display: block; flex: 1;">
                        Claims restrictions, including time periods within which shippers or
                        consignees must file a claim or bring an action against the Carrier for its
                        acts or omissions, or those of its agents;
                    </span>
                </div>
                <div style="display: flex; align-items: flex-start; gap: 8px; margin-bottom: 2px;">
                    <span style="width: 35px; flex-shrink: 0; text-align: right;">2.2.2.3</span>
                    <span style="display: block; flex: 1;">
                        Rights, if any, of the Carrier to change the terms of the contract;
                    </span>
                </div>
                <div style="display: flex; align-items: flex-start; gap: 8px; margin-bottom: 2px;">
                    <span style="width: 35px; flex-shrink: 0; text-align: right;">2.2.2.4</span>
                    <span style="display: block; flex: 1;">
                        Rules about Carrier s right to refuse to carry;
                    </span>
                </div>

                <div style="display: flex; align-items: flex-start; gap: 8px; margin-bottom: 2px;">
                    <span style="width: 35px; flex-shrink: 0; text-align: right;">2.2.2.5</span>
                    <span style="display: block; flex: 1;">
                        Rights of the Carrier and limitations concerning delay or failure to perform
                        service, including schedule changes, substitution of alternate Carrier or
                        aircraft and rerouting.
                    </span>
                </div>
                <div style="display: flex; align-items: flex-start; gap: 8px; margin-bottom: 2px;">
                    <span style="width: 35px; flex-shrink: 0; text-align: right;">3</span>
                    <span style="display: block; flex: 1;">
                        The agreed stopping places (which may be altered by Carrier in case of
                        necessity) are those places, except the place of departure and place of
                        destination, set forth on the face hereof or shown in Carrier’s timetables as
                        scheduled stopping places for the route. Carriage to be performed
                        hereunder by several successive Carriers is regarded as a single operation.
                    </span>
                </div>
                <div style="display: flex; align-items: flex-start; gap: 8px; margin-bottom: 2px;">
                    <span style="width: 35px; flex-shrink: 0; text-align: right;">4</span>
                    <span style="display: block; flex: 1;">
                        For carriage to which the Montreal Convention does not apply, Carrier s
                        liability limitation for cargo lost, damaged or delayed shall be 22 SDRs per
                        kilogram unless a greater per kilogram monetary limit is provided in any
                        applicable Convention or in Carrier s tariffs or general conditions of carriage.
                    </span>
                </div>

                <div style="display: flex; align-items: flex-start; gap: 8px; margin-bottom: 2px;">
                    <span style="width: 35px; flex-shrink: 0; text-align: right;">5./5.1</span>
                    <span style="display: block; flex: 1;">
                        Except when the Carrier has extended credit to the consignee without the
                        written consent of the shipper, the shipper guarantees payment of all
                        charges for the carriage due in accordance with Carrier s tariff, conditions of
                        carriage and related regulations, applicable laws (including national laws
                        implementing the Warsaw Convention and the Montreal Convention),
                        government regulations, orders and requirements.
                    </span>
                </div>
                <div style="display: flex; align-items: flex-start; gap: 8px; margin-bottom: 2px;">
                    <span style="width: 35px; flex-shrink: 0; text-align: right;">5.2</span>
                    <span style="display: block; flex: 1;">
                        When no part of the consignment is delivered, a claim with respect to such
                        consignment will be considered even though transportation charges thereon
                        are unpaid.
                    </span>
                </div>
            </div>
            <div style="flex: 1;">
                <div style="display: flex; align-items: flex-start; gap: 8px; margin-bottom: 2px;">
                    <span style="width: 35px; flex-shrink: 0; text-align: right;">6./6.1</span>
                    <span style="display: block; flex: 1;">
                        For cargo accepted for carriage, the Warsaw Convention and the Montreal
                        Convention permit shipper to increase the limitation of liability by declaring a
                        higher value for carriage and paying a supplemental charge if required.
                    </span>
                </div>
                <div style="display: flex; align-items: flex-start; gap: 8px; margin-bottom: 2px;">
                    <span style="width: 35px; flex-shrink: 0; text-align: right;">6.2</span>
                    <span style="display: block; flex: 1;">
                        In carriage to which neither the Warsaw Convention nor the Montreal
                        Convention applies Carrier shall, in accordance with the procedures set forth in
                        its general conditions of carriage and applicable tariffs, permit shipper to
                        increase the limitation of liability by declaring a higher value for carriage and
                        paying a supplemental charge if so required.
                    </span>
                </div>
                <div style="display: flex; align-items: flex-start; gap: 8px; margin-bottom: 2px;">
                    <span style="width: 35px; flex-shrink: 0; text-align: right;">7./7.1</span>
                    <span style="display: block; flex: 1;">
                        In cases of loss of, damage or delay to part of the cargo, the weight to be taken
                        into account in determining Carrier s limit of liability shall be only the weight of
                        the package or packages concerned
                    </span>
                </div>

                <div style="display: flex; align-items: flex-start; gap: 8px; margin-bottom: 2px;">
                    <span style="width: 35px; flex-shrink: 0; text-align: right;">7.2</span>
                    <span style="display: block; flex: 1;">
                        Notwithstanding any other provisions, for "foreign air transportation" as defined
                        by the U.S. Transportation Code:
                    </span>
                </div>
                <div style="display: flex; align-items: flex-start; gap: 8px; margin-bottom: 2px;">
                    <span style="width: 35px; flex-shrink: 0; text-align: right;">7.2.1</span>
                    <span style="display: block; flex: 1;">
                        In the case of loss of, damage or delay to a shipment, the weight to be used in
                        determining Carrier s limit of liability shall be the weight which is used to
                        determine the charge for carriage of such shipment; and
                    </span>
                </div>
                <div style="display: flex; align-items: flex-start; gap: 8px; margin-bottom: 2px;">
                    <span style="width: 35px; flex-shrink: 0; text-align: right;">7.2.2</span>
                    <span style="display: block; flex: 1;">
                        In the case of loss of, damage or delay to a part of a shipment, the shipment
                        weight in 7.2.1 shall be prorated to the packages covered by the same air
                        waybill whose value is affected by the loss, damage or delay. The weight
                        applicable in the case of loss or damage to one or more articles in a package
                        shall be the weight of the entire package.
                    </span>
                </div>

                <div style="display: flex; align-items: flex-start; gap: 8px; margin-bottom: 2px;">
                    <span style="width: 35px; flex-shrink: 0; text-align: right;">8</span>
                    <span style="display: block; flex: 1;">
                        Any exclusion or limitation of liability applicable to Carrier shall apply to
                        Carrier s agents, employees, and representatives and to any person whose
                        aircraft or equipment is used by Carrier for carriage and such person’s agents,
                        employees and representatives.
                    </span>
                </div>
                <div style="display: flex; align-items: flex-start; gap: 8px; margin-bottom: 2px;">
                    <span style="width: 35px; flex-shrink: 0; text-align: right;">9</span>
                    <span style="display: block; flex: 1;">
                        Carrier undertakes to complete the carriage with reasonable dispatch. Where
                        permitted by applicable laws, tariffs and government regulations, Carrier may
                        use alternative carriers, aircraft or modes of transport without notice but with
                        due regard to the interests of the shipper. Carrier is authorized by the shipper
                        to select the routing and all intermediate stopping places that it deems
                        appropriate or to change or deviate from the routing shown on the face hereof.
                    </span>
                </div>
                <div style="display: flex; align-items: flex-start; gap: 8px; margin-bottom: 2px;">
                    <span style="width: 35px; flex-shrink: 0; text-align: right;">10</span>
                    <span style="display: block; flex: 1;">
                        Receipt by the person entitled to delivery of the cargo without complaint shall
                        be prima facie evidence that the cargo has been delivered in good condition
                        and in accordance with the contract of carriage.
                    </span>
                </div>

                <div style="display: flex; align-items: flex-start; gap: 8px; margin-bottom: 2px;">
                    <span style="width: 35px; flex-shrink: 0; text-align: right;">10.1</span>
                    <span style="display: block; flex: 1;">
                        In the case of loss of, damage or delay to cargo a written complaint must be
                        made to Carrier by the person entitled to delivery. Such complaint must be
                        made:
                    </span>
                </div>
                <div style="display: flex; align-items: flex-start; gap: 8px; margin-bottom: 2px;">
                    <span style="width: 35px; flex-shrink: 0; text-align: right;">10.1.1</span>
                    <span style="display: block; flex: 1;">
                        In the case of damage to the cargo, immediately after discovery of the damage
                        and at the latest within 14 days from the date of receipt of the cargo;
                    </span>
                </div>
                <div style="display: flex; align-items: flex-start; gap: 8px; margin-bottom: 2px;">
                    <span style="width:30px;">10.1.2</span>
                    <span style="display: block; flex: 1;">
                        in the case of delay, within 21 days from the date on which the cargo was
                        placed at the disposal of the person entitled to delivery.
                    </span>
                </div>
                <div style="display: flex; align-items: flex-start; gap: 8px; margin-bottom: 2px;">
                    <span style="width: 35px; flex-shrink: 0; text-align: right;">10.1.3</span>
                    <span style="display: block; flex: 1;">
                        In the case of non-delivery of the cargo, within 120 days from the date of issue
                        of the air waybill, or if an air waybill has not been issued, within 120 days from
                        the date of receipt of the cargo for transportation by the Carrier.
                    </span>
                </div>
                <div style="display: flex; align-items: flex-start; gap: 8px; margin-bottom: 2px;">
                    <span style="width: 35px; flex-shrink: 0; text-align: right;">10.2</span>
                    <span style="display: block; flex: 1;">
                        Such complaint may be made to the Carrier whose air waybill was used, or to
                        the first Carrier or to the last Carrier or to the Carrier, which performed the
                        carriage during which the loss, damage or delay took place.
                    </span>
                </div>
                <div style="display: flex; align-items: flex-start; gap: 8px; margin-bottom: 2px;">
                    <span style="width: 35px; flex-shrink: 0; text-align: right;">10.3</span>
                    <span style="display: block; flex: 1;">
                        Unless a written complaint is made within the time limits specified in 10.1 no
                        action may be brought against Carrier.
                    </span>
                </div>

                <div style="display: flex; align-items: flex-start; gap: 8px; margin-bottom: 2px;">
                    <span style="width: 35px; flex-shrink: 0; text-align: right;">10.4</span>
                    <span style="display: block; flex: 1;">
                        Any rights to damages against Carrier shall be extinguished unless an action is
                        brought within two years from the date of arrival at the destination, or from the
                        date on which the aircraft ought to have arrived, or from the date on which the
                        carriage stopped.
                    </span>
                </div>
                <div style="display: flex; align-items: flex-start; gap: 8px; margin-bottom: 2px;">
                    <span style="width: 35px; flex-shrink: 0; text-align: right;">11</span>
                    <span style="display: block; flex: 1;">
                        Shipper shall comply with all applicable laws and government regulations of
                        any country to or from which the cargo may be carried, including those relating
                        to the packing, carriage or delivery of the cargo, and shall furnish such
                        information and attach such documents to the air waybill as may be necessary
                        to comply with such laws and regulations. Carrier is not liable to shipper and
                        shipper shall indemnify Carrier for loss or expense due to shipper s failure to
                        comply with this provision.
                    </span>
                </div>
                <div style="display: flex; align-items: flex-start; gap: 8px; margin-bottom: 2px;">
                    <span style="width: 35px; flex-shrink: 0; text-align: right;">12</span>
                    <span style="display: block; flex: 1;">
                        No agent, employee or representative of Carrier has authority to alter, modify
                        or waive any provisions of this contract.
                    </span>
                </div>
            </div>
        </div>
        <p style="font-size:11px; color:#000; border-top: 1px solid #333; padding-top:10px;">
            <small>
                IF THIS AIR WAY BILL IS ISSUED BY A FORWARDER IN A CAPACITY AS CONTRACTING CARRIER FOR AIR TRANSPORTATION, ANY TRANSPORTATION OR OTHER SERVICE WHICH IS NOT SUBJECT
                TO AN INTERNATIONAL AIR CARRIAGE CONVENTION WILL NOT BE SUBJECT TO THE TERMS AND CONDITIONS OF THIS AIR WAY BILL BUT WILL INSTEAD BE SUBJECT TO THE FORWARDER S
                GENERAL CONDITIONS AS APPROPRIATE.
            </small>
        </p>
    </div>

  </div>
</body>
</html>
