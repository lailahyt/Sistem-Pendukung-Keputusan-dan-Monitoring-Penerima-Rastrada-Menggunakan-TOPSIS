<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Resident;

class Wilayah extends Model
{
    protected $table = 'wilayah';

    protected $fillable = [
        'rw',
        'rt'
    ];

    public function residents()
    {
        return $this->hasMany(Resident::class);
    }
}
