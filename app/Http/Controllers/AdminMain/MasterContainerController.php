<?php

namespace App\Http\Controllers\AdminMain;

use Illuminate\Http\Request;
use App\Models\MasterContainer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MasterContainerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = MasterContainer::query();

        if($request->filled('container_no')){
            $query->where('container_no', 'LIKE', '%'.$request->container_no.'%');
        }
        if($request->filled('size')){
            $query->where('size', 'LIKE', '%'.$request->size.'%');
        }
        if($request->filled('category')){
            $query->where('category', 'LIKE', '%'.$request->category.'%');
        }
        $containers = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin-main.admin.container.index', compact('containers'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin-main.admin.container.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'container_no' => 'required|string|max:200',
            'size' => 'nullable|string|max:200',
            'category' => 'nullable|string|max:255',
            'status' => 'required|boolean',
        ]);

        $container = new MasterContainer();

        $container->company_id  = Auth::user()->company_id;
        $container->uuid = Str::uuid();
        $container->container_no  = $request->container_no;
        $container->size  = $request->size;
        $container->category  = $request->category;
        $container->status  = $request->status;

        $container->save();

        return redirect()->route('containers.index')->with('success', 'Container added successfully.');
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
        $container = MasterContainer::findOrFail($id);
        return view('admin-main.admin.container.edit', compact('container'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validation = $request->validate([
            'company_id' => 'required',
            'container_no' => 'required|string|max:200',
            'size' => 'nullable|string|max:200',
            'category' => 'nullable|string|max:255',
            'status' => 'required|boolean',
        ]);

        $container = MasterContainer::findOrFail($id);
        $container->update($validation);

        return redirect()->route('containers.index')->with('success', 'Container updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $container = MasterContainer::findOrFail($id);
        $container->delete();

        return response()->json(['status' => 'success', 'message' => 'container record delete successfull']);
    }
}
