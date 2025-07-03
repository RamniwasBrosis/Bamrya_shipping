<?php

namespace App\Models\Operations;

use App\Models\MasterImportParty;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationAirExport extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_no', 'full_job_no', 'booking_no', 'booking_date',
        'mawb_no', 'hawb_no', 'eta_date', 'etd_date',
        'enquiry_reference_no', 'flight_name_1', 'flight_date_1', 'flight_number_1',
        'flight_name_2', 'flight_date_2', 'flight_number_2',
        'gross_weight', 'chargable_weight', 'tare_weight',
        'issue_place', 'movement', 'iata_agent', 'package_qty',
        'package_id', 'customer_acc_no', 'issue_date', 'sales_person_id',

        'shipper_id','consignee_id','lata_agent','overSeas_agent','loading_port_id','discharge_port_id',
        'receipt_port_id','delivery_port_id','insurance','fpa_amount','transportation',
        'transportation_details','clearance','shipping_bill', 'company_id', 'uuid',

        'file_path', 'file_name', 'dimention', 'handling_information', 'goods_description', 'mark_number'
    ];

    public function salesPerson(){
        return $this->belongsTo(MasterImportParty::class, 'sales_person_id');
    }
}
