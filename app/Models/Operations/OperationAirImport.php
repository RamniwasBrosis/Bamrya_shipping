<?php

namespace App\Models\Operations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationAirImport extends Model
{
    use HasFactory;

     protected $fillable = [
        'company_id', 'uuid',
        
        'mawb_no','mawb_date','flight_no','flight_date','igm_no',
        'igm_date','origin_port','dest_port', 'shipment','package',
        'weight','username','description','remark','full_job_no',
        'eta_date','etd_date',

        'job_no','hbl_no','hbl_date','hawb_package', 'hawb_shipment', 'hawb_dest_port', 'hawb_origin_port',
        'enquiry_reference_no','descriptions','hawb_weight',

        'freight','currency','exchange_rate','cc_perc','cc_currency',
        'cc_exch_rate','caf_perc','chg_weight',

        'consignee_id','shipper_id','billing_party_id','sales_person_id',

        'fpa_amount','bill_of_entry','insurance','transportation','transportation_details','clearance',

        'file_name', 'file_path',
    ];
}
