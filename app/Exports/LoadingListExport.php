<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LoadingListExport implements FromCollection
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
                'Booking No'        => $item->booking_no ?? '--',
                'Container No'            => $item->container_no ?? '--',
                'Cont Size'         => $item->size ?? '--',
                'Type'            => $item->cont_category ?? '--',
                'VGM WT'          => $item->vgm_wt ?? '--',
                'POL'            => $item->port_loading_id ?? '--',
                'POD'          => $item->port_discharge_id ?? '--',
                'TEM'    => $item->tem ?? '--',
                'Remark (Hum & Vent)'   => $item->remark ?? '--',
                'Commodity'=> $item->commodity ?? '--',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Booking No',
            'Container No',
            'Cont Size',
            'Type',
            'VGM WT',
            'POL',
            'POD',
            'TEM',
            'Remark (Hum & Vent)',
            'Commodity',
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
