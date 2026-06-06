<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
{
    // Ambil semua data produk dari database
    $products = Product::all(); 

    // Return ke file blade tempat kamu menaruh grid HTML tadi
    // Misalnya nama filenya: resources/views/home.blade.php atau resources/views/products.blade.php
    return view('home', compact('products')); 
}
    public function store(Request $request)
    {
        $request->validate([
            'nama'     => 'required',
            'harga'    => 'required|numeric',
            'stok'     => 'required|numeric',
            'kategori' => 'required|in:sparepart,ban,oli',
            'gambar'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->only(['nama', 'harga', 'stok', 'kategori', 'deskripsi']);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('products', 'public');
        }

        Product::create($data);
        return back()->with('success', 'Barang berhasil ditambah!');
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'nama'     => 'required',
            'harga'    => 'required|numeric',
            'stok'     => 'required|numeric',
            'kategori' => 'required|in:sparepart,ban,oli',
            'gambar'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->only(['nama', 'harga', 'stok', 'kategori', 'deskripsi']);

        if ($request->hasFile('gambar')) {
            if ($product->gambar) {
                Storage::disk('public')->delete($product->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('products', 'public');
        }

        $product->update($data);
        return back()->with('success', 'Produk diperbarui!');
    }

    public function destroy(Product $product)
    {
        if ($product->gambar) {
            Storage::disk('public')->delete($product->gambar);
        }
        
        $product->delete();
        return back()->with('success', 'Barang dihapus!');
    }
}