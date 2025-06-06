<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\LaporanKesalahan;
use Illuminate\Support\Str;

class UpdateLaporanKesalahanPelapor extends Command
{
    protected $signature = 'laporan:update-pelapor';
    protected $description = 'Update pelapor_id dan pelapor_type untuk laporan kesalahan yang sudah ada';

    public function handle()
    {
        $laporanKesalahan = LaporanKesalahan::all();

        foreach ($laporanKesalahan as $laporan) {
            if (!$laporan->pelapor_id) {
                $laporan->update([
                    'pelapor_id' => $laporan->user_id ?? Str::uuid()->toString(),
                    'pelapor_type' => $laporan->user_id ? 'App\Models\User' : 'visitor',
                ]);
            }
        }

        $this->info('Pelapor ID dan Type berhasil diperbarui untuk semua laporan.');
    }
}