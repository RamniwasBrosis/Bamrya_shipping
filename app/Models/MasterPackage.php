<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterPackage extends Model
{
    use HasFactory;

    protected $fillable = ['company_id','package_code', 'description', 'status', 'uuid'];
}
