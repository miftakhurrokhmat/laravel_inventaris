<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Peminjaman extends Model
{
    //
    use HasFactory;

    protected $table = 'peminjaman';

    protected $fillable = [
        'kode_pinjam', 'inventaris_id', 'user_id',
        'tanggal_pinjam', 'tanggal_kembali', 'rencana_kembali',
        'status', 'catatan',
    ];

    protected $casts = [
        'tanggal_pinjam' => 'date',
        'tanggal_kembali' => 'date',
        'rencana_kembali' => 'date',
    ];

    public function inventaris(): BelongsTo
    {
        return $this->belongsTo(Inventaris::class, 'inventaris_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Membuat kode peminjaman: PJM-YYYYMMDD-XXXX
     */
    public static function buatKode(): string
    {
        $prefix = 'PJM-' . now()->format('Ymd') . '-';
        $last = static::where('kode_pinjam', 'like', $prefix . '%')
            ->orderByDesc('kode_pinjam')
            ->first();

        $sequence = $last ? ((int) Str::afterLast($last->kode_pinjam, '-')) + 1 : 1;

        return $prefix . str_pad((string) $sequence, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Scope filter berdasarkan status.
     */
    public function scopeStatus($query, ?string $status)
    {
        return $query->when($status, fn ($q) => $q->where('status', $status));
    }
}
