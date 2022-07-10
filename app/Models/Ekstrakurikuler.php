<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ekstrakurikuler extends Model
{
    use HasFactory;

    protected $table = 'ekstrakurikuler';
    protected $primaryKey = 'kode_ekskul';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = ['kode_ekskul', 'nama_ekskul'];

    public function getKodeAttribute()
    {
        return $this->kode_ekskul;
    }

    public function getNamaAttribute()
    {
        return $this->nama_ekskul;
    }

    public function setNamaAttribute($value)
    {
        $this->attributes['nama_ekskul'] = $value;
    }
}
