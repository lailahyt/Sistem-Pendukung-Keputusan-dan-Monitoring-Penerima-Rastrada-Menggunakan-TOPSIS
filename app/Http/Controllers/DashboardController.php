<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use App\Models\MonitoringDistribusi;
use App\Models\Periode;

class DashboardController extends Controller
{
    public function index()
    {
        // =========================
        // PERIODE AKTIF
        // =========================
        $periode = Periode::latest()->first();

        // =========================
        // TOTAL DATA
        // =========================
        $totalPenduduk = Resident::count();

        $totalPenerima = MonitoringDistribusi::count();

        $sudahAmbil = MonitoringDistribusi::where(
            'status_pengambilan',
            'sudah_ambil'
        )->count();

        $belumAmbil = MonitoringDistribusi::where(
            'status_pengambilan',
            'belum_ambil'
        )->count();

        // =========================
        // PERSENTASE REALISASI
        // =========================
        $realisasi = $totalPenerima > 0
            ? ($sudahAmbil / $totalPenerima) * 100
            : 0;

        // =========================
        // TOP RANKING TOPSIS
        // =========================
        $topRanking = MonitoringDistribusi::with('resident')
            ->orderBy('rank')
            ->take(5)
            ->get();

        return view('pages.dashboard', compact(
            'periode',
            'totalPenduduk',
            'totalPenerima',
            'sudahAmbil',
            'belumAmbil',
            'realisasi',
            'topRanking'
        ));
    }
}
