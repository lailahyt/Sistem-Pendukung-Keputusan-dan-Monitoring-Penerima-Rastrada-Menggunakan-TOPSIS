<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use App\Models\Kriteria;
use App\Models\Periode;
use App\Models\Penilaian;
use App\Models\PenilaianDetail;
use App\Models\Subkriteria;
use App\Models\BantuanLain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PenilaianController extends Controller
{
    public function index()
    {
        $kriteria = Kriteria::where('is_active', true)->get();
        $totalKriteria = $kriteria->count();

        $statusFilter = request('status');

        $periode = Periode::first();

        if (!$periode) {
            return redirect('/periode')->with('error', 'Silakan tambahkan periode terlebih dahulu');
        }

        $periode_id = request('periode_id') ?? $periode->id;

        $periodeAktif = Periode::find($periode_id);

        $tahunPeriode = $periodeAktif->tahun;

        $excludedResidents = BantuanLain::where('tahun', $tahunPeriode)
            ->pluck('penduduk_id')
            ->toArray(); 

        $residents = Resident::where('status', 'active')
            ->whereNotIn('id', $excludedResidents)
            ->with([
                'penilaian' => function ($q) use ($periode_id) {
                    $q->where('periode_id', $periode_id);
                },
                'penilaian.penilaianDetail'
            ])
            ->orderBy('id', 'asc')
            ->get();

        foreach ($residents as $p) {

            $penilaian = optional($p->penilaian)->first();

            $detail = $penilaian
                ? $penilaian->penilaianDetail->filter(function ($d) {
                    return !is_null($d->nilai);
                })
                : collect();

            // rata-rata
            $p->rata_rata = $detail->count() > 0
                ? round($detail->avg('nilai'), 2)
                : null;

            // kelengkapan
            $validCount = $detail
                ->pluck('kriteria_id')
                ->unique()
                ->count();

            $p->kelengkapan = $validCount . '/' . $kriteria->count();

            // 🔥 hitung status real
            if ($penilaian) {
                if ($validCount == 0) {
                    $status = 'belum';
                } elseif ($validCount < $kriteria->count()) {
                    $status = 'proses';
                } else {
                    $status = 'selesai';
                }

                // sync ke DB
                if ($penilaian->status !== $status) {
                    $penilaian->update(['status' => $status]);
                }
            }

            // tampilkan status dari DB
            $status = $penilaian->status ?? 'belum';

            $p->status = $status;
            $p->status_label = ucfirst($status);

            $p->badge = match ($status) {
                'selesai' => 'success',
                'proses' => 'warning',
                default => 'secondary'
            };
        }

        // filter status
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
        $periode_id = request('periode_id');

        $penilaian = Penilaian::where('penduduk_id', $id)
            ->where('periode_id', $periode_id)
            ->first();

        if ($penilaian && $penilaian->isLocked()) {
            return redirect('/penilaian?periode_id=' . $periode_id)
                ->with('error', 'Penilaian yang telah selesai tidak dapat diubah.');
        }

        $penduduk = Resident::findOrFail($id);

        $kriteria = Kriteria::where('is_active', true)
            ->with('subkriteria')
            ->get();

        return view('pages.penilaian.create', compact(
            'penduduk',
            'kriteria',
            'periode_id'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'penduduk_id' => 'required|exists:residents,id',
            'subkriteria' => 'required|array',
            'subkriteria.*' => 'required|exists:subkriteria,id',
            'bukti.*' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'catatan.*' => 'nullable|string'
        ]);

        $periode_id = $request->periode_id ?? Periode::first()->id;

        $penilaian = Penilaian::firstOrCreate([
            'penduduk_id' => $request->penduduk_id,
            'periode_id' => $periode_id
        ]);

        if ($penilaian->isLocked()) {
            return redirect('/penilaian?periode_id=' . $periode_id)
                ->with('error', 'Penilaian yang telah selesai tidak dapat diubah.');
        }

        foreach ($request->subkriteria ?? [] as $kriteria_id => $sub_id) {

            if (!$sub_id) continue;

            $filePath = null;

            if ($request->hasFile("bukti.$kriteria_id")) {
                $filePath = $request->file("bukti.$kriteria_id")
                    ->store('bukti_penilaian', 'public');
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

        //  FIX STATUS BERDASARKAN DATA DB
        $jumlahTerisi = PenilaianDetail::where('penilaian_id', $penilaian->id)
            ->whereNotNull('subkriteria_id')
            ->count();

        $totalKriteria = Kriteria::where('is_active', true)->count();

        if ($jumlahTerisi == 0) {
            $penilaian->update(['status' => 'belum']);
        } elseif ($jumlahTerisi < $totalKriteria) {
            $penilaian->update(['status' => 'proses']);
        } else {
            $penilaian->update(['status' => 'selesai']);
        }

        return redirect('/penilaian?periode_id=' . $periode_id)
            ->with('success', 'Penilaian berhasil disimpan');
    }

    public function edit($id)
    {
        $penduduk = Resident::findOrFail($id);
        $kriteria = Kriteria::where('is_active', true)
            ->with('subkriteria')
            ->get();

        $periode_id = request('periode_id');

        if (!$periode_id) {
            return redirect('/penilaian')->with('error', 'Periode tidak dipilih');
        }

        $penilaian = Penilaian::where('penduduk_id', $id)
            ->where('periode_id', $periode_id)
            ->first();

        if ($penilaian) {
            foreach ($penilaian->penilaianDetail as $d) {
                $detail[$d->kriteria_id] = [
                    'subkriteria_id' => $d->subkriteria_id,
                    'catatan' => $d->catatan,
                    'bukti_file' => $d->bukti_file
                ];
            }
        }

        $detail = [];

        if ($penilaian) {
            foreach ($penilaian->penilaianDetail as $d) {
                $detail[$d->kriteria_id] = [
                    'subkriteria_id' => $d->subkriteria_id,
                    'catatan' => $d->catatan,
                    'bukti_file' => $d->bukti_file
                ];
            }
        }

        return view('pages.penilaian.edit', compact(
            'penduduk',
            'kriteria',
            'detail',
            'periode_id'
        ));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'subkriteria' => 'required|array',
            'subkriteria.*' => 'required|exists:subkriteria,id',
            'bukti.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'catatan.*' => 'nullable|string'
        ]);

        $periode_id = $request->periode_id;

        $penilaian = Penilaian::where('penduduk_id', $id)
            ->where('periode_id', $periode_id)
            ->firstOrFail();

        foreach ($request->subkriteria ?? [] as $kriteria_id => $sub_id) {

            if (!$sub_id) continue;

            $detail = PenilaianDetail::where([
                'penilaian_id' => $penilaian->id,
                'kriteria_id' => $kriteria_id
            ])->first();

            $filePath = $detail->bukti_file ?? null;

            if ($request->hasFile("bukti.$kriteria_id")) {
                $filePath = $request->file("bukti.$kriteria_id")
                    ->store('bukti_penilaian', 'public');
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

        // update status konsisten
        $jumlahTerisi = PenilaianDetail::where('penilaian_id', $penilaian->id)
            ->whereNotNull('subkriteria_id')
            ->count();

        $totalKriteria = Kriteria::where('is_active', true)->count();

        if ($jumlahTerisi == 0) {
            $penilaian->update(['status' => 'belum']);
        } elseif ($jumlahTerisi < $totalKriteria) {
            $penilaian->update(['status' => 'proses']);
        } else {
            $penilaian->update(['status' => 'selesai']);
        }

        return redirect('/penilaian?periode_id=' . $request->periode_id)
            ->with('success', 'Data penilaian berhasil diperbarui');
    }

    public function destroy(Request $request, $id)
    {
        $periode_id = $request->periode_id;

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

        $detail = PenilaianDetail::where('penilaian_id', $penilaian->id)->get();

        foreach ($detail as $item) {
            if ($item->bukti_file) {
                Storage::disk('public')->delete($item->bukti_file);
            }
        }

        PenilaianDetail::where('penilaian_id', $penilaian->id)->delete();
        $penilaian->delete();

        return redirect('/penilaian?periode_id=' . $periode_id)
            ->with('success', 'Data berhasil dihapus');
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
