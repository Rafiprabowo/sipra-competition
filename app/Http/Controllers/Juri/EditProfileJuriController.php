<?php

namespace App\Http\Controllers\Juri;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash; 
use App\Models\User;
use App\Models\Juri;

class EditProfileJuriController extends Controller
{
    public function editProfileJuri()
    {
        $user = Auth::user();
        $juri = Juri::where('user_id', $user->id)->first();

        return view('juri.editProfile-juri', compact('user', 'juri'));
    }

    public function updateProfileJuri(Request $request)
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

        $juri = Juri::where('user_id', $user->id)->first();
        $juri->nama = $request->nama;
        $juri->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}
