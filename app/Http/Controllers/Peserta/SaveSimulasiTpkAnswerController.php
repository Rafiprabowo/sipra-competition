<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\SimulasiTpkAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaveSimulasiTpkAnswerController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'tpk_question_id' => 'required|exists:simulasi_tpk_questions,id',
            'nama' => 'nullable|string',
            'answer' => 'nullable|string|max:1'
        ]);

        $simulasiTpkAnswer = SimulasiTpkAnswer::updateOrCreate(
            [
                'simulasi_tpk_question_id' => $request->tpk_question_id,
                'answer' => $request->answer ?? null,
                'nama' => $request->nama ?? null,
            ]
        );
        
        return response()->json([
            'message' => 'Jawaban berhasil disimpan!',
            'data' => $simulasiTpkAnswer
        ])->setStatusCode(200);
    }
}
