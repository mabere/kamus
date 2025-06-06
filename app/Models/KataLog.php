<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KataLog extends Model
{
    use HasFactory;

    protected $table = 'kata_log';

    protected $fillable = [
        'kata_id',
        'user_id',
        'pelapor_id',
        'pelapor_type',
        'field_changed',
        'old_value',
        'new_value',
        'description',
    ];

    public function kata()
    {
        return $this->belongsTo(Kata::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pelapor()
    {
        return $this->morphTo();
    }
}