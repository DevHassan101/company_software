<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserInfo;
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
            'fname' => 'required',
            'dob' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'profile' => 'required',
            'cnic' => 'required',
            'cnic_frnt' => 'required',
            'cnic_back' => 'required',
            'address' => 'required',
            'role' => 'required|exists:roles,name'
        ]);

        if ($request->hasFile('profile')) {
            $image = $request->file('profile');
            $name_gen = hexdec(uniqid() . '.' . $image->getClientOriginalExtension());
            $image->move('uploads/users/profile', $name_gen);
            $validation['profile'] = 'uploads/users/profile/' . $name_gen;
        }

        if ($request->hasFile('cnic_frnt')) {
            $image = $request->file('cnic_frnt');
            $name_gen = hexdec(uniqid() . '.' . $image->getClientOriginalExtension());
            $image->move('uploads/users/cnicfrnt', $name_gen);
            $validation['cnic_frnt'] = 'uploads/users/cnicfrnt/' . $name_gen;
        }


        if ($request->hasFile('cnic_back')) {
            $image = $request->file('cnic_back');
            $name_gen = hexdec(uniqid() . '.' . $image->getClientOriginalExtension());
            $image->move('uploads/users/cnicback', $name_gen);
            $validation['cnic_back'] = 'uploads/users/cnicback/' . $name_gen;
        }


        $validation['password'] = Hash::make($request->password);

        $user = User::create($validation);
        $validation['user_id'] = $user->id;
        UserInfo::create($validation);
        $user->assignRole($request->role);

        return redirect()->route('user.index')->with('message', 'User Created Successfully');
    }

    public function show($id)
    {
        $user = User::with('userInfo')->find($id);
        return view('users.view', compact('user'));
    }

    public function edit($id)
    {
        $user = User::with('userInfo')->findOrFail($id);
        $roles = Role::all();

        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $user = User::with('userInfo')->findOrFail($id);
        $validation = $request->validate([
            'name' => 'nullable',
            'email' => 'nullable|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8',
            'fname' => 'nullable',
            'dob' => 'nullable',
            'phone' => 'nullable',
            'gender' => 'nullable',
            'profile' => 'nullable|image',
            'cnic' => 'nullable',
            'cnic_frnt' => 'nullable',
            'cnic_back' => 'nullable',
            'address' => 'nullable',
            'role' => 'nullable|exists:roles,name'
        ]);


        if ($request->hasFile('profile')) {
            if ($user->userInfo?->profile && file_exists(public_path($user->userInfo?->profile))) {
                unlink(public_path($user->userInfo->profile));
            }

            $image = $request->file('profile');
            $name_gen = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move('uploads/users/profile', $name_gen);
            $validation['profile'] = 'uploads/users/profile/' . $name_gen;
        }

        if ($request->hasFile('cnic_frnt')) {
            if ($user->userInfo?->cnic_frnt && file_exists(public_path($user->userInfo?->cnic_frnt))) {
                unlink(public_path($user->userInfo->cnic_frnt));
            }

            $image = $request->file('cnic_frnt');
            $name_gen = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move('uploads/users/cnicfrnt', $name_gen);
            $validation['cnic_frnt'] = 'uploads/users/cnicfrnt/' . $name_gen;
        }

        if ($request->hasFile('cnic_back')) {
            if ($user->userInfo?->cnic_back && file_exists(public_path($user->userInfo?->cnic_back))) {
                unlink(public_path($user->userInfo->cnic_back));
            }

            $image = $request->file('cnic_back');
            $name_gen = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move('uploads/users/cnicback', $name_gen);
            $validation['cnic_back'] = 'uploads/users/cnicback/' . $name_gen;
        }


        if ($request->filled('password')) {
            $validation['password'] = Hash::make($request->password);
        } else {
            unset($validation['password']);
        }

        if ($request->email !== $user->email) {
            $user->email_verified_at = null;
        }

        $validation['user_id'] = $user->id;
        $user->update($validation);

        $user->syncRoles([$request->role]);
        UserInfo::where('user_id', $id)->firstOrFail()->update($validation);

        return redirect()->route('user.index')->with('message', 'User updated successfully!');
    }

    public function destroy($id)
    {
        $user = User::Find($id);
        $user->delete();

        return redirect()->route('user.index')->with('message', 'User Deleted successfully!');
    }
}
