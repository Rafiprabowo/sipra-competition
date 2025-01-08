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
        // Validasi data input
        $validatedData = $request->validate([
            'mata_lomba_id' => 'required|exists:mata_lombas,id',
            'nama' => 'required',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required|after:waktu_mulai',
            'jumlah_soal' => 'required|integer|min:1',
            'status' => 'required|in:draft,active,completed',
            'kode_akses' => 'nullable|string|unique:cbt_sessions,kode_akses',
        ]);

        // Hitung durasi otomatis (dalam menit) dari waktu mulai dan selesai
        $waktuMulai = strtotime($request->input('waktu_mulai'));
        $waktuSelesai = strtotime($request->input('waktu_selesai'));
        $durasi = ($waktuSelesai - $waktuMulai) / 60; // Konversi ke menit

        // Simpan data ke dalam database
        $cbtSession = CbtSession::create([
            'mata_lomba_id' => $validatedData['mata_lomba_id'],
            'nama' => $validatedData['nama'],
            'waktu_mulai' => $validatedData['waktu_mulai'],
            'waktu_selesai' => $validatedData['waktu_selesai'],
            'durasi' => $durasi,
            'jumlah_soal' => $validatedData['jumlah_soal'],
            'status' => $validatedData['status'],
            'kode_akses' => $validatedData['kode_akses'],
        ]);

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('sesi-cbt.index')
            ->with('success', 'Sesi CBT berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $mataLombas = MataLomba::all();  // Mendapatkan daftar lomba
        $session = CbtSession::findOrFail($id);  // Mengambil data sesi berdasarkan id
        return view('admin.sesi-cbt.edit', compact('session', 'mataLombas'));
    }

    // Memperbarui data sesi CBT
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'mata_lomba_id' => 'required|exists:mata_lombas,id',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required|after:waktu_mulai',
            'jumlah_soal' => 'required|integer|min:1',
            'status' => 'required|in:draft,active,completed',
            'kode_akses' => 'nullable|string|unique:cbt_sessions,kode_akses,' . $id,
        ]);

        $waktuMulai = strtotime($request->input('waktu_mulai'));
        $waktuSelesai = strtotime($request->input('waktu_selesai'));
        $durasi = ($waktuSelesai - $waktuMulai) / 60;

        $session = CbtSession::findOrFail($id);
        $session->update([
            'nama' => $validatedData['nama'],
            'mata_lomba_id' => $validatedData['mata_lomba_id'],
            'waktu_mulai' => $validatedData['waktu_mulai'],
            'waktu_selesai' => $validatedData['waktu_selesai'],
            'durasi' => $durasi,
            'jumlah_soal' => $validatedData['jumlah_soal'],
            'status' => $validatedData['status'],
            'kode_akses' => $validatedData['kode_akses'],
        ]);

        return redirect()->route('sesi-cbt.index')->with('success', 'Sesi CBT berhasil diperbarui.');
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

