<?php

namespace App\Helpers;

use App\Models\PredikatSikap;

class SikapHelper
{
    public static function getDeskripsi(string $sikap = '', string | null $predikat = '')
    {
        if (!$predikat) return null;

        $col = "deskripsi_" . $sikap;
        return PredikatSikap::where('predikat', $predikat)
            ->first([$col])->$col;
    }
}
