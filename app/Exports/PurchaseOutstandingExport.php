<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PurchaseOutstandingExport implements FromCollection, WithHeadings, WithStyles
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        $rows = collect();
        $totalBill = 0;
        $totalBasic = 0;
        $totalTds = 0;
        $totalPayable = 0;
        $totalTaxableAmount = 0;
        $totalGstAmount = 0;

        foreach ($this->data as $item) {
            $charges = $item['chargesContainer'] ?? collect();
            if ($charges->isEmpty()) continue;

            $cgstAmount  = $charges->sum('cgst');
            $sgstAmount  = $charges->sum('sgst');
            $igstAmount  = $charges->sum('igst');
            $gstAmount = $igstAmount + $sgstAmount + $cgstAmount;
            $taxableAmount  = $charges->sum('freight');

            $billAmount  = $charges->sum('amount');
            $basicAmount = $charges->sum('basic_amount') ?? 0;
            $tdsAmt      = $charges->sum('tds_amount');
            $tdsPercent  = $charges->avg('tds');
            $payableAmt  = $billAmount;

            $totalBill += $billAmount;
            $totalBasic += $basicAmount;
            $totalTds += $tdsAmt;
            $totalPayable += $payableAmt;
            $totalTaxableAmount  += $taxableAmount;
            $totalGstAmount += $gstAmount;

            $rows->push([
                'Party Name'   => optional($item->partyName)->party_name ?? '--',
                'Job No'       => optional($item->operationJob)->full_job_no ?? '--',
                'Branch'       => $item->branch->branch_name ?? '--',
                'Invoice No'   => $item->invoice_no ?? '--',
                'INV DT'       => $item->invoice_date ? \Carbon\Carbon::parse($item->invoice_date)->format('d-m-Y') : '' ,
                'GSTIN No'       => optional($item->partyName)->pan_no ?? '--',
                'Taxable Amount'  => number_format($taxableAmount, 2),
                'GST Amount' => number_format($gstAmount, 2),
                'Total Amount'  => number_format($totalPayable, 2),
            ]);
        }

        // Add grand total row at the end
        $rows->push([
            'Party Name'   => '',
            'Job No'       => '',
            'Branch'       => '',
            'Invoice No'   => '',
            'INV DT'       => '',
            'GSTIN No'       => 'GRAND TOTAL:',
            'Taxable Amount'  => number_format($totalTaxableAmount, 2),
            'GST Amount' => number_format($totalGstAmount, 2),
            'Total Amount'  => number_format(round($totalPayable), 2),
        ]);

        return $rows;
    }

    public function headings(): array
    {
        return [
            'Party Name',
            'Job No',
            'Branch',
            'Invoice No',
            'INV DT',
            'GSTIN No',
            'Taxable Amount',
            'GST Amount',
            'Total Amount',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Heading style
        $sheet->getStyle('A1:J1')->applyFromArray([
            'font' => ['bold' => true, 'size' => 12],
            'alignment' => ['horizontal' => 'center'],
        ]);

        // Auto width for all columns
        foreach (range('A', 'J') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Make last row (grand total) bold
        $lastRow = $sheet->getHighestRow();
        $sheet->getStyle('A' . $lastRow . ':J' . $lastRow)->applyFromArray([
            'font' => ['bold' => true],
            'fill' => [
                'fillType' => 'solid',
                'color' => ['rgb' => 'F2F2F2']
            ],
        ]);

        return [];
    }
}

