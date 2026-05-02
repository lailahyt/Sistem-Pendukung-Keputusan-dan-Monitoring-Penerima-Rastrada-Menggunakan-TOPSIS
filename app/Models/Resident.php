<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    protected $table = 'residents';

    protected $guarded = [];

    public function penilaianDetail()
    {
        return $this->hasMany(PenilaianDetail::class, 'penduduk_id');
    }
}
