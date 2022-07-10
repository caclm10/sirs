<?php

namespace App\Http\Controllers\Rapot;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use App\Models\Siswa;
use Illuminate\Http\Request;

class NilaiMapelController extends Controller
{
    public function create(Request $request, string $nis)
    {
        /** @var \App\Models\Siswa $siswa */
        $siswa = Siswa::find($nis);
        $semester = $request->input('semester') ?: 'ganjil';

        $daftar_mapel = MataPelajaran::peminatan($siswa->pem_lintas_minat, $siswa->mataPelajaranLintasMinat($semester)->pluck('kode_mapel')->toArray());

        return view('dashboard.rapot.matapelajaran.create', [
            'siswa' => $siswa,
            'semester' => $semester,
            'daftar_mapel' => $daftar_mapel
        ]);
    }

    public function store(Request $request, string $nis)
    {
        /** @var \App\Models\Siswa $siswa */
        $siswa = Siswa::find($nis);

        if (in_array($request->kode, $siswa->mataPelajaranLintasMinat($request->semester)->pluck('kode_mapel')->toArray())) return back()->withErrors([
            'kode' => 'Mata pelajaran ini sudah ditambahkan',
        ])->withInput();

        $request->validate([
            'pengetahuan' => 'nullable|integer|min:0|max:100',
            'keterampilan' => 'nullable|integer|min:0|max:100',
            'kbm' => 'nullable|integer|min:0|max:100',
        ], [
            'pengetahuan.integer' => 'Nilai harus berupa bilangan bulat',
            'pengetahuan.min' => 'Nilai minimum adalah :min',
            'pengetahuan.max' => 'Nilai maksimum adalah :max',
            'keterampilan.integer' => 'Nilai harus berupa bilangan bulat',
            'keterampilan.min' => 'Nilai minimum adalah :min',
            'keterampilan.max' => 'Nilai maksimum adalah :max',
            'kbm.integer' => 'Nilai harus berupa bilangan bulat',
            'kbm.min' => 'Nilai minimum adalah :min',
            'kbm.max' => 'Nilai maksimum adalah :max',
        ]);


        $siswa->mataPelajaran()->attach($request->kode, [
            'semester' => $request->semester,
            'kbm' => $request->kbm,
            'pengetahuan' => $request->pengetahuan,
            'keterampilan' => $request->keterampilan,
            'kd_pengetahuan' => $request->kd_pengetahuan,
            'kd_keterampilan' => $request->kd_keterampilan,
        ]);

        return redirect()
            ->route('dashboard.rapot.show', [$nis, 'semester' => $request->semester])
            ->with('success', 'Nilai mata pelajaran berhasil ditambah');
    }

    public function edit(Request $request, string $nis, string $kode)
    {
        /** @var \App\Models\Siswa $siswa */
        $siswa = Siswa::find($nis);
        $semester = $request->input('semester') ?: 'ganjil';
        $mata_pelajaran = $siswa->mataPelajaranSem($semester, $kode);

        $isLintasMinat = $mata_pelajaran->peminatan != 'umum' && $mata_pelajaran->peminatan != $siswa->peminatan;

        return view('dashboard.rapot.matapelajaran.edit', [
            'siswa' => $siswa,
            'semester' => $semester,
            'mata_pelajaran' => $mata_pelajaran,
            'isLintasMinat' => $isLintasMinat,
        ]);
    }

    public function update(Request $request, string $nis, string $kode)
    {
        $request->validate([
            'pengetahuan' => 'nullable|integer|min:0|max:100',
            'keterampilan' => 'nullable|integer|min:0|max:100',
            'kbm' => 'nullable|integer|min:0|max:100',
        ], [
            'pengetahuan.integer' => 'Nilai harus berupa bilangan bulat',
            'pengetahuan.min' => 'Nilai minimum adalah :min',
            'pengetahuan.max' => 'Nilai maksimum adalah :max',
            'keterampilan.integer' => 'Nilai harus berupa bilangan bulat',
            'keterampilan.min' => 'Nilai minimum adalah :min',
            'keterampilan.max' => 'Nilai maksimum adalah :max',
            'kbm.integer' => 'Nilai harus berupa bilangan bulat',
            'kbm.min' => 'Nilai minimum adalah :min',
            'kbm.max' => 'Nilai maksimum adalah :max',
        ]);

        /** @var \App\Models\Siswa $siswa */
        $siswa = Siswa::find($nis);

        $siswa->mataPelajaran()->wherePivot('semester', $request->semester)->updateExistingPivot($kode, [
            'kbm' => $request->kbm,
            'pengetahuan' => $request->pengetahuan,
            'keterampilan' => $request->keterampilan,
            'kd_pengetahuan' => $request->kd_pengetahuan,
            'kd_keterampilan' => $request->kd_keterampilan,
        ]);

        return redirect()
            ->route('dashboard.rapot.show', [$nis, 'semester' => $request->semester])
            ->with('success', 'Nilai mata pelajaran berhasil diubah');;
    }

    public function destroy(Request $request, string $nis, string $kode)
    {
        /** @var \App\Models\Siswa $siswa */
        $siswa = Siswa::find($nis);
        $semester = $request->input('semester') ?: 'ganjil';
        $mata_pelajaran = $siswa->mataPelajaranSem($semester, $kode);

        $isLintasMinat = $mata_pelajaran->peminatan != 'umum' && $mata_pelajaran->peminatan != $siswa->peminatan;

        if (!$isLintasMinat) return redirect()->back()->withErrors(['mapel' => 'Nilai mata pelajaran tidak dapat dihapus']);

        $siswa->mataPelajaran()->wherePivot('semester', $semester)->detach($kode);

        return redirect()
            ->route('dashboard.rapot.show', [$nis, 'semester' => $semester])
            ->with('success', 'Nilai mata pelajaran berhasil dihapus');;
    }
}
