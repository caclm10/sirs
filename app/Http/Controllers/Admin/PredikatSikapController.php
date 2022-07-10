<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PredikatSikap;
use Illuminate\Http\Request;

class PredikatSikapController extends Controller
{
    public function index(Request $request)
    {
        $predikatSikap = null;

        if ($request->search || $request->search === "")
            $predikatSikap = PredikatSikap::query()
                ->where('predikat', 'like', "%" . $request->search . "%")
                ->orWhere('deskripsi_spiritual', 'like', "%" . $request->search . "%")
                ->orWhere('deskripsi_sosial', 'like', "%" . $request->search . "%")
                ->paginate(15);
        else
            $predikatSikap =  PredikatSikap::query()->paginate(15);

        $data = ['predikatSikap' => $predikatSikap];

        if ($request->ajax())
            return view('includes.admin.list-predikat-sikap', $data);

        $data['search'] = $request->search ?? '';

        return view('dashboard.admin.predikat-sikap.index', $data);
    }

    public function create()
    {
        return view('dashboard.admin.predikat-sikap.create');
    }

    public function store(Request $request)
    {
        $input = $request->validate([
            'predikat' => 'required|max:2',
            'deskripsi_spiritual' => 'required',
            'deskripsi_sosial' => 'required',
        ]);

        PredikatSikap::query()->create($input);

        return redirect()->route('dashboard.admin.predikat-sikap.index')->with('success', 'Berhasil menambah predikat sikap');
    }

    public function edit(PredikatSikap $predikatSikap)
    {
        return view('dashboard.admin.predikat-sikap.edit', ['predikatSikap' => $predikatSikap]);
    }

    public function update(Request $request, PredikatSikap $predikatSikap)
    {
        $input = $request->validate([
            'deskripsi_spiritual' => 'required',
            'deskripsi_sosial' => 'required',
        ]);

        $predikatSikap->fill($input)->save();

        return redirect()->route('dashboard.admin.predikat-sikap.index')->with('success', 'Berhasil memperbarui data ekstrakurikuler');
    }

    public function destroy(PredikatSikap $predikatSikap)
    {
        $resp = redirect()->back();

        if ($predikatSikap) {
            $predikatSikap->delete();
            $resp = $resp->with('success', 'Berhasil menghapus predikat sikap');
        }

        return $resp;
    }
}
