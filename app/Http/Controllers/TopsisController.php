<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use App\Services\TopsisService;
use Illuminate\Http\Request;

class TopsisController extends Controller
{
    public function index(TopsisService $topsisService)
    {
        $periode = Periode::first();

        if (!$periode) {
            return redirect('/periode')
                ->with('error', 'Tambahkan periode terlebih dahulu');
        }

        $periode_id = request('periode_id') ?? $periode->id;

        $periodeList = Periode::all();

        // Ambil hasil perhitungan dari service
        $data = $topsisService->calculate($periode_id);

        return view('pages.topsis.index', array_merge(
            $data,
            [
                'periode_id' => $periode_id,
                'periodeList' => $periodeList
            ]
        ));
    }
}
