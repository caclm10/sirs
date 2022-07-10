<?php

namespace App\Http\Controllers;

use App\Helpers\PresensiHelper;
use Illuminate\Http\Request;

class RekapPresensiController extends Controller
{
    public function index(Request $request)
    {
        $pengguna = auth()->user();
        $kelas = $pengguna->kelas;
        $semester = $request->input('semester') ?: 'ganjil';

        $presensi = PresensiHelper::getPresensi($pengguna, $semester);
        $jumlahPresensi = PresensiHelper::countPresensi($presensi);

        return view('dashboard.presensi.rekap', [
            'pengguna' => $pengguna,
            'kelas' => $kelas,
            'semester' => $semester,
            'presensi' => $presensi,
            'jumlahPresensi' => $jumlahPresensi
        ]);
    }
}
