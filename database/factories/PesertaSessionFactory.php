<?php

namespace Database\Factories;

use App\Models\CbtSession;
use App\Models\Peserta;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PesertaSession>
 */
class PesertaSessionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'score' => $this->faker->randomFloat(2, 0, 100), // Random score between 0 and 100
            'status' => 'completed',
            'completed_at' => $this->faker->dateTime(), // Randomly assign completed_at or leave null
            'cbt_session_id' => CbtSession::factory(), // Create or associate a CbtSession
            'peserta_id' => Peserta::factory(), // Create or associate a Peserta
        ];
    }
}
