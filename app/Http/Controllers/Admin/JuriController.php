<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Juri;
use Illuminate\Http\Request;

class JuriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $juri = Juri::with('mata_lomba')->get();
        return view('admin.juri.index', compact('juri'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mataLombas = \App\Models\MataLomba::all();
        return view('admin.juri.create', compact('mataLombas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'kwartir_cabang' => 'required|string|max:255',
            'pangkalan' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string|max:255',
            'no_hp' => 'required|string|max:255',
            'username' => 'required',
            'password' => 'required',
            'mata_lomba_id' => 'required',
        ]);

        Juri::create($validatedData);
        return redirect()->route('juri.index')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $mataLombas = \App\Models\MataLomba::all();
        $juri = Juri::with('mata_lomba')->findOrFail($id);
        return view('admin.juri.edit', compact('juri', 'mataLombas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'kwartir_cabang' => 'required',
            'pangkalan' => 'required',
            'jenis_kelamin' => 'required',
            'no_hp' => 'required',
            'username' => 'required',
            'password' => 'required',
            'mata_lomba_id' => 'required',
        ]);

        $juri = Juri::findOrFail($id);
        $juri->update($validatedData);
        return redirect()->route('juri.index')->with('success', 'Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Juri::destroy($id);
        return redirect()->route('juri.index')->with('success', 'Data berhasil dihapus!');
    }
}
