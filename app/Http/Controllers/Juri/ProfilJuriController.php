<?php

namespace App\Http\Controllers\Juri;

use App\Http\Controllers\Controller;
use App\Models\Juri;
use Illuminate\Http\Request;

class ProfilJuriController extends Controller
{
    public function index() { 
        $juris = Juri::all(); 
        return view('juri.profil_juri.index', compact('juris')); 
    } 
        
    public function create() { 
        return view('juri.profil_juri.create'); 
    } 
        
    public function store(Request $request) { 
        $request->validate([ 
            'nama' => 'required', 
            'kwartir_cabang' => 'required', 
            'pangkalan' => 'required', 
            'tanggal_lahir' => 'required', 
            'jenis_kelamin' => 'required', 
            'alamat' => 'required', 
            'no_hp' => 'required', 
            'pengalaman_juri' => 'nullable', 
            'pekerjaan' => 'nullable', 
            'mata_lomba_id' => 'required', 
        ]); 
        
        Juri::create($request->all()); 
        return redirect()->route('juri.profil_juri.index')->with('success', 'Juri berhasil ditambahkan.'); 
    } 
        
    public function edit(Juri $juri) { 
        return view('juri.profil_juri.edit', compact('juri')); 
    } 
        
    public function update(Request $request, Juri $juri) { 
        $request->validate([ 
            'nama' => 'required', 
            'kwartir_cabang' => 'required', 
            'pangkalan' => 'required', 
            'tanggal_lahir' => 'required', 
            'jenis_kelamin' => 'required', 
            'alamat' => 'required', 
            'no_hp' => 'required', 
            'pengalaman_juri' => 'nullable', 
            'pekerjaan' => 'nullable', 
            'mata_lomba_id' => 'required', 
        ]); 
        
        $juri->update($request->all()); 
        return redirect()->route('juri.profil_juri.index')->with('success', 'Juri berhasil diperbarui.'); 
    } 
        
    public function destroy(Juri $juri) { 
        $juri->delete(); 
        return redirect()->route('juri.profil_juri.index')->with('success', 'Juri berhasil dihapus.');
    }
}
