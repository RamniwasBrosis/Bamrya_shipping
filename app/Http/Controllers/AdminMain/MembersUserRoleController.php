<?php

namespace App\Http\Controllers\AdminMain;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MembersUserRoleController extends Controller
{
    public function index()
    {

       $roles = Role::with('permissions')
        ->whereNotIn('name', ['super-admin'])
        ->paginate(10);
        return view('admin-main.admin.userrole.index', compact('roles'));
    }

    public function create()
    {

        $allPermissions = Permission::all();
        $allRoles = Role::all();

        return view('admin-main.admin.userrole.create', compact('allPermissions', 'allRoles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'nullable|array',
        ]);

        $role = Role::create(['name' => $request->name]);

        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        }

        return redirect()->back()->with('success', 'Role created successfully!');
    }
    

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();

        return view('admin-main.admin.userrole.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,'.$id,
            'permissions' => 'nullable|array',
        ]);

        $role = Role::findOrFail($id);

        $role->name = $request->name;

        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        }

        $role->save();

        return response()->json(['success' => true, 'message' => 'Role updated successfully.']);
         
    }

    public function destroy($id){
        $role = Role::findOrFail($id);
        $role->delete();

        return response()->json(['success' => true, 'message' => 'Role deleted successfully']);
    }


}
