<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Bab extends Model
{
    protected $table = 'bab';
    protected $guarded = ['id'];
    public $timestamps = true;

    public function guru(): BelongsTo
    {
        return $this->belongsTo(SMPN11Guru::class, 'guru_id');
    }

    public function isiBab(): HasOne
    {
        return $this->hasOne(IsiBab::class, 'bab_id', 'id');
    }
}
