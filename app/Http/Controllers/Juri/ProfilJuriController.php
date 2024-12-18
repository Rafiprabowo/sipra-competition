<?php

namespace App\Http\Controllers\Juri;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Juri;
use App\Models\User;
use App\Models\MataLomba;
use Illuminate\Support\Facades\Hash;

class ProfilJuriController extends Controller
{
    public function createOrUpdate(Request $request)
    {
        $juri = Juri::firstOrNew(['user_id' => auth()->id()]);
        $mataLombas = MataLomba::all();
        
        if ($request->isMethod('post')) {
            // Validasi untuk data dari tabel Juri
            $validatedJuriData = $request->validate([
                'nama' => 'required|string|max:255',
                'alamat' => 'nullable|string|max:255',
                'tanggal_lahir' => 'nullable|date',
                'jenis_kelamin' => 'required|string|max:1',
                'no_hp' => 'nullable|string|max:15',
                'kwartir_cabang' => 'nullable|string|max:255',
                'pangkalan' => 'nullable|string|max:255',
                'pengalaman_juri' => 'nullable|string|max:255',
                'pekerjaan' => 'nullable|string|max:255',
                'mata_lomba_id' => 'required|exists:mata_lombas,id'
            ]);
            
            // Validasi untuk data dari tabel Users
            $validatedUserData = $request->validate([
                'username' => 'required|string|max:255|unique:users,username,' . auth()->id(),
                'password' => 'nullable|string|confirmed'
            ]);
            
            // Update or create Juri
            $juri->fill($validatedJuriData);
            $juri->user_id = auth()->id();
            $juri->save();
            
            // Update User
            $user = User::findOrFail(auth()->id());
            $user->username = $validatedUserData['username'];
            
            if ($request->filled('password')) {
                $user->password = Hash::make($validatedUserData['password']);
            }
            
            $user->save();
        }
        return view('juri.profil_juri', compact('juri', 'mataLombas'));
    }
}
