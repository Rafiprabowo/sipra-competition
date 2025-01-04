<?php

namespace App\Http\Controllers\Juri;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Juri;
use App\Models\MataLomba;
use App\Models\BobotSoal;
use App\Models\Peserta;
use App\Models\Pembina;
use App\Models\PenilaianKarikatur;
use App\Models\ReguPembina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenilaianKarikaturController extends Controller
{

    public function index()
    {
        // Ambil juri yang sedang login
        $juris = Auth::user()->juri;

        // Ambil mata lomba "karikatur"
        $mata_lomba = MataLomba::where('nama', \App\Enums\MataLomba::KARIKATUR->value)->first();

        // Ambil peserta yang terdaftar pada mata lomba "karikatur" dan sudah memiliki penilaian
        $pesertas = Peserta::with('penilaian_karikatur') // Eager load penilaian_karikatur
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
        $peserta_id = $request->peserta_id;
        $nilai = $request->input('nilai'); // Nilai dari input array

        // Ambil juri yang sedang login
        $juri_id = Auth::user()->juri->id;

        // Validasi peserta_id
        $peserta = Peserta::find($peserta_id);
        if (!$peserta) {
            return back()->withErrors(['error' => 'Peserta tidak valid atau tidak ditemukan.']);
        }

        // Validasi nilai input berdasarkan bobot_soal
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

        // Simpan data ke tabel penilaian_karikaturs
        $total_nilai = 0; // Variabel untuk menghitung total nilai
        foreach ($nilai as $bobot_id => $nilai_input) {
            PenilaianKarikatur::create([
                'juri_id' => $juri_id,
                'mata_lomba_id' => $mata_lomba_id,
                'peserta_id' => $peserta_id,
                'bobot_soal_id' => $bobot_id,
                'nilai' => $nilai_input,
            ]);

            // Tambahkan nilai ke total_nilai
            $total_nilai += $nilai_input;
        }

        // Update atau buat entri total_nilai di tabel penilaian_karikaturs
        PenilaianKarikatur::updateOrCreate(
            [
                'mata_lomba_id' => $mata_lomba_id,
                'peserta_id' => $peserta_id,
                'juri_id' => $juri_id,
            ],
            [
                'total_nilai' => $total_nilai,
            ]
        );

        // Duplikasi nilai total_nilai ke semua entri lain dengan mata_lomba_id yang sama
        PenilaianKarikatur::where('peserta_id', $peserta_id)
            ->update(['total_nilai' => $total_nilai]);

        return redirect()->route('penilaian-karikatur.index')->with('success', 'Penilaian berhasil disimpan.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit($id)
{
    $penilaian = PenilaianKarikatur::with(['nilai.bobot_soal'])->findOrFail($id);
    return view('penilaian_karikatur.edit', compact('penilaian'));
}

public function update(Request $request, $id)
{
    $penilaian = PenilaianKarikatur::findOrFail($id);

    // Validasi nilai input berdasarkan bobot_soal
    foreach ($request->nilai as $bobot_id => $nilai_input) {
        $bobotSoal = BobotSoal::findOrFail($bobot_id);

        if ($nilai_input < 0 || $nilai_input > $bobotSoal->bobot_soal) {
            return back()->withErrors([
                'error' => "Nilai untuk kriteria {$bobotSoal->kriteria_nilai} harus antara 0 dan {$bobotSoal->bobot_soal}."
            ]);
        }
    }

    // Update nilai
    $total_nilai = 0;
    foreach ($request->nilai as $bobot_id => $nilai_input) {
        $penilaianItem = PenilaianKarikatur::where([
            'juri_id' => $penilaian->juri_id,
            'mata_lomba_id' => $penilaian->mata_lomba_id,
            'peserta_id' => $penilaian->peserta_id,
            'bobot_soal_id' => $bobot_id,
        ])->first();

        if ($penilaianItem) {
            $penilaianItem->update(['nilai' => $nilai_input]);
        } else {
            PenilaianKarikatur::create([
                'juri_id' => $penilaian->juri_id,
                'mata_lomba_id' => $penilaian->mata_lomba_id,
                'peserta_id' => $penilaian->peserta_id,
                'bobot_soal_id' => $bobot_id,
                'nilai' => $nilai_input,
            ]);
        }

        $total_nilai += $nilai_input;
    }

    // Update total nilai
    $penilaian->update(['total_nilai' => $total_nilai]);

    return redirect()->route('penilaian-karikatur.index')->with('success', 'Penilaian berhasil diperbarui.');
}

    public function destroy($id)
    {
        $penilaian = PenilaianKarikatur::findOrFail($id);

        // Hapus semua nilai terkait penilaian ini
        PenilaianKarikatur::where([
            'juri_id' => $penilaian->juri_id,
            'mata_lomba_id' => $penilaian->mata_lomba_id,
            'peserta_id' => $penilaian->peserta_id,
        ])->delete();

        return redirect()->route('penilaian-karikatur.index')->with('success', 'Penilaian berhasil dihapus.');
    }
}
