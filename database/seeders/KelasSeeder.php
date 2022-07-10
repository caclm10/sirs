<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $kelas = [
            [
                'tingkat' => 10,
                'peminatan' => 'mipa',
                'ke' => 1,
                'nip' => '123456789123456789',
            ],
            [
                'tingkat' => 10,
                'peminatan' => 'mipa',
                'ke' => 2
            ],
            [
                'tingkat' => 10,
                'peminatan' => 'mipa',
                'ke' => 3,
                'nip' => '312853424365500945'
            ],
            [
                'tingkat' => 10,
                'peminatan' => 'ips',
                'ke' => 1,
                'nip' => '312435473829345345',
            ],
            [
                'tingkat' => 10,
                'peminatan' => 'ips',
                'ke' => 2
            ],
            [
                'tingkat' => 10,
                'peminatan' => 'ips',
                'ke' => 3
            ],
            [
                'tingkat' => 11,
                'peminatan' => 'mipa',
                'ke' => 1
            ],
            [
                'tingkat' => 11,
                'peminatan' => 'mipa',
                'ke' => 2,
                'nip' => '312852633829345345',
            ],
            [
                'tingkat' => 11,
                'peminatan' => 'mipa',
                'ke' => 3
            ],
            [
                'tingkat' => 11,
                'peminatan' => 'ips',
                'ke' => 1
            ],
            [
                'tingkat' => 11,
                'peminatan' => 'ips',
                'ke' => 2,
                'nip' => '312855342625193935',
            ],
            [
                'tingkat' => 11,
                'peminatan' => 'ips',
                'ke' => 3
            ],
            [
                'tingkat' => 12,
                'peminatan' => 'mipa',
                'ke' => 1,
                'nip' => '312850094829345345',
            ],
            [
                'tingkat' => 12,
                'peminatan' => 'mipa',
                'ke' => 2
            ],
            [
                'tingkat' => 12,
                'peminatan' => 'mipa',
                'ke' => 3
            ],
            [
                'tingkat' => 12,
                'peminatan' => 'ips',
                'ke' => 1,
                'nip' => '053853843534500945',
            ],
            [
                'tingkat' => 12,
                'peminatan' => 'ips',
                'ke' => 2
            ],
            [
                'tingkat' => 12,
                'peminatan' => 'ips',
                'ke' => 3
            ],
        ];

        foreach ($kelas as $k) {
            DB::table('kelas')->insert($k);
        }
    }
}
