<?php

namespace App\Http\Controllers\AdminMain\Accounts;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\MasterImportParty;
use App\Models\MasterBank;
use App\Http\Controllers\Controller;
use App\Models\Accounts\AccountOnAccount;
use App\Models\Accounts\AccountSaleInvoice;
use App\Models\Accounts\AccountSaleInvoiceContainer;
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
        $parties = MasterImportParty::where('company_id', $this->company_id)->where('party_type', 10)->get();
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
        $parties = MasterImportParty::where('company_id', $this->company_id)->where('party_type', 10)->get();
        $bankDetails = MasterBank::where('company_id', $this->company_id)->get();
        return view('admin-main.admin.onAccount.create', compact(['parties', 'bankDetails']));
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
            'round_of_amount' => 'nullable|numeric',
            'bank_id' => 'required|integer',
        ]);

        $validation['company_id'] = $this->company_id;
        $validation['uuid'] = Str::uuid();

        $data = AccountOnAccount::create($validation);
        
        $billingPartyId = $data->party_id;
        $received_amount = $data->amount;
        
        $invoices = AccountSaleInvoice::with('chargesContainer')
         ->where('company_id', $this->company_id)
        ->where('billing_party_id', $billingPartyId)
        ->where(function($q) {
            $q->whereNull('invoice_amount_status')
              ->orWhere('invoice_amount_status', 'Pending');
        })
        ->orderBy('created_at', 'asc')
        ->get();
      
        foreach ($invoices as $invoice) {
          
            $total = $invoice->chargesContainer->sum('total');
            $outstanding = $invoice->outstanding_amount ? $invoice->outstanding_amount : $total;
            if ($received_amount <= 0) {
                break;
            }
            
            if ($received_amount >= $outstanding) {
                // full settle
                $received_amount =  $received_amount - $outstanding;
        
                $invoice->invoice_amount = round($total);
                $invoice->recieved_amount = round($total);
                $invoice->outstanding_amount = 0;
                $invoice->invoice_amount_status = 'Completed';
            } else {
                // partial settle
                $invoice->recieved_amount = ($total - $outstanding) + $received_amount;
                $invoice->outstanding_amount = $outstanding - $received_amount;
                $invoice->invoice_amount = $total;
                $invoice->invoice_amount_status = 'Pending';
                
                if($data->round_of_amount){
                    $invoice->outstanding_amount = 0;
                    $invoice->invoice_amount_status = 'Completed';
                }

                $received_amount = 0;
            }
            $invoice->save();
        }
        
        return redirect()->route('on-accounts.index')->with('success', 'OnAccount Data created successfull. !');
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
        $bankDetails = MasterBank::where('company_id', $this->company_id)->get();

        $parties = MasterImportParty::where('company_id', $this->company_id)->where('party_type', 10)->get();
        return view('admin-main.admin.onAccount.edit', compact('parties', 'on_account', 'bankDetails'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $update_account = AccountOnAccount::find($id);
        $old_amount = $update_account->amount;
        $already_round_of_amt_exist = $update_account->round_of_amount;
        
        $validation = $request->validate([
            'sales_date' => 'required|date',
            'party_id' => 'required|integer',
            'amount' => 'required|numeric',
            'round_of_amount' => 'nullable|numeric',
            'bank_id' => 'required|integer',
        ]);
        
        $update_account->update($validation);
        $billingPartyId = $update_account->party_id;
        
        /**
         * CASE 1: If only round_of_amount is edited
         */
        if (!empty($request->round_of_amount) && empty($already_round_of_amt_exist)) {
            $invoice = AccountSaleInvoice::with('chargesContainer')
                ->where('company_id', $this->company_id)
                ->where('billing_party_id', $billingPartyId)
                ->where('invoice_amount_status', 'Pending')
                ->where('outstanding_amount', '>', 0)
                ->orderBy('created_at', 'desc')
                ->first();
    
            if ($invoice) {
                $invoice->outstanding_amount = 0;
                $invoice->invoice_amount_status = 'Completed';
                $invoice->save();
            }
        }
        /**
         * CASE 2: If updated amount > old amount → distribute difference to invoices
         */
        if ($request->amount > $old_amount) {
            $received_amount = $request->amount - $old_amount;
    
            $invoices = AccountSaleInvoice::with('chargesContainer')
                ->where('company_id', $this->company_id)
                ->where('billing_party_id', $billingPartyId)
                ->where(function ($q) {
                    $q->whereNull('invoice_amount_status')
                      ->orWhere('invoice_amount_status', 'Pending');
                })
                ->orderBy('created_at', 'asc')
                ->get();
    
            foreach ($invoices as $invoice) {
                // Get invoice total from charges or use existing
                $total = $invoice->chargesContainer->sum('total') ?: $invoice->invoice_amount;
                $outstanding = $invoice->outstanding_amount ?: $total;
    
                if ($received_amount <= 0) {
                    break;
                }
    
                if ($received_amount >= $outstanding) {
                    // Full settlement
                    $received_amount -= $outstanding;
    
                    $invoice->invoice_amount = $total;
                    $invoice->recieved_amount = $total;
                    $invoice->outstanding_amount = 0;
                    $invoice->invoice_amount_status = 'Completed';
                } else {
                    // Partial settlement
                    $invoice->invoice_amount = $total;
                    $invoice->recieved_amount = ($total - $outstanding) + $received_amount;
                    $invoice->outstanding_amount = $outstanding - $received_amount;
                    $invoice->invoice_amount_status = 'Pending';
    
                    $received_amount = 0;
                }
    
                $invoice->save();
            }
    
            return redirect()->back()->with('success', 'OnAccount and invoices updated successfully (received amount allocated).');
        }
        
        /**
         * CASE 3: If updated amount < old amount → distribute difference to invoices
         */
        if ($request->amount < $old_amount) {
            $reverse_amount = $old_amount - $request->amount;
        
            $invoices = AccountSaleInvoice::with('chargesContainer')
                ->where('company_id', $this->company_id)
                ->where('billing_party_id', $billingPartyId)
                ->where('recieved_amount', '>', 0)
                ->orderBy('created_at', 'desc') // latest invoice first
                ->get();
        
            foreach ($invoices as $invoice) {
                if ($reverse_amount <= 0) {
                    break;
                }
        
                $total = $invoice->chargesContainer->sum('total') ?: $invoice->invoice_amount;
                $received = $invoice->recieved_amount;
                $outstanding = $invoice->outstanding_amount;
        
                if ($reverse_amount >= $received) {
                    // Full reversal of this invoice
                    $reverse_amount -= $received;
                    $invoice->invoice_amount = 0;
                    $invoice->recieved_amount = 0;
                    $invoice->outstanding_amount = 0;
                    $invoice->invoice_amount_status = 'Pending';
                } else {
                    // Partial reversal
                    $invoice->recieved_amount = $received - $reverse_amount;
                    $invoice->outstanding_amount = $outstanding + $reverse_amount;
                    // $invoice->outstanding_amount =  $reverse_amount;
                    $invoice->invoice_amount_status = 'Pending';
                    $reverse_amount = 0;
                }
        
                $invoice->save();
            }
        
            return redirect()->back()->with('success', 'OnAccount and invoice amounts reversed successfully (amount reduced).');
        }

        
        return redirect()->back()->with('success', 'OnAccount Data Updated successfull. !');
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(string $id)
    // {
    //     $delete = AccountOnAccount::find($id);
    //     $delete->delete();

    //     return response()->json(['success', 'On Account Record deleted Successfully. !']);
    // }
    
    
    public function destroy(string $id)
    {
        $onAccount = AccountOnAccount::findOrFail($id);
        $billingPartyId = $onAccount->party_id;
        $deleteAmount = $onAccount->amount;
    
        $onAccount->delete();
    
        $invoices = AccountSaleInvoice::with('chargesContainer')
            ->where('billing_party_id', $billingPartyId)
            ->where(function($q) {
                $q->where('recieved_amount', '>', 0)
                  ->orWhere('invoice_amount_status', 'Completed')
                  ->orWhere('outstanding_amount', '<', \DB::raw('invoice_amount'));
            })
            ->orderBy('created_at', 'desc') // latest first (reverse adjustment)
            ->get();
    
        $reverseAmount = $deleteAmount;
    
        foreach ($invoices as $invoice) {
            if ($reverseAmount <= 0) {
                break;
            }
    
            $total = $invoice->chargesContainer->sum('total') ?: $invoice->invoice_amount;
            $received = $invoice->recieved_amount ?? 0;
            $outstanding = $invoice->outstanding_amount ?? $total;
    
            if ($received > 0) {
                if ($reverseAmount >= $received) {
                    // Full reversal for this invoice
                    $reverseAmount -= $received;
                    $invoice->recieved_amount = 0;
                    $invoice->outstanding_amount = 0;
                    $invoice->invoice_amount_status = 'Pending';
                } else {
                    // Partial reversal
                    $invoice->recieved_amount = $received - $reverseAmount;
                    $invoice->outstanding_amount = $total - ($received - $reverseAmount);
                    $invoice->invoice_amount_status = 'Pending';
                    $reverseAmount = 0;
                }
                $invoice->save();
            }
        }
    
        return redirect()->back()->with('success', 'OnAccount entry deleted and invoice amounts reversed successfully!');
    }

}
