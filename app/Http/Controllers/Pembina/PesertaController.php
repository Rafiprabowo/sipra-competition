<?php

namespace App\Http\Controllers\Pembina;

use App\Http\Controllers\Controller;
use App\Imports\PesertaImport;
use App\Models\MataLomba;
use App\Models\Peserta;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class PesertaController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        try {
            // Proses impor data
            Excel::import(new PesertaImport, $request->file('file'));

            return back()->with('success', 'Berhasil Import Data Peserta');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    public function index()
    {
        $peserta = Peserta::with('mata_lomba')->get();
        return view('pembina.peserta.index', compact('peserta'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mataLombas = MataLomba::all();
        return view('pembina.peserta.create', compact('mataLombas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input data
        $validatedData = $request->validate([
            'nisn' => 'required|unique:pesertas',  // Validasi NISN harus unik
            'nama' => 'required',
            'pangkalan' => 'required',
            'regu' => 'required',
            'jenis_kelamin' => 'required',
            'mata_lomba_id' => 'required|exists:mata_lombas,id',  // Pastikan ID Mata Lomba valid
        ]);

        // Buat user untuk peserta menggunakan nisn sebagai username dan password yang di-hash
        $user = User::create([
            'username' => $validatedData['nisn'],
            'password' => Hash::make($validatedData['nisn']),  // Menggunakan NISN sebagai password sementara
        ]);

        // Buat data peserta dan hubungkan dengan user_id
        $peserta = new Peserta();
        $peserta->nisn = $validatedData['nisn'];
        $peserta->nama = $validatedData['nama'];
        $peserta->pangkalan = $validatedData['pangkalan'];
        $peserta->regu = $validatedData['regu'];
        $peserta->jenis_kelamin = $validatedData['jenis_kelamin'];
        $peserta->mata_lomba_id = $validatedData['mata_lomba_id'];
        $peserta->user_id = $user->id;  // Menyimpan user_id yang berelasi dengan pengguna
        $peserta->save();  // Simpan data peserta

        // Redirect dengan pesan sukses
        return redirect()->route('data-peserta.index')->with('success', 'Data berhasil ditambahkan!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $peserta = Peserta::with('mata_lomba')->findOrFail($id);
        $mataLombas = MataLomba::all();
        return view('pembina.peserta.edit', compact('peserta', 'mataLombas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nisn' => 'required|string|max:255|unique:pesertas,nisn,' . $id, // Pastikan NISN unik, kecuali untuk peserta yang sedang diupdate
            'nama' => 'required|string|max:255',
            'pangkalan' => 'required|string|max:255',
            'regu' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string|in:laki-laki,perempuan',
            'mata_lomba_id' => 'required|exists:mata_lombas,id',
        ]);

        // Mencari data peserta berdasarkan ID
        $peserta = Peserta::findOrFail($id);

        // Update data peserta
        $peserta->nisn = $validatedData['nisn'];
        $peserta->nama = $validatedData['nama'];
        $peserta->pangkalan = $validatedData['pangkalan'];
        $peserta->regu = $validatedData['regu'];
        $peserta->jenis_kelamin = $validatedData['jenis_kelamin'];
        $peserta->mata_lomba_id = $validatedData['mata_lomba_id'];

        // Simpan perubahan
        $peserta->save();

        // Notifikasi berhasil
        return redirect()->route('data-peserta.index')->with('success', 'Peserta berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Peserta::destroy($id);
        return redirect()->route('data-peserta.index')->with('success', 'Peserta berhasil dihapus.');
    }
}
