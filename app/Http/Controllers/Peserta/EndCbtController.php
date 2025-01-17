<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\CbtSession;
use App\Models\PesertaSession;
use App\Models\SmsAnswer;
use App\Models\TpkAnswer;
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
                                ->with(['questionImage.smsQuestion', 'questionImage.symbol', 'cbtSession.questionConfigurations'])
                                ->get();
        
            $correctAnswerCount = 0;
            $correctDifficultAnswers = 0;
            $correctEasyAnswers = 0;
            $scoreMorse = 0;
            $scoreSemaphore = 0;
            $score = 0; // Initialize $score to a default value
        
            foreach ($answers as $answer) {
                $questionImage = $answer->questionImage;
                if ($questionImage) {
                    $participantAnswer = strtoupper($answer->answer);
                    $question = $questionImage->smsQuestion;
        
                    // Calculate score and check if the answer is correct
                    if ($participantAnswer == strtoupper($questionImage->symbol->letter)) {
                        $correctAnswerCount += 1; // Increment for each correct letter
        
                        // Check if the question difficulty is 'sulit'
                        if ($question->difficulty == 'sulit') {
                            $correctAnswerLetters = str_split(strtoupper($question->word));  // Convert word to an array of letters
                            if (in_array($participantAnswer, $correctAnswerLetters)) {
                                $correctDifficultAnswers += 1; // Increment if the letter is correct for 'sulit' difficulty
                            }
                        }
        
                        if ($question->difficulty == 'mudah') {
                            $correctAnswerLetters = str_split(strtoupper($question->word));  // Convert word to an array of letters
                            if (in_array($participantAnswer, $correctAnswerLetters)) {
                                $correctEasyAnswers += 1; // Increment if the letter is correct for 'mudah' difficulty
                            }
                        }
                    }
                }
            }
        
            // Check if there are any answers before proceeding
            if ($answers->isNotEmpty()) {
                $cbt_session = $answers->first()->cbtSession;
                $questionConfigurations = $cbt_session->questionConfigurations;
        
                // Initialize scores for each type
                $scoreMorse = 0;
                $scoreSemaphore = 0;
        
                foreach ($answers as $answer) {
                    $questionImage = $answer->questionImage;
                    $question = $questionImage->smsQuestion;
        
                    // Calculate the score based on the question type
                    if ($question->type == \App\Enums\QuestionType::MORSE->value) {
                        foreach ($questionConfigurations as $configuration) {
                            $bobot_nilai_sulit = $configuration->bobot_nilai_sulit;
                            $bobot_nilai_mudah = $configuration->bobot_nilai_mudah;
                            $scoreMorse = ((($correctDifficultAnswers * $bobot_nilai_sulit)/100) + (($correctEasyAnswers * $bobot_nilai_mudah)/100));
                        }
                    } elseif ($question->type == \App\Enums\QuestionType::SEMAPHORE->value) {
                        foreach ($questionConfigurations as $configuration) {
                            $bobot_nilai_sulit = $configuration->bobot_nilai_sulit;
                            $bobot_nilai_mudah = $configuration->bobot_nilai_mudah;
                            $scoreSemaphore = ((($correctDifficultAnswers * $bobot_nilai_sulit)/100) + (($correctEasyAnswers * $bobot_nilai_mudah)/100));
                        }
                    }
                }
        
                $score = $scoreMorse + $scoreSemaphore;
            }
        
            // Save the score and answer counts (adjust as needed)
            PesertaSession::where('peserta_id', $peserta->id)
                          ->where('cbt_session_id', $session_id)
                          ->update([
                              'status' => 'completed',
                              'completed_at' => now(),
                              'score' => $score,  // Save the calculated score
                              'correct_difficult_answers' => $correctDifficultAnswers,  // Store the count of correct letters for 'sulit'
                              'correct_easy_answers' => $correctEasyAnswers,
                              'correct_answer_count' => $correctAnswerCount,  // Store the total correct answers
                          ]);
        
            return redirect()->route('review.cbt', ['session_id' => $session_id])
                             ->with('success', 'Tes SMS berhasil diakhiri. Terima kasih telah mengikuti!')
                             ->with('score', $score)
                             ->with('correct_difficult_answers', $correctDifficultAnswers)
                             ->with('correct_easy_answers', $correctEasyAnswers)
                             ->with('correct_answer_count', $correctAnswerCount);
        }
        
        return response()->json(['message' => 'Tidak ada tindakan yang diambil untuk jenis lomba ini.'], 400);     
    }
}
