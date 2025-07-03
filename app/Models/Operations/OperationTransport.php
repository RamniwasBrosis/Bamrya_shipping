<?php

namespace App\Models\Operations;

use App\Models\MasterImportParty;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationTransport extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id','uuid','job_no','full_job_no','from_party_id','cha_trans_id','from_place_id','to_place_id','booking_no','customer_inv_no',
        'booking_date','ccm_date','pickup_date','stuffing_date','gate_in_date','port_in_date',
        'sales_person_id','transporter_id','shipping_bill_no','description','quantity','package_id','gross_weight','remarks',
    
        'container_no','size','vehicle_no','lr_no','tare_weight',
        'cvc_plate','stuffing_point','customer_seal_no','agent_seal_no','net_weight',
        'cargo','transporter','container_job_no',

        'cont_gross_weight', 'cont_transporter_id',
    
    ];

    public function importParty(){
        return $this->belongsTo(MasterImportParty::class, 'from_party_id');
    }

}
