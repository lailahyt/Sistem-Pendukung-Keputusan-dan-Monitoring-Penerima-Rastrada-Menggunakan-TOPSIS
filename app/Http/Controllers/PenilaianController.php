<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use App\Models\Kriteria;
use App\Models\Subkriteria;
use App\Models\Penilaian;
use App\Models\PenilaianDetail;
use App\Models\Periode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PenilaianController extends Controller
{
    public function index()
    {
        $kriteria = Kriteria::all();
        $totalKriteria = $kriteria->count();

        $statusFilter = request('status');

        $periode = Periode::first();

        if (!$periode) {
            return redirect('/periode')->with('error', 'Silakan tambahkan periode terlebih dahulu');
        }

        $periode_id = request('periode_id') ?? $periode->id;

        $residents = Resident::with([
            'penilaian' => function ($q) use ($periode_id) {
                $q->where('periode_id', $periode_id);
            },
            'penilaian.penilaianDetail'
        ])->get();

        foreach ($residents as $p) {
            $penilaian = $p->penilaian->first();
            $detail = $penilaian ? $penilaian->penilaianDetail : collect();

            // rata-rata
            $p->rata_rata = $detail->count() > 0
                ? round($detail->avg('nilai'), 2)
                : null;

            // hitung kelengkapan
            $validCount = $detail
                ->filter(function ($d) {
                    return !is_null($d->kriteria_id)
                        && !is_null($d->subkriteria_id)
                        && !is_null($d->nilai);
                })
                ->pluck('kriteria_id')
                ->unique()
                ->count();

            $p->kelengkapan = $validCount . '/' . $totalKriteria;

            $terisi = $validCount;
            $total = $totalKriteria;

            if ($terisi == 0) {
                $p->status = 'belum';
                $p->status_label = 'Belum';
                $p->badge = 'secondary';
            } elseif ($terisi < $total) {
                $p->status = 'proses';
                $p->status_label = 'Proses';
                $p->badge = 'warning';
            } else {
                $p->status = 'selesai';
                $p->status_label = 'Selesai';
                $p->badge = 'success';
            }
        }

        if ($statusFilter) {
            $residents = $residents->filter(function ($p) use ($statusFilter) {
                return $p->status === $statusFilter;
            })->values();
        }

        $periodeList = Periode::all();

        return view('pages.penilaian.index', [
            'penduduk' => $residents,
            'kriteria' => $kriteria,
            'periodeList' => $periodeList,
            'periode_id' => $periode_id
        ]);
    }

    public function create($id)
    {
        $penduduk = Resident::findOrFail($id);
        $kriteria = Kriteria::with('subkriteria')->get();

        $periode_id = request('periode_id');

        return view('pages.penilaian.create', compact('penduduk', 'kriteria', 'periode_id'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'penduduk_id' => 'required|exists:residents,id',
            'subkriteria' => 'nullable|array',
            'subkriteria.*' => 'nullable|exists:subkriteria,id',
            'bukti.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'catatan.*' => 'nullable|string'
        ]);

        $periode_id = $request->periode_id ?? null;

        $penilaian = Penilaian::firstOrCreate([
            'penduduk_id' => $request->penduduk_id,
            'periode_id' => $periode_id
        ]);

        foreach ($request->subkriteria ?? [] as $kriteria_id => $sub_id) {

            if (!$sub_id) continue;

            $filePath = null;

            if ($request->hasFile("bukti.$kriteria_id")) {
                $file = $request->file("bukti.$kriteria_id");
                $filePath = $file->store('bukti_penilaian', 'public');
            }

            $sub = Subkriteria::find($sub_id);
            if (!$sub) continue;

            $data = [
                'subkriteria_id' => $sub_id,
                'nilai' => $sub->nilai,
                'catatan' => $request->catatan[$kriteria_id] ?? null
            ];

            if ($filePath) {
                $data['bukti_file'] = $filePath;
            }

            PenilaianDetail::updateOrCreate(
                [
                    'penilaian_id' => $penilaian->id,
                    'kriteria_id' => $kriteria_id
                ],
                $data
            );
        }

        return redirect('/penilaian')->with('success', 'Penilaian berhasil disimpan');
    }

    public function edit($id)
    {
        $penduduk = Resident::findOrFail($id);
        $kriteria = Kriteria::with('subkriteria')->get();

        $periode_id = request('periode_id');

        $penilaian = Penilaian::where('penduduk_id', $id)
            ->where('periode_id', $periode_id)
            ->first();

        $detail = $penilaian
            ? PenilaianDetail::where('penilaian_id', $penilaian->id)->get()->keyBy('kriteria_id')
            : collect();

        return view('pages.penilaian.edit', [
            'penduduk' => $penduduk,
            'kriteria' => $kriteria,
            'penilaian' => $detail,
            'periode_id' => $periode_id
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'subkriteria' => 'nullable|array',
            'bukti.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'catatan.*' => 'nullable|string'
        ]);

        $periode_id = $request->periode_id;

        $penilaian = Penilaian::where('penduduk_id', $id)
            ->where('periode_id', $periode_id)
            ->firstOrFail();

        foreach ($request->subkriteria as $kriteria_id => $sub_id) {

            if (!$sub_id) continue;

            $detail = PenilaianDetail::where([
                'penilaian_id' => $penilaian->id,
                'kriteria_id' => $kriteria_id
            ])->first();

            $filePath = $detail->bukti_file ?? null;

            if ($request->hasFile("bukti.$kriteria_id")) {
                $file = $request->file("bukti.$kriteria_id");
                $filePath = $file->store('bukti_penilaian', 'public');
            }

            $sub = Subkriteria::findOrFail($sub_id);

            PenilaianDetail::updateOrCreate(
                [
                    'penilaian_id' => $penilaian->id,
                    'kriteria_id' => $kriteria_id
                ],
                [
                    'subkriteria_id' => $sub_id,
                    'nilai' => $sub->nilai,
                    'bukti_file' => $filePath,
                    'catatan' => $request->catatan[$kriteria_id] ?? null
                ]
            );
        }

        return redirect('/penilaian')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $periode_id = request('periode_id');

        $penilaian = Penilaian::where('penduduk_id', $id)
            ->where('periode_id', $periode_id)
            ->firstOrFail();

        $detail = PenilaianDetail::where('penilaian_id', $penilaian->id)->get();

        foreach ($detail as $item) {
            if ($item->bukti_file) {
                Storage::disk('public')->delete($item->bukti_file);
            }
        }

        PenilaianDetail::where('penilaian_id', $penilaian->id)->delete();
        $penilaian->delete();

        return redirect('/penilaian')->with('success', 'Data berhasil dihapus');
    }

    public function detailJson($id)
    {
        $periode_id = request('periode_id');

        $penilaian = Penilaian::with('penilaianDetail.kriteria', 'penilaianDetail.subkriteria')
            ->where('penduduk_id', $id)
            ->where('periode_id', $periode_id)
            ->first();

        if (!$penilaian) {
            return response()->json([]);
        }

        $data = $penilaian->penilaianDetail->map(function ($d) {
            return [
                'kriteria' => [
                    'nama_kriteria' => $d->kriteria->nama_kriteria ?? '-'
                ],
                'subkriteria' => [
                    'label_subkriteria' => $d->subkriteria->label_subkriteria ?? '-'
                ],
                'nilai' => $d->nilai,
                'bukti_file' => $d->bukti_file,
                'catatan' => $d->catatan,
            ];
        });

        return response()->json($data);
    }
}
