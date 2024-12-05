<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembina;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PembinaController extends Controller
{
    public function index(){
        $pembina = Pembina::all();
        return view('admin.pembina.index', compact('pembina'));
    }
    public function create(){
        return view('admin.pembina.create');
    }
    public function edit($id)
    {
        $pembina = Pembina::where('id', $id)->first();
        return view('admin.pembina.edit', compact('pembina'));
    }
    public function show($id){
        $pembina = Pembina::findOrFail($id);
        return view('admin.pembina.show', compact('pembina'));
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'pangkalan' => 'required|string|max:255',
        ]);

        $pembina = Pembina::findOrFail($id);
        $pembina->update($validated);
        return redirect()->route('admin.pembina.index')->with('success', 'Pembina berhasil diperbarui!');
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'nama' => 'required',
            'pangkalan' => 'required',

        ]);
        Pembina::create([
            'nama' => $validatedData['nama'],
            'pangkalan' => $validatedData['pangkalan'],
        ]);
        return redirect()->route('admin.pembina.index')->with('success', 'Data berhasil ditambahkan');
    }
    public function destroy($id){
        Pembina::where('id', $id)->delete();
        return redirect()->route('admin.pembina.index')->with('status', 'Data Berhasil Dihapus');
    }
}
