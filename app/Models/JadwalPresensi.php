<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPresensi extends Model
{
    use HasFactory;

    protected $table = 'jadwal_presensi';
    protected $primaryKey = 'id_jadwal_presensi';
    public $timestamps = false;

    protected $fillable = ['semester', 'tanggal_mulai', 'tanggal_akhir'];
}
