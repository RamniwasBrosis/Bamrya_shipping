<?php

namespace App\Http\Controllers\AdminMain\Operations;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Operations\OperationUploadedFile;

class UploadedFileController extends Controller
{
    public $company_id ;

    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->company_id = Auth::user()->company_id;
            return $next($request);
        });
    }
    
    public function index(Request $request)
    {
        $query = OperationUploadedFile::where('company_id', $this->company_id);

        $filters = OperationUploadedFile::where('company_id', $this->company_id)->orderBy('created_at', 'desc')->get();

        if($request->filled('file_name')){
            $query->where('file_name', 'LIKE', $request->file_name);
        }

        $files = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin-main.admin.fileDownload.index', compact('files', 'filters'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pdf_file' => 'required|mimes:pdf,xls,xlsx,doc,docx',
        ]);

        $file = $request->file('pdf_file');
        $filename = $file->getClientOriginalName();
        $path = $file->storeAs('uploads', $filename, 'public');

        OperationUploadedFile::create([
            'company_id' => $this->company_id,
            'uuid'  => Str::uuid(),
            'file_name' => $filename,
            'file_path' => $path,
        ]);

        return back()->with('success', 'File uploaded successfully!');
    }

    public function download($id)
    {
        $file = OperationUploadedFile::findOrFail($id);

        if (!Storage::disk('public')->exists($file->file_path)) {
            return back()->with('error', 'File not found on server.');
        }

        return Storage::disk('public')->download($file->file_path);
    }

    public function destroy($id)
    {
        $file = OperationUploadedFile::findOrFail($id);
        Storage::disk('public')->delete($file->file_path);
        $file->delete();
        return back()->with('success', 'File deleted successfully!');
    }
    

}
