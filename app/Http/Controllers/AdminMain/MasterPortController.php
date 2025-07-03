<?php

namespace App\Http\Controllers\AdminMain;

use App\Models\MasterPort;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MasterPortController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = MasterPort::query();

        if ($request->filled('port_code')) {
            $query->where('port_code', 'like', '%' . $request->port_code . '%');
        }

        if ($request->filled('port_name')) {
            $query->where('port_name', 'like', '%' . $request->port_name . '%');
        }

        if ($request->filled('edi_code')) {
            $query->where('edi_code', 'like', '%' . $request->edi_code . '%');
        }

        if ($request->filled('jnpt_code ')) {
            $query->where('jnpt_code ', 'like', '%' . $request->jnpt_code  . '%');
        }

        if ($request->filled('nsict_code')) {
            $query->where('nsict_code', 'like', '%' . $request->nsict_code . '%');
        }

        if ($request->filled('gti_code')) {
            $query->where('gti_code', 'like', '%' . $request->gti_code . '%');
        }

        $ports = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin-main.admin.ports.index', compact('ports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin-main.admin.ports.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {        
        $validated = $request->validate([
            'port_code' => 'required|string|max:255',
            'port_name' => 'required|string|max:255',

            'edi_code' => 'nullable|string|max:255',
            'jnpt_code' => 'nullable|string|max:255',
            'nsict_code' => 'nullable|string|max:255',

            'nsict_group_code' => 'nullable|string|max:255',
            'gti_code' => 'nullable|string|max:255',
            'gti_group_code' => 'nullable|string|max:255',
            'nsi_gt_code' => 'nullable|string|max:255',

            'status' => 'required|in:1,0',
        ]);

        $port = new MasterPort();
        $port->company_id = Auth::user()->company_id;
        $port->uuid = Str::uuid();
        $port->port_code = $request->port_code;
        $port->port_name = $request->port_name;
        $port->edi_code = $request->edi_code;
        $port->jnpt_code = $request->jnpt_code;
        $port->nsict_code = $request->nsict_code;
        $port->nsict_group_code = $request->nsict_group_code;
        $port->gti_code = $request->gti_code;
        $port->gti_group_code = $request->gti_group_code;
        $port->nsi_gt_code = $request->nsi_gt_code;
        $port->status = $request->status;

        $port->save();       

        return redirect()->route('ports.index')->with('success', 'Port entry create successfully.');
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
        if(!$id){
            return "Record not found";
        }

        $port  = MasterPort::findOrFail($id);

        return view('admin-main.admin.ports.edit', compact('port'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'port_code' => 'required|string|max:255',
            'port_name' => 'required|string|max:255',

            'edi_code' => 'nullable|string|max:255',
            'jnpt_code' => 'nullable|string|max:255',
            'nsict_code' => 'nullable|string|max:255',

            'nsict_group_code' => 'nullable|string|max:255',
            'gti_code' => 'nullable|string|max:255',
            'gti_group_code' => 'nullable|string|max:255',
            'nsi_gt_code' => 'nullable|string|max:255',

            'status' => 'required|in:1,0',
        ]);

        $port = MasterPort::findOrFail($id);

        $port->port_code = $request->port_code;
        $port->port_name = $request->port_name;
        $port->edi_code = $request->edi_code;
        $port->jnpt_code = $request->jnpt_code;
        $port->nsict_code = $request->nsict_code;
        $port->nsict_group_code = $request->nsict_group_code;
        $port->gti_code = $request->gti_code;
        $port->gti_group_code = $request->gti_group_code;
        $port->nsi_gt_code = $request->nsi_gt_code;
        $port->status = $request->status;

        $port->save(); 


        return redirect()->route('ports.index')->with('success', 'Port details updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vessel = MasterPort::findOrFail($id);
        $vessel->delete();

        return response()->json(['status' => 'success', 'message' => 'Port Record deleted successfully.']);
    }
}
