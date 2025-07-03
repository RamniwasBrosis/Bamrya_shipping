<?php

namespace App\Http\Controllers\AdminMain;

use Illuminate\Http\Request;
use App\Models\MasterShipping;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MasterShippingController extends Controller
{
    public function index(Request $request)
    {
        $query = MasterShipping::query();

        if ($request->filled('shipping_line_code')) {
            $query->where('shipping_line_code', 'like', '%' . $request->shipping_line_code . '%');
        }

        if ($request->filled('shipping_line_name')) {
            $query->where('shipping_line_name', 'like', '%' . $request->shipping_line_name . '%');
        }

        if ($request->filled('shipping_line_type')) {
            $query->where('shipping_line_type', 'like', '%' . $request->shipping_line_type . '%');
        }

        $MasterShippings = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin-main.admin.shipping.index', compact('MasterShippings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin-main.admin.shipping.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'shipping_line_code' => 'required|string|max:10',
            'shipping_line_name' => 'required|string|max:100',
            'address_line_1'     => 'required|string|max:100',
            'address_line_2'     => 'nullable|string|max:100',
            'agent_code'         => 'nullable|string|max:10',
            'line_code'          => 'nullable|string|max:10',
            'shipping_line_type' => 'required|in:1,2', // 1: Indian, 2: Overseas
            'status'             => 'required|in:1,0',
        ]);

        $shipping = new MasterShipping();

        $shipping->company_id =  Auth::user()->company_id;
        $shipping->uuid = Str::uuid();
        $shipping->shipping_line_code = $request->shipping_line_code;
        $shipping->shipping_line_name = $request->shipping_line_name;
        $shipping->address_line_1 = $request->address_line_1;
        $shipping->address_line_2 = $request->address_line_2;
        $shipping->agent_code = $request->agent_code;
        $shipping->line_code = $request->line_code;
        $shipping->shipping_line_type = $request->shipping_line_type;
        $shipping->status = $request->status;

        $shipping->save();

        return redirect()->route('shippings.index')->with('success', 'Shipping Line added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $MasterShipping = MasterShipping::findOrFail($id);

        return view('admin-main.admin.shipping.edit', compact('MasterShipping'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'company_id' => 'required',
            'shipping_line_code' => 'required|string|max:10',
            'shipping_line_name' => 'required|string|max:100',
            'address_line_1'     => 'required|string|max:100',
            'address_line_2'     => 'nullable|string|max:100',
            'agent_code'         => 'nullable|string|max:10',
            'line_code'          => 'nullable|string|max:10',
            'shipping_line_type' => 'required|in:1,2',
            'status'             => 'required|in:1,0',
        ]);
        
        $MasterShipping = MasterShipping::findOrFail($id);

        $MasterShipping->company_id = $validated['company_id'];
        $MasterShipping->shipping_line_code = $validated['shipping_line_code'];
        $MasterShipping->shipping_line_name = $validated['shipping_line_name'];
        $MasterShipping->address_line_1 = $validated['address_line_1'];
        $MasterShipping->address_line_2 = $validated['address_line_2'];
        $MasterShipping->agent_code = $validated['agent_code'];
        $MasterShipping->line_code = $validated['line_code'];
        $MasterShipping->shipping_line_type = $validated['shipping_line_type'];
        $MasterShipping->status = $validated['status'];

        $MasterShipping->save();

        return redirect()->route('shippings.index')->with('success', 'Shipping Line updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $MasterShipping = MasterShipping::findOrFail($id);
        $MasterShipping->delete();

        return response()->json(['status' => 'success', 'message' => 'Shipping Line deleted successfully.']);
    }
}
