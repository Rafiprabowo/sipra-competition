<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JawabanTpk;
use App\Models\PertanyaanTpk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PertanyaanTpkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pertanyaan_tpk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pertanyaan' => 'required_without:pertanyaan_gambar|string|nullable',
            'pertanyaan_gambar' => 'required_without:pertanyaan|string|nullable|image|mimes:jpeg,png,jpg|max:2048',
            'options' => 'required|array|min:5',
            'options.*' => 'required|string',
            'is_benar' => 'required|integer|min:0|max:4',
        ]);

        $question = new PertanyaanTpk();

        if ($request->has('pertanyaan')) {
            $question->pertanyaan = $request->input('pertanyaan');
        }

        if ($request->hasFile('pertanyaan_gambar')) {
            $file = $request->file('pertanyaan_gambar');
            $path = $file->store('public/pertanyaan_gambar');
            $question->pertanyaan = Storage::url($path);
        }

        $question->save();

        foreach ($request->input('options') as $index => $optionText) {
            $option = new JawabanTpk();
            $option->pertanyaan_tpk_id = $question->id;
            $option->jawaban = $optionText;
            $option->is_benar = ($index == $request->input('is_benar'));
            $option->save();
        }

        return redirect()->route('questions.create')->with('success', 'Pertanyaan berhasil disimpan.');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
