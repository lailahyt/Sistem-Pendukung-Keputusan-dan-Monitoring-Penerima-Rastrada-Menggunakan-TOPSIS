<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use App\Services\TopsisService;
use Illuminate\Http\Request;

class HasilController extends Controller
{
    public function index(TopsisService $topsisService)
    {
        $periode = Periode::first();

        if (!$periode) {
            return redirect('/periode')
                ->with('error', 'Tambahkan periode terlebih dahulu');
        }

        $periode_id = request('periode_id') ?? $periode->id;

        $periode = Periode::findOrFail($periode_id);

        $periodeList = Periode::all();

        // Ambil hasil akhir TOPSIS
        $data = $topsisService->calculate($periode_id);

        $hasil = $data['hasil'];

        // Statistik Dashboard
        $totalPenduduk = count($hasil);

        $direkomendasikan = collect($hasil)
            ->where('status', 'Direkomendasikan')
            ->count();

        $tidakDirekomendasikan = collect($hasil)
            ->where('status', 'Tidak Direkomendasikan')
            ->count();

        return view('pages.hasil.index', compact(
            'hasil',
            'totalPenduduk',
            'direkomendasikan',
            'tidakDirekomendasikan',
            'periode',
            'periode_id',
            'periodeList'
        ));
    }
}
