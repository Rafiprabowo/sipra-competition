<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SimulasiTpkQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BankSoalSimulasiTpkController extends Controller
{
    public function index()
    {
        $simulasi_tpk_questions = SimulasiTpkQuestion::all();
        return view('admin.bank-soal.simulasi_tpk.index', compact('simulasi_tpk_questions'));
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
        $simulasiTpkQuestion = SimulasiTpkQuestion::findOrFail($id);
        return view('admin.bank-soal.simulasi_tpk.edit', compact('simulasiTpkQuestion'));
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'question_text' => 'required|string',
            'question_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'answer_a' => 'required|string',
            'answer_b' => 'required|string',
            'answer_c' => 'required|string',
            'answer_d' => 'required|string',
            'correct_answer' => 'required|string',
            'difficulty' => 'required|string',
        ]);

        $question = SimulasiTpkQuestion::findOrFail($id); // Adjust the model name if different

        if ($request->hasFile('question_image')) {
            $validated['question_image'] = $request->file('question_image')->store('images', 'public');
        }

        $question->update($validated);

        return redirect()->route('simulasi-soal-tpk.index')->with('success', 'Soal berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Fetch the question by ID
            $question = SimulasiTpkQuestion::findOrFail($id);
            
            // Check if there is an associated image and delete it
            if ($question->question_image) {
                Storage::delete($question->question_image);
            }
            
            // Delete the question
            $question->delete();
    
            // Redirect back with a success message
            return redirect()->route('simulasi-soal-tpk.index')->with('success', 'Pertanyaan berhasil dihapus.');
        } catch (\Exception $e) {
            // Redirect back with an error message if something goes wrong
            return redirect()->route('simulasi-soal-tpk.index')->with('error', 'Terjadi kesalahan saat menghapus pertanyaan.');
        }
    }
}
