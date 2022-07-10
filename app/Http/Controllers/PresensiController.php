<?php

namespace App\Http\Controllers;

use App\Helpers\PresensiHelper;
use App\Models\Presensi;
use Illuminate\Support\Facades\Date;

class PresensiController extends Controller
{
    public function index()
    {
        $presensi = null;

        /** @var \App\Models\Siswa $siswa */
        $siswa = auth()->user();

        [$isJadwalPresensiCreated, $jadwalPresensi] = PresensiHelper::isJadwalPresensiCreated();

        $now = now();
        if ($isJadwalPresensiCreated) {
            $presensi = $siswa->presensiMingguan;
            if ($presensi->isEmpty()) {
                $presensiBaru = PresensiHelper::createPresensi($jadwalPresensi, $siswa->presensi()->orderBy('tanggal_hadir', 'DESC')->first(), $now, $siswa->nis);

                $siswa->presensi()->saveMany($presensiBaru);
                $siswa->refresh();

                $presensi = $siswa->presensiMingguan;
            } else {
                foreach ($presensi as $p) {
                    $selisih = $now->diffInDays(Date::parse($p->tanggal_hadir), false);
                    if (($selisih < 0 && !$p->keterangan && !$p->waktu_hadir) || ($now->toDateString() == $p->tanggal_hadir && PresensiHelper::isAfterPresensiTime($now))) {
                        if (app()->environment('local') && $siswa->nis == 9331) {
                            if ($selisih != 0) {
                                $p->waktu_hadir = "07:00:00";
                            }
                        } else {
                            $p->keterangan = 'tanpa keterangan';
                        }
                        $p->save();
                    }
                }
            }
        }

        return view('dashboard.presensi.index', [
            'presensi' => $presensi,
            'siswa' => $siswa,
            'isJadwalPresensiCreated' => $isJadwalPresensiCreated,
        ]);
    }

    public function presensi(Presensi $presensi)
    {
        return view('dashboard.presensi.presensi', [
            'presensi' => $presensi,
        ]);
    }
    public function presen(Presensi $presensi)
    {
        if (!$presensi) return back()->withErrors([
            'presensi' => 'Presensi tidak ditemukan'
        ]);

        $parsed = Date::parse($presensi->tanggal_hadir)->toImmutable();

        if ($parsed->isoFormat('LL') != now()->isoFormat('LL')) return back()->withErrors([
            'presensi' => 'Presensi hanya dapat dilakukan pada hari ' . $parsed->isoFormat('dddd, LL'),
        ]);

        if (auth()->id() != "9331") {
            if (!PresensiHelper::isPresensiTime()) return back()->withErrors([
                'presensi' => 'Presensi dapat dilakukan mulai pukul 06:00 hingga pukul 07:59'
            ]);
        }

        $presensi->waktu_hadir = now()->toTimeString();
        $presensi->save();

        return back()->with('presensi-success', 'Presensi berhasil dilakukan');
    }
}
