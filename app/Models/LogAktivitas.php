<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogAktivitas extends Model
{
    protected $table = 'log_aktivitas';

    protected $fillable = [
        'user_id',
        'bahasa_id',
        'kategori_id',
        'kata_id',
        'aktivitas',
        'ip_address',
        'user_agent'
    ];

    public function bahasa()
    {
        return $this->belongsTo(Bahasa::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function kata()
    {
        return $this->belongsTo(Kata::class);
    }
    public function usulanKata()
    {
        return $this->belongsTo(UsulanKata::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}