<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use App\Models\Wilayah;
use App\Models\MonitoringDistribusi;
use Illuminate\Support\Facades\DB;

class LandingController extends Controller
{
    public function index()
    {
        $totalPenduduk = Resident::count();

        $totalRW = Wilayah::distinct('rw')
            ->count('rw');

        $totalRT = Wilayah::distinct('rt')
            ->count('rt');

        $totalPenerima = MonitoringDistribusi::count();

        $totalDistribusi = MonitoringDistribusi::where(
            'status_pengambilan',
            'sudah_ambil'
        )->count();

        $pendudukPerRW = DB::table('residents')
            ->join('wilayah', 'residents.wilayah_id', '=', 'wilayah.id')
            ->select(
                'wilayah.rw',
                DB::raw('COUNT(residents.id) as total_penduduk')
            )
            ->groupBy('wilayah.rw')
            ->orderBy('wilayah.rw')
            ->get();

        return view('landingpage', compact(
            'totalPenduduk',
            'totalRW',
            'totalRT',
            'totalPenerima',
            'totalDistribusi',
            'pendudukPerRW'
        ));
    }
}
