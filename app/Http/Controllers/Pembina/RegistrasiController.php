<?php

namespace App\Http\Controllers\Pembina;

use App\Http\Controllers\Admin\MataLomba;
use App\Http\Controllers\Controller;
use App\Models\Pembina;
use App\Models\Peserta;
use App\Models\ReguPembina;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegistrasiController extends Controller
{
    public function registrasi(Request $request)
    {
        $pembina = auth()->user()->pembina;
        $mataLombas = \App\Models\MataLomba::all();

        if ($pembina) {
            $regus = $pembina->regu ?? collect(); // Pastikan $regus adalah koleksi yang valid
            $pesertas = Peserta::whereIn('regu_pembina_id', $regus->pluck('id'))->get();
            $reguToEdit = null;
            $pesertaToEdit = null;

            if ($request->has('edit_regu_id')) {
                $reguToEdit = ReguPembina::findOrFail($request->get('edit_regu_id'));
            }

            if ($request->has('edit_peserta_id')) {
                $pesertaToEdit = Peserta::findOrFail($request->get('edit_peserta_id'));
            }

            return view('pembina.registrasi', compact('pembina', 'regus', 'reguToEdit', 'pesertaToEdit', 'pesertas', 'mataLombas'));
        }

        return view('pembina.registrasi', compact('pembina'))->with('regus', collect()); // Tambahkan 'regus' sebagai koleksi kosong
    }

    public function storePembina(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'no_hp' => 'required',
            'kwartir_cabang' => 'required',
            'pangkalan' => 'required',
            'nama_gudep' => 'required',
            'pengalaman_pembina' => 'nullable',
            'pekerjaan' => 'nullable',
        ]);

        //set id user to pembina
        $validatedData['user_id'] = auth()->user()->id;

        Pembina::create($validatedData);

        return redirect()->back()->with('success', 'Pembina berhasil disimpan! ');

    }

    public function updatePembina(Request $request)
    {
        $validatedData = $request->validate([
            'pembina_id' => 'required|exists:pembinas,id',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'no_hp' => 'required',
            'kwartir_cabang' => 'required',
            'pangkalan' => 'required',
            'nama_gudep' => 'required',
            'pengalaman_pembina' => 'nullable',
            'pekerjaan' => 'nullable',
        ]);

        $pembina = Pembina::findOrFail($validatedData['pembina_id']);
        if ($pembina) {
            unset($validatedData['pembina_id']);
            $pembina->update($validatedData);
            return redirect()->back()->with('success', 'Pembina berhasil diupdate! ');
        }
        return redirect()->back()->with('error', 'Pembina gagal diupdate! ');
    }

    public function storeRegu(Request $request)
    {
        $validatedData = $request->validate([
            'nama_regu' => 'required|string|max:255',
            'kategori' => 'required|in:PA,PI',
            'pembina_id' => 'required|exists:pembinas,id',
        ]);

        $pembina = auth()->user()->pembina;

        if ($pembina) {
            $regus = $pembina->regu;

            if ($regus->count() >= 2) {
                return redirect()->route('pembina.registrasi')->with('error', 'Anda sudah memiliki 2 regu. Tidak bisa menambah lebih banyak.');
            }

            $existingCategories = $regus->pluck('kategori')->toArray();

            if (in_array($validatedData['kategori'], $existingCategories)) {
                return redirect()->back()->with('error', 'Kategori regu sudah ada. Anda harus memilih kategori yang berbeda.');
            }

            $regu = ReguPembina::create($validatedData);
            return redirect()->back()->with('success', 'Regu berhasil disimpan.');
        }

        return redirect()->back()->with('error', 'Anda belum terdaftar sebagai pembina.');
    }

    public function updateRegu(Request $request, ReguPembina $regu)
    {
        $validatedData = $request->validate([
            'nama_regu' => 'required|string|max:255',
            'kategori' => 'required|in:PA,PI',
        ]);

        // Periksa apakah kategori yang sama sudah ada, kecuali regu ini sendiri
        $existingRegu = ReguPembina::where('pembina_id', $regu->pembina_id)
            ->where('kategori', $validatedData['kategori'])
            ->where('id', '!=', $regu->id)
            ->first();

        if ($existingRegu) {
            return redirect()->back()->with('error', 'Kategori yang sama sudah ada untuk regu lain.');
        }

        $regu->update($validatedData);
        return redirect()->back()->with('success', 'Regu berhasil diupdate.');
    }

    public function destroyRegu(ReguPembina $regu)
    {
        $regu->delete();
        return redirect()->back()->with('success', 'Regu berhasil dihapus.');
    }


    public function storePeserta(Request $request)
    {
        $validatedData = $request->validate([
            'nisn' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'mata_lomba_id' => 'required|exists:mata_lombas,id',
            'regu_pembina_id' => 'required|exists:regu_pembinas,id',
        ]);

        $regu = ReguPembina::findOrFail($validatedData['regu_pembina_id']);
        $regu->load('peserta'); // Memastikan relasi pesertas dimuat

        if ($regu->peserta->count() >= 8) {
            return redirect()->route('registrasi.form')->with('error', 'Masing-masing regu hanya bisa memiliki maksimal 8 peserta.');
        }

        Peserta::create($validatedData);

        return redirect()->route('registrasi.form')->with('success', 'Peserta berhasil ditambahkan.');
    }

    public function destroyPeserta(Peserta $peserta)
    {
        $peserta->delete();
        return redirect()->route('registrasi.form')->with('success', 'Peserta berhasil dihapus.');
    }


    public function updatePeserta(Request $request, Peserta $peserta)
    {
        $validatedData = $request->validate([
            'nisn' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'mata_lomba_id' => 'required|exists:mata_lomba,id',
        ]);

        $peserta->update($validatedData);

        return redirect()->route('pembina.registrasi')->with('success', 'Peserta berhasil diupdate.');
    }

}
