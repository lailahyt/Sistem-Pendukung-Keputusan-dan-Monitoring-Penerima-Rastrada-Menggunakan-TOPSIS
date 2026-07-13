<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use Illuminate\Http\Request;

class PeriodeController extends Controller
{
public function index()
{
    $periode = Periode::latest()->get();
    return view('pages.periode.index', compact('periode'));
}

public function store(Request $request)
{
    $request->validate([
        'nama_periode' => 'required|string|max:255',
        'tahun' => 'required|digits:4'
    ]);

    Periode::create([
        'nama_periode' => $request->nama_periode,
        'tahun' => $request->tahun
    ]);

    return back()->with(
        'success',
        'Periode berhasil ditambahkan'
    );
}

public function update(Request $request, $id)
{
    $request->validate([
        'nama_periode' => 'required|string|max:255',
        'tahun' => 'required|digits:4'
    ]);

    $periode = Periode::findOrFail($id);

    $periode->update([
        'nama_periode' => $request->nama_periode,
        'tahun' => $request->tahun
    ]);

    return back()->with(
        'success',
        'Periode berhasil diupdate'
    );
}

    public function destroy($id)
    {
        Periode::findOrFail($id)->delete();
        return back()->with('success', 'Periode berhasil dihapus');
    }

    public function kuotaIndex()
    {
        $periode = Periode::latest()->get();

        return view(
            'pages.kuota.index',
            compact('periode')
        );
    }

    public function updateKuota(Request $request, Periode $periode)
    {
        $request->validate([
            'kuota' => 'required|integer|min:0'
        ]);

        $periode->update([
            'kuota' => $request->kuota
        ]);

        return redirect()
            ->route('kuota.index')
            ->with('success', 'Kuota berhasil diperbarui.');
    }
}
