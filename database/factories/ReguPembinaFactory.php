<?php

namespace Database\Factories;

use App\Models\Pembina;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ReguPembina>
 */
class ReguPembinaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_regu' => $this->faker->word(),
            'kategori' => $this->faker->randomElement(['PA', 'PI']),
            'pembina_id' => Pembina::factory()
        ];
    }

    public function withKategoriPa(){
        return $this->state(fn() => ['kategori' => 'PA']);
    }

    public function withKategoriPi(){
        return $this->state(fn() => ['kategori' => 'PI']);
    }
}
