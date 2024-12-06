<?php

namespace App\Imports;

use App\Models\MataLomba;
use App\Models\Peserta;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class PesertaImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function __construct()
    {
        $this->mataLombas = MataLomba::pluck('id', 'nama')->toArray();
    }
    public function model(array $row)
    {
        $mataLombaId = $this->mataLombas[$row[5]] ?? null;

        if (!$mataLombaId) {
            throw new \Exception("Mata lomba dengan nama '{$row[5]}' tidak ditemukan.");
        }

        // Buat User baru berdasarkan NISN
        $user = User::create([
            'name'     => $row[1], // Nama peserta
            'username' => $row[0], // NISN sebagai username
            'password' => Hash::make($row[0]), // Password dari NISN
        ]);

        // Buat Peserta baru dengan user_id
        return new Peserta([
            'nisn'          => $row[0],
            'nama'          => $row[1],
            'pangkalan'     => $row[2],
            'regu'          => $row[3],
            'jenis_kelamin' => $row[4],
            'mata_lomba_id' => $mataLombaId,
            'user_id'       => $user->id, // Hubungkan Peserta dengan User
        ]);
    }
}
