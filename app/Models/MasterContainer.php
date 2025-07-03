<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterContainer extends Model
{
    use HasFactory;



    protected $fillable = [
        'company_id',
        'container_no',
        'size',
        'category',
        'status',
    ];
}
