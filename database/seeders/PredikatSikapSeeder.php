<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PredikatSikapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $predikat_sikap = [
            [
                'predikat' => 'SB',
                'deskripsi_spiritual' => 'Secara umum peserta didik memiliki sikap spiritual sangat baik. Terbiasa berdoa sebelum dan sesudah mengikuti pembelajaran, memberi dan menjawab salam serta selalu menunjukkan rasa syukur kepada Tuhan Yang Maha Esa.',
                'deskripsi_sosial' => 'Secara umum peserta didik memiliki sikap sosial yang sangat baik. Selalu jujur, disiplin, tanggungjawab, toleransi, gotong royong, sopan santun, dan percaya diri.'
            ],
            [
                'predikat' => 'B',
                'deskripsi_spiritual' => 'Secara umum peserta didik memiliki sikap spiritual baik. Sudah mulai terbiasa berdoa sebelum dan sesudah mengikuti pembelajaran, menunjukkan rasa syukur kepada Tuhan Yang Maha Esa.',
                'deskripsi_sosial' => 'Secara umum peserta didik memiliki sikap sosial yang baik, Memiliki toleransi, gotong royong, dan tanggung jawab.',
            ],
            [
                'predikat' => 'C',
                'deskripsi_spiritual' => 'Secara umum peserta didik memiliki sikap spiritual cukup. Sudah mulai terlihat berdoa sebelum dan sesudah mengikuti pembelajaran, menjawab salam',
                'deskripsi_sosial' => 'Secara umum peserta didik memiliki sikap sosial yang cukup',
            ],
            [
                'predikat' => 'K',
                'deskripsi_spiritual' => 'Secara umum peserta didik memiliki sikap spiritual kurang. Perlu bimbingan dan membiasakan diri berdoa sebelum dan sesudah mengikuti pembelajaran.',
                'deskripsi_sosial' => 'Secara umum peserta didik memiliki sikap sosial yang kurang',
            ],
        ];

        foreach ($predikat_sikap as $predikat) {
            DB::table('predikat_sikap')->insert($predikat);
        }
    }
}
