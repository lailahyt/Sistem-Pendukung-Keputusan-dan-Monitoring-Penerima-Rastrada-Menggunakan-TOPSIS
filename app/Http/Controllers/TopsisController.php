<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use App\Models\Kriteria;
use App\Models\Periode;
use Illuminate\Http\Request;

class TopsisController extends Controller
{
    public function index()
    {
        $periode = Periode::first();

        if (!$periode) {
            return redirect('/periode')->with('error', 'Tambahkan periode terlebih dahulu');
        }

        $periode_id = request('periode_id') ?? $periode->id;

        $kriteria = Kriteria::all();

        // ✅ ambil dari PENILAIAN langsung
        $penilaianList = \App\Models\Penilaian::with([
            'resident',
            'penilaianDetail'
        ])
            ->where('periode_id', $periode_id)
            ->where('status', 'selesai')
            ->get();

        // 🔥 bentuk matriks keputusan
        $matriks = [];

        foreach ($penilaianList as $p) {

            $row = [];

            foreach ($kriteria as $k) {

                $detail = $p->penilaianDetail
                    ->where('kriteria_id', $k->id)
                    ->first();

                $row[$k->id] = $detail->nilai ?? 0;
            }

            $matriks[] = [
                'nama' => $p->resident->nama,
                'data' => $row
            ];
        }

        // 🔥 NORMALISASI
        $normalisasi = [];
        $pembagi = [];

        foreach ($kriteria as $k) {
            $sum = 0;

            foreach ($matriks as $row) {
                $sum += pow($row['data'][$k->id], 2);
            }

            $pembagi[$k->id] = sqrt($sum);
        }

        foreach ($matriks as $i => $row) {
            foreach ($kriteria as $k) {
                $nilai = $row['data'][$k->id];

                $normalisasi[$i][$k->id] = $pembagi[$k->id] == 0
                    ? 0
                    : $nilai / $pembagi[$k->id];
            }
        }

        $periodeList = Periode::all();

        return view('pages.topsis.index', compact(
            'matriks',
            'kriteria',
            'periode_id',
            'periodeList',
            'normalisasi'
        ));
    }
}
