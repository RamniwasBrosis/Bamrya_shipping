<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Collection;

class CostSheetExport implements FromCollection, WithHeadings, WithStyles
{
    protected $sales;
    protected $purchases;

    public function __construct($sales, $purchases)
    {
        $this->sales = $sales;
        $this->purchases = $purchases;
    }

    public function collection()
    {
        $data = collect();

        $data->push(['--- SALES (Receivables) ---']);
        foreach ($this->sales as $sale) {
            $data->push([
                'Invoice No' => $sale->invoice_no,
                'Amount' => $sale->amount,
                'Date' => optional($sale->created_at)->format('d-m-Y'),
            ]);
        }

        $data->push(['--- PURCHASES (Payables) ---']);
        foreach ($this->purchases as $purchase) {
            $data->push([
                'Invoice No' => $purchase->invoice_no,
                'Amount' => $purchase->amount,
                'Date' => optional($purchase->created_at)->format('d-m-Y'),
            ]);
        }

        return $data;
    }

    public function headings(): array
    {
        return ['Invoice No', 'Amount', 'Date'];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 12]],
        ];
    }
}
