<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SimulasiSmsQuestion;
use App\Models\Symbols;

class ExamController extends Controller
{
    public function show($id)
    {
        // Fetch the question by ID with related symbols
        $question = SimulasiSmsQuestion::with(['images.symbol'])->findOrFail($id);

        // Split the word into individual letters
        $letters = str_split($question->word);

        // Fetch the corresponding symbols for each letter
        $symbols = Symbols::whereIn('letter', $letters)->where('type', $question->type)->get()->keyBy('letter');

        return view('exam', compact('question', 'symbols', 'letters'));
    }
}
