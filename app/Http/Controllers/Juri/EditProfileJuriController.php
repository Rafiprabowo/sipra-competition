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
        $juri = $user->juri;
        if(!$juri){
            $juri = new \App\Models\Juri();
        }

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

        // Ambil data juri terkait user
        $juri = $user->juri;

        if (!$juri) {
            // Jika juri tidak ada, buat baru
            Juri::create([
                'user_id' => $user->id, // Pastikan ada foreign key ke user
                'nama' => $request->nama,
            ]);
        } else {
            // Jika juri ada, perbarui datanya
            $juri->update([
                'nama' => $request->nama,
            ]);
        }
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}
