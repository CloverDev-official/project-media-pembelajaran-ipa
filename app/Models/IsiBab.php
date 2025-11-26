<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IsiBab extends Model
{
    protected $table = 'isi_bab';
    protected $guarded = [];
    public $timestamps = true;

    public function bab(): BelongsTo
    {
        return $this->belongsTo(Bab::class, 'bab_id', 'id');
    }
}
