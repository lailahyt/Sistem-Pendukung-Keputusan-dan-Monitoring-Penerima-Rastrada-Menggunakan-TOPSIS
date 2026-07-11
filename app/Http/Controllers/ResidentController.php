<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resident;
use App\Models\Wilayah;
use Illuminate\Support\Facades\Auth;

class ResidentController extends Controller
{
    public function index(Request $request)
    {
        $query = Resident::with('wilayah');

        $user = Auth::user();

        // RT/RW hanya melihat wilayahnya
        if ($user->role_id == 4) {

            $query->whereHas('wilayah', function ($q) use ($user) {

                $q->where('rt', $user->rt)
                    ->where('rw', $user->rw);
            });
        } else {

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
        }

        $residents = $query
            ->orderBy('id', 'asc')
            ->get();

        $wilayah = ($user->role_id == 4)
            ? Wilayah::where('rt', $user->rt)
            ->where('rw', $user->rw)
            ->get()
            : Wilayah::all();

        return view('pages.resident.index', [
            'residents' => $residents,
            'wilayah' => $wilayah,
        ]);
    }

    public function create()
    {
        $user = Auth::user();

        if ($user->role_id == 4) {

            $wilayah = Wilayah::where('rt', $user->rt)
                ->where('rw', $user->rw)
                ->get();
        } else {

            $wilayah = Wilayah::all();
        }

        return view('pages.resident.create', [
            'wilayah' => $wilayah
        ]);
    }

    public function store(Request $request)
    {

        // Logic to store a new resident in the database
        $validatedData = $request->validate([
            'nik' => 'required|digits:16|unique:residents,nik',
            'nama' => 'required',
            'usia' => 'required|integer|min:0|max:120',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required',
            'desa' => 'required',
            'kecamatan' => 'required',
            'wilayah_id' => 'nullable|exists:wilayah,id',
            'desil' => 'nullable|integer',
            'status' => 'required|in:active,moved,deceased',
        ]);

        $user = Auth::user();

        if ($user->role_id == 4) {

            $wilayah = Wilayah::where('rt', $user->rt)
                ->where('rw', $user->rw)
                ->first();

            $validatedData['wilayah_id'] = $wilayah->id;
        }

        Resident::create($validatedData);
        return redirect('/resident')->with('success', 'Data berhasil di simpan.');
    }

    public function edit($id)
    {
        $resident = Resident::with('wilayah')
            ->findOrFail($id);

        $user = Auth::user();

        if (
            $user->role_id == 4 &&
            (
                $resident->wilayah->rt != $user->rt ||
                $resident->wilayah->rw != $user->rw
            )
        ) {
            abort(403);
        }

        $wilayah = ($user->role_id == 4)
            ? Wilayah::where('rt', $user->rt)
            ->where('rw', $user->rw)
            ->get()
            : Wilayah::all();

        return view('pages.resident.edit', [
            'resident' => $resident,
            'wilayah' => $wilayah
        ]);
    }

    public function update(Request $request, $id)
    {
        $resident = Resident::with('wilayah')
            ->findOrFail($id);

        $user = Auth::user();

        if (
            $user->role_id == 4 &&
            (
                $resident->wilayah->rt != $user->rt ||
                $resident->wilayah->rw != $user->rw
            )
        ) {
            abort(403);
        }

        // Logic to update an existing resident in the database
        $validatedData = $request->validate([
            'nik' => 'required|digits:16|unique:residents,nik,' . $id,
            'nama' => 'required',
            'usia' => 'required|integer|min:0|max:120',
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
        $resident = Resident::with('wilayah')
            ->findOrFail($id);

        $user = Auth::user();

        if (
            $user->role_id == 4 &&
            (
                $resident->wilayah->rt != $user->rt ||
                $resident->wilayah->rw != $user->rw
            )
        ) {
            abort(403);
        }

        $resident->delete();

        return redirect('/resident')
            ->with('success', 'Data penduduk berhasil dihapus!');
    }
}
