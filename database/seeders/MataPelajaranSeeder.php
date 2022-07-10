<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MataPelajaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mata_pelajaran = [
            [
                'kode_mapel' => 'a_1',
                'nama_mapel' => 'Pendidikan Agama dan Budi Pekerti',
                'peminatan' => 'umum',
                'kelompok' => 'a'
            ],
            [
                'kode_mapel' => 'a_2',
                'nama_mapel' => 'Pendidikan Pancasila dan Kewarganegaraan',
                'peminatan' => 'umum',
                'kelompok' => 'a'
            ],
            [
                'kode_mapel' => 'a_3',
                'nama_mapel' => 'Bahasa Indonesia',
                'peminatan' => 'umum',
                'kelompok' => 'a'
            ],
            [
                'kode_mapel' => 'a_4',
                'nama_mapel' => 'Matematika',
                'peminatan' => 'umum',
                'kelompok' => 'a',
            ],
            [
                'kode_mapel' => 'a_5',
                'nama_mapel' => 'Sejarah Indonesia',
                'peminatan' => 'umum',
                'kelompok' => 'a',
            ],
            [
                'kode_mapel' => 'a_6',
                'nama_mapel' => 'Bahasa Inggris',
                'peminatan' => 'umum',
                'kelompok' => 'a',
            ],
            [
                'kode_mapel' => 'b_1',
                'nama_mapel' => 'Seni Budaya',
                'peminatan' => 'umum',
                'kelompok' => 'b',
            ],
            [
                'kode_mapel' => 'b_2',
                'nama_mapel' => 'Pendidikan Jasmani, Olahraga dan Kesehatan',
                'peminatan' => 'umum',
                'kelompok' => 'b',
            ],
            [
                'kode_mapel' => 'b_3',
                'nama_mapel' => 'Prakarya dan Kewirausahaan',
                'peminatan' => 'umum',
                'kelompok' => 'b',
            ],
            [
                'kode_mapel' => 'c_1',
                'nama_mapel' => 'Matematika',
                'peminatan' => 'mipa',
                'kelompok' => 'c',
            ],
            [
                'kode_mapel' => 'c_2',
                'nama_mapel' => 'Fisika',
                'peminatan' => 'mipa',
                'kelompok' => 'c',
            ],
            [
                'kode_mapel' => 'c_3',
                'nama_mapel' => 'Biologi',
                'peminatan' => 'mipa',
                'kelompok' => 'c',
            ],
            [
                'kode_mapel' => 'c_4',
                'nama_mapel' => 'Kimia',
                'peminatan' => 'mipa',
                'kelompok' => 'c',
            ],
            [
                'kode_mapel' => 'c_5',
                'nama_mapel' => 'Sejarah',
                'peminatan' => 'ips',
                'kelompok' => 'c',
            ],
            [
                'kode_mapel' => 'c_6',
                'nama_mapel' => 'Geografi',
                'peminatan' => 'ips',
                'kelompok' => 'c',
            ],
            [
                'kode_mapel' => 'c_7',
                'nama_mapel' => 'Sosiologi',
                'peminatan' => 'ips',
                'kelompok' => 'c',
            ],
            [
                'kode_mapel' => 'c_8',
                'nama_mapel' => 'Ekonomi',
                'peminatan' => 'ips',
                'kelompok' => 'c',
            ],
        ];

        foreach ($mata_pelajaran as $mapel) {
            DB::table('mata_pelajaran')->insert($mapel);
        }
    }
}
