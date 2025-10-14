<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use App\Models\User;
use App\Models\Address;

class AddressController extends Controller
{
    /**
     * Display a listing of the user's addresses.
     */
    public function index(User $user)
    {
        $addresses = $user->addresses()->latest()->get();

        return view('admin.users.addresses', compact('user', 'addresses'));
    }

    /**
     * Show the form for creating a new address.
     */
    public function create(User $user)
    {
        $address = new Address();

        return view('admin.users.address-form', compact('user', 'address'));
    }

    /**
     * Store a newly created address in storage.
     */
    public function store(AddressRequest $request, User $user)
    {
        $user->addresses()->create($request->validated());

        return redirect()
            ->route('admin.users.addresses.index', $user->id)
            ->with('success', 'Address added successfully.');
    }

    /**
     * Show the form for editing the specified address.
     */
    public function edit(Address $address)
    {
        $user = $address->user;

        return view('admin.users.address-form', compact('user', 'address'));
    }

    /**
     * Update the specified address in storage.
     */
    public function update(AddressRequest $request, Address $address)
    {
        $address->update($request->validated());

        return redirect()
            ->route('admin.users.addresses.index', $address->user_id)
            ->with('success', 'Address updated successfully.');
    }

    /**
     * Remove the specified address from storage.
     */
    public function destroy(Address $address)
    {
        $userId = $address->user_id;
        $address->delete();

        return redirect()
            ->route('admin.users.addresses.index', $userId)
            ->with('success', 'Address deleted successfully.');
    }
}
