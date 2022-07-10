<?php

namespace App\Models;

use App\Helpers\Angka;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Siswa extends Authenticatable
{
    use HasFactory;

    protected $table = 'siswa';
    protected $primaryKey = 'nis';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = ['nis', 'nisn', 'nama_siswa', 'id_kelas', 'password'];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id');
    }

    public function mataPelajaran()
    {
        return $this->belongsToMany(MataPelajaran::class, 'nilai', 'nis', 'kode_mapel', 'nis', 'kode_mapel')
            ->as('nilai')
            ->using(Nilai::class)
            ->withPivot(['pengetahuan', 'keterampilan', 'semester', 'kd_pengetahuan', 'kd_keterampilan', 'kbm']);;
    }

    public function mataPelajaranSem(string $semester, $kode = null)
    {
        $query = $this->mataPelajaran()->wherePivot('semester', $semester);
        if ($kode)
            return $query->wherePivot('kode_mapel', $kode)->first();

        return $query->get();
    }

    public function mataPelajaranLintasMinat(string $semester)
    {
        return $this->mataPelajaran()
            ->wherePivot('semester', $semester)
            ->where('peminatan', $this->pem_lintas_minat)
            ->get();
    }

    public function ekstrakurikuler()
    {
        return $this->belongsToMany(Ekstrakurikuler::class, 'ekskul_siswa', 'nis', 'kode_ekskul', 'nis', 'kode_ekskul')
            ->withPivot(['nilai', 'semester', 'deskripsi'])
            ->using(EkskulSiswa::class);
    }

    public function ekskulSem(string $semester, string $kode = null)
    {
        $query = $this->ekstrakurikuler()->wherePivot('semester', $semester);
        if ($kode)
            return $query->wherePivot('kode_ekskul', $kode)->first();

        return $query->get();
    }

    public function nilaiSikap()
    {
        return $this->hasMany(NilaiSikap::class, 'nis', 'nis');
    }

    public function nilaiSikapSem(string $semester)
    {
        return $this->nilaiSikap()->semester($semester)->first();
    }

    public function prestasi()
    {
        return $this->hasMany(Prestasi::class, 'nis', 'nis');
    }

    public function prestasiSem(string $semester)
    {
        return $this->prestasi()->semester($semester)->get();
    }

    public function getNamaAttribute()
    {
        return $this->nama_siswa;
    }

    public function setNamaAttribute($value)
    {
        $this->attributes['nama_siswa'] = $value;
    }

    public function getPeminatanAttribute()
    {
        return $this->kelas->peminatan;
    }

    public function getPemLintasMinatAttribute()
    {
        return $this->peminatan == 'mipa' ? 'ips' : 'mipa';
    }

    public function presensi()
    {
        return $this->hasMany(Presensi::class, 'nis', 'nis');
    }
    public function presensiMingguan()
    {
        return $this->presensi()->mingguan();
    }
}
