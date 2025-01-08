<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\TpkQuestionImport;
use App\Models\CbtSession;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportSoalTpkController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // Validasi file yang diunggah
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);
    
        // Hapus semua data dari tabel `tpk_questions` dan tabel terkait
        \App\Models\TpkQuestion::query()->delete();
    
        // Impor data dari file
        Excel::import(new TpkQuestionImport(), $request->file('file'));
    
        // Redirect dengan pesan sukses
        return redirect()->route('soal-tpk.index')->with('success', 'Data soal berhasil diimpor. Semua data lama telah dihapus.');
    }
    

}
