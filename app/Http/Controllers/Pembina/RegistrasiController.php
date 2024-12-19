<?php

namespace App\Http\Controllers\Pembina;

use App\Http\Controllers\Admin\MataLomba;
use App\Http\Controllers\Controller;
use App\Models\Finalisasi;
use App\Models\Pembina;
use App\Models\Peserta;
use App\Models\ReguPembina;
use App\Models\TemplateDokumen;
use App\Models\UploadDokumen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use SebastianBergmann\Template\Template;

class RegistrasiController extends Controller
{
    public function registrasi(Request $request)
    {
        $pembina = auth()->user()->pembina()->with('finalisasi')->first();
    
        $ditujukan = 'peserta'; // Nama peserta untuk dicocokkan
        $mataLombas = \App\Models\MataLomba::whereRaw('LOWER(ditujukan) = ?', [strtolower($ditujukan)])->get();
        $templates = TemplateDokumen::with('upload_dokumen')->get();
        $uploadDokumens = UploadDokumen::with('template_dokumen')->get();

        if ($pembina) {
            $regus = $pembina->regu ?? collect();
            $pesertas = Peserta::whereIn('regu_pembina_id', $regus->pluck('id'))->get();
            $reguToEdit = null;
            $pesertaToEdit = null;
            $status = $pembina->upload_dokumen;

            if ($request->has('edit_regu_id')) {
                $reguToEdit = ReguPembina::findOrFail($request->get('edit_regu_id'));
            }

            if ($request->has('edit_peserta_id')) {
                $pesertaToEdit = Peserta::findOrFail($request->get('edit_peserta_id'));
            }

            return view('pembina.registrasi', compact('pembina', 'regus', 'reguToEdit', 'pesertaToEdit', 'pesertas', 'mataLombas', 'status', 'templates', 'uploadDokumens'));
        }

        return view('pembina.registrasi', compact('pembina', 'templates', 'uploadDokumens'))->with('regus', collect()); // Tambahkan 'regus' sebagai koleksi kosong
    }


    public function storePembina(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'no_hp' => 'required',
            'kwartir_cabang' => 'required',
            'pangkalan' => 'required',
            'nama_gudep' => 'required',
            'pengalaman_pembina' => 'nullable',
            'pekerjaan' => 'nullable',
        ]);

        $pembina = Pembina::where('user_id', auth()->user()->id);
        if($pembina){
            $pembina->update($validatedData);
        }
        //set id user to pembina
        $validatedData['user_id'] = auth()->user()->id;

        Pembina::create($validatedData);

        return redirect()->route('registrasi.form')->with('success', 'Pembina berhasil disimpan! ');

    }

    public function updatePembina(Request $request)
    {
        $validatedData = $request->validate([
            'pembina_id' => 'required|exists:pembinas,id',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'no_hp' => 'required',
            'kwartir_cabang' => 'required',
            'pangkalan' => 'required',
            'nama_gudep' => 'required',
            'pengalaman_pembina' => 'nullable',
            'pekerjaan' => 'nullable',
        ]);

        $pembina = Pembina::findOrFail($validatedData['pembina_id']);
        if ($pembina) {
            unset($validatedData['pembina_id']);
            $pembina->update($validatedData);
            return redirect()->back()->with('success', 'Pembina berhasil diupdate! ');
        }
        return redirect()->route('registrasi.form')->with('error', 'Pembina gagal diupdate! ');
    }

    public function storeRegu(Request $request)
    {
        $validatedData = $request->validate([
            'nama_regu' => 'required|string|max:255',
            'kategori' => 'required|in:PA,PI',
        ]);

        $pembina = auth()->user()->pembina;

        if ($pembina) {
            $regus = $pembina->regu;

            if ($regus->count() >= 2) {
                return redirect()->route('registrasi.form')
                    ->with('error', 'Anda sudah memiliki 2 regu. Tidak bisa menambah lebih banyak.')
                    ->with('active_tab', 'regu');
            }

            $existingCategories = $regus->pluck('kategori')->toArray();

            if (in_array($validatedData['kategori'], $existingCategories)) {
                return redirect()->route('registrasi.form')
                    ->with('error', 'Kategori regu sudah ada. Anda harus memilih kategori yang berbeda.')
                    ->with('active_tab', 'regu');
            }

            $validatedData['pembina_id'] = auth()->user()->pembina->id;
            $regu = ReguPembina::create($validatedData);
            return redirect()->route('registrasi.form')
            ->with('success', 'Regu berhasil disimpan.')
            ->with('active_tab', 'regu');
        }

        return redirect()->route('registrasi.form')
        ->with('error', 'Anda belum terdaftar sebagai pembina.')
        ->with('active_tab', 'pembina');
    }

    public function updateRegu(Request $request, ReguPembina $regu)
    {
        $validatedData = $request->validate([
            'nama_regu' => 'required|string|max:255',
            'kategori' => 'required|in:PA,PI',
        ]);

        // Periksa apakah kategori yang sama sudah ada, kecuali regu ini sendiri
        $existingRegu = ReguPembina::where('pembina_id', $regu->pembina_id)
            ->where('kategori', $validatedData['kategori'])
            ->where('id', '!=', $regu->id)
            ->first();

        if ($existingRegu) {
            return redirect()->route('registrasi.form')->with('error', 'Kategori yang sama sudah ada untuk regu lain.');
        }

        $regu->update($validatedData);
        return redirect()->route('registrasi.form')->with('success', 'Regu berhasil diupdate.');
    }

    public function destroyRegu(ReguPembina $regu)
    {
        $regu->delete();
        return redirect()->route('registrasi.form')->with('success', 'Regu berhasil dihapus.');
    }


    public function storePeserta(Request $request)
    {
        $validatedData = $request->validate([
            'nisn' => 'required|string|max:255|unique:pesertas,nisn',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required',
            'mata_lomba_id' => 'required|exists:mata_lombas,id',
            'regu_pembina_id' => 'required|exists:regu_pembinas,id',
        ]);

        $regu = ReguPembina::findOrFail($validatedData['regu_pembina_id']);
        $regu->load('peserta'); // Memastikan relasi pesertas dimuat

        // Cek kategori regu dan jenis kelamin peserta
        if (($regu->kategori == 'PA' && $validatedData['jenis_kelamin'] != 'Putra') ||
            ($regu->kategori == 'PI' && $validatedData['jenis_kelamin'] != 'Putri')) {
            return redirect()->route('registrasi.form')->with('error', 'Jenis kelamin peserta harus sesuai dengan kategori regu.');
        }

        // Ambil data mata lomba untuk validasi jumlah peserta
        $mataLomba = \App\Models\MataLomba::findOrFail($validatedData['mata_lomba_id']);

        // Hitung jumlah peserta yang sudah ada di regu untuk mata lomba tersebut
        $jumlahPeserta = \App\Models\Peserta::where('regu_pembina_id', $regu->id)
            ->where('mata_lomba_id', $mataLomba->id)
            ->count();

        if ($jumlahPeserta >= $mataLomba->jumlah_peserta) {
            return redirect()->route('registrasi.form')->with('error', 'Maaf, jumlah orang melebihi batas untuk mata lomba ' . $mataLomba->nama);
        }

        // Jika jumlah peserta belum melebihi batas, simpan data peserta baru
        \App\Models\Peserta::create($validatedData);

        return redirect()->route('registrasi.form')->with('success', 'Peserta berhasil ditambahkan.');
    }

    public function destroyPeserta(Peserta $peserta)
    {
        $peserta->delete();
        return redirect()->route('registrasi.form')->with('success', 'Peserta berhasil dihapus.');
    }


    public function updatePeserta(Request $request, Peserta $peserta)
    {
        $validatedData = $request->validate([
            'nisn' => 'required|string|max:255|unique:pesertas,nisn,' . $peserta->id,
            'nama' => 'required|string|max:255',
            'regu_pembina_id' => 'required|exists:regu_pembinas,id',
            'jenis_kelamin' => 'required',
            'mata_lomba_id' => 'required|exists:mata_lombas,id',
        ]);

        $regu = ReguPembina::findOrFail($validatedData['regu_pembina_id']);

        // Cek kategori regu dan jenis kelamin peserta
        if (($regu->kategori == 'PA' && $validatedData['jenis_kelamin'] != 'Putra') ||
            ($regu->kategori == 'PI' && $validatedData['jenis_kelamin'] != 'Putri')) {
            return redirect()->route('registrasi.form')->with('error', 'Jenis kelamin peserta harus sesuai dengan kategori regu.');
        }

        $peserta->update($validatedData);

        return redirect()->route('registrasi.form')->with('success', 'Peserta berhasil diupdate.');
    }

    public function storeDokumen(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'template_dokumen_id' => 'required|exists:template_dokumens,id',
            'file' => 'required|file|max:2048',  // Maksimal 2MB untuk file
        ]);
    
        // Proses penyimpanan file
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('dokumen_pendaftaran');
    
            // Ambil data mata lomba berdasarkan ID
            $mataLomba = TemplateDokumen::find($request->template_dokumen_id);
    
            // Cek apakah sudah ada dokumen dengan jenis yang sama
            $existingFile = UploadDokumen::where('template_dokumens_id', $mataLomba->id)
                                          ->where('pembina_id', auth()->user()->pembina->id)
                                          ->first();
    
            if ($existingFile) {
                // Hapus file lama
                Storage::delete($existingFile->file);
    
                // Perbarui data dengan file baru
                $existingFile->file = $filePath;
                $existingFile->save();
            } else {
                // Simpan file baru
                UploadDokumen::create([
                    'template_dokumens_id' => $mataLomba->id,
                    'pembina_id' => auth()->user()->pembina->id,
                    'keterangan' => null, // Keterangan awal, dapat diupdate kemudian
                    'file' => $filePath,
                ]);
            }
    
            // Redirect ke halaman form registrasi dengan pesan sukses
            return redirect()->route('registrasi.form')->with('success', 'Dokumen berhasil ditambahkan atau diupdate.');
        } else {
            return redirect()->route('registrasi.form')->with('error', 'Gagal mengunggah dokumen.');
        }
    }    

public function finalisasi(Request $request)
{
    $pembina = Auth::user()->pembina;

    // Cek apakah data pembina sudah terisi
    if (!$pembina) {
        return redirect()->route('registrasi.form')->with('error', 'Data pembina belum lengkap.');
    }

    // Cek apakah jumlah regu sudah terpenuhi
    $regus = ReguPembina::where('pembina_id', $pembina->id)->get();
    if ($regus->count() < 2) {
        return redirect()->route('registrasi.form')->with('error', 'Jumlah regu minimal adalah 2.');
    }

    // Cek apakah setiap regu memiliki 8 peserta
    // foreach ($regus as $regu) {
    //     if ($regu->pesertas()->count() < 8) {
    //         return redirect()->route('registrasi.form')->with('error', 'Setiap regu harus memiliki minimal 8 peserta.');
    //     }
    // }

    // Cek apakah upload dokumen sudah lengkap
//    $requiredDocuments = TemplateDokumen::all();
//    foreach ($requiredDocuments as $document) {
//        $uploadedDokumen = UploadDokumen::where('template_dokumens_id', $document->id)
//                                         ->where('pembina_id', $pembina->id)
//                                         ->first();
//        if (!$uploadedDokumen) {
//            return redirect()->route('registrasi.form')->with('error', 'Semua dokumen wajib harus diunggah.');
//        }
//    }

    // Finalisasi pendaftaran
    Finalisasi::updateOrCreate(
        [
            'pembina_id' => $pembina->id,
        ],
    );

    return redirect()->route('registrasi.form')->with('success', 'Pendaftaran berhasil difinalisasi.');
}

}
