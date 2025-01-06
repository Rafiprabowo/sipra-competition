<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CbtSession;
use App\Models\MataLomba;
use App\Enums\StatusSesiCbt;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class CbtSessionFactory extends Factory
{
    protected $model = CbtSession::class;

    public function definition(): array
    {
        // Return the factory definition for CbtSession
        return [
            'nama' => $this->faker->word(),
            'waktu_mulai' => $waktuMulai = Carbon::parse($this->faker->time()), // Start time
            'waktu_selesai' => function ($attributes) use ($waktuMulai) {
                return $waktuMulai->addMinutes(rand(30, 120)); // End time
            },
            'durasi' => function ($attributes) use ($waktuMulai) {
                // Calculate the duration by adding a random duration to waktu_mulai
                $waktuSelesai = Carbon::parse($attributes['waktu_selesai']);
                return $waktuMulai->diffInMinutes($waktuSelesai); // Duration in minutes
            },
            'status' => StatusSesiCbt::Completed->value,
            'jumlah_soal' => $this->faker->numberBetween(15, 50),
            'kode_akses' => strtoupper(Str::random(6)),
        ];        
        
    }

    public function withMataLomba(MataLomba $mataLomba):self{
       return $this->state(fn() => ['mata_lomba_id' => $mataLomba->id]);
    }
}

