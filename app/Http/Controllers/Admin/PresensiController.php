<?php

namespace App\Http\Controllers\Admin;


use App\Helpers\PresensiHelper;
use App\Http\Controllers\Controller;
use App\Models\Presensi;
use Illuminate\Http\Request;

class PresensiController extends Controller
{
    public function index(Request $request)
    {

        $search = $request->search ?? '';
        $tanggal = $request->tanggal ?? now()->toDateString();

        $query = Presensi::query()
            ->with('siswa')
            ->where('tanggal_hadir', $tanggal);

        if ($search) {
            $query = $query
                ->whereHas('siswa', function ($query) use ($search) {
                    $query->where('nis', 'like', "%" . $search . "%");
                    $query->orWhere('nisn', 'like', "%" . $search . "%");
                    $query->orWhere('nama_siswa', 'like', "%" . $search . "%");
                });
        }

        $data = [
            'presensi' => $query->orderBy('nis')->paginate(15),
            'search' => $search,
            'tanggal' => $tanggal
        ];

        if ($request->ajax())
            return view('includes.admin.list-presensi', $data);


        return view('dashboard.admin.presensi.index', $data);
    }

    public function edit(Request $request, Presensi $presensi)
    {
        $now = now();

        if ($presensi) {
            if (!$presensi->waktu_hadir && !$presensi->keterangan && ($presensi->tanggal_hadir != $now->toDateString() || PresensiHelper::isAfterPresensiTime($now))) {
                $presensi->keterangan = "tanpa keterangan";
                $presensi->save();
            }
        }

        return view('dashboard.admin.presensi.edit', [
            'presensi' => $presensi,
            'search' => $request->search,
            'tanggal' => $request->tanggal
        ]);
    }

    public function update(Request $request, Presensi $presensi)
    {
        PresensiHelper::handlePresensiSiswa($presensi, $request->keterangan);

        return back()->with('success', 'Presensi siswa berhasil diperbarui');
    }
}
