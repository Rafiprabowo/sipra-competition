<?php

namespace App\Http\Controllers\Juri;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash; 
use App\Models\User;
use App\Models\Juri;
use Illuminate\Support\Facades\Storage;

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

        // Jika ada gambar baru yang diunggah
        if ($request->hasFile('foto_profil')) {
            // Menghapus gambar lama jika ada
            if ($user->profil) {
                Storage::disk('public')->delete($user->image);
            }

            // Menyimpan gambar baru dengan cara yang sama seperti di method store
            $imagePath = $request->file('foto_profil')->store('images', 'public');  // Menyimpan gambar di folder 'images'
            $user->foto_profil = $imagePath;
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
