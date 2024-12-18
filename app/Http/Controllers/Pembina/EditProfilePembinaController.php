<?php

namespace App\Http\Controllers\Pembina;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash; 
use App\Models\User;
use App\Models\Pembina;

class EditProfilePembinaController extends Controller
{
    public function editProfilePembina()
    {
        $user = Auth::user();
        $pembina = Pembina::where('user_id', $user->id)->first();

        return view('pembina.editProfile-pembina', compact('user', 'pembina'));
    }

    public function updateProfilePembina(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:users,username,' . Auth::id(),
            'password' => 'nullable|string|confirmed',
            'nama' => 'required|string',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = Auth::user();
        $user->username = $request->username;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('foto_profil')) {
            $path = $request->file('foto_profil')->store('profile_pictures', 'public');
            $user->foto_profil = $path;
        }

        $user->save();

        $pembina = Pembina::where('user_id', $user->id)->first();
        $pembina->nama = $request->nama;
        $pembina->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}
