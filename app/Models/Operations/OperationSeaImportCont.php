<?php

namespace App\Models\Operations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationSeaImportCont extends Model
{
    use HasFactory;

    protected $fillable = [
        'cont_hbl',
        'container_no',
        'size',
        'seal_no',
        'gross_weight',
        'cbm',
        'refer',
        'fcl_lcl',
        'total_package',
        'cargo_type',
        'detent_date',
        'freedays_cont',
        'ground_date',
        'ground_days',
        'imo_code',
        'uno_no',
        'tp_icd',
        'soc_yn',
        'disposal',
        'remarks',
        'printed',
        'selected',
        'sector',
        'do_date',
        'previous_days','net_weight','cust_seal_no','ex_rate','rate',
        
        'agentSealNo', 'sobDate', 'mark_and_numbers', 'bill_of_entry_date', 'goods_description', 'customer_inv_no', 'out_off_charge_date', 'destuffing_date', 'check_list_date',

        'company_id',
        'uuid',
        'sea_import_id',
    ];

    public function seaImport()
    {
        return $this->belongsTo(OperationSeaImport::class, 'sea_import_id');
    }
}
