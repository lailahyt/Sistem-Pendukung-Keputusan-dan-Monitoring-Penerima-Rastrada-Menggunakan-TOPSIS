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

            $data['hasilPaginate'] = $this->paginateArray(
                $data['hasil'],
                5,
                'hasil_page'
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
