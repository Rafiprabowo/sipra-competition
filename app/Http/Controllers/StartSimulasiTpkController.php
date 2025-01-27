<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StartSimulasiTpkController extends Controller
{
    public function start(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:simulasi_tpk_answers,nama',
        ]);

        // Here you can handle the start logic, maybe redirect to the first question or save the name for later use
        return redirect()->route('simulasi_tpk.index', ['nama' =>$request->nama ,'nomor_soal' => 1]);
    }
}
