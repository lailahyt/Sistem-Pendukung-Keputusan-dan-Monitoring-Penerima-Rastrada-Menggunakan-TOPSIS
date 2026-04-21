<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function account_request_view()
    {
        $users= User::where('status', 'submitted')->get();
        // $residents = Resident::where('user_id',null)->get(); // Assuming you want to show residents in the account request view
        // Logic to handle the account request view
        return view('pages.account-request.index',[
            'users' => $users,
            // 'residents' => $residents,
        ]); // Assuming you have an account request view
    }

        public function account_approval(Request $request, $userId)
    {
        // $request->validate([
        //     'for' => ['required', Rule::in(['approve', 'reject', 'activate', 'deactivate'])],
        //     'resident_id'=> ['nullable', 'exists:residents,id'], // Validate that user_id exists in residents table
        // ]);

        $for = $request->input('for');

        $user = User::findOrFail($userId);
        $user->status = ($for== 'approve' || $for == 'activate') ? 'approved' : 'rejected'; // Update the status to approved
        $user->save();

        // $residentId = $request->input('resident_id');

        // if($request->has('resident_id') && isset($residentId)){
        //     Resident::where('id', $residentId)->update([
        //         'user_id' => $user->id, // Associate the resident with the user
        //     ]);
        // }

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
