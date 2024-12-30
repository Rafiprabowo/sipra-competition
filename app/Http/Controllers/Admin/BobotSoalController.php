<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BobotSoal;
use App\Models\MataLomba;

class BobotSoalController extends Controller
{
    public function index() {
        // Ambil semua data bobot soal dengan relasi mata lomba
        $bobot_soal = BobotSoal::with('mata_lomba')->get();
    
        // Ambil semua mata lomba yang unik
        $uniqueBobotSoal = $bobot_soal->unique('mata_lomba_id');
    
        // Loop melalui setiap mata lomba yang unik untuk menghitung ulang bobot soal
        foreach ($uniqueBobotSoal as $bobot) {
            $total_bobot = BobotSoal::where('mata_lomba_id', $bobot->mata_lomba_id)->sum('bobot_soal');
    
            // Perbarui total bobot di tabel bobot_soals untuk mata_lomba_id yang sesuai
            BobotSoal::where('mata_lomba_id', $bobot->mata_lomba_id)->update(['total_bobot' => $total_bobot]);
        }
    
        // Kembali ke halaman dengan data bobot soal
        return view('admin.bobot_soal.index', compact('bobot_soal'));
    }    

    public function create() {
        $mata_lomba = MataLomba::all();
        $temporaryData = session('temporary_bobot_soal', []);
        return view('admin.bobot_soal.create', compact('mata_lomba', 'temporaryData'));
    }

    public function storeTemporary(Request $request) {
        $validatedData = $request->validate([
            'kriteria_nilai' => 'required',
            'bobot_soal' => 'required|integer',
            'mata_lomba_id' => 'required',
        ]);

        // Ambil data sementara dari session
        $temporaryData = session('temporary_bobot_soal', []);
        $temporaryData[] = $validatedData;
        
        // Simpan data sementara ke session
        session(['temporary_bobot_soal' => $temporaryData]);

        return redirect()->route('admin.bobot-soal.create')->with('success', 'Data berhasil disimpan sementara!');
    }

    public function store(Request $request) {
        $temporaryData = session('temporary_bobot_soal', []);
        $mataLombaIds = array_column($temporaryData, 'mata_lomba_id');

        foreach ($mataLombaIds as $mataLombaId) {
            $totalBobot = array_sum(array_column(array_filter($temporaryData, function($data) use ($mataLombaId) {
                return $data['mata_lomba_id'] == $mataLombaId;
            }), 'bobot_soal'));

            foreach ($temporaryData as &$data) {
                if ($data['mata_lomba_id'] == $mataLombaId) {
                    $data['total_bobot'] = $totalBobot;
                }
            }
        }

        foreach ($temporaryData as $data) {
            BobotSoal::create($data);
        }

        // Hapus data sementara dari session
        session()->forget('temporary_bobot_soal');

        return redirect()->route('admin.bobot-soal.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function removeTemporary($index) {
        $temporaryData = session('temporary_bobot_soal', []);
        unset($temporaryData[$index]);
        
        // Simpan ulang data sementara setelah menghapus
        session(['temporary_bobot_soal' => array_values($temporaryData)]);

        return redirect()->route('admin.bobot-soal.create')->with('success', 'Data berhasil dihapus dari sementara!');
    }

    public function edit($id) {
        $bobotSoal = BobotSoal::findOrFail($id);
        $mata_lomba = MataLomba::all();
        return view('admin.bobot_soal.edit', compact('bobotSoal', 'mata_lomba'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'kriteria_nilai' => 'required',
            'bobot_soal' => 'required|integer',
            'mata_lomba_id' => 'required',
        ]);

        $bobot_soal = BobotSoal::findOrFail($id);
        $oldMataLombaId = $bobot_soal->mata_lomba_id; // Simpan mata_lomba_id yang lama

        // Update data bobot soal
        $bobot_soal->update($validatedData);

        // Hitung ulang total_bobot untuk mata_lomba_id lama jika berubah
        if ($oldMataLombaId !== $validatedData['mata_lomba_id']) {
            $totalBobotOld = BobotSoal::where('mata_lomba_id', $oldMataLombaId)->sum('bobot_soal');
            BobotSoal::where('mata_lomba_id', $oldMataLombaId)->update(['total_bobot' => $totalBobotOld]);
        }

        // Hitung ulang total_bobot untuk mata_lomba_id baru
        $totalBobotNew = BobotSoal::where('mata_lomba_id', $validatedData['mata_lomba_id'])->sum('bobot_soal');
        BobotSoal::where('mata_lomba_id', $validatedData['mata_lomba_id'])->update(['total_bobot' => $totalBobotNew]);

        return redirect()->route('admin.bobot-soal.index')->with('success', 'Data berhasil diubah!');
    }

    public function destroy($id)
    {
        // Ambil data bobot soal berdasarkan ID
        $bobot_soal = BobotSoal::findOrFail($id);
        $mataLombaId = $bobot_soal->mata_lomba_id; // Simpan mata_lomba_id

        // Hapus semua data dengan mata_lomba_id yang sama
        BobotSoal::where('mata_lomba_id', $mataLombaId)->delete();

        return redirect()->route('admin.bobot-soal.index')->with('success', 'Semua data dengan mata lomba yang sama berhasil dihapus!');
    }

    public function show($id)
    {
        // Ambil data dari tabel bobot_soals berdasarkan mata_lomba_id
        $bobot_soals = BobotSoal::where('mata_lomba_id', $id)->get();
        $totalBobot = $bobot_soals->sum('bobot');

        // Redirect ke view bobot-soal.show dengan data
        return view('admin.bobot_soal.show', [
            'bobot_soals' => $bobot_soals,
            'totalBobot' => $totalBobot,
            'mata_lomba_id' => $id,
        ]);
    }

    public function deleteRow(Request $request, $id)
    {
        // Validasi input kriteria_nilai
        $validatedData = $request->validate([
            'kriteria_nilai' => 'required|string',
        ]);

        // Ambil data berdasarkan ID bobot soal
        $bobot_soal = BobotSoal::findOrFail($id);

        // Ambil nilai bobot dari kriteria_nilai yang akan dihapus
        $nilaiKriteria = BobotSoal::where('mata_lomba_id', $bobot_soal->mata_lomba_id)
            ->where('kriteria_nilai', $validatedData['kriteria_nilai'])
            ->value('bobot_soal');

        if ($nilaiKriteria === null) {
            return redirect()->route('admin.bobot-soal.show', $id)->with('error', 'Kriteria tidak ditemukan.');
        }

        // Hapus row berdasarkan kriteria_nilai dan mata_lomba
        BobotSoal::where('mata_lomba_id', $bobot_soal->mata_lomba_id)
            ->where('kriteria_nilai', $validatedData['kriteria_nilai'])
            ->delete();

        // Hitung ulang total_bobot untuk mata_lomba yang sama
        $totalBobot = BobotSoal::where('mata_lomba_id', $bobot_soal->mata_lomba_id)->sum('bobot_soal');

        // Update total_bobot di mata_lomba terkait
        $mataLomba = MataLomba::findOrFail($bobot_soal->mata_lomba_id);
        $mataLomba->penilaian_karikatur->total_bobot = $totalBobot; // Sesuaikan kolom total_bobot di tabel MataLomba
        $mataLomba->save();

        return redirect()->route('admin.bobot-soal.index')->with('success', 'Kriteria berhasil dihapus dan total bobot diperbarui!');
    }
}
