<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\CbtSession;
use App\Models\PesertaSession;
use App\Models\SmsAnswer;
use App\Models\SmsQuestion;
use App\Models\TpkAnswer;
use App\Models\TpkQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EndCbtController extends Controller
{
    /**
     * Handle the incoming request.
     */
    
    
     public function __invoke(Request $request, $session_id)
     {
         // Get the authenticated participant
         $peserta = Auth::user()->peserta;
         
         // Get the session and its associated MataLomba
         $session = CbtSession::with('mataLomba')->findOrFail($session_id);
     
         // If the MataLomba is TPK (as before)
         if ($session->mataLomba->nama == \App\Enums\MataLomba::TPK->value) {
             $answers = TpkAnswer::where('peserta_id', $peserta->id)
                                 ->where('cbt_session_id', $session_id)
                                 ->get();
     
             // Process answers and calculate score (as before)
             $questions = $session->tpk_questions;
             $score = $answers->reduce(function ($score, $answer) use ($questions) {
                 $question = $questions->firstWhere('id', $answer->tpk_question_id);
                 return $question && $answer->answer == $question->correct_answer ? $score + 1 : $score;
             }, 0);
     
             // Save score and update status
             PesertaSession::where('peserta_id', $peserta->id)
                           ->where('cbt_session_id', $session_id)
                           ->update([
                               'status' => 'completed',
                               'completed_at' => now(),
                               'score' => $score * 2,
                           ]);
     
             return redirect()->route('review.cbt', ['session_id' => $session_id])
                              ->with('success', 'Tes berhasil diakhiri. Terima kasih telah mengikuti!')
                              ->with('score', $score * 2);
         }
     
         // Handle SMS Mata Lomba
         if ($session->mataLomba->nama == \App\Enums\MataLomba::SMS->value) {
             // Get all SMS answers for the participant in this session
             $answers = SmsAnswer::where('peserta_id', $peserta->id)
                                 ->where('cbt_session_id', $session_id)
                                 ->get();
     
             // Get all SMS questions for this session
             $questions = $session->smsQuestions;
     
             // Example of processing SMS answers
             $score = 0;

             foreach ($answers as $answer) {
                 $questionImage = $answer->questionImage;
                 if($questionImage){
                    $letter = $questionImage->symbol->letter;
                    $participantAnswer = strtoupper($answer->answer);

                    if($participantAnswer == $letter){
                        $score += 1;
                    }
                 }

             }
     
             // Save the score (adjust as needed)
             PesertaSession::where('peserta_id', $peserta->id)
                           ->where('cbt_session_id', $session_id)
                           ->update([
                               'status' => 'completed',
                               'completed_at' => now(),
                               'score' => $score * 1.333,  // Save the calculated score
                           ]);
     
             // Redirect to the review page with the score
             return redirect()->route('review.cbt', ['session_id' => $session_id])
                              ->with('success', 'Tes SMS berhasil diakhiri. Terima kasih telah mengikuti!')
                              ->with('score', $score);
         }
     
         return response()->json(['message' => 'Tidak ada tindakan yang diambil untuk jenis lomba ini.'], 400);
     }     

    
   
}
