<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UsulanKata extends Model
{
    use HasFactory;

    protected $table = 'usulan_kata';

    protected $fillable = [
        'user_id',
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
        'status',
        'catatan_ahli'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

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
}