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
        $user = Auth::user();

        // =========================
        // PERIODE AKTIF
        // =========================
        $periode = Periode::first();

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
        $topRanking = collect();

        if ($periode) {

            $hasilTopsis = $topsisService->calculate($periode->id);

            $topRanking = collect($hasilTopsis['hasil'])
                ->take(5);
        }

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

        $rwLabels = [
            'RW 1',
            'RW 2',
            'RW 3',
            'RW 4',
            'RW 5',
        ];

        $rwTotals = [0, 0, 0, 0, 0];

        if ($periode) {

            $penerimaPerRw = MonitoringDistribusi::with([
                'resident.wilayah'
            ])
                ->where('periode_id', $periode->id)
                ->get()
                ->groupBy(function ($item) {

                    return optional(
                        optional($item->resident)->wilayah
                    )->rw;
                });

            foreach ($penerimaPerRw as $rw => $items) {

                if ($rw >= 1 && $rw <= 5) {

                    $rwTotals[$rw - 1] = $items->count();
                }
            }
        }

        return view('pages.dashboard', compact(
            'periode',
            'totalPenduduk',
            'totalPenerima',
            'sudahAmbil',
            'belumAmbil',
            'realisasi',
            'topRanking',
            'rwLabels',
            'rwTotals',
            'totalLakiLaki',
            'totalPerempuan'
        ));
    }
}
