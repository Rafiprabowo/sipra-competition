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
            'nama' => $this->faker->randomElement([\App\Enums\MataLomba::TPK->value, \App\Enums\MataLomba::SMS->value]),
            'deskripsi' => $this->faker->sentence(),
            'jumlah_peserta' => 1,
            'ditujukan' => 0,
            'kategori' => 'cbt',
        ];
    }
}
