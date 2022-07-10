<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class AppHelper
{
    public static function getActiveGuard($isTitle = false)
    {
        $guards = ["admin", "siswa", "wali_kelas"];

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {

                return $isTitle ? str_replace("_", " ", $guard) : $guard;
            }
        }

        return null;
    }

    public static function isGuruGuard()
    {
        return self::getActiveGuard() == 'guru';
    }

    public static function isWaliKelasGuard()
    {
        return self::getActiveGuard() == 'wali_kelas';
    }
}
