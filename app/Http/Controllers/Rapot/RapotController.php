<?php

namespace App\Http\Controllers\Rapot;

use App\Helpers\PresensiHelper;
use App\Helpers\AppHelper;
use App\Helpers\RapotHelper;
use App\Http\Controllers\Controller;
use App\Models\PredikatSikap;
use App\Models\Siswa;
use Illuminate\Http\Request;

class RapotController extends Controller
{
    public function index(Request $request)
    {
        $pengguna = $request->user();
        $semester = $request->input('semester') ?: 'ganjil';

        if (AppHelper::isWaliKelasGuard()) {
            /** @var \App\Models\WaliKelas $pengguna */

            $kelas = $pengguna->kelas()->with('siswa')->first();
        } else {
            /** @var \App\Models\Siswa $pengguna */

            $kelas = $pengguna->kelas;
            $mapel = RapotHelper::getMataPelajaran($pengguna, $semester);
            $lainnya = RapotHelper::getLainnya($pengguna, $semester);
            $jumlahPredikatD = RapotHelper::jumlahPredikatD($mapel['semua']);
            $jumlahPresensi = PresensiHelper::countPresensiSiswa($pengguna, $semester);
            $isLulus = RapotHelper::isLulus($mapel['semua'], $lainnya['sikap'], $jumlahPresensi['tanpa keterangan']);
        }

        // dd($jumlahPresensi);
        return view('dashboard.rapot.index', [
            'pengguna' => $pengguna,
            'kelas' => $kelas,
            'semester' => $semester,
            'lainnya' => $lainnya ?? null,
            'mapel' => $mapel ?? null,
            'jumlahPredikatD' => $jumlahPredikatD ?? null,
            'jumlahPresensi' => $jumlahPresensi ?? null,
            'isLulus' => $isLulus ?? null,
        ]);
    }

    public function show(Request $request, string $nis)
    {
        /** @var \App\Models\Siswa $siswa */
        $siswa = Siswa::find($nis);
        $semester = $request->input('semester') ?: 'ganjil';
        $predikatSikap = PredikatSikap::all();

        $dataRapot = RapotHelper::getData($siswa, $semester);

        return view('dashboard.rapot.show', [
            'siswa' => $siswa,
            'semester' => $semester,
            'dataRapot' => $dataRapot,
            'predikatSikap' => $predikatSikap,
        ]);
    }
}
