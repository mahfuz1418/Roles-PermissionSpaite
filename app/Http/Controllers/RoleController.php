<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class RoleController extends Controller //implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view role', only: ['index']),
            new Middleware('permission:edit role', only: ['edit']),
            new Middleware('permission:update role', only: ['create']),
            new Middleware('permission:delete role', only: ['delete']),
        ];
    }

    public function index()
    {
        $roles = Role::latest()->paginate(10);
        return view('role.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('role.create', compact('permissions'));
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles',
        ]);

        if ($validator->passes()) {
            $role = Role::create([
                'name' => $request->name,
            ]);
            if (!empty($request->permission)) {
                foreach ($request->permission as $permission) {
                    $role->givePermissionTo($permission);
                }
            }
            return redirect()->route('role.index')->with('success', 'Role created successfully');
        } else {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $hasPermissions = $role->permissions->pluck('name');
        $permissions = Permission::get();
        return view('role.edit', [
            'role' => $role,
            'permissions' => $permissions,
            'hasPermissions' => $hasPermissions,
        ]);
    }

    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name,'.$request->id.',id',
        ]);
        $role = Role::findOrFail($request->id);
        if ($validator->passes()) {
            $role->update([
                'name' => $request->name,
            ]);

            if ($request->permissions) {
                $role->syncPermissions($request->permissions);
            } else {
                $role->syncPermissions([]);
            }
            return redirect()->route('role.index')->with('success', 'Roles Updated successfully');
        } else {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    public function delete($id)
    {
        Role::findOrFail($id)->delete();
        return response()->json([
            'success' => 'Roles Deleted Successfully',
        ]);
    }
}
