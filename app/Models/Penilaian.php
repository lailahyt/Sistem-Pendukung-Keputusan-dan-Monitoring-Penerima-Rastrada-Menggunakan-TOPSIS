<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    protected $table = 'penilaian';

    protected $fillable = [
        'penduduk_id',
        'status'
    ];

    public function detail()
    {
        return $this->hasMany(PenilaianDetail::class);
    }

    public function penduduk()
    {
        return $this->belongsTo(Resident::class);
    }
}
