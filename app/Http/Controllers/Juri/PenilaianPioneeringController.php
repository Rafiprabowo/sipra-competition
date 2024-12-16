<?php

namespace App\Http\Controllers\Juri;

use App\Http\Controllers\Controller;
use App\Models\Peserta;
use App\Models\MataLomba;
use App\Models\Pembina;
use App\Models\ReguPembina;
use App\Models\Juri;
use App\Models\BobotSoal;
use App\Models\PenilaianPioneering;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenilaianPioneeringController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'mata_lomba_id' => 'required',
            'juri_id' => 'required',
            'pembina_id' => 'required',
            'regu_pembina_id' => 'required',
            'peserta_id' => 'required',
            'bobot_soal_id' => 'required',
            'nilai_lomba' => 'required',
        ]);

        $data = [
            'mata_lomba_id' => $request->mata_lomba_id,
            'pembina_id' => $request->pembina_id,
            'regu_pembina_id' => $request->regu_pembina_id,
            'peserta_id' => $request->peserta_id,
            'bobot_soal_id' => $request->bobot_soal_id,
            'juri_id' => auth()->user()->juri->id,
        ];

        // Handle file upload
        if ($request->hasFile('upload_foto')) {
            $file = $request->file('upload_foto');
            $filename =$file->getClientOriginalName();
            $filePath = $file->storeAs('lomba_foto_vidio', $filename); // Store in default disk
            $data['file'] = $filePath;
        } elseif ($request->upload_video) {
            // Handle video link
            $data['file'] = $request->upload_video;
        }

        // Create or update the record
        PenilaianPioneering::updateOrCreate(
            [
                'mata_lomba_id' => $request->mata_lomba_id,
                'pembina_id' => $request->pembina_id,
                'regu_pembina_id' => $request->regu_pembina_id,
                'peserta_id' => $request->peserta_id,
                'bobot_soal_id' => $request->bobot_soal_id,
                'juri_id' => auth()->user()->juri->id,
            ],
            $data
        );

        return redirect()->route('penilaian_pionering.form')->with('success', 'Data berhasil disimpan.');
    }

    public function destroy($id){
        $file = PenilaianPioneering::findOrFail($id);
        $file->delete();
        return redirect()->route('upload_lombas.form')->with('success', 'Data berhasil dihapus.');
    }
}
