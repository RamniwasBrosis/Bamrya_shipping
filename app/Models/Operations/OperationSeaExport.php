<?php

namespace App\Models\Operations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationSeaExport extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id', 'uuid', 'entry_by',
        'job_no', 'full_job_no', 'booking_no', 'booking_date', 'vessel_id', 'voyage_no',
        'mbl_no', 'hbl_no', 'enquiry_ref_no', 'quantity', 'package_id', 'freight',
        'freight_charges', 'gross_weight', 'net_weight', 'tare_weight', 'volume_unit',
        'movement', 'cargo_type', 'eta_date', 'etd_date', 'cbm', 'sob_date',
        'port_cutoff', 'si_cutoff', 'document_cutoff', 'vgm_cutoff', 'remarks',
        'overseas_agent_id', 'bl_type', 'issue_place', 'no_of_origin',
        'place_of_acceptance', 'sales_person_id', 'stuffing_point', 'cha_id',
        'shipping_line_id', 'forwarder_id', 'bl_issued_date', 'vgm_issued_date',
        

        'notify2_id', 'notify_id', 'consignee_id', 'shipper_id', 'delivery_port_id', 'receipt_port_id', 'discharge_port_id', 'loading_port_id',
        'shipping_bill', 'clearance', 'transportation_details', 'transportation', 'fpa_amount',
         'insurance', 'commodity', 'sbill_no', 'customer_inv_no', 'goods_description', 'mark_number',
    ];

    public function container(){
        return $this->hasOne(OperationSeaExportCont::class, 'sea_export_id');
    }

}
