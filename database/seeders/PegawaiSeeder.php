<?php

// database/seeders/PegawaiSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pegawai;
use Faker\Factory as Faker;

class PegawaiSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 100) as $index) {
            Pegawai::create([
                'nama' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'tanggal_lahir' => $faker->date,
                'jabatan' => $faker->word,
                'file' => $faker->fileExtension, // Mengisi kolom file dengan ekstensi file dummy
            ]);
        }
    }
}
