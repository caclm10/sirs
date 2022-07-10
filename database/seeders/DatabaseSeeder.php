<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            WaliKelasSeeder::class,
            KelasSeeder::class,
            SiswaSeeder::class,
            AdminSeeder::class,
            MataPelajaranSeeder::class,
            EkstrakurikulerSeeder::class,
            PredikatSikapSeeder::class,
            TanggalLiburSeeder::class,
            NilaiSeeder::class,
        ]);
    }
}
