<?php

namespace App\Imports;

use App\Models\SimulasiTpkQuestion;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;

class SimulasiTpkImportQuestion implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        Log::info($row); 
        return new SimulasiTpkQuestion([
            'question_text' => $row['pertanyaan'],
            'answer_a' => $row['opsi_a'],
            'answer_b' => $row['opsi_b'],
            'answer_c' => $row['opsi_c'],
            'answer_d' => $row['opsi_d'],
            'correct_answer' => strtolower($row['kunci_jawaban']),
            'difficulty' => strtoupper($row['tingkat_kesulitan']),         
        ]);
    }
}
