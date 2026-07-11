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

            'foto_ktp' => 'required|image|max:2048',

            'foto_distribusi' => 'required|image|max:2048',

            'catatan' => 'nullable|string'
        ]);

        $monitoring = MonitoringDistribusi::findOrFail($id);

        // upload bukti
        $fotoKtp = $monitoring->foto_ktp;
        $fotoDistribusi = $monitoring->bukti_distribusi;

        if ($request->hasFile('foto_ktp')) {

            $fotoKtp = $request->file('foto_ktp')
                ->store('foto_ktp', 'public');
        }

        if ($request->hasFile('foto_distribusi')) {

            $fotoDistribusi = $request->file('foto_distribusi')
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
            'foto_ktp' => $fotoKtp,
            'bukti_distribusi' => $fotoDistribusi,
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

    public function tetapkanKuota(
        Request $request,
        TopsisService $topsisService
    ) {

        $request->validate([
            'periode_id' => 'required'
        ]);

        $periode = Periode::findOrFail(
            $request->periode_id
        );

        $kuota = $periode->kuota ?? 0;

        if ($kuota <= 0) {

            return back()->with(
                'error',
                'Kuota penerima belum diisi.'
            );
        }

        $data = $topsisService->calculate(
            $periode->id
        );

        $hasil = $data['hasil'];

        $berhasil = 0;

        foreach ($hasil as $row) {

            if ($row['rank'] > $kuota) {
                continue;
            }

            $cek = MonitoringDistribusi::where(
                'penduduk_id',
                $row['id']
            )
                ->where(
                    'periode_id',
                    $periode->id
                )
                ->exists();

            if (!$cek) {

                MonitoringDistribusi::create([

                    'penduduk_id' => $row['id'],

                    'periode_id' => $periode->id,

                    'rank' => $row['rank'],

                    'nilai_preferensi' => $row['nilai'],

                    'status_pengambilan' => 'belum_ambil'

                ]);

                $berhasil++;
            }
        }

        return back()->with(
            'success',
            $berhasil . ' penerima RASTRADA berhasil ditetapkan.'
        );
    }

    public function batalkan($id)
    {
        // Hanya Admin
        if (Auth::user()->role->name !== 'Admin') {
            abort(403);
        }

        $monitoring = MonitoringDistribusi::findOrFail($id);

        // Jangan izinkan jika sudah diambil
        if ($monitoring->status_pengambilan == 'sudah_ambil') {

            return back()->with(
                'error',
                'Data yang sudah didistribusikan tidak dapat dibatalkan.'
            );
        }

        $monitoring->delete();

        return redirect('/monitoring')
            ->with(
                'success',
                'Penetapan berhasil dibatalkan.'
            );
    }
}
