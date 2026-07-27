<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('division', 'roles')->latest()->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $divisions = Division::where('is_active', true)->get();
        return view('admin.users.create', compact('divisions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik' => ['required', 'string', 'max:255', 'unique:users'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:admin,operator,user'],
            'division_id' => ['nullable', 'exists:divisions,id'],
        ]);

        $user = User::create([
            'nik' => $validated['nik'],
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'], // We still save it on table if it exists as column
            'division_id' => $validated['division_id'],
        ]);

        $user->assignRole($validated['role']);

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        $divisions = Division::where('is_active', true)->get();
        return view('admin.users.edit', compact('user', 'divisions'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'nik' => ['required', 'string', 'max:255', 'unique:users,nik,' . $user->id],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:admin,operator,user'],
            'division_id' => ['nullable', 'exists:divisions,id'],
        ]);

        $data = [
            'nik' => $validated['nik'],
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'division_id' => $validated['division_id'],
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($validated['password']);
        }

        $user->update($data);
        $user->syncRoles([$validated['role']]);

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}
