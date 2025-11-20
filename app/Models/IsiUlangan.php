<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IsiUlangan extends Model
{
    protected $table = 'isi_ulangan';
    protected $guarded = [];
    public $timestamps = true;

    public function ulangan(): BelongsTo
    {
        return $this->belongsTo(Ulangan::class, 'ulangan_id');
    }
}
