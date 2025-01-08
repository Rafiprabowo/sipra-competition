<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CbtSession;
use App\Models\CbtSessionQuestionConfiguration;
use App\Models\SmsQuestion;
use App\Models\TpkQuestion;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        'easy_question_count' => 'required|integer|min:0',
        'hard_question_count' => 'required|integer|min:0',
    ]);

    // Ambil sesi CBT
    $cbtSession = CbtSession::findOrFail($validatedData['cbt_session_id']);

    // Validasi apakah jenis soal sesuai dengan mata lomba
    $mataLomba = $cbtSession->mataLomba;

    if (in_array($validatedData['question_type'], [\App\Enums\QuestionType::SEMAPHORE->value, \App\Enums\QuestionType::MORSE->value])) {
        if ($mataLomba->nama !== \App\Enums\MataLomba::SMS->value) {
            return back()->withErrors([
                'question_type' => 'Jenis soal SEMAPHORE dan MORSE hanya bisa digunakan untuk sesi CBT dengan mata lomba SMS.'
            ])->withInput();
        }
    } elseif ($validatedData['question_type'] === \App\Enums\QuestionType::PK->value) {
        if ($mataLomba->nama !== \App\Enums\MataLomba::TPK->value) {
            return back()->withErrors([
                'question_type' => 'Jenis soal PK hanya bisa digunakan untuk sesi CBT dengan mata lomba TPK.'
            ])->withInput();
        }
    } else {
        return back()->withErrors([
            'question_type' => 'Jenis soal tidak valid atau tidak didukung.'
        ])->withInput();
    }

    // Validasi ketersediaan soal
    if (in_array($validatedData['question_type'], [\App\Enums\QuestionType::SEMAPHORE->value, \App\Enums\QuestionType::MORSE->value])) {
        $easyAvailable = SmsQuestion::where('type', $validatedData['question_type'])
            ->where('difficulty', 'mudah')
            ->count();

        $hardAvailable = SmsQuestion::where('type', $validatedData['question_type'])
            ->where('difficulty', 'sulit')
            ->count();
    } elseif ($validatedData['question_type'] === \App\Enums\QuestionType::PK->value) {
        $easyAvailable = TpkQuestion::where('difficulty', \App\Enums\Difficulty::LOTS->value)
            ->count();

        $hardAvailable = TpkQuestion::where('difficulty', \App\Enums\Difficulty::MOTS->value)
            ->count();
    }

    if ($validatedData['easy_question_count'] > $easyAvailable) {
        return back()->withErrors([
            'easy_question_count' => 'Jumlah soal mudah yang tersedia tidak mencukupi. Tersedia: ' . $easyAvailable
        ])->withInput();
    }

    if ($validatedData['hard_question_count'] > $hardAvailable) {
        return back()->withErrors([
            'hard_question_count' => 'Jumlah soal sulit yang tersedia tidak mencukupi. Tersedia: ' . $hardAvailable
        ])->withInput();
    }

    // Hitung total soal untuk sesi
    $existingTotalQuestions = CbtSessionQuestionConfiguration::where('cbt_session_id', $validatedData['cbt_session_id'])
        ->sum(DB::raw('easy_question_count + hard_question_count'));

    $newTotalQuestions = $existingTotalQuestions + $validatedData['easy_question_count'] + $validatedData['hard_question_count'];

    // Validasi agar total soal tidak melebihi jumlah soal yang diizinkan
    if ($newTotalQuestions > $cbtSession->jumlah_soal) {
        return back()->withErrors([
            'question_count' => 'Total jumlah soal melebihi jumlah soal yang diperbolehkan untuk sesi ini. Maksimal: ' . $cbtSession->jumlah_soal . ', saat ini: ' . $existingTotalQuestions
        ])->withInput();
    }

    // Simpan konfigurasi soal
    DB::beginTransaction();

    try {
        // Simpan konfigurasi soal terlebih dahulu
        $configuration = CbtSessionQuestionConfiguration::updateOrCreate(
            ['cbt_session_id' => $validatedData['cbt_session_id'], 'question_type' => $validatedData['question_type']],
            [
                'easy_question_count' => $validatedData['easy_question_count'],
                'hard_question_count' => $validatedData['hard_question_count'],
            ]
        );

        // Ambil soal berdasarkan tipe soal yang dipilih
        if ($validatedData['question_type'] === \App\Enums\QuestionType::SEMAPHORE->value || $validatedData['question_type'] === \App\Enums\QuestionType::MORSE->value) {
            // Ambil soal dari tabel SMS
            $easyQuestions = SmsQuestion::where('type', $validatedData['question_type'])
                ->where('difficulty', 'mudah')
                ->inRandomOrder()  // Mengacak soal
                ->take($validatedData['easy_question_count'])
                ->get();

            $hardQuestions = SmsQuestion::where('type', $validatedData['question_type'])
                ->where('difficulty', 'sulit')
                ->inRandomOrder()  // Mengacak soal
                ->take($validatedData['hard_question_count'])
                ->get();

            // Attach soal ke sesi CBT
            $cbtSession->smsQuestions()->saveMany($easyQuestions);
            $cbtSession->smsQuestions()->saveMany($hardQuestions);
        } elseif ($validatedData['question_type'] === \App\Enums\QuestionType::PK->value) {
            // Ambil soal dari tabel TPK
            $easyQuestions = TpkQuestion::where('difficulty', \App\Enums\Difficulty::LOTS->value)
                ->inRandomOrder()  // Mengacak soal
                ->take($validatedData['easy_question_count'])
                ->get();

            $hardQuestions = TpkQuestion::where('difficulty', \App\Enums\Difficulty::MOTS->value)
                ->inRandomOrder()  // Mengacak soal
                ->take($validatedData['hard_question_count'])
                ->get();

            // Attach soal ke sesi CBT
            $cbtSession->tpk_questions()->saveMany($easyQuestions);
            $cbtSession->tpk_questions()->saveMany($hardQuestions);
        }

        DB::commit();

        return redirect()->route('cbt-session-question-configurations.index')->with('success', 'Konfigurasi soal dan soal berhasil ditambahkan!');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan konfigurasi soal.'])->withInput();
    }
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
        'easy_question_count' => 'required|integer|min:0',
        'hard_question_count' => 'required|integer|min:0',
    ]);

    // Ambil konfigurasi soal yang akan diupdate
    $configuration = CbtSessionQuestionConfiguration::findOrFail($id);

    // Ambil sesi CBT
    $cbtSession = CbtSession::findOrFail($validatedData['cbt_session_id']);

    // Validasi apakah jenis soal sesuai dengan mata lomba
    $mataLomba = $cbtSession->mataLomba;

    if (in_array($validatedData['question_type'], [\App\Enums\QuestionType::SEMAPHORE->value, \App\Enums\QuestionType::MORSE->value])) {
        if ($mataLomba->nama !== \App\Enums\MataLomba::SMS->value) {
            return back()->withErrors([
                'question_type' => 'Jenis soal SEMAPHORE dan MORSE hanya bisa digunakan untuk sesi CBT dengan mata lomba SMS.'
            ])->withInput();
        }
    } elseif ($validatedData['question_type'] === \App\Enums\QuestionType::PK->value) {
        if ($mataLomba->nama !== \App\Enums\MataLomba::TPK->value) {
            return back()->withErrors([
                'question_type' => 'Jenis soal PK hanya bisa digunakan untuk sesi CBT dengan mata lomba TPK.'
            ])->withInput();
        }
    } else {
        return back()->withErrors([
            'question_type' => 'Jenis soal tidak valid atau tidak didukung.'
        ])->withInput();
    }

    // Validasi ketersediaan soal
    if (in_array($validatedData['question_type'], [\App\Enums\QuestionType::SEMAPHORE->value, \App\Enums\QuestionType::MORSE->value])) {
        $easyAvailable = SmsQuestion::where('type', $validatedData['question_type'])
            ->where('difficulty', 'mudah')
            ->count();

        $hardAvailable = SmsQuestion::where('type', $validatedData['question_type'])
            ->where('difficulty', 'sulit')
            ->count();
    } elseif ($validatedData['question_type'] === \App\Enums\QuestionType::PK->value) {
        $easyAvailable = TpkQuestion::where('difficulty', \App\Enums\Difficulty::LOTS->value)
            ->count();

        $hardAvailable = TpkQuestion::where('difficulty', \App\Enums\Difficulty::MOTS->value)
            ->count();
    }

    if ($validatedData['easy_question_count'] > $easyAvailable) {
        return back()->withErrors([
            'easy_question_count' => 'Jumlah soal mudah yang tersedia tidak mencukupi. Tersedia: ' . $easyAvailable
        ])->withInput();
    }

    if ($validatedData['hard_question_count'] > $hardAvailable) {
        return back()->withErrors([
            'hard_question_count' => 'Jumlah soal sulit yang tersedia tidak mencukupi. Tersedia: ' . $hardAvailable
        ])->withInput();
    }

    // Hitung total soal untuk sesi
    $existingTotalQuestions = CbtSessionQuestionConfiguration::where('cbt_session_id', $validatedData['cbt_session_id'])
        ->where('id', '!=', $id) // Exclude the current record
        ->sum(DB::raw('easy_question_count + hard_question_count'));

    $newTotalQuestions = $existingTotalQuestions + $validatedData['easy_question_count'] + $validatedData['hard_question_count'];

    // Validasi agar total soal tidak melebihi jumlah soal yang diizinkan
    if ($newTotalQuestions > $cbtSession->jumlah_soal) {
        return back()->withErrors([
            'question_count' => 'Total jumlah soal melebihi jumlah soal yang diperbolehkan untuk sesi ini. Maksimal: ' . $cbtSession->jumlah_soal . ', saat ini: ' . $existingTotalQuestions
        ])->withInput();
    }

    // Update konfigurasi soal
    DB::beginTransaction();

    try {
        // Update konfigurasi soal
        $configuration->update([
            'cbt_session_id' => $validatedData['cbt_session_id'],
            'question_type' => $validatedData['question_type'],
            'easy_question_count' => $validatedData['easy_question_count'],
            'hard_question_count' => $validatedData['hard_question_count'],
        ]);

        // Hapus soal yang sudah ada
        if ($validatedData['question_type'] === \App\Enums\QuestionType::SEMAPHORE->value || $validatedData['question_type'] === \App\Enums\QuestionType::MORSE->value) {
            $cbtSession->smsQuestions()->detach();
        } elseif ($validatedData['question_type'] === \App\Enums\QuestionType::PK->value) {
            $cbtSession->tpk_questions()->detach();
        }

        // Ambil soal berdasarkan tipe soal yang dipilih secara acak
        if ($validatedData['question_type'] === \App\Enums\QuestionType::SEMAPHORE->value || $validatedData['question_type'] === \App\Enums\QuestionType::MORSE->value) {
            // Ambil soal dari tabel SMS secara acak
            $easyQuestions = SmsQuestion::where('type', $validatedData['question_type'])
                ->where('difficulty', 'mudah')
                ->inRandomOrder()
                ->take($validatedData['easy_question_count'])
                ->get();

            $hardQuestions = SmsQuestion::where('type', $validatedData['question_type'])
                ->where('difficulty', 'sulit')
                ->inRandomOrder()
                ->take($validatedData['hard_question_count'])
                ->get();

            // Attach soal ke sesi CBT
            $cbtSession->smsQuestions()->saveMany($easyQuestions);
            $cbtSession->smsQuestions()->saveMany($hardQuestions);
        } elseif ($validatedData['question_type'] === \App\Enums\QuestionType::PK->value) {
            // Ambil soal dari tabel TPK secara acak
            $easyQuestions = TpkQuestion::where('difficulty', \App\Enums\Difficulty::LOTS->value)
                ->inRandomOrder()
                ->take($validatedData['easy_question_count'])
                ->get();

            $hardQuestions = TpkQuestion::where('difficulty', \App\Enums\Difficulty::MOTS->value)
                ->inRandomOrder()
                ->take($validatedData['hard_question_count'])
                ->get();

            // Attach soal ke sesi CBT
            $cbtSession->tpk_questions()->saveMany($easyQuestions);
            $cbtSession->tpk_questions()->saveMany($hardQuestions);
        }

        DB::commit();

        return redirect()->route('cbt-session-question-configurations.index')->with('success', 'Konfigurasi soal berhasil diperbarui!');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->withErrors(['error' => 'Terjadi kesalahan saat memperbarui konfigurasi soal.'])->withInput();
    }
}









}
