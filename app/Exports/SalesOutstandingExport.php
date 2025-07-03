<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SalesOutstandingExport implements FromCollection, WithHeadings, WithStyles
{
   protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data->map(function ($item) {
            return [
                'Party Name'        => $item->billingParty->party_name ?? '--',
                'Job No'            => $item->job_no ?? '--',
                'Port Name'         => $item->pod ?? '--',
                'HBL No'            => $item->hbl_no ?? '--',
                'Inv Type'          => $item->invoice_type ?? '--',
                'Inv No'            => $item->invoice_no ?? '--',
                'Inv Date'          => optional($item->invoice_date)->format('d-m-Y'),
                'Invoice Amount'    => number_format($item->amount ?? 0, 2),
                'Amount Received'   => number_format($item->amount_received ?? 0, 2),
                'Outstanding Amount'=> number_format(($item->amount - $item->amount_received), 2),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Party Name',
            'Job No',
            'Port Name',
            'HBL No',
            'Inv Type',
            'Inv No',
            'Inv Date',
            'Invoice Amount',
            'Amount Received',
            'Outstanding Amount',
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
