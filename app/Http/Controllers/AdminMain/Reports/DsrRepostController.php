<?php

namespace App\Http\Controllers\AdminMain\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Dompdf\Dompdf;
use App\Models\MasterImportParty;
use App\Models\MasterExportParty;

use App\Exports\DsrExport;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SalesOutstandingExport;
use App\Models\Accounts\AccountSaleInvoice;

use App\Models\Operations\OperationAirImport;
use App\Models\Operations\OperationAirExport;
use App\Models\Operations\OperationSeaImport;
use App\Models\Operations\OperationSeaExport;
use App\Models\Operations\OperationTransport;
use App\Models\Operations\OperationSeaExportCont;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use App\Models\CompanyBranch;

class DsrRepostController extends Controller
{
    public $company_id ;

    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->company_id = Auth::user()->company_id;
            return $next($request);
        });
    }

    public function index()
    {
        $page_title = "DSR";
        $shipper_parties = MasterExportParty::where('company_id', $this->company_id)->where('status', 1)->get();
        $consignee_parties = MasterImportParty::where('company_id', $this->company_id)->where('status', 1)->where('party_type', 1)->get();
        $branches = CompanyBranch::where('company_id', $this->company_id)
            ->where('status',1)
            ->orderBy('branch_name')
            ->get();

        return view('admin-main.admin.dsrReport.first', compact('page_title','shipper_parties', 'consignee_parties', 'branches'));
    }

    public function preview(Request $request)
    {
        $activity_type = $request->activity_type;
        $from_date     = $request->from_date;
        $to_date       = $request->to_date;
        $shipper_id    = $request->shipper;
        $consignee_id    = $request->consignee;
        $party_type    = 'all';

        $company_id = $this->company_id;
        $branch_id = $request->branch_id;
        $perPage = 25;
        $page = $request->get('page', 1);

        $data = collect(); // unified collection

        // Helper date filter
        $dateFilter = fn($q) => $q->whereBetween('created_at', [
            Carbon::parse($from_date)->startOfDay(),
            Carbon::parse($to_date)->endOfDay()
        ]);

        // CASE 1: Single Activity (works same as before)
        if (in_array($activity_type, ['AI', 'AE', 'SI', 'SE'])) {

            switch ($activity_type) {
                case 'AI':
                    $query = OperationAirImport::where('company_id', $company_id);
                    if($branch_id != 'all'){
                        $query->where('branch_id',$branch_id);
                    }
                    break;
                case 'AE':
                    $query = OperationAirExport::where('company_id', $company_id);
                    if($branch_id != 'all'){
                        $query->where('branch_id',$branch_id);
                    }
                    break;
                case 'SI':
                    $query = OperationSeaImport::with(['container', 'jobMaster'])->where('company_id', $company_id);
                    if($branch_id != 'all'){
                        $query->where('branch_id',$branch_id);
                    }
                    break;
                case 'SE':
                    $query = OperationSeaExport::with(['container.shipmentLines.consignee', 'jobMaster'])
                        ->where('company_id', $company_id);
                        if($branch_id != 'all'){
                        $query->where('branch_id',$branch_id);
                    }
                    break;
            }

            $query->whereBetween('created_at', [
                Carbon::parse($from_date)->startOfDay(),
                Carbon::parse($to_date)->endOfDay()
            ]);

            if ($shipper_id) {
                $query->where('shipper_id', $shipper_id);
                $party_type = 'shipper';
            } elseif ($consignee_id) {
                $query->where('consignee_id', $consignee_id);
                $party_type = 'consignee';
            }

            $all_data = $query->paginate($perPage);
        }
        else {

            $company_id = $this->company_id;
            $page = $request->get('page', 1);
            $perPage = 25;

            // Define date filter callback for each table (since fields differ)
            $airImport = OperationAirImport::with('jobMaster')->
                where('company_id', $company_id)
                ->when($branch_id != 'all', function($q) use ($branch_id){
                    $q->where('branch_id',$branch_id);
                })
                ->when($from_date && $to_date, function ($q) use ($from_date, $to_date) {
                    $q->whereBetween('created_at', [
                        Carbon::parse($from_date)->startOfDay(),
                        Carbon::parse($to_date)->endOfDay()
                    ]);
                })
                ->get();

            $airExport = OperationAirExport::with('jobMaster')->
                where('company_id', $company_id)
                ->when($branch_id != 'all', function($q) use ($branch_id){
                    $q->where('branch_id',$branch_id);
                })
                ->when($from_date && $to_date, function ($q) use ($from_date, $to_date) {
                    $q->whereBetween('created_at', [
                        Carbon::parse($from_date)->startOfDay(),
                        Carbon::parse($to_date)->endOfDay()
                    ]);
                })
                ->get();

            $seaImport = OperationSeaImport::with('jobMaster')->
                where('company_id', $company_id)
                ->when($branch_id != 'all', function($q) use ($branch_id){
                    $q->where('branch_id',$branch_id);
                })
                ->when($from_date && $to_date, function ($q) use ($from_date, $to_date) {
                    $q->whereBetween('created_at', [
                        Carbon::parse($from_date)->startOfDay(),
                        Carbon::parse($to_date)->endOfDay()
                    ]);
                })
                ->get();

            $seaExport = OperationSeaExport::with(['container.shipmentLines', 'jobMaster'])
                ->where('company_id', $company_id)
                ->when($branch_id != 'all', function($q) use ($branch_id){
                    $q->where('branch_id',$branch_id);
                })
                ->when($from_date && $to_date, function ($q) use ($from_date, $to_date) {
                    $q->whereBetween('created_at', [
                        Carbon::parse($from_date)->startOfDay(),
                        Carbon::parse($to_date)->endOfDay()
                    ]);
                })
                ->get();

            // $merged = $airImport->merge($airExport)->merge($seaImport)->merge($seaExport);
            $merged = $airImport
            ->concat($airExport)
            ->concat($seaImport)
            ->concat($seaExport)
            ->values();

            //Sort by created_at descending
            $merged = $merged->sortByDesc('created_at');

            // âœ… Manual pagination
            $items = $merged->forPage($page, $perPage);
            $all_data = new \Illuminate\Pagination\LengthAwarePaginator(
                $items,
                $merged->count(),
                $perPage,
                $page,
                ['path' => \Illuminate\Pagination\Paginator::resolveCurrentPath()]
            );
        }

        // HTML TABLE RENDERING
        $html = '
        <h4 style="text-align:center; font-weight:bold;">DSR REPORT : FROM :- ' . $from_date . ' TO :- ' . $to_date . '</h4>
        <div class="table-responsive" style="max-height:800px; overflow-y:scroll; width:100%;">
            <div>
                <div class="dropdown mb-3">
                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        Download
                    </button>
                    <ul class="dropdown-menu" style="z-index:9999;">
                        <li>
                            <a class="dropdown-item"
                               href="/admin/dsr-report/download-excel?from_date=' . $from_date . '&to_date=' . $to_date . '&activity_type=' . $activity_type . '&party_type=' . $party_type . '&shipper=' . $shipper_id . '&consignee=' . $consignee_id . '&branch_id='.$branch_id . '"
                               target="_blank">Download Excel</a>
                        </li>
                    </ul>
                </div>
           </div>
            <table border="1" width="100%" max-height-"500px" overflow="scroll" cellspacing="0" cellpadding="5" style="border-collapse: collapse;" class="table table-bordered table-striped dsr-table">
                <thead style="background-color:#d2ebf9; color:#000000;">
                    <tr>
                        <th>Sr No.</th>
                        <th>Job No</th>
                        <th>Branch</th>
                        <th>Shipper Name</th>
                        <th>Consignee Name</th>

                        <th>Inv no / Inv Dt</th>
                        <th>PKGS</th>
                        <th>LCL/FCL/AIR</th>

                        <th>Load Port</th>
                        <th>Discharge Port</th>

                        <th>Cargo Dispach</th>
                        <th>Check list</th>
                        <th>S.Bill No/Date / BOE</th>

                        <th>Cartining</th>
                        <th>LEO/Out Of Charge</th>
                        <th>Stuffing Point/Dt</th>
                        <th>Shipping Line / AirLine</th>

                        <th> BL/AWB No</th>
                        <th>Cont No / Size</th>
                        <th>Flight No / Flight Dt</th>
                        <th>SOB Date</th>

                        <th>VSL / VOY</th>
                        <th>ETD</th>
                        <th>ETA</th>
                        <th>Forwarder</th>
                        <th>CBM / Chargeable Weight</th>
                        <th>Iata Agent</th>

                        <th>Booking No / Date</th>
                        <th>CHA</th>
                        <th>Transport</th>
                        <th>Destination Port</th>
                        <th>Delivery Port</th>
                        <th>Flight Status</th>
                    </tr>
                </thead>
                <tbody>';

        $sr = ($page - 1) * $perPage + 1;

        foreach ($all_data as $item) {

            $job_no = $item->jobMaster->full_job_no;
            if($item->prefix == 'AI'){
                $url = 'admin/air-imports/'.$item->uuid.'/edit';
            }elseif($item->prefix == 'AE'){
                $url = 'admin/air-exports/'.$item->uuid.'/edit';
            }elseif($item->prefix == 'SI'){
                $url = 'admin/sea-imports/'.$item->uuid.'/edit';
            }elseif($item->prefix == 'SE'){
                $url = 'admin/sea-exports/'.$item->uuid.'/edit';
            }

            if($item->prefix == 'AI' || $item->prefix == 'AE'){

                $firstFlightNumber = $item->flight_number_1 ?? $item->flight_no ?? '--';
                $secondFlightNumber = $item->flight_number_2 ?? '';
                $firstFlightDate = $item->flight_date_1 ?? $item->flight_date ?? '--';
                $secondFlightDate = $item->flight_date_2 ?? '';
                $FlightNumbers = $firstFlightNumber .' '. $secondFlightNumber;
                $FlightDate = $firstFlightDate .' '. $secondFlightDate;

                $html .= '<tr onclick="window.location.href=\''.url($url).'\'" style="cursor:pointer;">
                    <td style="color:#000000;">' . $sr++ . '</td>
                    <td style="color:#000000;">' . $job_no . '</td>
                    <td style="color:#000000;">'
                        .($item->jobMaster->branch->branch_name ?? '--').
                    '</td>
                    <td style="color:#000000;">' . ($item->shipperName->party_name ?? '--') . '</td>
                    <td style="color:#000000;">' . ($item->ConsigneeName->party_name ?? '--') . '</td>

                    <td style="color:#000000;">' . ($item->customer_inv_no ?? '--') . '</td>
                    <td style="color:#000000;">' . ($item->package ?? '--') . '</td>
                    <td style="color:#000000;"> Air </td>

                    <td style="color:#000000;">' . ($item->loadingPortName->port_name ?? '--') . '</td>
                    <td style="color:#000000;">' . ($item->dischargePortName->port_name ?? '--') . '</td>

                    <td style="color:#000000;">' . ($item->jobMaster->cargo_ready_date ?? 'Pending') . '</td>
                    <td style="color:#000000;">'.($item->check_list_date ?? '--').'</td>
                    <td style="color:#000000;">'.($item->sbill_no ?? $item->bill_of_entry_date ?? '--').'</td>
                    <td style="color:#000000;">'.($item->cartining_date ?? '--').'</td>
                    <td style="color:#000000;">'. ($item->out_off_charge_date ?? $item->leo_date ?? '--').'</td>
                    <td style="color:#000000;"> -- </td>

                    <td style="color:#000000;">' . ($item->flight_name_1 ?? $item->flight_name_2 ?? '--') . '</td>
                    <td style="color:#000000;">'.($item->mawb_no ?? '--').'/'.($item->hbl_no ?? '--').'</td>
                    <td style="color:#000000;"> -- </td>
                    <td style="color:#000000;">'.($FlightNumbers).' / '.($FlightDate).'</td>

                    <td style="color:#000000;">' . (!empty($item->sobDate) ? \Carbon\Carbon::parse($item->sobDate)->format('Y-m-d') : 'Pending') . '</td>
                    <td style="color:#000000;"> -- </td>

                    <td style="color:#000000;">' . (!empty($item->etd_date) ? \Carbon\Carbon::parse($item->etd_date)->format('Y-m-d') : 'Pending') . '</td>
                    <td style="color:#000000;">' . (!empty($item->eta_date) ? \Carbon\Carbon::parse($item->eta_date)->format('Y-m-d') : 'Pending') . '</td>

                    <td style="color:#000000;">' . ($item->Forwarder->party_name ?? '--') . '</td>
                    <td style="color:#000000;">' . ($item->chg_weight ?? $item->chargable_weight ?? '--') . '</td>
                    <td style="color:#000000;">' . ($item->iataAgent->party_name ?? $item->LataAgentName->party_name ?? '--') . '</td>

                    <td style="color:#000000;">'. ($item->booking_no ?? '--') .'/'.(!empty($item->booking_date) ? \Carbon\Carbon::parse($item->booking_date)->format('Y-m-d') : 'Pending'). '</td>
                    <td style="color:#000000;">' . ($item->ChaName->party_name ?? '--') . '</td>
                    <td style="color:#000000;">' . ($item->transportation_details ?? '--') . '</td>
                    <td style="color:#000000;">' . ($item->destinationPortName->port_name ?? '--') . '</td>
                    <td style="color:#000000;">' . ($item->deliveryPortName->port_name ?? '--') . '</td>
                    <td style="color:#000000;">' . ($item->flight_status ?? '--') . '</td>
                </tr>';
            }else{
                // ---------- SEA IMPORT / EXPORT ----------
                $containerBlocks = [
                    'container'    => [],
                    'consignee'    => [],
                    'invoice'      => [],
                    'package'      => [],
                    'checklist'    => [],
                    'sbill'        => [],
                    'cartining'    => [],
                    'leo'          => [],
                    'sob'          => [],
                    'cbm'          => [],
                ];

                foreach ($item->container as $cont) {
                    $containerId = ($cont->container_no ?? '--') . ' / ' . ($cont->size ?? '--');

                    // ---- STEP 1: Get Container values (as first shipment) ----
                    $containerInvoice   = $cont->customer_inv_no ?? '--';
                    $containerPackages  = $cont->total_package ?? '--';
                    $containerChecklist = $cont->check_list_date ?? '--';
                    $containerSbill = ($cont->sbill_no ?? '--') . ' / ' .
                          (!empty($cont->sbill_date)
                              ? Carbon::parse($cont->sbill_date)->format('Y-m-d')
                              : '--');
                    $containerCartining = $cont->cartining_date ?? '--';

                    $containerLeo       = $cont->leo_date ?? '--';
                    $containerCbm       = $cont->cbm ?? '--';
                    $containerSob       = !empty($cont->sob_date) ? Carbon::parse($cont->sob_date)->format('Y-m-d') : '--';
                    $containerConsignee = $item->ConsigneeName->party_name ?? '--'; // job-level consignee

                    // ---- STEP 2: Get Shipment Lines values ----
                    $shipmentLines = ($cont instanceof \App\Models\Operations\OperationSeaExportCont)
                        ? ($cont->shipmentLines ?? collect())
                        : collect();

                    // Helper to collect shipment line values
                    $getShipmentValues = function($field) use ($shipmentLines) {
                        if ($shipmentLines->count() > 0) {
                            return $shipmentLines->pluck($field)->map(fn($v) => $v ?? '--')->toArray();
                        }
                        return [];
                    };

                    $shipmentInvoices   = $getShipmentValues('invoice_no');
                    $shipmentPackages   = $getShipmentValues('packages');
                    $shipmentChecklists = $getShipmentValues('check_list_date');
                    // shipment shipping bill no and no
                    $shipmentSbills = [];
                    if ($shipmentLines->count() > 0) {
                        $shipmentSbills = $shipmentLines->map(function ($line) {
                            $billNo = $line->shipping_bill_no ?? '--';
                            $billDate = !empty($line->shipping_bill_date)
                                ? Carbon::parse($line->shipping_bill_date)->format('Y-m-d')
                                : '--';

                            return $billNo . ' / ' . $billDate;
                        })->toArray();
                    }

                    $shipmentCartinings = $getShipmentValues('carting_date');
                    $shipmentLeos       = $getShipmentValues('leo_date');
                    $shipmentCbms       = $getShipmentValues('cbm');
                    $shipmentSobs       = $shipmentLines->count() > 0
                        ? $shipmentLines->map(fn($line) => !empty($line->sob_date) ? Carbon::parse($line->sob_date)->format('Y-m-d') : '--')->toArray()
                        : [];
                    $shipmentConsignees = $shipmentLines->count() > 0
                        ? $shipmentLines->map(fn($line) => $line->consignee->party_name ?? '--')->toArray()
                        : [];

                    // ---- STEP 3: Merge Container + Shipment Lines into single arrays ----
                    $allInvoices   = array_merge([$containerInvoice], $shipmentInvoices);
                    $allPackages   = array_merge([$containerPackages], $shipmentPackages);
                    $allChecklists = array_merge([$containerChecklist], $shipmentChecklists);
                    $allSbills     = array_merge([$containerSbill], $shipmentSbills);
                    $allCartinings = array_merge([$containerCartining], $shipmentCartinings);
                    $allLeos       = array_merge([$containerLeo], $shipmentLeos);
                    $allCbms       = array_merge([$containerCbm], $shipmentCbms);
                    $allSobs       = array_merge([$containerSob], $shipmentSobs);
                    $allConsignees = array_merge([$containerConsignee], $shipmentConsignees);

                    // ---- STEP 4: Wrap values with styling ----
                    $wrapValues = function($values) {
                        $count = count($values);
                        $items = [];
                        foreach ($values as $index => $v) {
                            $style = 'display:block; background:#f8f9fa; padding:4px 8px; margin:2px 0; border-radius:4px; font-size:12px; border-left:3px solid #007bff;';
                            if ($index < $count - 1) {
                                $style .= ' border-bottom: 1px dashed #dee2e6;';
                            }
                            $items[] = '<span style="' . $style . '">' . $v . '</span>';
                        }
                        return implode('', $items);
                    };

                    // ---- STEP 5: Store blocks ----
                    $containerBlocks['container'][]    = $containerId;
                    $containerBlocks['consignee'][]    = $wrapValues($allConsignees);
                    $containerBlocks['invoice'][]      = $wrapValues($allInvoices);
                    $containerBlocks['package'][]      = $wrapValues($allPackages);
                    $containerBlocks['checklist'][]    = $wrapValues($allChecklists);
                    $containerBlocks['sbill'][]        = $wrapValues($allSbills);
                    $containerBlocks['cartining'][]    = $wrapValues($allCartinings);
                    $containerBlocks['leo'][]          = $wrapValues($allLeos);
                    $containerBlocks['sob'][]          = $wrapValues($allSobs);
                    $containerBlocks['cbm'][]          = $wrapValues($allCbms);
                }

                // Separator between containers
                $hr = '<hr style="margin:10px 0; border:0; border-top:2px dashed #007bff;">';

                // Render ONE ROW per job
                $html .= '<tr onclick="window.location.href=\''.url($url).'\'" style="cursor:pointer;">
                    <td>'.$sr++.'</td>
                    <td>'.$job_no.'</td>
                    <td>'
                        .($item->jobMaster->branch->branch_name ?? '--').
                    '</td>
                    <td>'.($item->shipperName->party_name ?? '--').'</td>
                    <td>'.implode($hr, $containerBlocks['consignee']).'</td>
                    <td>'.implode($hr, $containerBlocks['invoice']).'</td>
                    <td>'.implode($hr, $containerBlocks['package']).'</td>
                    <td>'.($item->cargo_type ?? '').'</td>
                    <td>'.($item->loadingPortName->port_name ?? '--').'</td>
                    <td>'.($item->dischargePortName->port_name ?? '--').'</td>
                    <td>'.($item->jobMaster->cargo_ready_date ?? 'Pending').'</td>
                    <td>'.implode($hr, $containerBlocks['checklist']).'</td>
                    <td>'.implode($hr, $containerBlocks['sbill']).'</td>
                    <td>'.implode($hr, $containerBlocks['cartining']).'</td>
                    <td>'.implode($hr, $containerBlocks['leo']).'</td>
                    <td>'.($item->stuffing_point ?? $item->stuffingDate ?? '--').'</td>
                    <td>'.($item->shippingLine->shipping_line_name ?? '--').'</td>
                    <td>'.($item->hbl_no ?? $item->mbl_no ?? '--').'</td>
                    <td>'.implode($hr, $containerBlocks['container']).'</td>
                    <td>--</td>
                    <td>'.implode($hr, $containerBlocks['sob']).'</td>
                    <td>'.($item->vessel_name ?? '--').' / '.($item->voyage_no ?? '--').'</td>
                    <td>'.(!empty($item->etd_date) ? Carbon::parse($item->etd_date)->format('Y-m-d') : '--').'</td>
                    <td>'.(!empty($item->eta_date) ? Carbon::parse($item->eta_date)->format('Y-m-d') : '--').'</td>
                    <td>'.($item->Forwarder->party_name ?? '--').'</td>
                    <td>'.implode($hr, $containerBlocks['cbm']).'</td>
                    <td>--</td>
                    <td>'.($item->booking_no ?? '--').' / '.(!empty($item->booking_date)
                            ? Carbon::parse($item->booking_date)->format('Y-m-d')
                            : 'Pending').'</td>
                    <td>'.($item->ChaName->party_name ?? '--').'</td>
                    <td>'.($item->transportation_details ?? '--').'</td>
                    <td>'.($item->destinationPortName->port_name ?? '--').'</td>
                    <td>'.($item->deliveryPortName->port_name ?? '--').'</td>
                    <td>'.($item->flight_status ?? '--').'</td>
                </tr>';
            }
        }

        $html .= '</tbody></table>';
        $html .= '<div class="mt-3">' . $all_data->withQueryString()->links('pagination::bootstrap-5') . '</div></div>';

        return response()->json(['html' => $html]);
    }


    public function downloadExcel(Request $request)
    {
        $from_date     = $request->from_date;
        $to_date       = $request->to_date;
        $activity_type = $request->activity_type;
        $company_id    = $this->company_id;
        $shipper_id    = $request->shipper;
        $consignee_id    = $request->consignee;
        $branch_id = $request->branch_id;
        $party_type    = 'all';

        // same logic → get all filtered data (AIR/SEA IMPORT/EXPORT)
        $data = $this->getDsrDataForExcel($from_date, $to_date, $activity_type, $party_type, $company_id, $shipper_id, $consignee_id, $branch_id);

        return Excel::download(new DsrExport($data), 'DSR_Report.xlsx');
    }

    public function getDsrDataForExcel($from_date, $to_date, $activity_type, $party_type, $company_id, $shipper_id, $consignee_id, $branch_id)
    {
        if (in_array($activity_type, ['AI', 'AE', 'SI', 'SE'])) {

            // echo $shipper_id; echo $consignee_id; exit();

            switch ($activity_type) {
                case 'AI':
                    $query = OperationAirImport::where('company_id', $company_id)
                        ->when($branch_id != 'all', function ($q) use ($branch_id) {
                            $q->where('branch_id', $branch_id);
                        });

                    break;
                case 'AE':
                    $query = OperationAirExport::where('company_id', $company_id)
                        ->when($branch_id != 'all', function ($q) use ($branch_id) {
                            $q->where('branch_id', $branch_id);
                        });

                    break;
                case 'SI':
                    $query = OperationSeaImport::with('container')->where('company_id', $company_id)
                        ->when($branch_id != 'all', function ($q) use ($branch_id) {
                            $q->where('branch_id', $branch_id);
                        });

                    break;
                case 'SE':
                    $query = OperationSeaExport::with(['container.shipmentLines.consignee', 'jobMaster'])->where('company_id', $company_id)
                        ->when($branch_id != 'all', function ($q) use ($branch_id) {
                            $q->where('branch_id', $branch_id);
                        });

                    break;
            }

            if ($shipper_id) {
                $query->where('shipper_id', $shipper_id);
                $party_type = 'shipper';
            } elseif ($consignee_id) {
                $query->where('consignee_id', $consignee_id);
                $party_type = 'consignee';
            }

            $query->whereBetween('created_at', [
                Carbon::parse($from_date)->startOfDay(),
                Carbon::parse($to_date)->endOfDay()
            ]);

            // echo "<pre>"; print_r($query->get()); exit();

            return $query->get();
        }

        // MERGE ALL
        $airImport = OperationAirImport::where('company_id', $company_id)
            ->when($branch_id != 'all', function ($q) use ($branch_id) {
                $q->where('branch_id', $branch_id);
            })
            ->whereBetween('created_at', [Carbon::parse($from_date)->startOfDay(), Carbon::parse($to_date)->endOfDay()])
            ->get();

        $airExport = OperationAirExport::where('company_id', $company_id)
            ->when($branch_id != 'all', function ($q) use ($branch_id) {
                $q->where('branch_id', $branch_id);
            })
            ->whereBetween('created_at', [Carbon::parse($from_date)->startOfDay(), Carbon::parse($to_date)->endOfDay()])
            ->get();

        $seaImport = OperationSeaImport::with('container')->where('company_id', $company_id)
            ->when($branch_id != 'all', function ($q) use ($branch_id) {
                $q->where('branch_id', $branch_id);
            })
            ->whereBetween('created_at', [Carbon::parse($from_date)->startOfDay(), Carbon::parse($to_date)->endOfDay()])
            ->get();

        $seaExport = OperationSeaExport::with(['container.shipmentLines.consignee', 'jobMaster'])->where('company_id', $company_id)
            ->when($branch_id != 'all', function ($q) use ($branch_id) {
                $q->where('branch_id', $branch_id);
            })
            ->whereBetween('created_at', [Carbon::parse($from_date)->startOfDay(), Carbon::parse($to_date)->endOfDay()])
            ->get();

        return $airImport->concat($airExport)->concat($seaImport)->concat($seaExport)->sortByDesc('created_at')->values();
    }


    // public function download($format)
    // {
    //     $query = AccountSaleInvoice::where('company_id', $this->company_id)->get();

    //     if ($format == 'pdf') {
    //         $html = View::make('admin-main.admin.salesOutstanding.report', compact('query'))->render();

    //         $dompdf = new Dompdf();
    //         $dompdf->loadHtml($html);
    //         $dompdf->setPaper('A4', 'landscape');
    //         $dompdf->render();
    //         return response($dompdf->output(), 200)
    //                 ->header('Content-Type', 'application/pdf')
    //                 ->header('Content-Disposition', 'attachment; filename="repost.pdf"');
    //     }

    //     if ($format == 'excel') {
    //         return Excel::download(new SalesOutstandingExport($query), 'Sales-Outstanding.xlsx');
    //     }

    //     if ($format == 'word') {
    //         $html = View::make('admin-main.admin.salesOutstanding.report', compact('query'))->render();
    //         return response($html)
    //             ->header('Content-Type', 'application/msword')
    //             ->header('Content-Disposition', 'attachment; filename="loading-list.doc"');
    //     }

    //     return redirect()->back()->with('error', 'Invalid format selected');
    // }



}
