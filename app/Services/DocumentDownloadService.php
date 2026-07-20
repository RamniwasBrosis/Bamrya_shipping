<?php

namespace App\Services;

use App\Models\DocumentDownload;
use App\Models\DocumentDownloadRule;
use Illuminate\Support\Facades\Auth;

class DocumentDownloadService
{
    /**
     * Check whether the current user can download the document.
     */
    public function canDownload(
        int $jobNo,
        string $module,
        string $documentType,
        string $copyType
    ): array {

        /*
        |--------------------------------------------------------------------------
        | Super Admin
        |--------------------------------------------------------------------------
        */

        if (Auth::user()->hasRole('super-admin')) {

            return [
                'status' => true,
                'message' => 'Unlimited download.'
            ];
        }

        /*
        |--------------------------------------------------------------------------
        | Find Rule
        |--------------------------------------------------------------------------
        */

        $rule = DocumentDownloadRule::where([
            'company_id'    => Auth::user()->company_id,
            'module'        => $module,
            'document_type' => $documentType,
            'copy_type'     => $copyType,
            'is_active'     => true
        ])->first();

        /*
        |--------------------------------------------------------------------------
        | Rule Not Found
        |--------------------------------------------------------------------------
        */

        if (!$rule) {

            return [
                'status' => true,
                'message' => 'No restriction.'
            ];
        }

        /*
        |--------------------------------------------------------------------------
        | Unlimited
        |--------------------------------------------------------------------------
        */

        if (is_null($rule->max_download)) {

            return [
                'status' => true,
                'message' => 'Unlimited download.'
            ];
        }

        /*
        |--------------------------------------------------------------------------
        | Existing Count
        |--------------------------------------------------------------------------
        */

        $download = DocumentDownload::where([
            'company_id'    => Auth::user()->company_id,
            'job_no'        => $jobNo,
            'module'        => $module,
            'document_type' => $documentType,
            'copy_type'     => $copyType
        ])->first();

        $count = $download?->download_count ?? 0;

        if ($count >= $rule->max_download) {

            return [
                'status' => false,
                'message' => "Maximum {$rule->max_download} downloads reached."
            ];
        }

        return [
            'status' => true,
            'message' => 'Allowed.'
        ];
    }

    /**
     * Record download
     */
    public function recordDownload(
        int $jobNo,
        string $module,
        string $documentType,
        string $copyType
    ): void {

        DocumentDownload::updateOrCreate(

            [
                'company_id'    => Auth::user()->company_id,
                'job_no'        => $jobNo,
                'module'        => $module,
                'document_type' => $documentType,
                'copy_type'     => $copyType,
            ],

            [
                'download_count' => \DB::raw('download_count + 1'),
                'last_downloaded_by' => Auth::id(),
                'last_downloaded_at' => now(),
            ]

        );
    }

    /**
     * Remaining Downloads
     */
    public function remainingDownloads(
        int $jobNo,
        string $module,
        string $documentType,
        string $copyType
    ): int|null {

        $rule = DocumentDownloadRule::where([
            'company_id'=>Auth::user()->company_id,
            'module'=>$module,
            'document_type'=>$documentType,
            'copy_type'=>$copyType
        ])->first();

        if (!$rule || is_null($rule->max_download)) {
            return null;
        }

        $download = DocumentDownload::where([
            'company_id'=>Auth::user()->company_id,
            'job_no'=>$jobNo,
            'module'=>$module,
            'document_type'=>$documentType,
            'copy_type'=>$copyType
        ])->first();

        $count = $download?->download_count ?? 0;

        return max(0, $rule->max_download - $count);
    }
}