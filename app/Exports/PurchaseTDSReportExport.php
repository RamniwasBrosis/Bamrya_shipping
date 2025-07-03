<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PurchaseTDSReportExport implements FromCollection, WithHeadings, WithStyles
{
   protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        

        return $this->data->map(function ($item) {

            // Totals
            $totalBill = 0;
            $totalBasic = 0;
            $totalTds = 0;
            $totalPayable = 0;

            $billAmount = $item->amount ?? 0;
            $basicAmount = $item->basic_amount ?? 0;
            $tdsAmt = $item->tds_amount ?? 0;
            $tdsPercent = $item->tds ?? 0;
            $payableAmt = $billAmount - $tdsAmt;
            $panNo = $item->partyName->pan_no ?? '--';

            $totalBill += $billAmount;
            $totalBasic += $basicAmount;
            $totalTds += $tdsAmt;
            $totalPayable += $payableAmt;

            
            return [
                'Party Name'        => $item->partyName->party_name ?? '--',
                'Job No'            => $item->job_no ?? '--',
                'Invoice No'         => $item->invoice_no ?? '--',
                'INV DT'            => $item->invoice_date ?? '--',
                'Bill Amount'          => $item->amount ?? '--',
                'Basic Amount'            => $item->basic_amount ?? '--',
                'TDS AMT'          => $tdsAmt,
                'TDS %'    => number_format($tdsPercent ?? 0, 2),
                'Payable Amt'   => $payableAmt,
                'PAN No'=> $panNo,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Party Name',
            'Job No',
            'Invoice No',
            'INV DT',
            'Bill Amount',
            'Basic Amount',
            'TDS AMT',
            'TDS %',
            'Payable Amt',
            'PAN No',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Make first row (headings) bold and font size 18
            1 => ['font' => ['bold' => true, 'size' => 18]],
        ];
    }
}
