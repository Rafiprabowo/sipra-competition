<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CbtSession;
use App\Models\MataLomba;
use App\Models\PesertaSession;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanHasilLombaTpkController extends Controller
{
    /**
     * Handle the incoming request.
     */
    
     public function __invoke(Request $request)
     {
         $mataLomba = MataLomba::where('nama', \App\Enums\MataLomba::TPK->value)->first();
 
         $rankingResults = [];
 
         if ($mataLomba) {
             $pesertaSessions = PesertaSession::with('peserta')
                 ->whereHas('cbtSession', function ($query) use ($mataLomba) {
                     $query->where('mata_lomba_id', $mataLomba->id);
                 })
                 ->orderByDesc('score')
                 ->orderByDesc('correct_difficult_answers')
                 ->orderBy('completed_at')
                 ->get();
 
             $groupedByGender = $pesertaSessions->groupBy(fn($pesertaSession) => $pesertaSession->peserta->jenis_kelamin ?? 'Tidak Diketahui');
 
             $rankedByGender = $groupedByGender->map(function ($group) {
                 return $group->map(function ($pesertaSession, $index) {
                     if ($index < 3) {
                         $pesertaSession->rank = $index + 1; // Juara 1, 2, atau 3
                     } else {
                         $pesertaSession->rank = ''; // Tidak mendapat juara
                     }
                     return $pesertaSession;
                 });
             });
 
             $rankingResults = [
                 'ranked_participants' => $rankedByGender,
             ];
         }
 
         // Buat PDF dari tampilan
         $pdf = Pdf::loadView('pdf.laporan-lomba-tpk', ['rankingResults' => $rankingResults]);
 
         // Mengatur ukuran kertas dan orientasi PDF (Opsional)
         $pdf->setPaper('A4', 'portrait'); // Atur ukuran dan orientasi kertas
 
         return $pdf->download('laporan-hasil-lomba-tpk.pdf');
     }
}
