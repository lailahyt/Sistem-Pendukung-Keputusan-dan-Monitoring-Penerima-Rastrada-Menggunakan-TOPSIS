<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use App\Models\MonitoringDistribusi;
use App\Models\Kriteria;
use App\Models\Periode;
use App\Services\TopsisService;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(TopsisService $topsisService)
    {
        $role = Auth::user()?->role?->name;

        // =========================
        // PERIODE AKTIF
        // =========================
        $periode = Periode::latest()->first();

        // =========================
        // STATISTIK DISTRIBUSI
        // (dipakai semua role)
        // =========================
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
        // TOP 5 RANKING TOPSIS
        // (menggunakan hasil perhitungan TOPSIS)
        // =========================
        $dataTopsis = $topsisService->calculate($periode->id);

        $topRanking = collect($dataTopsis['hasil'] ?? [])
            ->take(5);

        // =========================
        // TOTAL PENDUDUK
        // (hanya Admin & Petugas)
        // =========================
        $totalPenduduk = ($role === 'Admin' || $role === 'Petugas')
            ? Resident::count()
            : 0;

        // =========================
        // TOTAL KRITERIA AKTIF
        // (hanya Admin)
        // =========================
        $totalKriteria = $role === 'Admin'
            ? Kriteria::where('is_active', true)->count()
            : 0;

        return view('pages.dashboard', compact(
            'periode',
            'totalPenduduk',
            'totalPenerima',
            'sudahAmbil',
            'belumAmbil',
            'realisasi',
            'topRanking',
            'totalKriteria'
        ));
    }
}
