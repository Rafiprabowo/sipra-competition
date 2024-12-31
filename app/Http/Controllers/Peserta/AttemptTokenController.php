<?php

namespace App\Http\Controllers\Peserta;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CbtSession;
use App\Models\PesertaSession;
use Illuminate\Support\Facades\Auth;

class AttemptTokenController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $session_id)
     {
         // Validate the request
         $validatedData = $request->validate([
             'token' => 'required|string',
         ]);
     
         $session = CbtSession::findOrFail($session_id);
     
         // Check if the token is correct
         if ($request->input('token') !== $session->kode_akses) {
             return redirect()->back()->with('error', 'Token salah. Coba lagi.');
         }
     
         // Get the authenticated participant
         $peserta = Auth::user()->peserta;
     
         // Check if the participant is already registered for this session
         $exists = PesertaSession::where('peserta_id', $peserta->id)
                     ->where('cbt_session_id', $session->id)
                     ->exists();
     
         if ($exists) {
            return redirect()->route('start.cbt', ['session_id' => $session->id, 'question_number' => 1]);
         }
     
         // Debugging: Check registration data
        //  dd([
        //      'peserta_id' => $peserta->id,
        //      'cbt_session_id' => $session->id,
        //      'nilai' => 0, // Default value for 'nilai'
        //      'status' => 'in_progress',
        //  ]);
     
         // Register the participant for the session
         PesertaSession::create([
             'peserta_id' => $peserta->id,
             'cbt_session_id' => $session->id,
             'nilai' => 0, // Default value for 'nilai'
             'status' => 'in_progress',
         ]);
     
         return redirect()->route('start.cbt', ['session_id' => $session->id, 'question_number' => 1]);
     }
}
