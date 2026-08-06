<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Job File Form</title>
<style>
    body {
        margin: 0;
        padding: 0;
        background-color: #f0f0f0;
        font-family: "Arial", Times, serif;
    }
    /* This container ensures the PDF renders exactly as A4 */
    #pdf-content {
        width: 210mm;
        /*height: 296mm;*/
        margin: 0 auto;
        background-color: white;
        box-sizing: border-box;
        padding: 8mm;
        /*overflow: hidden;*/
    }
    .inner-border {
        border: 4px solid black;
        height: 100%;
        width: 100%;
        padding: 15px;
        box-sizing: border-box;
        position: relative;
    }
    .header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
    }
    .header-left { width: 30%; }
    .header-center { text-align: center; width: 40%; }
    .header-right { text-align: right; width: 30%; font-size: 11px; font-weight: bold;}

    .job-file-box {
        border: 3px solid black;
        padding: 5px 15px;
        font-weight: bold;
        font-size: 24px;
        display: inline-block;
        margin-bottom: 5px;
    }
    .company-name { font-size: 18px; font-weight: bold; margin: 5px 0; }
    .sub-title { font-weight: bold; font-size: 12px; }
    .address { font-size: 11px; line-height: 1.2; }

    .row { display: flex; align-items: flex-end; margin-bottom: 10px; }
    .field { display: flex; align-items: flex-end; flex-grow: 1; margin-right: 10px;width: 0px; }
    .label { font-weight: 800; white-space: nowrap; margin-right: 5px; font-size: 13px; }
    .line { border-bottom: 1.5px solid black; flex-grow: 1; min-height: 1.2em; }

    .section-split { display: flex; border-top: 3px solid black; border-bottom: 3px solid black; margin-top: 10px; }
    .split-col { width: 50%; padding: 8px; }
    .split-col:first-child { border-right: 3px solid black; }
    .split-row { display: flex; align-items: flex-end; margin-bottom: 6px; }

    .yes-no-field { display: flex; align-items: center; margin-left: 10px; }
    .short-line { border-bottom: 1.5px solid black; width: 35px; display: inline-block; margin-left: 5px;}

    .footer-section { border-top: 3px solid black; display: flex; min-height: 120px; }
    .remark-col { width: 50%; border-right: 3px solid black; padding: 10px; font-weight: bold; }
    .flight-col { width: 50%; display: flex; flex-direction: column; }
    .flight-details { padding: 10px; flex-grow: 1; }
    .flight-line { border-bottom: 1.5px solid black; margin-top: 20px; }

    .bottom-boxes { display: flex; border-top: 2px solid black; padding: 5px 10px; justify-content: space-between; }
    .box-field { display: flex; align-items: center; }
    .box { border: 2px solid black; width: 45px; height: 18px; margin-left: 5px; }

    .download-btn {
        display: block;
        margin: 20px auto;
        padding: 12px 24px;
        background-color: #2e7d32;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }
    .line-block {
        display: inline-flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .line-text {
        border-bottom: 1.5px solid black;
        min-height: 1.2em;
    }

    .line-date {
        /*font-size: 10px;*/
        /*text-align: right;*/
        margin-top: 2px;
    }
    .page-break {
        page-break-before: always;
        break-before: page;
    }
</style>
</head>
<body>

<button id="downloadBtn" class="download-btn" data-html2canvas-ignore="true">Download Air Job Card PDF</button>

<div id="pdf-content">
    <div class="inner-border">
        <div class="header">
            <div class="header-left">
                <div class="row">
                    <span class="label">AIR JOB NO.</span>

                    <div class="line-block">
                        <div class="line-text">{{ $data['air_job_no'] ?? '' }}</div>
                        <div class="line-date">{{ $data['air_job_date'] ?? '' }}</div>
                    </div>
                </div>
                <div style="height: 80px; width: 120px; display: flex; align-items: center; justify-content: center; font-size: 10px; color: #999;margin-top: 45px;">
                    <img src="{{ url('public/uploads/company_logo/' . basename($logoUrl)) }}" alt="{{ $company->company_name }}" style="width: 123px;">
                </div>
            </div>
            <div class="header-center">
                <div style="font-size: 11px; margin-bottom: 2px;">जय श्री साँवलिया सेठ जी</div>
                <div class="job-file-box">JOB FILE</div>
                <div class="company-name">{{ $company->company_name }}</div>
                <div class="sub-title">CLEARING, FORWARDING & FREIGHT BROKER</div>
                <div class="address">
                    {{ $branch->address }}<br>
                    Mob.: {{ $company->companySetting->phone ?? '-' }}
                </div>
            </div>
            <div class="header-right">
                <div>GSTIN: {{ $branch->gstin_no }}</div>
                <div>CIN: {{ $branch->cin_no }}</div>
            </div>
        </div>

        <div class="main-body">
            <div class="row">
                <div class="field" style="flex: 2;"><span class="label">BILL NO. :</span><span class="line">{{$data['bill_no']}}</span></div>
                <div class="field" style="flex: 1.5;"><span class="label">DATE :</span><span class="line">{{$data['bill_date']}}</span></div>
                <div class="field" style="flex: 1.5;"><span class="label">SALE :</span><span class="line">{{$data['sale']}}</span></div>
            </div>
            <div class="row">
                <div class="field"><span class="label">PURCHASE</span><span class="line">{{$data['purchase']}}</span></div>
                <div class="field" style="flex: 2;"><span class="label">CUSTOM CLEARANCE</span><span class="line">{{$data['custom_clearance']}}</span></div>
            </div>
            <div class="row"><div class="field"><span class="label">EXPORTER NAME</span><span class="line">{{$data['exporter_name']}}</span></div></div>
            <div class="row"><div class="field"><span class="label">CONSIGNEE NAME</span><span class="line">{{$data['consignee_name']}}</span></div></div>
            <div class="row">
                <div class="field" style="flex: 2;"><span class="label">INVOICE NO.</span><span class="line">{{$data['invoice']}}</span></div>
                <div class="field" style="flex: 1;"><span class="label">DATE :</span><span class="line">{{$data['invoice_date']}}</span></div>
            </div>
            <div class="row">
                <div class="field"><span class="label">BOX NO.</span><span class="line">{{$data['box_no']}}</span></span></div>
                <div class="field"><span class="label">BOX SIZE</span><span class="line">{{$data['box_size']}}</span></span></div>
            </div>
            <div class="row">
                <div class="field"><span class="label">WEIGHT</span><span class="line">{{$data['weight']}}</span></span></div>
                <div class="field"><span class="label">G.WEIGHT</span><span class="line">{{$data['g_weight']}}</span></span></div>
                <div class="field"><span class="label">V.WEIGHT</span><span class="line">{{$data['v_weight']}}</span></span></div>
                <div class="field" style="flex: 0.5;"><span class="label">CBM</span><span class="line">{{$data['cbm']}}</span></span></div>
            </div>
            <div class="row">
                <div class="field" style="flex: 1.5;"><span class="label">PORT OF LOADING :</span><span class="line">{{$data['pol']}}</span></span></div>
                <div class="field"><span class="label">STUFFING POINT</span><span class="line">{{$data['stuffing_date']}}</span></span></div>
            </div>
            <div class="row"><div class="field"><span class="label">PORT OF DISCHARGE</span><span class="line">{{$data['pod']}}</span></span></div></div>
            <div class="row">
                <div class="field"><span class="label">AIR LINE NAME</span><span class="line">{{$data['air_line_name']}}</span></span></div>
                <div class="field"><span class="label">VESSEL / VOY / NAME</span><span class="line">{{$data['vessel_voy_name']}}</span></span></div>
            </div>
            <div class="row">
                <div class="field"><span class="label">AWB NO.</span><span class="line">{{$data['awb_no']}}</span></div>
                <div class="field"><span class="label">BL NO.</span><span class="line">{{$data['bl_no']}}</span></div>
            </div>
            <div class="row">
                <div class="field" style="flex: 3;"><span class="label">CONTAINER NO. & SEAL NO.</span><span class="line">{{$data['container_seal_no']}}</span></div>
                <div class="field"><span class="label">FREIGHT</span><span class="line">{{$data['freight']}}</span></div>
            </div>
            <div class="row" style="font-size: 12px;">
                <span class="label">MODE OF SHIPMENT:</span>
                <span>(1) Air {{ ($data['mode_of_shipment'] ?? '') == 'Air' ? '✔' : '___' }}</span>
                <span style="margin-left: 8px;">(2) Sea {{ ($data['mode_of_shipment'] ?? '') == 'Sea' ? '✔' : '___' }}</span>
                <span style="margin-left: 8px;">(3) LCL {{ ($data['mode_of_shipment'] ?? '') == 'LCL' ? '✔' : '___' }}</span>
                <span style="margin-left: 8px;">(4) 20/40 {{ ($data['mode_of_shipment'] ?? '') == '20/40' ? '✔' : '___' }}</span>
                <span style="margin-left: 8px;">(5) IMPORT {{ ($data['mode_of_shipment'] ?? '') == 'Import' ? '✔' : '___' }}</span>
            </div>
        </div>

        <div class="section-split" style="margin-bottom: 2px;">
            <div class="split-col" style="border-left: 3px solid black;">
                <div class="split-row">
                    <span class="label" style="width: 20px;">GSP</span>

                    <!-- Blank before YES -->
                    <span class="short-line"></span>

                    YES

                    <!-- Check for YES -->
                    <span class="short-line">
                        {{ ($data['gsp'] ?? '') === 'yes' ? '✔' : '' }}
                    </span>

                    NO

                    <!-- Check for NO -->
                    <span class="short-line">
                        {{ ($data['gsp'] ?? '') === 'no' ? '✔' : '' }}
                    </span>
                </div>
                <div class="split-row">
                    <span class="label" style="width: 20px;">COC</span>
                    <span class="short-line"></span>
                    YES
                    <span class="short-line">
                        {{ ($data['coc'] ?? '') === 'yes' ? '✔' : '' }}
                    </span>
                    NO
                    <span class="short-line">
                        {{ ($data['coc'] ?? '') === 'no' ? '✔' : '' }}
                    </span>
                </div>
                <div class="split-row">
                    <span class="label" style="width: 80px;">FUMIGATION</span>
                    <span class="short-line"></span>
                    YES
                    <span class="short-line">
                        {{ ($data['fumication'] ?? '') === 'yes' ? '✔' : '' }}
                    </span>
                    NO
                    <span class="short-line">
                        {{ ($data['fumication'] ?? '') === 'no' ? '✔' : '' }}
                    </span>
                </div>
                <div class="split-row">
                    <div class="field" style="width: 25px;"><span class="label">S/Bill No.</span><span class="line">{{$data['s_bill_no']}}</span></div>
                    <div class="field" style="flex: 0.6;"><span class="label">Date</span><span class="line">{{$data['s_bill_date']}}</span></div>
                </div>
                <div class="split-row"><div class="field"><span class="label">EP COPY</span><span class="line">{{$data['ep_copy']}}</span></div></div>
            </div>
            <div class="split-col" style="border-right: 3px solid black;">
                <div class="split-row"><div class="field"><span class="label">Forwarder Name</span><span class="line">{{$data['freight_forwarder_name']}}</span></div></div>
                <div class="split-row"><div class="field"><span class="label">CHA Name</span><span class="line">{{$data['cha_name']}}</span></div></div>
                <div class="split-row" style="margin-top: 5px;">
                    <div class="field" style="width: 20px;"><span class="label">Debit Note No</span><span class="line">{{$data['debit_note_no']}}</span></div>
                    <div class="field" style="flex: 0.6;"><span class="label">Date</span><span class="line">{{$data['debit_note_date']}}</span></div>
                </div>
                <div class="split-row"><div class="field"><span class="label">Amounts</span><span class="line">{{$data['amounts']}}</span></div></div>
                <div class="split-row"><div class="field"><span class="label">Payment Condition</span><span class="line">{{$data['payment_condition']}}</span></div></div>
            </div>
        </div>

        <div class="footer-section">
            <div class="remark-col">REMARK : <br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$data['remark']}}</div>
            <div class="flight-col" style="border-right: 3px solid black;">
                <div class="flight-details">
                    <div style="font-weight: bold;">Flight Details:</div>
                    <div class="flight-line">{{$data['flight_details']}}</div>
                    <div class="flight-line"></div>
                </div>
                <div class="bottom-boxes">
                    <div class="box-field"><span class="label">AWB</span><div class="box">{{ isset($data['awb']) ? '✔' : '' }}</div></div>
                    <div class="box-field"><span class="label">LEO</span><div class="box">{{ isset($data['leo']) ? '✔' : '' }}</div></div>
                </div>
                <div class="bottom-boxes" style="border-top: none; border-bottom: 3px solid black;">
                    <div class="box-field"><span class="label">PURCHASE BILL</span><div class="box">{{ isset($data['purchase_bill']) ? '✔' : '' }}</div></div>
                    <div class="box-field"><span class="label">SALES BILL</span><div class="box">{{ isset($data['sale_bill']) ? '✔' : '' }}</div></div>
                </div>
            </div>
        </div>
    </div>

    <!--second page-->
    <div class="page-break"></div>

    <!-- SECOND PAGE -->
        <div style="text-align: center; font-weight: bold; margin-bottom: 10px;margin-top: 20px;">
            AIR JOB PRO-FORMA INVOICE
        </div>
          <div style="text-align: center; font-weight: bold; font-size: 1.2em; border: 1px solid black;padding: 10px;">{{ $company->company_name }}</div>

          <div style="display: flex; justify-content: space-between; margin-bottom: 10px; border: 1px solid black; padding: 5px;">
            <div style="flex: 1; border-right: 1px solid black; padding-right: 5px;">POL :-</div>
            <div style="flex: 1; border-right: 1px solid black; padding-left: 5px; padding-right: 5px;">POD :-</div>
            <div style="flex: 1; padding-left: 5px;">SHIPPER NAME :-</div>
          </div>

          <table style="width: 100%; border-collapse: collapse; border: 1px solid black;">
            <tr>
              <th style="border: 1px solid black; padding: 5px; text-align: center; width: 50px;">S.NO</th>
              <th style="border: 1px solid black; padding: 5px; text-align: left;">AIR CHARGES PARTICULARS</th>
              <th style="border: 1px solid black; padding: 5px; text-align: center; width: 150px;">AMOUNT</th>
            </tr>
            <tr>
              <td style="border: 1px solid black; padding: 5px; text-align: center;">1</td>
              <td style="border: 1px solid black; padding: 5px;">AIR FREIGHT CHARGES</td>
              <td style="border: 1px solid black; padding: 5px;"></td>
            </tr>
            <tr>
              <td style="border: 1px solid black; padding: 5px; text-align: center;">2</td>
              <td style="border: 1px solid black; padding: 5px;">AIR APT TERMINAL CHARGES</td>
              <td style="border: 1px solid black; padding: 5px;"></td>
            </tr>
            <tr>
              <td style="border: 1px solid black; padding: 5px; text-align: center;">3</td>
              <td style="border: 1px solid black; padding: 5px;">AMS CHARGES</td>
              <td style="border: 1px solid black; padding: 5px;"></td>
            </tr>
            <tr>
              <td style="border: 1px solid black; padding: 5px; text-align: center;">4</td>
              <td style="border: 1px solid black; padding: 5px;">ACMES CHARGES</td>
              <td style="border: 1px solid black; padding: 5px;"></td>
            </tr>
            <tr>
              <td style="border: 1px solid black; padding: 5px; text-align: center;">5</td>
              <td style="border: 1px solid black; padding: 5px;">CUSTOM CLEARANCE CHARGES</td>
              <td style="border: 1px solid black; padding: 5px;"></td>
            </tr>
            <tr>
              <td style="border: 1px solid black; padding: 5px; text-align: center;">6</td>
              <td style="border: 1px solid black; padding: 5px;">AGENCY CHARGES</td>
              <td style="border: 1px solid black; padding: 5px;"></td>
            </tr>
            <tr>
              <td style="border: 1px solid black; padding: 5px; text-align: center;">7</td>
              <td style="border: 1px solid black; padding: 5px;">HANDLING CHARGES</td>
              <td style="border: 1px solid black; padding: 5px;"></td>
            </tr>
            <tr>
              <td style="border: 1px solid black; padding: 5px; text-align: center;">8</td>
              <td style="border: 1px solid black; padding: 5px;">CARTAGE</td>
              <td style="border: 1px solid black; padding: 5px;"></td>
            </tr>
            <tr>
              <td style="border: 1px solid black; padding: 5px; text-align: center;">9</td>
              <td style="border: 1px solid black; padding: 5px;">PALLETIZATON CHARGES</td>
              <td style="border: 1px solid black; padding: 5px;"></td>
            </tr>
            <tr>
              <td style="border: 1px solid black; padding: 5px; text-align: center;">10</td>
              <td style="border: 1px solid black; padding: 5px;">FUMIGATION CHARGES</td>
              <td style="border: 1px solid black; padding: 5px;"></td>
            </tr>
            <tr>
              <td style="border: 1px solid black; padding: 5px; text-align: center;">11</td>
              <td style="border: 1px solid black; padding: 5px;">OTHER/ MISC/ CHALLAN</td>
              <td style="border: 1px solid black; padding: 5px;"></td>
            </tr>
          </table>

          <div style="margin-top: 10px; font-style: italic;border: 1px solid black;padding-bottom: 80px;">NOTE / BILLING INSUTRUCITON</div>

          <div style="display: flex; justify-content: space-between; margin-top: 50px;">
            <div style="text-align: center; width: 30%;">
              <div style="border-top: 1px solid black; width: 80%; margin: 0 auto;"></div>
              <div style="padding-top: 5px;">ACCOUNTANT</div>
            </div>
            <div style="text-align: center; width: 30%;">
              <div style="border-top: 1px solid black; width: 80%; margin: 0 auto;"></div>
              <div style="padding-top: 5px;">MANAGER</div>
            </div>
            <div style="text-align: center; width: 30%;">
              <div style="border-top: 1px solid black; width: 80%; margin: 0 auto;"></div>
              <div style="padding-top: 5px;">DIRECTOR</div>
            </div>
          </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script>
document.getElementById('downloadBtn').addEventListener('click', function () {
    const element = document.getElementById('pdf-content');
    const opt = {
        margin: 0,
        filename: 'Job_File_Form.pdf',
        image: { type: 'jpeg', quality: 1 },
        html2canvas: {
            scale: 2,
            useCORS: true,
            width: 794, // Fixed A4 width in pixels at 96 DPI
        },
        jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
    };

    html2pdf().set(opt).from(element).save();
});
</script>
</body>
</html>
