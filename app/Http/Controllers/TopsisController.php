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
            return redirect('/periode')
                ->with('error', 'Tambahkan periode terlebih dahulu');
        }

        $periode_id = request('periode_id') ?? $periode->id;

        $kriteria = Kriteria::all();

        // Ambil data penilaian
        $penilaianList = \App\Models\Penilaian::with([
            'resident',
            'penilaianDetail'
        ])
            ->where('periode_id', $periode_id)
            ->where('status', 'selesai')
            ->get();

        // =========================
        // MATRlKS KEPUTUSAN
        // =========================
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

        // =========================
        // NORMALISASI
        // =========================
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

                $normalisasi[$i][$k->id] =
                    $pembagi[$k->id] == 0
                    ? 0
                    : $nilai / $pembagi[$k->id];
            }
        }

        // =========================
        // NORMALISASI TERBOBOT
        // =========================
        $terbobot = [];

        foreach ($matriks as $i => $row) {

            foreach ($kriteria as $k) {

                $bobot = $k->bobot;

                $terbobot[$i][$k->id] =
                    $normalisasi[$i][$k->id] * $bobot;
            }
        }

        // =========================
        // SOLUSI IDEAL
        // =========================
        $idealPositif = [];
        $idealNegatif = [];

        foreach ($kriteria as $k) {

            $column = [];

            foreach ($terbobot as $row) {

                $column[] = $row[$k->id];
            }

            // BENEFIT
            if ($k->atribut == 'benefit') {

                $idealPositif[$k->id] = max($column);
                $idealNegatif[$k->id] = min($column);
            }

            // COST
            else {

                $idealPositif[$k->id] = min($column);
                $idealNegatif[$k->id] = max($column);
            }
        }

        // =========================
        // JARAK SOLUSI
        // =========================
        $jarakPositif = [];
        $jarakNegatif = [];

        foreach ($terbobot as $i => $row) {

            $sumPositif = 0;
            $sumNegatif = 0;

            foreach ($kriteria as $k) {

                $sumPositif += pow(
                    $row[$k->id] - $idealPositif[$k->id],
                    2
                );

                $sumNegatif += pow(
                    $row[$k->id] - $idealNegatif[$k->id],
                    2
                );
            }

            $jarakPositif[$i] = sqrt($sumPositif);
            $jarakNegatif[$i] = sqrt($sumNegatif);
        }

        // =========================
        // NILAI PREFERENSI
        // =========================
        $preferensi = [];

        foreach ($matriks as $i => $row) {

            $dPlus = $jarakPositif[$i];
            $dMinus = $jarakNegatif[$i];

            $preferensi[$i] =
                ($dPlus + $dMinus) == 0
                ? 0
                : $dMinus / ($dPlus + $dMinus);
        }

        // =========================
        // RANKING
        // =========================
        $ranking = [];

        foreach ($matriks as $i => $row) {

            $ranking[] = [
                'nama' => $row['nama'],
                'nilai' => $preferensi[$i]
            ];
        }

        usort($ranking, function ($a, $b) {
            return $b['nilai'] <=> $a['nilai'];
        });

        $periodeList = Periode::all();

        return view('pages.topsis.index', compact(
            'matriks',
            'kriteria',
            'periode_id',
            'periodeList',
            'normalisasi',
            'terbobot',
            'idealPositif',
            'idealNegatif',
            'jarakPositif',
            'jarakNegatif',
            'preferensi',
            'ranking'
        ));
    }
}
