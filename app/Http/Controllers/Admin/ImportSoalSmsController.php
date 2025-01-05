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
    public function __invoke(Request $request, $id)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);
    
        $session = CbtSession::find($id);
    
        // Corrected Excel import method with both import class and file
        Excel::import(new SmsImportQuestion($session->id), $request->file('file'));
    
        return redirect()->route('sesi-soal.index', ['id' => $session->id, 'nama' => $session->mataLomba->nama])
                         ->with('success', 'Data soal berhasil diimpor.');
    }
    
}
