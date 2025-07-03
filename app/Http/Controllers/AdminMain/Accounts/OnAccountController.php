<?php

namespace App\Http\Controllers\AdminMain\Accounts;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\MasterImportParty;
use App\Http\Controllers\Controller;
use App\Models\Accounts\AccountOnAccount;
use Illuminate\Support\Facades\Auth;

class OnAccountController extends Controller
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
        $parties = MasterImportParty::where('company_id', $this->company_id)->get();
        $query = AccountOnAccount::where('company_id', $this->company_id);

        if($request->filled('party_id')){
            $query->where('party_id', 'LIKE', $request->party_id);
        }

        $on_accounts = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('admin-main.admin.onAccount.index', compact('on_accounts', 'parties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parties = MasterImportParty::where('company_id', $this->company_id)->get();
        return view('admin-main.admin.onAccount.create', compact('parties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'sales_date' => 'required|date',
            'party_id' => 'required|integer',
            'amount' => 'required|integer',
            'balance_amout' => 'nullable|integer',
        ]);

        $validation['company_id'] = $this->company_id;
        $validation['uuid'] = Str::uuid();

        AccountOnAccount::create($validation);

        return redirect()->back()->with('success', 'OnAccount Data created successfull. !');
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
    public function edit(string $uuid)
    {
        $on_account = AccountOnAccount::where('uuid', $uuid)->firstOrFail();

        $parties = MasterImportParty::where('company_id', $this->company_id)->get();
        return view('admin-main.admin.onAccount.edit', compact('parties', 'on_account'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $update_account = AccountOnAccount::findOrFail($id);

        $validation = $request->validate([
            'sales_date' => 'required|date',
            'party_id' => 'required|integer',
            'amount' => 'required',
            'balance_amout' => 'nullable',
        ]);

        $update_account->update($validation);

        return redirect()->back()->with('success', 'OnAccount Data Updated successfull. !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = AccountOnAccount::find($id);
        $delete->delete();

        return response()->json(['success', 'On Account Record deleted Successfully. !']);
    }
}
