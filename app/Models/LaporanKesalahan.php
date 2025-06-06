<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanKesalahan extends Model
{
    protected $table = 'laporan_kesalahan';

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kata()
    {
        return $this->belongsTo(Kata::class);
    }

}