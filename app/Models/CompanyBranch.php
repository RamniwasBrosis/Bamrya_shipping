<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyBranch extends Model
{
    use HasFactory;

    protected $fillable = ['company_id', 'branch_code', 'branch_name', 'status'];
    
    public function company()
    {
        return $this->beLongsTo(Company::class);
    }
}
