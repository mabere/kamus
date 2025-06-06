<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kata extends Model
{
    use HasFactory;

    protected $table = 'kata';

    protected $fillable = [
        'bahasa_id',
        'kategori_id',
        'kata_daerah',
        'kata_indonesia',
        'kata_inggris',
        'arti_daerah',
        'arti_indonesia',
        'arti_inggris',
        'contoh_kalimat_daerah',
        'contoh_kalimat_indonesia',
        'contoh_kalimat_inggris',
        'gambar_path',
        'audio_path',
        'search_count'
    ];

    public function bahasa()
    {
        return $this->belongsTo(Bahasa::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function logs()
    {
        return $this->hasMany(LogAktivitas::class);
    }

    public function logsKata()
    {
        return $this->hasMany(KataLog::class);
    }

    public function laporanKesalahan()
    {
        return $this->hasMany(LaporanKesalahan::class);
    }

}