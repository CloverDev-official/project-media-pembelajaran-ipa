<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tymon\JWTAuth\Contracts\JWTSubject;

class SMPN11Guru extends Authenticatable implements JWTSubject
{
    protected $table = 'guru';
    protected $guarded = [];
    public $timestamps = true;
    protected $fillable = ['nama', 'email', 'password'];
    protected $hidden = ['password'];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function bab(): HasMany
    {
        return $this->hasMany(Bab::class, 'guru_id');
    }

    public function latihan(): HasMany
    {
        return $this->hasMany(Latihan::class, 'guru_id');
    }

    public function ulangan(): HasMany
    {
        return $this->hasMany(Ulangan::class, 'guru_id');
    }
}
