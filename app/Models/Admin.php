<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $table = 'admin';
    protected $primaryKey = 'kode_admin';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = ['kode_admin', 'nama_admin', 'password'];

    public function getKodeAttribute()
    {
        return $this->kode_admin;
    }

    public function getNamaAttribute()
    {
        return $this->nama_admin;
    }

    public function setNamaAttribute($value)
    {
        $this->attributes['nama_admin'] = $value;
    }
}
