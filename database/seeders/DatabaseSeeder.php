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
use App\Models\TpkAnswer;
use App\Models\TpkQuestion;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(TpkQuestionSeeder::class);
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

        //  $pionering = MataLomba::create([
        //      'nama' => 'Pionering',
        //      'deskripsi' => 'pionering'
        //  ]);
//         $karikatur = MataLomba::create([
//             'nama' => 'Karikatur',
//             'deskripsi' => 'karikatur'
//         ]);
        $dutaLogika = MataLomba::create([
            'nama' => 'Duta Logika',
            'deskripsi' => 'duta',
            'ditujukan' => 'peserta',
            'jumlah_peserta' => 1
        ]);


        $user_pembina = \App\Models\User::create([
            'username' => 'pembina',
            'password' => Hash::make('pembina123'),
            'role' => 'pembina'
        ]);
        // $pembina = Pembina::create([
        //     'nama' => 'Pembina',
        //     'pangkalan' => 'Polinema',
        //     'user_id' => $user_pembina->id,
        // ]);

        $user_juri  = \App\Models\User::create([
            'username' => 'juri',
            'password' => Hash::make('juri123'),
            'role' => 'juri'
        ]);
        // $juri = Juri::create([
        //     'nama' => 'Juri',
        //     'mata_lomba_id' => $pionering->id,
        //     'user_id' => $user_juri->id,
        // ]);
    }
}
