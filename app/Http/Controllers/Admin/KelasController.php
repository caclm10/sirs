<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WaliKelas;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::query()->with('wali')->orderBy('tingkat')->orderBy('peminatan')->paginate();

        return view('dashboard.admin.kelas.index', [
            'kelas' => $kelas
        ]);
    }

    public function create()
    {
        return view('dashboard.admin.kelas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tingkat' => 'required',
            'peminatan' => 'required',
            'ke' => 'required|numeric|min:1|max:50',
        ], [
            'tingkat.required' => 'Tingkat harus diisi',
            'peminatan.required' => 'Pendidikan harus diisi',
            'ke.required' => 'Ke harus diisi',
            'ke.numeric' => 'Ke hanya dapat berupa angka',
            'ke.min' => 'Minimal 1',
            'ke.max' => 'Maximal 50',
        ]);

        $kelas = Kelas::query()
            ->where('tingkat', $request->tingkat)
            ->where('peminatan', $request->peminatan)
            ->where('ke', $request->ke)
            ->first();

        if ($kelas) return redirect()->back()->withErrors(['kelas' => 'Kelas sudah ada'])->withInput();

        $kelas = Kelas::query()->create([
            'tingkat' => $request->tingkat,
            'peminatan' => $request->peminatan,
            'ke' => $request->ke,
        ]);

        return redirect()->back()->with('success', 'Berhasil menambah kelas');
    }

    public function show(Request $request, $id)
    {
        $kelas = Kelas::find($id);

        if ($request->ajax()) {
            return view('includes.admin.kelas.list-siswa', [
                'kelas' => $kelas
            ]);
        }

        return view('dashboard.admin.kelas.show', [
            'kelas' => $kelas,
        ]);
    }

    public function edit($id)
    {
        $kelas = Kelas::find($id);
        return view('dashboard.admin.kelas.edit', [
            'kelas' => $kelas
        ]);
    }

    public function update(Request $request, $id)
    {
        /** @var \App\Models\Kelas $kelas */
        $kelas = Kelas::find($id);

        $nis = $request->input('nis');
        $nip = $request->input('nip');

        /** @var \App\Models\Siswa $siswa */
        if ($nis) $siswa = Siswa::find($nis);

        /** @var \App\Models\WaliKelas $waliKelas */
        if ($nip) $waliKelas = WaliKelas::find($nip);

        if ($request->input('tambah-siswa')) {
            if ($siswa->id_kelas == $id) return response()->json(['message' => 'Siswa sudah berada di kelas ini'], 422);

            $siswa->update(['id_kelas' => $id]);
            return response()->json(['message' => 'Siswa berhasil ditambah ke kelas ' . $kelas->nama]);
        } else if ($request->input('hapus-siswa')) {
            $siswa->update(['id_kelas' => null]);
            return response()->json(['message' => 'Siswa berhasil dihapus dari kelas ' . $kelas->nama]);
        } else if ($request->input('ganti-wali')) {
            if ($waliKelas->kelas) {
                $waliKelas->kelas->wali()->disassociate();
                $waliKelas->kelas->save();
            }

            $kelas->wali()->associate($waliKelas);
            $kelas->save();
            return response()->json([
                'message' => 'Berhasil mengganti wali kelas ' . $kelas->nama,
                'wali' => ['nama' => $waliKelas->nama],
            ]);
        }
    }

    public function destroy($id)
    {
        $kelas = Kelas::find($id);

        if ($kelas) {
            $kelas->delete();
            return redirect()->back()->with('success', 'Berhasil menghapus kelas ' . $kelas->nama);
        }

        return redirect()->back();
    }
}
