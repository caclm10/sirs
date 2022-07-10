<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Nilai extends Pivot
{
    use HasFactory;

    public function isSemGanjil()
    {
        return $this->semester == 'ganjil';
    }
}
