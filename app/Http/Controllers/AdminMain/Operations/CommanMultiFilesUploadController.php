<?php

namespace App\Http\Controllers\AdminMain\Operations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Operations\OperationAllFileUpload;

class CommanMultiFilesUploadController extends Controller
{
    public $company_id ;

    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->company_id = Auth::user()->company_id;
            return $next($request);
        });
    }
    public function updateFileUpload(Request $request)
    {
        $request->validate([
            'file' => 'required|array',
            'file.*' => 'file|mimes:pdf,xls,xlsx,doc,docx,jpg,jpeg,png',
        ], [
            'file.required' => 'Please choose at least one file to upload.',
            'file.*.mimes' => 'Only PDF, Excel, Word, JPG, and PNG files are allowed.',
        ]);

        $file_related = $request->file_related;
        
        foreach ($request->file('file') as $file) {
            $path = null;
            switch ($file_related) {
                case 'air_export':
                    $path = $file->store('uploads/airExports', 'public');
                    break;
                case 'air_import':
                    $path = $file->store('uploads/airImports', 'public');
                    break;
                case 'sea_export':
                    $path = $file->store('uploads/seaExports', 'public');
                    break;
                case 'sea_import':
                    $path = $file->store('uploads/seaImports', 'public');
                    break;
                case 'transport':
                    $path = $file->store('uploads/transport', 'public');
                    break;
                case 'booking':
                    $path = $file->store('uploads/booking', 'public');
                    break;
                case 'sea_import_data_ent':
                    $path = $file->store('uploads/SeaImportDataEntry', 'public');
                    break;
                case 'exort_bl_data_ent':
                    $path = $file->store('uploads/ExportBl', 'public');
                    break;
                default:
                    return back()->with('error', 'Invalid file category.');
            }
    
            $originalName = $file->getClientOriginalName();
            $file_type = $file->getClientOriginalExtension();
    
            $file_upload = new OperationAllFileUpload();
            $file_upload->company_id = $this->company_id;
            $file_upload->uuid = Str::uuid();
            $file_upload->file_name = $originalName;
            $file_upload->file_path = $path;
            $file_upload->file_type = $file_type;
            $file_upload->file_related = $file_related;
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
}
