<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SalesPurchaseAggregatedExport implements FromCollection, WithHeadings
{
    protected $rows;

    public function __construct($rows)
    {
        $this->rows = $rows;
    }

    public function collection()
    {
        return collect($this->rows)->map(function ($row) {
            // For profit, show only on first row (sale)
            $profit = ($row->is_first && $row->profit !== null) ? number_format($row->profit, 2) : '';
            return [
                $row->job_no,
                $row->branch_name,
                $row->type,
                $row->party_name,
                $row->invoices,
                number_format($row->taxable, 2),
                number_format($row->gst, 2),
                number_format($row->total, 2),
                $profit,
            ];
        });
    }

    public function headings(): array
    {
        return ['Job No', 'Branch', 'Type', 'Party Name', 'Invoice No(s)', 'Taxable Amount', 'GST Amount', 'Total Amount', 'Profit'];
    }
}
