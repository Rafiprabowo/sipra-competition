<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CbtSession;
use App\Models\MataLomba;
use Illuminate\Http\Request;

class ManajemenSesiCbtController extends Controller
{
    public function index(){
        $sessions = CbtSession::with('mataLomba')->get();
        return view('admin.sesi-cbt.index', compact('sessions'));
    }
    public function create(){
        $mataLombas = MataLomba::where('kategori', 'cbt')->get();
        return view('admin.sesi-cbt.create', compact('mataLombas'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required|after:waktu_mulai',
            'mata_lomba_id' => 'required|exists:mata_lombas,id'
        ], [
            'waktu_selesai.after' => 'Waktu selesai harus sesudah waktu mulai.'
        ]);
    
        CbtSession::create($validatedData);
        return redirect()->route('sesi-cbt.index')->with('success', 'Sesi berhasil ditambahkan!');
    }
    public function edit($id){
        $session = CbtSession::with('mataLomba')->find($id);
        if(!$session){
            return redirect()->route('sesi-cbt.index')->with('error', 'Sesi tidak ditemukan!');
        }
        $mataLombas = MataLomba::where('kategori', 'cbt')->get();
        return view('admin.sesi-cbt.edit', compact('session', 'mataLombas'));
    }
    public function update(Request $request, $id){
        $validatedData = $request->validate([
            'nama' => 'required',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required|after:waktu_mulai',
            'mata_lomba_id' => 'required|exists:mata_lombas,id'
        ], [
            'waktu_selesai.after' => 'Waktu selesai harus sesudah waktu mulai.'
        ]);

        $session = CbtSession::find($id);
        if (!$session) {
            return redirect()->route('sesi-cbt.index')->with('error', 'Sesi tidak ditemukan.');
        }
        $session->update($validatedData);
        return redirect()->route('sesi-cbt.index')->with('success', 'Sesi berhasil diperbarui!');
    }
    public function destroy($id){
        $session = CbtSession::find($id);
        if (!$session) {
            return redirect()->route('sesi-cbt.index')->with('error', 'Sesi tidak ditemukan.');
        }
        $session->delete();
        return redirect()->route('sesi-cbt.index')->with('success', 'Sesi berhasil dihapus!');
    }
    
    

    
}

