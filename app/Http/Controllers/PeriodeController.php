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
        ]);

        Periode::create([
            'nama_periode' => $request->nama_periode,
        ]);

        return back()->with('success', 'Periode berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_periode' => 'required|string|max:255',
        ]);

        $periode = Periode::findOrFail($id);
        $periode->update([
            'nama_periode' => $request->nama_periode,
        ]);

        return back()->with('success', 'Periode berhasil diupdate');
    }

    public function destroy($id)
    {
        Periode::findOrFail($id)->delete();
        return back()->with('success', 'Periode berhasil dihapus');
    }
}
