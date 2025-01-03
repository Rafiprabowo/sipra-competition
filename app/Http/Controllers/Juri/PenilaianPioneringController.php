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

        // Ambil mata lomba
        $mata_lomba = MataLomba::where('nama', 'Pionering')->first();

        $pesertas = Peserta::with('penilaian_pionering') 
        ->where('mata_lomba_id', $mata_lomba->id)
            ->whereHas('penilaian_pionering')  
            ->get();

        // Mengirim data ke view
        return view('juri.penilaian_pionering.index', compact('pesertas'));
    }

    public function createForm()
    {
        // Ambil semua pangkalan dari tabel pembinas
        $pangkalans = Pembina::all();

        $mata_lomba = MataLomba::where('nama', 'PIONERING')->first();

        // Ambil kriteria nilai dari bobot_soals untuk mata lomba 
        $bobot_soals = BobotSoal::where('mata_lomba_id', $mata_lomba->id)->get();

        return view('juri.penilaian_pionering.create', compact('pangkalans', 'mata_lomba', 'bobot_soals'));
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

        // Simpan data ke tabel 
        $total_nilai = 0; // Variabel untuk menghitung total nilai
        foreach ($nilai as $bobot_id => $nilai_input) {
            PenilaianPionering::create([
                'juri_id' => $juri_id,
                'mata_lomba_id' => $mata_lomba_id,
                'peserta_id' => $peserta_id,
                'bobot_soal_id' => $bobot_id,
                'nilai' => $nilai_input,
            ]);

            // Tambahkan nilai ke total_nilai
            $total_nilai += $nilai_input;
        }

        // Update atau buat entri total_nilai di tabel 
        PenilaianPionering::updateOrCreate(
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
        PenilaianPionering::where('peserta_id', $peserta_id)
            ->update(['total_nilai' => $total_nilai]);

        return redirect()->route('penilaian-pionering.index')->with('success', 'Penilaian berhasil disimpan.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit($id)
{
    $penilaian = PenilaianPionering::with(['nilai.bobot_soal'])->findOrFail($id);
    return view('penilaian_pionering.edit', compact('penilaian'));
}

public function update(Request $request, $id)
{
    $penilaian = PenilaianPionering::findOrFail($id);

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
        $penilaianItem = PenilaianPionering::where([
            'juri_id' => $penilaian->juri_id,
            'mata_lomba_id' => $penilaian->mata_lomba_id,
            'peserta_id' => $penilaian->peserta_id,
            'bobot_soal_id' => $bobot_id,
        ])->first();

        if ($penilaianItem) {
            $penilaianItem->update(['nilai' => $nilai_input]);
        } else {
            PenilaianPionering::create([
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

    return redirect()->route('penilaian-pionering.index')->with('success', 'Penilaian berhasil diperbarui.');
}

    public function destroy($id)
    {
        $penilaian = PenilaianPionering::findOrFail($id);

        // Hapus semua nilai terkait penilaian ini
        PenilaianPionering::where([
            'juri_id' => $penilaian->juri_id,
            'mata_lomba_id' => $penilaian->mata_lomba_id,
            'peserta_id' => $penilaian->peserta_id,
        ])->delete();

        return redirect()->route('penilaian-pionering.index')->with('success', 'Penilaian berhasil dihapus.');
    }
}
