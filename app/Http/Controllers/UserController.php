<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private function checkAdmin()
    {
        if (session('user_role') !== 'admin') {
            return redirect()->route('home')->with('error', 'Akses ditolak');
        }

        return null;
    }

    public function index()
    {
        $checkAdmin = $this->checkAdmin();
        if ($checkAdmin) {
            return $checkAdmin;
        }

        $users = User::orderBy('id', 'desc')->get();

        return view('users.index', compact('users'));
    }

    public function create()
    {
        $checkAdmin = $this->checkAdmin();
        if ($checkAdmin) {
            return $checkAdmin;
        }

        return view('users.create');
    }

    public function store(Request $request)
    {
        $checkAdmin = $this->checkAdmin();
        if ($checkAdmin) {
            return $checkAdmin;
        }

        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'jenis_kelamin' => 'required|in:L,P',
            'role' => 'required|in:admin,mekanik,pengguna',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'role' => $validated['role'],
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'User berhasil ditambahkan');
    }

    public function edit(string $id)
    {
        $checkAdmin = $this->checkAdmin();
        if ($checkAdmin) {
            return $checkAdmin;
        }

        $user = User::findOrFail($id);

        return view('users.edit', compact('user'));
    }

    public function update(Request $request, string $id)
    {
        $checkAdmin = $this->checkAdmin();
        if ($checkAdmin) {
            return $checkAdmin;
        }

        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
            'jenis_kelamin' => 'required|in:L,P',
            'role' => 'required|in:admin,mekanik,pengguna',
        ]);

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'role' => $validated['role'],
        ];

        if (!empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        $user->update($data);

        return redirect()->route('admin.dashboard')->with('success', 'User berhasil diupdate');
    }

    public function destroy(string $id)
    {
        $checkAdmin = $this->checkAdmin();
        if ($checkAdmin) {
            return $checkAdmin;
        }

        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.dashboard')->with('success', 'User berhasil dihapus');
    }
}