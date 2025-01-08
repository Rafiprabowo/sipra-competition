<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SmsQuestion;
use App\Models\Symbols;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BankSoalSmsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sms_questions = SmsQuestion::all();
        return view('admin.bank-soal.sms.index', compact('sms_questions'));
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
        $smsQuestion = SmsQuestion::findOrFail($id);
        return view('admin.bank-soal.sms.edit', compact('smsQuestion'));
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
             $smsQuestion = SmsQuestion::findOrFail($id);
     
             // Update the SMS question fields
             $smsQuestion->update([
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
                 return redirect()->route('soal-sms.edit', $id)
                                  ->with('error', "Missing or invalid symbols for word: $word");
             }
     
             // Detach existing symbols
             $smsQuestion->symbols()->detach();
     
             // Attach new symbols with the correct order
             foreach ($letters as $index => $letter) {
                 $symbol = $symbols->firstWhere('letter', $letter);
     
                 // If symbol is not found or has the wrong type, rollback
                 if (!$symbol || $symbol->type !== $smsQuestion->type) {
                     DB::rollBack();
                     Log::error("Symbol mismatch for letter: $letter in word: $word");
                     return redirect()->route('soal-sms.edit', $id)
                                      ->with('error', "Symbol mismatch for letter: $letter in word: $word");
                 }
     
                 // Attach symbol to the question with the order
                 $smsQuestion->symbols()->attach($symbol->id, ['order' => $index + 1]);
             }
     
             // Commit the transaction after successful processing
             DB::commit();
             return redirect()->route('soal-sms.index')->with('success', 'Pertanyaan berhasil diperbarui.');
         } catch (\Exception $e) {
             DB::rollBack();
             Log::error("Error updating SMS Question for word: $word. Error: " . $e->getMessage());
             return redirect()->route('soal-sms.edit', $id)
                              ->with('error', "Error updating SMS Question for word: $word. Please try again.");
         }
     }
     


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $smsQuestion = SmsQuestion::findOrFail($id);
    $smsQuestion->delete();

    return redirect()->route('soal-sms.index')->with('success', 'Pertanyaan berhasil dihapus.');
}

}
