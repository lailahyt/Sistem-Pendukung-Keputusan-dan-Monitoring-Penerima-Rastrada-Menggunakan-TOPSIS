<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Models\Pegawai;

class UserController extends Controller
{
    public function account_request_view()
    {
        $users= User::where('status', 'submitted')->get();
        $pegawai = Pegawai::where('user_id',null)->get(); // Assuming you want to show pegawai in the account request view
        // Logic to handle the account request view
        return view('pages.account-request.index',[
            'users' => $users,
            'pegawai' => $pegawai,
        ]); // Assuming you have an account request view
    }

        public function account_approval(Request $request, $userId)
    {
        $request->validate([
            'for' => ['required', Rule::in(['approve', 'reject', 'activate', 'deactivate'])],
            'pegawai_id'=> ['nullable', 'exists:pegawai,id'], // Validate that user_id exists in pegawai table
        ]);

        $for = $request->input('for');

        $user = User::findOrFail($userId);
        $user->status = ($for== 'approve' || $for == 'activate') ? 'approved' : 'rejected'; // Update the status to approved
        $user->save();

        $pegawaiId = $request->input('pegawai_id');

        if($request->has('pegawai_id') && isset($pegawaiId)){
            Pegawai::where('id', $pegawaiId)->update([
                'user_id' => $user->id, // Associate the pegawai with the user
            ]);
        }

        if($for == 'activate') {
            return back()->with('success', 'Akun berhasil diaktifkan.');
        } elseif ($for == 'deactivate') {
            return back()->with('success', 'Akun berhasil dinonaktifkan.');
        }

        return back()->with('success',$for == 'approve' ? 'Akun berhasil disetujui.' : 'Akun berhasil ditolak.');
    }

        public function account_list_view()
    {
        $users = User::where('role_id', 2)->where('status','!=','submitted')->paginate(5);
        return view('pages.account-list.index',[
            'users' => $users,
        ]); // Assuming you have an account list view
    }


}
