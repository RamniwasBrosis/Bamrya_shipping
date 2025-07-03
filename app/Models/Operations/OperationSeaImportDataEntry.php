<?php

namespace App\Models\Operations;

use App\Models\MasterImportParty;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OperationSeaImportDataEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id', 'uuid', 'bl_issue_by',
        'job_no', 'cargo_type', 'mbl_no', 'mbl_date', 'hbl_no', 'hbl_date',
        'igm_no', 'igm_date', 'item_no', 'sub_item_no', 'voyage_no', 'arrival_date',
        'vessel_id', 'eta_date', 'etd_date', 'quantity', 'package_type_id', 'freight',
        'gross_weight', 'cbm', 'cargo', 'is_hazardous', 'delivery_type', 'imo_cd',
        'uno_cd', 'free_days', 'hbl_type', 'fpa_amount', 'transportation_details',
        'bill_of_entry', 'delivery_order_date', 'port_loading_id', 'port_discharge_id',
        'port_delivery_id', 'port_destination_id', 'shipping_line_id', 'overseas_agent_id',
        'cfs_yard_id', 'empty_yard_id', 'sales_person_id', 'coloader_id', 'shipper_id',
        'consignee_id', 'notify_id', 'cha_id', 'mark_and_numbers', 'goods_description',
        'obl_no', 'obl_date', 'ref_no', 'do_date', 'surveyor_id', 'validity_date'
    ];

    public function consignee(){
        return $this->belongsTo(MasterImportParty::class, 'consignee_id');
    }

    public function shipperName(){
        return $this->belongsTo(MasterImportParty::class, 'shipper_id');
    }

    public function container(){
        return $this->hasOne(OperationSeaImportDataEntryCont::class, 'sea_imp_ent_id');
    }
}
