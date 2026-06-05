<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kriteria;

class KriteriaController extends Controller
{
    // Helper: cek apakah user adalah Admin (role_id = 1)
    private function isAdmin(): bool
    {
        return auth()->user()->role_id == 1;
    }

    public function index()
    {
        $kriteria = Kriteria::all();
        return view('pages.kriteria.index', [
            'kriteria' => $kriteria,
        ]);
    }

    public function create()
    {
        abort_if(!$this->isAdmin(), 403, 'Akses ditolak.');
        return view('pages.kriteria.create');
    }

    public function store(Request $request)
    {
        abort_if(!$this->isAdmin(), 403, 'Akses ditolak.');

        $request->validate([
            'kode'          => 'required|unique:kriteria,kode',
            'nama_kriteria' => 'required',
            'bobot'         => 'required|numeric',
            'atribut'       => 'required|in:benefit,cost',
            'butuh_bukti'   => 'required|boolean',
        ]);

        Kriteria::create([
            'kode'          => $request->kode,
            'nama_kriteria' => $request->nama_kriteria,
            'bobot'         => $request->bobot,
            'atribut'       => $request->atribut,
            'butuh_bukti'   => $request->butuh_bukti,
        ]);

        return redirect('/kriteria')->with('success', 'Data kriteria berhasil ditambahkan');
    }

    public function edit($kode)
    {
        abort_if(!$this->isAdmin(), 403, 'Akses ditolak.');

        $kriteria = Kriteria::where('kode', $kode)->firstOrFail();
        return view('pages.kriteria.edit', compact('kriteria'));
    }

    public function update(Request $request, $kode)
    {
        abort_if(!$this->isAdmin(), 403, 'Akses ditolak.');

        $request->validate([
            'nama_kriteria' => 'required',
            'bobot'         => 'required|numeric',
            'atribut'       => 'required|in:benefit,cost',
            'butuh_bukti'   => 'required|boolean',
        ]);

        $kriteria = Kriteria::where('kode', $kode)->firstOrFail();
        $kriteria->update([
            'nama_kriteria' => $request->nama_kriteria,
            'bobot'         => $request->bobot,
            'atribut'       => $request->atribut,
            'butuh_bukti'   => $request->butuh_bukti,
        ]);

        return redirect('/kriteria')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($kode)
    {
        abort_if(!$this->isAdmin(), 403, 'Akses ditolak.');

        $kriteria = Kriteria::where('kode', $kode)->firstOrFail();
        $kriteria->delete();

        return redirect('/kriteria')->with('success', 'Data berhasil dihapus');
    }

    public function toggle($id)
    {
        abort_if(!$this->isAdmin(), 403, 'Akses ditolak.');

        $kriteria = Kriteria::findOrFail($id);
        $kriteria->update(['is_active' => !$kriteria->is_active]);

        return redirect()->back()->with('success', 'Status kriteria berhasil diubah');
    }
}
