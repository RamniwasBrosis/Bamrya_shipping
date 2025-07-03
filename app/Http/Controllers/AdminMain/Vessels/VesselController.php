<?php

namespace App\Http\Controllers\AdminMain\Vessels;

use App\Models\MasterVessel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class VesselController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = MasterVessel::query();

        if ($request->filled('vessel_name')) {
            $query->where('vessel_name', 'like', '%' . $request->vessel_name . '%');
        }

        if ($request->filled('call_sign')) {
            $query->where('call_sign', 'like', '%' . $request->call_sign . '%');
        }

        $vesselDatas = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin-main.admin.vessels.index', compact('vesselDatas'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin-main.admin.vessels.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'vessel_name' => 'required|string|max:255',
            'call_sign' => 'nullable|string|max:255',
            'imo_code' => 'nullable|string|max:255',
            'status' => 'required|in:1,0,2',
        ]);

        $vessel = new MasterVessel();

        $vessel->company_id = Auth::user()->company_id;
        $vessel->uuid = Str::uuid();
        $vessel->vessel_name = $request->vessel_name;
        $vessel->call_sign = $request->call_sign;
        $vessel->imo_code = $request->imo_code;
        $vessel->status = $request->status;

        $vessel->save();

        // return response()->json(['status' => 'success', 'message' => 'Vessel created successfully']);
        return redirect()->route('vessels.index')->with('success', 'Vessel create successfully.');
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
        if(!$id){
            return "Record not found";
        }
        $editVessel = MasterVessel::findOrFail($id);
        return view('admin-main.admin.vessels.edit', compact('editVessel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'vessel_name' => 'required|string|max:255',
            'call_sign' => 'nullable|string|max:255',
            'imo_code' => 'nullable|string|max:255',
            'vessel_status' => 'required|in:0,1,2',
        ]);

        $vessel = MasterVessel::findOrFail($id);

        $vessel->update([
            'vessel_name' => $validated['vessel_name'],
            'call_sign' => $validated['call_sign'],
            'imo_code' => $validated['imo_code'],
            'status' => $validated['vessel_status'],
        ]);

        return redirect()->route('vessels.index')->with('success', 'Vessel updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vessel = MasterVessel::findOrFail($id);
        $vessel->delete();

        return response()->json(['status' => 'success', 'message' => 'Vessel deleted successfully.']);
    }
}
