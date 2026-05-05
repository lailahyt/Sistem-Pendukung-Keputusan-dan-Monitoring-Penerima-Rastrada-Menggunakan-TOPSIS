<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    protected $table = 'penilaian';

    protected $fillable = [
        'penduduk_id',
        'periode_id',
        'status'
    ];

    public function resident()
    {
        return $this->belongsTo(\App\Models\Resident::class, 'penduduk_id');
    }

    public function penilaianDetail()
    {
        return $this->hasMany(\App\Models\PenilaianDetail::class, 'penilaian_id');
    }

    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }
}
