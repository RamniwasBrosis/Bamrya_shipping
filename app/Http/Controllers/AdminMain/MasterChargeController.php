<?php

namespace App\Http\Controllers\AdminMain;

use App\Models\MasterCharge;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MasterChargeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = MasterCharge::query();

        if($request->filled('charge_code')){
            $query->where('charge_code', 'LIKE', '%'.$request->charge_code.'%');
        }

        if($request->filled('charge_name')){
            $query->where('charge_name', 'LIKE', '%'.$request->charge_name.'%');
        }

        if($request->filled('limit')){
            $query->where('limit', 'LIKE', '%'.$request->limit.'%');
        }

        if($request->filled('percentage')){
            $query->where('percentage', 'LIKE', '%'.$request->percentage.'%');
        }

        if($request->filled('charge_type')){
            $query->where('charge_type', 'LIKE', '%'.$request->charge_type.'%');
        }

        if($request->filled('has_formula')){
            $query->where('has_formula', 'LIKE', '%'.$request->has_formula.'%');
        }

        if($request->filled('gst_applicable')){
            $query->where('gst_applicable', 'LIKE', '%'.$request->gst_applicable.'%');
        }

        if($request->filled('currency')){
            $query->where('currency', 'LIKE', '%'.$request->currency.'%');
        }
        
        $charges = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin-main.admin.charges.index', compact('charges'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin-main.admin.charges.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validated = $request->validate([
            'charge_code' => 'required',
            'charge_name' => 'required',
            'tally_ledger_name' => 'required',
            'currency' => 'required',
            'charge_type' => 'required',
            'gst_applicable' => 'required|boolean',
            'gst_percentage' => 'required|integer',
            'has_formula' => 'required|boolean',
            'limit' => 'nullable|numeric',
            'percentage' => 'nullable|numeric',
            'sac_code' => 'required',
            'status' => 'required|boolean',
        ]);

        $charge = new MasterCharge();

        $charge->company_id = Auth::user()->company_id;
        $charge->uuid = Str::uuid();
        $charge->charge_code = $request->charge_code;
        $charge->charge_name = $request->charge_name;
        $charge->tally_ledger_name = $request->tally_ledger_name;
        $charge->currency = $request->currency;
        $charge->charge_type = $request->charge_type;
        $charge->gst_applicable = $request->gst_applicable;
        $charge->gst_percentage = $request->gst_percentage;
        $charge->has_formula = $request->has_formula;
        $charge->limit = $request->limit;
        $charge->percentage = $request->percentage;
        $charge->sac_code = $request->sac_code;
        $charge->status = $request->status;

        $charge->save();
        
        return redirect()->route('charges.index')->with('success', 'Charge created successfully.');
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
        $charge = MasterCharge::findOrFail($id);
        return view('admin-main.admin.charges.edit', compact('charge'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $charge = MasterCharge::findOrFail($id);
        $validated = $request->validate([
            'company_id' => 'required',
            'charge_code' => 'required',
            'charge_name' => 'required',
            'tally_ledger_name' => 'required',
            'currency' => 'required',
            'charge_type' => 'required',
            'gst_applicable' => 'required|boolean',
            'gst_percentage' => 'required|integer',
            'has_formula' => 'required|boolean',
            'limit' => 'nullable|numeric',
            'percentage' => 'nullable|numeric',
            'sac_code' => 'required',
            'status' => 'required|boolean',
        ]);

        $charge->update($validated);
        return redirect()->route('charges.index')->with('success', 'Charge updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $charge = MasterCharge::findOrFail($id);
        $charge->delete();
        return response()->json(['status' => 'success', 'message' => 'delete successfull']);
    }
}
