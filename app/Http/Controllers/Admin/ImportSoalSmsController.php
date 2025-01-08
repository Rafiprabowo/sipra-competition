<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\SmsImportQuestion;
use App\Models\CbtSession;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportSoalSmsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);
    
        \App\Models\SmsQuestion::query()->delete();
    
        // Corrected Excel import method with both import class and file
        Excel::import(new SmsImportQuestion(), $request->file('file'));
    
        return redirect()->route('soal-sms.index')->with('success', 'Data soal berhasil diimpor. Semua data lama telah dihapus.');
    }
    
}
