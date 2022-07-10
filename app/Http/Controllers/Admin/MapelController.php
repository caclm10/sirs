<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    public function index(Request $request)
    {
        $mapel = null;
        $columns = ['*'];

        if ($request->search || $request->search === "") {
            $mapel = MataPelajaran::query()
                ->where('kode_mapel', 'like', "%" . $request->search . "%")
                ->orWhere('nama_mapel', 'like', "%" . $request->search . "%")
                ->paginate(15, $columns);
        } else {
            $mapel =  MataPelajaran::query()->paginate(15, $columns);
        }

        if ($request->ajax()) {
            return view('includes.admin.list-mapel', [
                'mapel' => $mapel
            ]);
        }

        return view('dashboard.admin.mapel.index', [
            'mapel' => $mapel,
            'search' => $request->search ?? ''
        ]);
    }

    public function create()
    {
        return view('dashboard.admin.mapel.create');
    }

    public function store(Request $request)
    {
        $data =  $request->validate([
            'nama' => 'required|min:4|max:50',
            'kelompok' => 'required',
            'peminatan' => 'required_if:kelompok,c',
        ], [
            'nama.required' => 'Nama harus diisi',
            'nama.min' => 'Nama minimal :min karakter',
            'nama.max' => 'Nama maksimum :max karakter',
            'kelompok.required' => 'Kelompok harus diisi',
            'peminatan.required_if' => 'Peminatan harus diisi'
        ]);

        if ($data['kelompok'] == 'a' || $data['kelompok'] == 'b') {
            $data['peminatan'] = 'umum';
        }

        $last_mapel = MataPelajaran::query()->where('kelompok', $data['kelompok'])->orderBy('kode_mapel', 'DESC')->first(['kode_mapel']);

        $data['kode_mapel'] = $data['kelompok'] . "_" . ((int) explode("_", $last_mapel->kode)[1]) + 1;
        $data['nama_mapel'] = $data['nama'];

        MataPelajaran::query()->create($data);

        return redirect()->route('dashboard.admin.mapel.index')->with('success', 'Berhasil menambah mata pelajaran');
    }

    public function edit($kode)
    {
        $mapel = MataPelajaran::query()->find($kode);

        return view('dashboard.admin.mapel.edit', [
            'mapel' => $mapel,
        ]);
    }

    public function update(Request $request, $kode)
    {
        $request->validate([
            'nama' => 'required|min:4|max:50',
        ], [
            'nama.required' => 'Nama harus diisi',
            'nama.min' => 'Nama minimal :min karakter',
            'nama.max' => 'Nama maksimum :max karakter',
        ]);

        $mapel = MataPelajaran::query()->find($kode);

        $mapel->nama = $request->nama;

        $mapel->save();

        return redirect()->route('dashboard.admin.mapel.index')->with('success', 'Berhasil memperbarui data mata pelajaran');
    }

    public function destroy($kode)
    {
        $mapel = Matapelajaran::query()->find($kode, ['kode_mapel']);

        $resp = redirect()->back();

        if ($mapel) {
            $mapel->delete();
            $resp = $resp->with('success', 'Berhasil menghapus mata pelajaran');
        }

        return $resp;
    }
}
