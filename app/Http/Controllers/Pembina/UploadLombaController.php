<?php

namespace App\Http\Controllers\Pembina;

use App\Http\Controllers\Controller;
use App\Models\Finalisasi;
use App\Models\UploadLomba;
use App\Models\Peserta;
use App\Models\MataLomba;
use App\Models\Pembina;
use App\Models\ReguPembina;
use Illuminate\Http\Request;

class UploadLombaController extends Controller
{
    public function upload_lombas()
    {
        $pembina = auth()->user()->pembina;
        if(!$pembina || !$pembina->finalisasi){
            return redirect()->route('registrasi.form')->with('warning', 'Harap registrasi terlebih dahulu sebelum mengakses Upload Lomba');
        }
        if($pembina->finalisasi->status != 1){
            return redirect()->route('registrasi.form')->with('warning', 'Menunggu Hasil Verifikasi');
        }


        $foto = strtoupper('foto');
        $vidio = strtoupper('vidio');
        $mataLombas = MataLomba::whereIn('nama', [$vidio, $foto])->get();


        return view('pembina.upload-lombas', compact('pembina' , 'mataLombas' ));
    }

    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'upload_poster' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'upload_video' => 'nullable|string|max:255', // Mengubah validasi untuk upload_video menjadi string
            'peserta_id' => 'required|exists:pesertas,id',
            'mata_lomba_id' => 'required|exists:mata_lombas,id',
            'pembina_id' => 'required|exists:pembinas,id',
            'regu_pembina_id' => 'required|exists:regu_pembinas,id',
        ]);

        // Buat instance baru dari model UploadLomba
        $uploadLomba = new UploadLomba();

        // Simpan file poster jika ada
        if ($request->hasFile('upload_poster')) {
            $posterPath = $request->file('upload_poster')->store('posters', 'public');
            $uploadLomba->upload_poster = $posterPath; // Menyimpan path file di database
        }

        // Ambil link video dari inputan teks
        $videoLink = $request->upload_video;

        // Buat data baru
        UploadLomba::create([
            'upload_poster' => $posterPath,
            'upload_video' => $videoLink, // Simpan link video sebagai string
            'peserta_id' => $request->peserta_id,
            'mata_lomba_id' => $request->mata_lomba_id,
            'pembina_id' => $request->pembina_id,
            'regu_pembina_id' => $request->regu_pembina_id,
        ]);

        return redirect()->route('upload_lombas.form')->with('success', 'Data berhasil disimpan!');
    }

    public function edit($id)
    {
        $uploadLomba = UploadLomba::findOrFail($id);

        // Ambil data tambahan untuk dropdown
        $pesertas = Peserta::all();
        $mataLombas = MataLomba::all();
        $pembinas = Pembina::all();
        $reguPembinas = ReguPembina::all();

        return view('peserta.edit-upload-lombas', compact('uploadLomba', 'pesertas', 'mataLombas', 'pembinas'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data
        $request->validate([
            'upload_poster' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'upload_video' => 'nullable|string|max:255', // Mengubah validasi untuk upload_video menjadi string
            'peserta_id' => 'required|exists:pesertas,id',
            'mata_lomba_id' => 'required|exists:mata_lombas,id',
            'pembina_id' => 'required|exists:pembinas,id',
            'regu_pembina_id' => 'required|exists:regu_pembinas,id',
        ]);

        // Temukan data yang ingin diupdate
        $uploadLomba = UploadLomba::findOrFail($id);

        // Simpan file baru untuk poster jika ada
        if ($request->hasFile('upload_poster')) {
            $posterPath = $request->file('upload_poster')->store('posters', 'public');
            $uploadLomba->upload_poster = $posterPath;  // Menyimpan path lengkap ke database
        }

        // Ambil link video dari inputan teks
        $videoLink = $request->upload_video;

        // Update data lainnya
        $uploadLomba->upload_video = $videoLink; // Update link video
        $uploadLomba->peserta_id = $request->peserta_id;
        $uploadLomba->mata_lomba_id = $request->mata_lomba_id;
        $uploadLomba->pembina_id = $request->pembina_id;
        $uploadLomba->regu_pembina_id = $request->regu_pembina_id;
        $uploadLomba->save();

        return redirect()->route('upload_lombas.form')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        // Hapus data
        $data = UploadLomba::findOrFail($id);
        $data->delete();

        return redirect()->route('upload_lombas.form')->with('success', 'Data berhasil dihapus!');
    }
}
