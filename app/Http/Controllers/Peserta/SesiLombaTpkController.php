<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\CbtSession;
use App\Models\MataLomba;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SesiLombaTpkController extends Controller
{
    public function index()
{
    $peserta = Auth::user()->peserta;

    // Retrieve the MataLomba with the name "TPK"
    $mataLombaTPK = MataLomba::where('nama', \App\Enums\MataLomba::TPK->value)->first();

    // Check if the participant has the correct mata_lomba_id
    if ($peserta->mata_lomba_id !== $mataLombaTPK->id) {
        return abort(403, 'Unauthorized');
    }


    $sessions = CbtSession::where('mata_lomba_id', $mataLombaTPK->id)
        ->where('status', 'active')
        ->get();

    return view('peserta.sesi-cbt.tpk.index', compact('sessions'));
}
}
