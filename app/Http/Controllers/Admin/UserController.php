<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Address;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['billingAddresses', 'shippingAddresses'])->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.form');
    }

    public function store(UserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully');
    }

    public function edit(User $user)
    {
        return view('admin.users.form', compact('user'));
    }

    public function update(UserRequest $request, User $user)
    {
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
            $user->save();
        }

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
    }
}
