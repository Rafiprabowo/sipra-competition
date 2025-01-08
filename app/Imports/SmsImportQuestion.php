<?php

namespace App\Imports;

use App\Models\SmsQuestion;
use App\Models\Symbols;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SmsImportQuestion implements ToModel, WithHeadingRow
{


public function model(array $row)
{
    Log::info($row); // Log to see the row data

    // Prepare the word (convert to uppercase)
    $word = strtoupper($row['kata']);

    // Validate that word has exactly 5 characters
    if (strlen($word) !== 5) {
        Log::error("Invalid word length for row: " . implode(", ", $row));
        return null; // Skip invalid row
    }

    // Start a database transaction
    DB::beginTransaction();

    try {
        // Create the SMS Question
        $smsQuestion = SmsQuestion::create([
            'type' => strtoupper($row['tipe_soal']),
            'word' => $word,
        ]);

        // Extract the letters from the word
        $letters = str_split($word);
        $symbols = Symbols::whereIn('letter', $letters)
                            ->where('type', strtoupper($row['tipe_soal']))
                            ->get();

        // Validate the symbols
        if ($symbols->count() != count(array_unique($letters))) {
            DB::rollBack();
            Log::error("Missing or invalid symbols for word: $word");
            return null; // Skip this row if symbols are invalid
        }

        // Attach symbols to the SMS Question with the correct order
        foreach ($letters as $index => $letter) {
            $symbol = $symbols->firstWhere('letter', $letter);

            // If symbol is not found or has the wrong type, rollback
            if (!$symbol || $symbol->type !== $smsQuestion->type) {
                DB::rollBack();
                Log::error("Symbol mismatch for letter: $letter in word: $word");
                return null; // Skip this row
            }

            // Attach symbol to the question with the order
            $smsQuestion->symbols()->attach($symbol->id, ['order' => $index + 1]);
        }

        // Commit the transaction after successful processing
        DB::commit();
        return $smsQuestion; // Return the model to indicate success
    } catch (\Exception $e) {
        DB::rollBack();
        Log::error("Error processing SMS Question for word: $word. Error: " . $e->getMessage());
        return null; // Skip the row on error
    }
}
}