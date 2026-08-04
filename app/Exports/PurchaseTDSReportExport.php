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
        $rows = collect();

        $totalTaxableAmount = 0;
        $totalGstAmount = 0;
        $totalPayable = 0;

        foreach ($this->data as $item) {

            $charges = $item['chargesContainer'] ?? collect();

            if ($charges->isEmpty()) {
                continue;
            }

            $cgstAmount = $charges->sum('cgst');
            $sgstAmount = $charges->sum('sgst');
            $igstAmount = $charges->sum('igst');

            $gstAmount = $cgstAmount + $sgstAmount + $igstAmount;

            $taxableAmount = $charges->sum('freight');

            $payableAmt = $taxableAmount + $gstAmount;

            $totalTaxableAmount += $taxableAmount;
            $totalGstAmount += $gstAmount;
            $totalPayable += $payableAmt;

            $rows->push([
                'Party Name'      => optional($item->partyName)->party_name ?? '--',
                'Job No'          => optional($item->operationJob)->full_job_no ?? '--',
                'Branch'          => $item->branch->branch_name ?? '--',
                'Invoice No'      => $item->invoice_no ?? '--',
                'INV DT'          => $item->invoice_date
                                        ? \Carbon\Carbon::parse($item->invoice_date)->format('d-m-Y')
                                        : '',
                'GSTIN No'        => optional($item->partyName)->gstin ?? '--',
                'Taxable Amount'  => number_format($taxableAmount, 2),
                'GST Amount'      => number_format($gstAmount, 2),
                'Total Amount'    => number_format($payableAmt, 2),
            ]);
        }

        // Grand Total Row
        $rows->push([
            'Party Name'      => '',
            'Job No'          => '',
            'Branch'          => '',
            'Invoice No'      => '',
            'INV DT'          => '',
            'GSTIN No'        => 'GRAND TOTAL :',
            'Taxable Amount'  => number_format($totalTaxableAmount, 2),
            'GST Amount'      => number_format($totalGstAmount, 2),
            'Total Amount'    => number_format(round($totalPayable), 2),
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
        return [
            // Make first row (headings) bold and font size 18
            1 => ['font' => ['bold' => true, 'size' => 18]],
        ];
    }
}
