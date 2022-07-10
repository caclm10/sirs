<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NilaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nilai = [
            [
                'nis' => '9331',
                'kode_mapel' => 'a_1',
                'kbm' => 78,
                'pengetahuan' => 90,
                'keterampilan' => 90,
                'kd_pengetahuan' => "Berpikir kritis dan bersikap demokratis",
                "kd_keterampilan" => "Menjelaskan tentang berpikir kritis dan bersikap demokratis",
                "semester" => "genap",
            ],
            [
                'nis' => '9331',
                'kode_mapel' => 'a_2',
                'kbm' => 78,
                'pengetahuan' => 96,
                'keterampilan' => 96,
                'kd_pengetahuan' => "Berbagai kasus-kasus pelanggaran Hak Asasi Manusia dalam Perspektif Pancasila",
                "kd_keterampilan" => "Berbagai macam ketentuan yang berkaitan dengan hak asasi manusia yang tertuang dalam Batang Tubuh UUD 1945 Pasal 7, Pasal 7 A, Pasal 7B, dan Pasal 7C",
                "semester" => "genap",
            ],
            [
                'nis' => '9331',
                'kode_mapel' => 'a_3',
                'kbm' => 80,
                'pengetahuan' => 90,
                'keterampilan' => 87,
                'kd_pengetahuan' => "Mengidentifikasi isi dan sistematika surat lamaran pekerjaan yang dibaca",
                "kd_keterampilan" => "Menyajikan simpulan sistematika dan unsur-unsur isi surat lamaran baik secara lisan maupun tulis",
                "semester" => "genap",
            ],
            [
                'nis' => '9331',
                'kode_mapel' => 'a_4',
                'kbm' => 80,
                'pengetahuan' => 92,
                'keterampilan' => 96,
                'kd_pengetahuan' => "Menentukan jarak dalam ruang dan ukuran pemusatan data",
                "kd_keterampilan" => "Menyajikan tabel distribusi frekuensi, histogram, dan bangun ruang",
                "semester" => "genap",
            ],
            [
                'nis' => '9331',
                'kode_mapel' => 'a_5',
                'kbm' => 80,
                'pengetahuan' => 96,
                'keterampilan' => 95,
                'kd_pengetahuan' => "Menganalisis upaya bangsa Indonesia dalam menghadapi ancaman disintegrasi bangsa antara lain PKI Madiun 1948, DI/TII, APRA, Andi Aziz, RMS, PRRI, Permesta, G-30-S/PKI",
                "kd_keterampilan" => "Menyajikan hasil telaah tentang peran bangsa Indonesia dalam perdamaian dunia antara lain KAA, Misi Garuda, Deklarasi Djuanda, Gerakan Non Blok, ASEAN, OKI, dan Jakarta Informal Meeting serta menyajikannya dalam bentuk laporan tertulis",
                "semester" => "genap",
            ],
            [
                'nis' => '9331',
                'kode_mapel' => 'a_6',
                'kbm' => 80,
                'pengetahuan' => 90,
                'keterampilan' => 90,
                'kd_pengetahuan' => "Memahami teks lisan dan tulis sederhana untuk memberikan saran dan tawaran, penyampaian informasi yang mengejutkan, minta perhatian bersayap, teks khusus surat lamaran kerja, penyerta gambar,  teks ilmiah faktual, dan menyatakan keharusan",
                "kd_keterampilan" => "Membuat teks lisan dan tulis sederhana untuk memberikan saran dan tawaran, penyampaian informasi yang mengejutkan, minta perhatian bersayap, teks khusus surat lamaran kerja, penyerta gambar,  teks ilmiah faktual, dan menyatakan keharusan",
                "semester" => "genap",
            ],
            [
                'nis' => '9331',
                'kode_mapel' => 'b_1',
                'kbm' => 77,
                'pengetahuan' => 98,
                'keterampilan' => 98,
                'kd_pengetahuan' => "Memahami konsep dan teknik berkreasi musik kontemporer serta menganalisis karya musik kontemporer dan mampu menganalisis manajemen seni tari",
                "kd_keterampilan" => "Teknik berkreasi musik kontemporer serta menganalisis karya musik kontemporer dan mampu menganalisis manajemen seni tari",
                "semester" => "genap",
            ],
            [
                'nis' => '9331',
                'kode_mapel' => 'b_2',
                'kbm' => 77,
                'pengetahuan' => 91,
                'keterampilan' => 91,
                'kd_pengetahuan' => "Merancang pola penyerangan dan pertahanan salah satu permainan bola besar",
                "kd_keterampilan" => "Merancang pola penyerangan dan pertahanan salah satu permainan bola besar",
                "semester" => "genap",
            ],
            [
                'nis' => '9331',
                'kode_mapel' => 'b_3',
                'kbm' => 76,
                'pengetahuan' => 96,
                'keterampilan' => 95,
                'kd_pengetahuan' => "Mengingat, mengetahui, menerapkan, menganalisis, dan mengevaluasi semua KD yang diajarkan",
                "kd_keterampilan" => "Mengingat, mengetahui, menerapkan, menganalisis, dan mengevaluasi semua KD yang diajarkan",
                "semester" => "genap",
            ],
            [
                'nis' => '9331',
                'kode_mapel' => 'c_1',
                'kbm' => 80,
                'pengetahuan' => 95,
                'keterampilan' => 94,
                'kd_pengetahuan' => "Memahami dan menganalisis konsep dan sifat-sifat limit fungsi trigonometri, nilai limit fungsi aljabar menuju ketakhinggaan serta turunan fungsi dan menerapkannya dalam pemecahan berbagai masalah",
                "kd_keterampilan" => "Memilih strategi yang efektif dan menyajikan model matematika dalam memecahkan masalah nyata tentang fungsi trigonometri",
                "semester" => "genap",
            ],
            [
                'nis' => '9331',
                'kode_mapel' => 'c_2',
                'kbm' => 80,
                'pengetahuan' => 93,
                'keterampilan' => 94,
                'kd_pengetahuan' => "Menganalisis muatan listrik, gaya listrik, fiks, kuat medan potensial listrik, energi potensial, serta penerapannya",
                "kd_keterampilan" => "Melakukan percobaan prinsip kerja rangkaian listrik searah dengan metode ilmiah",
                "semester" => "genap",
            ],
            [
                'nis' => '9331',
                'kode_mapel' => 'c_3',
                'kbm' => 80,
                'pengetahuan' => 93,
                'keterampilan' => 91,
                'kd_pengetahuan' => "Memahami peran enzim dalam proses metabolisme dan menyajikan data tentang proses metabolisme berdasarkan hasil investigasi dan studi literature untuk memahami proses pembentukan energi pada makhluk hidup",
                "kd_keterampilan" => "Melaksanakan percobaan dan menyusun laporan hasil percobaan tentang cara kerja enzim, fotosintesis, respirasi anaerob secara tertulis dengan berbagai media",
                "semester" => "genap",
            ],
            [
                'nis' => '9331',
                'kode_mapel' => 'c_4',
                'kbm' => 80,
                'pengetahuan' => 85,
                'keterampilan' => 93,
                'kd_pengetahuan' => "Menentukan penurunan tekanan uap, tekanan osmosis, kenaikan titik didih, dan penurunan titik beku dalam suatu larutan",
                "kd_keterampilan" => "Mengolah data percobaan membandingkan sifat koligatif elektrolit dan larutan nonelektrolit yang konsentrasinya sama dalam suatu larutan",
                "semester" => "genap",
            ],
            [
                'nis' => '9331',
                'kode_mapel' => 'c_6',
                'kbm' => 80,
                'pengetahuan' => 89,
                'keterampilan' => 91,
                'kd_pengetahuan' => "Memahami konsep wilayah dan perwilayahan dalam perencanaan tata ruang wilayah nasional, provinsi, dan kabupaten/kota yang baik",
                "kd_keterampilan" => "Membuat peta pengelompokkan penggunaan lahan di wilayah kabupaten/kota/provinsi berdasarkan data wilayah sangat baik",
                "semester" => "genap",
            ],
        ];

        foreach ($nilai as $n) {
            DB::table('nilai')->insert($n);
        }
    }
}
