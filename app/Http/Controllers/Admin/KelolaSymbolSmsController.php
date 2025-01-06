<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Symbols;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class KelolaSymbolSmsController extends Controller
{
    public function index(){
        $symbols = Symbols::all();
        return view('admin.symbols.index', compact('symbols'));
    }

    public function create(){
        return view('admin.symbols.create');
    }

    public function store(Request $request){
        $request->validate([
            'letter' => 'required|string|max:1',
            'type' => ['required', Rule::in([\App\Enums\QuestionType::MORSE->value, \App\Enums\QuestionType::SEMAPHORE->value])],
            'image' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        $symbol = new Symbols();
        $symbol->letter = strtoupper($request->letter);
        $symbol->type = $request->type;
        // Handling Image Upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $symbol->image = $imagePath;
        }

        $symbol->save();
        return redirect()->route('symbols.index')->with('success', 'Simbol berhasil disimpan!');
    }

    public function edit($id){
        $symbol = Symbols::findOrFail($id);
        return view('admin.symbols.edit', compact('symbol'));
    }

    
    public function update(Request $request, $id)
{
    $symbol = Symbols::findOrFail($id);

    // Validasi input
    $request->validate([
        'letter' => 'required|string|max:1',
        'type' => ['required', Rule::in([\App\Enums\QuestionType::MORSE->value, \App\Enums\QuestionType::SEMAPHORE->value])],
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // Update data simbol
    $symbol->letter = strtoupper($request->letter);  // Mengubah letter menjadi uppercase
    $symbol->type = $request->type;

    // Jika ada gambar baru yang diunggah
    if ($request->hasFile('image')) {
        // Menghapus gambar lama jika ada
        if ($symbol->image) {
            Storage::disk('public')->delete($symbol->image);
        }

        // Menyimpan gambar baru dengan cara yang sama seperti di method store
        $imagePath = $request->file('image')->store('images', 'public');  // Menyimpan gambar di folder 'images'
        $symbol->image = $imagePath;
    }

    // Menyimpan perubahan data simbol ke database
    $symbol->save();

    // Redirect dengan pesan sukses
    return redirect()->route('symbols.index')->with('success', 'Symbol updated successfully!');
}



    public function destroy($id)
{
    // Cari simbol berdasarkan ID
    $symbol = Symbols::findOrFail($id);

    // Hapus gambar jika ada (optional)
    if ($symbol->image) {
        Storage::delete($symbol->image); // Hapus file gambar dari storage
    }

    // Hapus simbol
    $symbol->delete();

    // Mengembalikan respons
    return redirect()->route('symbols.index')->with('success', 'Symbol deleted successfully.');
}

    
}
