<?php

namespace Database\Factories;

use App\Models\MataLomba;
use App\Models\ReguPembina;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Peserta>
 */
class PesertaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
{
    return [
        'nama' => $this->faker->name(),
        'nisn' => Str::random(8),
        'jenis_kelamin' => $this->faker->randomElement(['L', 'P']),
        'regu_pembina_id' => ReguPembina::factory()->state(function (array $atr) {
            return [
                'kategori' => $atr['jenis_kelamin'] === 'L' ? 'PA' : 'PI',
            ];
        }),
        'mata_lomba_id' => MataLomba::factory(),
        'user_id' => User::factory()->peserta(), // Menggunakan state "peserta"
    ];
}


    public function withMataLomba($mataLombaId)
    {
        return $this->state(fn () => ['mata_lomba_id' => $mataLombaId]);
    }
}
