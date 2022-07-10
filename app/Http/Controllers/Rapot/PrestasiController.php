<?php

namespace App\Http\Controllers\Rapot;

use App\Http\Controllers\Controller;
use App\Models\Prestasi;
use App\Models\Siswa;
use Illuminate\Http\Request;

class PrestasiController extends Controller
{
    public function create(Request $request, string $nis)
    {
        $siswa = Siswa::find($nis);
        $semester = $request->input('semester') ?: 'ganjil';

        return view('dashboard.rapot.prestasi.create', [
            'siswa' => $siswa,
            'semester' => $semester,
        ]);
    }

    public function store(Request $request, string $nis)
    {
        $request->validate([
            'jenis_kegiatan' => 'required|string|max:80',
        ]);

        /** @var \App\Models\Siswa $siswa*/
        $siswa = Siswa::find($nis);
        $siswa->prestasi()->create([
            'jenis_kegiatan' => $request->jenis_kegiatan,
            'keterangan' => $request->keterangan,
            'semester' => $request->semester,
        ]);

        return redirect()
            ->route('dashboard.rapot.show', [$siswa->nis, 'semester' => $request->semester])
            ->with('success', 'Prestasi berhasil ditambah');
    }

    public function edit(Request $request, string $nis, int $id)
    {
        /** @var \App\Models\Siswa $siswa */
        $siswa = Siswa::find($nis);
        $semester = $request->input('semester') ?: 'ganjil';
        $prestasi = Prestasi::find($id);

        return view('dashboard.rapot.prestasi.edit', [
            'siswa' => $siswa,
            'semester' => $semester,
            'prestasi' => $prestasi
        ]);
    }

    public function update(Request $request, string $nis, string $id)
    {
        $request->validate([
            'jenis_kegiatan' => 'required|string|max:80',
        ]);

        /** @var \App\Models\Prestasi $prestasi */
        $prestasi = Prestasi::find($id);

        $prestasi->jenis_kegiatan = $request->jenis_kegiatan;
        $prestasi->keterangan = $request->keterangan;
        $prestasi->save();

        return redirect()
            ->route('dashboard.rapot.show', [$nis, 'semester' => $request->semester])
            ->with('success', 'Prestasi berhasil diubah');
    }

    public function destroy(string $nis, string $id)
    {
        /** @var \App\Models\Prestasi $prestasi */
        $prestasi = Prestasi::find($id);

        if ($prestasi) {
            $semester = $prestasi->semester;
            $prestasi->delete();
            return redirect()->route('dashboard.rapot.show', [$nis, 'semester' => $semester]);
        }

        return redirect()
            ->back()
            ->with('success', 'Prestasi berhasil dihapus');
    }
}
