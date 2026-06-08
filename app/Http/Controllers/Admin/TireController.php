<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TireController extends Controller
{
    private function checkAdmin()
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('home')->with('error', 'Akses ditolak');
        }
        return null;
    }

    public function store(Request $request)
    {
        $check = $this->checkAdmin();
        if ($check) {
            return $check;
        }

        $request->validate([
            'nama'       => 'required|string|max:255',
            'harga'      => 'required|numeric|min:0',
            'stok'       => 'required|integer|min:0',
            'jenis_ban'  => 'required|string',
            'merek'      => 'required|string',
            'ukuran_ban' => 'required|string',
            'posisi_ban' => 'required|string',
            'material'   => 'required|string',
            'diameter'   => 'required|string',
            'tipe'       => 'required|string',
            'gambar'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'deskripsi'  => 'nullable|string',
            'fitur'      => 'nullable|string',
        ]);

        $data = $request->only([
            'nama', 'harga', 'stok', 'jenis_ban', 'merek', 
            'ukuran_ban', 'posisi_ban', 'material', 'diameter', 
            'tipe', 'deskripsi', 'fitur'
        ]);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('tires', 'public');
        }

        Tire::create($data);

        return back()->with('success', 'Ban motor berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $check = $this->checkAdmin();
        if ($check) {
            return $check;
        }

        $tire = Tire::findOrFail($id);

        $request->validate([
            'nama'       => 'required|string|max:255',
            'harga'      => 'required|numeric|min:0',
            'stok'       => 'required|integer|min:0',
            'jenis_ban'  => 'required|string',
            'merek'      => 'required|string',
            'ukuran_ban' => 'required|string',
            'posisi_ban' => 'required|string',
            'material'   => 'required|string',
            'diameter'   => 'required|string',
            'tipe'       => 'required|string',
            'gambar'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'deskripsi'  => 'nullable|string',
            'fitur'      => 'nullable|string',
        ]);

        $data = $request->only([
            'nama', 'harga', 'stok', 'jenis_ban', 'merek', 
            'ukuran_ban', 'posisi_ban', 'material', 'diameter', 
            'tipe', 'deskripsi', 'fitur'
        ]);

        if ($request->hasFile('gambar')) {
            if ($tire->gambar) {
                Storage::disk('public')->delete($tire->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('tires', 'public');
        }

        $tire->update($data);

        return back()->with('success', 'Ban motor berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $check = $this->checkAdmin();
        if ($check) {
            return $check;
        }

        $tire = Tire::findOrFail($id);

        if ($tire->gambar) {
            Storage::disk('public')->delete($tire->gambar);
        }

        $tire->delete();

        return back()->with('success', 'Ban motor berhasil dihapus!');
    }
}
