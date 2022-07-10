<?php

namespace App\Helpers;

use App\Models\Siswa;

class Sekolah
{
    public static function kelasRomawi($tingkat)
    {
        if ($tingkat == 10)
            return 'X';
        elseif ($tingkat == 11)
            return 'XI';

        return 'XII';
    }

    public static function semester($tingkat, $tipe = null)
    {
        if ($tingkat == 10)
            if ($tipe == 'ganjil') return 1;
            elseif ($tipe == 'genap') return 2;
            else return [1, 2];

        elseif ($tingkat == 11)
            if ($tipe == 'ganjil') return 3;
            elseif ($tipe == 'genap') return 4;
            else return [3, 4];

        if ($tipe == 'ganjil') return 5;
        elseif ($tipe == 'genap') return 6;
        return [5, 6];
    }

    public static function semesterGanjil($tingkat)
    {
        if ($tingkat == 10)
            return 1;
        elseif ($tingkat == 11)
            return 3;

        return 5;
    }

    public static function semesterGenap($tingkat)
    {
        if ($tingkat == 10)
            return 2;
        elseif ($tingkat == 11)
            return 4;

        return 6;
    }

    public static function predikatNilai(int|null $nilai, int|null $kbm): string
    {
        if ($nilai == null || $kbm == null) return '';

        $interval = (100 - $kbm) / 3;
        $is_float = is_float($interval);
        if ($is_float) $interval = (int) floor($interval) + 1;

        if ($nilai < $kbm) return 'D';
        elseif ($nilai >= $kbm && $nilai < $kbm + $interval) return 'C';
        elseif ($nilai >= $kbm + $interval && $nilai < $kbm + (2 * $interval)) return 'B';

        return 'A';
    }

    public static function jumlahPredikatD($mataPelajaran)
    {
        $jumlah = 0;

        foreach ($mataPelajaran as $mapel) {
            if (self::predikatNilai($mapel->nilai->pengetahuan, $mapel->nilai->kbm) == 'D') $jumlah++;
            if (self::predikatNilai($mapel->nilai->keterampilan, $mapel->nilai->kbm) == 'D') $jumlah++;
        }

        return $jumlah;
    }

    public static function deskripsiNilai($predikat, $kd, $aspek)
    {
        $desk = '';

        switch ($predikat) {
            case 'A':
                $desk = 'sangat baik';
                break;
            case 'B':
                $desk = 'baik';
                break;
            case 'C':
                $desk = 'kurang baik';
                break;
            default:
                $desk = 'tidak baik';
        }

        return "Memiliki $aspek yang $desk dalam " . lcfirst($kd);
    }
}
