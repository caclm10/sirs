<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $siswa = null;
        $columns = ['nis', 'nisn', 'nama_siswa', 'id_kelas'];

        if ($request->search || $request->search === "") {
            $query = Siswa::query()
                ->where('nis', 'like', "%" . $request->search . "%")
                ->orWhere('nisn', 'like', "%" . $request->search . "%")
                ->orWhere('nama_siswa', 'like', "%" . $request->search . "%");


            if ($request->input('tambah-kelas') == "1") {
                $siswa = $query->limit(5)->get($columns);
            } else {
                $siswa = $query->paginate(15, $columns);
            }
        } else {
            $siswa =  Siswa::query()->paginate(15, $columns);
        }

        if ($request->ajax()) {
            if ($request->input('tambah-kelas') == "1") {
                return view('includes.admin.kelas.list-searched-siswa', [
                    'siswa' => $siswa,
                    'id_kelas' => $request->input('id-kelas')
                ]);
            }

            return view('includes.admin.list-siswa', [
                'siswa' => $siswa
            ]);
        }

        return view('dashboard.admin.siswa.index', [
            'siswa' => $siswa,
            'search' => $request->search ?? ''
        ]);
    }

    public function create()
    {
        $kelas = Kelas::all();

        return view('dashboard.admin.siswa.create', [
            'kelas' => $kelas,
        ]);
    }

    public function store(Request $request)
    {
        $input = $request->validate([
            'nis' => ['required', 'numeric', 'digits_between:4,5', 'unique:siswa,nis'],
            'nisn' => ['required', 'numeric', 'digits:10', 'unique:siswa,nisn'],
            'nama' => 'required|string|max:50',
        ]);

        Siswa::query()->create([
            'nis' => $input['nis'],
            'nisn' => $input['nisn'],
            'nama_siswa' => $input['nama'],
            'password' => bcrypt('siswa'),
        ]);

        return redirect()->route('dashboard.admin.siswa.index')->with('success', 'Berhasil menambah siswa');
    }

    public function edit($nis)
    {
        $siswa = Siswa::query()->find($nis);

        return view('dashboard.admin.siswa.edit', [
            'siswa' => $siswa
        ]);
    }

    public function update(Request $request, $nis)
    {
        $siswa = Siswa::query()->find($nis);

        $input = $request->validate([
            'nis' => ['required', 'numeric', 'digits_between:4,5', "unique:siswa,nis,{$nis},nis"],
            'nisn' => ['required', 'numeric', 'digits:10', "unique:siswa,nisn,{$siswa->nisn},nisn"],
            'nama' => 'required|string|max:50',
        ]);

        $updateNIS = false;
        if ($siswa->nis != $input['nis']) {
            $siswa->nis = $input['nis'];
            $updateNIS = true;
        }
        if ($siswa->nisn != $input['nisn']) $siswa->nisn = $input['nisn'];
        $siswa->nama = $input['nama'];

        DB::transaction(function () use ($siswa, $input, $nis, $updateNIS) {
            $siswa->save();

            if ($updateNIS) {
                DB::table('nilai')->where('nis', $nis)->update(['nis' => $input['nis']]);
                DB::table('ekskul_siswa')->where('nis', $nis)->update(['nis' => $input['nis']]);
                DB::table('prestasi')->where('nis', $nis)->update(['nis' => $input['nis']]);
                DB::table('presensi')->where('nis', $nis)->update(['nis' => $input['nis']]);
            }
        });

        return redirect()->route('dashboard.admin.siswa.index')->with('success', 'Berhasil memperbarui data siswa');
    }

    public function destroy($nis)
    {
        $siswa = Siswa::query()->find($nis);

        $resp = redirect()->route('dashboard.admin.siswa.index');

        if ($siswa) {
            $siswa->delete();
            $resp = $resp->with('success', 'Berhasil menghapus siswa');
        }

        return $resp;
    }
}
