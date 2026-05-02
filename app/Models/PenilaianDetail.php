<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenilaianDetail extends Model
{
    protected $table = 'penilaian_detail';

    protected $fillable = [
        'penilaian_id',
        'kriteria_id',
        'subkriteria_id',
        'nilai',
        'bukti_file',
        'catatan'
    ];

    public function penilaian()
    {
        return $this->belongsTo(Penilaian::class);
    }

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }

    public function subkriteria()
    {
        return $this->belongsTo(Subkriteria::class);
    }

    public function resident()
    {
        return $this->belongsTo(Resident::class, 'penduduk_id');
    }
}
