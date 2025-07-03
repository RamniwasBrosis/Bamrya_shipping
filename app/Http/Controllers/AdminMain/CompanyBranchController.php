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
        $query = CompanyBranch::query();

        if ($request->filled('branch_code')) {
            $query->where('branch_code', 'like',  $request->branch_code );
        }

        if ($request->filled('branch_name')) {
            $query->orWhere('branch_name', 'like', $request->branch_name );
        }

        $branches = $query->orderBy('created_at', 'desc')->paginate(10);

        $branchCodes = CompanyBranch::orderBy('branch_code')->get();
        $branchNames = CompanyBranch::orderBy('branch_name')->get();

        return view('admin-main.admin.branch.index', compact('branches', 'branchCodes', 'branchNames'));
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
            'branch_code' => 'required|unique:company_branches,branch_code',
            'branch_name' => 'required',
            'status' => 'required|boolean',
        ]);

        $branch = new CompanyBranch();

        $branch->company_id = Auth::user()->company_id;
        $branch->branch_code = $request->branch_code;
        $branch->branch_name = $request->branch_name;
        $branch->status = $request->status;

        $branch->save();

        return response()->json(['success' => 'Branch record created successfull']);

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
    public function edit(string $id)
    {
        $branch = CompanyBranch::findOrFail($id);

        return view('admin-main.admin.branch.edit', compact('branch'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'branch_code' => [
                'required',
                Rule::unique('company_branches', 'branch_code')->ignore($id),
            ],
            'branch_name' => 'required',
            'status' => 'required|boolean',
        ]);


        $branch = CompanyBranch::findOrFail($id);

        $branch->branch_code = $request->branch_code;
        $branch->branch_name = $request->branch_name;
        $branch->status = $request->status;

        $branch->save();

        return response()->json(['success' => 'Branch record updated successfull']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $branch = CompanyBranch::findOrFail($id);
        $branch->delete();

        return response()->json(['success' => 'Branch record deleted successfull']);
    }
}
