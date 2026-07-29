<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyBranch extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function company()
    {
        return $this->beLongsTo(Company::class);
    }
}
