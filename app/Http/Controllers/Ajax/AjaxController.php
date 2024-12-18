<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\ReguPembina;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function getRegu($pembinaId, $jenisKelamin)
{
    // Ubah nilai $jenisKelamin menjadi "PA" jika "Putra", atau "PI" jika "Putri"
    $kategori = ($jenisKelamin === 'Putra') ? 'PA' : (($jenisKelamin === 'Putri') ? 'PI' : null);

    // Jika $kategori tidak valid, kembalikan null atau sesuaikan dengan kebutuhan
    if (!$kategori) {
        return null;
    }

    // Query berdasarkan pembina_id dan kategori
    $regu = ReguPembina::where('pembina_id', $pembinaId)
                       ->where('kategori', $kategori)
                       ->first();

    return response()->json(['data' => $regu]);
}

}
