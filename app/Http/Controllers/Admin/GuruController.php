<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function index(Request $request)
    {
        $guru = null;
        $columns = ['nip', 'nama_guru'];

        if ($request->search || $request->search === "") {
            $query = Guru::query()
                ->where('nip', 'like', "%" . $request->search . "%")
                ->orWhere('nama_guru', 'like', "%" . $request->search . "%");


            if ($request->input('ganti-wali') == "1") {
                $guru = $query->limit(5)->get($columns);
            } else {
                $guru = $query->paginate(15, $columns);
            }
        } else {
            $guru =  Guru::query()->paginate(15, $columns);
        }

        if ($request->ajax()) {
            if ($request->input('ganti-wali') == "1") {
                return view('includes.admin.kelas.list-searched-guru', [
                    'guru' => $guru,
                    'id_kelas' => $request->input('id-kelas')
                ]);
            }

            return view('includes.admin.list-guru', [
                'guru' => $guru
            ]);
        }

        return view('dashboard.admin.guru.index', [
            'guru' => $guru,
            'search' => $request->search ?? ''
        ]);
    }

    public function create()
    {
        return view('dashboard.admin.guru.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|numeric|digits:18|unique:guru,nip',
            'nama' => 'required|string|max:50',
        ], [
            'nip.required' => 'NIP harus diisi',
            'nip.numeric' => 'NIP hanya dapat berupa angka',
            'nip.digits' => 'NIP harus 18 angka',
            'nip.unique' => 'NIP sudah terdaftar',
            'nama.required' => 'Nama harus diisi',
            'nama.max' => 'Nama maksimum 50 karakter',
        ]);

        Guru::query()->create([
            'nip' => $request->nip,
            'nama_guru' => $request->nama,
            'password' => bcrypt('guru'),
        ]);

        return redirect()->route('dashboard.admin.wali-kelas.index')->with('success', 'Berhasil menambah wali kelas');
    }

    public function edit($nis)
    {
        $guru = Guru::query()->find($nis);

        return view('dashboard.admin.guru.edit', [
            'guru' => $guru
        ]);
    }

    public function update(Request $request, $nip)
    {
        $request->validate([
            'nama' => 'required|string|max:50',
        ], [
            'nama.required' => 'Nama harus diisi',
            'nama.max' => 'Nama maksimum 50 karakter',
        ]);

        $guru = Guru::query()->find($nip);

        $guru->nama = $request->nama;
        $guru->save();

        return redirect()->route('dashboard.admin.wali-kelas.index')->with('success', 'Berhasil memperbarui data wali kelas');
    }

    public function destroy($nip)
    {
        $guru = Guru::query()->find($nip);

        if ($guru) {
            $guru->delete();
            session()->flash('success', 'Berhasil menghapus data guru');
        }

        return redirect()->route('dashboard.admin.wali-kelas.index');
    }
}
