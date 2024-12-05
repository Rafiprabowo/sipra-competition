<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $credentials = $request->only('username', 'password');
        Auth::attempt($credentials);
        if(Auth::attempt($credentials)) {
            $user = Auth::user();
            switch ($user->role){
                case 'admin':
                    return redirect()->route('admin.dashboard');
                    case 'pembina':
                        return redirect()->route('pembina.dashboard');
                case 'peserta':
                    return redirect()->route('peserta.dashboard');
                case 'juri' :
                    return redirect()->route('juri.dashboard');
                    default:
                        return redirect()->route('/404');
            }
        }
        // Jika autentikasi gagal
        return redirect()->back()->withErrors([
            'login' => 'Username atau password salah.',
        ])->withInput($request->only('username'));
    }
}
