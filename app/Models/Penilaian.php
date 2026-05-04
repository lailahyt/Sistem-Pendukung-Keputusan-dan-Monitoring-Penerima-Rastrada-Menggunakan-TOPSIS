<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    protected $table = 'penilaian';

    protected $fillable = [
        'penduduk_id',
        'periode',
        'status'
    ];

    public function penduduk()
    {
        return $this->belongsTo(Resident::class);
    }

    public function penilaianDetail()
    {
        return $this->hasMany(PenilaianDetail::class);
    }

    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }
}
