<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CbtSession;
use App\Models\CbtSessionQuestionConfiguration;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PengaturanSoalCbtController extends Controller
{
    public function index() : View {
        $configurations = CbtSessionQuestionConfiguration::all(); 
        return view('admin.pengaturan-soal.index', compact('configurations'));
    }

    public function create() : View {
        $cbtSessions = CbtSession::all();
        return view('admin.pengaturan-soal.create', compact('cbtSessions'));
    }

    public function store(Request $request)
{
    // Validasi input
    $validatedData = $request->validate([
        'cbt_session_id' => 'required|exists:cbt_sessions,id',
        'question_type' => 'required',
        'question_count' => 'required|integer|min:1',
    ]);

    // Fetch the CBT session to validate its related MataLomba
    $cbtSession = CbtSession::findOrFail($validatedData['cbt_session_id']);
    $mataLomba = $cbtSession->mataLomba; // Assuming there is a relationship `mataLomba` in the CbtSession model

    // Validasi untuk soal jenis SEMAPHORE dan MORSE hanya untuk MataLomba SMS
    if (in_array($validatedData['question_type'], [\App\Enums\QuestionType::SEMAPHORE->value, \App\Enums\QuestionType::MORSE->value])) {
        if ($mataLomba->nama !== \App\Enums\MataLomba::SMS->value) {
            return back()->withErrors([
                'question_type' => 'Jenis soal SEMAPHORE dan MORSE hanya bisa digunakan untuk sesi CBT dengan mata lomba SMS.'
            ])->withInput();
        }
    }

    // Validasi untuk soal jenis PK hanya untuk MataLomba TPK
    if ($validatedData['question_type'] === \App\Enums\QuestionType::PK->value) {
        if ($mataLomba->nama !== \App\Enums\MataLomba::TPK->value) {
            return back()->withErrors([
                'question_type' => 'Jenis soal PK hanya bisa digunakan untuk sesi CBT dengan mata lomba TPK.'
            ])->withInput();
        }
    }

    // Hitung total soal yang sudah ada untuk sesi ini
    $existingQuestionCount = CbtSessionQuestionConfiguration::where('cbt_session_id', $validatedData['cbt_session_id'])
        ->sum('question_count');

    $newTotal = $existingQuestionCount + $validatedData['question_count'];

    // Periksa apakah total soal melebihi jumlah_soal pada sesi
    if ($newTotal > $cbtSession->jumlah_soal) {
        return back()->withErrors([
            'question_count' => 'Total jumlah soal melebihi jumlah soal yang diperbolehkan untuk sesi ini. Maksimal: ' . $cbtSession->jumlah_soal . ', saat ini: ' . $existingQuestionCount
        ])->withInput();
    }

    // Simpan data konfigurasi soal
    CbtSessionQuestionConfiguration::create($validatedData);

    return redirect()->route('cbt-session-question-configurations.index')->with('success', 'Konfigurasi soal berhasil ditambahkan!');
}

public function edit($id)
{
    // Ambil data konfigurasi berdasarkan ID
    $configuration = CbtSessionQuestionConfiguration::findOrFail($id);

    // Ambil daftar semua sesi CBT untuk dropdown
    $cbtSessions = CbtSession::all();

    return view('admin.pengaturan-soal.edit', compact('configuration', 'cbtSessions'));
}


public function update(Request $request, $id)
{
    // Validasi input
    $validatedData = $request->validate([
        'cbt_session_id' => 'required|exists:cbt_sessions,id',
        'question_type' => 'required',
        'question_count' => 'required|integer|min:1',
    ]);

    // Ambil data konfigurasi berdasarkan ID
    $configuration = CbtSessionQuestionConfiguration::findOrFail($id);

    // Ambil sesi CBT terkait untuk validasi tambahan
    $cbtSession = CbtSession::findOrFail($validatedData['cbt_session_id']);
    $mataLomba = $cbtSession->mataLomba; // Asumsi relasi `mataLomba` ada di model CbtSession

    // Validasi tambahan: jenis soal SEMAPHORE dan MORSE hanya untuk MataLomba SMS
    if (in_array($validatedData['question_type'], [\App\Enums\QuestionType::SEMAPHORE->value, \App\Enums\QuestionType::MORSE->value])) {
        if ($mataLomba->nama !== \App\Enums\MataLomba::SMS->value) {
            return back()->withErrors([
                'question_type' => 'Jenis soal SEMAPHORE dan MORSE hanya bisa digunakan untuk sesi CBT dengan mata lomba SMS.',
            ])->withInput();
        }
    }

    // Validasi tambahan: jenis soal PK hanya untuk MataLomba TPK
    if ($validatedData['question_type'] === \App\Enums\QuestionType::PK->value) {
        if ($mataLomba->nama !== \App\Enums\MataLomba::TPK->value) {
            return back()->withErrors([
                'question_type' => 'Jenis soal PK hanya bisa digunakan untuk sesi CBT dengan mata lomba TPK.',
            ])->withInput();
        }
    }

    // Validasi tambahan: jumlah soal tidak melebihi `jumlah_soal` pada sesi CBT
    $existingConfigurations = CbtSessionQuestionConfiguration::where('cbt_session_id', $cbtSession->id)
        ->where('id', '!=', $configuration->id) // Exclude the current configuration
        ->sum('question_count');
    
    $totalQuestions = $existingConfigurations + $validatedData['question_count'];
    if ($totalQuestions > $cbtSession->jumlah_soal) {
        return back()->withErrors([
            'question_count' => 'Total jumlah soal melebihi batas maksimal (' . $cbtSession->jumlah_soal . ') untuk sesi CBT ini.',
        ])->withInput();
    }

    // Update data konfigurasi soal
    $configuration->update($validatedData);

    return redirect()->route('cbt-session-question-configurations.index')->with('success', 'Konfigurasi soal berhasil diperbarui!');
}

public function destroy($id)
{
    // Cari konfigurasi berdasarkan ID
    $configuration = CbtSessionQuestionConfiguration::findOrFail($id);

    // Hapus data konfigurasi
    $configuration->delete();

    // Redirect ke halaman indeks dengan pesan sukses
    return redirect()->route('cbt-session-question-configurations.index')->with('success', 'Konfigurasi soal berhasil dihapus!');
}




}
