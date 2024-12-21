<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Exam;
use Illuminate\Http\Request;

class ExamTpkController extends Controller
{
    public function saveAnswer(Request $request, $exam_id, $order)
    {
        dd($request->all());
        $request->validate([
            'answer' => 'required|in:a,b,c,d,e',
        ]);
    
        $exam = Exam::find($exam_id);
        $peserta = auth()->user()->peserta;
    
        // Ambil soal berdasarkan urutan
        $question = $exam->tpk_questions()->skip($order - 1)->first();
    
        if (!$question) {
            return response()->json(['error' => 'Pertanyaan tidak ditemukan'], 404);
        }
    
        // Simpan jawaban
        Answer::updateOrCreate(
            [
                'peserta_id' => $peserta->id,
                'exam_id' => $exam->id,
                'tpk_question_id' => $question->id,
            ],
            [
                'selected_answer' => $request->answer,
                'is_correct' => $request->answer === $question->correct_answer,
            ]
        );
    
        return response()->json(['success' => true, 'message' => 'Jawaban berhasil disimpan']);
    }
    
}
