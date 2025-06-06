<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bahasa extends Model
{
    protected $table = 'bahasa';
    protected $fillable = [
        'nama_bahasa',
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
}