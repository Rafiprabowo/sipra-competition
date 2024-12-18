<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\ReguPembina;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function getRegu($jenisKelamin)
    {
        // Periksa apakah user memiliki pembina
        $pembina = optional(auth()->user())->pembina;
    
        if (!$pembina) {
            // Jika pembina null, kembalikan respons dengan pesan error
            return response()->json([
                'error' => 'Data pembina tidak ditemukan.',
            ], 404);
        }
    
        // Ubah nilai $jenisKelamin menjadi "PA" jika "Putra", atau "PI" jika "Putri"
        $kategori = ($jenisKelamin === 'Putra') ? 'PA' : (($jenisKelamin === 'Putri') ? 'PI' : null);
    
        // Jika $kategori tidak valid, kembalikan null atau sesuaikan dengan kebutuhan
        if (!$kategori) {
            return response()->json([
                'error' => 'Kategori jenis kelamin tidak valid.',
            ], 400);
        }
    
        // Query berdasarkan pembina_id dan kategori
        $regu = ReguPembina::where('pembina_id', $pembina->id)
                           ->where('kategori', $kategori)
                           ->first();
    
        if (!$regu) {
            return response()->json([
                'error' => 'Data regu tidak ditemukan.',
            ], 404);
        }
    
        return response()->json(['data' => $regu]);
    }
    

}
