<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WaliKelas;
use Illuminate\Http\Request;

class WaliKelasController extends Controller
{
    public function index(Request $request)
    {
        $waliKelas = null;
        $columns = ['nip', 'nama_wali_kelas'];

        if ($request->search || $request->search === "") {
            $query = WaliKelas::query()
                ->where('nip', 'like', "%" . $request->search . "%")
                ->orWhere('nama_wali_kelas', 'like', "%" . $request->search . "%");


            if ($request->input('ganti-wali') == "1") {
                $waliKelas = $query->limit(5)->get($columns);
            } else {
                $waliKelas = $query->paginate(15, $columns);
            }
        } else {
            $waliKelas =  WaliKelas::query()->paginate(15, $columns);
        }

        if ($request->ajax()) {
            if ($request->input('ganti-wali') == "1") {
                return view('includes.admin.kelas.list-searched-wali_kelas', [
                    'waliKelas' => $waliKelas,
                    'id_kelas' => $request->input('id-kelas')
                ]);
            }

            return view('includes.admin.list-wali_kelas', [
                'waliKelas' => $waliKelas
            ]);
        }

        return view('dashboard.admin.wali_kelas.index', [
            'waliKelas' => $waliKelas,
            'search' => $request->search ?? ''
        ]);
    }

    public function create()
    {
        return view('dashboard.admin.wali_kelas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|numeric|digits:18|unique:wali_kelas,nip',
            'nama' => 'required|string|max:50',
        ], [
            'nip.required' => 'NIP harus diisi',
            'nip.numeric' => 'NIP hanya dapat berupa angka',
            'nip.digits' => 'NIP harus 18 angka',
            'nip.unique' => 'NIP sudah terdaftar',
            'nama.required' => 'Nama harus diisi',
            'nama.max' => 'Nama maksimum 50 karakter',
        ]);

        WaliKelas::query()->create([
            'nip' => $request->nip,
            'nama_wali_kelas' => $request->nama,
            'password' => bcrypt('walikelas'),
        ]);

        return redirect()->route('dashboard.admin.wali-kelas.index')->with('success', 'Berhasil menambah wali kelas');
    }

    public function edit($nis)
    {
        $waliKelas = WaliKelas::query()->find($nis);

        return view('dashboard.admin.wali_kelas.edit', [
            'waliKelas' => $waliKelas
        ]);
    }

    public function update(Request $request, $nip)
    {
        $request->validate([
            'nip' => ['required', 'numeric', 'digits:18', "unique:wali_kelas,nip,{$nip},nip"],
            'nama' => 'required|string|max:50',
        ]);

        $waliKelas = WaliKelas::query()->find($nip);

        if ($waliKelas->nip != $request->nip) {
            $waliKelas->nip = $request->nip;
        }
        $waliKelas->nama = $request->nama;
        $waliKelas->save();

        return redirect()->route('dashboard.admin.wali-kelas.index')->with('success', 'Berhasil memperbarui data wali kelas');
    }

    public function destroy($nip)
    {
        $waliKelas = WaliKelas::query()->find($nip);

        if ($waliKelas) {
            $waliKelas->delete();
            session()->flash('success', 'Berhasil menghapus data wali kelas');
        }

        return redirect()->route('dashboard.admin.wali-kelas.index');
    }
}
