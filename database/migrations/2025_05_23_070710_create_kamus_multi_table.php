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
        // Tabel bahasa (menyimpan daftar bahasa daerah)
        Schema::create('bahasa', function (Blueprint $table) {
            $table->id();
            $table->string('nama_bahasa', 100)->unique();
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });

        // Tabel kategori (misal: kata benda, kerja)
        Schema::create('kategori', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kategori', 50);
            $table->timestamps();
        });

        // Tabel kata (kata utama dalam 3 bahasa)
        Schema::create('kata', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bahasa_id')->constrained('bahasa')->onDelete('cascade');
            $table->foreignId('kategori_id')->constrained('kategori')->cascadeOnDelete();
            $table->string('kata_daerah', 100);
            $table->string('kata_indonesia', 100);
            $table->string('kata_inggris', 100);
            $table->text('arti_daerah')->nullable();
            $table->text('arti_indonesia')->nullable();
            $table->text('arti_inggris')->nullable();
            $table->text('contoh_kalimat_daerah')->nullable();
            $table->text('contoh_kalimat_indonesia')->nullable();
            $table->text('contoh_kalimat_inggris')->nullable();
            $table->string('gambar_path')->nullable();
            $table->string('audio_path')->nullable();
            $table->integer('search_count')->default(0);
            $table->timestamps();
            $table->index(['kata_daerah', 'kata_indonesia', 'kata_inggris']);
        });

        // Tabel usulan_kata (untuk kontribusi pengguna)
        Schema::create('usulan_kata', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('bahasa_id')->constrained('bahasa')->onDelete('cascade');
            $table->foreignId('kategori_id')->constrained('kategori')->cascadeOnDelete();
            $table->string('kata_daerah', 100);
            $table->string('kata_indonesia', 100);
            $table->string('kata_inggris', 100);
            $table->text('arti_daerah')->nullable();
            $table->text('arti_indonesia')->nullable();
            $table->text('arti_inggris')->nullable();
            $table->text('contoh_kalimat_daerah')->nullable();
            $table->text('contoh_kalimat_indonesia')->nullable();
            $table->text('contoh_kalimat_inggris')->nullable();
            $table->string('gambar_path')->nullable();
            $table->string('audio_path')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('catatan_ahli')->nullable();
            $table->timestamps();
        });

        // Tabel log_aktivitas (untuk melacak usulan dan revisi)
        Schema::create('log_aktivitas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('kata_id')->nullable()->constrained('kata')->onDelete('set null');
            $table->foreignId('usulan_kata_id')->nullable()->constrained('usulan_kata')->onDelete('set null');
            $table->string('aksi', 50); // misal: 'usulan', 'approve', 'reject', 'edit'
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('log_aktivitas');
        Schema::dropIfExists('usulan_kata');
        Schema::dropIfExists('kata');
        Schema::dropIfExists('kategori');
        Schema::dropIfExists('bahasa');
    }
};