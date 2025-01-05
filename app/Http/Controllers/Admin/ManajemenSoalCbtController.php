<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CbtSession;
use App\Models\MataLomba;
use App\Models\SmsQuestion;
use App\Models\TpkQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ManajemenSoalCbtController extends Controller
{
    public function index(Request $request, $id){
        $session = CbtSession::findOrFail($id);

        if($session->mataLomba->nama == \App\Enums\MataLomba::TPK->value){
            return view('admin.soal-tpk.index', compact('session'));
        }else if($session->mataLomba->nama == \App\Enums\MataLomba::SMS->value){
            return view('admin.soal-sms.index', compact('session'));
        }else{
            return redirect()->route('sesi-soal.index', ['session_id' => $session, 'nama' => $session->mataLomba->nama])->with('error', 'Kategori lomba tidak valid.');
        }
    }
    public function create(Request $request, $id){
        $session = CbtSession::findOrFail($id);

        if($session->mataLomba->nama == \App\Enums\MataLomba::TPK->value){
            return view('admin.soal-tpk.create', compact('session'));
        }else{
            return redirect()->route('sesi-soal.index', ['session_id' => $session, 'nama' => $session->mataLomba->nama])->with('error', 'Kategori lomba tidak valid.');
        }
    }
    public function edit(Request $request, $session_id, $id){
        $session = CbtSession::find($session_id);
        
        if($session->mataLomba->nama == \App\Enums\MataLomba::TPK->value){
            $tpk_question = TpkQuestion::find($id);
            return view('admin.soal-tpk.edit', compact('session', 'tpk_question'));
        }else if($session->mataLomba->nama == \App\Enums\MataLomba::SMS->value){
            $sms_questions = SmsQuestion::find($id);
        }
    }


    public function update(Request $request, $session_id, $id)
    {
        $session = CbtSession::findOrFail($session_id);
    
        if ($session->mataLomba->nama == \App\Enums\MataLomba::TPK->value) {
            $tpk_question = TpkQuestion::findOrFail($id);
    
            $validated = $request->validate([
                'question_text' => 'nullable|string',
                'question_image' => 'nullable|mimes:png,jpg,jpeg|max:2048',
                'answer_a' => 'required|string',
                'answer_b' => 'required|string',
                'answer_c' => 'required|string',
                'answer_d' => 'required|string',
                'correct_answer' => 'required|in:a,b,c,d',
                'difficulty' => 'required|in:LOW,MIDDLE',
            ]);
    
            // Handling Image Upload
            if ($request->hasFile('question_image')) {
                $imagePath = $request->file('question_image')->store('images', 'public');
    
                if ($tpk_question->question_image) {
                    Storage::disk('public')->delete($tpk_question->question_image);
                }
    
                $validated['question_image'] = $imagePath;
            }
    
            $tpk_question->update($validated);
    
            return redirect()->route('sesi-soal.index', ['id' => $session->id, 'nama' => $session->mataLomba->nama])
                ->with('success', 'Pertanyaan berhasil diperbarui!');
        }
    
        return redirect()->route('sesi-soal.index', ['session_id' => $session_id, 'nama' => $session->mataLomba->nama])->with('error', 'Kategori lomba tidak valid.');
    }

    public function destroy(Request $request, $session_id, $id)
    {
        $session = CbtSession::findOrFail($session_id);

        if ($session->mataLomba->nama == \App\Enums\MataLomba::TPK->value) {
            TpkQuestion::destroy($id);
            return redirect()->route('sesi-soal.index', ['id' => $session->id, 'nama' => $session->mataLomba->nama])
                ->with('success', 'Soal berhasil dihapus!');
        }
    }

    public function destroyAll($session_id)
    {
        $session = CbtSession::findOrFail($session_id);

        if ($session->mataLomba->nama == \App\Enums\MataLomba::TPK->value) {
            TpkQuestion::where('cbt_session_id', $session_id)->delete();
            return redirect()->route('sesi-soal.index', ['id' => $session->id, 'nama' => $session->mataLomba->nama])
                ->with('success', 'Semua soal berhasil dihapus!');
        }
    }

    


}
