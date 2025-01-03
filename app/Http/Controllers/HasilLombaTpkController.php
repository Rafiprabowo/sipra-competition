<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CbtSession;
use App\Models\PesertaSession;

class HasilLombaTpkController extends Controller
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
            ->orderByDesc('score')
            ->with([
                'peserta:id,nama,jenis_kelamin,regu_pembina_id',
                'peserta.regu_pembina:id,nama_regu,pembina_id',
                'peserta.regu_pembina.pembina:id,pangkalan', // Memuat relasi pembina dan pangkalan
                'cbtSession.mataLomba:id,nama',
            ])
            ->get()
            ->map(function ($pesertaSession) {
                return [
                    'id' => $pesertaSession->id,
                    'score' => $pesertaSession->score,
                    'nama_peserta' => $pesertaSession->peserta->nama,
                    'jenis_kelamin' => $pesertaSession->peserta->jenis_kelamin,
                    'mata_lomba' => $pesertaSession->cbtSession->mataLomba->nama ?? null,
                    'nama_regu' => $pesertaSession->peserta->regu_pembina->nama_regu ?? null,
                    'nama_pangkalan' => $pesertaSession->peserta->regu_pembina->pembina->pangkalan ?? 'Tidak ada pangkalan', // Menampilkan pangkalan
                ];
            });

        // Kembalikan view dengan data yang diambil
        return view('hasil-lomba-tpk', [
            'top_peserta' => $topPeserta,
        ]);
    }
}
