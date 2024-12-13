<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BobotSoal;
use App\Models\MataLomba;

class BobotSoalController extends Controller
{
    public function index() {
        $bobot_soal = BobotSoal::with('mata_lomba')->get();
        return view('admin.bobot_soal.index', compact('bobot_soal'));
    }

    public function create() {
        $mata_lomba = MataLomba::all();
        return view('admin.bobot_soal.create', compact('mata_lomba'));
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'kriteria_nilai' => 'required',
            'bobot_soal' => 'required',
            'mata_lomba_id' => 'required',
        ]);

        BobotSoal::create($validatedData);
        return redirect()->route('admin.bobot-soal.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id) {
        $bobotSoal = BobotSoal::findOrFail($id);
        $mata_lomba = MataLomba::all();
        return view('admin.bobot_soal.edit', compact('bobotSoal', 'mata_lomba'));
    }

    public function update(Request $request, $id) {
        $validatedData = $request->validate([
            'kriteria_nilai' => 'required',
            'bobot_soal' => 'required',
            'mata_lomba_id' => 'required',
        ]);

        $bobot_soal = BobotSoal::findOrFail($id);
        $bobot_soal->update($validatedData);
        return redirect()->route('admin.bobot-soal.index')->with('success', 'Data berhasil diubah!');
    }

    public function destroy($id) {
        BobotSoal::destroy($id);
        return redirect()->route('admin.bobot-soal.index')->with('success', 'Data berhasil dihapus!');
    }
}
