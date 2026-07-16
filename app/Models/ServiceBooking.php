<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ServiceBooking extends Model
{
    protected $fillable = [
        'user_id',
        'service_id',
        'mechanic_id',
        'nama_kendaraan',
        'plat_nomor',
        'keluhan',
        'tanggal_booking',
        'jam_booking',
        'status',
        'latitude',
        'longitude',
        'catatan_admin',
        'catatan_mekanik',
    ];

    protected $casts = [
        'tanggal_booking' => 'date',
        'latitude' => 'float',
        'longitude' => 'float',
    ];

    /**
     * Status list for display
     */
    public static function statusList(): array
    {
        return ['pending', 'diterima', 'ditolak', 'diproses', 'selesai', 'dibatalkan'];
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isDiterima(): bool
    {
        return $this->status === 'diterima';
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function mechanic(): BelongsTo
    {
        return $this->belongsTo(User::class, 'mechanic_id');
    }

    public function assistanceRequests(): HasMany
    {
        return $this->hasMany(MechanicAssistanceRequest::class);
    }

    public function activeAssistanceRequest(): HasOne
    {
        return $this->hasOne(MechanicAssistanceRequest::class)
            ->whereIn('status', ['pending', 'accepted'])
            ->latestOfMany();
    }
}
