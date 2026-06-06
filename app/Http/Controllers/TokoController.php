<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TokoController extends Controller
{
    public function index(Request $request)
    {
        $kategori = $request->get('kategori'); // null, 'sparepart', 'ban', 'oli'

        $query = Product::where('stok', '>', 0);

        if ($kategori && in_array($kategori, ['sparepart', 'ban', 'oli'])) {
            $query->where('kategori', $kategori);
        }

        $products = $query->latest()->get();

        return view('toko.index', compact('products', 'kategori'));
    }

    public function show($id)
    {
        $product = Product::where('stok', '>', 0)->findOrFail($id);

        return view('toko.show', compact('product'));
    }

    public function buy(Request $request, $id)
    {
        $product = Product::where('stok', '>', 0)->findOrFail($id);

        // Kurangi stok
        $product->decrement('stok');

        $purchase = Purchase::create([
            'user_id'     => Auth::id(),
            'barang_id'   => $product->id,
            'barang_nama' => $product->nama,
            'harga'       => $product->harga,
        ]);

        return redirect()->route('toko.result', $purchase->id)
            ->with('success', 'Pembelian berhasil! Stok telah dikurangi.');
    }

    public function result(Purchase $purchase)
    {
        // Pastikan user hanya bisa lihat pembelian miliknya
        if ($purchase->user_id !== Auth::id()) {
            abort(403);
        }

        return view('toko.hasil', compact('purchase'));
    }
}
