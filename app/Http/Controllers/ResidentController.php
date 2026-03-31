<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resident;

class ResidentController extends Controller
{
    public function index()
    {
        $residents = Resident::all();
        return view('pages.resident.index', [
            'residents' => $residents,
        ]);
    }

    public function create()
    {
        // Logic to show the form for creating a new resident
        return view('pages.resident.create');
    }

    public function store(Request $request)
    {
        // Logic to store a new resident in the database
        $validatedData = $request->validate([
            'nik' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'desa' => 'required',
            'kecamatan' => 'required',
            'penghasilan' => 'required|integer',
            'tanggungan' => 'required|integer',
            'kondisi_rumah' => 'required',
        ]);

        Resident::create($validatedData);
        return redirect('/resident')->with('success', 'Data berhasil di simpan.');
    }

    public function edit($id)
    {
        // Logic to show the form for editing an existing resident
        $resident = Resident::findOrFail($id);
        return view('pages.resident.edit', [
            'resident' => $resident,
        ]);
    }

    public function update(Request $request, $id)
    {
        // Logic to update an existing resident in the database
        $validated = $request->validate([
            'nik' => 'required' ,
            'nama' => 'required',
            'alamat' => 'required',
            'desa' => 'required',
            'kecamatan' => 'required',
            'penghasilan' => 'required|integer',
            'tanggungan' => 'required|integer',
            'kondisi_rumah' => 'required',
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
