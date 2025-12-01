<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GimLevel extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul_level',
        'deskripsi',
        'pasangan',
        'urutan',
        'aktif',
        'thumbnail',
    ];

    protected $casts = [
        'pasangan' => 'array',
        'aktif' => 'boolean',
    ];
}