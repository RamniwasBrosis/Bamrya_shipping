<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PurchaseLedgerExport implements FromCollection, WithHeadings, WithStyles
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        $srNo = 1;

        return $this->data->map(function ($item) use (&$srNo) {
            $invoiceDate = optional($item->invoice_date)->format('d-m-Y') ?? '--';
            $receiptDate = optional($item->receipt_date)->format('d-m-Y') ?? '--';
            $neftDate = optional($item->neft_date)->format('d-m-Y') ?? '--';

            return [
                'Sr. No.'         => $srNo++,
                'Invoice Date'    => $invoiceDate,
                'Party Name'      => $item->partyName->party_name ?? '--',
                'Invoice No'      => $item->invoice_no ?? '--',
                'Debit Amount'    => $item->amount ?? 0,
                'Actual Paid Amt' => $item->actual_paid_amount ?? 0,
                'TDS'             => $item->tds_amount ?? 0,
                'Receipt No'      => $item->receipt_no ?? '--',
                'Receipt Date'    => $receiptDate,
                'NEFT Details'    => $item->neft_details ?? '--',
                'NEFT Date'       => $neftDate,
                'Bank Name'       => $item->bank_name ?? '--',
                'Paid Party'      => $item->paid_party ?? '--',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Sr. No.',
            'Invoice Date',
            'Party Name',
            'Invoice No',
            'Debit Amount',
            'Actual Paid Amt',
            'TDS',
            'Receipt No',
            'Receipt Date',
            'NEFT Details',
            'NEFT Date',
            'Bank Name',
            'Paid Party',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 12]],
        ];
    }
}
