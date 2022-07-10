<?php

namespace App\Http\Controllers\Rapot;

use App\Http\Controllers\Controller;
use App\Models\Ekstrakurikuler;
use App\Models\Siswa;
use Illuminate\Http\Request;

class NilaiEkskulController extends Controller
{
    public function create(Request $request, string $nis)
    {
        /** @var \App\Models\Siswa $siswa */
        $siswa = Siswa::find($nis);
        $semester = $request->input('semester') ?: 'ganjil';
        $ekskulSiswa = $siswa->ekskulSem($semester);

        $ekstrakurikuler = Ekstrakurikuler::all()->reject(fn ($value) => in_array($value->kode, $ekskulSiswa->pluck('kode_ekskul')->toArray()));

        return view('dashboard.rapot.ekstrakurikuler.create', [
            'siswa' => $siswa,
            'ekstrakurikuler' => $ekstrakurikuler,
            'semester' => $semester
        ]);
    }

    public function store(Request $request, string $nis)
    {
        /** @var \App\Models\Siswa $siswa */
        $siswa = Siswa::find($nis);
        $ekskul = $siswa->ekskulSem($request->semester, $request->kode);

        if ($ekskul) return redirect()->back()->withErrors(['ekskul' => 'Ekstrakurikuler sudah ada']);

        $siswa->ekstrakurikuler()->attach($request->kode, [
            'nilai' => $request->nilai,
            'semester' => $request->semester,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()
            ->route(
                'dashboard.rapot.show',
                [
                    $nis,
                    'semester' => $request->semester
                ]
            )
            ->with('success', 'Nilai ekstrakurikuler berhasil ditambah');
    }

    public function edit(Request $request, string $nis, string $kode)
    {
        /** @var \App\Models\Siswa $siswa */
        $siswa = Siswa::find($nis);
        $semester = $request->input('semester') ?: 'ganjil';

        $ekstrakurikuler = $siswa->ekskulSem($semester, $kode);

        return view('dashboard.rapot.ekstrakurikuler.edit', [
            'siswa' => $siswa,
            'semester' => $semester,
            'ekstrakurikuler' => $ekstrakurikuler
        ]);
    }

    public function update(Request $request, string $nis, string $kode)
    {
        /** @var \App\Models\Siswa $siswa */
        $siswa = Siswa::find($nis);

        $request->validate([
            'nilai' => 'nullable|integer|min:0|max:100'
        ], [
            'nilai.integer' => 'Nilai harus berupa bilangan bulat',
            'nilai.min' => 'Nilai minimum adalah :min',
            'nilai.max' => 'Nilai maksimum adalah :max'
        ]);

        $siswa->ekstrakurikuler()
            ->wherePivot('semester', $request->semester)
            ->updateExistingPivot($kode, [
                'nilai' => $request->nilai,
                'deskripsi' => $request->deskripsi
            ]);

        return redirect()
            ->route('dashboard.rapot.show', [
                $request->nis,
                'semester' => $request->semester
            ])
            ->with('success', 'Nilai ekstrakurikuler berhasil diubah');
    }

    public function destroy(Request $request, string $nis, string $kode)
    {
        /** @var \App\Models\Siswa $siswa */
        $siswa = Siswa::find($nis);
        $semester = $request->input('semester') ?: 'ganjil';

        $siswa->ekstrakurikuler()->wherePivot('semester', $semester)->detach($kode);

        return redirect()
            ->route('dashboard.rapot.show', [$nis, 'semester' => $semester])
            ->with('success', 'Nilai ekstrakurikuler berhasil dihapus');
    }
}
