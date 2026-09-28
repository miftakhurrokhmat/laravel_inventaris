<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Inventaris extends Model
{
    //
    use HasFactory;

    protected $table = 'inventaris';

    protected $fillable = [
        'kode', 'nama', 'kategori_id', 'kondisi_id', 'user_id',
        'tanggal_perolehan', 'harga', 'catatan',
    ];

    protected $casts = [
        'tanggal_perolehan' => 'date',
        'harga' => 'decimal:2',
    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function kondisi(): BelongsTo
    {
        return $this->belongsTo(Kondisi::class, 'kondisi_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function peminjaman(): HasMany
    {
        return $this->hasMany(Peminjaman::class, 'inventaris_id');
    }

    /**
     * Membuat kode barang otomatis: INV-YYYYMMDD-XXXX
     */
    public static function buatKode(): string
    {
        $prefix = 'INV-' . now()->format('Ymd') . '-';
        $last = static::where('kode', 'like', $prefix . '%')
            ->orderByDesc('kode')
            ->first();

        $sequence = $last ? ((int) Str::afterLast($last->kode, '-')) + 1 : 1;

        return $prefix . str_pad((string) $sequence, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Scope pencarian nama atau kode.
     */
    public function scopeCari($query, ?string $kataKunci)
    {
        return $query->when($kataKunci, function ($q) use ($kataKunci) {
            $q->where(function ($dalam) use ($kataKunci) {
                $dalam->where('nama', 'like', "%{$kataKunci}%")
                      ->orWhere('kode', 'like', "%{$kataKunci}%");
            });
        });
    }

    /**
     * Scope filter barang kondisi baik.
     */
    public function scopeKondisiBaik($query)
    {
        return $query->whereHas('kondisi', fn ($q) => $q->where('nama', 'Baik'));
    }
}
