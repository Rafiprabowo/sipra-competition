<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CbtSession;
use App\Models\MataLomba;
use App\Enums\StatusSesiCbt;
use Illuminate\Support\Str;

class CbtSessionFactory extends Factory
{
    protected $model = CbtSession::class;

    public function definition(): array
    {
        // Return the factory definition for CbtSession
        return [
            'nama' => $this->faker->word(),
            'waktu_mulai' => $this->faker->time(),
            'waktu_selesai' => $this->faker->time(),
            'durasi' => $this->faker->numberBetween(30, 120), // Duration in minutes
            'status' => StatusSesiCbt::Completed->value,
            'kode_akses' => Str::random(8),
        ];
    }

    public function withMataLomba(MataLomba $mataLomba):self{
       return $this->state(fn() => ['mata_lomba_id' => $mataLomba->id]);
    }
}

