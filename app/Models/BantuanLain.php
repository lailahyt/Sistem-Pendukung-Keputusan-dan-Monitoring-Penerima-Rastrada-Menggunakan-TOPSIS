<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BantuanLain extends Model
{
    protected $table = 'bantuan_lain';

    protected $fillable = [
        'penduduk_id',
        'nama_bantuan',
        'tahun',
        'keterangan',
    ];

    public function resident()
    {
        return $this->belongsTo(
            Resident::class,
            'penduduk_id'
        );
    }
}
