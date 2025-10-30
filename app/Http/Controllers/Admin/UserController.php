<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = User::with('addresses');

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('addresses', function ($user) {
                    $viewUrl = route('admin.users.addresses.index', $user->id);
                    $addUrl = route('admin.users.addresses.create', $user->id);
                    $count = $user->addresses->count();

                    return '
                        <div class="d-flex align-items-center gap-2">
                            <a href="' . $viewUrl . '" class="btn btn-outline-primary btn-sm px-2 d-flex align-items-center" title="View Addresses">
                                <i class="bi bi-eye me-1"></i> <span>(' . $count . ')</span>
                            </a>
                            <a href="' . $addUrl . '" class="btn btn-outline-success btn-sm px-2 d-flex align-items-center" title="Add Address">
                                <i class="bi bi-plus-lg"></i>
                            </a>
                        </div>
                    ';
                })
                ->addColumn('status', fn($user) => status_badge($user->status))
                ->addColumn('actions', function ($user) {
                    $edit = route('admin.users.edit', $user->id);
                    $delete = route('admin.users.destroy', $user->id);
                    return '
                        <a href="' . $edit . '" class="btn btn-warning btn-sm"><i class="bi bi-pencil text-white"></i></a>
                        <form action="' . $delete . '" method="POST" style="display:inline;" onsubmit="return confirm(\'Delete this user?\')">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button class="btn btn-danger btn-sm"><i class="bi bi-trash text-white"></i></button>
                        </form>
                    ';
                })
                ->rawColumns(['addresses', 'status', 'actions'])
                ->make(true);
        }

        return view('admin.users.index');
    }

    public function create()
    {
        return view('admin.users.form');
    }

    public function store(UserRequest $request)
    {
        try {
            DB::beginTransaction();

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'status' => $request->has('status'),
            ]);

            DB::commit();
            return redirect()->route('admin.users.index')->with('success', 'User created successfully');

        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong!')->withInput();
        }
    }

    public function edit(User $user)
    {
        return view('admin.users.form', compact('user'));
    }

    public function update(UserRequest $request, User $user)
    {
        try {
            DB::beginTransaction();

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'status' => $request->has('status'),
            ]);

            if ($request->filled('password')) {
                $user->update([
                    'password' => Hash::make($request->password)
                ]);
            }

            DB::commit();
            return redirect()->route('admin.users.index')->with('success', 'User updated successfully');

        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong!')->withInput();
        }
    }

    public function destroy(User $user)
    {
        try {
            DB::beginTransaction();

            $user->delete();

            DB::commit();
            return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');

        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }
}
