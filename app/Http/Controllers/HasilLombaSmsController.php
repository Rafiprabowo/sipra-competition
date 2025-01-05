<?php

namespace App\Http\Controllers;

use App\Models\CbtSession;
use App\Models\PesertaSession;
use Illuminate\Http\Request;

class HasilLombaSmsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // Nama Mata Lomba SMS
        $mataLombaSMS = \App\Enums\MataLomba::SMS->value;
    
        // Ambil ID sesi CBT yang terkait dengan mata lomba SMS
        $cbtSessionIds = CbtSession::whereHas('mataLomba', function ($query) use ($mataLombaSMS) {
            $query->where('nama', $mataLombaSMS);
        })->pluck('id');
    
        // Ambil data peserta dan urutkan berdasarkan jenis kelamin dan nilai
        $topPeserta = PesertaSession::whereIn('cbt_session_id', $cbtSessionIds)
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
                // Menampilkan semua peserta tanpa batasan jumlah
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
                        'id' => $pesertaSession->id,
                        'score' => $pesertaSession->score,
                        'nama_peserta' => $pesertaSession->peserta->nama,
                        'jenis_kelamin' => $pesertaSession->peserta->jenis_kelamin,
                        'mata_lomba' => $pesertaSession->cbtSession->mataLomba->nama ?? null,
                        'nama_regu' => $pesertaSession->peserta->regu_pembina->nama_regu ?? null,
                        'nama_pangkalan' => $pesertaSession->peserta->regu_pembina->pembina->pangkalan ?? 'Tidak ada pangkalan', // Menampilkan pangkalan
                        'peringkat' => $peringkat,
                    ];
                });
            });
    
        // Gabungkan data laki-laki dan perempuan dalam satu array
        $combinedTopPeserta = $topPeserta->collapse();
    
        // Kembalikan view dengan data yang diambil
        return view('hasil-lomba-sms', [
            'top_peserta' => $combinedTopPeserta,
            'mataLomba' => $mataLombaSMS
        ]);
    }
}
