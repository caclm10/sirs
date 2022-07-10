<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TanggalLibur extends Model
{
    use HasFactory;

    protected $table = 'tanggal_libur';
    protected $primaryKey = 'id_tanggal_libur';
    public $timestamps = false;

    protected $fillable = ['tanggal'];
}
