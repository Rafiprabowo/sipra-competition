<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\CbtSession;
use App\Models\MataLomba;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SesiLombaSmsController extends Controller
{
    /**
     * Handle the incoming request.
     */

     public function __invoke()
     {
         $peserta = Auth::user()->peserta;
     
         // Retrieve the MataLomba with the name "TPK"
         $mataLombaTPK = MataLomba::where('nama', \App\Enums\MataLomba::SMS->value)->first();
     
         // Check if the participant has the correct mata_lomba_id
         if ($peserta->mata_lomba_id !== $mataLombaTPK->id) {
             return abort(403, 'Unauthorized');
         }
     
         $sessions = CbtSession::where('mata_lomba_id', $mataLombaTPK->id)
             ->where('status', 'active')
             ->with('questionConfigurations')  // Eager load the question configurations
             ->get();
     
         return view('peserta.sesi-cbt.sms.index', compact('sessions'));
     }
     
}
