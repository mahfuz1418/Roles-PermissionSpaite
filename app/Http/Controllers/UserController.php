<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view user', only: ['index']),
            new Middleware('permission:view user', only: ['create']),
            new Middleware('permission:edit user', only: ['edit']),
            new Middleware('permission:view user', only: ['delete']),
        ];
    }
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('user.index', compact('users'));
    }

    public function create()
    {
        // $users = User::all();
        $roles = Role::all();
        return view('user.create', [
            'roles' => $roles
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ]);
        if ($validator->passes()) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            $user->syncRoles($request->roles);
            return redirect()->route('user.index')->with('success', 'User Created successfully');
        } else {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        $hasRoles = $user->roles->pluck('id');
        return view('user.edit', [
            'user' => $user,
            'roles' => $roles,
            'hasRoles' => $hasRoles,
        ]);
    }

    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$request->id.',id',
        ]);
        if ($validator->passes()) {
            $user = User::findOrFail($request->id);
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
            $user->syncRoles($request->role);
            return redirect()->route('user.index')->with('success', 'User updated successfully');
        } else {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    public function delete($id)
    {
        User::findOrFail($id)->delete();
        return response()->json([
            'success' => 'User Deleted Successfully',
        ]);
    }
}
