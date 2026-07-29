<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sea Way Bill - {{ $blType }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&family=Times+New+Roman:wght@400;700&display=swap');

        /* A4 Page Setup */
        @page {
            size: A4;
            margin: 0;
        }

        body {
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
            font-family: 'Times New Roman', Times, serif;
            font-size: 10px;
            color: #000;
            -webkit-print-color-adjust: exact;
        }

        * {
            box-sizing: border-box;
        }

        /* Main Container representing the paper */
        .page {
            width: 210mm;
            min-height: 297mm;
            background: white;
            margin: 15px auto;
            padding: 10mm;
            position: relative;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        /* Terms and Conditions Page */
        .terms-page {
            padding: 5mm 3mm !important;
            font-family: Arial, Helvetica, sans-serif !important;
            font-size: 7px !important;
            line-height: 1 !important;
        }

        @media print {
            body { background: none; }
            .page { margin: 0; box-shadow: none; height: 100%; width: 100%; padding: 5mm; }
            .page-break { page-break-before: always; }
            .no-print { display: none !important; }
            .terms-page { padding: 2mm 3mm !important; }
        }

        /* Layout Utilities */
        .border-box {
            border: 1px solid #000;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .row {
            display: flex;
            width: 100%;
            border-bottom: 1px solid #000;
        }
        
        .row:last-child {
            border-bottom: none;
        }

        .col {
            border-right: 1px solid #000;
            padding: 4px;
        }

        .col:last-child {
            border-right: none;
        }

        /* Typography */
        h1 {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            margin: 5px 0;
            text-transform: uppercase;
        }

        .header-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            padding-bottom: 5px;
            margin-top: -30px;
        }

        .copy-label {
            font-size: 10px;
            font-weight: bold;
            text-align: right;
        }

        .label {
            font-size: 10px;
            color: #333;
            margin-bottom: 2px;
            display: block;
        }

        .content-text {
            font-size: 11px;
            line-height: 1.2;
        }

        .small-text {
            font-size: 11px;
            line-height: 1.3;
        }

        /* Terms and Conditions Specific Styles */
        .terms-heading {
            text-align: center;
            margin-bottom: 1mm;
        }

        .terms-main-title {
            font-size: 9.5px;
            font-weight: bold;
        }

        .terms-source {
            font-size: 6.8px;
        }

        .terms-columns {
            column-count: 3;
            column-gap: 1.5mm;
        }

        .terms-columns h5 {
            font-size: 7px;
            margin: 3px 0 2px;
        }

        .terms-columns p {
            margin: 0 0 2px;
            text-align: justify;
            line-height: 1.2 !important;
        }

        .terms-indent {
            margin-left: 7px;
        }

        /* Specific Sections */
        .logo-section {
            text-align: center;
            padding: 10px;
        }

        .company-logo {
            width: 125px;
            margin-bottom: 5px;
        }

        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 80px;
            color: rgba(0, 0, 0, 0.1);
            font-weight: bold;
            z-index: 0;
            pointer-events: none;
            white-space: nowrap;
        }

        .draft-watermark {
            color: rgba(0, 0, 0, 0.08);
        }

        /* Table inside the description area */
        .goods-table {
            width: 100%;
            border-collapse: collapse;
            height: 100%;
            min-height: 350px;
        }

        .goods-table th {
            border-bottom: 1px solid #000;
            border-right: 1px solid #000;
            font-weight: bold;
            font-size: 9px;
            text-align: left;
            padding: 3px 4px;
            vertical-align: top;
            height: 25px;
            background-color: #f5f5f5;
        }

        .goods-table td {
            border-right: 1px solid #000;
            padding: 5px;
            vertical-align: top;
            font-size: 10px;
        }

        .goods-table th:last-child,
        .goods-table td:last-child {
            border-right: none;
        }

        .signature-box {
            height: 60px;
            display: flex;
            align-items: flex-end;
            justify-content: flex-end;
            padding-right: 10px;
        }

        /* Print Controls */
        .print-controls {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            background: white;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .btn {
            padding: 8px 16px;
            margin: 5px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-print {
            background: #007bff;
            color: white;
        }

        .btn-download {
            background: #28a745;
            color: white;
        }
    </style>
</head>
<body>
    <!-- Print Controls -->
    <div class="print-controls no-print">
        <button onclick="downloadPDF()" id="downloadPdfBtn" class="btn btn-download">📥 Download PDF</button>
        <!--<button onclick="goBack()" class="btn" style="background: #6c757d; color: white;">⬅️ Back</button>-->
    </div>

    @php
        // Helper function to get safe data
        function safeData($data, $property, $default = '') {
            $value = optional($data)->$property;
        
            // null, empty string, ya sirf spaces ho to blank return karo
            if (is_null($value) || trim($value) === '') {
                return '';
            }
        
            return $value;
        }
        
        // Get container count
        $containerCount = count($seaImportDraftData->container ?? []);
        $hasContainers = $containerCount > 0;
        $containerIndex = 0;
        
        // Get BL type display text
        $blTypeDisplay = [
            'DRAFT' => 'DRAFT',
            'ORIGINAL' => 'ORIGINAL',
            '1st ORIGINAL' => '1st ORIGINAL',
            '2nd ORIGINAL' => '2nd ORIGITAL',
            '3rd ORIGINAL' => '3rd ORIGITAL',
            'NON-NEGOTIABLE' => 'COPY NON - NEGOTIABLE 3',
            'SEA WAY B/L' => 'SEA WAY BILL'
        ];
        
        $currentBlTypeDisplay = $blTypeDisplay[$blType] ?? 'DRAFT';
        
        // Company data
        $companyName = safeData($company, 'company_name');
        $companyAddress = safeData($company, 'address');
        $companyLogo = $company->logo 
            ? asset('public/uploads/company_logo/' . $company->logo)
            : asset('images/default-logo.png');
        
        // Company settings
        $companySettings = optional($company->companySetting);
        
        // Common data for all pages
        $shipper = $seaImportDraftData->shipperName;
        $consignee = $seaImportDraftData->ConsigneeName;
        $notify = $seaImportDraftData->notifyName;
        $deliveryAgent = $seaImportDraftData->deliveryAgentName;
        $shippingLine = $seaImportDraftData->shippingLine;
        
        // Format dates
        $sobDate = $seaImportDraftData->sob_date ? date('d M Y', strtotime($seaImportDraftData->sob_date)) : '';
        
        $formattedIssueDate = $issueDate;
        if (strtotime($issueDate)) {
            $formattedIssueDate = date('d/m/Y', strtotime($issueDate));
        }
        
        // Get package details from seaImportDraftData if no containers
        $totalPackages = 0;
        $goodsDescription = '';
        $grossWeight = 0;
        $netWeight = 0;
        $cbm = 0;
        
        if (!$hasContainers) {
            $totalPackages = safeData($seaImportDraftData, 'total_package', 0);
            $goodsDescription = safeData($seaImportDraftData, 'goods_description', '');
            $grossWeight = safeData($seaImportDraftData, 'gross_weight', 0);
            $netWeight = safeData($seaImportDraftData, 'net_weight', 0);
            $cbm = safeData($seaImportDraftData, 'cbm', 0);
        }
        
        // Freight display
        $freightDisplay = safeData($seaImportDraftData, 'freight', 'PREPAID');
        if ($freightDisplay === 'C') {
            $freightDisplay = 'COLLECT';
        } elseif ($freightDisplay === 'P') {
            $freightDisplay = 'PREPAID';
        }
    @endphp

    @if($hasContainers)
        @foreach($seaImportDraftData->container as $container)
            @if($loop->index == 2)
                @break
            @endif
            @php
                $containerIndex++;
                
                if($containerIndex > 2){
                    break;
                }
            @endphp

            {{-- Container Main Page --}}
            @if($containerIndex == 1) {{-- First container (Front Page) --}}
                <div class="page">
                    @if($blType == 'DRAFT')
                        <div class="watermark draft-watermark">DRAFT</div>
                    @elseif($blType == 'NON-NEGOTIABLE')
                        <div class="watermark draft-watermark">NON-NEGOTIABLE</div>
                    @endif
                    
                    <div class="header-top">
                        <div style="flex:1"></div>
                        <h1 style="flex:2">MULTIMODAL TRANSPORT DOCUMENT</h1>
                        <div class="copy-label" style="flex:1">{{ $currentBlTypeDisplay }}</div>
                    </div>

                    <div class="border-box">
                        {{-- Shipper and BL Info Row --}}
                        <div class="row" style="height: 125px; border-bottom: none;">
                            {{-- Shipper Section --}}
                            <div class="col" style="width: 45%; border-bottom: 1px solid #000;">
                                <span class="label">Consignor / Shipper</span>
                                <div class="content-text">
                                    {{ safeData($shipper, 'party_name') }}<br>
                                    {{ safeData($shipper, 'address_line1') }}<br>
                                    {{ safeData($shipper, 'address_line2') }}<br>
                                    {{ safeData($shipper, 'city') }}<br>
                                    @if(safeData($shipper, 'contact_person'))
                                        <b>Contact Person: </b>{{ safeData($shipper, 'contact_person') }}<br>
                                    @endif
                                    @if(safeData($shipper, 'tel_no'))
                                        <b>Contact No: </b>{{ safeData($shipper, 'tel_no') }}<br>
                                    @endif
                                    @if(safeData($shipper, 'pincode'))
                                        <b>Pincode: </b>{{ safeData($shipper, 'pincode') }}<br>
                                    @endif
                                    @if(safeData($shipper, 'gstin'))
                                        <b>GSTIN No: </b>{{ safeData($shipper, 'gstin') }}
                                    @endif
                                </div>
                            </div>

                            {{-- BL Info Section --}}
                            <div class="col" style="width: 55%; padding: 0; display: flex; flex-direction: column;">
                                <div class="row" style="height: 20px;">
                                    <div class="col" style="width: 50%; border-bottom: none; text-align: right; padding-right: 5px;">Booking No.</div>
                                    <div class="col" style="width: 50%; border-bottom: none; font-weight: bold; text-align: center;">
                                        {{ safeData($seaImportDraftData, 'booking_no') }}
                                    </div>
                                </div>
                                <div class="row" style="height: 20px;">
                                    <div class="col" style="width: 50%; text-align: right; padding-right: 5px;">BL Number</div>
                                    <div class="col" style="width: 50%; font-weight: bold; text-align: center;">
                                        {{ $seaImportDraftData->mbl_no ?? $seaImportDraftData->hbl_no ?? 'N/A' }}
                                    </div>
                                </div>
                                
                                <div class="logo-section" style="flex-grow: 1;">
                                    <img src="{{ $companyLogo }}" alt="Company Logo" class="company-logo" onerror="this.style.display='none'">
                                </div>
                            </div>
                        </div>

                        {{-- Consignee and Company Info Row --}}
                        <div class="row" style="height: 125px; border-bottom: none;">
                            <div class="col" style="width: 45%;">
                                <span class="label">Consignee (if 'To Order' as indicated)</span>
                                <div class="content-text">
                                    {{ safeData($consignee, 'party_name') }}<br>
                                    {{ safeData($consignee, 'address_line1') }}<br>
                                    {{ safeData($consignee, 'address_line2') }}<br>
                                    {{ safeData($consignee, 'city') }}<br>
                                    @if(safeData($consignee, 'contact_person'))
                                        <b>Contact Person: </b>{{ safeData($consignee, 'contact_person') }}<br>
                                    @endif
                                    @if(safeData($consignee, 'tel_no'))
                                        <b>Contact No: </b>{{ safeData($consignee, 'tel_no') }}<br>
                                    @endif
                                    @if(safeData($consignee, 'pincode'))
                                        <b>Pincode: </b>{{ safeData($consignee, 'pincode') }}<br>
                                    @endif
                                    @if(safeData($consignee, 'gstin'))
                                        <b>GSTIN No: </b>{{ safeData($consignee, 'gstin') }}
                                    @endif
                                </div>
                            </div>

                            <div class="col" style="width: 55%; text-align: center; padding: 5px;">
                                <div style="font-weight: bold; font-size: 16px; margin-bottom: 5px;margin-top: 15px;">{{ $companyName }}</div>
                                <div class="small-text">
                                    {{ $companyAddress }}<br>
                                    @if(safeData($companySettings, 'phone'))
                                        Tel: {{ safeData($companySettings, 'phone') }}
                                    @endif
                                    @if(safeData($companySettings, 'email'))
                                        E-mail: {{ safeData($companySettings, 'email') }}
                                    @endif
                                    @if(safeData($company, 'website'))
                                        Website: {{ safeData($company, 'website') }}
                                    @endif
                                </div>
                                @if(safeData($companySettings, 'reg_no'))
                                    <div style="font-weight: bold; margin: 5px 0; font-size: 12px;">MTO Reg. No. {{ safeData($companySettings, 'reg_no') }}</div>
                                @endif
                                <div class="small-text" style="text-align: justify; font-size: 9px; margin-top: 5px;">
                                    Taken in charge in apparently good condition herein at the place of receipt for transport and delivery as mentioned above, unless otherwise stated. The MTO in accordance with the provisions contained in the MTD undertakes to perform or to procure the performance of the multimodal transport from the place at which the goods are taken in charge, to be place designated for delivery and assumes responsibility for such transport.
                                    <br><br>
                                    One of the MTD(s) must be surrendered, duly endorsed in exchange for the goods, in witness where of the original MTD all of this tenor and date have been signed in number indicated below one of which being accomplished the other(s) to be void
                                </div>
                            </div>
                        </div>

                        {{-- Notify Party Row --}}
                        <div class="row" style="height: 125px; border-top: none;">
                            <div class="col" style="width: 45%; border-top: 1px solid #000;">
                                <span class="label">Notify address (No Claim shall attached for failure to notify)</span>
                                <div class="content-text">
                                    @if(safeData($notify, 'party_name'))
                                    
                                        {{ safeData($notify, 'party_name') }}<br>
                                        {{ safeData($notify, 'address_line1') }}<br>
                                        {{ safeData($notify, 'address_line2') }}<br>
                                        {{ safeData($notify, 'city') }}<br>
                                        @if(safeData($notify, 'contact_person'))
                                            <b>Contact Person: </b>{{ safeData($notify, 'contact_person') }}<br>
                                        @endif
                                        @if(safeData($notify, 'tel_no'))
                                            <b>Contact No: </b>{{ safeData($notify, 'tel_no') }}<br>
                                        @endif
                                        @if(safeData($notify, 'pincode'))
                                            <b>Pincode: </b>{{ safeData($notify, 'pincode') }}<br>
                                        @endif
                                        @if(safeData($notify, 'gstin'))
                                            <b>GSTIN No: </b>{{ safeData($notify, 'gstin') }}
                                        @endif
                                    @else
                                        <small>Notify same as consignee</small>
                                    @endif
                                    
                                </div>
                            </div>
                            <div class="col" style="width: 55%; border-top: 1px solid #000; border-left: none;border-top: none;"></div>
                        </div>

                        {{-- Port Information --}}
                        <div class="row" style="height: 45px;">
                            <div class="col" style="width: 22.5%;">
                                <span class="label">Place Of Receipt</span>
                                <div class="content-text">{{ safeData($seaImportDraftData->receiptPortName, 'port_name', 'N/A') }}</div>
                            </div>
                            <div class="col" style="width: 22.5%;">
                                <span class="label">Port Of Loading</span>
                                <div class="content-text">{{ safeData($seaImportDraftData->loadingPortName, 'port_name', 'N/A') }}</div>
                            </div>
                            <div class="col" style="width: 55%; padding: 0;"></div>
                        </div>

                        <div class="row" style="height: 45px;">
                            <div class="col" style="width: 22.5%;">
                                <span class="label">Port Of Discharge</span>
                                <div class="content-text">{{ safeData($seaImportDraftData->dischargePortName, 'port_name', 'N/A') }}</div>
                            </div>
                            <div class="col" style="width: 22.5%;">
                                <span class="label">Final Place Of Delivery</span>
                                <div class="content-text">{{ safeData($seaImportDraftData->deliveryPortName, 'port_name', 'N/A') }}</div>
                            </div>
                            <div class="col" style="width: 55%; padding: 0;"></div>
                        </div>

                        {{-- Vessel and Transport Details --}}
                        <div class="row" style="height: 45px;">
                            <div class="col" style="width: 45%;">
                                <span class="label">Vessel & Voyage No.</span>
                                <div class="content-text">
                                    {{ safeData($seaImportDraftData, 'vessel_name', 'N/A') }} V. {{ safeData($seaImportDraftData, 'voyage_no', 'N/A') }}
                                </div>
                            </div>
                            <div class="col" style="width: 25%;">
                                <span class="label">Mode Means Of Transport</span>
                                <div class="content-text">Sea</div>
                            </div>
                            <div class="col" style="width: 30%;">
                                <span class="label">Route/Place of Transhipment(if any)</span>
                                <div class="content-text">{{ safeData($seaImportDraftData, 'transhipment_port', 'N/A') }}</div>
                            </div>
                        </div>

                        {{-- Goods Table --}}
                        <div class="row" style="flex-grow: 1; position: relative;">
                            <table class="goods-table">
                                <colgroup>
                                    <col style="width: 25%;">
                                    <col style="width: 45%;">
                                    <col style="width: 15%;">
                                    <col style="width: 15%;">
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th>Container No.(s)<br>Marks and number</th>
                                        <th>Number of packages, kinds of packages<br>general description of goods, said to contain</th>
                                        <th>Gross Weight</th>
                                        <th>Measurement</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="height: 300px; vertical-align: top;">
                                        <td>
                                            <b>Container:</b> {{ safeData($container, 'container_no') }}/{{ safeData($container, 'size') }}<br>
                                            <b>C.S.No:</b> {{ safeData($container, 'cust_seal_no', 'N/A') }}<br>
                                            <b>A.S.No:</b> {{ safeData($container, 'agentSealNo', 'N/A') }}<br>
                                            <b>PACKAGES:</b> {{ safeData($container, 'total_package') }} {{ safeData($seaImportDraftData->packageName, 'package_code') }}<br>
                                            @if(!empty($container->mark_number))
                                                <b>Marks and Numbers:</b><br>
                                                {{ $container->mark_number }}<br><br>
                                            @endif
                                            
                                            {{ safeData($container, 'fcl_lcl', 'N/A') }}/{{ safeData($container, 'fcl_lcl', 'N/A') }}, {{ safeData($seaImportDraftData, 'movement', '') }}<br>
                                            <br>ALL DESTINATION CHARGES ON CONSIGNEE ACCOUNT
                                            <br><br><br><br>
                                            <div style="font-size: 10;">
                                                @php
                                                    $containers = $seaImportDraftData->container;
                                                @endphp
                                                @foreach($containers as $index => $cont)
                                                    @if($index >= 1) {{-- 2nd container se start --}}
                                                        Cont. No.{{ $cont['container_no'] }}/{{ $cont['size'] }}<br>
                                                        @if($index < count($containers) - 1)
                                                            <br> 
                                                        @endif
                                                    @endif
                                                @endforeach
                                                @php
                                                    $totalPackagesOfContainers = 0;
                                                
                                                    foreach ($seaImportDraftData->container as $contPkgTotal) {
                                                        $totalPackagesOfContainers += $contPkgTotal->total_package;
                                                    }
                                                @endphp
                                            </div>
                                        </td>
                                        <td>    
                                            <b>Total Packages:</b>{{$totalPackagesOfContainers}} {{ safeData($seaImportDraftData->packageName, 'package_code') }} ONLY<br>
                                            <b>Goods Description:</b><br>
                                            {{ safeData($container, 'goods_description') }}<br>
                                            
                                            @if(safeData($container, 'customer_inv_no'))
                                                <br><b>INVOICE NO:</b> {{ safeData($container, 'customer_inv_no') }}<br>
                                            @endif
                                            @if(safeData($container, 'sbill_no'))
                                                <b>SB. NO:</b> {{ safeData($container, 'sbill_no') }}
                                            @endif
                                            <br><br><br><br><br>
                                            <div style="text-align: right; margin-top: 20px; font-weight: bold;">
                                                SHIPPED ONBOARD DATE: {{ safeData($container, 'sobDate') }}
                                            
                                                @php
                                                    $blDescription = optional($seaImportDraftData->blType)->bl_description;
                                                @endphp
                                            
                                                @if(!empty($seaImportDraftData->hbl_type) && $blDescription === 'TELEX RELEASE')
                                                    <br><br><br><br><br><br><br>
                                                    <span style="
                                                            display: inline-block;
                                                            margin-top: 8px;
                                                            padding: 6px 18px;
                                                            border: 2px solid #000;
                                                            font-weight: bold;
                                                            text-align: center;
                                                            font-size: 15px;
                                                        ">{{ $blDescription }}</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td style="text-align: center;">
                                            {{ safeData($container, 'gross_weight', '0') }}<br><b>KGS</b><br><br>
                                            <b>Net Weight</b><br>
                                            {{ safeData($container, 'net_weight', '0') }}<br><b>KGS</b>
                                        </td>
                                        <td style="text-align: center;">
                                            {{ safeData($container, 'cbm', '0') }}<br><b>CBM</b>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                            
                        {{-- Footer Section --}}
                        <div class="row" style="border-top: 1px solid #000; text-align: center; height: 25px;">
                            <div style="width: 100%; text-align: center; padding: 5px;">
                                <b>FREIGHT : </b>{{ strtoupper($freightDisplay) }}
                            </div>
                        </div>
                        
                        {{-- Final Details and Signature --}}
                        <div class="row" style="height: 137px;">
                            <div class="col" style="width: 40%; display: flex; flex-direction: column; justify-content: space-between;">
                                <div>
                                    @if(safeData($seaImportDraftData->agentName, 'party_name'))
                                        <span class="label">Booking Party: {{ safeData($seaImportDraftData->agentName, 'party_name') }}</span><br>
                                    @endif
                                    <span class="label">Delivery Agent</span>
                                    <div class="content-text" style="margin-top: 5px;">
                                        {{ safeData($deliveryAgent, 'party_name') }}<br>
                                        {{ safeData($deliveryAgent, 'address_line1') }}<br>
                                        {{ safeData($deliveryAgent, 'address_line2') }}<br>
                                        {{ safeData($deliveryAgent, 'city') }}<br>
                                        @if(safeData($deliveryAgent, 'tel_no'))
                                            <b>TEL:</b> {{ safeData($deliveryAgent, 'tel_no') }}
                                        @endif
                                    </div>
                                </div>
                                <div style="border-top: 1px solid #000; font-size: 8px; padding-top: 2px;">
                                    Other Particulars (if any)<br>
                                    Weight and Measurement of container not be included
                                </div>
                            </div>

                            <div class="col" style="width: 60%; padding: 0; display: flex; flex-direction: column;">
                                <div class="row" style="flex-grow: 1; height: 70%; border-bottom: none;">
                                    <div class="col" style="width: 30%;">
                                        <span class="label">Freight Amount</span>
                                        <div style="margin-top: 40px; font-size: 9px;">
                                            Freight Payable At<br>
                                            <b>{{ $freightPayable ?: 'N/A' }}</b>
                                        </div>
                                    </div>
                                    <div class="col" style="width: 20%;">
                                        <span class="label">No. of Original MTD(s)</span>
                                        <div style="text-align: center; margin-top: 5px; font-weight: bold;">
                                            @if(in_array($blType, ['ORIGINAL', '1st ORIGINAL', '2nd ORIGINAL', '3rd ORIGINAL']))
                                                3
                                            @else
                                                0
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col" style="width: 50%;">
                                        <span class="label">Place and Date of Issue</span>
                                        <div style="text-align: center; font-weight: bold; margin-top: 5px; font-size: 12px;">
                                            {{ safeData($seaImportDraftData, 'issue_place', '') }} &nbsp;&nbsp;&nbsp; {{ $formattedIssueDate }}
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="height: 60px; border-top: 1px solid #000;">
                                    <div style="width: 100%; padding: 3px; position: relative;">
                                        <div style="font-weight: bold; text-align: right; font-size: 9px; margin-bottom: 20px;">
                                            FOR {{ $companyName }}
                                            <br><br><br><br>
                                            <span style="font-size: 8px;">(Authorised Signatory)</span>
                                        </div>
                                        @if(safeData($companySettings, 'cin_no'))
                                            <div style="position: absolute; bottom: -12px; right: 5px; font-size: 10px;">
                                                CIN: {{ safeData($companySettings, 'cin_no') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Terms and Conditions Page for First Container --}}
                <div class="page-break"></div>
                <div class="page terms-page">
                <div class="terms-heading">
                    <div class="terms-main-title">
                        Standard Conditions governing Multimodal Transport Documents (MTD),
                        issued in accordance with Multimodal Transportation of Goods Act, 1993
                    </div>
                    <div class="terms-source">
                        [As Placed on www.dgshipping.com / Shipping Notices / MTO]
                    </div>
                </div>

                <div class="terms-columns">
                    <h5>1. Definitions</h5>
                    <p>(a) "Carrier" means a person who is engaged in the business of transporting for hire goods by road, rail, inland waterways or sea.</p>
                    <p>(b) "Consignee" means the person named as consignee in the multimodal transport contract.</p>
                    <p>(c) "Consignment" means the goods entrusted to a MTO for multimodal transportation.</p>
                    <p>(d) "Consignor" means the person, named in the Multimodal Transport Contract as consignor by whom or on whose behalf the multimodal transport contract are entrusted to a MTO for Multimodal transportation.</p>
                    <p>(e) "Delivery" means -  
                        (1) in the case of a negotiable MTD, delivery of the consignment to, or placing the consignment at the disposal of, the consignee or any other person entitled to receive it;
                        (2) in the case of a non-negotiable MTD, delivery of the consignment to the consignee or any person authorized by the consignee to accept delivery of the consignment.</p>
                    <p>(f) "Endorsement" means the signing by the consignee or the endorsee after adding a direction on a negotiable MTD to pass the property in the goods mentioned in such document to a specified person.</p>
                    <p>(g) "Goods" include
                        (1) Containers, pallets or similar articles of transport used to consolidate goods; and
                        (2) Animals.</p>
                    <p>(h) "Mode of transport" means carriage of goods by road, inland waterways or sea.</p>
                    <p>(i) "Multimodal transportation" means carriage of goods by two or more modes of transport from the place of acceptance of the goods in India to a place of delivery of the goods outside India.</p>
                    <p>(j) "Multimodal Transport Contract" means a contract entered into by the consignor and the MTO for multimodal transportation.</p>
                    <p><b>(k) "Multimodal Transport Operator (MTO)"</b> means any person who:
                        (1) concludes a multimodal transport contract on his own behalf or through another person acting on his behalf;
                        (2) acts as a principal or as an agent either of the consignor or of the consignee; and
                        (3) assumes responsibility for the performance of the contract; and
                        (4) is registered under sub-section (3) of section 4 of the Act.</p>
                    <p><b>(l) "Negotiable MTD"</b> means a multimodal transport document which is:
                        (1) made out to order or to bearer; or
                        (2) made out to order and is transferable by endorsement.</p>
                    <p><b>(m) "Non-negotiable MTD"</b> means a MTD which indicates only one named consignee.</p>

                    <h5>2. Acceptability</h5>
                    <p>The provisions set out and referred to in this MTD shall apply if the transport as described on the face of the document is by two or more modes of transport from the place of acceptance of the goods in India to a place of delivery of the goods outside India.</p>

                    <h5>3. Effect of issue of MTD</h5>
                    <p>(1) The issuance of the MTD confers and imposes on all parties having or acquiring a right or interest in the rights/obligations and defences set out in the conditions mentioned in this document.<br>
                        (2) By issuance of the MTD the MTO:<br>
                        (a) undertakes to perform and/or in his own name to procure performance of the MTO including all services which are necessary to such performance from the time of taking the goods in charge to the time of delivery, and accepts responsibility for such transportation and such services to the extent set out in these conditions;
                        (b) accepts responsibility for the acts and omissions of his agents or servants, such acts and omissions within the scope of their employment, as if such acts and omissions were his own;
                        (c) accepts responsibility for the acts and omissions of any other person whose services he uses for the performance of the contract evidenced by this MTD;
                        (d) undertakes to perform or to procure performance of all acts necessary to delivery or to procure performance of all acts necessary to delivery;
                        (e) assumes liability to the extent set out in these conditions of loss or damage to the goods occurring between the time of taking the goods in charge and the time of delivery, and undertakes to pay compensation as set out in these conditions in respect of such loss or damage;
                        (f) assumes liability to the extent set out in these conditions for delay in delivery of the goods and undertakes to pay compensation as set out in that condition.</p>

                    <h5>4. Negotiability and Title to the Goods</h5>
                    <p>By accepting the Multimodal Transportation Document the consignor and his transferees agree with the MTO that, unless it is marked "Non-negotiable", it shall constitute title to the goods and the holder, by endorsement of this MTD, shall be entitled to receive or to transfer the goods mentioned in this MTD.</p>

                    <h5>5. Reservations</h5>
                    <p>If the MTD contains particulars concerning the general nature, leading marks, number of packages or pieces, weight or quantity of the goods which the MTO or a person acting on his behalf knows, or has reasonable grounds to suspect, do not accurately represent the goods actually taken in charge, or if he has no reasonable means of checking such particulars, the MTO or a person acting on his behalf shall insert in the MTD a reservation specifying these inaccuracies, grounds of suspicion or the absence of reasonable means of checking. If the MTO or a person acting on his behalf fails to note on the MTD the apparent condition of the goods, he is deemed to have noted on the MTD that the goods were in apparent good condition</p>

                    <h5>6. Evidentiary effect of the MTD</h5>
                    <p>(1) The MTD shall be prima facie evidence of the taking in charge by the MTO of the goods as described therein; and
                        (2) Proof to the contrary the MTD shall not be admissible if the MTD is issued in negotiable form and has been transferred to a third party, including a consignee, who has acted in good faith in reliance on the description of goods therein.</p>

                    <h5>7. Guarantee by the consignor</h5>
                    <p>(1) The consignor shall be deemed to have guaranteed to the MTO the accuracy at the time the goods were taken in charge by the MTO of particulars relating to the general nature of the goods, their marks, number, weight and quantity, and, if applicable, to the dangerous character of the goods as furnished by him for insertion in the MTD.
                    (2) The consignor shall indemnify the MTO against loss resulting from inaccuracies or inadequacies of the particulars. The consignor shall remain liable even if the MTD has been transferred by him. The right of the MTO to such indemnity shall in no way limit his liability under the Multimodal Transport Contract to any person other than the consignor.</p>

                    <h5>8. Dangerous goods</h5>
                    <p>(1) The consignor shall mark or label dangerous goods in a suitable manner as "dangerous goods".<br>
                        (2) Where the consignor hands over dangerous goods to the MTO or any person acting on his behalf, the consignor shall inform him of the dangerous character of the goods and, if necessary, the precautions to be taken. If the consignor fails to do so and the MTO does not otherwise have knowledge of their dangerous character then:
                        <br>
                        (i) the consignor shall be liable to the MTO for all loss resulting from the shipment of such goods; and<br>
                        (ii) the goods may at any time be unloaded, destroyed or rendered innocuous, as the circumstances may require, without payment of compensation.
                    </p>

                    <h5>9. Period of responsibility</h5>
                    <p>(1) The responsibility of the MTO for the goods covers the period from the time he takes the goods in his charge to the time of their delivery. For the purpose of this responsibility, the MTO is deemed to be in charge of the goods,<br>
                        (a) from the time he has taken over the goods from:
                            (i) the consignor or a person acting on his behalf;<br>
                            (ii) an authority or other third party to whom, pursuant to law or regulations applicable at the place of taking charge the goods must be handed over for transport;<br>
                        (b) until the time he has delivered the goods:
                            (i) by handing them over to the consignee; or
                            (ii) by placing them at the disposal of the consignee in accordance with the Multimodal Transport Contract; or
                            (iii) by handing them over to an authority or other third party to whom, pursuant to law or regulations applicable at the place of delivery, the goods must be handed over.<br>
                        (2) Reference to the MTO in this regard shall include his servants or agents or any other person of whose services he makes use for the performance of the Multimodal Transport Contract, and reference to the consignor or consignee shall include their servants or agents.
                    </p>

                    <h5>10. Basis of liability</h5>
                    <p>
                        (1)The MTO shall be liable for loss resulting from loss of or damage to goods or delay in delivery and any consequential loss or damage caused by delay, except where the goods were in his charge unless the MTO proves that he, his servants or agents or other persons whose services he uses for the performance of the contract evidenced by this Multimodal Transport Document, took all measures that could reasonably be required to avoid the occurrence and its consequences.<br>
                        (2) Where loss of or damage to goods, or delay in delivery, is attributable to the fault or neglect, provided that the MTO proves that the loss, damage or delay in delivery not attributable thereto.<br>
                        (3) Delay in delivery occurs when the goods have not been delivered within the time expressly agreed upon in the absence of such agreement, within reasonable time required by a diligent MTO, having regard to the circumstances of the case to affect the delivery of goods.<br>
                        (4) If the goods have not been delivered within ninety consecutive days following the date of delivery when ninety days are agreed upon, the claimant may treat the goods as lost.
                    </p>

                    <h5>11. Liability for loss or damage when the stage of transport where the loss or damage occurred is not known</h5>
                    <p>
                        (1) When the MTO is liable to pay compensation in respect of loss of or damage to the goods occurring between the time of taking them into his charge and the time of delivery and the stage of transport where the loss or damage occurred is not known:<br>
                            a. such compensation shall be calculated by reference to the value of such goods at the place and time they are delivered to the consignee or at the place and time when, in accordance with the contract of Multimodal Transport, they should have been so delivered.<br>
                            b. The value of the goods shall be determined according to the current commodity exchange price or, if there is no such price, according to the current market price or, if there is no commodity exchange price or current market price, by reference to the normal value of goods of the same kind and quality; however, the MTO shall not, in any case, be liable for an amount greater than that which is due in accordance with the applicable law.<br>
                        (2) Where a MTO becomes liable for any loss of, or damage to, any consignment, the nature and value thereof have not been declared by the consignor before such consignment has been taken in charge by the multimodal transport operator and the stage of transport at which such loss or damage occurred is not known, the special drawing rights per kilogram of the gross weight of the consignment lost or damaged shall not exceed two Special Drawing Rights per kilogram.<br>
                        (3) Notwithstanding anything contained above if the multimodal transportation does not, accordingly to the multimodal transport contract, include carriage of goods by sea or by inland waterways, the liability of the MTO shall be limited to an amount not exceeding 8.33 Special Drawing Rights per kilogram of the gross weight of the goods lost or damaged.
                    </p>

                    <h5>12. Liability for loss or damage when the stage of transport where the loss or damage occurred is known:-</h5>
                    <p>
                        (1) When the MTO is liable to pay compensation in respect of loss of or damage to the goods occurring between the time of taking them into his charge and the time of delivery and the stage of transport where such loss or damage occurred is known, the liability of the MTO in respect of such loss or damage shall be determined by the provisions of law applicable to the mode of transport under which the loss or damage occurred.<br>
                        (2) Without prejudice to the provisions contained in para 3(2) and (c) mentioned in this document when, under the provisions of law applicable to the provisions contained in this document, the liability of the MTO shall be determined by the provisions of law applicable to the mode of transport under which the loss or damage occurred.
                    </p>

                    <h5>13. Defence and limits of the MTO and his servants</h5>
                    <p>
                        (1) The defences and limits of liability provided for in this MTD shall apply in any action for loss resulting from loss of or damage to goods, delay in delivery and any consequential loss or damage arising from such delay.<br>
                        (2) If any action for loss of or damage is brought against the servant or agent of the MTO, if such servant or agent proves that he acted within the scope of his employment, or against any other person of whose services he makes use for the performance of the Multimodal Transport Contract, if such other person proves that he acted within the performance of the contract, the servant or agent or such other person shall be entitled to avail himself of the defences and limits of liability which the MTO is entitled to invoke under this MTD.<br>
                        (3) Except as provided for liability for delay, as mentioned below, the aggregate of the amounts recoverable from the MTO and from a servant or agent or any other person of whose services he makes use for the performance of the Multimodal Transport Contract shall not exceed the limits of liability provided for in this MTD.
                    </p>

                    <h5>14. Liability for delay</h5>
                    <p>
                        The liability of the MTO for loss resulting from delay in delivery shall be limited to an amount equivalent to the freight payable for the goods delayed but not exceeding twice the freight payable under the Multimodal Transport Contract.
                    </p>

                    <h5>15. Loss of the right to limit liability</h5>
                    <p>
                        (1) The limits of liability established in conditions 11, 12 and 14 above shall not apply if it is proved that the loss, damage or delay in delivery resulted from an act or omission of the MTO or his servants or agents or any other person of whose services he makes use for the performance of the Multimodal Transport Contract, done with the intent to cause such loss, damage or delay or recklessly and with knowledge that such loss, damage or delay would probably result.<br>
                        (2) Notwithstanding the provisions 13(2) above, if it is proved that the loss, damage or delay in delivery resulted from an act or omission of a servant or agent of whose services he makes use for the performance of the Multimodal Transport Contract, done with the intent to cause such loss, damage or delay or recklessly and with knowledge that such loss, damage or delay would probably result, the servant or agent shall not be entitled to the benefit of limitation of liability provided for in these conditions.
                    </p>

                    <h5>16. Delivery / non-delivery</h5>
                    <p>
                        (1) If delivery / non-delivery of the consignee within a reasonable time after the MTO has called upon him to take delivery, the MTO shall be at liberty to put the goods in safe custody or behalf of the consignee at the consignee's risk and expense or to place the goods at the disposal of the consignee in accordance with the Multimodal Transport Contract or with the law, or with usage of the particular trade applicable at the place of delivery.<br>
                        (2)The MTD shall be discharged from his obligation to deliver the goods if, where a negotiable MTD has been issued in a set of more than one original, he, or a person acting on his behalf, has in good faith delivered the goods against surrender of one of such originals.
                    </p>

                    <h5>17. Notice of loss, damage or delay</h5>
                    <p>
                        (1) Unless notice of loss or damage, specifying the general nature of such loss or damage is given in writing by the consignee to the MTO at the time of taking over the goods or within six consecutive days thereafter, the goods shall be presumed to have been delivered as described in the MTD.<br>
                        (2)Where the loss or damage is not apparent, the provisions of condition (1) referred to above apply correspondingly if notice in writing is not given within ten consecutive days after the day when the goods were handed over to the consignee.<br>
                        (3) If the state of the goods at the time they were handed over to the consignee has been subject to a joint survey and inspection by the parties or their representatives of the loss or damage on delivery, notice in writing need not be given of loss or damage ascertained during such survey or inspection.<br>
                        (4) In the case of any actual or apprehended loss or damage the MTO and the consignee shall give all reasonable facilities to each other for inspecting and tallying the goods.<br>
                        (5) If any of the notice periods provided for in condition (2) and (4) referred to above terminates on a public holiday at the place of delivery, such periods shall be extended up to the next working day.<br>
                        (6) Notice given to a person acting on behalf of the MTO including any person of whose services he makes use at the place of delivery, shall be deemed to have been given to the MTO.
                    </p>

                    <h5>18. Freight and charges</h5>
                    <p>
                        (1) Freight shall be deemed earned on receipt of goods by MTO and shall be paid for, in any event.<br>
                        (2) For the purpose of verifying the freight basis, the MTO reserves the right to have the contents of the containers, trailers or similar articles of transport inspected in order to ascertain the weight, measurement, value or nature of the goods.<br>
                        (3) All dues, taxes and the charges levied on the goods and other expenses in connection therewith, shall be paid by the consignor at the consignee or the holder of MTD or the owner of the goods.<br>
                    </p>

                    <h5>19. Containers etc.</h5>
                    <p>
                        (1) Goods may be stowed by the MTO by means of containers, trailers, transportable tanks, pallets and similar articles of transport used to consolidate goods and these articles of transport may be stowed under or on deck.<br>
                        (2) If a container has not been filled, packed or stowed by the MTO, the MTO shall not be liable for any loss of, or damage to, its contents and the consignor shall cover any loss of expense incurred by the MTO, if such loss, damage or expense has been caused by:<br>
                            (a) negligent packing or stowing of the container;<br>
                            (b) the contents being unsuitable for carriage in container; or<br>
                            (c) the unsuitability or defective condition of the container unless the container has been supplied by the MTO and the unsuitable or defective condition would not have been apparent upon reasonable inspection at, or prior to, the time when the container was filled, packed and stowed.<br>
                        (3) The provisions of this condition also apply with respect to trailers, transportable tanks, flats and pallets which have not been filled, packed or stowed by the Multimodal Transport Operator.<br>
                        (4) The MTO does not accept liability for the functioning of refrigerated containers supplied by the consignor.<br>
                        (5) If, by order of the authorities of any place, the goods have to be unpacked from their containers or be inspected, the MTO shall not be liable for the loss or damage incurred during the unpacking, inspection or re-packing. The MTO shall be entitled to recover the cost of unpacking, inspection and repacking from the consignor/consignee.
                    </p>

                    <h5>20. Hindrance etc. affecting performance</h5>
                    <p>The MTO shall use reasonable endeavors to complete the transport and to deliver the goods at the place designated for delivery.</p>

                    <h5>21. Lien</h5>
                    <p>The MTO shall have a lien on the goods for any amount due under the Multimodal Contract and for the costs of recovering the same, and may enforce such lien in any reasonable manner.</p>

                    <h5>22. Limitation of action</h5>
                    <p>
                        Any action relating to Multimodal Transport under these conditions shall be time-barred if judicial proceedings have not been instituted within a period of nine months after:<br>
                        (1) the date of delivery of the goods, or<br>
                        (2) the date when the goods should have been delivered, or<br>
                        (3) the date on and from which the party entitled to receive has the right to treat the goods as lost.
                    </p>

                    <h5>23. Jurisdiction</h5>
                    <p>
                        (1) In judicial proceedings relating to the contract for MTD under these conditions the plaintiff, at his option, may institute an action in a court which, according to the law of the country where the court is situated, is competent and within the jurisdiction of which is situated one of the following places:<br>
                            (a) the principal place of business, or the absence thereof, the habitual residence of the defendant; or<br>
                            (b) the place where the Multimodal Transport Contract was made, provided that the defendant has a place of business branch or agency at such place; or<br>
                            (c) the place of taking charge of the goods for Multimodal Transportation or the place of delivery thereof; or<br>
                            (d) any other place specified for that purpose in the Multimodal Transport Contract and evidenced in the MTD.
                    </p>

                    <h5>24. General Average</h5>
                    <p>
                        The Consignor or consignee, the holder of the MTD, the receiver and the owner of the goods shall indemnify MTO in respect of any claim of general average nature which may be made on him and shall provide such security as may be required by the MTO in this connection.
                    </p>

                    <h5>25. Arbitration</h5>
                    <p>
                        Suitable provisions may be incorporated, by the parties to the Multimodal Transport Contract.
                    </p>

                    <h5>26. "Carrier Clause"</h5>
                    <p>
                        When the MTO is named on the face of the MTD and assumes liability for the performance under the MTD for transport or from the United States, the MTO assumes liability for such performance as a common carrier.
                    </p>

                    <h5>27. "USA Clause Paramount"</h5>
                    <p>
                        (1) If carriage performed to, from or through a port in the United States of America, the MTD shall be subject to the United States Carriage of Goods by Sea Act of 1936 ("US COGSA"), the terms of which are incorporated herein and shall be paramount throughout carriage by sea and the entire time that the goods are in the custody of the MTO or his sub-contractor at the sea terminal in the United States or being transported by non-ocean carriers under an MTD covering both water and inland through transportation to or from the United States.<br>
                        (2) The MTO shall not be liable in any capacity whatsoever for loss, damage or delay to the Goods, while the Goods are in the custody of the United States Army from the sea terminal and are not in actual custody of the MTO. All these times the MTO acts only as agent to procure carriage by persons (or modes) other than the MTO is deemed the rights to act as agent only at these times, his liability for loss, damage or delay shall be governed by US COGSA.<br>
                        (3) If US COGSA applies the liability of the MTO shall not exceed $500 per package or customary freight unit (in accordance with Section 1304(5) thereof).<br>
                        (4) If carriage includes carriage to, from or through the United States of America, the Consignor or Consignee may refer any claim or dispute to the United States District Court for the Southern District of New York in accordance with the laws of the United States of America.
                    </p>
                </div>
            </div>
    
            @else {{-- Additional containers --}}
            {{-- Additional Container Page - All containers in compact format --}}
            <div class="page-break"></div>
            <div class="page">
                @if($blType == 'DRAFT')
                    <div class="watermark draft-watermark">DRAFT</div>
                @elseif($blType == 'NON-NEGOTIABLE')
                    <div class="watermark draft-watermark">NON-NEGOTIABLE</div>
                @endif
                
                <div class="header-top">
                    <div style="flex:1"></div>
                    <h1 style="flex:2">ADDITIONAL CONTAINER DETAILS</h1>
                    <div class="copy-label" style="flex:1">{{ $currentBlTypeDisplay }}</div>
                </div>
                
                <div class="border-box" style="border: none;" style="padding: 10px;">
                    <div style="text-align: center; margin-bottom: 15px; font-size: 12px;">
                        <strong>Booking No:</strong> {{ safeData($seaImportDraftData, 'booking_no') }} | 
                        <strong>BL No:</strong> {{ $seaImportDraftData->mbl_no ?? $seaImportDraftData->hbl_no ?? 'N/A' }} |
                        <strong>Total Containers:</strong> {{ $containerCount }}
                    </div>
                    
                    {{-- Container Details in Compact Table --}}
                    <table style="width: 100%; border-collapse: collapse; font-size: 8.5px; margin-bottom: 20px;">
                        <thead>
                            <tr style="background-color: #f5f5f5;">
                                <th style="border: 1px solid #000; padding: 5px; text-align: center; width: 5%;">#</th>
                                <th style="border: 1px solid #000; padding: 5px; text-align: left; width: 20%;">Container Details</th>
                                <th style="border: 1px solid #000; padding: 5px; text-align: left; width: 25%;">Marks & Description</th>
                                <th style="border: 1px solid #000; padding: 5px; text-align: left; width: 25%;">Goods Information</th>
                                <th style="border: 1px solid #000; padding: 5px; text-align: center; width: 25%;">Weights & Measurement</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $additionalContainers = $seaImportDraftData->container->slice(1);
                                $counter = 2;
                            @endphp
                            
                            @foreach($additionalContainers as $cont)
                            <tr style="height: 75px;">
                                <td style="border: 1px solid #000; padding: 4px; text-align: center; vertical-align: top; font-weight: bold;" rowspan="2">
                                    {{ $counter++ }}
                                </td>
                                <td style="padding: 4px; vertical-align: top;">
                                    <strong>{{ safeData($cont, 'container_no') }}/{{ safeData($cont, 'size') }}</strong><br>
                                    <strong>Packages:</strong> {{ safeData($cont, 'total_package') }} {{ safeData($seaImportDraftData->packageName, 'package_code') }}<br>
                                    <strong>Type:</strong> {{ safeData($cont, 'fcl_lcl') }}<br>
                                    <strong>A.S.No:</strong> {{ safeData($cont, 'agent_seal_no', 'N/A') }}<br>
                                    <strong>C.S.No:</strong>{{ safeData($cont, 'cust_seal_no', 'N/A') }}
                                </td>
                                <td style="border: 1px solid #000; padding: 4px; vertical-align: top;" rowspan="2">
                                    <strong>Marks:</strong><br>
                                    {{ safeData($cont, 'mark_number') }}
                                </td>
                                <td style="padding: 4px; vertical-align: top;">
                                    <strong>Description:</strong> {{ Str::limit(safeData($cont, 'goods_description'), 60) }}
                                </td>
                                <td style="border-left: 1px solid #000;border-right: 1px solid #000; padding: 4px; vertical-align: top; text-align: center;">
                                    <strong>Gross Weight:</strong><br>
                                    {{ safeData($cont, 'gross_weight', '0') }} KGS
                                </td>
                            </tr>
                            <tr style="height: 50px;">
                                <td style="border-bottom: 1px solid #000; padding: 4px; vertical-align: top;">
                                    @if(safeData($cont, 'customer_inv_no'))
                                        <strong>Invoice No:</strong> {{ safeData($cont, 'customer_inv_no') }}<br>
                                    @endif
                                    @if(safeData($cont, 'sbill_no'))
                                        <strong>SB No:</strong> {{ safeData($cont, 'sbill_no') }}
                                    @endif
                                </td>   
                                <td style="border-bottom: 1px solid #000; padding: 4px; vertical-align: top;">
                                    @if(safeData($cont, 'hs_code'))
                                        <strong>HS Code:</strong> {{ safeData($cont, 'hs_code') }}
                                    @endif
                                </td>
                                <td style="border: 1px solid #000;border-top: none; padding: 4px; vertical-align: top; text-align: center;">
                                    <strong>Net Weight:</strong> {{ safeData($cont, 'net_weight', '0') }} KGS<br>
                                    <strong>Measurement:</strong> {{ safeData($cont, 'cbm', '0') }} CBM
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>
            </div>
        
            {{-- Terms and Conditions Page --}}
            <div class="page-break"></div>
            <div class="page terms-page">
            <div class="terms-heading">
                <div class="terms-main-title">
                    Standard Conditions governing Multimodal Transport Documents (MTD),
                    issued in accordance with Multimodal Transportation of Goods Act, 1993
                </div>
                <div class="terms-source">
                    [As Placed on www.dgshipping.com / Shipping Notices / MTO]
                </div>
            </div>

            <div class="terms-columns">
                <h5>1. Definitions</h5>
                <p>(a) "Carrier" means a person who is engaged in the business of transporting for hire goods by road, rail, inland waterways or sea.</p>
                <p>(b) "Consignee" means the person named as consignee in the multimodal transport contract.</p>
                <p>(c) "Consignment" means the goods entrusted to a MTO for multimodal transportation.</p>
                <p>(d) "Consignor" means the person, named in the Multimodal Transport Contract as consignor by whom or on whose behalf the multimodal transport contract are entrusted to a MTO for Multimodal transportation.</p>
                <p>(e) "Delivery" means -  
                    (1) in the case of a negotiable MTD, delivery of the consignment to, or placing the consignment at the disposal of, the consignee or any other person entitled to receive it;
                    (2) in the case of a non-negotiable MTD, delivery of the consignment to the consignee or any person authorized by the consignee to accept delivery of the consignment.</p>
                <p>(f) "Endorsement" means the signing by the consignee or the endorsee after adding a direction on a negotiable MTD to pass the property in the goods mentioned in such document to a specified person.</p>
                <p>(g) "Goods" include
                    (1) Containers, pallets or similar articles of transport used to consolidate goods; and
                    (2) Animals.</p>
                <p>(h) "Mode of transport" means carriage of goods by road, inland waterways or sea.</p>
                <p>(i) "Multimodal transportation" means carriage of goods by two or more modes of transport from the place of acceptance of the goods in India to a place of delivery of the goods outside India.</p>
                <p>(j) "Multimodal Transport Contract" means a contract entered into by the consignor and the MTO for multimodal transportation.</p>
                <p><b>(k) "Multimodal Transport Operator (MTO)"</b> means any person who:
                    (1) concludes a multimodal transport contract on his own behalf or through another person acting on his behalf;
                    (2) acts as a principal or as an agent either of the consignor or of the consignee; and
                    (3) assumes responsibility for the performance of the contract; and
                    (4) is registered under sub-section (3) of section 4 of the Act.</p>
                <p><b>(l) "Negotiable MTD"</b> means a multimodal transport document which is:
                    (1) made out to order or to bearer; or
                    (2) made out to order and is transferable by endorsement.</p>
                <p><b>(m) "Non-negotiable MTD"</b> means a MTD which indicates only one named consignee.</p>

                <h5>2. Acceptability</h5>
                <p>The provisions set out and referred to in this MTD shall apply if the transport as described on the face of the document is by two or more modes of transport from the place of acceptance of the goods in India to a place of delivery of the goods outside India.</p>

                <h5>3. Effect of issue of MTD</h5>
                <p>(1) The issuance of the MTD confers and imposes on all parties having or acquiring a right or interest in the rights/obligations and defences set out in the conditions mentioned in this document.<br>
                    (2) By issuance of the MTD the MTO:<br>
                    (a) undertakes to perform and/or in his own name to procure performance of the MTO including all services which are necessary to such performance from the time of taking the goods in charge to the time of delivery, and accepts responsibility for such transportation and such services to the extent set out in these conditions;
                    (b) accepts responsibility for the acts and omissions of his agents or servants, such acts and omissions within the scope of their employment, as if such acts and omissions were his own;
                    (c) accepts responsibility for the acts and omissions of any other person whose services he uses for the performance of the contract evidenced by this MTD;
                    (d) undertakes to perform or to procure performance of all acts necessary to delivery or to procure performance of all acts necessary to delivery;
                    (e) assumes liability to the extent set out in these conditions of loss or damage to the goods occurring between the time of taking the goods in charge and the time of delivery, and undertakes to pay compensation as set out in these conditions in respect of such loss or damage;
                    (f) assumes liability to the extent set out in these conditions for delay in delivery of the goods and undertakes to pay compensation as set out in that condition.</p>

                <h5>4. Negotiability and Title to the Goods</h5>
                <p>By accepting the Multimodal Transportation Document the consignor and his transferees agree with the MTO that, unless it is marked "Non-negotiable", it shall constitute title to the goods and the holder, by endorsement of this MTD, shall be entitled to receive or to transfer the goods mentioned in this MTD.</p>

                <h5>5. Reservations</h5>
                <p>If the MTD contains particulars concerning the general nature, leading marks, number of packages or pieces, weight or quantity of the goods which the MTO or a person acting on his behalf knows, or has reasonable grounds to suspect, do not accurately represent the goods actually taken in charge, or if he has no reasonable means of checking such particulars, the MTO or a person acting on his behalf shall insert in the MTD a reservation specifying these inaccuracies, grounds of suspicion or the absence of reasonable means of checking. If the MTO or a person acting on his behalf fails to note on the MTD the apparent condition of the goods, he is deemed to have noted on the MTD that the goods were in apparent good condition</p>

                <h5>6. Evidentiary effect of the MTD</h5>
                <p>(1) The MTD shall be prima facie evidence of the taking in charge by the MTO of the goods as described therein; and
                    (2) Proof to the contrary the MTD shall not be admissible if the MTD is issued in negotiable form and has been transferred to a third party, including a consignee, who has acted in good faith in reliance on the description of goods therein.</p>

                <h5>7. Guarantee by the consignor</h5>
                <p>(1) The consignor shall be deemed to have guaranteed to the MTO the accuracy at the time the goods were taken in charge by the MTO of particulars relating to the general nature of the goods, their marks, number, weight and quantity, and, if applicable, to the dangerous character of the goods as furnished by him for insertion in the MTD.
                (2) The consignor shall indemnify the MTO against loss resulting from inaccuracies or inadequacies of the particulars. The consignor shall remain liable even if the MTD has been transferred by him. The right of the MTO to such indemnity shall in no way limit his liability under the Multimodal Transport Contract to any person other than the consignor.</p>

                <h5>8. Dangerous goods</h5>
                <p>(1) The consignor shall mark or label dangerous goods in a suitable manner as "dangerous goods".<br>
                    (2) Where the consignor hands over dangerous goods to the MTO or any person acting on his behalf, the consignor shall inform him of the dangerous character of the goods and, if necessary, the precautions to be taken. If the consignor fails to do so and the MTO does not otherwise have knowledge of their dangerous character then:
                    <br>
                    (i) the consignor shall be liable to the MTO for all loss resulting from the shipment of such goods; and<br>
                    (ii) the goods may at any time be unloaded, destroyed or rendered innocuous, as the circumstances may require, without payment of compensation.
                </p>

                <h5>9. Period of responsibility</h5>
                <p>(1) The responsibility of the MTO for the goods covers the period from the time he takes the goods in his charge to the time of their delivery. For the purpose of this responsibility, the MTO is deemed to be in charge of the goods,<br>
                    (a) from the time he has taken over the goods from:
                        (i) the consignor or a person acting on his behalf;<br>
                        (ii) an authority or other third party to whom, pursuant to law or regulations applicable at the place of taking charge the goods must be handed over for transport;<br>
                    (b) until the time he has delivered the goods:
                        (i) by handing them over to the consignee; or
                        (ii) by placing them at the disposal of the consignee in accordance with the Multimodal Transport Contract; or
                        (iii) by handing them over to an authority or other third party to whom, pursuant to law or regulations applicable at the place of delivery, the goods must be handed over.<br>
                    (2) Reference to the MTO in this regard shall include his servants or agents or any other person of whose services he makes use for the performance of the Multimodal Transport Contract, and reference to the consignor or consignee shall include their servants or agents.
                </p>

                <h5>10. Basis of liability</h5>
                <p>
                    (1)The MTO shall be liable for loss resulting from loss of or damage to goods or delay in delivery and any consequential loss or damage caused by delay, except where the goods were in his charge unless the MTO proves that he, his servants or agents or other persons whose services he uses for the performance of the contract evidenced by this Multimodal Transport Document, took all measures that could reasonably be required to avoid the occurrence and its consequences.<br>
                    (2) Where loss of or damage to goods, or delay in delivery, is attributable to the fault or neglect, provided that the MTO proves that the loss, damage or delay in delivery not attributable thereto.<br>
                    (3) Delay in delivery occurs when the goods have not been delivered within the time expressly agreed upon in the absence of such agreement, within reasonable time required by a diligent MTO, having regard to the circumstances of the case to affect the delivery of goods.<br>
                    (4) If the goods have not been delivered within ninety consecutive days following the date of delivery when ninety days are agreed upon, the claimant may treat the goods as lost.
                </p>

                <h5>11. Liability for loss or damage when the stage of transport where the loss or damage occurred is not known</h5>
                <p>
                    (1) When the MTO is liable to pay compensation in respect of loss of or damage to the goods occurring between the time of taking them into his charge and the time of delivery and the stage of transport where the loss or damage occurred is not known:<br>
                        a. such compensation shall be calculated by reference to the value of such goods at the place and time they are delivered to the consignee or at the place and time when, in accordance with the contract of Multimodal Transport, they should have been so delivered.<br>
                        b. The value of the goods shall be determined according to the current commodity exchange price or, if there is no such price, according to the current market price or, if there is no commodity exchange price or current market price, by reference to the normal value of goods of the same kind and quality; however, the MTO shall not, in any case, be liable for an amount greater than that which is due in accordance with the applicable law.<br>
                    (2) Where a MTO becomes liable for any loss of, or damage to, any consignment, the nature and value thereof have not been declared by the consignor before such consignment has been taken in charge by the multimodal transport operator and the stage of transport at which such loss or damage occurred is not known, the special drawing rights per kilogram of the gross weight of the consignment lost or damaged shall not exceed two Special Drawing Rights per kilogram.<br>
                    (3) Notwithstanding anything contained above if the multimodal transportation does not, accordingly to the multimodal transport contract, include carriage of goods by sea or by inland waterways, the liability of the MTO shall be limited to an amount not exceeding 8.33 Special Drawing Rights per kilogram of the gross weight of the goods lost or damaged.
                </p>

                <h5>12. Liability for loss or damage when the stage of transport where the loss or damage occurred is known:-</h5>
                <p>
                    (1) When the MTO is liable to pay compensation in respect of loss of or damage to the goods occurring between the time of taking them into his charge and the time of delivery and the stage of transport where such loss or damage occurred is known, the liability of the MTO in respect of such loss or damage shall be determined by the provisions of law applicable to the mode of transport under which the loss or damage occurred.<br>
                    (2) Without prejudice to the provisions contained in para 3(2) and (c) mentioned in this document when, under the provisions of law applicable to the provisions contained in this document, the liability of the MTO shall be determined by the provisions of law applicable to the mode of transport under which the loss or damage occurred.
                </p>

                <h5>13. Defence and limits of the MTO and his servants</h5>
                <p>
                    (1) The defences and limits of liability provided for in this MTD shall apply in any action for loss resulting from loss of or damage to goods, delay in delivery and any consequential loss or damage arising from such delay.<br>
                    (2) If any action for loss of or damage is brought against the servant or agent of the MTO, if such servant or agent proves that he acted within the scope of his employment, or against any other person of whose services he makes use for the performance of the Multimodal Transport Contract, if such other person proves that he acted within the performance of the contract, the servant or agent or such other person shall be entitled to avail himself of the defences and limits of liability which the MTO is entitled to invoke under this MTD.<br>
                    (3) Except as provided for liability for delay, as mentioned below, the aggregate of the amounts recoverable from the MTO and from a servant or agent or any other person of whose services he makes use for the performance of the Multimodal Transport Contract shall not exceed the limits of liability provided for in this MTD.
                </p>

                <h5>14. Liability for delay</h5>
                <p>
                    The liability of the MTO for loss resulting from delay in delivery shall be limited to an amount equivalent to the freight payable for the goods delayed but not exceeding twice the freight payable under the Multimodal Transport Contract.
                </p>

                <h5>15. Loss of the right to limit liability</h5>
                <p>
                    (1) The limits of liability established in conditions 11, 12 and 14 above shall not apply if it is proved that the loss, damage or delay in delivery resulted from an act or omission of the MTO or his servants or agents or any other person of whose services he makes use for the performance of the Multimodal Transport Contract, done with the intent to cause such loss, damage or delay or recklessly and with knowledge that such loss, damage or delay would probably result.<br>
                    (2) Notwithstanding the provisions 13(2) above, if it is proved that the loss, damage or delay in delivery resulted from an act or omission of a servant or agent of whose services he makes use for the performance of the Multimodal Transport Contract, done with the intent to cause such loss, damage or delay or recklessly and with knowledge that such loss, damage or delay would probably result, the servant or agent shall not be entitled to the benefit of limitation of liability provided for in these conditions.
                </p>

                <h5>16. Delivery / non-delivery</h5>
                <p>
                    (1) If delivery / non-delivery of the consignee within a reasonable time after the MTO has called upon him to take delivery, the MTO shall be at liberty to put the goods in safe custody or behalf of the consignee at the consignee's risk and expense or to place the goods at the disposal of the consignee in accordance with the Multimodal Transport Contract or with the law, or with usage of the particular trade applicable at the place of delivery.<br>
                    (2)The MTD shall be discharged from his obligation to deliver the goods if, where a negotiable MTD has been issued in a set of more than one original, he, or a person acting on his behalf, has in good faith delivered the goods against surrender of one of such originals.
                </p>

                <h5>17. Notice of loss, damage or delay</h5>
                <p>
                    (1) Unless notice of loss or damage, specifying the general nature of such loss or damage is given in writing by the consignee to the MTO at the time of taking over the goods or within six consecutive days thereafter, the goods shall be presumed to have been delivered as described in the MTD.<br>
                    (2)Where the loss or damage is not apparent, the provisions of condition (1) referred to above apply correspondingly if notice in writing is not given within ten consecutive days after the day when the goods were handed over to the consignee.<br>
                    (3) If the state of the goods at the time they were handed over to the consignee has been subject to a joint survey and inspection by the parties or their representatives of the loss or damage on delivery, notice in writing need not be given of loss or damage ascertained during such survey or inspection.<br>
                    (4) In the case of any actual or apprehended loss or damage the MTO and the consignee shall give all reasonable facilities to each other for inspecting and tallying the goods.<br>
                    (5) If any of the notice periods provided for in condition (2) and (4) referred to above terminates on a public holiday at the place of delivery, such periods shall be extended up to the next working day.<br>
                    (6) Notice given to a person acting on behalf of the MTO including any person of whose services he makes use at the place of delivery, shall be deemed to have been given to the MTO.
                </p>

                <h5>18. Freight and charges</h5>
                <p>
                    (1) Freight shall be deemed earned on receipt of goods by MTO and shall be paid for, in any event.<br>
                    (2) For the purpose of verifying the freight basis, the MTO reserves the right to have the contents of the containers, trailers or similar articles of transport inspected in order to ascertain the weight, measurement, value or nature of the goods.<br>
                    (3) All dues, taxes and the charges levied on the goods and other expenses in connection therewith, shall be paid by the consignor at the consignee or the holder of MTD or the owner of the goods.<br>
                </p>

                <h5>19. Containers etc.</h5>
                <p>
                    (1) Goods may be stowed by the MTO by means of containers, trailers, transportable tanks, pallets and similar articles of transport used to consolidate goods and these articles of transport may be stowed under or on deck.<br>
                    (2) If a container has not been filled, packed or stowed by the MTO, the MTO shall not be liable for any loss of, or damage to, its contents and the consignor shall cover any loss of expense incurred by the MTO, if such loss, damage or expense has been caused by:<br>
                        (a) negligent packing or stowing of the container;<br>
                        (b) the contents being unsuitable for carriage in container; or<br>
                        (c) the unsuitability or defective condition of the container unless the container has been supplied by the MTO and the unsuitable or defective condition would not have been apparent upon reasonable inspection at, or prior to, the time when the container was filled, packed and stowed.<br>
                    (3) The provisions of this condition also apply with respect to trailers, transportable tanks, flats and pallets which have not been filled, packed or stowed by the Multimodal Transport Operator.<br>
                    (4) The MTO does not accept liability for the functioning of refrigerated containers supplied by the consignor.<br>
                    (5) If, by order of the authorities of any place, the goods have to be unpacked from their containers or be inspected, the MTO shall not be liable for the loss or damage incurred during the unpacking, inspection or re-packing. The MTO shall be entitled to recover the cost of unpacking, inspection and repacking from the consignor/consignee.
                </p>

                <h5>20. Hindrance etc. affecting performance</h5>
                <p>The MTO shall use reasonable endeavors to complete the transport and to deliver the goods at the place designated for delivery.</p>

                <h5>21. Lien</h5>
                <p>The MTO shall have a lien on the goods for any amount due under the Multimodal Contract and for the costs of recovering the same, and may enforce such lien in any reasonable manner.</p>

                <h5>22. Limitation of action</h5>
                <p>
                    Any action relating to Multimodal Transport under these conditions shall be time-barred if judicial proceedings have not been instituted within a period of nine months after:<br>
                    (1) the date of delivery of the goods, or<br>
                    (2) the date when the goods should have been delivered, or<br>
                    (3) the date on and from which the party entitled to receive has the right to treat the goods as lost.
                </p>

                <h5>23. Jurisdiction</h5>
                <p>
                    (1) In judicial proceedings relating to the contract for MTD under these conditions the plaintiff, at his option, may institute an action in a court which, according to the law of the country where the court is situated, is competent and within the jurisdiction of which is situated one of the following places:<br>
                        (a) the principal place of business, or the absence thereof, the habitual residence of the defendant; or<br>
                        (b) the place where the Multimodal Transport Contract was made, provided that the defendant has a place of business branch or agency at such place; or<br>
                        (c) the place of taking charge of the goods for Multimodal Transportation or the place of delivery thereof; or<br>
                        (d) any other place specified for that purpose in the Multimodal Transport Contract and evidenced in the MTD.
                </p>

                <h5>24. General Average</h5>
                <p>
                    The Consignor or consignee, the holder of the MTD, the receiver and the owner of the goods shall indemnify MTO in respect of any claim of general average nature which may be made on him and shall provide such security as may be required by the MTO in this connection.
                </p>

                <h5>25. Arbitration</h5>
                <p>
                    Suitable provisions may be incorporated, by the parties to the Multimodal Transport Contract.
                </p>

                <h5>26. "Carrier Clause"</h5>
                <p>
                    When the MTO is named on the face of the MTD and assumes liability for the performance under the MTD for transport or from the United States, the MTO assumes liability for such performance as a common carrier.
                </p>

                <h5>27. "USA Clause Paramount"</h5>
                <p>
                    (1) If carriage performed to, from or through a port in the United States of America, the MTD shall be subject to the United States Carriage of Goods by Sea Act of 1936 ("US COGSA"), the terms of which are incorporated herein and shall be paramount throughout carriage by sea and the entire time that the goods are in the custody of the MTO or his sub-contractor at the sea terminal in the United States or being transported by non-ocean carriers under an MTD covering both water and inland through transportation to or from the United States.<br>
                    (2) The MTO shall not be liable in any capacity whatsoever for loss, damage or delay to the Goods, while the Goods are in the custody of the United States Army from the sea terminal and are not in actual custody of the MTO. All these times the MTO acts only as agent to procure carriage by persons (or modes) other than the MTO is deemed the rights to act as agent only at these times, his liability for loss, damage or delay shall be governed by US COGSA.<br>
                    (3) If US COGSA applies the liability of the MTO shall not exceed $500 per package or customary freight unit (in accordance with Section 1304(5) thereof).<br>
                    (4) If carriage includes carriage to, from or through the United States of America, the Consignor or Consignee may refer any claim or dispute to the United States District Court for the Southern District of New York in accordance with the laws of the United States of America.
                </p>
            </div>
        </div>
        @endif
        @endforeach
    @else
        {{-- No Container Main Page --}}
        <div class="page">
            @if($blType == 'DRAFT')
                <div class="watermark draft-watermark">DRAFT</div>
            @elseif($blType == 'NON-NEGOTIABLE')
                <div class="watermark draft-watermark">NON-NEGOTIABLE</div>
            @endif
            
            <div class="header-top">
                <div style="flex:1"></div>
                <h1 style="flex:2">MULTIMODAL TRANSPORT DOCUMENT</h1>
                <div class="copy-label" style="flex:1">{{ $currentBlTypeDisplay }}</div>
            </div>

            <div class="border-box">
                {{-- Shipper and BL Info Row --}}
                <div class="row" style="height: 125px; border-bottom: none;">
                    {{-- Shipper Section --}}
                    <div class="col" style="width: 45%; border-bottom: 1px solid #000;">
                        <span class="label">Consignor / Shipper</span>
                        <div class="content-text">
                            {{ safeData($shipper, 'party_name') }}<br>
                            {{ safeData($shipper, 'address_line1') }}<br>
                            {{ safeData($shipper, 'address_line2') }}<br>
                            {{ safeData($shipper, 'city') }}<br>
                            @if(safeData($shipper, 'contact_person'))
                                <b>Contact Person: </b>{{ safeData($shipper, 'contact_person') }}<br>
                            @endif
                            @if(safeData($shipper, 'tel_no'))
                                <b>Contact No: </b>{{ safeData($shipper, 'tel_no') }}<br>
                            @endif
                            @if(safeData($shipper, 'pincode'))
                                <b>Pincode: </b>{{ safeData($shipper, 'pincode') }}<br>
                            @endif
                            @if(safeData($shipper, 'gstin'))
                                <b>GSTIN No: </b>{{ safeData($shipper, 'gstin') }}
                            @endif
                        </div>
                    </div>

                    {{-- BL Info Section --}}
                    <div class="col" style="width: 55%; padding: 0; display: flex; flex-direction: column;">
                        <div class="row" style="height: 20px;">
                            <div class="col" style="width: 50%; border-bottom: none; text-align: right; padding-right: 5px;">Booking No.</div>
                            <div class="col" style="width: 50%; border-bottom: none; font-weight: bold; text-align: center;">
                                {{ safeData($seaImportDraftData, 'booking_no') }}
                            </div>
                        </div>
                        <div class="row" style="height: 20px;">
                            <div class="col" style="width: 50%; text-align: right; padding-right: 5px;">BL Number</div>
                            <div class="col" style="width: 50%; font-weight: bold; text-align: center;">
                                {{ $seaImportDraftData->mbl_no ?? $seaImportDraftData->hbl_no ?? 'N/A' }}
                            </div>
                        </div>
                        
                        <div class="logo-section" style="flex-grow: 1;">
                            <img src="{{ $companyLogo }}" alt="Company Logo" class="company-logo" onerror="this.style.display='none'">
                        </div>
                    </div>
                </div>

                {{-- Consignee and Company Info Row --}}
                <div class="row" style="height: 125px; border-bottom: none;">
                    <div class="col" style="width: 45%;">
                        <span class="label">Consignee (if 'To Order' as indicated)</span>
                        <div class="content-text">
                            {{ safeData($consignee, 'party_name') }}<br>
                            {{ safeData($consignee, 'address_line1') }}<br>
                            {{ safeData($consignee, 'address_line2') }}<br>
                            {{ safeData($consignee, 'city') }}<br>
                            @if(safeData($consignee, 'contact_person'))
                                <b>Contact Person: </b>{{ safeData($consignee, 'contact_person') }}<br>
                            @endif
                            @if(safeData($consignee, 'tel_no'))
                                <b>Contact No: </b>{{ safeData($consignee, 'tel_no') }}<br>
                            @endif
                            @if(safeData($consignee, 'pincode'))
                                <b>Pincode: </b>{{ safeData($consignee, 'pincode') }}<br>
                            @endif
                            @if(safeData($consignee, 'gstin'))
                                <b>GSTIN No: </b>{{ safeData($consignee, 'gstin') }}
                            @endif
                        </div>
                    </div>

                    <div class="col" style="width: 55%; text-align: center; padding: 5px;">
                        <div style="font-weight: bold; font-size: 16px; margin-bottom: 5px;margin-top: 15px;">{{ $companyName }}</div>
                        <div class="small-text">
                            {{ $companyAddress }}<br>
                            @if(safeData($companySettings, 'phone'))
                                Tel: {{ safeData($companySettings, 'phone') }}
                            @endif
                            @if(safeData($companySettings, 'email'))
                                E-mail: {{ safeData($companySettings, 'email') }}
                            @endif
                            @if(safeData($company, 'website'))
                                Website: {{ safeData($company, 'website') }}
                            @endif
                        </div>
                        @if(safeData($companySettings, 'reg_no'))
                            <div style="font-weight: bold; margin: 5px 0; font-size: 12px;">MTO Reg. No. {{ safeData($companySettings, 'reg_no') }}</div>
                        @endif
                        <div class="small-text" style="text-align: justify; font-size: 7px; margin-top: 5px;">
                            Taken in charge in apparently good condition herein at the place of receipt for transport and delivery as mentioned above, unless otherwise stated. The MTO in accordance with the provisions contained in the MTD undertakes to perform or to procure the performance of the multimodal transport from the place at which the goods are taken in charge, to be place designated for delivery and assumes responsibility for such transport.
                            <br><br>
                            One of the MTD(s) must be surrendered, duly endorsed in exchange for the goods, in witness where of the original MTD all of this tenor and date have been signed in number indicated below one of which being accomplished the other(s) to be void
                        </div>
                    </div>
                </div>

                {{-- Notify Party Row --}}
                <div class="row" style="height: 125px; border-top: none;">
                    <div class="col" style="width: 45%; border-top: 1px solid #000;">
                        <span class="label">Notify address (No Claim shall attached for failure to notify)</span>
                        <div class="content-text">
                            {{ safeData($notify, 'party_name') }}<br>
                            {{ safeData($notify, 'address_line1') }}<br>
                            {{ safeData($notify, 'address_line2') }}<br>
                            {{ safeData($notify, 'city') }}<br>
                            @if(safeData($notify, 'contact_person'))
                                <b>Contact Person: </b>{{ safeData($notify, 'contact_person') }}<br>
                            @endif
                            @if(safeData($notify, 'tel_no'))
                                <b>Contact No: </b>{{ safeData($notify, 'tel_no') }}<br>
                            @endif
                            @if(safeData($notify, 'pincode'))
                                <b>Pincode: </b>{{ safeData($notify, 'pincode') }}<br>
                            @endif
                            @if(safeData($notify, 'gstin'))
                                <b>GSTIN No: </b>{{ safeData($notify, 'gstin') }}
                            @endif
                        </div>
                    </div>
                    <div class="col" style="width: 55%; border-top: 1px solid #000; border-left: none;border-top: none;"></div>
                </div>

                {{-- Port Information --}}
                <div class="row" style="height: 45px;">
                    <div class="col" style="width: 22.5%;">
                        <span class="label">Place Of Receipt</span>
                        <div class="content-text">{{ safeData($seaImportDraftData->receiptPortName, 'port_name', 'N/A') }}</div>
                    </div>
                    <div class="col" style="width: 22.5%;">
                        <span class="label">Port Of Loading</span>
                        <div class="content-text">{{ safeData($seaImportDraftData->loadingPortName, 'port_name', 'N/A') }}</div>
                    </div>
                    <div class="col" style="width: 55%; padding: 0;"></div>
                </div>

                <div class="row" style="height: 45px;">
                    <div class="col" style="width: 22.5%;">
                        <span class="label">Port Of Discharge</span>
                        <div class="content-text">{{ safeData($seaImportDraftData->dischargePortName, 'port_name', 'N/A') }}</div>
                    </div>
                    <div class="col" style="width: 22.5%;">
                        <span class="label">Final Place Of Delivery</span>
                        <div class="content-text">{{ safeData($seaImportDraftData->deliveryPortName, 'port_name', 'N/A') }}</div>
                    </div>
                    <div class="col" style="width: 55%; padding: 0;"></div>
                </div>

                {{-- Vessel and Transport Details --}}
                <div class="row" style="height: 45px;">
                    <div class="col" style="width: 45%;">
                        <span class="label">Vessel & Voyage No.</span>
                        <div class="content-text">
                            {{ safeData($seaImportDraftData, 'vessel_name', 'N/A') }} V. {{ safeData($seaImportDraftData, 'voyage_no', 'N/A') }}
                        </div>
                    </div>
                    <div class="col" style="width: 25%;">
                        <span class="label">Mode Means Of Transport</span>
                        <div class="content-text"></div>
                    </div>
                    <div class="col" style="width: 30%;">
                        <span class="label">Route/Place of Transhipment(if any)</span>
                        <div class="content-text">{{ safeData($seaImportDraftData, 'transhipment_port', 'N/A') }}</div>
                    </div>
                </div>

                {{-- Goods Table --}}
                <div class="row" style="flex-grow: 1; position: relative;">
                    <table class="goods-table">
                        <colgroup>
                            <col style="width: 25%;">
                            <col style="width: 45%;">
                            <col style="width: 15%;">
                            <col style="width: 15%;">
                        </colgroup>
                        <thead>
                            <tr>
                                <th>Marks and number</th>
                                <th>Number of packages, kinds of packages<br>general description of goods, said to contain</th>
                                <th>Gross Weight</th>
                                <th>Measurement</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="height: 300px; vertical-align: top;">
                                <td>
                                    <b>NO CONTAINER</b><br>
                                    <b>PACKAGES:</b> {{ $totalPackages }} {{ safeData($seaImportDraftData->packageName, 'package_code') }}<br>
                                    @if(safeData($seaImportDraftData, 'mark_number'))
                                        <b>Marks and Numbers:</b><br>
                                        {{ safeData($seaImportDraftData, 'mark_number') }}<br><br>
                                    @endif
                                    
                                    @if(safeData($seaImportDraftData, 'fcl_lcl'))
                                        {{ safeData($seaImportDraftData, 'fcl_lcl', '') }}/{{ safeData($seaImportDraftData, 'fcl_lcl', '') }}, {{ safeData($seaImportDraftData, 'movement', 'N/A') }}
                                    @endif
                                    <br>
                                    ALL DESTINATION CHARGES ON CONSIGNEE ACCOUNT
                                    <br><br><br><br><br><br>
                                    <div style="margin-bottom: 5px;"></div>
                                </td>
                                <td>
                                    <b>Total Packages:</b> {{ $totalPackages }} {{ safeData($seaImportDraftData->packageName, 'package_code') }} ONLY<br>
                                    <b>Goods Description:</b><br>
                                    {{ $goodsDescription }}<br>
                                    
                                    @if(safeData($seaImportDraftData, 'customer_inv_no'))
                                        <br><b>INVOICE NO:</b> {{ safeData($seaImportDraftData, 'customer_inv_no') }}
                                    @endif
                                    @if(safeData($seaImportDraftData, 'sbill_no'))
                                        <b>SB. NO:</b> {{ safeData($seaImportDraftData, 'sbill_no') }}<br>
                                    @endif
                                    <br><br><br><br><br>
                                    <div style="text-align: right; margin-top: 20px; font-weight: bold;">
                                        SHIPPED ONBOARD DATE: {{ safeData($container, 'sobDate') }}
                                        
                                        @php
                                            $blDescription = optional($seaImportDraftData->blType)->bl_description;
                                        @endphp
                                    
                                        @if(!empty($seaImportDraftData->hbl_type) && $blDescription === 'TELEX RELEASE')
                                            <br><br><br><br><br><br><br>
                                            <span style="
                                                    display: inline-block;
                                                    margin-top: 8px;
                                                    padding: 6px 18px;
                                                    border: 2px solid #000;
                                                    font-weight: bold;
                                                    text-align: center;
                                                    font-size: 15px;
                                                ">{{ $blDescription }}</span>
                                        @endif
                                    </div>
                                </td>
                                <td style="text-align: center;">
                                    {{ $grossWeight }}<br><b>KGS</b><br><br>
                                    <b>Net Weight</b><br>
                                    {{ $netWeight }}<br><b>KGS</b>
                                </td>
                                <td style="text-align: center;">
                                    {{ $cbm }}<br><b>CBM</b>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                    
                {{-- Footer Section --}}
                <div class="row" style="border-top: 1px solid #000; text-align: center; height: 25px;">
                    <div style="width: 100%; text-align: center; padding: 5px;">
                        <b>FREIGHT : </b>{{ strtoupper($freightDisplay) }}
                    </div>
                </div>
                
                {{-- Final Details and Signature --}}
                <div class="row" style="height: 137px;">
                    <div class="col" style="width: 40%; display: flex; flex-direction: column; justify-content: space-between;">
                        <div>
                            @if(safeData($seaImportDraftData->agentName, 'party_name'))
                                <span class="label">Booking Party: {{ safeData($seaImportDraftData->agentName, 'party_name') }}</span><br>
                            @endif
                            <span class="label">Delivery Agent</span>
                            <div class="content-text" style="margin-top: 5px;">
                                {{ safeData($deliveryAgent, 'party_name') }}<br>
                                {{ safeData($deliveryAgent, 'address_line1') }}<br>
                                {{ safeData($deliveryAgent, 'address_line2') }}<br>
                                {{ safeData($deliveryAgent, 'city') }}<br>
                                @if(safeData($deliveryAgent, 'tel_no'))
                                    <b>TEL:</b> {{ safeData($deliveryAgent, 'tel_no') }}
                                @endif
                            </div>
                        </div>
                        <div style="border-top: 1px solid #000; font-size: 8px; padding-top: 2px;">
                            Other Particulars (if any)<br>
                            Weight and Measurement of cargo as declared by shipper
                        </div>
                    </div>

                    <div class="col" style="width: 60%; padding: 0; display: flex; flex-direction: column;">
                        <div class="row" style="flex-grow: 1; height: 70%; border-bottom: none;">
                            <div class="col" style="width: 30%;">
                                <span class="label">Freight Amount</span>
                                <div style="margin-top: 40px; font-size: 9px;">
                                    Freight Payable At<br>
                                    <b>{{ $freightPayable ?: 'N/A' }}</b>
                                </div>
                            </div>
                            <div class="col" style="width: 20%;">
                                <span class="label">No. of Original MTD(s)</span>
                                <div style="text-align: center; margin-top: 5px; font-weight: bold;">
                                    @if(in_array($blType, ['ORIGINAL', '1st ORIGINAL', '2nd ORIGINAL', '3rd ORIGINAL']))
                                        3
                                    @else
                                        0
                                    @endif
                                </div>
                            </div>
                            <div class="col" style="width: 50%;">
                                <span class="label">Place and Date of Issue</span>
                                <div style="text-align: center; font-weight: bold; margin-top: 5px; font-size: 12px;">
                                    {{ safeData($seaImportDraftData, 'issue_place', '') }} &nbsp;&nbsp;&nbsp; {{ $formattedIssueDate }}
                                </div>
                            </div>
                        </div>
                        <div class="row" style="height: 60px; border-top: 1px solid #000;">
                            <div style="width: 100%; padding: 3px; position: relative;">
                                <div style="font-weight: bold; text-align: right; font-size: 9px; margin-bottom: 20px;">
                                    FOR {{ $companyName }}
                                    <br><br><br><br>
                                    <span style="font-size: 8px;">(Authorised Signatory)</span>
                                </div>
                                @if(safeData($companySettings, 'cin_no'))
                                    <div style="position: absolute; bottom: -12px; right: 5px; font-size: 10px;">
                                        CIN: {{ safeData($companySettings, 'cin_no') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Terms and Conditions Page for No Container --}}
        <div class="page-break"></div>
        <div class="page terms-page">
            <div class="terms-heading">
                <div class="terms-main-title">
                    Standard Conditions governing Multimodal Transport Documents (MTD),
                    issued in accordance with Multimodal Transportation of Goods Act, 1993
                </div>
                <div class="terms-source">
                    [As Placed on www.dgshipping.com / Shipping Notices / MTO]
                </div>
            </div>

            <div class="terms-columns">
                <h5>1. Definitions</h5>
                <p>(a) "Carrier" means a person who is engaged in the business of transporting for hire goods by road, rail, inland waterways or sea.</p>
                <p>(b) "Consignee" means the person named as consignee in the multimodal transport contract.</p>
                <p>(c) "Consignment" means the goods entrusted to a MTO for multimodal transportation.</p>
                <p>(d) "Consignor" means the person, named in the Multimodal Transport Contract as consignor by whom or on whose behalf the multimodal transport contract are entrusted to a MTO for Multimodal transportation.</p>
                <p>(e) "Delivery" means -  
                    (1) in the case of a negotiable MTD, delivery of the consignment to, or placing the consignment at the disposal of, the consignee or any other person entitled to receive it;
                    (2) in the case of a non-negotiable MTD, delivery of the consignment to the consignee or any person authorized by the consignee to accept delivery of the consignment.</p>
                <p>(f) "Endorsement" means the signing by the consignee or the endorsee after adding a direction on a negotiable MTD to pass the property in the goods mentioned in such document to a specified person.</p>
                <p>(g) "Goods" include
                    (1) Containers, pallets or similar articles of transport used to consolidate goods; and
                    (2) Animals.</p>
                <p>(h) "Mode of transport" means carriage of goods by road, inland waterways or sea.</p>
                <p>(i) "Multimodal transportation" means carriage of goods by two or more modes of transport from the place of acceptance of the goods in India to a place of delivery of the goods outside India.</p>
                <p>(j) "Multimodal Transport Contract" means a contract entered into by the consignor and the MTO for multimodal transportation.</p>
                <p><b>(k) "Multimodal Transport Operator (MTO)"</b> means any person who:
                    (1) concludes a multimodal transport contract on his own behalf or through another person acting on his behalf;
                    (2) acts as a principal or as an agent either of the consignor or of the consignee; and
                    (3) assumes responsibility for the performance of the contract; and
                    (4) is registered under sub-section (3) of section 4 of the Act.</p>
                <p><b>(l) "Negotiable MTD"</b> means a multimodal transport document which is:
                    (1) made out to order or to bearer; or
                    (2) made out to order and is transferable by endorsement.</p>
                <p><b>(m) "Non-negotiable MTD"</b> means a MTD which indicates only one named consignee.</p>

                <h5>2. Acceptability</h5>
                <p>The provisions set out and referred to in this MTD shall apply if the transport as described on the face of the document is by two or more modes of transport from the place of acceptance of the goods in India to a place of delivery of the goods outside India.</p>

                <h5>3. Effect of issue of MTD</h5>
                <p>(1) The issuance of the MTD confers and imposes on all parties having or acquiring a right or interest in the rights/obligations and defences set out in the conditions mentioned in this document.<br>
                    (2) By issuance of the MTD the MTO:<br>
                    (a) undertakes to perform and/or in his own name to procure performance of the MTO including all services which are necessary to such performance from the time of taking the goods in charge to the time of delivery, and accepts responsibility for such transportation and such services to the extent set out in these conditions;
                    (b) accepts responsibility for the acts and omissions of his agents or servants, such acts and omissions within the scope of their employment, as if such acts and omissions were his own;
                    (c) accepts responsibility for the acts and omissions of any other person whose services he uses for the performance of the contract evidenced by this MTD;
                    (d) undertakes to perform or to procure performance of all acts necessary to delivery or to procure performance of all acts necessary to delivery;
                    (e) assumes liability to the extent set out in these conditions of loss or damage to the goods occurring between the time of taking the goods in charge and the time of delivery, and undertakes to pay compensation as set out in these conditions in respect of such loss or damage;
                    (f) assumes liability to the extent set out in these conditions for delay in delivery of the goods and undertakes to pay compensation as set out in that condition.</p>

                <h5>4. Negotiability and Title to the Goods</h5>
                <p>By accepting the Multimodal Transportation Document the consignor and his transferees agree with the MTO that, unless it is marked "Non-negotiable", it shall constitute title to the goods and the holder, by endorsement of this MTD, shall be entitled to receive or to transfer the goods mentioned in this MTD.</p>

                <h5>5. Reservations</h5>
                <p>If the MTD contains particulars concerning the general nature, leading marks, number of packages or pieces, weight or quantity of the goods which the MTO or a person acting on his behalf knows, or has reasonable grounds to suspect, do not accurately represent the goods actually taken in charge, or if he has no reasonable means of checking such particulars, the MTO or a person acting on his behalf shall insert in the MTD a reservation specifying these inaccuracies, grounds of suspicion or the absence of reasonable means of checking. If the MTO or a person acting on his behalf fails to note on the MTD the apparent condition of the goods, he is deemed to have noted on the MTD that the goods were in apparent good condition</p>

                <h5>6. Evidentiary effect of the MTD</h5>
                <p>(1) The MTD shall be prima facie evidence of the taking in charge by the MTO of the goods as described therein; and
                    (2) Proof to the contrary the MTD shall not be admissible if the MTD is issued in negotiable form and has been transferred to a third party, including a consignee, who has acted in good faith in reliance on the description of goods therein.</p>

                <h5>7. Guarantee by the consignor</h5>
                <p>(1) The consignor shall be deemed to have guaranteed to the MTO the accuracy at the time the goods were taken in charge by the MTO of particulars relating to the general nature of the goods, their marks, number, weight and quantity, and, if applicable, to the dangerous character of the goods as furnished by him for insertion in the MTD.
                (2) The consignor shall indemnify the MTO against loss resulting from inaccuracies or inadequacies of the particulars. The consignor shall remain liable even if the MTD has been transferred by him. The right of the MTO to such indemnity shall in no way limit his liability under the Multimodal Transport Contract to any person other than the consignor.</p>

                <h5>8. Dangerous goods</h5>
                <p>(1) The consignor shall mark or label dangerous goods in a suitable manner as "dangerous goods".<br>
                    (2) Where the consignor hands over dangerous goods to the MTO or any person acting on his behalf, the consignor shall inform him of the dangerous character of the goods and, if necessary, the precautions to be taken. If the consignor fails to do so and the MTO does not otherwise have knowledge of their dangerous character then:
                    <br>
                    (i) the consignor shall be liable to the MTO for all loss resulting from the shipment of such goods; and<br>
                    (ii) the goods may at any time be unloaded, destroyed or rendered innocuous, as the circumstances may require, without payment of compensation.
                </p>

                <h5>9. Period of responsibility</h5>
                <p>(1) The responsibility of the MTO for the goods covers the period from the time he takes the goods in his charge to the time of their delivery. For the purpose of this responsibility, the MTO is deemed to be in charge of the goods,<br>
                    (a) from the time he has taken over the goods from:
                        (i) the consignor or a person acting on his behalf;<br>
                        (ii) an authority or other third party to whom, pursuant to law or regulations applicable at the place of taking charge the goods must be handed over for transport;<br>
                    (b) until the time he has delivered the goods:
                        (i) by handing them over to the consignee; or
                        (ii) by placing them at the disposal of the consignee in accordance with the Multimodal Transport Contract; or
                        (iii) by handing them over to an authority or other third party to whom, pursuant to law or regulations applicable at the place of delivery, the goods must be handed over.<br>
                    (2) Reference to the MTO in this regard shall include his servants or agents or any other person of whose services he makes use for the performance of the Multimodal Transport Contract, and reference to the consignor or consignee shall include their servants or agents.
                </p>

                <h5>10. Basis of liability</h5>
                <p>
                    (1)The MTO shall be liable for loss resulting from loss of or damage to goods or delay in delivery and any consequential loss or damage caused by delay, except where the goods were in his charge unless the MTO proves that he, his servants or agents or other persons whose services he uses for the performance of the contract evidenced by this Multimodal Transport Document, took all measures that could reasonably be required to avoid the occurrence and its consequences.<br>
                    (2) Where loss of or damage to goods, or delay in delivery, is attributable to the fault or neglect, provided that the MTO proves that the loss, damage or delay in delivery not attributable thereto.<br>
                    (3) Delay in delivery occurs when the goods have not been delivered within the time expressly agreed upon in the absence of such agreement, within reasonable time required by a diligent MTO, having regard to the circumstances of the case to affect the delivery of goods.<br>
                    (4) If the goods have not been delivered within ninety consecutive days following the date of delivery when ninety days are agreed upon, the claimant may treat the goods as lost.
                </p>

                <h5>11. Liability for loss or damage when the stage of transport where the loss or damage occurred is not known</h5>
                <p>
                    (1) When the MTO is liable to pay compensation in respect of loss of or damage to the goods occurring between the time of taking them into his charge and the time of delivery and the stage of transport where the loss or damage occurred is not known:<br>
                        a. such compensation shall be calculated by reference to the value of such goods at the place and time they are delivered to the consignee or at the place and time when, in accordance with the contract of Multimodal Transport, they should have been so delivered.<br>
                        b. The value of the goods shall be determined according to the current commodity exchange price or, if there is no such price, according to the current market price or, if there is no commodity exchange price or current market price, by reference to the normal value of goods of the same kind and quality; however, the MTO shall not, in any case, be liable for an amount greater than that which is due in accordance with the applicable law.<br>
                    (2) Where a MTO becomes liable for any loss of, or damage to, any consignment, the nature and value thereof have not been declared by the consignor before such consignment has been taken in charge by the multimodal transport operator and the stage of transport at which such loss or damage occurred is not known, the special drawing rights per kilogram of the gross weight of the consignment lost or damaged shall not exceed two Special Drawing Rights per kilogram.<br>
                    (3) Notwithstanding anything contained above if the multimodal transportation does not, accordingly to the multimodal transport contract, include carriage of goods by sea or by inland waterways, the liability of the MTO shall be limited to an amount not exceeding 8.33 Special Drawing Rights per kilogram of the gross weight of the goods lost or damaged.
                </p>

                <h5>12. Liability for loss or damage when the stage of transport where the loss or damage occurred is known:-</h5>
                <p>
                    (1) When the MTO is liable to pay compensation in respect of loss of or damage to the goods occurring between the time of taking them into his charge and the time of delivery and the stage of transport where such loss or damage occurred is known, the liability of the MTO in respect of such loss or damage shall be determined by the provisions of law applicable to the mode of transport under which the loss or damage occurred.<br>
                    (2) Without prejudice to the provisions contained in para 3(2) and (c) mentioned in this document when, under the provisions of law applicable to the provisions contained in this document, the liability of the MTO shall be determined by the provisions of law applicable to the mode of transport under which the loss or damage occurred.
                </p>

                <h5>13. Defence and limits of the MTO and his servants</h5>
                <p>
                    (1) The defences and limits of liability provided for in this MTD shall apply in any action for loss resulting from loss of or damage to goods, delay in delivery and any consequential loss or damage arising from such delay.<br>
                    (2) If any action for loss of or damage is brought against the servant or agent of the MTO, if such servant or agent proves that he acted within the scope of his employment, or against any other person of whose services he makes use for the performance of the Multimodal Transport Contract, if such other person proves that he acted within the performance of the contract, the servant or agent or such other person shall be entitled to avail himself of the defences and limits of liability which the MTO is entitled to invoke under this MTD.<br>
                    (3) Except as provided for liability for delay, as mentioned below, the aggregate of the amounts recoverable from the MTO and from a servant or agent or any other person of whose services he makes use for the performance of the Multimodal Transport Contract shall not exceed the limits of liability provided for in this MTD.
                </p>

                <h5>14. Liability for delay</h5>
                <p>
                    The liability of the MTO for loss resulting from delay in delivery shall be limited to an amount equivalent to the freight payable for the goods delayed but not exceeding twice the freight payable under the Multimodal Transport Contract.
                </p>

                <h5>15. Loss of the right to limit liability</h5>
                <p>
                    (1) The limits of liability established in conditions 11, 12 and 14 above shall not apply if it is proved that the loss, damage or delay in delivery resulted from an act or omission of the MTO or his servants or agents or any other person of whose services he makes use for the performance of the Multimodal Transport Contract, done with the intent to cause such loss, damage or delay or recklessly and with knowledge that such loss, damage or delay would probably result.<br>
                    (2) Notwithstanding the provisions 13(2) above, if it is proved that the loss, damage or delay in delivery resulted from an act or omission of a servant or agent of whose services he makes use for the performance of the Multimodal Transport Contract, done with the intent to cause such loss, damage or delay or recklessly and with knowledge that such loss, damage or delay would probably result, the servant or agent shall not be entitled to the benefit of limitation of liability provided for in these conditions.
                </p>

                <h5>16. Delivery / non-delivery</h5>
                <p>
                    (1) If delivery / non-delivery of the consignee within a reasonable time after the MTO has called upon him to take delivery, the MTO shall be at liberty to put the goods in safe custody or behalf of the consignee at the consignee's risk and expense or to place the goods at the disposal of the consignee in accordance with the Multimodal Transport Contract or with the law, or with usage of the particular trade applicable at the place of delivery.<br>
                    (2)The MTD shall be discharged from his obligation to deliver the goods if, where a negotiable MTD has been issued in a set of more than one original, he, or a person acting on his behalf, has in good faith delivered the goods against surrender of one of such originals.
                </p>

                <h5>17. Notice of loss, damage or delay</h5>
                <p>
                    (1) Unless notice of loss or damage, specifying the general nature of such loss or damage is given in writing by the consignee to the MTO at the time of taking over the goods or within six consecutive days thereafter, the goods shall be presumed to have been delivered as described in the MTD.<br>
                    (2)Where the loss or damage is not apparent, the provisions of condition (1) referred to above apply correspondingly if notice in writing is not given within ten consecutive days after the day when the goods were handed over to the consignee.<br>
                    (3) If the state of the goods at the time they were handed over to the consignee has been subject to a joint survey and inspection by the parties or their representatives of the loss or damage on delivery, notice in writing need not be given of loss or damage ascertained during such survey or inspection.<br>
                    (4) In the case of any actual or apprehended loss or damage the MTO and the consignee shall give all reasonable facilities to each other for inspecting and tallying the goods.<br>
                    (5) If any of the notice periods provided for in condition (2) and (4) referred to above terminates on a public holiday at the place of delivery, such periods shall be extended up to the next working day.<br>
                    (6) Notice given to a person acting on behalf of the MTO including any person of whose services he makes use at the place of delivery, shall be deemed to have been given to the MTO.
                </p>

                <h5>18. Freight and charges</h5>
                <p>
                    (1) Freight shall be deemed earned on receipt of goods by MTO and shall be paid for, in any event.<br>
                    (2) For the purpose of verifying the freight basis, the MTO reserves the right to have the contents of the containers, trailers or similar articles of transport inspected in order to ascertain the weight, measurement, value or nature of the goods.<br>
                    (3) All dues, taxes and the charges levied on the goods and other expenses in connection therewith, shall be paid by the consignor at the consignee or the holder of MTD or the owner of the goods.<br>
                </p>

                <h5>19. Containers etc.</h5>
                <p>
                    (1) Goods may be stowed by the MTO by means of containers, trailers, transportable tanks, pallets and similar articles of transport used to consolidate goods and these articles of transport may be stowed under or on deck.<br>
                    (2) If a container has not been filled, packed or stowed by the MTO, the MTO shall not be liable for any loss of, or damage to, its contents and the consignor shall cover any loss of expense incurred by the MTO, if such loss, damage or expense has been caused by:<br>
                        (a) negligent packing or stowing of the container;<br>
                        (b) the contents being unsuitable for carriage in container; or<br>
                        (c) the unsuitability or defective condition of the container unless the container has been supplied by the MTO and the unsuitable or defective condition would not have been apparent upon reasonable inspection at, or prior to, the time when the container was filled, packed and stowed.<br>
                    (3) The provisions of this condition also apply with respect to trailers, transportable tanks, flats and pallets which have not been filled, packed or stowed by the Multimodal Transport Operator.<br>
                    (4) The MTO does not accept liability for the functioning of refrigerated containers supplied by the consignor.<br>
                    (5) If, by order of the authorities of any place, the goods have to be unpacked from their containers or be inspected, the MTO shall not be liable for the loss or damage incurred during the unpacking, inspection or re-packing. The MTO shall be entitled to recover the cost of unpacking, inspection and repacking from the consignor/consignee.
                </p>

                <h5>20. Hindrance etc. affecting performance</h5>
                <p>The MTO shall use reasonable endeavors to complete the transport and to deliver the goods at the place designated for delivery.</p>

                <h5>21. Lien</h5>
                <p>The MTO shall have a lien on the goods for any amount due under the Multimodal Contract and for the costs of recovering the same, and may enforce such lien in any reasonable manner.</p>

                <h5>22. Limitation of action</h5>
                <p>
                    Any action relating to Multimodal Transport under these conditions shall be time-barred if judicial proceedings have not been instituted within a period of nine months after:<br>
                    (1) the date of delivery of the goods, or<br>
                    (2) the date when the goods should have been delivered, or<br>
                    (3) the date on and from which the party entitled to receive has the right to treat the goods as lost.
                </p>

                <h5>23. Jurisdiction</h5>
                <p>
                    (1) In judicial proceedings relating to the contract for MTD under these conditions the plaintiff, at his option, may institute an action in a court which, according to the law of the country where the court is situated, is competent and within the jurisdiction of which is situated one of the following places:<br>
                        (a) the principal place of business, or the absence thereof, the habitual residence of the defendant; or<br>
                        (b) the place where the Multimodal Transport Contract was made, provided that the defendant has a place of business branch or agency at such place; or<br>
                        (c) the place of taking charge of the goods for Multimodal Transportation or the place of delivery thereof; or<br>
                        (d) any other place specified for that purpose in the Multimodal Transport Contract and evidenced in the MTD.
                </p>

                <h5>24. General Average</h5>
                <p>
                    The Consignor or consignee, the holder of the MTD, the receiver and the owner of the goods shall indemnify MTO in respect of any claim of general average nature which may be made on him and shall provide such security as may be required by the MTO in this connection.
                </p>

                <h5>25. Arbitration</h5>
                <p>
                    Suitable provisions may be incorporated, by the parties to the Multimodal Transport Contract.
                </p>

                <h5>26. "Carrier Clause"</h5>
                <p>
                    When the MTO is named on the face of the MTD and assumes liability for the performance under the MTD for transport or from the United States, the MTO assumes liability for such performance as a common carrier.
                </p>

                <h5>27. "USA Clause Paramount"</h5>
                <p>
                    (1) If carriage performed to, from or through a port in the United States of America, the MTD shall be subject to the United States Carriage of Goods by Sea Act of 1936 ("US COGSA"), the terms of which are incorporated herein and shall be paramount throughout carriage by sea and the entire time that the goods are in the custody of the MTO or his sub-contractor at the sea terminal in the United States or being transported by non-ocean carriers under an MTD covering both water and inland through transportation to or from the United States.<br>
                    (2) The MTO shall not be liable in any capacity whatsoever for loss, damage or delay to the Goods, while the Goods are in the custody of the United States Army from the sea terminal and are not in actual custody of the MTO. All these times the MTO acts only as agent to procure carriage by persons (or modes) other than the MTO is deemed the rights to act as agent only at these times, his liability for loss, damage or delay shall be governed by US COGSA.<br>
                    (3) If US COGSA applies the liability of the MTO shall not exceed $500 per package or customary freight unit (in accordance with Section 1304(5) thereof).<br>
                    (4) If carriage includes carriage to, from or through the United States of America, the Consignor or Consignee may refer any claim or dispute to the United States District Court for the Southern District of New York in accordance with the laws of the United States of America.
                </p>
            </div>
        </div>
    @endif

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        async function downloadPDF() {

            const btn = document.getElementById("downloadPdfBtn");
        
            btn.innerHTML = "Downloading PDF...";
            btn.disabled = true;
        
            try {
        
                const element = document.body;
        
                const opt = {
                    margin: 0,
                    filename: 'Sea_Way_Bill_{{ $seaImportDraftData->booking_no ?? "document" }}.pdf',
                    image: {
                        type: 'jpeg',
                        quality: 3
                    },
                    html2canvas: {
                        scale: 8,
                        useCORS: true,
                        scrollY: 0,
                        backgroundColor: '#ffffff'
                    },
                    jsPDF: {
                        unit: 'mm',
                        format: 'a4',
                        orientation: 'portrait'
                    }
                };
        
                await $.ajax({
                    url: "{{ route('sea.import.check.download') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        job_no: "{{ $seaImportDraftData->job_no }}",
                        copy_type: "{{ $blType }}"
                    }
                });
        
                await html2pdf().set(opt).from(element).save();
        
                await $.ajax({
                    url: "{{ route('sea.import.confirm.download') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        job_no: "{{ $seaImportDraftData->job_no }}",
                        copy_type: "{{ $blType }}"
                    }
                });
        
            } catch (error) {
                console.error(error);
                Swal.fire({
                    icon: 'warning',
                    title: 'Download Blocked',
                    text: error.responseJSON?.message ?? 'Unable to download PDF.',
                    confirmButtonText: 'OK'
                });
            
            } finally {
        
                btn.innerHTML = "📥 Download PDF";
                btn.disabled = false;
        
            }
        }
    
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>