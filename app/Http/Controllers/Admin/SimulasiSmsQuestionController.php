<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SimulasiSmsQuestion;
use App\Models\Symbols;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class SimulasiSmsQuestionController extends Controller
{
    public function index()
    {
        // Mengambil semua smsQuestions beserta simbol dan CBT session
        $simulasiSmsQuestions = SimulasiSmsQuestion::with(['symbols' => function($query) {
            $query->orderBy('simulasi_sms_question_images.order');  // Urutkan simbol berdasarkan order yang ada di sms_question_images
        }])->get();

        return view('admin.simulasi-sms-questions.index', compact('simulasiSmsQuestions'));
    }

    public function create(){
        $mataLomba = \App\Enums\MataLomba::SMS->value;
        return view('admin.simulasi-sms-questions.create', compact('simulasiCbtSessions'));
    }

    
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'word' => 'required|string|size:5', // Kata harus terdiri dari tepat 5 huruf
            'type' => ['required', Rule::in([\App\Enums\QuestionType::MORSE->value, \App\Enums\QuestionType::SEMAPHORE->value])],
            'difficulty' => ['required', Rule::in(['mudah', 'sulit'])],
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
            $simulasiSmsQuestion = SimulasiSmsQuestion::create([
                'type' => $request->type,
                'word' => $word,
                'difficulty' => $request->difficulty,
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
                if (!$symbol || $symbol->type !== $simulasiSmsQuestion->type) {
                    DB::rollBack();
                    return back()->withErrors(['word' => 'Some symbols are missing or have an incorrect type.']);
                }
    
                // Simpan ke tabel pivot dengan urutan
                $simulasiSmsQuestion->symbols()->attach($symbol->id, ['order' => $index + 1]);
            }
    
            // Commit transaksi jika semuanya valid
            DB::commit();
            return redirect()->route('simulasi-sms-questions.index')->with('success', 'Simulasi SMS Question created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'An error occurred while creating the SMS Question.']);
        }
    }
    

    

    public function edit($id){
        $mataLomba = \App\Enums\MataLomba::SMS->value;
        return view('admin.simulasi-sms-questions.edit', compact('simulasiSmsQuestion', 'simulasicbtSessions'));
    }


    public function update(Request $request, SimulasiSmsQuestion $simulasiSmsQuestion)
{
    // Validasi input
    $request->validate([
        'type' => ['required', Rule::in([\App\Enums\SymbolType::Morse->value, \App\Enums\SymbolType::Semaphore->value])],
        'word' => 'required|string|size:5', // Kata harus terdiri dari tepat 5 huruf
        'difficulty' => ['required', Rule::in(['mudah', 'sulit'])], // Menambahkan validasi difficulty
    ]);

    // Validasi tambahan: pastikan input adalah satu kata tanpa spasi
    if (str_contains($request->word, ' ')) {
        return back()->withErrors(['word' => 'The word must be a single word without spaces and exactly 5 letters.']);
    }

    // Ubah input menjadi huruf besar
    $word = strtoupper($request->word);

    // Mulai transaksi
    DB::beginTransaction();
    try {
        // Perbarui data SMS Question dengan difficulty
        $simulasiSmsQuestion->update([
            'type' => $request->type,
            'word' => $word,
            'difficulty' => $request->difficulty, // Menambahkan difficulty ke update
        ]);

        // Hapus semua simbol lama yang terhubung dengan SMS Question
        $simulasiSmsQuestion->symbols()->detach();

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
            if (!$symbol || $symbol->type !== $simulasiSmsQuestion->type) {
                DB::rollBack();
                return back()->withErrors(['word' => 'Some symbols have an incorrect type or are missing.']);
            }

            // Tambahkan simbol ke tabel pivot dengan urutan
            $simulasiSmsQuestion->symbols()->attach($symbol->id, ['order' => $index + 1]);
        }

        // Commit transaksi jika semuanya valid
        DB::commit();
        return redirect()->route('simulasi-sms-questions.index')->with('success', 'Simulasi SMS Question updated successfully.');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->withErrors(['error' => 'An error occurred while updating the SMS Question.']);
    }
}


    public function destroy(SimulasiSmsQuestion $simulasiSmsQuestion){
        $simulasiSmsQuestion->symbols()->detach();
        $simulasiSmsQuestion->delete();

        return redirect()->route('simulasi-sms-questions.index')->with('success', 'Simulasi SMS Question deleted successfully');
    }
}
