<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\SmsAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaveSmsAnswerController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'sms_question_image_id' => 'required|exists:sms_question_images,id',
            'answer' => 'nullable|string|max:1',
            'session_id' => 'required|exists:cbt_sessions,id'
        ]);

        $peserta = Auth::user()->peserta;

        $smsAnswer = SmsAnswer::updateOrCreate(
            [
                'peserta_id' => $peserta->id,
                'cbt_session_id' => $request->session_id,
                'sms_question_image_id' => $request->sms_question_image_id,
            ],
            [
                'answer' => $request->answer ?? null,
            ]
        );
        
        return response()->json([
            'message' => 'Jawaban berhasil disimpan!',
            'data' => $smsAnswer
        ])->setStatusCode(200);
    }
}
