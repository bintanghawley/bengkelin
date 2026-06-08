<?php

namespace App\Http\Controllers;

use App\Models\Tire;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TireController extends Controller
{
    public function index(Request $request)
    {
        $query = Tire::query();

        // 1. Filter Search
        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->input('search') . '%');
        }

        // 2. Filter Kategori (Jenis Ban)
        if ($request->has('jenis_ban') && is_array($request->input('jenis_ban'))) {
            $query->whereIn('jenis_ban', $request->input('jenis_ban'));
        }

        // 3. Filter Merek
        if ($request->has('merek') && is_array($request->input('merek'))) {
            $query->whereIn('merek', $request->input('merek'));
        }

        // 4. Filter Ukuran Ban
        if ($request->has('ukuran_ban') && is_array($request->input('ukuran_ban'))) {
            $query->whereIn('ukuran_ban', $request->input('ukuran_ban'));
        }

        // 5. Filter Posisi Ban
        if ($request->has('posisi_ban') && is_array($request->input('posisi_ban'))) {
            $query->whereIn('posisi_ban', $request->input('posisi_ban'));
        }

        // 6. Filter Material
        if ($request->has('material') && is_array($request->input('material'))) {
            $query->whereIn('material', $request->input('material'));
        }

        // 7. Filter Diameter
        if ($request->has('diameter') && is_array($request->input('diameter'))) {
            $query->whereIn('diameter', $request->input('diameter'));
        }

        // 8. Filter Tipe
        if ($request->has('tipe') && is_array($request->input('tipe'))) {
            $query->whereIn('tipe', $request->input('tipe'));
        }

        // 9. Filter Range Harga
        $hargaMin = $request->input('harga_min', 0);
        $hargaMax = $request->input('harga_max', 2000000); // support up to 2 million
        $query->whereBetween('harga', [$hargaMin, $hargaMax]);

        // 10. Sorting
        $sort = $request->input('sort');
        if ($sort === 'Harga Paling Murah') {
            $query->orderBy('harga', 'asc');
        } elseif ($sort === 'Harga Tertinggi') {
            $query->orderBy('harga', 'desc');
        } else {
            $query->latest();
        }

        // Paginate max 24 items
        $tires = $query->paginate(24)->appends($request->all());

        return view('toko.ban-motor', compact('tires'));
    }

    public function show($id)
    {
        $tire = Tire::findOrFail($id);
        return view('toko.ban-motor-detail', compact('tire'));
    }

    public function checkout($id)
    {
        $tire = Tire::findOrFail($id);

        if ($tire->stok <= 0) {
            return back()->with('error', 'Stok ban motor ini sedang kosong!');
        }

        $user = Auth::user();
        return view('toko.ban-motor-checkout', compact('tire', 'user'));
    }

    public function buy(Request $request, $id)
    {
        $tire = Tire::findOrFail($id);

        if ($tire->stok <= 0) {
            return back()->with('error', 'Stok ban motor ini sedang kosong!');
        }

        $request->validate([
            'jumlah' => 'required|integer|min:1|max:' . $tire->stok,
            'alamat' => 'required|string|max:500',
            'telepon' => 'required|string|max:20',
            'metode_pembayaran' => 'required|in:COD,Transfer Bank',
            'catatan' => 'nullable|string|max:1000',
        ]);

        $jumlah = (int) $request->input('jumlah');
        $totalHarga = $tire->harga * $jumlah;

        // Kurangi stok
        $tire->decrement('stok', $jumlah);

        // Buat purchase
        $purchase = Purchase::create([
            'user_id'           => Auth::id(),
            'barang_id'         => $tire->id,
            'barang_nama'       => $tire->nama,
            'harga'             => $tire->harga,
            'jumlah'            => $jumlah,
            'total_harga'       => $totalHarga,
            'alamat'            => $request->input('alamat'),
            'telepon'           => $request->input('telepon'),
            'metode_pembayaran' => $request->input('metode_pembayaran'),
            'catatan'           => $request->input('catatan'),
            'status'            => 'pending',
        ]);

        return redirect()->route('toko.result', $purchase->id)
            ->with('success', 'Pembelian ban berhasil! Pesanan Anda sedang diproses.');
    }
}
