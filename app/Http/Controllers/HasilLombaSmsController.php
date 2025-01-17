<?php

namespace App\Http\Controllers;

use App\Models\CbtSession;
use App\Models\MataLomba;
use App\Models\PesertaSession;
use Illuminate\Http\Request;

class HasilLombaSmsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    
     public function __invoke(Request $request)
     {
         $mataLomba = MataLomba::where('nama', \App\Enums\MataLomba::SMS->value)->first();
     
         $rankingResults = []; // Inisialisasi variabel
     
         if ($mataLomba) {
             // Ambil semua peserta dari semua sesi dengan mata_lomba_id yang sesuai
             $pesertaSessions = PesertaSession::with('peserta')
                 ->whereHas('cbtSession', function ($query) use ($mataLomba) {
                     $query->where('mata_lomba_id', $mataLomba->id);
                 })
                 ->orderByDesc('score')
                 ->orderBy('completed_at')
                 ->orderByDesc('correct_difficult_answers')
                 ->get();
     
             // Group peserta berdasarkan jenis_kelamin
             $groupedByGender = $pesertaSessions->groupBy(fn($pesertaSession) => $pesertaSession->peserta->jenis_kelamin ?? 'Tidak Diketahui');
     
             // Berikan ranking untuk setiap grup
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
     
         return view('hasil-lomba-sms', ['rankingResults' => $rankingResults]);
     }
     
     

}
