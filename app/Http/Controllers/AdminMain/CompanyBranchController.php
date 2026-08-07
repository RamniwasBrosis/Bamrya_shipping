<?php

namespace App\Http\Controllers\AdminMain;

use App\Http\Controllers\Controller;
use App\Models\CompanyBranch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CompanyBranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = CompanyBranch::where('company_id', Auth::user()->company_id);
        if ($request->filled('branch_code')) {
            $query->where('branch_code', 'like', "%{$request->branch_code}%");
        }
        if ($request->filled('branch_name')) {
            $query->where('branch_name', 'like', "%{$request->branch_name}%");
        }
        $branches = $query->latest()->paginate(10);
        $branchCodes = CompanyBranch::where('company_id', Auth::user()->company_id)
                        ->orderBy('branch_code')
                        ->get();
        $branchNames = CompanyBranch::where('company_id', Auth::user()->company_id)
                        ->orderBy('branch_name')
                        ->get();
        return view(
            'admin-main.admin.branch.index',
            compact('branches','branchCodes','branchNames')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin-main.admin.branch.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'branch_code' => [
                'required',
                Rule::unique('company_branches')
                    ->where(function ($query) {
                        return $query->where('company_id', Auth::user()->company_id);
                    }),
            ],

            'branch_name' => 'required|max:150',

            'address' => 'nullable',

            'city' => 'nullable|max:100',
            'state' => 'nullable|max:100',
            'country' => 'nullable|max:100',
            'pincode' => 'nullable|max:20',

            'phone' => 'nullable|max:20',
            'landline_phone' => 'nullable|max:20',
            'email' => 'nullable|email|max:150',

            'gstin_no' => 'nullable|max:50',
            'pan_no' => 'nullable|max:50',
            'tan_no' => 'nullable|max:50',
            'cin_no' => 'nullable|max:50',

            'manager_name' => 'nullable|max:150',

            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'status' => 'required|boolean',
            'seal_sign' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->except(['logo', 'seal_sign']);

        $data['company_id'] = Auth::user()->company_id;

        if ($request->hasFile('logo')) {
            $path = public_path('uploads/branch_logo');
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $file = $request->file('logo');
            $filename = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
            $file->move($path, $filename);
            $data['logo'] = $filename;
        }

        if ($request->hasFile('seal_sign')) {
            $path = public_path('uploads/branch_seal_sign');
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $file = $request->file('seal_sign');
            $filename = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
            $file->move($path, $filename);
            $data['seal_sign'] = $filename;
        }

        CompanyBranch::create($data);

        return response()->json([
            'success' => 'Branch created successfully.'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $branch = CompanyBranch::where('company_id', Auth::user()->company_id)
                    ->findOrFail($id);

        return view(
            'admin-main.admin.branch.edit',
            compact('branch')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $branch = CompanyBranch::where('company_id', Auth::user()->company_id)
                    ->findOrFail($id);
        $request->validate([
            'branch_code' => [
                'required',
                Rule::unique('company_branches')
                    ->where(function ($query) {
                        return $query->where('company_id', Auth::user()->company_id);
                    })
                    ->ignore($branch->id),
            ],
            'branch_name' => 'required|max:150',
            'address' => 'nullable',
            'city' => 'nullable|max:100',
            'state' => 'nullable|max:100',
            'country' => 'nullable|max:100',
            'pincode' => 'nullable|max:20',
            'phone' => 'nullable|max:20',
            'landline_phone' => 'nullable|max:20',
            'email' => 'nullable|email|max:150',
            'gstin_no' => 'nullable|max:50',
            'pan_no' => 'nullable|max:50',
            'tan_no' => 'nullable|max:50',
            'cin_no' => 'nullable|max:50',
            'manager_name' => 'nullable|max:150',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|boolean',
            'seal_sign' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->except(['logo', 'seal_sign']);
        if ($request->hasFile('logo')) {
            $path = public_path('uploads/branch_logo');
            if (!file_exists($path)) {
                mkdir($path,0777,true);
            }
            if ($branch->logo && file_exists($path.'/'.$branch->logo)) {
                unlink($path.'/'.$branch->logo);
            }
            $file = $request->file('logo');
            $filename = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
            $file->move($path,$filename);
            $data['logo'] = $filename;
        }
        if ($request->hasFile('seal_sign')) {
            $path = public_path('uploads/branch_seal_sign');
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            if ($branch->seal_sign && file_exists($path.'/'.$branch->seal_sign)) {
                unlink($path.'/'.$branch->seal_sign);
            }
            $file = $request->file('seal_sign');
            $filename = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
            $file->move($path, $filename);
            $data['seal_sign'] = $filename;
        }

        $branch->update($data);

        return response()->json([
            'success' => 'Branch updated successfully.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $branch = CompanyBranch::where('company_id', Auth::user()->company_id)
                    ->findOrFail($id);

        if ($branch->logo) {
            $path = public_path('uploads/branch_logo/'.$branch->logo);
            if (file_exists($path)) {
                unlink($path);
            }
        }
        if ($branch->seal_sign) {
            $path = public_path('uploads/branch_seal_sign/'.$branch->seal_sign);
            if (file_exists($path)) {
                unlink($path);
            }
        }

        $branch->delete();

        return response()->json([
            'success' => 'Branch deleted successfully.'
        ]);
    }
}
