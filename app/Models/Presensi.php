<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;
    protected $table = 'presensi';
    protected $primaryKey = 'id_presensi';
    public $timestamps = false;
    protected $fillable = ['tanggal_hadir', 'keterangan', 'waktu_hadir'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nis', 'nis');
    }


    public function scopeMingguan($query)
    {
        $start = now()->startOfWeek()->addDays(-1);
        $end = now()->endOfWeek();
        return $query
            ->where('tanggal_hadir', '>', $start)
            ->where('tanggal_hadir', '<', $end)
            ->limit(6)
            ->orderBy('tanggal_hadir', 'ASC');
    }
}
