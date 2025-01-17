<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\SimulasiSmsImportQuestion;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportSimulasiSoalSmsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);
    
        \App\Models\SimulasiSmsQuestion::query()->delete();
    
        // Corrected Excel import method with both import class and file
        Excel::import(new SimulasiSmsImportQuestion(), $request->file('file'));
    
        return redirect()->route('simulasi-soal-sms.index')->with('success', 'Data soal berhasil diimpor. Semua data lama telah dihapus.');
    }
    
}
