<?php

namespace App\Http\Controllers\Pembina;

use App\Http\Controllers\Controller;
use App\Models\LombaFotoVidio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LombaFotoVidioController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'mata_lomba_id' => 'required',
            'upload_foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'upload_video' => 'nullable|string',
        ]);

        $data = [
            'mata_lomba_id' => $request->mata_lomba_id,
            'pembina_id' => auth()->user()->pembina->id,
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
        LombaFotoVidio::updateOrCreate(
            [
                'mata_lomba_id' => $request->mata_lomba_id,
                'pembina_id' => auth()->user()->pembina->id,
            ],
            $data
        );

        return redirect()->route('upload_lombas.form')->with('success', 'Data berhasil disimpan.');
    }

    public function showFile($file)
    {
         $filePath = 'lomba_foto_vidio/' . $file;

        if (!Storage::exists($filePath)) {
            return abort(404, 'File not found');
        }

        $fileContents = Storage::get($filePath);
        $mimeType = Storage::mimeType($filePath);

        return response($fileContents, 200)->header('Content-Type', $mimeType);
    }
    public function destroy($id){
        $file = LombaFotoVidio::findOrFail($id);
        if(Storage::exists($file->file)){
            Storage::delete($file->file);
        }
        $file->delete();
        return redirect()->route('upload_lombas.form')->with('success', 'Data berhasil dihapus.');
    }
}
