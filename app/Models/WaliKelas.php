<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class WaliKelas extends Authenticatable
{
    use HasFactory;

    protected $table = 'wali_kelas';
    protected $primaryKey = 'nip';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = ['nip', 'nama_wali_kelas', 'password'];

    public function kelas()
    {
        return $this->hasOne(Kelas::class, 'nip', 'nip');
    }

    public function setNamaAttribute($value)
    {
        $this->attributes['nama_wali_kelas'] = $value;
    }

    public function getNamaAttribute()
    {
        return $this->nama_wali_kelas;
    }
}
