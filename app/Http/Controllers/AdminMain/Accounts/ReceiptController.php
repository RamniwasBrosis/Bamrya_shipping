<?php

namespace App\Http\Controllers\AdminMain\Accounts;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\MasterImportParty;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Accounts\AccountReceipt;
use App\Models\Accounts\AccountReceiptPaymentDetail;
use App\Models\MasterParty;

class ReceiptController extends Controller
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
        $query = AccountReceipt::where('company_id', $this->company_id);

        $query->when($request->filled('billing_party_id'), function($q) use ($request){
            $q->where('billing_party_id', 'LIKE', $request->billing_party_id);
        });

        $query->when($request->filled('radio_type'), function($q) use ($request){
            $q->where('radio_type', 'LIKE', $request->radio_type);
        });

        if ($request->filled('form_date') && $request->filled('to_date')) {
            $query->whereBetween('receipt_date', [$request->form_date, $request->to_date]);
        }


        $receipt_lists = $query->orderBy('created_at', 'desc')->paginate(10);

        $parties = MasterImportParty::where('company_id', $this->company_id)->get();

        return view('admin-main.admin.receipt.index', compact('receipt_lists', 'parties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parties = MasterImportParty::where('company_id', $this->company_id)->get();
        $partyNames = MasterParty::all();
        return view('admin-main.admin.receipt.create', compact('parties', 'partyNames'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'neft_details' => 'nullable|string|max:255',
            'neft_date' => 'nullable|date',
            'bank_name' => 'nullable|string|max:255',
            'total_amount_received' => 'nullable|numeric|min:0',
            'received_from_party' => 'nullable|string|max:255',
            'billing_party_id' => 'required|exists:master_import_parties,id',
            'invoice_f_year' => 'required|string|max:9',
            'receipt_date' => 'required|date',
            'inv_type' => 'nullable',
            'inv_no' => 'nullable',
        ]);

        $receipt = new AccountReceipt();

        $receipt->company_id = $this->company_id;
        $receipt->uuid = Str::uuid();

        $receipt->billing_party_id = $request->billing_party_id ;  
        $receipt->invoice_f_year = $request->invoice_f_year ;  
        $receipt->receipt_date = $request->receipt_date ;  
        $receipt->radio_type = $request->radio_type ;

        if($request->radio_type == 'neft_cash'){

            $receipt->neft_details = $request->neft_details;
            $receipt->neft_date = $request->neft_date;
            $receipt->bank_name = $request->bank_name;
            $receipt->total_amount_received = $request->total_amount_received;
            $receipt->received_from_party = $request->received_from_party;

        }
        $receipt->save();

        return redirect()->back()->with('success', 'Entry Insert Successfully. !');


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
        $receipt = AccountReceipt::where('uuid', $uuid)->firstOrFail();
        $parties = MasterImportParty::where('company_id', $this->company_id)->get();

        return view('admin-main.admin.receipt.edit', compact('receipt', 'parties'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'billing_party_id'      => 'required|exists:master_import_parties,id',
            'invoice_f_year'        => 'required|in:2020-21,2021-22,2022-23,2023-24,2024-25,2025-26,2026-27,2027-28,2028-29,2029-30',
            'receipt_date'          => 'required|date',
            'radio_type'            => 'required|in:onaccount,neft_cash',
            'neft_details'          => 'nullable|string|max:255',
            'neft_date'             => 'nullable|date',
            'bank_name'             => 'nullable|string|max:255',
            'total_amount_received' => 'required|numeric|min:0',
            'received_from_party'   => 'required|string|max:255',
        ]);

        $receipt = AccountReceipt::findOrFail($id);

        $receipt->update($validated);

        return back()->with('success', 'Receipt details updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = AccountReceipt::findOrFail($id);
        $delete->delete();

        $delete_pay_details = AccountReceiptPaymentDetail::where('receipt_id', $id)->first();
        $delete_pay_details->delete();

        return response()->json(['success' => 'Receipt Deleted Successfully. !']);
    }

    public function paymentDetails(Request $request, $id){

        $validated = $request->validate([
            'inv_type'         => 'required|string|max:255',
            'inv_no'           => 'required|string|max:255',
            'payment_type'     => 'required|in:Full Payment,Part Payment',
            'percentage'       => 'nullable|in:0.00,2,5,1',
            'tds_amount'       => 'nullable|numeric|min:0',
            'received_amount'  => 'required|numeric|min:0',
            'actual_amount'    => 'nullable|numeric|min:0',
        ]);

        $validated['company_id'] = $this->company_id;
        $validated['uuid'] = Str::uuid();
        $validated['receipt_id'] = $id;

        $pay_details = AccountReceiptPaymentDetail::where('receipt_id', $id)->first();
        if($pay_details){

            $pay_details->update($validated);
            return back()->with('success', 'Payment details updated successfully.');

        }else{
            AccountReceiptPaymentDetail::create($validated);
            return back()->with('success', 'Payment details saved successfully.');
        }     
    }
}
