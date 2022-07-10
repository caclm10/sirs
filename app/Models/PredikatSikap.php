<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PredikatSikap extends Model
{
    use HasFactory;

    protected $table = 'predikat_sikap';
    protected $primaryKey = 'predikat';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'predikat',
        'deskripsi_spiritual',
        'deskripsi_sosial'
    ];
}
