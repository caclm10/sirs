<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    use HasFactory;

    protected $table = 'mata_pelajaran';
    protected $primaryKey = 'kode_mapel';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = ['kode_mapel', 'nama_mapel', 'kelompok', 'peminatan'];

    public function siswa()
    {
        return $this->belongsToMany(Siswa::class, 'nilai', 'kode_mapel', 'nis', 'kode_mapel', 'nis');
    }

    public static function peminatan(string $peminatan, $except = []): Collection
    {
        $query = self::where('peminatan', $peminatan)
            ->where('kelompok', 'c');

        if (!empty($except)) $query->whereNotIn('kode_mapel', $except);

        return $query->get();
    }

    public static function umum(string $kelompok = null)
    {
        $query = self::where('peminatan', 'umum');

        if ($kelompok) $query->where('kelompok', $kelompok);

        return $query->get();
    }

    public function getKodeAttribute()
    {
        return $this->kode_mapel;
    }

    public function getNamaAttribute()
    {
        return $this->nama_mapel;
    }

    public function setNamaAttribute($value)
    {
        $this->attributes['nama_mapel'] = $value;
    }
}
