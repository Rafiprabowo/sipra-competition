<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\CbtSession;
use App\Models\PesertaSession;
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
        
        // Get all answers for the participant in this session
        $answers = TpkAnswer::where('peserta_id', $peserta->id)
                            ->where('cbt_session_id', $session_id)
                            ->get();

        // Calculate the score
        $score = 0;
        foreach ($answers as $answer) {
            if ($answer->user_answer == $answer->correct_answer) {
                $score += 1; // Assuming each correct answer adds 1 point
            }
        }

        // Save the score in PesertaSession
        PesertaSession::where('peserta_id', $peserta->id)
                      ->where('cbt_session_id', $session_id)
                      ->update([
                          'status' => 'completed',
                          'completed_at' => now(),
                          'score' => $score * 2
                      ]);

        // Redirect to a completion or summary page with the score
        return redirect()->route('review.cbt', ['session_id' => $session_id])->with('success', 'Tes berhasil diakhiri. Terima kasih telah mengikuti!')->with('score', $score);

    }
   
}
