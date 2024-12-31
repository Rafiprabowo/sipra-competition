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
        $mata_lomba = MataLomba::where('nama', 'KARIKATUR')->first(); // Ambil peserta yang terdaftar pada mata lomba "karikatur" dan sudah memiliki penilaian 
        $pesertas = Peserta::with('penilaian_karikatur') // Eager load penilaian_karikatur 
        ->where('mata_lomba_id', $mata_lomba->id) 
        ->whereHas('penilaian_karikatur') // Mengambil peserta yang sudah memiliki penilaian 
        ->get(); 
        return view('admin.hasil_nilai.nilai_karikatur', compact('pesertas')); 
    }
}

