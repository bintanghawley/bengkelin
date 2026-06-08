<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oil extends Model
{
    use HasFactory;

    protected $table = 'oils';

    protected $fillable = [
        'nama',
        'harga',
        'stok',
        'gambar',
        'deskripsi',
        'jenis_oli',
        'kekentalan',
        'ukuran',
        'tipe_oli',
        'merek',
        'fitur',
    ];

    /**
     * Accessor untuk URL gambar
     */
    public function getImageUrlAttribute()
    {
        if ($this->gambar) {
            return asset('storage/' . $this->gambar);
        }
        return null;
    }
}
