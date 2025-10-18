<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Address;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;

use Yajra\DataTables\Facades\DataTables;


class UserController extends Controller
{

    public function index(Request $request)
    {
        // If AJAX request → return DataTables JSON
        if ($request->ajax()) {
            $query = User::with('addresses'); // eager load addresses count

            return DataTables::of($query)
                ->addIndexColumn() // adds serial number
                ->addColumn('addresses', function ($user) {
                    $viewUrl = route('admin.users.addresses.index', $user->id);
                    $addUrl = route('admin.users.addresses.create', $user->id);
                    return '
                        <a href="' . $viewUrl . '" class="btn btn-info btn-sm">View (' . $user->addresses->count() . ')</a>
                        <a href="' . $addUrl . '" class="btn btn-success btn-sm">Add</a>
                    ';
                })
                ->addColumn('status', function ($user) {
                    return status_badge($user->status);
                })
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
                ->rawColumns(['addresses', 'status', 'actions']) // allow HTML
                ->make(true);
        }

        // If not AJAX → return view
        return view('admin.users.index');
    }


    public function indexx(Request $request)
    {
        $query = User::query();

        // Search by name, email, or phone
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $users = $query->with(['billingAddresses', 'shippingAddresses'])->orderBy('id', 'desc')->paginate(1);

        // Keep the search query in pagination links
        $users->appends($request->all());

        return view('admin.users.index', compact('users', 'search'));
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
            'status' => $request->has('status'),
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
            'status' => $request->has('status'),
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
