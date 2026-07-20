<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanySetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'company_name',
        'company_email',
        'reg_no',
        'pan_no',
        'branches',
        'gstin_no',
        'cin_no',
        'tan_no',
        'phone',
        'email',
        'nsgit_code',
        'status',
        'fax_no','land_line_ph'
    ];
    
    public function company()
    {
        return $this->beLongsTo(Company::class);
    }
}
