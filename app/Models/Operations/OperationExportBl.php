<?php

namespace App\Models\Operations;

use App\Models\MasterImportParty;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationExportBl extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'job_no','full_job_no','booking_no','booking_date','vessel_id','voyage_no',
        'mbl_no','hbl_no','enquiry_ref_no','quantity','package_type_id','freight','freight_charges','gross_wt',
        'net_wt','tare_wt','volume','movement','cargo_type','eta_date','etd_date','cbm',
        'sob_dt','port_cutoff','si_cutoff','document_cutoff','vgm_cutoff','remarks','overseas_agent_id','bl_type',
        'issue_place','no_of_origin','place_of_acceptance','sales_person_id','stuffing_point','cha_id','shipping_line_id',
        'forwarder_id','bl_issued_date','vgm_issued_date', 

        'shipper_id','consignee_id','notify_id','notify2_id','loading_port_id','discharge_port_id',
        'receipt_port_id','delivery_port_id','insurance','fpa_amount','transportation',
        'transportation_details','clearance','shipping_bill', 'company_id', 'uuid',
    ];

    public function shipper(){
        return $this->belongsTo(MasterImportParty::class, 'shipper_id');
    }
}
