<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InteractiveQuestion extends Model
{
    protected $fillable = [
        'interactive_video_id',
        'time_marker',
        'question',
        'option_a',
        'option_b',
        'option_c',
        'option_d',
        'correct_answer',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function video(): BelongsTo
    {
        return $this->belongsTo(InteractiveVideo::class, 'interactive_video_id');
    }
}