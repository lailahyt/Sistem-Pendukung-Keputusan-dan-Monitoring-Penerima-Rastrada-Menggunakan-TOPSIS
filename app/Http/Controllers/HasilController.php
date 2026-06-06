<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use App\Models\MonitoringDistribusi;
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

        $totalAlternatif = count($hasil);

        $totalDitetapkan = MonitoringDistribusi::where(
            'periode_id',
            $periode_id
        )->count();

        $belumDitetapkan =
            $totalAlternatif - $totalDitetapkan;

        $ditetapkan = MonitoringDistribusi::where(
            'periode_id',
            $periode_id
        )->pluck('penduduk_id')
            ->toArray();

        return view('pages.hasil.index', compact(
            'hasil',
            'totalAlternatif',
            'totalDitetapkan',
            'belumDitetapkan',
            'periode',
            'periode_id',
            'periodeList',
            'ditetapkan'
        ));
    }
}
