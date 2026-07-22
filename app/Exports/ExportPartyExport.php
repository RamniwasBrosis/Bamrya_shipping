<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportPartyExport implements FromCollection, WithHeadings
{
    protected $exportParties;

    public function __construct($exportParties)
    {
        $this->exportParties = $exportParties;
    }

    public function collection()
    {
        return $this->exportParties->map(function ($party, $index) {

            return [
                'S.No'            => $index + 1,
                'Party Name'      => $party->party_name,
                'Telephone'       => $party->tel_no,
                'Email'           => $party->email,
                'GSTIN'           => $party->gstin,
                'PAN No'          => $party->pan_no,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'S.No',
            'Party Name',
            'Telephone',
            'Email',
            'GSTIN',
            'PAN No',
        ];
    }
}
