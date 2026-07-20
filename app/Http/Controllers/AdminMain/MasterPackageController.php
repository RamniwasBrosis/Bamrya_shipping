<?php

namespace App\Http\Controllers\AdminMain;

use Illuminate\Http\Request;
use App\Models\MasterPackage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MasterPackageController extends Controller
{
    public $company_id ;

    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->company_id = Auth::user()->company_id;
            return $next($request);
        });
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $query = MasterPackage::query();
        if($request->filled('package_code')){
            $query->where('package_code', 'LIKE', '%'.$request->package_code.'%');
        }
        $packages = $query->where('company_id', $this->company_id)->orderBy('created_at', 'desc')->paginate(10);
        return view('admin-main.admin.package.index', compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin-main.admin.package.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userId = auth()->user()->id;
        $request->validate([
            'package_code' => 'required|max:255',
            'description' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        $package = new MasterPackage();

        $package->company_id = Auth::user()->company_id;
        $package->uuid = Str::uuid();
        $package->package_code = $request->package_code;
        $package->description = $request->description;
        $package->status = $request->status;
        $package->user_id = $userId;

        $package->save();

        return redirect()->route('packages.index')->with('success', 'Package created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $package = MasterPackage::findOrFail($id);
        return view('admin-main.admin.package.edit', compact('package'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $userId = auth()->user()->id;
        $package = MasterPackage::findOrFail($id);

        $request->validate([
            'package_code' => 'required|unique:master_packages,package_code,' . $package->id,
            'description' => 'nullable|string',
            'status' => 'required|boolean',
        ]);
        $package->user_id = $userId;

        $package->update($request->all());

        return redirect()->route('packages.index')->with('success', 'Package updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        MasterPackage::findOrFail($id)->delete();
        return response()->json(['status' => 'success', 'message' => 'Package deleted successfully.']);
    }
}
