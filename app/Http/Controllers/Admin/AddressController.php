<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use App\Models\User;
use App\Models\Address;
use Illuminate\Support\Facades\DB;
use Exception;

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
        DB::beginTransaction();

        try {
            $user->addresses()->create($request->validated());

            DB::commit();
            return redirect()
                ->route('admin.users.addresses.index', $user->id)
                ->with('success', 'Address added successfully.');

        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong while saving address.')->withInput();
        }
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
        DB::beginTransaction();

        try {
            $address->update($request->validated());

            DB::commit();
            return redirect()
                ->route('admin.users.addresses.index', $address->user_id)
                ->with('success', 'Address updated successfully.');

        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong while updating address.')->withInput();
        }
    }

    /**
     * Remove the specified address from storage.
     */
    public function destroy(Address $address)
    {
        DB::beginTransaction();

        try {
            $userId = $address->user_id;
            $address->delete();

            DB::commit();
            return redirect()
                ->route('admin.users.addresses.index', $userId)
                ->with('success', 'Address deleted successfully.');

        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong while deleting address.');
        }
    }
}
