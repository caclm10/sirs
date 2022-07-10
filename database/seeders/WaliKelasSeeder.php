<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WaliKelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $wali_kelas = [
            'nama_wali_kelas' => 'Siti Melia',
            'password' => bcrypt('walikelas'),
            'nip' => '123456789123456789',
        ];

        DB::table('wali_kelas')->insert($wali_kelas);

        $faker = Factory::create('id_ID');
        $nip = ['312435473829345345', "312852633829345345", "312855342625193935", "312850094829345345", "312853424365500945", "053853843534500945"];
        for ($i = 0; $i < 15; $i++) {
            DB::table('wali_kelas')->insert([
                'nama_wali_kelas' => $faker->firstName . ' ' . $faker->lastName,
                'password' => bcrypt('walikelas'),
                'nip' => $i <= 5 ? $nip[$i] : $faker->numerify("##################"),
            ]);
        }
    }
}
