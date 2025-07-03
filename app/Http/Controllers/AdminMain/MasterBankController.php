<?php

namespace App\Http\Controllers\AdminMain;

use App\Http\Controllers\Controller;
use App\Models\MasterBank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MasterBankController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = MasterBank::query();

        if($request->filled('beneficiary_name')){
            $query->where('beneficiary_name', 'LIKE', '%'.$request->beneficiary_name.'%');
        }
        if($request->filled('account_no')){
            $query->orWhere('account_no', 'LIKE', '%'.$request->account_no.'%');
        }
      
        $banks = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin-main.admin.bank.index', compact('banks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
        return view('admin-main.admin.bank.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'bank_name' => 'required',
            'beneficiary_name' => 'required',
            'branch_name' => 'required',
            'account_no' => 'required',
            'ifsc_code' => 'required',
            'account_type' => 'required|in:Current Account,Saving Account',
        ]);

        $bank = new MasterBank();

        $bank->company_id = Auth::user()->company_id;
        $bank->uuid = Str::uuid();
        $bank->bank_name = $request->bank_name;
        $bank->beneficiary_name = $request->beneficiary_name;
        $bank->branch_name = $request->branch_name;
        $bank->account_no = $request->account_no;
        $bank->ifsc_code = $request->ifsc_code;
        $bank->account_type = $request->account_type;

        $bank->swift_code = $request->swift_code;
        $bank->gstin_no_company = $request->gstin_no;
        $bank->company_pan = $request->company_pan;
        $bank->company_name = $request->company_name;

        $bank->branch_company_address1 = $request->address1;
        $bank->branch_company_address2 = $request->address2;
        $bank->branch_company_address3 = $request->address3;
        $bank->contact_no = $request->contact_no;

        $bank->notes1 = $request->notes1;
        $bank->notes2 = $request->notes2;
        $bank->notes3 = $request->notes3;
        $bank->notes4 = $request->notes4;
        $bank->notes5 = $request->notes5;
        $bank->notes6 = $request->notes6;
        $bank->notes7 = $request->notes7;
        $bank->notes8 = $request->notes8;
        $bank->notes9 = $request->notes9;
        $bank->notes10 = $request->notes10;

        $bank->save();

        return redirect()->route('banks.index')->with('success', 'Bank Master added successfully.');
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
    public function edit(string $id)
    {
        $bank  = MasterBank::findOrFail($id);
        return view('admin-main.admin.bank.edit', compact('bank'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $request->validate([
            'company_id' => 'required',
            'bank_name' => 'required',
            'beneficiary_name' => 'required',
            'branch_name' => 'required',
            'account_no' => 'required',
            'ifsc_code' => 'required',
            'account_type' => 'required|in:Current Account,Saving Account',
        ]);

        $bank  = MasterBank::findOrFail($id);
        
        $bank->company_id = $request->company_id;
        $bank->bank_name = $request->bank_name;
        $bank->beneficiary_name = $request->beneficiary_name;
        $bank->branch_name = $request->branch_name;
        $bank->account_no = $request->account_no;
        $bank->ifsc_code = $request->ifsc_code;
        $bank->account_type = $request->account_type;

        $bank->swift_code = $request->swift_code;
        $bank->gstin_no_company = $request->gstin_no;
        $bank->company_pan = $request->company_pan;
        $bank->company_name = $request->company_name;

        $bank->branch_company_address1 = $request->address1;
        $bank->branch_company_address2 = $request->address2;
        $bank->branch_company_address3 = $request->address3;
        $bank->contact_no = $request->contact_no;

        $bank->notes1 = $request->notes1;
        $bank->notes2 = $request->notes2;
        $bank->notes3 = $request->notes3;
        $bank->notes4 = $request->notes4;
        $bank->notes5 = $request->notes5;
        $bank->notes6 = $request->notes6;
        $bank->notes7 = $request->notes7;
        $bank->notes8 = $request->notes8;
        $bank->notes9 = $request->notes9;
        $bank->notes10 = $request->notes10;

        $bank->save();

        return redirect()->route('banks.index')->with('success', 'Bank Master updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bankMaster  = MasterBank::findOrFail($id);
        $bankMaster->delete();

        return response()->json(['status' => 'success', 'message' => 'Bank record deleted']);
    }
}
