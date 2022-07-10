<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EkstrakurikulerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ekstrakurikuler = [
            [
                'kode_ekskul' => 'ekskul_1',
                'nama_ekskul' => 'Futsal'
            ],
            [
                'kode_ekskul' => 'ekskul_2',
                'nama_ekskul' => 'Komputer'
            ],
            [
                'kode_ekskul' => 'ekskul_3',
                'nama_ekskul' => 'Paskibra'
            ],
            [
                'kode_ekskul' => 'ekskul_4',
                'nama_ekskul' => 'Pramuka',
            ],
            [
                'kode_ekskul' => 'ekskul_5',
                'nama_ekskul' => 'Tari',
            ],
        ];

        foreach ($ekstrakurikuler as $ekskul) {
            DB::table('ekstrakurikuler')->insert($ekskul);
        }
    }
}
