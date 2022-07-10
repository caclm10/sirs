<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ekstrakurikuler;
use Illuminate\Http\Request;

class EkskulController extends Controller
{
    public function index(Request $request)
    {
        $ekskul = null;

        if ($request->search || $request->search === "")
            $ekskul = Ekstrakurikuler::query()
                ->where('kode_ekskul', 'like', "%" . $request->search . "%")
                ->orWhere('nama_ekskul', 'like', "%" . $request->search . "%")
                ->paginate(15);
        else
            $ekskul =  Ekstrakurikuler::query()->paginate(15);

        $data = ['ekskul' => $ekskul];

        if ($request->ajax())
            return view('includes.admin.list-ekskul', $data);

        $data['search'] = $request->search ?? '';

        return view('dashboard.admin.ekskul.index', $data);
    }

    public function create()
    {
        return view('dashboard.admin.ekskul.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|min:4|max:50'
        ], [
            'nama.required' => 'Nama harus diisi',
            'nama.min' => 'Nama minimal :min karakter',
            'nama.max' => 'Nama maksimum :max karakter',
        ]);

        $last_ekskul = Ekstrakurikuler::query()->orderBy('kode_ekskul', 'DESC')->first(['kode_ekskul']);

        $new_ekskul = [
            'nama_ekskul' => $request->nama,
            'kode_ekskul' => 'ekskul_' . ((int) explode("_", $last_ekskul->kode)[1] + 1)
        ];

        Ekstrakurikuler::query()->create($new_ekskul);

        return redirect()->route('dashboard.admin.ekskul.index')->with('success', 'Berhasil menambah ekstrakurikuler');
    }

    public function edit($kode)
    {
        $ekskul = Ekstrakurikuler::query()->find($kode);

        return view('dashboard.admin.ekskul.edit', ['ekskul' => $ekskul]);
    }

    public function update(Request $request, $kode)
    {
        $request->validate([
            'nama' => 'required|min:4|max:50'
        ], [
            'nama.required' => 'Nama harus diisi',
            'nama.min' => 'Nama minimal :min karakter',
            'nama.max' => 'Nama maksimum :max karakter',
        ]);

        $ekskul = Ekstrakurikuler::query()->find($kode);
        $ekskul->nama = $request->nama;
        $ekskul->save();

        return redirect()->route('dashboard.admin.ekskul.index')->with('success', 'Berhasil memperbarui data ekstrakurikuler');
    }

    public function destroy($kode)
    {
        $ekskul = Ekstrakurikuler::query()->find($kode, ['kode_ekskul']);

        $resp = redirect()->back();

        if ($ekskul) {
            $ekskul->delete();
            $resp = $resp->with('success', 'Berhasil menghapus ekstrakurikuler');
        }

        return $resp;
    }
}
