<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kondisi extends Model
{
    //
    use HasFactory;

    protected $table = 'kondisi';
    protected $fillable = ['nama', 'keterangan'];

    public function inventaris(): HasMany
    {
        return $this->hasMany(Inventaris::class, 'kondisi_id');
    }

    public function scopeBaik($query)
    {
        return $query->where('nama', 'Baik');
    }

}
