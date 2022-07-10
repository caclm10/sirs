<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin')->insert([
            'kode_admin' => 'ADM-0111',
            'nama_admin' => 'Hamdan Hamdi',
            'password' => bcrypt('admin')
        ]);

        $number = 112;
        $faker = Factory::create('id_ID');
        for ($i = 0; $i < 10; $i++) {
            DB::table('admin')->insert([
                'kode_admin' => 'ADM-0' . $number,
                'nama_admin' => $faker->firstName . ' ' . $faker->lastName,
                'password' => bcrypt('admin')
            ]);
            $number++;
        }
    }
}
