<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::with(['branch', 'role'])
            ->latest()
            ->paginate(10);

        return view('users.index', compact('users'));
    }

    public function create()
    {
        $branches = Branch::orderBy('name')->get();

        $roles = Role::where('status', 'Active')
            ->orderBy('display_name')
            ->get();

        return view('users.create', compact('branches', 'roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'branch_id'   => 'nullable|exists:branches,id',
            'role_id'     => 'required|exists:roles,id',
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|unique:users,email',
            'password'    => 'required|min:8|confirmed',
            'designation' => 'nullable|string|max:255',
            'mobile'      => 'nullable|string|max:20',
            'status'      => 'required|in:Active,Inactive',
        ]);

        User::create([
            'branch_id'   => $validated['branch_id'],
            'role_id'     => $validated['role_id'],
            'name'        => $validated['name'],
            'email'       => $validated['email'],
            'password'    => Hash::make($validated['password']),
            'designation' => $validated['designation'] ?? null,
            'mobile'      => $validated['mobile'] ?? null,
            'status'      => $validated['status'],
        ]);

        return redirect()
            ->route('users.index')
            ->with('success', 'User created successfully.');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $branches = Branch::orderBy('name')->get();

        $roles = Role::where('status', 'Active')
            ->orderBy('display_name')
            ->get();

        return view('users.edit', compact('user', 'branches', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'branch_id'   => 'nullable|exists:branches,id',
            'role_id'     => 'required|exists:roles,id',
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|unique:users,email,' . $user->id,
            'designation' => 'nullable|string|max:255',
            'mobile'      => 'nullable|string|max:20',
            'status'      => 'required|in:Active,Inactive',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        }

        $user->update($validated);

        return redirect()
            ->route('users.index')
            ->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', 'User deleted successfully.');
    }
}