<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CbtSession;
use App\Models\MataLomba;
use App\Models\User;
use App\Models\Juri;
use App\Models\PesertaSession;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanHasilLombaSmsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $mataLomba = MataLomba::where('nama', \App\Enums\MataLomba::SMS->value)->first();
    
        $rankingResults = [];
    
        if ($mataLomba) {
            $pesertaSessions = PesertaSession::with('peserta')
                ->whereHas('cbtSession', function ($query) use ($mataLomba) {
                    $query->where('mata_lomba_id', $mataLomba->id);
                })
                ->orderByDesc('score')
                ->orderByDesc('correct_difficult_answers')
                ->orderBy('completed_at')
                ->get();
    
            $groupedByGender = $pesertaSessions->groupBy(fn($pesertaSession) => $pesertaSession->peserta->jenis_kelamin ?? 'Tidak Diketahui');
    
            $rankedByGender = $groupedByGender->map(function ($group) {
                return $group->map(function ($pesertaSession, $index) {
                    if ($index < 3) {
                        $pesertaSession->rank = $index + 1; // Juara 1, 2, atau 3
                    } else {
                        $pesertaSession->rank = ''; // Tidak mendapat juara
                    }
                    return $pesertaSession;
                });
            });
    
            $rankingResults = [
                'ranked_participants' => $rankedByGender,
            ];
        }

        // Fetch Ketua Pelaksana
        $ketuaPelaksanas = User::where('role', 'ketua_pelaksana')->get();
        // Fetch Juris with specific mata_lomba_id
        $juritpks = Juri::whereHas('mata_lomba', function ($query) {
            $query->where('nama', 'TES SEMAPHORE & MORSE');
        })->get();
    
        // Add base64 encoding for logos
        $pathLogoKiri = public_path('img/logo-kiri.png');
        $pathLogoKanan = public_path('img/logo-kanan.jpg');
        $typeLogoKiri = pathinfo($pathLogoKiri, PATHINFO_EXTENSION);
        $typeLogoKanan = pathinfo($pathLogoKanan, PATHINFO_EXTENSION);
        $dataLogoKiri = file_get_contents($pathLogoKiri);
        $dataLogoKanan = file_get_contents($pathLogoKanan);
        $base64LogoKiri = 'data:image/' . $typeLogoKiri . ';base64,' . base64_encode($dataLogoKiri);
        $base64LogoKanan = 'data:image/' . $typeLogoKanan . ';base64,' . base64_encode($dataLogoKanan);
    
        $data = [
            'base64LogoKiri' => $base64LogoKiri,
            'base64LogoKanan' => $base64LogoKanan,
            'rankingResults' => $rankingResults,
            'ketuaPelaksanas' => $ketuaPelaksanas,
            'juritpks' => $juritpks,
        ];
    
        // Buat PDF dari tampilan
        $pdf = Pdf::loadView('pdf.laporan-lomba-sms', $data);
    
        // Mengatur ukuran kertas dan orientasi PDF (Opsional)
        $pdf->setPaper('A4', 'portrait'); // Atur ukuran dan orientasi kertas
    
        return $pdf->download('laporan-hasil-lomba-sms.pdf');
    }    
}
