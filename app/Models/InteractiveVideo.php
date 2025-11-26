<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InteractiveVideo extends Model
{
    protected $fillable = [
        'title',
        'description',
        'video_path',
        'thumbnail_path',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function questions(): HasMany
    {
        return $this->hasMany(InteractiveQuestion::class, 'interactive_video_id');
    }

        public function interactiveQuestions()
    {
        return $this->hasMany(InteractiveQuestion::class, 'interactive_video_id');
    }

    public function materi()
    {
        return $this->belongsToMany(IsiBab::class, 'materis', 'interactive_video_id', 'materi_id');
    }
}