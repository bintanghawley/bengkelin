<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Tentukan kolom mana saja yang boleh diisi secara massal
    protected $fillable = [
        'nama',
        'harga',
        'stok',
        'gambar',
    ];

    /**
     * Opsional: Accessor untuk memudahkan pemanggilan URL gambar
     * Jadi di Blade lu cukup panggil {{ $product->image_url }}
     */
    public function getImageUrlAttribute()
    {
        if ($this->gambar) {
            return asset('storage/' . $this->gambar);
        }
        return asset('img/no-image.png'); // Sediakan gambar default jika kosong
    }
}   