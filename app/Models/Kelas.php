<?php

namespace App\Models;

use App\Helpers\Sekolah;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    public $timestamps = false;

    protected $fillable = ['tingkat', 'peminatan', 'ke', 'nip'];

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'id_kelas', 'id');
    }

    public function wali()
    {
        return $this->belongsTo(WaliKelas::class, 'nip', 'nip');
    }

    /**
     * Mendapatkan data kelas lengkap
     *
     * @return string
     */
    public function getNamaAttribute()
    {
        return Sekolah::kelasRomawi($this->tingkat) . ' ' . strtoupper($this->peminatan) . " " . ($this->ke < 10 ? "0{$this->ke}" : $this->ke);
    }
}
