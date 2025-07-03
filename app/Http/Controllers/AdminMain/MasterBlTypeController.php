<?php

namespace App\Http\Controllers\AdminMain;

use App\Models\MasterBlType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MasterBlTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = MasterBlType::query();

        if($request->filled('bl_description')){
            $query->where('bl_description', 'LIKE', '%'.$request->bl_description.'%');
        }
              
        $blTypes = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin-main.admin.bltype.index', compact('blTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin-main.admin.bltype.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'bl_description' => 'required|max:200',
            'status' => 'required|boolean',
        ]);

        $blType = new MasterBlType();

        $blType->company_id =  Auth::user()->company_id; 
        $blType->uuid = Str::uuid();
        $blType->bl_description =  $request->bl_description; 
        $blType->status =  $request->status; 

        $blType->save();
        
        return redirect()->route('bl-types.index')->with('success', 'Bl Type added.');
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
        $blType = MasterBlType::findOrFail($id);
        return view('admin-main.admin.bltype.edit', compact('blType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validation = $request->validate([
            'company_id' => 'required',
            'bl_description' => 'required|max:200',
            'status' => 'required|boolean',
        ]);

        $blType = MasterBlType::findOrFail($id);
        $blType->update($validation);

        return redirect()->route('bl-types.index')->with('success', 'Bl Type updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blType = MasterBlType::findOrFail($id);
        $blType->delete();

        return response()->json(['status' => 'success', 'message' => 'Bl type record deleted']);
    }
}
