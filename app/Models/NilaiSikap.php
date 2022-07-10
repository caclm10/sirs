<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiSikap extends Model
{
    use HasFactory;

    protected $table = 'nilai_sikap';
    public $timestamps = false;

    protected $fillable = ['semester'];

    public function scopeSemester($query, $semester)
    {
        return $query->where('semester', $semester);
    }
}
