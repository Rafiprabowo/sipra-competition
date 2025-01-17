<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StartSimulasiController extends Controller
{
    public function start(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:simulasi_sms_answers,nama',
        ]);

        // Here you can handle the start logic, maybe redirect to the first question or save the name for later use
        return redirect()->route('simulasi.index', ['nama' =>$request->nama ,'nomor_soal' => 1]);
    }
}

