<?php

namespace App\Http\Controllers\AdminMain\Operations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Operations\OperationAllFileUpload;
use App\Models\Accounts\AccountFileUpload;
use Illuminate\Support\Facades\Validator;

class CommanMultiFilesUploadController extends Controller
{
    public $company_id ;

    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->company_id = Auth::user()->company_id;
            return $next($request);
        });
    }
   
    //changed by mourya
    public function updateFileUpload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file_related' => 'required|string',
            'file' => 'required|array',
            'file.*' => [
                'required',
                'mimes:pdf,xls,xlsx,doc,docx,jpg,jpeg,png',
                'max:10240',
                function ($attribute, $value, $fail) {
                    $fileName = $value->getClientOriginalName();
                    // if (OperationAllFileUpload::where('file_name', $fileName)->exists()) {
                    //     $fail("The file '{$fileName}' has already been uploaded.");
                    // }
                }
            ],
            'job_no' => 'nullable|integer', // base rule
        ], [
            'file.required' => 'Please choose at least one file to upload.',
            'file.*.mimes' => 'Only PDF, Excel, Word, JPG, and PNG files are allowed.',
            'job_no.required' => 'Job number is required for this file type.',
        ]);
    
        // Conditionally require job_no
        if (in_array($request->file_related, ['air_export', 'air_import', 'sea_export', 'sea_import'])) {
            $validator->sometimes('job_no', 'required|integer', function ($input) {
                return true; // apply rule
            });
        }
    
        $validated = $validator->validate();
    
        // File upload process (same as before)
        foreach ($request->file('file') as $file) {
            $paths = [
                'air_export' => 'uploads/airExports',
                'air_import' => 'uploads/airImports',
                'sea_export' => 'uploads/seaExports',
                'sea_import' => 'uploads/seaImports',
                'transport' => 'uploads/transport',
                'booking' => 'uploads/booking',
                'sea_import_data_ent' => 'uploads/SeaImportDataEntry',
                'exort_bl_data_ent' => 'uploads/ExportBl',
            ];
    
            $path = $paths[$request->file_related] ?? null;
            if (!$path) {
                return back()->with('error', 'Invalid file category.');
            }
    
            $storedPath = $file->store($path, 'public');
    
            $file_upload = new OperationAllFileUpload();
            $file_upload->company_id = $this->company_id;
            $file_upload->uuid = Str::uuid();
            $file_upload->file_name = $file->getClientOriginalName();
            $file_upload->file_path = $storedPath;
            $file_upload->file_type = $file->getClientOriginalExtension();
            $file_upload->file_related = $request->file_related;
            $file_upload->job_no = $validated['job_no'] ?? null;
            $file_upload->save();
        }
    
        return back()->with('success', 'File uploaded successfully.');
    }



    public function searchFile(Request $request)
    {        
        $request->validate([
            'search_query' => 'required'
        ]);

        $file = OperationAllFileUpload::find($request->search_query);
       
        $html = '
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>File ID</th>
                        <th>File Name</th>
                        <th>Download PDF</th>
                        <th>Remove PDF</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>' . $file->id . '</td>
                        <td>' . $file->file_name . '</td>
                        <td><a href="' . route('multi-file-upload.downloadFile', $file->id) . '" target="_blank" class="text-success">Download</a></td>
                        <td id="delete_td">
                            <button class="btn btn-sm btn-danger" onclick="clearSearchFile()">×</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>';
        return response($html);
    }
    
    // public function searchFile(Request $request)
    // {
    //     $request->validate([
    //         'search_query' => 'required'
    //     ]);
    
    //     $file = OperationAllFileUpload::find($request->search_query);
    
    //     if (!$file) {
    //         return response('<p class="text-danger">No file found.</p>', 404);
    //     }
    
    //     // Initialize variables
    //     $jobNo = null;
    //     $fileRelated = $file->file_related;
    
    //     // Check for supported file types
    //     if (in_array($fileRelated, ['air_export', 'air_import', 'sea_export', 'sea_import'])) {
    //         switch ($fileRelated) {
    //             case 'air_export':
    //                 $jobNo = optional($file->airExport)->job_no;
    //                 break;
    //             case 'air_import':
    //                 $jobNo = optional($file->airImport)->job_no;
    //                 break;
    //             case 'sea_export':
    //                 $jobNo = optional($file->seaExport)->job_no;
    //                 break;
    //             case 'sea_import':
    //                 $jobNo = optional($file->seaImport)->job_no;
    //                 break;
    //         }
    //     } else {
    //         // If not related to import/export, just show file_related label
    //         $jobNo = strtoupper(str_replace('_', ' ', $fileRelated)); // e.g. "OTHER FILE"
    //     }
    
    //     // Fallback if job not found
    //     $jobNo = $jobNo ?? 'N/A';
    
    //     // Generate HTML response
    //     $html = '
    //     <div class="table-responsive">
    //         <table class="table table-bordered">
    //             <thead>
    //                 <tr>
    //                     <th>File ID</th>
    //                     <th>File Name</th>
    //                     <th>' . (in_array($fileRelated, ['air_export', 'air_import', 'sea_export', 'sea_import']) ? 'Related Job No' : 'File Related') . '</th>
    //                     <th>Download PDF</th>
    //                     <th>Remove PDF</th>
    //                 </tr>
    //             </thead>
    //             <tbody>
    //                 <tr>
    //                     <td>' . e($file->id) . '</td>
    //                     <td>' . e($file->file_name) . '</td>
    //                     <td>' . e($jobNo) . '</td>
    //                     <td><a href="' . route('multi-file-upload.downloadFile', $file->id) . '" target="_blank" class="text-success">Download</a></td>
    //                     <td id="delete_td">
    //                         <button class="btn btn-sm btn-danger" onclick="clearSearchFile()">×</button>
    //                     </td>
    //                 </tr>
    //             </tbody>
    //         </table>
    //     </div>';
    
    //     return response($html);
    // }




    public function downloadFile($id)
    {
        $file = OperationAllFileUpload::findOrFail($id);

        $filePath = 'public/' . $file->file_path;
        $fileName = $file->file_name;

        if (Storage::exists($filePath)) {
            return Storage::download($filePath, $fileName);
        }

        return back()->with('error', 'File not found.');
    }
    
    public function destroy($id){
        try {
            $file = OperationAllFileUpload::findOrFail($id);
    
            if ($file->file_path && Storage::exists($file->file_path)) {
                Storage::delete($file->file_path);
            }
    
            $file->delete();
    
            return response()->json(['message' => 'File deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Delete failed',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    
    // public function filesForJob($job, $fileRelated)
    // {
    //     // Skip job filtering for booking/transport
    //     if (in_array($fileRelated, ['booking', 'transport'])) {
    //         $files = OperationAllFileUpload::with('jobMasterFile')
    //                     ->where('file_related', $fileRelated)
    //                     ->get();
    //     } else {
    //         $files = OperationAllFileUpload::with('jobMasterFile')
    //                     ->where('job_no', $job)
    //                     ->where('file_related', $fileRelated)
    //                     ->get();
    //     }
    
    //     // Optional: map data for frontend
    //     $files = $files->map(function($file) {
    //         return [
    //             'id' => $file->id,
    //             'file_name' => $file->file_name,
    //             'job_no' => optional($file->jobMasterFile)->job_no ?? null,
    //         ];
    //     });
    
    //     return response()->json($files);
    // }
    
    public function accountUpdateFileUpload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required',
            'file.*' => 'file|mimes:pdf,doc,docx,xls,xlsx|max:10240',
            'file_related' => 'required|string|in:sales_invoice,purchase_invoice,proforma_invoice',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }
    
        $fileRelated = $request->file_related;
        $invoiceId = $request->input("{$fileRelated}_id"); 
    
        if (!$invoiceId) {
            return response()->json([
                'success' => false,
                'message' => "Invoice ID ({$fileRelated}_id) missing"
            ], 400);
        }
    
        $uploadedFiles = [];
    
        if ($request->hasFile('file')) {
    
            foreach ($request->file('file') as $file) {
    
                $fileName = time() . '_' . Str::slug($file->getClientOriginalName());
                $filePath = $file->storeAs('uploads/account_files', $fileName, 'public');
    
                $uploadedFiles[] = AccountFileUpload::create([
                    'company_id' => $this->company_id,
                    'uuid' => Str::uuid(),
                    'file_name' => $fileName,
                    'file_path' => $filePath,
                    'file_type' => $file->getClientOriginalExtension(),
                    'file_related' => $fileRelated,
                    "{$fileRelated}_id" => $invoiceId,
                ]);
            }
        }
    
        return response()->json([
            'success' => true,
            'files' => $uploadedFiles,
            'message' => 'Files uploaded successfully.'
        ]);
    }



}
