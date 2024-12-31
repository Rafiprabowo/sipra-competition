<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\CbtSession;
use App\Models\PesertaSession;
use App\Models\TpkAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewCbtController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $session_id)
    {
        $session = CbtSession::findOrFail($session_id);
        $peserta = Auth::user()->peserta;

        // Get all answers for the participant in this session
        $answers = TpkAnswer::where('peserta_id', $peserta->id)
                            ->where('cbt_session_id', $session_id)
                            ->get();

        // Get the score from PesertaSession
        $score = PesertaSession::where('peserta_id', $peserta->id)
                              ->where('cbt_session_id', $session_id)
                              ->value('score');

        return view('peserta.sesi-cbt.review', compact('session', 'answers', 'score'));
    }
}
