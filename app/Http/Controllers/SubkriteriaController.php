<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subkriteria;
use App\Models\Kriteria;

class SubkriteriaController extends Controller
{
    public function index($id)
    {
        $kriteria = Kriteria::findOrFail($id);
        $subkriteria = Subkriteria::where('kriteria_id', $id)->get();

        return view('pages.subkriteria.index', [
            'kriteria' => $kriteria,
            'subkriteria' => $subkriteria
        ]);
    }

    public function create(int $id)
    {
        $kriteria = Kriteria::findOrFail($id);

        return view('pages.subkriteria.create', [
            'kriteria' => $kriteria
        ]);
    }

    public function store(Request $request, int $id)
    {
        $request->validate([
            'label_subkriteria' => 'required',
            'nilai' => 'required|integer|min:1|max:5',
            'keterangan' => 'nullable'
        ]);

        Subkriteria::create([
            'kriteria_id' => $id,
            'label_subkriteria' => $request->label_subkriteria,
            'nilai' => $request->nilai,
            'keterangan' => $request->keterangan,
        ]);

        return redirect('/kriteria/' . $id . '/subkriteria')
            ->with('success', 'Data subkriteria berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'label_subkriteria' => 'required',
            'nilai' => 'required|integer|min:1|max:5',
            'keterangan' => 'nullable'
        ]);

        $subkriteria = Subkriteria::findOrFail($id);

        $subkriteria->update([
            'label_subkriteria' => $request->label_subkriteria,
            'nilai' => $request->nilai,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->back()
            ->with('success', 'Subkriteria berhasil diupdate');
    }

    public function destroy($id)
    {
        $subkriteria = Subkriteria::findOrFail($id);

        $subkriteria->delete();

        return redirect()->back()
            ->with('success', 'Subkriteria berhasil dihapus');
    }
}
