<?php

namespace App\Http\Controllers\AdminMain;

use App\Models\MasterVessel;
use App\Models\MasterVoyage;

use Illuminate\Http\Request;
use App\Models\MasterShipping;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MasterVoyageController extends Controller
{
     public function index(Request $request)
    {
        $query = MasterVoyage::query();

        if ($request->filled('voyage_code')) {
            $query->where('voyage_code', 'like', '%' . $request->voyage_code . '%');
        }

        if ($request->filled('voyage_number')) {
            $query->where('voyage_number', 'like', '%' . $request->voyage_number . '%');
        }

        $MasterVoyages = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin-main.admin.voyage.index', compact('MasterVoyages'));
    }

    public function create()
    {
        $vessels = MasterVessel::all();
        $shippings = MasterShipping::all();

        return view('admin-main.admin.voyage.create', compact('vessels', 'shippings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'voyage_code' => 'required|string|max:10',
            'voyage_number' => 'required|string|max:10',
            'm_vessel_id' => 'nullable|exists:master_vessels,id',
            'arrival_date' => 'nullable|date',
            'igm_number' => 'nullable|string|max:10',
            'igm_date' => 'nullable|date',
            'shipping_line_id' => 'nullable|exists:master_shippings,id',
            'f_voyage_no' => 'nullable|string|max:255',
            'f_vessel_id' => 'nullable|exists:master_vessels,id',
            'mumbai_igm_no' => 'nullable|string|max:255',
            'mumbai_igm_date' => 'nullable|date',
            'overseas_agent_id' => 'nullable|integer',
            'status' => 'required|in:1,0',
        ]);

        $voyage = new MasterVoyage();

        $voyage->company_id =  Auth::user()->company_id;
        $voyage->uuid = Str::uuid();
        $voyage->voyage_code = $request->voyage_code;
        $voyage->voyage_number = $request->voyage_number;
        $voyage->m_vessel_id = $request->m_vessel_id;
        $voyage->arrival_date = $request->arrival_date;
        $voyage->igm_number = $request->igm_number;
        $voyage->igm_date = $request->igm_date;
        $voyage->shipping_line_id = $request->shipping_line_id;
        $voyage->f_voyage_no = $request->f_voyage_no;
        $voyage->f_vessel_id = $request->f_vessel_id;
        $voyage->mumbai_igm_no = $request->mumbai_igm_no;
        $voyage->mumbai_igm_date = $request->mumbai_igm_date;
        $voyage->overseas_agent_id = $request->overseas_agent_id;
        $voyage->status = $request->status;
        $voyage->save();

        return redirect()->route('voyages.index')->with('success', 'Voyage added successfully.');
    }

    public function edit(string $id)
    {
        $MasterVoyage = MasterVoyage::findOrFail($id);
        $vessels = MasterVessel::all();
        $shippings = MasterShipping::all();

        return view('admin-main.admin.voyage.edit', compact('MasterVoyage', 'vessels', 'shippings'));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'company_id' => 'required',
            'voyage_code' => 'required|string|max:10',
            'voyage_number' => 'required|string|max:10',
            'm_vessel_id' => 'nullable|exists:master_vessels,id',
            'arrival_date' => 'nullable|date',
            'igm_number' => 'nullable|string|max:10',
            'igm_date' => 'nullable|date',
            'shipping_line_id' => 'nullable|exists:master_shippings,id',
            'f_voyage_no' => 'nullable|string|max:255',
            'f_vessel_id' => 'nullable|exists:master_vessels,id',
            'mumbai_igm_no' => 'nullable|string|max:255',
            'mumbai_igm_date' => 'nullable|date',
            'overseas_agent_id' => 'nullable|integer',
            'status' => 'required|in:1,0',
        ]);

        $MasterVoyage = MasterVoyage::findOrFail($id);
        $MasterVoyage->update($validated);

        return redirect()->route('voyages.index')->with('success', 'Voyage updated successfully.');
    }

    public function destroy(string $id)
    {
        $MasterVoyage = MasterVoyage::findOrFail($id);
        $MasterVoyage->delete();

        return response()->json(['status' => 'success', 'message' => 'Voyage deleted successfully.']);
    }
}
