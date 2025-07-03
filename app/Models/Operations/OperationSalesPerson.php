<?php

namespace App\Models\Operations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationSalesPerson extends Model
{
    use HasFactory;
    
   protected $fillable = [
        'name', 'email', 'number', 'designation', 'company_id'
    ];
}
