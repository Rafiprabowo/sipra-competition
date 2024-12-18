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

    // Jika pembinaId null, buat objek kosong atau tangani sesuai kebutuhan
    // if (!$pembinaId) {
    //     return redirect()->route('error.page')->with('error', 'Pembina tidak ditemukan.');
    // }

    $pembina = \App\Models\Pembina::with('regu.peserta', 'finalisasi') // Eager load regu dan finalisasi
    ->whereHas('finalisasi', function ($query) {
        $query->where('status', true);
    })
    ->orWhereDoesntHave('finalisasi') // Membawa pembina yang tidak memiliki finalisasi
    ->find($pembinaId);


    if (!$pembina || !optional($pembina->finalisasi)->status) {
        // Jika pembina tidak ditemukan, buat objek kosong
        $pembina = new \App\Models\Pembina();
    }

    return view('pembina.lihat-anggota', compact('pembina'));
}

}
