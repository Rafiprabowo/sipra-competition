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
             // Get all TPK answers for the participant in this session
             $answers = TpkAnswer::where('peserta_id', $peserta->id)
                                 ->where('cbt_session_id', $session_id)
                                 ->get();
             
             // Get all TPK questions for this session
             $questions = $session->tpk_questions;
     
             // Initialize score, correct difficult answers count, and correct answer count
             $score = 0;
             $correctDifficultAnswers = 0;
             $correctAnswerCount = 0;
     
             foreach ($answers as $answer) {
                 $question = $questions->firstWhere('id', $answer->tpk_question_id);
     
                 // Calculate score and check if the answer is correct
                 if ($question && $answer->answer == $question->correct_answer) {
                     $score += 1;
                     $correctAnswerCount += 1; // Increment for each correct answer
     
                     // Check if the question difficulty is 'sulit'
                     if ($question->difficulty == \App\Enums\Difficulty::MOTS->value) {
                         // Increment if the answer is correct for 'sulit' difficulty
                         $correctDifficultAnswers += 1;
                     }
                 }
             }
     
             // Save the score and answer counts (adjust as needed)
             PesertaSession::where('peserta_id', $peserta->id)
                           ->where('cbt_session_id', $session_id)
                           ->update([
                               'status' => 'completed',
                               'completed_at' => now(),
                               'score' => $score * 2,  // Save the calculated score (adjust weight as needed)
                               'correct_difficult_answers' => $correctDifficultAnswers,  // Store the count of correct answers for 'sulit'
                               'correct_answer_count' => $correctAnswerCount,  // Store the total correct answers
                           ]);
     
             return redirect()->route('review.cbt', ['session_id' => $session_id])
                              ->with('success', 'Tes TPK berhasil diakhiri. Terima kasih telah mengikuti!')
                              ->with('score', $score * 2)  // Adjust score as needed
                              ->with('correct_difficult_answers', $correctDifficultAnswers)
                              ->with('correct_answer_count', $correctAnswerCount);
         }
     
         // If the MataLomba is SMS
         if ($session->mataLomba->nama == \App\Enums\MataLomba::SMS->value) {
             // Get all SMS answers for the participant in this session
             $answers = SmsAnswer::where('peserta_id', $peserta->id)
                                  ->where('cbt_session_id', $session_id)
                                  ->get();
             
             // Get all SMS questions for this session
             $questions = $session->smsQuestions;
             
             // Initialize score, correct difficult answers count, and correct answer count
             $score = 0;
             $correctDifficultAnswers = 0;
             $correctAnswerCount = 0;
     
             foreach ($answers as $answer) {
                 $questionImage = $answer->questionImage;
                 if ($questionImage) {
                     $participantAnswer = strtoupper($answer->answer);
                     $question = $questionImage->smsQuestion;
                     
                     // Calculate score and check if the answer is correct
                     if ($participantAnswer == strtoupper($questionImage->symbol->letter)) {
                         $score += 1;
                         $correctAnswerCount += 1; // Increment for each correct letter
     
                         // Check if the question difficulty is 'sulit'
                         if ($question->difficulty == 'sulit') {
                             // Iterate over each character in the word and check if it's correctly answered
                             $correctAnswerLetters = str_split(strtoupper($question->word));  // Convert word to an array of letters
                             if (in_array($participantAnswer, $correctAnswerLetters)) {
                                 $correctDifficultAnswers += 1; // Increment if the letter is correct for 'sulit' difficulty
                             }
                         }
                     }
                 }
             }
     
             // Save the score and answer counts (adjust as needed)
             PesertaSession::where('peserta_id', $peserta->id)
                           ->where('cbt_session_id', $session_id)
                           ->update([
                               'status' => 'completed',
                               'completed_at' => now(),
                               'score' => $score * 1.333,  // Save the calculated score
                               'correct_difficult_answers' => $correctDifficultAnswers,  // Store the count of correct letters for 'sulit'
                               'correct_answer_count' => $correctAnswerCount,  // Store the total correct answers
                           ]);
     
             return redirect()->route('review.cbt', ['session_id' => $session_id])
                              ->with('success', 'Tes SMS berhasil diakhiri. Terima kasih telah mengikuti!')
                              ->with('score', $score)
                              ->with('correct_difficult_answers', $correctDifficultAnswers)
                              ->with('correct_answer_count', $correctAnswerCount);
         }
     
         return response()->json(['message' => 'Tidak ada tindakan yang diambil untuk jenis lomba ini.'], 400);
     }
     

    
   
}
