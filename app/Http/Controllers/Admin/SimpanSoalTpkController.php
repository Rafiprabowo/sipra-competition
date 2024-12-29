<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CbtSession;
use App\Models\TpkQuestion;
use Illuminate\Http\Request;

class SimpanSoalTpkController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $id)
    {
        $validated = $request->validate([
            'question' => 'required',
            'answer_a' => 'required',
            'answer_b' => 'required',
            'answer_c' => 'required',
            'answer_d' => 'required',
            'answer_e' => 'required',
            'difficulty' => 'required',
            'correct_answer' => 'required|in:a,b,c,d,e',
        ]);

        $session = CbtSession::find($id);
        $tpk_question = new TpkQuestion($validated);
        $session->tpk_questions()->save($tpk_question);


        return redirect()->route('sesi-soal.index', ['id' => $session->id, 'nama' => $session->mataLomba->nama])->with('success', 'Pertanyaan berhasil disimpan!');
    }
}
