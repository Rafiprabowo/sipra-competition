<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Exam;
use App\Models\Peserta;
use App\Models\TpkQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LombaTpkController extends Controller
{
    public function index()
    {
        $exam = Exam::find(1);
        return view('peserta.lombatpk', compact('exam'));
    }

    public function startExam($exam_id)
    {
        $exam = Exam::find($exam_id);

        // Validasi apakah data peserta dan ujian ditemukan
        if (!$exam) {
            abort(404, 'Data ujian tidak ditemukan.');
        }

        // Ambil soal yang terkait dengan ujian dan acak
        $questions = $exam->tpk_questions()->inRandomOrder()->get();

        // Validasi apakah ujian memiliki soal
        if ($questions->isEmpty()) {
            return redirect()->back()->with('error', 'Ujian ini belum memiliki soal.');
        }

        // Arahkan ke soal pertama
        return redirect()->route('peserta.exam.question', [
            'exam_id' => $exam->id,
            'order' => 1,
        ]);
    }

    public function showQuestion($exam_id, $order)
{
    $peserta = auth()->user()->peserta;
    $exam = Exam::find($exam_id);

    // Validasi apakah ujian dan peserta ditemukan
    if (!$exam) {
        abort(404, 'Data ujian tidak ditemukan.');
    }

    // Ambil soal berdasarkan urutan
    $question = $exam->tpk_questions()->skip($order - 1)->first();

    // Ambil jawaban yang sudah dipilih sebelumnya
    $selectedAnswer = Answer::where('exam_id', $exam_id)
                             ->where('peserta_id', $peserta->id)
                             ->where('tpk_question_id', $question->id)
                             ->first()
                             ->selected_answer ?? null;

    // Ambil semua jawaban peserta untuk navigasi soal
    $answers = Answer::where('exam_id', $exam_id)
                      ->where('peserta_id', $peserta->id)
                      ->with('peserta') // Eager loading untuk relasi peserta
                      ->get()
                      ->pluck('selected_answer', 'tpk_question_id');

    // Data untuk view
    return view('peserta.exam.question', [
        'exam' => $exam,
        'question' => $question,
        'selectedAnswer' => $selectedAnswer,
        'currentOrder' => $order,
        'totalQuestions' => $exam->tpk_questions()->count(),
        'answers' => $answers,
        'duration' => $exam->duration * 60, // Convert minutes to seconds
    ]);
}

public function saveAnswer(Request $request, $exam_id, $order)
{
    // Validasi input jawaban
    $request->validate([
        'answer' => 'required|in:a,b,c,d,e',
    ]);

    // Cari ujian berdasarkan exam_id
    $exam = Exam::find($exam_id);

    // Jika ujian tidak ditemukan
    if (!$exam) {
        return response()->json(['success' => false, 'message' => 'Exam not found'], 404);
    }

    // Ambil peserta yang sedang login
    $peserta = auth()->user()->peserta;

    // Ambil soal berdasarkan urutan
    $question = $exam->tpk_questions()->skip($order - 1)->first();

    // Jika soal tidak ditemukan
    if (!$question) {
        return response()->json(['success' => false, 'message' => 'Question not found'], 404);
    }

    // Simpan atau update jawaban
    Answer::updateOrCreate(
        [
            'peserta_id' => $peserta->id,
            'exam_id' => $exam->id,
            'tpk_question_id' => $question->id,
        ],
        [
            'selected_answer' => $request->answer,
            'is_correct' => $request->answer === $question->correct_answer, // Asumsikan ada kolom "correct_answer"
        ]
    );

    // Kembalikan respons JSON
    return response()->json(['success' => true]);
}


}
