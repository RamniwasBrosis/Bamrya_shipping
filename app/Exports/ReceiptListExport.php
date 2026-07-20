<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReceiptListExport implements FromCollection, WithHeadings
{
    protected $receipts;

    public function __construct($receipts)
    {
        $this->receipts = $receipts;
    }

    public function collection()
    {
        return collect($this->receipts)->map(function($item) {
            return [
                'Date' => $item->date,
                'Party Name' => $item->billingParty->name ?? '',
                'Invoice Type' => $item->invoice_type,
                'Amount' => $item->amount,
                'Payment' => $item->invoice_type === 'payment' ? $item->amount : 0, // If you want 'payment' amount separately
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Date',
            'Party Name',
            'Invoice Type',
            'Amount',
            'Payment'
        ];
    }
}
