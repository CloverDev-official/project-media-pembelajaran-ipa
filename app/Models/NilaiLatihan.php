<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NilaiLatihan extends Model
{
    protected $table = 'nilai_latihan';
    protected $guarded = [];
    public $timestamps = true;

    public function murid(): BelongsTo
    {
        return $this->belongsTo(SMPN11Murid::class, 'murid_id');
    }

    public function latihan(): BelongsTo
    {
        return $this->belongsTo(Latihan::class, 'latihan_id');
    }

    public function bab(): BelongsTo
    {
        return $this->belongsTo(Bab::class, 'bab_id');
    }
}
