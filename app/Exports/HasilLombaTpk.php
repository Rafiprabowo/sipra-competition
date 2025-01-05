<?php

namespace App\Exports;

use App\Models\CbtSession;
use App\Models\PesertaSession;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class HasilLombaTpk implements FromCollection, WithHeadings
{
    // Menentukan data yang akan diekspor
    public function collection()
    {
        $sms = \App\Enums\MataLomba::TPK->value;
    
        // Ambil ID sesi CBT yang terkait dengan mata lomba TPK
        $cbtSessionIds = CbtSession::whereHas('mataLomba', function ($query) use ($sms) {
            $query->where('nama', $sms);
        })->pluck('id');

        // Ambil data peserta dan urutkan berdasarkan jenis kelamin dan nilai
        return PesertaSession::whereIn('cbt_session_id', $cbtSessionIds)
            ->whereHas('peserta', function ($query) {
                $query->whereIn('jenis_kelamin', ['Putra', 'Putri']);
            })
            ->with([
                'peserta:id,nama,jenis_kelamin,regu_pembina_id',
                'peserta.regu_pembina:id,nama_regu,pembina_id',
                'peserta.regu_pembina.pembina:id,pangkalan', // Memuat relasi pembina dan pangkalan
                'cbtSession.mataLomba:id,nama',
            ])
            ->orderByDesc('score') // Mengurutkan berdasarkan nilai
            ->get()
            ->groupBy('peserta.jenis_kelamin') // Kelompokkan berdasarkan jenis kelamin
            ->map(function ($group) {
                return $group->map(function ($pesertaSession, $index) {
                    // Menambahkan label "Juara" untuk indeks 0, 1, dan 2, lainnya diberi label "Peserta"
                    $peringkat = '';
                    if ($index == 0) {
                        $peringkat = 'Juara 1';
                    } elseif ($index == 1) {
                        $peringkat = 'Juara 2';
                    } elseif ($index == 2) {
                        $peringkat = 'Juara 3';
                    } else {
                        $peringkat = '';
                    }

                    return [
                        'nama_peserta' => $pesertaSession->peserta->nama,
                        'jenis_kelamin' => $pesertaSession->peserta->jenis_kelamin,
                        'mata_lomba' => $pesertaSession->cbtSession->mataLomba->nama ?? null,
                        'nama_regu' => $pesertaSession->peserta->regu_pembina->nama_regu ?? null,
                        'nama_pangkalan' => $pesertaSession->peserta->regu_pembina->pembina->pangkalan ?? 'Tidak ada pangkalan', // Menampilkan pangkalan
                        'score' => $pesertaSession->score,
                        'peringkat' => $peringkat,
                    ];
                });
            })->collapse();
    }

    // Menentukan header kolom Excel
    public function headings(): array
    {
        return [
            'Nama Peserta',
            'Jenis Kelamin',
            'Mata Lomba',
            'Nama Regu',
            'Nama Pangkalan',
            'Score',
            'Peringkat'
        ];
    }
}
