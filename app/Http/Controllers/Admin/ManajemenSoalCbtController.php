<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CbtSession;
use App\Models\MataLomba;
use Illuminate\Http\Request;

class ManajemenSoalCbtController extends Controller
{
    public function index(Request $request, $id){
        $namaMataLomba =  $request->query('nama');
        $session = CbtSession::findOrFail($id);

        if($namaMataLomba == \App\Enums\MataLomba::TPK->value){
            return view('admin.soal-tpk.index', compact('session'));
        }else if($namaMataLomba == \App\Enums\MataLomba::SandiMorse->value){    
            
        }else if($namaMataLomba == \App\Enums\MataLomba::Semaphore->value){

        }else{
            return redirect()->route('sesi-cbt.index')->with('error', 'Mata lomba atau Sesi tidak ditemukan!');
        }
    }
    public function create(Request $request, $id){
        $namaMataLomba = $request->query('nama');
        $session = CbtSession::findOrFail($id);

        if($namaMataLomba == \App\Enums\MataLomba::TPK->value){
            return view('admin.soal-tpk.create', compact('session'));
        }else if($namaMataLomba == \App\Enums\MataLomba::SandiMorse->value){

        }else if($namaMataLomba == \App\Enums\MataLomba::Semaphore->value){

        }else{
            return redirect()->route('sesi-soal.index')->with('error', 'Mata lomba atau Sesi tidak ditemukan!');
        }
    }
}
