<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Finalisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class FinalisasiController extends Controller
{

    public function edit($id)
{
    $finalisasi = Finalisasi::with(['pembina.upload_dokumen', 'pembina'])->findOrFail($id);
    return view('admin.finalisasi.edit', compact('finalisasi'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:1,0', // Ensure the status is either 1 or 0
        'keterangan' => 'nullable|string',
        'dokumen_status' => 'required|array',
        'dokumen_status.*' => 'in:1,0', // Ensure each dokumen_status is either 1 or 0
        'dokumen_keterangan' => 'nullable|array',
        'dokumen_keterangan.*' => 'string|nullable'
    ]);

    $finalisasi = Finalisasi::findOrFail($id);
    $finalisasi->status = $request->input('status');
    $finalisasi->keterangan = $request->input('keterangan');
    $finalisasi->save();

    foreach ($finalisasi->pembina->upload_dokumen as $uploadDokumen) {
        $uploadDokumen->status = $request->input('dokumen_status')[$uploadDokumen->id] ?? null;
        $uploadDokumen->keterangan = $request->input('dokumen_keterangan')[$uploadDokumen->id] ?? null;
        $uploadDokumen->save();
    }

    return redirect()->route('admin.dashboard', $id)->with('success', 'Finalisasi updated successfully.');
}


    public function approve($id)
    {
        $finalisasi = Finalisasi::findOrFail($id);
        $finalisasi->status = 1;

            $finalisasi->keterangan = "Finalisasi disetujui";

        $finalisasi->save();

        return redirect()->route('admin.dashboard')->with('success', 'Status finalisasi berhasil disetujui.');
    }

    public function reject($id)
    {
        $finalisasi = Finalisasi::findOrFail($id);
        $finalisasi->status = 0;
            $finalisasi->keterangan = "Finalisasi ditolak";

        $finalisasi->save();

        return redirect()->route('admin.dashboard')->with('success', 'Status finalisasi berhasil ditolak.');
    }
    public function view($file)
    {
        $filePath = 'dokumen_pendaftaran/' . $file;

        if (!Storage::exists($filePath)) {
            return abort(404, 'File not found');
        }

        $fileContents = Storage::get($filePath);
        $mimeType = Storage::mimeType($filePath);

        return response($fileContents, 200)->header('Content-Type', $mimeType);
    }
}





