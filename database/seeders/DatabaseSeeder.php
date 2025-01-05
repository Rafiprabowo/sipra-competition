<?php

namespace Database\Seeders;

use App\Models\CbtSession;
use App\Models\MataLomba;
use App\Models\Peserta;
use App\Models\PesertaSession;
use App\Models\Pembina;
use App\Models\ReguPembina;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Membuat User Admin
        $user_admin = \App\Models\User::create([
             'username' => 'admin',
             'password' => Hash::make('admin123'),
             'role' => 'admin'
         ]);

         $sms = MataLomba::factory()->forMataLomba(\App\Enums\MataLomba::SMS->value)->create();
         $tpk = MataLomba::factory()->forMataLomba(\App\Enums\MataLomba::TPK->value)->create();

        // Membuat User Pembina dengan Regu dan Peserta terkait
        User::factory()
        ->state(['role' => 'pembina'])
        ->has(
            Pembina::factory()
                ->has(
                    ReguPembina::factory()
                        ->count(1)
                        ->withKategoriPA() // Kategori PA
                        ->has(Peserta::factory()->putra()->withMataLomba($tpk)->count(1)) // Regu PA memiliki 1 peserta putra
                        ->has(Peserta::factory()->putra()->withMataLomba($sms)->count(1)) // Regu PA memiliki 1 peserta putra
                )
                ->has(
                    ReguPembina::factory()
                        ->count(1)
                        ->withKategoriPI() // Kategori PI
                        ->has(Peserta::factory()->putri()->withMataLomba($sms)->count(1)) // Regu PI memiliki 1 peserta putri
                        ->has(Peserta::factory()->putri()->withMataLomba($tpk)->count(1)) // Regu PI memiliki 1 peserta putri
                )
        )
        ->count(5) // Buat 5 user dengan role pembina
        ->afterCreating(function (User $user) {
            dump($user->toArray()); // Debug statement
        })
        ->create();
    
        // Buat beberapa sesi CBT
        CbtSession::factory()->withMataLomba($tpk)->count(2)->create();
        CbtSession::factory()->withMataLomba($sms)->count(2)->create();

        $cbtSessions = CbtSession::all();

        // Ambil semua peserta yang dibuat sebelumnya
        $pesertas = Peserta::all();

        // Hubungkan peserta dengan sesi CBT melalui tabel pivot peserta_sessions
        $cbtSessions->each(function ($cbtSession) use ($pesertas) {
            // Pilih peserta dengan mata_lomba_id yang sama dengan mata_lomba_id dari sesi CBT
            $selectedPesertas = $pesertas->where('mata_lomba_id', $cbtSession->mata_lomba_id)->random(10); // Ambil 5-10 peserta sesuai mata lomba

            foreach ($selectedPesertas as $peserta) {
                // Buat relasi di tabel pivot PesertaSession
                PesertaSession::factory()->create([
                    'cbt_session_id' => $cbtSession->id,
                    'peserta_id' => $peserta->id,
                ]);
            }
        });

    }
}
