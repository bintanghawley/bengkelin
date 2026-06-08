<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sparepart extends Model
{
    use HasFactory;

    protected $table = 'spareparts';

    protected $fillable = [
        'nama',
        'harga',
        'stok',
        'gambar',
        'deskripsi',
        'jenis_sparepart',
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
