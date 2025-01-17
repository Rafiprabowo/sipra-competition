<?php

namespace App\Exports;

use App\Models\CbtSession;
use App\Models\MataLomba;
use App\Models\PesertaSession;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class HasilLombaTpk implements FromCollection, WithHeadings
{
    
    public function collection()
    {
        
        $mataLomba = MataLomba::where('nama', \App\Enums\MataLomba::TPK->value)->first();

        $rankingResults = [];

        if ($mataLomba) {
            $pesertaSessions = PesertaSession::with('peserta')
                ->whereHas('cbtSession', function ($query) use ($mataLomba) {
                    $query->where('mata_lomba_id', $mataLomba->id);
                })
                ->orderByDesc('score')
                ->orderByDesc('completed_at')
                ->orderByDesc('correct_difficult_answers')
                ->get();

            
            $groupedByGender = $pesertaSessions->groupBy(fn($pesertaSession) => $pesertaSession->peserta->jenis_kelamin ?? 'Tidak diketahui');

            
            $rankedByGender = $groupedByGender->map(function ($group) {
                return $group->map(function ($pesertaSession, $index) {
                    // Menambahkan peringkat untuk Juara 1, 2, dan 3
                    if ($index < 3) {
                        $pesertaSession->rank = 'Juara ' . ($index + 1);
                    } else {
                        $pesertaSession->rank = '';
                    }

                    return $pesertaSession;
                });
            });

            
            $rankingResults = $rankedByGender->collapse(); // Flatten the collection

            // Format hasil untuk ekspor
            $formattedResults = $rankingResults->map(function ($pesertaSession) {
                return [
                    'nama_peserta' => $pesertaSession->peserta->nama ?? 'N/A',
                    'jenis_kelamin' => $pesertaSession->peserta->jenis_kelamin ?? 'N/A',
                    'mata_lomba' => $pesertaSession->cbtSession->mataLomba->nama ?? 'N/A',
                    'nama_regu' => $pesertaSession->peserta->regu_pembina->nama_regu ?? 'N/A',
                    'nama_pangkalan' => $pesertaSession->peserta->regu_pembina->pembina->pangkalan ?? 'Tidak ada pangkalan',
                    'score' => $pesertaSession->score,
                    'peringkat' => $pesertaSession->rank,
                    'completed_at' => $pesertaSession->completed_at,
                    'correct_difficult_answers' => $pesertaSession->correct_difficult_answers,
                    'correct_answer_count' => $pesertaSession->correct_answer_count,
                ];
            });

            return $formattedResults;
        }

        return collect(); // Kembalikan koleksi kosong jika tidak ditemukan data
    }

    // Menentukan header kolom Excel
    public function headings(): array
    {
        return [
            'Nama Peserta',
            'Jenis Kelamin',
            'Mata Lomba',
            'Regu',
            'Pangkalan',
            'Nilai',
            'Waktu',
            'Peringkat',
            'Soal Sulit Benar',
            'Jumlah Soal Benar'
        ];
    }
}
