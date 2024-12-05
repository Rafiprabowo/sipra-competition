<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peserta;
use Illuminate\Http\Request;

class PesertaController extends Controller
{
        public function index(){
            $peserta = Peserta::all();
            return view('admin.peserta.index', compact('peserta'));
        }
        public function create(){
            return view('admin.peserta.create');
        }
        public function show($id){
            $peserta = Peserta::findOrFail($id);
            return view('admin.peserta.show', compact('peserta'));
        }
        public function edit($id){
            $peserta = Peserta::findOrFail($id);
            return view('admin.peserta.edit', compact('peserta'));
        }
        public function update(Request $request, $id){
            $request->validate([
                'nisn' => 'required',
                'nama' => 'required',
                'pangkalan' => 'required',
                'regu' => 'required',
                'jenis_kelamin' => 'required',
            ]);

            $peserta = Peserta::findOrFail($id);
            $peserta->update($request->all());
            return redirect()->route('admin.peserta.index')->with('success', 'Data Peserta Berhasil Diupdate!');
        }
        public function destroy($id){
            Peserta::where('id', $id)->delete();
            return redirect()->route('admin.peserta.index')->with('success', 'Peserta Berhasil Dihapus');
        }
}
