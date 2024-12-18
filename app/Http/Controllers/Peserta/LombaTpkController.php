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
                      ->pluck('selected_answer', 'tpk_question_id')
                      ->all();

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
        $request->validate([
            'answer' => 'required|in:a,b,c,d,e',
        ]);

        $exam = Exam::find($exam_id);
        $peserta = auth()->user()->peserta;

        // Ambil soal berdasarkan urutan
        $question = $exam->tpk_questions()->skip($order - 1)->first();

        if (!$question) {
            // return redirect()->route('peserta.exam.result', $exam_id)->with('success', 'Ujian telah selesai.');
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
                'is_correct' => $request->answer === $question->correct_answer, // Asumsikan ada kolom "correct_answer"
            ]
        );

        // Redirect ke soal berikutnya
        return redirect()->route('peserta.exam.question', [
            'exam_id' => $exam->id,
            'order' => $order + 1,
        ]);
    }
}
