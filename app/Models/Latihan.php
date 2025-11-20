<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Latihan extends Model
{
    protected $table = 'latihan';
    protected $guarded = [];
    public $timestamps = true;

    public function guru(): BelongsTo
    {
        return $this->belongsTo(SMPN11Guru::class, 'guru_id');
    }

    public function bab(): BelongsTo
    {
        return $this->belongsTo(Bab::class, 'bab_id');
    }

    public function isiLatihan(): HasMany
    {
        return $this->hasMany(IsiLatihan::class, 'latihan_id');
    }

    public function nilaiLatihan(): HasMany
    {
        return $this->hasMany(NilaiLatihan::class, 'latihan_id');
    }
}
