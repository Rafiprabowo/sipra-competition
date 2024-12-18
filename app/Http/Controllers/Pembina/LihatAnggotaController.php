<?php

namespace App\Http\Controllers\Pembina;

use App\Http\Controllers\Controller;


class LihatAnggotaController extends Controller
{
    public function index()
{
    // Pastikan user memiliki pembina
    $user = auth()->user();
    $pembinaId = optional($user->pembina)->id;

    // Mengambil data peserta dengan relasi ke regu_pembinas dan mata_lombas
    $pembina = \App\Models\Pembina::with('regu.peserta')->find($pembinaId);

    if (!$pembina) {
        // Jika pembina tidak ditemukan, buat objek kosong
        $pembina = new \App\Models\Pembina();
    }

    return view('pembina.lihat-anggota', compact('pembina'));
}

}
