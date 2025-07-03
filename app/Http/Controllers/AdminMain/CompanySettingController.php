<?php

namespace App\Http\Controllers\AdminMain;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyBranch;
use App\Models\CompanySetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanySettingController extends Controller
{
    // public function index(Request $request)
    // {
    //     $query = CompanySetting::query();

    //     if ($request->filled('company_name')) {
    //         $query->where('company_name', 'like', '%' . $request->company_name . '%');
    //     }

    //     if ($request->filled('company_email')) {
    //         $query->orWhere('company_email', 'like', '%' . $request->company_email . '%');
    //     }

    //     if ($request->filled('reg_no')) {
    //         $query->orWhere('reg_no', 'like', '%' . $request->reg_no . '%');
    //     }

    //     $companies = $query->orderBy('created_at', 'desc')->paginate(10);

    //     $companyNameLists = CompanySetting::orderBy('company_name')->get();
    //     $companyEmailLists = CompanySetting::orderBy('company_email')->get();
    //     $reg_nos = CompanySetting::orderBy('reg_no')->get();

    //     return view('admin-main.admin.companysetting.index', compact('companies', 'companyNameLists', 'companyEmailLists', 'reg_nos'));
    // }

    // public function create()
    // {
    //     $company_id = Auth::user()->company_id;
    //     $branches = CompanyBranch::whereIn('company_id', $company_id)->get();
    //     return view('admin-main.admin.companysetting.create', compact('branches'));
    // }

  
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'company_name' => 'required|max:200',
    //         'company_email' => 'required|email|max:200',
    //         'reg_no' => 'required|max:50',
    //         'icegate_no' => 'required|max:50',
    //         // 'branch' => 'nullable|array',
    //         'branch' => 'nullable',
    //         'carn_no' => 'nullable|max:15',
    //         'mlo_code' => 'nullable|max:10',
    //         'jnpt_code' => 'nullable|max:5',
    //         'gti_code' => 'nullable|max:5',
    //         'nsict_code' => 'nullable|max:5',
    //         'nsgit_code' => 'nullable|max:5',
    //         'status' => 'required|boolean',
    //     ]);

    //     $companySetting  =  new CompanySetting();

    //     $companySetting->company_id = Auth::user()->company_id;

    //     $companySetting->company_name = $request->company_name;
    //     $companySetting->company_email = $request->company_email;
    //     $companySetting->reg_no = $request->reg_no;
    //     $companySetting->icegate_no = $request->icegate_no;
    //     $companySetting->branches = $request->branch;
    //     $companySetting->carn_no = $request->carn_no;
    //     $companySetting->mlo_code = $request->mlo_code;
    //     $companySetting->jnpt_code = $request->jnpt_code;
    //     $companySetting->gti_code = $request->gti_code;
    //     $companySetting->nsict_code = $request->nsict_code;
    //     $companySetting->nsgit_code = $request->nsgit_code;
    //     $companySetting->status = $request->status;

    //     $companySetting->save();

    //     return redirect()->route('company-settings.index')->with('success', 'Company created successfully.');
    // }

    // public function show(string $id)
    // {
    // }

    public function edit()
    {
        $id = Auth::user()->company_id;
        $company  = Company::findOrFail($id);

        $branches  = CompanyBranch::whereIn('company_id', [$id])->get();

        // $companySettings = CompanySetting::where('company_id', $id)->first();

        return view('admin-main.admin.companysetting.edit', compact('company', 'branches'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'company_name' => 'required|max:200',
            'company_email' => 'required|email|max:200',
            'address' => 'required',
            'company_phone' => 'required',
            'reg_no' => 'nullable|max:50',
            'icegate_no' => 'nullable|max:50',
            // 'branch' => 'nullable|array',
            'branch' => 'nullable',
            'carn_no' => 'nullable|max:15',
            'mlo_code' => 'nullable|max:10',
            'jnpt_code' => 'nullable|max:5',
            'gti_code' => 'nullable|max:5',
            'nsict_code' => 'nullable|max:5',
            'nsgit_code' => 'nullable|max:5',
            'status' => 'required|boolean',
        ]);

        $company = Company::findOrFail($id);
        $company->company_name = $request->company_name;
        $company->company_email = $request->company_email;
        $company->company_phone = $request->company_phone;
        $company->address = $request->address;
        $company->save();

        $companySetting = CompanySetting::where('company_id', $id)->first();

        if (!$companySetting) {
            $companySetting = new CompanySetting();
            $companySetting->company_id = $id;
        }

        $companySetting->reg_no = $request->reg_no;
        $companySetting->icegate_no = $request->icegate_no;
        $companySetting->branches = $request->branch;
        $companySetting->carn_no = $request->carn_no;
        $companySetting->mlo_code = $request->mlo_code;
        $companySetting->jnpt_code = $request->jnpt_code;
        $companySetting->gti_code = $request->gti_code;
        $companySetting->nsict_code = $request->nsict_code;
        $companySetting->nsgit_code = $request->nsgit_code;
        $companySetting->status = $request->status;

        $companySetting->save();

        return redirect()->route('company-settings.edit')->with('success', 'Company updated successfully.');
    }

    // public function destroy(string $id)
    // {
    //     $company = CompanySetting::findOrFail($id);
    //     $company->delete();

    //     return response()->json(['success' => 'company record deleted successfull']);
    // }
}
