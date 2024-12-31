<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pembina>
 */
class PembinaFactory extends Factory
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
            'kwartir_cabang' => $this->faker->word(),
            'pangkalan' => $this->faker->name(),
            'nama_gudep' => $this->faker->name(),
            'tanggal_lahir' => $this->faker->date(),
            'jenis_kelamin' => 'L',
            'alamat' => $this->faker->address(),
            'no_hp' => $this->faker->phoneNumber(),
            'pengalaman_pembina' => $this->faker->text(),
            'pekerjaan' => $this->faker->word(),
            'user_id' => User::factory()
        ];
    }
}
