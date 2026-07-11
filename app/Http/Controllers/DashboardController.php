<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use App\Models\MonitoringDistribusi;
use App\Models\Kriteria;
use App\Models\Periode;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function index()
    {
        $role = Auth::user()?->role?->name;
        $user = Auth::user();

        // =========================
        // PERIODE AKTIF
        // =========================
        $periode = Periode::latest()->first();

        // =========================
        // STATISTIK DISTRIBUSI
        // (dipakai semua role)
        // =========================
        $totalPenerima = MonitoringDistribusi::count();

        $sudahAmbil = MonitoringDistribusi::where('status_pengambilan', 'sudah_ambil')->count();

        $belumAmbil = MonitoringDistribusi::where('status_pengambilan', 'belum_ambil')->count();

        // =========================
        // PERSENTASE REALISASI
        // =========================
        $realisasi = $totalPenerima > 0
            ? ($sudahAmbil / $totalPenerima) * 100
            : 0;

        // =========================
        // TOP 5 RANKING TOPSIS
        // (dipakai semua role termasuk Lurah)
        // =========================
        $topRanking = MonitoringDistribusi::with('resident')
            ->orderBy('rank')
            ->take(5)
            ->get();

        // =========================
        // TOTAL PENDUDUK
        if ($role === 'RT/RW') {

            $totalPenduduk = Resident::whereHas('wilayah', function ($q) use ($user) {

                $q->where('rt', $user->rt)
                    ->where('rw', $user->rw);
            })->count();

            $totalLakiLaki = Resident::where('jenis_kelamin', 'L')
                ->whereHas('wilayah', function ($q) use ($user) {

                    $q->where('rt', $user->rt)
                        ->where('rw', $user->rw);
                })->count();

            $totalPerempuan = Resident::where('jenis_kelamin', 'P')
                ->whereHas('wilayah', function ($q) use ($user) {

                    $q->where('rt', $user->rt)
                        ->where('rw', $user->rw);
                })->count();
        } else {

            $totalPenduduk = ($role === 'Admin' || $role === 'Petugas')
                ? Resident::count()
                : 0;

            $totalLakiLaki = 0;
            $totalPerempuan = 0;
        }

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
            'totalKriteria',
            'totalLakiLaki',
            'totalPerempuan'
        ));
    }
}
