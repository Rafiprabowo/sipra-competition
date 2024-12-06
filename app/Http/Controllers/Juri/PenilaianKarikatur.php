<?php

namespace App\Http\Controllers\Juri;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Juri;
use App\Models\MataLomba;
use App\Models\Peserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenilaianKarikatur extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil juri yang sedang login
        $juris = Auth::user()->juri;

        // Ambil mata lomba "karikatur"
        $mata_lomba = MataLomba::where('nama', 'Karikatur')->first();

        // Ambil peserta yang terdaftar pada mata lomba "karikatur" dan sudah memiliki penilaian
        $pesertas = Peserta::with('penilaian_karikatur') // Eager load penilaian_karikatur
        ->where('mata_lomba_id', $mata_lomba->id)
            ->whereHas('penilaian_karikatur')  // Mengambil peserta yang sudah memiliki penilaian
            ->get();

        // Mengirim data ke view
        return view('juri.penilaian_karikatur.index', compact('pesertas'));
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil juri yang sedang login
        $juris = Auth::user()->juri;

        // Ambil mata lomba yang bernama "karikatur"
        $mata_lomba = MataLomba::where('nama', 'Karikatur')->first();

        // Ambil peserta yang terdaftar untuk mata lomba "karikatur" dan belum memiliki penilaian
        $pesertas = Peserta::where('mata_lomba_id', $mata_lomba->id)
            ->whereDoesntHave('penilaian_karikatur') // Pastikan peserta belum memiliki penilaian
            ->get();

        // Mengirim data ke view
        return view('juri.penilaian_karikatur.create', compact('juris', 'pesertas', 'mata_lomba'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'peserta_id' => 'required|exists:pesertas,id',
            'juri_id' => 'required|exists:juris,id',
            'mata_lomba_id' => 'required|exists:mata_lombas,id',
            'orisinalitas' => 'required|numeric|min:0|max:30',
            'kesesuaian_tema' => 'required|numeric|min:0|max:25',
            'kreativitas' => 'required|numeric|min:0|max:20',
            'pesan_yang_disampaikan' => 'required|numeric|min:0|max:15',
            'teknik' => 'required|numeric|min:0|max:10',
        ]);

        // Membuat penilaian baru
        \App\Models\PenilaianKarikatur::create([
            'peserta_id' => $request->peserta_id,
            'juri_id' => $request->juri_id,
            'mata_lomba_id' => $request->mata_lomba_id,
            'orisinalitas' => $request->orisinalitas,
            'kesesuaian_tema' => $request->kesesuaian_tema,
            'kreativitas' => $request->kreativitas,
            'pesan_yang_disampaikan' => $request->pesan_yang_disampaikan,
            'teknik' => $request->teknik,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('penilaian-karikatur.index')->with('success', 'Penilaian berhasil disimpan.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
