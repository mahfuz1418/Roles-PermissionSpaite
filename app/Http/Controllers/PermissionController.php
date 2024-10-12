<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::latest()->paginate(10);
        return view('permission.index', compact('permissions'));
    }

    public function create()
    {
        return view('permission.create');
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => 'required',
        // ]);
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:permissions',
        ]);

        if ($validator->passes()) {
            Permission::create([
                'name' => $request->name,
            ]);
            return redirect()->route('permission.index')->with('success', 'Permission created successfully');
        } else {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        return view('permission.edit', compact('permission'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:permissions',
        ]);

        if ($validator->passes()) {
            Permission::findOrFail($request->edit_id)->update([
                'name' => $request->name,
            ]);
            return redirect()->route('permission.index')->with('success', 'Permission Updated successfully');
        } else {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    public function delete($id)
    {
        Permission::findOrFail($id)->delete();
        return redirect()->route('permission.index')->with('success', 'Permission deleted successfully');
    }


}
