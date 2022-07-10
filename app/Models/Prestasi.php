<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    use HasFactory;

    protected $table = 'prestasi';
    public $timestamps = false;

    protected $fillable = ['jenis_kegiatan', 'nis', 'keterangan', 'semester'];

    public function scopeSemester($query, $semester)
    {
        return $query->where('semester', $semester);
    }
}
