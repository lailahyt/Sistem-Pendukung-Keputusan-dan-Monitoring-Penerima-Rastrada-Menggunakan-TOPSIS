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

        // Ambil data penduduk + penilaian sesuai periode
        $residents = Resident::with(['penilaian' => function ($q) use ($periode_id) {
            $q->where('periode_id', $periode_id);
        }, 'penilaian.penilaianDetail'])->get();

        //  Bentuk matriks keputusan
        $matriks = [];

        foreach ($residents as $r) {
            $row = [];

            foreach ($kriteria as $k) {
                $nilai = 0;

                if ($r->penilaian->first()) {
                    $detail = $r->penilaian->first()
                        ->penilaianDetail
                        ->where('kriteria_id', $k->id)
                        ->first();

                    $nilai = $detail->nilai ?? 0;
                }

                $row[$k->id] = $nilai;
            }

            $matriks[] = [
                'nama' => $r->nama,
                'data' => $row
            ];
        }

        // Normalisasi matriks
        $normalisasi = [];

        // hitung penyebut per kriteria
        $pembagi = [];
        foreach ($kriteria as $k) {
            $sum = 0;
            foreach ($matriks as $row) {
                $sum += pow($row['data'][$k->id], 2);
            }
            $pembagi[$k->id] = sqrt($sum);
        }

        // hitung normalisasi
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
