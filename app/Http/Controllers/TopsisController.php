<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use App\Services\TopsisService;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

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

        $data = $topsisService->calculate($periode_id);

        if (!isset($data['message'])) {

            $data['matriksPaginate'] = $this->paginateArray(
                $data['matriks'],
                5,
                'matriks_page'
            );

            $data['normalisasiPaginate'] = $this->paginateArray(
                collect($data['normalisasi'])->map(function ($row, $index) use ($data) {
                    return [
                        'nama' => $data['matriks'][$index]['nama'],
                        'data' => $row,
                    ];
                })->toArray(),
                5,
                'normalisasi_page'
            );

            $data['terbobotPaginate'] = $this->paginateArray(
                collect($data['terbobot'])->map(function ($row, $index) use ($data) {
                    return [
                        'nama' => $data['matriks'][$index]['nama'],
                        'data' => $row,
                    ];
                })->toArray(),
                5,
                'terbobot_page'
            );

            $data['jarakPaginate'] = $this->paginateArray(
                collect($data['matriks'])->map(function ($row, $index) use ($data) {
                    return [
                        'nama' => $row['nama'],
                        'positif' => $data['jarakPositif'][$index],
                        'negatif' => $data['jarakNegatif'][$index],
                    ];
                })->toArray(),
                5,
                'jarak_page'
            );

            $data['preferensiPaginate'] = $this->paginateArray(
                $data['hasil'],
                5,
                'preferensi_page'
            );

            $data['rankingPaginate'] = $this->paginateArray(
                $data['hasil'],
                5,
                'ranking_page'
            );
        }

        return view('pages.topsis.index', array_merge(
            $data,
            [
                'periode_id' => $periode_id,
                'periodeList' => $periodeList
            ]
        ));
    }

    private function paginateArray($items, $perPage, $pageName)
    {
        $page = request()->input($pageName, 1);

        $collection = Collection::make($items);

        return new LengthAwarePaginator(
            $collection->forPage($page, $perPage),
            $collection->count(),
            $perPage,
            $page,
            [
                'path' => request()->url(),
                'pageName' => $pageName,
                'query' => request()->query(),
            ]
        );
    }
}
