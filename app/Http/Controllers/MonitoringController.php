<?php

namespace App\Http\Controllers;

use App\Models\MonitoringDistribusi;
use App\Models\Periode;
use App\Models\User;
use App\Services\TopsisService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MonitoringController extends Controller
{
    public function index(TopsisService $topsisService)
    {
        // =========================
        // PERIODE
        // =========================
        $periode = Periode::first();

        if (!$periode) {
            return redirect('/periode')
                ->with('error', 'Periode belum tersedia');
        }

        $periode_id = request('periode_id') ?? $periode->id;

        $periode = Periode::findOrFail($periode_id);

        $periodeList = Periode::all();

        // =========================
        // HASIL TOPSIS
        // =========================
        $data = $topsisService->calculate($periode_id);

        $hasil = $data['hasil'];

        // =========================
        // FILTER STATUS
        // =========================
        $status = request('status');

        $query = MonitoringDistribusi::with('resident')
            ->where('periode_id', $periode_id);

        if ($status) {
            $query->where('status_pengambilan', $status);
        }

        $monitoring = $query
            ->orderBy('rank')
            ->get();

        // =========================
        // STATISTIK
        // =========================
        $totalPenerima = $monitoring->count();

        $sudahAmbil = $monitoring
            ->where('status_pengambilan', 'sudah_ambil')
            ->count();

        $belumAmbil = $monitoring
            ->where('status_pengambilan', 'belum_ambil')
            ->count();

        // Persentase
        $realisasi = $totalPenerima > 0
            ? ($sudahAmbil / $totalPenerima) * 100
            : 0;

        return view('pages.monitoring.index', compact(
            'monitoring',
            'periode',
            'periode_id',
            'periodeList',
            'totalPenerima',
            'sudahAmbil',
            'belumAmbil',
            'realisasi',
            'status'
        ));
    }

    public function edit($id)
    {
        $monitoring = MonitoringDistribusi::with('resident')
            ->findOrFail($id);

        return view('pages.monitoring.create', compact(
            'monitoring'
        ));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'diambil_oleh' => 'required',
            'nama_wakil' => 'nullable|string|max:255',
            'foto_bukti' => 'nullable|image|max:2048',
            'catatan' => 'nullable|string'
        ]);

        $monitoring = MonitoringDistribusi::findOrFail($id);

        // upload bukti
        $foto = $monitoring->bukti_distribusi;

        if ($request->hasFile('foto_bukti')) {

            $foto = $request->file('foto_bukti')
                ->store('bukti_distribusi', 'public');
        }

        // status pengambilan
        $status = 'sudah_ambil';

        // siapa yang mengambil
        $diambilOleh = $request->diambil_oleh;

        if ($diambilOleh == 'diwakilkan') {

            $diambilOleh = $request->nama_wakil;
        }

        $monitoring->update([
            'status_pengambilan' => $status,
            'tanggal_ambil' => now(),
            'diambil_oleh' => $diambilOleh,
            'petugas' => Auth::check()
                ? Auth::user()->name
                : 'Admin',
            'bukti_distribusi' => $foto,
            'catatan' => $request->catatan
        ]);

        return redirect('/monitoring')
            ->with('success', 'Distribusi berhasil dicatat');
    }

    public function show($id)
    {
        $monitoring = MonitoringDistribusi::with('resident')
            ->findOrFail($id);

        return view('pages.monitoring.show', compact(
            'monitoring'
        ));
    }

    public function tetapkan(Request $request)
    {
        $request->validate([
            'penduduk_id' => 'required',
            'periode_id' => 'required',
            'rank' => 'required',
            'nilai' => 'required'
        ]);

        $cek = MonitoringDistribusi::where(
            'penduduk_id',
            $request->penduduk_id
        )
            ->where(
                'periode_id',
                $request->periode_id
            )
            ->exists();

        if ($cek) {
            return redirect()->back()
                ->with(
                    'error',
                    'Calon penerima sudah ditetapkan pada periode ini.'
                );
        }

        MonitoringDistribusi::create([
            'penduduk_id' => $request->penduduk_id,
            'periode_id' => $request->periode_id,
            'rank' => $request->rank,
            'nilai_preferensi' => $request->nilai,
            'status_pengambilan' => 'belum_ambil',
        ]);

        return redirect()->back()
            ->with(
                'success',
                'Calon penerima berhasil ditetapkan.'
            );
    }
}
