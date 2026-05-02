<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TokoController extends Controller
{
    private function barang()
    {
        return [
            [
                'id' => 1,
                'nama' => 'Piston Pro X',
                'harga' => 850000,
                'deskripsi' => 'Spare part original untuk performa mesin harian',
            ],
        ];
    }

    public function index()
    {
        $items = $this->barang();

        return view('toko.index', compact('items'));
    }

    public function show($id)
    {
        $item = collect($this->barang())->firstWhere('id', (int) $id);

        if (!$item) {
            abort(404);
        }

        return view('toko.show', compact('item'));
    }

    public function buy($id)
    {
        $item = collect($this->barang())->firstWhere('id', (int) $id);

        if (!$item) {
            abort(404);
        }

        $purchase = Purchase::create([
            'user_id' => Auth::id(),
            'barang_id' => $item['id'],
            'barang_nama' => $item['nama'],
            'harga' => $item['harga'],
        ]);

        return redirect()->route('toko.result', $purchase->id);
    }

    public function result(Purchase $purchase)
    {
        return view('toko.hasil', compact('purchase'));
    }
}
