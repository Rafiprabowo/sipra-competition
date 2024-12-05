<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin;
use App\Models\Juri;
use App\Models\Pembina;
use App\Models\Peserta;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

         $user_admin = \App\Models\User::create([
             'username' => 'admin',
             'password' => Hash::make('admin123'),
             'role' => 'admin'
         ]);

         $admin = Admin::create([
             'nama' => 'Admin',
             'user_id' => $user_admin->id,
         ]);

        $user_peserta = \App\Models\User::create([
            'username' => 'peserta',
            'password' => Hash::make('peserta123'),
            'role' => 'peserta'
        ]);
        $peserta = Peserta::create([
            'nama' => 'Peserta',
            'nisn' => '2141720239',
            'pangkalan' => 'Polinema',
            'regu' => 'semut',
            'jenis_kelamin' => 'laki-laki',
            'user_id' => $user_peserta->id,
        ]);

        $user_pembina = \App\Models\User::create([
            'username' => 'pembina',
            'password' => Hash::make('pembina123'),
            'role' => 'pembina'
        ]);
        $pembina = Pembina::create([
            'nama' => 'Pembina',
            'pangkalan' => 'Polinema',
            'user_id' => $user_pembina->id,
        ]);

        $user_juri  = \App\Models\User::create([
            'username' => 'juri',
            'password' => Hash::make('juri123'),
            'role' => 'juri'
        ]);
        $juri = Juri::create([
            'nama' => 'Juri',
            'user_id' => $user_juri->id,
        ]);
    }
}
