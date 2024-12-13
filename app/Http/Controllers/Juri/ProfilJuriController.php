<?php

namespace App\Http\Controllers\Juri;

use App\Http\Controllers\Controller;
use App\Models\Juri;
use App\Models\MataLomba;
use Illuminate\Http\Request;

class ProfilJuriController extends Controller
{
    public function createOrUpdate(Request $request) { 
        $juri = Juri::firstOrNew(['user_id' => auth()->id()]); 
        $mataLombas = MataLomba::all(); 
        if ($request->isMethod('post')) { 
            $juri->fill($request->all()); 
            $juri->save(); 
        } 
        return view('juri.profil_juri', compact('juri', 'mataLombas'));
    }
}
