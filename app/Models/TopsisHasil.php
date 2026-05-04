<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TopsisHasil extends Model
{
    protected $table = 'topsis_hasil';

    protected $fillable = [
        'periode_id',
        'penduduk_id',
        'nilai_preferensi',
        'ranking'
    ];

    public function penduduk()
    {
        return $this->belongsTo(Resident::class, 'penduduk_id');
    }

    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }
}
