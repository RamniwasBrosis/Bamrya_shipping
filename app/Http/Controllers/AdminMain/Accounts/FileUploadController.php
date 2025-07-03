<?php

namespace App\Http\Controllers\AdminMain\Accounts;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Accounts\AccountFileUpload;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class FileUploadController extends Controller
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
            'file' => 'required|file|mimes:pdf,xls,xlsx,doc,docx',
        ], [
            'file.required' => 'Please choose a file to upload.',
            'file.mimes' => 'Only PDF, Excel, and Word files are allowed.',
        ]);

        $file = $request->file('file');
        $file_related = $request->file_related;
        $path = null;

        switch ($file_related) {
            case 'proforma_invoice':
                $path = $file->store('uploads/proformaInvoice', 'public');
                break;
            case 'purchase_invoice':
                $path = $file->store('uploads/purchaseInvoice', 'public');
                break;
            case 'sales_invoice':
                $path = $file->store('uploads/salesInvoice', 'public');
                break;
            default:
                return back()->with('error', 'Invalid file category.');
        }

        
        $originalName = $file->getClientOriginalName();
        $file_type  = $file->getClientOriginalExtension();
        $file_related = $request->file_related;

        $file_upload = new AccountFileUpload();

        $file_upload->company_id = $this->company_id;
        $file_upload->uuid = Str::uuid();
        $file_upload->file_name = $originalName;
        $file_upload->file_path = $path;
        $file_upload->file_type = $file_type;
        $file_upload->file_related = $file_related;

        $file_upload->save(); 
        return back()->with('success', 'File uploaded successfully.');
    }

    public function searchFile(Request $request)
    {  
        $request->validate([
            'search_query' => 'required'
        ]);

        $file = AccountFileUpload::find($request->search_query);
       
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
                        <td><a href="' . route('file-upload.downloadFile', $file->id) . '" target="_blank" class="text-success">Download</a></td>
                        <td>
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
        $file = AccountFileUpload::findOrFail($id);

        $filePath = 'public/' . $file->file_path;
        $fileName = $file->file_name;

        if (Storage::exists($filePath)) {
            return Storage::download($filePath, $fileName);
        }

        return back()->with('error', 'File not found.');
    }
}
