<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    // 🔹 Menampilkan data
    public function index()
    {
        $pegawai = Pegawai::with('user')->get();
        return view('pages.employee.index', [
            'pegawai' => $pegawai,
        ]);
    }

    // 🔹 Form tambah
    public function create()
    {
        return view('pages.employee.create');
    }

    // 🔹 Simpan data
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jabatan' => 'required'
        ]);

        Pegawai::create($request->all());

        return redirect('/employee')->with('success', 'Data berhasil ditambahkan');
    }

    // 🔹 Form edit
    public function edit($id)
    {
        $pegawai = Pegawai::where('id', $id)->firstOrFail();

        return view('pages.employee.edit', compact('pegawai'));
    }

    // 🔹 Update data
    public function update(Request $request, $id)
    {
        $pegawai = Pegawai::findOrFail($id);

        $pegawai->update($request->all());

        return redirect('/employee')->with('success', 'Data berhasil diupdate');
    }

    // 🔹 Hapus data
    public function destroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);

        if ($pegawai->user_id) {

            $user = User::find($pegawai->user_id);

            if ($user) {
                $user->delete();
            }
        }

        $pegawai->delete();

        return redirect('/employee')
            ->with('success', 'Data pegawai dan akun berhasil dihapus');
    }
}
