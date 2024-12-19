<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash; 
use App\Models\User;
use App\Models\Admin;

class EditProfileAdminController extends Controller
{
    public function editProfileAdmin()
    {
        $user = Auth::user();
        $admin = $user->admin;
        if(!$admin){
            $admin = new \App\Models\Admin();
        }

        return view('admin.editProfile-admin', compact('user', 'admin'));
    }

    public function updateProfileAdmin(Request $request)
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

        $admin = $user->admin;
        if(!$admin){
            Admin::create([
                'nama' => $request->nama,
                'user_id' => $user->id
            ]);
        }

        $admin->nama = $request->nama;
        $admin->save();

        return redirect()->route('editProfileAdmin')->with('success', 'Profile updated successfully.');
    }
}
