<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TanggalLiburSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tanggalLibur = [
            [
                'tanggal' => '2022-02-01',
            ],
            [
                'tanggal' => '2022-02-28',
            ],
            [
                'tanggal' => '2022-03-03',
            ],
            [
                'tanggal' => '2022-04-15',
            ],
            [
                'tanggal' => '2022-05-01',
            ],
            [
                'tanggal' => '2022-05-02',
            ],
            [
                'tanggal' => '2022-05-03',
            ],
            [
                'tanggal' => '2022-05-16',
            ],
            [
                'tanggal' => '2022-05-26',
            ],
            [
                'tanggal' => '2022-06-01',
            ],
        ];

        foreach ($tanggalLibur as $tanggal) {
            DB::table('tanggal_libur')->insert(['tanggal' => $tanggal]);
        }
    }
}
