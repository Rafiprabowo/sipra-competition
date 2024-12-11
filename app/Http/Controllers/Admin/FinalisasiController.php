<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Finalisasi;
use Illuminate\Http\Request;


class FinalisasiController extends Controller
{
    public function approve($id)
    {
        $finalisasi = Finalisasi::findOrFail($id);
        $finalisasi->status = 1;

            $finalisasi->keterangan = "Finalisasi disetujui";

        $finalisasi->save();

        return redirect()->route('admin.dashboard')->with('success', 'Status finalisasi berhasil disetujui.');
    }

    public function reject($id)
    {
        $finalisasi = Finalisasi::findOrFail($id);
        $finalisasi->status = 0;
            $finalisasi->keterangan = "Finalisasi ditolak";

        $finalisasi->save();

        return redirect()->route('admin.dashboard')->with('success', 'Status finalisasi berhasil ditolak.');
    }
}

