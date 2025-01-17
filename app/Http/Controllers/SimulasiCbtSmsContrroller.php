<?php

namespace App\Http\Controllers;

use App\Models\SimulasiSmsAnswer;
use App\Models\SimulasiSmsQuestion;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SimulasiCbtSmsContrroller extends Controller
{

    public function index(){
        return view('peserta.start');
    }
    public function start($nomor_soal, Request $request) {
        $nama = $request->query('nama', session('nama'));
    
        if ($nama) {
            $request->session()->put('nama', $nama);
        }
    
        $sms_questions = SimulasiSmsQuestion::take(15)->get();
        $nomor_soal = (int) $nomor_soal;
    
        $sms_question = $sms_questions->skip($nomor_soal - 1)->first();
    
        // Memuat jawaban yang telah disimpan
        $saved_answers = SimulasiSmsAnswer::where('nama', $nama)
            ->where('simulasi_sms_question_id', $sms_question->id)
            ->pluck('answer', 'simulasi_sms_question_image_id')
            ->toArray();
    
        // Tentukan status warna tombol nomor soal
        $questionStatus = [];
        foreach ($sms_questions as $question) {
            $isAnswered = SimulasiSmsAnswer::where('nama', $nama)
                ->where('simulasi_sms_question_id', $question->id)
                ->whereNotNull('answer')
                ->exists();
    
            $questionStatus[$question->id] = $isAnswered ? '#FFBC29' : 'white';
        }
    
        return view('peserta.sesi-cbt.simulasi_sms', compact('sms_question', 'sms_questions', 'nomor_soal', 'nama', 'saved_answers', 'questionStatus'));
    }
    
    public function end($nama) {
        // Retrieve answers by the user
        $jawabans = SimulasiSmsAnswer::where('nama', $nama)
            ->with(['simulasiQuestionImage.SimulasiSmsQuestion', 'simulasiQuestionImage.symbol'])
            ->get();
    
        // Calculate the total number of questions and correct answers
        $jumlah_soal = $jawabans->count();
        $jawaban_benar = 0;
    
        foreach ($jawabans as $jawaban) {
            $gambar = $jawaban->simulasiQuestionImage;
            if ($gambar) {
                $jawaban_peserta = strtoupper($jawaban->answer);
                if ($jawaban_peserta == strtoupper($gambar->symbol->letter)) {
                    $jawaban_benar += 1;
                }
            }
        }
    
        // Calculate the score
        $nilai = $jumlah_soal > 0 ? ($jawaban_benar / $jumlah_soal) * 100 : 0;
    
        // Calculate duration in seconds and format as HH:MM:SS
        $duration_data = DB::table('simulasi_sms_answers')
            ->select(
                DB::raw('MIN(created_at) as first_created_at'),
                DB::raw('MAX(created_at) as last_created_at'),
                DB::raw('TIMESTAMPDIFF(SECOND, MIN(created_at), MAX(created_at)) as duration_in_seconds')
            )
            ->where('nama', $nama)
            ->first();
    
        $duration_in_seconds = $duration_data->duration_in_seconds ?? 0;
        $hours = floor($duration_in_seconds / 3600);
        $minutes = floor(($duration_in_seconds % 3600) / 60);
        $seconds = $duration_in_seconds % 60;
    
        $formatted_duration = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    
        // Pass the data to the results view
        return redirect()->route('simulasi.hasil', [
            'nama' => $nama,
            'nilai' => round($nilai, 2),
            'jawaban_benar' => $jawaban_benar,
            'durasi' => $formatted_duration
        ]);
    }
    
    public function hasil($nama, $nilai, $jawaban_benar, $durasi) {
        return view('peserta.hasil', compact('nama', 'nilai', 'jawaban_benar', 'durasi'));
    }
    
}
