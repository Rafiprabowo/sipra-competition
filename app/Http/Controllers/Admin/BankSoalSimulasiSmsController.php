<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SimulasiSmsQuestion;
use App\Models\Symbols;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BankSoalSimulasiSmsController extends Controller
{
    public function index()
    {
        $simulasi_sms_questions = SimulasiSmsQuestion::all();
        return view('admin.bank-soal.simulasi_sms.index', compact('simulasi_sms_questions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $simulasiSmsQuestion = SimulasiSmsQuestion::findOrFail($id);
        return view('admin.bank-soal.simulasi_sms.edit', compact('simulasiSmsQuestion'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    
     public function update(Request $request, $id)
     {
         $request->validate([
             'type' => 'required',
             'word' => 'required|string|size:5',
             'difficulty' => 'required|string',
         ]);
     
         // Convert the word to uppercase and split into letters
         $word = strtoupper($request->input('word'));
         $letters = str_split($word);
     
         // Start a database transaction
         DB::beginTransaction();
     
         try {
             // Find the SMS question
             $simulasiSmsQuestion = SimulasiSmsQuestion::findOrFail($id);
     
             // Update the SMS question fields
             $simulasiSmsQuestion->update([
                 'type' => strtoupper($request->input('type')),
                 'word' => $word,
                 'difficulty' => $request->input('difficulty'),
             ]);
     
             // Retrieve the symbols matching the letters and type
             $symbols = Symbols::whereIn('letter', $letters)
                               ->where('type', strtoupper($request->input('type')))
                               ->get();
     
             // Validate the symbols
             if ($symbols->count() != count(array_unique($letters))) {
                 DB::rollBack();
                 Log::error("Missing or invalid symbols for word: $word");
                 return redirect()->route('simulasi-soal-sms.edit', $id)
                                  ->with('error', "Missing or invalid symbols for word: $word");
             }
     
             // Detach existing symbols
             $simulasiSmsQuestion->symbols()->detach();
     
             // Attach new symbols with the correct order
             foreach ($letters as $index => $letter) {
                 $symbol = $symbols->firstWhere('letter', $letter);
     
                 // If symbol is not found or has the wrong type, rollback
                 if (!$symbol || $symbol->type !== $simulasiSmsQuestion->type) {
                     DB::rollBack();
                     Log::error("Symbol mismatch for letter: $letter in word: $word");
                     return redirect()->route('simulasi-soal-sms.edit', $id)
                                      ->with('error', "Symbol mismatch for letter: $letter in word: $word");
                 }
     
                 // Attach symbol to the question with the order
                 $simulasiSmsQuestion->symbols()->attach($symbol->id, ['order' => $index + 1]);
             }
     
             // Commit the transaction after successful processing
             DB::commit();
             return redirect()->route('simulasi-soal-sms.index')->with('success', 'Pertanyaan berhasil diperbarui.');
         } catch (\Exception $e) {
             DB::rollBack();
             Log::error("Error updating SMS Question for word: $word. Error: " . $e->getMessage());
             return redirect()->route('simulasi-soal-sms.edit', $id)
                              ->with('error', "Error updating SMS Question for word: $word. Please try again.");
         }
     }
     

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $simulasiSmsQuestion = SimulasiSmsQuestion::findOrFail($id);
        $simulasiSmsQuestion->delete();

        return redirect()->route('simulasi-soal-sms.index')->with('success', 'Pertanyaan berhasil dihapus.');
    }

}
