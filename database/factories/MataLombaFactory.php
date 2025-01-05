<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MataLomba>
 */
class MataLombaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'deskripsi' => $this->faker->sentence(),
            'jumlah_peserta' => 1,
            'ditujukan' => 0,
            'kategori' => 'cbt',
        ];
    }

    public function forMataLomba(string $namaMataLomba): self
    {
        return $this->state(fn() => ['nama' => $namaMataLomba]);
    }
}
