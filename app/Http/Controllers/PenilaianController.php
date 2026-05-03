<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use App\Models\Kriteria;
use App\Models\Subkriteria;
use App\Models\Penilaian;
use App\Models\PenilaianDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PenilaianController extends Controller
{
    private $periode;

    public function __construct(Request $request)
    {
        $this->periode = $request->periode ?? date('Y');
    }

    public function index()
    {
        $kriteria = Kriteria::all();
        $totalKriteria = $kriteria->count();

        $periode = request('periode', date('Y'));
        $statusFilter = request('status');

        $residents = Resident::whereHas('penilaian', function ($q) use ($periode, $statusFilter) {
            $q->where('periode', $periode);

            if ($statusFilter) {
                $q->where('status', $statusFilter);
            }
        })
            ->with([
                'penilaian' => function ($q) use ($periode) {
                    $q->where('periode', $periode);
                },
                'penilaian.penilaianDetail'
            ])
            ->get();

        foreach ($residents as $p) {
            $penilaian = Penilaian::where('penduduk_id', $p->id)
                ->where('periode', $periode)
                ->first();

            $detail = $penilaian ? $penilaian->penilaianDetail : collect();

            // rata-rata
            $p->rata_rata = $detail->count() > 0
                ? round($detail->avg('nilai'), 2)
                : null;

            // hitung kelengkapan
            $validCount = $detail
                ->whereNotNull('subkriteria_id')
                ->whereNotNull('nilai')
                ->pluck('kriteria_id')
                ->unique()
                ->count();

            $p->kelengkapan = $validCount . '/' . $totalKriteria;

            // 🔥 AMBIL STATUS DARI DATABASE
            $p->status = $penilaian->status ?? 'belum';
        }

        // 🔥 FILTER STATUS (case insensitive)
        if ($statusFilter) {
            $residents = $residents->filter(function ($p) use ($statusFilter) {
                return strtolower($p->status) === strtolower($statusFilter);
            })->values();
        }

        return view('pages.penilaian.index', [
            'penduduk' => $residents,
            'kriteria' => $kriteria
        ]);
    }

    public function create($id)
    {
        $penduduk = Resident::findOrFail($id);
        $kriteria = Kriteria::with('subkriteria')->get();

        return view('pages.penilaian.create', compact('penduduk', 'kriteria'));
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

        $periode = $request->periode ?? date('Y');

        $penilaian = Penilaian::firstOrCreate([
            'penduduk_id' => $request->penduduk_id,
            'periode' => $periode
        ]);

        foreach ($request->subkriteria as $kriteria_id => $sub_id) {

            if (!$sub_id) continue;

            $filePath = null;

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

        return redirect('/penilaian')->with('success', 'Penilaian berhasil disimpan');
    }

    public function edit($id)
    {
        $penduduk = Resident::findOrFail($id);
        $kriteria = Kriteria::with('subkriteria')->get();

        $penilaian = Penilaian::where('penduduk_id', $id)
            ->where('periode', $this->periode)
            ->first();

        $detail = $penilaian
            ? PenilaianDetail::where('penilaian_id', $penilaian->id)->get()->keyBy('kriteria_id')
            : collect();

        return view('pages.penilaian.edit', [
            'penduduk' => $penduduk,
            'kriteria' => $kriteria,
            'penilaian' => $detail
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'subkriteria' => 'nullable|array',
            'bukti.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'catatan.*' => 'nullable|string'
        ]);

        $penilaian = Penilaian::where('penduduk_id', $id)
            ->where('periode', $this->periode)
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
        $penilaian = Penilaian::where('penduduk_id', $id)
            ->where('periode', $this->periode)
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
        $periode = request('periode') ?? date('Y');

        $penilaian = Penilaian::where('penduduk_id', $id)
            ->where('periode', $periode)
            ->first();

        if (!$penilaian) {
            return response()->json([]);
        }

        $data = PenilaianDetail::with(['kriteria', 'subkriteria'])
            ->where('penilaian_id', $penilaian->id)
            ->get();

        return response()->json(
            $data->map(function ($item) {
                return [
                    'kriteria' => $item->kriteria,
                    'subkriteria' => $item->subkriteria,
                    'nilai' => $item->nilai,
                    'catatan' => $item->catatan,
                    'bukti_file' => $item->bukti_file
                        ? asset('storage/' . $item->bukti_file)
                        : null
                ];
            })
        );
    }
}
