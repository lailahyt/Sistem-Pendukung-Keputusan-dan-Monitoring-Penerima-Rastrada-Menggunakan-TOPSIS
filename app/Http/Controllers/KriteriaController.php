<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kriteria;

class KriteriaController extends Controller
{
    public function index()
    {
        $kriteria = Kriteria::all();
        return view('pages.kriteria.index', [
            'kriteria' => $kriteria,
        ]);
    }

    public function create()
    {
        return view('pages.kriteria.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:kriteria,kode',
            'nama_kriteria' => 'required',
            'bobot' => 'required|numeric',
            'atribut' => 'required|in:benefit,cost',
        ]);

        Kriteria::create([
            'kode' => $request->kode,
            'nama_kriteria' => $request->nama_kriteria,
            'bobot' => $request->bobot,
            'atribut' => $request->atribut,
        ]);

        return redirect('/kriteria')->with('success', 'Data kriteria berhasil ditambahkan');
    }
}
