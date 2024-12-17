<?php

namespace App\Http\Controllers\Pembina;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peserta;
use App\Models\ReguPembina;
use App\Models\MataLomba;

class LihatAnggotaController extends Controller
{
    public function index()
    {
        // Mengambil data peserta dengan relasi ke regu_pembinas dan mata_lombas
        $pembina = Peserta::with(['regu_pembina', 'mata_lomba'])->get();
        
        return view('pembina.lihat-anggota', compact('pembina'));
    }
}
