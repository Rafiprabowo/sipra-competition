<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CbtSession;
use App\Models\Peserta;
use App\Models\PesertaSession;
use Illuminate\Http\Request;

class ParticipantsSessionController extends Controller
{
    public function index($id)
    {
        $session = CbtSession::find($id);
        $participants = PesertaSession::with('peserta.regu_pembina.pembina')
                                        ->where('cbt_session_id', $id)
                                        ->get();
    
        return view('admin.sesi-peserta.index', compact('session', 'participants'));
    }
    

    public function create($id){
        $session = CbtSession::find($id);
        $pesertas= Peserta::where('mata_lomba_id', $session->mataLomba->id)->get();
        return view('admin.sesi-peserta.create', compact('session', 'pesertas'));
    }
    
}
