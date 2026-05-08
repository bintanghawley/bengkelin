<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ControllerAPI extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'desc')->get();

        return response()->json([
            'status' => true,
            'message' => 'Data users berhasil diambil',
            'data' => $users,
        ]);
    }

    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User tidak ditemukan',
                'data' => null,
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Data user berhasil diambil',
            'data' => $user,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,mekanik,pengguna',
            'jenis_kelamin' => 'required|in:L,P',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
        ]);

        return response()->json([
            'status' => true,
            'message' => 'User berhasil ditambahkan',
            'data' => $user,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User tidak ditemukan',
                'data' => null,
            ], 404);
        }

        $validated = $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
            'password' => 'nullable|min:6',
            'role' => 'nullable|in:admin,mekanik,pengguna',
            'jenis_kelamin' => 'nullable|in:L,P',
        ]);

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
        ];

        if (!empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        if (!empty($validated['role'])) {
            $data['role'] = $validated['role'];
        }

        if (!empty($validated['jenis_kelamin'])) {
            $data['jenis_kelamin'] = $validated['jenis_kelamin'];
        }

        $user->update($data);

        return response()->json([
            'status' => true,
            'message' => 'User berhasil diperbarui',
            'data' => $user,
        ]);
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User tidak ditemukan',
                'data' => null,
            ], 404);
        }

        $user->delete();

        return response()->json([
            'status' => true,
            'message' => 'User berhasil dihapus',
            'data' => null,
        ]);
    }
}
