<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class SMPN11Murid extends Authenticatable implements JWTSubject
{
    protected $table = 'murid';
    protected $guarded = [];
    public $timestamps = true;
    protected $fillable = ['nipd', 'gambar', 'nama', 'sekolah', 'absen', 'kelas_id', 'password'];
    protected $hidden = ['password'];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function nilaiUlangan()
    {
        return $this->hasMany(NilaiUlangan::class, 'murid_id');
    }

    public function nilaiLatihan()
    {
        return $this->hasMany(NilaiLatihan::class, 'murid_id');
    }
}
