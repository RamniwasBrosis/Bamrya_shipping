<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterContainerSize extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'cont_type',
        'description',
        'iso_code',
        'status',
    ];
}
