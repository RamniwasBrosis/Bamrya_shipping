<?php

namespace App\Http\Controllers\AdminMain;

use Illuminate\Http\Request;
use App\Models\MasterContainerSize;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MasterContainerSizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = MasterContainerSize::query();

        if($request->filled('cont_type')){
            $query->where('cont_type', 'LIKE', '%'.$request->cont_type.'%');
        }
        if($request->filled('iso_code')){
            $query->orWhere('iso_code', 'LIKE', '%'.$request->iso_code.'%');
        }
      
        $containerSizes = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin-main.admin.containersize.index', compact('containerSizes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin-main.admin.containersize.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'cont_type' => 'required|max:200',
            'description' => 'nullable|max:200',
            'iso_code' => 'nullable|max:50',
            'status' => 'required|boolean',
        ]);

        $containerSize = new MasterContainerSize();

        $containerSize->company_id = Auth::user()->company_id;
        $containerSize->uuid = Str::uuid();
        $containerSize->cont_type = $request->cont_type;
        $containerSize->description = $request->description;
        $containerSize->iso_code = $request->iso_code;
        $containerSize->status = $request->status;

        $containerSize->save();

        return redirect()->route('container-sizes.index')->with('success', 'Container size added.');
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
        $containerSize = MasterContainerSize::findOrFail($id);
        return view('admin-main.admin.containersize.edit', compact('containerSize'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validation = $request->validate([
            'cont_type' => 'required|max:200',
            'description' => 'nullable|max:200',
            'iso_code' => 'nullable|max:50',
            'status' => 'required|boolean',
        ]);

        $size = MasterContainerSize::findOrFail($id);
        $size->update($validation);

        return redirect()->route('container-sizes.index')->with('success', 'Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $containerSize  = MasterContainerSize::findOrFail($id);
        $containerSize->delete();

        return response()->json(['status' => 'success', 'message' => 'container size delete successfull']);
    }
}
