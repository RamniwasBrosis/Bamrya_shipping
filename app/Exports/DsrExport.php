<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Carbon\Carbon;

class DsrExport implements FromArray, WithStyles, ShouldAutoSize
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function array(): array
    {
        $output = [];

        // Header
        $output[] = [
            'Sr No', 'Job No','Branch', 'Shipper', 'Consignee',
            'Inv No/Inv Dt','PKGS','LCL/FCL/AIR',
            'Load Port','Discharge Port',
            'Cargo Dispatch',
            'Check List','S.Bill No/Dt / BOE','Cartining','LEO/Out Of Charge',
            'Stuffing Point/Dt','Shipping Line/AirLine','BL/AWB No',
            'Container / Size', 'Flight No/Date','SOB Date',
            'VSL/VOY','ETD', 'ETA','Forwarder','CBM/Chargeable Weight','Iata Agent',
            'Booking No/Date','CHA',
            'Transport','Destination Port', 'Delivery Port','Flight Status'
        ];

        $sr = 1;

        foreach ($this->data as $item) {

            // ------ AIR (AI / AE) ------
            if ($item->prefix == 'AI' || $item->prefix == 'AE') {

                if($item->prefix == 'AI'){
                    $charge_able_weight = $item->chg_weight;
                }elseif($item->prefix == 'AE'){
                    $charge_able_weight = $item->chargable_weight;
                }

                $firstFlightNumber = $item->flight_number_1 ?? $item->flight_no ?? '--';
                $secondFlightNumber = $item->flight_number_2 ?? '';
                $firstFlightDate = $item->flight_date_1 ?? $item->flight_date ?? '--';
                $secondFlightDate = $item->flight_date_2 ?? '';
                $FlightNumbers = $firstFlightNumber .' '. $secondFlightNumber;
                $FlightDate = $firstFlightDate .' '. $secondFlightDate;

                $output[] = [
                    $sr++,
                    $item->jobMaster->full_job_no ?? '',
                    $item->jobMaster->branch->branch_name ?? '',
                    $item->shipperName->party_name ?? '',
                    $item->ConsigneeName->party_name ?? '',

                    $item->customer_inv_no ?? '',
                    $item->package ?? 0,
                    'Air',

                    $item->loadingPortName->port_name ?? '--',
                    $item->dischargePortName->port_name ?? '',

                    $item->jobMaster->cargo_ready_date ?? 'Pending',
                    $item->check_list_date ?? 'Pending',
                    $item->sbill_no ?? $item->bill_of_entry_date ?? '',
                    $item->cartining_date,
                    $item->leo_date ?? $item->out_off_charge_date ?? '',
                    '--',
                    $item->flight_name_1 ?? $item->flight_name_2 ?? '--',
                    $item->mawb_no ?? '--'.'/'.$item->hbl_no ?? '--',

                    '--',
                    $FlightNumbers.' / '.$FlightDate,
                    $item->sobDate ?? '--',
                    '--',

                    !empty($item->etd_date) ? \Carbon\Carbon::parse($item->etd_date)->format('Y-m-d') : 'Pending',
                    !empty($item->eta_date) ? \Carbon\Carbon::parse($item->eta_date)->format('Y-m-d') : 'Pending',
                    $item->Forwarder->party_name ?? '--',
                    $charge_able_weight,
                    $item->iataAgent->party_name ?? $item->LataAgentName->party_name ?? '--',

                    ($item->booking_no ?? '--') .'/'. (!empty($item->booking_date) ? \Carbon\Carbon::parse($item->booking_date)->format('Y-m-d') : 'Pending'),
                    $item->ChaName->party_name ?? '',
                    $item->transportation_details ?? '--',
                    $item->destinationPortName->port_name ?? '--',
                    $item->deliveryPortName->port_name ?? '--',
                    $item->flight_status,

                ];

            }else {
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

                    // ---- Container values (as first entry) ----
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

                    // ---- Shipment Lines ----
                    $shipmentLines = ($cont instanceof \App\Models\Operations\OperationSeaExportCont)
                        ? ($cont->shipmentLines ?? collect())
                        : collect();

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

                    // ---- Merge Container + Shipment Lines ----
                    $allInvoices   = array_merge([$containerInvoice], $shipmentInvoices);
                    $allPackages   = array_merge([$containerPackages], $shipmentPackages);
                    $allChecklists = array_merge([$containerChecklist], $shipmentChecklists);
                    $allSbills     = array_merge([$containerSbill], $shipmentSbills);
                    $allCartinings = array_merge([$containerCartining], $shipmentCartinings);
                    $allLeos       = array_merge([$containerLeo], $shipmentLeos);
                    $allCbms       = array_merge([$containerCbm], $shipmentCbms);
                    $allSobs       = array_merge([$containerSob], $shipmentSobs);
                    $allConsignees = array_merge([$containerConsignee], $shipmentConsignees);

                    $containerBlocks['container'][]    = $containerId;
                    $containerBlocks['consignee'][]    = implode(PHP_EOL, $allConsignees);
                    $containerBlocks['invoice'][]      = implode(PHP_EOL, $allInvoices);
                    $containerBlocks['package'][]      = implode(PHP_EOL, $allPackages);
                    $containerBlocks['checklist'][]    = implode(PHP_EOL, $allChecklists);
                    $containerBlocks['sbill'][]        = implode(PHP_EOL, $allSbills);
                    $containerBlocks['cartining'][]    = implode(PHP_EOL, $allCartinings);
                    $containerBlocks['leo'][]          = implode(PHP_EOL, $allLeos);
                    $containerBlocks['sob'][]          = implode(PHP_EOL, $allSobs);
                    $containerBlocks['cbm'][]          = implode(PHP_EOL, $allCbms);
                }

                $hr = PHP_EOL . '--------------------' . PHP_EOL;

                $output[] = [
                    $sr++,
                    $item->jobMaster->full_job_no ?? '',
                    $item->jobMaster->branch->branch_name ?? '',
                    $item->shipperName->party_name ?? '',
                    implode($hr, $containerBlocks['consignee']),
                    implode($hr, $containerBlocks['invoice']),
                    implode($hr, $containerBlocks['package']),
                    $item->cargo_type ?? '',
                    $item->loadingPortName->port_name ?? '--',
                    $item->dischargePortName->port_name ?? '',
                    $item->jobMaster->cargo_ready_date ?? '',
                    implode($hr, $containerBlocks['checklist']),
                    implode($hr, $containerBlocks['sbill']),
                    implode($hr, $containerBlocks['cartining']),
                    implode($hr, $containerBlocks['leo']),
                    $item->stuffing_point ?? '',
                    $item->shippingLine->shipping_line_name ?? '--',
                    $item->hbl_no ?? $item->mbl_no ?? '--',
                    implode($hr, $containerBlocks['container']),
                    '--',
                    implode($hr, $containerBlocks['sob']),
                    ($item->vessel_name ?? '--') . ' / ' . ($item->voyage_no ?? '--'),
                    !empty($item->etd_date) ? Carbon::parse($item->etd_date)->format('Y-m-d') : '--',
                    !empty($item->eta_date) ? Carbon::parse($item->eta_date)->format('Y-m-d') : '--',
                    $item->Forwarder->party_name ?? '--',
                    implode($hr, $containerBlocks['cbm']),
                    $item->iataAgent->party_name ?? $item->LataAgentName->party_name ?? '--',
                    ($item->booking_no ?? '--') . '/' . (!empty($item->booking_date) ? Carbon::parse($item->booking_date)->format('Y-m-d') : '--'),
                    $item->ChaName->party_name ?? '--',
                    $item->transportation_details ?? '--',
                    $item->destinationPortName->port_name ?? '--',
                    $item->deliveryPortName->port_name ?? '--',
                    $item->flight_status ?? '--',
                ];
            }
        }

        return $output;
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle($sheet->calculateWorksheetDimension())
            ->getAlignment()
            ->setWrapText(true);

        return [
            1 => [
                'font' => ['bold' => true, 'size' => 11],
            ]
        ];
    }
}
