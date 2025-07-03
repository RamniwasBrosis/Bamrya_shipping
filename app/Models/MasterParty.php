<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterParty extends Model
{
    use HasFactory;

    protected $fillable = [
        'party_name',
        'party_type',
        'status',
    ];
}
