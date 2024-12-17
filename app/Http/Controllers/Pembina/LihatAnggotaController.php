<?php

namespace App\Http\Controllers\Pembina;

use App\Http\Controllers\Controller;
use App\Models\Peserta;
use App\Models\ReguPembina;
use App\Models\MataLomba;

class LihatAnggotaController extends Controller
{
    public function index()
    {
        // Mengambil data dari database dengan relasi
        $pembina = Peserta::with(['regu_pembina', 'mata_lomba'])->get();

        // Mengirim data ke view
        return view('pembina.lihat-anggota', compact('pembina'));
    }
}
