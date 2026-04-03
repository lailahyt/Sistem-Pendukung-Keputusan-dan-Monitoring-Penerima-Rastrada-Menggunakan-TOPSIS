<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function login()
    {
        return view('pages.auth.login'); // Assuming you have a login view
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $userStatus = Auth::user()->status;

            if ($userStatus === 'submitted') {
                // $this->_logout($request);
                return back()->withErrors([
                    'email' => 'Akun anda belum disetujui, silahkan tunggu konfirmasi dari admin.',
                ]);
            } elseif ($userStatus === 'rejected') {
                // $this->_logout($request);
                return back()->withErrors([
                    'email' => 'Akun anda ditolak oleh admin.',
                ]);
            }

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'Terjadi kesalahan, periksa kembali email atau password anda.',
        ])->onlyInput('email');
    }

        public function registerView()
    {
        return view('pages.auth.register'); // Assuming you have a register view
    }

        public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->role_id = 2;
        $user->saveOrFail();

        return redirect('/')->with('success', 'Registrasi berhasil, silahkan tunggu konfirmasi dari admin.');
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

}
