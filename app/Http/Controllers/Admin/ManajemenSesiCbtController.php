<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CbtSession;
use App\Models\MataLomba;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;


class ManajemenSesiCbtController extends Controller
{
    public function index(){
        $sessions = CbtSession::with('mataLomba')->get();
        return view('admin.sesi-cbt.index', compact('sessions'));
    }
    public function create(){
        $mataLombas = MataLomba::where('kategori', 'cbt')->get();
        return view('admin.sesi-cbt.create', compact('mataLombas'));
    }
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'mata_lomba_id' => 'required|exists:mata_lombas,id',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required|after:waktu_mulai',
            'jumlah_soal' => 'required|integer',
            'status' => 'required|in:draft,active,completed',
            'kode_akses' => 'nullable|string|unique:cbt_sessions,kode_akses',
        ], [
            'waktu_selesai.after' => 'Waktu selesai harus sesudah waktu mulai.'
        ]);

        // Fetch related MataLomba
        $mataLomba = MataLomba::findOrFail($validatedData['mata_lomba_id']);
        $namaLomba = $mataLomba->nama;

        // Count existing sessions
        $sessionCount = CbtSession::where('mata_lomba_id', $validatedData['mata_lomba_id'])->count();

        // Generate nama from MataLomba name and session count
        $validatedData['nama'] = $namaLomba . ' - Sesi ' . ($sessionCount + 1);

        // Calculate duration in minutes
        $startTime = Carbon::parse(trim($validatedData['waktu_mulai']));
        $endTime = Carbon::parse( trim($validatedData['waktu_selesai']));
        $validatedData['durasi'] = $startTime->diffInMinutes($endTime);

        // Generate a unique access code
        $validatedData['kode_akses'] = $validatedData['kode_akses'] ?? strtoupper(Str::random(6));

        CbtSession::create($validatedData);

        return redirect()->route('sesi-cbt.index')->with('success', 'Sesi berhasil ditambahkan!');
    }

    public function edit($id){
        $session = CbtSession::with('mataLomba')->find($id);
        if(!$session){
            return redirect()->route('sesi-cbt.index')->with('error', 'Sesi tidak ditemukan!');
        }
        $mataLombas = MataLomba::where('kategori', 'cbt')->get();
        return view('admin.sesi-cbt.edit', compact('session', 'mataLombas'));
    }   

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'mata_lomba_id' => 'required|exists:mata_lombas,id',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required|after:waktu_mulai',
            'jumlah_soal' => 'required|integer',
            'status' => 'required|in:draft,active,completed',
            'kode_akses' => 'nullable|string|unique:cbt_sessions,kode_akses,' . $id, // Adjusting unique rule for update
        ], [
            'waktu_selesai.after' => 'Waktu selesai harus sesudah waktu mulai.'
        ]);
    
        // Fetch the session to update
        $session = CbtSession::findOrFail($id);
    
        // Fetch related MataLomba
        $mataLomba = MataLomba::findOrFail($validatedData['mata_lomba_id']);
        $namaLomba = $mataLomba->nama;
    
        // Count existing sessions (excluding the current session)
        $sessionCount = CbtSession::where('mata_lomba_id', $validatedData['mata_lomba_id'])
                                    ->where('id', '!=', $id)
                                    ->count();
    
        // Update session name
        $validatedData['nama'] = $namaLomba . ' - Sesi ' . ($sessionCount + 1);
 
        $waktuMulai = Carbon::parse(trim($validatedData['waktu_mulai']));
        $waktuSelesai = Carbon::parse(trim($validatedData['waktu_selesai']));

    
        // Calculate duration in minutes
        $validatedData['durasi'] = $waktuMulai->diffInMinutes($waktuSelesai);
    
        // Generate a unique access code if it's not provided
        $validatedData['kode_akses'] = $validatedData['kode_akses'] ?? strtoupper(Str::random(6));
    
        // Update the session
        $session->update($validatedData);
    
        return redirect()->route('sesi-cbt.index')->with('success', 'Sesi berhasil diperbarui!');
    }
    


    public function destroy($id){
        $session = CbtSession::find($id);
        if (!$session) {
            return redirect()->route('sesi-cbt.index')->with('error', 'Sesi tidak ditemukan.');
        }
        $session->delete();
        return redirect()->route('sesi-cbt.index')->with('success', 'Sesi berhasil dihapus!');
    }
    
    

    
}

