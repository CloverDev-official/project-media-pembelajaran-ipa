<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Ulangan extends Model
{
    protected $table = 'ulangan';
    protected $guarded = [];
    public $timestamps = true;

    protected static function booted()
    {
        static::deleting(function ($ulangan) {
            if ($ulangan->gambar) {
                $folderPath = dirname($ulangan->gambar);
                Storage::disk('public')->deleteDirectory($folderPath);
            }
        });
    }

    public function guru(): BelongsTo
    {
        return $this->belongsTo(SMPN11Guru::class, 'guru_id');
    }

    public function isiUlangan(): HasMany
    {
        return $this->hasMany(IsiUlangan::class, 'ulangan_id');
    }

    public function nilaiUlangan(): HasMany
    {
        return $this->hasMany(NilaiUlangan::class, 'ulangan_id');
    }
}
