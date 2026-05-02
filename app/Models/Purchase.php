<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Purchase extends Model
{
    protected $fillable = [
        'user_id',
        'barang_id',
        'barang_nama',
        'harga',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
