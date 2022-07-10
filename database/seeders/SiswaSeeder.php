<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $siswa = [
            [
                'nis' => '9331',
                'nisn' => '8572385923',
                'nama_siswa' => 'Abdel Hamzah',
                'password' => bcrypt('siswa'),
                'id_kelas' => 1
            ],
            [
                'nama_siswa' => 'Ani Lisa',
                'password' => bcrypt('siswa'),
                'nis' => '9332',
                'nisn' => '8572310923',
                'id_kelas' => 1
            ],
            [
                'nama_siswa' => 'Budi Kim',
                'password' => bcrypt('siswa'),
                'nis' => '9333',
                'nisn' => '4472310923',
                'id_kelas' => 1
            ],
            [
                'nama_siswa' => 'Christia',
                'password' => bcrypt('siswa'),
                'nis' => '9334',
                'nisn' => '4472310952',
                'id_kelas' => 1
            ],
        ];

        foreach ($siswa as $s) {
            DB::table('siswa')->insert($s);
        }

        $nis = 9335;
        $faker = Factory::create('id_ID');
        for ($i = 0; $i < 30; $i++) {
            DB::table('siswa')->insert([
                'nama_siswa' => $faker->firstName . ' ' . $faker->lastName,
                'password' => bcrypt('siswa'),
                'nis' => $nis,
                'nisn' => $faker->numerify("##########"),
                'id_kelas' => $faker->randomDigitNotNull,
            ]);
            $nis++;
        }
    }
}
