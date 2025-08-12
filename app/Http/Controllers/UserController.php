<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->paginate();
        $roles = Role::all();
        return view('users.index', compact('users', 'roles'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8',
            'role' => 'required|exists:roles,name'
        ]);

        $validation['password'] = Hash::make($request->password);

        $user = User::create($validation);
        $user->assignRole($request->role);

        return redirect()->route('user.index')->with('message', 'User Created Successfully');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();

        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validation = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8',
            'role' => 'required|exists:roles,name'
        ]);

        if ($request->filled('password')) {
            $validation['password'] = Hash::make($request->password);
        } else {
            unset($validation['password']);
        }

        if ($request->email !== $user->email) {
            $user->email_verified_at = null;
        }

        $user->update($validation);

        $user->syncRoles([$request->role]);

        return redirect()->route('user.index')->with('message', 'User updated successfully!');
    }



    public function destroy($id)
    {
        $user = User::Find($id);
        $user->delete();

        return redirect()->route('user.index')->with('message', 'User Deleted successfully!');
    }
}
