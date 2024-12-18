<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Juri;
use App\Models\User;
use App\Models\MataLomba;

class JuriController extends Controller
{
    public function index()
    {
        $juri = Juri::with('mata_lomba')->get();
        return view('admin.juri.index', compact('juri'));
    }

    public function create()
    {
        $mataLombas = MataLomba::all();
        return view('admin.juri.create', compact('mataLombas'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'kwartir_cabang' => 'required|string|max:255',
            'pangkalan' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string|max:255',
            'no_hp' => 'required|string|max:255',
            'username' => 'required|unique:users,username',
            'password' => 'required|confirmed',
            'mata_lomba_id' => 'required',
        ]);

        // Create user
        $user = User::create([
            'username' => $validatedData['username'],
            'password' => Hash::make($validatedData['password']),
            'role' => 'juri'
        ]);

        // Create juri
        $juri = Juri::create([
            'nama' => $validatedData['nama'],
            'kwartir_cabang' => $validatedData['kwartir_cabang'],
            'pangkalan' => $validatedData['pangkalan'],
            'jenis_kelamin' => $validatedData['jenis_kelamin'],
            'no_hp' => $validatedData['no_hp'],
            'user_id' => $user->id,
            'mata_lomba_id' => $validatedData['mata_lomba_id']
        ]);

        return redirect()->route('juri.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $mataLombas = MataLomba::all();
        $juri = Juri::with('mata_lomba')->findOrFail($id);
        $user = User::findOrFail($juri->user_id);

        return view('admin.juri.edit', compact('juri', 'user', 'mataLombas'));
    }

    public function update(Request $request, $id)
    {
        $juri = Juri::findOrFail($id);
        $user = User::findOrFail($juri->user_id);

        $validatedData = $request->validate([
            'nama' => 'required',
            'kwartir_cabang' => 'required',
            'pangkalan' => 'required',
            'jenis_kelamin' => 'required',
            'no_hp' => 'required',
            'username' => 'required|unique:users,username,' . $user->id,
            'password' => 'nullable|confirmed',
            'mata_lomba_id' => 'required',
        ]);

        $juri->update([
            'nama' => $validatedData['nama'],
            'kwartir_cabang' => $validatedData['kwartir_cabang'],
            'pangkalan' => $validatedData['pangkalan'],
            'jenis_kelamin' => $validatedData['jenis_kelamin'],
            'no_hp' => $validatedData['no_hp'],
            'mata_lomba_id' => $validatedData['mata_lomba_id']
        ]);

        $user->username = $validatedData['username'];

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('juri.index')->with('success', 'Data berhasil diupdate!');
    }

    public function destroy($id)
    {
        $juri = Juri::findOrFail($id);
        User::destroy($juri->user_id);
        $juri->delete();

        return redirect()->route('juri.index')->with('success', 'Data berhasil dihapus!');
    }
}
