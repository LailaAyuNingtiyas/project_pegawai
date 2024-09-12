<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pegawai>
 */

class PegawaiFactory extends Factory
{
    protected $model = Pegawai::class;

    public function definition()
    {
        return [
            'nama' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'tanggal_lahir' => $this->faker->date(),
            'jabatan' => $this->faker->jobTitle,
        ];
    }
}

