<?php

namespace App\Helpers;

use App\Models\Presensi;
use App\Models\JadwalPresensi;
use App\Models\Siswa;
use App\Models\TanggalLibur;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Date;

class PresensiHelper
{
    public static function isPresensiTime(Carbon $currentTime = null)
    {
        $now = $currentTime ?: now();

        if ($now->hour < 6 || $now->hour >= 8) {
            return false;
        }

        return true;
    }

    public static function isAfterPresensiTime(Carbon $currentTime = null)
    {
        $now = $currentTime ?: now();

        if ($now->hour >= 8) return true;

        return false;
    }

    public static function isBeforePresensiTime(Carbon $currentTime = null)
    {
        $now = $currentTime ?: now();

        if ($now->hour < 6) return true;

        return false;
    }

    public static function handlePresensiSiswa(Presensi $presensi, string $keterangan)
    {
        $presensi->waktu_hadir = $keterangan == 'hadir' ? now()->toTimeString() : null;
        $presensi->keterangan = $keterangan == 'hadir' ? null : $keterangan;
        $presensi->save();
    }

    public static function getJadwalPresensi(string | null $semester = null): array
    {
        $jadwal = JadwalPresensi::all();

        if (!$semester) return [
            $jadwal->filter(fn ($j) => $j->semester == 'ganjil')->first(),
            $jadwal->filter(fn ($j) => $j->semester == 'genap')->first(),
        ];

        return [$jadwal->filter(fn ($j) => $j->semester == $semester)->first()];
    }

    public static function updateJadwalPresensi(array $input, string $semester)
    {
        $jadwalPresensi = JadwalPresensi::query()
            ->where('semester', $semester)
            ->first();


        if (!$jadwalPresensi) {
            $jadwalPresensi = new JadwalPresensi([
                'semester' => $semester
            ]);
        }
        $jadwalPresensi->tanggal_mulai = $input[$semester . "_mulai"];
        $jadwalPresensi->tanggal_akhir = $input[$semester . "_akhir"];
        $jadwalPresensi->save();
    }

    public static function isJadwalPresensiCreated(): array
    {
        [$jadwalGanjil, $jadwalGenap] = self::getJadwalPresensi();

        if ($jadwalGenap || $jadwalGanjil) {
            $now = now();
            $parsed = [];

            if ($jadwalGanjil) $parsed['ganjil'] = self::getParsedTanggalJadwal($jadwalGanjil);
            if ($jadwalGenap) $parsed['genap'] = self::getParsedTanggalJadwal($jadwalGenap);

            if ($jadwalGanjil && $now->isBetween($parsed['ganjil']['tanggal_mulai'], $parsed['ganjil']['tanggal_akhir'])) return [true, $jadwalGanjil];
            elseif ($jadwalGenap && $now->isBetween($parsed['genap']['tanggal_mulai'], $parsed['genap']['tanggal_akhir'])) return [true, $jadwalGenap];
        }

        return [false, null];
    }

    public static function getTanggalLibur(): array
    {
        return TanggalLibur::orderBy('tanggal')->get(['tanggal'])->pluck('tanggal')->all();
    }

    public static function getParsedTanggalJadwal(JadwalPresensi $jadwal)
    {
        return [
            'tanggal_mulai' => Date::parse($jadwal->tanggal_mulai),
            'tanggal_akhir' => Date::parse($jadwal->tanggal_akhir)
        ];
    }

    public static function countPresensiSiswa(Siswa $siswa, string $semester)
    {
        [$jadwalPresensi] = self::getJadwalPresensi($semester);

        if (!$jadwalPresensi) return [
            'tanpa keterangan' => null,
            'izin' => null,
            'sakit' => null,
        ];

        $presensi = $siswa->presensi()->whereBetween('tanggal_hadir', [$jadwalPresensi->tanggal_mulai, $jadwalPresensi->tanggal_akhir])->get();

        return self::countPresensi($presensi);
    }

    public static function getPresensi(Siswa $siswa, string $semester)
    {
        [$jadwalPresensi] = self::getJadwalPresensi($semester);

        return $jadwalPresensi ?
            $siswa->presensi()->whereBetween('tanggal_hadir', [$jadwalPresensi->tanggal_mulai, $jadwalPresensi->tanggal_akhir])->get()
            :
            null;
    }

    public static function countPresensi(\Illuminate\Database\Eloquent\Collection | null $presensi)
    {
        if (!$presensi) return [];
        return [
            'hadir' => $presensi->filter(fn ($p) => !!$p->waktu_hadir)->count(),
            'sakit' => $presensi->filter(fn ($p) => $p->keterangan == 'sakit')->count(),
            'izin' => $presensi->filter(fn ($p) => $p->keterangan == 'izin')->count(),
            'tanpa keterangan' => $presensi->filter(fn ($p) => $p->keterangan == 'tanpa keterangan')->count(),
        ];
    }

    public static function createPresensi($jadwal, $presensiTerakhir = null, $now = null, $nis = null): array
    {
        $now = $now ?: now();
        $presensiBaru = [];
        $parsed = self::getParsedTanggalJadwal($jadwal);
        $tanggalLibur = self::getTanggalLibur();
        $tanggalMulai = $presensiTerakhir ? Date::parse($presensiTerakhir->tanggal_hadir)->addDay() : $parsed['tanggal_mulai'];

        for ($tanggal = $tanggalMulai; $tanggal->timestamp <= $parsed['tanggal_akhir']->timestamp; $tanggal->addDay()) {
            $minggu = $tanggal->copy()->endOfWeek();
            $tanggalString = $tanggal->toDateString();

            if ($tanggalString == $minggu->toDateString()) continue;
            if (in_array($tanggalString, $tanggalLibur)) continue;

            $dataAbsen = ['tanggal_hadir' => $tanggalString];

            $selisih = $now->diffInDays($tanggal, false);
            if ($selisih < 0 || ($now->toDateString() == $tanggalString && PresensiHelper::isAfterPresensiTime($now))) {

                if (app()->environment('local') && $nis == 9331) {
                    if ($selisih != 0) {
                        $dataAbsen['waktu_hadir'] = "07:00:00";
                    }
                } else {
                    $dataAbsen['keterangan'] = 'tanpa keterangan';
                }
            }

            $presensiBaru[] = new Presensi($dataAbsen);
        }

        return $presensiBaru;
    }
}
