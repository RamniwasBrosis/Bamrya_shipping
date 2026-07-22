<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ImportPartyExport implements FromCollection, WithHeadings
{
    protected $importParties;

    public function __construct($importParties)
    {
        $this->importParties = $importParties;
    }

    public function collection()
    {
        return $this->importParties->map(function ($party, $index) {

            return [
                'S.No'            => $index + 1,
                'Party Name'      => $party->party_name,
                'Party Type'      => $party->party->party_name ?? '',
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
            'Party Type',
            'Telephone',
            'Email',
            'GSTIN',
            'PAN No',
        ];
    }
}