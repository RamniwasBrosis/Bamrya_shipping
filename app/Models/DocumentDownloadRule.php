<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DocumentDownloadRule extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'module',
        'document_type',
        'copy_type',
        'max_download',
        'is_active',
    ];
}