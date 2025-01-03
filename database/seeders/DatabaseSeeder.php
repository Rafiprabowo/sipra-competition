<?php

namespace Database\Seeders;

use App\Models\CbtSession;
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

        // Membuat User Pembina dengan Regu dan Peserta terkait
        User::factory()
        ->state(['role' => 'pembina'])
        ->has(
            Pembina::factory()
                ->has(
                    ReguPembina::factory()
                        ->count(1)
                        ->withKategoriPA() // Kategori PA
                        ->has(Peserta::factory()->putra()->count(1)) // Regu PA memiliki 1 peserta putra
                )
                ->has(
                    ReguPembina::factory()
                        ->count(1)
                        ->withKategoriPI() // Kategori PI
                        ->has(Peserta::factory()->putri()->count(1)) // Regu PI memiliki 1 peserta putri
                )
        )
        ->count(5) // Buat 5 user dengan role pembina
        ->afterCreating(function (User $user) {
            dump($user->toArray()); // Debug statement
        })
        ->create();
    
        // Buat beberapa sesi CBT
        $cbtSessions = CbtSession::factory()->count(3)->create();

        // Ambil semua peserta yang dibuat sebelumnya
        $pesertas = Peserta::all();

        // Hubungkan peserta dengan sesi CBT melalui tabel pivot peserta_sessions
        $cbtSessions->each(function ($cbtSession) use ($pesertas) {
            // Pilih beberapa peserta secara acak untuk setiap sesi
            $selectedPesertas = $pesertas->random(rand(5, 10)); // Ambil 5-10 peserta secara acak

            foreach ($selectedPesertas as $peserta) {
                PesertaSession::factory()->create([
                    'cbt_session_id' => $cbtSession->id,
                    'peserta_id' => $peserta->id,
                ]);
            }
        });
    }
}
