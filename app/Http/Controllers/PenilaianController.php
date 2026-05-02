<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use App\Models\Kriteria;
use App\Models\PenilaianDetail;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    public function index()
    {
        $kriteria = Kriteria::all();

        $residents = Resident::withCount([
            'penilaianDetail as penilaian_detail_count'
        ])->get();

        // hitung rata-rata (opsional)
        foreach ($residents as $p) {
            $detail = PenilaianDetail::where('penduduk_id', $p->id)->get();

            $p->rata_rata = $detail->count() > 0
                ? round($detail->avg('nilai'), 2)
                : null;
        }

        return view('pages.penilaian.index', [
            'penduduk' => $residents,
            'kriteria' => $kriteria
        ]);
    }
}
