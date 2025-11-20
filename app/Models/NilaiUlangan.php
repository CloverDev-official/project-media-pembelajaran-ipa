<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class NilaiUlangan extends Model
{
    protected $table = 'nilai_ulangan';
    protected $guarded = [];
    public $timestamps = true;

    protected static function booted()
    {
        static::deleting(function ($NilaiUlangan) {
            if ($NilaiUlangan->gambar) {
                Storage::disk('public')->delete($NilaiUlangan->gambar);
            }
        });
    }

    public function murid(): BelongsTo
    {
        return $this->belongsTo(SMPN11Murid::class, 'murid_id');
    }

    public function ulangan(): BelongsTo
    {
        return $this->belongsTo(Ulangan::class, 'ulangan_id');
    }

    public function bab(): BelongsTo
    {
        return $this->belongsTo(Bab::class, 'bab_id');
    }
}
