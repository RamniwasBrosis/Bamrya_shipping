<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Operations\OperationJobMaster;
use App\Models\Company;
use App\Models\User;

class DocumentDownload extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'job_no',
        'module',
        'document_type',
        'copy_type',
        'download_count',
        'last_downloaded_by',
        'last_downloaded_at',
    ];

    protected $casts = [
        'last_downloaded_at' => 'datetime',
    ];

    public function job()
    {
        return $this->belongsTo(OperationJobMaster::class, 'job_no');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function downloadedBy()
    {
        return $this->belongsTo(User::class, 'last_downloaded_by');
    }
}