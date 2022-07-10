<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $admin = null;
        $columns = ['kode_admin', 'nama_admin'];

        if ($request->search || $request->search === "") {
            $query = Admin::query()
                ->where('kode_admin', 'like', "%" . $request->search . "%")
                ->orWhere('nama_admin', 'like', "%" . $request->search . "%");


            if ($request->input('ganti-wali') == "1") {
                $admin = $query->limit(5)->get($columns);
            } else {
                $admin = $query->paginate(15, $columns);
            }
        } else {
            $admin =  Admin::query()->paginate(15, $columns);
        }

        if ($request->ajax()) {
            return view('includes.admin.list-admin', [
                'admin' => $admin
            ]);
        }

        return view('dashboard.admin.admin.index', [
            'admin' => $admin,
            'search' => $request->search ?? ''
        ]);
    }

    public function create()
    {
        return view('dashboard.admin.admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:50',
        ], [
            'nama.required' => 'Nama harus diisi',
            'nama.max' => 'Nama maksimum 50 karakter',
        ]);

        $kodeAdmin = 'ADM-0001';
        $latestAdmin = Admin::orderBy('kode_admin', 'DESC')->first(['kode_admin']);
        if ($latestAdmin) {
            $number = ((int) explode('-', $latestAdmin->kode_admin)[1] + 1);
            if ($number < 1000) $number = '0' . (string) $number;
            $kodeAdmin = 'ADM' . '-' . $number;
        }

        Admin::query()->create([
            'kode_admin' => $kodeAdmin,
            'nama_admin' => $request->nama,
            'password' => bcrypt('admin'),
        ]);

        return redirect()->route('dashboard.admin.admin.index')->with('success', 'Berhasil menambah admin');
    }

    public function edit(Admin $admin)
    {
        return view('dashboard.admin.admin.edit', [
            'admin' => $admin
        ]);
    }

    public function update(Request $request, Admin $admin)
    {
        $request->validate([
            'nama' => 'required|string|max:50',
        ], [
            'nama.required' => 'Nama harus diisi',
            'nama.max' => 'Nama maksimum 50 karakter',
        ]);

        $admin->nama = $request->nama;
        $admin->save();

        return redirect()->route('dashboard.admin.admin.index')->with('success', 'Berhasil memperbarui data admin');
    }

    public function destroy(Admin $admin)
    {
        if ($admin) {
            $admin->delete();
            session()->flash('success', 'Berhasil menghapus data admin');
        }

        return redirect()->route('dashboard.admin.admin.index');
    }
}
