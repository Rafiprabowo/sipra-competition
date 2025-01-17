<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\CbtSession;
use App\Models\SmsAnswer;
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
                return redirect()->route('peserta.sesi-tpk.index')->with('error', 'Tidak ada pertanyaan');
            } 

            // Get the authenticated participant
            $peserta = Auth::user()->peserta;

            // Retrieve the previously stored answer
            $answer = TpkAnswer::where('peserta_id', $peserta->id)
                        ->where('cbt_session_id', $session_id)
                        ->where('tpk_question_id', $tpk_question->id)
                        ->value('answer');

            return view('peserta.sesi-cbt.tpk.exam', compact('session', 'tpk_question', 'question_number', 'answer'));
        }else if ($session->mataLomba->nama == \App\Enums\MataLomba::SMS->value) {
            $sms_question = $session->smsQuestions()->skip($question_number - 1)->first();
            
            if (!$sms_question) {
                return redirect()->route('peserta.sesi-sms.index')->with('error', 'Tidak ada pertanyaan');
            }
        
            $peserta = Auth::user()->peserta;
        
            // Fetch all SMS answers for the participant in this session, grouped by sms_question_id
                $answers = \App\Models\SmsAnswer::where('peserta_id', $peserta->id)
                ->where('cbt_session_id', $session->id)
                ->whereIn('sms_question_image_id', $sms_question->images->pluck('id')) // Fetch image IDs
                ->get();
        
            return view('peserta.sesi-cbt.sms.exam', compact('session', 'sms_question', 'question_number', 'answers'));
        }
        
    }
}



