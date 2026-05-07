<?php

namespace App\Http\Controllers;

use App\Models\MonitoringDistribusi;
use App\Models\Periode;

use Barryvdh\DomPDF\Facade\Pdf;

use Maatwebsite\Excel\Facades\Excel;

use App\Exports\LaporanExport;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
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
        // DATA LAPORAN
        // =========================

        $laporan = MonitoringDistribusi::with('resident')
            ->where('periode_id', $periode_id)
            ->orderBy('rank')
            ->get();

        // =========================
        // STATISTIK
        // =========================

        $total = $laporan->count();

        $sudahAmbil = $laporan
            ->where('status_pengambilan', 'sudah_ambil')
            ->count();

        $belumAmbil = $laporan
            ->where('status_pengambilan', 'belum_ambil')
            ->count();

        return view('pages.report.index', compact(
            'laporan',
            'periode',
            'periode_id',
            'periodeList',
            'total',
            'sudahAmbil',
            'belumAmbil'
        ));
    }

    public function exportPdf(Request $request)
    {
        $periode_id = $request->periode_id;

        $periode = Periode::findOrFail($periode_id);

        $laporan = MonitoringDistribusi::with('resident')
            ->where('periode_id', $periode_id)
            ->orderBy('rank')
            ->get();

        $pdf = Pdf::loadView('pages.report.pdf', [
            'laporan' => $laporan,
            'periode' => $periode
        ]);

        return $pdf->stream('laporan-rastrada.pdf');
    }

    public function exportExcel(Request $request)
    {
        $periode_id = $request->periode_id;

        return Excel::download(
            new LaporanExport($periode_id),
            'laporan-rastrada.xlsx'
        );
    }
}
