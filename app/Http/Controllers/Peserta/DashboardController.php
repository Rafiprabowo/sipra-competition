<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\Finalisasi;
use http\Client;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request){
        $tab = $request->query('tab');
        if($tab === 'listverifikasi'){
            $finalisasis = Finalisasi::with('pembina')->get();
            return view('peserta.dashboard', compact('finalisasis'));
        }
        return view('peserta.dashboard');
    }
}
