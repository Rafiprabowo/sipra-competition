<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\ReguPembina;
use App\Models\Peserta;
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

    public function getReguPangkalan($pangkalan_id)
    {
        // Mengambil regu berdasarkan ID pangkalan
        $regu = ReguPembina::where('pembina_id', $pangkalan_id)->get();
        
        if ($regu->isEmpty()) {
            return response()->json([
                'data' => [],
                'error' => 'Data regu tidak ditemukan.',
            ], 404);
        }

        return response()->json(['data' => $regu]);
    }

    public function getReguPangkalan2($pangkalan_id)
    {
        // Mengambil regu berdasarkan ID pangkalan
        $regu = ReguPembina::where('pembina_id', $pangkalan_id)->get();
        
        if ($regu->isEmpty()) {
            return response()->json([
                'data' => [],
                'error' => 'Data regu tidak ditemukan.',
            ], 404);
        }

        return response()->json(['data' => $regu]);
    }

    public function getReguPangkalan3($pangkalan_id)
    {
        // Mengambil regu berdasarkan ID pangkalan
        $regu = ReguPembina::where('pembina_id', $pangkalan_id)->get();
        
        if ($regu->isEmpty()) {
            return response()->json([
                'data' => [],
                'error' => 'Data regu tidak ditemukan.',
            ], 404);
        }

        return response()->json(['data' => $regu]);
    }

    public function getReguPangkalan4($pangkalan_id)
    {
        // Mengambil regu berdasarkan ID pangkalan
        $regu = ReguPembina::where('pembina_id', $pangkalan_id)->get();
        
        if ($regu->isEmpty()) {
            return response()->json([
                'data' => [],
                'error' => 'Data regu tidak ditemukan.',
            ], 404);
        }

        return response()->json(['data' => $regu]);
    }

    public function getPesertaRegu($regu_id)
    {
        // Mengambil peserta berdasarkan ID regu dan mata lomba 'KARIKATUR'
        $peserta = Peserta::where('regu_pembina_id', $regu_id)
            ->whereHas('mata_lomba', function ($query) {$query->where('nama', 'KARIKATUR');})
        ->get();
        
        if ($peserta->isEmpty()) {
            return response()->json([
                'data' => [],
                'error' => 'Tidak ada peserta dengan mata lomba KARIKATUR.',
            ], 404);
        }

        return response()->json(['data' => $peserta]);
    }

    public function getPesertaRegu2($regu_id)
    {
        // Mengambil peserta berdasarkan ID regu dan mata lomba 'PIONERING'
        $peserta = Peserta::where('regu_pembina_id', $regu_id)
            ->whereHas('mata_lomba', function ($query) {$query->where('nama', 'PIONERING');})
        ->get();
        
        if ($peserta->isEmpty()) {
            return response()->json([
                'data' => [],
                'error' => 'Tidak ada peserta dengan mata lomba PIONERING.',
            ], 404);
        }

        return response()->json(['data' => $peserta]);
    }

    public function getPesertaRegu3($regu_id)
    {
        // Mengambil peserta berdasarkan ID regu dan mata lomba 'DUTA LOGIKA'
        $peserta = Peserta::where('regu_pembina_id', $regu_id)
            ->whereHas('mata_lomba', function ($query) {$query->where('nama', 'DUTA LOGIKA');})
        ->get();
        
        if ($peserta->isEmpty()) {
            return response()->json([
                'data' => [],
                'error' => 'Tidak ada peserta dengan mata lomba DUTA LOGIKA.',
            ], 404);
        }

        return response()->json(['data' => $peserta]);
    }

    public function getPesertaRegu4($regu_id)
    {
        // Mengambil peserta berdasarkan ID regu dan mata lomba 'LKFBB'
        $peserta = Peserta::where('regu_pembina_id', $regu_id)
            ->whereHas('mata_lomba', function ($query) {$query->where('nama', 'LKFBB');})
        ->get();
        
        if ($peserta->isEmpty()) {
            return response()->json([
                'data' => [],
                'error' => 'Tidak ada peserta dengan mata lomba LKFBB.',
            ], 404);
        }

        return response()->json(['data' => $peserta]);
    }
}
