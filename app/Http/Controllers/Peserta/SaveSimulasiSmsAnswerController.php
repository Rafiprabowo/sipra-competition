<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\SimulasiSmsAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaveSimulasiSmsAnswerController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'simulasi_sms_question_image_id' => 'required|exists:simulasi_sms_question_images,id',
            'sms_question_id' => 'required|exists:simulasi_sms_questions,id',
            'nama' => 'nullable|string',
            'answer' => 'nullable|string|max:1'
        ]);

        $simulasiSmsAnswer = SimulasiSmsAnswer::updateOrCreate(
            [
                'simulasi_sms_question_image_id' => $request->simulasi_sms_question_image_id,
            ],
            [
                'simulasi_sms_question_id' => $request->sms_question_id,
                'answer' => $request->answer ?? null,
                'nama' => $request->nama ?? null,
            ]
        );
        
        return response()->json([
            'message' => 'Jawaban berhasil disimpan!',
            'data' => $simulasiSmsAnswer
        ])->setStatusCode(200);
    }
}
