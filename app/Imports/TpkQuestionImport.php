<?php

namespace App\Imports;

use App\Models\TpkQuestion;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;

class TpkQuestionImport implements ToModel, WithHeadingRow
{
    protected $cbt_session_id;

    public function __construct($cbt_session_id)
    {
        $this->cbt_session_id = $cbt_session_id;   
    }
    public function model(array $row)
    {
        Log::info($row); 
        return new TpkQuestion([
            'question_text' => $row['pertanyaan'],
            'answer_a' => $row['opsi_a'],
            'answer_b' => $row['opsi_b'],
            'answer_c' => $row['opsi_c'],
            'answer_d' => $row['opsi_d'],
            'correct_answer' => strtolower($row['kunci_jawaban']),
            'difficulty' => strtoupper($row['tingkat_kesulitan']),
            'cbt_session_id' => $this->cbt_session_id
        ]);
    }
}
