<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use App\Models\Kriteria;
use App\Models\Subkriteria;
use App\Models\PenilaianDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PenilaianController extends Controller
{
    public function index()
    {
        $kriteria = Kriteria::all();

        $residents = Resident::withCount([
            'penilaianDetail as penilaian_detail_count'
        ])->get();

        // hitung rata-rata (opsional)
        foreach ($residents as $p) {
            $detail = PenilaianDetail::where('penduduk_id', $p->id)->get();

            $p->rata_rata = $detail->count() > 0
                ? round($detail->avg('nilai'), 2)
                : null;
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

        return view('pages.penilaian.create', [
            'penduduk' => $penduduk,
            'kriteria' => $kriteria
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'penduduk_id' => 'required|exists:residents,id',
            'subkriteria' => 'required|array',
            'subkriteria.*' => 'required|exists:subkriteria,id',
            'bukti.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'catatan.*' => 'nullable|string'
        ]);

        $penduduk_id = $request->penduduk_id;

        foreach ($request->subkriteria as $kriteria_id => $sub_id) {

            $sub = Subkriteria::findOrFail($sub_id);
            $filePath = null;

            if ($request->hasFile("bukti.$kriteria_id")) {
                $file = $request->file("bukti.$kriteria_id");
                $filePath = $file->store('bukti_penilaian', 'public');
            }

            PenilaianDetail::updateOrCreate(
                [
                    'penduduk_id' => $penduduk_id,
                    'kriteria_id' => $kriteria_id
                ],
                [
                    'penduduk_id' => $penduduk_id,
                    'kriteria_id' => $kriteria_id,
                    'subkriteria_id' => $sub_id,
                    'nilai' => $sub->nilai,
                    'bukti_file' => $filePath,
                    'catatan' => $request->catatan[$kriteria_id] ?? null
                ]
            );
        }

        return redirect('/penilaian')->with('success', 'Penilaian berhasil disimpan');
    }

    public function detailJson($id)
    {
        $data = PenilaianDetail::with(['kriteria', 'subkriteria'])
            ->where('penduduk_id', $id)
            ->get();

        return response()->json($data);
    }
}
