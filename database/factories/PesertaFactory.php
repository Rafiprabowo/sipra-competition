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
    $nisn = Str::random(8); // Generate NISN

    return [
        'nama' => $this->faker->name(),
        'nisn' => $nisn, // Assign generated NISN
        'jenis_kelamin' => $this->faker->randomElement(['Putra', 'Putri']),
        'regu_pembina_id' => ReguPembina::factory(),
        'user_id' => User::factory()->state([
            'username' => $nisn, // Use NISN as username
            'password' => bcrypt($nisn), // Use NISN as password and hash it
            'role' => 'peserta'
        ]),
    ];
}


    public function putra(){
        return $this->state(fn() => ['jenis_kelamin' => 'Putra']);
    }
    public function putri(){
        return $this->state(fn() => ['jenis_kelamin' => 'Putri']);
    }

    public function withMataLomba(MataLomba $mataLomba): self
    {
        return $this->state(fn() => ['mata_lomba_id' => $mataLomba->id]);
    }

    
}
