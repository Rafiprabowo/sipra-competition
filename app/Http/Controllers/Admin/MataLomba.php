<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MataLomba extends Controller
{
    public function index(){
        $mata_lomba = \App\Models\MataLomba::all();
        return view('admin.mata_lomba.index', compact('mata_lomba'));
    }
    public function create(){
        return view('admin.mata_lomba.create');
    }
    public function store(Request $request){
        $validatedData = $request->validate([
            'nama' => 'required',
            'jumlah_peserta' => 'required',
            'ditujukan' => 'required',
            'deskripsi' => 'required',
        ]);
        $validatedData['nama'] =strtoupper(trim($validatedData['nama']));
        \App\Models\MataLomba::create($validatedData);
        return redirect()->route('admin.mata-lomba.index')->with('success', 'Data berhasil ditambahkan!');
    }
    public function edit($id){
        $mataLomba = \App\Models\MataLomba::findOrFail($id);
        return view('admin.mata_lomba.edit', compact('mataLomba'));
    }
    public function update(Request $request,  $id){
        $validatedData = $request->validate([
            'nama' => 'required',
            'jumlah_peserta' => 'required',
            'ditujukan' => 'required',
            'deskripsi' => 'required',
        ]);

        $mata_lomba = \App\Models\MataLomba::findOrFail($id);
        $mata_lomba->update($validatedData);
        return redirect()->route('admin.mata-lomba.index')->with('success', 'Data berhasil diubah!');
    }
    public function destroy($id){
        \App\Models\MataLomba::destroy($id);
        return redirect()->route('admin.mata-lomba.index')->with('success', 'Data berhasil dihapus!');
    }
}
