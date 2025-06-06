<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('laporan_kesalahan', function (Blueprint $table) {
            $table->id();
            $table->string('pelapor_id')->nullable();
            $table->string('pelapor_type')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('kata_id')->constrained('kata')->onDelete('cascade');
            $table->enum('tipe_kesalahan', ['terjemahan', 'ejaan', 'arti', 'contoh_kalimat', 'media', 'lainnya']);
            $table->text('deskripsi');
            $table->string('bukti_path')->nullable();
            $table->enum('status', ['baru', 'diproses', 'selesai'])->default('baru');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_kesalahan');
    }
};
