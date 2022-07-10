<?php

namespace App\Http\Controllers\Rapot;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;

class NilaiSikapController extends Controller
{
    public function update(Request $request, string $nis)
    {
        /** @var \App\Models\Siswa $siswa */
        $siswa = Siswa::find($nis);

        // dd($request->input());
        $siswa->nilaiSikap()->where('semester', $request->semester)->update([
            'predikat_spiritual' => $request->predikat_spiritual,
            'predikat_sosial' => $request->predikat_sosial,
            'deskripsi_spiritual' => $request->deskripsi_spiritual,
            'deskripsi_sosial' => $request->deskripsi_sosial,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Nilai sikap berhasil diubah');
    }
}
