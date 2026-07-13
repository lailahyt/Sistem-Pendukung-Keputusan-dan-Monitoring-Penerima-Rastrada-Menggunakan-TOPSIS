<?php

namespace App\Http\Controllers;

use App\Models\BantuanLain;
use App\Models\Resident;
use Illuminate\Http\Request;

class BantuanLainController extends Controller
{
    public function index(Request $request)
    {
        $query = BantuanLain::with('resident');

        if ($request->filled('tahun')) {
            $query->where('tahun', $request->tahun);
        }

        $dataBantuan = $query->latest()->get();

        return view('pages.bantuan-lain.index', [
            'dataBantuan' => $dataBantuan,
        ]);
    }

    public function create()
    {
        $residents = Resident::where('status', 'active')
            ->orderBy('nama')
            ->get();

        return view('pages.bantuan-lain.create', [
            'residents' => $residents,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'penduduk_id' => 'required|exists:residents,id',
            'nama_bantuan' => 'required|string|max:100',
            'tahun' => 'required|digits:4',
            'keterangan' => 'nullable|string',
        ]);

        $exists = BantuanLain::where('penduduk_id', $request->penduduk_id)
            ->where('nama_bantuan', $request->nama_bantuan)
            ->where('tahun', $request->tahun)
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->with('error', 'Data bantuan sudah terdaftar.');
        }

        BantuanLain::create([
            'penduduk_id' => $request->penduduk_id,
            'nama_bantuan' => $request->nama_bantuan,
            'tahun' => $request->tahun,
            'keterangan' => $request->keterangan,
        ]);

        return redirect('/bantuan-lain')
            ->with('success', 'Data bantuan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $bantuan = BantuanLain::findOrFail($id);

        $residents = Resident::where('status', 'active')
            ->orderBy('nama')
            ->get();

        return view('pages.bantuan-lain.edit', compact(
            'bantuan',
            'residents'
        ));
    }

    public function update(Request $request, $id)
    {
        $bantuan = BantuanLain::findOrFail($id);

        $request->validate([
            'penduduk_id' => 'required|exists:residents,id',
            'nama_bantuan' => 'required|string|max:100',
            'tahun' => 'required|digits:4',
            'keterangan' => 'nullable|string',
        ]);

        $exists = BantuanLain::where('penduduk_id', $request->penduduk_id)
            ->where('nama_bantuan', $request->nama_bantuan)
            ->where('tahun', $request->tahun)
            ->where('id', '!=', $id)
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->with('error', 'Data bantuan sudah terdaftar.');
        }

        $bantuan->update([
            'penduduk_id' => $request->penduduk_id,
            'nama_bantuan' => $request->nama_bantuan,
            'tahun' => $request->tahun,
            'keterangan' => $request->keterangan,
        ]);

        return redirect('/bantuan-lain')
            ->with('success', 'Data bantuan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $bantuan = BantuanLain::findOrFail($id);

        $bantuan->delete();

        return redirect('/bantuan-lain')
            ->with('success', 'Data bantuan berhasil dihapus.');
    }
}
