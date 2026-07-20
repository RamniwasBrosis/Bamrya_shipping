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
            $this->user_id = auth()->user()->id;
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
        $party_lists = MasterParty::all();
        return view('admin-main.admin.receipt.create', compact('parties', 'party_lists'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'billing_party_id'      => 'required|exists:master_import_parties,id',
            'receipt_date'          => 'required|date',
            'invoice_type'          => 'required|string|max:50',
            'invoice_no'            => 'required|string|max:255',
            'amount'                => 'required|numeric|min:0',
        ]);
    
        $receipt = new AccountReceipt();
    
        $receipt->company_id = $this->company_id;
        $receipt->user_id = $this->user_id;
        $receipt->uuid = Str::uuid();
    
        $receipt->billing_party_id = $validated['billing_party_id'];
        $receipt->receipt_date = $validated['receipt_date'];
        $receipt->invoice_type = $validated['invoice_type'];
        $receipt->invoice_no = $request->invoice_no;
        $receipt->amount = $validated['amount']; // matching DB column
    
        $receipt->save();
    
        return response()->json([
            'success' => true,
            'message' => 'Receipt entry stored successfully!',
        ]);
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
        $party_lists = MasterParty::all();

        return view('admin-main.admin.receipt.edit', compact('receipt', 'parties', 'party_lists'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'billing_party_id'      => 'required|exists:master_import_parties,id',
            'receipt_date'          => 'required|date',
            'invoice_type'          => 'required|string|max:50',
            'invoice_no'            => 'required|string|max:255',
            'amount'                => 'required|numeric|min:0',
        ]);
        $validated['user_id'] = $this->user_id;
        $receipt = AccountReceipt::findOrFail($id);
        $receipt->update($validated);
    
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Receipt details updated successfully.',
                'data' => $receipt,
            ]);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(string $id)
    // {
    //     $receipt = AccountReceipt::findOrFail($id);
    
    //     // Delete related payment details if exist
    //     $paymentDetail = AccountReceiptPaymentDetail::where('receipt_id', $id)->first();
    //     if ($paymentDetail) {
    //         $paymentDetail->delete();
    //     }
    
    //     $receipt->delete();
    
    //     return response()->json(['success' => 'Receipt deleted successfully!']);
    // }
    
    public function destroy($id)
    {
        $receipt = AccountReceipt::findOrFail($id);
        $receipt->delete();
    
        return redirect()->route('receipts.index')->with('success', 'Receipt deleted successfully.');
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
