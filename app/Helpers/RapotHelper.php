<?php

namespace App\Helpers;

use App\Models\MataPelajaran;
use App\Models\NilaiSikap;
use App\Models\Siswa;

class RapotHelper
{
    public static function createNilaiMapel(Siswa $siswa, string $semester)
    {
        foreach (MataPelajaran::umum() as $mapel) {
            $siswa->mataPelajaran()->attach($mapel->kode, ['semester' => $semester]);
        }
        foreach (MataPelajaran::peminatan($siswa->peminatan) as $mapel) {
            $siswa->mataPelajaran()->attach($mapel->kode, ['semester' => $semester]);
        }
    }

    public static function generateNilaiSikap(NilaiSikap | null $nilaiSikap)
    {
        $sikap = [
            'spiritual' => null,
            'sosial' => null,
        ];

        if ($nilaiSikap) {
            $sikap['spiritual'] = [
                'predikat' => $nilaiSikap->predikat_spiritual,
                'deskripsi' => SikapHelper::getDeskripsi('spiritual', $nilaiSikap->predikat_spiritual),
                'custom' => $nilaiSikap->deskripsi_spiritual,
            ];
            $sikap['sosial'] = [
                'predikat' => $nilaiSikap->predikat_sosial,
                'deskripsi' => SikapHelper::getDeskripsi('sosial', $nilaiSikap->predikat_sosial),
                'custom' => $nilaiSikap->deskripsi_sosial,
            ];
        }

        return $sikap;
    }

    public static function getMataPelajaran(Siswa $siswa, string $semester)
    {
        $semua = $siswa->mataPelajaranSem($semester);

        return [
            'semua' => $semua,
            'a' => $semua->isNotEmpty() ? $semua->filter(fn ($mapel) => $mapel->kelompok == 'a') : [],
            'b' => $semua->isNotEmpty() ? $semua->filter(fn ($mapel) => $mapel->kelompok == 'b') : [],
            'c' => $semua->isNotEmpty() ? $semua->filter(fn ($mapel) => $mapel->kelompok == 'c' && $mapel->peminatan == $siswa->peminatan) : [],
            'lintasMinat' => $semua->isNotEmpty() ? $semua->filter(fn ($mapel) => $mapel->kelompok == 'c' && $mapel->peminatan == $siswa->pem_lintas_minat) : [],
        ];
    }

    public static function getLainnya(Siswa $siswa, string $semester)
    {
        $nilaiSikap = $siswa->nilaiSikapSem($semester);

        return [
            'sikap' => self::generateNilaiSikap($nilaiSikap),
            'ekstrakurikuler' => $siswa->ekskulSem($semester),
            'prestasi' => $siswa->prestasiSem($semester),
        ];
    }

    public static function getData(Siswa $siswa, string $semester)
    {

        $data = [
            'mapel' => self::getMataPelajaran($siswa, $semester),
            ...self::getLainnya($siswa, $semester),
        ];

        if ($data['mapel']['semua']->isEmpty()) {
            self::createNilaiMapel($siswa, $semester);
            $data['mapel'] = self::getMataPelajaran($siswa, $semester);
        }

        if (!$data['sikap']['spiritual'] || !$data['sikap']['sosial']) $data['sikap'] = self::generateNilaiSikap($siswa->nilaiSikap()->create(['semester' => $semester])->refresh());

        return $data;
    }

    public static function predikatNilai(int|null $nilai, int|null $kbm): string
    {
        if ($nilai == null || $kbm == null) return '';

        $interval = (100 - $kbm) / 3;
        if (is_float($interval)) $interval = (int) floor($interval) + 1;

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

    public static function isLulus(\Illuminate\Database\Eloquent\Collection $mapel, array $sikap, int | null $jumlahTanpaKeterangan): bool
    {
        if (self::jumlahPredikatD($mapel) > 7) return false;

        if (($sikap['spiritual'] && $sikap['spiritual']['predikat'] == 'K') || ($sikap['sosial'] && $sikap['sosial']['predikat'] == 'K')) return false;

        if ($jumlahTanpaKeterangan && $jumlahTanpaKeterangan > 14) return false;

        return true;
    }
}
