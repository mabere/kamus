<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';

    protected $fillable = [
        'nama_kategori',
        'slug',
        'deskripsi',
        'gambar_path',
        'audio_path',
        'status'
    ];

    public function kata()
    {
        return $this->hasMany(Kata::class);
    }

    public function usulanKata()
    {
        return $this->hasMany(UsulanKata::class);
    }
    public function logs()
    {
        return $this->hasMany(LogAktivitas::class);
    }
    public function bahasa()
    {
        return $this->hasMany(Bahasa::class);
    }
}