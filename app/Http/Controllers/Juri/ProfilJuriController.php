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
    $user = auth()->user();
    $juri = $user->juri; // Relasi juri dari user
    $mataLombas = MataLomba::all();

    if ($request->isMethod('post')) {
        // Validasi data dari tabel Juri
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
            'mata_lomba_id' => 'nullable|exists:mata_lombas,id',
        ]);

        if ($juri) {
            // Jika Juri sudah ada, lakukan update
            $juri->update($validatedJuriData);
        } else {
            // Jika Juri belum ada, lakukan create
            $validatedJuriData['user_id'] = $user->id; // Pastikan ada kolom user_id di tabel juri
            Juri::create($validatedJuriData);
        }

        return redirect()->route('juri.profil_juri')
            ->with('success', 'Profil juri berhasil disimpan.');
    }

    return view('juri.profil_juri', compact('juri', 'mataLombas'));
}

}
