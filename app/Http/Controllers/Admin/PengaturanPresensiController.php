<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\PresensiHelper;
use App\Http\Controllers\Controller;
use App\Models\JadwalPresensi;
use App\Models\TanggalLibur;
use Illuminate\Http\Request;

class PengaturanPresensiController extends Controller
{
    public function index()
    {
        [$jadwalGanjil, $jadwalGenap] = PresensiHelper::getJadwalPresensi();
        $tanggalLibur = TanggalLibur::orderBy('tanggal')->get();

        return view('dashboard.admin.presensi.pengaturan.index', [
            'jadwal' => [
                'ganjil' => $jadwalGanjil,
                'genap' => $jadwalGenap,
            ],
            'tanggalLibur' => $tanggalLibur
        ]);
    }

    public function storeTanggalLibur(Request $request)
    {
        $input = $request->validateWithBag('tanggal-libur', [
            'tanggal_libur' => "required|unique:tanggal_libur,tanggal"
        ]);

        (new TanggalLibur(['tanggal' => $input['tanggal_libur']]))->save();

        return back()->with('success', 'Berhasil menambah tanggal libur');
    }

    public function updateJadwalGanjil(Request $request)
    {
        $input = $request->validateWithBag('jadwal-ganjil', [
            'ganjil_mulai' => 'required',
            'ganjil_akhir' => 'required',
        ]);

        PresensiHelper::updateJadwalPresensi($input, 'ganjil');

        return back()->with('success', 'Berhasil memperbarui jadwal presen');
    }

    public function updateJadwalGenap(Request $request)
    {
        $input = $request->validateWithBag('jadwal-genap', [
            'genap_mulai' => 'required',
            'genap_akhir' => 'required',
        ]);

        PresensiHelper::updateJadwalPresensi($input, 'genap');

        return back()->with('success', 'Berhasil memperbarui jadwal presen');
    }

    public function destroyTanggalLibur(TanggalLibur $tanggalLibur)
    {
        if ($tanggalLibur) {
            $tanggalLibur->delete();
            session()->flash('success', 'Berhasil menghapus tanggal libur');
        }

        return back();
    }
}
