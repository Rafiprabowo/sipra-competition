<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CbtSession;
use App\Models\SmsQuestion;
use App\Models\Symbols;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class SmsQuestionSmsController extends Controller
{
    public function index()
    {
        // Mengambil semua smsQuestions beserta simbol dan CBT session
        $smsQuestions = SmsQuestion::with(['symbols' => function($query) {
            $query->orderBy('sms_question_images.order');  // Urutkan simbol berdasarkan order yang ada di sms_question_images
        }, 'cbtSession'])->get();

        return view('admin.sms-questions.index', compact('smsQuestions'));
    }

    public function create(){
        $mataLomba = \App\Enums\MataLomba::SMS->value;
        $cbtSessions = CbtSession::whereHas('mataLomba', function($query) use ($mataLomba){
            $query->where('nama', $mataLomba);
        })->get();
        return view('admin.sms-questions.create', compact('cbtSessions'));
    }

        public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'type' => ['required', Rule::in([\App\Enums\SymbolType::Morse->value, \App\Enums\SymbolType::Semaphore->value])],
            'word' => 'required|string|size:5', // Kata harus terdiri dari tepat 5 huruf
            'cbt_session_id' => 'required|exists:cbt_sessions,id',
        ]);

        // Validasi tambahan: pastikan input adalah satu kata tanpa spasi
        if (str_contains($request->word, ' ')) {
            return back()->withErrors(['word' => 'The word must be a single word without spaces and exactly 5 letters.']);
        }

        // Ubah input ke huruf besar
        $word = strtoupper($request->word);

        // Mulai transaksi
        DB::beginTransaction();
        try {
            // Buat SMS Question
            $smsQuestion = SmsQuestion::create([
                'type' => $request->type,
                'word' => $word,
                'cbt_session_id' => $request->cbt_session_id
            ]);

            // Ambil simbol dari huruf-huruf kata
            $letters = str_split($word);
            $symbols = Symbols::whereIn('letter', $letters)
                                ->where('type', $request->type)
                                ->get();

            // Validasi simbol
            if ($symbols->count() != count(array_unique($letters))) {
                DB::rollBack();
                return back()->withErrors(['word' => 'Some symbols are missing or invalid.']);
            }

            // Tambahkan simbol ke pertanyaan dengan urutan unik
            foreach ($letters as $index => $letter) {
                // Ambil simbol berdasarkan huruf
                $symbol = $symbols->firstWhere('letter', $letter);

                // Jika simbol tidak ditemukan, rollback transaksi
                if (!$symbol || $symbol->type !== $smsQuestion->type) {
                    DB::rollBack();
                    return back()->withErrors(['word' => 'Some symbols are missing or have an incorrect type.']);
                }

                // Simpan ke tabel pivot dengan urutan
                $smsQuestion->symbols()->attach($symbol->id, ['order' => $index + 1]);
            }

            // Commit transaksi jika semuanya valid
            DB::commit();
            return redirect()->route('sms-questions.index')->with('success', 'SMS Question created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'An error occurred while creating the SMS Question.']);
        }
    }

    

    public function edit($id){
        $mataLomba = \App\Enums\MataLomba::SMS->value;
        $smsQuestion = SmsQuestion::with('cbtSession')->findOrFail($id);
        $cbtSessions = CbtSession::whereHas('mataLomba', function($query) use ($mataLomba){
            $query->where('nama', $mataLomba);
        })->get();

        return view('admin.sms-questions.edit', compact('smsQuestion', 'cbtSessions'));
    }

    public function update(Request $request, SmsQuestion $smsQuestion)
    {
        // Validasi input
        $request->validate([
            'type' => ['required', Rule::in([\App\Enums\SymbolType::Morse->value, \App\Enums\SymbolType::Semaphore->value])],
            'word' => 'required|string|size:5', // Kata harus terdiri dari tepat 5 huruf
            'cbt_session_id' => 'required|exists:cbt_sessions,id',
        ]);
    
        // Validasi tambahan: pastikan input adalah satu kata tanpa spasi
        if (str_contains($request->word, ' ')) {
            return back()->withErrors(['word' => 'The word must be a single word without spaces and exactly 5 letters.']);
        }
    
        // Ubah input menjadi huruf besar
        $word = strtoupper($request->word);
    
        DB::beginTransaction();
        try {
            // Perbarui data SMS Question
            $smsQuestion->update([
                'type' => $request->type,
                'word' => $word,
                'cbt_session_id' => $request->cbt_session_id
            ]);
    
            // Hapus semua simbol lama yang terhubung dengan SMS Question
            $smsQuestion->symbols()->detach();
    
            // Pecah kata menjadi huruf-huruf
            $letters = str_split($word);
    
            // Ambil simbol untuk huruf-huruf tersebut
            $symbols = Symbols::whereIn('letter', $letters)
                                ->where('type', $request->type)
                                ->get();
    
            // Validasi simbol (pastikan semua simbol ditemukan)
            if ($symbols->count() != count(array_unique($letters))) {
                DB::rollBack();
                return back()->withErrors(['word' => 'Some symbols are missing or invalid.']);
            }
    
            // Loop untuk menyimpan simbol berdasarkan posisi huruf dalam kata
            foreach ($letters as $index => $letter) {
                // Ambil simbol berdasarkan huruf
                $symbol = $symbols->firstWhere('letter', $letter);
    
                // Jika simbol tidak ditemukan atau jenisnya salah, rollback
                if (!$symbol || $symbol->type !== $smsQuestion->type) {
                    DB::rollBack();
                    return back()->withErrors(['word' => 'Some symbols have an incorrect type or are missing.']);
                }
    
                // Tambahkan simbol ke tabel pivot dengan urutan
                $smsQuestion->symbols()->attach($symbol->id, ['order' => $index + 1]);
            }
    
            // Commit transaksi jika semuanya valid
            DB::commit();
            return redirect()->route('sms-questions.index')->with('success', 'SMS Question updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'An error occurred while updating the SMS Question.']);
        }
    }
    


    public function destroy(SmsQuestion $smsQuestion){
        $smsQuestion->symbols()->detach();
        $smsQuestion->delete();

        return redirect()->route('sms-questions.index')->with('success', 'SMS Question deleted successfully');
    }
    



}
