<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PenilaianDetail;
use App\Models\Penilaian;
use App\Models\Wilayah;

class Resident extends Model
{
    protected $table = 'residents';

    protected $guarded = [];

    public function penilaianDetail()
    {
        return $this->hasMany(PenilaianDetail::class, 'penduduk_id');
    }

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class, 'penduduk_id');
    }

    public function wilayah()
    {
        return $this->belongsTo(Wilayah::class);
    }
}
