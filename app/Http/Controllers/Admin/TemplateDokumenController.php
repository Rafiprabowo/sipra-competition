<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TemplateDokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TemplateDokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dokumens = TemplateDokumen::all();
        return view('admin.template-dokumen.index', compact('dokumens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.template-dokumen.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'nama' => 'nullable|string|max:255',
            'tipe' => 'nullable|string|max:255',
            'template' => 'nullable|file|mimes:doc,docx,pdf|max:2048',
        ]);

        // Proses penyimpanan file template jika ada
        if ($request->hasFile('template')) {
            $templatePath = $request->file('template')->store('templates');
        } else {
            $templatePath = null;
        }

        // Membuat data dokumen baru di database
        TemplateDokumen::create([
            'nama' => $request->nama,
            'tipe' => $request->tipe,
            'template' => $templatePath,
        ]);

        // Mengarahkan kembali ke halaman index dengan pesan sukses
        return redirect()->route('dokumen.index')->with('success', 'Dokumen berhasil ditambahkan.');
    }
   public function viewFile($fileName)
{
    $filePath = 'dokumen_pendaftaran/' . $fileName;
    if (!Storage::exists($filePath)) {
        return abort(404, 'File not found');
    }
    $fileContents = Storage::get($filePath);
    $mimeType = Storage::mimeType($filePath);

    return response($fileContents, 200)->header('Content-Type', $mimeType);
}

public function downloadTemplate($templateId)
{
    $template = TemplateDokumen::findOrFail($templateId);

    // Make sure the storage path is correctly formed
    $filePath = $template->template; // This should be 'templates/yourfilename.ext'
    $fileName = $template->nama . '.' . pathinfo($template->template, PATHINFO_EXTENSION);

    if (!Storage::exists($filePath)) {
        return response()->json(['error' => 'File not found'], 404);
    }

    return response()->download(storage_path('app/' . $filePath), $fileName); // Ensure the correct storage path
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
    public function edit($id)
    {
        $dokumen = TemplateDokumen::where('id', $id)->first();
        return view('admin.template-dokumen.edit', compact('dokumen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'nullable|string|max:255',
            'tipe' => 'nullable|string|max:255',
            'template' => 'nullable|file|mimes:doc,docx,pdf,jpg,png,jpeg    |max:2048',
        ]);

        $data = $request->only(['nama', 'tipe']);

        if ($request->hasFile('template')) {
            $templatePath = $request->file('template')->store('templates');
            $data['template'] = $templatePath;
        }
        $dokumen = TemplateDokumen::where('id', $id)->update($data);

        return redirect()->route('dokumen.index')->with('success', 'Dokumen berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
