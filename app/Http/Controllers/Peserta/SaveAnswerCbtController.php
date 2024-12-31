<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\TpkAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SaveAnswerCbtController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $session_id, $question_number)
{
    Log::info('Received Data: ', $request->all());

    $validated = $request->validate([
        'answer' => 'required|string|in:a,b,c,d',
        'question_id' => 'required|exists:tpk_questions,id'
    ]);

    $peserta = Auth::user()->peserta;

    $result = TpkAnswer::updateOrCreate(
        [
            'peserta_id' => $peserta->id,
            'cbt_session_id' => $session_id,
            'tpk_question_id' => $request->question_id
        ],
        [
            'answer' => $request->answer
        ]
    );

    Log::info('Database Update Result: ', [$result]);

    return response()->json(['message' => 'Jawaban berhasil disimpan!'])->setStatusCode(200);
}

}
