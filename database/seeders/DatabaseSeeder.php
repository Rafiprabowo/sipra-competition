<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin;
use App\Models\Exam;
use App\Models\Juri;
use App\Models\MataLomba;
use App\Models\Pembina;
use App\Models\Peserta;
use App\Models\Pionering;
use App\Models\ReguPembina;
use App\Models\TpkAnswer;
use App\Models\TpkQuestion;
use App\Models\User;
use Database\Factories\PembinaFactory;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user_admin = \App\Models\User::create([
             'username' => 'admin',
             'password' => Hash::make('admin123'),
             'role' => 'admin'
         ]);

        $user_peserta = \App\Models\User::create([
            'username' => 'peserta',
            'password' => Hash::make('peserta123'),
            'role' => 'peserta'
        ]);
        
        $user_juri  = \App\Models\User::create([
            'username' => 'juri',
            'password' => Hash::make('juri123'),
            'role' => 'juri'
        ]);

        $tpk = MataLomba::create([
            'nama' => \App\Enums\MataLomba::TPK->value,
            'deskripsi' => \App\Enums\MataLomba::TPK->value,
            'ditujukan' => '0',
            'jumlah_peserta' => 1,
            'kategori' => 'cbt',
        ]);
        
        $sms = MataLomba::create([
            'nama' => \App\Enums\MataLomba::SMS->value,
            'deskripsi' => \App\Enums\MataLomba::SMS->value,
            'ditujukan' => '0',
            'jumlah_peserta' => 1,
            'kategori' => 'cbt',
        ]);

        $user = User::factory()
    ->state(['role' => 'pembina'])
    ->has(
        Pembina::factory()
    )
    ->create();

         }
}
