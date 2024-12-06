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
        $this->mataLombas = MataLomba::all()->mapWithKeys(function($item) {
            return [trim(strtolower($item->nama)) => $item->id];
        })->toArray();
    }

    public function model(array $row)
    {
        // Cek apakah baris saat ini adalah header (misalnya berdasarkan NISN yang tidak mungkin menjadi kolom nama)
        if ($row[0] == 'NISN') {
            return null; // Melewati header
        }

        $mataLombaName = trim(strtolower($row[5]));

        $mataLombaId = $this->mataLombas[$mataLombaName] ?? null;

        if (!$mataLombaId) {
            throw new \Exception("Mata lomba dengan nama '{$row[5]}' tidak ditemukan.");
        }

        // Buat User baru berdasarkan NISN
        $user = User::create([
            'username' => $row[0], // NISN sebagai username
            'password' => Hash::make($row[0]), // Password dari NISN
        ]);

        // Buat Peserta baru dengan user_id
        return new Peserta([
            'nisn'          => $row[0],
            'nama'          => $row[1],
            'pangkalan'     => $row[2],
            'regu'          => $row[3],
            'jenis_kelamin' => trim(strtolower($row[4])),
            'mata_lomba_id' => $mataLombaId,
            'user_id'       => $user->id, // Hubungkan Peserta dengan User
        ]);
    }

    public function startRow(): int
    {
        return 2; // Mulai pembacaan data dari baris kedua
    }

}
