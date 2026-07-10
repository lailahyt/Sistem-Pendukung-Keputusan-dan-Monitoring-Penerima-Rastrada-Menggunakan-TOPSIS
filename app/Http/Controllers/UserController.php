<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Models\Pegawai;
use App\Models\Wilayah;

class UserController extends Controller
{
    public function account_request_view()
    {
        $users = User::where('status', 'submitted')->get();
        $pegawai = Pegawai::where('user_id', null)->get();
        return view('pages.account-request.index', [
            'users' => $users,
            'pegawai' => $pegawai,
        ]);
    }

    public function account_approval(Request $request, $userId)
    {
        $request->validate([
            'for' => ['required', Rule::in(['approve', 'reject', 'activate', 'deactivate'])],
            'pegawai_id' => ['nullable', 'exists:pegawai,id'], // Validate that user_id exists in pegawai table
        ]);

        $for = $request->input('for');

        $user = User::findOrFail($userId);
        $user->status = ($for == 'approve' || $for == 'activate') ? 'approved' : 'rejected'; // Update the status to approved
        $user->save();

        $pegawaiId = $request->input('pegawai_id');

        if ($request->has('pegawai_id') && isset($pegawaiId)) {
            Pegawai::where('id', $pegawaiId)->update([
                'user_id' => $user->id, // Associate the pegawai with the user
            ]);
        }

        if ($for == 'activate') {
            return back()->with('success', 'Akun berhasil diaktifkan.');
        } elseif ($for == 'deactivate') {
            return back()->with('success', 'Akun berhasil dinonaktifkan.');
        }

        return back()->with('success', $for == 'approve' ? 'Akun berhasil disetujui.' : 'Akun berhasil ditolak.');
    }

    public function account_list_view()
    {
        $users = User::with('role')
            ->where('role_id', '!=', 1)
            ->paginate(10);

        return view('pages.account-list.index', [
            'users' => $users,
        ]);
    }

    public function account_create_view()
    {
        $roles = Role::whereIn('id', [2, 3, 4])->get();

        $pegawaiPetugas = Pegawai::where('jabatan', 'Pegawai')
            ->whereNull('user_id')
            ->get();

        $pegawaiLurah = Pegawai::where('jabatan', 'Lurah')
            ->whereNull('user_id')
            ->get();

        $wilayah = Wilayah::orderBy('rt')->get();

        return view('pages.account-list.create', [
            'roles' => $roles,
            'pegawaiPetugas' => $pegawaiPetugas,
            'pegawaiLurah' => $pegawaiLurah,
            'wilayah' => $wilayah,
        ]);
    }

    public function account_store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'role_id' => 'required|exists:roles,id',
        ]);

        $role = Role::findOrFail($request->role_id);

        if ($role->name == 'Petugas' || $role->name == 'Lurah') {

            $request->validate([
                'pegawai_id' => 'required|exists:pegawai,id'
            ]);

            $pegawai = Pegawai::findOrFail($request->pegawai_id);

            if ($pegawai->user_id) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'pegawai_id' => 'Pegawai sudah memiliki akun.'
                    ]);
            }
        }

        if ($role->name == 'RT/RW') {

            $request->validate([
                'rt' => 'required',
                'rw' => 'required',
            ]);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'status' => 'approved',
            'rt' => $request->rt,
            'rw' => $request->rw,
        ]);

        if ($request->filled('pegawai_id')) {

            Pegawai::where('id', $request->pegawai_id)
                ->update([
                    'user_id' => $user->id
                ]);
        }

        return redirect('/account-list')
            ->with('success', 'Akun berhasil ditambahkan.');
    }

    public function account_edit_view($id)
    {
        $user = User::findOrFail($id);

        $roles = Role::whereIn('id', [2, 3, 4])->get();

        $pegawaiPetugas = Pegawai::where(function ($query) use ($user) {
            $query->whereNull('user_id')
                ->orWhere('user_id', $user->id);
        })
            ->where('jabatan', 'Pegawai')
            ->get();

        $pegawaiLurah = Pegawai::where(function ($query) use ($user) {
            $query->whereNull('user_id')
                ->orWhere('user_id', $user->id);
        })
            ->where('jabatan', 'Lurah')
            ->get();

        $wilayah = Wilayah::orderBy('rt')->get();

        return view('pages.account-list.edit', [
            'user' => $user,
            'roles' => $roles,
            'pegawaiPetugas' => $pegawaiPetugas,
            'pegawaiLurah' => $pegawaiLurah,
            'wilayah' => $wilayah,
        ]);
    }

    public function account_update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'role_id' => 'required|exists:roles,id',
        ]);

        $role = Role::findOrFail($request->role_id);

        if ($role->id == 2 || $role->id == 3) {

            $request->validate([
                'pegawai_id' => 'required|exists:pegawai,id'
            ]);
        }

        if ($role->id == 4) {

            $request->validate([
                'rt' => 'required',
                'rw' => 'required',
            ]);
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'rt' => $request->rt,
            'rw' => $request->rw,
        ];

        if ($request->filled('password')) {

            $data['password'] =
                Hash::make($request->password);
        }

        $user->update($data);

        /*
    |--------------------------------------------------------------------------
    | Reset Relasi Pegawai Lama
    |--------------------------------------------------------------------------
    */

        Pegawai::where('user_id', $user->id)
            ->update([
                'user_id' => null
            ]);

        /*
    |--------------------------------------------------------------------------
    | Hubungkan Pegawai Baru
    |--------------------------------------------------------------------------
    */

        if ($request->filled('pegawai_id')) {

            Pegawai::where('id', $request->pegawai_id)
                ->update([
                    'user_id' => $user->id
                ]);
        }

        return redirect('/account-list')
            ->with('success', 'Akun berhasil diperbarui.');
    }
}
