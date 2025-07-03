<?php

namespace App\Models\Operations;

use App\Models\MasterVessel;
use App\Models\MasterParty;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id','uuid', 'booking_no', 'vessel_id', 'voy_no', 'eta_date', 'entry_date',
        'validity_days', 'validity_date', 'cargo_type', 'shipment_terms',
        'gate_open', 'container_volume', 'plugging', 'do_cancel',
        'cargo_wt', 'cont_wt', 'ventilation', 'temperature', 'commodity',
        'package', 'humidity', 'special_eq_remarks', 'class', 'sub_class',
        'shipper_id', 'sales_person_id', 'empty_yard_id', 'surveyor_id',
        'shipping_line_id', 'port_loading_id', 'port_discharge_id',
        'port_transhipment_id', 'port_destination_id',
        'imo_cd', 'uno_cd', 'cancel_remark', 'special_remark', 'full_do_no',

        'cont_category', 'container_no', 'size', 'customer_seal_no', 'cont_do_no',

        'uploaded_file_path',
    ];

    public function vessel(){
        return $this->belongsTo(MasterVessel::class, 'vessel_id');
    }
    
    public function party(){
        return $this->belongsTo(MasterParty::class, 'sales_person_id ');
    }
    
}
