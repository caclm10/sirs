<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\MessageBag;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login', [
            'admin' => true
        ]);
    }

    public function authenticate(Request $request)
    {
        $kode = $request->input('kode');
        $password = $request->input('password');

        /** @var \App\Models\Admin $admin */
        $admin = Admin::query()->find($kode);

        $errorMessage = new MessageBag();

        if (!$admin) {
            $errorMessage->add('kode', $kode ? 'Kode admin tidak ditemukan' : 'Kode admin harus diisi');
            if ($password == '')
                $errorMessage->add('password', 'Password harus diisi');
        } else {
            if (!Hash::check($password, $admin->password))
                $errorMessage->add('password', $password ? 'Password salah' : 'Password harus diisi');
        }

        if (count($errorMessage->messages()) > 0) {
            return redirect()->back()->withErrors($errorMessage)->withInput();
        }

        Auth::guard('admin')->login($admin);
        $request->session()->regenerate();

        return redirect()->route('dashboard.admin.siswa.index');
    }
}
