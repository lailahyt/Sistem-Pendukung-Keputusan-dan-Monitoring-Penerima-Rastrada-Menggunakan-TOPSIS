<?php

namespace App\Services;

use App\Models\Resident;
use App\Models\Kriteria;
use App\Models\Periode;
use App\Models\Penilaian;

class TopsisService
{
    public function calculate($periode_id)
    {
        $kriteria = Kriteria::where('is_active', true)->get();

        // =========================
        // AMBIL DATA PENILAIAN
        // =========================
        $penilaianList = Penilaian::with([
            'resident',
            'penilaianDetail'
        ])
            ->where('periode_id', $periode_id)
            ->where('status', 'selesai')
            ->orderBy('penduduk_id', 'asc')
            ->get();

        // VALIDASI DATA KOSONG
        if ($penilaianList->isEmpty()) {

            return [
                'kriteria' => $kriteria,
                'matriks' => [],
                'normalisasi' => [],
                'terbobot' => [],
                'idealPositif' => [],
                'idealNegatif' => [],
                'jarakPositif' => [],
                'jarakNegatif' => [],
                'hasil' => [],
                'message' => 'Belum ada data penilaian pada periode ini.'
            ];
        }

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
                'id' => $p->resident->id,
                'nama' => $p->resident->nama,
                'nik' => $p->resident->nik,
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

                $terbobot[$i][$k->id] =
                    $normalisasi[$i][$k->id] * $k->bobot;
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

            if ($k->atribut == 'benefit') {

                $idealPositif[$k->id] = max($column);
                $idealNegatif[$k->id] = min($column);
            } else {

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
        $hasil = [];

        foreach ($matriks as $i => $row) {

            $dPlus = $jarakPositif[$i];
            $dMinus = $jarakNegatif[$i];

            $nilai = ($dPlus + $dMinus) == 0
                ? 0
                : $dMinus / ($dPlus + $dMinus);

            $hasil[] = [
                'id' => $row['id'],
                'nama' => $row['nama'],
                'nik' => $row['nik'],
                'nilai' => $nilai
            ];
        }

        // =========================
        // SORTING
        // =========================
        usort($hasil, function ($a, $b) {
            return $b['nilai'] <=> $a['nilai'];
        });

        // =========================
        // HASIL RANKING
        // =========================
        foreach ($hasil as $i => &$row) {

            $row['rank'] = $i + 1;
        }

        return [
            'kriteria' => $kriteria,
            'matriks' => $matriks,
            'normalisasi' => $normalisasi,
            'terbobot' => $terbobot,
            'idealPositif' => $idealPositif,
            'idealNegatif' => $idealNegatif,
            'jarakPositif' => $jarakPositif,
            'jarakNegatif' => $jarakNegatif,
            'hasil' => $hasil
        ];
    }
}
