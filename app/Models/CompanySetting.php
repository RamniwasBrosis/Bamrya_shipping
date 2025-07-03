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
        'icegate_no',
        'branches',
        'carn_no',
        'mlo_code',
        'jnpt_code',
        'gti_code',
        'nsict_code',
        'nsgit_code',
        'status',
    ];
    
    public function company()
    {
        return $this->beLongsTo(Company::class);
    }
}
