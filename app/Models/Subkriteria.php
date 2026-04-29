<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subkriteria extends Model
{
    protected $table = 'subkriteria';

    protected $fillable = [
        'kriteria_id',
        'label_subkriteria',
        'nilai',
        'keterangan'
    ];

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }
}
