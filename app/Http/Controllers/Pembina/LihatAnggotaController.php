<?php

namespace App\Http\Controllers\Pembina;

use App\Http\Controllers\Controller;


class LihatAnggotaController extends Controller
{
    public function index()
    {
        // Mengambil data peserta dengan relasi ke regu_pembinas dan mata_lombas
        $pembina = \App\Models\Pembina::with('regu.peserta')->find(auth()->user()->pembina->id);

        if(!$pembina){
            $pembina = new \App\Models\Pembina();
        }
        
        return view('pembina.lihat-anggota', compact('pembina'));
    }
}
