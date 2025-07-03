<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterBlType extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'bl_description',
        'status',
    ];
}
