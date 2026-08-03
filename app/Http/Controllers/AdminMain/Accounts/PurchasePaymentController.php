<?php

namespace App\Http\Controllers\AdminMain\Accounts;

use App\Models\MasterParty;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\MasterImportParty;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Accounts\AccountPurchasePayment;
use App\Models\Accounts\AccountPurchasePaymentDetail;

class PurchasePaymentController extends Controller
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
        $query = AccountPurchasePayment::where('company_id', $this->company_id);

        $query->when($request->filled('billing_party_id'), function($q) use ($request){
            $q->where('billing_party_id', 'LIKE', $request->billing_party_id);
        });

        $query->when($request->filled('radio_type'), function($q) use ($request){
            $q->where('radio_type', 'LIKE', $request->radio_type);
        });

        if ($request->filled('form_date') && $request->filled('to_date')) {
            $query->whereBetween('receipt_date', [$request->form_date, $request->to_date]);
        }


        $purchase_payments = $query->orderBy('created_at', 'desc')->paginate(10);

        $parties = MasterImportParty::where('company_id', $this->company_id)->get();

        return view('admin-main.admin.purchasePayment.index', compact('purchase_payments', 'parties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parties = MasterImportParty::where('company_id', $this->company_id)->get();
        $party_lists = MasterParty::all();
        return view('admin-main.admin.purchasePayment.create', compact('parties', 'party_lists'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'billing_party_id' => 'required|exists:master_import_parties,id',
            'purchase_date'     => 'required|date',
            'invoice_type'     => 'required|string|max:50',
            'invoice_no'       => 'required|string|max:255',
            'amount'           => 'required|numeric|min:0',
        ]);

        $purchase = new AccountPurchasePayment();
        $purchase->company_id = $this->company_id;
        $purchase->user_id = $this->user_id;
        $purchase->branch_id = Auth::user()->branch_id;
        $purchase->uuid = Str::uuid();

        $purchase->billing_party_id = $request->billing_party_id;
        $purchase->purchase_date = $request->purchase_date; // fixed: matches form name
        $purchase->invoice_type = $request->invoice_type;
        $purchase->invoice_no = $request->invoice_no;
        $purchase->amount = $request->amount;
        $purchase->save();

        return response()->json([
            'success' => true,
            'message' => 'Purchase payment added successfully!'
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
        $purchase_payment = AccountPurchasePayment::where('uuid', $uuid)->firstOrFail();
        $parties = MasterImportParty::where('company_id', $this->company_id)->get();
        $party_lists = MasterParty::all();
        $purchase_payment_detail = AccountPurchasePaymentDetail::where('purchase_id', $purchase_payment->id)->first();

        return view('admin-main.admin.purchasePayment.edit', compact('purchase_payment', 'parties', 'purchase_payment_detail', 'party_lists'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'billing_party_id' => 'required|exists:master_import_parties,id',
            'purchase_date'    => 'required|date',
            'invoice_type'     => 'required|string|max:50',
            'invoice_no'       => 'required|string|max:255',
            'amount'           => 'required|numeric|min:0',
        ]);
        $validated['user_id'] = $this->user_id;
        $validated['branch_id'] = Auth::user()->branch_id;

        $purchasePayment = AccountPurchasePayment::findOrFail($id);
        $purchasePayment->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Purchase details updated successfully!',
        ]);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $delete = AccountPurchasePayment::findOrFail($id);
        $delete->delete();

        return redirect()->route('purchase-payment.index')->with('success', 'Purchase Payment deleted successfully!');
    }


    public function paymentDetails(Request $request, $id){

        $validated = $request->validate([
            'inv_type'         => 'required|string|max:255',
            'inv_no'           => 'required|string|max:255',
            'payment_type'     => 'required|in:Full Payment,Part Payment',
            'percentage'       => 'nullable',
            'tds_amount'       => 'nullable|numeric|min:0',
            'payment_amount'  => 'required|numeric|min:0',
            'actual_amount'    => 'nullable|numeric|min:0',
        ]);

        $validated['company_id'] = $this->company_id;
        $validated['uuid'] = Str::uuid();
        $validated['purchase_id'] = $id;

        $pay_details = AccountPurchasePaymentDetail::where('purchase_id', $id)->first();
        if($pay_details){

            $pay_details->update($validated);
            return back()->with('success', 'Payment details updated successfully.');

        }else{
            AccountPurchasePaymentDetail::create($validated);
            return back()->with('success', 'Payment details saved successfully.');
        }
    }
}
