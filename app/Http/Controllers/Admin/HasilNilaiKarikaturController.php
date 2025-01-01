<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peserta;
use App\Models\MataLomba;
use Illuminate\Support\Facades\DB;

class HasilNilaiKarikaturController extends Controller
{
    public function index() {
        $mata_lomba = MataLomba::where('nama', 'KARIKATUR')->first();
    
        // Fetch and process participants by gender
        $putra = Peserta::with('penilaian_karikatur')
            ->where('mata_lomba_id', $mata_lomba->id)
            ->where('jenis_kelamin', 'Putra')
            ->whereHas('penilaian_karikatur')
            ->get()
            ->map(function ($peserta) {
                $peserta->highest_total_nilai = $peserta->penilaian_karikatur->total_nilai;
                return $peserta;
            })->sortByDesc('highest_total_nilai')->values();
    
        $putri = Peserta::with('penilaian_karikatur')
            ->where('mata_lomba_id', $mata_lomba->id)
            ->where('jenis_kelamin', 'Putri')
            ->whereHas('penilaian_karikatur')
            ->get()
            ->map(function ($peserta) {
                $peserta->highest_total_nilai = $peserta->penilaian_karikatur->total_nilai;
                return $peserta;
            })->sortByDesc('highest_total_nilai')->values();
    
        // Assign rankings and update the database for Putra
        $putra->each(function ($peserta, $index) {
            if ($index == 0) {
                $rank = 'Juara 1';
            } elseif ($index == 1) {
                $rank = 'Juara 2';
            } elseif ($index == 2) {
                $rank = 'Juara 3';
            } else {
                $rank = null;
            }
            $peserta->penilaian_karikatur->update(['rangking' => $rank]);
        });
    
        // Assign rankings and update the database for Putri
        $putri->each(function ($peserta, $index) {
            if ($index == 0) {
                $rank = 'Juara 1';
            } elseif ($index == 1) {
                $rank = 'Juara 2';
            } elseif ($index == 2) {
                $rank = 'Juara 3';
            } else {
                $rank = null;
            }
            $peserta->penilaian_karikatur->update(['rangking' => $rank]);
        });
    
        return view('admin.hasil_nilai.nilai_karikatur', compact('putra', 'putri'));
    }      
}

