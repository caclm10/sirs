<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class ProfileController extends Controller
{
    public function index()
    {
        return view('dashboard.profile.index');
    }

    public function update(Request $request)
    {
        /** @var \App\Interfaces\AuthUser $user */
        $user = auth()->user();

        $activeGuard = AppHelper::getActiveGuard();

        $validationRules = [
            'password' => 'nullable|min:4|max:16',
            'password_lama' => 'required_with:password',
        ];

        $input = $request->input();

        if ($activeGuard == 'admin') $validationRules['nama'] = 'required|min:3|max:50';

        $validator = Validator::make($input, $validationRules);

        $manualErrors = new MessageBag();
        if ($input['password'] && $input['password_lama'] && !Hash::check($input['password_lama'], $user->password)) {
            $manualErrors->add('password_lama', 'Password lama salah');
        }

        if ($manualErrors->any()) {
            if ($validator->fails()) {
                $errors = $validator->errors();
                $errors->merge($manualErrors);
            } else {
                $errors = $manualErrors;
            }
            return back()->withErrors($errors);
        }

        $data = [];
        if ($activeGuard == 'admin') $data['nama_admin'] = $input['nama'];
        if ($input['password']) $data['password'] = bcrypt($input['password']);

        $user->update($data);

        return redirect()->back()->with('success', 'Berhasil memperbarui profil');
    }
}
