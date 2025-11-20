<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $primaryKey = 'id';
    protected $fillable = ['nama_kelas'];
    public $timestamps = true;

    public function murid()
    {
        return $this->hasMany(SMPN11Murid::class, 'kelas_id');
    }

    public function ulangan()
    {
        return $this->hasMany(Ulangan::class);
    }

    public function latihan()
    {
        return $this->hasManyThrough(
            Latihan::class,
            Bab::class,
            'kelas_id', // FK di bab
            'bab_id',   // FK di latihan
            'id',       // PK di kelas
            'id'        // PK di bab
        );
    }
}
