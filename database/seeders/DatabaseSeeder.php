<?php

namespace Database\Seeders;

// database/seeders/DatabaseSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Panggil PegawaiSeeder
        $this->call(PegawaiSeeder::class);
    }
}
