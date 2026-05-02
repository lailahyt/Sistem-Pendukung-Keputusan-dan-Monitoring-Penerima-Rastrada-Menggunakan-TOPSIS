<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    protected $table = 'kriteria';

    protected $guarded = [];

    protected $fillable = [
        'kode',
        'nama_kriteria',
        'bobot',
        'atribut'
    ];

    public function subkriteria()
    {
        return $this->hasMany(Subkriteria::class);
    }

    public function penilaianDetail()
    {
        return $this->hasMany(PenilaianDetail::class);
    }
}
