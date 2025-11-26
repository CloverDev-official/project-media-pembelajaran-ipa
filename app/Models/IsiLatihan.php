<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IsiLatihan extends Model
{
    protected $table = 'isi_latihan';
    protected $guarded = [];
    public $timestamps = true;

    public function latihan(): BelongsTo
    {
        return $this->belongsTo(Latihan::class, 'latihan_id');
    }
}
