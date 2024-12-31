<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\CbtSession;
use App\Models\TpkAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StartCbtController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $session_id, $question_number)
    {
        $session = CbtSession::findOrFail($session_id);
        
        if($session->mataLomba->nama == \App\Enums\MataLomba::TPK->value){
            $tpk_question = $session->tpk_questions()->skip($question_number - 1)->first();
            if(!$tpk_question){
                return redirect()->route('peserta.sesi-tpk.index')->with('error', 'Tidak ada pertanyaan lagi');
            } 

            // Get the authenticated participant
            $peserta = Auth::user()->peserta;

            // Retrieve the previously stored answer
            $answer = TpkAnswer::where('peserta_id', $peserta->id)
                        ->where('cbt_session_id', $session_id)
                        ->where('tpk_question_id', $tpk_question->id)
                        ->value('answer');

                        // Get total number of questions $total_questions = $session->tpk_questions()->count
            $total_questions = $session->tpk_questions->count(); 

            return view('peserta.sesi-cbt.tpk.exam', compact('session', 'tpk_question', 'question_number', 'answer', 'total_questions'));
        }
    }
}



