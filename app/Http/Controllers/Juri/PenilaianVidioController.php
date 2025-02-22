<?php

namespace App\Http\Controllers\Juri;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Juri;
use App\Models\MataLomba;
use App\Models\BobotSoal;
use App\Models\Pembina;
use App\Models\PenilaianVidio;
use App\Models\ReguPembina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenilaianVidioController extends Controller
{
    public function index()
    {
        // Ambil juri yang sedang login
        $juri = Auth::user()->juri;

        // Ambil mata lomba
        $mata_lomba = MataLomba::where('nama', \App\Enums\MataLomba::VIDIO->value)->first();

        // Ambil penilaian vidio dengan relasi dan filter duplikat berdasarkan mata_lomba_id
        $penilaianVidios = PenilaianVidio::with('juri', 'pembina')
            ->where('mata_lomba_id', $mata_lomba->id)
            ->get()
            ->unique('pembina_id');  // Menghapus duplikat berdasarkan mata_lomba_id

        // Mengirim data ke view
        return view('juri.penilaian_vidio.index', compact('penilaianVidios'));
    }

    public function createForm()
    {
        // Ambil semua pangkalan dari tabel pembinas
        $pangkalans = Pembina::all();

        $mata_lomba = MataLomba::where('nama', \App\Enums\MataLomba::VIDIO->value)->first();

        // Ambil kriteria nilai dari bobot_soals untuk mata lomba 
        $bobot_soals = BobotSoal::where('mata_lomba_id', $mata_lomba->id)->get();

        return view('juri.penilaian_vidio.create', compact('pangkalans', 'mata_lomba', 'bobot_soals'));
    }

    public function store(Request $request) {
        $mata_lomba_id = $request->mata_lomba_id;
        $pembina_id = $request->pembina_id;
        $nilai = $request->input('nilai'); // Nilai dari input array

        $juri_id = Auth::user()->juri->id;
        $request->validate([
            'pembina_id'=>'required|exists:pembinas,id',
        ]);
        // dd($request->pembina_id);

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

        // Simpan data ke tabel penilaian_vidios
        $total_nilai = 0; // Variabel untuk menghitung total nilai
        foreach ($nilai as $bobot_id => $nilai_input) {
            PenilaianVidio::create([
                'juri_id' => $juri_id,
                'mata_lomba_id' => $mata_lomba_id,
                'pembina_id' => $pembina_id,
                'bobot_soal_id' => $bobot_id,
                'nilai' => $nilai_input,
            ]);

            // Tambahkan nilai ke total_nilai
            $total_nilai += $nilai_input;
        }

        // Update atau buat entri total_nilai di tabel penilaian_vidios
        PenilaianVidio::updateOrCreate(
            [
                'mata_lomba_id' => $mata_lomba_id,
                'pembina_id' => $pembina_id,
                'juri_id' => $juri_id,
            ],
            [
                'total_nilai' => $total_nilai,
            ]
        );

        // Duplikasi nilai total_nilai ke semua entri lain dengan mata_lomba_id yang sama
        PenilaianVidio::where('pembina_id', $pembina_id)
            ->update(['total_nilai' => $total_nilai]);

        return redirect()->route('penilaian-vidio.index')->with('success', 'Penilaian berhasil disimpan.');
        // return response()->json(['data' => $request->all()])->setStatusCode(200);
    }

    public function show(string $id)
    {
        //
    }

    public function edit($id)
{
    $penilaian = PenilaianVidio::with(['nilai.bobot_soal'])->findOrFail($id);
    return view('penilaian_vidio.edit', compact('penilaian'));
}

public function update(Request $request, $id)
{
    $penilaian = PenilaianVidio::findOrFail($id);

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
        $penilaianItem = PenilaianVidio::where([
            'juri_id' => $penilaian->juri_id,
            'mata_lomba_id' => $penilaian->mata_lomba_id,
            'pembina_id' => $penilaian->pembina_id,
            'bobot_soal_id' => $bobot_id,
        ])->first();

        if ($penilaianItem) {
            $penilaianItem->update(['nilai' => $nilai_input]);
        } else {
            PenilaianVidio::create([
                'juri_id' => $penilaian->juri_id,
                'mata_lomba_id' => $penilaian->mata_lomba_id,
                'pembina_id' => $penilaian->pembina_id,
                'bobot_soal_id' => $bobot_id,
                'nilai' => $nilai_input,
            ]);
        }

        $total_nilai += $nilai_input;
    }

    // Update total nilai
    $penilaian->update(['total_nilai' => $total_nilai]);

    return redirect()->route('penilaian-vidio.index')->with('success', 'Penilaian berhasil diperbarui.');
}

    public function destroy($id)
    {
        $penilaian = PenilaianVidio::findOrFail($id);

        // Hapus semua nilai terkait penilaian ini
        PenilaianVidio::where([
            'juri_id' => $penilaian->juri_id,
            'mata_lomba_id' => $penilaian->mata_lomba_id,
            'pembina_id' => $penilaian->pembina_id,
        ])->delete();

        return redirect()->route('penilaian-vidio.index')->with('success', 'Penilaian berhasil dihapus.');
    }
}
