<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resident;
use App\Models\Wilayah;

class ResidentController extends Controller
{
    public function index(Request $request)
    {
        $query = Resident::with('wilayah');

        if ($request->rw) {

            $query->whereHas('wilayah', function ($q) use ($request) {

                $q->where('rw', $request->rw);
            });
        }

        if ($request->rt) {

            $query->whereHas('wilayah', function ($q) use ($request) {

                $q->where('rt', $request->rt);
            });
        }

        $residents = $query
            ->orderBy('id', 'asc')
            ->get();

        $wilayah = Wilayah::all();

        return view('pages.resident.index', [
            'residents' => $residents,
            'wilayah' => $wilayah,
        ]);
    }

    public function create()
    {
        // Logic to show the form for creating a new resident
        $wilayah = Wilayah::all();

        return view('pages.resident.create', [
            'wilayah' => $wilayah
        ]);
    }

    public function store(Request $request)
    {
        // Logic to store a new resident in the database
        $validatedData = $request->validate([
            'nik' => 'required',
            'nama' => 'required',
            'usia' => 'required|integer|min:0',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required',
            'desa' => 'required',
            'kecamatan' => 'required',
            'wilayah_id' => 'nullable|exists:wilayah,id',
            'desil' => 'nullable|integer',
            'status' => 'required|in:active,moved,deceased',
        ]);

        Resident::create($validatedData);
        return redirect('/resident')->with('success', 'Data berhasil di simpan.');
    }

    public function edit($id)
    {
        // Logic to show the form for editing an existing resident
        $resident = Resident::findOrFail($id);
        $wilayah = Wilayah::all();

        return view('pages.resident.edit', [
            'resident' => $resident,
            'wilayah' => $wilayah
        ]);
    }

    public function update(Request $request, $id)
    {
        // Logic to update an existing resident in the database
        $validatedData = $request->validate([
            'nik' => 'required',
            'nama' => 'required',
            'usia' => 'required|integer|min:0',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required',
            'desa' => 'required',
            'kecamatan' => 'required',
            'wilayah_id' => 'nullable|exists:wilayah,id',
            'desil' => 'nullable|integer',
            'status' => 'required|in:active,moved,deceased',
        ]);

        Resident::findOrFail($id)->update($validatedData);
        return redirect('/resident')->with('success', 'Data berhasil diupdate.');
    }

    public function destroy($id)
    {
        // Logic to delete a resident from the database
        $resident = Resident::findOrFail($id);
        $resident->delete();
        return redirect('/resident')->with('success', 'Data penduduk berhasil dihapus!');
    }
}
