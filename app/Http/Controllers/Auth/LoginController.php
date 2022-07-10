<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\WaliKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\MessageBag;

class LoginController extends Controller
{
    public function index()
    {
        // dd(Nilai::all());
        return view('auth.login', [
            'admin' => false
        ]);
    }

    public function authenticate(Request $request)
    {
        $nomor = $request->input('nomor');
        $password = $request->input('password');
        $guard = 'siswa';

        $user = Siswa::where('nis', $nomor)->first();

        if (!$user) {
            $guard = 'wali_kelas';
            $user = WaliKelas::where('nip', $nomor)->first();
        }

        $errorMessage = new MessageBag();

        if (!$user) {
            $errorMessage->add('nomor', $nomor ? 'NIS/NIP tidak ditemukan' : 'NIS/NIP harus diisi');
            if ($password == '')
                $errorMessage->add('password', 'Password harus diisi');
        } else {
            if (!Hash::check($password, $user->password))
                $errorMessage->add('password', $password ? 'Password salah' : 'Password harus diisi');
        }

        if (count($errorMessage->messages()) > 0) {
            return redirect()->back()->withErrors($errorMessage)->withInput();
        }

        Auth::guard($guard)->login($user);
        $request->session()->regenerate();

        return redirect()->route('dashboard.rapot.index');
    }
}
