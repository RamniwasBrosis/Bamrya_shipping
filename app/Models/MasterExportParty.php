<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Operations\OperationSeaExport;
use App\Models\User;

class MasterExportParty extends Model
{
    use HasFactory;
    
    protected $casts = [
        'document' => 'array',
    ];

    protected $fillable = [
        'uuid',
        'company_id',
        'party_code',
        'party_name',
        'address_line1',
        'address_line2',
        'address_line3',
        'city',
        'pincode',
        'party_type',
        'contact_person',
        'tel_no',
        'email',
        'gstin',
        'pan_no',
        'cin_no',
        'credit_days',
        'tds_percent',
        'party_mode',
        'document',
        'status','user_id'
    ];
    
    public function shipperName()
    {
        return $this->hasMany(OperationSeaExport::class, 'shipper_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by', 'id');
    }
}
