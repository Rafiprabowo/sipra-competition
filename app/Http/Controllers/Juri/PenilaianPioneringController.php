<?php

namespace App\Http\Controllers\Juri;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Juri;
use App\Models\MataLomba;
use App\Models\BobotSoal;
use App\Models\Peserta;
use App\Models\Pembina;
use App\Models\PenilaianPionering;
use App\Models\ReguPembina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenilaianPioneringController extends Controller
{

    public function index()
    {
        // Ambil juri yang sedang login
        $juris = Auth::user()->juri;

        // Ambil mata lomba "karikatur"
        $mata_lomba = MataLomba::where('nama', 'Pionering')->first();

        // Ambil peserta yang terdaftar pada mata lomba "karikatur" dan sudah memiliki penilaian
        $pesertas = Peserta::with('penilaian_pionering') // Eager load penilaian_karikatur
        ->where('mata_lomba_id', $mata_lomba->id)
            ->whereHas('penilaian_karikatur')  // Mengambil peserta yang sudah memiliki penilaian
            ->get();

        // Mengirim data ke view
        return view('juri.penilaian_karikatur.index', compact('pesertas'));
    }

    public function createForm()
    {
        // Ambil semua pangkalan dari tabel pembinas
        $pangkalans = Pembina::all();

        // Ambil mata lomba "Karikatur"
        $mata_lomba = MataLomba::where('nama', 'KARIKATUR')->first();

        // Ambil kriteria nilai dari bobot_soals untuk mata lomba "Karikatur"
        $bobot_soals = BobotSoal::where('mata_lomba_id', $mata_lomba->id)->get();

        return view('juri.penilaian_karikatur.create', compact('pangkalans', 'mata_lomba', 'bobot_soals'));
    }

    public function store(Request $request)
{
    $mata_lomba_id = $request->mata_lomba_id;
    $juri_id = $request->juri_id;
    $peserta_id = $request->peserta_id;
    $nilai = $request->input('nilai'); // Nilai dari input array

    // Validasi setiap nilai berdasarkan bobot_soal
    foreach ($nilai as $bobot_id => $nilai_input) {
        $bobotSoal = BobotSoal::find($bobot_id);

        if (!$bobotSoal) {
            return back()->withErrors(['error' => 'Bobot soal tidak valid.']);
        }

        if ($nilai_input < 0 || $nilai_input > $bobotSoal->bobot_soal) {
            return back()->withErrors([
                'error' => "Nilai untuk kriteria {$bobotSoal->kriteria_nilai} harus antara 0 dan {$bobotSoal->bobot_soal}."
            ]);
        }
    }

    // Simpan data jika validasi lulus
    foreach ($nilai as $bobot_id => $nilai_input) {
        PenilaianPionering::create([
            'juri_id' => $juri_id,
            'mata_lomba_id' => $mata_lomba_id,
            'peserta_id' => $peserta_id,
            'bobot_soal_id' => $bobot_id,
            'nilai' => $nilai_input,
        ]);
    }

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
