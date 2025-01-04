<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CbtSession;
use App\Models\PesertaSession;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class LaporanHasilLombaTpkController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // Nama Mata Lomba TPK
        $mataLombaTPK = \App\Enums\MataLomba::TPK->value;
    
        // Ambil ID sesi CBT yang terkait dengan mata lomba TPK
        $cbtSessionIds = CbtSession::whereHas('mataLomba', function ($query) use ($mataLombaTPK) {
            $query->where('nama', $mataLombaTPK);
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
                // Ambil hanya 3 peserta teratas dari setiap jenis kelamin
                return $group->take(3)->map(function ($pesertaSession, $index) {
                    return [
                        'id' => $pesertaSession->id,
                        'score' => $pesertaSession->score,
                        'nama_peserta' => $pesertaSession->peserta->nama,
                        'jenis_kelamin' => $pesertaSession->peserta->jenis_kelamin,
                        'mata_lomba' => $pesertaSession->cbtSession->mataLomba->nama ?? null,
                        'nama_regu' => $pesertaSession->peserta->regu_pembina->nama_regu ?? null,
                        'nama_pangkalan' => $pesertaSession->peserta->regu_pembina->pembina->pangkalan ?? 'Tidak ada pangkalan', // Menampilkan pangkalan
                        'peringkat' => $index + 1 // Menambahkan peringkat berdasarkan urutan
                    ];
                });
            });
    
        // Gabungkan data laki-laki dan perempuan dalam satu array
        $combinedTopPeserta = $topPeserta->collapse();

        // Buat PDF dari tampilan
        $pdf = Pdf::loadView('pdf.laporan-lomba-tpk', ['top_peserta' => $combinedTopPeserta]);
        
        // Mengatur ukuran kertas dan orientasi PDF (Opsional)
        $pdf->setPaper('A4', 'potrait'); // Atur ukuran dan orientasi kertas (A4 dan landscape)

        return $pdf->download('laporan-hasil-lomba-tpk.pdf');
       
    }
}


