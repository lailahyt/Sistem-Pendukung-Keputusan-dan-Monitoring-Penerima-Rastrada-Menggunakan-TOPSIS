<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonitoringDistribusi extends Model
{
    protected $table = 'monitoring_distribusi';

    protected $fillable = [
        'penduduk_id',
        'periode_id',
        'rank',
        'nilai_preferensi',
        'status_pengambilan',
        'tanggal_ambil',
        'diambil_oleh',
        'petugas',
        'foto_ktp',
        'bukti_distribusi',
        'catatan'
    ];

    // Relasi penduduk
    public function resident()
    {
        return $this->belongsTo(Resident::class, 'penduduk_id');
    }
    // Relasi periode
    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }
}
